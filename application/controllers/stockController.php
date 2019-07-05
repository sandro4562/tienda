<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/BaseController.php');
include_once(APPPATH . 'helpers/auth/cotizacion_rules_helper.php');

class StockController extends BaseController {
	function __construct() {
		parent::__construct();
		$this->data = array_merge($this->data, array(
			'current' => 'StockController',
			'expanded' => 'Stock'
		));
		$this->load->library('form_validation');
		$this->load->helper(array('auth/cotizacion_rules'));
		$this->load->helper('form');
		$this->load->model('especie_model');
		$this->load->model('producto_model');
		$this->load->model('medida_model');
		$this->load->model('stock_model');
	}

	public function index() {
		redirect("especieController/listar");
	}

	public function registrar(){
		$this->data = array_merge($this->data, array(
			'currentExpanded' => 'CrearEspecie'
		));
		$data['productos'] = $this->producto_model->obtenerProductos();
		$this->load->view('Header',$this->data);
		if($this->data['type'] == 'admin') {
			$this->load->view('Menu', $this->data);
			$this->load->view('especie/crearEspecie',$data);
		}else{
			$this->load->view('paginaNoEncontrada',$data);
		}
		$this->load->view('Footer');
	}

	public function registarStockProducto(){
		$data['productos'] = $this->producto_model-> obtenerProductos();
		$this->data = array_merge($this->data, array(
			'currentExpanded' => 'CrearStrock'
		));
		$this->load->view('Header',$this->data);
		if($this->data['type'] == 'admin') {
			$this->load->view('Menu', $this->data);
			$this->load->view('stock/seleccionarProductoStock',$data);
		}else{
			$this->load->view('paginaNoEncontrada',$data);
		}
		$this->load->view('Footer');
	}

	function general(){
		$data['stock'] = $this->stock_model-> obtenerStocks();
		$this->load->view('Header',$this->data);
		$this->load->view('Menu',$this->data);
		$this->load->view('stock/stockGlobal',$data);
		$this->load->view('Footer',$this->data);
	}

	function recibirdatos(){
		$hasError = $this->hasError();
		$cantidad = floatval($this->input->post('cantidad'));
		if($hasError == False) {
			$data = array(
				'idProducto' => $this->uri->segment(3),
				'idEspecie' => $this->input->post('especie'),
				'largo' => $this->input->post('largo'),
				'ancho' => $this->input->post('ancho'),
				'espesor' => $this->input->post('espesor'),
				'ingreso' => $cantidad >= 0 ? $cantidad : 0,
				'egreso' => $cantidad < 0 ? $cantidad * -1 : 0
			);
			$this->stock_model->crearStock($data);
			$this->output
		        ->set_status_header(206)
		        ->set_content_type('application/json')
		        ->set_output(json_encode(array(
		              'url' => "/index.php/stockController/listarPorProducto/".$this->uri->segment(3)
		            )));
		}
	}

	function editar(){
		$data['id'] = $this->uri->segment(3);
		$data['stocks'] = $this->stock_model->obtenerStock($data['id']);
		$this->load->view('Header',$this->data);
		if($this->data['type'] == 'admin') {
			$this->load->view('Menu', $this->data);
			$data['medidas'] = $this->medida_model->obtenerMedidasProd($data['stocks'][0]->productoId);
			$this->load->view('stock/editarStock',$data);
		}else{
			$this->load->view('paginaNoEncontrada',$data);
		}		
		$this->load->view('Footer');
	}

	function listarStockProducto() {
		$data['productos'] = $this->producto_model-> obtenerProductos();
		$this->load->view('Header',$this->data);
		if($this->data['type'] == 'admin') {
			$this->load->view('Menu', $this->data);
			$this->load->view('stock/listarStockProducto',$data);
		}else{
			$this->load->view('paginaNoEncontrada',$data);
		}
		$this->load->view('Footer');
	}

