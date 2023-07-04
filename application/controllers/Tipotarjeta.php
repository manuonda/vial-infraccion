<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tipotarjeta extends MY_Controller {

     function __construct(){
       parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('rol_model');
        $this->load->model('ley_model');
        $this->load->model('tipotarjeta_model');

        //Cargamos el Helper para el uso del BASE_URL()
        $this->load->helper('url');
    }



    /**
     *  Index
     */
      public function index($filter=null,$message=null,$status=null){
       if ($this->ion_auth->logged_in()) {
            
            //Obtenemos el usuario y cargamos solamente el tipo de 
            //infraccion
            //Obtenemos los roles
             

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

            
            if ($query->num_rows() === 1) {
               $rol = $query->row();
            } 

            if($filter==null){
               //filtro por leyes de tipo vial
               $filter['tipo_infraccion'] ="V";   
               $filter['nombre']=null;
            }
            
            $this->data['message']=$message;
            $this->data['contenido'] = "tipotarjeta/index_view.php";
            $this->data['titulo']="Tipo Tarjetas";
            $this->data['filter']=$filter;
            $this->data['leyes']=$this->ley_model->buscar($filter);
           
            $this->load->view('template', $this->data);
        } else {
            redirect('admin/login');
        }
   

    }


    /**
      * Funcion que permite agregar 
      * una ley
      **/
    public function create(){
      
      $tipoInfracciones=array('V' =>"VIAL");


      $tipoUnidades=array(
                'UM'=>'UM',
                'UF'=>'UF');


      $tipoTramites = $this->tipotramite_model->get_all();

      $this->data['contenido']="leyes/create_view.php";
      $this->data['titulo']="Leyes";
      $this->data['subtitulo']="Agregar Ley";
      $this->data['tipoInfracciones']=$tipoInfracciones;
      $this->data['tipoUnidades']=$tipoUnidades; 
      $this->data['tipoTramites']=$tipoTramites;
      $this->load->view('template',$this->data);

    }

     /** Funcion que permite poder 
       * editar una seccion 
       * @param : $id
       */
     public function editar($id){
       $this->data['contenido']="leyes/create_view.php";

       $ley=$this->ley_model->getById($id);

          
       $tipoInfracciones=array('V' =>"VIAL");


      $tipoUnidades=array(
                'UM'=>'UM',
                'UV'=>'UF');

      $tipoTramites = $this->tipotramite_model->get_all();

       //Contravenciones titulos
       $this->data['ley']=$ley;
       $this->data['titulo']='Leyes';
       $this->data['subtitulo']="Editar Ley";
       $this->data['tipoInfracciones']=$tipoInfracciones;
       $this->data['tipoUnidades']=$tipoUnidades; 
       $this->data['tipoTramites']=$tipoTramites;
       $this->load->view('template',$this->data);

    }
    
    /**Funcion que permite obtener los 
      * datos a filtrar de la busqueda mediante 
      * post
      * @param : post, parameters
      */

    public function buscar(){
       $this->filter['nombre']=$this->input->post('nombre');
      
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
        $this->data['tipo_infraccion'] = $this->input->post('tipoinfraccion');
        $this->data['tipo_unidad'] =$this->input->post('tipounidad');
        $this->data['descripcion']=$this->input->post('descripcion');
        $this->data['tipo_tramite']=$this->input->post('tipotramite');
        $this->data['unidad_fija'] = $this->input->post('unidad_fija');

        if ( $this->input->post('unidad_fija') != '' && $this->input->post('unidad_fija') != null ) {
           $this->data['unidad_fija']  = intval($this->input->post('unidad_fija'));
        } else {
          $this->data['unidad_fija'] = 0 ;
        }
       
        if(empty($this->data['id'])) {
                $this->data['id'] = $this->ley_model->insert($this->data);
                $message="Se agrego Ley";
                $this->index(null,$message,null);
        }else {
                $this->ley_model->update($this->data);
                $this->index(null,"Se actualizo la seccion",null);
        }
    }


   /**
     * <b>Funcion que permite obtener 
     * el articulo </b>
     * @param type $idArticulo
     * @return type
     */
     function get_all(){
      $leyes=$this->ley_model->get_all();
      echo json_encode($leyes);
      return ;
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

      
     /** Funcion que permite obtener una 
       * ley a partir de un parametro 
       * @param : idLey
       **/ 
     function get_ley($idLey){
      $ley=$this->ley_model->getById($idLey);
      echo json_encode($ley);
      return ;
    }


    /**
     * <b>Funcion que permite obtener 
     * el articulo </b>
     * @param type $idArticulo
     * @return type
     */
     function get_json_leyes(){

       $filter['tipo_infraccion'] ="V";   
       $filter['nombre']=null;
          
      $leyes=$this->ley_model->buscar($filter);
      $data = [];
      foreach ($leyes as $key => $value) {
      
        $data[] = [ 'id' => $value->id , 'name' =>  $value->nombre , 'unidad' => $value->unidad_fija];
      }
      echo json_encode($data);
      return ;
    }



     
}