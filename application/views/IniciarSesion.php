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
              <div style="margin-top: 20px;">
                <div class="text-center" style="color: #6b4329;">
                  <h4>
                    Bienvenido
                  </h4>
                </div>
                <div class="text-center" style="color: #6b4329;margin-top: 20px;margin-bottom: 20px;">
                  ¿No tienes una cuenta? registrate: <a href="/index.php/registrar/index"><Strong style="color: #6b4329;text-decoration: underline;">Regístrate</Strong></a>
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
                  <i class="fa fa-user" style="margin-right: 10px;"></i>
                  Inicia sesion
                </h4>
              </div>
              <div class="text-center" style="color: #6b4329;margin-top: 20px;margin-bottom: 20px;">
                Ingresa tu correo electronico y contraseña para acceder:
              </div>
            </div>
            <form role="form" action="/index.php/login/indexPOST" method="post" class="needs-validation login-form" id="loginFormulario">
              <div class="form-bottom">
                <div class="form-group">
                  <div class="input-container">
                    <i class="fa fa-user icon"></i>
                    <label class="sr-only" for="form-username">Correo electronico</label>
                    <input type="text" name="form-username" placeholder="Correo electronico..." class="form-username form-control" id="form-username" value="<?php if ($hasError === true): ?><?php echo $email;?><?php endif; ?>">
                  </div>
                  <span class="help-inline error-message" style="color:red;"></span>
                </div>
                <div class="form-group">
                  <div class="input-container">
                    <i class="fa fa-key icon"></i>
                    <label class="sr-only" for="form-password">Contraseña</label>
                    <input type="password" name="form-password" placeholder="Contraseña..." class="form-password form-control" id="form-password">
                  </div>
                  <span class="help-inline error-message" style="color:red;"></span>
                </div>
                <?php if ($hasError === true): ?>
                  <div class="text-danger text-center" style="margin-bottom: 10px;"><?php echo $message;?></div>
                <?php endif; ?>
                <div class="col-md-12">
                  <div class="text-center">
                    <button class="btn btn-primary col-md-8" type="submit">Ingresar</button> 
                  </div>
                </div>
              </div>
            </form>
          </div>
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
<script src="<?= $this->config->item('boost_serial_file') ?>/validation.js"></script>
</body>
</html>