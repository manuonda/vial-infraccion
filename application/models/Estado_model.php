<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Marca correspondiente a la tabla
   *  @tabla: contravenciones.t_marca 
  **/

class Estado_model extends MY_Model {

    public function __construct() {
       
        //Seteamos los valores 
        //para el base bean
        $this->table='infracciones.estados';
        $this->id='id_estado';
    }



    /** Funcion que permiter guardar 
      * estado
      * @param  : json(id_contravencion,id_estado,observacion) 
      * return  : id o null
      **/
    public function guardar($data){

       if(empty($data['id_contravencion'])) $data['id_contravencion'] = null;
       if(empty($data['id_estado']))   $data['id_estado'] = null;
       if(empty($data['observacion'])) $data['observacion'] = null; 
        
        $this->db->trans_begin();
        $carga = array(
            'id_contravencion' => $data['id_contravencion'],
            'id_estado'=>$data['id_estado'],
            'id_observacion'=>$data['observacion'],

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
