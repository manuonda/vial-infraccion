<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


 ini_set('display_errors', 0);
 ini_set('log_errors', 1);

/***
   * Clase que permite generar el informe 
   * en excel 
  **/

class Excelinfracciones {

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
    function excel($filter) {
    
     //obtenemos las infracciones
     $infracciones=$this->ci->infraccion_model->buscar($filter,null, null);
     $object = new PHPExcel();
     
     $object->setActiveSheetIndex(0);
     $object->getActiveSheet()->setTitle('Llamadas');

     $table_columns = array("Nro.Acta", "Fecha Hecho", "Fecha Alta" , "Infractor", "DNI", "Dominio" , "Leyes Alcoholemia" , "Leyes Generales");
     $column = 0;
     
     
     
     foreach($table_columns as $field) {
      $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
      //$object->getActiveSheet()->getColumnDimension('A')->setWidth(20); 
      $column++;
     }
     $object->getActiveSheet()->getColumnDimension('A')->setWidth(30);
     $object->getActiveSheet()->getColumnDimension('B')->setWidth(30);
     $object->getActiveSheet()->getColumnDimension('C')->setWidth(30);
     $object->getActiveSheet()->getColumnDimension('D')->setWidth(30);
     $object->getActiveSheet()->getColumnDimension('E')->setWidth(30);
     $object->getActiveSheet()->getColumnDimension('F')->setWidth(30);
     $object->getActiveSheet()->getColumnDimension('G')->setWidth(30);
     $object->getActiveSheet()->getColumnDimension('H')->setWidth(60);
    // $object->getActiveSheet()->getColumnDimension('I')->setWidth(60);

     $excel_row = 2;

    foreach($infracciones as $row) {
      $object->getActiveSheet()->setCellValue("A{$excel_row}", trim($row->numeroActa));
      $object->getActiveSheet()->getRowDimension('A{$excel_row}')->setRowHeight(50);
      
      $object->getActiveSheet()->setCellValue("B{$excel_row}", $row->fechaHecho);
      $object->getActiveSheet()->getRowDimension('B{$excel_row}')->setRowHeight(50);

      $object->getActiveSheet()->setCellValue("C{$excel_row}", $row->fechaAlta);
      $object->getActiveSheet()->getRowDimension('C{$excel_row}')->setRowHeight(50);
      
      $object->getActiveSheet()->setCellValue("D{$excel_row}", $row->involucrado);
      
      $object->getActiveSheet()->setCellValue("E{$excel_row}", trim($row->dni_involucrado));
      
      $object->getActiveSheet()->setCellValue("F{$excel_row}", $row->dominio);
      $object->getActiveSheet()->getRowDimension("F${excel_row}")->setRowHeight(15);

      // usuario _alta 
      /*$usuario = $this->usuario_model->getById($row->usuario_alta);  
      $object->getActiveSheet()->setCellValue("G{$excel_row}", $usuario->username);
      $object->getActiveSheet()->getRowDimension("G${excel_row}")->setRowHeight(15);
      */   
      // Obtenemos las leyes de alcoholemia 
      $itemLeyesAlcoholemias = "";
      $tipoTramite = $this->ci->tipotramite_model->getByAcronimo(LEY_ALCOHOLEMIA);
      if ( $tipoTramite != null ){
          $leyesAlcoholemias = $this->ci->infraccionley_model->getByIdInfraccion($row->id ,$tipoTramite->id_tipo_tramite);
         if($leyesAlcoholemias != null && isset($leyesAlcoholemias)) {
            foreach ($leyesAlcoholemias as $key => $value) {
              if ( $itemLeyesAlcoholemias != "" ) {
                $itemLeyesAlcoholemias = $itemLeyesAlcoholemias ." / ";
              }
                $itemLeyesAlcoholemias = $itemLeyesAlcoholemias . $value->nombre;
                
                if($value->nombreArticulo != null ) {
                       $itemLeyesAlcoholemias = $itemLeyesAlcoholemias.','.$value->nombreArticulo;
                }
                if($value->nombreInciso != null ) {
                   $itemLeyesAlcoholemias = $itemLeyesAlcoholemias . ','.$value->nombreInciso;
                }
              }
         }
      }
      

      $object->getActiveSheet()->setCellValue("G{$excel_row}", $itemLeyesAlcoholemias);
      
      //Obtenemos las leyes de manera general  
      $itemLeyesGenerales = "";
      $tipoTramite = $this->ci->tipotramite_model->getByAcronimo(LEY_GENERAL);
      if ( $tipoTramite != null ){
          $leyesGenerales = $this->ci->infraccionley_model->getByIdInfraccion($row->id, $tipoTramite->id_tipo_tramite);

          if ($leyesGenerales != null && isset($leyesGenerales)) {
           foreach ($leyesGenerales as $key => $value) {
                if( $itemLeyesGenerales != "") {
                   $itemLeyesGenerales = $itemLeyesGenerales ." / ";
                }
                $itemLeyesGenerales = $itemLeyesGenerales . $value->nombre;
                
                if($value->nombreArticulo != null ) {
                       $itemLeyesGenerales = $itemLeyesGenerales.','.$value->nombreArticulo;
                }
                if($value->nombreInciso != null ) {
                   $itemLeyesGenerales = $itemLeyesGenerales . ','.$value->nombreInciso;
                }
              }
           }
         }
      
      

      $object->getActiveSheet()->setCellValue("H{$excel_row}", $itemLeyesGenerales);

      $excel_row++;
     }


      $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename=infracciones.xls');
      header('Cache-Control: max-age=0');
      $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
      //Hacemos una salida al navegador con el archivo Excel.
      ob_end_clean();
      $objWriter->save('php://output');
      
    }

}