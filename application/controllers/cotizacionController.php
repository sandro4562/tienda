<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/BaseController.php');
include_once(APPPATH . 'helpers/auth/cotizacion_rules_helper.php');
class CotizacionController extends BaseController {
  function __construct() {
    parent::__construct();
    $this->data = array_merge($this->data, array(
      'current' => 'CotizacionController'
    ));
    $this->load->library('form_validation');
        //$this->load->helper(array('auth/tallado_rules'));
    $this->load->helper('form');
    $this->load->model('cotizacion_model');
    $this->load->model('code_model');
    $this->load->model('producto_model');
    $this->load->model('cepillado_model');
    $this->load->model('especie_model');
    $this->load->model('imagen_model');
    $this->load->model('moldura_model');
    $this->load->model('tallado_model');
    $this->load->model('medida_model');
    $this->load->model('stock_model');
    $this->load->helper(array('auth/cotizacion_rules'));
  }

  public function index() {
    redirect("cotizacionController/lectura");
  }
  
  public function registrar(){
    $data['productos'] = $this->producto_model->obtenerProductos();
    $this->detalleVenta_model->crearDetalleVenta();
    $this->load->view('Header',$this->data);
    $this->load->view('Menu');
    $this->load->view('detalle');
    $this->load->view('Home');
    $this->load->view('Footer');
  }
  
