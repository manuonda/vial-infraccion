<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


 ini_set('display_errors', 0);
  ini_set('log_errors', 1);

/***
   * Clase que permite generar el comprobante 
  **/

class Comprobante {

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

        //Datos del vehiculo 
       $this->data['dominio']=$infraccion->dominio;
       $modelo=$this->ci->modelo_model->getById($infraccion->id_modelo);
       
       $marca=$this->ci->marca_model->getById($modelo->id_marca);
       $tipovehiculo=$this->ci->tipovehiculo_model->getById($marca->id_tipovehiculo);
   
       //Leyes - 
       $leyesGeneral=$this->ci->infraccionley_model->getByIdInfraccion($infraccion->id_infraccion ,$tipoTramiteGeneral->id_tipo_tramite);
       $leyesAlcoholemia = $this->ci->infraccionley_model->getByIdInfraccion($infraccion->id_infraccion , $tipoTramiteAlcoholemia->id_tipo_tramite);

     
       
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
       
      

     //Codigo de Barra Ley General
     $codigoBarraGeneral  = $configuracion->codigo_ministerio
                     .'0'.$tipoTramiteGeneral->valor
                     .$this->getCuit($infraccion->cuil_involucrado)
                     .$this->getNumeroActa($infraccion->numero_acta)
                     .'0'.$infraccionPagoCuota->numero_cuota
                     .'0'.$infraccionPago->cant_cuotas
                     .$this->getImporte($infraccionPagoCuota->importe_general)
                     .date('dmY',strtotime("+1 day"));

    $codigoBarraGeneral = $codigoBarraGeneral. $this->getDigitoVerificador($codigoBarraGeneral); 
    echo "codigoBarraGeneral length : ".length($codigoBarraGeneral);
  
    // Codigo de Barra de Alcholomeia 
    $codigoBarraAlcoholemia = $configuracion->codigo_ministerio
                              .'0'.$tipoTramiteAlcoholemia->valor
                              .$this->getCuit($infraccion->cuil_involucrado)
                              .$this->getNumeroActa($infraccion->numero_acta)
                              .'0'.$infraccionPagoCuota->numero_acta
                              .'0'.$infraccionPago->cant_cuotas
                              .$this->getImporte($infraccionPagoCuota->importe_alcoholemia)
                              .date('dmY', strtotime("+1 day"));
    $codigoBarraAlcoholemia = $codigoBarraAlcoholemia. $this->getDigitoVerificador($codigoBarraAlcoholemia);
    echo "codigoBarraAlcoholemia length : ".length($codigoBarraAlcoholemia);


     ob_start();
 
      $pdf = new TCPDF(); 
       

