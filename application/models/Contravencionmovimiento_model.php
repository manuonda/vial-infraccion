<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * <b>Clase Correspondiente a Contravencion Movimiento model 
 * </b>
 * A movimiento de Contravenciones para establecer el movimiento donde
 * se encuentra el expediente
 */
class Contravencionmovimiento_model extends MY_Model {

    public function __construct() {
        $this->table='contravenciones.contravencion_movimiento';
        $this->id='id_contravencion_movimiento';
   
     } 

}

?>