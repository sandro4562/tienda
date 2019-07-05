<div class="col-md-12"">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Crear Tallado</div>
      <div class="card-body">
        <form class="needs-validation" id="talladoFormulario" action="<?= $this->config->item('base_url') ?>/index.php/talladoController/registrarPOST" method="post" accept-charset="utf-8" entype="multipart/form-data" >
          <div class="form-group form-label-group">
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <label>Producto: </label>
                </div>
              </div>
              <SELECT onchange="storeLastSelected(this)" name="idProducto" id="producto" class="nav-link dropdown-toggle form-control">
                <?php
                foreach ($productos as $prod) {?>
                  <option value="<?= $prod->id; ?>" ><?= $prod->nombre; ?></option>
                  <?php
                }?>
              </SELECT>
            </li>
          </div>
        </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-12">
              <div class="form-label-group">
                <label for="imagen">Imagen: </label>
                <input name="imagen" type="file" id="imagen" class="form-control" autofocus="autofocus">
                <span class="help-inline error-message" style="color:red;"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-12">
              <div class="form-label-group">
                <label for="costo">Costo: </label>
                <input name="costo" type="text" id="costo" class="form-control" placeholder="Ingrese el Costo" autofocus="autofocus">
                <span class="help-inline error-message" style="color:red;"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="text-center">
            <button class="btn btn-primary col-md-3" type="submit"> Guardar</button> 
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>