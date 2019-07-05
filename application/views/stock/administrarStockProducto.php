<div class="col-md-12"">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <center>
        <div class="text-center noPrint" style="padding: .75rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #D7CEC7;font-weight: bold;margin-bottom: 8px;" >
          Stock
        </div>
        <table class="table productoDataTableStock" id="printTable" style="width: 100%">
          <thead class="card-header">
            <tr style="pointer-events: none;" class="text-center">
              <td style="display: none;">Producto/especie/largo/espesor/ancho</td>
              <td>Fecha</td>
              <td>Producto</td>
              <td>Especie</td>
              <td>Ingresos</td>
              <td>Egresos</td>
              <td>Fecha de ingreso</td>
              <td class="noPrint">Opciones</td>
            </tr>
          </thead>
          <tbody>
            <?php if($stock){ foreach ($stock as $prod) { ?>
              <tr data-ingreso="<?= $prod->ingreso; ?>" data-egreso="<?= $prod->egreso; ?>">
                <td style="display: none;"><span style="font-weight: 100;">Producto:</span> <?= $prod->nombreprod; ?> <span style="font-weight: 100;"> / Especie: </span> <?= $prod->nombreesp; ?> <span style="font-weight: 100;"> / Largo: </span> <?= $prod->largo; ?> <span style="font-weight: 100;">mts / Ancho: </span> <?= $prod->ancho; ?> <span style="font-weight: 100;"> pulg / Espesor: </span> <?= $prod->espesor; ?><span style="font-weight: 100;"> pulg </span>
                </td>
                <td><?= $prod->fecha_registro; ?></td>
                <td><?= $prod->nombreprod; ?></td>
                <td><?= $prod->nombreesp; ?></td>
                <td><?= $prod->ingreso; ?></td>
                <td><?= $prod->egreso; ?></td>
                <td class="formatDate"><?= $prod->fecha_registro; ?></td>
                <td class="noPrint">
                  <a class="btn btn-info" href="/index.php/stockController/editar/<?= $prod->idStock; ?>">Modificar</a>
                  <a class="btn btn-danger btn-sm eliminar-item" data-stock-id="<?= $prod->idStock; ?>" data-productoId="<?= $prod->productoId; ?>">Eliminar</a>
                </td>
              </tr>
            <?php } } else { ?>
              <tr>
                <td colspan="9" class="text-center">No se encontraron resultados</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </center>
    </div>
  </div>
  <br>
  <br>
  <div class="col-md-12">
    <button class="btn btn-primary col-md-3" onclick="printTableContent('printTable', 'Reporte de stock por producto')"> Imprimir
    </button>
  </div>
  <br>
  <br>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $(".close").click(function(){
      $("#myAlert").alert("close");
    });
    $(".eliminar-item").click(function(item){
      var data = $(item.target).data();
      bootbox.confirm({
        message: "¿Esta seguro de eliminarlo?",
        buttons: {
          confirm: {
            label: 'Si',
            className: 'btn-success'
          },
          cancel: {
            label: 'No',
            className: 'btn-danger'
          }
        },
        callback: function (result) {
          if(result) {
            $.ajax({
              type: "POST",
              url: "/index.php/stockController/borrar/" + data.stockId, 
              dataType: "text",  
              cache:false,
              data:{
                productoId: data.productoid
              },
              success: function(data,statusTest,xhr){
                var data = JSON.parse(data);
                location.href = data.url;
              }
            });
          }
        }
      });
    });
    $("#dropdown1").parent().find("ul.dropdown-menu").on('click', function (e) {
      e.stopPropagation();
    });

    $("#printTable").on('search.dt', function () {
      setTimeout(function(){
        refreshTotals();
      },300);
    });
    refreshTotals();
    
  });

  function refreshTotals() {
    $('.Total').remove();
    var groupsEl = $("#printTable tr.group-start");
    var trs = $("#printTable tr");
    var groups = [];
    var groupsRefs = [];
    _.each(groupsEl, function(item) {
      groups.push([]);
    });
    var index = -1;
    _.each(trs, function(item, key, list) {
      var $item = $(item);
      if($item.hasClass("group-start") || $item.hasClass("odd") || $item.hasClass("even")) {
        if($item.hasClass("group-start")) {
          groupsRefs.push(item);
          index++;
        } else if(!_.isNull(groups[index]) && !_.isUndefined(groups[index]) && _.isArray(groups[index])) {
          groups[index].push(item);
        }
      }
    });
    _.each(groups, function(items, index) {
      var total = 0;
      _.each(items, function(item) {
        var $item = $(item);
        var data = $item.data();
        total += data.ingreso;
        total -= data.egreso;
      });
      var $last = $(_.last(items));
      var style = total < 0 ? "style='COLOR: red;'" : "";
      $last.after(`
              <tr class='Total' ` +  style + `>
                <td style="display: none;">` + groupsRefs[index].outerText + `</td>
                <td style='font-weight: bold;'>TOTAL</td>
                <td colspan="2">
                    ` + total + `
                </td>
                <td></td>
              </tr>
            `)
    });
  }
</script>
