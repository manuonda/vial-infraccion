<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Provincia correspondiente a la tabla
   *  @tabla: public.pais 
  **/

class Pais_model extends MY_Model {

    public function __construct() {
         //Seteamos los valores 
        //para el base bean
        $this->table='public.paises';
        $this->id='id_pais';
    }


    public function findByName($name){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('pais',$name);
        $query = $this->db->get();
        return $query->row();
    }



}
