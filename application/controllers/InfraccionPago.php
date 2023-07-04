
<?php


    /**
      ***************************
      * Clase correspondiente a 
      * los pagos de las infracciones
      * @dathe  : 05-12-2017
      * @author : dgarcia
      **/ 
   class Infraccionpago extends MY_Controller{


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
       

        //modal de leyes 
        $this->load->model('ley_model');
        //estado 
        $this->load->model('estado_model');

        $this->load->model('infraccion_model');
        $this->load->model('infraccionpago_model');
        $this->load->model('infraccionpagocuota_model');
        $this->load->model('infraccionley_model');
        $this->load->model('tipotramite_model');
        $this->load->model('configuracion_model');
        $this->load->model('valor_model');
        $this->load->model('personatemporal_model');


    } 
 

    /**
     *  Index
     */
   	public function index($idInfraccion){
       if ($this->ion_auth->logged_in()) {
         
       	    
            $this->data['contenido'] = "vial/index_pago.php";
            $this->data['titulo']="Infracciones / Pago";
            $this->data['subtitulo']="Detalles del Pago de la Infracción";
            $this->data['valores'] = $this->valor_model->get_all();
            $total_importes = 0;
            
            // infraccion
            $infraccion = $this->infraccion_model->getById($idInfraccion);
            
            // Configuracion
            $configuracion=$this->configuracion_model->getByName('LEY'); 
            
            $leyesAlcoholemias = [];
            $leyesGenerales = []; 

            // Obtenemos las leyes de alcoholemia 
            $tipoTramite = $this->tipotramite_model->getByAcronimo(LEY_ALCOHOLEMIA);

            $this->data['cant_unidad_alcoholemia'] = 0;
            $this->data['importe_alcoholemia'] = 0;

             
            $valor_unidad = 0;
            foreach ($this->data['valores'] as $key => $value) {
               if($value->estado == 1 ) {
                $valor_unidad = $value->valor;
               }
            }

              

            if ( $tipoTramite != null ){
               $leyesAlcoholemias = $this->infraccionley_model->getByIdInfraccion($idInfraccion ,$tipoTramite->id_tipo_tramite);
               $this->data['cant_unidad_alcoholemia'] = $this->calcularUnidad($leyesAlcoholemias);
               
               if($valor_unidad != null &&  isset($valor_unidad)) {
                   $valor = floatval($valor_unidad);
                   if( $valor != null) {
                      $this->data['importe_alcoholemia'] = $valor * $this->data['cant_unidad_alcoholemia'];
                    }
               }
            } 
           

            //Obtenemos las leyes de manera general  
            $tipoTramite = $this->tipotramite_model->getByAcronimo(LEY_GENERAL);

            $this->data['cant_unidad_general'] = 0;
            $this->data['importe_general'] = 0;
            if ( $tipoTramite != null ){
                $leyesGenerales = $this->infraccionley_model->getByIdInfraccion($idInfraccion , $tipoTramite->id_tipo_tramite);
                $this->data['cant_unidad_general'] = $this->calcularUnidad($leyesGenerales);

               if($valor_unidad != null &&  isset($valor_unidad)) {
                   $valor = floatval($valor_unidad);
                   if( $valor != null) {
                       $this->data['importe_general'] = $valor * $this->data['cant_unidad_general'];
                    }
               }
            }
           
            // Calculamos el importe general 
            $total_importes = $this->data['importe_alcoholemia'] + $this->data['importe_general'];
            $this->data['importe_total'] = $total_importes;
            
            //------------------------------
            //Obtenemos datos del infractor 
            $infractor="";
            $reincidente = false;
          
            $bandInfraccion = isset($infraccion);
            $bandEstablecerInvoucrado = isset($infraccion->persona_establecer_involucrado);

            if(isset($infraccion) && isset($infraccion->dni_involucrado)){
              $infractor=$this->persona_model->getInformacion($infraccion->dni_involucrado);
            } else if($bandInfraccion && $bandEstablecerInvoucrado) {
              $infractor = $this->personatemporal_model->getPersona($infraccion->id_infraccion , 'involucrado'); 
            } else {
            }
            // buscamos las infracciones del 
            // infractor si tiene 
            $infracciones = "";
            if ($infractor != null && $infractor != "" ){
                //Verificamos si el infractor es reincidente 
                $filter['dni']= $infractor->dni;
                $filter['numero_acta'] = null;
                $filter['actual'] = null;
                $filter['fecha_desde'] = null;
                $filter['fecha_hasta'] = null;
                $filter['dominio'] = null ;
                $filter['estado_pago'] = null;

                $infracciones = $this->infraccion_model->buscar($filter);
            }     
             

            $observacionesInfractor = "";
            if ($infracciones != null && sizeof($infracciones) > 1 ){
               $observacionesInfractor = "El infractor es reincidente";
               $reincidente =  true;
            } else {
               $observacionesInfractor = "El infractor no es reincidente";
            }

            $this->data['valor_unidad'] = $valor_unidad;
            $this->data['infraccion']=$infraccion;
            $this->data['idInfraccion']=$idInfraccion;
            $this->data['infractor']=$infractor;
            $this->data['reincidente'] = $reincidente;
            $this->data['observacionesInfractor'] = $observacionesInfractor;
            $this->data['infracciones'] =  $infracciones;
            $this->data['leyesAlcoholemia'] = $leyesAlcoholemias;
            $this->data['leyesGeneral'] = $leyesGenerales;
            $this->data['configuracion'] = $configuracion; 
            $this->load->view('template', $this->data);
        } else {
            redirect('admin/login');
        }
   

   	}


     /**
     **/
     function post_tabla(){
       
       $json = json_decode(file_get_contents("php://input"));
       $idInfraccion = $json->idInfraccion;
       // infraccion
       $infraccion = $this->infraccion_model->getById($idInfraccion);
       $valor_unidad = $json->valorUnidad;
       // Configuracion
       $configuracion=$this->configuracion_model->getByName('LEY'); 
       // Obtenemos las leyes de alcoholemia 
       $tipoTramite = $this->tipotramite_model->getByAcronimo(LEY_ALCOHOLEMIA);
       $cant_unidad_alcoholemia = 0;
       $importe_alcoholemia = 0;
       
       if ( $tipoTramite != null ){
               $leyesAlcoholemias = $this->infraccionley_model->getByIdInfraccion($idInfraccion ,$tipoTramite->id_tipo_tramite);
               $cant_unidad_alcoholemia = $this->calcularUnidad($leyesAlcoholemias);
               
               if($valor_unidad != null &&  isset($valor_unidad)) {
                   $valor = floatval($valor_unidad);
                   if( $valor != null) {
                      $importe_alcoholemia = $valor * $cant_unidad_alcoholemia;
                    }
               }
        } 
           

       // ---------------------------------------- 
       //Obtenemos las leyes de manera general  
       $tipoTramite = $this->tipotramite_model->getByAcronimo(LEY_GENERAL);

       $cant_unidad_general = 0;
       $importe_general = 0;
       if ( $tipoTramite != null ){
            $leyesGenerales = $this->infraccionley_model->getByIdInfraccion($idInfraccion , $tipoTramite->id_tipo_tramite);
            $cant_unidad_general = $this->calcularUnidad($leyesGenerales);
            if($valor_unidad != null &&  isset($valor_unidad)) {
                $valor = floatval($valor_unidad);
                   if( $valor != null) {
                       $importe_general = $valor * $cant_unidad_general;
                    }
               }
        }

       $importe_total = $importe_general + $importe_alcoholemia;


      $row_importe =   
               '<tr>'.
               '<td><strong> Alcoholemia</strong></td>'.
               '<td> <div class="text-center">'.
               '<strong>$'.$importe_alcoholemia.'</strong>'.
               '</div>'.
               '<input type="hidden" id="importe_alcoholemia" name="importe_alcoholemia" class="form-control" readonly="true" value="'.$importe_alcoholemia.'">'.
               '</td>'.
               '<td>'.
               '<div class="form-group" id="porcentajeDescuentoAlcoholemia-div">'.
               '<select class="form-control select2 requerido" data-toggle="tooltip" id="porcentajeDescuentoAlcoholemia" name="porcentajeDescuentoAlcoholemia" 
                 onchange=module_pago.aplicarPorcentaje("ALCOHOLEMIA") tabindex="-1" aria-hidden="true"> 
                <option value="">Seleccionar</option>
                <option value="0">0 % </option>
                <option value="50">50 % </option> 
                <option value="75">75 % </option> 
               </select>'.
               '<span class="span_none" id="porcentajeDescuentoAlcoholemia-error" style="display: none;">Seleccionar</span>'.
               '</div>'.
               '</td>'.
               '<td>'.
               '<button type="button" class="btn btn-success form-control" onclick=module_pago.aplicarPorcentaje("ALCOHOLEMIA") id="btnCalcularPorcentaje">Aplicar Porcentaje
                </button>
               </td>
               <td><input type="text" id="importe_descuento_alcoholemia" name="importe_descuento_alcoholemia" class="form-control" readonly="true" value="'.$importe_alcoholemia.'">
               </td>
                </tr>
               
               <!-- leyes generales -->
               <tr>
               <td><strong> Leyes Generales </strong></td>
               <td><div class="text-center"><strong>$ '.$importe_general.'</strong></div> 
               <input type="hidden" id="importe_general" name="importe_general" class="form-control" readonly="true" value="'.$importe_general.'">
               </td>
                <td>
                <div class="form-group" id="porcentajeDescuentoGeneral-div">
                <select class="form-control select2 requerido" data-toggle="tooltip" id="porcentajeDescuentoGeneral" name="porcentajeDescuentoGeneral" 
                  onchange=module_pago.aplicarPorcentaje("GENERAL") tabindex="-1" aria-hidden="true"> 
                <option value="">Seleccionar</option>
                <option value="0">0 % </option>
                <option value="50">50 % </option> 
                <option value="75">75 % </option> 
                </select>  
                <span class="span_none" id="porcentajeDescuentoGeneral-error" style="display: none;">Seleccionar</span>
               </div>
               </td>
               <td>
               <button type="button" class="btn btn-success form-control" onclick=module_pago.aplicarPorcentaje("GENERAL") id="btnCalcularPorcentaje">
                 Aplicar  Porcentaje
               </button>
               </td>
               <td>
               <input type="text" id="importe_descuento_general" name="importe_descuento_general" class="form-control" readonly="true" value="'.$importe_general.'">
               </td>
               </tr>';

     $row_total = '<tr><th>Totales</th>
                  <th><div class="text-center"><strong>$'.$importe_total.'</strong></div>
                 <input type="hidden" id="importe_total" name="importe_total" readonly="true" value="'.$importe_total.'"></th>
                 <th></th>
                 <th>Totales</th>
                 <th><div class="text-center">
                 <strong>
                 <input type="text" id="importe_descuento_total" name="importe_descuento_total" readonly="true" value="'.$importe_total.'">
                 </strong>
                 </div>
                 </th></tr>';

        
      $json=array();
      $json=[
              "importe"=>$row_importe,
              "total"=>$row_total
            ] ;
        
       echo json_encode($json);
       return;
      
    }


    


   
    /**
     * Permite calcular la cantidad de unidad por registros
    **/
    private function calcularUnidad($leyes) {
       $cantidad = 0;
       if($leyes != null && sizeof($leyes)) {
          foreach ($leyes as $key) {
             $cantidad = $cantidad + $key->unidad;
          }
          
       }      
       return $cantidad;
    }


     /**
    * Funcion que permite guardar la informacion 
    * del pago a crear,cambiando el estado del 
    * pago
    **/
    public function guardar(){
        
        $idInfraccion = $this->input->post('idInfraccion');
        $infraccion = $this->infraccion_model->getById($idInfraccion);
        
        // id infraccion pago 
        $data['id'] = $this->input->post('id');
        
        // Importe General
        $data['importe_general'] = $this->input->post('importe_general');
        $data['importe_descuento_general'] = $this->input->post('importe_descuento_general');
        $data['porcentaje_descuento_general']     = $this->input->post('porcentajeDescuentoGeneral');
        
        // Importe Alcoholemia 
        $data['importe_alcoholemia'] = $this->input->post('importe_alcoholemia');
        $data['importe_descuento_alcoholemia'] = $this->input->post('importe_descuento_alcoholemia');
        $data['porcentaje_descuento_alcoholemia'] = $this->input->post('porcentajeDescuentoAlcoholemia');
        

        $data['id_infraccion'] = $idInfraccion;
        $data['fecha'] =  date('Y-m-d');
        $data['hora']  =  date('H:i');
        $data['tipo_pago'] = $this->input->post('tipo_pago');
        $cant_cuotas=$this->input->post('cant_cuotas');

        // configuracion valor unidad 
        $configuracion=$this->configuracion_model->getByName('LEY');


        if(empty($cant_cuotas)){
          $data['cant_cuotas'] =1;
        }else{
          $data['cant_cuotas']=$cant_cuotas; 
        }


        $data['valor_unidad'] = $this->input->post('valor_unidad');
        $this->data['id'] = $this->infraccionpago_model->insert($data);  

        
        //Redireccionamos a la pagina si se creo 
        //el registro correctamente, a la pagina de pagos 
        //por cuotas o pago en efectivo
        $status="";
        $message="";
        $url="";
        $bandPagoCuotas=false;
        

        $year = substr(date('Y') , -2 );
        if(isset($this->data['id'])){
          
          //Se debe crear si el pago es de contado 
          //o es de tipo en cuotas 
          //se debe generar la cantida de registros a pagar 
          if($data['tipo_pago']==TIPO_PAGO_CONTADO){
            
             //datos para guardar la informacion 
             //en cuota de contado  
             $datos=[];
             $datos['id_infraccion_pago']=$this->data['id'];
             $datos['numero_cuota']="1"; 
             $datos['fecha_pago'] = null;
             $datos['hora_pago']=null;
             $datos['importe_general']=$data['importe_descuento_general'];
             $datos['importe_alcoholemia'] = $data['importe_descuento_alcoholemia'];
             $datos['estado']=CUOTA_NO_PAGADA;
             $datos['id_infraccion'] =$idInfraccion;
             $datos['comprobante']  = $infraccion->numero_acta.'01'.$year;               
             //Guardamos en el registro de infracciones de pago
             //solamente en una cuota porque es de contado 
             $idPagoCuota=$this->infraccionpagocuota_model->insert($datos);
             if(isset($idPagoCuota) && $idPagoCuota>0){
               $bandPagoCuotas=true;
              } else{
                $bandPagoCuotas=false;
              }
          
          }else if($data['tipo_pago']==TIPO_PAGO_CUOTAS){
             
             $precio_cuota = 0;

             $cuotasGeneral = $this->calcularImporteCuota($data['importe_descuento_general'] , $cant_cuotas);
             $cuotasAlcoholemia = $this->calcularImporteCuota($data['importe_descuento_alcoholemia'] ,$cant_cuotas);
             
             //Generamos la cantidad de cuotas seleccionadas
             for($i=0 ;  $i< $data['cant_cuotas'] ; $i++){
              
              $datos=[];
              $datos['id_infraccion_pago']=$this->data['id'];
              $datos['numero_cuota']=$i + 1 ;
              $datos['fecha_pago']="";
              $datos['hora_pago']="";
              $datos['importe_general']     = floatval($cuotasGeneral[$i]);

              $datos['importe_alcoholemia'] = floatval($cuotasAlcoholemia[$i]); 
              $datos['estado']=CUOTA_NO_PAGADA;
              $datos['id_infraccion'] = $idInfraccion;
              $datos['comprobante']  = $infraccion->numero_acta.'0'.$datos['numero_cuota'].$year;               

              

              $idPagoCuota=$this->infraccionpagocuota_model->insert($datos);
              if(isset($idPagoCuota) && $idPagoCuota>0){
                 $bandPagoCuotas=true;
              } else{
                $bandPagoCuotas=false;
                break;
              }
            }

          } else if ($data['tipo_pago']==TIPO_PAGO_TARJETA) {
               //datos para guardar la informacion 
             //en cuota de tarjeta siempre es solamente uno  
             $datos=[];
             $datos['id_infraccion_pago']=$this->data['id'];
             $datos['numero_cuota']="1"; 
             $datos['fecha_pago'] = null;
             $datos['hora_pago']=null;
             $datos['importe_general']=$data['importe_descuento_general'];
             $datos['importe_alcoholemia'] = $data['importe_descuento_alcoholemia'];
             $datos['estado']=CUOTA_NO_PAGADA;
             $datos['id_infraccion'] =$idInfraccion;
             $datos['comprobante']  = $infraccion->numero_acta.'01'.$year;               
             //Guardamos en el registro de infracciones de pago
             //solamente en una cuota porque es de contado 
             $idPagoCuota=$this->infraccionpagocuota_model->insert($datos);
             if(isset($idPagoCuota) && $idPagoCuota>0){
               $bandPagoCuotas=true;
              } else{
                $bandPagoCuotas=false;
              }
          }

          //Verifico que se crearon la cantidad de cuotas a pagar 
          if($bandPagoCuotas){
             
            if(empty($data['cant_cuotas'])){
               $label_cuotas="0 - 1";
            } else{
                $label_cuotas="0 - ".$data['cant_cuotas'];
            }


            //Cambia el estado de la infraccion 
            //para indicar el estado a pago incompleto
            $this->infraccion_model->updateEstadoInfraccion
                                       ( $data['id_infraccion'],
                                         INFRACCION_PAGO_INCOMPLETO,
                                         $label_cuotas 
                                        );

            $status='OK';
            $message="Se creo el Pago y la cantidad de Cuotas a Pagar";
            $url=base_url().'infraccionpago/index/'.$this->data['id'];
          }else{
             $status='ERROR';
             $message="No se pudo crearla cantidad de cuotas a Pagar";
             $url=null; 
          }

          
          //redirect($urlPagos);
        }else{
          $status="ERROR";
          $message="No se pudo crear el método de Pago";
          $url=null;
           
        }

         
       $this->data['contenido'] = "vial/index_pago.php";
       $this->data['titulo']="Infracciones / Pago";
       $this->data['subtitulo']="Detalles del Pago de la Infracción";

       if ( $status == "OK") {
          redirect('infraccionpagocuota/index/'.$idInfraccion);
       } {
       
        $this->data['error'] = "Se produjo un error al generar el pago";
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




    private function calcularImporteCuota($importe , $cantCuotas) {
      $importes = [];
      
      if ( isset($importe) && $importe > 0 ) {
          if ($importe  > $cantCuotas) {
              
              $importeCuota = $importe / $cantCuotas;
              $importeCuotaRound = round($importeCuota);
              //Generamos un importe total incrementado 
              //para sacar la difernecia de cuanto restar
              $importeTotal  = $importeCuotaRound * $cantCuotas;
              $diferencia = $importeTotal - $importe;
              //Obtenemos la diferencia para descontar de la primera 
              //cuota
              $valorCuota1 = $importeCuotaRound - $diferencia;
              //las restantes cuotas se toman como los valores 
              //de las cuotas 
              $importes[] = $valorCuota1;
              for ($i=1; $i < $cantCuotas ; $i++) { 
                  $importes[] = $importeCuotaRound;
              }


          } else {
           
              $importes[] = $importe;
              for($i=0; $i<$cantCuotas;$i++){
                $importes[] = 0;
              }
          }  
      }else {
       
            
              for($i=0; $i<$cantCuotas;$i++){
                $importes[] = 0;
              }
      }  

      return $importes;
    }



    
    //**********************************************
    //**** REFERIDO A PAGOS Y METODOS DE PAGOS 
    //**********************************************


   public function delete_pago($idInfraccionPago){
    
      //Obtenemos todos los elementos de pago cuotas
      $infraccionPagoCuotas =$this->infraccionpagocuota_model->getByIdInfraccionPago($idInfraccionPago);
   
      if(isset($infraccionPagoCuotas)){
        foreach ($infraccionPagoCuotas as $key => $value) {
          $this->infraccionpagocuota_model->delete($value->id);
        }
      }

      $infraccionPago = $this->infraccionpago_model->getById($idInfraccionPago);
      //Actualizamos la infraccion estableciendo al estado 
      $id = $this->infraccion_model->updateEstadoInfraccion
                                       ( $infraccionPago->id_infraccion,
                                         "",
                                         "");  


       //Delete infraccion 
       $this->infraccionpago_model->delete($idInfraccionPago);                                

        $json=array();
        $json=[  "status"=>"OK"
              ] ;
        
       echo json_encode($json);
       return;

   }
    
  

     
    /**
      * Function que permite realizar el pago 
      * de una determinada cuota y determinar a partir 
      * de la cuota si se completo los pagos o no
     **/ 

     public function post_pagoCuota(){
      
        $json = json_decode(file_get_contents("php://input"));
        $this->data['id_infraccion_pago_cuota'] = $json->idInfraccionPagoCuota;
        $infraccionPagoCuota=$this->infraccionpagocuota_model->getById($json->idInfraccionPagoCuota);

        $this->data['id_infraccion_pago']=$infraccionPagoCuota->id_infraccion_pago;
        $this->data['fecha_pago'] =  date('Y-m-d');
        $this->data['hora_pago'] = date('H:i');
        $this->data['numero_cuota']=$infraccionPagoCuota->numero_cuota;
        $this->data['estado']=CUOTA_PAGADA;
        

        //obtenemos el registro de pago
        $this->data['id'] = $this->infraccionpagocuota_model->update($this->data);
        
        //Redireccionamos a la pagina si se creo 
        //el registro correctamente, a la pagina de pagos 
        //por cuotas o pago en efectivo
        $status="";
        $message="";
        $url="";
        $bandPagoCuotas=false;
        $cantidadCuotas=0;

        if(isset($this->data['id'])){
          //se pudo crear el pago de la cuota 
          //se debe verificar si el numero de cuota coincide 
          //con la cantidad de cuotas del tipo de pago 
          $infraccionPago=$this->infraccionpago_model->getById($this->data['id_infraccion_pago']);
          
          //Obtenemos todas las cuotas para verificar en que estado se encuentran
          $infraccionPagoCuotas=$this->infraccionpagocuota_model->getByIdInfraccionPago($infraccionPago->id_infraccion_pago);
          
          $cantidadCuotaPagadas=0;
          foreach($infraccionPagoCuotas as $pagoCuota) {
              if($pagoCuota->estado==CUOTA_PAGADA){
                 $cantidadCuotaPagadas++;
              }
          }

          $label_cuotas=$this->data['numero_cuota']."-".$cantidadCuotaPagadas;


          //Las cuotas son iguales entonces estan pagadas 
          if($infraccionPago->cant_cuotas==$cantidadCuotaPagadas){
            
           //Cambia el estado de la infraccion 
           //para indicar el estado a pago completo
           $this->infraccion_model->updateEstadoInfraccion
                                       ( $infraccionPago->id_infraccion,
                                         INFRACCION_PAGO_COMPLETO,
                                         $label_cuotas 
                                        );
          
          }else{
           
           //Cambia el estado de la infraccion
           //para indicar la cantidad de cuotas pagadas 
           //hasta el momento
           $this->infraccion_model->updateEstadoInfraccion
                                       ( $infraccionPago->id_infraccion,
                                         INFRACCION_PAGO_INCOMPLETO,
                                         $label_cuotas 
                                        );


          }

            $status='OK';
            $message="Se actualizo el estado de la cuota pagada";
        }else{
             $status='ERROR';
             $message="No se pudo actualizar el estado de la cuota pagada";
             $url=null; 
        }


        $json=array();
        $json=[
             "status"=>$status,
              "message"=>$message,
              "url"=>$url
              ] ;
        
       echo json_encode($json);
       //return;
     }

   

 }
?>