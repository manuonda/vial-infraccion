<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Marca correspondiente a la tabla
   *  @tabla: contravenciones.t_marca 
  **/

class Valor_model extends MY_Model {

    public function __construct() {
       
        //Seteamos los valores 
        //para el base bean
        $this->table='infracciones.valores';
        $this->id='id_valor';
    }


    
     /**
      * 
      * @param : data es un array de datos 
      *          que contiene datos para realizar 
      *          la insercion de datos
     **/
    public function insert($data) {
        //Section - Acta
        if(empty($data['nombre'])) $data['nombre'] = null;
        if(empty($data['valor'])) $data['valor'] = null;
        if(empty($data['year'])) $data['year']=null;
        if(empty($data['estado'])) $data['estado']=null;
        if(empty($data['estado'])) $data['estado'] = null;

        $this->db->trans_begin();
        $carga = array(
            //Section -  Lugar
            
            'nombre' => $data['nombre'],
            'valor' => $data['valor'],
            'year'=>$data['year'],
            'estado'=>$data['estado'],
            'usuario_alta' => $this->session->userdata('user_id'),
            'fecha_alta' => date('Y-m-d H:i:s')
        );
        $this->db->insert($this->table, $carga);
        $id_carga = $this->db->insert_id();


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        }else {
            $this->db->trans_commit();
            return $id_carga;
        }
    }

    /** Funcion que permite realizar 
      * la actualizacion de registros 
      * @param : array de datos
      **/
    public function update($data) {
       
         //Section - Acta
        if(empty($data['nombre'])) $data['nombre'] = null;
        if(empty($data['valor'])) $data['valor'] = null;
        if(empty($data['year'])) $data['year']=null;
        if(empty($data['estado'])) $data['estado']=null;
      
        $this->db->trans_begin();
        $carga = array(
            //Section -  Lugar
            
            'nombre' => $data['nombre'],
            'valor' => $data['valor'],
            'year'=>$data['year'],
            'estado'=>$data['estado'],
            'usuario_modificacion' => $this->session->userdata('user_id'),
            'fecha_modificacion' => date('Y-m-d H:i:s')
        );
        
        $this->db->where($this->id, $data['id']);
        $this->db->update($this->table, $carga);

    

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        }else {
            $this->db->trans_commit();
            return $data['id'];
        }
    } 


}
