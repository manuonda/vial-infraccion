<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase que permite generar el comprobante 
   * de contado
  **/

class Comprobantecontado_model extends CI_Model {

    public function __construct() {
         parent::__construct();
        $this->load->database();
        
        //model
        $this->load->model('expediente_model');
        $this->load->model('calle_model');
        $this->load->model('barrio_model');
        $this->load->model('localidad_model');
        $this->load->model('departamento_model');
        $this->load->model('persona_model');
                
        $this->load->model('tipovehiculo_model');
        $this->load->model('marca_model');
        $this->load->model('modelo_model');
        $this->load->model('contravencionarticuloinciso_model');

        //modal de leyes 
        $this->load->model('ley_model');
        //estado 
        $this->load->model('estado_model');
        $this->load->model('contravencionestado_model');

        $this->load->model('infraccion_model');
        $this->load->model('infraccionpago_model');
        $this->load->model('infraccionpagocuota_model');
        $this->load->model('infraccionarticuloinciso_model');
       
    }

    

   //********************************************************************************
   //PAGO DE CONTADO 
   public function getComprobante($idInfraccionPagoCuota){
      
        $infraccionPagoCuota=$this->infraccionpagocuota_model->getById($idInfraccionPagoCuota);
        $html="";

        //($infraccionPagoCuota);

        //Obtenemos la informacion
        //de la infraccion de pago - para verificar que tipo 
        //de pago es
        $infraccionPago=null;
        $infraccion=null;
        if(isset($infraccionPagoCuota)){
           $infraccionPago=$this->infraccionpago_model->getById($infraccionPagoCuota->id_infraccion_pago);
        }

        //Obtenemos informacion de la infraccion 
        if($infraccionPago!=null){
            $infraccion=$this->infraccion_model->getById($infraccionPago->id_infraccion);
        }



        //Datos del vehiculo 
       $this->data['dominio']=$infraccion->dominio;
       $modelo=$this->modelo_model->getById($infraccion->id_modelo);
       
       $marca=$this->marca_model->getById($modelo->id_marca);
       $tipovehiculo=$this->tipovehiculo_model->getById($marca->id_tipovehiculo);
   
       //Leyes - Detalle de la infraccion 
       $leyes=$this->infraccionarticuloinciso_model->getByIdInfraccion($infraccion->id_infraccion);
       //($infraccion);
       
       //*****************************************************
       //Datos del involucrado
       $involucrado=$this->persona_model->getInformacion($infraccion->cuil_involucrado);
       
      



        $this->data['fecha_actual']=date("Y-m-d");
            
        $data_header = null;
        //$html = $this->get_header($data_header, $this->data);
        $this->data['titulo'] = 'PLAN DE PAGO ESPONTÁNEO';
        $html = $this->get_title($html, $this->data);
 
        //Detalle de la infraccion 
        $html = $this->get_subtitulo($html,'Datos del Infractor') ;
        $html = $this->get_detalle_infractor($html,$involucrado,$infraccion,$tipovehiculo,$marca,$modelo);
        $html = $this->get_subtitulo($html,'Datos de las leyes');
        $html = $this->get_detalle_leyes($html,$leyes);
        $html = $this->get_detalle_pago($html,$infraccion,$infraccionPago,$infraccionPagoCuota);
        $html =$html . "<br></br><br></br><p></p><p></p>";
        $html = $this->get_detalle_firma($html);
        $html = $html . "<br></br><p></p>";
        $html = $html."--------------------------------------------------------------------------------------------------------------------------------------------------";

        //vuelvo a repetir 
        //$html = $this->get_header($data_header, $this->data);
        $this->data['titulo'] = 'PLAN DE PAGO ESPONTÁNEO';
        $html = $this->get_title($html, $this->data);
 
        //Detalle de la infraccion 
        $html = $this->get_subtitulo($html,'Datos del Involucrado') ;
        $html = $this->get_detalle_infractor($html,$involucrado,$infraccion,$tipovehiculo,$marca,$modelo);
        $html = $this->get_subtitulo($html,'Datos de las leyes');
        $html = $this->get_detalle_leyes($html,$leyes);
        $html = $this->get_detalle_pago($html,$infraccion,$infraccionPago,$infraccionPagoCuota);
        $html =$html . "<br></br><br></br><p></p>";
        $html = $this->get_detalle_firma($html);
        
        //($infraccionPago);
        
    
       ob_end_clean();
        $this->load->library('pdf');
        $pdf = new TCPDF();
        $pdf->setPrintHeader(false);
        $pdf->SetPageOrientation("P");
        $pdf->SetTitle('Reporte');
        $pdf->setPrintFooter(true);
        $pdf->setFooterMargin(20);
        $pdf->SetFont('times', '', 11);
        $pdf->AddPage();
        $pdf->writeHTML($html);
        $pdf->Output('cuota.pdf', 'I');

       
   } 




