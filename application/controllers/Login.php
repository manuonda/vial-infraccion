<?php

/**
 * Description of Login
 *
 * @author Choque Raul A. <no_moleste@gmail.com>
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
//        $this->load->library('comisaria');
        $this->load->library('session');
    }

    /**
     * Permite Ingreso al Sistema
     *
     * @access public
     * @return void
     */
    function index() {
        if ($this->ion_auth->logged_in()) {
            redirect('Inicio', 'refresh');
        }
        $this->data['title'] = "Login";

        if ($this->_validate_login() == TRUE) {
            $remember = (bool) $this->input->post('remember'); //Opcion Recordarme (No se usa)
            //aca se loguea con el usuario y password
            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                //se obtiene el menu de navegacion
                //$menuNavegacion = $this->permiso_model->get_permisos3($this->session->userdata('user_id'));
                //$this->session->set_userdata('menuNavegacion', $menuNavegacion);
                //$this->estadoUsuario($this->session->userdata('legajo'));
                redirect('Inicio', 'refresh');
            } else {
                echo "aqui ingreso";
                //$menuNavegacion = $this->permiso_model->get_permisos3($this->session->userdata('user_id'));
                //   $this->session->set_userdata('menuNavegacion', $menuNavegacion);
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        } else {
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['identity'] = array('name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['password'] = array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
            );

            $this->load->view('acceso/login', $this->data);
        }
    }

    /**
     * Permite salir del sistema
     *
     * @access public
     * @return void
     */
    function logout() {
        $this->data['title'] = "Logout";

        //log the user out
        $logout = $this->ion_auth->logout();

        //redirect them to the login page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('login', 'refresh');
    }

    /**
     * Determina estado del usuario, basado en informacion proveniente de
     * departamento Sanidad y del Dep. Personal. determina si esta habilitado o no para
     *
     * @access public
     * @return boolean
     */
    function estadoUsuario($legajo = null) {
        $sanidad = $this->permiso_model->get_estado_sanidad($legajo);
        $asistencia = $this->permiso_model->get_asistencia($legajo);
        $enfermo = $this->permiso_model->get_enfermo($legajo);
        $junta = $this->permiso_model->get_junta_medica($legajo);
        $estado = TRUE;
        $mensaje = '';


        if (is_object($sanidad)) {
            if ($sanidad->id_tipo_revista != 1 || $sanidad->id_tipo_situacion_revista != 1) {
                $estado = FALSE;
                $mensaje = '<i class="fa fa-exclamation-triangle"></i> Inhabilitado por Informe de Personal/Sanidad';
            }
        }

        if (is_object($asistencia)) {
            if (strtotime("+ " . $asistencia->dias . " day" . $asistencia->fecha_desde) >= strtotime(date('Y-m-d'))) {
                $estado = FALSE;
                $mensaje = '<i class="fa  fa-exclamation-triangle"></i> Inhabilitado por Informe de Personal/Sanidad';
            }
        }
        if (is_object($enfermo)) {
            if (strtotime("+ " . $enfermo->dias . " day" . $enfermo->fecha_desde) >= strtotime(date('Y-m-d'))) {
                $estado = FALSE;
                $mensaje = '<i class="fa fa-exclamation-triangle"></i> Inhabilitado por Informe de Personal/Sanidad';
            }
        }
        if (is_object($asistencia)) {
            if (strtotime("+ " . $asistencia->dias . " day" . $asistencia->fecha_desde) >= strtotime(date('Y-m-d'))) {
                $estado = FALSE;
                $mensaje = '<i class="fa fa-exclamation-triangle"></i> Inhabilitado por Informe de Personal/Sanidad';
            }
        }
        $this->session->set_userdata('Estado', $estado);
        $this->session->set_userdata('mensaje', $mensaje);
    }

    /**
     * Enviar contraseña por Email
     *
     * @access public
     * @return void
     */
    function forgot_password() {
        $this->form_validation->set_rules('email', 'Email Address', 'required');
        if ($this->form_validation->run() == false) {
            //setup the input
            $this->data['email'] = array('name' => 'email',
                'id' => 'email',
            );

            //set any errors and display the form
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->load->view('auth/forgot_password', $this->data);
        } else {
            //run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));

            if ($forgotten) {
                //if there were no errors
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect("auth/forgot_password", 'refresh');
            }
        }
    }

    /**
     * Permite resetear la contraseña
     *
     * @param $code
     * @return void
     */
    public function reset_password($code = NULL) {
        if (!$code) {
            show_404();
        }

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user) {
            //if the code is valid then display the password reset form

            if ($this->_validate_passwd() == FALSE) {
                //display the form
                //set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $this->data['new_password'] = array(
                    'name' => 'new',
                    'id' => 'new',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                );
                $this->data['new_password_confirm'] = array(
                    'name' => 'new_confirm',
                    'id' => 'new_confirm',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                );
                $this->data['user_id'] = array(
                    'name' => 'user_id',
                    'id' => 'user_id',
                    'type' => 'hidden',
                    'value' => $user->id,
                );
                $this->data['csrf'] = $this->_get_csrf_nonce();
                $this->data['code'] = $code;

                //render
                $this->load->view('auth/reset_password', $this->data);
            } else {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {

                    //something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($code);

                    show_error('This form post did not pass our security checks.');
                } else {
                    // finally change the password
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};

                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                    if ($change) {
                        //if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        $this->logout();
                    } else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect('auth/reset_password/' . $code, 'refresh');
                    }
                }
            }
        } else {
            //if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("auth/forgot_password", 'refresh');
        }
    }

    /**
     * Permite validar datos de Login.
     *
     * @return bool
     */
    private function _validate_login() {
        //Reglas de Validación
        $this->form_validation->set_rules('identity', 'Username', 'required|alpha_numeric|min_length[3]|max_length[15]'); //|xss_clean
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']'); //|xss_clean
        return $this->form_validation->run();
    }

}

/* End of file Login.php */
/* Location: ./application/controllers/admin/Login.php */