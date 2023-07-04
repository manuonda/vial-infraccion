<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   *  Clase Funcion 
   *  @tabla: base_menu.
  **/

class FuncionesRoles_model extends MY_Model {

    public function __construct() {
        
        //Seteamos los valores 
        //para el base bean
        $this->table='base_menu.funciones_roles';
        $this->id='id_funcion_rol';

    }

     /**
      * Funcion que permite realizar la insercion 
      * de un registro
      * @param : data es un array de datos 
      *          que contiene datos de infraccion vial
     **/
    public function insert($data) {
        //Section - Acta
        if(empty($data['nombre'])) $data['fecha_ingreso'] = null;
        if(empty($data['descripcion'])) $data['numero_acta'] = null;
       
     
        $this->db->trans_begin();
        $carga = array(
            //Section -  Lugar
            
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
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
       

     
        $this->db->trans_begin();
        $carga = array(
            //Section -  Lugar
            
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
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
      * Funcion que permite obtener un listado de 
      * funciones por el id_user
     **/
    public function getFuncionesByIdRol($id_rol){

       //Se definen los campos de la consulta de persona
        $campos="funciones.id_funcion as id,".
                "funciones.nombre as nombre,".
                "funciones.url as url";
      
       
        $this->db->select('roles.*');
        $this->db->from($this->table.' as funciones');
        $this->db->where('menu_base.roles_funciones.id_rol', $id_rol);
        $this->db->join('menu_base.roles_funciones as rolesfunciones', 'rolesfunciones.id_funcion = funciones.id_funcion', 'left');
        
        
       
        $query = $this->db->get();
        $result = $query->result();
        return $result;


    }

}
