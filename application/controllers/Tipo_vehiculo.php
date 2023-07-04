<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tipo_vehiculo extends CI_Controller {

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
     * del tipo vehiculo
     */
    function postTipoVehiculo(){

      $json = json_decode(file_get_contents("php://input"));
      $this->data['nombre']   = $json->nombre;

      $id=$this->tipovehiculo_model->guardar($this->data);

      $message="";
      $status="OK";
      $tipovehiculos=$this->tipovehiculo_model->get_all();

      if($id>0){
       $message="Tipo Vehiculo guardado";
       $status="OK";
      }else{
        $status="ERROR";  
      }
      $json=array();
      $json=[
             "status"=>$status,
             "id"=>$id,
             "message"=>$message,
             "list"=>$tipovehiculos
        ] ;
      echo json_encode($json);
      return ;
     }
}