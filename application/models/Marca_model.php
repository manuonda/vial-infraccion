<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Marca correspondiente a la tabla
   *  @tabla: infracciones.marcas 
  **/

class Marca_model extends MY_Model {

    public function __construct() {
       
        //Seteamos los valores 
        //para el base bean
        $this->table='infracciones.marcas';
        $this->id='id_marca';
    }


  
 /**
    *    Funcion que permite obtener 
    *    las localidades por departamento
    **/
    public function getByTipoVehiculo($id_tipovehiculo){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_tipovehiculo',$id_tipovehiculo);
        $this->db->order_by("fecha_alta");
         return $this->db->get()->result();
    }


    /**
      Funcion que permite realizar la busqueda 
      por nombre de la marca y del idTipoVehiculo
    **/
    public function buscarPorNombre($id_tipovehiculo , $nombre){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_tipovehiculo',$id_tipovehiculo);
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
            'id_tipovehiculo'=>$data['id'],
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
