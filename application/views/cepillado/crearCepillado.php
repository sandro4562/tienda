<div class="col-md-12">    
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Crear Cepillado</div>
      <div class="card-body">
        <form class="needs-validation" id="cepilladoFormulario" action="<?= $this->config->item('base_url') ?>/index.php/cepilladoController/recibirdatos" method="post" accept-charset="utf-8">
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
            </div>
          </div>
          <div class="form-group form-label-group">
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <label>Numero de Caras: </label>
                </div>
              </div>
              <SELECT  name="caras" id="idCaras" class="nav-link dropdown-toggle form-control">
                <option value="1 Cara">1 Cara</option>
                <option value="2 Caras">2 Caras</option>
                <option value="3 Caras">3 Caras</option>
                <option value="4 Caras">4 Caras</option>
              </SELECT>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-12">
                <div class="form-label-group">
                  <label for="costo">Costo: </label>
                </div>
                <div class="form-label-group">
                  <input id="costo" class="form-control" placeholder="Ingrese el costo:"
                  name="costo">
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
      </div>
    </div>
  </div>
</div>