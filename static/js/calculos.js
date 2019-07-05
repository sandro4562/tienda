function CargarTablaMedidas() {
  /*var medidaSeleccionada = $("[name=medidaConversion] option:selected").text();
  var medidas = _.map(JSON.parse($("#medidasJson").html()), function(medida) {
      medida.costo = parseFloat(medida.costo);
      medida.largo = convertirDeMetros(medidaSeleccionada, parseFloat(medida.largo));
      medida.ancho = convertirDeMetros(medidaSeleccionada, parseFloat(medida.ancho));
      medida.espesor = convertirDeMetros(medidaSeleccionada, parseFloat(medida.espesor));
      return medida;
  });
  var $tableBody = $("#medidas-table-body");
  var htmlTemplate = _.template(`<tr style="pointer-events: none;" class="text-center medidaBody">
                    <td><%= largo %></td>
                    <td><%= espesor %></td>
                    <td><%= ancho %></td>
                    <td><%= costo %></td>
                  </tr>`);
  $(".medidaBody").remove();
  _.each(medidas, function(medida){
    $tableBody.append(htmlTemplate(medida));
  });*/
  var $tableBody = $("#medidas-table-body");
  var htmlTemplate = _.template(`<tr class="text-center medidaBody">
                      <td><%= largo %></td>
                      <td><%= espesor %></td>
                      <td><%= ancho %></td>
                      <td><%= total %></td>
                      <td>
                        <button data-largo="<%= largoM %>" data-espesor="<%= espesorM %>" data-ancho="<%= anchoM %>" style="width: 100%;" class="btn btn-info" onclick="seleccionarStock(event);">
                          Seleccionar
                        </button>
                      </td>
                    </tr>`);
  $(".medidaBody").remove();
  var stock = JSON.parse($("#stockJson").html());
  var grouped = _.groupBy(stock, function(item){ 
    return item.largo + "/" + item.espesor + "/" + item.ancho; 
  });
  if(stock.length == 0) {
    $("#stockContainer").hide();
  } else {
    $("#stockContainer").show();
  }
  _.each(grouped, function(items, key){
    var keys = key.split("/");
    var largo = keys[0],
        espesor = keys[1],
        ancho = keys[2];
    var ingresos = _.reduce(_.map(_.pluck(items, 'ingreso'), function(val) {
      return parseFloat(val);
    }), function(memo, num){ return memo + num; }, 0);
    var egresos = _.reduce(_.map(_.pluck(items, 'egreso'), function(val) {
      return parseFloat(val);
    }), function(memo, num){ return memo + num; }, 0);
    
    $tableBody.append(htmlTemplate({
      largo: largo,
      espesor: convertirDeMetros('Pulgadas', parseFloat(espesor)),
      ancho: convertirDeMetros('Pulgadas', parseFloat(ancho)),
      total: ingresos - egresos <= 0 ? 'Agotado' : ingresos - egresos,
      largoM: largo,
      espesorM: espesor,
      anchoM: ancho
    }));
  });
}

function seleccionarStock(evt) {
  evt.preventDefault();
  var $button = $(evt.target);
  var data = $button.data();
  var medidaSeleccionada = $("[name=medidaConversion] option:selected").text();
  var largo = convertirDeMetros(medidaSeleccionada, parseFloat(data.largo));
  var espesor = convertirDeMetros(medidaSeleccionada, parseFloat(data.espesor));
  var ancho = convertirDeMetros(medidaSeleccionada, parseFloat(data.ancho));
  $("#largoCliente").val(largo);
  $("#espesorCliente").val(espesor);
  $("#anchoCliente").val(ancho);
  CalcularCostoPorMedida();
  bootbox.hideAll();
}

