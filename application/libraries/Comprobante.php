<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


 ini_set('display_errors', 0);
  ini_set('log_errors', 1);

/***
   * Clase que permite generar el comprobante
  **/

class Comprobante {


 protected $logo_jujuy_negro = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAARIAAABICAYAAAA6VXoGAAAe6UlEQVR42u3dBbSlVRUHcOyWVLqHhpmhO4YGlQGUVGFoBJTuTpWU7g6BoZVWYuwkRErAYIHKWhbLruP8jrPf+vi49d7cd9+bN2evddd993vf/e4XZ//P3v8dZ4YZplF55ZVXzn7iiSfSV77ylXTeeeelY445Jh155JHp85//fLrmmmvSgw8+mH7605+mGYoUKVKkLvfcc0868MAD03rrrZeWWGKJtMwyy+T3pZZYMo1ZZnRaesml0mKLLJoWX3SxtOLyK6Ttt90unXj8Cemxxx4roFKkyPQud9x2e1p/3fXSgvMvkMaOHpNfK62wYgaLZceMTaustHJaecWV8rtty41dNr/bb+EFF0oLLbRQ2m233dJ3v/vdAihFikxv8u1vfzttvvnmacnFl0irr7paWnXlVTJAeAccKyy3fP68/LLL5W3ABbDYtsZqq+fXaqusmlZYYTLgLLtsGjVqVDrxxBPTb3/729nL3S1SZDqQ22+/Pa2yyipp+eWXzxYGsAjAACIAA5CwQgCIbUAjwCYAJ++/8soZTLwvvfTSafz48emll14q1kmRIiNZrr322rTYYoulsWPHZiABFkADWACNABZgEUAS7k0Ajv29/M0aWXXVVfP7uHHj0pgxYzKoPP300wVMihQZiXLrrbdm4hQoVC2PeAVoxMs+4cL4H+CoA03sF26QfX3edONN0tNPlehOkSIjSp5//vm00kor9RGm4bIEsRovn2NbFTgCaOI7Ptf/5zv+b/sySy2d9tx9jwIkRYqMJDniiCPSiiv+33VhRQAAkRefI7wr1BvvwryLLDwqvy+x2OL5Jfy76KhF8rt9Ri+9TN4/oj0AhUXi+LaL6tx9990FTIoUGQny4x//OM0555xpkUUWSaMWWrjP9dh2623SPnvtnQ49+JB0ykknp7POODOdf+556dKLL0nXXXNtuuXmifk18aab8+vmG29KN1x3fbrissvTuWefk04/9bR0/LHHpUMOOjjttOOEtOXmW6QN198gAwwQmmuOOdNHP/rRAiRFiowEueOOO9Jxxx2XrYMnHns8PffMs+m1V1/buNu/8+tf/3rCK6+8ctgzzzyThJdvvvnmtPPOOxcgKVKkSJEiRYpURLLYSy+8mJ59+pkcUXnkoYfTjTfemC699NJ06qmnpqOOOioddNBBab/99kv77LNP+sxnPpP22GOP/Np9993TnnvumbcffPDB6dhjj02nnHJKOv/889PVV1+dpNizQtTh/OxnP0u/+tWvbnr11Vc3Lne9SJFpVCYr8aSvfe1r6aqrrkonn3xy+tznPpd22WWXtOmmm+YsVoTpQgssmElT9TReSy65ZFpqqaVyjc3o0aNznomXbRLNqtv8bZvv+dtrwQUXTHPNNVdaeOGF8//WXHPN9IlPfCKDkMK/M888M91www3pueeeK9mvRYoMd7nvvvsysTr33HPn5DDJZ94pvXdAIHojG9XnABAvf9tv0UUXzYAAHBZffPF8jEzUjhqV322rgk58luAmGc225ZZbLoebgYqXhDXffetb35q23377wpsUKdJLeeGFF/Is/uyzz+ZsUW5Duxmdm7HWWmtlsGAZUG4gQLFtV2PzyU9+MlsL3BSh4eOPPz67N+eee2665JJL0pVXXpnbBnjJhr3uuuvy35dffnl2Z84444z0hS98IZO4hx56aHaHuD9bb7112mijjfLvAhQAA0ScC0A64YQT2oKIVgbyXlzzU089ldyDydc8poyGIkX6IZRH/w8zt9l83nnnTbPMMkt6//vfn+aZZ560/vrrp8MOOyzddNNNqRWYsBhYHeuss0667bbb0osvvpjrYAZTKfEiXCvgJ+wMqACK89hpp51Sq2sGTp/+9Kcz4L397W9P733ve9OHPvShNN9886W11147A98VV1xRXKMiRdoBCIJz8p9ppplmyjP7vvvumxXssssuS2effXbmG7baaqvsdrznPe9Jq622WlKE1+h4SFRuCpflO9/5zpC4E/JIFAgCtSbWx2H7779/dsfe8pa3pA022CDtuuuu6bTTTsu8ype+9KVs+QAh1o19tC5wL8qIKVKkJtwH7ocZGSnZyaz7rW99K7slXAYuRqN9EJ7+D4yG4roWWGCBbFV99atffdPvP/TQQxlkVAwDPZGedsd78skns3sEcFha3KAyeooUmSwXXHBBNt2FTwfKo5ix99577zd9X8tE0RSzfq+v60c/+lGaffbZG7o0XC9AIHQ8kGPjis4666zM9/ziF794voyiItO1PPDAA+n000/vipIjQ7/4xS++6VgTJkzIJGuvr01GLfdLJKkOfN2K3ABfuS0jYSw8+uijGVzvv//+6dZt48pu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";
 
