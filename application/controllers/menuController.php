<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/BaseController.php');

class MenuController extends BaseController {
	function __construct() {
        parent::__construct();
        $this->data = array_merge($this->data, array(
			'current' => 'Menu'
		));
    }
	public function index(){
		$this->load->view('Header', $this->data);
		if($this->data['type'] == 'admin') {
			$this->load->view('Menu', $this->data);
		}
		$this->load->view('Footer', $this->data);
	}
}