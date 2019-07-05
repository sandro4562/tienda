<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pago_model extends CI_Model {
  function __construct() {
    parent::__construct();
    $this->load->database();
  }

  function crearPago($data){
    $this->db->insert('pagos',array(
      'id'=>$data['id'],
      'create_time'=>$data['create_time'],
      'cart'=>$data['cart'],
      'state'=>$data['state'],
      'monto_total'=>$data['monto_total'],
      'detalle_compra'=>$data['detalle_compra'],
      'descripcion'=>$data['descripcion'],
      'idUser' => $data['idUser'],
      'deleted'=> 0));
  }

  function obtenerPagos(){
    $this->db->select('pagos.id as idpago, pagos.create_time, pagos.cart, pagos.state, pagos.monto_total, pagos.detalle_compra, pagos.descripcion, pagos.idUser, user.id as userid, user.nombre, user.correo');
    $this->db->from('pagos');
    $this->db->where('pagos.deleted',0);
    $this->db->join('user','user.id=pagos.idUser');
    $this->db->order_by('pagos.create_time');
    $query = $this->db->get();
    if($query->num_rows() > 0) return $query->result();
    else return array();
  }

  function obtenerPagosUsuario($id){
    $this->db->select('pagos.id as idpago, pagos.create_time, pagos.cart, pagos.state, pagos.monto_total, pagos.detalle_compra, pagos.descripcion, pagos.idUser, user.id as userid, user.nombre, user.correo');
    $this->db->where('pagos.idUser',$id);
    $this->db->from('pagos');
    $this->db->where('pagos.deleted',0);
    $this->db->join('user','user.id=pagos.idUser');
    $this->db->order_by('pagos.create_time');
    $query = $this->db->get();
    if($query->num_rows() > 0) return $query->result();
    else return array();
  }

  function obtenerPago($id){
    $this->db->where('id',$id);
    $this->db->where('deleted',0);
    $query = $this->db->get('pagos');
    if($query->num_rows() > 0) return $query->result();
    else return array();
  }

  function obtenerPagoUsuario($id){
    $this->db->where('idUser',$id);
    $this->db->where('deleted',0);
    $query = $this->db->get('pagos');
    if($query->num_rows() > 0) return $query->result();
    else return array();
  }

  function actualizarUsuario($id,$data){
    $datos = array(
      'correo'=>$data['correo'],
      'nombre'=>$data['nombre'],
      'fecha_nacimiento'=>$data['fecha'],
      'num_celular'=>$data['num_celular']
    );
    $this->db->where('id',$id);
    $query = $this->db->update('user',$datos);
  }

  function eliminarUsuario($id){
    $datos = array(
      'deleted' => 1);
    $this->db->where('id',$id);
    $this->db->update('user',$datos);
  }
}
?>