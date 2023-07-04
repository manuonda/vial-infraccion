<?php

/**
 * Clase correspondiente a Multas 
 * de Contraveciones
 * @dathe  : 06-10-2017
 * @author : dgarcia
 * */
class DepContravencional extends MY_Controller {

    /**
     * Constructor para cargar las librerias 
     * necesarias
     */
    function __construct() {
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

        $this->load->model('contravencion_model');


        //$this->load->model('contravencionarticuloinciso_model');
        //$this->load->model('infraccionarticuloinciso_model');
        //modal de leyes 
        $this->load->model('ley_model');



        $this->load->model('dependencia_model');
        $this->load->model('movimiento_model');
        $this->load->model('contravencionseccion_model');
        $this->load->model('contravencionleyes_model');
        

        $this->load->model('secuestro_model');
        $this->load->model('comercio_model');
        $this->load->model('rol_model');
        $this->load->model('domicilio_model');
        $this->load->model('comercio_domicilio_model');


        $this->load->model('calle_model');
        $this->load->model('barrio_model');
        $this->load->model('localidad_model');
        $this->load->model('departamento_model');
        $this->load->model('contravencioninvolucrado_model');
        $this->load->model('contravencionmovimiento_model');
        $this->load->model('categoria_model');
        $this->load->model('rubro_model');
        $this->load->model('tipocontravencion_model');

        $this->load->model('regional_model');

        //carga de secuestro de mercaderia
        $this->load->model('secuestro_model');

        //model
        // $this->load->model('expediente_model');
        //carga de categoria y rubro de los comercios
        $this->load->model('rubro_model');
    }

    /**
     *  Index
     */
    public function index($filter = null) {
        if ($this->ion_auth->logged_in()) {

            //$this->data['expedientes']=$this->expediente_model->get_all();
            $this->data['contenido'] = "contravencion/index_view.php";
            $this->data['titulo'] = "Contravenciones";
            $this->data['contravenciones'] = $this->contravencion_model->buscar($filter);
            $this->data['departamentos'] = $this->departamento_model->get_all(9); //provincia de jujuy = 9
            $this->data['regionales'] = $this->regional_model->get_all();
            $this->data['dependencias'] = $this->dependencia_model->get_all();
            $this->data['movimientos'] = $this->contravencionseccion_model->get_all();
            $this->data['tipo_contravenciones'] = $this->tipocontravencion_model->get_all();
            $this->data['rubros'] = $this->rubro_model->get_all();
            $this->data['secuestros'] = $this->secuestro_model->get_all();

            $this->data['filter'] = $filter;

            $this->load->view('template', $this->data);
        } else {
            redirect('admin/login');
        }
    }

    /**
     * Funcion que permite obtener los 
     * datos a filtrar de la busqueda mediante 
     * post
     * @param : post, parameters
     */
    public function buscar() {

        $this->filter['numero_expediente'] = $this->input->post('numero_expediente');
        $this->filter['numero_expediente_entrante'] = $this->input->post('numero_expediente_entrante');
        $this->filter['numero_acta'] = $this->input->post('numero_acta');
        $this->filter['fecha_desde'] = $this->input->post('fecha_desde');
        $this->filter['fecha_hasta'] = $this->input->post('fecha_hasta');
        $this->filter['id_tipo_contravencion'] = $this->input->post('id_tipo_contravencion');

        $this->index($this->filter);
    }

