
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


    } 
 

    /**
     *  Index
     */
   	public function index($idInfraccionPago){
       if ($this->ion_auth->logged_in()) {
         
       	    
            $this->data['contenido'] = "vial/index_detalle_pago.php";
            $this->data['titulo']="Infracciones / Pagos";
            $this->data['subtitulo']="Detalles del Pago de la Infracción";

            //Obtenemos datos del pago 
            $infraccionPago=$this->infraccionpago_model->getById($idInfraccionPago);
            
            //Obtenemos datos de la infraccion
            $infraccion="";
            if(isset($infraccionPago)){
               $infraccion=$this->infraccion_model->getById($infraccionPago->id_infraccion);
            }
            
            //------------------------------
            //Obtenemos datos del infractor 
            $infractor="";
            if(isset($infraccion)){
              $infractor=$this->persona_model->getInformacion($infraccion->dni_involucrado);
            } 
              

            //********************************************

            $marca=null;
            $modelo=null;
            $tipovehiculo=null;
            //Datos del vehiculo 
            if($infraccion->id_modelo!=null){
              $modelo=$this->modelo_model->getById($infraccion->id_modelo);
              if($modelo!=null){
               $marca=$this->marca_model->getById($modelo->id_marca);
              }

              if($marca!=null){
                  $tipovehiculo=$this->tipovehiculo_model->getById($marca->id_tipovehiculo);
              }
            }


   
            
              $this->data['tipovehiculo']=$tipovehiculo;
              $this->data['marca']=$marca;
              $this->data['modelo']=$modelo;
          

            //Obtenemos los pagos de la infraccion 
            $pagos="";
            if(isset($infraccionPago)){
               $pagos=$this->infraccionpagocuota_model->getByIdInfraccionPago($infraccionPago->id_infraccion_pago);
            }


            //Importe con descuento 
            $importeDescuento=0;
            
            $importeDescuento =$infraccionPago->importe - ($infraccionPago->importe * $infraccionPago->porcentaje_descuento);

            $this->data['infraccion']=$infraccion;
            $this->data['infraccionPago']=$infraccionPago;
            $this->data['infractor']=$infractor;
            $this->data['pagos']=$pagos;
            $this->data['importeDescuento']=$importeDescuento;

            //$this->data['infracciones']=$this->infraccion_model->buscar($filter);
            //$this->data['departamentos']=$this->departamento_model->get_all(9); //provincia de jujuy = 9
            $this->load->view('template', $this->data);
        } else {
            redirect('admin/login');
        }
   

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
                                         "INFRACCION_PAGO_NO_GENERADO",
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
    * Funcion que permite guardar la informacion 
    * del pago a crear,cambiando el estado del 
    * pago
    **/
    public function post_generarpago(){
    
        $json = json_decode(file_get_contents("php://input"));
        $this->data['id_infraccion'] = $json->idInfraccion;
        $this->data['fecha'] =  date('Y-m-d');
        $this->data['hora'] = date('H:i');;
        $this->data['tipo_pago'] = $json->tipo_pago;
        $this->data['porcentaje_descuento']=$json->porcentaje_descuento;
        $cant_cuotas=$json->cant_cuotas;
        if(empty($cant_cuotas)){
          $this->data['cant_cuotas'] =1;
        }else{
          $this->data['cant_cuotas']=$cant_cuotas; 
        }

        $importe_reduccion = 0;
        if(!empty($json->importe)){
            $importe_reduccion = $json->importe  - ($json->importe * 50) /100;
        }



        $this->data['importe']=$json->importe;
        $this->data['importe_reduccion'] =$importe_reduccion;
        $this->data['porcentaje_descuento']=$json->porcentaje_descuento;
        $this->data['numero_operacion']="Operacion1"; //se debe crear una funcion para obtener un numero de operacion
                                                      //o a traves de una secuencia con una letra 
        //obtenemos el registro de pago
        $this->data['id'] = $this->infraccionpago_model->insert($this->data);
        
        //Redireccionamos a la pagina si se creo 
        //el registro correctamente, a la pagina de pagos 
        //por cuotas o pago en efectivo
        $status="";
        $message="";
        $url="";
        $bandPagoCuotas=false;
        
        if(isset($this->data['id'])){
          
          //Se debe crear si el pago es de contado 
          //o es de tipo en cuotas 
          //se debe generar la cantida de registros a pagar 
          if($this->data['tipo_pago']==TIPO_PAGO_CONTADO){
            
             //datos para guardar la informacion 
             //en cuota de contado  
             $datos=[];
             $datos['id_infraccion_pago']=$this->data['id'];
             $datos['numero_cuota']="1"; 
             $datos['fecha_pago'] = null;
             $datos['hora_pago']=null;
             $datos['importe']=$importe_reduccion;
             $datos['estado']=CUOTA_NO_PAGADA;
             $datos['id_infraccion'] =null;

             //Guardamos en el registro de infracciones de pago
             //solamente en una cuota porque es de contado 
             $idPagoCuota=$this->infraccionpagocuota_model->insert($datos);
             if(isset($idPagoCuota) && $idPagoCuota>0){
               $bandPagoCuotas=true;
              } else{
                $bandPagoCuotas=false;
              }
          
          }else if($this->data['tipo_pago']==TIPO_PAGO_CUOTAS){
             
             $precio_cuota = 0;
             if($importe_reduccion !=0 &&  $this->data['cant_cuotas']){
                 $precio_cuota = $importe_reduccion / $this->data['cant_cuotas']; 
             }   


             //Generamos la cantidad de cuotas seleccionadas
            for($i=1 ;$i<=$this->data['cant_cuotas'] ;$i++){
              
              $datos=[];
              $datos['id_infraccion_pago']=$this->data['id'];
              $datos['numero_cuota']=$i;
              $datos['fecha_pago']="";
              $datos['hora_pago']="";
              $datos['importe']=$precio_cuota;
              $datos['estado']=CUOTA_NO_PAGADA;
              
              $idPagoCuota=$this->infraccionpagocuota_model->insert($datos);
              if(isset($idPagoCuota) && $idPagoCuota>0){
                 $bandPagoCuotas=true;
              } else{
                $bandPagoCuotas=false;
                break;
              }
            }

          }

          //Verifico que se crearon la cantidad de cuotas a pagar 
          if($bandPagoCuotas){
             
            if(empty($this->data['cant_cuotas'])){
               $label_cuotas="0 - 1";
            } else{
                $label_cuotas="0 - ".$this->data['cant_cuotas'];
            }

            //Cambia el estado de la infraccion 
            //para indicar el estado a pago incompleto
            $this->infraccion_model->updateEstadoInfraccion
                                       ( $this->data['id_infraccion'],
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