<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/BaseController.php');
include_once(APPPATH . 'helpers/auth/tallado_rules_helper.php');

class TalladoController extends BaseController {
  function __construct() {
    parent::__construct();
    $this->data = array_merge($this->data, array(
      'current' => 'TalladoController',
      'expanded' => 'Tallado'
    ));
    $this->load->library('form_validation');
    $this->load->helper(array('auth/tallado_rules'));
    $this->load->helper('form');
    $this->load->helper('file');
    $this->load->model('tallado_model');
    $this->load->model('producto_model');
    $this->load->model('imagen_model');
  }
  public function index() {
    redirect("talladoController/listar");
  }
  public function registrar(){
    $data['productos'] = $this->producto_model->obtenerProductos();
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
      $this->load->view('tallado/crearTallado',$data);
    }else{
      $this->load->view('paginaNoEncontrada',$data);
    }
    $this->load->view('Footer');
  }
  public function registrarPOST(){
    $hasError = $this->hasError();
    if($hasError == False) {
      $salt = parent::get_salt();
      $imagen = parent::doUpload('imagen');
      if($imagen == null) {
        $errors = array(
          'imagen' => 'No selecciono una imagen'
        );
        $this->output->set_status_header(400);
        echo json_encode($errors);
        return;
      }
      $this->imagen_model->save(array(
        'id' => $salt,
        'imagen'=> $imagen  
      ));
      $data = array(
        'nombre' => $this->input->post('nombre'),
        'imagen' => $salt,
        'costo' => $this->input->post('costo'),
        'idProducto' => $this->input->post('idProducto')
      );
      $this->tallado_model->crearTallado($data);
      $this->output
      ->set_status_header(206)
      ->set_content_type('application/json')
      ->set_output(json_encode(array(
        'url' => "/index.php/talladoController/listar"
      )));
    }
  }
  function editar(){
    $data['id'] = $this->uri->segment(3);
    $data['tallados'] = $this->tallado_model-> obtenerTallado($data['id']);
    $data['productos'] = $this->producto_model-> obtenerProductos();
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
      $this->load->view('tallado/editarTallado',$data);
    }else{
      $this->load->view('paginaNoEncontrada',$data);
    }
    $this->load->view('Footer');
  }
  function listar(){
    $data['segmento'] = $this->uri->segment(3);
    
    if(!$data['segmento']){
      $data['tallados'] = $this->tallado_model->obtenerTallados();
    }else{
      $data['tallados'] = $this->tallado_model->obtenerTallado($data['segmento']);
    }
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
      $this->load->view('tallado/administrarTallado',$data);
    }else{
      $this->load->view('paginaNoEncontrada',$data);
    }
    $this->load->view('Footer');
  }
  function actualizar(){
    $hasError = $this->hasError();
    if($hasError == False) {
      $imagen = parent::doUpload('imagen');
      $talladoId = $this->uri->segment(3);
      $original = $this->tallado_model->obtenerTallado($talladoId);
      //no se encontro el producto
      if(count($original) == 0) {
        redirect("/");
      }
      $salt = null;
      if($imagen == null) {
        $salt = $original[0]->imagen;
      } else {
        $salt = parent::get_salt();
        $this->imagen_model->save(array(
          'id' => $salt,
          'imagen'=> parent::doUpload('imagen')
        ));
      }
      $data = array(
        'nombre' => $this->input->post('nombre'),
        'imagen' => $salt,
        'costo' => $this->input->post('costo'),
        'idProducto' => $this->input->post('idProducto')
      );
      $this->tallado_model->actualizarTallado($this->uri->segment(3),$data);
      $this->output
      ->set_status_header(206)
      ->set_content_type('application/json')
      ->set_output(json_encode(array(
        'url' => "/index.php/talladoController/listar"
      )));
    }
  }
  function borrar(){
    $id = $this->uri->segment(3);
    $this->tallado_model-> eliminarTallado($id);
    redirect("talladoController/listar");
  }

  public function hasError(){
    $this->form_validation->set_error_delimiters('', '');
    $rules = getTalladoRules();
    $this->form_validation->set_rules($rules);
    if($this->form_validation->run() === FALSE){
      $errors = array(
        'nombre' => form_error('nombre'),
        'costo' => form_error('costo')
      );
      echo json_encode($errors);
      $this->output->set_status_header(400);
      return True;
    }
    return False;
  }
}