    /**
     * Funcion que permite agregar 
     * un expediente cargando la vista 
     * del expediente
     * */
    public function agregar($idTipoContravencion) {
        if ($idTipoContravencion == 'comercial') {
            $this->data['contenido']="contravencion/comercial/create_view.php";
            $this->data['titulo']="Contravenciones / Comercial";
            $this->data['subtitulo']="Agregar Acta Comercial";
            $this->data['detalleInfracciones']=null;
            $this->data['tipoContravencion']=1;   //Es comercial 
            $this->data['comercios']=null;
            
            $this->data['categorias']=$this->categoria_model->get_all();
            $this->data['rubros']=$this->rubro_model->get_all();

         } else {
            $this->data['contenido'] = "contravencion/otro/create_view.php";
            $this->data['detalleLeyes'] = null;
            $this->data['leyes'] = $this->ley_model->get_all();
            $this->data['titulo'] = "Contravención / Otros";
            $this->data['subtitulo'] = "Agregar Acta";
            $this->data['detalleInfracciones'] = null;
            $this->data['tipoContravencion'] = 2;  //Otros
            $this->data['involucrados'] = null;
            $this->data['juridicas'] = null;
            $this->data['localidades'] = null;
            $this->data['prueba']=1;
        }
        $this->data['domiciliosInvolucrado'] = null;
        /////////////////////////////////////////////////////////
        //filter leyes 
        //Obtenemos las leyes filtrado por el 
        //rol , que dependiendo de este Vial o Contravencional 
        //Se obtiene los tipos de leyes 
        $tipo_infraccion = $this->rol_model->getTipoInfraccionByRol($this->session->userdata('user_id'));
        $filterLeyes = [];
        $filterLeyes['nombre'] = null;
        if ($tipo_infraccion != null) {
            $filterLeyes['tipo_infraccion'] = $tipo_infraccion;
        }
        $this->data['leyes'] = $this->ley_model->buscar($filterLeyes);
        ///////////////////////////////////////////////////////////////
        // == Leyes
        $this->data['detalleLeyes'] = null;

        // == Seccion de encabezado
        $this->data['departamentos'] = $this->departamento_model->findByProvincia(9); //provinica de jujuy  9
        $this->data['secciones'] = $this->contravencionseccion_model->get_all(); //provinica de jujuy  9
        $this->data['movimientos'] = $this->contravencionmovimiento_model->get_all();
        $this->data['regionales'] = $this->regional_model->get_all();
        $this->data['dependencias'] = $this->dependencia_model->get_all();
        $this->data['secuestros'] = $this->secuestro_model->get_all();
        //Objeto contravencion 
        $this->data['contravencion'] = null;
        $this->load->view('template', $this->data);
    }

