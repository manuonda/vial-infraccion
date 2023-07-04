
<?php


    /**
      ***************************
      * Clase correspondiente a 
      * los pagos de las infracciones
      * @dathe  : 05-12-2017
      * @author : dgarcia
      **/ 
   class Informes extends MY_Controller{


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
        //$this->load->model('contravencionestado_model');

        $this->load->model('infraccion_model');
        $this->load->model('infraccionpago_model');
        $this->load->model('infraccionpagocuota_model');
        $this->load->model('infraccionley_model');

        $this->load->model('informe_model');


    } 
 

    /**
     *  Index
     */
    public function index($idInfraccion){
       if ($this->ion_auth->logged_in()) {
            
            $this->data['contenido'] = "vial/informes/index_informes.php";
            $this->data['titulo']="Generaciòn de Informes";
            $this->data['subtitulo']="Informes";

            $infraccion =$this->infraccion_model->getById($idInfraccion);

            //********************************************

            $marca=null;
            $modelo=null;
            $tipovehiculo=null;
            //Datos del vehiculo 
            if($infraccion->id_modelo!=null){
              $modelo=$this->modelo_model->getById($infraccion->id_modelo);
              $marca=$this->marca_model->getById($modelo->id_marca);
              $tipovehiculo=$this->tipovehiculo_model->getById($marca->id_tipovehiculo);
            }

            //*****************************************************
            //Datos del propietario y conductor
       
            $involucrado=$this->persona_model->getInformacion($infraccion->cuil_involucrado);
            $domiciliosInvolucrado=$this->persona_model->get_domicilios($infraccion->cuil_involucrado);
           
            $propietario=$this->persona_model->getInformacion($infraccion->cuil_propietario);
            $domiciliosPropietario=$this->persona_model->get_domicilios($infraccion->cuil_propietario);

            $this->data['involucrado']=$involucrado;
            $this->data['domiciliosInvolucrado']=$domiciliosInvolucrado;
            $this->data['propietario']=$propietario;
            $this->data['domiciliosPropietario']=$propietario;

            $this->data['tipovehiculo']=$tipovehiculo;
            $this->data['marca']=$marca;
            $this->data['modelo']=$modelo;
          

          
            $this->data['infraccion']=$infraccion;

            $this->data['informes']=$this->informe_model->getByIdInfraccion($idInfraccion);

            //$this->data['infracciones']=$this->infraccion_model->buscar($filter);
            //$this->data['departamentos']=$this->departamento_model->get_all(9); //provincia de jujuy = 9
            $this->load->view('template', $this->data);
        } else {
            redirect('admin/login');
        }
   

    }


        /**
      * Funcion que permite agregar 
      * un expediente cargando la vista 
      * del expediente
      **/
    public function agregar($idInfraccion){
      $this->data['contenido']="vial/informes/create_view.php";
      $this->data['titulo']="Informe / Vial";
      $this->data['subtitulo']="Agregar Informe";
      $this->data['idInfraccion']=$idInfraccion;
      $this->data['infraccion']=$this->infraccion_model->getById($idInfraccion);
      
      $this->load->view('template',$this->data);

    }


    public function guardar(){
        $this->data['id'] = $this->input->post('id');
        $this->data['id_infraccion']=$this->input->post('idInfraccion');
        $this->data['fecha_ingreso'] =  $this->input->post('fecha_ingreso');
        $this->data['texto'] = $this->input->post('texto');
        $this->data['descripcion'] =$this->input->post('descripcion');
        $url="informes/index/". $this->data['id_infraccion'];
        
        if(empty($this->data['id'])) {
                $this->data['id'] = $this->informe_model->insert($this->data);
                $message="Se agrego Informe";
               // $this->index(null,$message,null);
                $status="OK";
                $message="Se guardo el registro de Infraccion";
                 
        }else {

              $this->informe_model->update($this->data);
              $status="OK";
              $message="Se actualizo la infraccion";
        }


        $json=[
              "status"=>$status,
              "message"=>$message,
              "url"=>$url
              ] ;
        
       echo json_encode($json);
       return; 
    }

     /** Funcion que permite poder 
       * editar una contravencion 
       * @param : $idContravencion
       */
     public function editar($idInforme){
       $this->data['contenido']="vial/informes/create_view.php";

       $informe=$this->informe_model->getById($idInforme);  
       $this->data['informe']=$informe;
       $this->data['idInfraccion']=$informe->id_infraccion;  
      
       $this->data['titulo']="Editar  Informe";
       $this->data['subtitulo']="Informes";
        $this->load->view('template',$this->data);

    }

  
    /*
     * 
     */
    public function delete($idInforme){
      
       $informe=$this->informe_model->getById($idInforme);  
       $this->informe_model->delete($idInforme);
       ($informe);
       $idInfraccion=$informe->idInfraccion;
       $this->index($id_infraccion);
    
     }


     public function generarComprobanteLicencia(){
        
         $json = json_decode(file_get_contents("php://input"));
        $this->data['id'] = $json->id_informe;
        $informe = $this->informe_model->getById($json->id_informe);
        $this->data['nombre_apellido_representante'] =$json->nombre_apellido_representante;
        $this->data['cuil_representante'] =$json->cuil_representante;
        $this->data['dni_representante'] =$json->dni_representante;
        $this->data['domicilio_representante'] =$json->domicilio_representante;
        $this->data['vinculo_representante'] =$json->vinculo_representante;
        $this->data['id_infraccion'] = $informe->id_infraccion;
        $this->data['texto'] =$json->texto;
        $this->data['pedido_dni'] =$json->pedido_dni;
        $this->data['pedido_licencia'] =$json->pedido_licencia;
        $this->data['pedido_cedula'] =$json->pedido_cedula;
        $this->data['pedido_otro'] = $json->pedido_otro;
      
    

        //permite actualizar solamente el numero de comprobante 
        $this->data['id'] = $this->informe_model->update($this->data);
        
        $data['url_comprobante']=  base_url().'informes/generarComprobantePDF/'.$json->id_informe;

        $json=array();
        $json=[
              "status"=>"OK",
              "data"=>$data
              ] ;
        
       echo json_encode($json);



     }




    ///*************************************
    //** METODOS DE GENERACION DE PDF
    //***************************************
    public function generarComprobantePDF($idInforme){
      $informe =$this->informe_model->getById($idInforme);
      $infraccion=null; 
      if($informe->id_infraccion!=null){
        $infraccion=$this->infraccion_model->getById($informe->id_infraccion);  
      }

      ///($infraccion);
      
      
        //Datos del vehiculo 
       $this->data['dominio']=$infraccion->dominio;
       $modelo=$this->modelo_model->getById($infraccion->id_modelo);
       $marca=null;

       if(null!=$modelo){
       $marca=$this->marca_model->getById($modelo->id_marca);
       $tipovehiculo=$this->tipovehiculo_model->getById($marca->id_tipovehiculo);
       } 
       
       
     
   
        
       $this->data['fecha_actual']=date("Y-m-d");
            
        $html="<html><body><br></br><br></br>"; 
        $data_header = null;
        $this->data['titulo'] = 'DILIGENCIA DE NOTIFICACION Y ENTREGA DE DOCUMENTACION';
        $html =$html . $this->get_title($this->data);
        $html = $html . "<br></br><br></br>";

         

        //Detalle del contenido
       
         $html = $html . $this->get_contenido($infraccion,$informe,$this->session->userdata('nombre'));
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
        $pdf->Output('informe'.$informe->dni_representante.'.pdf', 'I');
        
    } 



   
    /**
      * <b>Funcion que permite generar el contenido 
      * de la informacion 
      * </b>
     **/ 

    public function get_contenido($infraccion,$informe, $username){
      $mes=$this->getMes();
      $dia=date("d");
      $year=date("Y");
      $hora=date("H:i", time());
      $domicilio ='------------'; 
      $detalleLeyes = $this->infraccionley_model->getByIdInfraccion($infraccion->id_infraccion);
                                           
     $fecha_ingreso="";
      if($infraccion->fecha_ingreso!=null && isset($infraccion->fecha_ingreso)){
         $fecha_ingreso=date("d/m/Y", strtotime($infraccion->fecha_ingreso));
       }

      $leyes=$this->get_detalle_leyes($detalleLeyes);
 
      if(empty($leyes)){
         $leyes="-------"; 
       }

       if($informe->domicilio_representante!=null){
         $domicilio  = $informe->domicilio_representante;
       }
    
      $detalle_documentacion  ="<ul>";
      
      if($informe->pedido_dni!=null && $informe->pedido_dni == 1){
        $detalle_documentacion  = $detalle_documentacion ."<li><strong>ENTREGA DNI </strong></li>";
      } 

      if($informe->pedido_cedula!=null && $informe->pedido_cedula == 1){
        $detalle_documentacion = $detalle_documentacion ."<li><strong>ENTREGA CEDULA </strong></li>";
      }

      if($informe->pedido_licencia != null && $informe->pedido_licencia == 1){
        $detalle_documentacion = $detalle_documentacion ."<li><strong>ENTREGA LICENCIA </strong></li>";
      }

      if($informe->pedido_otro != null && $informe->pedido_otro == 1){
        if($informe->texto!=null && !empty($informe->texto)){
        $detalle_documentacion  = $detalle_documentacion ."<li><strong>ENTREGA ".$informe->texto."</strong></li>";
       }  
      } 
      

      $contenido ="<br></br><p></p>";

      $contenido =$contenido. "<p></p>".
                 ' <div  style="font-family: Open Sans,sans-serif; font-size: 8px;text-align: justify; text-justify: inter-word;">'.
                 " <strong>EN LA DIRECCION DE TRANSITO  Y SEGURIDAD VIAL, DE LA POLICIA DE LA PROVINCIA DE JUJUY, CON ASIENTO ".
                 " EN LA CIUDAD DE SAN SALVADOR DE JUJUY, DEPARTAMENTO DR. MANUEL BELGRANO, PROVINCIA DE JUJUY, REPUBLICA ARGENTINA,".
                 " </strong>a los <strong>".$dia."</strong> días del mes de <strong>".$mes."</strong> del <strong>".$year."</strong>, siendo las horas <strong>".$hora."</strong> .El funcionario policial que subscribe, a los efectos legales hace CONSTAR: Que, en éste acto se encuentra presente la persona de <strong>".$informe->nombre_apellido_representante."</strong> con DNI <strong>".$informe->dni_representante ."</strong> con domicilio en <strong>".$domicilio. 
            "</strong>. A quien se le notifica del contenido integro y de los derechos que se le asiste del Acta de Comprobaciòn Nro. <strong>".$infraccion->numero_acta."</strong> de fecha <strong>".
              $fecha_ingreso."</strong> , por s/ infracciòn : ".$leyes. " a quien se le procede hacer entrega de la documentación que se detalla a continuación. No siendo mas para el acto, se da por finalizado el mismo, firmando al pie de la presente el causante, en prueba de su notificación y para constancia, por ante mi que <strong>CERTIFICO</strong>".
              "<br></br> ".
                ' <div  style="font-family: Open Sans,sans-serif; font-size: 8px;text-align: justify; text-justify: inter-word;">'.      
                ' Detalle de la documentación : <br>'.
                 $detalle_documentacion  
                .'</div><br><br><br><br><br><br><br><br><br><br><br><p></p><p></p>'.
               
              $this->get_detalle_firma($informe,$username);


            
      
      return $contenido;
    }

     /**
      * Funcion que permite mostrar en un cuadro las leyes
     **/
    public function get_detalle_leyes($leyes) {
      
    
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
    private function get_title($par) {
        $parametros = $par['titulo'];
        $html =  ' <h4 align="center"><u>'. strtoupper($parametros) .'</u></h4>
                   <br/>';
        return $html;
    }  




       function get_detalle_firma($informe,$username){
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
                    font-size: 8px;text-align: center;vertical-align: middle;"><td><strong>'.$informe->nombre_apellido_representante.'</strong></td></tr>
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td>      Aclaración </td></tr>
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td><strong>'.$informe->dni_representante.'</strong></td></tr>
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td>DNI</td></tr>
                    <tr style="font-family: Open Sans,sans-serif;
                    font-size: 8px;text-align: center;vertical-align: middle;"><td><strong>'.$informe->vinculo_representante.'</strong></td></tr>
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

 }
?>