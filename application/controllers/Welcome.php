<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/BaseController.php');

class Welcome extends BaseController {
	function __construct() {
        parent::__construct();
        $this->data = array_merge($this->data, array(
			'current' => 'Welcome'
		));
    }
	public function index() {
		$this->load->view('welcome_message');
	}
}

