<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Contravencion correspondiente a la tabla
   *  @tabla: contravenciones.t_contravencion 
  **/

class Infraccionley_model extends MY_Model {

    public function __construct() {
       
        //Seteamos los valores 
        //para el base bean
        $this->table='infracciones.infracciones_leyes';
        $this->id='id_infraccion_ley';
    }




    /*** 
      * Funcion que permite actualizar/guardar 
      * una la contravencion articulo  inciso
      * el formato es el siguiente : 
      *  id-idInfraccion-idLey-idArticulo-idInciso
      **/
    public function guardarLeyesInfraccion($leyes, $articulos , $incisos , $unidades, $estadosExhimidos, $descripcionExhimidos, $idInfraccion){
       
       // Delete registro de infracciones 
       $leyesObtenidas = $this->getDetalleLeyInfraccion($idInfraccion);
        foreach ($leyesObtenidas as $key => $value) {
            $this->delete($value->id_infraccion_ley);
        }

       $cantLeyes = sizeof($leyes);
       $nuevasLeyes = [];
       $nuevosArticulos = [];
       $nuevosIniciso = [];
       $nuevasUnidades = [];
       $nuevosEstadosExhimidos = [];
       $nuevosDescripcionExhimidos=[];
      

       //Inicializamos los valores y seteamos los indices 
       //var_dump($leyes); 
       if ( $cantLeyes != null && $cantLeyes > 0 ) {
          foreach ($leyes as $key => $value) {
            $nuevasLeyes[] = $value;
          }
       }

       foreach ($articulos as $key => $value) {
         $nuevosArticulos[]= $value;
       }

       foreach ($incisos as $key => $value) {
          $nuevosIniciso[] = $value;
       }
       foreach ($unidades as $key => $value) {
          $nuevasUnidades[] = $value;
       }
       
       foreach ($estadosExhimidos as $key => $value) {
         $nuevosEstadosExhimidos [] = $value;
       }
       foreach ($descripcionExhimidos as $key => $value) {
          $nuevosDescripcionExhimidos [] = $value;
       }

    

       // Tomo como referencia las leyes debido a que indica la cantidad 
       // de registros 
       for ($i=0 ; $i < $cantLeyes  ; $i++ ) { 
           $idLey = $nuevasLeyes[$i];
           $idArticulo = 0;
           $idInciso   = 0;
           $unidad     = 0; 
           $cantArticulos =  sizeof($nuevosArticulos);
           $cantIncisos   =  sizeof($nuevosIniciso);
           $cantUnidades   =  sizeof($nuevasUnidades);
           
           if ( $cantArticulos > 0 && $cantArticulos > $i ) {
               $idArticulo = $nuevosArticulos[$i];
           } 
           if ( $cantIncisos > 0  && $cantIncisos > $i){
               $idInciso  = $nuevosIniciso[$i];  
           }
           if ( $cantUnidades > 0 && $cantUnidades > $i) {
               $unidad = $nuevasUnidades[$i];
           }
           
           $estado_exhimido = $nuevosEstadosExhimidos[$i];
           $texto_exhimido = $nuevosDescripcionExhimidos[$i];

           $data['id_infraccion'] = $idInfraccion;
           $data['id_ley'] = $idLey;
           $data['id_articulo'] = $idArticulo;
           $data['id_inciso'] = $idInciso;
           $data['unidad'] = $unidad;
           $data['estado_exhimido'] = $estado_exhimido;
           $data['texto_exhimido'] = $texto_exhimido; 
           $this->guardarUpdate($data);

       }
    }

 
    /** Funcion que permite guardar 
      * la contravencion, ley, articulo, inciso
      **/
    public function guardarUpdate($data){  

       if(empty($data['id_infraccion'])) $data['id_infraccion']=null;
       if(empty($data['id_ley']))        $data['id_ley']=null;
       if(empty($data['id_articulo']))   $data['id_articulo']=null;
       if(empty($data['id_inciso']))     $data['id_inciso']=null;
       if(empty($data['unidad']))        $data['unidad']=null;
     
       $carga = array(
            //Section -  Expediente
            'id_infraccion' =>$data['id_infraccion'],
            'id_ley' =>$data['id_ley'],
            'id_articulo' => $data['id_articulo'],
            'id_inciso' => $data['id_inciso'],
            'unidad' => $data['unidad'],
            'texto_exhimido' => $data['texto_exhimido'],
            'estado_exhimido' => $data['estado_exhimido'],
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
    *    Funcion que permite obtener 
    *    los modelos a partir del identificador
    *    de la marca
    *    @param:idInfraccion
    *    @return : un listado de leyes articulos incisos
    **/
    public function getByIdInfraccion($idInfraccion ,$idTipoTramite = null){
       
   
        //Se definen los campos de la consulta 
        $campos="infraccionLey.id_infraccion_ley as id,".
                "ley.id_ley as idLey,".
                "ley.nombre as nombre,".
                "ley.nombre as descripcionLey,".
                "ley.id_tipo_tramite as tipoTramite,".
                "articulo.id_articulo as idArticulo ,".
                "articulo.nombre ||' '|| articulo.descripcion as descripcionArticulo,".
                "articulo.nombre as nombreArticulo, ".  
                "inciso.id_inciso as idInciso,".
                "inciso.nombre as nombreInciso,".
                "inciso.nombre ||' '|| inciso.descripcion as descripcionInciso,".
                "infraccionLey.unidad as unidad,".
                "infraccionLey.tipo_unidad as tipoUnidad";
       

        $this->db->join('leyes.leyes as ley', 'infraccionLey.id_ley = ley.id_ley', 'left');
        $this->db->join('leyes.articulos as articulo', 'infraccionLey.id_articulo = articulo.id_articulo', 'left');
        $this->db->join('leyes.incisos as inciso','infraccionLey.id_inciso=inciso.id_inciso','left');
        
     
        $this->db->select($campos);
        $this->db->from($this->table.' as infraccionLey');
        $this->db->where('infraccionLey.id_infraccion', $idInfraccion);
        
        if($idTipoTramite != null ){
          $this->db->where('ley.id_tipo_tramite', $idTipoTramite);
        }


        
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    /** 
      *  Funcion que permite obtener el detalle 
      *  de la ley 
    **/
    public function getDetalleLeyInfraccion($idInfraccion){
        $this->db->select();
        $this->db->from($this->table.' as infraccionLey');
        $this->db->where('id_infraccion', $idInfraccion);
        $query = $this->db->get();
        $result = $query->result();
        return $result; 
    }

  
 }
