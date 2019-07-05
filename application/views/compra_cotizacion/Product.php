<div class="container">
  <div id="medidasJson" style="display: none;"><?php echo $medidasJson;?></div>
  <div id="stockJson" style="display: none;"><?php echo json_encode($stock);?></div>
  <div class="row">
    <?php $descuento=0;?>
    <div class="col-md-12" style="<?php if ($username): ?>margin-top: -42px;<?php else: ?>margin-top: 42px;<?php endif; ?>">
      <?php if($productos){ foreach ($productos as $prod) { ?>
        <div class="col-md-12">
          <div class="card" style="align-items: center; margin-top: 5%;">
            <h4 class="card-title" style="margin-top: 18px;margin-bottom: 0px;"><?= $prod->nombre; ?></h4>
            <div class="card-body text-center">
              <div src="/index.php/imagen/obtener/<?php echo $prod->imagen; ?>" width="20%" height="20%" class="load-image card-img-top img-fluid"></div>
            </div>
          </div>
          <br>
          <br>
        </div>
      <?php } } else { ?>
        <div>
          <h3>No Se encontro productos</h3>
        </div>
      <?php } ?>
    </div>
    <div class="col-md-12"">
      <div class="container" style="margin-bottom: 100px;">
        <div class="card card-register mx-auto mt-5" style="margin-top: 0px !important;">
          <form class="needs-validation" id="cotizacionFormulario" action="<?= $this->config->item('base_url') ?>/index.php/cotizacionController/registrarPOST/<?= $prod->id; ?>" method="post" accept-charset="utf-8">
            <input type="text" name="idProducto" value="<?= $productos[0]->id; ?>" style="display: none;">
            <div class="card-header">Tipo de Producto</div>
            <div class="card-body">
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">
                    <h4>Especie</h4>
                    <SELECT  name="idEspecie" id="idEspecie" class="nav-link dropdown-toggle form-control">
                      <?php
                      foreach ($especies as $prod) {?>
                        <option value="<?= $prod->id; ?>" ><?= $prod->nombre; ?></option>
                        <?php
                      }?>
                    </SELECT>
                    <span class="help-inline error-message" style="color:red;"></span>
                  </div>
                </div>
                <br>
              </div>
              <?php if($productos[0]->medidas==="1") {?>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-12">
                      <h4>Medida:</h4>
                    </div>
                  </div>
                  <div class="form-row" id="idMedidaConversion" style="margin-bottom: 15px;">
                    <div class="col-md-12" style="margin-top: 20px;">
                      <h6 class="ayuda" style="display: none;">metros</h6>
                      <h6>Seleccione la unidad de medida: </h6>
                    </div>
                    <div class="col-md-12">
                      <SELECT onchange="CalcularCostoPorMedida()" name="medidaConversion" class="nav-link dropdown-toggle form-control medida-select">
                        <option name="optionselect" value="metros">Metros</option>
                        <option name="optionselect" value="centimetros">Centimetros</option>
                        <option name="optionselect" value="pulgadas">Pulgadas</option>
                        <option name="optionselect" value="pies">Pies</option>
                      </SELECT>
                    </div>
                  </div>
                  <div id="modalStockContainer" style="display: none;">
                    <div id="stockContainer" style="margin-bottom: 20px;">
                      <div class="col-md-12 text-center" style="margin-top: 10px;
    margin-bottom: 20px;">
                        <h5>Stock Disponible</h5>
                      </div>
                      <table class="table table-bordered" id="medidas-table" style="width: 100%">
                        <thead class="card-header">
                          <tr style="pointer-events: none;" class="text-center">
                            <td>Largo (Mts)</td>
                            <td>Espesor (Pulg)</td>
                            <td>Ancho (Pulg)</td>
                            <td>En Stock</td>
                            <td>Acciones</td>
                          </tr>
                        </thead>
                        <tbody id="medidas-table-body">
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="form-row medidas-container">
                    <div class="col-md-4 form-group">
                      <div class="form-label-group">
                        <label for="largo1">Largo:</label>
                        <input onkeyup="CalcularCostoPorMedida()" type="text" id="largoCliente" style="display: block;" name="largoCliente" placeholder="Ingrese el largo" class="form-control">
                        <span class="help-inline error-message" style="color:red;"></span>
                      </div>
                    </div>
                    <div class="col-md-4 form-group">
                      <div class="form-label-group">
                        <label for="espesor1">Espesor:</label>
                        <input onkeyup="CalcularCostoPorMedida()" type="text" id="espesorCliente" style="display: block;" name="espesorCliente" placeholder="Ingrese el espesor" class="form-control espesor-convert">
                        <span class="help-inline error-message" style="color:red;"></span>
                      </div>
                    </div>
                    <div class="col-md-4 form-group">
                      <div class="form-label-group">
                        <label for="ancho1">Ancho:</label>
                        <input onkeyup="CalcularCostoPorMedida()" type="text" id="anchoCliente" style="display: block;" name="anchoCliente" placeholder="Ingrese el ancho" class="form-control">
                        <span class="help-inline error-message" style="color:red;"></span>
                      </div>
                    </div>
                    <div class="form-group" style="display: none;">
                      <div class="form-row" >
                        <div class="col-md-12">
                          <h4>Costo</h4>
                          <input type="text" name="costo" id="costo" readonly>
                        </div>
                      </div>
                      <div class="form-row" >
                        <div class="col-md-12">
                          <h4>Cubicacion</h4>
                          <input type="text" name="cubicacion" id="cubicacion" readonly>
                        </div>
                      </div>
                      <br>
                    </div>
                    <div class="col-md-12" style="margin-top: 20px;" id="medidas-mensajes">
                      <div class="alert alert-info" id="alerta-info-medida" role="alert" style="display: none;">
                        El costo por centrimetro cubico por es de:
                        <strong class="costo"></strong>, para la medida ingresada su costo es: <strong class="total"></strong>
                      </div>
                      <div class="alert alert-danger" id="alerta-error-medida-rango" role="alert" style="display: none;">
                        Las medidas deben estar en el siguiente rango:
                        <br>Largo: <strong class="largo"></strong>
                        <br>Espesor: <strong class="espesor"></strong>
                        <br>Ancho: <strong class="ancho"></strong>
                      </div>
                      <div class="alert alert-danger" id="alerta-error-medida" role="alert">
                        Ingrese sus medidas.
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="text-center">
                        <button class="btn btn-primary col-md-3" onclick="verStock(event);">Ver Stock</button>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
              <!--Disable the Combobox when the checkbox is true-->
              <?php if($productos[0]->cepillado==="1") {?>
                <div class="form-group">
                  <h4>Cepillado:</h4>
                  <div class="form-row cepillados-container">
                    <div class="col-md-12">
                      <div class="radio">
                        <label><input type="radio" name="cepillado-input" value="si"><span style="margin-left: 15px;">Si</span></label>
                      </div>
                      <div class="radio">
                        <label><input type="radio" name="cepillado-input" value="no" checked><span style="margin-left: 15px;">No</span></label>
                      </div>
                    </div>
                    <div class="col-md-12" id="cepillado-dropdown" style="display: none;">
                      <SELECT  name="cepillado" id="cepillado" class="nav-link dropdown-toggle form-control cepillado-selected select-cepillado">
                        <?php foreach ($cepillados as $prod) { ?>
                          <option value="<?= $prod->id; ?>" data-precio="<?= $prod->costo; ?>"><?= $prod->caras; ?></option>
                        <?php } ?>
                      </SELECT>
                      <div style="display: none;">
                        <SELECT  name="costoCepillado" id="costoCepillado" class="nav-link dropdown-toggle form-control cepillado-selected select-cepillado">
                          <?php foreach ($cepillados as $prod) { ?>
                            <option value="<?= $prod->costo; ?>" data-precio="<?= $prod->costo; ?>"><?= $prod->costo; ?></option>
                          <?php } ?>
                        </SELECT>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
              <?php $selected = 0; ?>
              <?php if($productos[0]->moldura==="1") {?>
                <div class="form-group" id="moldura-select">
                  <h4>Moldura:</h4>
                  <div class="form-row input-container">
                    <?php $index = 0 ?>
                    <?php foreach ($molduras as $prod) {?>
                      <div class="col-md-3">
                        <div class="form-label-group">
                          <div class="checkbox">
                            <div tipo="moldura" class="image-selectable <?php if ($index === 0) { $selected=1; ?>image-selected<?php } ?>" data-index="<?php echo $index; ?>" data-precio="<?php echo $prod->costo; ?>" data-id="<?php echo $prod->id; ?>" data-tipo="moldura">
                              <div src="/index.php/imagen/obtener/<?php echo $prod->imagen; ?>" width="100%" class="load-image"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php $index = $index + 1 ?>
                    <?php } ?>
                    <input type="hidden" name="moldura" id="moldura" class="input-imagen" value="0">
                  </div>
                </div>
              <?php }?>
              <?php if($productos[0]->tallado==="1") {?>
                <div class="form-group" id="tallado-select">
                  <h4>Tallado:</h4>
                  <div class="form-row input-container">
                    <?php $index = 0 ?>
                    <?php foreach ($tallados as $prod) {?>
                      <div class="col-md-3">
                        <div class="form-label-group">
                          <div class="checkbox">
                            <div tipo="tallado" class="image-selectable <?php if ($index === 0 && $selected === 0): ?>image-selected<?php endif; ?>" data-index="<?php echo $index; ?>" data-precio="<?php echo $prod->costo; ?>" data-id="<?php echo $prod->id; ?>" data-tipo="tallado">
                              <div src="/index.php/imagen/obtener/<?php echo $prod->imagen; ?>" width="100%" class="load-image"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php $index = $index + 1 ?>
                    <?php } ?>
                    <input type="hidden" name="tallado" id="tallado" class="input-imagen" value="0">
                  </div>
                </div>
              <?php } ?>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">
                    <div class="form-label-group">
                      <h4>Cantidad:</h4>
                      <input type="text-center" id="cantidad" name="cantidad" placeholder="Ingrese la cantidad" class="form-control" value="1">
                      <span class="help-inline error-message" style="color:red;"></span>
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">
                    <h4>Cotizacion (Bs):</h4>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-12">
                    <div class="form-label-group">
                      <input <?php if($type==="preferencial"){?> style="text-decoration: line-through;"<?php } ?> type="text-center" name="cotizacion" id="cotizacion" class="form-control" readonly>
                      <span class="help-inline error-message" style="color:red;"></span>
                    </div>
                  </div>
                </div>
              </div>
              <?php if($type==="preferencial"){?>
                <input type="hidden" name="descuento" value="<?php echo $user[0]->descuento ?>">
              <?php } ?>

              <?php if($type==="preferencial"){?>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-12">
                      <h4>Cotizacion con descuento (Bs): </h4>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col-md-12">
                      <div class="form-label-group">
                        <input type="text-center" name="cotizacionDescuento" id="cotizacionDescuento" class="form-control" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="alert alert-success" id="alerta-info-descuento" role="alert" style="margin-top: 10px;">
                    Se le otorgara un descuendo del <strong class="descuento"></strong> de la compra total.
                  </div>
                </div>
              <?php } ?>
              <div class="alert alert-info" role="alert" id="cotizacion-info">
                La cotizacion se calculara cuando ingrese toda la informacion solicitada.
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-12">
                  <div class="text-center">
                    <?php if ($username === null){ ?>
                      <div class="alert alert-warning" role="alert">
                        Para realizar compras debe iniciar sesion.
                      </div>
                    <?php } else { ?>
                      <button class="btn btn-primary col-md-3" type="submit"> Agregar Carrito</button>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-row"></div>
            <div class="form-row"></div>
            <br>
          </form> 
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $( document ).ready(function() {
    $("[name=cepillado-input]").click(function() {
      if($(this).val() === 'si') {
        $("#cepillado-dropdown").show();
        $("#moldura-select").show();
        $("#tallado-select").show();
      } else {
        $("#cepillado-dropdown").hide();
        $("#moldura-select").hide();
        $("#tallado-select").hide();
      }
    });
    $("[name=medida-input]").click(function() {
      if($(this).val() === 'si') {
        $("#idEspesor").show();
        $("#idAncho").show();
        $("#idLargo").show();
        $("#idEspesor-cliente").hide();
        $("#idAncho-cliente").hide();
        $("#idLargo-cliente").hide();
        $("#idMedidaConversion").hide();
      } else {
        $("#idEspesor").hide();
        $("#idAncho").hide();
        $("#idLargo").hide();
        $("#idEspesor-cliente").show();
        $("#idAncho-cliente").show();
        $("#idLargo-cliente").show();
        $("#idMedidaConversion").show();
      }
    });
    $(".select-medida").change(function() {
      var $selects = $(this).closest('.medidas-container').find("select");
      var selectedIndex = $(this).prop('selectedIndex');
      _.each($selects, function(item) {
        var $item = $(item);
        $item.find('option')[selectedIndex].selected = true;
      });
    });
    $(".select-cepillado").change(function() {
      var $selects = $(this).closest('.cepillados-container').find("select");
      var selectedIndex = $(this).prop('selectedIndex');
      _.each($selects, function(item) {
        var $item = $(item);
        $item.find('option')[selectedIndex].selected = true;
      });
    });
    setInterval(function() {
      calcularCotizacion();
    }, 250);
    $(".image-selectable").click(function() {
      var imageSelected = $(this);
      $('input.input-imagen').val("0");
      $(".image-selected").removeClass("image-selected");
      imageSelected.addClass("image-selected");
      var currdata = imageSelected.data();
      imageSelected.closest(".input-container").find("input").val(currdata.id);
    });
    if($(".image-selected").length > 0) {
      var imageSelected = $($(".image-selected")[0]);
      var currdata = imageSelected.data();
      imageSelected.closest(".input-container").find("input").val(currdata.id);
    }
    CargarTablaMedidas();
  });
  function verStock(evt) {
    evt.preventDefault();
    if($(".medidaBody").length > 0) {
      var dialog = bootbox.dialog({
        message: $("#stockContainer").html(),
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
</script>
<script src="<?= $this->config->item('boost_serial_file') ?>/cotizacion.js"></script>
<script src="<?= $this->config->item('boost_serial_file') ?>/calculos.js"></script>