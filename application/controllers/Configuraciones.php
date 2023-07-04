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
        $this->load->helper('url');
    }



    /**
     *  Index
     */
      public function index($filter=null,$message=null,$status=null){
       if ($this->ion_auth->logged_in()) {
            
            $this->data['message']=$message;
            $this->data['contenido'] = "configuracion/index_view.php";
            $this->data['titulo']="Configuracion Valores";
            $this->data['filter']=$filter;
            $this->data['configuracion']=$this->configuracion_model->getByName('LEY');
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
      
      $this->data['contenido']="leyes/create_view.php";
      $this->data['titulo']="Leyes";
      $this->data['subtitulo']="Agregar Ley";
      $this->data['tipoInfracciones']=$tipoInfracciones;
      $this->data['tipoUnidades']=$tipoUnidades; 
      $this->load->view('template',$this->data);

    }

     /** Funcion que permite poder 
       * editar una seccion 
       * @param : $id
       */
     public function editar($id){
       $this->data['contenido']="configuracion/create_view.php";

       $configuracion=$this->configuracion_model->getById($id);

       //Contravenciones titulos
       $this->data['configuracion']=$configuracion;
       $this->data['titulo']='Configuracion';
       $this->data['subtitulo']="Configuracion UF";
       $this->load->view('template',$this->data);

    }
    

    /**
      * Funcion que permite guardar la 
      * informacion
     **/
    public function guardar(){
        $this->data['id'] = $this->input->post('id');
        $this->data['valor'] = $this->input->post('valor');
        $this->data['serie'] = $this->input->post('serie');
        if(empty($this->data['id'])) {
            $this->data['id'] = $this->configuracion_model->guardar($this->data);
             $message = "Se guarda la configuracion";
             $this->session->set_flashdata('message', $message);
             redirect('configuraciones');
        }else {
            $this->configuracion_model->update($this->data);
            $message = "Se actualizo la informacion de Configuracion";
            $this->session->set_flashdata('message', $message);
            redirect('configuraciones');
        }
    }
     
}