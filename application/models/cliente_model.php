<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model
{

	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function crearCliente($data){
		$this->db->insert('cliente',array(
			'ci'=>$data['ci'],
			'nombre'=>$data['nombre'],
			'apellido'=>$data['apellido'],
			'deleted'=> 0));
	}
	function obtenerClientes(){
		$this->db->where('deleted',0);
		$query = $this->db->get('cliente');
		if($query->num_rows() > 0) return $query->result();
		else return array();
	}
	function obtenerCliente($id){
		$this->db->where('id',$id);
		$this->db->where('deleted',0);
		$query = $this->db->get('cliente');
		if($query->num_rows() > 0) return $query->result();
		else return array();
	}
	function obtenerClienteCi($ci){
		$this->db->select('id,nombre,apellido');
		$this->db->from('cliente');
		$this->db->where('ci',$ci);
		$this->db->where('deleted',0);
		$query = $this->db->get();
		if($query->num_rows() > 0) return $query->result();
		else return array();
	}
	function actualizarCliente($id,$data){
		$datos = array(
			'apellido'=>$data['apellido'],
			'nombre'=>$data['nombre'],
			'ci'=>$data['ci']
		);
		$this->db->where('id',$id);
		$query = $this->db->update('cliente',$datos);
	}
	function eliminarCliente($id){
		$datos = array(
			'deleted' => 1);
		$this->db->where('id',$id);
		$this->db->update('cliente',$datos);
	}
}

?>