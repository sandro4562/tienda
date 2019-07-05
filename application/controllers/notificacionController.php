<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/BaseController.php');
include_once(APPPATH . 'helpers/auth/tallado_rules_helper.php');
class NotificacionController extends BaseController {
  function __construct() {
    parent::__construct();
    $this->data = array_merge($this->data, array(
      'current' => 'Notificacion',
      'expanded' => 'Notificacion',
    ));
    $this->load->model('notificacion_model');
    $this->load->model('cotizacion_model');
    $this->load->model('producto_model');
    $this->load->model('especie_model');
    $this->load->model('cepillado_model');
    $this->load->model('tallado_model');
    $this->load->model('moldura_model');
  }

  public function pendientes() {
    $notificaciones = $this->notificacion_model->obtenerNotificacion("Contactar cliente");
    $cotizaciones = $this->cotizacion_model->obtenerTodoCotizaciones();
    $productos = $this->producto_model->obtenerProductos();
    $especies = $this->especie_model->obtenerEspecies();
    $cepillados = $this->cepillado_model->obtenerCepillados();
    $moldura = $this->moldura_model->obtenerMolduras();
    $tallado = $this->tallado_model->obtenerTallados();
    $this->data = array_merge($this->data, array(
      'notificaciones' => $notificaciones,
      'cotizaciones' => json_encode($cotizaciones),
      'productos' => json_encode($productos),
      'especies' => json_encode($especies),
      'cepillados' => json_encode($cepillados),
      'moldura' => json_encode($moldura),
      'tallado' => json_encode($tallado)
    ));
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
      $this->load->view('notificacion/pendientes',$this->data);
    }else{
      $this->load->view('paginaNoEncontrada',$this->data);
    }
    $this->load->view('Footer');
  }

  function actualizarNotificacion() {
    $data = array(
      'id' => $this->input->post('id'),
      'estado' => $this->input->post('estado'),
      'fechaEntrega' => $this->input->post('fechaEntrega')
    );
    if($data['estado'] === 'En produccion') {
      $this->notificacion_model->actualizarNotificacionPendiente($data);
    } else {
      $this->notificacion_model->actualizarNotificacion($data);
    }
    $this->output
      ->set_status_header(206)
      ->set_content_type('application/json')
      ->set_output(json_encode(array(
        'url' => "/index.php/producto/listar"
      )));
  }

  public function produccion() {
    $notificaciones = $this->notificacion_model->obtenerNotificacion("En produccion");
    $cotizaciones = $this->cotizacion_model->obtenerTodoCotizaciones();
    $productos = $this->producto_model->obtenerProductos();
    $especies = $this->especie_model->obtenerEspecies();
    $cepillados = $this->cepillado_model->obtenerCepillados();
    $moldura = $this->moldura_model->obtenerMolduras();
    $tallado = $this->tallado_model->obtenerTallados();
    $this->data = array_merge($this->data, array(
      'notificaciones' => $notificaciones,
      'cotizaciones' => json_encode($cotizaciones),
      'productos' => json_encode($productos),
      'especies' => json_encode($especies),
      'cepillados' => json_encode($cepillados),
      'moldura' => json_encode($moldura),
      'tallado' => json_encode($tallado)
    ));
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
      $this->load->view('notificacion/produccion',$this->data);
    }else{
      $this->load->view('paginaNoEncontrada',$this->data);
    }
    $this->load->view('Footer');
  }

  public function entregado() {
    $notificaciones = $this->notificacion_model->obtenerNotificacion("Entregado");
    $cotizaciones = $this->cotizacion_model->obtenerTodoCotizaciones();
    $productos = $this->producto_model->obtenerProductos();
    $especies = $this->especie_model->obtenerEspecies();
    $cepillados = $this->cepillado_model->obtenerCepillados();
    $moldura = $this->moldura_model->obtenerMolduras();
    $tallado = $this->tallado_model->obtenerTallados();
    $this->data = array_merge($this->data, array(
      'notificaciones' => $notificaciones,
      'cotizaciones' => json_encode($cotizaciones),
      'productos' => json_encode($productos),
      'especies' => json_encode($especies),
      'cepillados' => json_encode($cepillados),
      'moldura' => json_encode($moldura),
      'tallado' => json_encode($tallado)
    ));
    $this->load->view('Header',$this->data);
    if($this->data['type'] == 'admin') {
      $this->load->view('Menu', $this->data);
      $this->load->view('notificacion/entregado',$this->data);
    }else{
      $this->load->view('paginaNoEncontrada',$this->data);
    }
    $this->load->view('Footer');
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
      'descripcion'=>$this->input->post('descripcion')
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
}