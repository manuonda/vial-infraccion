 <?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Persona correspondiente a la tabla
   *  @tabla: persona_temporal
  **/

class Personatemporal_model extends MY_Model {



    public function __construct() {
        //Seteamos los valores 
        //para el base bean
        $this->table='infracciones.persona_temporal';
        $this->id='id';
        
    }

    public function getPersona($idInfraccion,  $tipoPersona){
        $columns = "id as id, nombre as nombre , apellido as apellido, dni as dni,fecha_nacimiento as fechaNacimiento,".
                   "sexo as sexo,nacionalidad as nacionalidad, tipo_identificacion as tipoDocumento";
        $this->db->select($columns);
        $this->db->from($this->table);
        $this->db->where('tipo_persona', $tipoPersona);
        $this->db->where('id_infraccion', $idInfraccion);   
        $query = $this->db->get();
        $persona=$query->row();
        return $persona;
    }




     /**
      * Funcion que permite realizar la insercion 
      * de un registro
      * @param : data es un array de datos 
      *          que contiene datos de infraccion vial
     **/
    public function guardarPropietario($data) {
       
        $this->db->trans_begin();
        $carga = array(
            'nombre'              => $data['nombrePropietario'],
            'apellido'            => $data['apellidoPropietario'],
            'tipo_identificacion' => $data['tipoDocumentoPropietario'],
            'dni'                 => $data['numeroDocumentoPropietario'], 
            'fecha_nacimiento'    => $data['fechaNacimientoPropietario'],
            'nacionalidad'        => $data['nacionalidadPropietario'],
            'sexo'                => $data['sexoPropietario'], 
            'id_infraccion'       => $data['id_infraccion'],
            'tipo_persona'        => 'propietario',
            'usuario_alta'        => $this->session->userdata('user_id'),
            'fecha_alta'          => date('Y-m-d H:i:s')
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



    public function guardarInvolucrado($data) {
       
        $this->db->trans_begin();
        $carga = array(
            'nombre'              => $data['nombreInvolucrado'],
            'apellido'            => $data['apellidoInvolucrado'],
            'tipo_identificacion' => $data['tipoDocumentoInvolucrado'],
            'dni'                 => $data['numeroDocumentoInvolucrado'], 
            'fecha_nacimiento'    => $data['fechaNacimientoInvolucrado'],
            'nacionalidad'        => $data['nacionalidadInvolucrado'],
            'sexo'                => $data['sexoInvolucrado'], 
            'id_infraccion'       => $data['id_infraccion'],
            'tipo_persona'        => 'involucrado',
            'usuario_alta'        => $this->session->userdata('user_id'),
            'fecha_alta'          => date('Y-m-d H:i:s')
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
    public function updatePropietario($data) {
       
        $this->db->trans_begin();
        $carga = array(
            'nombre'              => $data['nombrePropietario'],
            'apellido'            => $data['apellidoPropietario'],
            'tipo_identificacion' => $data['tipoDocumentoPropietario'],
            'dni'                 => $data['numeroDocumentoPropietario'], 
            'fecha_nacimiento'    => $data['fechaNacimientoPropietario'],
            'nacionalidad'        => $data['nacionalidadPropietario'],
            'sexo'                => $data['sexoPropietario'], 
            'usuario_modificacion' => $this->session->userdata('user_id'),
            'fecha_modificacion' => date('Y-m-d H:i:s')
        );

        

        $this->db->where('id_infraccion', $data['id_infraccion']);
        $this->db->where('id' , $data['idPropietario']);
        $this->db->where('tipo_persona' , 'propietario');
        $this->db->update($this->table, $carga);

        // var_dump($this->db->last_query()); 
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
          
            return -1;
        }else {
            $this->db->trans_commit();
            return $data['id'];
        }
    }


    /** Funcion que permite realizar 
      * la actualizacion de registros 
      * @param : array de datos
      **/
    public function updateInvolucrado($data) {
       
        $this->db->trans_begin();
        $carga = array(
            'nombre'              => $data['nombreInvolucrado'],
            'apellido'            => $data['apellidoInvolucrado'],
            'tipo_identificacion' => $data['tipoDocumentoInvolucrado'],
            'dni'                 => $data['numeroDocumentoInvolucrado'], 
            'fecha_nacimiento'    => $data['fechaNacimientoInvolucrado'],
            'nacionalidad'        => $data['nacionalidadInvolucrado'],
            'sexo'                => $data['sexoInvolucrado'], 
            'usuario_modificacion' => $this->session->userdata('user_id'),
            'fecha_modificacion' => date('Y-m-d H:i:s')
        );

        

        $this->db->where('id_infraccion', $data['id_infraccion']);
        $this->db->where('id'           , $data['idInvolucrado']);
        $this->db->where('tipo_persona' , 'involucrado');
        $this->db->update($this->table, $carga);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
          
            return -1;
        }else {
            $this->db->trans_commit();
            return $data['id'];
        }
    }


}
