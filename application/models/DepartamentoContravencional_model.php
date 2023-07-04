<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Contravencion correspondiente a la tabla
   *  @tabla: contravenciones.departamentos 
  **/

class DepartamentoContravencional_model extends MY_Model {

    public function __construct() {
       
        //Seteamos los valores 
        //para el base bean
        $this->table='contravenciones.departamentos';
        $this->id='id_departamento';
    }


   

    /**
      * Funcion que permite realizar la insercion 
      * de un registro
      * @param : data es un array de datos 
      *          que contiene datos de contravenciones
     **/
    public function insert($data) {
        //Section -  Expediente 
        if(empty($data['num_exp_vial'])) $data['num_exp_vial'] = null;
        if(empty($data['fecha_ingreso'])) $data['fecha_ingreso'] = null;
        if(empty($data['num_acta_vial'])) $data['num_acta_vial'] = null;
        if(empty($data['num_exp_vial_entrante'])) $data['num_exp_vial_entrante']=null;

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
            'num_exp_vial' => $data['num_exp_vial'],
            'fecha_ingreso' => $data['fecha_ingreso'],
            'num_acta_vial' => $data['num_acta_vial'],
            'num_exp_vial_entrante' => $data['num_exp_vial_entrante'],
            
 

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
        if(empty($data['marca'])) $data['marca'] = null;
        if(empty($data['id_tipo_movil'])) $data['id_tipo_movil'] = null;
        if(empty($data['anio'])) $data['anio'] = null;
        if(empty($data['modelo'])) $data['modelo'] = null;
        if(empty($data['kilometraje'])) $data['kilometraje'] = null;
        if(empty($data['legajo'])) $data['legajo'] = null;
        if(empty($data['id_unidad_policial'])) $data['id_unidad_policial'] = null;
        if(empty($data['id_dependencia'])) $data['id_dependencia'] = null;

        if(empty($data['nro_comprobante'])) $data['nro_comprobante'] = null;
        if(empty($data['importe'])) $data['importe'] = null;
        if(empty($data['nro_resolucion'])) $data['nro_resolucion'] = null;
        if(empty($data['observacion'])) $data['observacion'] = null;
        if(empty($data['nro_nota_refuerzo'])) $data['nro_nota_refuerzo'] = null;
        if(empty($data['jefe_logistica_autorizante'])) $data['jefe_logistica_autorizante'] = null;
        if(empty($data['jefe_unidad_autorizante'])) $data['jefe_unidad_autorizante'] = null;

        $this->db->trans_begin();
        $carga = array(
            'marca' => $data['marca'],
            'modelo' => $data['modelo'],
            'anio' => $data['anio'],
            'id_tipo_movil' => $data['id_tipo_movil'],
            'kilometraje' => $data['kilometraje'],
            'id_dependencia' => $data['id_dependencia'],
            'id_unidad_policial' => $data['id_unidad_policial'],
             

            'legajo' => $data['legajo'],
            'apellido' => $data['apellido'],
            'nombre' => $data['nombre'],
            'cargo_funcion' => $data['cargo_funcion'],
            'lugar_de_trabajo' => $data['lugar_de_trabajo'],

            'nro_comprobante' => $data['nro_comprobante'],
            'importe' => $data['importe'],
            'nro_resolucion' => $data['nro_resolucion'],
            'observacion' => $data['observacion'],
            'nro_nota_refuerzo' => $data['nro_nota_refuerzo'],
            'jefe_logistica_autorizante' => $data['jefe_logistica_autorizante'],
            'jefe_unidad_autorizante' => $data['jefe_unidad_autorizante'],
            'usuario_modificacion' => $this->session->userdata('user_id'),
            'fecha_modificacion' => date('Y-m-d H:i:s'),
            'sincro_envio' => 2
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
                "contravencion.num_exp_vial as expediente,".
                "contravencion.num_exp_vial_entrante as expedienteEntrante,".
                "contravencion.fecha_ingreso as fechaIngreso,".
                "contravencion.num_acta_vial as actaVial,".
                "contravencion.estado as estado,";
       
        //Propietario
        $campos=$campos . " CONCAT(propietario.nombre,'.',propietario.apellido) as propietario";
       

        if(empty($filter['num_exp_vial'])) $data['num_exp_vial'] = null;
        if(empty($data['num_acta_vial'])) $data['num_acta_vial'] = null;
        if(empty($data['fecha_desde'])) $data['fecha_desde'] = null;
        if(empty($data['fecha_hasta'])) $data['fecha_hasta'] = null;
        if(empty($data['propietario'])) $data['propietario'] = null;

   
       
     
        $this->db->join('public.personas as propietario',
                        'propietario.cuil = contravencion.cuil_propietario OR '.
                        'propietario.dni  = contravencion.cuil_propietario');
        $this->db->select($campos);
        $this->db->from($this->table.' as contravencion');

         //numero de expediente vial
        if($filter['num_exp_vial']!=null && $filter['num_exp_vial']!=""){
            $this->db->like('num_exp_vial',$filter['num_exp_vial']);
        }

        //numero de acta vial 
        if($filter['num_acta_vial']!=null && $filter['num_acta_vial']!=""){
            $this->db->like('num_acta_vial',$filter['num_acta_vial']);
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
        
        $query = $this->db->get();
        $result = $query->result();
        return $result;

    }


  
 }
