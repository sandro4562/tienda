<?php if(is_array($stocks) && count($stocks) > 0) {  ?>
<div id="medidasJson" style="display: none;"><?php echo json_encode($medidas);?></div>
<div class="col-md-12"">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Stock</div>
      <div class="card-body">
        <?php $num=0; ?>
        <form class="needs-validation" id="stockFormulario" novalidate="" action="<?= $this->config->item('base_url') ?>/index.php/stockController/actualizar/<?= $stocks[0]->idStock ?>" method="post" accept-charset="utf-8" data-Producto="<?php echo $num; ?>">
          <input type="hidden" name="productoId" id="productoId" class="form-control" value="<?= $stocks[0]->productoId; ?>" readonly>
          <div class="form-group form-label-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <label>Producto: </label>
                  <input type="text" name="producto" id="producto" class="form-control" value="<?= $stocks[0]->nombreprod; ?>" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <label>Especie: </label>
                  <input type="hidden" name="idEspecie" id="idEspecie" class="form-control" value="<?= $stocks[0]->especieId; ?>" readonly>
                  <input type="text" name="especie" id="especie" class="form-control" value="<?= $stocks[0]->nombreesp; ?>" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group" style="display: none;">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group" id="medidasContainer">
                  <div>
                    <table class="table table-bordered" id="medidas-table" style="width: 100%">
                      <thead class="card-header">
                        <tr style="pointer-events: none;" class="text-center">
                          <td>Largo (Mts)</td>
                          <td>Espesor (Pulg)</td>
                          <td>Ancho (Pulg)</td>
                          <td>Acciones</td>
                        </tr>
                      </thead>
                      <tbody id="medidas-table-body">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12" style="margin-bottom: 20px;">
            <div class="text-center">
              <button class="btn btn-primary col-md-3" onclick="verMedidas(event);">Ver Medidas</button>
            </div>
          </div>
          <div class="form-group" style="margin-bottom: 0px;">
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <label for="largo1">Largo (Metros):</label>
                  <div class="form-group form-label-group">
                    <input type="text" name="largo" id="largo" class="form-control" value="<?= $stocks[0]->largo; ?>" readonly>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <label for="ancho1">Ancho (Pulgadas):</label>
                  <div class="form-group form-label-group">
                    <input type="text" name="ancho" id="ancho" class="form-control" value="<?= $stocks[0]->ancho; ?>" readonly>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <label for="espesor1">Espesor (Pulgadas):</label>
                  <div class="form-group form-label-group">
                    <input type="text" name="espesor" id="espesor" class="form-control" value="<?= $stocks[0]->espesor; ?>" readonly>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <label for="nombre">Cantidad: </label>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-label-group">
                  <input name="cantidad" type="text" id="cantidad" class="form-control" value="<?php if ($stocks[0]->ingreso !== "0"): echo $stocks[0]->ingreso; else: echo -$stocks[0]->egreso; endif; ?>">
                  <span class="help-inline error-message" style="color:red;"></span>
                </div>
              </div>
              <div class="alert alert-info col-md-12" role="alert" style="margin-top: 10px;">
                Registrar una cantidad positiva es ingreso y negativa es un egreso.
              </div>
              <br>
              <div class="col-md-12">
                <div class="text-center">
                  <button class="btn btn-primary col-md-3" type="submit" value="Upload"> Guardar</button> 
                </div>
              </div>
            </div>
          </div>
          <br>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } else { ?>
  <div class="col-md-12">    
    <div class="container" style="margin-top: 50px;">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">
          Lo sentimos
        </div>
        <div class="card-body">
          No se encontro el cepillado que esta buscando
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
<script type="text/javascript">
  $(document).ready(function() {
    $(".isSelected").change(function() {
      $(".isSelected").removeClass("isSelected");
      $(this).addClass("selected");
      $(this).data("procuto")
    });
    $("#idEspecie").change(function() {
      CargarMedidasStock();
      $("#largo").val('');
      $("#ancho").val('');
      $("#espesor").val('');
    });
    CargarMedidasStock();
  });
  function CargarMedidasStock() {
    var $tableBody = $("#medidas-table-body");
    var htmlTemplate = _.template(`<tr class="text-center medidaBody">
      <td><%= largo %></td>
      <td><%= espesor %></td>
      <td><%= ancho %></td>
      <td>
      <button data-largo="<%= largoM %>" data-espesor="<%= espesor %>" data-ancho="<%= ancho %>" style="width: 100%;" class="btn btn-info" onclick="seleccionarMedida(event);">
      Seleccionar
      </button>
      </td>
      </tr>`);
    $(".medidaBody").remove();
    var medidas = JSON.parse($("#medidasJson").html());
    var grouped = _.groupBy(medidas, 'idEspecie');
    var medidasItems = grouped[$("#idEspecie").val()];
    if(medidasItems) {
      _.each(medidasItems, function(items, key){
        $tableBody.append(htmlTemplate({
          largo: items.largo,
          espesor: convertirDeMetros('Pulgadas', parseFloat(items.espesor)),
          ancho: convertirDeMetros('Pulgadas', parseFloat(items.ancho)),
          largoM: items.largo,
          espesorM: items.espesor,
          anchoM: items.ancho
        }));
      });
    }
  }
  function verMedidas(evt) {
    evt.preventDefault();
    if($(".medidaBody").length > 0) {
      var dialog = bootbox.dialog({
        title: 'Lista de medidas',
        message: $("#medidasContainer").html(),
        buttons: {
          cancel: {
            label: "Cerrar",
            className: 'btn-danger',
            callback: function(){}
          }
        }
      });
    } else {
      bootbox.alert("No se encontro stock para el producto.");
    }
  }
  function seleccionarMedida(evt) {
    evt.preventDefault();
    var data = $(evt.target).data();
    $("#largo").val(data.largo);
    $("#ancho").val(data.ancho);
    $("#espesor").val(data.espesor);
    bootbox.hideAll();
  }
</script>
<link href="<?= $this->config->item('font_file') ?>/stock.js"> 
<style type="text/css">
  .modal-body {
    height: 550px;
    overflow-y: scroll;
  }
  .bootbox .modal-header h4 {
    float: none;
  }

  .bootbox .modal-header .close {
    position: absolute;
    right: 15px;
  }
</style>