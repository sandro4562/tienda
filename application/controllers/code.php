<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Code extends CI_Controller {
	function __construct(){
		parent::__construct();
		//$this->load->helper('mihelper');
		$this->load->helper('form');
		$this->load->model('code_model');
		$this->load->library('form_validation');
	}

	function index(){
		$this->load->library('menu',array('inicio','contacto','cursos'));
		$data['mi_menu'] = $this->menu->contruirMenu();
		$this->load->view('code/headers');
		$this->load->view('code/bienvenido',$data);
	}

	function nuevouser(){
		$this->load->view('code/headers');
		$this->load->view('code/formulario');
	}

	function recibirdatos(){
		$data = array(
			'correo' => $this->input->post('correo'),
			'nombre' => $this->input->post('nombre'),
			'fecha' => $this->input->post('fecha'),
			'password' => $this->input->post('password'),
			'num_celular' => $this->input->post('num_celular'));
		$this->validarregistro();
		if($this->form_validation->run()==FALSE)
		{
			echo "no entro"+'correo' ;
			$this->load->view('RegistroNuevoUsuario');
		}
		else
		{
			//$this->load->view('code/headers');

			$this->code_model->crearUsuario($data);
			$this->load->view('Header');
			$this->load->view('Home');
			$this->load->view('Footer');
			//$this->load->view('code/bienvenido');
		}
	}
	function editar(){

		$data['id'] = $this->uri->segment(3);
		$data['usuarios'] = $this->code_model-> obtenerUsuario($data['id']);
		$this->load->view('code/headers');
		$this->load->view('code/editar',$data);
	}

	function actualizar(){
		$this->validaredicion();
		if($this->form_validation->run()==FALSE)
		{
			$data['id'] = $this->uri->segment(3);
			$data['usuarios'] = $this->code_model-> obtenerUsuario($data['id']);
			$this->load->view('code/editar', $data);
		}
		else
		{
			$data = array(
			'correo' => $this->input->post('correo'),
			'nombre' => $this->input->post('nombre'),
			'fecha' => $this->input->post('fecha'),
			'num_celular' => $this->input->post('num_celular'));
			$this->code_model->actualizarUsuario($this->uri->segment(3),$data);
			$this->load->view('code/headers');
			$this->load->view('code/bienvenido');
		}
	}

	function borrar(){
		$id = $this->uri->segment(3);
		$this->code_model-> eliminarUsuario($id);
	}
}
?>	