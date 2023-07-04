
<?php


    /**
      ***************************
      * Clase correspondiente a Seccion 
      * Esta clase contiene los grupo 
      * secciones del sistema
      * del sistema
      * @dathe  : 17/4/18
      * @author : dgarcia
      **/ 
   class Gruposeccion extends MY_Controller{


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

     
        $this->load->model('gruposeccion_model');


    } 
 

    /**
     *  Index
     */
      public function index($filter=null,$message=null,$status=null){
       if ($this->ion_auth->logged_in()) {
       	    
            //$this->data['expedientes']=$this->expediente_model->get_all();

            //filter vial 
            if($filter==null){
              $filter['nombre']=null;
            }
            
            $this->data['message']=$message;
            $this->data['contenido'] = "gruposeccion/index_view.php";
            $this->data['titulo']="Grupo Seccion";
            $this->data['gruposeccion']=$this->gruposeccion_model->buscar($filter);
           
            $this->load->view('template', $this->data);
        } else {
            redirect('admin/login');
        }
   

   	}


    /**
      * Funcion que permite agregar 
      * una seccion
      **/
    public function agregar(){
      $this->data['contenido']="gruposeccion/create_view.php";
      $this->data['titulo']="Grupo Seccion";
      $this->data['subtitulo']="Agregar Grupo Seccion";
      $this->load->view('template',$this->data);

    }

     /** Funcion que permite poder 
       * editar una seccion 
       * @param : $id
       */
     public function editar($id){
       $this->data['contenido']="gruposeccion/create_view.php";

       $gruposeccion=$this->gruposeccion_model->getById($id);

       //Contravenciones titulos
       $this->data['gruposeccion']=$gruposeccion;
       $this->data['titulo']='Grupo Seccion';
       $this->data['subtitulo']="Editar Grupo Seccion";
       $this->load->view('template',$this->data);

    }
    
    /**Funcion que permite obtener los 
      * datos a filtrar de la busqueda mediante 
      * post
      * @param : post, parameters
      */

    public function buscar(){
       $this->filter['nombre']=$this->input->post('nombre');
      
       $this->index($this->filter);     
    }

    /**
      * Funcion que permite guardar la 
      * informacion
     **/
    public function guardar(){
        $this->data['id'] = $this->input->post('id');
        //Campos
        $this->data['name'] =  $this->input->post('name');
        $this->data['description'] = $this->input->post('description');
      
            if(empty($this->data['id'])) {
                $this->data['id'] = $this->gruposeccion_model->insert($this->data);
                $message="Se agrego Grupo Seccion";
                $this->index(null,$message,null);
            }else {
                $this->gruposeccion_model->update($this->data);
                $this->index(null,"Se actualizo el Grupo Seccion",null);
            }
    }


   }

?>