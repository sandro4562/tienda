<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Producto_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function crearProducto($data){
		$this->db->insert('producto',array(
			'nombre'=>$data['nombre'],
			'imagen'=>$data['imagen'],
			'precio'=>$data['precio'],
			'deleted'=> 0)
			);
	}
	function obtenerProductos(){
		$this->db->where('deleted',0);
		$query = $this->db->get('producto');
		if($query->num_rows() > 0) return $query->result();
		else return array();
	}
	function obtenerProducto($id){
		$this->db->where('id',$id);
		$this->db->where('deleted',0);
		$query = $this->db->get('producto');
		if($query->num_rows() > 0) return $query->result();
		else return array();
	}
	function actualizarProducto($id,$data){
		$datos = array(
			'nombre'=>$data['nombre'],
			'imagen'=>$data['imagen'],
			'precio'=>$data['precio']
		);
		$this->db->where('id',$id);
		$query = $this->db->update('producto',$datos);
	}
	function eliminarProducto($id){
		$datos = array(
			'deleted' => 1);
		$this->db->where('id',$id);
		$this->db->update('producto',$datos);
	}
	function obtenerCantidad($id){
		$this->db->select('cantidad');
		$this->db->where('id',$id);
		$this->db->where('deleted',0);
		$query = $this->db->get('producto');
		if($query->num_rows() > 0) return $query->result();
		else return array();
	}
	function actualizarCantidad($id,$cantidad){
		$datos = array(
			'cantidad'=>$cantidad
		);
		$this->db->where('id',$id);
		$this->db->where('deleted',0);
		$query = $this->db->update('producto',$datos);
	}
}