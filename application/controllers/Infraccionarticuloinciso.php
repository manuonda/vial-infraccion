<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
  * Clase que permite poder obtener diferentes 
  * request en formato json
  **/
class Infraccionarticuloinciso extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        
        $this->load->library('form_validation');

        $this->load->model('dependencia_model');
        $this->load->model('localidad_model');
        $this->load->model('marca_model');
        $this->load->model('modelo_model');
        $this->load->model('persona_model');
        $this->load->model('infraccionarticuloinciso_model');

        //Cargamos el Helper para el uso del BASE_URL()
        $this->load->helper('url');
    }

 
  

      /**
        *
       */

      function post_addLey(){
       
       $json = json_decode(file_get_contents("php://input"));
       $this->data['id_contravencion']   = $json->id_contravencion;
       $this->data['id_ley']=$json->ley;
       $this->data['id_articulo']=$json->articulo;
       $this->data['id_inciso']=$json->inciso;
       $this->data['id']=$json->id;
       $this->data['unidad']=$json->unidad;
       $this->data['tipo_unidad']=$json->tipo_unidad;


      $id=$this->infraccionarticuloinciso_model->guardarUpdate($this->data);

      $message="";
      $status="OK";
      
      //Se definen los campos de la consulta de persona
      $list=$this->infraccionarticuloinciso_model->getByIdContravencion($this->data['id_contravencion']);

      if($id>0){
       $message="Modelo guardado";
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

      /**
        * Funcion que permite eliminar un registro de la tabla 
        * contravenciones articulos incisos
        */
      function post_delete(){
        
      
       $json = json_decode(file_get_contents("php://input"));
       $this->data['id_contravencion_articulo_inciso']   = $json->id;
       
       $band=$this->infraccionarticuloinciso_model->delete($this->data);

        $message="";
        $status="OK";
      
      
      if($band){
       $message="Registro eliminado";
       $status="OK";
      }else{
        $status="ERROR";  
      }
      $json=array();
      $json=[
             "status"=>$status,
             "message"=>$message
        ] ;
      echo json_encode($json);
      return ;
      }
    
 }

?>