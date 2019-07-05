<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/BaseController.php');
include_once(APPPATH . 'helpers/auth/login_rules_helper.php');

class Login extends BaseController{
	function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->database();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper(array('auth/login_rules'));
        $this->load->model('code_model');
        $this->data = array_merge($this->data, array(
			'current' => 'Login'
		));
    }
	public function index(){
		$this->data = array_merge($this->data, array(
			'hasError' => false
		));
		$errorMessage = $this->session->flashdata('errorMessage');
		$email = $this->session->flashdata('email');
		if(!empty($errorMessage)){
			$this->data = array_merge($this->data, array(
				'hasError' => true, 
				'message' => $errorMessage,
				'email' => $email
			));
		}
		$this->load->view('IniciarSesion',$this->data);
	}

	public function indexPOST() {
		$hasError = $this->hasError();
		//$hasError = False;
		if($hasError == False) {
			$username = $_POST['form-username'];
			$userpass = $_POST['form-password'];
			$query = $this->db->query("CALL Login('".$username."','".$userpass."')");
			$query = $query->result();
			if(!empty($query)){
				$cookie= array(
					'name'   => 'username',  
					'value'  => $username,
					'expire' => '18000',
				);
				$this->input->set_cookie($cookie);
				$this->output
					->set_status_header(206)
					->set_content_type('application/json')
					->set_output(json_encode(array(
			        	'url' => "/index.php/home/principal"
			       	)));
			}else{
				$this->session->set_flashdata('errorMessage','Usuario o contraseña invalido.');
				$this->session->set_flashdata('email', $username);
				redirect('/login/index');
			}
		}
	}

	public function logout() {
		delete_cookie("userId");
		delete_cookie("username");
		redirect('/home/index');
	}

	public function hasError(){
		$this->form_validation->set_error_delimiters('', '');
		$rules = getLoginRules();
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() === FALSE){
			$errors = array(
				'form-username' => form_error('form-username'),
				'form-password' => form_error('form-password')
			);
			echo json_encode($errors);
			$this->output->set_status_header(400);
			return True;
		}
		return False;
	}
}