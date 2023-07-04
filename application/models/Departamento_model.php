<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Departamento correspondiente a la tabla
   *  @tabla: public.departamento 
  **/

class Departamento_model extends MY_Model {

    public function __construct() {
         //Seteamos los valores 
        //para el base bean
        $this->table='public.departamentos';
        $this->id='id_departamento';
    }



    /**
     * Funcion que permite 
     * retornar todos los registros 
     * de la tabla, dependiendo de la provincia
     **/
    public function findByProvincia($idProvincia) {
        $this->db->select('*');
        $this->db->where('id_provincia',$idProvincia);
        $this->db->order_by("fecha_alta");
        return $this->db->get($this->table)->result();
    }


     /** Funcion que permiter guardar un
      * modelo
      * @param  : json 
      * return  : id o null
      **/
    public function guardar($data){

       if(empty($data['nombre'])) $data['nombre'] = null;
        $this->db->trans_begin();
        $carga = array(
            'depto' => $data['nombre'],
            'id_provincia'=>$data['id'],
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
