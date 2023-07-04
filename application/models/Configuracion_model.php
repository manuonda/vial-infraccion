<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Configuracion_model correspondiente a la tabla
   *  @tabla: contravenciones.configuracion 
  **/

class Configuracion_model extends MY_Model {

    public function __construct() {
       
        //Seteamos los valores 
        //para el base bean
        $this->table='infracciones.configuraciones';
        $this->id='id_configuracion';
    }




    /** Funcion que permiter guardar un
      * modelo
      * @param  : json 
      * return  : id o null
      **/
    public function guardar($data){
       
      if(empty($data['valor']))$data['valor']=null;
       
      $this->db->trans_begin();
        $carga = array(
            'valor'=>$data['valor'],
            'serie' => $data['serie'],
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

     /** Retorna un elemento 
      * de la tabla 
      * @param : id 
      */ 
    public function getByName($text){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('nombre',$text);
        $query = $this->db->get();
        return $query->row();
    }



    /** Funcion que permite realizar 
      * la actualizacion de registros 
      * @param : array de datos
      **/
    public function update($data) {
       
         //Section - Acta
        if(empty($data['valor'])) $data['valor'] = null;
        
      
        $this->db->trans_begin();
        $carga = array(
            'valor' => $data['valor'],
            'serie' => $data['serie'],
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
