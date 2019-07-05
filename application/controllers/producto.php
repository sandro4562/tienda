<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/BaseController.php');
include_once(APPPATH . 'helpers/auth/producto_rules_helper.php');

class Producto extends BaseController {
	function __construct() {
		parent::__construct();
		$this->data = array_merge($this->data, array(
			'current' => 'Producto',
			'expanded' => 'Producto'
		));
		$this->load->library('form_validation');
		$this->load->helper(array('auth/producto_rules'));
		$this->load->helper('form');
		$this->load->helper('file');
		$this->load->model('producto_model');
		$this->load->model('imagen_model');
	}

	public function registrar(){
		$this->load->view('Header',$this->data);
		if($this->data['type'] == 'administrador') {
			$this->load->view('Menu', $this->data);
			$this->load->view('producto/crearProducto');
		}else{
			$this->load->view('paginaNoEncontrada');
		}
		$this->load->view('Footer');
	}
	
	public function registrarPOST(){
		$hasError = $this->hasError();
		if($hasError == False) {
			$salt = parent::get_salt();
			$imagen = parent::doUpload('imagen');
			if($imagen == null) {
				$errors = array(
					'imagen' => 'No selecciono una imagen'
				);
				$this->output->set_status_header(400);
				echo json_encode($errors);
				return;
			}
			$this->imagen_model->save(array(
				'id' => $salt,
				'imagen'=> $imagen
			));
			$data = array(
				'nombre' => $this->input->post('nombre'),
				'imagen' => $salt,
				'precio' => $this->input->post('precio')
			);
			$this->producto_model->crearProducto($data);
			$this->output
			->set_status_header(206)
			->set_content_type('application/json')
			->set_output(json_encode(array(
				'url' => "/index.php/producto/listar"
			)));
		}
	}
	function editar(){
		$data['id'] = $this->uri->segment(3);
		$data['productos'] = $this->producto_model->obtenerProducto($data['id']);
		//Si no existe el producto redireccionar
		if(count($data['productos']) == 0) {
			redirect("/producto/listar");
		}
		$this->load->view('Header',$this->data);
		if($this->data['type'] == 'administrador') {
			$this->load->view('Menu', $this->data);
			$this->load->view('producto/editarProducto',$data);
		}else{
			$this->load->view('paginaNoEncontrada');
		}
		$this->load->view('Footer');
	}
	function listar(){
		$data['segmento'] = $this->uri->segment(3);
		if(!$data['segmento']){
			$data['productos'] = $this->producto_model->obtenerProductos();
		}else{
			$data['productos'] = $this->producto_model->obtenerProducto($data['segmento']);
		}
		$this->load->view('Header',$this->data);
		if($this->data['type'] == 'administrador') {
			$this->load->view('Menu', $this->data);
			$this->load->view('producto/administrarProducto',$data);
		}else{
			$this->load->view('paginaNoEncontrada');
		}
		$this->load->view('Footer');
	}
	
	function actualizar(){
		$hasError = $this->hasError();
		if($hasError == False) {
			$imagen = parent::doUpload('imagen');
			$productoId = $this->uri->segment(3);
			$original = $this->producto_model->obtenerProducto($productoId);
			//no se encontro el producto
			if(count($original) == 0) {
				redirect("/");
			}
			//Si el usuario selecciono una imagen crear la nueva imagen, si no selecciono nada mantener la anterior
			$salt = null;
			if($imagen == null) {
				$salt = $original[0]->imagen;
			} else {
				$salt = parent::get_salt();
				$this->imagen_model->save(array(
					'id' => $salt,
					'imagen'=> parent::doUpload('imagen')
				));
			}
			$data = array(
				'nombre' => $this->input->post('nombre'),
				'imagen' => $salt,
				'precio' => $this->input->post('precio')
			);
			$this->producto_model->actualizarProducto($productoId,$data);
			print_r($this->producto_model->actualizarProducto($productoId,$data));
			$this->output
			->set_status_header(206)
			->set_content_type('application/json')
			->set_output(json_encode(array(
				'url' => "/index.php/producto/listar"
			)));
		}
	}
	function borrar(){
		$id = $this->uri->segment(3);
		$this->producto_model-> eliminarProducto($id);
		redirect("/producto/listar");
	}
	function borrarProductoAjax(){
		$id = $this->uri->segment(3);
		$this->producto_model-> eliminarProducto($id);
		$this->output
		->set_status_header(206)
		->set_content_type('application/json')
		->set_output(json_encode(array(
			'url' => ""
		)));
	}
	public function detalle(){
		$data['id'] = $this->uri->segment(3);
		$data['productos'] = $this->producto_model-> obtenerProducto($data['id']);
		$this->load->view('Header',$this->data);
		if($this->data['type'] == 'admin') {
			$this->load->view('Menu', $this->data);
		}
		$this->load->view('compra_cotizacion/ListaCompra', $this->data);
		$this->load->view('Product',$data);
		$this->load->view('Footer');
	}
	public function hasError(){
		$this->form_validation->set_error_delimiters('', '');
		$rules = getProductoRules();
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() === FALSE){
			$errors = array(
				'nombre' => form_error('nombre')
			);
			echo json_encode($errors);
			$this->output->set_status_header(400);
			return True;
		}
		return False;
	}
}