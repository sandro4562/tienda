<div class="col-md-12"">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Crear Especie</div>
      <div class="card-body">
        <form class="needs-validation" id="especieFormulario" novalidate="" action="<?= $this->config->item('base_url') ?>/index.php/especieController/recibirdatos" method="post" accept-charset="utf-8">
          <div class="form-group form-label-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <label>Producto: </label>
                  <SELECT onchange="storeLastSelected(this)" name="idProducto" id="producto" class="nav-link dropdown-toggle form-control">
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
              <div class="col-md-12">
                <div class="form-label-group">
                  <label>Nombre de especie: </label>
                  <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingresar Nombre">
                  <span class="help-inline error-message" style="color:red;"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="text-center">
              <button class="btn btn-primary col-md-3" type="submit">Guardar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>