<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Imagen_Model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	function get($id){
		$this->db->where('id',$id);
		$this->db->where('deleted',0);
		$query = $this->db->get('imagen');
		if($query->num_rows() > 0) return $query->result();
		else return array();
	}

	function save($data){
		$this->db->insert('imagen',array(
			'id'=>$data['id'],
			'imagen'=>$data['imagen'],
			'deleted'=> 0));
	}	
}