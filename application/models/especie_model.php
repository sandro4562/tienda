<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Especie_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function crearEspecie($data){
		$this->db->insert('especie',array(
			'nombre'=>$data['nombre'],
			'idProducto' => $data['idProducto'],
			'deleted'=> 0));
	}
	function obtenerEspecies(){
		//$this->db->where('deleted',0);
		$this->db->select('especie.id, especie.nombre, producto.nombre as nombreprod, producto.id as prodId');
		$this->db->from('especie');
		$this->db->join('producto','especie.idProducto=producto.id and especie.deleted=0');
		$query = $this->db->get();
		if($query->num_rows() > 0) return $query->result() ;
		else return array();
	}
	function obtenerEspeciesProd($prod){
		//$this->db->where('deleted',0);
		$this->db->select('especie.id, especie.nombre, producto.nombre as nombreprod');
		$this->db->from('especie');
		$this->db->join('producto','especie.idProducto=producto.id and especie.deleted=0 and '.$prod.'=especie.idProducto');
		$query = $this->db->get();
		if($query->num_rows() > 0) return $query->result() ;
		else return array();
	}
	function obtenerEspecie($id){
		$this->db->where('id',$id);
		$this->db->where('deleted',0);
		$query = $this->db->get('especie');
		if($query->num_rows() > 0) return $query->result() ;
		else return array();
	}
	function actualizarEspecie($id,$data){
		$datos = array(
			'nombre'=>$data['nombre'],
			'idProducto' => $data['idProducto']
		);
		$this->db->where('id',$id);
		$query = $this->db->update('especie',$datos);
	}
	function eliminarEspecie($id){
		$datos = array(
			'deleted' => 1);
		$this->db->where('id',$id);
		$this->db->update('especie',$datos);
	}
}