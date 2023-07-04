<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase TipoTramite  correspondiente a la tabla
   *  @tabla: leyes.tipo_tramite 
  **/

class Tipotramite_model extends MY_Model {

    public function __construct() {
       
        //Seteamos los valores 
        //para el base bean
        $this->table='leyes.tipo_tramite';
        $this->id='id_tipo_tramite';
        } 

            /**
         * Funcion que permite realizar la busqueda por 
         * acronimo
         **/
        public function getByAcronimo($acronimo) {
          $this->db->select('*');
          $this->db->from($this->table);
          $this->db->where('acronimo',$acronimo);
          $query = $this->db->get();
          return $query->row();

    }
}
