<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Marca correspondiente a la tabla
   *  @tabla: contravenciones.estados_expedientes 
  **/

class Estadoexpediente_model extends MY_Model {

    public function __construct() {
       
        //Seteamos los valores 
        //para el base bean
        $this->table='contravenciones.estados_expedientes';
        $this->id='id_estado_expediente';
    }


    /**
      * Funcion que permite obtener los 
      * estados del expediente segun el tipo
    **/
    public function findByTipo($tipo){
       $this->db->select('*');
       $this->db->from($this->table);
       $this->db->where('tipo',$tipo);
         return $this->db->get()->result();
    }


}
