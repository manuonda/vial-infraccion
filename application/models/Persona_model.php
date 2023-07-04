 <?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Persona correspondiente a la tabla
   *  @tabla: 
  **/

class Persona_model extends MY_Model {



    public function __construct() {
        //Seteamos los valores 
        //para el base bean
        $this->table='public.personas';
        $this->table_domicilio='';
        $this->id='public.personas.cuil';
        
    }


    /*
     *Funcion que permite obtener informacion 
     * retornando direccion, datos personales
     * @param : $cuit/dni
     * @return : array de datos
     * @tablas : personas, persona_domicilios, domicilios 
     */
    public function getInformacion($cuilDni){
      
        //Se definen los campos de la consulta de persona
        $campos=$this->table.".nombre as nombre,".
                $this->table.".apellido as apellido,".
                $this->table.".dni as dni,".
                $this->table.".cuil as cuil,".
                $this->table.".fecha_nacimiento as fechaNacimiento,".
                $this->table.".sexo as sexo,".
                $this->table.".nacionalidad,".

                //Other tablas
                "public.tipo_documentos.tipo_documento as tipoDocumento"; 


        $this->db->select($campos);
        $this->db->from($this->table);
        
        if(strlen($cuilDni) > 0){
            $this->db->where('dni',$cuilDni);
        }   

       

        //Tipo documento
        $this->db->join('public.tipo_documentos','public.personas.id_tipo_documento = public.tipo_documentos.id_tipo_documento', 'left');
        $query = $this->db->get();
        $data = array();
        $personaInformacion=$query->row();
       
        return $personaInformacion;
    }


    /**
      * Funcion que permite obtener el/los domicilios 
      * del usuario 
      * @param : $cuil
      * @return : array
      **/
    public function get_domicilios($cuil){

        //Obtenemos informacion de los domicilios
        $this->db->select('public.domicilios.id_domicilio,public.calles.calle,public.domicilios.numero,public.barrios.barrio,public.persona_domicilios.actual');
        $this->db->from($this->table);
        $this->db->where($this->id, $cuil);
        $this->db->join('public.persona_domicilios', 'public.personas.cuil = public.persona_domicilios.cuil', 'left');
        $this->db->join('public.domicilios', 'public.persona_domicilios.id_domicilio = public.domicilios.id_domicilio', 'left');
        $this->db->join('public.calles','public.domicilios.id_calle=public.calles.id_calle');
        $this->db->join('public.barrios','public.calles.id_barrio=public.barrios.id_barrio');


        $queryDomicilios=$this->db->get();
        $dataDomicilios=array();

         if($queryDomicilios->result()){
          //Cargo los domicilios correspondientes al usuario
          foreach ($queryDomicilios->result() as $row) {
            $dataDomicilios[] = $row;           
          }  
         }else{
           $dataDomicilios=null;
         }
        
        //retornamos el array de domicilios
        return $dataDomicilios;
    }
    


    /** Funcion que permite obtener los roles 
     * a partir del usuario logueado en el sistema 
     */
    public function getRolesByIdUser($id_user){
        //Obtenemos informacion de los domicilios
        $this->db->select('roles.*');
        $this->db->from('public.usuarios as usuarios');
        $this->db->where('usuarios.id', $id_user);
        $this->db->join('base_menu.usuarios_roles as usuarioroles', 'usuarios.id = usuarioroles.id_usuario', 'left');
        $this->db->join('base_menu.roles as roles', 'usuarioroles.id_rol = roles.id_rol', 'left');


        $roles=$this->db->get();

        return $roles->result();
    }



    /**
     * Funcion que permite buscarPersonaFilter
     * 
    **/ 
    public function buscarPersonaFilter($filter){

      
       $sql="";
       if($filter['type']=='dni'){
          $sql="SELECT persona.nombre as nombre, persona.apellido as apellido ,".
            " persona.dni as dni, persona.cuil as cuil , persona.fecha_nacimiento as fechaNacimiento ,".
            " persona.sexo as sexo , persona.nacionalidad, public.tipo_documentos.tipo_documento  as tipoDocumento ,".
            " public.calles.calle,public.domicilios.numero,public.barrios.barrio,public.persona_domicilios.actual ". 
            " FROM  public.personas as persona ".
            " LEFT JOIN public.tipo_documentos ON persona.id_tipo_documento = public.tipo_documentos.id_tipo_documento " .
            " LEFT JOIN public.persona_domicilios ON persona.cuil = public.persona_domicilios.cuil ".
            " LEFT JOIN public.domicilios ON public.persona_domicilios.id_domicilio = public.domicilios.id_domicilio ".
            " LEFT JOIN public.calles ON public.domicilios.id_calle=public.calles.id_calle ".
            " LEFT JOIN public.barrios ON public.calles.id_barrio=public.barrios.id_barrio ".
            " WHERE dni::TEXT LIKE '".$filter['dni']."%' ESCAPE '!' ";
       }else{ 
         $sql= "SELECT persona.nombre as nombre, persona.apellido as apellido ,".
            " persona.dni as dni, persona.cuil as cuil , persona.fecha_nacimiento as fechaNacimiento ,".
            " persona.sexo as sexo , persona.nacionalidad, public.tipo_documentos.tipo_documento  as tipoDocumento ,".
            " public.calles.calle,public.domicilios.numero,public.barrios.barrio,public.persona_domicilios.actual ". 
            " FROM  public.personas as persona ".
            " LEFT JOIN public.tipo_documentos ON persona.id_tipo_documento = public.tipo_documentos.id_tipo_documento " .
            " LEFT JOIN public.persona_domicilios ON persona.cuil = public.persona_domicilios.cuil ".
            " LEFT JOIN public.domicilios ON public.persona_domicilios.id_domicilio = public.domicilios.id_domicilio ".
            " LEFT JOIN public.calles ON public.domicilios.id_calle=public.calles.id_calle ".
            " LEFT JOIN public.barrios ON public.calles.id_barrio=public.barrios.id_barrio ". 
            " WHERE persona.nombre ILIKE '%".$filter['nombre']."%' ESCAPE '!'" . 
            " AND persona.apellido ILIKE '%".$filter['apellido']."%' ESCAPE '!'";

         }


        $query = $this->db->query($sql);
       /// ($this->db->last_query());
        $result = $query->result();
        return $result;
     }

   


}