   private function get_subtitulo($html,$par){
      $html=$html."<h3 style='margin: 30px 0;padding-bottom: 5px;border-bottom: 1px solid #e7ecf1;
                   border-bottom-width: 1px;
                   border-bottom-style: solid;
                   border-bottom-color: rgb(231, 236, 241);
                   font-family: 'Open Sans',sans-serif;font-weight: 
                   300;font-size: 24px;'>".$par."</h3>";
      return $html;
   }

    /**
     * Obtenemos el header
    **/
    private function get_header($data, $par) {
        //$parametros = 'FECHA: 10/10/2017';
        //$parametros = $par['titulo'] .'&nbsp;&nbsp;&nbsp;' . $par['fecha_desde'];
        //$parametros = date_format(date_create($par['fecha_actual']), 'd/m/Y');
        //date_format(date_create($par['fecha_desde']), 'd/m/Y H:i');
        $html =  $data . '<br><table border="0" style="border:1px solid #000000;" cellpadding="5">
        <tr>
                    <td width="15%"><img src="assets/img/escudo.png" width="580" height="315" /></td>
                    <td width="70%">
            <div align="center">
                          Policia de Jujuy - Dirección de Tránsito y Seguridad Vial <br/>
                          <b>ACTA DE PAGOS ESPONTÁNEO</b><br/><br/>
                            '. $parametros .'
                        </div>
                    </td>
                    <td width="15%"><img src="assets/img/logo.jpg" width="580" height="315" /></td>
                  </tr>
                </table><br/>';
        return $html;
    }

     //get_title
    private function get_title($data, $par) {

        $parametros = $par['titulo'];
        //$format_date= date_format(date_create($par['fecha_desde']), 'd/m/Y H:i');
        $html =  $data . '                            
                          <h4 align="center"><u>'. strtoupper($parametros) .'</u></h4>
                        <br/>';
        return $html;
    }  


    private function get_detalle_infractor2($data,$involucrado){
      $html= $data  .'<br><table border="0" style="border:1px solid #000000;" cellpadding="5">
                    <tr>
                    <td width="35%">  
                    <label style="margin-top: 1px;font-weight: 400;"><strong>Nombre y Apellido</strong></label>
                    <div style="background-color: #eef1f5;opacity: 1;">'.$involucrado->nombre.','.$involucrado->apellido.'</div>
                    </td>
                    <td width="20%">
                    <label style="margin-top: 1px;font-weight: 400;"><strong>Cuil</strong></label>
                    <div style="background-color: #eef1f5;opacity: 1;">'.$involucrado->cuil.'</div>
                    </td>
                   
                  </tr>
                </table><br/>';
      
        return $html;


    } 

    private function get_detalle_infractor($html,$involucrado,$infraccion,$tipovehiculo_model,$marca,$modelo){
      $html =$html ."<div style='' >El infractor <strong>".$involucrado->nombre.",".$involucrado->apellido
                   ." </strong> con cuil : <strong>".$involucrado->cuil ." </strong>. En el cual posee el siguiente "
                   ." vehiculo.Tipo Vehículo : "
                   ." <strong>".$tipovehiculo->nombre."</strong>"
                   ." ,Marca : <strong>".$marca->nombre."</strong>"
                   ." ,Modelo : <strong>".$modelo->nombre."</strong>"
                   ." Dominio : <strong>".$infraccion->dominio."</strong>"
                   ."</div>";
      return $html;
    }

    private function get_detalle_vehiculo2($data,$infraccion,$tipovehiculo,$marca,$modelo){
      $html= $data  .'<br><table border="0" style="border:1px solid #000000;" cellpadding="5">
                    <tr>
                    <td width="60">  
                    <label style="margin-top: 1px;font-weight: 400;"><strong>Tipo Vehiculo</strong></label>
                    <div style="background-color: #eef1f5;opacity: 1;">'.$tipovehiculo->nombre.'</div>
                    </td>
                    <td width="20%">
                    <label style="margin-top: 1px;font-weight: 400;"><strong>Marca</strong></label>
                    <div style="background-color: #eef1f5;opacity: 1;">'.$marca->nombre.'</div>
                    </td>

                    <td width="20%">
                    <label style="margin-top: 1px;font-weight: 400;"><strong>Modelo</strong></label>
                    <div style="background-color: #eef1f5;opacity: 1;">'.$modelo->nombre.'</div>
                    </td>
                    <td width="20%">
                    <label style="margin-top: 1px;font-weight: 400;"><strong>Dominio</strong></label>
                    <div style="background-color: #eef1f5;opacity: 1;">'.$infraccion->dominio.'</div>
                    </td>
                   
                  </tr>
                </table><br/>';
      
        return $html;
    }

