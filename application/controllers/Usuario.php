<?php

/**
 * Description of Usuario
 *
 * @author Raul A. Choque
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends MY_Controller {

    function __construct() {
        parent::__construct();
      //  $this->load->library('fechautil');
      
        $this->load->library('ion_auth');
        $this->load->model('ion_auth_model');
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
    }

    /**
     * Muestra listado de Usuarios
     *
     * @author Raul A.
     * @param int $offset Indice para Paginación
     * @access public
     * @return void
     */
    public function buscarPersonal() {
        $this->data['mensage'] = "";
        $this->data['modal'] = 3;
        $this->data['nroDoc'] = '';
        $this->data['legajo'] = '';
        $this->data['cuil'] = '';
        $this->data['usuarios'] = $this->ion_auth_model->get_users()->result();
        foreach ($this->data['usuarios'] as $k => $user) {
            $this->data['usuarios'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
            if ($user->fecha_desde <= date('Y-m-d') && date('Y-m-d') <=$user->fecha_hasta) {
                $this->data['usuarios'][$k]->estado = explode('--', $this->estadoUsuario($user->legajo, 1));
            } else {
                $this->data['usuarios'][$k]->estado = array(0 => 0, 1 => 'Inhabilitado por autorizaci&oacute;n de fecha');
            }
        }
        $this->data['seccion'] = 'Gesti&oacute;n de Usuarios';
        $this->data['main'] = 'usuario/usuarioBuscar';
        $this->data['javaScript'] = 'usuarioBuscar';
        $this->load->view('template', $this->data);
    }

    function usuarioCrear($cuil = null) {
        $cuil = $this->input->post('cuil');

        $this->data['title'] = 'Gesti&oacute;n de Usuarios';
        $this->data['personal'] = $this->personaModel->getDatosPersonal($cuil);
        $grupos = $this->comisaria->convert_to_array_select($this->ion_auth_model->groups()->result(), 'id', 'name');
        $this->data['grupos'] = $grupos;
        $this->data['seccion'] = 'Crear Usuario';
//        $this->data['javaScript'] = 'usuarioCrear';
        $this->load->view('usuario/usuarioCrear', $this->data);
    }

    public function buscarPersonalExistente($id = null) {
        $this->data['title'] = 'Gesti&oacute;n de Usuarios';
        if($id == null){
        $nroDoc = $this->input->post('nroDoc');
        $legajo = $this->input->post('legajo');

        $result = $this->buscarPerPersonalUsuario($nroDoc, $legajo);
        $resArray = explode('--', $result);
        $this->data['cuil'] = 0;
        switch ($resArray[0]) {
            case 0:
                $mensajeModal = 'No se encontro Persona/Personal con los datos ingresados.<br/> Por favor regularice su situaci&oacute;n en el Departamento Personal.';
                $user = (object) [];
                break;
            case 1:
                $this->data['cuil'] = $resArray[1];
                $mensajeModal = 'No se encontro Usuario con los datos ingresados.<br/> Desea crear un Nuevo Usuario&quest;';
                $user = (object) [];
                break;
            case 2:
                $mensajeModal = '';
                $user = $this->ion_auth->user($resArray[1])->row();
                break;
        }
        $this->data['modal'] = (int) $resArray[0];
        $this->data['nroDoc'] = $nroDoc;
        $this->data['legajo'] = $legajo;
        }else{
            $user = $this->ion_auth->user($id)->row();
            $this->data['modal'] = 2;
            $resArray[0] = 2;
            $this->data['cuil'] = '';
            $this->data['nroDoc'] = '';
        $this->data['legajo'] = '';
        $mensajeModal = '';
        }
        //Permite recuperar los todos los roles existentes y el/los roles a los que pertenece el usuario
        if ($resArray[0] == 2) {
            $grupos = $this->comisaria->convert_to_array_select($this->ion_auth_model->groups()->result(), 'id', 'name');
            $grupos_selected = $this->ion_auth->convert_to_array($this->ion_auth_model->get_users_groups($user->id)->result(), 'id', 'name');
            $data = array(
                'usuario_modificacion' => $this->session->userdata('user_id'),
                'fecha_modificacion' => date('Y-m-d H:i:s')
            );
            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $user->fecha_desde = date("d/m/Y", strtotime($user->fecha_desde));
            $user->fecha_hasta = date("d/m/Y", strtotime($user->fecha_hasta));
            $this->data['user'] = $user;
            $this->data['grupos'] = $grupos;
            $this->data['grupos_selected'] = $grupos_selected;

            $this->data['id'] = array(
                'name' => 'id',
                'id' => 'id',
                'type' => 'hidden',
                'value' => $this->form_validation->set_value('id', $user->id),
            );
            $this->data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'size' => '40',
                'maxlength' => $this->config->item('max_password_length', 'ion_auth')
            );
            $this->data['password_confirm'] = array(
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password',
                'size' => '40',
                'maxlength' => $this->config->item('max_password_length', 'ion_auth')
            );
            $this->data['estado'] = $this->estadoUsuario($user->legajo);
        }
        $this->data['mensajeModal'] = $mensajeModal;
//        $this->data['seccion'] = 'Actualizar Datos Usuario';
        $this->data['main'] = 'usuario/usuarioBuscar';
        if ($this->data['modal'] == 2) {
            $this->data['javaScript'] = 'usuarioUpdate';
        } else {
            $this->data['javaScript'] = 'usuarioBuscar';
        }
        $this->load->view('template', $this->data);
    }

    public function buscarPerPersonalUsuario($nroDoc = null, $legajo = 0) {
        if ($nroDoc != NULL) {
            $cuil = $this->personaModel->getPersona($nroDoc);
            if (empty($cuil)) {
                // retorno (0) no encontro persona/personal -- (0) id de usuario no Existe
                return '0--0';
            }
        } else {
            $cuil = array('cuil' => null);
        }
        $perlCuil = $this->personaModel->getPersonal($cuil['cuil'], (int) $legajo);
        if (empty($perlCuil)) {
            // retorno (0) NO encontro personal -- (0) id de usuario no Existe
            return '0--0';
        }
        $userId = $this->ion_auth->userSearch($perlCuil['cuil']);
        if (!empty($userId)) {
            // retorno (2) encontro persona/personal/usuario -- id de usuario
            return '2--' . $userId['id'];
        } else {
            // retorno (1) No encontro usuario -- Cuil de Personal
            return '1--' . $perlCuil['cuil'];
        }
    }

    public function edit($id) {
        $this->data['title'] = 'Perfil Usuario';
        $user = $this->ion_auth->user($id)->row();

//Permite recuperar los todos los roles existentes y el/los roles a los que pertenece el usuario
        /*
        $grupos = $this->comisaria->convert_to_array_select($this->ion_auth_model->groups()->result(), 'id', 'name');
        $grupos_selected = $this->ion_auth->convert_to_array($this->ion_auth_model->get_users_groups($id)->result(), 'id', 'name');

        if (isset($_POST) && !empty($_POST)) {//Si existen datos por POST
            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                show_error('This form post did not pass our security checks.');
            }

            $data = array(
                'usuario_modificacion' => $this->session->userdata('user_id'),
                'fecha_modificacion' => date('Y-m-d H:i:s')
            );

            $groups = $this->input->post('groups');
            if ($this->input->post('password')) { //En caso de actualizar Password
                if ($this->_validate_passwd() === TRUE) {
                    $data['password'] = $this->input->post('password');
                }
            }

//if ($this->_validate_user() === TRUE) {//Actualizo Usuario
            $this->ion_auth->update($user->id, $data, $groups);
            $this->session->set_flashdata('message', "Usuario Actualizado Correctamente");
            redirect('admin/usuario', 'refresh');
//}
        }
        */

        /*
        $this->data['csrf'] = $this->_get_csrf_nonce();
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        $user->fecha_desde = $this->fechautil->format($user->fecha_desde);
        $user->fecha_hasta = $this->fechautil->format($user->fecha_hasta);
        $this->data['user'] = $user;
        $this->data['grupos'] = $grupos;
        $this->data['grupos_selected'] = $grupos_selected;

        $this->data['id'] = array(
            'name' => 'id',
            'id' => 'id',
            'type' => 'hidden',
            'value' => $this->form_validation->set_value('id', $user->id),
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'type' => 'password',
            'size' => '40',
            'maxlength' => $this->config->item('max_password_length', 'ion_auth')
        );
        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'type' => 'password',
            'size' => '40',
            'maxlength' => $this->config->item('max_password_length', 'ion_auth')
        );*/

           //Contravenciones titulos
        $this->data['titulo']='Datos Personales';
        $this->data['subtitulo']="Editar Usuario";
        $this->data['usuario'] = $user;
        $this->data['contenido'] = 'usuarios/edit_user.php';
        $this->load->view('template', $this->data);
    }

    function delete() {
        $id = $this->input->post('id');
        $user = $id > 0 ? $this->ion_auth->user($id)->row() : NULL;
        $msg = 'Usuario con id ' . $id . ' no existe.';

        if ($user != NULL) {

            if ($this->ion_auth->delete_user($user->id)) {
                $msg = 'Se ha eliminado el usuario: ' . $user->apellido . ', ' . $user->nombre;
            } else {
                $msg = 'Error al intentar eliminar: ' . $user->apellido . ', ' . $user->nombre;
            }
        }
        echo $msg;
    }

    /**
     * Permite crear nuevos Usuario
     *
     * @author Raul A. Choque
     * @return bool
     */
    public function validateCrear() {
        if ($this->validarForm() === FALSE) {
//            $this->data['title'] = 'Solicitud de Nuevo Servicio';
            $this->data['mensaje'] = $msje;
            $this->data['tipo'] = $tipo;
            $this->data['seccion'] = 'Gesti&oacute;n de Usuarios';
            $this->data['javaScript'] = '';
            $this->data['main'] = 'usuario/usuarioCrear';
            $this->load->view('template', $this->data);
            return;
        }
        if (isset($_POST) && !empty($_POST)) {//Si existen datos por POST
            $data = array();
            $groups = $this->input->post('groups');
            $pwd = $this->input->post('password');

            $fecha = explode(' - ', $this->input->post('fechas'));
            $datosUsr['username'] = xss_clean($this->input->post('nombreUsuario'));
            $datosUsr['password'] = $this->input->post('password');
            $datosUsr['cuil'] = xss_clean($this->input->post('cuil'));
            $datosUsr['tel_fijo'] = xss_clean($this->input->post('telFijo'));
            $datosUsr['tel_celular'] = xss_clean($this->input->post('telCelular'));
            $datosUsr['email'] = xss_clean($this->input->post('email'));
            $datosUsr['fecha_desde'] = $fecha[0];
            $datosUsr['fecha_hasta'] = $fecha[1];
            $idUsuario = $this->ion_auth->insertUsuario($datosUsr, $groups);
            $this->session->set_userdata('message', $this->ion_auth->messages());
            $this->data['mensage'] = "";
            $this->data['modal'] = 3;
            $this->data['nroDoc'] = '';
            $this->data['legajo'] = '';
            $this->data['cuil'] = '';
            $this->data['title'] = 'Gesti&oacute;n de Usuarios';
            $this->data['mensaje'] = 'Se Generado exitosamente el nuevo usuario.';
            $this->data['tipo'] = 'success';
            $this->data['seccion'] = 'Crear Usuario';
            $this->data['javaScript'] = 'usuarioBuscar';
            $this->data['main'] = 'usuario/usuarioBuscar';
            $this->load->view('template', $this->data);
        }
        redirect('Adicional', 'refresh');
    }

    /**
     * Permite editar datos de Usuarios
     *
     * @author Raul A. Choque
     * @return bool
     */
    public function actualizarUsuario() {
        if ($this->validarFormActualizar() === FALSE) {
            $this->data['mensaje'] = 'Se ha producido un error, por favor intentelo nuevamente.';
            $this->data['tipo'] = 'danger';
            $this->data['seccion'] = 'Gesti&oacute;n de Usuarios';
            $this->data['javaScript'] = '';
            $this->data['main'] = 'usuario/usuarioListado';
            $this->load->view('template', $this->data);
            return;
        }
        if (isset($_POST) && !empty($_POST)) {//Si existen datos por POST
            $data = array();
            $groups = $this->input->post('groups');
            $fecha = explode(' - ', $this->input->post('fechas'));
            if (trim($this->input->post('password')) != '') {
                $datosUsr['password'] = trim($this->input->post('password'));
            }
            $datosUsr['tel_fijo'] = xss_clean($this->input->post('telFijo'));
            $datosUsr['tel_celular'] = xss_clean($this->input->post('telCelular'));
            $datosUsr['email'] = xss_clean($this->input->post('email'));
            $datosUsr['fecha_desde'] = $fecha[0];
            $datosUsr['fecha_hasta'] = $fecha[1];
            $resUsuario = $this->ion_auth->update($this->input->post('id'), $datosUsr, $groups);
            if ($resUsuario) {
                $this->data['mensage'] = 'Se actualizaron los datos correctamente';
                $this->data['icono'] = 'success';
            } else {
                $this->data['mensaje'] = 'Se Generado exitosamente el nuevo usuario.';
                $this->data['tipo'] = 'warning';
            }
            $this->data['nroDoc'] = '';
            $this->data['legajo'] = '';
            $this->data['cuil'] = '';
            $this->data['modal'] = 3;
            $this->data['title'] = 'Gesti&oacute;n de Usuarios';
            $this->data['seccion'] = 'Crear Usuario';
            $this->data['javaScript'] = 'usuarioBuscar';
            $this->data['main'] = 'usuario/usuarioBuscar';
            $this->load->view('template', $this->data);
            return;
        }
        redirect('Adicional', 'refresh');
    }

    /**
      * Funcion que permite actualizar el password 
      * del usuario
    **/
    public function actualizarPassword(){
            
            $data = array();
            $id               = $this->input->post('id');
            $identity         = $this->input->post('identity');
            $password         = $this->input->post('password');
            $passwodActual    = $this->input->post('passwordactual');
            $repetirpassword  = $this->input->post('repetirpassword');
            $user = $this->ion_auth->user($id)->row();
            

            if (trim($password)!= '') {
                $password = trim($this->input->post('password'));
            }
           
            $resUsuario = $this->ion_auth_model->change_password($identity, $passwodActual, $password);
            

            if ($resUsuario) {
                $this->data['status'] = "OK";
                $this->data['mensage'] = 'Se actualizaron los datos correctamente';
            } else {
                $this->data['mensage'] = 'No se pudo actualizar la clave del usuario';
                $this->data['tipo'] = 'warning';
            }

            echo json_encode($this->data);
            return;
           
    }

    public function validarForm() {
        $this->form_validation->set_rules('telFijo', 'Telefono Fijo', 'max_length[20]||xss_clean');
        $this->form_validation->set_rules('telCelular', 'Telefono Celular', 'max_length[20]||xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'max_length[100]|valid_email|xss_clean');
        $this->form_validation->set_rules('nombreUsuario', 'Nombre de Usuario', 'required|max_length[30]|xss_clean');
        $this->form_validation->set_rules('groups', 'Rol de Usuario', 'required|xss_clean');
        $this->form_validation->set_rules('fechas', 'Periodo Habilitado', 'required|xss_clean');
        $this->form_validation->set_rules('passwordNuevo', 'Contrase&ntilde;a', 'required|min_length[4]|max_length[15]|xss_clean');
        $this->form_validation->set_rules('confirmPasswordNuevo', 'Repetir contrase&ntilde;a', 'required|min_length[4]|max_length[15]|xss_clean');
        return $this->form_validation->run();
    }

    public function validarFormActualizar() {
        $this->form_validation->set_rules('telFijo', 'Telefono Fijo', 'max_length[20]||xss_clean');
        $this->form_validation->set_rules('telCelular', 'Telefono Celular', 'max_length[20]||xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'max_length[100]|valid_email|xss_clean');
        $this->form_validation->set_rules('groups', 'Rol de Usuario', 'required|xss_clean');
        $this->form_validation->set_rules('fechas', 'Periodo Habilitado', 'required|xss_clean');
        $this->form_validation->set_rules('passwordNuevo', 'Contrase&ntilde;a', 'min_length[4]|max_length[15]|xss_clean');
        $this->form_validation->set_rules('confirmPasswordNuevo', 'Repetir contrase&ntilde;a', 'min_length[4]|max_length[15]|xss_clean');
        return $this->form_validation->run();
    }

    /**
     * Permite validar datos de Usuario
     *
     * @author Raul A. Choque
     * @return bool
     */
    public function validate() {
        $post = $this->input->post();
        ($post);
        return;
    }

    /**
     * Permite validar datos de Usuario
     *
     * @author Raul A. Choque
     * @return bool
     */
    private function _validate_user() {
        $this->form_validation->set_rules('cuil', 'Cuil', 'is_natural_no_zero|xss_clean');
        $this->form_validation->set_rules('legajo', 'Legajo', 'is_natural_no_zero|xss_clean');
        $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[3]|max_length[30]|xss_clean');
        return $this->form_validation->run();
    }

    /**
     * Permite validar password
     *
     * @author Raul A. Choque
     * @return bool
     */
    private function _validate_passwd() {
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]|xss_clean');
        $this->form_validation->set_rules('password_confirm', 'Confirmacion Password', 'required|xss_clean');
        return $this->form_validation->run();
    }

    /**
     * Permite validar datos de Busqueda de Usuarios.
     *
     * @author Raul A. Choque
     * @return bool
     */
    private function _validate_search() {
        $this->form_validation->set_rules('search_last_name', 'Apellido', 'min_length[3]|max_length[25]|xss_clean');
        $this->form_validation->set_rules('search_name', 'Nombre', 'min_length[3]|max_length[25]|xss_clean');
        return $this->form_validation->run();
    }

    /**
     * Determina estado del usuario, basado en informacion proveniente de
     * departamento Sanidad y del Dep. Personal. determina si esta habilitado o no para
     *
     * @access public
     * @return boolean
     */
    function estadoUsuario($legajo = null, $origen = null) {
        $sanidad = $this->permiso_model->get_estado_sanidad($legajo);
        $asistencia = $this->permiso_model->get_asistencia($legajo);
        $enfermo = $this->permiso_model->get_enfermo($legajo);
        $junta = $this->permiso_model->get_junta_medica($legajo);
        $mensaje = '';
        $estado = 1;

        if (is_object($sanidad)) {
            if ($sanidad->id_tipo_revista != 1 || $sanidad->id_tipo_situacion_revista != 1) {
                $estado = 0;
                $mensaje = 'Inhabilitado por Informe de Personal/Sanidad';
            }
        }

        if (is_object($asistencia)) {
            if (strtotime("+ " . $asistencia->dias . " day" . $asistencia->fecha_desde) >= strtotime(date('Y-m-d'))) {
                $mensaje = 'Inhabilitado por Informe de Personal/Sanidad';
                $estado = 0;
            }
        }
        if (is_object($enfermo)) {
            if (strtotime("+ " . $enfermo->dias . " day" . $enfermo->fecha_desde) >= strtotime(date('Y-m-d'))) {
                $mensaje = 'Inhabilitado por Informe de Personal/Sanidad';
                $estado = 0;
            }
        }
        if (is_object($asistencia)) {
            if (strtotime("+ " . $asistencia->dias . " day" . $asistencia->fecha_desde) >= strtotime(date('Y-m-d'))) {
                $mensaje = 'Inhabilitado por Informe de Personal/Sanidad';
                $estado = 0;
            }
        }
        if ($origen == null) {
            return $mensaje;
        } else {
            return $estado . '-' . $mensaje;
        }
    }

    public function validarUsuario() {
        $nombre = htmlspecialchars($_POST['nombreUsuario']);
        header('Content-type: application/json');
        $valid = $this->ion_auth->buscarNombreUsr($nombre);
        echo json_encode(array('valid' => $valid));
    }

}

/* End of file Usuario.php */
/* Location: ./application/controllers/admin/Usuario.php */