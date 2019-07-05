<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notificacion_model extends CI_Model {
  function __construct() {
    parent::__construct();
    $this->load->database();
  }

  function crearNotificacion($data){
    $this->db->insert('notificaciones',array(
      'monto_total'=>$data['monto_total'],
      'detalle_compra'=>$data['detalle_compra'],
      'descripcion'=>$data['descripcion'],
      'idUser' => $data['idUser'],
      'estado' => 'Contactar cliente',
      'cotizaciones' => $data['cotizaciones'],
      'deleted'=> 0));
  }

  function obtenerNotificacion($estado){
    $this->db->select('notificaciones.id as notfId, notificaciones.creation_time, notificaciones.estado, notificaciones.monto_total, notificaciones.detalle_compra, notificaciones.descripcion, notificaciones.idUser, user.nombre, user.correo, user.num_celular, notificaciones.cotizaciones, notificaciones.fechaEntrega');
    $this->db->from('notificaciones');
    $this->db->where('notificaciones.deleted', 0);
    $this->db->where('notificaciones.estado', $estado);
    $this->db->join('user','user.id=notificaciones.idUser');
    $this->db->order_by('notificaciones.creation_time');
    $query = $this->db->get();
    if($query->num_rows() > 0) return $query->result();
    else return array();
  }

  function eliminarNotificacion($id) {
    $datos = array(
      'deleted' => 1);
    $this->db->where('id',$id);
    $this->db->update('user',$datos);
  }

  function actualizarNotificacionPendiente($data){
    $actualizador = array(
      'estado' => $data['estado'],
      'fechaEntrega' => $data['fechaEntrega']
    );
    $this->db->where('id', $data['id']);
    $query = $this->db->update('notificaciones', $actualizador);
  }

  function actualizarNotificacion($data){
    $actualizador = array(
      'estado' => $data['estado']
    );
    $this->db->where('id', $data['id']);
    $query = $this->db->update('notificaciones', $actualizador);
  }
}
?>