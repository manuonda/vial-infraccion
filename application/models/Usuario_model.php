 <?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Persona correspondiente a la tabla
   *  @tabla: 
  **/

class Usuario_model extends MY_Model {



    public function __construct() {
        //Seteamos los valores 
        //para el base bean
        $this->table='public.usuarios';
        $this->id='id';
        
    }
}
