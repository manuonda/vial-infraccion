<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author dgarcia
 */
class Adicional extends MY_Controller {

    function __construct() {
        parent::__construct();
//        $this->load->model('usuarioModel');
//        $this->load->model('personaModel');
        $this->load->library('session');
    }

 

    /**
      * Index  
    **/
    public function index($fecha_alta=null) {
        if ($this->ion_auth->logged_in()) {
            /*if(empty($fecha_alta)) {
                $this->data['fecha_desde'] = date('Y-m-d');
                $this->data['fecha_hasta'] = date('Y-m-d');
            }else {
                $this->data['fecha_desde'] = $fecha_alta;
                $this->data['fecha_hasta'] = $fecha_alta;
            }*/
            //$this->data['listado'] = $this->carga_especial_model->buscar($this->data);
            //$this->data['unidades_policiales'] = $this->unidad_policial_model->get_all();

            $this->data['contenido'] = "";
            $this->load->view('template', $this->data);
        } else {
            redirect('admin/login');
        }
    }



    
    public function agregar(){

    }
}