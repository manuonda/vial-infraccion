<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Marca correspondiente a la tabla
   *  @tabla: contravenciones.incisos 
  **/

class Inciso_model extends MY_Model {

    public function __construct() {
       
        //Seteamos los valores 
        //para el base bean
        $this->table='leyes.incisos';
        $this->id='id_inciso';
    }


    /**
      * 
      * @param : data es un array de datos 
      *          que contiene datos para realizar 
      *          la insercion de datos
     **/
    public function insert($data) {
        
       if(empty($data['nombre'])) $data['nombre'] = null;
       if(empty($data['descripcion'])) $data['descripcion']=null;
       if(empty($data['id_articulo'])) $data['id_articulo']=null;
       if(empty($data['id_ley'])) $data['id_ley']=null;
       if(empty($data['tipo_unidad'])) $data['tipo_unidad'] = null;

        
      
        $this->db->trans_begin();
        $carga = array(
            'nombre' => $data['nombre'],
            'id_articulo'=>$data['id_articulo'],
            'tipo_unidad'=>$data['tipo_unidad'],
            'unidad_fija' => $data['unidad_fija'],

            'descripcion'=>$data['descripcion'],
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
       if(empty($data['descripcion'])) $data['descripcion']=null;
       if(empty($data['id_articulo'])) $data['id_articulo']=null;
       if(empty($data['id_ley']))  $data['id_ley']=null;
       if(empty($data['tipo_unidad'])) $data['tipo_unidad'] = null;
        
      
        $this->db->trans_begin();
    
        $carga = array(
            'nombre' => $data['nombre'],
            'id_articulo'=>$data['id_articulo'],
            'tipo_unidad'=>$data['tipo_unidad'],
            'unidad_fija' => $data['unidad_fija'],
            'descripcion'=>$data['descripcion'],
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
        $campos="inciso.id_inciso as id,".
                "inciso.nombre as nombre,".
                "inciso.descripcion as descripcion,".
                "articulo.nombre as nombreArticulo,". 
                "ley.nombre as nombreLey,".
                "ley.tipo_infraccion as tipoInfraccion,".
                "inciso.unidad_fija as unidad";                                     
        
        if(empty($data['nombre'])) $data['nombre'] = null;
        
        $this->db->join('leyes.articulos as articulo',
                        'articulo.id_articulo  = inciso.id_articulo','left');

        $this->db->join('leyes.leyes as ley',
                        'articulo.id_ley  = ley.id_ley','left');

        $this->db->select($campos);
        $this->db->from($this->table.' as inciso');


        if($filter['idLey']!=null && $filter['idLey']!=""){
          $this->db->where('ley.id_ley',$filter['idLey']);
        } 

        //numero de acta vial 
        if($filter['nombre']!=null && $filter['nombre']!=""){
            $this->db->like('inciso.nombre',$filter['nombre']);
        }
        
        if($filter['idArticulo']!=null && $filter['idArticulo']!=null){
           $this->db->where('inciso.id_articulo',$filter['idArticulo']);
        }

        //tipo infarccion_vial
        $this->db->where('ley.tipo_infraccion','V');

        /*
        if($filter['tipo_infraccion']!=null && $filter['tipo_infraccion']!=""){
          $this->db->group_start();
          $this->db->where('ley.tipo_infraccion',$filter['tipo_infraccion']); 
          $this->db->or_where('ley.tipo_infraccion','VC');
          $this->db->group_end();
        }*/
        
       
        $query = $this->db->get();
        //$dbgquery = $this->db->last_query();
        $result = $query->result();
         return $result;

    } 






 /************************************************************************/
 /***** Funciones establecidas   ********************/

  
  /**
    *    Funcion que permite obtener 
    *    los incisos
    *    @param : id_articulo
    **/
    public function getByArticulo($id_articulo){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_articulo',$id_articulo);
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
        $this->db->trans_begin();
        $carga = array(
            'nombre' => $data['nombre'],
            'id_articulo'=>$data['id'],
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
