
<?php


    /**
      ***************************
      * Clase correspondiente a 
      * Infracciones Viales
      * @dathe  : 05-12-2018
      * @author : dgarcia
      **/ 
   class Domicilio extends MY_Controller{


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
        $this->load->model('configuracion_model');
        $this->load->model('rol_model');
        $this->load->model('infraccionley_model');
        $this->load->model('destacamento_model');
        $this->load->model('provincia_model');
        $this->load->model('pais_model');
        $this->load->model('domicilio_model');
        $this->load->model('personadomicilio_model');
        $this->load->model('persona_model');
        $this->load->model('calle_model');

    } 
 
  
     public function guardar(){
        $json = json_decode(file_get_contents("php://input"));
       
        $cuil        = $json->cuilDomicilio;
        $idDomicilio = $json->idDomicilio;       
        $prefijo     = $json->prefijoDomicilio;

        $this->data['manzana']       = $json->manzana ; 
        $this->data['sector']        = $json->sector;;
        $this->data['departamento']  = $json->departamento;
        $this->data['monoblock']     = $json->monoblock;
        $this->data['cuil']          = $json->cuilDomicilio;               
        $this->data['lote']             = $json->lote;
        $this->data['numero']           = $json->numero;
        $this->data['piso']             = $json->piso;
        $this->data['calle']            = $json->calle; 
        //$this->data['tipoDomicilio']    = $json->tipoDomicilio;
        $this->data['domicilioActual']  = $json->domicilioActual;  
        $this->data['id_domicilio']               = $json->idDomicilio;
        $this->data['descripcion']      = $json->observacion;

 
        $message="";
        $status="";
        $domicilios ="";

        if(empty($this->data['id_domicilio'])) {
                $this->data['id'] = $this->domicilio_model->insert($this->data);

                //verificamos si es el domicilio actual
                if($this->data['domicilioActual']){
                 // var_dump("es el domicilio actual"); 
                } 
               
                //insertamos el registro en la parte persona_domicilios
                $this->data['id_domicilio']=$this->data['id'];
                $this->data['cuil']        =$this->data['cuil'];  

                $this->personadomicilio_model->insert($this->data);
                
                $domicilios=$this->getRowsDomicilioActionHtml($this->data['cuil'],$prefijo);

                $status="OK";
                $message="Se guardo el domicilio";
         }else {

                
                $this->data['id']=$this->domicilio_model->update($this->data);
                $status="OK";
                $message="Se actualizo el domicilio";
                $domicilios=$this->getRowsDomicilioActionHtml($this->data['cuil'],$prefijo);

       }
        
          $json=[
              "status"=>$status,
              "message"=>$message,
              "domicilios"=>$domicilios
              ] ;
        
       echo json_encode($json);
       return;   
     }



     function eliminar($idDomicilio){

        $deletePersonaDomicilio =$this->personadomicilio_model->deleteByIdDomicilio($idDomicilio);
        $delete =$this->domicilio_model->delete($idDomicilio);
        

        $status  = "";
        $message = "";
        if($delete && $deletePersonaDomicilio){
            $status="OK";
            $message="Se elimino el Domicilio Correctamente";
        }else{
           $status ="ERROR";
           $message ="Se produjo un error al eliminar el Domicilio";
        }

        $json=[
              "status"=>$status,
              "message"=>$message 
        ] ;
        
       echo json_encode($json);
       return;   
  
     }




   
  

     /** Funcion que permite poder 
       * editar un Domicilio
       * @param : $idDomicilio
       */
     public function editar($idDomicilio){

       $status="";
       $domicilio=$this->domicilio_model->getById($idDomicilio);
       
       $calle ="";
       $barrio = "";
       $localidad="";
       $departamento ="";
       $provincia ="";

       //listados 
       $paises="";
       $provincias ="";
       $departamentos ="";
       $localidades ="";
       $barrios ="";
       $calles="";
       $personaDomicilio = "";
       $actual ="f";

       if($domicilio!= null && $domicilio->id_calle !=null){
         $status="OK";
         $calle        = $this->calle_model->getById($domicilio->id_calle);
         $barrio       = $this->barrio_model->getById($calle->id_barrio);
         $localidad    = $this->localidad_model->getById($barrio->id_localidad);
         $departamento = $this->departamento_model->getById($localidad->id_departamento);
         $provincia    = $this->provincia_model->getById($departamento->id_provincia);
         $pais         = $this->pais_model->getById($provincia->id_pais); 


         $paises            = $this->pais_model->get_all(); 
         $provincias        = $this->provincia_model->findByProvincia($pais->id_pais);
         $departamentos     = $this->departamento_model->findByProvincia($provincia->id_provincia);
         $localidades       = $this->localidad_model->findByDepartamento($departamento->id_departamento);
         $barrios           = $this->barrio_model->findByLocalidad($localidad->id_localidad);
         $calles            = $this->calle_model->findByBarrio($barrio->id_barrio);
  
         $personaDomicilio  = $this->personadomicilio_model->getByIdDomicilio($idDomicilio);    
         
         if($personaDomicilio!=null){
            $actual = $personaDomicilio->actual;
         }        

      
       }



        $json=[

              "status"    => $status,
              "domicilio" => $domicilio,
              "calle"     => $calle,
              "barrio"    => $barrio,
              "localidad" => $localidad,
              "departamento" => $departamento,
              "provincia"    => $provincia,
              "pais"         => $pais,

              "paises"       => $paises,
              "provincias"   => $provincias,
              "departamentos" =>$departamentos,
              "localidades"   =>$localidades,
              "barrios"       =>$barrios,
              "calles"        =>$calles,
              "actual"        =>$actual 
          ] ;
        
       echo json_encode($json);
       return;   

      
         
    }


    /**
      * Funcion que permite actualizar el 
      * domicilio de la Persona
     **/
    function actualizar(){
         
        $json = json_decode(file_get_contents("php://input"));
       
        $cuil        = $json->cuilDomicilio;
        $idDomicilio = $json->idDomicilio;       
        $status      = "";
        $message     = "";
        $personaDomicilios = $this->personadomicilio_model->getByCuil($cuil);
        
        foreach ($personaDomicilios as $domicilio) {
          
           $this->data['id_domicilio'] =$domicilio->id_domicilio;
           $this->data['cuil']         =$domicilio->cuil;

           if($domicilio->id_domicilio == $idDomicilio){
                $this->data['actual'] = 't';  
                $message="Se actualizo el domicilio de la Persona";
             }else{
                $this->data['actual'] ='f';
            }
            $status = "OK";
            $this->personadomicilio_model->update($this->data);

        }
    

     $json=[
            "status"  => $status,
            "message" => $message
          ] ;
        
       echo json_encode($json);
       return;   

    }


   


    /**
     * Funcion que permite guardar 
     * el departamento
     */
    function postDepartamento(){

      $json = json_decode(file_get_contents("php://input"));
      $this->data['nombre']   = $json->nombre;
      $this->data['id']=$json->id; //provincia

      $id=$this->departamento_model->guardar($this->data);

      $message="";
      $status="OK";
      //Obtenemos las marcas correspondientes al 
      //tipo de vehiculo
      $list=$this->departamento_model->findByProvincia($this->data['id']);

      if($id>0){
       $message="Departamento guardado";
       $status="OK";
      }else{
        $status="ERROR";  
      }
      $json=array();
      $json=[
             "status"=>$status,
             "message"=>$message,
             "list"=>$list,
             "id"=>$id
        ] ;
      echo json_encode($json);
      return ;
     }


     /**
     * Funcion que permite guardar 
     * el departamento
     */
    function postLocalidad(){

      $json = json_decode(file_get_contents("php://input"));
      $this->data['nombre']   = $json->nombre;
      $this->data['id']=$json->id; //provincia

      $id=$this->localidad_model->guardar($this->data);

      $message="";
      $status="OK";
      //Obtenemos las marcas correspondientes al 
      //tipo de vehiculo
      $list=$this->localidad_model->findByDepartamento($this->data['id']);

      if($id>0){
       $message="Localidad guardada";
       $status="OK";
      }else{
        $status="ERROR";  
      }
      $json=array();
      $json=[
             "status"=>$status,
             "message"=>$message,
             "list"=>$list,
             "id"=>$id
        ] ;
      echo json_encode($json);
      return ;
     }


      /**
     * Funcion que permite guardar 
     * el departamento
     */
    function postBarrio(){

      $json = json_decode(file_get_contents("php://input"));
      $this->data['nombre']   = $json->nombre;
      $this->data['id']=$json->id; //provincia

      $id=$this->barrio_model->guardar($this->data);

      $message="";
      $status="OK";
      //Obtenemos las marcas correspondientes al 
      //tipo de vehiculo
      $list=$this->barrio_model->findByLocalidad($this->data['id']);

      if($id>0){
       $message="Localidad guardada";
       $status="OK";
      }else{
        $status="ERROR";  
      }
      $json=array();
      $json=[
             "status"=>$status,
             "message"=>$message,
             "list"=>$list,
             "id"=>$id
        ] ;
      echo json_encode($json);
      return ;
     }


          /**
     * Funcion que permite guardar 
     * el departamento
     */
    function postCalle(){

      $json = json_decode(file_get_contents("php://input"));
      $this->data['nombre']   = $json->nombre;
      $this->data['id']=$json->id; //provincia

      $id=$this->calle_model->guardar($this->data);

      $message="";
      $status="OK";
      //Obtenemos las marcas correspondientes al 
      //tipo de vehiculo
      $list=$this->calle_model->findByBarrio($this->data['id']);

      if($id>0){
       $message="Localidad guardada";
       $status="OK";
      }else{
        $status="ERROR";  
      }
      $json=array();
      $json=[
             "status"=>$status,
             "message"=>$message,
             "list"=>$list,
             "id"=>$id
        ] ;
      echo json_encode($json);
      return ;
     }

   }
?>