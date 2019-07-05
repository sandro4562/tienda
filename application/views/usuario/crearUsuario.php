<div class="col-md-12"">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Crear Nuevo Usuario</div>
      <div class="card-body">
        <form role="form" action="<?= $this->config->item('base_url') ?>/index.php/usuariosController/recibirdatos" method="post" class="needs-validation register-form" id="registerFormulario">
          <div class="form-bottom">
            <?= form_open('usuarioController/recibirdatos'); ?>
            <div class="form-group" id="nombre">
              <?php
              $nombre = array(
                'name' => 'nombre',
                'for' => 'form-username',
                'class' => 'form-username form-control',
                'id' => 'nombre',
                'placeholder' => 'Ingrese nombre completo'
              );?>
              <?= form_input($nombre,@set_value('nombre')) ?>
              <span class="help-inline error-message" style="color:red;"></span>
            </div>
            <div class="form-group" id="correo">
              <?php 
              $correo = array(
                'name' => 'correo',
                'for' => 'form-username',
                'class' => 'form-username form-control',
                'id' => 'correo',
                'placeholder' => 'Ingrese correo electronico'
              );?>
              <?= form_input($correo,@set_value('correo')) ?>
              <span class="help-inline error-message" style="color:red;"></span>
            </div>
            <div class="form-group" id="password">
              <?php 
              $password = array(
                'name' => 'password',
                'for' => 'form-password',
                'class' => 'form-password form-control',
                'id' => 'password',
                'placeholder' => 'Ingrese contraseña',
                'type' => 'password'
              );?>
              <?= form_input($password) ?>
              <span class="help-inline error-message" style="color:red;"></span>
            </div>
            
            <div class="form-group form-label-group">
              <div class="form-row">
                <SELECT  name="tipo" id="tipo"  class="nav-link dropdown-toggle form-control">
                  <option value="admin">administrador</option>
                  <option value="user" selected="">usuario</option>
                  <option value="preferencial">preferencial</option>
                </SELECT>
              </div>
              <span class="help-inline error-message" style="color:red;"></span>
            </div>
            <div class="text-danger text-center" style="margin-bottom: 10px;"><?= validation_errors();?>
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
</div>

<script>
  $( document ).ready(function() {
    $('.datepicker').datepicker({
     format:'dd/mm/yyyy'
   });
  });
</script>