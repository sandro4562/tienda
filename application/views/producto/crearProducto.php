  <div class="col-md-12"">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Crear Producto</div>
      <div class="card-body">
        <form class="needs-validation" id="productoFormulario" action="<?= $this->config->item('base_url') ?>/index.php/producto/registrarPOST" method="post" accept-charset="utf-8" entype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-label-group">
                  <label for="nombre">Nombre: </label>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-label-group">
                  <input name="nombre" type="text" id="nombre" class="form-control" placeholder="Ingresar nombre" autofocus="autofocus">
                  <span class="help-inline error-message" style="color:red;"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-label-group">
                  <label for="imagen">Imagen: </label>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-label-group">
                  <input name="imagen" type="file" id="imagen" class="form-control">
                  <span class="help-inline error-message" style="color:red;"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-label-group">
                  <label for="nombre">Precio: </label>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-label-group">
                  <input name="precio" type="text" id="precio" class="form-control" placeholder="Ingresar precio" autofocus="autofocus">
                  <span class="help-inline error-message" style="color:red;"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="text-center">
              <button class="btn btn-primary col-md-3" type="submit" value="Upload"> Guardar</button> 
            </div>
          </div>
          <div class="text-center">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>