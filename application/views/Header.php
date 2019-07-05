<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Pagina principal - Aserradero</title>
  <link rel="shortcut icon" href="<?= $this->config->item('icons_folder') ?>/icono.png">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= $this->config->item('icons_folder') ?>/cortador 144x144.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= $this->config->item('icons_folder') ?>/cortador 114x114.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= $this->config->item('icons_folder') ?>/cortador 72x72.png">
  <link rel="apple-touch-icon-precomposed" href="<?= $this->config->item('icons_folder') ?>/cortador 57x57.png">
  <link rel="stylesheet" href="<?= $this->config->item('boost_min_file') ?>/bootstrap.min.css">
  <link rel="stylesheet" href="<?= $this->config->item('boost_min_file') ?>/site.css">
  <link rel="stylesheet" href="<?= $this->config->item('boost_min_file') ?>/shop-homepage.css">
  <link rel="stylesheet" href="<?= $this->config->item('boost_min_file') ?>/manu.css">
  <link rel="stylesheet" href="<?= $this->config->item('boost_min_file') ?>/fontello.css">
  <link rel="stylesheet" href="<?= $this->config->item('boost_min_file') ?>/icon-menu.css">
  <link rel="stylesheet" href="<?= $this->config->item('boost_min_file') ?>/icon-menu2.css">

  <link rel="stylesheet" href="<?= $this->config->item('boost_min_file') ?>/fontCarrito.css">
  <link rel="stylesheet" href="<?= $this->config->item('boost_min_file') ?>/carrito.css">
  
  <link href="<?= $this->config->item('font_file') ?>/solid.js">
  <link href="<?= $this->config->item('font_file') ?>/fontawesome.js">
  
  <link href="<?= $this->config->item('font_file') ?>/slim.js">
  <link rel="stylesheet" href="<?= $this->config->item('boost_min_file') ?>/font-awesome.css">
  <link rel="stylesheet" href="<?= $this->config->item('boost_min_file') ?>/jquery.dataTables.min.css">
  <script src="<?= $this->config->item('boost_jquery_file') ?>/jquery.min.js"></script>

  <link rel="stylesheet" href="<?= $this->config->item('boost_min_file') ?>/jquery-ui.css">

  <script src="<?= $this->config->item('boost_serial_file') ?>/jquery.serializejson.js"></script>
  <script src="<?= $this->config->item('boost_serial_file') ?>/underscore.js"></script>
  <script src="<?= $this->config->item('boost_serial_file') ?>/bootbox.min.js"></script>
  <script src="<?= $this->config->item('boost_serial_file') ?>/jquery.dataTables.min.js"></script>
  <script src="<?= $this->config->item('print_js') ?>/printThis.js"></script>
  <script src="<?= $this->config->item('print_js') ?>/common.js"></script>
  <script src="<?= $this->config->item('boost_serial_file') ?>/lockr.js"></script>
  <script src="<?= $this->config->item('boost_serial_file') ?>/common.js"></script>
  <script src="<?= $this->config->item('boost_serial_file') ?>/moment.js"></script>
  <script src="<?= $this->config->item('boost_serial_file') ?>/jquery-ui.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark background-primary fixed-top">
    <div class="container">
      <a class="navbar-brand" href="/index.php"><img rel="shortcut icon" src="<?= $this->config->item('img_folder') ?>/aserradero.png" style='width: 60px;margin-right: 12px;'/> <span class="background-primary-text-color">Aserradero Inc.</span></a>
      <button class="navbar-toggler navbar-toggler ml-auto hidden-sm-up float-xs-right collapsed" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="fa fa-align-justify fa-2x background-primary-text-color"></span>
      </button>
      <?php if ($showOptions == false) { ?>
        
      <?php } else { ?>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto background-primary-text-color">
            <li class="nav-item <?php if ($current === 'Home'): ?>active<?php endif; ?>">
              <a class="nav-link" href="/index.php/home/principal">Inicio
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <?php if ($username !== null): ?>
              <?php if ($type !== 'admin'): ?>
                <li class="nav-item">
                  <a class="nav-link" href="/index.php/egresosController/listar">Mis compras</a>
                </li>
              <?php endif; ?>
              <li class="nav-item">
                <a class="nav-link" href="/index.php/login/logout">Salir (<?php echo $username;?>)</a>
              </li>
              <?php else: ?>
                <li class="nav-item">
                  <a class="nav-link" href="/index.php/login/index">Ingresar</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/index.php/registrar/index">Registrate</a>
                </li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      <?php } ?>
    </nav>
    