  public function carrito(){
    $id = $this->code_model->obtenerUsuarioCorreo($this->input->cookie()['username']);
    $data['cotizaciones'] = $this->cotizacion_model->obtenerCotizacionesUser($id[0]->id);
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
    }
    $this->load->view('compra_cotizacion/CarritoCompra',$data);
    $this->load->view('Footer');
  }

  function registrarPOST(){
    $producto = $this->producto_model-> obtenerProducto($this->uri->segment(3))[0];
    $errors = array();
    $errors = array_merge($errors, $this->hasError());

    $id = $this->code_model->obtenerUsuarioCorreo($this->input->cookie()['username']);
    $moldura = $this->input->post('moldura');
    $tallado = $this->input->post('tallado');
    if($moldura === null){
      $moldura = 0;
    }
    if($tallado === null){
      $tallado = 0;
    }
    $espesor = $this->input->post('espesorCliente');
    $largo = $this->input->post('largoCliente');
    $ancho = $this->input->post('anchoCliente');
    $default = 1; 
    if($id[0]->tipo === "preferencial"){
      $precioDescuento = $this->input->post('cotizacionDescuento');
    }else{
      $precioDescuento = $this->input->post('cotizacion');
    }
    
    //Validar las medida si esta activo
    if($producto->medidas === "1") {
      $errors = array_merge($errors, $this->hasMedidaError());
    }

    if(count($errors) > 0) {
      echo json_encode($errors);
      $this->output->set_status_header(400);
      return;
    }
        
    $data = array(
      'idUser' => $id[0]->id,
      'precio' => $this->input->post('cotizacion'),
      'precioDescuento' =>$precioDescuento,
      'cantidad' => $this->input->post('cantidad'),
      'idProducto' => $this->uri->segment(3),
      'idEspecie' => $this->input->post('idEspecie'),
      'idCepillado' => $this->input->post('cepillado'),
      'idMedida' => $this->input->post('idMedida'),
      'espesor' => $espesor,
      'largo' => $largo,
      'ancho' => $ancho,
      'isDefault' => $default,
      'idMoldura' => $moldura,
      'idTallado' => $tallado 
    );

    $this->cotizacion_model->crearCotizacion($data);
    $this->output
    ->set_status_header(206)
    ->set_content_type('application/json')
    ->set_output(json_encode(array(
      'url' => "/index.php/cotizacionController/carrito"
    )));
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
    $data['medidasJson'] = json_encode($data['medidas']);
    $data['tallados'] = $this->tallado_model-> obtenerTalladosProd($data['id']);
    $data['molduras'] = $this->moldura_model-> obtenerMoldurasProd($data['id']);
    $data['cepillados'] = $this->cepillado_model-> obtenerCepilladosProd($data['id']);
    $data['stock'] = $this->stock_model->obtenerStocksPorProducto($data['id']);
    foreach ($data['medidas'] as $prod) {
      $costo[] = $prod->costo;
      $cubicacion[] = $prod->precioCubicacion;
      //$data['costo'] = $this->medida_model-> obtenerMedida($prod->id);
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
    $data['user'] = $this->code_model->obtenerUsuarioCorreo($username);
    $this->load->view('compra_cotizacion/Product',$data);
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
   $hasError = $this->hasError();
    if($hasError == False) {
      $id = $this->code_model->obtenerUsuarioCorreo($this->input->cookie()['username']);
      $moldura = $this->input->post('moldura');
      $tallado = $this->input->post('tallado');
      if($moldura === null){
        $moldura = 0;
      }
      if($tallado === null){
        $tallado = 0;
      }
      $data = array(
        'idUser' => $id[0]->id,
        'precio' => $this->input->post('cotizacion'),
        'precioDescuento' =>$this->input->post('cotizacionDescuento'),
        'cantidad' => $this->input->post('cantidad'),
        'idProducto' => $this->uri->segment(4),
        'idEspecie' => $this->input->post('idEspecie'),
        'idCepillado' => $this->input->post('cepillado'),
        'idMedida' => $this->input->post('medida'),
        'idMoldura' => $moldura,
        'idTallado' => $tallado 
      );
      $this->cotizacion_model->actualizarCotizacion($this->uri->segment(3),$data);
      $this->output
      ->set_status_header(206)
      ->set_content_type('application/json')
      ->set_output(json_encode(array(
        'url' => "/index.php/cotizacionController/carrito"
      )));
    }
  }

  function borrar(){
    $id = $this->uri->segment(3);
    $this->cotizacion_model->eliminarCotizacion($id);
    redirect("cotizacionController/carrito");
  }

  function borrarAjax(){
    $id = $this->uri->segment(3);
    $this->cotizacion_model->eliminarCotizacion($id);
    $this->output
        ->set_status_header(200)
        ->set_content_type('application/json')
        ->set_output(json_encode(array(
              'id' => $id
            )));
  }

  public function hasError(){
    $this->form_validation->set_error_delimiters('', '');
    $rules = $this->getCotizacionRules();
    $this->form_validation->set_rules($rules);
    if($this->form_validation->run() === FALSE){
      $errors = array(
        'cantidad' => form_error('cantidad'),
        'idEspecie' => form_error('idEspecie'),
        'cotizacion' => form_error('cotizacion')
      );
      return $errors;
    }
    return array();
  }

  public function hasMedidaError(){
    $this->form_validation->set_error_delimiters('', '');
    $rules = $this->getMedidaRules();
    $this->form_validation->set_rules($rules);
    if($this->form_validation->run() === FALSE){
      $errors = array(
        'largoCliente' => form_error('largoCliente'),
        'espesorCliente' => form_error('espesorCliente'),
        'anchoCliente' => form_error('anchoCliente')
      );
      return $errors;
    }
    return array();
  }

  function getMedidaRules(){
    return array(
      array(
        'field' => 'espesorCliente',
        'label' => 'espesor',
        'rules' => 'trim|required|numeric|greater_than[0]',
        'errors' => array(
          'required'=> 'El %s es requerido.',
          'numeric'=> 'El %s es numerico.',
          'greater_than'=> 'El espesor es invalido.'
        ),
      ),
      array(
        'field' => 'anchoCliente',
        'label' => 'ancho',
        'rules' => 'trim|required|numeric|greater_than[0]',
        'errors' => array(
          'required'=> 'El %s es requerido.',
          'numeric'=> 'El %s es numerico.',
          'greater_than'=> 'El ancho es invalido.'
        ),
      ),
      array(
        'field' => 'largoCliente',
        'label' => 'largo',
        'rules' => 'trim|required|numeric|greater_than[0]',
        'errors' => array(
          'required'=> 'El %s es requerido.',
          'numeric'=> 'El %s es numerico.',
          'greater_than'=> 'El largo es invalido.'
        ),
      )
    );
  }

  function getCotizacionRules(){
    return array(
      array(
        'field' => 'cotizacion',
        'label' => 'cotizacion',
        'rules' => 'trim|required|numeric|greater_than[0]',
        'errors' => array(
          'required'=> 'La %s es requerida.',
          'numeric'=> 'La %s es numerico.',
          'greater_than'=> 'La cotizacion es invalida.'
        ),
      ),
      array(
        'field' => 'cantidad',
        'label' => 'cantidad',
        'rules' => 'trim|required|numeric|greater_than[0]',
        'errors' => array(
          'required'=> 'La %s es requerida.',
          'numeric'=> 'La %s es numerico.',
          'greater_than'=> 'La cantidad es invalida.'
        ),
      ),
      array(
        'field' => 'idEspecie',
        'label' => 'especie',
        'rules' => 'trim|required|numeric|greater_than[0]',
        'errors' => array(
          'required'=> 'La %s es requerida.',
          'numeric'=> 'La %s es numerico.',
          'greater_than'=> 'La especie es requerida.'
        )
      )
    );
  }
}