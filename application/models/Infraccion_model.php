<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Contravencion correspondiente a la tabla
   *  @tabla: infracciones.t_infracciones 
  **/

class Infraccion_model extends MY_Model {

    public function __construct() {
       
         parent::__construct();
        //Seteamos los valores 
        //para el base bean
        ini_set('memory_limit', '-1');
        $this->table='infracciones.infracciones';
        $this->id='id_infraccion';
    }


    
      /**
    *    Funcion que permite obtener 
    *    las localidades por departamento
    **/
    public function buscarNumeroActa($numeroActa){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('numero_acta',$numeroActa);
       return $this->db->get()->result();
    }
   

    /**
      * Funcion que permite realizar la insercion 
      * de un registro
      * @param : data es un array de datos 
      *          que contiene datos de infraccion vial
     **/
    public function insert($data) {
        //Section - Acta
        if(empty($data['fecha_ingreso'])) $data['fecha_ingreso'] = null;
        if(empty($data['numero_acta'])) $data['numero_acta'] = null;
        if(empty($data['seccion']))  $data['seccion']=null;
        if(empty($data['paquete']))  $data['paquete']=null;

        //Section - Lugar del hecho 
        if(empty($data['fecha_hecho'])) $data['fecha_hecho'] = null;
        if(empty($data['hora_hecho'])) $data['hora_hecho'] = null;
        if(empty($data['provincia']))  $data['provincia'] =null;
        if(empty($data['departamento'])) $data['departamento'] = null;
        if(empty($data['localidad'])) $data['localidad'] = null;
        if(empty($data['destacamento'])) $data['destacamento']=null;
        if(empty($data['lugar_hecho'])) $data['lugar_hecho']=null;
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
        if(empty($data['documentoPropietario'])) $data['documentoPropietario']=null;
       
        //Infractor 
        if(empty($data['involucrado'])) $data['involucrado'] =null;
        if(empty($data['documentoInvolucrado'])) $data['documentoInvolucrado']=null;

        
        //Tipo Persona 
        if(empty($data['tipoPersona'])) $data['tipoPersona'] = null ;

         
        //descripcion
        if(empty($data['descripcion'])) $data['descripcion']=null;

        //Informacion Restantes 
        if(empty($data['numero_licencia'])) $data['numero_licencia']=null;
        if(empty($data['categoria'])) $data['categoria']=null;
        if(empty($data['autoridad']))$data['autoridad']=null;
        if(empty($data['fecha_expedicion'])) $data['fecha_expedicion']=null;
        if(empty($data['fecha_vencimiento'])) $data['fecha_vencimiento']=null;


        

     
        $this->db->trans_begin();
        $carga = array(
            //Section -  Lugar
            
            'fecha_ingreso' => $data['fecha_ingreso'],
            'numero_acta' => $data['numero_acta'],
            'seccion' =>$data['seccion'],
            'paquete' =>$data['paquete'],
            'serie'=>$data['serie'],
            
            
            //Section - Lugar del hecho
            'fecha_hecho' => $data['fecha_hecho'],
            'hora_hecho' => $data['hora_hecho'],
            'numero' => $data['numero'],
            'id_provincia' =>$data['provincia'],
            'id_departamento'=>$data['departamento'],
            'id_localidad'=>$data['localidad'],
            'id_destacamento'=>$data['destacamento'],
            'lugar_hecho'=>$data['lugar_hecho'],
            
            //Datos del vehiculo 
            'id_modelo'=>$data['modelo'],
            'dominio'=>$data['dominio'],
       
            
            //Section - infractor 
            'cuil_involucrado'=>$data['involucrado'],
            'dni_involucrado'=>$data['documentoInvolucrado'],
            'cuil_propietario'=>$data['propietario'],
            'dni_propietario'=>$data['documentoPropietario'],
            'cuit_persona_juridica' => $data['cuitPersonaJuridica'],
            'persona_establecer_involucrado' => $data['personaEstablecerInvolucrado'],
            'persona_establecer_propietario' => $data['personaEstablecerPropietario'],

            //descripcion 
            'descripcion' =>$data['descripcion'],
            'numero_licencia' =>$data['numero_licencia'],
            'categoria'=>$data['categoria'],
            'autoridad'=>$data['autoridad'],
            'fecha_expedicion'=>$data['fecha_expedicion'],
            'fecha_vencimiento'=>$data['fecha_vencimiento'],

            //TipoPersona
            'tipo_persona' => $data['tipoPersona'], 

    
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
       
         //Section - Acta
        if(empty($data['fecha_ingreso'])) $data['fecha_ingreso'] = null;
        if(empty($data['numero_acta'])) $data['numero_acta'] = null;
        if(empty($data['seccion']))  $data['seccion']=null;
        if(empty($data['paquete']))  $data['paquete']=null;

        //Section - Lugar del hecho 
        if(empty($data['fecha_hecho'])) $data['fecha_hecho'] = null;
        if(empty($data['hora_hecho'])) $data['hora_hecho'] = null;
        if(empty($data['provincia']))  $data['provincia'] = null;
        if(empty($data['departamento'])) $data['departamento'] = null;
        if(empty($data['localidad'])) $data['localidad'] = null;
        if(empty($data['destacamento'])) $data['destacamento']=null;
        if(empty($data['lugar_hecho'])) $data['lugar_hecho']=null;
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
        if(empty($data['documentoPropietario'])) $data['documentoPropietario']=null;
       
        //Infractor 
        if(empty($data['involucrado'])) $data['involucrado'] =null;
        if(empty($data['documentoInvolucrado'])) $data['documentoInvolucrado']=null;


        //Informacion Restantes 
        if(empty($data['numero_licencia'])) $data['numero_licencia']=null;
        if(empty($data['categoria'])) $data['categoria']=null;
        if(empty($data['autoridad']))$data['autoridad']=null;
        if(empty($data['fecha_expedicion'])) $data['fecha_expedicion']=null;
        if(empty($data['fecha_vencimiento'])) $data['fecha_vencimiento']=null;
        
        if(empty($data['cuitPersonaJuridica'])) $data['cuitPersonaJuridica'] = null;
        if(empty($data['personaEstablecerInvolucrado'])) $data['personaEstablecerInvolucrado'] = null;
        if(empty($data['personaEstablecerPropietario'])) $data['personaEstablecerPropietario'] = null;

        //Tipo Persona 
        if(empty($data['tipoPersona'])) $data['tipoPersona'] = null ;
        
        $personaEstablecerPropietario = $data['personaEstablecerPropietario'] != null ?$data['personaEstablecerPropietario'] : 'null';
        $personaEstablecerInvolucrado = $data['personaEstablecerInvolucrado'] != null?$data['personaEstablecerInvolucrado'] :  'null';

      

        $sql = " UPDATE infracciones.infracciones SET  ".
               " fecha_ingreso = '".$data['fecha_ingreso']."',".
               " numero_acta = '".$data['numero_acta']."' ,".
               " seccion  = '".$data['seccion']."' ,".
               " paquete = '".$data['paquete']."' ,". 
               " serie    =  '".$data['serie']."' ,". 
               " fecha_hecho  = '".$data['fecha_hecho']."' ,".
               " hora_hecho = '".$data['hora_hecho']."',".
               " numero = '".$data['numero']."' , ".
               " id_provincia =  '".$data['provincia']."' ,".
               " id_departamento = '".$data['departamento']."',".
               " id_localidad  = '".$data['localidad']."' ,".
               " id_destacamento  = '".$data['destacamento']."' ,".
               " lugar_hecho = '".$data['lugar_hecho']."' ,".
               " id_modelo = '".$data['modelo']."',".
               " dominio = '".$data['dominio']."',".
               " cuil_involucrado = ".($data['involucrado'] != '' && $data['involucrado'] != null? $data['involucrado'] : 'null').",".
               " dni_involucrado = ".($data['documentoInvolucrado'] != null? $data['documentoInvolucrado']: 'null').", ".
               " cuil_propietario = ".($data['propietario'] != null ? $data['propietario']: 'null').",".
               " dni_propietario  =  ".($data['documentoPropietario'] != null ?$data['propietario'] : 'null').",".
               " cuit_persona_juridica  = ".($data['cuitPersonaJuridica'] != null ?data['cuitPersonaJuridica'] : 'null').",".
               " persona_establecer_involucrado = ".$personaEstablecerInvolucrado.",".
               " persona_establecer_propietario  = ".$personaEstablecerPropietario.",".
               " descripcion  = '".$data['descripcion']."', ".
               " numero_licencia  = '".$data['numero_licencia']."',".
               " categoria = '".$data['categoria']."',".
               " autoridad = '".$data['autoridad']."',".
               " fecha_expedicion = '".$data['fecha_expedicion']."',".
               " fecha_vencimiento = '".$data['fecha_vencimiento']."',".
               " tipo_persona = '".$data['tipoPersona']."',".
               " dni_establecer_involucrado = '". $data['dniEstablecerInvolucrado']."',".
               " dni_establecer_propietario = '". $data['dniEstablecerPropietario'] ."',".
               " usuario_modificacion = '". $this->session->userdata('user_id')."',".
               " fecha_modificacion = '".date('Y-m-d H:i:s')."'".
               " WHERE id_infraccion = ".$data['id'];



        $this->db->trans_begin();
        $carga = array(
            //Section -  Lugar
            
            'fecha_ingreso' => $data['fecha_ingreso'],
            'numero_acta' => $data['numero_acta'],
            'seccion' =>$data['seccion'],
            'paquete' =>$data['paquete'],
            'serie'=>$data['serie'],

            
            //Section - Lugar del hecho
            
            'fecha_hecho' => $data['fecha_hecho'],
            'hora_hecho' => $data['hora_hecho'],
            'numero' => $data['numero'],
            'id_provincia'=>$data['provincia'],
            'id_departamento'=>$data['departamento'],
            'id_localidad'=>$data['localidad'],
            'id_destacamento'=>$data['destacamento'],
            'lugar_hecho'=>$data['lugar_hecho'], 
            
             
            //Datos del vehiculo 
            'id_modelo'=>$data['modelo'],
            'dominio'=>$data['dominio'],

             //Section - infractor 
            'cuil_involucrado'=>$data['involucrado'],
            'dni_involucrado'=>$data['documentoInvolucrado'],
            'cuil_propietario'=>$data['propietario'],
            'dni_propietario'=>$data['documentoPropietario'],
            'cuit_persona_juridica' => $data['cuitPersonaJuridica'],
            'persona_establecer_involucrado' => $data['personaEstablecerInvolucrado'],
            'persona_establecer_propietario' => $data['personaEstablecerPropietario'],
            


            
            //descripcion 
            'descripcion' =>$data['descripcion'],
            'numero_licencia' =>$data['numero_licencia'],
            'categoria'=>$data['categoria'],
            'autoridad'=>$data['autoridad'],
            'fecha_expedicion'=>$data['fecha_expedicion'],
            'fecha_vencimiento'=>$data['fecha_vencimiento'],

             //TipoPersona
            'tipo_persona' => $data['tipoPersona'], 

            // Establecer dni 
            'dni_establecer_involucrado' => $data['dniEstablecerPropietario'],
            'dni_establecer_involucrado' => $data['dniEstablecerInvolucrado'],
               
            'usuario_modificacion' => $this->session->userdata('user_id'),
            'fecha_modificacion' => date('Y-m-d H:i:s')
            
        );

       

        $this->db->where($this->id, $data['id']);
        $this->db->update($this->table, $carga);
        
        //$this->db->query($sql);
           
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
          
            return -1;
        }else {
            $this->db->trans_commit();
            return $data['id'];
        }
    }

    
    function update_exhimido($data){
        if(empty($data['descripcion'])) $data['descripcion'] = null;
        if(empty($data['fecha'])) $data['fecha'] = null;
        
        $this->db->trans_begin();
        $carga = array(
            'texto_exhimido' => $data['descripcion'],
            'texto_carece_exhimido' => $data['carece'],
            'fecha_exhimido' => $data['fecha'],
            'estado_pago' => $data['estadoPago'],
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

    /**
      * Funcion que permite obtener el numero 
        de registros de la tabla
     */
    function all_count()
    {   
        $query = $this->db->get($this->table);
    
        return $query->num_rows();  

    }

   
 

    function posts_search_count($search){
        $query = $this
                ->db
                ->like('id',$search)
                ->or_like('title',$search)
                ->get('posts');
    
        return $query->num_rows();
    } 



    /** Funcion que permite obtener el listado de 
      * infracciones a partir de una serie de 
      * filters 
      */
    public function buscar222($filter = null ,$limit=null ,$start = null){

        ini_set('memory_limit', '-1');
        //var_dump("informacion numero 23");
        //Se definen los campos de la consulta de persona
        // $campos="infraccion.id_infraccion as id,".
        //         "infraccion.fecha_ingreso as fechaIngreso,".
        //         "infraccion.numero_acta as numeroActa,".
        //         "infraccion.fecha_hecho as fechaHecho,".
        //         "infraccion.fecha_alta as fechaAlta,".
        //         "infraccion.estado_pago as estadoPago,".
        //         "infraccion.label_cuotas as labelCuotas,".
        //         "infraccionPago.id_infraccion_pago as idInfraccionPago,".
        //         "infraccion.descripcion as descripcion,".
        //         "infraccion.dominio as dominio,".
        //         "infraccion.texto_exhimido as textoExhimido,".
        //         "infraccion.fecha_exhimido as fechaExhimido,".
        //         "infraccion.tipo_persona as tipoPersona,".
        //         "infraccion.persona_establecer_propietario as establecerPropietario,".
        //         "infraccion.persona_establecer_involucrado as establecerInvolucrado,".
        //         "infraccion.dni_establecer_propietario as dniEstablecerPropietario,".
        //         "infraccion.dni_establecer_involucrado as dniEstablecerInvolucrado,".
        //         "infraccion.cuil_involucrado as cuilInvolucrado,".
        //         "infraccion.usuario_alta as usuario_alta,".
        //         "infraccion.dni_involucrado as dniInvolucrado";
              
        //Involucrado o Infractor
        /*$campos=$campos . " involucrado.nombre ||' '|| involucrado.apellido as involucrado,".
                          " infraccion.dni_involucrado as dni_involucrado,";
        */
        //Persona temporal 
        //$campos = $campos ." persona_temporal.nombre ||' '|| persona_temporal.apellido as personaTemporal";   
        
       // if (empty($filter['actual'])) $filter['actual']  = null;
    


        /*Involucrado
        $this->db->join('public.personas as involucrado',
                        'involucrado.dni  = infraccion.dni_involucrado  ','left');
        */

        /* Persona establecer propietario
        $this->db->join('infracciones.persona_temporal as persona_temporal',
                        'persona_temporal.dni = infraccion.dni_establecer_involucrado', 'left');
        */

        //Relaciono con infracciones pagos
       /* $this->db->join('infracciones.infracciones_pagos as infraccionPago',
                        'infraccion.id_infraccion = infraccionPago.id_infraccion','left');
        */
    //     $this->db->select($campos);
    //     $this->db->from($this->table.' as infraccion');

    //     //numero de acta vial 
    //     if($filter['numero_acta']!=null && $filter['numero_acta']!=""){
    //         $this->db->where('numero_acta',$filter['numero_acta']);
    //     }

    //     //fecha_desde 
    //    if($filter['fecha_desde']!=null && $filter['fecha_desde']!=""){
    //         $this->db->where('fecha_hecho >=',$filter['fecha_desde']);
    //     }

    //     if($filter['fecha_hasta']!=null && $filter['fecha_hasta']!=""){
    //         $this->db->where('fecha_hecho <= ',$filter['fecha_hasta']);
    //     }

    //     if($filter['dni']!=null && $filter['dni']!=""){
    //        $this->db->where('infraccion.dni_involucrado = ',$filter['dni']);
    //     }
          

    //     if($filter['dominio']!=null && $filter['dominio']!=""){
    //         $this->db->like('infraccion.dominio',$filter['dominio']);
    //     }
         
    //     if($filter['estado_pago']!=null  &&  $filter['estado_pago']=='INFRACCION_PAGO_NO_GENERADO'){
    //            $this->db->where('estado_pago = ',INFRACCION_PAGO_NO_GENERADO);
    //            $this->db->or_where('estado_pago = ','');
    //      }else if( $filter['estado_pago'] !=null && $filter['estado_pago']== 'INFRACCION_PAGO_INCOMPLETO'){
    //            $this->db->where('estado_pago',INFRACCION_PAGO_INCOMPLETO); 
    //      }else if( $filter['estado_pago']!=null && $filter['estado_pago']=='INFRACCION_PAGO_COMPLETO'){
    //            $this->db->where('estado_pago',INFRACCION_PAGO_COMPLETO);
    //      }else if( $filter['estado_pago']!=null && $filter['estado_pago']=='INFRACCION_PAGO_EXHIMIDO') {
    //            $this->db->where('estado_pago',INFRACCION_PAGO_EXHIMIDO);
    //      }   

    //      if($filter['actual'] != null && isset($filter['actual'])) {
    //         $this->db->where('infraccion.fecha_alta > ',date('Y-m-d 00:00:00'));
    //      } 



    //     $this->db->limit($limit,$start)->order_by('infraccion.id_infraccion');
    //     $query = $this->db->get();
        
 

    //      $result = $query->result();
         
    //      var_dump($this->db->last_query());
    return ["array vacio"];
    

    }

public function buscar($filter = null ,$limit=null ,$start = null){
       
        //Se definen los campos de la consulta de persona
        $campos="infraccion.id_infraccion as id,".
                "infraccion.fecha_ingreso as fechaIngreso,".
                "infraccion.numero_acta as numeroActa,".
                "infraccion.fecha_hecho as fechaHecho,".
                "infraccion.fecha_alta as fechaAlta,".
                "infraccion.estado_pago as estadoPago,".
                "infraccion.label_cuotas as labelCuotas,".
                "infraccionPago.id_infraccion_pago as idInfraccionPago,".
                "infraccion.descripcion as descripcion,".
                "infraccion.dominio as dominio,".
                "infraccion.texto_exhimido as textoExhimido,".
                "infraccion.fecha_exhimido as fechaExhimido,".
                "infraccion.tipo_persona as tipoPersona,".
                "infraccion.persona_establecer_propietario as establecerPropietario,".
                "infraccion.persona_establecer_involucrado as establecerInvolucrado,".
                "infraccion.dni_establecer_propietario as dniEstablecerPropietario,".
                "infraccion.dni_establecer_involucrado as dniEstablecerInvolucrado,".
                "infraccion.cuil_involucrado as cuilInvolucrado,".
                "infraccion.usuario_alta as usuario_alta,".
                "infraccion.dni_involucrado as dniInvolucrado";
              
        //Involucrado o Infractor
        /*$campos=$campos . " involucrado.nombre ||' '|| involucrado.apellido as involucrado,".
                          " infraccion.dni_involucrado as dni_involucrado,";
        */
        //Persona temporal 
        //$campos = $campos ." persona_temporal.nombre ||' '|| persona_temporal.apellido as personaTemporal";   
        
        if (empty($filter['actual'])) $filter['actual']  = null;
    


        /*Involucrado
        $this->db->join('public.personas as involucrado',
                        'involucrado.dni  = infraccion.dni_involucrado  ','left');
        */

        /* Persona establecer propietario
        $this->db->join('infracciones.persona_temporal as persona_temporal',
                        'persona_temporal.dni = infraccion.dni_establecer_involucrado', 'left');
        */

        //Relaciono con infracciones pagos
        $this->db->join('infracciones.infracciones_pagos as infraccionPago',
                        'infraccion.id_infraccion = infraccionPago.id_infraccion','left');

        $this->db->select($campos);
        $this->db->from($this->table.' as infraccion');

        //numero de acta vial 
        if($filter['numero_acta']!=null && $filter['numero_acta']!=""){
            $this->db->where('numero_acta',$filter['numero_acta']);
        }

        //fecha_desde 
       if($filter['fecha_desde']!=null && $filter['fecha_desde']!=""){
            $this->db->where('fecha_hecho >=',$filter['fecha_desde']);
        }

        if($filter['fecha_hasta']!=null && $filter['fecha_hasta']!=""){
            $this->db->where('fecha_hecho <= ',$filter['fecha_hasta']);
        }

        if($filter['dni']!=null && $filter['dni']!=""){
           $this->db->where('infraccion.dni_involucrado = ',$filter['dni']);
        }
          

        if($filter['dominio']!=null && $filter['dominio']!=""){
            $this->db->like('infraccion.dominio',$filter['dominio']);
        }
         
        if($filter['estado_pago']!=null  &&  $filter['estado_pago']=='INFRACCION_PAGO_NO_GENERADO'){
               $this->db->where('estado_pago = ',INFRACCION_PAGO_NO_GENERADO);
               $this->db->or_where('estado_pago = ','');
         }else if( $filter['estado_pago'] !=null && $filter['estado_pago']== 'INFRACCION_PAGO_INCOMPLETO'){
               $this->db->where('estado_pago',INFRACCION_PAGO_INCOMPLETO); 
         }else if( $filter['estado_pago']!=null && $filter['estado_pago']=='INFRACCION_PAGO_COMPLETO'){
               $this->db->where('estado_pago',INFRACCION_PAGO_COMPLETO);
         }else if( $filter['estado_pago']!=null && $filter['estado_pago']=='INFRACCION_PAGO_EXHIMIDO') {
               $this->db->where('estado_pago',INFRACCION_PAGO_EXHIMIDO);
         }   

         if($filter['actual'] != null && isset($filter['actual'])) {
            $this->db->where('infraccion.fecha_alta > ',date('Y-m-d 00:00:00'));
         } 



        $this->db->limit($limit,$start)->order_by('infraccion.id_infraccion', 'asc');
        $query = $this->db->get();
        
 

         $result = $query->result();
         
         //var_dump($this->db->last_query());
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

    /**
      ** Funcion que permite actualizar el estado de una 
       * infraccion :los parametros son  :
       * @params : $idInfraccion, $estadoNew,$label(label que se muestra la cantidad de cuotas)
       **/
    public function updateEstadoInfraccion($idInfraccion,$estadoNew,$label){
        
        $this->db->trans_begin();

          $carga = array(
            'estado_pago    ' => $estadoNew,
            'label_cuotas'  => $label,
            'usuario_modificacion' => $this->session->userdata('user_id'),
            'fecha_modificacion' => date('Y-m-d H:i:s')
        );

        $this->db->where($this->id, $idInfraccion);
        $this->db->update($this->table, $carga);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        }else {
            $this->db->trans_commit();
            return $idInfraccion;
        }
    }



    /**
      * Funcion que permite obtener 
      * una infraccion a partir de su 
      * id
      *  
    **/
    public function getByIdInfraccion($idInfraccion){
       //Se definen los campos de la consulta de persona
        $campos="infraccion.id_infraccion as id,".
                "infraccion.fecha_ingreso as fechaIngreso,".
                "infraccion.numero_acta as numeroActa,".
                "infraccion.fecha_hecho as fechaHecho,".
                "infraccion.estado_pago as estadoPago,".
                "infraccion.label_cuotas as labelCuotas,".
                "infraccionPago.id_infraccion_pago as idInfraccionPago,".
                "infraccion.descripcion as descripcion,".
                "infraccion.dominio as dominio,".
                "infraccion.usuario_alta as usuario_alta,";
              
        //Propietario
        $campos=$campos . " involucrado.nombre ||' '|| involucrado.apellido as involucrado,".
                          "infraccion.dni_involucrado as dni";
                                                      
       
     
        /* tarda mucho esta consulta
          $this->db->join('public.personas as involucrado',
                        'involucrado.cuil = infraccion.cuil_involucrado OR '.
                        'involucrado.dni  = infraccion.dni_involucrado  ','left');
        */

        $this->db->join('public.personas as involucrado',
                        'involucrado.dni  = infraccion.dni_involucrado  ','left');

        //Relaciono con infracciones pagos
        $this->db->join('infracciones.infracciones_pagos as infraccionPago',
                        'infraccion.id_infraccion = infraccionPago.id_infraccion','left');


        //where $idInfraccion 
        $this->db->where('infraccion.id_infraccion',$idInfraccion);


        $this->db->select($campos);
        $this->db->from($this->table.' as infraccion');

        
        $query = $this->db->get();

        $dbgquery = $this->db->last_query();

        //($dbgquery);
      
        $result = $query->result();
         return $result;

    }


    /**
      * Funcion que permite verificar si existe un acta 
      * en las infracciones
     **/
    public function existeNumeroActa($numeroActa){
    

        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("TRIM(numero_acta)",$numeroActa);
     
        $query = $this->db->get();
        $result = $query->row();
      
        return $result;
    }

   
    public function getByParametros($tipoTramite){
    
        $this->db->join('infracciones.infracciones_leyes as infraccionLey',
                        'infraccionLey.id_infraccion  = infraccion.id_infraccion  ','left');
        $this->db->join('leyes.leyes as ley', 'infraccionLey.id_ley = ley.id_ley', 'left');
         if($tipoTramite != null ){
          $this->db->where('ley.id_tipo_tramite', $tipoTramite);
        }
        $this->db->select('count(infraccion.id_infraccion)');
        $this->db->from($this->table.' as infraccion');
        $this->db->group_by('infraccion.id_infraccion');
        $query = $this->db->get();
        $dbgquery = $this->db->last_query();
        //var_dump($dbgquery);
        $result = $query->result();
         return $result;

    }



  
 }
