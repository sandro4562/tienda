<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function crearStock($data){
		$this->db->insert('stock',array(
			'idProducto'=>$data['idProducto'],
			'idEspecie'=>$data['idEspecie'],
			'espesor' => $data['espesor'],
			'largo' => $data['largo'],
			'ancho' => $data['ancho'],
			'ingreso' => $data['ingreso'],
			'egreso' => $data['egreso'],
			'deleted'=> 0));
	}
	function obtenerStocks(){
		$this->db->select('stock.id as idStock, stock.ingreso, stock.egreso, producto.nombre as nombreprod, producto.imagen, stock.espesor, stock.largo, stock.ancho, especie.nombre as nombreesp, stock.creation_time as fecha_registro');
		$this->db->from('stock');
		$this->db->where('stock.deleted',0);
		$this->db->join('producto','stock.idProducto=producto.id');
		$this->db->join('especie','stock.idEspecie=especie.id', 'left');
		$this->db->order_by('stock.creation_time');
		$query = $this->db->get();
		if($query->num_rows() > 0) return $query->result() ;
		else return array();
	}

	function obtenerStocksPorProducto($id){
		$this->db->select('stock.id as idStock, stock.ingreso, stock.egreso, producto.nombre as nombreprod, producto.imagen, stock.espesor, stock.largo, stock.ancho, especie.nombre as nombreesp, stock.creation_time as fecha_registro, producto.id as productoId');
		$this->db->from('stock');
		$this->db->where('stock.idProducto',$id);
		$this->db->where('stock.deleted',0);
		$this->db->join('producto','stock.idProducto=producto.id');
		$this->db->join('especie','stock.idEspecie=especie.id', 'left');
		$this->db->order_by('stock.creation_time');
		$query = $this->db->get();
		if($query->num_rows() > 0) return $query->result() ;
		else return array();
	}

	function obtenerStock($id){
		$this->db->select('stock.id as idStock, stock.ingreso, stock.egreso, producto.nombre as nombreprod, producto.imagen, stock.espesor, stock.largo, stock.ancho, especie.nombre as nombreesp, especie.id as especieId, producto.id as productoId');
		$this->db->from('stock');
		$this->db->where('stock.id',$id);
		$this->db->where('stock.deleted',0);
		$this->db->join('producto','stock.idProducto=producto.id');
		$this->db->join('especie','stock.idEspecie=especie.id', 'left');
		$query = $this->db->get();
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


	function actualizarStock($id,$data){
		$datos = array(
			'ingreso' => $data['ingreso'],
			'largo' => $data['largo'],
			'ancho' => $data['ancho'],
			'espesor' => $data['espesor'],
			'egreso' => $data['egreso']
		);
		$this->db->where('id',$id);
		$query = $this->db->update('stock',$datos);
	}
	function eliminarStock($id){
		$datos = array('deleted' => 1);
		$this->db->where('id',$id);
		$this->db->update('stock',$datos);
	}
}