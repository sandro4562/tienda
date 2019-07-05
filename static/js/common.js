function redondearADosDecimales(value) {
  return Math.round(value * 100) / 100;
}

function storeLastSelected(item) {
  var $item = $(item);
  var selected = $item.val();
  Lockr.set('producto', selected);
}

function redondearADosDecimales(value) {
  return Math.round(value * 100) / 100;
}

function redondearACuatroDecimales(value) {
  return Math.round(value * 100) / 100;
}

function convertirDeMetros(option, value) {
  var obj = {
    "Metros": function(value) {
      return value;
    },
    "Centimetros": function(value) {
      return redondearACuatroDecimales(value * 100)
    },
    "Pulgadas": function(value) {
      return redondearACuatroDecimales(value * 39.37008);
    },
    "Pies": function(value) {
      return redondearACuatroDecimales(value * 3.280840);
    }
  };
  return obj[option](value);
}

function convertirHaciaMetros(option, value) {
  var obj = {
    "Metros": function(value) {
      return value;
    },
    "Centimetros": function(value) {
      return (value / 100);
    },
    "Pulgadas": function(value) {
      return (value / 39.37008);
    },
    "Pies": function(value) {
      return (value / 3.280840);
    }
  };
  return obj[option](value);
}

var dt = null;

$(document).ready(function() {
  if(window.location.href.indexOf('editar') == -1) {
    //Recuperar el producto actual seleccionado en memoria
    var productoSelected = Lockr.get('producto');
    if(_.isString(productoSelected) 
      && !_.isEmpty(productoSelected) 
      && _.contains(_.map($("#producto option"), function(item) { return $(item).val();}), productoSelected)) 
    {
      $("#producto").val(productoSelected);
    }
  }

  $('.productoDataTable').DataTable({
    "language": {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    },
    "paging": false,
    "rowGroup": {
      dataSrc: 0
    }
  });

  dt = $('.productoDataTableStock').DataTable({
    "language": {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    },
    "paging": false,
    "rowGroup": {
      dataSrc: 0
    },
    "drawCallback": function ( settings ) {
      var api = this.api();
      var rows = api.rows( {page:'current'} ).nodes();
      var last = null;
      api.column(1, {page:'current'} ).data().each( function ( group, i ) {
        
      } );
    }
  });
  _.each($(".formatDate"), function(date) {
    date.innerText = moment(date.innerText).format("DD/MM/YYYY HH:MM");
  });

  _.each($(".formatTwoDecimals"), function(date) {
    date.innerText = redondearADosDecimales(parseFloat(date.innerText));
  });
});