       $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => false,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );
       /**
       array('position'=>'S', 'border'=>false, 'padding'=>4, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>8, 'stretchtext'=>4)
        **/

       $paramsGeneral     = $pdf->serializeTCPDFtagParameters(array($codigoBarraGeneral, 'I25', '', '', 80, 16, 0.2, $style, 'N'));
       $paramsAlcoholemia = $pdf->serializeTCPDFtagParameters(array($codigoBarraAlcoholemia, 'I25', '', '', 80, 16, 0.2, $style, 'N'));

      $this->data['fecha_actual']=date("Y-m-d");
      $data_header = null;
      $html  =  '
                   <html>
                   <head>
                     <style type="text/css">
                       .bb td, .bb th {
                         border-bottom: 1px solid black !important;
                       }
                     </style>
                   </head>
                   <body>
                   <table style="font-size:8px">
                   <tr height="40%">
                   <td width="100%">
                   '.$this->get_pdfGeneral($configuracion,$involucrado,$domicilioActual,$infraccion,$infraccionPago,$infraccionPagoCuota,$leyes,$tipovehiculo,$marca,$modelo,$configuracion,$username ,$paramsGeneral,  $paramsAlcoholemia).
                   '</td>
                   </tr>
                   <tr>
                   <td>-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
                   </tr>
                   <tr height="40%" style="padding-bottom: 20px;">
                   <td width="100%">
                  '.$this->get_pdfGeneral($configuracion,$involucrado,$domicilioActual,$infraccion,$infraccionPago,$infraccionPagoCuota,$leyes,$tipovehiculo,$marca,$modelo,$configuracion,$username, $paramsGeneral , $paramsAlcoholemia).
                   '</td>
                   </tr>
                   <tr height="40%">
                   <td>
                   -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                  
                   </td>
                   </tr>
                   <tr>
                   <td width="100%">
                  '.$this->get_pdfGeneral($configuracion,$involucrado,$domicilioActual,$infraccion,$infraccionPago,$infraccionPagoCuota,$leyes,$tipovehiculo,$marca,$modelo,$configuracion,$username, $paramsGeneral , $paramsAlcoholemia).
                   '</td>
                   </tr>
                   </table>
                   </body>
                   </html> 
                   ';
  
  
        $nombre_pdf = $involucrado->dni."-"."cuota".$infraccionPagoCuota->numero_cuota.".pdf";

     
       
        $pdf->setPrintHeader(false);
        $pdf->SetPageOrientation("P");
        $pdf->SetTitle('Reporte');
        $pdf->setPrintFooter(true);
        //$pdf->setFooterMargin(10);
        //$pdf->setCustomFooterText('Depositar en cualquier boca de cobro del Banco de Desarrollo Jujuy S.E');

        $pdf->SetFont('times', '', 11);
        $pdf->AddPage();
        

        // output the HTML content
        $pdf->writeHTML($html, true, 0, true, 0);

        //$pdf->writeHTMLCell(0, 0, '', '', "fasfds", 0, 0, false,true, "L", true);

        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        // reset pointer to the last page
        $pdf->lastPage();
        // ---------------------------------------------------------
        //Close and output PDF document
        //$pdf->Output($nombre_pdf, 'I'); 
        //var_dump($html);
        ob_end_flush(); 
   
    } 
      
     /**
      * Funcion codificar
     **/
     public function getDigitoVerificador($texto) {

        //$texto = '7' . $concepto . $categoria . $cuil_ciudadano . $importepagar . $fechavencimiento;
        //$texto = '701020202329717402904060010000031122019'; //701020202329717402904060010000031122019
        $nroprimo = 1;
        $i = 0;
        $sumadelosdigitos = 0;

        $cadena = $texto;
        $cant = strlen($cadena);

        for ($j = 1; $j <= $cant; $j++) {
            if ($nroprimo > 9) {
                $nroprimo = 3;
            }
                        
            $sumadelosdigitos = $sumadelosdigitos + intval(substr($cadena, $i, 1)) * $nroprimo;
            $i++;
            $nroprimo = $nroprimo + 2;            
        }

        $nrocociente = $sumadelosdigitos / 2;
        $nroentero = (int) $nrocociente;
        $DigitoVeridicador = $nroentero % 10;
        
        return $DigitoVeridicador; 
    } 

    /**
      * Numero Acta
      */
    private function getNumeroActa($numeroActa){
      
      if ( isset($numeroActa) &&  strlen($numeroActa) <=8 ) {
         $cantCeros = 8 - strlen($numeroActa);
         for ( $i = 0 ; $i< $cantCeros ; $i++) {
            $numeroActa = '0'.$numeroActa;
         }
      } else {
          $numeroActa = '00000000';
      }

      return $numeroActa;
    }

    private function getCuit($cuit) {
      if ( isset($cuit)  &&  strlen($cuit) <=11 ) {
        $cantCeros = 11 - strlen($cuit);
        for ( $i = 0; $i < $cantCeros ; $i++ ) {
           $cuit = '0'.$cuit;
        }
      } else {
        $cuit = '00000000000';
      }

      return $cuit;
    }

    private function getImporte($importe) {
      if ( isset($importe) &&  strlen($importe) <=8 ) {
        $cantCeros = 8 - strlen($importe);
        for( $i = 0 ; $i < $cantCeros ; $i++ ) {
          $importe = '0'.$importe;
        }
      }
      return $importe;
    }

   /**
    * Funcion que permite obtener las leyes 
    * generales
   **/
  private function get_pdfGeneral($configuracion,$involucrado,$domicilio,$infraccion,$infraccionPago,$infraccionPagoCuota,$leyes,$tipovehiculo,$marca,$modelo,$configuracion,$username ,$barraGeneral, $barraAlcoholemia) {
       


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

       
       $vehiculo ="";
       if ( $tipovehiculo !=  null  && isset($tipovehiculo)) {
          $vehiculo = 'Tipo Vehiculo : <strong> '.$tipovehiculo->nombre.' </strong>';
       } else {
          $vehiculo = 'Tipo Vehiculo : <strong> --- </strong>';
       }

       if ( $marca != null && isset($marca)) {
         $vehiculo  = $vehiculo .' Marca : <strong> '.$marca->nombre.'</strong>';
       } else {
         $vehiculo  = $vehiculo .' Marca : <strong> ---  </strong> ';
       }

       if ( $modelo != null && isset($modelo)) {
         $vehiculo = $vehiculo .' Modelo : <strong>'.$modelo->nombre.'</strong>';
       } else {
          $vehiculo = $vehiculo .' Modelo : <strong> --- </strong>';
       }

       if ( $infraccion != null && isset($infraccion)) {
         $vehiculo = $vehiculo . ' Dominio :<strong>'.$infraccion->dominio.'</strong>';
       } else {
         $vehiculo = $vehiculo . ' Dominio :<strong> --- </strong>';
       }

      $total = $infraccionPagoCuota->importe_general + $infraccionPagoCuota->importe_alcoholemia;

      $html = '  <table border="1" style="border:1px solid #000000;" >
                  <tr>
                  <td width="100%">
                  <div align="center" style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: justify;
                    text-justify: inter-word;">
                   Policia de Jujuy - Dirección de Tránsito y Seguridad Vial 
                  <b><br></b>
                  </div>
                  </td>
                  </tr>
                  </table>
                  <br>
                  <br>
                
                <table  style="font-family: Open Sans,sans-serif;
                               font-size: 8px;text-align: justify;
                               text-justify: inter-word;">
                  <tr><td width="40%"> Número Acta   </td><td><strong>'.$infraccion->numero_acta.'</strong></td></tr>
                  <tr><td width="40%"> DNI Infractor </td><td><strong>'.$involucrado->dni.'</strong></td></tr> 
                  <tr><td width="40%"> Nombre y Apellido Infractor </td><td><strong>'.$involucrado->nombre.', '.$involucrado->apellido.'</strong></td></tr>
                  <tr><td width="40%"> Fecha de Generación  </td><td><strong>'.date('d/m/Y').', a horas '.date("h:i:sa").'</strong></td></tr>
                  <tr><td width="40%"> Fecha de Vencimiento </td><td><strong>'.date('d/m/Y',strtotime("+1 day")).'</strong></td></tr>
                  <tr><td width="40%"> Nro.Cuota </td><td><strong>'.$infraccionPagoCuota->numero_cuota.'</strong></td></tr>
                  <tr><td width="40%"> Cantidad Cuotas </td><td><strong>'.$infraccionPago->cant_cuotas.'</strong></td></tr>
                  <tr><td width="40%"> Importe Leyes  </td><td><strong>$ '.$infraccionPagoCuota->importe_general.'</strong></td></tr>
                  <tr><td width="40%"> Importe Alcoholemia </td><td><strong>$ '.$infraccionPagoCuota->importe_alcoholemia.'</strong></td></tr>
                   <tr><td width="40%"> Total a Pagar </td><td><strong>$ '.$total.'</strong></td></tr>
                  <tr>
                  <td>
                  <br>
                  <br>
                  <br>
                  <table border="0"  width="100%">
                  <tr>
                  <td width="120%">
                  <table border="0" cellpadding="2">
                    <tr><td>------------------------------------</td></tr>
                    <tr><td>Recibido por </td></tr>
                    </table>   
                  </td>
                  <td width="120%">
                  <table border="0" cellpadding="2">
                  <tr><td>-----------------------------------------</td></tr>
                  <tr><td>Sello </td></tr>
                  </table>   
                  </td>
                  </tr>
                  <tr><td width="120%"><tcpdf method="write1DBarcode" params="'.$barraGeneral.'" /></td>
                      <td width="120%"><tcpdf method="write1DBarcode" params="'.$barraAlcoholemia.'" /></td>
                  </tr>
                  
                  </table>
                  </td>
                  </tr>
        </table>';



      return $html;


  } 


    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'logo_example.jpg';
        $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
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
