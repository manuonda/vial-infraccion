<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Articulo extends MY_Controller {

      function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
//    
        $this->load->model('articulo_model');
        $this->load->model('ley_model');

        //Cargamos el Helper para el uso del BASE_URL()
        $this->load->helper('url');
    }


    /**
     *  Index
     */
      public function index($filter=null,$message=null,$idLey=null){
       if ($this->ion_auth->logged_in()) {
            
           $rol=null;
           $tipo_infraccion=null;

           $this->session->userdata('user_id');  
           $query = $this->db->select
                  ('rol.name')
                ->join('usuarios_roles ur', 'ur.id_usuario=u.id')
                ->join('roles rol','ur.id_rol=rol.id')
                ->where('u.id',$this->session->userdata('user_id'))
                ->limit(1)
                ->get($this->tables['users'].' as u');
                           
          
            //filter vial 
            if($filter==null){
              $filter['nombre']=null;
              $filter['idLey']=null;  
              $filter['tipo_infraccion']='V';
            }else{
              $filter['tipo_infraccion']='V';
            }
            
      
              
           //listado de combo de leyes
            $filterLeyes=[];
            $filterLeyes['tipo_infraccion']='V';
            $filterLeyes['nombre']=null;
            $leyes=$this->ley_model->buscar($filterLeyes);


            //Enviamos datos a la pantalla
            $this->data['leyes']=$leyes;
            $this->data['tipo_infraccion']=$tipo_infraccion;
            $this->data['message']=$message;
            $this->data['contenido'] = "articulos/index_view.php";
            $this->data['titulo']="Articulos";
            $this->data['filter']=$filter;
            $this->data['articulos']=$this->articulo_model->buscar($filter);
            $this->load->view('template', $this->data);
        } else {
            redirect('admin/login');
        }
   

    }



    /**
      * Funcion que redireccion al index 
      * pasando como parametros 
      * los 
     **/
    public function get_articulos($idLey){
     
       $filter['idLey']=$idLey;
       $this->index($filter,"",$idLey);
    }


    /**
      * Funcion que permite agregar 
      * una seccion
      **/
    public function create(){
      
    //listado de combo de leyes
    $filterLeyes=[];
    $filterLeyes['tipo_infraccion']='V';
    $filterLeyes['nombre']=null;
    $leyes=$this->ley_model->buscar($filterLeyes);
    $tipoUnidades=array(
                'UM'=>'UM',
                'UV'=>'UF');
    
    //Enviamos datos a la pantalla
    $this->data['leyes']=$leyes;
    $this->data['contenido']="articulos/create_view.php";
    $this->data['titulo']="Articulos";
    $this->data['tipoUnidades']=$tipoUnidades; 
    $this->data['subtitulo']="Agregar Articulo";
    $this->load->view('template',$this->data);

    }

     /** Funcion que permite poder 
       * editar una seccion 
       * @param : $id
       */
     public function editar($id){
       $articulo=$this->articulo_model->getById($id);
       //A partir de la ley obtengo el tipo de infraccion
       $ley=$this->ley_model->getById($articulo->id_ley);
       $filterLeyes=[];
       $filterLeyes['tipo_infraccion']='V'; //filter leyes viales
       $filterLeyes['nombre']=null;
       $tipoUnidades=array(
                'UM'=>'UM',
                'UV'=>'UF');
       $leyes=$this->ley_model->buscar($filterLeyes);
       $this->data['leyes']=$leyes;
       $this->data['tipoUnidades']=$tipoUnidades; 
       $this->data['articulo']=$articulo;
       $this->data['titulo']='Articulo';
       $this->data['subtitulo']="Editar Articulo";
       $this->data['contenido']="articulos/create_view.php";
       $this->load->view('template',$this->data);

    }
    
    /**Funcion que permite obtener los 
      * datos a filtrar de la busqueda mediante 
      * post
      * @param : post, parameters
      */

    public function buscar(){
       $this->filter['nombre']=$this->input->post('nombre');
       $this->filter['idLey']=$this->input->post('idLey');
      
       $this->index($this->filter);     
    }

    /**
      * Funcion que permite guardar la 
      * informacion
     **/
    public function guardar2(){
     
        $this->data['id'] = $this->input->post('id');
        //Campos
        $this->data['nombre'] =  $this->input->post('nombre');
        $this->data['unidad_minima'] = $this->input->post('unidadMinima');
        $this->data['unidad_maxima'] =$this->input->post('unidadMaxima');
        $this->data['ley'] =$this->input->post('ley');
        $this->data['descripcion'] =$this->input->post('descripcion');
        $this->data['tipo_unidad'] =$this->input->post('tipoUnidad');
        $this->data['unidad_fija'] =$this->input->post('unidad_fija');
        if ( $this->input->post('unidad_fija') != '' && $this->input->post('unidad_fija') != null ) {
           $this->data['unidad_fija']  = intval($this->input->post('unidad_fija'));
        } else {
          $this->data['unidad_fija'] = 0 ;
        }

        $status="OK";
        $message="";


        if(empty($this->data['id'])) {
                $this->data['id'] = $this->articulo_model->insert($this->data);
                $message="Se agrego Articulo";
                
         }else {
                $message="Se actualizo la infraccion"; 
                $this->articulo_model->update($this->data);
        }
        
        $json=[
              "status"=>$status,
              "message"=>$message
              ] ;
        
       echo json_encode($json);
       return;       
        

    }







    /*************************************************************************/
    /*************************************************************************/
    /************ GET JSON ***************************************************/

    /**
     * Funcion que permite 
     * obtener la informacion
     * correspondiente para guardar el nombre 
     * del modelo
     */
    function postLey(){

      $json = json_decode(file_get_contents("php://input"));
      $this->data['nombre']   = $json->nombre;
      $this->data['id']=$json->id; //tipovehiculo

      $id=$this->marca_model->guardar($this->data);

      $message="";
      $status="OK";
      //Obtenemos las marcas correspondientes al 
      //tipo de vehiculo
      $list=$this->marca_model->getByTipoVehiculo($this->data['id']);

      if($id>0){
       $message="Modelo guardado";
       $status="OK";
      }else{
        $status="ERROR";  
      }
      $json=array();
      $json=[
             "status"=>$status,
             "message"=>$message,
             "list"=>$list
        ] ;
      echo json_encode($json);
      return ;
     }

      
    /**
     * <b>Funcion que permite obtener 
     * el articulo </b>
     * @param type $idArticulo
     * @return type
     */
     function get_articulo($idArticulo){
      $articulo=$this->articulo_model->getById($idArticulo);
      echo json_encode($articulo);
      return ;
    }


    /**
      * Get Articulos by idLey
     **/ 
    function get_json_articulos($idLey){
      $filter = [];
      $filter['nombre'] = null;
      $filter['idLey'] = $idLey;


      $articulos =$this->articulo_model->buscar($filter);
      $data = [];
      foreach ($articulos as $key => $value) {
         $data[] = [ 'id' => $value->id , 'name' =>  $value->nombre , 'idLey' => $value->idLey  , 'unidad' => $value->unidad];
       }
        echo json_encode($data);
        return ;
     }


    


     
}