<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Comercio_model correspondiente a la tabla
   *  @tabla: contravenciones.comercios 
  **/

class Comercio_model extends MY_Model {

    public function __construct() {
       
        //Seteamos los valores 
        //para el base bean
        $this->table='contravenciones.comercios';
        $this->id='id_comercio';
    }


    

     /**
       * Funcion que permite agregar los comercios
       * 
       */
     public function agregarComercios($comercios,$idContravencion){
  
      if(!empty($comercios) && !empty($idContravencion)){
       
        //Borramos los comercios
        $this->deleteComercios($idContravencion);
        foreach($comercios as  $comercio){
          $valores=explode('-',$comercio);
          $data['id_comercio']=$valores[0];   //id: id_comercio 
          $data['denominacion']=$valores[1];      //denominacion
          $data['cuit_comercio']=$valores[2];          //id_articulo 
          $data['categoria']=$valores[3];     //id_inciso
          $data['rubro']=$valores[4];         //rubro
          $data['ubicacion']=$valores[5] ;    //ubicacion
  

          $data['id_contravencion']=$idContravencion; //id_contravencion

          //Guardamos los comercios
          $this->guardar($data);
        }
     }
    }



    /**
     * Funcion que permite eliminar los comercios 
     * asociados a la contravencion
    **/
    public function deleteComercios($idContravencion){
       $comercios =$this->getListById($idContravencion);
    
       foreach ($comercios as $comercio) {
         $this->delete($comercio->id);

       }

    }
 


    /** Funcion que permiter guardar un
      * modelo
      * @param  : json 
      * return  : id o null
      **/
    public function guardar($data){

       if(empty($data['denominacion']))  $data['denominacion']=null;
       if(empty($data['cuit_comercio']))$data['cuit_comercio']=null;
       if(empty($data['categoria'])) $data['categoria']=null;
       if(empty($data['rubro']))  $data['rubro']=null;
       if(empty($data['ubicacion'])) $data['ubicacion']=null;
        

      $this->db->trans_begin();
        $carga = array(
            'id_contravencion'=>$data['id_contravencion'],
            'denominacion' => $data['denominacion'],
            'cuit_comercio'=>$data['cuit_comercio'],
            'categoria'=>$data['categoria'],
            'rubro' =>$data['rubro'],
            'ubicacion'=>$data['ubicacion'],
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



   /**   Funcion que permite obteners 
    *    los comercios por la contravencion
    *    @param:idContravencion
    *    @return : un listado de leyes articulos incisos
    **/
    public function getListById($idContravencion){
          //Se definen los campos de la consulta 
        $campos="comercio.id_comercio as id,".
                "comercio.denominacion,".
                "comercio.cuit_comercio as cuitComercio,".
                "comercio.categoria,".
                "comercio.rubro,".
                "comercio.ubicacion,".
                "comercio.id_contravencion as idContravencion";
     
        $this->db->select($campos);
        $this->db->from($this->table.' as comercio');
        $this->db->where('comercio.id_contravencion', $idContravencion);
        
        $query = $this->db->get();
        $result = $query->result();
      
        return $result;
    }
}
