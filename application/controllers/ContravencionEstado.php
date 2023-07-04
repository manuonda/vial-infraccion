<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
  * Clase que permite poder obtener diferentes 
  * request en formato json
  **/
class ContravencionEstado extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        
        $this->load->library('form_validation');

        $this->load->model('dependencia_model');
        $this->load->model('localidad_model');
        $this->load->model('marca_model');
        $this->load->model('modelo_model');
        $this->load->model('persona_model');
        $this->load->model('contravencion_model');
     

        //Cargamos el Helper para el uso del BASE_URL()
        $this->load->helper('url');
    }

 
  


      /** Funcion que permite cambiar el estado del expediente 
        * a un estado de Archivar 
        **/
      function post_estadoArchivar(){
       
       $json = json_decode(file_get_contents("php://input"));
       $this->data['id_contravencion']   = $json->id_contravencion;
       $this->data['id_estado']=ESTADO_ARCHIVAR; //Se establece el estado de archivado
       $this->data['observacion']=$json->observacion  ;
       

      //guardo el estado 
      $id=$this->contravencionestado_model->guardar($this->data);

      $message="";
      $status="OK";
      
      //se agrega el estado 
      $this->data['nombre_estado']=ESTADO_ARCHIVAR_NOMBRE;
      $list=$this->contravencion_model->actualizarEstado($this->data);

      if($id>0){
       $message="Estado guardado";
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

?>