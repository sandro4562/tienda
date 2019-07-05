var meses = {
  0: 'Enero',
  1: 'Febrero',
  2: 'Merzo',
  3: 'Abril',
  4: 'Mayo',
  5: 'Junio',
  6: 'Julio',
  7: 'Agosto',
  8: 'Septiembre',
  9: 'Octubre',
  10: 'Noviembre',
  11: 'Diciembre'
}

$(document).ready(function() {
  var pagos = JSON.parse($("#pagos").html());
  var cotizaciones = JSON.parse($("#cotizaciones").html());
  var productos = JSON.parse($("#productos").html());
  var currentDate = moment();
  var mensualesData = _.times(12, _.constant(0));
  _.each(pagos, function(pago) {
    var pagoDate = moment(pago.create_time);
    var pagoTotal = parseFloat(pago.monto_total);
    pagoTotal = !_.isNaN(pagoTotal) && _.isNumber(pagoTotal) ? pagoTotal : 0;
    if(pagoDate.year() == currentDate.year()) {
      mensualesData[pagoDate.month()] += parseFloat((pagoTotal * 6.96).toFixed(2));
    }
  });
  var item = _.template(`
      <tr>
        <td class="text-center"><%= mes %></td>
        <td class="text-center"><%= valor %></td>
      </tr>
  `);
  _.each(mensualesData, function(data, index) {
    $("#tablaGananciasMensualesBody").append(item({
      mes: meses[index],
      valor: data
    }));       
  });
  Highcharts.chart('mensuales', {
    chart: {
      type: 'line'
    },
    title: {
      text: 'Ganancias Mensuales'
    },
    subtitle: {
      text: 'Aserradero Inc.'
    },
    xAxis: {
      categories: ['Ene', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
    },
    yAxis: {
      title: {
        text: 'Bolivianos'
      }
    },
    plotOptions: {
      line: {
        dataLabels: {
          enabled: true
        },
        enableMouseTracking: false
      }
    },
    series: [{
      name: 'Ganancias',
      data: mensualesData
    }]
  });

  var vendidosData = [];
  var productos = [];
  _.each(pagos, function(pago) {
    var detallesCompra = JSON.parse(pago.detalle_compra);
    _.each(detallesCompra, function(detalleCompra) {
      if(!_.contains(productos, detalleCompra.name)) {
        productos.push(detalleCompra.name);
      }
    });
  });
  _.each(productos, function(producto) {
    vendidosData.push({
      name: producto,
      data: _.times(12, _.constant(0))
    });
  });
  _.each(pagos, function(pago) {
    var detallesCompra = JSON.parse(pago.detalle_compra);
    var pagoDate = moment(pago.create_time);
    _.each(detallesCompra, function(detalleCompra) {
      var cantidad = parseFloat(detalleCompra.quantity);
      cantidad = !_.isNaN(cantidad) && _.isNumber(cantidad) ? cantidad : 0;
      if(pagoDate.year() == currentDate.year()) {
        var idx = 0;
        _.find(productos, function(producto, index){ 
         if(producto === detalleCompra.name){ idx = index; return true;}; 
       });
        vendidosData[idx].data[pagoDate.month()] += (cantidad);
      }
    });
  });
  item = _.template(`
      <tr>
        <td class="text-center"><%= producto %></td>
        <td class="text-center"><%= mes %></td>
        <td class="text-center"><%= valor %></td>
      </tr>
  `);
  _.each(vendidosData, function(data, index) {
    _.each(data.data, function(value, index) {
      if(value > 0) {
        $("#tablaVendidosMensualesBody").append(item({
          producto: data.name,
          mes: meses[index],
          valor: value
        }));  
      }
    });  
  });
  Highcharts.chart('vendidos', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Productos Vendidos Mensuales'
    },
    subtitle: {
      text: 'Aserradero Inc.'
    },
    xAxis: {
      categories: ['Ene', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
      crosshair: true
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Unidades'
      }
    },
    tooltip: {
      headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
      pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.1f} unidades</b></td></tr>',
      footerFormat: '</table>',
      shared: true,
      useHTML: true
    },
    plotOptions: {
      column: {
        pointPadding: 0.2,
        borderWidth: 0
      }
    },
    series: vendidosData
  });


  var cantidadData=[];
  _.each(productos, function(producto) {
    cantidadData.push({
      name: producto,
      y: 0
    });
  });
  var ventatotal=0;
  _.each(pagos, function(pago) {
    var pagoDate = moment(pago.create_time);
    var pagoTotal = parseFloat(pago.monto_total);
    pagoTotal = !_.isNaN(pagoTotal) && _.isNumber(pagoTotal) ? pagoTotal : 0;
    if(pagoDate.year() == currentDate.year()) {
      ventatotal+= parseFloat((pagoTotal));
    }
  });

  _.each(pagos, function(pago) {
    var detallesCompra = JSON.parse(pago.detalle_compra);
    var pagoDate = moment(pago.create_time);
    _.each(detallesCompra, function(detalleCompra) {
      var price = parseFloat(detalleCompra.price) * parseFloat(detalleCompra.quantity);
      price = !_.isNaN(price) && _.isNumber(price) ? price : 0;
      if(pagoDate.year() == currentDate.year()) {//dato deberia ser mensual
        var idx = 0;
        _.find(productos, function(producto, index){ 
         if(producto === detalleCompra.name){ idx = index; return true;}; 
       });
        cantidadData[idx].y += (price);
      }
    });
  });
  cantidadData = _.map(cantidadData, function(item){
    item.y = ventatotal == 0 ? 0 : (item.y * 100) / ventatotal;
    return item;
  });


  item = _.template(`
      <tr>
        <td class="text-center"><%= producto %></td>
        <td class="text-center"><%= valor %></td>
      </tr>
  `);
  _.each(cantidadData, function(data, index) {
    $("#tablaPorcentajesBody").append(item({
      producto: data.name,
      valor: (Math.round(data.y * 100) / 100) + '%'
    }));  
  });
  Highcharts.chart('porcentajes-producto', {
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
    },
    title: {
      text: 'Porcentajes de ganancias por producto'
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        dataLabels: {
          enabled: true,
          format: '<b>{point.name}</b>: {point.percentage:.1f} %',
          style: {
            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
          }
        }
      }
    },
    series: [{
      name: 'Brands',
      colorByPoint: true,
      data: cantidadData
    }]
  });
});

