<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cupon extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('cupon_model');
        $this->load->model('articulo_model');

        //Cargamos el Helper para el uso del BASE_URL()
        $this->load->helper('url');
    }


     /**
     *  Index
     */
    public function index($filter=null){
       if ($this->ion_auth->logged_in()) {
            
            //$this->data['expedientes']=$this->expediente_model->get_all();
            $this->data['contenido'] = "cupon/cupon_view.php";
            $this->data['titulo']="Contravenciones / Viales";
            $this->data['departamentos']=$this->departamento_model->get_all(9); //provincia de jujuy = 9
            $this->load->view('template', $this->data);
        } else {
            redirect('admin/login');
        }
   

    }

    
    /**
     * Funcion que permite 
     * obtener la informacion
     * correspondiente para guardar el nombre
     * del articulo
     */
    function postArticulo(){

      $json = json_decode(file_get_contents("php://input"));
      $this->data['nombre']   = $json->nombre;
      $this->data['id']=$json->id; //tipovehiculo
       
      $id=$this->articulo_model->guardar($this->data);

      $message="";
      $status="OK";
      //Obtenemos las marcas correspondientes al 
      //tipo de vehiculo
      $list=$this->articulo_model->getByLey($this->data['id']);

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
}