<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/BaseController.php');

class About extends BaseController {
	function __construct() {
        parent::__construct();
        $this->data = array_merge($this->data, array(
			'current' => 'About'
		));
    }
	public function index(){
		$this->load->view('Header', $this->data);
		$this->load->view('About', $this->data);
		$this->load->view('Footer', $this->data);
	}
}