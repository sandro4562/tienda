<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/BaseController.php');
include_once(APPPATH . 'helpers/auth/especie_rules_helper.php');

class EspecieController extends BaseController {
  function __construct() {
    parent::__construct();
    $this->data = array_merge($this->data, array(
      'current' => 'EspecieController',
      'expanded' => 'Especie'
    ));
    $this->load->library('form_validation');
    $this->load->helper(array('auth/especie_rules'));
    $this->load->helper('form');
    $this->load->model('especie_model');
    $this->load->model('producto_model');
  }
  public function index() {
    redirect("especieController/listar");
  }
  public function registrar(){
    $this->data = array_merge($this->data, array(
      'currentExpanded' => 'CrearEspecie'
    ));
    $data['productos'] = $this->producto_model->obtenerProductos();
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
      $this->load->view('especie/crearEspecie',$data);
    }else{
      $this->load->view('paginaNoEncontrada',$data);
    }
    $this->load->view('Footer');
    
  }
  function recibirdatos(){
    $hasError = $this->hasError();
    if($hasError == False) {
      $data = array(
        'nombre' => $this->input->post('nombre'),
        'idProducto' => $this->input->post('idProducto')
      );
      $this->especie_model->crearEspecie($data);
      redirect("especieController/listar");
    }
  }
  function editar(){
    $data['id'] = $this->uri->segment(3);
    $data['especies'] = $this->especie_model-> obtenerEspecie($data['id']);
    $data['productos'] = $this->producto_model-> obtenerProductos();
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
      $this->load->view('especie/editarEspecie',$data);
    }else{
      $this->load->view('paginaNoEncontrada',$data);
    }
    $this->load->view('Footer');
  }
  function listar(){
    $data['segmento'] = $this->uri->segment(3);
    if(!$data['segmento']){
      $data['especies'] = $this->especie_model->obtenerEspecies();
    }else{
      $data['especies'] = $this->especie_model->obtenerEspecie($data['segmento']);
    }
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
      $this->load->view('especie/administrarEspecie',$data);
    }else{
      $this->load->view('paginaNoEncontrada',$data);
    }
    $this->load->view('Footer');
  }
  function actualizar(){
    $hasError = $this->hasError();
    if($hasError == False) {
      $data = array(
        'nombre' => $this->input->post('nombre'),
        'idProducto' => $this->input->post('idProducto')
      );
      $this->especie_model->actualizarEspecie($this->uri->segment(3),$data);
      redirect("especieController/listar");
    }
  }
  function borrar(){
    $id = $this->uri->segment(3);
    $this->especie_model-> eliminarEspecie($id);
    redirect("especieController/listar");
  }

  public function hasError(){
    $this->form_validation->set_error_delimiters('', '');
    $rules = getEspecieRules();
    $this->form_validation->set_rules($rules);
    if($this->form_validation->run() === FALSE){
      $errors = array(
        'nombre' => form_error('nombre')
      );
      echo json_encode($errors);
      $this->output->set_status_header(400);
      return True;
    }
    return False;
  }
}