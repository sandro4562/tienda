<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/BaseController.php');

class BaseController extends CI_Controller {
	protected $userId = null;
	protected $username = null;
	protected $current = null;
	protected $data = null;
	
	function __construct() {
        parent::__construct();
        $this->username = $this->input->cookie('username', TRUE);
        $this->load->model('code_model');
        $this->data = array(
	        'userId' => '',
	        'username' => $this->username,
	        'expanded' => '',
	        'currentExpanded' => '',
	        'showOptions' => true
		);
		if($this->username) {
			$user = $this->code_model->obtenerUsuarioCorreo($this->input->cookie()['username']);
			if(count($user) > 0) {
				$this->data = array_merge($this->data, array(
					'type' => $user[0]->rol ? $user[0]->rol : 'user',
					'userId' => $user[0]->id
				));
			} else {
				$this->data = array_merge($this->data, array(
					'type' => 'user'
				));
			}
		} else {
			$this->data = array_merge($this->data, array(
				'type' => 'user'
			));
		}
        

		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = '*';
        $config['max_size']             = 10000;
        $config['max_width']            = 10000;
        $config['max_height']           = 10000;
        $this->load->library('upload', $config);
    }

    public function get_salt() {
		$chars = array(
			'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
			'n', 'o', 'p', 'q', 'r', 'ss', 't', 'u', 'v', 'w', 'x', 'y', 'z',
			'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
			'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
		);
		shuffle($chars);
		$num_chars = count($chars) - 1;
		$token = date('YmdHis');
	  	for ($i = 0; $i < 10; $i++){
	    	$token .= $chars[mt_rand(0, $num_chars)];
	  	}
	  	return $token;
	}

	public function generateSalt() {
		$chars = array(
			'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
			'n', 'o', 'p', 'q', 'r', 'ss', 't', 'u', 'v', 'w', 'x', 'y', 'z',
			'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
			'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
		);
		shuffle($chars);
		$num_chars = count($chars) - 1;
		$token = '';
	  	for ($i = 0; $i < 10; $i++){
	    	$token .= $chars[mt_rand(0, $num_chars)];
	  	}
	  	return $token;
	}


	public function doUpload($imgName) {
		if (empty($_FILES[$imgName]['tmp_name'])) {
		    return null;
		}
		$get_image = $this->input->post(file_get_contents($_FILES[$imgName]['tmp_name']));
		$uploaded = $this->upload->do_upload($imgName);
		$imageBlob = base64_encode(file_get_contents($this->upload->data()['full_path']));
		//print_r($imageBlob);
		return $imageBlob;
	}
}