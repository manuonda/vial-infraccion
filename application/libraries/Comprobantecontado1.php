<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


 ini_set('display_errors', 0);
  ini_set('log_errors', 1);

/***
   * Clase que permite generar el comprobante 
   * de contado
  **/

class Comprobantecontado  {

   /**
      * Constructor para cargar las librerias 
      * necesarias
      */
    function __construct(){
       
        
        $CI = & get_instance();
        $CI->load->model('expediente_model');
        $CI->load->model('calle_model');
        $CI->load->model('barrio_model');
        $CI->load->model('localidad_model');
        $CI->load->model('departamento_model');
        $CI->load->model('persona_model');
                
        $CI->load->model('tipovehiculo_model');
        $CI->load->model('marca_model');
        $CI->load->model('modelo_model');

        //modal de leyes 
        $CI->load->model('ley_model');
        //estado 
        $CI->load->model('estado_model');
    

        $CI->load->model('infraccion_model');
        $CI->load->model('infraccionpago_model');
        $CI->load->model('infraccionpagocuota_model');
        $CI->load->model('infraccionley_model');
        $CI->load->model('configuracion_model');
        $CI->load->model('provincia_model');
        $CI->load->model('departamento_model');
        $CI->load->model('localidad_model');
        $CI->load->model('configuracion_model');
        $CI->load->model('tipotramite_model');



        $CI->load->library('pdf');

        $this->ci = $CI;
       
    }

    


