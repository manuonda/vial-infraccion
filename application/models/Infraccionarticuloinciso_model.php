<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Contravencion correspondiente a la tabla
   *  @tabla: contravenciones.t_contravencion 
  **/

class Infraccionarticuloinciso_model extends MY_Model {

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
    public function agregarLeyesInfraccion($leyes,$idInfraccion){
  
      if(!empty($leyes) && !empty($idInfraccion)){
        foreach($leyes as  $value){
          $valores=explode('-',$value);
         
          $data['id']=$valores[0];             //id:  id_infraccion_articulo_inciso
          $data['id_ley']=$valores[1];        //id_ley
          $data['id_articulo']=$valores[2];   //id_articulo 
          $data['id_inciso']=$valores[3];     //id_inciso
         
  
          $data['id_infraccion']=$idInfraccion; //id_infraccion
          $this->guardarUpdate($data);
        }
     }
    }

 
    /** Funcion que permite guardar 
      * la contravencion, ley, articulo, inciso
      **/
    public function guardarUpdate($data){  

       if(empty($data['id_infraccion'])) $data['id_infraccion']=null;
       if(empty($data['id_articulo']))   $data['id_articulo']=null;
       if(empty($data['id_inciso']))     $data['id_inciso']=null;
       if(empty($data['unidad']))        $data['unidad']=null;
       if(empty($data['tipo_unidad']))   $data['tipo_unidad']=null; 

       $carga = array(
            //Section -  Expediente
            'id_infraccion' =>$data['id_infraccion'],
            'id_ley' =>$data['id_ley'],
            'id_articulo' => $data['id_articulo'],
            'id_inciso' => $data['id_inciso'],
            'unidad' => $data['unidad'],
            'tipo_unidad'=>$data['tipo_unidad'],

            'usuario_alta' => $this->session->userdata('user_id'),
            'fecha_alta' => date('Y-m-d H:i:s')
          );

          if($data['id']==null || $data['id']==0){
        
              $this->db->insert($this->table, $carga);
              $id = $this->db->insert_id();
              return $id;
          }else{
            
              $this->db->where($this->id, $data['id']);
              $this->db->update($this->table, $carga);
              $id=$data['id'];
          }

          if ($this->db->trans_status() === FALSE) {
              $this->db->trans_rollback();
              return -1;
          }else {
              $this->db->trans_commit();
          }
        $this->db->trans_begin();

        return $id;
  
    }

   

    /**
      * Funcion que permite realizar la insercion 
      * de un registro
      * @param : data es un array de datos 
      *          que contiene los articulos incisos
     **/
    public function insertUpdate($data) {
        //Multiple values 
        foreach ($data['articulos'] as $key => $value) {
         
        $carga = array(
            //Section -  Expediente
            'id_infraccion' => $value->id_infraccion,
            'id_articulo' => $value->id_articulo,
            'id_inciso' => $value->id_inciso,
                    
            'usuario_alta' => $this->session->userdata('user_id'),
            'fecha_alta' => date('Y-m-d H:i:s')
        );
           
          if($value->id_contravencion_articulo_inciso==null){
              $this->db->insert($this->table, $carga);
          }else{
              $this->db->where($this->id, $value->id_contravencion_articulo_inciso);
              $this->db->update($this->table, $carga);
          }

           if ($this->db->trans_status() === FALSE) {
              $this->db->trans_rollback();
              return -1;
            }else {
              $this->db->trans_commit();
             }
        }
        
        $this->db->trans_begin();
        
    }


   
    
      /**
    *    Funcion que permite obtener 
    *    los modelos a partir del identificador
    *    de la marca
    *    @param:idInfraccion
    *    @return : un listado de leyes articulos incisos
    **/
    public function getByIdInfraccion($idInfraccion){
       
   
        //Se definen los campos de la consulta 
        $campos="infraccionLey.id_infraccion_articulo_inciso as id,".
                "ley.id_ley as idLey,".
                "CONCAT(ley.numero,' - ',ley.nombre) as descripcionLey,".
                "ley.numero as numeroLey,".
                "articulo.id_articulo as idArticulo ,".
                "CONCAT(articulo.nombre,' - ',articulo.descripcion) as descripcionArticulo,".
                "articulo.nombre as nombreArticulo, ".  
                "inciso.id_inciso as idInciso,".
                "CONCAT(inciso.nombre,' - ',inciso.descripcion) as descripcionInciso,".
                "infraccionLey.unidad as unidad,".
                "infraccionLey.tipo_unidad as tipoUnidad";
       
     
        $this->db->select($campos);
        $this->db->from($this->table.' as infraccionLey');
        $this->db->where('infraccionLey.id_infraccion', $idInfraccion);
        $this->db->join('leyes.leyes as ley', 'infraccionLey.id_ley = ley.id_ley', 'left');
        $this->db->join('leyes.articulos as articulo', 'infraccionLey.id_articulo = articulo.id_articulo', 'left');
        $this->db->join('leyes.incisos as inciso','infraccionLey.id_inciso=inciso.id_inciso','left');

        
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }



   

  
 }