 protected $escudo_negro = "data:image/png;base64,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";



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
        $CI->load->model('personatemporal_model');



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
        $bandInfraccion = isset($infraccion);
        $bandEstablecerInvoucrado = isset($infraccion->persona_establecer_involucrado);
        $datoInvolucrado = 0000000;

       if(isset($infraccion->dni_involucrado)){
          var_dump("obtenemos los datos del involucrado");
          $involucrado=$this->ci->persona_model->getInformacion($infraccion->dni_involucrado);
          $datoInvolucrado = $infraccion->cuil_involucrado;     
       } else if($bandInfraccion && $bandEstablecerInvoucrado) {
          var_dump("encontro uan persona de establecer involucrado");
          $involucrado = $this->ci->personatemporal_model->getPersona($infraccion->id_infraccion , 'involucrado'); 
          $datoInvolucrado  = $involucrado->dni;
          var_dump("datoInvolucrado");
          var_dump($datoInvolucrado);
       } 
            


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
                            .$this->getNumeroActa($infraccion->numero_acta)
                            .$this->getCuit($datoInvolucrado)
                            .'0'.$infraccionPagoCuota->numero_cuota
                            .'0'.$infraccionPago->cant_cuotas
                            .'0'.$tipoTramiteGeneral->valor 
                            .$this->getImporte($infraccionPagoCuota->importe_general)
                            .'0'.$tipoTramiteAlcoholemia->valor 
                            .$this->getImporte($infraccionPagoCuota->importe_alcoholemia)
                            .date('dmY');
    echo 'codigoantes :'.strlen($codigoBarraGeneral);
    echo "<br>";
    $codigoBarraGeneral = $codigoBarraGeneral. $this->getDigitoVerificador($codigoBarraGeneral); 
    echo "<br>";
    echo 'codigoBarraGeneral'.strlen($codigoBarraGeneral);
    echo '<br>';
    echo $codigoBarraGeneral;
    echo '<br>';
    echo 'numeroActa : '.$this->getNumeroActa($infraccion->numero_acta). 'cant '.strlen($this->getNumeroActa($infraccion->numero_acta));
    echo "<br>";
    echo 'cuil_involucrado : '.$this->getCuit($datoInvolucrado). 'cant : '.strlen($this->getCuit($datoInvolucrado));
    echo '<br>';
    echo 'numero_cuota'.'0'.$infraccionPagoCuota->numero_cuota. 'cant: '.strlen($infraccionPagoCuota->numero_cuota);
    echo '<br>';
    echo 'cant_cuotas : '.strlen('0'.$infraccionPago->cant_cuotas);
    echo '<br>';
    echo 'tipo tramite valor general : '.'0'.$tipoTramiteGeneral->valor ;
    echo '<br>';
     echo 'tipo tramite valor Alcholomeia : '.'0'.$tipoTramiteAlcoholemia->valor ;
     echo "<br>";
    echo 'importe General: '.$this->getImporte($infraccionPagoCuota->importe_general) .' cant '.strlen($this->getImporte($infraccionPagoCuota->importe_general));
    echo '<br>';
    echo 'importe Alcholomeia : '.$this->getImporte($infraccionPagoCuota->importe_alcoholemia) .' cant : '.strlen($this->getImporte($infraccionPagoCuota->importe_alcoholemia));
    echo "<br>";
    echo "fecha : ".date('dmY');
                           

