<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/BaseController.php');
include_once(APPPATH . 'helpers/auth/register_rules_helper.php');

class Registrar extends BaseController {
	function __construct() {
        parent::__construct();
        $this->data = array_merge($this->data, array(
			'current' => 'Registrar'
		));
		$this->load->helper('form');
		$this->load->model('code_model');
		$this->load->helper(array('auth/register_rules'));
		$this->load->library('form_validation');
    }
	public function index() {
		$this->load->view('RegistroNuevoUsuario');
	}

	function recibirdatos(){
		$hasError = $this->hasError();
		if($hasError == False) {
			$fecha = strtotime($this->input->post('fecha'));
			$newfecha = date('Y-m-d',$fecha);
			$data = array(
			'correo' => $this->input->post('correo'),
			'nombre' => $this->input->post('nombre'),
			'fecha' => $newfecha,
			'password' => $this->input->post('password'),
			'num_celular' => $this->input->post('num_celular'));
			if($this->form_validation->run()==FALSE)
			{
				echo "no entro"+'correo' ;
				$this->load->view('RegistroNuevoUsuario');
			}
			else
			{
				$this->code_model->crearUsuario($data);
				redirect('/login/index');
			}	
		}
	}

	function editar(){
		$data['id'] = $this->uri->segment(3);
		$data['usuarios'] = $this->code_model-> obtenerUsuario($data['id']);
		//$this->load->view('Header');
		$this->load->view('usuarios/editar',$data);
	}
	function lectura(){
		$data['segmento'] = $this->uri->segment(3);
		$this->load->view('Header');
		if(!$data['segmento']){
			$data['usuarios'] = $this->code_model->obtenerUsuarios();
		}else{
			$data['usuarios'] = $this->code_model->obtenerUsuario($data['segmento']);
		}
		$this->load->view('usuarios/usuarios',$data);
		$this->load->view('Footer');
	}
	function actualizar(){
		$data = array(
			'correo' => $this->input->post('correo'),
			'nombre' => $this->input->post('nombre'),
			'fecha' => $this->input->post('fecha'),
			'num_celular' => $this->input->post('num_celular')
		);
		$this->code_model->actualizarUsuario($this->uri->segment(3),$data);
		$this->load->view('Header');
		$this->load->view('Home');
		$this->load->view('Footer');
	}
	function borrar(){
		$id = $this->uri->segment(3);
		$this->code_model-> eliminarUsuario($id);
		$this->load->view('code/headers');
		$this->load->view('code/bienvenido');
	}

	public function hasError(){
		$this->form_validation->set_error_delimiters('', '');
		$rules = getRegisterRules();
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() === FALSE){
			$errors = array(
				'nombre' => form_error('nombre'),
				'fecha' => form_error('fecha'),
				'correo' => form_error('correo'),
				'password' => form_error('password'),
				'num_celular' => form_error('num_celular')
			);
			echo json_encode($errors);
			$this->output->set_status_header(400);
			return True;
		}
		return False;
	}
}
?>