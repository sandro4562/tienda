<?php if(is_array($molduras) && count($molduras) > 0) {  ?>
  <div class="col-md-12"">
    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Editar Moldura</div>
        <div class="card-body">
          <form class="needs-validation" id="molduraFormulario" action="/index.php/molduraController/actualizar/<?php echo $id?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" >
            <div class="form-group form-label-group">
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-label-group">
                    <label>Producto: </label>
                    <SELECT onchange="storeLastSelected(this)" name="idProducto" id="producto" class="nav-link dropdown-toggle form-control">
                      <?php
                      foreach ($productos as $prod) {?>
                        <option value="<?= $prod->id; ?>" <?php if ($prod->id == $molduras[0]->idProducto): ?> selected <?php endif; ?>><?= $prod->nombre; ?></option>
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
                    <label for="imagen">Imagen: </label>
                    <input name="imagen" type="file" id="imagen" class="form-control" autofocus="autofocus" value="">
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-2">
                  <div class="form-label-group">
                    <label for="nombre">Imagen Anterior: </label>
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-label-group">
                    <div src="/index.php/imagen/obtener/<?= $molduras[0]->imagen; ?>" width="200" class="load-image"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-label-group">
                    <label for="costo">Costo: </label>
                    <input name="costo" type="text" id="costo" class="form-control" placeholder="Ingrese el Costo" autofocus="autofocus"  value=" <?php echo $molduras[0]->costo;?>">
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
<?php } else { ?>
  <div class="col-md-12">    
    <div class="container" style="margin-top: 50px;">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">
          Lo sentimos
        </div>
        <div class="card-body">
          No se encontro la moldura que esta buscando
        </div>
      </div>
    </div>
  </div>
  <?php } ?>