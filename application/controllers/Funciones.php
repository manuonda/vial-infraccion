
<?php


    /**
      ***************************
      * Clase correspondiente a Multas 
      * de Direccion Vial
      * @dathe  : 06-10-2017
      * @author : dgarcia
      **/ 
   class Funciones extends MY_Controller{


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
        $this->load->model('contravencionarticuloinciso_model');

        //modal de leyes 
        $this->load->model('ley_model');
        //estado 
        $this->load->model('estado_model');
        $this->load->model('contravencionestado_model');
        $this->load->model('funciones_model');


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
      $this->data['contenido']="funciones/create_view.php";
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
     public function editar($idFuncion){
       $this->data['contenido']="funciones/create_view.php";

       $funcion=$this->funciones_model->getById($idFuncion);

       //Contravenciones titulos
       $this->data['funcion']=$funcion;
       $this->data['titulo']='Funcion';
       $this->data['subtitulo']="Editar Función";
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
      
            if(empty($this->data['id'])) {
                //agregamos el estado al expediente 
                $this->estado['id_contravencion']=$this->data['id'];
                $this->estado['id_estado']=1;
                $this->estado['observacion']='Inicio de Expediente';

                //Guardamos el estado
                
                $this->index(null);
            }else {
                $this->contravencion_model->update($this->data);
                $this->index($this->input->post('fecha_alta'));
            }

      

    }


   }

?>