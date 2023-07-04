<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   *  Clase Base Modelo con algunas
   * funcionalidades incorporadas
   **/

class MY_Model extends CI_Model {
   
     //Propiedades
	//Corresponde a la tabla
     protected $table;
     //Corresponde al identificador de la tabla
     protected $id;  
   

    public function __construct(){
        
        parent::__construct();
        $this->load->database();
    }




    /** Funciones bases  **/

    /** Retorna todos los elementos 
      * de la table
      * @return listado
      **/
    public function get_all(){ 
      $this->db->select('*');
      $this->db->from($this->table);
      $this->db->order_by("fecha_alta");
      return $this->db->get()->result();
    } 

   
    /** Retorna un elemento 
      * de la tabla 
      * @param : id 
      */ 
    public function getById($id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($this->id,$id);
        $query = $this->db->get();
        return $query->row();
    }


     /**
     * Funcion que permite poder eliminar 
     * un registro
     */
    function delete($id){
     $this->db->trans_begin();
     $this->db->delete($this->table, array($this->id => $id));
     if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
      }
      $this->db->trans_commit();
      return TRUE;
    }



   
   

    
    /*************************************/
     /****  Getter and Setters **/
     public function getTable(){
     	return $this->table;
     }

     public function getId(){
     	return $this->id;
     }

     public function setTable($table){
     	$this->table=$table;
     }


     public function setId($id){
     	$this->id=$id;
     }

      

   }

?>