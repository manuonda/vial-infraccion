<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Contravencion correspondiente a la tabla
   *  @tabla: contravenciones.infracciones_pagos 
  **/

class Infraccionpago_model extends MY_Model {

    public function __construct() {
       
        //Seteamos los valores 
        //para el base bean
        $this->table='infracciones.infracciones_pagos';
        $this->id='id_infraccion_pago';
    }


   

    /**
      * Funcion que permite realizar la insercion 
      * de un registro
      * @param : data es un array de datos 
      *          que contiene datos de pago
     **/
    public function insert($data) {
        
        //Section - Acta
        if(empty($data['id_infraccion'])) $data['id_infraccion']=null;
        if(empty($data['fecha'])) $data['fecha'] = null;
        if(empty($data['hora'])) $data['hora'] = null;
        if(empty($data['tipo_pago']))  $data['tipo_pago'] = null;
        if(empty($data['cant_cuotas']))  $data['cant_cuotas']= null;
        if(empty($data['valor_unidad'])) $data['valor_unidad'] = null ;

        // importe general 
        if(empty($data['importe_general'])) $data['importe_general'] = null;
        if(empty($data['porcentaje_descuento_general'])) $data['porcentaje_descuento_general'] = null;
        if(empty($data['importe_descuento_general'])) $data['importe_descuento_general'] = null ;

        // importe alcoholemia
        if(empty($data['importe_alcoholemia'])) $data['importe_alcoholemia'] = null ;
        if(empty($data['porcentaje_descuento_alcoholemia'])) $data['porcentaje_descuento_alcoholemia'] = null;
        if(empty($data['importe_descuento_alcoholemia'])) $data['importe_descuento_alcoholemia'] = null;

     
        $this->db->trans_begin();
        $carga = array(
            //Section -  Lugar
            
            'id_infraccion' => $data['id_infraccion'],
            'fecha' => $data['fecha'],
            'hora' =>$data['hora'],
            'tipo_pago' =>$data['tipo_pago'],
            'cant_cuotas' => $data['cant_cuotas'],
            'valor_unidad' => $data['valor_unidad'],
            
            //importe general 
            'importe_general' => $data['importe_general'],
            'porcentaje_descuento_general' => $data['porcentaje_descuento_general'],
            'importe_descuento_general' => $data['importe_descuento_general'],

            //importe alcoholemi
            'importe_alcoholemia' => $data['importe_alcoholemia'],
            'porcentaje_descuento_alcoholemia' => $data['porcentaje_descuento_alcoholemia'],
            'importe_descuento_alcoholemia' => $data['importe_descuento_alcoholemia'],
            

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


    /** Retorna un elemento 
      * de la tabla por el 
      * @param : idInfraccion
      */ 
    public function getByIdInfraccion($idInfraccion){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_infraccion',$idInfraccion);
        $query = $this->db->get();
        return $query->row();
    }

   
    
  
 }
