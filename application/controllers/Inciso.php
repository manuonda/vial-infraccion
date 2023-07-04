<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inciso extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
//        $this->load->library('MY_Form_validation');
//        $this->load->library('pagination');
        $this->load->model('dependencia_model');
        $this->load->model('localidad_model');
        $this->load->model('marca_model');
        $this->load->model('modelo_model');
        $this->load->model('barrio_model');
        $this->load->model('calle_model');
        $this->load->model('tipovehiculo_model');
        $this->load->model('articulo_model');
        $this->load->model('inciso_model');
        $this->load->model('ley_model');

        //Cargamos el Helper para el uso del BASE_URL()
        $this->load->helper('url');
    }


    /**
     *  Index
     */
      public function index($filter=null,$message=null){
       if ($this->ion_auth->logged_in()) {
            
           $tipo_infraccion=null;

           $this->session->userdata('user_id');  
           $query = $this->db->select
                  ('rol.name')
                ->join('usuarios_roles ur', 'ur.id_usuario=u.id')
                ->join('roles rol','ur.id_rol=rol.id')
                ->where('u.id',$this->session->userdata('user_id'))
                ->limit(1)
                ->get($this->tables['users'].' as u');

            
            if ($query->num_rows() === 1) {
               $rol = $query->row();
            } 

            

            if($filter==null){
               $filter['idLey']=null;
               $filter['idArticulo']=null;
               $filter['nombre']=null;
               $filter['tipo_infraccion']='V';
            }else{
              $filter['tipo_infraccion']='V';
            }


      
              
           //listado de combo de leyes
            $filterLeyes=[];
            $filterLeyes['tipo_infraccion']='V';
            $filterLeyes['nombre']=null;
            $leyes=$this->ley_model->buscar($filterLeyes);


            //listado de articulos 
            $articulos=[];
            if($filter['idLey']!=null && $filter['idLey']!=""){
              $filterArticulos=[];
              $filterArticulos['nombre']=null;
              $filterArticulos['idLey']=$filter['idLey'];
              $articulos=$this->articulo_model->buscar($filterArticulos); 
            }
            

            $this->data['leyes']=$leyes;
            $this->data['message']=$message;
            $this->data['articulos']=$articulos;
            $this->data['contenido'] = "incisos/index_view.php";
            $this->data['titulo']="Incisos";
            $this->data['filter']=$filter;
            $this->data['incisos']=$this->inciso_model->buscar($filter);
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
      echo "idLey : ".$idLey;
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
      $this->data['tipoUnidades']=$tipoUnidades; 
      $this->data['id_ley']="";
      $this->data['id_articulo']="";
      $this->data['contenido']="incisos/create_view.php";
      $this->data['titulo']="Incisos";
      $this->data['subtitulo']="Agregar Inciso";
      $this->load->view('template',$this->data);

    }

     /** Funcion que permite poder 
       * editar una seccion 
       * @param : $id
       */
     public function editar($id){
      $inciso=$this->inciso_model->getById($id); 

       $articulo=null; 
       if(isset($inciso)){
          $articulo=$this->articulo_model->getById($inciso->id_articulo);
       }

       $ley=null;
       $id_ley="";
       if(isset($articulo)){
         $ley =$this->ley_model->getById($articulo->id_ley);  
       }
       $tipoUnidades=array(
                'UM'=>'UM',
                'UV'=>'UF');

       //filter de leyes  
       $filterLeyes=[];
       $filterLeyes['tipo_infraccion']='V';
       $filterLeyes['nombre']=null;
       $leyes=$this->ley_model->buscar($filterLeyes);
       $this->data['leyes']=$leyes; 
       $this->data['tipoUnidades']=$tipoUnidades; 

     
       //Contravenciones titulos
       $this->data['id_ley']=$ley!=null? $ley->id_ley :"";
       $this->data['id_articulo']=$articulo!=null? $articulo->id_articulo:"";
       $this->data['articulos']=$this->articulo_model->getByLey($ley->id_ley);
       //($this->data['articulos']);
       
       $this->data['inciso']=$inciso;
       $this->data['titulo']='Inciso';
       $this->data['subtitulo']="Editar  Inciso";
       $this->data['contenido']="incisos/create_view.php";
      
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
       $this->filter['idArticulo']=$this->input->post('articulo');
       $this->index($this->filter);     
    }

    /**
      * Funcion que permite guardar la 
      * informacion
     **/
    public function guardar(){

        $this->data['id'] = $this->input->post('id');
        //Campos
        $this->data['nombre'] =  $this->input->post('nombre');
        $this->data['descripcion'] = $this->input->post('descripcion');
        $this->data['unidad_minima']=$this->input->post('unidadMinima');
        $this->data['unidad_maxima']=$this->input->post('unidadMaxima');
        $this->data['id_articulo'] =$this->input->post('articulo');
        $this->data['tipo_unidad'] =$this->input->post('tipoUnidad');
        $this->data['unidad_fija'] =$this->input->post('unidad_fija');
        if ( $this->input->post('unidad_fija') != '' && $this->input->post('unidad_fija') != null ) {
           $this->data['unidad_fija']  = intval($this->input->post('unidad_fija'));
        } else {
          $this->data['unidad_fija'] = 0 ;
        }
      
        if(empty($this->data['id'])) {
                $this->data['id'] = $this->inciso_model->insert($this->data);
                $message="Se agrego Inciso";
                $this->index(null,$message,null);
        }else {
                $this->inciso_model->update($this->data);
                $this->index(null,"Se actualizo el Inciso",null);
        }
    }
 


    /*******************************************************/
    /**** Funciones  ***************************************/

    
    /**
     * Funcion que permite 
     * obtener la informacion
     * correspondiente para guardar el nombre
     * del articulo
     */
    function postArticulo(){

      $json = json_decode(file_get_contents("php://input"));
      $this->data['nombre']   = $json->nombre;
      $this->data['id']=$json->id; //tipovehiculo
       
      $id=$this->articulo_model->guardar($this->data);

      $message="";
      $status="OK";
      //Obtenemos las marcas correspondientes al 
      //tipo de vehiculo
      $list=$this->articulo_model->getByLey($this->data['id']);

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


      /** Funcion que permite obtener una 
       * ley a partir de un parametro 
       * @param : idLey
       **/ 
     function get_inciso($idInciso){
      $ley=$this->inciso_model->getById($idInciso);
      echo json_encode($ley);
      return ;
    }

    


    /**
      * Get Articulos by idLey
     **/ 
    function get_json_incisos($idArticulo){
      $filter = [];
      $filter['nombre'] = null;
      $filter['idLey'] = null;
      $filter['idArticulo'] = $idArticulo;


      $incisos =$this->inciso_model->buscar($filter);
      $data = [];
      foreach ($incisos as $key => $value) {
         $data[] = [ 'id' => $value->id , 'name' =>  $value->nombre , 'unidad' => $value->unidad];
       }
        echo json_encode($data);
        return ;
     }
    

}