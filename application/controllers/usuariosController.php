<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/BaseController.php');
include_once(APPPATH . 'helpers/auth/register_rules_helper.php');
include_once(APPPATH . 'helpers/auth/actualizar_rules_helper.php');

class usuariosController extends BaseController {
	function __construct() {
		parent::__construct();
		$this->data = array_merge($this->data, array(
			'current' => 'usuariosController',
			'expanded' => 'Usuarios'
		));
		$this->load->helper('form');
		$this->load->model('code_model');
		$this->load->helper(array('auth/register_rules'));
		$this->load->helper(array('auth/actualizar_rules'));
		$this->load->library('form_validation');
	}
	public function index() {
		$this->data = array_merge($this->data, array(
			'currentExpanded' => 'usuariosController'
		));
		$this->load->view('Header',$this->data);
		if($this->data['type'] == 'administrador') {
			$this->load->view('Menu');
			$this->load->view('usuario/registrarUsuario');
		}else{
			$this->load->view('paginaNoEncontrada');
		}
		$this->load->view('Footer');
	}

	function recibirdatos(){
		//$hasError = False;
		$hasError = $this->hasError();
		if($hasError == False) {
			$data = array(
				'correo' => $this->input->post('correo'),
				'nombre' => $this->input->post('nombre'),
				'password' => $this->input->post('password'),
				'tipo' => $this->input->post('tipo'));
			echo "hola ";
			print_r($data);
			if($this->form_validation->run()==FALSE)
			{
				echo "no entro"+'correo' ;
				$this->load->view('usuario/registrarUsuario');
			}
			else
			{
				$this->code_model->crearUsuario($data);
				redirect('/');
			}	
		}
	}
	public function registrarPOST(){
		$hasError = $this->hasError();
		if($hasError == False) {
			$data = array(
				'correo' => $this->input->post('correo'),
				'nombre' => $this->input->post('nombre'),
				'password' => $this->input->post('password'),
				'tipo' => $this->input->post('tipo')
			);
			if($this->form_validation->run()==FALSE)
			{
				echo "no entro"+'correo' ;
				$this->load->view('usuario/registrarUsuario');
			}
			else
			{
				$this->code_model->crearUsuario($data);
				redirect("/usuariosController/listar");
			}	
			
		}
	}
	function editar(){
		$data['id'] = $this->uri->segment(3);
		$data['usuarios'] = $this->code_model->obtenerUsuario($data['id']);
		//Si no existe el producto redireccionar
		if(count($data['usuarios']) == 0) {
			redirect("/usuariosController/listar");
		}
		$this->load->view('Header',$this->data);
		if($this->data['type'] == 'administrador') {
			$this->load->view('Menu');
			$this->load->view('usuario/editarUsuario',$data);
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
			$data['usuarios'] = $this->code_model->obtenerUsuarios();
		}else{
			$data['usuarios'] = $this->code_model->obtenerUsuario($data['segmento']);
		}
		$this->load->view('Header',$this->data);
		if($this->data['type'] == 'administrador') {
			$this->load->view('Menu');
			$this->load->view('usuario/administrarUsuarios',$data);
		}else{
			$this->load->view('paginaNoEncontrada',$data);
		}
		$this->load->view('Footer');
	}

	function actualizar(){
		$hasErrorActualizar = $this->hasErrorActualizar();
		if($hasErrorActualizar == False) {
			$productoId = $this->uri->segment(3);
			$original = $this->code_model->obtenerUsuario($productoId);
			//no se encontro el producto
			if(count($original) == 0) {
				redirect("/");
			}
			$fecha = strtotime($this->input->post('fecha'));
			$newfecha = date('Y-m-d',$fecha);
			$data = array(
				'nombre' => $this->input->post('nombre'),
				'correo' => $this->input->post('correo'),
				'fecha' => $newfecha,
				'password' => $this->input->post('password'),
				'num_celular' => $this->input->post('num_celular'),
				'tipo' => $this->input->post('tipo'),
				'descuento' => $this->input->post('num_descuento'),
				'deleted' => $this->input->post('deleted')
			);
			$this->code_model->actualizarUsuario($productoId,$data);
			$this->output
			->set_status_header(206)
			->set_content_type('application/json')
			->set_output(json_encode(array(
				'url' => "/index.php/usuariosController/listar"
			)));
		}
	}

	function borrar(){
		$id = $this->uri->segment(3);
		$this->code_model-> eliminarUsuario($id);
		redirect("/usuariosController/listar");
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
				'password' => form_error('password')
			);
			echo json_encode($errors);
			$this->output->set_status_header(400);
			return True;
		}
		return False;
	}

}
?>