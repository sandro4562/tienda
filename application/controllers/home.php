<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/BaseController.php');

class Home extends BaseController {
	function __construct() {
        parent::__construct();
        $this->data = array_merge($this->data, array(
      		'current' => 'EspecieController',
      		'expanded' => 'Especie'
    	));
		$this->load->model('producto_model');
		$this->load->model('code_model');
		$this->load->model('cotizacion_model');

    }
	public function index(){
		$this->data = array_merge($this->data, array(
      		'showOptions' => false
    	));
		$this->load->view('Header',$this->data);
		$this->load->view('Principal', $this->data);
		$this->load->view('Footer');
	}

	public function principal() {
		$username = $this->data['username'];
		if($username !== null){
			$id = $this->code_model->obtenerUsuarioCorreo($username);
			//$data['cotizaciones'] = $this->cotizacion_model->obtenerCotizacionesUser($id[0]->id);
			//$data['productos'] = $this->producto_model->obtenerProductos();
			$data = "";
			print_r($this->data);
			$this->load->view('Header', $this->data);
			if($this->data['type'] == 'administrador') {
				$this->load->view('Menu', $this->data);
			}
			$this->load->view('compra_cotizacion/ListaCompra', $data);
			$this->load->view('Home', $data);
			$this->load->view('Footer', $this->data);
		}else{
			//$data['productos'] = $this->producto_model->obtenerProductos();
			//$data['cotizaciones'] = false;
			$this->load->view('Header', $this->data);
			if($this->data['type'] == 'administrador') {
				$this->load->view('Menu', $this->data);
			}
			if($this->data['username']) {
				$this->load->view('compra_cotizacion/ListaCompra',$data);
			}
			$this->load->view('Home', $data);
			$this->load->view('Footer', $this->data);
		}
	}
}