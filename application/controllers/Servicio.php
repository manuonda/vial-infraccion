<?php

/**
 * Description of Usuario
 *
 * @author Choque Raul A.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicio extends MY_Controller {

    function __construct() {
        parent::__construct();
       // $this->load->library('fechautil');
        $this->load->model('personaModel');
        $this->load->model('servicioModel');
        $this->load->model('comercioModel');

        $this->data['jScript'] = array('template/plugins/bootstrapvalidator/bootstrapValidator.js', 'template/plugins/bootstrapvalidator/language/es_ES.js', 'template/plugins/select2/select2.min.js',
            'template/js/jquery.numeric.min.js', 'template/js/custom.js', 'template/plugins/datatables/jquery.dataTables.min.js', 'template/plugins/bootstrap-daterangepicker/moment.min.js',
            'template/plugins/datepicker/bootstrap-datepicker.js', 'template/plugins/timepicker/bootstrap-timepicker.min.js', 'template/plugins/switchery/dist/switchery.min.js', 'template/plugins/print/jquery.PrintArea.js');
        $this->data['cssTemplate'] = array('template/plugins/bootstrapvalidator/bootstrapValidator.css', 'template/plugins/select2/select2.css', 'template/dist/css/customForm.css',
            'template/plugins/datatables/dataTables.bootstrap.css', 'template/plugins/timepicker/bootstrap-timepicker.min.css',
            'template/plugins/datepicker/datepicker3.css', 'template/plugins/timepicker/bootstrap-timepicker.min.css',
            'template/plugins/switchery/dist/switchery.min.css');

        $this->data['grupoSeccion'] = 'Servicios';
    }

    /**
     * Muestra listado de Usuarios
     *
     * @author Choque Raul A.
     * @param int $offset Indice para Paginación
     * @access public
     * @return void
     */
    function index($offset = NULL) {
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        redirect("admin/usario/index", 'refresh');
    }

    /**
     * Muestra listado de Usuarios
     *
     * @author Choque Raul A.
     * @param int $offset Indice para Paginación
     * @access public
     * @return void
     */
    public function servicioListadoTodos($estado = null, $msje = null, $tipo = null) {
        $this->data['title'] = 'Listado de Servicios';
        $this->data['mensaje'] = $msje;
        $this->data['tipo'] = $tipo;
        $this->data['seccion'] = 'Listado de servicios';
        $servicios = $this->servicioModel->getAllServicios();
        if ($estado == null) {
            $servicios = $this->servicioModel->getAllServicios();
        } else {
            $servicios = $this->servicioModel->getAllServicios($estado);
        }
        foreach ($servicios as $ind => $serv) {
            $listado[$ind]['servicio'] = $serv;
            $listado[$ind]['comercio'] = $this->getComercio($serv['idComercio']);
            $listado[$ind]['dias'] = $this->servicioModel->getServicioDias($serv['id']);
            foreach ($listado[$ind]['dias'] as $ind => $pos) {
                $postuladosDia = $this->servicioModel->getServicioDiaPostulados($pos['idDia']);
                $cantServAsignadoMasc = 0;
                $cantServAsignadoFem = 0;
                $cupo[$pos['idServicio']] = '';
                if ($serv['estado'] == 2) {
                    foreach ($postuladosDia AS $post) {
                        if ($post['sexo'] == 'M') {
                            if ($post['estado'] == 'A') {
                                $cantServAsignadoMasc++;
                            }
                        } else {
                            if ($post['estado'] == 'A') {
                                $cantServAsignadoFem++;
                            }
                        }
                    }
                    if ($cantServAsignadoMasc != $pos['persMasculino'] || $cantServAsignadoFem != $pos['persFemenino']) {
                        $cupo[$pos['idServicio']] = 'fa-warning text-danger';
                    }
                }
            }
        }
//        ($cupo); die();
        if (!isset($listado)) {
            $this->data['mensaje'] = ' No se Registran Servicios.';
            $this->data['tipo'] = 'danger';
            $this->data['cupo'] = null;
            $this->data['listado'] = null;
        } else {
            $this->data['cupo'] = $cupo;
            $this->data['listado'] = $listado;
        }
        $this->data['javaScript'] = 'servicioListadoJS';
        $this->data['main'] = 'servicio/servicioListadoView';
        $this->load->view('template', $this->data);
    }

    /**
     * Muestra listado de Usuarios
     *
     * @author Choque Raul A.
     * @param int $offset Indice para Paginación
     * @access public
     * @return void
     */
    public function servicioListadoPublicados($msje = null, $tipo = null) {
        $this->data['title'] = 'Gesti&oacute;n de Servicios';
        $this->data['mensaje'] = $msje;
        $this->data['tipo'] = $tipo;
        $this->data['seccion'] = 'Gesti&oacute;n de servicios';
        $servicios = $this->servicioModel->getServiciosEstado(1);
        $listado = array();
        foreach ($servicios as $ind => $serv) {
            $listado[$ind]['servicio'] = $serv;
            $listado[$ind]['comercio'] = $this->getComercio($serv['idComercio']);
            $listado[$ind]['dias'] = $this->servicioModel->getServicioDias($serv['id']);
            foreach ($listado[$ind]['dias'] as $ind => $pos) {
                $postulados[$pos['idDia']] = $this->servicioModel->getServicioDiaPostulados($pos['idDia']);
                $cantServAsignadoMasc = 0;
                $cantServAsignadoFem = 0;
                $listPostuladosDia = $this->servicioModel->getServicioDiaPostulados($pos['idDia'], 1);
                foreach ($postulados[$pos['idDia']] AS $post) {
                    if ($post['sexo'] == 'M') {
                        if ($post['estado'] == 'A') {
                            $cantServAsignadoMasc++;
                        }
                    } else {
                        if ($post['estado'] == 'A') {
                            $cantServAsignadoFem++;
                        }
                    }
                }
                if ($cantServAsignadoMasc == $pos['persMasculino']) {
                    $cupo[$pos['idDia']]['cupoM'] = 'fa-check text-success';
                } else {
                    $cupo[$pos['idDia']]['cupoM'] = 'fa-times text-danger';
                }
                if ($cantServAsignadoFem == $pos['persFemenino']) {
                    $cupo[$pos['idDia']]['cupoF'] = 'fa-check text-success';
                } else {
                    $cupo[$pos['idDia']]['cupoF'] = 'fa-times text-danger';
                }
            }
        }
        $this->data['listado'] = $listado;
        $this->data['javaScript'] = 'servicioListadoPublicadosJS';
        $this->data['main'] = 'servicio/servicioListadoPublicadosView';
        $this->load->view('template', $this->data);
    }

    /**
     * Realiza el proceso de asignacion de servicios al personal postulado
     *
     * @author Choque Raul A.
     * @param
     * @access public
     * @return void
     */
    public function servicioConfirmarPostulados($msje = null, $tipo = null) {
        $this->data['title'] = 'Gesti&oacute;n de Servicios';
        $this->data['mensaje'] = $msje;
        $this->data['tipo'] = $tipo;
        $this->data['seccion'] = 'Gesti&oacute;n de servicios';
        $servicios = $this->servicioModel->getAllServicios(1);
        if (!empty($servicios)) {
            foreach ($servicios as $ind => $serv) {
                $listado[$ind]['servicio'] = $serv;
                $listado[$ind]['comercio'] = $this->getComercio($serv['idComercio']);
                $listado[$ind]['dias'] = $this->servicioModel->getServicioDias($serv['id']);
                foreach ($listado[$ind]['dias'] as $ind => $pos) {
                    $postuladosDia = array();
                    $cantServAsignadoMasc = 0;
                    $cantServAsignadoFem = 0;
                    $listPostuladosDia = $this->servicioModel->getServicioDiaPostulados($pos['idDia'], 1);
                    foreach ($listPostuladosDia AS $post) {
                        //($pos, $post);die();
                        if ($post['postulado'] != $pos['diaFecha']) {
                            if ($post['sexo'] == 'M') {
                                if ($cantServAsignadoMasc < $pos['persMasculino']) {
                                    $cantServAsignadoMasc++;
                                    //Actualiza la tabla usuario campo pustulado = fecha de dia de Servicio
                                    $this->servicioModel->updateUsuarioPostulado($post['id'], array('postulado' => $pos['diaFecha'], 'puntaje' => ++$post['puntaje']));
                                    //Actualiza la tabla servicioPostularDia campo estado = A (asignado)
                                    $this->servicioModel->updatePostularDia($pos['idDia'], $post['id'], null, array('estado' => 'A'));
                                    $post['estadoAsignacion'] = 'fa-check text-success';
                                } else {
                                    $post['estadoAsignacion'] = 'fa-clock-o text-info';
                                }
                            } else {
                                if ($cantServAsignadoFem < $pos['persFemenino']) {
                                    $cantServAsignadoFem++;
                                    //Actualiza la tabla usuario campo pustulado = fecha de dia de Servicio
                                    $this->servicioModel->updateUsuarioPostulado($post['id'], array('postulado' => $pos['diaFecha'], 'puntaje' => ++$post['puntaje']));
                                    //Actualiza la tabla servicioPostularDia campo estado = A (asignado)
                                    $this->servicioModel->updatePostularDia($pos['idDia'], $post['id'], null, array('estado' => 'A'));
                                    $post['estadoAsignacion'] = 'fa-check text-success';
                                } else {
                                    $post['estadoAsignacion'] = 'fa-clock-o text-info';
                                }
                            }
                        } else {
                            $post['estadoAsignacion'] = 'fa-times text-danger';
                        }
                        $postuladosDia[] = $post;
                    }
                    $postulados[$pos['idDia']] = $postuladosDia;
                    if ($cantServAsignadoMasc == $pos['persMasculino']) {
                        $cupo[$pos['idDia']]['cupoM'] = 'fa-check text-success';
                    } else {
                        $cupo[$pos['idDia']]['cupoM'] = 'fa-times text-danger';
                    }
                    if ($cantServAsignadoFem == $pos['persFemenino']) {
                        $cupo[$pos['idDia']]['cupoF'] = 'fa-check text-success';
                    } else {
                        $cupo[$pos['idDia']]['cupoF'] = 'fa-times text-danger';
                    }
                }
                // Actualizo estado de servcio, 2: Estado Asignado.
                $idUpdate = $this->servicioModel->updateServicio($pos['idServicio'], array('estado' => 2));
            }
            $this->data['cupo'] = $cupo;
            $this->data['listado'] = $listado;
            $this->data['postulados'] = $postulados;
        } else {
            $this->data['cupo'] = array();
            $this->data['listado'] = array();
            $this->data['postulados'] = array();
            $this->data['tipo'] = 'warning';
            $this->data['mensaje'] = 'No se registran Servicios Publicados sin asignar Postulante.';
        }
        $this->data['javaScript'] = 'servicioListadoPostuladosJS';
        $this->data['main'] = 'servicio/servicioListadoPostuladosView';
        $this->load->view('template', $this->data);
    }

    /**
     * Muestra listado de personal postulado a los servicios
     *
     * @author Choque Raul A.
     * @param
     * @access public
     * @return void
     */
    public function servicioListadoPostulados($msje = null, $tipo = null, $idServicio = null) {
        $this->data['title'] = 'Gesti&oacute;n de Servicios';
        $this->data['mensaje'] = $msje;
        $this->data['tipo'] = $tipo;
        $this->data['seccion'] = 'Gesti&oacute;n de servicios';
        if ($idServicio != null) {
            $servicios = $this->servicioModel->getServicio($idServicio);
        } else {
            $servicios = $this->servicioModel->getAllServicios(1, 2);
        }
        if (!empty($servicios)) {
            foreach ($servicios as $ind => $serv) {
                $listado[$ind]['servicio'] = $serv;
                $listado[$ind]['comercio'] = $this->getComercio($serv['idComercio']);
                $listado[$ind]['dias'] = $this->servicioModel->getServicioDias($serv['id']);
                foreach ($listado[$ind]['dias'] as $ind => $pos) {
                    $postulados[$pos['idDia']] = $this->servicioModel->getServicioDiaPostulados($pos['idDia']);
                    $cantServAsignadoMasc = 0;
                    $cantServAsignadoFem = 0;
                    $listPostuladosDia = $this->servicioModel->getServicioDiaPostulados($pos['idDia'], 1);
                    foreach ($postulados[$pos['idDia']] AS $post) {
                        if ($post['sexo'] == 'M') {
                            if ($post['estado'] == 'A' || $post['estado'] == 'C') {
                                $cantServAsignadoMasc++;
                            }
                        } else {
                            if ($post['estado'] == 'A' || $post['estado'] == 'C') {
                                $cantServAsignadoFem++;
                            }
                        }
                    }
                    if ($cantServAsignadoMasc == $pos['persMasculino']) {
                        $cupo[$pos['idDia']]['cupoM'] = 'fa-check text-success';
                    } else {
                        $cupo[$pos['idDia']]['cupoM'] = 'fa-times text-danger';
                    }
                    if ($cantServAsignadoFem == $pos['persFemenino']) {
                        $cupo[$pos['idDia']]['cupoF'] = 'fa-check text-success';
                    } else {
                        $cupo[$pos['idDia']]['cupoF'] = 'fa-times text-danger';
                    }
                }
            }
            $this->data['cupo'] = $cupo;
            $this->data['listado'] = $listado;
            $this->data['postulados'] = $postulados;
        } else {
            $this->data['cupo'] = array();
            $this->data['listado'] = array();
            $this->data['postulados'] = array();
            $this->data['tipo'] = 'warning';
            $this->data['mensaje'] = 'No se registran Servicios Publicados sin asignar Postulante.';
        }
        $this->data['controlVisualizacion'] = true;
        $this->data['javaScript'] = 'servicioListadoPostuladosJS';
        $this->data['main'] = 'servicio/servicioListadoPostuladosView';
        $this->load->view('template', $this->data);
    }

    /**
     * Muestra listado de Servicios postulados por personal
     *
     * @author Choque Raul A.
     * @param
     * @access public
     * @return void
     */
    public function servicioPostuladosIndividual($msje = null, $tipo = null) {
        $this->data['title'] = 'Postulaciones a Servicios';
        $this->data['mensaje'] = $msje;
        $this->data['tipo'] = $tipo;
        $this->data['seccion'] = 'Estado de Postulaciones a Servicios';
        $idUsuario = $this->session->userdata('user_id');
        $servicios = $this->servicioModel->getAllServicios(1, 2);
        if (!empty($servicios)) {
            foreach ($servicios as $ind => $serv) {
                $listado[$ind]['servicio'] = $serv;
                $listado[$ind]['comercio'] = $this->getComercio($serv['idComercio']);
                $listado[$ind]['dias'] = $this->servicioModel->getServicioDias($serv['id']);
                foreach ($listado[$ind]['dias'] as $ind => $pos) {
                    $postulados[$pos['idDia']] = $this->servicioModel->getServicioDiaPostulados($pos['idDia'], 1, $idUsuario);
                    $cantServAsignadoMasc = 0;
                    $cantServAsignadoFem = 0;
                    $cupo[$pos['idDia']]['cupoM'] = '';
                    $cupo[$pos['idDia']]['cupoF'] = '';
                }
            }
            $this->data['cupo'] = $cupo;
            $this->data['listado'] = $listado;
            $this->data['postulados'] = $postulados;
        } else {
            $this->data['cupo'] = array();
            $this->data['listado'] = array();
            $this->data['postulados'] = array();
            $this->data['tipo'] = 'warning';
            $this->data['mensaje'] = 'No se registran Servicios Publicados sin asignar Postulante.';
        }
        $this->data['javaScript'] = 'servicioListadoPostuladosJS';
        $this->data['main'] = 'servicio/servicioListadoPostuladosView';
        $this->load->view('template', $this->data);
    }

    /**
     * Muestra listado de Servicios postulados por personal
     *
     * @author Choque Raul A.
     * @param
     * @access public
     * @return void
     */
    public function servicioPostularIndividualAccion($msje = null, $tipo = null) {
        $this->data['title'] = 'Postulaciones a Servicios';
        $this->data['seccion'] = 'Estado de Postulaciones a Servicios';
        $post = $this->input->post();
        switch ($post['accion']) {
            case 'C':
                $this->servicioModel->updatePostularDia(null, null, $post['idPostularDia'], array('estado' => 'C'));
                $mensaje = 'Se ha Confirmado la Asignaci&oacute;n del Servicio.';
                $tipo = 'success';
                break;
            case 'R':
                $this->servicioModel->updatePostularDia(null, null, $post['idPostularDia'], array('estado' => 'R'));
                $mensaje = 'Se ha Rechazado la Asignaci&oacute;n del Servicio.';
                $tipo = 'danger';
                break;
            default:
                $mensaje = 'Se ha producido un Error. No se concreto la Acci&oacuten seleccionada.';
                $tipo = 'warning';
                break;
        }
        $this->servicioPostuladosIndividual($mensaje, $tipo);
    }

    public function servicioPostular() {
        $idDia = $this->input->post('postular');
        $idUsuario = $this->input->post('idUsuario');
        if ($this->servicioModel->getPostularDia($idDia, $idUsuario) > 0) {
            $this->servicioListadoPublicados('Ya se encuentra registrado para el D&iacute;a de Servicio.', 'warning');
            return;
        }
        $idPostulacion = $this->servicioModel->insertarPostularDia($idDia, $idUsuario, date('Y-m-d H:i:s'));
        if ($idPostulacion == NULL) {
            $this->servicioListadoPublicados('Se ha producido un Error. No se pudo realizar la Postulaci&oacute;n', 'danger');
            return;
        } else {
            $this->servicioListadoPublicados('Se Registro la Postulaci&oacute;n Correctamente', 'success');
        }
    }

    public function servicioNuevo($msje = null, $tipo = null) {
        $this->data['title'] = 'Solicitud de Nuevo Servicio';
        $this->data['mensaje'] = $msje;
        $this->data['tipo'] = $tipo;
        $this->data['seccion'] = 'Solicitud de Servicio Policia Adicional';
        $this->data['javaScript'] = 'servicioNuevoJS';
        $this->data['main'] = 'servicio/servicioNuevoView';
        $this->load->view('template', $this->data);
    }

    public function buscarPersonaAjax() {
        $nroDoc = htmlspecialchars($_POST['nroDoc']);
        header('Content-type: application/json');
        echo json_encode($this->personaModel->buscarPersonaServicio($nroDoc));
    }

    public function validarSeguridadCantidadAjax() {
        $perSino = htmlspecialchars($_POST['perSino']);
        $cantidad = htmlspecialchars($_POST['cantidad']);
        header('Content-type: application/json');
        if ($perSino == 'S') {
            if ($cantidad > 0 && is_int($cantidad)) {
                echo true;
            } else {
                echo false;
            }
        } else {
            echo true;
        }
        echo true;
    }

    public function servicioValidar() {
        $datos = $this->input->post();
        if ($this->validarFormServicio() === FALSE) {
            $this->servicioNuevo();
            return;
        }
        $datosServicio['fechaSolicitud'] = $datos['fechaSolic'];
        $datosServicio['cuil'] = $datos['cuil'];
        $datosServicio['telFijo'] = $datos['telFijo'];
        $datosServicio['telCelular'] = $datos['telCelular'];
        $datosServicio['solicitante'] = $datos['solicitante'];
        $datosServicio['idComercio'] = $datos['idComercio'];
        $datosServicio['capacidad'] = $datos['capacidad'];
        $datosServicio['cantidad'] = $datos['cantidad'];
        $datosServicio['zona'] = $datos['zona'];
        $datosServicio['montado'] = $datos['montado'];
        $datosServicio['especial'] = $datos['especial'];
        $datosServicio['otros'] = $datos['otros'];
        $datosServicio['publicado'] = '';
        if (array_key_exists('perSino', $datos)) {
            $datosServicio['perSino'] = 'S';
        } else {
            $datosServicio['perSino'] = 'N';
        }
        $idServicio = $this->servicioModel->insertarServicio($datosServicio);
        if ($idServicio == NULL) {
            $this->servicioNuevo();
            return;
        }
        $l = 1;
        for ($i = 1; array_key_exists('dia' . $i, $datos); $i++) {
            if ($datos['dia' . $i] != '' && $datos['horaDesde' . $i] != '' && $datos['horaHasta' . $i] != '' && ($datos['persMasculino' . $i] > 0 || $datos['persFemenino' . $i] > 0)) {
                $datosServicioDia['diaFecha'] = $datos['dia' . $i];
                $datosServicioDia['desde'] = $datos['horaDesde' . $i];
                $datosServicioDia['hasta'] = $datos['horaHasta' . $i];
                $datosServicioDia['persMasculino'] = $datos['persMasculino' . $i];
                $datosServicioDia['persFemenino'] = $datos['persFemenino' . $i];
                $datosServicioDia['idServicio'] = $idServicio;
                $idDia = $this->servicioModel->insertarServicioDia($datosServicioDia);
            }
        }
        $meses = array('01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Setiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre');
        $m = explode('/', $datos['fechaSolic']);
        $datos['publicado'] = '';
        $datos['estado'] = 0;
        $this->data['fechaSolicitud'] = $m[0] . ' de ' . $meses[$m[1]] . ' del ' . $m[2];
        $this->data['title'] = 'Solicitud de Nuevo Servicio';
        $this->data['servicio'] = $datos;
        $this->data['idServicio'] = $idServicio;
        $this->data['mensaje'] = '';
        $this->data['tipo'] = '';
        $this->data['seccion'] = 'Solicitud de Servicio Policia Adicional';
        $this->data['javaScript'] = 'servicioPreGuardarJS';
        $this->data['main'] = 'servicio/servicioPreGuardar';
        $this->load->view('template', $this->data);
    }

    public function servicioValidarUpdate() {
        $datos = $this->input->post();
//        ($datos); die();
        $datosServicio['fechaSolicitud'] = $datos['fechaSolic'];
        $datosServicio['cuil'] = $datos['cuil'];
        $datosServicio['telFijo'] = $datos['telFijo'];
        $datosServicio['telCelular'] = $datos['telCelular'];
        $datosServicio['solicitante'] = $datos['solicitante'];
        $datosServicio['idComercio'] = $datos['idComercio'];
        $datosServicio['capacidad'] = $datos['capacidad'];
        $datosServicio['cantidad'] = $datos['cantidad'];
        $datosServicio['montado'] = $datos['montado'];
        $datosServicio['especial'] = $datos['especial'];
        $datosServicio['otros'] = $datos['otros'];
        if (array_key_exists('perSino', $datos)) {
            $datosServicio['perSino'] = 'S';
        } else {
            $datosServicio['perSino'] = 'N';
        }

        if ($datos['idServicio'] == NULL) {
            $this->servicioListadoTodos(null, 'Se ha producido un Error. No se ha Realizado la Acci&oacute;n seleccionada', 'warning');
            return;
        }
        $rstUpdateServ = $this->servicioModel->updateServicio($datos['idServicio'], $datosServicio);
        $l = 1;
        for ($i = 1; array_key_exists('dia' . $i, $datos); $i++) {
            if ($datos['dia' . $i] != '' && $datos['horaDesde' . $i] != '' && $datos['horaHasta' . $i] != '' && ($datos['persMasculino' . $i] > 0 || $datos['persFemenino' . $i] > 0)) {
                $datosServicioDia['diaFecha'] = $datos['dia' . $i];
                $datosServicioDia['desde'] = $datos['horaDesde' . $i];
                $datosServicioDia['hasta'] = $datos['horaHasta' . $i];
                $datosServicioDia['persMasculino'] = $datos['persMasculino' . $i];
                $datosServicioDia['persFemenino'] = $datos['persFemenino' . $i];
                $rstUpdateDia = $this->servicioModel->updateServicioDia($datos['idServicio'], $datosServicioDia);
            }
        }
        //$datos['publicado'] = '';
        $meses = array('01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Setiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre');
        $m = explode('/', $datos['fechaSolic']);
        $this->data['fechaSolicitud'] = $m[0] . ' de ' . $meses[$m[1]] . ' del ' . $m[2];
        $this->data['title'] = 'Solicitud de Nuevo Servicio';
        $this->data['servicio'] = $datos;
        $this->data['idServicio'] = $datos['idServicio'];
        $this->data['mensaje'] = '';
        $this->data['tipo'] = '';
        $this->data['seccion'] = 'Solicitud de Servicio Policia Adicional';
        $this->data['javaScript'] = 'servicioPreGuardarJS';
        $this->data['main'] = 'servicio/servicioPreGuardar';
        $this->load->view('template', $this->data);
    }

    public function servicioListadoAccion() {
        $accion = $this->input->post('accion');
        $idServicio = $this->input->post('idServicio');
        switch ($accion) {
            case 'I':
                if ($idServicio != '') {
                    $this->servicioImprimir($idServicio);
                    break;
                }
                $this->servicioListadoTodos(null, 'Se ha producido un Error. No se ha Realizado la Acci&oacute;n seleccionada', 'warning');
                break;
            case 'V':
                if ($idServicio != '') {
                    $this->servicioListadoPostulados(null, null, $idServicio);
                    break;
                }
                $this->servicioListadoTodos(null, 'Se ha producido un Error. No se ha Realizado la Acci&oacute;n seleccionada', 'warning');
                break;
            case 'P':
                if ($idServicio != '') {
                    // Actualizo estado de servcio, 1: Estado publicado, fecha de publicacion
                    $idUpdate = $this->servicioModel->updateServicio($idServicio, array('estado' => 1, 'fechaPublicado' => date('Y-m-d')));
                    if ($idUpdate > 0) {
                        $this->servicioListadoTodos(null, 'Se ha Publicado Exitosamente el Servicio', 'success');
                        break;
                    }
                }
                $this->servicioListadoTodos(null, 'Se ha producido un Error. No se ha publicado el Servicio', 'danger');
                break;
            case 'D':
                if ($idServicio != '') {
                    $idEliminar = $this->servicioModel->eliminarServicio($idServicio);
                    if ($idEliminar > 0) {
                        $this->servicioListadoTodos(null, 'Se ha Eliminado Exitosamente el Servicio', 'success');
                        break;
                    }
                }
                $this->servicioListadoTodos(null, 'Se ha producido un Error. No se ha Eliminado el Servicio', 'danger');
                break;
            case 'E':
                if ($idServicio != '') {
                    $this->servicioEditar($idServicio);
                    break;
                }
                $this->servicioListadoTodos(null, 'Se ha producido un Error. No se ha publicado el Servicio', 'danger');
                break;
            default :
                $this->servicioListadoTodos(null, 'Se ha producido un Error. No se ha Realizado la Acci&oacute;n Seleccionada', 'warning');
        }
    }

    public function servicioEditar($idServicio = null) {
        if ($idServicio == NULL) {
            $this->servicioListadoTodos(null, 'Se ha producido un Error. No se ha Realizado la Acci&oacute;n Seleccionada', 'warning');
            return;
        }
        $datos = $this->servicioModel->getServicio($idServicio);
        $d = explode('-', $datos[0]['fechaSolicitud']);
        $datos[0]['fechaSolicitud'] = $d[2] . '/' . $d[1] . '/' . $d[0];
        $datosDias = $this->servicioModel->getServicioDias($idServicio);
        $comercio = $this->getComercio($datos[0]['idComercio']);
        $datos[0]['nroDoc'] = $datos[0]['dni'];
        foreach ($comercio as $key => $value) {
            $datos[0][$key] = $comercio[$key];
        }
        $i = 1;
        foreach ($datosDias as $dia) {
            $d = explode('-', $dia['diaFecha']);
            $datos[0]['dia' . $i] = $d[2] . '/' . $d[1] . '/' . $d[0];
            $datos[0]['horaDesde' . $i] = $dia['desde'];
            $datos[0]['horaHasta' . $i] = $dia['hasta'];
            $datos[0]['persMasculino' . $i] = $dia['persMasculino'];
            $datos[0]['persFemenino' . $i] = $dia['persFemenino'];
            $i++;
        }
        $this->data['title'] = 'Edici&oacute;n de Servicio';
        $this->data['servicio'] = $datos[0];
        $this->data['idServicio'] = $idServicio;
        $this->data['mensaje'] = '';
        $this->data['tipo'] = '';
        $this->data['seccion'] = 'Edici&oacute;n de Servicio Policia Adicional';
        $this->data['javaScript'] = 'servicioEditarJS';
        $this->data['main'] = 'servicio/servicioEditView';
        $this->load->view('template', $this->data);
    }

    public function servicioImprimir($idServicio = null) {
        if ($idServicio == NULL) {
            $this->servicioListadoTodos(null, 'Se ha producido un Error. No se ha Realizado la Acci&oacute;n Seleccionada', 'warning');
            return;
        }
        $datos = $this->servicioModel->getServicio($idServicio);
        $datosDias = $this->servicioModel->getServicioDias($idServicio);
        $comercio = $this->getComercio($datos[0]['idComercio']);
        $datos[0]['nroDoc'] = $datos[0]['dni'];
        foreach ($comercio as $key => $value) {
            $datos[0][$key] = $comercio[$key];
        }
        $i = 1;
        foreach ($datosDias as $dia) {
            $datos[0]['dia' . $i] = $dia['diaFecha'];
            $datos[0]['horaDesde' . $i] = $dia['desde'];
            $datos[0]['horaHasta' . $i] = $dia['hasta'];
            $datos[0]['persMasculino' . $i] = $dia['persMasculino'];
            $datos[0]['persFemenino' . $i] = $dia['persFemenino'];
            $datos[0]['idServicio' . $i] = $idServicio;
            $i++;
        }
        $meses = array('01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Setiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre');
        $m = explode('-', $datos[0]['fechaSolicitud']);
        $this->data['fechaSolicitud'] = $m[0] . ' de ' . $meses[$m[1]] . ' del ' . $m[2];
        $this->data['title'] = 'Solicitud de Nuevo Servicio';
        $this->data['servicio'] = $datos[0];
        $this->data['idServicio'] = $idServicio;
        $this->data['mensaje'] = '';
        $this->data['tipo'] = '';
        $this->data['seccion'] = 'Solicitud de Servicio Policia Adicional';
        $this->data['javaScript'] = 'servicioPreGuardarJS';
        $this->data['main'] = 'servicio/servicioPreGuardar';
        $this->load->view('template', $this->data);
    }

    public function validarFormServicio() {
        $this->form_validation->set_rules('nroDoc', 'Nro. de Documento de la Persona', 'trim|alpha_blank_point|required|min_length[3]|max_length[10]|xss_clean');
        $this->form_validation->set_rules('cuil', 'los Datos de la Persona', 'required|xss_clean');
        $this->form_validation->set_rules('solicitante', 'Caracter', 'trim|required|xss_clean');
        $this->form_validation->set_rules('idComercio', 'Datos Comercio', 'trim|required|xss_clean');
        $this->form_validation->set_rules('capacidad', 'Capacidad', 'trim|numeric|greater_than[0]|xss_clean');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|numeric|greater_than_or_equal[0]|xss_clean');
        $this->form_validation->set_rules('montado', 'cuerpo Montado', 'trim|numeric|greater_than[0]|xss_clean');
        $this->form_validation->set_rules('especial', 'cuerpo Especial', 'trim|numeric|greater_than[0]|xss_clean');
        $this->form_validation->set_rules('otros', 'Otros cuerpos', 'trim|numeric|greater_than[0]|xss_clean');
        $this->form_validation->set_rules('telFijo', 'Tel&oacutefono Fijo', 'trim|max_length[20]|xss_clean');
        $this->form_validation->set_rules('telCelular', 'Tel&oacutefono Celular', 'trim|max_length[20]|xss_clean');
        $this->form_validation->set_rules('dia1', 'D&iacute;a de servicio', 'trim|required|valid_date|xss_clean');
        $this->form_validation->set_rules('horaDesde1', 'Hora Desde', 'trim|required|xss_clean');
        $this->form_validation->set_rules('horaHasta1', 'Hora Hasta', 'trim|required|xss_clean');
        $this->form_validation->set_rules('persMasculino', 'Personal Masculino', 'trim|numeric|greater_than[0]|xss_clean');
        $this->form_validation->set_rules('persFemenino', 'Personal Femenino', 'trim|numeric|greater_than[0]|xss_clean');
        $this->form_validation->set_rules('montado', 'cuerpo Montado', 'trim|numeric|greater_than_or_equal[0]|xss_clean');
        $this->form_validation->set_rules('especial', 'cuerpo Especial', 'trim|numeric|greater_than_or_equal[0]|xss_clean');
        $this->form_validation->set_rules('otros', 'Otros cuerpos', 'trim|numeric|greater_than_or_equal[0]|xss_clean');
        return $this->form_validation->run();
    }

    public function getComercio($idComercio) {
        $com = $this->comercioModel->getComercioId($idComercio);
        $comercio['comercio'] = $com->comercio;
        $comercio['cuit'] = $com->cuit;
        $comercio['descripcion'] = $com->descripcion;
        $comercio['responsable'] = $com->apellido . ', ' . $com->nombre;
        $comercio['domicilio'] = html_entity_decode($com->depto . '-' . $com->localidad . ', B&ordm; ' . $com->barrio . ', ' . $com->calle . ' N&ordm; ' . $com->numero . ' M' . $com->manzana . ' L' . $com->lote . ' sect ' . $com->sector . ' piso ' . $com->piso . ' dpto ' . $com->departamento . ' mbck ' . $com->monoblock);
        return $comercio;
    }

}

/* End of file Usuario.php */
/* Location: ./application/controllers/admin/usuarioController.php */