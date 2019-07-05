<div id="especiesJson" style="display: none;"><?= $especiesJson; ?></div>
<div class="col-md-12"">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Crear Medidas</div>
      <div class="card-body">
        <form class="needs-validation" name="medida" id="medidaFormulario" action="<?= $this->config->item('base_url') ?>/index.php/medidaController/recibirdatos" method="post" accept-charset="utf-8">
          <div class="form-group form-label-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <label>Producto: </label>
                  <SELECT onchange="doAction(this)" name="idProducto" id="producto" class="nav-link dropdown-toggle form-control">
                    <?php
                    foreach ($productos as $prod) {?>
                      <option value="<?= $prod->id; ?>" ><?= $prod->nombre; ?></option>
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
          <div class="form-group" style="margin-bottom: 0px;">
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <label for="largo1">Largo (Metros):</label>
                  <div class="form-group form-label-group">
                    <input type="text" name="largo" id="largo" class="form-control" placeholder="Ingrese el Largo" autofocus>
                    <span class="help-inline error-message" style="color:red;"></span>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <label for="espesor1">Espesor (Metros):</label>
                  <div class="form-group form-label-group">
                    <input type="text" name="espesor" id="espesor" class="form-control" placeholder="Ingrese el Espesor">
                    <span class="help-inline error-message" style="color:red;"></span>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <label for="ancho1">Ancho (Metros):</label>
                  <div class="form-group form-label-group">
                    <input type="text" name="ancho" id="ancho" class="form-control" placeholder="Ingrese el Ancho">
                    <span class="help-inline error-message" style="color:red;"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group" style="margin-bottom: 0px;">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <label for="precioCubicacion">Precio cubicación:</label>
                  <div class="form-group form-label-group">
                    <input type="text" name="costo" id="costo" class="form-control" placeholder="Ingrese el costo" autofocus="autofocus">
                    <span class="help-inline error-message" style="color:red;"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="text-center">
              <button class="btn btn-primary col-md-3" type="submit" value="Upload"> Guardar</button> 
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="<?= $this->config->item('boost_serial_file') ?>/calculos.js"></script>
<script type="text/javascript">
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
  function doAction(el) {
    storeLastSelected(el);
    loadMedidas();
  }
  $(document).ready(function() {
    loadMedidas();
  });
</script>