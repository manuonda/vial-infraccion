
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

        //modal de leyes 
        $this->load->model('ley_model');
        //estado 
        $this->load->model('estado_model');
        $this->load->model('funciones_model');
        $this->load->model('usuarios_model');
        $this->load->model('roles_model');
        $this->load->model('usuarios_roles_model');


    } 
 


     /**
      * Funcion que permite obtener un listado 
      * de funciones 
      */
     public function getMenuList(){
      //Obtenemos el usuario id
      

      return null;

     }

   }

?>