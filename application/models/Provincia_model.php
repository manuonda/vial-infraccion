<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Provincia correspondiente a la tabla
   *  @tabla: public.provincia 
  **/

class Provincia_model extends MY_Model {

    public function __construct() {
         //Seteamos los valores 
        //para el base bean
        $this->table='public.provincias';
        $this->id='id_provincia';
    }



    /**
     * Funcion que permite 
     * retornar todos los registros 
     * de la tabla, dependiendo de la provincia
     **/
    public function findByProvincia($idPais) {
        $this->db->select('*');
        $this->db->where('id_pais',$idPais);
        $this->db->order_by("fecha_alta");
        return $this->db->get($this->table)->result();
    }


    public function findByName($name){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('provincia',$name);
        $query = $this->db->get();
        return $query->row();
    }

}
