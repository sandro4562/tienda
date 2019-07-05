<?php if(is_array($usuarios) && count($usuarios) > 0) {  ?>
  <div class="col-md-12"">
    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Editar Usuario</div>
        <div class="card-body">
          <form class="needs-validation" id="registrarFormulario" action="/index.php/usuariosController/actualizar/<?php echo $id?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" >
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-3">
                  <div class="form-label-group">
                    <label for="nombre">Nombre: </label>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-label-group">
                    <input name="nombre" type="text" id="nombre" class="form-control" placeholder="Ingresar nombre" autofocus="autofocus" value="<?php if($usuarios) echo $usuarios[0]->nombre; ?>">
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
                    <input name="correo" type="text" id="correo" class="form-control" readonly autofocus="autofocus" value="<?php if($usuarios) echo $usuarios[0]->correo; ?>">
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
                    <input name="password" type="text" id="password" class="form-control" autofocus="autofocus" value="<?php if($usuarios) echo $usuarios[0]->password; ?>">
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
                  <SELECT  name="tipo" id="tipo"  class="nav-link dropdown-toggle form-control" >
                    <option value="administrador" <?php if ("admin" == $usuarios[0]->rol): ?> selected <?php endif; ?>>administrador</option>
                    <option value="usuario" <?php if ("user" == $usuarios[0]->rol): ?> selected <?php endif; ?>>usuario</option>
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
<script>
  $( document ).ready(function() {
    $.datepicker.regional['es'] = {
      closeText: 'Cerrar',
      prevText: '< Ant',
      nextText: 'Sig >',
      currentText: 'Hoy',
      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
      dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
      dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
      dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
      weekHeader: 'Sm',
      dateFormat: 'yy-mm-dd',
      firstDay: 1,
      isRTL: false,
      showMonthAfterYear: false,
      yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $(".datepickerYears").datepicker({
      dateFormat: 'yy-mm-dd',
      maxDate: '-18y',
      changeYear: true,
      yearRange: "-90:+0"
    }).attr('readonly', 'readonly');
    $('.datepicker').datepicker({
      format:'dd/mm/yyyy'
    });
  });
</script>
