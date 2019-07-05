function redondearAUnDecimal(value) {
  return Math.round(value * 10) / 10;
}

function calcularCotizacion(){
  var data = $("#cotizacionFormulario").serializeJSON();
  var resultado = '';
  if(_.isObject(data)) {
    var str = data.cepillado;
    var res = _.isString(str) ? str.split(" ") : "";
    var costo = parseFloat(data.costo);
    var cubicacion = parseFloat(data.cubicacion);
    var caras = parseInt(res[0]);
    var cepillado = parseFloat(data.costoCepillado);
    var cantidad = parseInt(data.cantidad);
    var descuento = parseInt(data.descuento);
    cantidad = parseFloat(cantidad);
    caras = _.isNumber(caras) && !_.isNaN(caras) ? caras : 1;
    cepillado = _.isNumber(cepillado) && !_.isNaN(cepillado) ? cepillado : 0;
    var cotizacion = (((costo / cubicacion) ) );
    var resultado = 0;

    var cepilladoInputs = $("[name=cepillado-input]");
    //MOLDURA
    var actualSeleccioando = 0;
    if(!_.isUndefined($(".image-selected")[0])) {
      var imagenData = $($(".image-selected")[0]).data();
      actualSeleccioando = parseInt(imagenData.precio);
    }

    //TALLADO
    if(cepilladoInputs.length == 0) {
      resultado = costo * cantidad;
    } else if (cepilladoInputs[0].checked) {
      resultado = _.isNumber(cotizacion) && !_.isNaN(cotizacion) ? (((cotizacion * cepillado) + costo)+ actualSeleccioando) * cantidad : '';
    } else {
      resultado = costo * cantidad;
    }
  }
  var descuento = parseFloat(data.descuento);
  $("#alerta-info-descuento .descuento").html(descuento + "%");
  if(_.isNumber(resultado) && !_.isNaN(resultado)) {
    $('#cotizacion').val(redondearAUnDecimal(resultado));
    descuento = redondearAUnDecimal(resultado - (descuento/100 * resultado));
    $('#cotizacionDescuento').val(descuento);
    $("#cotizacion-info").hide();
  } else {
    $('#cotizacion').val('');
    $('#cotizacionDescuento').val('');
    $("#cotizacion-info").show();
  }
} 
