<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cepillado_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function crearCepillado($data){
		$this->db->insert('cepillado',array(
			'costo'=>$data['costo'],
			'caras'=>$data['caras'],
			'idProducto' => $data['idProducto'],
			'deleted'=> 0));
	}
	function obtenerCepillados(){
		//$this->db->where('deleted',0);
		$this->db->select('cepillado.id,cepillado.caras, cepillado.costo, producto.nombre as nombreprod');
		$this->db->from('cepillado');
		$this->db->join('producto','cepillado.idProducto=producto.id and cepillado.deleted=0');
		$query = $this->db->get();
		if($query->num_rows() > 0) return $query->result() ;
		else return array();
	}
	function obtenerCepillado($id){
		$this->db->where('id',$id);
		$this->db->where('deleted',0);
		$query = $this->db->get('cepillado');
		if($query->num_rows() > 0) return $query->result() ;
		else return array();
	}
	function obtenerCepilladosProd($prod){
		//$this->db->where('deleted',0);
		$this->db->select('cepillado.id,cepillado.caras, cepillado.costo, producto.nombre as nombreprod');
		$this->db->from('cepillado');
		$this->db->join('producto','cepillado.idProducto=producto.id and cepillado.deleted=0 and '.$prod.'=cepillado.idProducto');
		$query = $this->db->get();
		if($query->num_rows() > 0) return $query->result() ;
		else return array();
	}


	function actualizarCepillado($id,$data){
		$datos = array(
			'costo'=>$data['costo'],
			'caras'=>$data['caras'],
			'idProducto' => $data['idProducto']
		);
		$this->db->where('id',$id);
		$query = $this->db->update('cepillado',$datos);
	}
	function eliminarCepillado($id){
		$datos = array(
			'deleted' => 1);
		$this->db->where('id',$id);
		$this->db->update('cepillado',$datos);
	}
}