<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cotizacion_model extends CI_Model{
  function __construct(){
    parent::__construct();
    $this->load->database();
  }

  function crearCotizacion($data){
    $this->db->insert('cotizaciones',array(
      'idUser'=>$data['idUser'],
      'preciounitario'=>$data['precio'] / $data['cantidad'],
      'precio'=>$data['precio'],
      'precioDescuento' => $data['precioDescuento'],
      'cantidad'=>$data['cantidad'],
      'idProducto'=>$data['idProducto'],
      'idEspecie'=>$data['idEspecie'],
      'idCepillado' => $data['idCepillado'],
      'idMedida' => $data['idMedida'],
      'isDefault' => $data['isDefault'],
      'espesor' => $data['espesor'],
      'largo' => $data['largo'],
      'ancho' => $data['ancho'],
      'idMoldura' => $data['idMoldura'],
      'idTallado' => $data['idTallado'],
      'deleted'=> 0));
  }

  function actualizarCotizacion($id,$data){
    $datos = array(
      'idUser'=>$data['idUser'],
      'preciounitario'=>$data['precio'] / $data['cantidad'],
      'precio'=>$data['precio'],
      'precioDescuento' => $data['precioDescuento'],
      'cantidad'=>$data['cantidad'],
      'idEspecie'=>$data['idEspecie'],
      'idCepillado' => $data['idCepillado'],
      'idMedida' => $data['idMedida'],
      'espesor' => $data['espesor'],
      'largo' => $data['largo'],
      'ancho' => $data['ancho'],
      'idMoldura' => $data['idMoldura'],
      'idTallado' => $data['idTallado']
    );
    $this->db->where('id',$id);
    $query = $this->db->update('cotizaciones',$datos);
  }
  
  function obtenerCotizaciones(){
    $this->db->select('cotizaciones.idUser,cotizaciones.precio, producto.nombre as nombreprod, especie.nombre as nombreesp, cepillado.caras, cotizaciones.espesor,producto.nombre, cotizaciones.ancho, cotizaciones.largo, tallado.imagen as imgtallado, moldura.imagen as imgmoldura');
    $this->db->from('cotizaciones');
    $this->db->where('cotizaciones.deleted',0);
    $this->db->where('cotizaciones.pagado',0);
    $this->db->join('producto','cotizaciones.idProducto=producto.id');
    $this->db->join('especie','cotizaciones.idEspecie=especie.id');
    $this->db->join('cepillado','cotizaciones.idCepillado=cepillado.id');
    $this->db->join('medida','cotizaciones.idMedida=medida.id');
    $this->db->join('tallado','cotizaciones.idTallado=tallado.id');
    $this->db->join('moldura','cotizaciones.idMoldura=moldura.id');
    $query = $this->db->get();
    if($query->num_rows() > 0) return $query->result();
    else return array();
  }

  function obtenerTodoCotizaciones(){
    $this->db->select('cotizaciones.*, user.nombre, user.id as userId');
    $this->db->from('cotizaciones');
    $this->db->where('cotizaciones.deleted',0);
    $this->db->join('user','user.id=cotizaciones.idUser');
    /*$this->db->join('producto','cotizaciones.idProducto=producto.id');
    $this->db->join('especie','cotizaciones.idEspecie=especie.id');
    $this->db->join('cepillado','cotizaciones.idCepillado=cepillado.id');
    $this->db->join('medida','cotizaciones.idMedida=medida.id');
    $this->db->join('tallado','cotizaciones.idTallado=tallado.id');
    $this->db->join('moldura','cotizaciones.idMoldura=moldura.id');*/
    $query = $this->db->get();
    if($query->num_rows() > 0) return $query->result();
    else return array();
  }

  function obtenerCotizacionesUser($id){
    $this->db->select('cotizaciones.id as cotid, cotizaciones.idUser,cotizaciones.precio, cotizaciones.precioDescuento, producto.id as prodid, producto.nombre as nombreprod, especie.nombre as nombreesp, cepillado.caras, cotizaciones.espesor, cotizaciones.ancho, cotizaciones.largo, tallado.imagen as imgtallado, moldura.imagen as imgmoldura, producto.imagen as imagen, cotizaciones.cantidad as cantidad');
    $this->db->from('cotizaciones');
    $this->db->where('cotizaciones.idUser',$id);
    $this->db->where('cotizaciones.deleted',0);
    $this->db->where('cotizaciones.pagado',0);
    $this->db->join('producto','cotizaciones.idProducto=producto.id and cotizaciones.idUser = '.$id, 'left');
    $this->db->join('especie','cotizaciones.idEspecie=especie.id', 'left');
    $this->db->join('cepillado','cotizaciones.idCepillado=cepillado.id', 'left');
    $this->db->join('medida','cotizaciones.idMedida=medida.id', 'left');
    $this->db->join('tallado','cotizaciones.idTallado=tallado.id', 'left');
    $this->db->join('moldura','cotizaciones.idMoldura=moldura.id', 'left');
    $query = $this->db->get();
    if($query->num_rows() > 0) return $query->result();
    else return array();
  }

  function obtenerCotizacion($id){
    $this->db->where('id',$id);
    $this->db->where('deleted',0);
    $this->db->where('pagado',0);
    $query = $this->db->get('cotizaciones');
    if($query->num_rows() > 0) return $query->result();
    else return array();
  }

  function obtenerCotizacionesIn($id){
    $this->db->or_where_in('id',$id);
    $this->db->where('deleted',0);
    $this->db->where('pagado',0);
    $query = $this->db->get('cotizaciones');
    if($query->num_rows() > 0) return $query->result();
    else return array();
  }

  function confirmarionCotizacion($id){
    $datos = array(
      'pagado' => 1);
    $this->db->where('idUser',$id);
    $this->db->update('cotizaciones',$datos);
  }

  function eliminarCotizacion($id){
    $datos = array(
      'deleted' => 1);
    $this->db->where('id',$id);
    $this->db->update('cotizaciones',$datos);
  }

  function CotizacionesPagadas(){
    $this->db->where('pagado',1);
    $query = $this->db->get('cotizaciones');
    if($query->num_rows() > 0) return $query->result();
    else return array();
  }
}
