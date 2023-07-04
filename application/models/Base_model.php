<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   *  Clase Base Modelo con algunas
   * funcionalidades incorporadas
   **/

class Base_Model extends CI_Model {
   
     //Propiedades
	//Corresponde a la tabla
     private $table;
     //Corresponde al identificador de la tabla
     private $id;  
   

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



    /**
     * Funcion que permite obtener 
     * obtener un registro especifico 
     * @param: id
     * return @row
     */  
    function get($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($this->id, $id);
        $query = $this->db->get();
        return $query->row();
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