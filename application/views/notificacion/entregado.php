<div id="cotizacionesJson" style="display: none;"><?= $cotizaciones; ?></div>
<div id="notificacionesJson" style="display: none;"><?= json_encode($notificaciones); ?></div>
<div id="productosJson" style="display: none;"><?= $productos; ?></div>
<div id="especiesJson" style="display: none;"><?= $especies; ?></div>
<div id="cepilladosJson" style="display: none;"><?= $cepillados; ?></div>
<div id="molduraJson" style="display: none;"><?= $moldura; ?></div>
<div id="talladoJson" style="display: none;"><?= $tallado; ?></div>

<div class="col-md-12"">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <center>
        <div class="text-center noPrint" style="padding: .75rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #D7CEC7;font-weight: bold;margin-bottom: 8px;" >
          Entregado
        </div>
        <table class="table" id="printTable" style="width: 100%;">
          <thead class="card-header">
            <tr class="text-center">
              <th style="display: none;">Cliente</th>
              <th style="width: 20%">Fecha Pedido</th>
              <th style="width: 10%">Fecha Entrega</th>
              <th style="width: 40%">Detalle</th>
              <th style="width: 20%">Cliente</th>
              <th style="width: 20%">Estado</th>
              <!-- <th style="width: 20%" class="noPrint">Acciones</th> -->
            </tr>
          </thead>
          <tbody>
            <?php if($notificaciones && count($notificaciones) > 0) { foreach ($notificaciones as $notificacion) { ?>
              <tr class="text-center">
                <td style="display: none;"><?= $notificacion->nombre; ?></td>
                <td><?= $notificacion->creation_time; ?></td>
                <td><?= $notificacion->fechaEntrega; ?></td>
                <td class="formatDetalleCompra"><?= $notificacion->detalle_compra; ?></td>
                <td>Nombre: <?= $notificacion->nombre; ?><br>Celular: <?= $notificacion->num_celular; ?></td>
                <td><?= $notificacion->estado; ?></td>
              </tr>
            <?php } } else { ?>
              <tr>
                <td colspan="6" class="text-center">No se encontraron resultados</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </center>
    </div>
    <div style="margin-top: 20px;">
      <button class="btn btn-primary col-md-3" onclick="printTableContent('printTable', 'Productos Entregados')"> Imprimir
      </button>
    </div>
  </div>
  <br>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var cotizaciones = JSON.parse($("#cotizacionesJson").html());
    var notificaciones = JSON.parse($("#notificacionesJson").html());
    var productos = JSON.parse($("#productosJson").html());
    var especies = JSON.parse($("#especiesJson").html());
    var cepillados = JSON.parse($("#cepilladosJson").html());
    var molduras = JSON.parse($("#molduraJson").html());
    var tallados = JSON.parse($("#talladoJson").html());
    _.each($(".formatDetalleCompra"), function(item, i) {
      var $item = $(item);
      var template = _.template(`
        <div data-th="Product" class="col-12" style='<%= style %>'>
        <div class="row">
        <div class="col-12 text-center" style="font-size: 14px;text-align: center;">
        <div class="nomargin" style="text-align: center;">Producto: <%= producto %></div>
        <div class="nomargin" style="text-align: center;">Especie: <%= especie %></div>

        <div class="nomargin" style="text-align: center;">Largo: <%= largo %></div>
        <div class="nomargin" style="text-align: center;">Ancho: <%= ancho %></div>
        <div class="nomargin" style="text-align: center;">Espesor: <%= espesor %></div>

        <div class="nomargin" style="text-align: center;">Cepillado: <%= cepillado %></div>
        <div class="nomargin" style="text-align: center;">Moldura: <%= moldura %></div>
        <div class="nomargin" style="text-align: center;">Tallado: <%= tallado %></div>

        <div class="nomargin" style="text-align: center;">Cantidad: <%= cantidad %></div>
        </div>
        </div>
        </div>`);
      var text = "";
      var cotizacionesIds = notificaciones[i].cotizaciones.split(",");
      var cots = _.filter(cotizaciones, function(cotizacion) {
        return _.contains(cotizacionesIds, cotizacion.id);
      });
      _.each(JSON.parse($item.html()), function(data, index) {
        var cot = cots[index];
        var producto = _.find(productos, function(producto){
          return producto.id == cot.idProducto;
        });
        var especie = _.find(especies, function(producto){
          return producto.id == cot.idEspecie;
        });
        var cepillado = _.find(cepillados, function(producto){
          return producto.id == cot.idCepillado;
        });
        var tallado = _.find(tallados, function(producto){
          return producto.id == cot.idTallado;
        });
        var moldura = _.find(molduras, function(producto){
          return producto.id == cot.idMoldura;
        });
        text += template({
          style: index > 0 ? 'border-top: 1px solid darkgray;padding-top: 6px;' : '',
          imagen: producto.imagen,
          cantidad: cot.cantidad,
          producto: data.name,
          espesor: cot.espesor,
          ancho: cot.ancho,
          largo: cot.largo,
          especie: _.isUndefined(especie) ? '(No tiene)' : especie.nombre,
          cepillado: _.isUndefined(cepillado) ? '(No tiene)' : cepillado.caras,
          moldura: _.isUndefined(moldura) 
          ? '(No tiene)' 
          : '(Con moldura)',
          tallado: _.isUndefined(tallado) 
          ? '(No tiene)' 
          : '(Con tallado)',
        });
      });
      $item.html(text);
    });

    $('#printTable').DataTable({
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
      "rowGroup": {
        dataSrc: 0
      }
    });
  });
  function actualizarNotificacion(item) {
    bootbox.confirm({
      message: "¿Esta seguro de marcar el elemento como entregado?",
      buttons: {
        confirm: {
          label: 'Si',
          className: 'btn btn-success'
        },
        cancel: {
          label: 'No',
          className: 'btn btn-danger'
        }
      },
      callback: function (result) {
        if(result) {
          var data = $(item).data();
          $.ajax({
            type: "POST",
            url: data.url, 
            dataType: "text",  
            cache:false,
            data:{
              id: data.id,
              estado: 'Entregado'
            },
            success: function(data,statusTest,xhr){
              if(xhr.status == 206) {
                location.reload();
              }
            }
          });
        }
      }
    });
  }
</script>