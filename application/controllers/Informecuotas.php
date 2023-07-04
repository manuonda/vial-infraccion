
<?php


    /**
      ***************************
      * Clase correspondiente a 
      * A los pagos realizados de las 
      * cuotas
      * @dathe  : 18/4/2020
      * @author : dgarcia
      **/ 
   class Informecuotas extends MY_Controller{


    /**
      * Constructor para cargar las librerias 
      * necesarias
      */
    function __construct(){
       parent::__construct();
        
        //library y helpers
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('excelcuotas');


        //model
        $this->load->model('expediente_model');
        $this->load->model('calle_model');
        $this->load->model('barrio_model');
        $this->load->model('localidad_model');
        $this->load->model('departamento_model');
        $this->load->model('persona_model');
        $this->load->model('usuario_model');
        
        
        $this->load->model('tipovehiculo_model');
        $this->load->model('marca_model');
        $this->load->model('modelo_model');
      

        //modal de leyes 
        $this->load->model('ley_model');
        $this->load->model('articulo_model');
        $this->load->model('inciso_model');
        //estado 
        $this->load->model('estado_model');

        $this->load->model('infraccion_model');
        $this->load->model('infraccionpago_model');
        $this->load->model('infraccionpagocuota_model');
        $this->load->model('configuracion_model');
        $this->load->model('rol_model');
        $this->load->model('infraccionley_model');
        $this->load->model('destacamento_model');
        $this->load->model('provincia_model');
        $this->load->model('pais_model');
        $this->load->model('informe_model');
        $this->load->model('personajuridica_model');
        $this->load->model('configuracion_model');
        $this->load->model('tipotramite_model');
        $this->load->model('personatemporal_model');
        $this->load->model('tipotarjeta_model');
        $this->load->library('pagination');
        $this->load->library('excel');

    } 
 

    /**
     *  Index
     */
   	public function index($filter=null,$message=null,$status=null,$Starting=0){
       if ($this->ion_auth->logged_in()) {
       	    
            $filter = $this->session->userdata('filterInformeCuota');

            //filter vial 
            if($filter==null){
                $filter['numero_acta']=null;
                $filter['fecha_desde']=null;
                $filter['fecha_hasta']=null;
                $filter['actual'] = null;
                $filter['tipo_pago'] = null;
                $filter['tipo_tarjeta'] = null;
            }


            $tipoPagos = [TIPO_PAGO_CONTADO,TIPO_PAGO_TARJETA,FES, TARJETA_DEBITO ,TARJETA_CREDITO];

            $this->data['tipo_pagos']=$tipoPagos; 
            $this->data['message']=$message; 
            $this->data['status']=$status;
            $this->data['contenido'] = "informes/index_view.php";
            $this->data['titulo']="Informes / Pago Cuotas";
            $this->data['filter']=$filter;
            $this->data['tipotarjetas'] = $this->tipotarjeta_model->get_all();

            $this->data['departamentos']=$this->departamento_model->get_all(9); //provincia de jujuy = 9
            $this->load->view('template', $this->data);
        } else {
            redirect('admin/login');
        }
   

   	}


    /**
      * Funcion que permite realizar 
      * la limpieza de los filtros
     **/ 
    public function limpiar(){
       $this->session->set_userdata('filterInformeCuota', null);
       $this->index();
    }


    /**
      * Funcion que permite obtener la 
      * pagination de la tabla de infracciones
    **/
    public function pagination($rowno=0){
      $config = $this->get_configuration(); 
      $filter = $this->session->userdata('filterInformeCuota');
       
       //filter vial 
       if($filter==null){
          $filter['numero_acta']=null;
          $filter['fecha_desde']=null;
          $filter['fecha_hasta']=null;
          $filter['actual'] = null;
          $filter['tipo_pago'] = null;
          $filter['tipo_tarjeta'] = null;
      }
     
      
       
      // Row per page
      $rowperpage = 5;

     // Row position
     if($rowno != 0){
         $rowno = ($rowno-1) * $rowperpage;
      }


     //obtenemos los pagos
     $infracciones=$this->infraccionpagocuota_model->buscar($filter,$config["per_page"],$rowno);
     $result = [];
   
     foreach ($infracciones as $infraccion) {
         $result[] = $this->get_format_row($infraccion);
     }

     // Initialize
     $this->pagination->initialize($config);

    // Initialize $data Array
    $data['pagination'] = $this->pagination->create_links();
    $data['result'] = $result;
    $data['row'] = $rowno;
    
    echo json_encode($data);
    return;

    }


    public function downloadExcel() {
      $filter = $this->session->userdata('filterInformeCuota');
      if($filter==null){
          $filter['numero_acta']=null;
          $filter['fecha_desde']=null;
          $filter['fecha_hasta']=null;
          $filter['actual'] = null;
          $filter['tipo_pago'] = null;
          $filter['tipo_tarjeta'] = null;

      }
      $this->excelcuotas->getExcelCuotas($filter);
     
  } 


  public function downloadExcelActual() {
      $filter = $this->session->userdata('filterInformeCuota');
       //filter vial 
       if($filter==null){
           $filter['numero_acta']=null;
           $filter['fecha_desde']=null;
           $filter['fecha_hasta']=null;
           $filter['actual'] = 'actual';
           $filter['tipo_pago'] = null;
           $filter['tipo_tarjeta'] = null;
      }

      $this->excelcuotas->getExcelCuotas($filter);  
  } 


   /**
    * Get Format Row
   **/
   private function get_format_row($pago){
      $row = '<tr class="odd gradeX">';
      $row = $row . '<td>'.$pago->numero_acta.'</td>';
      $row = $row .'<td>'.$pago->numero_cuota.'</td>';
      $row = $row . '<td>';
              if($pago->estado==CUOTA_PAGADA){
      $row = $row . '<div class="text-center"><span class="label label-sm label-info form-rounded">'.
                     '<strong>CP</strong></span></div>';
              }else{
      $row = $row . '<div class="text-center">'.
                    '<span class="label label-sm label-warning form-rounded"><strong>CNP</strong></span></div>';
              }
      $row = $row .'</td>';
              if( $pago->tipo_pago_cuota == FES){

      $row = $row .'<td><div class="text-center"><strong>FES</strong></div></td>'
                  .'<td><div class="text-center"><strong>Compr. Alcoholemia : </strong>'.$pago->comprobanteAlcoholemia
                  .',<strong> Compr. General : </strong>'.$pago->comprobanteGeneral.'</div></td>';

              } else if ($pago->tipo_pago_cuota == TARJETA_DEBITO) {

      $row = $row    . '<td><div class="text-center"><strong>TARJETA DEBITO : </strong>'.$pago->nombreTarjeta.'</div></td>'
                     . '<td><div class="text-center"><strong>Nro.Compra</strong>'.$pago->numeroCompra
                     . '<strong>, Nro.Factura </strong>'. $pago->digitoFactura
                     .'<strong>-</strong>'.$pago->numeroFactura.'</div></td>';

              } else if ($pago->tipo_pago_cuota == TARJETA_CREDITO) {
      $row = $row . '<td><div class="text-center"><strong>TARJETA CREDITO:</strong> '.$pago->nombreTarjeta.'</div></td>'
                  . '<td><div class="text-center"><strong>Nro.Compra</strong>'
                  .   $pago->numeroCompra.'<strong>, Nro.Factura </strong>'
                  .   $pago->digitoFactura.'<strong>-</strong>'.$pago->numeroFactura.'</div></td>' ;
                 
              } else if ($pago->tipo_pago_cuota == BANCO) {
      $row = $row . '<td><div class="text-center"><strong>BANCO</strong></div></td>'
                  . '<td><div class="text-center"><strong>Nro.Compr. Banco</strong>'.$pago->comprobanteBanco.'<strong></td>';
              } else {
      $row = $row . '<td><div class="text-center">NO REALIZADO</div></td><td><div class="text-center">NO REALIZADO</div></td>';
              }
      $row = $row .'<td width="10%"><div class="text-center">';
              if(isset($pago->fecha_pago))  {
               $row = $row .date('d-m-Y',strtotime($pago->fecha_pago));  
              }
              
      $row = $row . '</div></td>';
              
      $row =  $row .'<td width="10%"><div class="text-center">'.$pago->hora_pago.'</div></td>';
              $row = $row .'<td width="10%"><div class="text-center"><strong>';
              $row = $row .'$'.$pago->importe_general.'</strong></td>';
              $row = $row .'<td width="10%"><div class="text-center"><strong>$'.
                           $pago->importe_alcoholemia.'</strong></div></td>';
              $row = $row .'</tr>';
       $row = $row."</div></td></tr>";
       return $row;

    }


    private function get_configuration(){
        $config['base_url'] = base_url().'informepago/pagination/';
        $config['use_page_numbers'] = TRUE;
        $config['per_page'] = 5; 
        $config['num_links'] = 5;
        $config['total_rows'] = $this->infraccion_model->all_count();
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        return $config;
    }

  
   
  
    
    /**Funcion que permite obtener los 
      * datos a filtrar de la busqueda mediante 
      * post
      * @param : post, parameters
      */

    public function buscar(){
     
       $this->filter['numero_acta']=$_POST['numero_acta'];
       $this->filter['fecha_desde']=$_POST['fecha_desde'];
       $this->filter['fecha_hasta']=$_POST['fecha_hasta'];
       $this->filter['tipo_pago'] =$_POST['tipo_pago'];
       $this->filter['actual'] = null;

       $this->session->set_userdata('filterInformeCuota', $this->filter);

       $this->index($this->filter);     
    }



 

    ///*************************************
    //** METODOS DE GENERACION DE EXHIMIR PDF 
    //***************************************
    public function generarComprobanteExhimirPDF($idInfraccion){
      $infraccion =$this->infraccion_model->getById($idInfraccion);
      
      $html="<html><body><br></br><br></br>"; 
      $data_header = null;
      $mes=$this->getMes();
      $dia=date("d");
      $year=date("Y");
      $fecha_ingreso = date("d M Y", strtotime(date("d M y")));
      $titulo = 'SAN SALVADOR DE JUJUY '.$dia.' de '.$mes.', '.$year;
      $html =$html . '<h4 align="rigth">'. strtoupper($titulo) .'</h4>';
      $html = $html . "<br></br><br></br>";
      //Detalle del contenido
      $html = $html . $this->get_contenido($infraccion);
      $html = $html . "</body></html>";
       
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
      $pdf->Output('descargo'.$infraccion->id_infraccion.'.pdf', 'I');
        
    } 



   
    /**
      * <b>Funcion que permite generar el contenido 
      * de la informacion 
      * </b>
     **/ 

    public function get_contenido($infraccion){
      $fecha_ingreso="";
      if($infraccion->fecha_ingreso!=null && isset($infraccion->fecha_ingreso)){
         $fecha_ingreso=date("d/m/Y", strtotime($infraccion->fecha_ingreso));
      }


      $contenido ="<br></br><p></p>";
      $contenido =$contenido. '<div align="left"><strong><u>A LA SEÑORA</u></strong><br>';
      $contenido =$contenido. '<div align="left"><strong><u>DIRECTORA TRANS. Y SEG. VIAL</u></strong><br>';
      $contenido =$contenido. '<div align="left"><strong><u>SU  // DESPACHO</u></strong>  <br>';

      $contenido =$contenido. "<p></p>".
                 ' <div  style="font-family: Open Sans,sans-serif; font-size: 10px;text-align: justify; text-justify: inter-word;">'.
                 ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Por la presente tengo el agrado de dirigirme a Ud. a fin de solicitarle, quisiera tener a bien se me EXIMA el pago de la multa por carece de <strong>'.$infraccion->texto_carece_exhimido.'</strong>, en razón de que en fecha <strong>'.$fecha_ingreso.'</strong>, personal Policial Caminera efectuo un control vehicular y realizo el Acta de Comprobación Nro. <strong>'.
                   $infraccion->numero_acta.'</strong>'.      
                 '<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Adjunto a al presente: <br><br><strong>'.
                 $infraccion->texto_exhimido.
                 '</strong><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A la espera de una respuesta favorable a mi solicitud. Saludo a Ud. muy atentamente'.  
                 '</div>'.
                 '<br><br><br><br><br><br></p>'.
                 '<div align="rigth"><table border="0" style="font-family: Open Sans,sans-serif;font-size: 12px;" cellpadding="2">
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td> _ _ _ _ _ _ _ _ _  _ _ _ _ _ _</td></tr>
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td> FIRMA</td></tr>
                   
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td>_ _ _ _ _ _ _ _ _ _ __  _ _ _ _</td></tr>
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td> ACLARACION </td></tr>
                   
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td> _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</td></tr>
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td> DNI</td></tr>
 

                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td>_ _ _ __ _ _ _ _ _ _ _ _ _ _ _ </td></tr>
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td>TELEFONO </td></tr>
                  </table> </div><br><br><br>';
               
      return $contenido;
    }

     public function getMes(){
       $mes=date("m");
      
         if($mes=="01") 
           return "Enero";
         else if($mes=="02")
            return "Febrero";
         else if($mes=="03") 
            return "Marzo";
         else if($mes=="04")
           return "Abril";
         else if($mes=="05")
           return "Mayo";
         else if($mes=="06") 
          return "Junio";
         else if($mes=="07")
           return "Julio";
         else if($mes=="08")
           return "Agosto";
         else if($mes=="09")
          return "Setiembre";
         else if($mes=="10")
           return "Octubre";
         else if($mes=="11")
           return "Noviembre";
         else if($mes=="12")
          return "Diciembre";  
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
?>