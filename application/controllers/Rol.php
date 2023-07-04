
<?php


    /**
      ***************************
      * Clase correspondiente a Roles 
      * Esta clase contiene los roles 
      * del sistema
      * @dathe  : 16/4/18
      * @author : dgarcia
      **/ 
   class Rol extends MY_Controller{


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

     
        $this->load->model('rol_model');


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
            $this->data['contenido'] = "rol/index_view.php";
            $this->data['titulo']="Roles ";
            $this->data['roles']=$this->rol_model->buscar($filter);
           
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
      $this->data['contenido']="rol/create_view.php";
      $this->data['titulo']="Roles";
      $this->data['subtitulo']="Agregar Rol";
      $this->load->view('template',$this->data);

    }

     /** Funcion que permite poder 
       * editar una contravencion 
       * @param : $idContravencion
       */
     public function editar($idFuncion){
       $this->data['contenido']="rol/create_view.php";

       $funcion=$this->funciones_model->getById($idFuncion);

       //Contravenciones titulos
       $this->data['funcion']=$funcion;
       $this->data['titulo']='Rol';
       $this->data['subtitulo']="Editar Rol";
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
                $this->data['id'] = $this->perfil_model->insert($this->data);
                $message="Se agrego Perfil";
                $this->index(null,$message,null);
            }else {
                $this->perfil_model->update($this->data);
                $this->index(null,"Se actualizo el perfil",null);
            }
    }


   }

?>