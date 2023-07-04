
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/**
  * Clase correspondiente al modelo 
  * de la tabla <b>Permiso_model</b>
  * <b>base_menu.perfil
  * @author  : dgarcia
  * @version :1.0
  * @dathe   :23/4/18
  **
  */

class Rol_model extends MY_Model {

    public function __construct() {
        
        //Seteamos los valores 
        //para el base bean
        $this->table='public.permisos';
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
        if(empty($data['id_permiso'])) $data['id_permiso'] = null;
        if(empty($data['id_rol'])) $data['id_rol'] = null;
       
     
        $this->db->trans_begin();
        $carga = array(
            //permiso - rol
            'id_rol' => $data['id_rol'],
            'id_permiso' => $data['id_permiso'],
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
        if(empty($data['id_permiso'])) $data['id_permiso'] = null;
        if(empty($data['id_rol'])) $data['id_rol'] = null;
       

     
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





}