	function listarPorProducto(){
		$data['segmento'] = $this->uri->segment(3);
		if(!$data['segmento']){
			$this->load->view('paginaNoEncontrada',$data);
			return;
		}else{
			$data['stock'] = $this->stock_model->obtenerStocksPorProducto($data['segmento']);
		}
		$this->load->view('Header',$this->data);
		if($this->data['type'] == 'admin') {
			$this->load->view('Menu', $this->data);
			$this->load->view('stock/administrarStockProducto',$data);
		}else{
			$this->load->view('paginaNoEncontrada',$data);
		}
		$this->load->view('Footer');
	}

	function actualizar(){
		$hasError = $this->hasError();
		$productoId = $this->input->post('productoId');
		$cantidad = floatval($this->input->post('cantidad'));
		if($hasError == False) {
			$data = array(
				'ingreso' => $this->input->post('cantidad'),
				'largo' => $this->input->post('largo'),
				'ancho' => $this->input->post('ancho'),
				'espesor' => $this->input->post('espesor'),
				'ingreso' => $cantidad >= 0 ? $cantidad : 0,
				'egreso' => $cantidad < 0 ? $cantidad * -1 : 0
			);
			$this->stock_model->actualizarStock($this->uri->segment(3),$data);
			$this->output
		        ->set_status_header(206)
		        ->set_content_type('application/json')
		        ->set_output(json_encode(array(
		              'url' => "/index.php/stockController/listarPorProducto/".$productoId
		            )));
		}
	}
	function borrar(){
		$id = $this->uri->segment(3);
		$productoId = $this->input->post('productoId');
		$this->stock_model->eliminarStock($id);
		$this->output
        ->set_status_header(206)
        ->set_content_type('application/json')
        ->set_output(json_encode(array(
              'url' => "/index.php/stockController/listarPorProducto/".$productoId
            )));
	}

	function registrarStock() {
		$id = $this->uri->segment(3);
		$data['productos'] = $this->producto_model->obtenerProducto($id);
		$data['especies'] = $this->especie_model->obtenerEspeciesProd($id);
		$data['medidas'] = $this->medida_model->obtenerMedidasProd($id);
		$this->data = array_merge($this->data, array(
			'currentExpanded' => 'CrearStrock'
		));
		$this->load->view('Header',$this->data);
		if($this->data['type'] == 'admin') {
			$this->load->view('Menu', $this->data);
			$this->load->view('stock/crearStock',$data);
		}else{
			$this->load->view('paginaNoEncontrada');
		}
		$this->load->view('Footer');
	}

	public function hasError(){
		$this->form_validation->set_error_delimiters('', '');
		$rules = $this->getStockRules();
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() === FALSE){
			$errors = array(
				'cantidad' => form_error('cantidad'),
				'espesor' => form_error('espesor'),
				'ancho' => form_error('ancho'),
				'largo' => form_error('largo')
			);
			echo json_encode($errors);
			$this->output->set_status_header(400);
			return True;
		}
		return False;
	}

	public function getStockRules() {
		return array(
			array(
				'field' => 'espesor',
				'label' => 'espesor',
				'rules' => 'trim|required|numeric|greater_than[0]',
				'errors' => array(
					'required'=> 'El %s es requerido.',
					'numeric'=> 'El %s debe ser un numero.',
					'greater_than'=> 'El espesor es invalido.'
				),
			),
			array(
				'field' => 'ancho',
				'label' => 'ancho',
				'rules' => 'trim|required|numeric|greater_than[0]',
				'errors' => array(
					'required'=> 'El %s es requerido.',
					'numeric'=> 'El %s debe ser un numero.',
					'greater_than'=> 'El ancho es invalido.'
				),
			),
			array(
				'field' => 'largo',
				'label' => 'largo',
				'rules' => 'trim|required|numeric|greater_than[0]',
				'errors' => array(
					'required'=> 'El %s es requerido.',
					'numeric'=> 'El %s debe ser un numero.',
					'greater_than'=> 'El largo es invalido.'
				),
			),
			array(
				'field' => 'cantidad',
				'label' => 'cantidad',
				'rules' => 'trim|required|numeric',
				'errors' => array(
					'required'=> 'La %s es requerida.',
					'numeric'=> 'La %s es numerico.'
				),
			),
	 	);
	} 
}