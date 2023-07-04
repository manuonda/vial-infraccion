
<?php


    /**
      ***************************
      * Clase correspondiente a Multas 
      * de Direccion Vial
      * @dathe  : 06-10-2017
      * @author : dgarcia
      **/ 
   class DireccionVial extends MY_Controller{


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
        
        $this->load->model('contravencion_model');
        
        $this->load->model('tipovehiculo_model');
        $this->load->model('marca_model');
        $this->load->model('modelo_model');
        $this->load->model('contravencionarticuloinciso_model');

        //modal de leyes 
        $this->load->model('ley_model');
        //estado 
        $this->load->model('estado_model');


    } 
 

    /**
     *  Index
     */
   	public function index($filter=null){
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
  
            }
            

            $this->data['contenido'] = "vial/index_view.php";
            $this->data['titulo']="Contravenciones / Viales";
            $this->data['contravenciones']=$this->contravencion_model->buscar($filter);
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
      $this->data['departamentos']=$this->departamento_model->findByProvincia(9); //provinica de jujuy  9
      $this->data['titulo']="Contravenciones / Expediente";
      $this->data['subtitulo']="Agregar Expediente";
      $this->data['idTipoVehiculo']="";
      $this->data['idMarca']="";
      $this->data["idModelo"]="";
      $this->data['detalleInfracciones']=null;
      $this->data['marcas']="";
      $this->data['leyes']=$this->ley_model->get_all();
      $this->load->view('template',$this->data);

    }

     /** Funcion que permite poder 
       * editar una contravencion 
       * @param : $idContravencion
       */
     public function editar($idContravencion){
       $this->data['contenido']="vial/create_view.php";

       $contravencion=$this->contravencion_model->getById($idContravencion);

      
       //componentes
       $this->data['id']=$contravencion->id_contravencion;  
       $this->data['num_exp_vial']=$contravencion->num_exp_vial;
       $this->data['fecha_ingreso']=$contravencion->fecha_ingreso;
       $this->data['num_acta_vial']=$contravencion->num_acta_vial;
       $this->data['num_exp_vial_entrante'] =$contravencion->num_exp_vial_entrante;
       $this->data['seccion']=$contravencion->seccion;
       $this->data['paquete']=$contravencion->paquete;
       
       
       //***********************************************
       //Lugar del hecho 
       $this->data['fecha_hecho']=$contravencion->fecha_hecho;
       $this->data['hora_hecho']=$contravencion->hora_hecho;
       $calle=$this->calle_model->getById($contravencion->id_calle);
       $barrio=$this->barrio_model->getById($calle->id_barrio);
       $localidad=$this->localidad_model->getById($barrio->id_localidad);
       $departamento=$this->departamento_model->getById($localidad->id_departamento);
       
       $this->data['id_calle']=$calle->id_calle;
       $this->data['id_barrio']=$barrio->id_barrio;
       $this->data['id_localidad']=$localidad->id_localidad;
       $this->data['id_departamento']=$departamento->id_departamento;

       $this->data['departamentos']=$this->departamento_model->findByProvincia(9);
       $this->data['localidades']=$this->localidad_model->findByDepartamento($localidad->id_departamento);
       $this->data['barrios']=$this->barrio_model->findByLocalidad($barrio->id_localidad);
       $this->data['calles']=$this->calle_model->findByBarrio($calle->id_barrio);

      

       //********************************************
       //Datos del vehiculo 
       $this->data['dominio']=$contravencion->dominio;
       $modelo=$this->modelo_model->getById($contravencion->id_modelo);
       
       $marca=$this->marca_model->getById($modelo->id_marca);
       $tipovehiculo=$this->tipovehiculo_model->getById($marca->id_tipovehiculo);
   
       //cargamos los selects 
       $this->data['tipovehiculos']=$this->tipovehiculo_model->get_all();
       $this->data['marcas']=$this->marca_model->getByTipoVehiculo($marca->id_tipovehiculo);
       $this->data['modelos']=$this->modelo_model->getByMarca($modelo->id_modelo);

      

       $this->data['id_modelo']=$modelo->id_modelo;
       $this->data['id_marca']=$marca->id_marca;
       $this->data['id_tipovehiculo']=$tipovehiculo->id_tipovehiculo;
      
    

      //Leyes - Detalle de la infraccion 
      $leyes=$this->contravencionarticuloinciso_model->getByIdContravencion($idContravencion);
      $this->data['detalleInfracciones']=$leyes;
      $this->data['leyes']=$this->ley_model->get_all();
    
      

       //*****************************************************
       //Datos del propietario y conductor
       $propietario=$this->persona_model->getInformacion($contravencion->cuil_propietario);
       $conductor=$this->persona_model->getInformacion($contravencion->cuil_conductor);
       $domicilioPropietario=$this->persona_model->get_domicilios($contravencion->cuil_propietario);
       $domicilioConductor=$this->persona_model->get_domicilios($contravencion->cuil_conductor);



       $this->data['propietario']=$propietario;
       $this->data['conductor']=$conductor;  
       $this->data['domiciliosPropietario']=$domicilioPropietario;
       $this->data['domiciliosConductor']=$domicilioConductor;

       //Contravenciones titulos
       $this->data['titulo']='Contravenciones / Expediente';
       $this->data['subtitulo']="Editar Expediente";
       $this->load->view('template',$this->data);

    }
    
    /**Funcion que permite obtener los 
      * datos a filtrar de la busqueda mediante 
      * post
      * @param : post, parameters
      */

    public function buscar(){
       $this->filter['numero_expediente']=$this->input->post('numero_expediente');
       $this->filter['numero_acta']=$this->input->post('numero_acta');
       $this->filter['fecha_desde']=$this->input->post('fecha_desde');
       $this->filter['fecha_hasta']=$this->input->post('fecha_hasta');
       $this->filter['propietario']=$this->input->post('propietario');

       //en este caso es de tipo 
    
      
       $this->index($this->filter);     
    }

    /**
      * Funcion que permite guardar la 
      * informacion
     **/
    public function guardar(){
        $this->data['id'] = $this->input->post('id');
        //Section - Expediente
        $this->data['numero_expediente'] =  $this->input->post('numero_expediente');
        $this->data['fecha_ingreso'] = $this->input->post('fecha_ingreso');
        $this->data['numero_acta'] = $this->input->post('numero_acta');
        $this->data['numero_expediente_entrante'] =$this->input->post('numero_expediente_entrante');
        $this->data['seccion']=$this->input->post('seccion');
        $this->data['paquete']=$this->input->post('paquete');



        //Section -  Lugar del hecho
        $this->data['fecha_hecho']   = $this->input->post('fecha_hecho');
        $this->data['hora_hecho']    = $this->input->post('hora_hecho');
        $this->data['departamento']  = $this->input->post('departamento');
        $this->data['localidad']     = $this->input->post('localidad');
        $this->data['barrio']        = $this->input->post('barrio');
        $this->data['calle']         = $this->input->post('calle');
        $this->data['numero']        = $this->input->post('numero');

      

        //Datos del vehiculo 
        $this->data['tipovehiculo']=$this->input->post('tipovehiculo');
        $this->data['marca']=$this->input->post('marca');
        $this->data['modelo']=$this->input->post('modelo');
        $this->data['dominio']=$this->input->post('dominio');


        //Propietario y Conductor 
        $this->data['propietario']       = $this->input->post('propietario');
        $this->data['conductor']         = $this->input->post('conductor');


       //Tipo de Expediente 
       $this->data['tipo_expediente'] ='V'; 

        //Dictamen 
        $this->data['dictamen'] =$this->input->post('dictamen');

        //Importe 
        $this->data['importe']=$this->input->post('importe');

        //Estado del expediente
        $estado=$this->estado_model->getById(1);//Es el estado inicial del expediente
        $this->data['estado']=$estado->nombre;

        //Leyes
        $leyes[]=$this->input->post('leyes');
        //$this->data['leyes']=$leyes;



        

      
        //$this->form_validation->set_rules('num_exp_vial', 'Expediente Vial', 'required');
        //$this->form_validation->set_rules('fecha_ingreso', 'Fecha Ingreso', 'required');
        //$this->form_validation->set_rules('num_acta_vial','Numero Acta Vial','required');

    
        //if($this->form_validation->run() === true) {
           
            if(empty($this->data['id'])) {
                $this->data['id'] = $this->contravencion_model->insert($this->data);
                //agregamos el estado al expediente 
                $this->estado['id_contravencion']=$this->data['id'];
                $this->estado['id_estado']=1;
                $this->estado['observacion']='Inicio de Expediente';

              
                
                $this->index(null);
            }else {
                $this->contravencion_model->update($this->data);
                $this->index($this->input->post('fecha_alta'));
            }

    }


   }

?>