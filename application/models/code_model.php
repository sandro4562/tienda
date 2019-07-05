<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Code_model extends CI_Model
{

	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function crearUsuario($data){
		$this->db->insert('user',array(
			'correo'=>$data['correo'],
			'nombre'=>$data['nombre'],
			'password'=>$data['password'],
			'rol'=>'user',
			'deleted'=> 0));
	}
	function obtenerUsuarios(){
		$this->db->where('deleted',0);
		$query = $this->db->get('user');
		if($query->num_rows() > 0) return $query->result();
		else return array();
	}
	function obtenerUsuario($id){
		$this->db->where('id',$id);
		$this->db->where('deleted',0);
		$query = $this->db->get('user');
		if($query->num_rows() > 0) return $query->result();
		else return array();
	}
	function obtenerUsuarioCorreo($correo){
		$this->db->select('id,nombre,correo,apellido,username,rol');
		$this->db->from('user');
		$this->db->where('correo',$correo);
		$this->db->where('deleted',0);
		$query = $this->db->get();
		if($query->num_rows() > 0) return $query->result();
		else return array();
	}

	function login($correo,$pass){
		$this->db->select('id,correo');
		$this->db->from('user');
		$this->db->where('correo',$correo);
		$this->db->where('password',$pass);
		$this->db->where('deleted',0);
		$query = $this->db->get();
		if($query->num_rows() > 0) return $query->result();
		else return array();
	}

	function actualizarUsuario($id,$data){
		$datos = array(
			'correo'=>$data['correo'],
			'nombre'=>$data['nombre'],
			'rol'=>$data['tipo']
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