    /**
     * Funcion que permite editar una contravencion
     * enviando como parametro el id de la contravencion
     * * */
    public function editar($idContravencion) {
        $contravencion = $this->contravencion_model->getById($idContravencion);
      
        $tipoContravencion = null;
        //tupac secuestro
//        $secuestro = null;
        
        if ($contravencion != null) {
            if ($contravencion->id_tipo_contravencion == 1) { //Comercial
                $this->data['contenido'] = "contravencion/comercial/create_view.php";
                $this->data['titulo'] = "Contravenciones / Comercial";
                $this->data['subtitulo'] = "Editar Comercial";
                $this->data['tipoContravencion'] = 1;   //Es comercial

                $involucrado = $this->persona_model->getInformacion($contravencion->cuil_involucrado);
                $domiciliosInvolucrado = $this->persona_model->get_domicilios($contravencion->cuil_involucrado);
                //var_dump($domiciliosInvolucrado);


                $this->data['involucrado'] = $involucrado;
                $this->data['domiciliosInvolucrado'] = $domiciliosInvolucrado;

                //Obtenemos los comercios del involucrado
                //asociados
                $comercios = $this->comercio_model->getListById($idContravencion);
//               var_dump($comercios);
//               echo "rest---".$comercios[0]->id."--esto";
//               var_dump(isset($comercios));
//               exit();
               $domic_a = NULL;
               $deno = NULL;
               $cuit_c = NULL;
               $rubro_c = NULL;
               $cat_c = NULL;
               $numero_c = NULL;
               
                $id_calle = NULL;
                $id_barrio=NULL;
                $id_localidad=NULL;
                $id_departamento=NULL;                    
               
               if (isset($comercios)) {
//                    echo "ingreso Comercio";
                    $dom_a = $this->comercio_model->get_domicilio($comercios[0]->id);
                    $deno = $comercios[0]->denominacion;
                    $cuit_c = $comercios[0]->cuitComercio;
                    $rubro_c = $comercios[0]->rubro;
                    $cat_c = $comercios[0]->categoria;                    
                    $domic_a = $dom_a[0];

                    if (isset($dom_a)) {
//                        $domic_a = $dom_a[0];
                        $id_calle = $dom_a[0]->id_calle;
                        $numero_c = $dom_a[0]->numero;
                        
                        $calle=$this->calle_model->getById($id_calle);
                        $barrio=$this->barrio_model->getById($calle->id_barrio);
                        $localidad=$this->localidad_model->getById($barrio->id_localidad);
                        $departamento=$this->departamento_model->getById($localidad->id_departamento);
//                        $id_calle=$calle->id_calle;
                        $id_barrio=$barrio->id_barrio;
                        $id_localidad=$localidad->id_localidad;
                        $id_departamento=$departamento->id_departamento;                              
                    } //else {
//                        $domic_a = $dom_a[0];
//                        $numero_c = NULL;                        
//                        $id_calle=NULL;                        
//                        $id_calle = NULL;
//                        $id_barrio=NULL;
//                        $id_localidad=NULL;
//                        $id_departamento=NULL;                          
//                    }
                }
//
//              $this->data['id_calle']=$calle->id_calle;
//              $this->data['id_barrio']=$barrio->id_barrio;
//              $this->data['id_localidad']=$localidad->id_localidad;
//              $this->data['id_departamento']=$departamento->id_departamento;                  
//              var_dump($calle);
//              var_dump($barrio);
//              exit();
              $this->data['id_calle']=$id_calle;
              $this->data['id_barrio']=$id_barrio;
              $this->data['id_localidad']=$id_localidad;
              $this->data['id_departamento']=$id_departamento;              
              
              $this->data['departamentos']=$this->departamento_model->findByProvincia(9);
              $this->data['localidades']=$this->localidad_model->findByDepartamento($id_departamento);
              $this->data['barrios']=$this->barrio_model->findByLocalidad($id_localidad);
              $this->data['calles']=$this->calle_model->findByBarrio($id_barrio);              
//              $this->data['localidades']=$this->localidad_model->findByDepartamento($localidad->id_departamento);
//              $this->data['barrios']=$this->barrio_model->findByLocalidad($barrio->id_localidad);
//              $this->data['calles']=$this->calle_model->findByBarrio($calle->id_barrio);  

               
               $this->data['comercios']=$comercios;
               $this->data['deno']=$deno;
               $this->data['cuit_c']=$cuit_c;
               $this->data['rubro_c']=$rubro_c;
               $this->data['cat_c']=$cat_c;
               $this->data['numero_c']=$numero_c;
               $this->data['domicilio_actual']=$domic_a;
               $this->data['categorias']=$this->categoria_model->get_all();
               $this->data['rubros']=$this->rubro_model->get_all();
                //tupac secuestro
                $this->data['secuestros'] = $this->secuestro_model->get_all();
//                
//                $this->data['optionsRadios'] = $this->contravencion_model->get_all();
//                
//                
//               $optionsRadios =$this->contravencion_model->getById($contravencion->radiosecuestro);
//               
               $secuestro = $this->secuestro_model->getById($contravencion->id_secuestro);               
            } else if ($contravencion->id_tipo_contravencion == 2) {
                $this->data['detalleInfracciones'] = null;
                $this->data['leyes'] = $this->ley_model->get_all();
                $this->data['contenido'] = "contravencion/otro/create_view.php";
                $this->data['titulo'] = "Contravención / Otros";
                $this->data['subtitulo'] = "Editar Acta";
                $this->data['tipoContravencion'] = 2;  //Otros
                //***********************************************
                //Lugar del hecho 
                /* $this->data['fecha_hecho']=$contravencion->fecha_hecho;
                  $this->data['hora_hecho']=$contravencion->hora_hecho;
                 */
                $calle = $this->calle_model->getById($contravencion->id_calle);
                $barrio = $this->barrio_model->getById($calle->id_barrio);
                $localidad = $this->localidad_model->getById($barrio->id_localidad);
                $departamento = $this->departamento_model->getById($localidad->id_departamento);

                $this->data['id_calle'] = $calle->id_calle;
                $this->data['id_barrio'] = $barrio->id_barrio;
                $this->data['id_localidad'] = $localidad->id_localidad;
                $this->data['id_departamento'] = $departamento->id_departamento;

                $this->data['departamentos'] = $this->departamento_model->findByProvincia(9);
                $this->data['localidades'] = $this->localidad_model->findByDepartamento($localidad->id_departamento);
                $this->data['barrios'] = $this->barrio_model->findByLocalidad($barrio->id_localidad);
                $this->data['calles'] = $this->calle_model->findByBarrio($calle->id_barrio);
                $this->data['departamentos'] = $this->departamento_model->findByProvincia(9); //provincia de jujuy  9
                //involucrados
//                var_dump($idContravencion);
                $request = $this->contravencioninvolucrado_model->getListById($idContravencion);
//                var_dump($request);
//                exit();
                $involucrados = array();
                foreach ($request as $involucrado) {

                    $domicilios = array();
                    $domicilios = $this->persona_model->get_domicilios($involucrado->cuil_involucrado);
                    $listDomicilio = "";
                    if ($domicilios != null) {
                        $listDomicilio = "<ul>";
                        foreach ($domicilios as $key) {
                            
                            if($key->actual == 't'){
//                                var_dump($key->actual);
                                $li = "<li>" . $key->calle . "," . $key->numero . "," . $key->barrio . "</li>";
                                $listDomicilio = $listDomicilio . $li;
                            }
                        }
                        $listDomicilio = $listDomicilio . "</ul>";
                        $involucrados[] = [
                            "persona" => $involucrado,
                            "domicilios" => $listDomicilio
                        ];
                    } else {
                        $involucrados[] = [
                            "persona" => $involucrado,
                            "domicilios" => ""];
                    }

//                $this->data['involucrados'] = $involucrados;
            }
//buscar personas juridicas            
                $comercios_ju = $this->comercio_model->getListById_j($idContravencion);
                //$request_j = $this->contravencioninvolucrado_model->getListById($idContravencion);
//                var_dump($comercios_ju);
//                exit();
//                $involucrados = array();            
            
//-----------------            
            $this->data['juridicas'] = $comercios_ju;
            $this->data['involucrados'] = $involucrados;
            $this->data['prueba']=0;
           
            $this->data['secuestros'] = $this->secuestro_model->get_all();
            
            
            
            
            $secuestro = $this->secuestro_model->getById($contravencion->id_secuestro);  
            }


        //Detalle de las leyes que tiene la contravencion
//       $this->data['detalleLeyes']=$this->contravencionleyes_model->getListById($idContravencion);
         $leyes=$this->contravencionleyes_model->getListById($idContravencion);
	 $this->data['detalleLeyes']=$leyes;
        // == Leyes del modal  
        //filter leyes 
        //Obtenemos las leyes filtrado por el 
        //rol , que dependiendo de este Vial o Contravencional 
        //Se obtiene los tipos de leyes 
        $tipo_infraccion = $this->rol_model->getTipoInfraccionByRol($this->session->userdata('user_id'));
        $filterLeyes = [];
        $filterLeyes['nombre'] = null;
        if ($tipo_infraccion != null) {
            $filterLeyes['tipo_infraccion'] = $tipo_infraccion;
        }else{
            $filterLeyes['tipo_infraccion']=null;
        }
        $this->data['leyes'] = $this->ley_model->buscar($filterLeyes);
        ///////////////////////////////////////////////////////////////
        // ==  Parte del expediente ==
        $this->data['secciones'] = $this->contravencionseccion_model->get_all(); //provinica de jujuy  9
        $this->data['movimientos'] = $this->contravencionmovimiento_model->get_all();
        $this->data['regionales'] = $this->regional_model->get_all();
        $this->data['dependencias'] = $this->dependencia_model->get_all();
        //Datos de la contravencion 
        $this->data['id'] = $contravencion->id_contravencion;
        $this->data['contravencion'] = $contravencion;

       }          
        $this->load->view('template', $this->data);
    }
    /**

      * Funcion que permite guardar 
      * contravenciones de tipo comercial
     */   
    public function guardarComercial(){
//        echo $this->input->post('cuitComercio');
//        echo "<br> esto es cuitComercio";
        
//        var_dump($this->input->post('barrio'));
//        var_dump($this->input->post('calle'));
//        var_dump($this->input->post('calle_d'));
//        
//        exit();
      $this->data['id'] = $this->input->post('id');
//      var_dump($this->data);
//      exit();
      //Section - Expediente
      $this->data['num_exp_cont'] =  $this->input->post('num_exp_cont');
      $this->data['fecha_ingreso'] = $this->input->post('fecha_ingreso');
      $this->data['fecha_hecho'] = $this->input->post('fecha_hecho');
      $this->data['num_acta_cont'] = $this->input->post('num_acta_cont');
      $this->data['regional'] = $this->input->post('regional');
      $this->data['num_exp_ent'] = $this->input->post('num_exp_ent');
      $this->data['dependencia'] = $this->input->post('dependencia');
      $this->data['involucrado']=$this->input->post('involucrado'); 
      $this->data['tipocontravencion']=$this->input->post('tipocontravencion');
      $this->data['sentencia']=$this->input->post('sentencia');
      $this->data['descripcion']=$this->input->post('descripcion');
      
      $this->data['optionsRadios']=$this->input->post('optionsRadios');     
      $this->data['secuestro']=$this->input->post('secuestro');  
      
      $this->data['denominacion']=$this->input->post('denominacionComercio');  
      $this->data['cuitComercio']=$this->input->post('cuitComercio'); 
      
      if($this->data['cuitComercio'] == NULL or $this->data['cuitComercio'] == '' or $this->data['cuitComercio'] == ' '){
            $this->data['cuitComercio'] = 0;
      }
      $this->data['categoria'] = $this->input->post('categoriaComercio');
      $this->data['rubro'] = $this->input->post('rubroComercio');      
      $this->data['departamento'] = $this->input->post('departamento');
      $this->data['localidad'] = $this->input->post('localidad');
      $this->data['barrio'] = $this->input->post('barrio');
      $this->data['calle'] = $this->input->post('calle');      
      $this->data['manzana']=$this->input->post('manzana'); 
      $this->data['lote']=$this->input->post('lote'); 
      $this->data['sector']=$this->input->post('sector');       
      $this->data['depto']=$this->input->post('depto');  
      $this->data['piso']=$this->input->post('piso'); 
      $this->data['monoblock']=$this->input->post('monoblock'); 
      $this->data['numero_direccion']=$this->input->post('numero_direccion'); 
             
        $this->data['optionsRadios'] = $this->input->post('optionsRadios');
        $this->data['secuestro'] = $this->input->post('secuestro');
        

        $this->data['observacion_gral'] = $this->input->post('observacion_gral');
//      $this->data['manzana']=$this->input->post('manzana');
        

        //Leyes
        $leyes[]=$this->input->post('leyes');
//var_dump($this->data);
//exit();

      
        if($this->input->post('optionsRadios')==1){
            $this->data['secuestro'] = null;
        }else{
            $this->data['secuestro'] = $this->input->post('secuestro');
        }


        //Comercios
//      
        $status = "";
        $message = "";


        if(empty($this->data['id'])) {
            $x= $this->contravencion_model->getById_max();
            $y= $this->contravencion_model->getById($x->id_contravencion);

            if($y->anio_expediente == ANIO_ACTUAL_EXPEDIENTE){
                $this->data['num_exp_cont'] = $y->numero_expediente + 1;
            }else{
                $this->data['num_exp_cont'] = 1;
            }

            $this->data['anio_expediente'] = ANIO_ACTUAL_EXPEDIENTE;
            
                $this->data['id'] = $this->contravencion_model->insertComercial($this->data);
                //actualizar num_expediente
//                $this->contravencion_model->update_num_exp($this->data);
                //agregamos el estado al expediente 
                $this->estado['id_contravencion']=$this->data['id'];
                //Guardamos las leyes 
                $this->contravencionleyes_model->agregarLeyes($this->input->post('leyes'),$this->data['id']);
                 //Guardamos los comercios
                //reeeeeeeeeeeeeeee
                $this->agregacomercionew2($this->data['id'],$this->input->post('involucrado'),$this->data);
//                $this->agregacomercionew2($this->input->post('comercios'),$this->data['id'],$this->input->post('involucrado'),$this->data);                


                //Indicamos el estado de la contravencion
                //Verificamos si existe leyes y si el numero de acta esta vacio
                 
                if(sizeof($leyes[0])>0 && strlen($this->input->post('num_acta_cont'))>0 && $this->input->post('num_acta_cont')!=""){
                   $this->data['id_contravencion']=$this->data['id'];
                   $this->data['id_movimiento']=MOVIMIENTO_INICIO;
                   $this->data['observacion']=OBSERVACION_INICIAL;
                   $this->data['id_seccion']=null;
                   $this->data['id_contravencion_movimiento']=$this->contravencionmovimiento_model->insert($this->data);
                   $this->contravencion_model->actualizarMovimiento($this->data);
                    //var_dump("MOVIMIENOT INICIO"); 
                 
                 }else {                
                    //Creamos el estado Inicial de la Contravencion 
                    $this->data['id_contravencion']=$this->data['id'];
                    $this->data['id_movimiento']=MOVIMIENTO_INFORMATIVO;
                    $this->data['observacion']=OBSERVACION_INFORMATIVO;
                    $this->data['id_seccion']=null;
                    $this->data['id_contravencion_movimiento']=$this->contravencionmovimiento_model->insert($this->data);  
                    $this->contravencion_model->actualizarMovimiento($this->data);
                    //var_dump("MOVIMIENTO INFORMATIVO");
                   //echo "vacios ambios";
                   
                 } 
                $status="OK";
                $message="Se guardo el registro de Contravencion";

            
        } else {

            //Verifico si tiene leyes,nro_acta y su estado actual es informativo
            if (sizeof($leyes[0]) > 0 && strlen($this->input->post('num_acta_cont')) > 0 && $this->input->post('num_acta_cont') != "" && $this->input->post('movimiento') == MOVIMIENTO_INFORMATIVO) {
                $this->data['id_contravencion'] = $this->data['id'];
                $this->data['id_movimiento'] = MOVIMIENTO_INICIO;
                $this->data['observacion'] = OBSERVACION_INICIAL;
                $this->data['id_seccion'] = null;
                $this->data['id_contravencion_movimiento'] = $this->contravencionmovimiento_model->insert($this->data);
                $this->contravencion_model->actualizarMovimiento($this->data);
            }
            $this->contravencion_model->updateComercial($this->data);
            $this->comercio_model->updateComercio($this->data);
            $id_c = $this->comercio_model->getListById($this->data['id']);
            
//            var_dump($id_c);
//            exit();
            $result_c = $this->comercio_domicilio_model->get_domicilio_actual($id_c[0]->id);
//            var_dump($result_c);
//                            $retorno = $this->comercio_model->getListById($this->data['id']);                
//                            var_dump($retorno);
//                            var_dump($this->data['id']);
//            exit();

            if (isset($result_c)) {
//                echo "ingreso ahora";
//                exit();
                $this->domicilio_model->updatedomicilio($this->data, $result_c->id_domicilio);
            } else {
                // $data2['id_tipo_domicilio'] = 3;   //id: tipo domicilio comercial           
                $data2['id_departamento'] = $this->data['departamento'];   //id: id_departamento
                $data2['id_localidad'] = $this->data['localidad'];   //id: id_localidad
                $data2['id_barrio'] = $this->data['barrio'];   //id: id_barrio
                $data2['id_calle'] = $this->data['calle'];   //id: id_calle 
                $data2['numero'] = $this->data['numero_direccion'];   //id: numero 
                $data2['descripcion'] = $this->data['descripcion'];   //id: descripcion 
                $data2['manzana'] = $this->data['manzana'];   //id: manzana
                $data2['lote'] = $this->data['lote'];   //id: lote           
                $data2['sector'] = $this->data['sector'];   //id: sector 
                $data2['depto'] = $this->data['depto'];   //id: depto 
                $data2['piso'] = $this->data['piso'];   //id: piso 
                $data2['monoblock'] = $this->data['monoblock'];   //id: monoblock                     
                $data2['id_tipo_domicilio'] = 3;   //id: tipo domicilio comercial  

                $retorno2 = $this->domicilio_model->guardar($data2); // insert domicilio de comercio.

                $data3['id_comercio'] = $id_c[0]->id;   //id: id_comercio
                $data3['id_domicilio'] = $retorno2;   //id: id_domicilio          
                $retorno3 = $this->comercio_domicilio_model->guardar($data3); // inser comercio_domicilio
//                $retorno = $this->comercio_model->getListById($this->data['id']);
            }


            //Guardamos las leyes 
            $this->data['id_'] = $this->contravencionleyes_model->agregarLeyes($this->input->post('leyes'), $this->data['id']);
           
            
            $this->contravencion_model->updateComercial($this->data);
            //Guardamos comercios 
            $status = "OK";
            $message = "Se actualizo la Contravencion";
        }


        $json = [
            "status" => $status,
            "message" => $message
        ];

        echo json_encode($json);
        return;
    }  
    
