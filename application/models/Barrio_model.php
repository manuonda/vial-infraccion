<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   *  Clase Barrio  correspondiente a la tabla
   *  @tabla: public.barrios 
  **/

class Barrio_model extends MY_Model {

    public function __construct() {
        
        //Seteamos los valores 
        //para el base bean
        $this->table='public.barrios';
        $this->id='id_barrio';

    }



   /**
    *    Funcion que permite obtener 
    *    los barrios por localidad
    *    @param : $id_localidad
    *    return : listado de barrios
    **/
    public function findByLocalidad($id_localidad){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_localidad',$id_localidad);
        $this->db->order_by("fecha_alta");
         return $this->db->get()->result();
    }


     /** Funcion que permiter guardar una
      * localidad
      * @param  : json 
      * return  : id o null
      **/
    public function guardar($data){

       if(empty($data['nombre'])) $data['nombre'] = null;
        $this->db->trans_begin();
        $carga = array(
            'barrio' => $data['nombre'],
            'id_localidad'=>$data['id'],
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
