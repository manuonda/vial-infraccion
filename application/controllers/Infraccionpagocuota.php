
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
        
        $this->load->library('comprobante');

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
        $this->load->model('personatemporal_model');
        $this->load->model('tipotarjeta_model');
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
            $bandInfraccion = isset($infraccion);
            $bandEstablecerInvoucrado = isset($infraccion->persona_establecer_involucrado);

            if(isset($infraccion) && isset($infraccion->dni_involucrado)){
              $involucrado=$this->persona_model->getInformacion($infraccion->dni_involucrado);
            } else if($bandInfraccion && $bandEstablecerInvoucrado) {
              $involucrado = $this->personatemporal_model->getPersona($infraccion->id_infraccion , 'involucrado'); 
            } else {
              var_dump("no es ninguno");
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
            }




            $this->data['infraccion']=$infraccion;
            $this->data['infraccionPago']=$infraccionPago;
            $this->data['involucrado']=$involucrado;
            $this->data['pagos']=$pagos;
            $this->data['tipotarjetas'] = $this->tipotarjeta_model->get_all();
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
        $this->data['fecha_pago'] = null ;
        $this->data['hora_pago'] = null;
        $this->data['estado']=CUOTA_NO_PAGADA;
        

        //obtenemos el registro de pago
       // y actualizamos el estado a CUOTA_PAGADA

        $this->data['id'] = $this->infraccionpagocuota_model->update_pago($this->data);
        
       
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
        
        //------------------------------
        //Obtenemos datos del involucrado 
        $involucrado="";
        $bandInfraccion = isset($infraccion);
        $bandEstablecerInvoucrado = isset($infraccion->persona_establecer_involucrado);
    
        $involucrado = null ;  
        if($infraccion!= null  && isset($infraccion)){
           if(isset($infraccion) && isset($infraccion->dni_involucrado)){
              $involucrado=$this->persona_model->getInformacion($infraccion->dni_involucrado);
            } else if($bandInfraccion && $bandEstablecerInvoucrado) {
              $involucrado = $this->personatemporal_model->getPersona($infraccion->id_infraccion , 'involucrado'); 
            } else {
              var_dump("no es ninguno");
            } 
        }

        $data['id_infraccion_pago']=$infraccionPagoCuota->id_infraccion_pago;
        $data['numero_cuota']=$infraccionPagoCuota->numero_cuota;
       $data['numero_comprobante']=$infraccionPagoCuota->comprobante;


        $data['estado']=$infraccionPagoCuota->estado;
        $data['idInfraccionPago']=$infraccionPagoCuota->id_infraccion_pago;
        $data['idInfraccionPagoCuota']=$infraccionPagoCuota->id_infraccion_pago_cuota;

        $data['fecha_pago']=$infraccionPagoCuota->fecha_pago;
        $data['hora_pago']=$infraccionPagoCuota->hora_pago;


        $data['numero_comprobante']=$infraccionPagoCuota->comprobante;
        $data['nombre_apellido']  =$infraccionPagoCuota->nombre_apellido;
        $data['domicilio_representante'] =$infraccionPagoCuota->domicilio_representante;
        $data['dni_representante'] =$infraccionPagoCuota->dni_representante;
        $data['vinculo_representante'] = $infraccionPagoCuota->vinculo_representante;
        $data['importe_general'] = $infraccionPagoCuota->importe_general;
        $data['importe_alcoholemia'] = $infraccionPagoCuota->importe_alcoholemia;
        $data['comprobante'] =$infraccionPagoCuota->comprobante;



        $total = 0;
        if ( isset($infraccionPagoCuota->importe_general) && $infraccionPagoCuota->importe_general != '') {
          $total = $total + floatval($infraccionPagoCuota->importe_general);
        } else {
          $total = $total + 0;
        }

        if ( isset($infraccionPagoCuota->importe_alcoholemia) && $infraccionPagoCuota->importe_alcoholemia != '') {
           $total = $total + floatval($infraccionPagoCuota->importe_alcoholemia);
        } else {
          $total = $total + 0;
        }

        $data['total'] = $total;

        $data['url_comprobante']=  base_url().'infraccionpagocuota/generarComprobantePDF/'.$infraccionPagoCuota->id_infraccion_pago_cuota;


        $json=array();
        $json=[
              "status"=>"OK",
              "data"=>$data,
              "persona" => $involucrado
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
        $comprobante = $json->comprobante;

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
        $this->data['estado']=CUOTA_PAGADA;
        $this->data['comprobante_policia'] = $comprobante;
        $this->data['comprobante_pago_alcoholemia'] = $json->comprobante_alcoholemia;
        $this->data['comprobante_pago_general']     = $json->comprobante_general;
        $this->data['tipo_pago']                    = $json->tipo_pago;
        $this->data['numero_compra']                = $json->numero_compra;
        $this->data['digito_factura']               = $json->digito_factura;
        $this->data['numero_factura']               = $json->numero_factura;  
        $this->data['comprobante_banco']            = $json->comprobante_banco;
        $this->data['tipo_tarjeta']                 = $json->tipo_tarjeta; 
        
 
        //obtenemos el registro de pago
       // y actualizamos el estado a CUOTA_PAGADA
        $this->data['id'] = $this->infraccionpagocuota_model->update_pago($this->data);

        
       
      //==============================================================================
      //==============================================================================
      //TIPO PAGO ES DE CONTADO  O DE TARJETA DEBIDO A QUE SI ES DE CREDITO O 
      //DE DEBITO ES LA TARJETA QUIEN SE HACE CARGO DEL PAGO    
        if($infraccionPago->tipo_pago==TIPO_PAGO_CONTADO  || $infraccionPago->tipo_pago==TIPO_PAGO_TARJETA){
          
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
          //=============================================
          //=============================================
          // TIPO PAGO ES EN CUOTA PORQUE ES COMO UN CREDITO PERSONAL
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




   // ==================================================
   // GENERACION DE COMPROBANTE PDF 
   // ==================================================


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
            $this->comprobante->getComprobante($idInfraccionPagoCuota,$this->session->userdata('nombre'));
        }else{
            //$this->comprobantecuota->getComprobante($idInfraccionPagoCuota,$this->session->userdata('nombre'));
            $this->comprobante->getComprobante($idInfraccionPagoCuota,$this->session->userdata('nombre'));

        }

        
   }

 }
?>