<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Contravencion correspondiente a la tabla
   *  @tabla: contravenciones.t_contravencion 
  **/

class PersonasComercio_model extends MY_Model {

    public function __construct() {
       
     
        $this->table='contravenciones.personas_comercio';
        $this->id='id_persona_comercio';
    }


   

    /**
      * Funcion que permite realizar la insercion 
      * de un registro
      * @param : data es un array de datos 
      *          que contiene datos de contravenciones
     **/
    public function insert($data) {
        //Section -  Expediente 
        if(empty($data['id_comercio'])) $data['id_comercio'] = null;
        if(empty($data['cuil'])) $data['cuil'] = null;
        

        

     
        $this->db->trans_begin();
        $carga = array(
            //Section -  Expediente
            'id_comercio' => $data['id_comercio'],
            'cuil' => $data['cuil'],
            
            
             
            
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
       
         //Section -  Expediente 
        if(empty($data['numero_expediente'])) $data['numero_expediente'] = null;
        if(empty($data['fecha_ingreso'])) $data['fecha_ingreso'] = null;
        if(empty($data['numero_acta'])) $data['numero_acta'] = null;
        if(empty($data['numero_expediente_entrante'])) $data['numero_expediente_entrante']=null;
        if(empty($data['seccion']))  $data['seccion']=null;
        if(empty($data['paquete']))  $data['paquete']=null;

        //Section - Lugar del hecho 
        if(empty($data['fecha_hecho'])) $data['fecha_hecho'] = null;
        if(empty($data['hora_hecho'])) $data['hora_hecho'] = null;
        if(empty($data['departamento'])) $data['departamento'] = null;
        if(empty($data['localidad'])) $data['localidad'] = null;
        if(empty($data['barrio'])) $data['barrio'] = null;
        if(empty($data['calle'])) $data['calle'] = null;
        if(empty($data['numero'])) $data['numero'] = null;
        
        //Datos del vehiculo 
        if(empty($data['tipovehiculo'])) $data['tipovehiculo']=null;
        if(empty($data['marca'])) $data['marca']=null;
        if(empty($data['modelo'])) $data['modelo']=null;
        if(empty($data['dominio'])) $data['dominio']=null;

        //Propietario y Conductor
        if(empty($data['propietario'])) $data['propietario'] =null;
        if(empty($data['conductor'])) $data['conductor'] =null;

        //Dictamen
        if(empty($data['dictamen'])) $data['dictamen']=null;

        //estado
        if(empty($data['estado'])) $data['estado']=null;


        $this->db->trans_begin();
        $carga = array(
            //Section -  Expediente
            'numero_expediente' => $data['numero_expediente'],
            'fecha_ingreso' => $data['fecha_ingreso'],
            'numero_acta' => $data['numero_acta'],
            'numero_expediente_entrante' => $data['numero_expediente_entrante'],
            'seccion' =>$data['seccion'],
            'paquete' =>$data['paquete'],
            
             //tipo_expediente 
            'tipo_expediente' => 'V', //Tipo de expediente vial

            //Section - Lugar del hecho
            'fecha_hecho' => $data['fecha_hecho'],
            'hora_hecho' => $data['hora_hecho'],
            'id_calle' => $data['calle'],
            'numero' => $data['numero'],
            
            //Datos del vehiculo 
            'id_modelo'=>$data['modelo'],
            'dominio'=>$data['dominio'],
             
            //Section - propietario
            'cuil_propietario' => $data['propietario'],
            //Section - conductor
            'cuil_conductor'=>$data['conductor'],

            //dictamen
            'dictamen' => $data['dictamen'],

            //estado
            'estado' =>$data['estado'],
            
            'usuario_modificacion' => $this->session->userdata('user_id'),
            'fecha_modificacion' => date('Y-m-d H:i:s')
        );

        $this->db->where('id', $data['id']);
        $this->db->update('logistica.cargas_particular', $carga);

    

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        }else {
            $this->db->trans_commit();
            return $data['id'];
        }
    }

    /** Funcion que permite obtener el listado de 
      * contravenciones a partir de una serie de 
      * filters 
      */
    public function buscar($filter = null){
        
        //Se definen los campos de la consulta de persona
        $campos="contravencion.id_contravencion as id,".
                "contravencion.numero_expediente as expediente,".
                "contravencion.numero_expediente_entrante as expedienteEntrante,".
                "contravencion.fecha_ingreso as fechaIngreso,".
                "contravencion.numero_acta as acta,".
                "contravencion.estado as estado,".
                "contravencion.tipo_expediente as tipoExpediente,";
       
        //Propietario
        $campos=$campos . " CONCAT(propietario.nombre,'.',propietario.apellido) as propietario";
       
        echo "numero_expediente : ".$filter['numero_expediente'];

        if(empty($filter['numero_expediente']) || $filter['numero_expediente']==null)
              $data['numero_expediente'] = null;
        
        if(empty($data['numero_acta'])) $data['numero_acta'] = null;
        
        if(empty($data['fecha_desde'])) $data['fecha_desde'] = null;
        if(empty($data['fecha_hasta'])) $data['fecha_hasta'] = null;
        if(empty($data['propietario'])) $data['propietario'] = null;
        if(empty($data['tipo_expediente'])) $data['tipo_expediente']=null;

   
       
     
        $this->db->join('public.personas as propietario',
                        'propietario.cuil = contravencion.cuil_propietario OR '.
                        'propietario.dni  = contravencion.cuil_propietario');
        $this->db->select($campos);
        $this->db->from($this->table.' as contravencion');

         //numero de expediente vial
        if($filter['numero_expediente']!=null && $filter['numero_expediente']!=""){
            $this->db->like('numero_expediente',$filter['numero_expediente']);
        }

        //numero de acta vial 
        if($filter['numero_acta']!=null && $filter['numero_acta']!=""){
            $this->db->like('numero_acta',$filter['numero_acta']);
        }

        //fecha_dese 
        if($filter['fecha_desde']!=null && $filter['fecha_desde']!=""){
            $this->db->where('fecha_ingreso >=',$filter['fecha_desde']);
        }

        if($filter['fecha_hasta']!=null && $filter['fecha_hasta']!=""){
            $this->db->where('fecha_ingreso <= ',$filter['fecha_hasta']);
        }

        if($filter['propietario']!=null && $filter['propietario']!=""){
           $this->db->where('propietario.cuil = ',$filter['propietario']);
           $this->db->or_where('propietario.dni =',$filter['propietario']);

        }

        if($filter['tipo_expediente']=='C' || $filter['tipo_expediente']=='O'){
           $this->db->where('contravencion.tipo_expediente = ','C');
           $this->db->or_where('contravencion.tipo_expediente =','O');
        }else{
           echo "ingreso aca";
           $this->db->where('contravencion.tipo_expediente = ',$filter['tipo_expediente']);
        }
        
        $query = $this->db->get();
        $result = $query->result();
        return $result;

    }


    /**
      ** Funcion que permite actualizar el estado de un expediente
       * @params : $idContravencion, $estado
       **/
    public function actualizarEstado($data){
        //estado
        if(empty($data['estado'])) $data['estado']=null;

        $this->db->trans_begin();
        $carga = array(
            //Section -  Expediente
            'estado' => $data['nombre_estado'],
            'usuario_modificacion' => $this->session->userdata('user_id'),
            'fecha_modificacion' => date('Y-m-d H:i:s')
        );

        $this->db->where($this->id, $data['id_contravencion']);
        $this->db->update($this->table, $carga);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        }else {
            $this->db->trans_commit();
            return $data['id_contravencion'];
        }
    }


  
 }

