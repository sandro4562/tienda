<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medida_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function crearMedida($data){
		$this->db->insert('medida',array(
			'espesor'=>$data['espesor'],
			'largo'=>$data['largo'],
			'ancho'=>$data['ancho'],
			'precioCubicacion'=>$data['precioCubicacion'],
			'costo'=>$data['costo'],
			'idEspecie' => $data['idEspecie'],
			'idProducto' => $data['idProducto'],
			'deleted'=> 0));
	}
	function obtenerMedidas(){
		$this->db->select('medida.id, medida.espesor, medida.largo, medida.ancho, medida.precioCubicacion, medida.costo, producto.nombre as nombreprod, medida.idEspecie, especie.nombre as especieNombre');
		$this->db->from('medida');
		$this->db->join('producto','medida.idProducto=producto.id and medida.deleted=0');
		$this->db->join('especie','medida.idEspecie=especie.id', 'left');
		$this->db->order_by('producto.nombre, medida.largo, medida.espesor, medida.ancho');
		$query = $this->db->get();
		if($query->num_rows() > 0) return $query->result();
		else return array();
	}
	function obtenerMedidasProd($prod){
		//$this->db->where('deleted',0);
		$this->db->select('medida.id, medida.espesor, medida.largo, medida.ancho, medida.precioCubicacion, medida.costo, producto.nombre as nombreprod, medida.idEspecie, especie.nombre as especieNombre');
		$this->db->from('medida');
		$this->db->join('producto','medida.idProducto=producto.id and medida.deleted=0 and '.$prod.'=medida.idProducto');
		$this->db->join('especie','medida.idEspecie=especie.id', 'left');
		$this->db->order_by('medida.largo, medida.espesor, medida.ancho');
		$query = $this->db->get();
		if($query->num_rows() > 0) return $query->result() ;
		else return array();
	}

	function obtenerMedida($id){
		$this->db->where('id',$id);
		$this->db->where('deleted',0);
		$query = $this->db->get('medida');
		if($query->num_rows() > 0) return $query->result();
		else return array();
	}
	function actualizarMedida($id,$data){
		$datos = array(
			'espesor'=>$data['espesor'],
			'largo'=>$data['largo'],
			'ancho'=>$data['ancho'],
			'precioCubicacion'=>$data['precioCubicacion'],
			'costo'=>$data['costo'],
			'idProducto' => $data['idProducto'],
			'idEspecie' => $data['idEspecie']
		);
		$this->db->where('id',$id);
		$query = $this->db->update('medida',$datos);
	}
	function eliminarMedida($id){
		$datos = array(
			'deleted' => 1);
		$this->db->where('id',$id);
		$this->db->update('medida',$datos);
	}
}