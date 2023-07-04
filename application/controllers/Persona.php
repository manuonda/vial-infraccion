
<?php


    /**
      ***************************
      * Clase correspondiente a 
      * Persona Controller
      * @author : dgarcia
      **/ 
   class Persona extends MY_Controller{


    /**
      * Constructor para cargar las librerias 
      * necesarias
      */
    function __construct(){
       parent::__construct();
        
        //library y helpers
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');

        //model
        $this->load->model('expediente_model');
        $this->load->model('calle_model');
        $this->load->model('barrio_model');
        $this->load->model('localidad_model');
        $this->load->model('departamento_model');
        $this->load->model('persona_model');
        
        
        $this->load->model('tipovehiculo_model');
        $this->load->model('marca_model');
        $this->load->model('modelo_model');
      

        //modal de leyes 
        $this->load->model('ley_model');
        //estado 
        $this->load->model('estado_model');

        $this->load->model('infraccion_model');
        $this->load->model('infraccionpago_model');
        $this->load->model('infraccionpagocuota_model');
        $this->load->model('configuracion_model');
        $this->load->model('rol_model');
        $this->load->model('infraccionley_model');
        $this->load->model('destacamento_model');
        $this->load->model('provincia_model');
        $this->load->model('pais_model');

    } 
 

    /**
     *  Index
     */
   	public function index($filter=null,$message=null,$status=null){
       if ($this->ion_auth->logged_in()) {
       	    
            //$this->data['expedientes']=$this->expediente_model->get_all();

            //filter vial 
            if($filter==null){
            $filter['tipo_expediente']='V';
            $filter['numero_expediente']=null;
            $filter['numero_acta']=null;
            $filter['fecha_desde']=null;
            $filter['fecha_hasta']=null;
            $filter['propietario']=null;
            $filter['nombre']=null;
            $filter['apellido']=null;
            $filter['dni']=null;
            $filter['dominio']=null;
            }
            
            $this->data['message']=$message; 
            $this->data['status']=$status;
            $this->data['contenido'] = "vial/index_view.php";
            $this->data['titulo']="Infracciones / Viales";
            $this->data['filter']=$filter;
            $this->data['infracciones']=$this->infraccion_model->buscar($filter);


            $this->data['departamentos']=$this->departamento_model->get_all(9); //provincia de jujuy = 9
            $this->load->view('template', $this->data);
        } else {
            redirect('admin/login');
        }
   

   	}

   
    /**
      * Funcion que permite agregar 
      * un expediente cargando la vista 
      * del expediente
      **/
    public function agregar(){
      $this->data['contenido']="vial/create_view.php";
      $this->data['tipovehiculos']=$this->tipovehiculo_model->get_all();
      $this->data['provincias']=$this->provincia_model->get_all();
      $this->data['titulo']="Infracciones / Vial";
      $this->data['subtitulo']="Agregar Infracción Vial";
      $this->data['idTipoVehiculo']="";
      $this->data['idMarca']="";
      $this->data["idModelo"]="";
      $this->data['detalleInfracciones']=null;
      $this->data['marcas']=null;
      $this->data['modelos']=null;
      $this->data['domiciliosPropietario']=null;
      $this->data['involucrado']=null;
      $this->data['propietario']=null;
      $this->data['domiciliosInvolucrado']=null;
      $this->data['destacamentos']=$this->destacamento_model->get_all();
      $this->data['paises']=$this->pais_model->get_all();
      $this->data['departamentos']=null;
      $this->data['localidades'] =null;


      //Obtenemos el valor de unidad uf
      $configuracion=$this->configuracion_model->getById(1);
      $this->data['valor_unidad_uf']=$configuracion->valor_unidad_uf;
        /////////////////////////////////////////////////////////
        //filter leyes 
         //Obtenemos las leyes filtrado por el 
        //rol , que dependiendo de este Vial o Contravencional 
        //Se obtiene los tipos de leyes 
        $tipo_infraccion=$this->rol_model->getTipoInfraccionByRol($this->session->userdata('user_id')); 
        $filterLeyes=[];
        $filterLeyes['nombre']=null;
        if($tipo_infraccion!=null){
            $filterLeyes['tipo_infraccion']='V';
        }
        $this->data['leyes']=$this->ley_model->buscar($filterLeyes);
        ///////////////////////////////////////////////////////////////
       
      
        // == Leyes
        $this->data['detalleLeyes']=null;           
        $this->load->view('template',$this->data);

    }

     /** Funcion que permite poder 
       * editar una contravencion 
       * @param : $idContravencion
       */
     public function editar($idInfraccion){
       $this->data['contenido']="vial/create_view.php";

       $infraccion=$this->infraccion_model->getById($idInfraccion);

       //componentes
       $this->data['id']=$infraccion->id_infraccion;  
       $this->data['provincias']=$this->provincia_model->get_all();
       $this->data['departamentos']=$this->departamento_model->findByProvincia($infraccion->id_provincia);
       $this->data['localidades']=$this->localidad_model->findByDepartamento($infraccion->id_departamento);
       $this->data['destacamentos']=$this->destacamento_model->get_all();      
      $this->data['paises']=$this->pais_model->get_all();  
 
       //********************************************
       //Datos del vehiculo 
       $modelo=null;
       $id_marca=null;
       $id_tipovehiculo=null;
       $id_modelo=null;
       $modelos=null;
       
       $this->data['dominio']=$infraccion->dominio;

       if($infraccion->id_modelo!=null){
          $modelo=$this->modelo_model->getById($infraccion->id_modelo);
          $id_modelo=$modelo->id_modelo;
          $modelos=$this->modelo_model->getByMarca($modelo->id_marca);;
       }


       $fecha_ingreso = date('Y-m-d',strtotime($infraccion->fecha_ingreso));
       $fecha_hecho  =date('Y-m-d',strtotime($infraccion->fecha_hecho));

       
       
       $marca=null;
       $marcas=null;
       $id_marca=null;
       if($modelo!=null){
          $marca=$this->marca_model->getById($modelo->id_marca);
          $marcas=$this->marca_model->getByTipoVehiculo($marca->id_tipovehiculo);
          $id_marca=$marca->id_marca;
       }
      
       $tipovehiculo=null;
       $id_tipovehiculo=null;
       if($marca!=null){
         $id_marca=$marca->id_marca;
         $tipovehiculo=$this->tipovehiculo_model->getById($marca->id_tipovehiculo); 
         $id_tipovehiculo=$tipovehiculo->id_tipovehiculo;
       } 
       
       //cargamos los selects 
       $this->data['tipovehiculos']=$this->tipovehiculo_model->get_all();
       $this->data['marcas']=$marcas;
       $this->data['modelos']=$modelos;

      

       $this->data['id_modelo']=$id_modelo;
       $this->data['id_marca']=$id_marca;
       $this->data['id_tipovehiculo']=$id_tipovehiculo;
      
    

      //Leyes - Detalle de la infraccion 
      $leyes=$this->infraccionley_model->getByIdInfraccion($idInfraccion);
      $this->data['detalleLeyes']=$leyes;
        /////////////////////////////////////////////////////////
        //filter leyes 
         //Obtenemos las leyes filtrado por el 
        //rol , que dependiendo de este Vial o Contravencional 
        //Se obtiene los tipos de leyes 
        //$tipo_infraccion=$this->rol_model->getTipoInfraccionByRol($this->session->userdata('user_id')); 
        $filterLeyes=[];
        $filterLeyes['nombre']=null;
        $filterLeyes['tipo_infraccion']='V';
        /*
        if($tipo_infraccion!=null){
            $filterLeyes['tipo_infraccion']='V';
        }*/
        $this->data['leyes']=$this->ley_model->buscar($filterLeyes);
        ///////////////////////////////////////////////////////////////
      
       //*****************************************************
       //Datos del propietario y conductor
      
      
       $involucrado=null;
       $domiciliosInvolucrado=null;
       $propietario=null;
       $domiciliosPropietario=null;

       if($infraccion->cuil_involucrado!=null){
         $involucrado=$this->persona_model->getInformacion($infraccion->cuil_involucrado);
         $domiciliosInvolucrado=$this->getRowsDomicilioActionHtml($infraccion->cuil_involucrado,'Involucrado');
       } 
       
       if($infraccion->cuil_propietario!=null){
        $propietario=$this->persona_model->getInformacion($infraccion->cuil_propietario);
        $domiciliosPropietario=$this->getRowsDomicilioActionHtml($infraccion->cuil_propietario,'Propietario');

       }
       


    

      
       
       

       $this->data['involucrado']=$involucrado;
       $this->data['domiciliosInvolucrado']=$domiciliosInvolucrado;
       


       $this->data['propietario']=$propietario;
       $this->data['domiciliosPropietario']=$domiciliosPropietario;

       $this->data['fecha_ingreso']=$fecha_ingreso;
       $this->data['fecha_hecho']=$fecha_hecho;
       $this->data['infraccion']=$infraccion;
            
        
       //Contravenciones titulos
       $this->data['titulo']='Infracciones / Vial';
       $this->data['subtitulo']="Editar Expediente Vial";
       $this->load->view('template',$this->data);
        
    }
    
    /**Funcion que permite obtener los 
      * datos a filtrar de la busqueda mediante 
      * post
      * @param : post, parameters
      */

    public function buscar(){
     
       $this->filter['numero_acta']=$_POST['numero_acta'];
       $this->filter['fecha_desde']=$_POST['fecha_desde'];
       $this->filter['fecha_hasta']=$_POST['fecha_hasta'];
 
       $this->filter['dni']=$_POST['dni'];
       $this->filter['dominio']=$_POST['dominio'];

       $this->index($this->filter);     
    }

     /**
       * Funcion que permite verificar 
       * que el numero de acta no existe en la 
       * tabla de infracciones viales
      **/
     public function existeNumeroActa($numeroActa){
        $infraccion=$this->infraccion_model->existeNumeroActa($numeroActa);
        return $infraccion;
     }

    /**
      * Funcion que permite guardar la 
      * informacion
     **/
    public function guardar(){

        $status="";
        $message="";

   
        
        //Id infraccion
        $this->data['id'] = $this->input->post('id');
        //Section - Expediente
        $this->data['numero_expediente'] =  $this->input->post('numero_expediente');
        $this->data['fecha_ingreso'] = $this->input->post('fecha_ingreso');
        $this->data['numero_acta'] = trim($this->input->post('numero_acta'));
        $this->data['numero_expediente_entrante'] =$this->input->post('numero_expediente_entrante');
        $this->data['seccion']=$this->input->post('seccion');
        $this->data['paquete']=$this->input->post('paquete');



        //Section -  Lugar del hecho
        $this->data['fecha_hecho']   = $this->input->post('fecha_hecho');
        $this->data['hora_hecho']    = $this->input->post('hora_hecho');
        $this->data['provincia']     = $this->input->post('provincia'); 
        $this->data['departamento']  = $this->input->post('departamento');
        $this->data['localidad']     = $this->input->post('localidad');
        $this->data['barrio']        = $this->input->post('barrio');
        $this->data['calle']         = $this->input->post('calle');
        $this->data['numero']        = $this->input->post('numero');
        $this->data['destacamento']  = $this->input->post('destacamento');
        $this->data['lugar_hecho']   = $this->input->post('lugar_hecho');

      

        //Datos del vehiculo 
        $this->data['tipovehiculo'] =$this->input->post('tipovehiculo');
        $this->data['marca']=$this->input->post('marca');
        $this->data['modelo']=$this->input->post('modelo');
        $this->data['dominio']=$this->input->post('dominio');


        //Propietario y Involucrado 
        $this->data['propietario']       = $this->input->post('propietario');
        $this->data['involucrado']         = $this->input->post('involucrado');
        $this->data['documentoPropietario'] =$this->input->post('numeroDocumentoPropietario');
        $this->data['documentoInvolucrado']=$this->input->post('numeroDocumentoInvolucrado');


       //Descripcion Ley
       $this->data['descripcion'] = $this->input->post('descripcion');   

       //Tipo de Expediente 
       $this->data['tipo_expediente'] ='V'; 

        //Dictamen 
        $this->data['dictamen'] =$this->input->post('dictamen');

        //Importe 
        $this->data['importe']=$this->input->post('importe');

        //Leyes
        $leyes[]=$this->input->post('leyes');

        //Informacion Restantes 
        $this->data['numero_licencia']=$this->input->post('numero_licencia');
        $this->data['categoria']=$this->input->post('categoria');
        $this->data['autoridad']=$this->input->post('autoridad');
        $this->data['fecha_expedicion']=$this->input->post('fecha_expedicion');
        $this->data['fecha_vencimiento']=$this->input->post('fecha_vencimiento');
      

        $infraccionEncontrada = null;
        $infraccionEncontrada =$this->existeNumeroActa(trim($this->input->post('numero_acta')));
        
           
        if(empty($this->data['id'])) {

              if($infraccionEncontrada == null){
                
                $this->data['id'] = $this->infraccion_model->insert($this->data);
                //agregamos el estado al expediente 
                $this->estado['id_contravencion']=$this->data['id'];
                $this->estado['id_estado']=1;
                $this->estado['observacion']='Inicio de Expediente';

                
                //Guardamos las leyes 
                $this->infraccionley_model->agregarLeyesInfraccion($this->input->post('leyes'),$this->data['id']);
               
               
                $status="OK";
                $message="Se guardo el registro de Infraccion";
              
              }else{

                $status="ERROR";
                $message="El número de acta existe en el sistema";     
              }   

         }else {
              
               if( isset($infraccionEncontrada) && $infraccionEncontrada->id_infraccion == $this->data['id']){
               
                $this->data['id_']=$this->infraccionley_model->agregarLeyesInfraccion($this->input->post('leyes'),$this->data['id']);
                $this->infraccion_model->update($this->data);
                $status="OK";
                $message="Se actualizo la infraccion";
              }else{

                $status="ERROR";
                $message="El número de acta existe en el sistema"  ;     
              }
          
       }

       


     

        $json=[
              "status"=>$status,
              "message"=>$message
              ] ;
        
       echo json_encode($json);
       return;      
    }




   



   }
?>