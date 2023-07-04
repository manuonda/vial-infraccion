<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Modelo correspondiente a la tabla
   *  @tabla: Contravenciones.Expediente  
  **/

class Expediente_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

  
    /**
     * Funcion que permite obtener 
     * obtener un registro especifico 
     * @param: id
     * return @row
     
    function get($id) {
        $this->db->select('*');
        $this->db->from('contravenciones.t_expediente');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }*/


    /**
     * Funcion que permite 
     * retornar todos los registros 
     * de la tabla
     *
    public function get_all() {
        $this->db->select('*');
        $this->db->order_by("fecha_alta");
        return $this->db->get('contravenciones.t_expediente')->result();
    }*/

}