    // Codigo de Barra de Alcholomeia 
    
    /*$codigoBarraAlcoholemia = $configuracion->codigo_ministerio
                              .'0'.$tipoTramiteAlcoholemia->valor
                              .$this->getCuit($infraccion->cuil_involucrado)
                              .$this->getNumeroActa($infraccion->numero_acta)
                              .'0'.$infraccionPagoCuota->numero_cuota
                              .'0'.$infraccionPago->cant_cuotas
                              .$this->getImporte($infraccionPagoCuota->importe_alcoholemia)
                              .date('dmY', strtotime("+1 day"));
    $codigoBarraAlcoholemia = $codigoBarraAlcoholemia. $this->getDigitoVerificador($codigoBarraAlcoholemia);
        echo $codigoBarraAlcoholemia;

    //echo 'codigoBarraAlcoholemia : '.strlen($codigoBarraAlcoholemia);
    */
  
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


       $paramsGeneral     = $pdf->serializeTCPDFtagParameters(array($codigoBarraGeneral, 'I25', '', '', 170, 18, 0.2, $style, 'N'));
       $paramsAlcoholemia = $pdf->serializeTCPDFtagParameters(array($codigoBarraAlcoholemia, 'I25', '', '', 170, 18, 0.2, $style, 'N'));

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
                   <tr >
                   <td width="100%">
                   '.$this->get_pdfGeneral($configuracion,$involucrado,$domicilioActual,$infraccion,$infraccionPago,$infraccionPagoCuota,$leyes,$tipovehiculo,$marca,$modelo,$configuracion,$username ,$paramsGeneral,  $paramsAlcoholemia ,$codigoBarraGeneral).
                   '</td>
                   </tr>
                   <tr>
                   <td>-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
                   </tr>
                   <tr height="10%" style="padding-bottom: 10px;">
                   <td width="100%">
                  '.$this->get_pdfGeneral($configuracion,$involucrado,$domicilioActual,$infraccion,$infraccionPago,$infraccionPagoCuota,$leyes,$tipovehiculo,$marca,$modelo,$configuracion,$username, $paramsGeneral , $paramsAlcoholemia ,$codigoBarraGeneral).
                   '</td>
                   </tr>
                   <tr >
                   <td>
                   -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                   </td>
                   </tr>
                   <tr >
                   <td width="100%">
                  '.$this->get_pdfGeneral($configuracion,$involucrado,$domicilioActual,$infraccion,$infraccionPago,$infraccionPagoCuota,$leyes,$tipovehiculo,$marca,$modelo,$configuracion,$username, $paramsGeneral , $paramsAlcoholemia ,$codigoBarraGeneral ).
                   '</td>
                   </tr>
                   </table>
                   </body>
                   </html>';

        //echo 'html' .$html;           
  
  
        $nombre_pdf = $involucrado->dni."-"."cuota".$infraccionPagoCuota->numero_cuota.".pdf";

     
       
