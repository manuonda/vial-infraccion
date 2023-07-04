<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Contravencion correspondiente a la tabla
   *  @tabla: contravenciones.t_contravencion 
  **/

class Contravencion_model extends MY_Model {

    public function __construct() {
       
        //Seteamos los valores 
        //para el base bean
        $this->table='contravenciones.contravenciones';
        $this->id='id_contravencion';
    }


   

    /**
      * Funcion que permite realizar la insercion 
      * de un registro
      * @param : data es un array de datos 
      *          que contiene datos de contravenciones
     *           comercial 
     **/
    public function insertComercial($data) {
        
        if(empty($data['num_exp_cont'])) $data['num_exp_cont'] = null; 
        if(empty($data['fecha_ingreso'])) $data['fecha_ingreso']=null;
        if(empty($data['num_acta_cont'])) $data['num_acta_cont'] =null; 
        if(empty($data['regional'])) $data['regional']=null ;
        if(empty($data['num_exp_ent'])) $data['num_exp_ent']=null;
        if(empty($data['dependencia'])) $data['dependencia']=null ; ;
        if(empty($data['movimiento'])) $data['movimiento']=null;
        if(empty($data['contravencionseccion'])) $data['contravencionseccion'] =null; 
        if(empty($data['involucrado'])) $data['involucrado'] = null;
        if(empty($data['regional'])) $data['regional'] =null;
        if(empty($data['optsentencia'])) $data['optsentencia'] =null;
       
        $this->db->trans_begin();
        $carga = array(
            //Section -  Expediente
            'numero_expediente' => $data['num_exp_cont'],
            'fecha_ingreso' => $data['fecha_ingreso'],
            'numero_acta' => $data['num_acta_cont'],
            'id_regional' => $data['regional'],
            'numero_expediente_entrante' => $data['num_exp_ent'],
            'id_dependencia' =>$data['dependencia'],
            'id_contravencion_movimiento' =>$data['movimiento'],
            'id_contravencion_seccion' =>$data['contravencionseccion'],
            'id_regional' =>$data['regional'],
            'cuil_involucrado'=>$data['involucrado'],
            'id_tipo_contravencion'=>$data['tipocontravencion'],
            'optsentencia'=>$data['optsentencia'],     
            
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


     /**
       * Funcion que permite realizar la insercion 
       * de registros de tipo otros
       * @param array of data
     **/ 
     public function insertOtros($data) {
        
         
        if(empty($data['num_exp_cont'])) $data['num_exp_cont'] = null; 
        if(empty($data['fecha_ingreso'])) $data['fecha_ingreso']=null;
        if(empty($data['num_acta_cont'])) $data['num_acta_cont'] =null; 
        if(empty($data['regional'])) $data['regional']=null ;
        if(empty($data['num_exp_ent'])) $data['num_exp_ent']=null;
        if(empty($data['dependencia'])) $data['dependencia']=null ; ;
        if(empty($data['movimiento'])) $data['movimiento']=null;
        if(empty($data['contravencionseccion'])) $data['contravencionseccion'] =null; 
        if(empty($data['involucrado'])) $data['involucrado'] = null;
        if(empty($data['regional'])) $data['regional'] =null;
        if(empty($data['tipocontravencion'])) $data['tipocontravencion']=null;
       
        $this->db->trans_begin();
        $carga = array(
            //Section -  Expediente
            'numero_expediente' => $data['num_exp_cont'],
            'fecha_ingreso' => $data['fecha_ingreso'],
            'numero_acta' => $data['num_acta_cont'],
            'id_regional' => $data['regional'],
            'numero_expediente_entrante' => $data['num_exp_ent'],
            'id_dependencia' =>$data['dependencia'],
            'id_contravencion_movimiento' =>$data['movimiento'],
            'id_contravencion_seccion' =>$data['contravencionseccion'],
            'id_regional' =>$data['regional'],
            'cuil_involucrado'=>$data['involucrado'],
            'id_tipo_contravencion'=>$data['tipocontravencion'],


            //Section - Lugar del hecho
            'fecha_hecho' => $data['fecha_hecho'],
            'hora_hecho' => $data['hora_hecho'],
            'id_calle' => $data['calle'],
            'numero_direccion' => $data['numero'],
            
            
            'usuario_alta' => $this->session->userdata('user_id'),
            'fecha_alta' => date('Y-m-d H:i:s')
        );

        ($data);
        $this->db->insert($this->table, $carga);
        $id_carga = $this->db->insert_id();
        ($this->db->last_query());


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
    public function updateComercial($data) {
       
             
        if(empty($data['num_exp_cont'])) $data['num_exp_cont'] = null; 
        if(empty($data['fecha_ingreso'])) $data['fecha_ingreso']=null;
        if(empty($data['num_acta_cont'])) $data['num_acta_cont'] =null; 
        if(empty($data['regional'])) $data['regional']=null ;
        if(empty($data['num_exp_ent'])) $data['num_exp_ent']=null;
        if(empty($data['dependencia'])) $data['dependencia']=null ; ;
        if(empty($data['movimiento'])) $data['movimiento']=null;
        if(empty($data['contravencionseccion'])) $data['contravencionseccion'] =null; 
        if(empty($data['involucrado'])) $data['involucrado'] = null;
        if(empty($data['regional'])) $data['regional'] =null;
       
        $this->db->trans_begin();
        $carga = array(
            //Section -  Expediente
            'numero_expediente' => $data['num_exp_cont'],
            'fecha_ingreso' => $data['fecha_ingreso'],
            'numero_acta' => $data['num_acta_cont'],
            'id_regional' => $data['regional'],
            'numero_expediente_entrante' => $data['num_exp_ent'],
            'id_dependencia' =>$data['dependencia'],
            'id_contravencion_movimiento' =>$data['movimiento'],
            'id_contravencion_seccion' =>$data['contravencionseccion'],
            'id_regional' =>$data['regional'],
            'cuil_involucrado'=>$data['involucrado'],
            'id_tipo_contravencion'=>$data['tipocontravencion'],


            //Section - Lugar del hecho
            'fecha_hecho' => $data['fecha_hecho'],
            'hora_hecho' => $data['hora_hecho'],
            'id_calle' => $data['calle'],
            'numero_direccion' => $data['numero'],
            
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
                "contravencion.cuil_involucrado as cuilInvolucrado,".
                "movimiento.nombre as movimiento,".
                "seccion.nombre as seccion,".
                "tipocontravencion.nombre as nombreTipoContravencion,";

       
        //Propietario
        $campos=$campos . " CONCAT(involucrado.nombre,'.',involucrado.apellido) as involucrado";
       
     

        if(empty($filter['numero_expediente']) || $filter['numero_expediente']==null)
              $data['numero_expediente'] = null;
        
        if(empty($data['numero_acta'])) $data['numero_acta'] = null;
        
        if(empty($data['fecha_desde'])) $data['fecha_desde'] = null;
        if(empty($data['fecha_hasta'])) $data['fecha_hasta'] = null;
        if(empty($data['propietario'])) $data['propietario'] = null;
        if(empty($data['tipo_expediente'])) $data['tipo_expediente']=null;

   
       
     
        //involucrado
        $this->db->join('public.personas as involucrado',
                        'involucrado.cuil  = contravencion.cuil_involucrado  ','left');

        
        //contravencion movimiento 
        $this->db->join('contravenciones.contravencion_movimiento as movimiento',
                        'movimiento.id_contravencion_movimiento  = contravencion.id_contravencion_movimiento','left');
 
        //contravencion seccion 
        $this->db->join('contravenciones.contravencion_seccion as seccion',
                        'seccion.id_contravencion_seccion  = contravencion.id_contravencion_seccion','left');

        //Tipo contravencion
        $this->db->join('contravenciones.tipo_contravencion as tipocontravencion',
                        'tipocontravencion.id_tipo_contravencion  = contravencion.id_tipo_contravencion','left');



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


        //Cambiar esta parteeeeeeeeeeeeeeeeeeeee!!!!!!!!!!!
        //Tipo contravencion 
        /*if($filter['tipo_expediente']=='C' || $filter['tipo_expediente']=='O'){
           $this->db->where('contravencion.tipo_expediente = ','C');
           $this->db->or_where('contravencion.tipo_expediente =','O');
        }else{
           
           $this->db->where('contravencion.tipo_expediente = ',$filter['tipo_expediente']);
        }*/

        //($this->db->last_query());
        
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
