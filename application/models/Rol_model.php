
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/**
  * Clase correspondiente al modelo 
  * de la tabla <b>Perfil</b>
  * <b>base_menu.perfil
  * @author  : dgarcia
  * @version :1.0
  * @dathe   :16/4/18
  **
  */

class Rol_model extends MY_Model {

    public function __construct() {
        
        //Seteamos los valores 
        //para el base bean
        $this->table='public.roles';
        $this->id='id';

    }

     /**
      * Funcion que permite realizar la insercion 
      * de un registro
      * @param : data es un array de datos 
      *          que contiene datos de infraccion vial
     **/
    public function insert($data) {
        //Section - Acta
        if(empty($data['name'])) $data['name'] = null;
        if(empty($data['description'])) $data['description'] = null;
       
     
        $this->db->trans_begin();
        $carga = array(
            //Section -  Lugar
            
            'name' => $data['name'],
            'description' => $data['description'],
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
        if(empty($data['name'])) $data['description'] = null;
        if(empty($data['description'])) $data['description'] = null;
       

     
        $this->db->trans_begin();
        $carga = array(
            //Section -  Lugar
            
            'name' => $data['name'],
            'description' => $data['description'],
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
      *  perfiles a partir de parametro
      * filters 
      */
    public function buscar($filter = null){
        
        //Se definen los campos 
        $campos="rol.id as id,".
                "rol.name as nombre";                                              
        
        if(empty($data['nombre'])) $data['nombre'] = null;
       
        $this->db->select($campos);
        $this->db->from($this->table.' as rol');

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
      * Funcion que permite obtener el 
      * rol de un usuario a partir de su 
      * id
      * @param : idUsuario
    **/
    public function getRolOfUsuario($idUsuario){
       
       $rol=null;
       $this->session->userdata('user_id');  
       $query = $this->db->select('rol.id,rol.name')
                ->join('usuarios_roles ur', 'ur.id_usuario=u.id')
                ->join('roles rol','ur.id_rol=rol.id')
                ->where('u.id',$idUsuario)
                ->get($this->tables['users'].' as u')->result();
        

        
        /*var_dump($query->num_rows());
          if ($query->num_rows() === 1) {
               $rol = $query->row();
            } 
       */
       return $query;
     }


     public function getTipoInfraccionByRol($idUsuario){
      $tipo_infraccion=null;
       $this->session->userdata('user_id');  
           $query = $this->db->select
                  ('rol.name')
                ->join('usuarios_roles ur', 'ur.id_usuario=u.id')
                ->join('roles rol','ur.id_rol=rol.id')
                ->where('u.id',$idUsuario)
                ->limit(1)
                ->get($this->tables['users'].' as u');
      
      
          if ($query->num_rows() === 1) {
               $rol = $query->row();
            
            } 

        if($rol!=null){
               if($rol->name =="AdminInfracciones"){
                  $tipo_infraccion='V';
               }

               if($rol->name=="AdminContravenciones"){
                  $tipo_infraccion='C';
               }

      
            
            }
 
          return $tipo_infraccion;

     }
    

}
