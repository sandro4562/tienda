<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tallado_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function crearTallado($data){
		$this->db->insert('tallado',array(
			'imagen'=>$data['imagen'],
			'costo'=>$data['costo'],
			'idProducto' => $data['idProducto'],
			'deleted'=> 0));
	}
	function obtenerTallados(){
		//$this->db->where('deleted',0);
		$this->db->select('tallado.id, tallado.imagen, tallado.costo, producto.nombre as nombreprod');
		$this->db->from('tallado');
		$this->db->join('producto','tallado.idProducto=producto.id and tallado.deleted=0');
		$query = $this->db->get();
		if($query->num_rows() > 0) return $query->result() ;
		else return array();
	}
	function obtenerTalladosProd($prod){
		//$this->db->where('deleted',0);
		$this->db->select('tallado.id, tallado.imagen, tallado.costo, producto.nombre as nombreprod');
		$this->db->from('tallado');
		$this->db->join('producto','tallado.idProducto=producto.id and tallado.deleted=0 and '.$prod.'=tallado.idProducto');
		$query = $this->db->get();
		if($query->num_rows() > 0) return $query->result() ;
		else return array();
	}

	function obtenerTallado($id){
		$this->db->where('id',$id);
		$this->db->where('deleted',0);
		$query = $this->db->get('tallado');
		if($query->num_rows() > 0) return $query->result() ;
		else return array();
	}
	function actualizarTallado($id,$data){
		$datos = array(
			'imagen'=>$data['imagen'],
			'costo'=>$data['costo'],
			'idProducto' => $data['idProducto']
		);
		$this->db->where('id',$id);
		$query = $this->db->update('tallado',$datos);
	}
	function eliminarTallado($id){
		$datos = array(
			'deleted' => 1);
		$this->db->where('id',$id);
		$this->db->update('tallado',$datos);
	}
}