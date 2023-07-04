<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Contravencion correspondiente a la tabla
   *  @tabla: public.persona_domiclios 
  **/

class Personadomicilio_model extends MY_Model {

    public function __construct() {
       
     
        $this->table='public.persona_domicilios';
        
    }



    public function insert($data) {
        
        if(empty($data['id_domicilio'])) $data['id_domicilio'] = null;
        if(empty($data['cuil'])) $data['cuil'] = null;
        if(empty($data['actual'])) $data['actual'] =null;


     
        $this->db->trans_begin();
        $carga = array(
           
            'id_domicilio' => $data['id_domicilio'],
            'cuil'        => $data['cuil'],
            'actual'      => $data['domicilioActual'],
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
       
        if(empty($data['id_domicilio'])) $data['id_domicilio'] = null;
        if(empty($data['cuil']))         $data['cuil'] = null;
        if(empty($data['actual']))       $data['actual'] =null;


        $this->db->trans_begin();
        $carga = array(
           
            'id_domicilio' => $data['id_domicilio'],
            'cuil'        => $data['cuil'],
            'actual'      => $data['actual'],
            'usuario_modificacion' => $this->session->userdata('user_id'),
            'fecha_modificacion' => date('Y-m-d H:i:s')
        );

        $this->db->where('id_domicilio', $data['id_domicilio']);
        $this->db->where('cuil',$data['cuil']);
        $this->db->update($this->table, $carga);

    

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        }else {
            $this->db->trans_commit();
            return $data['id_domicilio'];
        }
    }


    /**
     * Funcion que permite poder eliminar 
     * un registro
     */
    function deleteByIdDomicilio($idDomicilio){
     $this->db->trans_begin();
     $this->db->delete($this->table, 

        array('id_domicilio' => $idDomicilio));
     if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
      }
      $this->db->trans_commit();
      return TRUE;
    }



    /**
     * Funcion que permite obtener el registros 
     * por el idDomicilio
    **/
    function getByIdDomicilio($idDomicilio){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_domicilio',$idDomicilio);
        $query = $this->db->get();
        return $query->row();
    }


     /**
      * Funcion que permite obtener 
      * los domiclios por el cuil
      **/
    function getByCuil($cuil){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('cuil',$cuil);
        return $this->db->get()->result();
    

    }



  
 }

