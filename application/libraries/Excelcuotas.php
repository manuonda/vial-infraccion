<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


 ini_set('display_errors', 0);
 ini_set('log_errors', 1);

/***
   * Clase que permite generar el informe 
   * en excel 
  **/

class Excelcuotas {

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
        $CI->load->model('infraccionpagocuota_model');

        $CI->load->library('pdf');

        $this->ci = $CI;
       
    }



    /**
      * Informe de cuotas
    **/
    function getExcelCuotas($filter) {
     //obtenemos las infracciones
     $cuotas=$this->ci->infraccionpagocuota_model->buscar($filter,null, null);
     $object = new PHPExcel();
     
     $object->setActiveSheetIndex(0);
     $object->getActiveSheet()->setTitle('Llamadas');

     $table_columns = array("Nro.Acta", "Nro.Cuota ", "Estado","Tipo Pago","Tipo Tarjeta","Operacion", "Fecha Pago", "Hora Pago" , "Importe.General  $","Importe Alcoholemia $");
     $column = 0;
     
     
     
     foreach($table_columns as $field) {
      $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
      //$object->getActiveSheet()->getColumnDimension('A')->setWidth(20); 
      $column++;
     }
     $object->getActiveSheet()->getColumnDimension('A')->setWidth(15);
     $object->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
     $object->getActiveSheet()->getColumnDimension('B')->setWidth(15);
     $object->getActiveSheet()->getColumnDimension('C')->setWidth(15);
     $object->getActiveSheet()->getColumnDimension('D')->setWidth(15);
     $object->getActiveSheet()->getColumnDimension('E')->setWidth(15);
     $object->getActiveSheet()->getColumnDimension('F')->setWidth(50);
     $object->getActiveSheet()->getColumnDimension('G')->setWidth(15);
     $object->getActiveSheet()->getColumnDimension('H')->setWidth(15);
     $object->getActiveSheet()->getColumnDimension('I')->setWidth(20);
     $object->getActiveSheet()->getColumnDimension('J')->setWidth(20);
     
     $excel_row = 2;

    foreach($cuotas as $row) {
      $object->getActiveSheet()->setCellValue("A{$excel_row}", trim($row->numero_acta));
      $object->getActiveSheet()->getRowDimension('A{$excel_row}')->setRowHeight(30);
      
      $object->getActiveSheet()->setCellValue("B{$excel_row}", $row->numero_cuota);
      $object->getActiveSheet()->getRowDimension('B{$excel_row}')->setRowHeight(30);
      
      $tipoPago ="";
      if ($row->estado == CUOTA_PAGADA) {
           $object->getActiveSheet()->setCellValue("C{$excel_row}", 'CUOTA PAGADA');
           $object->getActiveSheet()->getRowDimension('C{$excel_row}')->setRowHeight(30);
       } else {
           $object->getActiveSheet()->setCellValue("C{$excel_row}", 'CUOTA NO PAGADA');
           $object->getActiveSheet()->getRowDimension('C{$excel_row}')->setRowHeight(30);
        }

      $tipoPago = "";
      $comprobante = "";
      $tipoTarjeta = "--------";

      if ($row->tipo_pago_cuota == 'FES') {
         $tipoPago = FES;
         $comprobante = 'Compr. Alcoholemia : '.$row->comprobanteAlcoholemia .',Compr. General :'.$row->comprobanteGeneral;
      } else  if ( $row->tipo_pago_cuota == 'TARJETA_DEBITO'){
         $tipoPago = 'TARJETA DEBITO';
         $tipoTarjeta = $row->nombreTarjeta;
         $comprobante = 'Nr. Compra: '.$row->numeroCompra .',Nro. Factura :'.$row->digitoFactura.'-'.$row->numeroFactura;
      } else if ( $row->tipo_pago_cuota == 'TARJETA_CREDITO') {
         $tipoPago = 'TARJETA CREDITO';
         $tipoTarjeta = $row->nombreTarjeta;
         $comprobante = 'Nr. Compra: '.$row->numeroCompra .',Nro. Factura :'.$row->digitoFactura.'-'.$row->numeroFactura;
      } else if ( $row->tipo_pago_cuota == 'BANCO' ) {
         $tipoPago = 'BANCO';
         $comprobante = 'Nr. Comprobante Banco: '.$row->comprobanteBanco;
      } else {
         $tipoPago = 'NO REALIZADO';
         $comprobante = 'NO REALIZADO';
      }

      // Tipo Pago 
      $object->getActiveSheet()->setCellValue("D{$excel_row}", $tipoPago);
      $object->getActiveSheet()->getRowDimension('D{$excel_row}')->setRowHeight(30);
      // Nombre Tarjeta
      $object->getActiveSheet()->setCellValue("E{$excel_row}", $tipoTarjeta);
      $object->getActiveSheet()->getRowDimension('E{$excel_row}')->setRowHeight(30);
      

      $object->getActiveSheet()->setCellValue("F{$excel_row}", $comprobante);
      $object->getActiveSheet()->getRowDimension('F{$excel_row}')->setRowHeight(30);

      $fechaPago ="";
      if ( isset($row->fecha_pago)){
        $fechaPago = date('d-m-Y',strtotime($row->fecha_pago));
      }
      $object->getActiveSheet()->setCellValue("G{$excel_row}", $fechaPago);
      $object->getActiveSheet()->getRowDimension("G${excel_row}")->setRowHeight(30);
      
      $object->getActiveSheet()->setCellValue("H{$excel_row}", $row->hora_pago);
      
      $object->getActiveSheet()->setCellValue("I{$excel_row}", $row->importe_general);
      $object->getActiveSheet()->setCellValue("J{$excel_row}", $row->importe_alcoholemia);
      $excel_row++;
     }
      
      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename=pagos.xls');
      header('Cache-Control: max-age=0');
      $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      //Hacemos una salida al navegador con el archivo Excel.
      ob_end_clean();
      $objWriter->save('php://output');
      
    }

}