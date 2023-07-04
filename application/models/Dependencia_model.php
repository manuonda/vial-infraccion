<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dependencia_model extends MY_Model {

    public function __construct() {
        $this->table='personal.dependencias';
        $this->id='id_dependencia';
    }
    
    public function findByUnidadPolicial($id_unidad_policial) {
        $this->db->select('id_dependencia, dependencia');
        $this->db->from('dependencias');
        $this->db->where('id_unidad_policial', $id_unidad_policial);
        return $this->db->get()->result();
    }
}

?>