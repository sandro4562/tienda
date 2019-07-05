<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/BaseController.php');
include_once(APPPATH . 'helpers/auth/register_rules_helper.php');
include_once(APPPATH . 'helpers/auth/actualizar_rules_helper.php');

class clienteController extends BaseController {
	function __construct() {
		parent::__construct();
		$this->data = array_merge($this->data, array(
			'current' => 'clienteController',
			'expanded' => 'Clientes'
		));
		$this->load->helper('form');
		$this->load->model('cliente_model');
		//$this->load->helper(array('auth/register_rules'));
		//$this->load->helper(array('auth/actualizar_rules'));
		$this->load->library('form_validation');
	}
	public function index() {
		$this->data = array_merge($this->data, array(
			'currentExpanded' => 'clienteController'
		));
		$this->load->view('Header',$this->data);
		if($this->data['type'] == 'administrador') {
			$this->load->view('Menu');
			$this->load->view('cliente/registrarCliente');
		}else{
			$this->load->view('paginaNoEncontrada');
		}
		$this->load->view('Footer');
	}

	public function registrarPOST(){
		//$hasError = $this->hasError();
		$hasError = False;
		if($hasError == False) {
			$data = array(
				'apellido' => $this->input->post('apellido'),
				'nombre' => $this->input->post('nombre'),
				'ci' => $this->input->post('ci')
			);
			$this->cliente_model->crearCLiente($data);
			redirect("/clienteController/listar");				
		}
	}
	function editar(){
		$data['id'] = $this->uri->segment(3);
		$data['usuarios'] = $this->cliente_model->obtenerCliente($data['id']);
		//Si no existe el producto redireccionar
		if(count($data['usuarios']) == 0) {
			redirect("/clienteController/listar");
		}
		$this->load->view('Header',$this->data);
		if($this->data['type'] == 'administrador') {
			$this->load->view('Menu');
			$this->load->view('cliente/editarCliente',$data);
		}else{
			$this->load->view('paginaNoEncontrada',$data);
		}
		$this->load->view('Footer');
	}
	function listar(){
		$this->data = array_merge($this->data, array(
			'currentExpanded' => 'usuariosController'
		));
		$data['segmento'] = $this->uri->segment(3);
		if(!$data['segmento']){
			$data['usuarios'] = $this->cliente_model->obtenerClientes();
		}else{
			$data['usuarios'] = $this->cliente_model->obtenerCliente($data['segmento']);
		}
		$this->load->view('Header',$this->data);
		print_r($this->data);
		if($this->data['type'] == 'administrador') {
			$this->load->view('Menu');
			$this->load->view('cliente/administrarClientes',$data);
		}else{
			$this->load->view('paginaNoEncontrada',$data);
		}
		$this->load->view('Footer');
	}

	function actualizar(){
		//$hasErrorActualizar = $this->hasErrorActualizar();
		$hasErrorActualizar = False;
		if($hasErrorActualizar == False) {
			/*$productoId = $this->uri->segment(3);
			$original = $this->code_model->obtenerUsuario($productoId);
			//no se encontro el producto
			if(count($original) == 0) {
				redirect("/");
			}
			$fecha = strtotime($this->input->post('fecha'));
			$newfecha = date('Y-m-d',$fecha);*/
			$data = array(
				'nombre' => $this->input->post('nombre'),
				'apellido' => $this->input->post('apellido'),
				'ci' => $this->input->post('ci'),
				'deleted' => $this->input->post('deleted')
			);
			$this->cliente_model->actualizarCliente($this->uri->segment(3),$data);
			$this->output
			->set_status_header(206)
			->set_content_type('application/json')
			->set_output(json_encode(array(
				'url' => "/index.php/clienteController/listar"
			)));
		}
	}

	function borrar(){
		$id = $this->uri->segment(3);
		$this->cliente_model-> eliminarCliente($id);
		redirect("/clienteController/listar");
	}

	public function hasError(){
		$this->form_validation->set_error_delimiters('', '');
		$rules = getRegisterRules();
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() === FALSE){
			$errors = array(
				'nombre' => form_error('nombre'),
				'correo' => form_error('correo'),
				'password' => form_error('password'),
				'tipo' => form_error('tipo')
			);
			echo json_encode($errors);
			$this->output->set_status_header(400);
			return True;
		}
		return False;
	}

	public function hasErrorActualizar(){
		$this->form_validation->set_error_delimiters('', '');
		$rules = getActualizarRules();
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() === FALSE){
			$errors = array(
				'nombre' => form_error('nombre'),
				'fecha' => form_error('fecha'),
				'password' => form_error('password'),
				'num_celular' => form_error('num_celular'),
				'num_descuento' => form_error('num_descuento'),
				'tipo' => form_error('tipo')
			);
			echo json_encode($errors);
			$this->output->set_status_header(400);
			return True;
		}
		return False;
	}

}
?>