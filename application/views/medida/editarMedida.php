<div id="especiesJson" style="display: none;"><?= $especiesJson; ?></div>
<?php if(is_array($medidas) && count($medidas) > 0) {  ?>
  <div id="medidaSelectedId" style="display: none;"><?= $medidas[0]->idEspecie; ?></div>
  <div class="col-md-12"">
    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Editar Medidas</div>
        <div class="card-body">
          <form class="needs-validation" name="medida"id="medidaFormulario" action="/index.php/medidaController/actualizar/<?php echo $id?>" method="post" accept-charset="utf-8">
            <div class="form-group form-label-group">
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-label-group">
                    <label>Producto: </label>
                    <SELECT onchange="doAction(this)" name="idProducto" id="producto" class="nav-link dropdown-toggle form-control">
                      <?php
                      foreach ($productos as $prod) {?>
                        <option value="<?= $prod->id; ?>" <?php if ($prod->id == $medidas[0]->idProducto): ?> selected <?php endif; ?>><?= $prod->nombre; ?></option>
                        <?php
                      }?>
                    </SELECT>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="form-label-group col-md-12">
                  <label>Especie:</label>
                  <SELECT  name="idEspecie" id="idEspecie" class="nav-link dropdown-toggle form-control">
                  </SELECT>
                  <span class="help-inline error-message" style="color:red;"></span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-group form-label-group">
                    <label for="largo1">Largo (Metros):</label>
                    <input type="text" name="largo" id="largo" class="form-control" placeholder="Ingrese el Largo" value=" <?php echo $medidas[0]->largo;?>">
                    <span class="help-inline error-message" style="color:red;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group form-label-group">
                    <label for="espesor1">Espesor (Metros):</label>
                    <input type="text" name="espesor" id="espesor" class="form-control" placeholder="Ingrese el Espesor" autofocus="autofocus" value=" <?php echo $medidas[0]->espesor;?>">
                    <span class="help-inline error-message" style="color:red;"></span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group form-label-group">
                    <label for="ancho1">Ancho (Metros):</label>
                    <input type="text" name="ancho" id="ancho" class="form-control" placeholder="Ingrese el Ancho" value=" <?php echo $medidas[0]->ancho;?>">
                    <span class="help-inline error-message" style="color:red;"></span>
                  </div>
                </div>

              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-group form-label-group">
                    <label for="costo1">Costo (metros):</label>
                    <input type="text" name="costo" id="costo" class="form-control" placeholder="Ingrese el Costo" value=" <?php echo $medidas[0]->costo;?>">
                    <span class="help-inline error-message" style="color:red;"></span>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="col-md-12">
              <div class="text-center">
                <button class="btn btn-primary col-md-3" type="submit">Guardar</button>
              </div>
            </div>
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
          No se encontro la medida que esta buscando
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<script src="<?= $this->config->item('boost_serial_file') ?>/calculos.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    loadMedidas();
    var idEspecie = $("#medidaSelectedId").html();
    if(idEspecie && !_.isEmpty(idEspecie)) {
      $("#idEspecie").val(idEspecie);
    }
  });
  function doAction(el) {
    storeLastSelected(el);
    loadMedidas();
  }
  function loadMedidas() {
    var $item = $("#producto");
    var selected = parseInt($item.val());
    var especies = JSON.parse($("#especiesJson").html());
    var especiesAgrupado = _.groupBy(especies, 'prodId');
    var especiesProducto = especiesAgrupado[selected];
    $(".especieOption").remove();
    if(especiesProducto) {
      _.each(especiesProducto, function(especie, index) {
        $("#idEspecie").append('<option value="' + especie.id + '" class="especieOption">' + especie.nombre + '</option>');
      });
    }
  }
</script>