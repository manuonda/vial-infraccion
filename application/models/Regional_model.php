<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *<b>Clase correspondiente a la tabla 
 * Regional</b>
 */
class Regional_model extends MY_Model {

    public function __construct() {
        $this->table='personal.regionales';
        $this->id='id_regional';
    }


}

?>