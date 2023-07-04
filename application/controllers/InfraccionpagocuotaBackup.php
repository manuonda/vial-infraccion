
<?php
  ini_set("session.auto_start", 0);
  ob_start();


    /**
      ***************************
      * Clase correspondiente a 
      * los pagos de las infracciones
      * @dathe  : 05-12-2017
      * @author : dgarcia
      **/ 
   class Infraccionpagocuota extends MY_Controller{


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
        
        $this->load->library('comprobantecuota');
        $this->load->library('comprobantecontado');

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
        $this->load->model('infraccionley_model');

        //modal de leyes 
        $this->load->model('ley_model');
        //estado 
        $this->load->model('estado_model');

        $this->load->model('infraccion_model');
        $this->load->model('infraccionpago_model');
        $this->load->model('infraccionpagocuota_model');
        $this->load->model('persona_model');

      
       


    } 
 

    /**
     *  Index
     */
   	public function index($idInfraccion){
       if ($this->ion_auth->logged_in()) {
       	    
            $this->data['contenido'] = "vial/index_pago_detalle";
            $this->data['titulo']="Infracciones / Pagos";
            $this->data['subtitulo']="Pago de Infracción";

            //Obtenemos los datos de la infraccion
            $infraccion = $this->infraccion_model->getById($idInfraccion);
             
            //Obtenemos datos del pago 
            $infraccionPago=$this->infraccionpago_model->getByIdInfraccion($infraccion->id_infraccion);
           
            
            //------------------------------
            //Obtenemos datos del involucrado 
            $involucrado="";
            if(isset($infraccion)){
              $involucrado=$this->persona_model->getInformacion($infraccion->dni_involucrado);
            } 

             //********************************************
             //Datos del vehiculo 
              $modelo=$this->modelo_model->getById($infraccion->id_modelo);
              $marca=$this->marca_model->getById($modelo->id_marca);
              $tipovehiculo=$this->tipovehiculo_model->getById($marca->id_tipovehiculo);
   
            
              $this->data['tipovehiculo']=$tipovehiculo;
              $this->data['marca']=$marca;
              $this->data['modelo']=$modelo;
          

            //Obtenemos los pagos de la infraccion 
            $pagos="";
            if(isset($infraccionPago)){
               $pagos=$this->infraccionpagocuota_model->getByIdInfraccionPago($infraccionPago->id_infraccion_pago);
               var_dump($pagos); 
            }




            $this->data['infraccion']=$infraccion;
            $this->data['infraccionPago']=$infraccionPago;
            $this->data['involucrado']=$involucrado;
            $this->data['pagos']=$pagos;

            //$this->data['infracciones']=$this->infraccion_model->buscar($filter);
            //$this->data['departamentos']=$this->departamento_model->get_all(9); //provincia de jujuy = 9
            $this->load->view('template', $this->data);
        } else {
            redirect('admin/login');
        }
   

   	}




  

  

    /**
      * Funcion que permite eliminar el pago de una cuota : 
      * La funcion de eliminar una cuota el significado del mismo 
      * es que la cuota cambia al estado a cuota_no_pagada, sin 
      * eliminar del sistema 
      **/ 
    public function delete_pagoCuota($idInfraccionPagoCuota){
        
        $infraccionPagoCuota=$this->infraccionpagocuota_model->getById($idInfraccionPagoCuota);
        //Obtenemos la infraccion de pago para indicar el estado del 
        //pago 
        $infraccionPago =$this->infraccionpago_model->getById($infraccionPagoCuota->id_infraccion_pago);


        //Redireccionamos a la pagina si se creo 
        //el registro correctamente, a la pagina de pagos 
        //por cuotas o pago en efectivo
        $status="";
        $message="";
        $url="";
        $bandPagoCuotas=false;
        $cantidadCuotas=0;

        //**************************************
        //** ACTUALIZAMOS EL PAGO E INDICAMOS QUE LA CUOTA ESTA NO PAGADA
        $this->data['id_infraccion_pago_cuota'] = $idInfraccionPagoCuota;
        $this->data['id_infraccion_pago']=$infraccionPagoCuota->id_infraccion_pago;
        $this->data['fecha_pago'] = "" ;
        $this->data['hora_pago'] = "";
        $this->data['numero_cuota']=$infraccionPagoCuota->numero_cuota;
        $this->data['estado']=CUOTA_NO_PAGADA;
        $this->data['numero_comprobante']="";
        $this->data['importe'] = "0";
        

        //obtenemos el registro de pago
       // y actualizamos el estado a CUOTA_PAGADA

        $this->data['id'] = $this->infraccionpagocuota_model->update($this->data);
        
       
      //=============================================
      //===========================================
      //TIPO PAGO ES DE CONTADO      
        if($infraccionPago->tipo_pago==TIPO_PAGO_CONTADO){
          
          $cantidadCuotas       = $this->getCantidadCuotas($infraccionPago->id_infraccion_pago);
          $cantidadCuotaPagadas = $this->getNumeroCuotaPagas($infraccionPago->id_infraccion_pago);
          $cantidadCuotaNoPagas = $this->getNumeroCuotaImpagas($infraccionPago->id_infraccion_pago);
          $esPagoCompleto       = $this->isPagoCompleto($infraccionPago->id_infraccion_pago);
          $label_cuotas=$cantidadCuotaPagadas."-".$cantidadCuotas;

          if(isset($this->data['id'])){
            //Cambia el estado de la infraccion 
            //para indicar el estado a pago completo
            $this->infraccion_model->updateEstadoInfraccion
                                       ( $infraccionPago->id_infraccion,
                                         INFRACCION_PAGO_INCOMPLETO,
                                         $label_cuotas 
                                        );
           $status="OK";
           $message="Se actualizo el estado del pago en contado";

          }else{
            $status="ERROR";
            $message="No se pudo realizar el estado de pago contado";
          }
 
         
        }else{
          //===================================
          //====================================
          //========= TIPO PAGO ES EN CUOTA

           
            if(isset($this->data['id'])){
                $cantidadCuotas       = $this->getCantidadCuotas($infraccionPago->id_infraccion_pago);
                $cantidadCuotaPagadas = $this->getNumeroCuotaPagas($infraccionPago->id_infraccion_pago);
                $cantidadCuotaNoPagas = $this->getNumeroCuotaImpagas($infraccionPago->id_infraccion_pago);
                $esPagoCompleto       = $this->isPagoCompleto($infraccionPago->id_infraccion_pago);
                $label_cuotas=$cantidadCuotaPagadas."-".$cantidadCuotas;
                 
              
                if($esPagoCompleto){
                
                   //Cambia el estado de la infraccion 
                   //para indicar el estado a pago completo
                   $this->infraccion_model->updateEstadoInfraccion( $infraccionPago->id_infraccion,
                                         INFRACCION_PAGO_COMPLETO,
                                         $label_cuotas 
                                        );
                  
                   $status="OK";
                   $message="El pago se Completo Correctamente";

                 }else{
                       //Cambia el estado de la infraccion
                       //para indicar la cantidad de cuotas pagadas 
                       //hasta el momento
                        $this->infraccion_model->updateEstadoInfraccion( $infraccionPago->id_infraccion,
                                         INFRACCION_PAGO_INCOMPLETO,
                                         $label_cuotas 
                                        );

                    $status="OK";
                    $message="El pago todavia esta incompleto";

                 }   

                 $status="OK";
                 $message="Estado de Pago de Infraccion en Cuota Actualizada";

                 
         

          }else{
            $status='ERROR';
             $message="No se pudo actualizar el estado de la cuota pagada";
             $url=null; 

          }
           
         
        }
      


       $json=array();
        $json=[
             "status"=>$status,
              "message"=>$message,
              "url"=>$url
              ] ;
        
        echo json_encode($json);
        
        return;
          

        }



    

    
    /**
      * Funcion que permite obtener informacion del 
      * del pago de la cuota junto con la url del
      * comprobante 
     **/
    public function get_pagocuota($idInfraccionPagoCuota){

        $infraccionPagoCuota = $this->infraccionpagocuota_model->getById($idInfraccionPagoCuota);
        $infraccionPago      = $this->infraccionpago_model->getById($infraccionPagoCuota->id_infraccion_pago);  
        $infraccion          = $this->infraccion_model->getById($infraccionPago->id_infraccion);
        

        $personal = null ;  
        if($infraccion!= null  && isset($infraccion)){

           $persona=$this->persona_model->getInformacion($infraccion->dni_involucrado);  
        }



        $data['id_infraccion_pago']=$infraccionPagoCuota->id_infraccion_pago;
        $data['numero_cuota']=$infraccionPagoCuota->numero_cuota;
        $data['numero_comprobante']=$infraccionPagoCuota->numero_comprobante;
        $data['estado']=$infraccionPagoCuota->estado;
        $data['idInfraccionPago']=$infraccionPagoCuota->id_infraccion_pago;
        $data['idInfraccionPagoCuota']=$infraccionPagoCuota->id_infraccion_pago_cuota;
        $data['importe']=$infraccionPagoCuota->importe;
        $data['fecha_pago']=$infraccionPagoCuota->fecha_pago;
        $data['hora_pago']=$infraccionPagoCuota->hora_pago;
        $data['numero_comprobante']=$infraccionPagoCuota->numero_comprobante;
        $data['nombre_apellido']  =$infraccionPagoCuota->nombre_apellido;
        $data['domicilio_representante'] =$infraccionPagoCuota->domicilio_representante;
        $data['dni_representante'] =$infraccionPagoCuota->dni_representante;
        $data['vinculo_representante'] = $infraccionPagoCuota->vinculo_representante;
        $data['importe_general'] = $infraccionPagoCuota->importe_general;
        $data['importe_alcoholemia'] = $infraccionPagoCuota->importe_alcoholemia;

        $data['url_comprobante']=  base_url().'infraccionpagocuota/generarComprobantePDF/'.$infraccionPagoCuota->id_infraccion_pago_cuota;


        $json=array();
        $json=[
              "status"=>"OK",
              "data"=>$data,
              "persona" => $persona
              ] ;
        
       echo json_encode($json);
    }



    
    //**********************************************
    //**** REFERIDO A PAGOS Y METODOS DE PAGOS 
    //**********************************************



    /**
      * Function que permite realizar el pago 
      * de una determinada cuota y determinar a partir 
      * de la cuota si se completo los pagos o no
     **/ 

     public function post_pagoCuota()
     {
      
        $json = json_decode(file_get_contents("php://input"));
        $infraccionPagoCuota=$this->infraccionpagocuota_model->getById($json->idInfraccionPagoCuota);
        //Obtenemos la infraccion de pago para indicar el estado del 
        //pago 
        $infraccionPago =$this->infraccionpago_model->getById($infraccionPagoCuota->id_infraccion_pago);


        //Redireccionamos a la pagina si se creo 
        //el registro correctamente, a la pagina de pagos 
        //por cuotas o pago en efectivo
        $status="";
        $message="";
        $url="";
        $bandPagoCuotas=false;
        $cantidadCuotas=0;

        //**************************************
        //** CREAMOS EL PAGO 
        $this->data['id_infraccion_pago_cuota'] = $json->idInfraccionPagoCuota;
        $this->data['id_infraccion_pago']=$infraccionPagoCuota->id_infraccion_pago;
        $this->data['fecha_pago'] =  date('Y-m-d');
        $this->data['hora_pago'] = date('H:i');
        $this->data['importe']  =$json->importe;
       
        $this->data['estado']=CUOTA_PAGADA;
        $this->data['numero_comprobante']=$json->comprobante;
        $this->data['numero_cuota']=$infraccionPagoCuota->numero_cuota;
        $this->data['nombre_apellido']    =  $infraccionPagoCuota->nombre_apellido;
        $this->data['dni_representante']  =  $infraccionPagoCuota->dni_representante;
        $this->data['domicilio_representante'] =  $infraccionPagoCuota->domicilio_representante;
        $this->data['vinculo_representante'] = $infraccionPagoCuota->vinculo_representante;
        $this->data['precio_uf'] =$infraccionPagoCuota->precio_uf;
        $this->data['valor_uf'] = $infraccionPagoCuota->valor_uf;
        

        //obtenemos el registro de pago
       // y actualizamos el estado a CUOTA_PAGADA

        $this->data['id'] = $this->infraccionpagocuota_model->update($this->data);
        
       
      //=============================================
      //===========================================
      //TIPO PAGO ES DE CONTADO      
        if($infraccionPago->tipo_pago==TIPO_PAGO_CONTADO){
          
          $cantidadCuotas       = $this->getCantidadCuotas($infraccionPago->id_infraccion_pago);
          $cantidadCuotaPagadas = $this->getNumeroCuotaPagas($infraccionPago->id_infraccion_pago);
          $cantidadCuotaNoPagas = $this->getNumeroCuotaImpagas($infraccionPago->id_infraccion_pago);
          $esPagoCompleto       = $this->isPagoCompleto($infraccionPago->id_infraccion_pago);
          $label_cuotas=$cantidadCuotaPagadas."-".$cantidadCuotas;

          if(isset($this->data['id'])){
            //Cambia el estado de la infraccion 
            //para indicar el estado a pago completo
            $this->infraccion_model->updateEstadoInfraccion
                                       ( $infraccionPago->id_infraccion,
                                         INFRACCION_PAGO_COMPLETO,
                                         $label_cuotas 
                                        );
           $status="OK";
           $message="Se actualizo el estado del pago en contado";

          }else{
            $status="ERROR";
            $message="No se pudo realizar el estado de pago contado";
          }
 
         
        }else{
          //===================================
          //====================================
          //========= TIPO PAGO ES EN CUOTA

           
            if(isset($this->data['id'])){
                $cantidadCuotas       = $this->getCantidadCuotas($infraccionPago->id_infraccion_pago);
                $cantidadCuotaPagadas = $this->getNumeroCuotaPagas($infraccionPago->id_infraccion_pago);
                $cantidadCuotaNoPagas = $this->getNumeroCuotaImpagas($infraccionPago->id_infraccion_pago);
                $esPagoCompleto       = $this->isPagoCompleto($infraccionPago->id_infraccion_pago);
                $label_cuotas=$cantidadCuotaPagadas."-".$cantidadCuotas;
                 
              
                if($esPagoCompleto){
                
                   //Cambia el estado de la infraccion 
                   //para indicar el estado a pago completo
                   $this->infraccion_model->updateEstadoInfraccion( $infraccionPago->id_infraccion,
                                         INFRACCION_PAGO_COMPLETO,
                                         $label_cuotas 
                                        );
                  
                   $status="OK";
                   $message="El pago se Completo Correctamente";

                 }else{
                       //Cambia el estado de la infraccion
                       //para indicar la cantidad de cuotas pagadas 
                       //hasta el momento
                        $this->infraccion_model->updateEstadoInfraccion( $infraccionPago->id_infraccion,
                                         INFRACCION_PAGO_INCOMPLETO,
                                         $label_cuotas 
                                        );

                    $status="OK";
                    $message="El pago todavia esta incompleto";

                 }   

                 $status="OK";
                 $message="Estado de Pago de Infraccion en Cuota Actualizada";

                 
         

          }else{
            $status='ERROR';
             $message="No se pudo actualizar el estado de la cuota pagada";
             $url=null; 

          }
           
         
        }


       $json=array();
        $json=[
             "status"=>$status,
              "message"=>$message,
              "url"=>$url
              ] ;
        
        echo json_encode($json);
        
        return;
     }

   

   /**
    * Funcion que permite obtener el 
    * numero de cuotas pagadas, pasando como 
    * parametros @idInfraccionPago
    **/
   private function getNumeroCuotaPagas($idInfraccionPago){
      $infraccionPago=$this->infraccionpago_model->getById($idInfraccionPago);
      
      //Obtenemos todas las cuotas para verificar en que estado se encuentran
      $infraccionPagoCuotas=$this->infraccionpagocuota_model->getByIdInfraccionPago($infraccionPago->id_infraccion_pago);
      $cantidadCuotaPagadas=0;
      foreach($infraccionPagoCuotas as $pagoCuota) {
              if($pagoCuota->estado==CUOTA_PAGADA){
                 $cantidadCuotaPagadas++;
              }
          }
      return $cantidadCuotaPagadas;  
   }

   /**
     * Funcion que permite obtener un 
     * numero de cantidad de cuotas 
     * impagas
    */
   public function getNumeroCuotaImpagas($idInfraccionPago){
      $infraccionPago=$this->infraccionpago_model->getById($idInfraccionPago);
      //Obtenemos todas las cuotas para verificar en que estado se encuentran
      $infraccionPagoCuotas=$this->infraccionpagocuota_model->getByIdInfraccionPago($infraccionPago->id_infraccion_pago);
      $cantidadCuotas=0;
      foreach($infraccionPagoCuotas as $pagoCuota) {
              if($pagoCuota->estado==CUOTA_NO_PAGADA){
                 $cantidadCuotas++;
              }
          }
      return $cantidadCuotas;  
   }





   /**
   * Funcion que permite verificar si el pago 
   * esta completo o no recorriendo la cantidad 
   * de cuotas pagadas
   **/
   private function isPagoCompleto($idInfraccionPago){
      
      $infraccionPago=$this->infraccionpago_model->getById($idInfraccionPago);
      //Obtenemos todas las cuotas para verificar en que estado se encuentran
      $infraccionPagoCuotas=$this->infraccionpagocuota_model->getByIdInfraccionPago($infraccionPago->id_infraccion_pago);
      
      $estaCompleto=true;
      foreach($infraccionPagoCuotas as $pagoCuota) {
              if($pagoCuota->estado==CUOTA_NO_PAGADA){
                 $estaCompleto=false;
              }
          }
      return $estaCompleto;  
   }

   /**
    * Funcion que permite obtener 
    * la cantidad de cuotas 
    * del pago
    */
   private function getCantidadCuotas($idInfraccionPago){
      $infraccionPago=$this->infraccionpago_model->getById($idInfraccionPago);
      //Obtenemos todas las cuotas para verificar en que estado se encuentran
      $infraccionPagoCuotas=$this->infraccionpagocuota_model->getByIdInfraccionPago($infraccionPago->id_infraccion_pago);
      $cantidadCuotas=0;
      foreach($infraccionPagoCuotas as $pagoCuota) {
         $cantidadCuotas++;
      }
      return $cantidadCuotas;  

   }






   

   /**
     * Funcion que permite generar el comprobante 
     * solamente guardando el numero de comprobante 
     * a realizar con el numero de pago 
     **/
   public function generarComprobanteCuota(){
        
          
        $json = json_decode(file_get_contents("php://input"));
        $this->data['id_infraccion_pago_cuota'] = $json->idInfraccionPagoCuota;
        $infraccionPagoCuota=$this->infraccionpagocuota_model->getById($json->idInfraccionPagoCuota);
      
    
        $this->data['id_infraccion_pago']=$json->idInfraccionPago;
        $this->data['id_infraccion_pago_cuota'] =$json->idInfraccionPagoCuota;
        $this->data['importe'] = $json->importe;
        $this->data['nombre_apellido'] =$json->nombreApellido;
        $this->data['cuil_representante'] =$json->dni;
        $this->data['dni_representante'] =$json->dni;
        $this->data['domicilio_representante'] =$json->domicilio;
        $this->data['vinculo_representante'] =$json->vinculo;
        $this->data['precio_uf'] =null;
        $this->data['valor_uf'] = null;
        
        //permite actualizar solamente el numero de comprobante 
        $this->data['id'] = $this->infraccionpagocuota_model->update_comprobante($this->data);
        
        $data['url_comprobante']=  base_url().'infraccionpagocuota/generarComprobantePDF/'.$json->idInfraccionPagoCuota;

        $json=array();
        $json=[
              "status"=>"OK",
              "data"=>$data
              ] ;
        
       echo json_encode($json);
        

   }


    /**
     * Funcion que permite generar el comprobante 
     * solamente guardando el numero de comprobante 
     * a realizar con el numero de pago 
     **/
   public function generarComprobanteContado(){
        
        $json = json_decode(file_get_contents("php://input"));
        $this->data['id_infraccion_pago_cuota'] = $json->idInfraccionPagoCuota;
        $infraccionPagoCuota=$this->infraccionpagocuota_model->getById($json->idInfraccionPagoCuota);
      
    
        $this->data['id_infraccion_pago']=$json->idInfraccionPago;
        $this->data['id_infraccion_pago_cuota'] =$json->idInfraccionPagoCuota;
        $this->data['nombre_apellido'] =$json->nombreApellido;
        $this->data['cuil_representante'] =$json->dni;
        $this->data['dni_representante'] =$json->dni;
        $this->data['domicilio_representante'] =$json->domicilio;
        $this->data['vinculo_representante'] =$json->vinculo;
        $this->data['importe_alcoholemia'] =$json->importeAlcoholemia;
        $this->data['importe_general'] = $json->importeGeneral;
    

        //permite actualizar solamente el numero de comprobante 
        $this->data['id'] = $this->infraccionpagocuota_model->update_comprobante($this->data);
        
        $data['url_comprobante']=  base_url().'infraccionpagocuota/generarComprobantePDF/'.$json->idInfraccionPagoCuota;

        $json=array();
        $json=[
              "status"=>"OK",
              "data"=>$data
              ] ;
        
       echo json_encode($json);
        

   }

    public function generarComprobantePDF1($idInfraccionPagoCuota) {
  
  ob_start();


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 049');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 049', PDF_HEADER_STRING);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
  require_once(dirname(__FILE__).'/lang/eng.php');
  $pdf->setLanguageArray($l);
}
// ---------------------------------------------------------
// set font
$pdf->SetFont('helvetica', '', 10);
// add a page
$pdf->AddPage();
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
IMPORTANT:
If you are printing user-generated content, tcpdf tag can be unsafe.
You can disable this tag by setting to false the K_TCPDF_CALLS_IN_HTML
constant on TCPDF configuration file.
For security reasons, the parameters for the 'params' attribute of TCPDF
tag must be prepared as an array and encoded with the
serializeTCPDFtagParameters() method (see the example below).
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
$html = '<h1>Test TCPDF Methods in HTML</h1>
<h2 style="color:red;">IMPORTANT:</h2>
<span style="color:red;">If you are using user-generated content, the tcpdf tag can be unsafe.<br />
You can disable this tag by setting to false the <b>K_TCPDF_CALLS_IN_HTML</b> constant on TCPDF configuration file.</span>
<h2>write1DBarcode method in HTML</h2>';
$params = $pdf->serializeTCPDFtagParameters(array('CODE 39', 'C39', '', '', 80, 30, 0.4, array('position'=>'S', 'border'=>true, 'padding'=>4, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>8, 'stretchtext'=>4), 'N'));
$html .= '<tcpdf method="write1DBarcode" params="'.$params.'" />';
$params = $pdf->serializeTCPDFtagParameters(array('CODE 128', 'C128', '', '', 80, 30, 0.4, array('position'=>'S', 'border'=>true, 'padding'=>4, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>8, 'stretchtext'=>4), 'N'));
$html .= '<tcpdf method="write1DBarcode" params="'.$params.'" />';
$html .= '<tcpdf method="AddPage" /><h2>Graphic Functions</h2>';
$params = $pdf->serializeTCPDFtagParameters(array(0));
$html .= '<tcpdf method="SetDrawColor" params="'.$params.'" />';
$params = $pdf->serializeTCPDFtagParameters(array(50, 50, 40, 10, 'DF', array(), array(0,128,255)));
$html .= '<tcpdf method="Rect" params="'.$params.'" />';
// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0);
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// reset pointer to the last page
$pdf->lastPage();
// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output('example_049.pdf', 'I');
ob_end_flush(); 

  
    }


    /**
     * Funcion que permite generar 
     * el comprobante : contado o cuota.
     * Son diferente tipos de comprobantes segun 
     * el tipo de pago
     **/
   public function generarComprobantePDF($idInfraccionPagoCuota){

        $infraccionPagoCuota=$this->infraccionpagocuota_model->getById($idInfraccionPagoCuota);
       
        //Obtenemos la informacion
        //de la infraccion de pago - para verificar que tipo 
        //de pago es
        $infraccionPago=null;
        $infraccion=null;
        if(isset($infraccionPagoCuota)){
           $infraccionPago=$this->infraccionpago_model->getById($infraccionPagoCuota->id_infraccion_pago);
        }

        //Se verifica con que tipo_pago se realizo 
        //para mostrar que comprobante a generar
        if($infraccionPago->tipo_pago=='TIPO_PAGO_CONTADO'){
            $this->comprobantecontado->getComprobante($idInfraccionPagoCuota,$this->session->userdata('nombre'));
        }else{
            $this->comprobantecuota->getComprobante($idInfraccionPagoCuota,$this->session->userdata('nombre'));
        }

        
   }



 

 }
?>