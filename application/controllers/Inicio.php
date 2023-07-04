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
class Inicio extends MY_Controller {

    function __construct() {
         
        parent::__construct();
//        $this->load->model('usuarioModel');
//        $this->load->model('personaModel');
        $this->load->library('session');
        $this->load->model('persona_model');
        $this->load->model('seccion_model');

        $this->load->model('gruposeccion_model');
        $this->load->model('departamento_model');
        $this->load->model('infraccion_model');
        $this->load->model('tipotramite_model');
        $this->load->model('infraccionley_model');

    }



     /**
     *  Index
     */
    public function index($filter=null,$message=null,$status=null,$Starting=0){
       if ($this->ion_auth->logged_in()) {
            
            $filter = $this->session->userdata('filter');

            //filter vial 
            if($filter==null){
               $filter['tipo_expediente']='V';
               $filter['numero_expediente']=null;
               $filter['numero_acta']=null;
               $filter['fecha_desde']=null;
               $filter['fecha_hasta']=null;
               $filter['propietario']=null;
               $filter['nombre']=null;
               $filter['apellido']=null;
               $filter['dni']=null;
               $filter['dominio']=null;
               $filter['estado_pago'] = null;
            }


            $tipoPagos = ['INFRACCION_PAGO_NO_GENERADO','INFRACCION_PAGO_COMPLETO','INFRACCION_PAGO_INCOMPLETO'];

            // Obtenemos las leyes de alcoholemia 
            $this->data['cantLeyAlcoholemia'] = 0;
            $tipoTramite = $this->tipotramite_model->getByAcronimo(LEY_ALCOHOLEMIA);
            if ( $tipoTramite != null ){
               $cantLeyes = $this->infraccion_model->getByParametros($tipoTramite->id_tipo_tramite);
               $this->data['cantLeyAlcoholemia'] = sizeof($cantLeyes);
            } 
            //Obtenemos las leyes de manera general  
            $tipoTramite = $this->tipotramite_model->getByAcronimo(LEY_GENERAL);
            $this->data['cantLeyGeneral'] = 0;
            if ( $tipoTramite != null ){
                $cantLeyes = $this->infraccion_model->getByParametros($tipoTramite->id_tipo_tramite);
                $this->data['cantLeyGeneral'] = sizeof($cantLeyes);
            }
           

            $this->data['tipo_pagos']=$tipoPagos; 
            $this->data['message']=$message; 
            $this->data['status']=$status;
            $this->data['contenido'] = "index.php";
            $this->data['titulo']="Infracciones / Viales";
            $this->data['filter']=$filter;

            $this->data['departamentos']=$this->departamento_model->get_all(9); //provincia de jujuy = 9
            $this->load->view('template', $this->data);
        } else {
            redirect('admin/login');
        }
   

    }


}