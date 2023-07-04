<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Modelo correspondiente a la tabla
   *  @tabla:  infracciones.model
  **/

class Modelo_model extends MY_Model {

    public function __construct() {
        //Seteamos los valores 
        //para el base bean
        $this->table='infracciones.modelos';
        $this->id='id_modelo';
    }

   /**
    *    Funcion que permite obtener 
    *    los modelos a partir del identificador
    *    de la marca
    *    @param:id_marca
    *    @return : un listado de 
    **/
    public function getByMarca($id_marca){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_marca',$id_marca);
        $this->db->order_by("fecha_alta");
         return $this->db->get()->result();
    }


    /**
      Funcion que permite realizar la busqueda 
      por nombre del modelo  y del idMarca
    **/
    public function buscarPorNombre($idMarca , $nombre){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_marca',$idMarca );
        $this->db->where('nombre', $nombre);
        $this->db->order_by("fecha_alta");
         return $this->db->get()->result();
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
            'nombre' => $data['nombre'],
            'id_marca'=>$data['id'],
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
