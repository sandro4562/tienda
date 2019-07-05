
  <div class="col-md-12"">
    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Crear Cliente</div>
        <div class="card-body">
          <form class="needs-validation" id="registrarFormulario" action="/index.php/clienteController/registrarPOST" method="post" accept-charset="utf-8" enctype="multipart/form-data" >
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-3">
                  <div class="form-label-group">
                    <label for="nombre">Nombre: </label>
                  </div>
                </div>
                <div class="col-md-9">
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
                    <label for="correo">Apellido: </label>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-label-group">
                    <input name="apellido" type="text" id="apellido" class="form-control" autofocus="autofocus">
                    <span class="help-inline error-message" style="color:red;"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-3">
                  <div class="form-label-group">
                    <label for="ci">CI: </label>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-label-group">
                    <input name="ci" type="text" id="ci" class="form-control" autofocus="autofocus" >
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
          </form>
          <br>
        </div>
      </div>
    </div>
  </div>
