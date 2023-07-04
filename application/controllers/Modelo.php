<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Modelo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
//        $this->load->library('MY_Form_validation');
//        $this->load->library('pagination');
        $this->load->model('dependencia_model');
        $this->load->model('localidad_model');
        $this->load->model('marca_model');
        $this->load->model('modelo_model');
        $this->load->model('barrio_model');
        $this->load->model('calle_model');
        $this->load->model('tipovehiculo_model');

        //Cargamos el Helper para el uso del BASE_URL()
        $this->load->helper('url');
    }

    
    /**
     * Funcion que permite 
     * obtener la informacion
     * correspondiente para guardar el nombre 
     * del modelo
     */
    function postModelo(){

      $json = json_decode(file_get_contents("php://input"));
      $this->data['nombre']   = $json->nombre;
      $this->data['id']=$json->id;

      $id=null;
      // existe modelo 
      $modelo =$this->modelo_model->buscarPorNombre($this->data['id'] , $this->data['nombre']); 
       
      if ( $modelo != null &&  sizeof($modelo) > 0 ){
         $status = "ERROR_EXISTE";
         $message = "Existe el nombre del modelo";
         $id = $modelo[0]->id_modelo; 
      } else {

        $id=$this->modelo_model->guardar($this->data);
        $message="";
        $status="OK";
        if( $id>0 ) {
           $message="Modelo guardado";
           $status="OK";
        }  else{
          $status="ERROR";  
        }
      }

      $list=$this->modelo_model->getByMarca($this->data['id']);

      $json=array();
      $json=[
             "status"=>$status,
             "message"=>$message,
             "id" => $id,
             "list"=>$list
        ] ;
      echo json_encode($json);
      return ;
     }
}