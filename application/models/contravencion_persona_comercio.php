<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/**
  * Clase correspondiente al modelo 
  * de la tabla <b>Seccion</b>
  * <b>
  * @author  : dgarcia
  * @version :1.0
  * @dathe   :16/4/18
  **
  */

class Contravencionpersonacomercio_model extends MY_Model {

    public function __construct() {
        
        //Seteamos los valores 
        //para el base bean
        $this->table='contravenciones.contravencion_persona_comercio';
        $this->id='id_contravencion_persona_comercio';

    }

     /**
      * Funcion que permite realizar la insercion 
      * de un registro
      * @param : data es un array de datos 
      *          que contiene datos para realizar 
      *          la insercion de datos
     **/
    public function insert($data) {
        //Section - Acta
        if(empty($data['nombre'])) $data['nombre'] = null;
        if(empty($data['description'])) $data['description'] = null;
        if(empty($data['url'])) $data['url'] = null;
        if(empty($data['icono'])) $data['icono'] =null;
        if(empty($data['id_grupo_seccion'])) $data['id_grupo_seccion'] = null;
     

        $this->db->trans_begin();
        $carga = array(
            //Section -  Lugar
            
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'icono' =>$data['icono'],
            'url'=>$data['url'],
            'id_grupo_seccion'=>$data['id_grupo_seccion'],
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
        if(empty($data['url'])) $data['url'] =null;
        if(empty($data['id_grupo_seccion'])) $data['id_grupo_seccion']=null;
        

     
        $this->db->trans_begin();
        $carga = array(
            //Section -  Lugar
            
            
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'icono' =>$data['icono'],
            'url'=>$data['url'],
            'id_grupo_seccion'=>$data['id_grupo_seccion'],
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
      *  perfiles a partir de parametro
      * filters 
      */
    public function buscar($filter = null){
        
        //Se definen los campos 
        $campos="seccion.id_seccion as id,".
                "seccion.nombre as nombre,".
                "grupo.nombre as nombreGrupo";                                              
        
        if(empty($data['nombre'])) $data['nombre'] = null;
       

         $this->db->join('public.grupo_secciones as grupo',
                        'seccion.id_grupo_seccion  = grupo.id_grupo_seccion','left');

        $this->db->select($campos);
        $this->db->from($this->table.' as seccion');

        //numero de acta vial 
        if($filter['nombre']!=null && $filter['nombre']!=""){
            $this->db->like('name',$filter['nombre']);
        }
        
        $query = $this->db->get();

        $dbgquery = $this->db->last_query();

        //($dbgquery);
      
        $result = $query->result();
         return $result;

    }


    
    /**
      * Funcion que permite obtener las secciones 
      * juntos con los grupos, url , icono y secciones
      *
    **/
    public function get_secciones($id_grupo_seccion){

         $this->db->select('s.nombre,s.url');
         $this->db->from('secciones s');
         $this->db->where('s.id_grupo_seccion',$id_grupo_seccion);
         $this->db->order_by('s.nombre',$id_grupo_seccion);

         return $this->db->get()->result(); 
         //return $dbgquery;
     }

}
