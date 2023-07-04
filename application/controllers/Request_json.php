<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
  * Clase que permite poder obtener diferentes 
  * request en formato json
  **/
class Request_json extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        
        $this->load->library('form_validation');

        $this->load->model('dependencia_model');
        $this->load->model('localidad_model');
        $this->load->model('marca_model');
        $this->load->model('modelo_model');
        $this->load->model('persona_model');
        $this->load->model('calle_model');
        $this->load->model('barrio_model');
        $this->load->model('departamento_model');
        $this->load->model('localidad_model');
        $this->load->model('modelo_model');
        $this->load->model('marca_model');
        $this->load->model('tipovehiculo_model');
        $this->load->model('infraccionarticuloinciso_model');
        $this->load->model('infraccion_model');
     


        //Cargamos el Helper para el uso del BASE_URL()
        $this->load->helper('url');
    }

 
  

    /**
      * Funcion que permite obtener informacion 
      * de la persona , obteniendo datos personales ,direccion, domicilio
      * en un formato json
      * @param: $cuit
      * @return : json
      */
    function get_informacionPersona($cuitTipoPersona){
       $valores=explode('-',$cuitTipoPersona);
       $cuit = $valores[0];
       $tipoPersona=$valores[1];

       $personaInformacion=$this->persona_model->getInformacion($cuit);
        
        $message="";
        $dataDomicilios="";
        $persona=null;
        $status="";
       
        if($personaInformacion){
           //persona encontrada   
           $dataDomicilios=array(); 
           $dataDomicilios=$this->getRowsDomicilioActionHtml($personaInformacion->cuil,$tipoPersona);
           $message="DNI/CUIL es correcto";
           $status="OK";
   
        }else{
          $message="DNI/CUIL no es correcto";
          $persona=null;
          $status="INCORRECTO";
        }

        
        $json=array();
        $json=[
              "status"=>$status,
              "message"=>$message,
              "tipoPersona"=>$tipoPersona,
              "persona" =>[ "datos" => $personaInformacion, "domicilios" =>$dataDomicilios]
              ] ;
        
       echo json_encode($json);
       return;
      
      }

       /**
      * Funcion que permite obtener informacion 
      * de la persona , obteniendo datos personales ,direccion, domicilio
      * en un formato json
      * @param: $cuit
      * @return : json
      */
    function get_informacionPersonaDomicilioActual($dni){
      
       $personaInformacion=$this->persona_model->getInformacion($dni);
        
        $message="";
        $dataDomicilio="";
        $persona=null;
        $status="";
        $domicilioActual = "";
        $domicilioNoActual = "";
        $domicilio ="";
        $message = "No hay domicilio Actual"; 
        if($personaInformacion){
           //persona encontrada   
          $dataDomicilios=array(); 
          $domicilios = $this->persona_model->get_domicilios($personaInformacion->cuil);
         
          
          if($domicilios != null && isset($domicilios)){
        
            foreach ($domicilios as $domicilio) {
               if ($domicilio->actual == 't') {
                   $domicilioActual = $domicilio->barrio ."," . $domicilio->calle ."," . $domicilio->numero;
               }else{
                    $domicilioNoActual = $domicilio->barrio ."," . $domicilio->calle ."," . $domicilio->numero;
               }
           }
          } 
          if(isset($domicilioActual)){
            $domicilio = $domicilioActual;
          }else{
            $domicilio = $domicilioNoActual;
          }
          
          $message="DNI/CUIL es correcto";
          $status="OK";
   
        }else{
          $message="DNI/CUIL no es correcto";
          $persona=null;
          $status="INCORRECTO";
        }

        
        $json=array();
        $json=[
              "status"=>$status,
              "message"=>$message,
              "persona" =>[ "datos" => $personaInformacion, "domicilio" =>$domicilio]
              ] ;
        
       echo json_encode($json);
       return;
      
      }

    

      

      /**
        * Funcion que permite eliminar un registro de la tabla 
        * infracciones articulos incisos
        */
      function post_deleteLeyInfraccion(){
        
      
       $json = json_decode(file_get_contents("php://input"));
      
       $band=$this->infraccionarticuloinciso_model->delete($json->id);
       
        $message="";
        $status="OK";
      
      
      if($band){
       $message="Registro eliminado";
       $status="OK";
      }else{
        $status="ERROR";  
      }
      $json=array();
      $json=[
             "status"=>$status,
             "message"=>$message
        ] ;
      echo json_encode($json);
      return ;
      }

       /**
         * Funcion buscar Filter modal con 
         * dni,nombre y apellido
       **/

      function buscarFilterModal(){
        $status="OK";
        $message="";

       $json = json_decode(file_get_contents("php://input"));
       
       $filter=[];
       $filter['dni']=$json->dni;
       $filter['nombre']=$json->nombre;
       $filter['apellido']=$json->apellido;
       $filter['type']=$json->type;


       
       $personas=[];
       $domicilios=[];
       $result=$this->persona_model->buscarPersonaFilter($filter);
       $dni=0;
       $objPersona=null;

       if ( $result != null && sizeof($result) > 0 ) {
           foreach ($result as $persona) {
           
           if($dni==0){
             $dni=$persona->dni;
             $objPersona=[
               "nombre"=>$persona->nombre,
               "apellido"=>$persona->apellido,
               "dni" =>$persona->dni,
               "cuil"=>$persona->cuil,
               "fechanacimiento"=>$persona->fechanacimiento,
               "sexo"=>$persona->sexo,
               "nacionalidad"=>$persona->nacionalidad,
               "tipodocumento"=>$persona->tipodocumento
              ];
             
           }

           if($dni==$persona->dni){
             //guardamos el domicilio
             if($persona->calle!="" && $persona->numero!="" && $persona->barrio!=""){
               $objDomicilio=[
                "calle"=> $persona->calle,
                "numero"=>$persona->numero,
                "barrio"=>$persona->barrio,
                "actual"=>$persona->actual
              ];
               $domicilios[]=$objDomicilio;

              
             }
                 
           }else{
            $personas[]=[
              "persona"=>$objPersona,
              "domicilios"=>$domicilios,
              ];
              //inicializamos los domicilios
              $domicilios=array();
             //actualizamos el dni 
             $dni=$persona->dni; 
             $objPersona=[
               "nombre"=>$persona->nombre,
               "apellido"=>$persona->apellido,
               "dni" =>$persona->dni,
               "cuil"=>$persona->cuil,
               "fechanacimiento"=>$persona->fechanacimiento,
               "sexo"=>$persona->sexo,
               "nacionalidad"=>$persona->nacionalidad,
               "tipodocumento"=>$persona->tipodocumento
              ];

               //guardamos el domicilio
             if($persona->calle!="" && $persona->numero!="" && $persona->barrio!=""){
               $objDomicilio=[
                "calle"=> $persona->calle,
                "numero"=>$persona->numero,
                "barrio"=>$persona->barrio,
                "actual"=>$persona->actual
              ];
               $domicilios[]=$objDomicilio;
              }

            }
        } 

        //guardamos el ultimo registro 
         $personas[]=[
              "persona"=>$objPersona,
              "domicilios"=>$domicilios,
         ];
      
       } else {
          $personas = [];
       }
      

       $json=array();
        $json=[
             "status"=>$status,
              "message"=>$message,
              "personas" =>$personas
              ] ;
        
       echo json_encode($json);
       return;
      }

 }

?>