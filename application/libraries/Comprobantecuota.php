<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/***
   * Clase que permite generar el comprobante 
   * de contado
  **/

class Comprobantecuota  {

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



        //Datos del vehiculo 
       $this->data['dominio']=$infraccion->dominio;
       $modelo=$this->ci->modelo_model->getById($infraccion->id_modelo);
       
       $marca=$this->ci->marca_model->getById($modelo->id_marca);
       $tipovehiculo=$this->ci->tipovehiculo_model->getById($marca->id_tipovehiculo);

      //Leyes - Detalle de la infraccion 
       $leyes=$this->ci->infraccionley_model->getByIdInfraccion($infraccion->id_infraccion);
       //($infraccion);
       
       //*****************************************************
       //Datos del involucrado
       $involucrado=$this->ci->persona_model->getInformacion($infraccion->dni_involucrado);
       
      



        $this->data['fecha_actual']=date("Y-m-d");
            
        $data_header = null;

        //$html  = $this->get_pdf($involucrado,$infraccion,$infraccionPago,$infraccionPagoCuota,$leyes,$tipovehiculo,$marca,$modelo);
        //$html = $this->get_header($data_header, $this->data);
        /*$this->data['titulo'] = 'PLAN DE PAGO ESPONTÁNEO';
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
        */
      
        $nombre_pdf = $involucrado->dni."-"."cuota".$infraccionPagoCuota->numero_cuota.".pdf";
      
        $html  =  '<table style="font-size:8px">
                   <tr height="40%">
                   <td width="100%">'.
                   $this->get_pdf($involucrado,$infraccion,$infraccionPago,$infraccionPagoCuota,$leyes,$tipovehiculo,$marca,$modelo,$username).
                   '<br><br></td>
                   </tr>
                   <tr width="100%" style="border-bottom: 1px solid #000;">
                   <td width="100%" style="border-bottom: 1px solid #000;">
                   
                   </td>
                  
                   </tr>
                   <tr height="40%">
                   <td width="100%">
                   <br><br>  
                   '
                   .$this->get_pdf($involucrado,$infraccion,$infraccionPago,$infraccionPagoCuota,$leyes,$tipovehiculo,$marca,$modelo,$username).
                   '</td>
                   </tr>
                   </table>';

                 //  var_dump($html);

        ob_end_clean();
       
        $pdf = new TCPDF();
        $pdf->setPrintHeader(false);
        $pdf->SetPageOrientation("P");
        $pdf->SetTitle('Reporte');
        $pdf->setPrintFooter(true);
        $pdf->setFooterMargin(20);
        $pdf->SetFont('times', '', 11);
        $pdf->AddPage();
        $pdf->writeHTML($html);
        $pdf->Output($nombre_pdf, 'I');
       
   } 

    private function get_pdf($involucrado,$infraccion,$infraccionPago,$infraccionPagoCuota,$leyes,$tipovehiculo,$marca,$modelo,$username){

    $html =  '<table style="font-family: "Open Sans",sans-serif;font-size: 12px;">
              <tr>
              <td>
              <h2 align="center"><u>  PLAN DE PAGO ESPONTANEO</u></h2>
              <h4 align="center"><u> CON REDUCCION DEL '.$infraccionPago->porcentaje_descuento.'% Art.85 Ley 24.449/95</u></h4>
              <h4 align="center">'.$infraccionPagoCuota->numero_cuota.'(CUOTA) de  '.$infraccionPago->cant_cuotas.'(CUOTAS)</h4>
              </td>
              </tr>
              <tr>
              <td>INFRACTOR : <strong>'.$involucrado->nombre.", ".$involucrado->apellido."</strong>  con DNI : <strong> ".$involucrado->dni .' </strong> 
              </td>
              </tr>
              <tr>
              <td width="100%">ACTA DE COMPROBACION: <strong>'.$infraccion->numero_acta.'</strong></td>
              </tr>
              <tr>
              <td>Fecha de Acta :<strong> '.date('d-m-Y',strtotime($infraccion->fecha_ingreso)).'</strong></td>
              </tr>
              <tr>
              <td width="100%">
               <div align="center">Detalle de las Infracciónes</div><br>'
              .$this->get_detalle_leyes2($leyes).'
              </td>
              </tr>
              <tr><td>Valor de la multa :<strong>$'.$infraccionPago->importe.'</strong></td></tr>
              <tr><td>Valor total con reduccion : <strong>$'.$infraccionPago->importe_reduccion.'</strong></td></tr>
              <tr><td>Plan de pago: <strong> '.$infraccionPago->cant_cuotas.'</strong> cuotas iguales de <strong>$'.$infraccionPagoCuota->importe.'</strong></td></tr>
              <tr><td width="50%"></td><td width="60%"><strong> $ '.$infraccionPagoCuota->importe.'</strong></td></tr>
              <tr><td width="50%"></td><td width="60%"> Hoy <strong>'.date('d-m-Y').'</strong></td></tr> 
              <tr>
              <td width="100%">
              <br>
              '.$this->get_detalle_firma2($infraccionPagoCuota,$username).'
              </td>
              </tr> 

              </table>';
   
     return $html;

   }

     function get_detalle_firma2($infraccionPagoCuota,$username){
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
      * Funcion que permite mostrar en un cuadro las leyes
     **/
    public function get_detalle_leyes2($leyes) {
      
    
       $texto ="";
        if(!empty(count($leyes))){        
      

        foreach($leyes as $ley):
           
            $texto = $texto ."La ley : <strong> ".$ley->descripcionLey ."</strong>";

            if($ley->nombreArticulo!=null && isset($ley->nombreArticulo)){
              $texto  = $texto . " ,articulo :  <strong> ".$ley->nombreArticulo ."</strong>";
            }

            if($ley->descripcioninciso!=null && isset($ley->descripcioninciso)){
              $texto = $texto . " , inciso: <strong> ".$ley->descripcioninciso ."</strong>";
            }
          $texto = $texto ."<br>";
        endforeach;
    }else{
          $html = $html.' <b>No Contiene ninguna ley</b>';
        }        
       
      return $texto;      
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
                          <b>ACTA DE PAGOS ESPONTÁNEO</b>
                          <b>CON REDUCCION DEL  %Art. 85 Ley 24449/95
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


    


    private function get_detalle_vehiculo($html,$infraccion,$tipovehiculo_model,$marca,$modelo){
      $html =$html.
             "<div style=''> Tipo Vehiculo :  <strong>".$tipovehiculo->nombre."</strong>".
             " Marca : <strong>".$marca->nombre."</strong>".
             " Modelo : <strong>".$modelo->nombre."</strong>".
             " Dominio : <strong>".$infraccion->dominio."</strong>".
             "</div>";
      return $html;
    }


    


      private function show_value($value) {
        $html = '<td width="15%" align="center">';
        $html = $html . '<font size="-3">'. $value . '</font>' ;
        $html = $html . '</td>';
        return $html;
    }


    function get_detalle_pago($html,$infraccion,$infraccionPago,$infraccionPagoCuota){
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
