
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/**
  * Clase correspondiente al modelo 
  * de la tabla <b>Grupo Seccion</b>
  * <b>
  * @author  : dgarcia
  * @version :1.0
  * @dathe   :16/4/18
  **
  */

class Gruposeccion_model extends MY_Model {

    public function __construct() {
        
        //Seteamos los valores 
        //para el base bean
        $this->table='public.grupo_secciones';
        $this->id='id_grupo_seccion';

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
        if(empty($data['description'])) $data['description'] = null;
        if(empty($data['orden'])) $data['url'] = null;
      
        $this->db->trans_begin();
        $carga = array(
            //Section -  Lugar
            
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'orden'=>$data['orden'],
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
        if(empty($data['orden'])) $data['url'] =null;
      
     
        $this->db->trans_begin();
        $carga = array(
            //Section -  Lugar
            
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'orden' =>$data['orden'],
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
        
        //Se definen los campos 
        $campos="gruposeccion.id_grupo_seccion as id,".
                "gruposeccion.nombre as nombre";                                              
        
        if(empty($data['nombre'])) $data['nombre'] = null;
       
        $this->db->select($campos);
        $this->db->from($this->table.' as gruposeccion');

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
    public function get_grupos($id_usuario){
  
         $this->db->select('gs.id_grupo_seccion as id_grupo_seccion,gs.nombre AS nombre');
         $this->db->from('usuarios'. ' u'); //usuarios
         $this->db->join('usuarios_roles ur', 'ur.id_usuario = u.id'); //usuarios_roles  as ur where usuariorol.id_usuario= usuario.id
         $this->db->join('roles  r', 'ur.id_rol = r.id'); //roles where  usuarioroles.id_rol==roles.id
         $this->db->join('permisos p', 'r.id = p.id_rol');
         $this->db->join('secciones s', 's.id_seccion = p.id_seccion');
         $this->db->join('grupo_secciones gs', 'gs.id_grupo_seccion = s.id_grupo_seccion');
         $this->db->join('grupos g', 'g.id_grupo = gs.id_grupo', 'left');
         $this->db->where('u.id', $id_usuario);
         //$this->db->where('r.id',49);
         //$this->db->or_where('r.id',50);
         $this->db->where_in('gs.id_grupo_seccion', array(87, 88)); //en servidor de produccion
         $this->db->order_by('gs.orden');
         $this->db->group_by('gs.id_grupo_seccion,gs.nombre,gs.orden');
         ($this->db->last_query());
         return $this->db->get()->result(); 
     }


}
