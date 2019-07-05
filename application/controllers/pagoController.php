<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/BaseController.php');
include_once(APPPATH . 'helpers/auth/tallado_rules_helper.php');
class PagoController extends BaseController {
  function __construct() {
    parent::__construct();
    $this->data = array_merge($this->data, array(
      'current' => 'PagoController'
    ));
    $this->load->library('form_validation');
    $this->load->helper('form');
    $this->load->model('cotizacion_model');
    $this->load->model('code_model');
    $this->load->model('pago_model');
    $this->load->model('notificacion_model');
  }
  public function index() {
    redirect("cotizacionController/lectura");
  }
  function registrarPOST(){
    $id = $this->code_model->obtenerUsuarioCorreo($this->input->cookie()['username']);
    $data = array(
      'id'=>$this->input->post('paypalId'),
      'create_time'=>$this->input->post('paypalCreateTime'),
      'cart'=>$this->input->post('paypalCart'),
      'state'=>$this->input->post('paypalState'),
      'monto_total'=>$this->input->post('montoTotal'),
      'detalle_compra'=>$this->input->post('detalleCompra'),
      'idUser' => $id[0]->id,
      'descripcion'=>$this->input->post('descripcion'),
      'cotizaciones'=>$this->input->post('cotizaciones')
    );
    $this->pago_model->crearPago($data);
    $this->cotizacion_model->confirmarionCotizacion($id[0]->id);
    $this->notificacion_model->crearNotificacion($data);

    $this->output
    ->set_status_header(206)
    ->set_content_type('application/json')
    ->set_output(json_encode(array(
      'url' => "/"
    )));
  }
  public function carrito(){
    $pagos = $this->pago_model->obtenerPagos();
    print_r($pagos);
  }
  public function editarCarrito(){
    $id = $this->code_model->obtenerUsuarioCorreo($this->input->cookie()['username']);
    $data['cotizaciones'] = $this->cotizacion_model->obtenerCotizacionesUser($id[0]->id);
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
    }
    $this->load->view('compra_cotizacion/EditarCarrito',$data);
    $this->load->view('Footer');
  }
  public function metodoPago(){
    $id = $this->code_model->obtenerUsuarioCorreo($this->input->cookie()['username']);
    $data['cotizaciones'] = $this->cotizacion_model->obtenerCotizacionesUser($id[0]->id);
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
    }
    $this->load->view('compra_cotizacion/MetodoDePago',$data);
    $this->load->view('Footer');
  }
  public function detalle(){
    $username = $this->data['username'];
    $costo = array();
    $cubicacion = array();
    $data['id'] = $this->uri->segment(3);
    $data['productos'] = $this->producto_model-> obtenerProducto($data['id']);
    $data['especies'] = $this->especie_model-> obtenerEspeciesProd($data['id']);
    $data['medidas'] = $this->medida_model-> obtenerMedidasProd($data['id']);
    $data['tallados'] = $this->tallado_model-> obtenerTalladosProd($data['id']);
    $data['molduras'] = $this->moldura_model-> obtenerMoldurasProd($data['id']);
    $data['cepillados'] = $this->cepillado_model-> obtenerCepilladosProd($data['id']);
    foreach ($data['medidas'] as $prod) {
      $costo[] = $prod->costo;
      $cubicacion[] = $prod->precioCubicacion;
    }
    $data['costo'] = $costo;
    $data['cubicacion'] =$cubicacion;
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
    }
    $username = $this->data['username'];
    if($username !== null){
      $id = $this->code_model->obtenerUsuarioCorreo($username);
      $data['cotizaciones'] = $this->cotizacion_model->obtenerCotizacionesUser($id[0]->id);
      $this->load->view('compra_cotizacion/ListaCompra', $data);
    }
    $this->load->view('Product',$data);
    $this->load->view('Footer');
  }
  function listar(){
    $data['ventas'] = $this->ventas_model->obtenerVentas();
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
    }
    $this->load->view('ventas_admin',$data);
    $this->load->view('Footer');
  }
  function actualizar(){
    $data = array(
      'nombre' => $this->input->post('nombre'),
      'imagen' => $this->input->post('imagen'),
      'costo' => $this->input->post('costo')
    );
    $this->tallado_model->actualizarTallado($this->uri->segment(3),$data);
    redirect("talladoController/lectura");
  }
  function borrar(){
    $id = $this->uri->segment(3);
    $this->tallado_model-> eliminarTallado($id);
    redirect("talladoController/lectura");
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