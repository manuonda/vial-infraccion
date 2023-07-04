<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Marca correspondiente a la tabla
   *  @tabla: contravenciones.t_marca 
  **/

class Articulo_model extends MY_Model {

    public function __construct() {
       
        //Seteamos los valores 
        //para el base bean
        $this->table='leyes.articulos';
        $this->id='id_articulo';
    }


  
 /**
    *    Funcion que permite obtener 
    *    los articulos por ley
    *    @param : id_ley
    **/
    public function getByLey($id_ley){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_ley',$id_ley);
        $this->db->order_by("fecha_alta");
         return $this->db->get()->result();
    }


    /** Funcion que permiter guardar un
      * modelo
      * @param  : json 
      * return  : id o null
      **/
    public function guardar($data){

       if(empty($data['nombre'])) $data['nombre'] = null;
       if(empty($data['unidad_minima'])) $data['unidad_minima']=null;
       if(empty($data['unidad_maxima'])) $data['unidad_maxima']=null;
       if(empty($data['id_ley'])) $data['ley']=NULL;
       if(empty($data['descripcion'])) $data['descripcion'] =NULL;  
       if(empty($data['tipo_unidad'])) $data['tipo_unidad']=null;


        $this->db->trans_begin();
        $carga = array(
            'nombre' => $data['nombre'],
            'id_ley'=>$data['ley'],
            'tipo_unidad'=>$data['tipo_unidad'],
            'unidad_fija' => $data['unidad_fija'],
            'descripcion' => $data['descripcion'],
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


    /**
      * 
      * @param : data es un array de datos 
      *          que contiene datos para realizar 
      *          la insercion de datos
     **/
    public function insert($data) {
        
       if(empty($data['nombre'])) $data['nombre'] = null;
       if(empty($data['ley'])) $data['ley']=NULL;
       if(empty($data['unidad_fija'])) $data['unidad_fija'] = null;
       if(empty($data['tipo_unidad'])) $data['tipo_unidad']=null;
       if(empty($data['descripcion'])) $data['descripcion']=NULL; 
       if(empty($data['tipo_unidad'])) $data['tipo_unidad'] = null;
        
      
        $this->db->trans_begin();
        $carga = array(
            'nombre' => $data['nombre'],
            'id_ley'=>$data['ley'],
            'tipo_unidad'=>$data['tipo_unidad'],
            'unidad_fija' => $data['unidad_fija'],

            'unidad_maxima'=>$data['unidad_maxima'],
            'descripcion' =>$data['descripcion'],
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
     
       if(empty($data['nombre'])) $data['nombre'] = null;
        if(empty($data['ley'])) $data['ley']=NULL;
       if(empty($data['descripcion'])) $data['descripcion']=NULL;
        
      
         $this->db->trans_begin();
        $carga = array(
            'nombre' => $data['nombre'],
            'id_ley'=>$data['ley'],
           'tipo_unidad'=>$data['tipo_unidad'],
            'unidad_fija' => $data['unidad_fija'],
            'descripcion'  =>$data['descripcion'],
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




     /** Funcion que permite obtener el listado de 
      * contravenciones a partir de una serie de 
      * filters 
      */
    public function buscar($filter = null){
       if(empty($data['tipo_infraccion'])) $data['tipo_infraccion'] = null;

        
        //Se definen los campos de la consulta de persona
        $campos="articulo.id_articulo as id,".
                "articulo.nombre as nombre,".
                "articulo.descripcion as descripcion,".
                "ley.id_ley as idLey,".
                "ley.nombre as ley,".
                "ley.tipo_infraccion as tipoInfraccion,".
                "articulo.unidad_fija  as unidad";
                                                      
        
        if(empty($data['nombre'])) $data['nombre'] = null;
        
        $this->db->join('leyes.leyes as  ley',
                        'ley.id_ley  = articulo.id_ley','left');

        $this->db->select($campos);
        $this->db->from($this->table.' as articulo');

        //numero de acta vial 
        if($filter['nombre']!=null && $filter['nombre']!=""){
            $this->db->like('articulo.nombre',$filter['nombre']);
        }
        
        if($filter['idLey']!=null && $filter['idLey']!=""){
           $this->db->where('articulo.id_ley',$filter['idLey']);
        }
        
        //tipo de infracciones viales
        $this->db->where('ley.tipo_infraccion','V');

        /*
        if($filter['tipo_infraccion']!=null && $filter['tipo_infraccion']!=""){
          $this->db->group_start();
          $this->db->where('ley.tipo_infraccion',$filter['tipo_infraccion']); 
          $this->db->or_where('ley.tipo_infraccion','VC');
          $this->db->group_end();
        }*/

        
        $query = $this->db->get();

        $dbgquery = $this->db->last_query();

        //($dbgquery);
      
        $result = $query->result();
         return $result;

    }

}