    public function agregacomercionew2($idContravencion,$cuil_involucrado, $dat){   
//        echo "system cont <br>";
//        var_dump($dat);
//        exit();
      if(!empty($dat) && !empty($idContravencion)){
        //Borramos los comercios
//          echo "esta dentro No vacio";
//          exit();
        $this->comercio_model->deleteComercios($idContravencion);
        
        
        //$this->deleteComercios($idContravencion);
//        foreach($comercios as  $comercio){
//          $valores=explode('-',$comercio);
          $data['id_comercio']=0;   //id: id_comercio 
          $data['denominacion']=$dat['denominacion'];      //denominacion
          $data['cuitComercio']=$dat['cuitComercio'];      //denominacion
          $data['categoria']=$dat['categoria'];      //denominacion
          $data['rubro']=$dat['rubro'];      //denominacion
//          $data['ubicacion']=$valores[5];    //ubicacion
          $data['cuil_propietario']=$cuil_involucrado;    //cuil propietario
           
          $data['id_contravencion']=$idContravencion; //id_contravencion
          $data2['id_departamento']=$dat['departamento'];   //id: id_departamento
          $data2['id_localidad']=$dat['localidad'];   //id: id_localidad
          $data2['id_barrio']=$dat['barrio'];   //id: id_barrio
          $data2['id_calle']=$dat['calle'];   //id: id_calle 
          $data2['numero']=$dat['numero_direccion'];   //id: numero 
          $data2['descripcion']=$dat['descripcion'];   //id: descripcion 
          $data2['manzana']=$dat['manzana'];   //id: manzana
          $data2['lote']=$dat['lote'];   //id: lote           
          $data2['sector']=$dat['sector'];   //id: sector 
          $data2['depto']=$dat['depto'];   //id: depto 
          $data2['piso']=$dat['piso'];   //id: piso 
          $data2['monoblock']=$dat['monoblock'];   //id: monoblock                     
          $data2['id_tipo_domicilio']=3;   //id: tipo domicilio comercial           
//          $data2['id_comercio']=$valores[0];   //id: id_comercio           
          //Guardamos los comercios
          $retorno = $this->comercio_model->guardar($data);
          $retorno2 = $this->domicilio_model->guardar($data2);
          $data3['id_comercio']=$retorno;   //id: id_comercio
          $data3['id_domicilio']=$retorno2;   //id: id_domicilio          
          $retorno3 = $this->comercio_domicilio_model->guardar($data3);
//          exit();
     }
//     echo "se inserto";
    }    
            

