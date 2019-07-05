<?php if(is_array($especies) && count($especies) > 0) {  ?>
  <div class="col-lg-12">
    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Editar Especie</div>
        <div class="card-body">
          <form class="needs-validation" id="especieFormulario" novalidate="" action="/index.php/especieController/actualizar/<?php echo $id?>" method="post" accept-charset="utf-8">
            <div class="form-group form-label-group">
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-label-group">
                    <label>Producto: </label>
                    <SELECT onchange="storeLastSelected(this)" name="idProducto" id="producto" class="nav-link dropdown-toggle form-control">
                      <?php
                      foreach ($productos as $prod) {?>
                        <option value="<?= $prod->id; ?>" <?php if ($prod->id == $especies[0]->idProducto): ?> selected <?php endif; ?>><?= $prod->nombre; ?></option>
                        <?php
                      }?>
                    </SELECT>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-label-group">
                    <label>Nombre de especie: </label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingresar Nombre" value="<?php echo $especies[0]->nombre; ?>">
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
          No se encontro la especie que esta buscando
        </div>
      </div>
    </div>
  </div>
<?php } ?>

