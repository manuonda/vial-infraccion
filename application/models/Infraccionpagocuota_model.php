<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Contravencion correspondiente a la tabla
   *  @tabla: contravenciones.infracciones_pagos_cuotas
  **/

class Infraccionpagocuota_model extends MY_Model {

    public function __construct() {
       
        //Seteamos los valores 
        //para el base bean
        $this->table='infracciones.infracciones_pagos_cuotas';
        $this->id='id_infraccion_pago_cuota';
    }


   

    /**
      * Funcion que permite realizar la insercion 
      * de un registro
      * @param : data es un array de datos 
      *          que contiene datos de pago
     **/
    public function insert($data) {
        //Section - Acta
        if(empty($data['id_infraccion_pago'])) $data['id_infraccion_pago']=null;
        if(empty($data['numero_cuota'])) $data['numero_cuota'] = null;
        if(empty($data['fecha_pago'])) $data['fecha_pago'] = null;
        if(empty($data['hora_pago']))  $data['hora_pago']=null;
        if(empty($data['estado'])) $data['estado']=null;
        if(empty($data['id_infraccion'])) $data['id_infraccion'] =null;
    

        $this->db->trans_begin();
        $carga = array(
            
            'id_infraccion_pago'  => $data['id_infraccion_pago'],
            'numero_cuota'        => $data['numero_cuota'],
            'fecha_pago'          => $data['fecha_pago'],
            'hora_pago'           => $data['hora_pago'],
            'estado'              => $data['estado'],
            'id_infraccion'       => $data['id_infraccion'],
            'importe_general'     => $data['importe_general'],
            'importe_alcoholemia' => $data['importe_alcoholemia'],
            'comprobante'         => $data['comprobante'], 
            'usuario_alta'        => $this->session->userdata('user_id'),
            'fecha_alta'          => date('Y-m-d H:i:s')
        );
        var_dump($data);
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
       
        if(empty($data['id_infraccion_pago_cuota'])) $data['infraccion_pago_cuota'] = null;
        if(empty($data['fecha_pago'])) $data['fecha_pago'] = null;
        if(empty($data['hora_pago'])) $data['hora_pago'] = null;
        if(empty($data['numero_cuota'])) $data['numero_cuota'] =null;
        if(empty($data['estado'])) $data['estado']=null;
        if(empty($data['nombre_apellido'])) $data['nombre_apellido'] = null;
        if(empty($data['dni_representante'])) $data['dni_representante'] = null;
        if(empty($data['domicilio_representante'])) $data['domicilio_representante'] = null;
        if(empty($data['vinculo_representante'])) $data['vinculo_representante'] = null;


        $this->db->trans_begin();
        $carga = array(
           
            'fecha_pago'         => $data['fecha_pago'],
            'hora_pago'          => $data['hora_pago'],
            'estado'             => $data['estado'],  
            'numero_cuota'       => $data['numero_cuota'],
            'comprobante' => $data['numero_comprobante'],  
            'importe'            => $data['importe'],  
            'nombre_apellido'    => $data['nombre_apellido'],
            'dni_representante'  => $data['dni_representante'],
            'domicilio_representante' => $data['domicilio_representante'],
            'vinculo_representante'   => $data['vinculo_representante'],
            
            'usuario_modificacion' => $this->session->userdata('user_id'),
            'fecha_modificacion' => date('Y-m-d H:i:s')
        );

       
        $this->db->where($this->id, $data['id_infraccion_pago_cuota']);
        $this->db->update($this->table, $carga);

    

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        }else {
            $this->db->trans_commit();
            return $this->id;
        }
    }

     /** Funcion que permite realizar 
      * la actualizacion de registros 
      * @param : array de datos
      **/
    public function update_comprobante($data) {
       
        if(empty($data['id_infraccion_pago_cuota'])) $data['infraccion_pago_cuota'] = null;
         if(empty($data['nombre_apellido'])) $data['nombre_apellido'] = null;
        if(empty($data['dni_representante'])) $data['dni_representante'] = null;
        if(empty($data['domicilio_representante'])) $data['domicilio_representante'] = null;
        if(empty($data['vinculo_representante']))   $data['vinculo_representante'] = null;
        if(empty($data['importe_general'])) $data['importe_general'] = null;
        if(empty($data['importe_alcoholemia']))  $data['importe_alcoholemia']  = null;
       
        $this->db->trans_begin();
        $carga = array(
           
            'importe_general'            => $data['importe_general'],
            'importe_alcoholemia'        => $data['importe_alcoholemia'],   
            'nombre_apellido'    => $data['nombre_apellido'],
            'dni_representante'  => $data['dni_representante'],
            'domicilio_representante' => $data['domicilio_representante'],
            'vinculo_representante'  => $data['vinculo_representante'],
            'usuario_modificacion' => $this->session->userdata('user_id'),
            'fecha_modificacion' => date('Y-m-d H:i:s')
        );


        $this->db->where($this->id, $data['id_infraccion_pago_cuota']);
        $this->db->update($this->table, $carga);


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        }else {
            $this->db->trans_commit();
            return $this->id;
        }
    }

    /**
      * Funcion que permite actualizar 
      * el Pago del comprobante estableciendo ciertos 
      * valores , como la fecha del pago y hora del pago
     **/
    public function update_pago($data) {
        $this->db->trans_begin();
        $carga = array(
            'fecha_pago' =>$data['fecha_pago'],
            'hora_pago'  =>$data['hora_pago'],
            'estado'     =>$data['estado'], 
            'tipo_operacion_pago_cuota'           => $data['tipo_pago'], 
            'numero_compra'       => $data['numero_compra'],
            'digito_factura'      => $data['digito_factura'],
            'numero_factura'      => $data['numero_factura'], 
            'comprobante_pago_alcoholemia' =>$data['comprobante_pago_alcoholemia'],
            'comprobante_pago_general' =>$data['comprobante_pago_general'],
            'comprobante_banco'        =>$data['comprobante_banco'],  
            'id_tipo_tarjeta'          =>$data['tipo_tarjeta'], 
            'usuario_modificacion' => $this->session->userdata('user_id'),
            'fecha_modificacion' => date('Y-m-d H:i:s')
        );


        $this->db->where($this->id, $data['id_infraccion_pago_cuota']);
        $this->db->update($this->table, $carga);


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        }else {
            $this->db->trans_commit();
            return $this->id;
        }
    }


    



      /**
    *    Funcion que permite obtener los 
         las cuotas a partir de la infraccion pago cuota
    *    @param:idContravencion
    *    @return : un listado de leyes articulos incisos
    **/
    public function getByIdInfraccionPago($idInfraccionpago){
       
   
        //Se definen los campos de la consulta 
        $campos="infraccionpagocuota.id_infraccion_pago_cuota as id,".
                "infraccionpagocuota.id_infraccion_pago as id_infraccion_pago,".  
                "infraccionpagocuota.numero_cuota as numero_cuota,".
                "infraccionpagocuota.comprobante as comprobante,".
                "infraccionpagocuota.fecha_pago as fecha_pago,".
                "infraccionpagocuota.hora_pago as hora_pago,".
                "infraccionpagocuota.importe_general as importe_general,".
                "infraccionpagocuota.importe_alcoholemia as importe_alcoholemia,".
                "infraccionpagocuota.estado as estado,".
                "infraccionpagocuota.comprobante_pago_general as comprobanteGeneral,".
                "infraccionpagocuota.comprobante_pago_alcoholemia as comprobanteAlcoholemia,".
                "infraccionpagocuota.tipo_operacion_pago_cuota as tipo_pago_cuota,".
                "infraccionpagocuota.numero_compra as numeroCompra,".
                "infraccionpagocuota.digito_factura as digitoFactura,".
                "infraccionpagocuota.numero_factura as numeroFactura,".
                "infraccionpagocuota.comprobante_banco as comprobanteBanco";
       
     
        $this->db->select($campos);
        $this->db->from($this->table.' as infraccionpagocuota');
        $this->db->where('infraccionpagocuota.id_infraccion_pago', $idInfraccionpago);
        $this->db->order_by($this->id, "asc");
       
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }





    /**
      * Funcion que permite obtener los  pagos 
      * de las cuotas 
     **/


  public function buscar($filter = null ,$limit=null ,$start = null){
          
        //Se definen los campos de la consulta 
        $campos="infraccionpagocuota.id_infraccion_pago_cuota as id,".
                "infraccionpagocuota.id_infraccion_pago as id_infraccion_pago,".  
                "infraccionpagocuota.numero_cuota as numero_cuota,".
                "infraccionpagocuota.comprobante as comprobante,".
                "infraccionpagocuota.fecha_pago as fecha_pago,".
                "infraccionpagocuota.hora_pago as hora_pago,".
                "infraccionpagocuota.importe_general as importe_general,".
                "infraccionpagocuota.importe_alcoholemia as importe_alcoholemia,".
                "infraccionpagocuota.estado as estado,".
                "infraccionpagocuota.comprobante_pago_general as comprobanteGeneral,".
                "infraccionpagocuota.comprobante_pago_alcoholemia as comprobanteAlcoholemia,".
                "infraccionpagocuota.tipo_operacion_pago_cuota as tipo_pago_cuota,".
                "infraccionpagocuota.numero_compra as numeroCompra,".
                "infraccionpagocuota.digito_factura as digitoFactura,".
                "infraccionpagocuota.numero_factura as numeroFactura,".
                "infraccionpagocuota.comprobante_banco as comprobanteBanco,".
                "infracciones.numero_acta as numero_acta,".
                "tipotarjeta.nombre as nombreTarjeta";
              
        
        if (empty($filter['actual'])) $filter['actual']  = null;
    

        // Relaciono con infracciones pagos
        $this->db->join('infracciones.infracciones_pagos as infraccionPago',
                        'infraccionpagocuota.id_infraccion_pago  = infraccionPago.id_infraccion_pago','left');
        
        // Relacioni con infracciones
        $this->db->join('infracciones.infracciones as infracciones',
                        'infraccionPago.id_infraccion = infracciones.id_infraccion');

        // tipo tarjeta 
        $this->db->join('infracciones.tipo_tarjeta as tipotarjeta',
                        'infraccionpagocuota.id_tipo_tarjeta = tipotarjeta.id_tipo_tarjeta', 'left'); 


        $this->db->select($campos);
        $this->db->from($this->table.' as infraccionpagocuota');


        //fecha_desde 
       if($filter['fecha_desde']!=null && $filter['fecha_desde']!=""){
            $this->db->where('fecha_pago >=',$filter['fecha_desde']);
        }

        if($filter['fecha_hasta']!=null && $filter['fecha_hasta']!=""){
            $this->db->where('fecha_pago <= ',$filter['fecha_hasta']);
        }


        if($filter['numero_acta']!=null && $filter['numero_acta']!=""){
            $this->db->like('infracciones.numero_acta',$filter['numero_acta']);
        }
         
         
         if($filter['tipo_pago']!=null  &&  $filter['tipo_pago']=='FES'){
               $this->db->where('tipo_operacion_pago_cuota ', FES);
         }else if( $filter['tipo_pago'] !=null && $filter['tipo_pago']== 'BANCO'){
               $this->db->where('tipo_operacion_pago_cuota',BANCO); 
         }else if( $filter['tipo_pago']!=null && $filter['tipo_pago']=='TARJETA_DEBITO'){
               $this->db->where('tipo_operacion_pago_cuota',TARJETA_DEBITO);
         }else if( $filter['tipo_pago']!=null && $filter['tipo_pago']=='TARJETA_CREDITO') {
               $this->db->where('tipo_operacion_pago_cuota',TARJETA_CREDITO);
         }   

         // fecha actual
         if($filter['actual'] != null && isset($filter['actual'])) {
            $this->db->where('infraccionpagocuota.fecha_alta > ',date('Y-m-d 00:00:00'));
         } 

         // Tipo tarjeta 
         if($filter['tipo_tarjeta'] != null && isset($filter['tipo_tarjeta'])) {
            $this->db->where('id_tipo_tarjeta',$filter['tipo_tarjeta']);
         }



        $this->db->limit($limit,$start)->order_by('infraccionpagocuota.id_infraccion_pago_cuota, infracciones.id_infraccion');
        $query = $this->db->get();
        //var_dump($this->db->last_query());
        $result = $query->result();
        return $result;

    }

 }
