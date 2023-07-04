<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Destacamento extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('destacamento_model');
        
        //Cargamos el Helper para el uso del BASE_URL()
        $this->load->helper('url');
    }

    
    /**
     * Funcion que permite 
     * obtener la informacion
     * correspondiente para guardar el nombre 
     * del modelo
     */
    function postDestacamento(){

      $json = json_decode(file_get_contents("php://input"));
      $this->data['nombre']   = $json->nombre;
    

      $id=$this->destacamento_model->guardar($this->data);

      $message="";
      $status="OK";
      $list=$this->destacamento_model->get_all();

      if($id>0){
       $message="Destacamento guardado";
       $status="OK";
      }else{
        $status="ERROR";  
      }
      $json=array();
      $json=[
             "status"=>$status,
             "message"=>$message,
             "list"=>$list
        ] ;
      echo json_encode($json);
      return ;
     }
}