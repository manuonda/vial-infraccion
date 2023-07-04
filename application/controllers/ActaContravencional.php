<?php

/**
 * Clase correspondiente a Multas 
 * de Contraveciones
 * @dathe  : 06-10-2017
 * @author : dgarcia
 * */
class ActaContravencional extends MY_Controller {

    /**
     * Constructor para cargar las librerias 
     * necesarias
     */
    function __construct() {
        parent::__construct();

        //library y helpers
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');

        //model
        // $this->load->model('expediente_model');
    }

    /**
     *  Index
     */
    public function index($idDepartamento=null) {
        if ($this->ion_auth->logged_in()) {

            // $this->data['expedientes']=$this->expediente_model->get_all();
            $this->data['titulo']="Departamentos / Actas";
            $this->data['subtitulo']="Listado";
            $this->data['contenido'] = "actas/index_view.php";
            $this->load->view('template', $this->data);
        } else {
            redirect('admin/login');
        }
    }

    /**
     * Funcion que permite agregar 
     * un expediente cargando la vista 
     * del expediente
     * */
    public function agregar() {
        $this->data['contenido'] = "contravencional/create_viewcon.php";
        $this->load->view('template', $this->data);
    }

    public function buscar() {
        
    }

    public function acta() {
        $this->data['contenido'] = "contravencional/acta_con.php";
        $this->load->view('template', $this->data);
    }

}

?>