   //********************************************************************************
   //PAGO DE CONTADO 
   public function getComprobante($idInfraccionPagoCuota,$username){
      
        $infraccionPagoCuota=$this->ci->infraccionpagocuota_model->getById($idInfraccionPagoCuota);
        $html="";

        //($infraccionPagoCuota);

        //Obtenemos la informacion
        //de la infraccion de pago - para verificar que tipo 
        //de pago es
        $infraccionPago=null;
        $infraccion=null;
        if(isset($infraccionPagoCuota)){
           $infraccionPago=$this->ci->infraccionpago_model->getById($infraccionPagoCuota->id_infraccion_pago);
        }

        //Obtenemos informacion de la infraccion 
        if($infraccionPago!=null){
            $infraccion=$this->ci->infraccion_model->getById($infraccionPago->id_infraccion);
        }


       //Configuracion 
       $configuracion =  $this->ci->configuracion_model->getById(1);
       $tipoTramiteAlcoholemia = $this->ci->tipotramite_model->getByAcronimo(LEY_ALCOHOLEMIA);
       $tipoTramiteGeneral     = $this->ci->tipotramite_model->getByAcronimo(LEY_GENERAL); 


      var_dump($tipoTramiteAlcoholemia);
      echo "<br>";
      var_dump($tipoTramiteGeneral);
      echo "<br>";
      


        //Datos del vehiculo 
       $this->data['dominio']=$infraccion->dominio;
       $modelo=$this->ci->modelo_model->getById($infraccion->id_modelo);
       
       $marca=$this->ci->marca_model->getById($modelo->id_marca);
       $tipovehiculo=$this->ci->tipovehiculo_model->getById($marca->id_tipovehiculo);
   
       //Leyes - 
       $leyes=$this->ci->infraccionley_model->getByIdInfraccion($infraccion->id_infraccion);
     

       
       //*****************************************************
       //Datos del involucrado
       $involucrado=$this->ci->persona_model->getInformacion($infraccion->dni_involucrado);

       //Datos del domicilio 
       $domicilios =$this->ci->persona_model->get_domicilios($infraccion->dni_involucrado);
       $domicilioActual=null;
       if ($domicilios != null ) {
         foreach($domicilios as $domicilio){
         if ($domicilio->actual == 't') {
            $domicilioActual=$domicilio;
          }
         } 
       }
       
      


      $pdf = new TCPDF(); 
     
     
      $this->data['fecha_actual']=date("Y-m-d");
      $data_header = null;
      $html  =  '<table style="font-size:8px">
                   <tr height="40%">
                   <td width="100%">
                   <br>
                   '.
                   $this->get_pdf($configuracion,$involucrado,$domicilioActual,$infraccion,$infraccionPago,$infraccionPagoCuota,$leyes,$tipovehiculo,$marca,$modelo,$configuracion,$username).
                   '</td>
                   </tr>
                  <tr width="100%" style="border-bottom: 1px solid #000;" height="20">
                   <td width="100%" style="border-bottom: 1px solid #000;">
                    <br><br><br>
                   </td>
                  
                   </tr>
                   <tr height="40%">
                   <td width="100%">
                    <br>
                    <br>
                    <br>
                   '.
                   
                   $this->get_pdf($configuracion,$involucrado,$domicilioActual,$infraccion,$infraccionPago,$infraccionPagoCuota,$leyes,$tipovehiculo,$marca,$modelo,$configuracion,$username).
                   '</td>
                   </tr>
                   <tr>
                   </tr>
                   </table>';

                   var_dump($html);


        $nombre_pdf = $involucrado->dni."-"."cuota".$infraccionPagoCuota->numero_cuota.".pdf";

        ob_end_clean();
       
       
        $pdf->setPrintHeader(false);
        $pdf->SetPageOrientation("P");
        $pdf->SetTitle('Reporte');
        $pdf->setPrintFooter(true);
        $pdf->setFooterMargin(20);
        $pdf->SetFont('times', '', 11);
        $pdf->AddPage();
        $pdf->writeHTML($html , true, false , true ,false , '');
        // Comprobante de pago 
        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => true,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );
       // $pdf->write1DBarcode('CODE 39', 'C39', '', '', '', 18, 0.4, $style, 'N');
        //$pdf->Output($nombre_pdf, 'I');
        



// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_049.pdf', 'I'); 
       
   } 


  /**
    * Funcion que permite obtener las leyes 
    * generales
   **/
  private function get_pdfGeneral($configuracion,$involucrado,$domicilio,$infraccion,$infraccionPago,$infraccionPagoCuota,$leyes,$tipovehiculo_model,$marca,$modelo,$configuracion,$username) {



  } 


  private function respaldo()

   private function get_pdf2($configuracion,$involucrado,$domicilio,$infraccion,$infraccionPago,$infraccionPagoCuota,$leyes,$tipovehiculo_model,$marca,$modelo,$configuracion,$username){
       
      
        $provincia = $this->ci->provincia_model->getById($infraccion->id_provincia);
        $departamento = $this->ci->departamento_model->getById($infraccion->id_departamento); 
        $localidad = $this->ci->localidad_model->getById($infraccion->id_localidad);
        $lugar_hecho  = "";
        if($provincia!=null && !empty($provincia)){
          $lugar_hecho  = $lugar_hecho . $provincia->provincia ; 
        }

        if($departamento!=null && !empty($departamento)){
           $lugar_hecho = $lugar_hecho . ",". $departamento->depto;   
        }


        if($localidad!=null && !empty($localidad)){
          $lugar_hecho = $lugar_hecho .",".$localidad->localidad;
        }

        if(!empty($infraccion->lugar_hecho)){
          $lugar_hecho = $lugar_hecho .",".$infraccion->lugar_hecho;
        }


      $html = '
                  <table border="0" style="border:1px solid #000000;" >
                  <tr>
                  <td width="100%">
                  <div align="center" style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: justify;
                    text-justify: inter-word;">
                   Policia de Jujuy - Dirección de Tránsito y Seguridad Vial 
                  <b>ACTA DE PAGOS ESPONTÁNEO</b><br/><br/>
                  <b>Reducción del 50% Art. 85 Inc.a) de la Ley 24.449/95</b>
                  </div>
                  </td>
                  </tr>
                  </table>
                
                  <table>
                  <tr>
                  <td>   
                  <br>  
                  <br>
                  <div  style="font-family: Open Sans,sans-serif;
                    font-size: 9px;text-align: justify;
                    text-justify: inter-word;">

                    Infractor : <strong>'.$involucrado->nombre.", ".$involucrado->apellido."</strong>  con DNI : <strong> ".$involucrado->dni .' </strong><br> 
                    Hoy '.date('d/m/Y').', a horas '.date("h:i:sa").' comparece el/la Sr./a'
                   .'<strong> '.$infraccionPagoCuota->nombre_apellido.'</strong> con DNI : <strong> '.$infraccionPagoCuota->dni_representante .'</strong> '
                   .'domiciliado en <strong> '.$infraccionPagoCuota->domicilio_representante 
                   .'</strong>, a efectos de hacer efectivo el pago voluntario previsto '
                   . 'en el Art. 85 Inc. a) de la Ley 24.449/95, por infracción al/los '
                   . ' artículos : ' .$this->get_detalle_leyes($leyes);

      $html =$html . ' y recaída en Acta de Comprobación Nro. <strong>'.$infraccion->numero_acta.'</strong>, '.
                     ' labrada el día <strong>'.date("d/m/Y", strtotime($infraccion->fecha_ingreso)).'</strong> '.
                     ' en el lugar <strong>'.$lugar_hecho.' ,</strong> al conducir el vehículo ';

        
      
      //*--------------------------------------------------
      //Información del vehiculo
      $html =$html .'<strong> '.$tipovehiculo_model->nombre.'</strong>'
                   .' ,Marca : <strong>'.$marca->nombre.'</strong>'
                   .' ,Modelo : <strong>'.$modelo->nombre.'</strong>'
                   .'  Dominio Nro. : <strong>'.$infraccion->dominio.'</strong> ';

    
      $html =$html .' . La multa esta fijada en <strong>'.$infraccionPagoCuota->valor_uf.'</strong> Unidades Fijas(U.F), equivalentes a <strong>$'.$infraccionPago->importe.'</strong> , que antes su espontaneidad de pago y lo estipulado en dicho texto legal accede a una reducción del 50% sobre el citado monto, debiendo abonar un total de <strong>$'.$infraccionPagoCuota->importe.'   </strong> lo que se hará efectivo en la Div. F.E.S- Fondo Especial de Seguridad - Dirección Admin y Finanzas -  Policia de Jujuy, sito en Avenida Santibañez 1372 de esta ciudad, oportunidad en la que se extenderá un Recibo Oficial. 
        </div>
        </td>
        </tr>
        <tr>
        <td>
        <br>
        <br>
        <br>
        <br>
        '.$this->get_detalle_firma2($infraccionPagoCuota,$username,$params ,$pdf).'
        </td>
        </tr>
       
        </table>';

      
       

      return $html;


   }
 
    /**
      * Se obtiene los articulos e incisos
      **/
    function get_detalle_leyes($leyes){
    // var_dump($leyes);
    // var_dump("<br>");
     $html = "";
     foreach ($leyes as $key => $value) {


        //var_dump($value);

         if($value->nombreArticulo!=null  && isset($value->nombreArticulo)){
            $html = $html . " articulo <strong>".$value->nombreArticulo."</strong>";
         }
         if($value->nombreInciso!=null && isset($value->nombreInciso)){
          $html =  $html . ", inciso <strong> ".$value->nombreInciso."</strong>";
         } 

         $html = $html . " ley : <strong>".$value->nombre."</strong>";


        
        $html = $html . " , ";  
     }

     return $html;
    }


     function get_detalle_firma2($infraccionPagoCuota,$username ,$barcode , $pdf){

           $params = $pdf->serializeTCPDFtagParameters(array('CODE 39', 'C39', '', '', 80, 30, 0.4, array('position'=>'S', 'border'=>true, 'padding'=>4, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>8, 'stretchtext'=>4), 'N'));  
 
         

         return ' <br>
                  <table border="0">
                  <tr>
                  <td width="40%" style="font-family: Open Sans,sans-serif;
                    font-size: 10px;">
                  <table border="0" cellpadding="2">
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td>-----------------------------------------</td></tr>
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td> Firma Infractor/a o Representante </td></tr>
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td><strong>'.$infraccionPagoCuota->nombre_apellido.'</strong></td></tr>
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td>      Aclaración </td></tr>
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td><strong>'.$infraccionPagoCuota->dni_representante.'</strong></td></tr>
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td>DNI</td></tr>
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td><strong>'.$infraccionPagoCuota->vinculo_representante.'</strong></td></tr>
                   <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td> Vínculo Representante</td></tr>
                  </table>   
                 
                  </td>
                  <td width="20%">
                  </td>
                  <td width="40%">
                  <table border="0" style="font-family: Open Sans,sans-serif;
                    font-size: 10px;" cellpadding="2">
                 <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td>-----------------------------------------</td></tr>
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td> Firma Funcionario Actuantes </td></tr>
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td> <strong>'.$username.'</strong></td></tr>
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td>      Aclaración </td></tr>
                   
                    
                   
                  </table>   
                  </td>
                  </tr>
                  </table><br/>';

     }

  
 

    /**
     * Obtenemos el header
    **/
    private function get_header($data, $par) {
      
        $html = ' <br></br>
                  <table border="0" style="border:1px solid #000000;" >
                  <tr>
                  <td width="100%">
                  <div align="center" style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: justify;
                    text-justify: inter-word;">
                   Policia de Jujuy - Dirección de Tránsito y Seguridad Vial 
                  <b>ACTA DE PAGOS ESPONTÁNEO</b><br/><br/>
                  <b>Reducción del 50% Art. 85 Inc.a) de la Ley 24.449/95</b>
                  </div>
                  </td>
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


   

}
