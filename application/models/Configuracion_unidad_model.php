<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Configuracion_model correspondiente a la tabla
   *  @tabla: contravenciones.configuracion 
  **/

class Configuracion_unidad_model extends MY_Model {

    public function __construct() {
       
        //Seteamos los valores 
        //para el base bean
        $this->table='infracciones.configuracion_unidades';
        $this->id='id_configuracion_unidad';
    }


    /** Funcion que permiter guardar un
      * modelo
      * @param  : json 
      * return  : id o null
      **/
    public function guardar($data){

       if(empty($data['precio_uf']))  $data['precio_uf']=null;
       if(empty($data['valor_uf']))$data['valor_uf']=null;
       
      $this->db->trans_begin();
        $carga = array(
            'precio_uf' => $data['precio_uf'],
            'valor_uf'=>$data['valor_uf'],
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
        if(empty($data['precio_uf'])) $data['precio_uf'] = null;
        if(empty($data['valor_uf'])) $data['valor_uf'] = null;
        
      
        $this->db->trans_begin();
        $carga = array(
            
            'precio_uf' => $data['precio_uf'],
            'valor_uf' => $data['valor_uf'],
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
