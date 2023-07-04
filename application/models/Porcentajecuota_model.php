 <?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase Persona correspondiente a la tabla
   *  @tabla: 
  **/

class Porcentajecuota_model extends MY_Model {



    public function __construct() {
        //Seteamos los valores 
        //para el base bean
        $this->table='infracciones.porcentaje_cuotas';
        $this->id='id';
        
    }


    /*
     *Funcion que permite obtener informacion 
     * retornando direccion, datos personales
     * @param : $cuit/dni
     * @return : array de datos
     * @tablas : personas, persona_domicilios, domicilios 
     */
    public function getPorcentaje($cuota){
        $this->db->select('*');
        $this->db->from($this->table.' as infraccion');
        $this->db->where('cuota_desde <=',$cuota);
        $this->db->where('cuota_hasta >=',$cuota);
        $query = $this->db->get();
        $porcentajecuota=$query->row();
       
        return $porcentajecuota;
    }


}
