<?php

/**
 * Description of acceso
 *
 * @author Felipe
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    /**
     * Constructor para cargar las librerias que heredan las subclases
     */
    //private $data;
    function __construct() {
        parent::__construct();
        date_default_timezone_set('America/Argentina/Jujuy');
        $this->load->helper('form');
		    $this->load->helper('url');
        //$this->load->library('comisaria');
        $this->load->library('ion_auth');
        //$this->load->library('UtilesLibraries');
        $this->load->config('ion_auth', TRUE);
        $this->load->library('session');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->tables = $this->config->item('tables', 'ion_auth');
        //$this->load->model('permiso_model');
        $this->load->model('gruposeccion_model');
        $this->load->model('seccion_model');
        $this->load->model('persona_model');
        $this->load->model('rol_model');



        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }



        //obtenemos el listado de funciones 
        $user_id=$this->session->userdata('user_id');
        $grupo_secciones=$this->gruposeccion_model->get_grupos($user_id);
     

        $listado=[];
        foreach ($grupo_secciones as $gs) {

                     //($gs->id_grupo_seccion);
                $listado[] = array(
                     "grupo_seccion" => $gs->nombre, 
                     "seccion" => $this->seccion_model->get_secciones($gs->id_grupo_seccion)); 
               
        }
        
        
       $rolesUsuario =  $this->rol_model->getRolOfUsuario($this->session->userdata('user_id'));
       $habilitarContador = false;
       if ( $rolesUsuario != null ){
          foreach( $rolesUsuario as $rol) {
             if ($rol->name =='AdminContador'){
              $habilitarContador = 'true';
             }
          }
       }
       $this->data['habilitarContador'] = $habilitarContador;
       $this->data['listado']=$listado; 


    }


    /**
     * Permite obtener la posición de el indice de paginación
     * 
     * @param string $url Cadena de tipo controlador/metodo
     * @return int 
     */
    function _uri_segment($url = NULL) {
        $data = explode('/', $this->uri->uri_string($url));
        return isset($data) ? count($data) : 1;
    }

    /* Permite cargar el template con la vista incluida.
     * Tambien cargar el titulo de la pagina
     * @param   $url: url de la vista.
     *          $titulo: titulo de la vista
     */

    /**
     * Genera un key de identificación de formulario en una cookie
     * @return array
     */
    function _get_csrf_nonce() {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);
        return array($key => $value);
    }

    /**
     * Permite validar la key de identificacón de formulario, checkea cookie
     * @return boolean
     */
    function _valid_csrf_nonce() {
//        $key = $this->session->flashdata('csrfkey');
//        $value = $this->session->flashdata('csrfvalue');
//        if ($this->input->post($key) !== FALSE && $this->input->post($key) == $value) {
//            return TRUE;
//        } else {
//            return FALSE;
//        }
        return TRUE;
    }



     /**
       * Funcion que permite obtener los 
       * domicilios en formato
       */
     public function getRowsDomicilioActionHtml($cuil,$tipoPersona){

          $domicilios = $this->persona_model->get_domicilios($cuil);
          $html  ="";
          $row = "";
          if($domicilios != null && $domicilios){
          foreach ($domicilios as $domicilio) {

               $row ="";
               $row ="<tr id='".$domicilio->id_domicilio."-".$cuil."-".$tipoPersona."' class='odd gradeX'>";

               if ($domicilio->actual == 't') {
                   $row =  $row . "<td><span><input name='".$tipoPersona."' type='radio' onclick=moduleDomicilioModal.actualizarDomicilio('".$domicilio->id_domicilio."-".$cuil."') checked/></span></td>";
               }else{
                 $row = $row . "<td><span><input  name='".$tipoPersona."' onclick=moduleDomicilioModal.actualizarDomicilio('".$domicilio->id_domicilio."-".$cuil."') type='radio'/></span></td>";
               }
                   

               $row = $row ."<td>". $domicilio->barrio ."," . $domicilio->calle ."," . $domicilio->numero."</td>";

               //acciones
               $action  ="<td>".
                         "<button type='button' class='btn default btn-xs blue' onclick=moduleDomicilioModal.editarDomicilio('".$domicilio->id_domicilio."-".$cuil."-".$tipoPersona."')>".
                         "<i class='fa fa-edit'></i></button>".
                         "<button type='button' class='btn default btn-xs red' onclick=moduleDomicilioModal.eliminarDomicilio('".$domicilio->id_domicilio."-".$cuil."-".$tipoPersona."')>".
                         "<i class='fa fa-times'></i></button>".
                         "</td>";
                $row = $row .$action;       

               $row = $row ."</tr>";

             $html = $html .$row ;   

          }
        }

          return $html;
     }

}
