<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Marca extends CI_Controller {

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
    function postMarca(){

      $json = json_decode(file_get_contents("php://input"));
      $this->data['nombre']   = $json->nombre;
      $this->data['id']=$json->id; //tipovehiculo

      $message="";
      $status="OK";
     
      $id=null;
      // existe marca 
      $marca =$this->marca_model->buscarPorNombre($this->data['id'] , $this->data['nombre']);
     
      if ( $marca != null &&  sizeof($marca) > 0 ){
         $status = "ERROR_EXISTE";
         $message = "Existe el nombre de la marca";
         $id = $marca[0]->id_marca;
      } else {
         $id=$this->marca_model->guardar($this->data);
         if($id>0){
             $message="Modelo guardado";
             $status="OK";
          } else {
           $status="ERROR";  
          }
      }

       //Obtenemos las marcas correspondientes al 
      //tipo de vehiculo
      $list=$this->marca_model->getByTipoVehiculo($this->data['id']);


      
      
      $json=array();
      $json=[
             "status" => $status,
             "message" => $message,
             "list" =>  $list , 
             "id" => $id
        ] ;
      echo json_encode($json);
      return ;
     }
}