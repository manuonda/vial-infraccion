
<?php


    /**
      ***************************
      * Clase correspondiente a 
      * Infracciones Viales
      * @dathe  : 05-12-2018
      * @author : dgarcia
      **/ 
   class Infraccionvial extends MY_Controller{
  
  
    /**
      * Constructor para cargar las librerias 
      * necesarias
      */
    function __construct(){
       parent::__construct();

       ini_set('memory_limit', '-1');

        
        //library y helpers
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('excelinfracciones');
        
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
        $this->load->library('pagination');
        $this->load->library('excel');

    } 
 

    /**
     *  Index
     */
   	public function index($filter=null,$message=null,$status=null,$Starting=0){
       if ($this->ion_auth->logged_in()) {
       	    
            $filter = $this->session->userdata('filter');

            //filter vial 
            if($filter==null){
               $filter['tipo_expediente']='V';
               $filter['numero_expediente']=null;
               $filter['numero_acta']=null;
               $filter['fecha_desde']=null;
               $filter['fecha_hasta']=null;
               $filter['propietario']=null;
               $filter['actual'] = null;
               $filter['nombre']=null;
               $filter['apellido']=null;
               $filter['dni']=null;
               $filter['dominio']=null;
               $filter['estado_pago'] = null;
            }

           // var_dump($filter);


            $tipoPagos = ['INFRACCION_PAGO_NO_GENERADO','INFRACCION_PAGO_COMPLETO','INFRACCION_PAGO_INCOMPLETO'];

            $this->data['tipo_pagos']=$tipoPagos; 
            $this->data['message']=$message; 
            $this->data['status']=$status;
            $this->data['contenido'] = "vial/index_view.php";
            $this->data['titulo']="Infracciones / Viales";
            $this->data['filter']=$filter;

            $this->data['departamentos']=$this->departamento_model->get_all(9); //provincia de jujuy = 9
            $this->load->view('template', $this->data);
        } else {
            redirect('admin/login');
        }
   

   	}

    public function buscarNumeroActa( $numeroActa) {
       $acta = $this->infraccion_model->buscarNumeroActa($numeroActa);
       echo json_encode($acta);
       return;


    }

    /**
      * Funcion que permite realizar 
      * la limpieza de los filtros
     **/ 
    public function limpiar(){
       $this->session->set_userdata('filter', null);
       $this->index();
    }

public function jeje(){
echo 'jeje ';
}

public function pagination_555($rowno=0){

	$config = $this->get_configuration(); 
      $filter = $this->session->userdata('filter');
       
       //filter vial 
       if($filter==null){
          $filter['tipo_expediente']='V';
          $filter['numero_expediente']=null;
          $filter['numero_acta']=null;
          $filter['fecha_desde']=null;
          $filter['fecha_hasta']=null;
          $filter['propietario']=null;
          $filter['actual'] = null;
          $filter['nombre'] = null;
          $filter['apellido'] = null;
          //$filter['dni']  =  '28646248';
$filter['dni']  =  null;

          $filter['dominio'] = null;
          $filter['estado_pago'] = null;
      }

	 // Row per page
      $rowperpage = 5;

     // Row position
     if($rowno != 0){
         $rowno = ($rowno-1) * $rowperpage;
      }

	//obtenemos las infracciones
     $infracciones=$this->infraccion_model->buscar($filter,5,$rowno);
     $result = [];

	
     foreach ($infracciones as $infraccion) {
	//echo $infraccion->id . '<br/>';
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


    /**
      * Funcion que permite obtener la 
      * pagination de la tabla de infracciones
    **/
    public function pagination($rowno=0){

      $config = $this->get_configuration(); 
      $filter = $this->session->userdata('filter');
       
       //filter vial 
       if($filter==null){
          $filter['tipo_expediente']='V';
          $filter['numero_expediente']=null;
          $filter['numero_acta']=null;
          $filter['fecha_desde']=null;
          $filter['fecha_hasta']=null;
          $filter['propietario']=null;
          $filter['actual'] = null;
          $filter['nombre'] = null;
          $filter['apellido'] = null;
          $filter['dni']  =  null;
          $filter['dominio'] = null;
          $filter['estado_pago'] = null;
      }
 
       
      // Row per page
      $rowperpage = 5;

     // Row position
     if($rowno != 0){
         $rowno = ($rowno-1) * $rowperpage;
      }


     //obtenemos las infracciones
     $infracciones=$this->infraccion_model->buscar($filter,$config["per_page"],$rowno);
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
      $filter = $this->session->userdata('filter');
       
       //filter vial 
       if($filter==null){
          $filter['tipo_expediente']='V';
          $filter['numero_expediente']=null;
          $filter['numero_acta']=null;
          $filter['fecha_desde']=null;
          $filter['fecha_hasta']=null;
          $filter['actual'] = null;
          $filter['propietario']=null;
          $filter['nombre'] = null;
          $filter['apellido'] = null;
          $filter['dni']  =  null;
          $filter['dominio'] = null;
          $filter['estado_pago'] = null;
      }

      $this->excelinfracciones->excel($filter);
     
  
    
  } 


  public function downloadExcelActual() {
      $filter = $this->session->userdata('filter');
       
       //filter vial 
       if($filter==null){
          $filter['tipo_expediente']='V';
          $filter['numero_expediente']=null;
          $filter['numero_acta']=null;
          $filter['fecha_desde']= null;
          $filter['fecha_hasta']= null;
          $filter['actual'] = 'actual';
          $filter['propietario']=null;
          $filter['nombre'] = null;
          $filter['apellido'] = null;
          $filter['dni']  =  null;
          $filter['dominio'] = null;
          $filter['estado_pago'] = null;
      }
   
     $this->excelinfracciones->excel($filter);
    
    
  } 


private function get_format_row333($infraccion){
         
          $pago = "";
            //Se debe verificar si el estado de pago es nulo o 
            //no generado se debe poder generar o seleccionar el pago 

           if ($infraccion->establecerInvolucrado == '1' &&  $infraccion->dniEstablecerInvolucrado == null  ){
                $pago = "<label class='btn default btn-xs red'>".
                     "<strong>NO GENERADO</strong></label>";      
           }else if (empty($infraccion->estadoPago) || $infraccion->estadoPago==INFRACCION_PAGO_NO_GENERADO){
                 $pago = "<a href='".base_url().'infraccionpago/index/'.$infraccion->id."' title='Generar Pago' class='btn default btn-xs green '>".
                     "<strong>GENERAR PAGO</strong></a>"; 
            }else if($infraccion->estadoPago==INFRACCION_PAGO_INCOMPLETO){
                  $pago =  "<a href='".base_url().'infraccionpagocuota/index/'.$infraccion->id."' class='btn btn-success label-sm btn-xs'><strong>".$infraccion->labelCuotas."</strong></a>";
            }else if($infraccion->estadoPago==INFRACCION_PAGO_COMPLETO){
                  $pago = "<a href='".base_url().'infraccionpagocuota/index/'.$infraccion->id."' class='btn btn yellow label-sm btn-xs'><strong><strong> PAGO COMPLETO</strong></a>";
            }else if($infraccion->estadoPago==INFRACCION_PAGO_EXHIMIDO) {

              $texto_exhimido = '';
              if ($infraccion->textoExhimido != null ) {
                  $text_exhimido = preg_replace( "/\r|\n/", "", $infraccion->textoExhimido );
              }
               $pago = "<button type='button' onclick=module_exhimido.mostrar(".$infraccion->id.") class='btn  default btn-xs blue'>".
                     "<strong>INFRACCION EXHIMIDA</strong></button>";   
            }     

           $dni_propietario = "---";
           $propietario = "---";
           $tipoPersona = "---";
           $color = "";
          
   if ( isset($infraccion->tipoPersona) && $infraccion->tipoPersona =='PF') {
                 $tipoPersona ="P. Fisica";
                 $color="btn default btn-xs yellow";
           } else if (isset($infraccion->tipoPersona) && $infraccion->tipoPersona == 'PJ'){
              $tipoPersona = "P.Juridica";
              $color = "btn default btn-xs warning";
           } else if (isset($infraccion->tipoPersona) && $infraccion->tipoPersona == 'PE') {
              $tipoPersona = "P. Establecida";
              $color = "btn default btn-xs red";
           }



 $row =  "<tr class='odd gradeX'>".
                  "<td>".$infraccion->id."</td>".
                  "<td width='6%'>".$infraccion->numeroActa."</td>".
                  "<td width='20%'>".date('d-m-Y',strtotime($infraccion->fechaHecho))."</td>".
                  "<td width='10%'><label class='".$color."'>".$tipoPersona."</label></td>";


	if ( $infraccion->establecerInvolucrado == '1' && $infraccion->dniEstablecerInvolucrado ==  null) {
                     $row = $row ."<td width='20%'><label class='btn default btn-xs red'><strong id='personaEstablecerInvolucrado'>".
                                  " DEBE COMPLETAR LOS DATOS</strong></label></td>".
                                  "<td><label class='btn default btn-xs red'>".
                                  "<strong id='personaEstablecerInvolucrado'> PERSONA A  ESTABLECER</strong>".
                                  "</label></td>";  
                  } else if ($infraccion->establecerInvolucrado == '1' && $infraccion->dniEstablecerInvolucrado != null ) {
                   $involucrado = $this->personatemporal_model->getPersona($infraccion->id , 'involucrado'); 
                   $row = $row  ."<td width='15%'><div class='text-center'>".$involucrado->nombre.",".$involucrado->apellido."</div></td>".
                                 "<td width='25%'>".$infraccion->dniEstablecerInvolucrado ."</td>";
                    
                  }  else if ($infraccion->dniInvolucrado != null ) {
                     $involucrado=$this->persona_model->getInformacion($infraccion->dniInvolucrado);
                     $row = $row  ."<td width='15%'><div class='text-center'>".$involucrado->nombre.",".$involucrado->apellido."</div></td>".
                                   "<td width='25%'>".$infraccion->dniInvolucrado ."</td>";
                   
                  } 
                  $row  = $row . "<td width='10%'><div class='text-center'>".$infraccion->dominio."</div></td>".

		//PAGO
                 "<td class='text-center'>". $pago."</td>".
      
                 // ACCIONES
                   "<td>
                    <div class='text-center'>";


	if($infraccion->estadoPago != INFRACCION_PAGO_EXHIMIDO) {
                      $row = $row .           
                                 "<a title='Editar' href='".base_url()."infraccionvial/editar/".$infraccion->id."' class='btn default btn-xs yellow'>". 
                                 "<i class='fa fa-pencil'></i></a>";
                     
                   }  

	
                     $row = $row .           
                                 "<a title='Exhimir la infraccion' href='#' onclick='if(confirm(\"Desea exhimir esta infraccion?\")) module_exhimido.agregar(".$infraccion->id."); return false;'  class='btn default btn-xs blue'>". 
                                  "<i class='fa fa-unlock-alt'></i></a>";     
                   

 
                    $row = $row .'<a href="#" onclick=module_comprobante_licencia.showModal('.$infraccion->id.');return false;'
                              .' title="Generar Documentacion" class="btn default btn-xs purple-plum" >'
                              . '<i class="fa fa-list"></i></a>'
                              . '</a>';
                   

             $row = $row."</div></td></tr>";

       return $row;



    }




    private function get_format_row($infraccion){
         
          $pago = "";
            //Se debe verificar si el estado de pago es nulo o 
            //no generado se debe poder generar o seleccionar el pago 

           if ($infraccion->establecerInvolucrado == '1' &&  $infraccion->dniEstablecerInvolucrado == null  ){
                $pago = "<label class='btn default btn-xs red'>".
                     "<strong>NO GENERADO</strong></label>";      
           }else if (empty($infraccion->estadoPago) || $infraccion->estadoPago==INFRACCION_PAGO_NO_GENERADO){
                 $pago = "<a href='".base_url().'infraccionpago/index/'.$infraccion->id."' title='Generar Pago' class='btn default btn-xs green '>".
                     "<strong>GENERAR PAGO</strong></a>"; 
            }else if($infraccion->estadoPago==INFRACCION_PAGO_INCOMPLETO){
                  $pago =  "<a href='".base_url().'infraccionpagocuota/index/'.$infraccion->id."' class='btn btn-success label-sm btn-xs'><strong>".$infraccion->labelCuotas."</strong></a>";
            }else if($infraccion->estadoPago==INFRACCION_PAGO_COMPLETO){
                  $pago = "<a href='".base_url().'infraccionpagocuota/index/'.$infraccion->id."' class='btn btn yellow label-sm btn-xs'><strong><strong> PAGO COMPLETO</strong></a>";
            }else if($infraccion->estadoPago==INFRACCION_PAGO_EXHIMIDO) {

              $texto_exhimido = '';
              if ($infraccion->textoExhimido != null ) {
                  $text_exhimido = preg_replace( "/\r|\n/", "", $infraccion->textoExhimido );
              }
               $pago = "<button type='button' onclick=module_exhimido.mostrar(".$infraccion->id.") class='btn  default btn-xs blue'>".
                     "<strong>INFRACCION EXHIMIDA</strong></button>";   
            }     

           $dni_propietario = "---";
           $propietario = "---";
           $tipoPersona = "---";
           $color = "";
          



           if ( isset($infraccion->tipoPersona) && $infraccion->tipoPersona =='PF') {
                 $tipoPersona ="P. Fisica";
                 $color="btn default btn-xs yellow";
           } else if (isset($infraccion->tipoPersona) && $infraccion->tipoPersona == 'PJ'){
              $tipoPersona = "P.Juridica";
              $color = "btn default btn-xs warning";
           } else if (isset($infraccion->tipoPersona) && $infraccion->tipoPersona == 'PE') {
              $tipoPersona = "P. Establecida";
              $color = "btn default btn-xs red";
           }



           $row =  "<tr class='odd gradeX'>".
                  "<td>".$infraccion->id."</td>".
                  "<td width='6%'>".$infraccion->numeroActa."</td>".
                  "<td width='20%'>".date('d-m-Y',strtotime($infraccion->fechaHecho))."</td>".
                  "<td width='10%'><label class='".$color."'>".$tipoPersona."</label></td>";
                 
                 if ( $infraccion->establecerInvolucrado == '1' && $infraccion->dniEstablecerInvolucrado ==  null) {
                     $row = $row ."<td width='20%'><label class='btn default btn-xs red'><strong id='personaEstablecerInvolucrado'>".
                                  " DEBE COMPLETAR LOS DATOS</strong></label></td>".
                                  "<td><label class='btn default btn-xs red'>".
                                  "<strong id='personaEstablecerInvolucrado'> PERSONA A  ESTABLECER</strong>".
                                  "</label></td>";  
                  } else if ($infraccion->establecerInvolucrado == '1' && $infraccion->dniEstablecerInvolucrado != null ) {
                   $involucrado = $this->personatemporal_model->getPersona($infraccion->id , 'involucrado'); 
                   $row = $row  ."<td width='15%'><div class='text-center'>".$involucrado->nombre.",".$involucrado->apellido."</div></td>".
                                 "<td width='25%'>".$infraccion->dniEstablecerInvolucrado ."</td>";
                    
                  }  else if ($infraccion->dniInvolucrado != null ) {
                     $involucrado=$this->persona_model->getInformacion($infraccion->dniInvolucrado);
                     $row = $row  ."<td width='15%'><div class='text-center'>".$involucrado->nombre.",".$involucrado->apellido."</div></td>".
                                   "<td width='25%'>".$infraccion->dniInvolucrado ."</td>";
                   
                  } 
                  $row  = $row . "<td width='10%'><div class='text-center'>".$infraccion->dominio."</div></td>".

                
                 //PAGO
                 "<td class='text-center'>". $pago."</td>".
      
                 // ACCIONES
                   "<td>
                    <div class='text-center'>";
                    

                   if($infraccion->estadoPago != INFRACCION_PAGO_EXHIMIDO) {
                      $row = $row .           
                                 "<a title='Editar' href='".base_url()."infraccionvial/editar/".$infraccion->id."' class='btn default btn-xs yellow'>". 
                                 "<i class='fa fa-pencil'></i></a>";
                     
                   }  

                   //BOTON MOSTRAR EXHIMICION, Cuando no se completo los pagos o no se exhimio todavia
                   if($infraccion->estadoPago != INFRACCION_PAGO_EXHIMIDO && $infraccion->estadoPago != INFRACCION_PAGO_INCOMPLETO &&
                      $infraccion->estadoPago != INFRACCION_PAGO_COMPLETO && 
                      ( $infraccion->dniEstablecerInvolucrado != null  || $infraccion->dniInvolucrado != null) ) {
                     $row = $row .           
                                 "<a title='Exhimir la infraccion' href='#' onclick='if(confirm(\"Desea exhimir esta infraccion?\")) module_exhimido.agregar(".$infraccion->id."); return false;'  class='btn default btn-xs blue'>". 
                                  "<i class='fa fa-unlock-alt'></i></a>";     
                   } 

                  //ENTREGA DE LICENCIA
                  if ($infraccion->dniEstablecerInvolucrado != null  || $infraccion->dniInvolucrado != null){
                    $row = $row .'<a href="#" onclick=module_comprobante_licencia.showModal('.$infraccion->id.');return false;'
                              .' title="Generar Documentacion" class="btn default btn-xs purple-plum" >'
                              . '<i class="fa fa-list"></i></a>'
                              . '</a>';
                   }

             $row = $row."</div></td></tr>";

       return $row;

    }


    private function get_configuration(){
        $config['base_url'] = base_url().'infraccionvial/pagination/';
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

  
   
    /**
      * Funcion que permite agregar 
      * un expediente cargando la vista 
      * del expediente
      **/
    public function agregar($numeroActa){
      $this->data['contenido']="vial/create_view.php";
      $this->data['tipovehiculos']=$this->tipovehiculo_model->get_all();
      $this->data['provincias']=$this->provincia_model->get_all();
      $this->data['titulo']="Infracciones / Vial";
      $this->data['subtitulo']="Agregar Infracción Vial";
      $this->data['idTipoVehiculo']="";
      $this->data['idMarca']="";
      $this->data["idModelo"]="";
      $this->data['detalleInfracciones']=null;
      $this->data['marcas']=null;
      $this->data['modelos']=null;
      $this->data['domiciliosPropietario']=null;
      $this->data['involucrado']=null;
      $this->data['propietario']=null;
      $this->data['domiciliosInvolucrado']=null;
      $this->data['destacamentos']=$this->destacamento_model->get_all();
      $this->data['paises']=$this->pais_model->get_all();
      $this->data['departamentos']=null;
      $this->data['localidades'] =null;
      $this->data['tipoPersona'] = ''; // Tipo Persona
      $this->data['configuracion']=$this->configuracion_model->getByName('LEY');
      $this->data['edicion'] = 'false';


            
      $this->data['numero_acta'] =$numeroActa;
      $pais = $this->pais_model->findByName('ARGENTINA');
      $this->data['provincias'] = $this->provincia_model->findByProvincia($pais->id_pais);
      $provincia = $this->provincia_model->findByName('JUJUY');
      $this->data['departamentos']  = $this->departamento_model->findByProvincia($provincia->id_provincia);


      // Configuracion
      $this->data['configuracion']=$this->configuracion_model->getByName('LEY');

        /////////////////////////////////////////////////////////
        //filter leyes F
         //Obtenemos las leyes filtrado por el 
        //rol , que dependiendo de este Vial o Contravencional 
        //Se obtiene los tipos de leyes 
        $tipo_infraccion=$this->rol_model->getTipoInfraccionByRol($this->session->userdata('user_id')); 
        
        $filterLeyes=[];
        $filterLeyes['nombre']=null;
        if($tipo_infraccion!=null){
            $filterLeyes['tipo_infraccion']='V';

        }
        $this->data['leyes']=$this->ley_model->buscar($filterLeyes);
        ///////////////////////////////////////////////////////////////
       
      
        // == Leyes
        $this->data['detalleLeyes']=null;           
        $this->load->view('template',$this->data);

    }

     /** Funcion que permite poder 
       * editar una infraccion 
       * @param : $idInfraccion
       */
     public function editar($idInfraccion){
       
       $rolesUsuario =  $this->rol_model->getRolOfUsuario($this->session->userdata('user_id'));
       $edicion = false;
       if ( $rolesUsuario != null ){
          foreach( $rolesUsuario as $rol) {
             if ($rol->name =='AdminVialEdicion'){
              $edicion = 'true';
             }
          }
       }



       $this->data['contenido']="vial/create_view.php";

       $infraccion=$this->infraccion_model->getById($idInfraccion);

       //componentes
       $this->data['id']=$infraccion->id_infraccion;  
       $this->data['provincias']=$this->provincia_model->get_all();
       $this->data['departamentos']=$this->departamento_model->findByProvincia($infraccion->id_provincia);
       $this->data['localidades']=$this->localidad_model->findByDepartamento($infraccion->id_departamento);
       $this->data['destacamentos']=$this->destacamento_model->get_all();      
       $this->data['paises']=$this->pais_model->get_all(); 
       $this->data['configuracion']=$this->configuracion_model->getByName('LEY');
       $this->data['edicion'] = $edicion;     
       
       //********************************************
       //Datos del vehiculo 
       $modelo=null;
       $id_marca=null;
       $id_tipovehiculo=null;
       $id_modelo=null;
       $modelos=null;
       
       $this->data['dominio']=$infraccion->dominio;
       

       if($infraccion->id_modelo!=null){
          $modelo=$this->modelo_model->getById($infraccion->id_modelo);
          $id_modelo=$modelo->id_modelo;
          $modelos=$this->modelo_model->getByMarca($modelo->id_marca);;
       }


       $fecha_ingreso = date('Y-m-d',strtotime($infraccion->fecha_ingreso));
       $fecha_hecho  =date('Y-m-d',strtotime($infraccion->fecha_hecho));

       
       
       $marca=null;
       $marcas=null;
       $id_marca=null;
       if($modelo!=null){
          $marca=$this->marca_model->getById($modelo->id_marca);
          $marcas=$this->marca_model->getByTipoVehiculo($marca->id_tipovehiculo);
          $id_marca=$marca->id_marca;
       }
      
       $tipovehiculo=null;
       $id_tipovehiculo=null;
       if($marca!=null){
         $id_marca=$marca->id_marca;
         $tipovehiculo=$this->tipovehiculo_model->getById($marca->id_tipovehiculo); 
         $id_tipovehiculo=$tipovehiculo->id_tipovehiculo;
       } 
       
       //cargamos los selects 
       $this->data['tipovehiculos']=$this->tipovehiculo_model->get_all();
       $this->data['marcas']=$marcas;
       $this->data['modelos']=$modelos;

      

       $this->data['id_modelo']=$id_modelo;
       $this->data['id_marca']=$id_marca;
       $this->data['id_tipovehiculo']=$id_tipovehiculo;
      
    

       //Leyes - Detalle de la infraccion 
       $leyes=$this->infraccionley_model->getDetalleLeyInfraccion($idInfraccion);
       $this->data['detalleLeyes']=$this->get_leyes_vial($leyes);
       




        /////////////////////////////////////////////////////////
        //filter leyes 
         //Obtenemos las leyes filtrado por el 
        //rol , que dependiendo de este Vial o Contravencional 
        //Se obtiene los tipos de leyes 
        //$tipo_infraccion=$this->rol_model->getTipoInfraccionByRol($this->session->userdata('user_id')); 
        $filterLeyes=[];
        $filterLeyes['nombre']=null;
        $filterLeyes['tipo_infraccion']='V';
        $this->data['leyes']=$this->ley_model->buscar($filterLeyes);
        ///////////////////////////////////////////////////////////////
      
       

       //*****************************************************
       //Datos del propietario y conductor
       $involucrado=null;
       $domiciliosInvolucrado=null;
       $propietario=null;
       $domiciliosPropietario=null;
       $personaJuridica = null ;
   

       if($infraccion->cuil_involucrado!=null && $infraccion->persona_establecer_involucrado == 0  ){
         $involucrado=$this->persona_model->getInformacion($infraccion->dni_involucrado);
         $domiciliosInvolucrado=$this->getRowsDomicilioActionHtml($infraccion->cuil_involucrado,'Involucrado');
       } else if ( $infraccion->persona_establecer_involucrado == '1' ){
         $involucrado = $this->personatemporal_model->getPersona($infraccion->id_infraccion , 'involucrado');
       } 

       
       // Datos del propietario puede ser null dependienteo 
       // del Tipo de Persona Fisica
       if($infraccion->cuil_propietario!=null && $infraccion->tipo_persona == 'PF'){
         $propietario=$this->persona_model->getInformacion($infraccion->dni_propietario);
         $domiciliosPropietario=$this->getRowsDomicilioActionHtml($infraccion->cuil_propietario,'Propietario');
       } else if ($infraccion->persona_establecer_propietario == '1') {
         $propietario = $this->personatemporal_model->getPersona($infraccion->id_infraccion , 'propietario');
       }




       $data['departamentosPJ'] = [];
       $data['localidadesPJ'] =  [];    
       $data['barriosPJ'] =   [];

       $provincia = $this->provincia_model->findByName('JUJUY');
       $this->data['departamentosPJ']=$this->departamento_model->findByProvincia($provincia->id_provincia);
       if($infraccion->cuit_persona_juridica != null && $infraccion->tipo_persona == 'PJ'){
         $personaJuridica =  $this->personajuridica_model->findByCuitByIdInfraccion($infraccion->cuit_persona_juridica , $infraccion->id_infraccion);
         $this->data['barriosPJ'] = $this->barrio_model->findByLocalidad($personaJuridica->id_localidad);
         $this->data['callesPJ'] = $this->calle_model->findByBarrio($personaJuridica->id_barrio);
         $this->data['localidadesPJ']=$this->localidad_model->findByDepartamento($personaJuridica->id_departamento);
       
       }
      
       

       $this->data['involucrado']=$involucrado;
       $this->data['domiciliosInvolucrado']=$domiciliosInvolucrado;
       $this->data['propietario']=$propietario;
       $this->data['domiciliosPropietario']=$domiciliosPropietario;
       $this->data['personaJuridica'] = $personaJuridica;
         
      

       
       $this->data['infraccion']=$infraccion;
       $this->data['numero_acta'] = $infraccion->numero_acta;
            
        
       //Contravenciones titulos
       $this->data['titulo']='Infracciones / Vial';
       $this->data['subtitulo']="Editar Expediente Vial";
       $this->load->view('template',$this->data);
        
    }


    /**
      **/
    private function get_leyes_vial($detalles){
        $result = [];
        $index = 0;
        
    
        foreach ($detalles as $detalle) {
          $unidad = 0;
          if ( $detalle->unidad!= null && $detalle->unidad != '' ){
            $unidad = $detalle->unidad;
          }

            $row ='<tr id='.$index.'>'.
                  '<td width="120">'.
                  $this->get_leyes_select($index , $detalle->id_ley).
                  '</td>'.
                  '<td width="120">'.
                  $this->get_articulos_select($index , $detalle->id_ley , $detalle->id_articulo)
                  .'</td>'
                  .'<td width="120">'
                  .$this->get_inicisos_select($index , $detalle->id_articulo , $detalle->id_inciso)
                  .'</td>'
                  // unidades
                  .'<td width="100">'
                  .'<input type="text" readonly="true" class="form-control" name="unidades['.$index.']" value="'.$unidad.'"'
                  .' id="unidad_'.$index.'"'
                  .' oninput=moduleDetalleLey.validateNumber(this)></td>'
                  .'</td>'
                  .'<td width="100">'
                  .'<input type="text" readonly="true" class="form-control" name="descripcionley['.$index.']" '
                  .' value="'.$detalle->descripcion_ley.'"'
                  .' id="descripcionley_'.$index.'">'
                  .'</td>';


                  
                  if ( $detalle->estado_exhimido == '' || $detalle->estado_exhimido =='NO') {
                    $row = $row 
                    .'<td width="50" class="text-center">' 
                    .'<button type="button" id="action_exhimir_'.$index.'" onclick=moduleDetalleLey.exhimido('.$index.')' 
                    .' class="btn  default btn-xs blue"><strong>NO EXHIMIDO</strong></button>'
                    .'</td>';   
                  } else {
                    $row = $row 
                    .'<td width="50" class="text-center">' 
                    .'<button type="button" id="action_exhimir_'.$index.'" onclick=moduleDetalleLey.exhimido('.$index.')' 
                    .' class="btn  default btn-xs yellow"><strong>SI EXHIMIDO</strong></button>'
                    .'</td>';
                  }

                  // estado_exhimido ,
                  $row = $row 
                    .'<input type="hidden" readonly="true" class="form-control" '
                    .' name="estado_eximido['.$index.']" '
                    .' value="'.$detalle->estado_exhimido.'"'
                    .' id="estado_eximido_'.$index.'">'; 
                  // observaciones exhimido
                   $row = $row 
                    .'<input type="hidden" readonly="true" class="form-control" '
                    .' name="texto_eximido['.$index.']" '
                    .' value="'.$detalle->texto_exhimido.'"'
                    .' id="texto_eximido_'.$index.'">'; 
                  
                  $row = $row.'<td width="50">'
                  .'<div class="text-center"><button type="button" onclick=moduleDetalleLey.eliminarRow("tbodyDetalleInfraccion",'.$index.')'
                  .' class="btn default btn-xs red"><i class="fa fa-times"></i></button></div>'
                  .'</td>'
                  .'</tr>';

           $index++;     
           $result[] = $row;            
      }
      return $result;
  }

  private function get_leyes_select($index , $idSelected){
    $filterLeyes=[];
    $filterLeyes['nombre']=null;
    $filterLeyes['tipo_infraccion']='V';
      
    $leyes=$this->ley_model->buscar($filterLeyes);
    $select  =  '<select id="selectLey'.$index.'" onclick="moduleDetalleLey.selectLey(this)" class="form-control" row="'.$index.'" name="leyes['.$index.']">';
    $select  =  $select .'<option value="">Seleccionar</option>';
    $options = "";
    foreach ($leyes as $ley) {
        $unidad_fija = 0;
        if ( $ley->unidad_fija != null ){
          $unidad_fija = $ley->unidad_fija;
        }
        $options = $options .'<option value="'.$ley->id.'" unidad="'.$unidad_fija.'"'; 
        if ($ley->id === $idSelected) {
            $options = $options . ' selected';
         } 
        $options = $options .'>'.$ley->nombre; 
        $options = $options .'</option>';  
    }
    $select = $select .$options ."</select>";
    return $select;

  }

  /**
    * Funcion que permite generar los select 
    * de articulos
  **/
  private function get_articulos_select($index = 0 ,$idLey = 0 , $idArticuloSelected){
    $articulos=$this->articulo_model->getByLey($idLey);
    $select  =  '<select id="selectArticulo'.$index.'" onclick="moduleDetalleLey.selectArticulo(this)" '.
                'class="form-control" row="'.$index.'" name="articulos['.$index.']">';
    $select  = $select .'<option value="">Seleccionar</option>';
    $options = "";
    
    foreach ($articulos as $articulo) {
        $unidad_fija = 0;
        if ( $articulo->unidad_fija != null ){
          $unidad_fija = $articulo->unidad_fija;
        }
        $options = $options .'<option value="'.$articulo->id_articulo.'" unidad="'.$unidad_fija.'"' ; 
        if ($articulo->id_articulo === $idArticuloSelected) {
            $options = $options . ' selected';
         } 
        $options = $options .'>'.$articulo->nombre.'</option>';  
           
    }
    $select = $select .$options ."</select>";
    return $select;
  }

   /**
    * Funcion que permite generar los select 
    * de articulos
  **/
  private function get_inicisos_select($index = 0 ,$idArticulo = 0 , $idIncisoSelected){
    $incisos=$this->inciso_model->getByArticulo($idArticulo);
    $select  =  '<select id="selectInciso'.$index.'"'.
                '  onclick="moduleDetalleLey.selectInciso(this)"'. 
                'class="form-control" row="'.$index.'" name="incisos['.$index.']">';
    $select  = $select .'<option value="">Seleccionar</option>';
    $options = "";
    
    foreach ($incisos as $inciso) {
        $unidad_fija = 0;
          if ( $inciso->unidad_fija != null ){
          $unidad_fija = $inciso->unidad_fija;
        }
        $options = $options .'<option value="'.$inciso->id_inciso.'" unidad="'.$unidad_fija.'"' ; 
        if ($inciso->id_inciso === $idIncisoSelected) {
            $options = $options . ' selected';
         } 
        $options = $options .'>'.$inciso->nombre.'</option>';  
           
    }
    $select = $select .$options ."</select>";
        return $select;
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
       $this->filter['dni']=$_POST['dni'];
       $this->filter['dominio']=$_POST['dominio'];
       $this->filter['estado_pago'] =$_POST['estado_pago'];
       $this->filter['actual'] = null;

       $this->session->set_userdata('filter', $this->filter);

       $this->index($this->filter);     
    }



     /**
       * Funcion que permite verificar 
       * que el numero de acta no existe en la 
       * tabla de infracciones viales
      **/
     public function existeNumeroActa($numeroActa){
        $infraccion=$this->infraccion_model->existeNumeroActa($numeroActa);
        return $infraccion;
     }

    /**
      * Funcion que permite guardar la 
      * informacion
     **/
    public function guardar(){

        $status="";
        $message="";

   
        
        //Id infraccion
        $this->data['id'] = $this->input->post('id');
        //Section - Expediente
        $this->data['numero_expediente'] =  $this->input->post('numero_expediente');
        $this->data['fecha_ingreso'] = $this->input->post('fecha_ingreso');
        $this->data['numero_acta'] = trim($this->input->post('numero_acta'));
        $this->data['numero_expediente_entrante'] =$this->input->post('numero_expediente_entrante');
        $this->data['seccion']=$this->input->post('seccion');
        $this->data['paquete']=$this->input->post('paquete');
        $this->data['serie']=$this->input->post('serie');



        //Section -  Lugar del hecho
        $this->data['fecha_hecho']   = $this->input->post('fecha_hecho');
        $this->data['hora_hecho']    = $this->input->post('hora_hecho');
        $this->data['provincia']     = $this->input->post('provincia'); 
        $this->data['departamento']  = $this->input->post('departamento');
        $this->data['localidad']     = $this->input->post('localidad');
        $this->data['barrio']        = $this->input->post('barrio');
        $this->data['calle']         = $this->input->post('calle');
        $this->data['numero']        = $this->input->post('numero');
        $this->data['destacamento']  = $this->input->post('destacamento');
        $this->data['lugar_hecho']   = $this->input->post('lugar_hecho');

      

        //Datos del vehiculo 
        $this->data['tipovehiculo'] =$this->input->post('tipovehiculo');
        $this->data['marca']=$this->input->post('marca');
        $this->data['modelo']=$this->input->post('modelo');
        $this->data['dominio']=$this->input->post('dominio');

       

        // Datos para la infraccion vial   
        $this->data['propietario']       = $this->input->post('propietario');
        $this->data['involucrado']       = $this->input->post('involucrado');
        $this->data['documentoInvolucrado'] = $this->input->post('numeroDocumentoInvolucrado');
        $this->data['documentoPropietario'] = $this->input->post('numeroDocumentoPropietario');
        $this->data['dniEstablecerPropietario'] = $this->input->post('numeroDocumentoPropietario');
        $this->data['dniEstablecerInvolucrado'] = $this->input->post('numeroDocumentoInvolucrado');

        
        // Propietario
        $this->data['idPropietario']            = $this->input->post('idPropietario');   
        $this->data['nombrePropietario']        = $this->input->post('nombrePropietario');
        $this->data['apellidoPropietario']      = $this->input->post('apellidoPropietario');
        $this->data['tipoDocumentoPropietario'] = $this->input->post('tipoDocumentoPropietario');
        $this->data['numeroDocumentoPropietario'] = $this->input->post('numeroDocumentoPropietario');
        $this->data['fechaNacimientoPropietario'] = $this->input->post('fechaNacimientoPropietario');
        $this->data['nacionalidadPropietario']    = $this->input->post('nacionalidadPropietario');
        $this->data['sexoPropietario']            = $this->input->post('sexoPropietario');  
        $this->data['personaEstablecerPropietario'] = $this->input->post('personaEstablecerPropietarioValor');

        // Temporal Involucrado - Datos del Involucrado
        $this->data['idInvolucrado']            = $this->input->post('idInvolucrado');
        $this->data['nombreInvolucrado']        = $this->input->post('nombreInvolucrado');
        $this->data['apellidoInvolucrado']      = $this->input->post('apellidoInvolucrado');
        $this->data['tipoDocumentoInvolucrado'] = $this->input->post('tipoDocumentoInvolucrado');
        $this->data['numeroDocumentoInvolucrado'] = $this->input->post('numeroDocumentoInvolucrado');
        $this->data['fechaNacimientoInvolucrado'] = $this->input->post('fechaNacimientoInvolucrado');
        $this->data['nacionalidadInvolucrado']    = $this->input->post('nacionalidadInvolucrado');
        $this->data['sexoInvolucrado']            = $this->input->post('sexoInvolucrado');  
        $this->data['personaEstablecerInvolucrado'] = $this->input->post('personaEstablecerInvolucradoValor');
        
        // Persona Juridica
        $this->data['cuitPersonaJuridica'] = $this->input->post('cuitPersonaJuridica');
        

       //Tipo de Expediente 
       $this->data['tipo_expediente'] ='V'; 

        //Dictamen 
        $this->data['dictamen'] =$this->input->post('dictamen');

      

        //Tipo Persona 
        $this->data['tipoPersona'] = $this->input->post('tipo_persona');

        //Informacion Restantes 
        $this->data['numero_licencia']=$this->input->post('numero_licencia');
        $this->data['categoria']=$this->input->post('categoria');
        $this->data['autoridad']=$this->input->post('autoridad');
        $this->data['fecha_expedicion']=$this->input->post('fecha_expedicion');
        $this->data['fecha_vencimiento']=$this->input->post('fecha_vencimiento');
        $this->data['descripcion'] = $this->input->post('descripcionInformacion');   

  
        // Persona Juridica
        $this->data['idPersonaJuridica']           =  $this->input->post('idPersonaJuridica');
        $this->data['nombrePersonaJuridica']       =  $this->input->post('nombrePersonaJuridica');
        $this->data['cuitPersonaJuridica']         =  $this->input->post('cuitPersonaJuridica') ;
        $this->data['nombrePersonaJuridica']       =  $this->input->post('nombrePersonaJuridica');
        $this->data['numeroPersonaJuridica']       =  $this->input->post('numeroPersonaJuridica');
        $this->data['direccionPersonaJuridica']    =  $this->input->post('direccionPersonaJuridica');

           
        $numeroActa = $this->infraccion_model->existeNumeroActa($this->data['numero_acta']);
        $existeNumeroActa = false;

      
        if($this->data['personaEstablecerInvolucrado'] == '1') {
           $this->data['involucrado']       = '';
           $this->data['documentoInvolucrado'] = '';
        }

        
        if($this->data['personaEstablecerPropietario'] == '1') {
           $this->data['propietario']       = '';
           $this->data['documentoPropietario'] = '';
        }
  
        if ( $numeroActa != null ) {
           $existeNumeroActa =  true;
        }
        
        /*
        var_dump("tipo_persona ");   
        var_dump($this->input->post('tipo_persona'));
        var_dump("personaEstablecerPropietario");
        var_dump($this->input->post('personaEstablecerPropietarioValor'));
        var_dump("personaEstablecerInvolucrado");
        var_dump($this->input->post('personaEstablecerInvolucradoValor'));
        var_dump("after");
        var_dump($this->data['tipoPersona']);
        */

        if(empty($this->data['id']) && $existeNumeroActa) {
            $status = 'ERROR';
            $message = 'El numero de Acta existe. No se puede crear una nueva acta con este número';
        
        }else if (empty($this->data['id']) && !$existeNumeroActa) {

                $this->data['id'] = $this->infraccion_model->insert($this->data);
                //agregamos el estado al expediente 
                $this->estado['id_contravencion']=$this->data['id'];
                $this->estado['id_estado']=1;
                $this->estado['observacion']='Inicio de Expediente';

                
                //Guardamos las leyes 
                $this->data['id_']=$this->infraccionley_model->guardarLeyesInfraccion( $this->input->post('leyes'), 
                                                                                       $this->input->post('articulos'),
                                                                                       $this->input->post('incisos'),
                                                                                       $this->input->post('unidades'),
                                                                                       $this->input->post('estado_exhimido'),
                                                                                       $this->input->post('texto_eximido'),
                                                                                       $this->data['id']);
                  
                // Guardamos la persona juridica 
                if ( $this->input->post('tipo_persona') == 'PJ') {
                  $this->personajuridica_model->guardar($this->data);  
                }

                // Guardamos la persona a establecer Propietario Valor
                if($this->input->post('personaEstablecerPropietarioValor') == 1) {
                   $this->data['tipo_persona'] = 'propietario';
                   $this->data['id_infraccion'] = $this->data['id'];
                   $this->data['tipoPersona'] ='PE';
                   $this->personatemporal_model->guardarPropietario($this->data);
                }

                // Guardamos la persona a establecer Involucrado Valor
                if ($this->input->post('personaEstablecerInvolucradoValor') == 1 ) {
                   $this->data['tipo_persona'] = 'involucrado';
                   $this->data['id_infraccion'] = $this->data['id'];
                   $this->data['tipoPersona'] = 'PE';
                   $this->personatemporal_model->guardarInvolucrado($this->data); 
                } 

                $status="OK";
                $message="Se guardo el registro de Infraccion";
                 

         }else {
                
                //guardamos 
                $this->data['id_']=$this->infraccionley_model->guardarLeyesInfraccion( $this->input->post('leyes'), 
                                                                                       $this->input->post('articulos'),
                                                                                       $this->input->post('incisos'),
                                                                                       $this->input->post('unidades'),
                                                                                       $this->input->post('estado_eximido'),
                                                                                       $this->input->post('texto_eximido'),
                                                                                       $this->data['id']);
                $this->infraccion_model->update($this->data);

                
                // Update persona juridica  
                if ( $this->input->post('tipo_persona') == 'PJ') {
                     $this->personajuridica_model->guardar($this->data);  
                }

                // Guardasmos la persona a establecer Propietario Valor 
                if($this->input->post('personaEstablecerPropietarioValor') == 1) {
                   $this->data['tipo_persona'] = 'involucrado';
                   $this->data['id_infraccion'] = $this->data['id'];
                   $this->data['tipoPersona'] = 'PE';
                   if(empty($this->data['idPropietario'])) {
                      $this->personatemporal_model->guardarPropietario($this->data); 
                   } else {
                     $this->personatemporal_model->updatePropietario($this->data); 
                   }
                }  else if ($this->input->post('idPropietario') != "") {
                   $this->personatemporal_model->delete($this->input->post('idPropietario'));
                }

                // Guardamos la persona a establecer Involucrado Valor
                if ($this->input->post('personaEstablecerInvolucradoValor') == 1 ) {
                   $this->data['tipo_persona'] = 'involucrado';
                   $this->data['id_infraccion'] = $this->data['id'];
                   $this->data['tipoPersona'] = 'PE';
                   if(empty($this->data['idInvolucrado'])) {
                     $this->personatemporal_model->guardarInvolucrado($this->data);  
                    } else {
                     $this->personatemporal_model->updateInvolucrado($this->data);
                   } 
                } else if ( $this->input->post('idInvolucrado') != "") {
                  // Elimino porque se eliminaron los datos de persona a establecer
                  $this->personatemporal_model->delete($this->input->post('idInvolucrado'));
                }

                $status="OK";
                $message="Se actualizo la infraccion";
           
          
       }


     

      $json=[
              "status"=>$status,
              "message"=>$message
              ] ;
        
       echo json_encode($json);
       return;
            
    }


    /**
      * Funcion que permite obtener la informacion 
      * de la infraccion, retornando un json con los datos 
      * de propietario, infractor y el informe.

    **/
    public function get_informe($idInfraccion){

       $data =[];
       $infraccion=$this->infraccion_model->getById($idInfraccion);
       
       $data['infraccion'] = $infraccion; 
       $involucrado=null;
       $domiciliosInvolucrado=null;
       $domicilioInvolucrado = null;
       $propietario=null;
       $domiciliosPropietario=null;
       $domicilioPropietario = null;

       
     
       if($infraccion->cuil_involucrado!=null && $infraccion->dni_involucrado!=null){
          $involucrado=$this->persona_model->getInformacion($infraccion->dni_involucrado);
          $domiciliosInvolucrado=$this->persona_model->get_domicilios($infraccion->cuil_involucrado);
          $tmp = "";
          if($domiciliosInvolucrado != null && $domiciliosInvolucrado){
           foreach ($domiciliosInvolucrado as $domicilio) {
                
               $tmp = ""; 

               if ($domicilio->actual == 't') {
                    $domicilioInvolucrado =  $domicilio->barrio ."," . $domicilio->calle ."," . $domicilio->numero;
               }else{
                    $tmp =  $domicilio->barrio ."," . $domicilio->calle ."," . $domicilio->numero;
               }
           }

           if($domicilioInvolucrado == null ){
              $domicilioInvolucrado  = $tmp;
           }
        } 

       } else if ( $infraccion->dni_establecer_involucrado != null ) {
          $involucrado = $this->personatemporal_model->getPersona($infraccion->id_infraccion , 'involucrado'); 
       } 

       
       if($infraccion->cuil_propietario!=null && $infraccion->dni_propietario!=null){
        $propietario=$this->persona_model->getInformacion($infraccion->dni_propietario);
        $domiciliosPropietario=$this->persona_model->get_domicilios($infraccion->cuil_propietario);
          $tmp = "";
          if($domiciliosPropietario != null && $domiciliosPropietario){
           foreach ($domiciliosPropietario as $domicilio) {
                
               $tmp = ""; 

               if ($domicilio->actual == 't') {
                    $domicilioPropietario =  $domicilio->barrio ."," . $domicilio->calle ."," . $domicilio->numero;
               }else{
                    $tmp =  $domicilio->barrio ."," . $domicilio->calle ."," . $domicilio->numero;
               }
           }

           if($domicilioPropietario == null ){
              $domicilioPropietario  = $tmp;
           }
        } 

       } else if ($infraccion->persona_establecer_propietario == '1') {
         $propietario = $this->personatemporal_model->getPersona($infraccion->id_infraccion , 'propietario');
       }

       $data['involucrado']=$involucrado;
       $data['domicilioInvolucrado']=$domicilioInvolucrado;
       $data['propietario']=$propietario;
       $data['domicilioPropietario']=$domicilioPropietario;
       $personaJuridica = null ;
       if ( $infraccion->cuit_persona_juridica != null && $infraccion->id_infraccion != null ) {
        $personaJuridica =  $this->personajuridica_model->findByCuitByIdInfraccion($infraccion->cuit_persona_juridica , $infraccion->id_infraccion);
       }  
       $data['personaJuridica'] = $personaJuridica;
      
        
       //verificamos si existe un informe 
       $informe = $this->informe_model->getByIdInfraccion($idInfraccion);
       if($informe == null){
           //creamos el informe 
          $informe['id_infraccion'] = $idInfraccion;
          $id = $this->informe_model->insert($informe);
          $informe = $this->informe_model->getByIdInfraccion($idInfraccion);
       }     
        
       $data['informe'] =$informe;
       $data['status'] = "OK";

       echo json_encode($data);
       return;
    }

    function get($idInfraccion) {
       //verificamos si existe un informe 
       $infraccion = $this->infraccion_model->getById($idInfraccion);
       $data['infraccion'] =$infraccion;
       $data['status'] = "OK";

       echo json_encode($data);
       return;
    }



     function post_exhimir(){
      
      $json = json_decode(file_get_contents("php://input"));
      $this->data['id']   = $json->id;
      $this->data['descripcion']    = $json->descripcion; 
      $this->data['carece']         = $json->carece; 
      $this->data['estadoPago']     = INFRACCION_PAGO_EXHIMIDO;
      $this->data['fecha']          = $json->fecha; 

      $message="";
      $status="OK";
     
      $result =$this->infraccion_model->update_exhimido($this->data);
      if($result>0){
             $message="Se actualizo el estado de la denuncia a Exhimido";
             $status="OK";
       } else {
           $status="ERROR";  
       }
      
      $json=array();
      $json=[
             "status" => $status,
             "message" => $message, 
             "id" => $result
        ] ;
      echo json_encode($json);
      return ;
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