<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   *  Clase Informe 
   *  @tabla: infracciones.informe_model.
  **/

class Informe_model extends MY_Model {

    public function __construct() {
        
        //Seteamos los valores 
        //para el base bean
        $this->table='infracciones.informes';
        $this->id='id_informe';

    }

     /**
      * Funcion que permite realizar la insercion 
      * de un registro
      * @param : data es un array de datos 
      *          que contiene datos de infraccion vial
     **/
    public function insert($data) {
        
        if(empty($data['id'])) $data['id']=null;
        if(empty($data['id_infraccion'])) $data['id_infraccion']=null;
        if(empty($data['descripcion'])) $data['descripcion'] = null;
     
        $this->db->trans_begin();
        $carga = array(
            'id_infraccion' =>$data['id_infraccion'],
            'descripcion' => $data['descripcion'],
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

        if(empty($data['nombre_apellido_representante'])) $data['nombre_apellido_representante'] = null;
        if(empty($data['cuil_representante'])) $data['cuil_representante'] =  null;
        if(empty($data['dni_representante'])) $data['dni_representante'] = null;
        if(empty($data['domicilio_representante'] )) $data['domicilio_representante'] = null;
        if(empty($data['vinculo_representante'] )) $data['vinculo_representante'] = null;
        if(empty($data['id_infraccion'] ))  $data['id_infraccion'] = null;
        if(empty($data['texto'])) $data['texto'] = null;
        if(empty($data['pedido_licencia'])) $data['pedido_licencia'] = null;
        if(empty($data['pedido_dni'])) $data['pedido_dni'] = null;
        if(empty($data['pedido_cedula'])) $data['pedido_cedula'] = null;
        if(empty($data['pedido_otro'])) $data['pedido_otro'] = null;

        $this->db->trans_begin();
        $carga = array(
            'id_infraccion' =>$data['id_infraccion'],
            'nombre_apellido_representante' => $data['nombre_apellido_representante'],
            'cuil_representante'=>$data['cuil_representante'],
            'dni_representante' => $data['dni_representante'],
            'domicilio_representante'=>$data['domicilio_representante'],
            'vinculo_representante' =>$data['vinculo_representante'],
            'texto' => $data['texto'],
            'pedido_dni' =>$data['pedido_dni'],
            'pedido_cedula' =>$data['pedido_cedula'],
            'pedido_licencia' => $data['pedido_licencia'],
            'pedido_otro' => $data['pedido_otro'],

            'usuario_alta' => $this->session->userdata('user_id'),
            'fecha_alta' => date('Y-m-d H:i:s')
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



    /**
      * Funcion que permite obtener los 
      * informes a traves del idInfraccion
    **/
    public function getByIdInfraccion($idInfraccion){

       $this->db->select();
       $this->db->from($this->table);
       $this->db->where('id_infraccion', $idInfraccion)->order_by('id_informe');
      
       return $this->db->get()->result();

    }



}
