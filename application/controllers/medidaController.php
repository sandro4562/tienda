<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/BaseController.php');
include_once(APPPATH . 'helpers/auth/medida_rules_helper.php');

class MedidaController extends BaseController {
  function __construct() {
    parent::__construct();
    $this->data = array_merge($this->data, array(
      'current' => 'MedidaController',
      'expanded' => 'Medida'
    ));
    $this->load->library('form_validation');
    $this->load->helper(array('auth/medida_rules'));
    $this->load->helper('form');
    $this->load->model('medida_model');
    $this->load->model('especie_model');
    $this->load->model('producto_model');
    $this->load->library('session');
  }

  public function index() {
    redirect("medidaController/listar");
  }

  public function registrar() {
    $data['productos'] = $this->producto_model->obtenerProductos();
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu');
      $data['especies'] = $this->especie_model->obtenerEspecies();
      $data['especiesJson'] = json_encode($data['especies']);

      $this->load->view('medida/crearMedidas',$data);
    } else {
      $this->load->view('paginaNoEncontrada',$data);
    }
    $this->load->view('Footer');
    if(!empty($this->session->flashdata('showMessage'))) {
      $this->load->view('common/itemGuardadoCorrectamente');
    }
  }

  function recibirdatos(){
    $hasError = $this->hasError();
    if($hasError == False) {
      $data = array(
        'espesor' => $this->input->post('espesor'),
        'ancho' => $this->input->post('ancho'),
        'largo' => $this->input->post('largo'),
        'costo' => $this->input->post('costo'),
        'idEspecie' => $this->input->post('idEspecie'),
        'idProducto' => $this->input->post('idProducto')
      );
      $this->medida_model->crearMedida($data);
      $this->session->set_flashdata('showMessage','true');
      redirect("medidaController/registrar");
    }
  }
  function editar(){
    $data['id'] = $this->uri->segment(3);
    $data['medidas'] = $this->medida_model-> obtenerMedida($data['id']);
    $data['productos'] = $this->producto_model-> obtenerProductos();
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
      $data['especies'] = $this->especie_model->obtenerEspecies();
      $data['especiesJson'] = json_encode($data['especies']);
      $this->load->view('medida/editarMedida',$data);
    }else{
      $this->load->view('paginaNoEncontrada',$data);
    }
    $this->load->view('Footer');
  }
  function listar(){
    $data['segmento'] = $this->uri->segment(3);
    if(!$data['segmento']){
      $data['medidas'] = $this->medida_model->obtenerMedidas();
    }else{
      $data['medidas'] = $this->medida_model->obtenerMedida($data['segmento']);
    }
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
      $this->load->view('medida/administrarMedida',$data);
    }else{
      $this->load->view('paginaNoEncontrada',$data);
    }
    $this->load->view('Footer');
  }
  function actualizar(){
    $hasError = $this->hasError();
    if($hasError == False) {
      $data = array(
        'espesor' => $this->input->post('espesor'),
        'ancho' => $this->input->post('ancho'),
        'largo' => $this->input->post('largo'),
        'precioCubicacion' => $this->input->post('precioCubicacion'),
        'costo' => $this->input->post('costo'),
        'idEspecie' => $this->input->post('idEspecie'),
        'idProducto' => $this->input->post('idProducto')
      );
      $this->medida_model->actualizarMedida($this->uri->segment(3),$data);
      redirect("medidaController/listar");
    }
  }
  function borrar(){
    $id = $this->uri->segment(3);
    $this->medida_model-> eliminarMedida($id);
    redirect("medidaController/listar");
  }

  public function hasError(){
    $this->form_validation->set_error_delimiters('', '');
    $rules = $this->getMedidaRules();
    $this->form_validation->set_rules($rules);
    if($this->form_validation->run() === FALSE){
      $errors = array(
        'nombre' => form_error('nombre'),
        'espesor' => form_error('espesor'),
        'costo' => form_error('costo'),
        'ancho' => form_error('ancho'),
        'largo' => form_error('largo'),
        'idEspecie' => form_error('idEspecie'),
        'precioCubicacion' => form_error('precioCubicacion'),
      );
      echo json_encode($errors);
      $this->output->set_status_header(400);
      return True;
    }
    return False;
  }

  function getMedidaRules(){
    return array(
      array(
        'field' => 'espesor',
        'label' => 'espesor',
        'rules' => 'trim|required|numeric|greater_than[0]',
        'errors' => array(
          'required'=> 'El %s es requerido.',
          'numeric'=> 'El %s es numerico.',
          'greater_than'=> 'El espesor es invalido.'
        ),
      ),
      array(
        'field' => 'ancho',
        'label' => 'ancho',
        'rules' => 'trim|required|numeric|greater_than[0]',
        'errors' => array(
          'required'=> 'El %s es requerido.',
          'numeric'=> 'El %s es numerico.',
          'greater_than'=> 'El ancho es invalido.'
        ),
      ),
      array(
        'field' => 'idEspecie',
        'label' => 'idEspecie',
        'rules' => 'trim|required|numeric|greater_than[0]',
        'errors' => array(
          'required'=> 'La especie es requerida.',
          'numeric'=> 'La especie es un numero.',
          'greater_than'=> 'La especie es invalido.'
        ),
      ),
      array(
        'field' => 'largo',
        'label' => 'largo',
        'rules' => 'trim|required|numeric|greater_than[0]',
        'errors' => array(
          'required'=> 'El %s es requerido.',
          'numeric'=> 'El %s es numerico.',
          'greater_than'=> 'El largo es invalido.'
        ),
      ),
      array(
        'field' => 'costo',
        'label' => 'costo',
        'rules' => 'trim|required|numeric|greater_than[0]',
        'errors' => array(
          'required'=> 'El %s es requerido.',
          'numeric'=> 'El %s es numerico.',
          'greater_than'=> 'El %s es invalido.'
        ),
      ),
     );
  } 
}