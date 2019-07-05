
  <div class="col-md-12"">
    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Crear Usuario</div>
        <div class="card-body">
          <form class="needs-validation" id="registrarFormulario" action="/index.php/usuariosController/registrarPOST" method="post" accept-charset="utf-8" enctype="multipart/form-data" >
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
                    <label for="correo">Correo Electronico: </label>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-label-group">
                    <input name="correo" type="text" id="correo" class="form-control" autofocus="autofocus">
                    <span class="help-inline error-message" style="color:red;"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-3">
                  <div class="form-label-group">
                    <label for="password">Contraseña: </label>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-label-group">
                    <input name="password" type="text" id="password" class="form-control" autofocus="autofocus" >
                    <span class="help-inline error-message" style="color:red;"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group form-label-group">
              <div class="form-row">
                <div class="col-md-3">
                  <div class="form-label-group">
                    <label for="num_descuento">Tipo de cuenta: </label>
                  </div>
                </div>
                <div class="col-md-9">
                  <SELECT  name="tipo" id="tipo"  class="nav-link dropdown-toggle form-control">
                    <option value="admin">administrador</option>
                    <option value="usuario" selected="">usuario</option>
                  
                  </SELECT>
                </div>
              </div>
              <span class="help-inline error-message" style="color:red;"></span>
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