function CalcularCostoPorMedida() {
  //CargarTablaMedidas();
  $("#medidas-mensajes .alert").hide();
  var largoCliente = parseFloat($("#largoCliente").val()),
      espesorCliente = parseFloat($("#espesorCliente").val()),
      anchoCliente = parseFloat($("#anchoCliente").val());
  if(  (_.isNumber(largoCliente) && !_.isNaN(largoCliente))
    && (_.isNumber(espesorCliente) && !_.isNaN(espesorCliente))
    && (_.isNumber(anchoCliente) && !_.isNaN(anchoCliente))) {
    var medidaSeleccionada = $("[name=medidaConversion] option:selected").text();
    var medidas = _.map(JSON.parse($("#medidasJson").html()), function(medida) {
      medida.costo = parseFloat(medida.costo);
      medida.largo = convertirDeMetros(medidaSeleccionada, parseFloat(medida.largo));
      medida.ancho = convertirDeMetros(medidaSeleccionada, parseFloat(medida.ancho));
      medida.espesor = convertirDeMetros(medidaSeleccionada, parseFloat(medida.espesor));
      return medida;
    });
    if(medidas.length === 0) {
      $("#alerta-error-medida").html("No existe medidas registradas para este producto. Contacte al administrador");
      $("#alerta-error-medida").show();
      return false;
    }
    var minimo = {};
    var maximo = {};
    minimo.largo = _.min(_.pluck(medidas, 'largo'));
    maximo.largo = _.max(_.pluck(medidas, 'largo'));
    minimo.espesor = _.min(_.pluck(medidas, 'espesor'));
    maximo.espesor = _.max(_.pluck(medidas, 'espesor'));
    minimo.ancho = _.min(_.pluck(medidas, 'ancho'));
    maximo.ancho = _.max(_.pluck(medidas, 'ancho'));
    if(  (largoCliente < minimo.largo || largoCliente > maximo.largo)
      || (espesorCliente < minimo.espesor || espesorCliente > maximo.espesor)
      || (anchoCliente < minimo.ancho || anchoCliente > maximo.ancho) ) {
      $("#alerta-error-medida-rango .largo").html(minimo.largo + " - " + maximo.largo + " (largo)");
      $("#alerta-error-medida-rango .espesor").html(minimo.espesor + " - " + maximo.espesor + " (espesor)");
      $("#alerta-error-medida-rango .ancho").html(minimo.ancho + " - " + maximo.ancho + " (ancho)");
      $("#alerta-error-medida-rango").show();
      $('#costo').val('');
      $('#cubicacion').val('');
      return false;
    } else {
      calcularCosto();
      return true;
    }
  } else {
    $("#alerta-error-medida").show();
    $('#costo').val('');
    $('#cubicacion').val('');
    return false;
  }
}

function calcularCosto() {
  var data = $("#cotizacionFormulario").serializeJSON(),
      largoCliente = parseFloat($("#largoCliente").val()),
      espesorCliente = parseFloat($("#espesorCliente").val()),
      anchoCliente = parseFloat($("#anchoCliente").val()),
      medidaSeleccionada = $("[name=medidaConversion] option:selected").text(),
      medidas = _.map(JSON.parse($("#medidasJson").html()), function(medida) {
        medida.costo = parseFloat(medida.costo);
        medida.largo = convertirDeMetros(medidaSeleccionada, parseFloat(medida.largo));
        medida.ancho = convertirDeMetros(medidaSeleccionada, parseFloat(medida.ancho));
        medida.espesor = convertirDeMetros(medidaSeleccionada, parseFloat(medida.espesor));
        return medida;
      });
  var largoEnMetros = convertirHaciaMetros(medidaSeleccionada, largoCliente),
      anchoEnMetros = convertirHaciaMetros(medidaSeleccionada, anchoCliente),
      espesorEnMetros = convertirHaciaMetros(medidaSeleccionada, espesorCliente);
  var diffs = [];
  _.each(medidas, function(item) {
    var diff = Math.abs(largoCliente - item.largo) + Math.abs(anchoCliente - item.ancho) + Math.abs(espesorCliente - item.espesor);
    diffs.push(diff);
  });
  var i = 0;
  if(_.min(diffs) > 0) {
    var pos = _.indexOf(diffs, _.min(diffs)) + 1;
    i = pos >= diffs.length ? pos - 1 : pos;
  } else {
    i = _.indexOf(diffs, _.min(diffs));
  }
  var masCercano = medidas[i];
  $("#alerta-info-medida .medida").html($("[name=medidaConversion] option:selected").text());
  $("#alerta-info-medida .costo").html(masCercano.costo);
  var costo = redondearADosDecimales(((espesorEnMetros * (largoEnMetros * 3.33) * anchoEnMetros)/12) * masCercano.costo);
  $("#alerta-info-medida .total").html(costo);
  $("#alerta-info-medida").show();
  $('#costo').val(costo);
  $('#cubicacion').val(masCercano.costo);
}