    public function agregacomercionew($comercios, $idContravencion, $cuil_involucrado) {
        if (!empty($comercios) && !empty($idContravencion)) {

            //Borramos los comercios
            $this->comercio_model->deleteComercios($idContravencion);
            //$this->deleteComercios($idContravencion);
            foreach ($comercios as $comercio) {
                $valores = explode('-', $comercio);
//          var_dump($valores);
//          exit();
                $data['id_comercio'] = $valores[0];   //id: id_comercio 
                $data['denominacion'] = $valores[1];      //denominacion
                $data['cuit_comercio'] = $valores[2];          //cuit comercio
                $data['categoria'] = $valores[3];     //id_inciso
                $data['rubro'] = $valores[4];         //rubro
                $data['ubicacion'] = $valores[5];    //ubicacion
                $data['cuil_propietario'] = $cuil_involucrado;    //cuil propietario


                $data['id_contravencion'] = $idContravencion; //id_contravencion
                $data2['id_departamento'] = $valores[6];   //id: id_departamento
                $data2['id_localidad'] = $valores[7];   //id: id_localidad
                $data2['id_barrio'] = $valores[8];   //id: id_barrio
                $data2['id_calle'] = $valores[9];   //id: id_calle 
                $data2['numero'] = $valores[10];   //id: numero 
                $data2['descripcion'] = $valores[11];   //id: descripcion 
                $data2['manzana'] = $valores[12];   //id: manzana
                $data2['lote'] = $valores[13];   //id: lote           
                $data2['sector'] = $valores[14];   //id: sector 
                $data2['depto'] = $valores[15];   //id: depto 
                $data2['piso'] = $valores[16];   //id: piso 
                $data2['monoblock'] = $valores[17];   //id: monoblock 


                $data2['id_tipo_domicilio'] = 3;   //id: tipo domicilio comercial           
//          $data2['id_comercio']=$valores[0];   //id: id_comercio           
                //Guardamos los comercios
                $retorno = $this->comercio_model->guardar($data);
//          var_dump($retorno);

                $retorno2 = $this->domicilio_model->guardar($data2);
//          echo "luego de domicilio";
//          exit();
//          var_dump($retorno2);
                $data3['id_comercio'] = $retorno;   //id: id_comercio
                $data3['id_domicilio'] = $retorno2;   //id: id_domicilio          
                $retorno3 = $this->comercio_domicilio_model->guardar($data3);
//          $retorno =$this->guardar($data);
//          var_dump($retorno3);
            }
        }
    }

