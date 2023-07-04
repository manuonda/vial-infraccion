
<?php


    /**
      ***************************
      * Clase correspondiente a Seccion 
      * Esta clase contiene las secciones
      * del sistema
      * @dathe  : 17/4/18
      * @author : dgarcia
      **/ 
   class Seccion extends MY_Controller{


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

     
        $this->load->model('seccion_model');
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
            $this->data['contenido'] = "seccion/index_view.php";
            $this->data['titulo']="Secciones";
            
            $this->data['secciones']=$this->seccion_model->buscar($filter);
           
            $this->load->view('template', $this->data);
        } else {
            redirect('admin/login');
        }
   

   	}


    /**
      * Funcion que permite agregar 
      * una seccion
      **/
    public function create(){
      $this->data['contenido']="seccion/create_view.php";
      $this->data['titulo']="Seccion";
      $this->data['grupos']=$this->gruposeccion_model->get_all();
      $this->data['subtitulo']="Agregar Seccion";
      $this->load->view('template',$this->data);

    }

     /** Funcion que permite poder 
       * editar una seccion 
       * @param : $id
       */
     public function editar($id){
       $this->data['contenido']="seccion/create_view.php";

       $seccion=$this->seccion_model->getById($id);

       //Contravenciones titulos
       $this->data['seccion']=$seccion;
       $this->data['titulo']='Seccion';
       $this->data['subtitulo']="Editar Seccion";
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
        $this->data['id_grupo_seccion'] =$this->input->post('id_grupo_seccion');

      
            if(empty($this->data['id'])) {
                $this->data['id'] = $this->seccion_model->insert($this->data);
                $message="Se agrego Seccion";
                $this->index(null,$message,null);
            }else {
                $this->seccion_model->update($this->data);
                $this->index(null,"Se actualizo la seccion",null);
            }
    }


   }

?>