<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pagina de logeo</title>
  <link rel="stylesheet" href="<?= $this->config->item('boost_min_file') ?>/bootstrap.min.css">
  <link rel="stylesheet" href="<?= $this->config->item('boost_min_file') ?>/font-awesome.css">
  <link rel="stylesheet" href="<?= $this->config->item('boost_min_file') ?>/form-elements.css">
  <link rel="stylesheet" href="<?= $this->config->item('boost_min_file') ?>/style.css">
  <link rel="stylesheet" href="<?= $this->config->item('boost_min_file') ?>/site.css">
  <link rel="shortcut icon" href="<?= $this->config->item('icons_folder') ?>/icono.png">
  
  <link rel="stylesheet" href="<?= $this->config->item('boost_min_file') ?>/jquery-ui.css">


  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= $this->config->item('icons_folder') ?>/cortador 144x144.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= $this->config->item('icons_folder') ?>/cortador 114x114.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= $this->config->item('icons_folder') ?>/cortador 72x72.png">
  <link rel="apple-touch-icon-precomposed" href="<?= $this->config->item('icons_folder') ?>/cortador 57x57.png">
</head>
<body>
  <div class="top-content">
    <div class="inner-bg">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-offset-3 text" style="display: block; margin-left: auto; margin-right: auto;">
            <div class="form-top">
              <div class="form-top">
                <div style="margin-top: 20px;">
                  <div class="text-center" style="color: #6b4329;">
                    <h4>
                      Registrate
                    </h4>
                  </div>
                  <div class="text-center" style="color: #6b4329;margin-top: 20px;margin-bottom: 20px;">
                    Para continuar por favor rellena el siguiente formulario.
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-sm-offset-2 form-box" style="display: block; margin-left: auto; margin-right: auto;">
           <div class="form-top">
            <div style="margin-top: 20px;">
              <div class="text-center" style="color: #6b4329;">
                <h4>
                  <i class="fa fa-key" style="margin-right: 10px;"></i>
                  Formulario de registro
                </h4>
              </div>
              <div class="text-center" style="color: #6b4329;margin-top: 20px;margin-bottom: 20px;">
                Llene el siguiente formulario:
              </div>
            </div>
            <form role="form" action="recibirdatos" method="post" class="needs-validation-password register-form" id="registerFormulario">
              <div class="form-bottom">
                <?= form_open('registrar/recibirdatos'); ?>
                <div class="form-group" id="nombre">
                  <div class="input-container">
                    <i class="fa fa-user icon"></i>
                    <?php
                    $nombre = array(
                      'name' => 'nombre',
                      'for' => 'form-username',
                      'class' => 'form-username form-control',
                      'id' => 'nombre',
                      'placeholder' => 'Ingrese su nombre'
                    );?>
                    <?= form_input($nombre,@set_value('nombre')) ?>
                  </div>
                  <span class="help-inline error-message" style="color:red;"></span>
                </div>
                <div class="form-group" id="fecha">
                  <div class="input-container">
                    <i class="fa fa-calendar icon"></i>
                    <input type="text" name="fecha" class="datepickerYears form-control" placeholder="Seleccione su fecha de nacimiento">
                  </div>
                  <span class="help-inline error-message" style="color:red;"></span>
                </div>
                <div class="form-group" id="correo">
                  <div class="input-container">
                    <i class="fa fa-envelope icon"></i>
                    <?php 
                    $correo = array(
                      'name' => 'correo',
                      'for' => 'form-username',
                      'class' => 'form-username form-control',
                      'id' => 'correo',
                      'placeholder' => 'Ingrese su correo'
                    );?>
                    <?= form_input($correo,@set_value('correo')) ?>
                  </div>
                  <span class="help-inline error-message" style="color:red;"></span>
                </div>
                <div class="form-group" id="password">
                  <div class="input-container">
                    <i class="fa fa-key icon"></i>
                    <?php 
                    $password = array(
                      'name' => 'password',
                      'for' => 'form-password',
                      'class' => 'form-password form-control',
                      'id' => 'password',
                      'placeholder' => 'Ingrese su contraseña',
                      'type' => 'password'
                    );?>
                    <?= form_input($password) ?>
                  </div>
                  <span class="help-inline error-message" style="color:red;"></span>
                </div>
                <div class="form-group" id="confirm-password">
                  <div class="input-container">
                    <i class="fa fa-key icon"></i>
                    <input type="password" name="confirm-password" value="" for="form-confirm-password" class="form-password form-control" id="confirm-password" placeholder="Ingrese de nuevo su contraseña" onkeyup="passwordValido()">
                  </div>
                  <span class="help-inline error-message" style="color:red;"></span>
                </div>
                <div class="form-group" id="num_celular">
                  <div class="input-container">
                    <i class="fa fa-mobile icon"></i>
                    <?php
                    $num_celular = array(
                      'name' => 'num_celular',
                      'for' => 'form-password',
                      'class' => 'form-password form-control',
                      'id' => 'num_celular',
                      'placeholder' => 'Ingrese su número de celular'
                    );
                    ?>
                    <?= form_input($num_celular,@set_value('num_celular')) ?>
                  </div>
                  <span class="help-inline error-message" style="color:red;"></span>
                </div>
                <div class="col-md-12">
                  <div class="text-center">
                    <button class="btn btn-primary col-md-8" type="submit">Registrarse</button> 
                  </div>
                </div>
                <div class="text-danger text-center" style="margin-bottom: 10px;"><?= validation_errors();?></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?= $this->config->item('boost_serial_file') ?>/jquery-1.11.1.min.js"></script>
  <script src="<?= $this->config->item('boost_serial_file') ?>/jquery.serializejson.js"></script>
  <script src="<?= $this->config->item('boost_serial_file') ?>/underscore.js"></script>
  <script src="<?= $this->config->item('boost_serial_file') ?>/bg-responsive.js"></script>
  <script src="<?= $this->config->item('boost_serial_file') ?>/bootstrap.min.js"></script>
  <script src="<?= $this->config->item('boost_serial_file') ?>/jquery.backstretch.min.js"></script>
  <script src="<?= $this->config->item('boost_serial_file') ?>/jquery-ui.js"></script>
  <script src="<?= $this->config->item('boost_serial_file') ?>/validation.js"></script>
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
    });
  </script>
</body>
</html>