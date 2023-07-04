<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/** Clase correspondiente al tipo  de vehiculo model 
  * tabla : infracciones.tipovehiculos
  */

class Tipovehiculo_model extends  MY_Model  {

    public function __construct() {
        $this->table='infracciones.tipovehiculos';
        $this->id='id_tipovehiculo';

    }


    /** Funcion que permiter guardar un tipo de 
      * de vehiculo 
      * @param : arrya de datos
      * return  : id o null
      **/
    public function guardar($data){

       if(empty($data['nombre'])) $data['nombre'] = null;
        $this->db->trans_begin();
        $carga = array(
            'nombre' => $data['nombre'],
            'usuario_alta' => $this->session->userdata('user_id'),
            'fecha_alta' => date('Y-m-d H:i:s')
        );
        $this->db->insert($this->table, $carga);
        $id = $this->db->insert_id();
    

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        }else {
            $this->db->trans_commit();
            return $id;
        }

    }

}

?>