    private function get_detalle_vehiculo($html,$infraccion,$tipovehiculo_model,$marca,$modelo){
      $html =$html.
             "<div style=''> Tipo Vehiculo :  <strong>".$tipovehiculo->nombre."</strong>".
             " Marca : <strong>".$marca->nombre."</strong>".
             " Modelo : <strong>".$modelo->nombre."</strong>".
             " Dominio : <strong>".$infraccion->dominio."</strong>".
             "</div>";
      return $html;
    }


    /**
      * Funcion que permite mostrar en un cuadro las leyes
     **/
    public function get_detalle_leyes($html,$leyes) {
      
        if(!empty(count($leyes))){        
        $html = $html . '<br/><table border="1">
            <thead>';
        $html = $html . '<tr>
            <th width="15%" align="center" style="background-color: #F3F3F3"><b>Ley</b></th>
            <th width="15%" align="center" style="background-color: #F3F3F3"><b>Articulo</b></th>
            <th width="15%" align="center" style="background-color: #F3F3F3"><b>Inciso</b></th>
            <th width="15%" align="center" style="background-color: #F3F3F3"><b>Tipo Unidad</b></th>
            <th width="15%" align="center" style="background-color: #F3F3F3"><b>Unidad Valor</b></th>
            </tr>';

        $html = $html . '</thead>
                 <tbody>';

        foreach($leyes as $ley):
            $html = $html . '<tr >';
           
            $html = $html .$this->show_value( $ley->numeroLey);
            $html = $html .$this->show_value($ley->nombreArticulo);
            $html = $html .$this->show_value($ley->descripcioninciso);
            $html = $html .$this->show_value($ley->tipoUnidad);
            $html = $html .$this->show_value($ley->unidad);
           
            //$item->lugar_de_trabajo
            $html = $html . '</tr>';
        endforeach;

        $html = $html . '</tbody>
                 </table>';
        }else{
                $html = $html.' <table border="0">    
                            <tr>                                              
        <td align="center" style="background-color: #F3F3F3"><b>No Contiene ninguna ley</b></td>
                             </tr>
                             </table>
                             ';
        }        
        return $html;        
      }


      private function show_value($value) {
        $html = '<td width="15%" align="center">';
        $html = $html . '<font size="-3">'. $value . '</font>' ;
        $html = $html . '</td>';
        return $html;
    }


    function get_detalle_pago($html,$infraccion,$infraccionPago,$infraccionPagoCuota,$fecha){
     $format_date= date_format(date_create(date("d-m-Y"), 'd/m/Y H:i'));
     $html=$html ."<p></p>";

           if($infraccionPago->tipo_pago==TIPO_PAGO_CONTADO){
             $html=$html. "<br>Tipo de Pago : Contado". 
              "<br>Pago Total : <strong>".$infraccionPagoCuota->importe."$</strong> con un descuento de ".$infraccionPago->porcentaje_descuento;
          }else{
             $html=$html."<br>Tipo de Pago : <strong>Cuotas</strong>".
             "<br>Cuota : <strong>".$infraccionPagoCuota->numero_cuota."</strong> de <strong>".$infraccionPago->cant_cuotas."</strong>".
             "<br>Pago Cuota  : <strong>".$infraccionPagoCuota->importe."$</strong> con descuento de : <strong>".$infraccionPago->porcentaje_descuento."% Art. 85 Ley 24449/95</strong>";
          }
         
          $html = $html ." <br>Fecha y Hora : <strong>".date('Y-m-d')." , ".date('H:i')."hs.</strong></br>";
          return $html;

     }


      /**
        Detalle de la firma 
        **/
     function get_detalle_firma($html){
      $html=$html."<br><br>".
                  "<span style='display:inline-block;' width='23px;'>______________________________ </span>".
                   "<h4 align='left'>Firma Infractor/a o Representante </h4>";
              
      return $html;
     }


   

}