        $pdf->setPrintHeader(false);
        $pdf->SetPageOrientation("P");
        $pdf->SetTitle('Reporte');
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, 0);
        //$pdf->setFooterMargin(10);
        //$pdf->setCustomFooterText('Depositar en cualquier boca de cobro del Banco de Desarrollo Jujuy S.E');

        $pdf->SetFont('times', '', 11);
        $pdf->AddPage();
        

        // output the HTML content
        $pdf->writeHTML($html);

        //$pdf->writeHTMLCell(0, 0, '', '', "fasfds", 0, 0, false,true, "L", true);

        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        // reset pointer to the last page
        $pdf->lastPage();
        // ---------------------------------------------------------
        //Close and output PDF document
         $pdf->Output($nombre_pdf, 'I'); 
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
      if ( isset($cuit)  &&  strlen($cuit) <=12 ) {
        $cantCeros = 12 - strlen($cuit);
        for ( $i = 0; $i < $cantCeros ; $i++ ) {
           $cuit = '0'.$cuit;
        }
      } else {
         $cuit = '000000000000';
      }

      return $cuit;
    }

    private function getImporte($importe) {
      if ( isset($importe) &&  strlen($importe) <=6 ) {
        $cantCeros = 6 - strlen($importe);
        for( $i = 0 ; $i < $cantCeros ; $i++ ) {
          $importe = '0'.$importe;
        }
      }
    
      return $importe.'00';
    }

   /**
    * Funcion que permite obtener las leyes 
    * generales
   **/
  private function get_pdfGeneral($configuracion,$involucrado,$domicilio,$infraccion,$infraccionPago,$infraccionPagoCuota,$leyes,$tipovehiculo,$marca,$modelo,$configuracion,$username ,$barraGeneral, $barraAlcoholemia ,$codigoBarraGeneral) {
       


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

      $html = '  <table border="0" style="border:1px solid #000000;" >
                  <tr>
                  <td width="30%" rowspan="2">
                  <div align="center" style="margin-top:0px">
                  <img  height="50" src="'.$this->logo_jujuy_negro.'">
                  </div>
                  </td>
                  <td width="10%"></td>
                  <td width="30%"></td>
                  <td width="30%" rowspan="2">
                  <div align="rigth" style="margin-top:0px">
                  <img  height="50" src="'.$this->escudo_negro.'">
                  </div>
                  </td>
                  </tr>
                  
                  <tr>
                  <td width="10%"></td>
                  <td width="30%">
                  <div align="center" style="font-family: Open Sans,sans-serif;
                    font-size: 9px;text-align: justify;font-weight: bold;font-style: italic;
                    text-justify: inter-word; margin-top:23px; margin-left: 25px;">
                   Policia de Jujuy - Dirección de Tránsito y Seguridad Vial 
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
                  <tr><td width="40%"> Comprobante </td><td><strong>'.$infraccionPagoCuota->comprobante.'</strong></td></tr>
                  <tr><td width="40%"> DNI Infractor </td><td><strong>'.$involucrado->dni.'</strong></td></tr> 
                  <tr><td width="40%"> Nombre y Apellido Infractor </td><td><strong>'.$involucrado->nombre.', '.$involucrado->apellido.'</strong></td></tr>
                  <tr><td width="40%"> Fecha de Generación  </td><td><strong>'.date('d/m/Y').', a horas '.date("h:i:sa").'</strong></td></tr>
                  <tr><td width="40%"> Fecha de Vencimiento </td><td><strong>'.date('d/m/Y').'</strong></td></tr>
                  <tr><td width="40%"> Nro.Cuota </td><td><strong>'.$infraccionPagoCuota->numero_cuota.'</strong></td></tr>
                  <tr><td width="40%"> Cantidad Cuotas </td><td><strong>'.$infraccionPago->cant_cuotas.'</strong></td></tr>
                  <tr><td width="40%"> Importe Leyes  </td><td><strong>$ '.$infraccionPagoCuota->importe_general.'</strong></td></tr>
                  <tr><td width="40%"> Importe Alcoholemia </td><td><strong>$ '.$infraccionPagoCuota->importe_alcoholemia.'</strong></td></tr>
                  <tr><td width="40%"> Total a Pagar </td><td><strong>$ '.$total.'</strong></td></tr>
                  <tr>
                  <td>
                  <br>
                  <br>
                  <table border="0"  width="100%">
                  <tr>
                  
                  <td width="60%"></td>
                  <td width="60%"></td>
                  
                  <td width="80%" rowspan="3">
                  <br>';
                  if( strlen($codigoBarraGeneral) == 54 ){
                   $html = $html . '<tcpdf method="write1DBarcode" params="'.$barraGeneral.'" />'; 
                  } else {
                    $html = $html . 'NO SE PUDO GENERAR EL CODIGO DE BARRA';            
                  }  
                  $html = $html .
                  '</td>
                  </tr>
                  <tr>
                  <td width="60%"></td>
                  <td width="60%"></td>
                  </tr>
                  <tr>
                  <td width="60%">
                  <table border="0" cellpadding="1">
                    <tr><td>------------------------------------</td></tr>
                    <tr><td>Recibido por </td></tr>
                    </table>   
                  </td>
                  
                  <td width="60%">
                  <table border="0" cellpadding="2">
                  <tr><td>-----------------------------------------</td></tr>
                  <tr><td>Sello </td>
                  </tr>
                  </table>   
                  </td>
                  </tr>
                  
                  </table>
                  </td>
                  </tr>
                  </table>';



      return $html;


  } 

  /**
   <tr><td width="120%"><tcpdf method="write1DBarcode" params="'.$barraGeneral.'" /></td>
                      <td width="120%"><tcpdf method="write1DBarcode" params="'.$barraAlcoholemia.'" /></td>
                  </tr>
                 */


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
    * Funcion que permite obtener las leyes 
    * generales
   **/
  private function get_pdfGeneral2($configuracion,$involucrado,$domicilio,$infraccion,$infraccionPago,$infraccionPagoCuota,$leyes,$tipovehiculo,$marca,$modelo,$configuracion,$username ,$params) {
       


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

      $html = '  <table border="1" style="border:1px solid #000000;" >
                  <tr>
                  <td width="100%">
                  <div align="center" style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: justify;
                    text-justify: inter-word;">
                   Policia de Jujuy - Dirección de Tránsito y Seguridad Vial 
                  <b><br>ACTA GENERAL</b>
                  </div>
                  </td>
                  </tr>
                  </table>
                  <br>
                  <br>
                
                <table  style="font-family: Open Sans,sans-serif;
                               font-size: 8px;text-align: justify;
                               text-justify: inter-word;">
                  <tr><td width="40%"> Número Acta   </td><td>'.$infraccion->numero_acta.'</td></tr>
                  <tr><td width="40%"> DNI Infractor </td><td>'.$involucrado->dni.'</td></tr> 
                  <tr><td width="40%"> Nombre y Apellido Infractor </td><td>'.$involucrado->nombre.', '.$involucrado->apellido.'</td></tr>
                  <tr><td width="40%"> Especificación del Rodado </td><td>'.$vehiculo.'</td></tr>
                  <tr><td width="40%"> Lugar del Hecho  </td><td><strong>'.$lugar_hecho.'</strong></td></tr>
                  <tr><td width="40%"> Fecha del Hecho </td><td><strong>'.date("d/m/Y", strtotime($infraccion->fecha_ingreso)).'</strong></td></tr>
                  <tr><td width="40%"> Infracciones     </td><td></td></tr>
                  <tr><td width="40%"> Fecha de Generación  </td><td><strong>'.date('d/m/Y').', a horas '.date("h:i:sa").'</strong></td></tr>
                  <tr><td width="40%"> Fecha de Vencimiento </td><td><strong>'.date('d/m/Y',strtotime("+1 day")).'</strong></td></tr>
                  <tr><td width="40%"> Nro.Cuota </td><td><strong>'.$infraccionPagoCuota->numero_cuota.'</strong></td></tr>
                  <tr><td width="40%"> Cantidad Cuotas </td><td><strong>'.$infraccionPago->cant_cuotas.'</strong></td></tr>
                  <tr><td width="40%"> Importe a Pagar </td><td><strong>$ '.$infraccionPagoCuota->importe_general.'</strong></td></tr>
                  <tr>
                  <td>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <table border="0">
                  <tr>
                  <td width="70%" style="font-family: Open Sans,sans-serif;
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
                  <td width="60%">
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
                   
                 <tr>
                 <td> 
                 <br><br>
                 <tcpdf method="write1DBarcode" params="'.$params.'" />
                 </td>
                 </tr>   
                   
                  </table>   
                  </td>
                 
                  </tr>
                  </table>
                  </td>
                  </tr>
                  <tr  width="100%" > 
                  <td width="100%" class="bb">
                    <table style="border:1px solid #000000; padding: 0px" border="0" cellspacing="0" cellpadding="0"> 
                     <tr><td>
                     <div align="center" style="font-family: Open Sans,sans-serif;
                      font-size: 8px;">
                      Depositar en cualquier boca de cobro del Banco de Desarrollo Jujuy S.E
                     </div></td></tr>
                     </table>
                       
                  </td>
                  </tr>
        </table>';



      return $html;


  } 
 

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