    /**

      * Funcion que permite guardar otros 
      * tipos de contravencion
     **/
    public function guardarOtro(){
      $this->data['id'] = $this->input->post('id');
      $this->data['num_exp_cont'] =  $this->input->post('num_exp_cont');
      $this->data['fecha_ingreso'] = $this->input->post('fecha_ingreso');
      $this->data['num_acta_cont'] = $this->input->post('num_acta_cont');
//      $this->data['num_acta_cont1'] = $this->input->post('num_acta_cont1');
//      var_dump($this->input->post('num_acta_cont'));
//      exit();
      
      $this->data['regional'] = $this->input->post('regional');
      $this->data['num_exp_ent'] = $this->input->post('num_exp_ent');
      $this->data['dependencia'] = $this->input->post('dependencia');
      $this->data['involucrado']=$this->input->post('involucrado'); 
      $this->data['tipocontravencion']=$this->input->post('tipocontravencion');
      //$this->data['sentencia']=$this->input->post('sentencia');
     
      $this->data['optionsRadios']=$this->input->post('optionsRadios');     
      $this->data['secuestro']=$this->input->post('secuestro');  
	  
      $this->data['observacion_gral']=$this->input->post('observacion_gral');
      $this->data['descripcion']=$this->input->post('descripcion');

        //Section -  Lugar del hecho

        $this->data['fecha_hecho']   = $this->input->post('fecha_hecho');
        $this->data['hora_hecho']    = $this->input->post('hora_hecho');
        $this->data['departamento']  = $this->input->post('departamento');
        $this->data['localidad']     = $this->input->post('localidad');
        $this->data['barrio']        = $this->input->post('barrio');
        $this->data['calle']         = $this->input->post('calle');
        $this->data['numero_direccion']        = $this->input->post('numero_direccion');
        
        $this->data['manzana']        = $this->input->post('manzana');
        $this->data['lote']        = $this->input->post('lote');
        $this->data['sector']        = $this->input->post('sector');
        $this->data['depto']        = $this->input->post('depto');
        $this->data['piso']        = $this->input->post('piso');                        
        $this->data['monoblock']        = $this->input->post('monoblock');                        

        //Leyes
        $leyes[] = $this->input->post('leyes');

        if($this->input->post('optionsRadios')==1){
            $this->data['secuestro'] = null;
        }else{
            $this->data['secuestro'] = $this->input->post('secuestro');
        }

        if (empty($this->data['id'])) {            
            $x= $this->contravencion_model->getById_max();
            $y= $this->contravencion_model->getById($x->id_contravencion);

            if($y->anio_expediente == ANIO_ACTUAL_EXPEDIENTE){
                $this->data['num_exp_cont'] = $y->numero_expediente + 1;
            }else{
                $this->data['num_exp_cont'] = 1;
            }

            $this->data['anio_expediente'] = ANIO_ACTUAL_EXPEDIENTE;            
            

            
            $this->data['id'] = $this->contravencion_model->insertOtros($this->data);
            //$this->data['id'];
            //actualizar num_expediente
            
//            $this->contravencion_model->update_num_exp($this->data);
            //agregamos el estado al expediente 
            $this->estado['id_contravencion'] = $this->data['id'];

            //Guardamos las leyes 
            $this->contravencionleyes_model->agregarLeyes($this->input->post('leyes'), $this->data['id']);

            if (sizeof($leyes[0]) > 0 && strlen($this->input->post('num_acta_cont')) > 0 && $this->input->post('num_acta_cont') != "") {
                $this->data['id_contravencion'] = $this->data['id'];
                $this->data['id_movimiento'] = MOVIMIENTO_INICIO;
                $this->data['observacion'] = OBSERVACION_INICIAL;
                $this->data['id_seccion'] = null;
                $this->data['id_contravencion_movimiento'] = $this->contravencionmovimiento_model->insert($this->data);
                $this->contravencion_model->actualizarMovimiento($this->data);
            } else {

                //Creamos el estado Inicial de la Contravencion 
                $this->data['id_contravencion'] = $this->data['id'];
                $this->data['id_movimiento'] = MOVIMIENTO_INFORMATIVO;
                $this->data['observacion'] = OBSERVACION_INFORMATIVO;
                $this->data['id_seccion'] = null;
                $this->data['id_contravencion_movimiento'] = $this->contravencionmovimiento_model->insert($this->data);
                $this->contravencion_model->actualizarMovimiento($this->data);

                //echo "vacios ambios";
            }

            //Guardamos los involucrados
            $this->contravencioninvolucrado_model->agregarInvolucrados($this->input->post('involucrados'), $this->data['id']);
            $this->comercio_model->updateJuridica($this->input->post('juridicas'), $this->data['id']);
            $status = "OK";
            $message = "Se guardo el registro de Contravención";
        } else {

            //Verifico si tiene leyes,nro_acta y su estado actual es informativo
            if (sizeof($leyes[0]) > 0 && strlen($this->input->post('num_acta_cont')) > 0 && $this->input->post('num_acta_cont') != "" && $this->input->post('movimiento') == MOVIMIENTO_INFORMATIVO) {
                $this->data['id_contravencion'] = $this->data['id'];
                $this->data['id_movimiento'] = MOVIMIENTO_INICIO;
                $this->data['observacion'] = OBSERVACION_INICIAL;
                $this->data['id_seccion'] = null;
                $this->data['id_contravencion_movimiento'] = $this->contravencionmovimiento_model->insert($this->data);
                $this->contravencion_model->actualizarMovimiento($this->data);
            }

            $this->contravencion_model->updateOtro($this->data);
            //Guardamos las leyes 
            $this->contravencionleyes_model->agregarLeyes($this->input->post('leyes'), $this->data['id']);

            //Guardamos involucrados 
            $this->contravencioninvolucrado_model->agregarInvolucrados($this->input->post('involucrados'), $this->data['id']);
//            $this->contravencioninvolucrado_model->insert_involucrado($this->input->post('involucrados'), $this->data['id']);
            $this->comercio_model->updateJuridica($this->input->post('juridicas'), $this->data['id']);

            $status = "OK";
            $message = "Se actualizo la Contravención";
        }

        $json = [
            "status" => $status,
            "message" => $message
        ];

        echo json_encode($json);
        return;
    }

    /**
     * Funcion que permite obtener los 
     * involucrados de la contravencion
     * @param type $idContravencion
     */
    function get_involucrados($idContravencion) {
        $request = $this->contravencioninvolucrado_model->getListById($idContravencion);
        $involucrados = array();
        foreach ($request as $involucrado) {
            $domicilios = [];
            $domicilios = array();
            $domicilios = $this->persona_model->get_domicilios($involucrado->cuil_involucrado);
            $involucrados[] = [
                "persona" => $involucrado,
                "domicilios" => $domicilios
            ];
        }
        echo json_encode($involucrados);
    }

    //function para que llame a la vista de infracciones del involucrado tupac



    function get_infracciones($idContravencion) {
        $request = $this->contravencionleyes_model->getListById($idContravencion);
        echo json_encode($request);
    }

}

?>