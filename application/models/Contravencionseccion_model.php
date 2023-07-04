<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * <b>Clase Correspondiente a Contravencion Seccion model 
 * </b>
 * A Secciones de contravencionales, de la entrada 
 * del expediente
 */
class Contravencionseccion_model extends MY_Model {

    public function __construct() {
        $this->table='contravenciones.contravencion_seccion';
        $this->id='id_contravencion_seccion';
   
     } 

}

?>