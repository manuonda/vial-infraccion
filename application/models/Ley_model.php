<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Marca correspondiente a la tabla
   *  @tabla: contravenciones.t_marca 
  **/

class Ley_model extends MY_Model {

    public function __construct() {
       
        //Seteamos los valores 
        //para el base bean
        $this->table='leyes.leyes';
        $this->id='id_ley';
    }


  
 /**
    *    Funcion que permite obtener 
    *    los articulos por el anexo y
    *    el tipo infraccion : Vial(V) y Contravencional(C)
    **/
    public function getByAnexo($idAnexo,$tipoInfraccion){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_anexo',$idAnexo);
        $this->db->where('tipo_infraccion',$tipoInfraccion);
        $this->db->order_by("fecha_alta");
         return $this->db->get()->result();
    }


    /**
      * Funcion que permite obtener 
      *  las leyes por el tipo de infraccion
      * el tipo de infraccion :  Vial(V) y Contravencional(C)
     **/
    public function getByTipoInfraccion($tipoInfraccion){
        $this->db->from($this->table);
        $this->db->where('tipo_infraccion',$tipoInfraccion);
        $this->db->order_by("fecha_alta");
        return $this->db->get()->result();

    }



    
     /**
      * 
      * @param : data es un array de datos 
      *          que contiene datos para realizar 
      *          la insercion de datos
     **/
    public function insert($data) {
        //Section - Acta
        if(empty($data['nombre'])) $data['nombre'] = null;
        if(empty($data['descripcion'])) $data['descripcion'] = null;
        if(empty($data['tipo_infraccion'])) $data['tipo_infraccion']=null;
        if(empty($data['tipo_unidad'])) $data['tipo_unidad']=null;
        if(empty($data['tipo_tramite'])) $data['tipo_tramite'] = null;

        $this->db->trans_begin();
        $carga = array(
            //Section -  Lugar
            
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'tipo_infraccion'=>$data['tipo_infraccion'],
            'tipo_unidad'=>$data['tipo_unidad'],
            'id_tipo_tramite'=>$data['tipo_tramite'],
            'unidad_fija' => $data['unidad_fija'],
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
        if(empty($data['nombre'])) $data['nombre'] = null;
        if(empty($data['descripcion'])) $data['descripcion'] = null;
        if(empty($data['tipo_infraccion'])) $data['tipo_infraccion']=null;
        if(empty($data['tipo_unidad'])) $data['tipo_unidad']=null;
        if(empty($data['tipo_tramite'])) $data['tipo_tramite'] = null;
      
        $this->db->trans_begin();
        $carga = array(
            //Section -  Lugar
            
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'tipo_infraccion'=>$data['tipo_infraccion'],
            'id_tipo_tramite'=>$data['tipo_tramite'],
            'tipo_unidad'=>$data['tipo_unidad'],
            'unidad_fija' => $data['unidad_fija'],

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
      * Funcion que permite obtener 
      * un listado de grupos a partir 
      * de un filter como parametro
      * @param filter
    **/
    public function buscar($filter = null){
        

        if(empty($data['tipo_infraccion'])) $data['tipo_infraccion'] = null;
        

        //Se definen los campos 
        $campos="ley.id_ley as id,".
                "ley.nombre as nombre,".
                "ley.descripcion as descripcion,".
                "ley.tipo_infraccion as tipoInfraccion,".
                "tipo_tramite.nombre as tipoTramite,".
                "ley.tipo_unidad as tipoUnidad,".
                "ley.unidad_fija as unidad_fija";           


       // Relacion con tipo de tramite
       $this->db->join('leyes.tipo_tramite as tipo_tramite',
                        'ley.id_tipo_tramite  = tipo_tramite.id_tipo_tramite','left');                                   
        
        if(empty($data['nombre'])) $data['nombre'] = null;
       
        $this->db->select($campos);
        $this->db->from($this->table.' as ley');

        //numero de acta vial 
        if($filter!=null && $filter['nombre']!=null && $filter['nombre']!=""){
            $this->db->like('nombre',$filter['nombre']);
        }

        //filtro por leyes de tipo vial 
        $this->db->where('tipo_infraccion','V');
        $query = $this->db->get();
        
        $result = $query->result();
         return $result;

    }


    /** Funcion que permiter guardar una 
      * ley
      * @param  : json(nombre,tipo(tipoInfraccion),id) 
      * return  : id o null
      **/
    public function guardar($data){

       if(empty($data['nombre'])) $data['nombre'] = null;
        $this->db->trans_begin();
        $carga = array(
            'nombre' => $data['nombre'],
            'tipo_infraccion'=>$data['tipo'],
            'id_anexo'=>$data['id'],

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
}
