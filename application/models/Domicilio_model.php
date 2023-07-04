<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Contravencion correspondiente a la tabla
   *  @tabla: public.domicilio 
  **/

class Domicilio_model extends MY_Model {

    public function __construct() {
       
         parent::__construct();
        //Seteamos los valores 
        //para el base bean
        $this->table='public.domicilios';
        $this->id='id_domicilio';
    }


   

    /**
      * Funcion que permite realizar la insercion 
      * de un registro
      * @param : data es un array de datos 
      *          que contiene datos de infraccion vial
     **/
    public function insert($data) {
        
        if(empty($data['id_manzana']))    $data['id_manzana']=null;
        if(empty($data['manzana']))       $data['manzana']=null;
        if(empty($data['sector']))        $data['sector'] =null;
        if(empty($data['departamento']))  $data['departamento']=null;
        if(empty($data['monoblock']))     $data['monoblock']  = null;
        if(empty($data['descripcion']))   $data['descripcion'] = null;
        if(empty($data['lote']))          $data['lote'] = null;
        if(empty($data['numero']))        $data['numero'] = null;
        if(empty($data['piso']))          $data['piso'] = null;
        if(empty($data['calle']))         $data['calle'] = null; 
        if(empty($data['tipoDomicilio'])) $data['tipoDomicilio']=null;
        $this->db->trans_begin();
        $carga = array(
            'manzana' => $data['manzana'],
            'sector' => $data['sector'],
            'departamento' =>$data['departamento'],
            'monoblock' =>$data['monoblock'],
            'descripcion' => $data['descripcion'],
            'lote' => $data['lote'],
            'numero' => $data['numero'],
            'piso' =>$data['piso'],
            'id_calle'=>$data['calle'],
            'id_tipo_domicilio'=>$data['tipoDomicilio'],

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

    /** Funcion que permite realizar 
      * la actualizacion de registros 
      * @param : array de datos
      **/
    public function update($data) {
    
        if(empty($data['id_manzana']))    $data['id_manzana']=null;
        if(empty($data['manzana']))       $data['manzana']=null;
        if(empty($data['sector']))        $data['sector'] =null;
        if(empty($data['departamento']))  $data['departamento']=null;
        if(empty($data['monoblock']))     $data['monoblock']  = null;
        if(empty($data['descripcion']))   $data['descripcion'] = null;
        if(empty($data['lote']))          $data['lote'] = null;
        if(empty($data['numero']))        $data['numero'] = null;
        if(empty($data['piso']))          $data['piso'] = null;
        if(empty($data['calle']))         $data['calle'] = null; 
        if(empty($data['tipoDomicilio'])) $data['tipoDomicilio']=null;
        if(empty($data['descripcion']))   $data['descripcion'] = null;


        $this->db->trans_begin();
        $carga = array(
            'manzana' => $data['manzana'],
            'sector' => $data['sector'],
            'departamento' =>$data['departamento'],
            'monoblock' =>$data['monoblock'],
            'descripcion' => $data['descripcion'],
            'lote' => $data['lote'],
            'numero' => $data['numero'],
            'piso' =>$data['piso'],
            'id_calle'=>$data['calle'],
            'id_tipo_domicilio'=>$data['tipoDomicilio'],

            'usuario_alta' => $this->session->userdata('user_id'),
            'fecha_alta' => date('Y-m-d H:i:s')
        );

        $this->db->where('id_domicilio', $data['id_domicilio']);
        $this->db->update($this->table, $carga);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
          
            return -1;
        }else {
            $this->db->trans_commit();
            return $data['id_domicilio'];
        }
    }

    

 }
