<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Configuraciones extends MY_Controller {

     function __construct(){
       parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('configuracion_model');
        $this->load->model('configuracion_unidad_model');
        $this->load->model('valor_model');
        $this->load->helper('url');
    }



    /**
     *  Index
     */
      public function index($filter=null,$message=null,$status=null){
       if ($this->ion_auth->logged_in()) {
            
            $this->data['message']=$message;
            $this->data['contenido'] = "configuracion/index_view.php";
            $this->data['titulo']="Actualizacion de Valores ";
            $this->data['filter']=$filter;
            $this->data['configuracion']=$this->configuracion_model->getByName('LEY');
            $this->data['valores'] = $this->valor_model->get_all();
            $this->load->view('template', $this->data);
        } else {
            redirect('admin/login');
        }
   
    }


    /**
      * Funcion que permite agregar 
      * una ley
      **/
    public function create(){
      
      $this->data['contenido']="configuracion/create_view.php";
      $this->data['titulo']="Configuracion Valor Unidad";
      $this->data['subtitulo']="Agregar Configuraciòn Unidad";
      $this->load->view('template',$this->data);

    }



     public function post_update(){
      
        $json = json_decode(file_get_contents("php://input"));
        $idValorUnidad = $json->idValorUnidad;
        $valorUnidad = $json->valorUnidad;
        $estadoUnidad = $json->estadoUnidad;

        $this->data['id_valor']=$idValorUnidad;
        $this->data['valor'] =  $valorUnidad;
        $this->data['estado'] = $estadoUnidad;
        $this->data['fecha_modificacion'] = date('H:i');
        
            
        $idReturn = $this->valor_model->update($this->data);
        
        //Redireccionamos a la pagina si se creo 
        //el registro correctamente, a la pagina de pagos 
        //por cuotas o pago en efectivo
        $status="";
        $message="";
        $url="";
        $bandPagoCuotas=false;
        $cantidadCuotas=0;

        
        if(isset($idReturn)){
            $status='OK';
            $message="Se actualizo el Valor Unidad";
        }else{
             $status='ERROR';
             $message="No se pudo actualizar el Valor Unidad";
             $url=null; 
        }


        $json=array();
        $json=[
             "status"=>$status,
              "message"=>$message,
              "url"=>$url
              ] ;
        
       echo json_encode($json);
       //return;
     }

      public function post_guardar(){
        // nextval('infracciones.valor_unidad_seq'::regclass)
      
        $json = json_decode(file_get_contents("php://input"));
        $valorUnidad = $json->valorUnidad;
        $estadoUnidad = $json->estadoUnidad;

        $this->data['valor'] =  $valorUnidad;
        $this->data['estado'] = $estadoUnidad;
        
            
        $idReturn = $this->valor_model->insert($this->data);
        
        //Redireccionamos a la pagina si se creo 
        //el registro correctamente, a la pagina de pagos 
        //por cuotas o pago en efectivo
        $status="";
        $message="";
        $url="";
        $bandPagoCuotas=false;
        $cantidadCuotas=0;

        
        if(isset($idReturn)){
            $status='OK';
            $message="Se agrego el Valor Unidad";
        }else{
             $status='ERROR';
             $message="No se pudo agregar el Valor Unidad";
             $url=null; 
        }


        $json=array();
        $json=[
             "status"=>$status,
              "message"=>$message,
              "url"=>$url
              ] ;
        
       echo json_encode($json);
       //return;
     }
     
}