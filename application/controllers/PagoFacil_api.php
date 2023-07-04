<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/* Class: Api correspondiente a Pago Facil */
class PagoFacil_api extends CI_Controller {

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
        $this->load->model('marca_model');
        $this->load->model('modelo_model');
        $this->load->model('ley_model');
        $this->load->model('articulo_model');
        $this->load->model('inciso_model');
        

        //Cargamos el Helper para el uso del BASE_URL()
        $this->load->helper('url');
    }


    
    /** Funcion que permite crear un usuario en PagoFacil
    **/ 
    public function createUsuario(){

     
     
    }


    /**
     * Funcion que permite obtener las 
     * dependencias de una unidad policial
     */ 
    function get_dependencias($id_unidad_policial) {
        $dependencias = $this->dependencia_model->findByUnidadPolicial($id_unidad_policial);
        echo json_encode($dependencias);
        return;
    }

    /**
     * Funcion que permite obtener 
     * las localidades correspondientes 
     * a un departamento
     */
    function get_localidad($id_departamento){
     $localidades=$this->localidad_model->findByDepartamento($id_departamento);
     echo json_encode($localidades);
     return;
    }


    /** Funcion que permite obtener 
      * los barrios correspondiente 
      * por localidad 
      * @param : $id_localidad 
      * return barrios
      **/   
    function get_barrio($id_localidad){
      $barrios=$this->barrio_model->findByLocalidad($id_localidad);
      echo json_encode($barrios);
      return;
    }

    /**
      * Funcion que permite obtener 
      * las calles correspondientes 
      * por barrio 
      * @param : $id_barrio
      * return calles
      **/
    function get_calle($id_barrio){
      $calles=$this->calle_model->findByBarrio($id_barrio);
      echo json_encode($calles);
      return;
    }
  
    /** Funcion que permite obtener las 
      *  marcas a partir del tipo de vehiculo
      * @param: id_vehiculo
      * return : json de marca 
      */
    function get_marca($id_tipovehiculo){
     $marcas=$this->marca_model->getByTipoVehiculo($id_tipovehiculo);
     echo json_encode($marcas);
     return;
    }

    /** Funcion que permite obtener 
      * un listado de modelos a partir 
      * de la marca pasada como parametro
      * @param : id_marca
    **/
    function get_modelo($id_marca){
        $modelos=$this->modelo_model->getByMarca($id_marca);
        echo json_encode($modelos);
        return;
    }


    /** Funcion que permite obtener 
      * unlistado de leyes a partir 
      * de los parametros de :
      * @param : id_anexion,tipoInfraccion(V,C)
      */
    function get_leyes($id_anexo,$tipoInfraccion){
      $leyes=$this->ley_model->getByAnexo($id_anexo,$tipoInfraccion);
      echo json_encode($leyes);
      return ;
    }


    /** Funcion que permite obtener 
      * un listado de articulos a partir 
      * del parametro de ley
      * @param : id_key
      */
    function get_articulos($id_ley){
      $articulos=$this->articulo_model->getByLey($id_ley);
      echo json_encode($articulos);
      return;
    }

    /** Funcion que permite obtener 
      * un listado de incisos 
      * por parametro id_articulo 
      * @param: id_articulo
      */
    function get_incisos($id_articulo){
      $incisos=$this->inciso_model->getByArticulo($id_articulo);
      echo json_encode($incisos);
      return;
    }







}