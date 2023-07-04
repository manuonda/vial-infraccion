<?php

/**
 * @author mar
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ServicioModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insertarServicio($datos) {
        $this->db->insert($this->tables['servicio'], $datos);
        return $this->db->insert_id();
    }
    
    public function insertarServicioDia($datos) {
        $this->db->insert($this->tables['servicioDia'], $datos);
        return $this->db->insert_id();
    }
    public function insertarPostularDia($idDia, $idUsuario,$fechaPostulado) {
        $this->db->insert($this->tables['servicioPostularDia'], array('idDia'=>$idDia, 'idUsuario'=>$idUsuario,'fechaPostulado'=>$fechaPostulado));
        return $this->db->insert_id();
    }
    public function getPostularDia($idDia, $idUsuario) {
        $this->db->where(array('idDia'=>$idDia, 'idUsuario'=>$idUsuario));
        $this->db->from($this->tables['servicioPostularDia']);
        return $this->db->count_all_results();
    }

    public function getAllServicios($estado1 = null, $estado2 = null, $estado3 = null) {
        $this->db->select('s.*, p.apellido, p.nombre, p.cuil_ciudadano');
        $this->db->from($this->tables['servicio'] . ' s');
        $this->db->join($this->tables['persona'] . ' p', 'p.cuil = s.cuil');
        if($estado1 != null){
            $this->db->where('s.estado', $estado1);
        }
        if($estado2 != null){
            $this->db->or_where('s.estado', $estado2);
        }
        if($estado3 != null){
            $this->db->or_where('s.estado', $estado3);
        }
        $this->db->order_by('fechaSolicitud', 'DESC');
        return $this->db->get()->result_array();
    }
    public function getServiciosEstado($estado) {
        $this->db->select('s.*, p.apellido, p.nombre, p.cuil_ciudadano');
        $this->db->from($this->tables['servicio'] . ' s');
        $this->db->join($this->tables['persona'] . ' p', 'p.cuil = s.cuil');
        $this->db->where('estado', $estado);
        $this->db->order_by('fechaPublicado', 'DESC');
        return $this->db->get()->result_array();
    }
    public function getServicio($idServicio) {
        $this->db->select('s.*, p.apellido, p.nombre, p.dni');
        $this->db->from($this->tables['servicio'] . ' s');
        $this->db->join($this->tables['persona'] . ' p', 'p.cuil = s.cuil');
        $this->db->where('id', $idServicio);
        return $this->db->get()->result_array();
    }
    public function getServicioDias($idServicio) {
        $this->db->select('*');
        $this->db->from($this->tables['servicioDia']);
        $this->db->where('idServicio', $idServicio);
        return $this->db->get()->result_array();
    }
    public function getServicioDiaPostulados($idDia, $ordenamiento = null, $idUsuario = null) {
        $this->db->select('u.id, p.apellido, p.nombre, u.tel_fijo, u.tel_celular, u.email, per.legajo,s.estado, u.puntaje, u.postulado, s.fechaPostulado,p.sexo,s.idPostularDia');
        $this->db->join($this->tables['users'] . ' u', 's.idUsuario = u.id');
        $this->db->join($this->tables['persona'] . ' p','p.cuil = u.cuil');
        $this->db->join($this->tables['personal'] . ' per','per.cuil = u.cuil');
        $this->db->from($this->tables['servicioPostularDia'] . ' s');
        $this->db->where('s.idDia', $idDia);
        if($idUsuario != null){
            $this->db->where('s.idUsuario', $idUsuario);
        }
        if($ordenamiento != null){
            $this->db->order_by('u.puntaje ASC');
            $this->db->order_by('s.fechaPostulado ASC');
        }
        return $this->db->get()->result_array();
    }
    public function updateServicio($id,$datos){
         $this->db->where('id', $id);
        $result = $this->db->update($this->tables['servicio'], $datos);
        return $this->db->affected_rows();
    }
    public function updateServicioDia($id, $datos){
         $this->db->where('idDia', $id);
        $result = $this->db->update($this->tables['servicioDia'], $datos);
        return $this->db->affected_rows();
    }
    public function updateUsuarioPostulado($id, $datos){
         $this->db->where('id', $id);
        $result = $this->db->update($this->tables['users'], $datos);
        return $this->db->affected_rows();
    }
    public function updatePostularDia($idDia, $idUsuario,$idPostularDia, $datos) {
        if($idDia != null){$this->db->where('idDia', $idDia);}
        if($idUsuario != null){$this->db->where('idUsuario', $idUsuario);}
        if($idPostularDia != null){$this->db->where('idPostularDia', $idPostularDia);}
        $result = $this->db->update($this->tables['servicioPostularDia'], $datos);
        return $this->db->affected_rows();
    }
    public function eliminarServicio($id){
         $this->db->where('id', $id);
        $result = $this->db->delete($this->tables['servicio']);
        return $this->db->affected_rows();
    }
}