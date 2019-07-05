<?php if(is_array($productos) && count($productos) > 0) {  ?>
  <div class="col-md-12"">
    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Editar Producto</div>
        <div class="card-body">
          <form class="needs-validation" id="productoFormulario" action="/index.php/producto/actualizar/<?php echo $id?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" >
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-label-group">
                    <label for="nombre">Nombre: </label>
                    <input name="nombre" type="text" id="nombre" class="form-control" placeholder="Ingresar nombre" autofocus="autofocus" value="<?php if($productos) echo $productos[0]->nombre; ?>">
                    <span class="help-inline error-message" style="color:red;"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-label-group">
                    <label for="imagen">Imagen: </label>
                    <input name="imagen" type="file" id="imagen" class="form-control" autofocus="autofocus" value="">
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-label-group">
                    <label for="nombre">Precio: </label>
                    <input name="precio" type="text" id="precio" class="form-control" placeholder="Ingresar nombre" autofocus="autofocus" value="<?php if($productos) echo $productos[0]->precio; ?>">
                    <span class="help-inline error-message" style="color:red;"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-3">
                  <div class="form-label-group">
                    <label for="nombre">Imagen Anterior: </label>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-label-group">
                    <div src="/index.php/imagen/obtener/<?= $productos[0]->imagen; ?>" width="200" class="load-image"></div>
                  </div>
                </div>
              </div>
            </div>
          
            <div class="col-md-12">
            <div class="text-center">
              <button class="btn btn-primary col-md-3" type="submit" type="submit"> Guardar</button> 
            </div>
          </div>
          </form>
          <br>
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
          No se encontro el producto que esta buscando
        </div>
      </div>
    </div>
  </div>
<?php } ?>