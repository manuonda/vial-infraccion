<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Contravencion correspondiente a la tabla
   *  @tabla: contravenciones.t_contravencion 
  **/

class Personajuridica_model extends MY_Model {

    public function __construct() {
       
     
        $this->table='infracciones.persona_juridicas';
        $this->id='id_persona_juridica';
    }


    public function guardar($data){
        if( empty($data['idPersonaJuridica'])) {
            $this->insert($data);
        } else {
             $this->update($data);
        }
    }

   

    /**
      * Funcion que permite realizar la insercion 
      * de un registro
      * @param : data es un array de datos 
      *          que contiene datos de contravenciones
     **/
    public function insert($data) {
        
        if(empty($data['id'])) $data['id'] = null;
        if(empty($data['cuitPersonaJuridica'])) $data['cuitPersonaJuridica'] = null;
        if(empty($data['nombrePersonaJuridica'])) $data['nombrePersonaJuridica'] = null;
        
        $this->db->trans_begin();
        $carga = array(
            'cuit' => $data['cuitPersonaJuridica'],
            'nombre' => $data['nombrePersonaJuridica'],
            'id_infraccion' => $data['id'],
            'direccion' => $data['direccionPersonaJuridica'],
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
       
        if(empty($data['id'])) $data['id'] = null;
        if(empty($data['cuitPersonaJuridica'])) $data['cuitPersonaJuridica'] = null;
        if(empty($data['nombrePersonaJuridica'])) $data['nombrePersonaJuridica'] = null;
       

        $this->db->trans_begin();
        $carga = array(
           
            'cuit' => $data['cuitPersonaJuridica'],
            'nombre' => $data['nombrePersonaJuridica'],
            'id_infraccion' => $data['id'],
            'direccion' => $data['direccionPersonaJuridica'],
            'usuario_modificacion' => $this->session->userdata('user_id'),
            'fecha_modificacion' => date('Y-m-d H:i:s')
        );

        $this->db->where('id_persona_juridica', $data['idPersonaJuridica']);
        $this->db->where('id_infraccion' ,$data['id']);
        $this->db->update($this->table, $carga);


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        }else {
            $this->db->trans_commit();
            return $data['id'];
        }
    }


    public function findByIdInfraccion($idInfraccion) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_infraccion',$idInfraccion);
        $query = $this->db->get();
        return $query->row();
    } 

    public function findByCuitByIdInfraccion($cuitPersonaJuridica , $idInfraccion) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('cuit',$cuitPersonaJuridica);
        $this->db->where('id_infraccion' ,$idInfraccion);
        $query = $this->db->get();
        return $query->row();

    }
  
 }

