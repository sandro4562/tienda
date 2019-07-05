<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Moldura_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function crearMoldura($data){
		$this->db->insert('moldura',array(
			'imagen'=>$data['imagen'],
			'costo'=>$data['costo'],
			'idProducto' => $data['idProducto'],
			'deleted'=> 0));
	}
	function obtenerMolduras(){
		//$this->db->where('deleted',0);
		$this->db->select('moldura.id, moldura.imagen, moldura.costo, producto.nombre as nombreprod');
		$this->db->from('moldura');
		$this->db->join('producto','moldura.idProducto=producto.id and moldura.deleted=0');
		$query = $this->db->get();
		if($query->num_rows() > 0) return $query->result() ;
		else return array();
	}
	function obtenerMoldurasProd($prod){
		//$this->db->where('deleted',0);
		$this->db->select('moldura.id, moldura.imagen, moldura.costo, producto.nombre as nombreprod');
		$this->db->from('moldura');
		$this->db->join('producto','moldura.idProducto=producto.id and moldura.deleted=0 and '.$prod.'=moldura.idProducto');
		$query = $this->db->get();
		if($query->num_rows() > 0) return $query->result() ;
		else return array();
	}

	function obtenerMoldura($id){
		$this->db->where('id',$id);
		$this->db->where('deleted',0);
		$query = $this->db->get('moldura');
		if($query->num_rows() > 0) return $query->result() ;
		else return array();
	}
	function actualizarMoldura($id,$data){
		$datos = array(
			'imagen'=>$data['imagen'],
			'costo'=>$data['costo'],
			'idProducto' => $data['idProducto']
		);
		$this->db->where('id',$id);
		$query = $this->db->update('moldura',$datos);
	}
	function eliminarMoldura($id){
		$datos = array(
			'deleted' => 1);
		$this->db->where('id',$id);
		$this->db->update('moldura',$datos);
	}
}