<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/BaseController.php');
include_once(APPPATH . 'helpers/auth/cepillado_rules_helper.php');

class CepilladoController extends BaseController {
  function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('auth/cepillado_rules'));
        $this->data = array_merge($this->data, array(
      'current' => 'CepilladoController',
      'expanded' => 'Cepillado'
    ));
    $this->load->helper('form');
    $this->load->model('cepillado_model');
    $this->load->model('producto_model');

    }
  public function index() {
    redirect("cepilladoController/listar");
  }
  public function registrar(){
    $data['productos'] = $this->producto_model->obtenerProductos();
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
      $this->load->view('cepillado/crearCepillado',$data);
    }else{
      $this->load->view('paginaNoEncontrada',$data);
    }
    $this->load->view('Footer');
  }
  function recibirdatos(){
    $hasError = $this->hasError();
    if($hasError == False) {
      $data = array(
      'costo' => $this->input->post('costo'),
      'caras' => $this->input->post('caras'),
      'idProducto' => $this->input->post('idProducto')
      );
      $this->cepillado_model->crearCepillado($data);
      redirect("cepilladoController/listar");
    }
  }
  function editar(){
    $data['id'] = $this->uri->segment(3);
    $data['cepillados'] = $this->cepillado_model-> obtenerCepillado($data['id']);
    $data['productos'] = $this->producto_model-> obtenerProductos();
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
      $this->load->view('cepillado/editarCepillado',$data);
    }else{
      $this->load->view('paginaNoEncontrada',$data);
    }
    $this->load->view('Footer');
  }
  function listar(){
    $data['segmento'] = $this->uri->segment(3);
    
    if(!$data['segmento']){
      $data['cepillados'] = $this->cepillado_model->obtenerCepillados();
    }else{
      $data['cepillados'] = $this->cepillado_model->obtenerCepillado($data['segmento']);
    }
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
      $this->load->view('cepillado/administrarCepillado',$data);
    }else{
      $this->load->view('paginaNoEncontrada',$data);
    }
    $this->load->view('Footer');
  }
  function actualizar(){
    $hasError = $this->hasError();
    if($hasError == False) {
      $data = array(
        'costo' => $this->input->post('costo'),
        'caras' => $this->input->post('caras'),
        'idProducto' => $this->input->post('idProducto')
      );
      $this->cepillado_model->actualizarCepillado($this->uri->segment(3),$data);
      redirect("cepilladoController/listar");
    }
  }
  function borrar(){
    $id = $this->uri->segment(3);
    $this->cepillado_model-> eliminarCepillado($id);
    redirect("cepilladoController/listar");
  }

  public function hasError(){
    $this->form_validation->set_error_delimiters('', '');
    $rules = getCepilladoRules();
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