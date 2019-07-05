<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/BaseController.php');

class Categoria extends BaseController{
	function __construct() {
        parent::__construct();
        $this->data = array_merge($this->data, array(
			'current' => 'Categoria'
		));
    }
	public function index(){
		$this->load->view('Header', $this->data);
		$this->load->view('Categoria', $this->data);
		$this->load->view('Footer', $this->data);
	}
}