<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/BaseController.php');

class egresosController extends BaseController {
  function __construct() {
    parent::__construct();
    $this->data = array_merge($this->data, array(
      'current' => 'egresosController',
      'expanded' => 'Reportes'
    ));
    $this->load->model('pago_model');
    $this->load->model('cotizacion_model');
    $this->load->model('code_model');
    $this->load->model('producto_model');
  }
  public function listar(){
    echo $this->data['userId'];
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $data['pagos'] = $this->pago_model->obtenerPagos();
      $this->load->view('Menu', $this->data);
      $this->load->view('egresos/administrarEgresos',$data);
    } else {
      $data['pagos'] = $this->pago_model->obtenerPagosUsuario($this->data['userId']);
      $this->load->view('egresos/administrarEgresos',$data);
    }
    $this->load->view('Footer');
  }

  public function ventaControl(){
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
      $this->load->view('controlVenta');
    }else{
      $this->load->view('paginaNoEncontrada',$data);
    }
    $this->load->view('Footer');
  }
  public function stock(){
    $data['pagos'] = $this->pago_model->obtenerPagos();
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
      $this->load->view('stock/administrarStock',$data);
    }else{
      $this->load->view('paginaNoEncontrada',$data);
    }
    $this->load->view('Footer');
  }
  public function listarUsuarios(){
    $data['segmento'] = $this->uri->segment(3);
    $data['pagos'] = $this->pago_model->obtenerPago($this->uri->segment(4));
    $data['user'] = $this->code_model->obtenerUsuario($data['segmento']);
    $detalles = array();
    foreach ($data['pagos'] as $pagos) {
      $token = strtok($pagos->detalle_compra, "{}[]:,");
      $cont = 0;
      while ($token !== false){
        $token;
        $detalles[] = $token;
        $token = strtok("{}[]:,");
      } 
    }
    $data['detalles']=$detalles;
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu');
      $this->load->view('egresos/detalles',$data);
    }else{
      $this->load->view('egresos/detalles',$data);
    }
    $this->load->view('Footer');
  }
  
  public function ingresos(){
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
      $pagos = $this->pago_model->obtenerPagos();
      $cotizaciones = $this->cotizacion_model->CotizacionesPagadas();
      $productos = $this->producto_model->obtenerProductos();
      $this->data = array_merge($this->data, array(
        'pagos' => json_encode($pagos),
        'cotizaciones' => json_encode($cotizaciones),
        'productos' => json_encode($productos)
      ));
      $this->load->view('reportes/Graficos', $this->data);
    }else{
      $this->load->view('paginaNoEncontrada');
    }
    $this->load->view('Footer');
  }
}