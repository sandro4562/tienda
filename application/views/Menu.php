</nav>
<div class="wrapper">
 <nav class="navbar-black background-secondary" id="sidebar" style="min-height: 100vh">
    <hr>
    <div class="sidebar-header background-secondary" style="padding: 0px;">
        <h4 class="icon">Administracion</h4>
    </div>
    <ul class="list-unstyled background-secondary" id="asserradero-sidebar-menu">
        <li class="">
            <a class="background-secondary" href="#Producto" data-toggle="collapse" aria-expanded="false">Producto</a>
            <ul class="<?php if ($expanded === 'Producto'): ?>list-unstyled collapse show<?php else: ?>collapse list-unstyled<?php endif; ?>" id="Producto">
                <li><a href="<?= $this->config->item('base_ulr') ?>/index.php/producto/registrar" class="background-primary background-primary-text-color">Crear Producto</a></li>
                <li><a href="<?= $this->config->item('base_ulr') ?>/index.php/producto/listar" class="background-primary background-primary-text-color">Reportes / Administrar</a></li>
            </ul>
        </li>
        <li class="">
            <a class="background-secondary" href="#especie" data-toggle="collapse" aria-expanded="false">Clientes</a>
            <ul class="<?php if ($expanded === 'Especie'): ?>list-unstyled collapse show<?php else: ?>collapse list-unstyled<?php endif; ?>" id="especie">
                <li><a href="<?= $this->config->item('base_ulr') ?>/index.php/clienteController/index" class="background-primary background-primary-text-color">Crear nuevo Cliente</a></li>
                <li><a href="<?= $this->config->item('base_ulr') ?>/index.php/clienteController/listar" class="background-primary background-primary-text-color">Administrar Clientes</a></li>
            </ul>
        </li>
        <li class="">
            <a class="background-secondary" href="#Medidas" data-toggle="collapse" aria-expanded="false">Medidas</a>
            <ul class="<?php if ($expanded === 'Medida'): ?>list-unstyled collapse show<?php else: ?>collapse list-unstyled<?php endif; ?>" id="Medidas">
                <li><a href="<?= $this->config->item('base_ulr') ?>/index.php/medidaController/registrar" class="background-primary background-primary-text-color">Crear Medidas</a></li>
                <li><a href="<?= $this->config->item('base_ulr') ?>/index.php/medidaController/listar" class="background-primary background-primary-text-color">Reportes / Administrar</a></li>
            </ul>
        </li>
        <li class="">
            <a class="background-secondary" href="#Cepillado" data-toggle="collapse" aria-expanded="false">Cepillado<i class="fas fa-caret-square-down"></i></a>
            <ul class="<?php if ($expanded === 'Cepillado'): ?>list-unstyled collapse show<?php else: ?>collapse list-unstyled<?php endif; ?>" id="Cepillado">
                <li><a href="<?= $this->config->item('base_ulr') ?>/index.php/cepilladoController/registrar" class="background-primary background-primary-text-color">Crear Cepillado</a></li>
                <li><a href="<?= $this->config->item('base_ulr') ?>/index.php/cepilladoController/listar" class="background-primary background-primary-text-color">Reportes / Administrar</a></li>
            </ul>
        </li>
        <li class="">
            <a class="background-secondary" href="#Moldura" data-toggle="collapse" aria-expanded="false">Moldura</a>
            <ul class="<?php if ($expanded === 'Moldura'): ?>list-unstyled collapse show<?php else: ?>collapse list-unstyled<?php endif; ?>" id="Moldura">
                <li><a href="<?= $this->config->item('base_ulr') ?>/index.php/molduraController/registrar" class="background-primary background-primary-text-color">Crear Moldura</a></li>
                <li><a href="<?= $this->config->item('base_ulr') ?>/index.php/molduraController/listar" class="background-primary background-primary-text-color">Reportes / Administrar</a></li>
            </ul>
        </li>
        <li class="">
            <a class="background-secondary" href="#Tallado" data-toggle="collapse" aria-expanded="false">Tallado</a>
            <ul class="<?php if ($expanded === 'Tallado'): ?>list-unstyled collapse show<?php else: ?>collapse list-unstyled<?php endif; ?>" id="Tallado">
                <li><a href="<?= $this->config->item('base_ulr') ?>/index.php/talladoController/registrar" class="background-primary background-primary-text-color">Crear Tallado</a></li>
                <li><a href="<?= $this->config->item('base_ulr') ?>/index.php/talladoController/listar" class="background-primary background-primary-text-color">Reportes / Administrar</a></li>
            </ul>
        </li>
        <li class="">
            <a class="background-secondary" href="#Stock" data-toggle="collapse" aria-expanded="false">Stock</a>
            <ul class="<?php if ($expanded === 'Stock'): ?>list-unstyled collapse show<?php else: ?>collapse list-unstyled<?php endif; ?>" id="Stock">
                <li><a href="<?= $this->config->item('base_ulr') ?>/index.php/stockController/registarStockProducto" class="background-primary background-primary-text-color">Ingresos / Egresos</a></li>
                <li><a href="<?= $this->config->item('base_ulr') ?>/index.php/stockController/listarStockProducto" class="background-primary background-primary-text-color">Reportes / Administrar</a></li>
            </ul>
        </li>
        <li class="">
            <a class="background-secondary" href="#Notificacion" data-toggle="collapse" aria-expanded="false">Notif. de entregas</a>
            <ul class="<?php if ($expanded === 'Notificacion'): ?>list-unstyled collapse show<?php else: ?>collapse list-unstyled<?php endif; ?>" id="Notificacion">
                <li>
                    <a href="<?= $this->config->item('base_ulr') ?>/index.php/notificacionController/pendientes" class="background-primary background-primary-text-color">Pendientes</a>
                </li>
                <li>
                    <a href="<?= $this->config->item('base_ulr') ?>/index.php/notificacionController/produccion" class="background-primary background-primary-text-color">En Produccion</a>
                </li>
                <li>
                    <a href="<?= $this->config->item('base_ulr') ?>/index.php/notificacionController/entregado" class="background-primary background-primary-text-color">Entregado</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a class="background-secondary" href="#Egresos" data-toggle="collapse" aria-expanded="false">Reportes</a>
            <ul class="<?php if ($expanded === 'Reportes'): ?>list-unstyled collapse show<?php else: ?>collapse list-unstyled<?php endif; ?>" id="Egresos">
                <li><a href="<?= $this->config->item('base_ulr') ?>/index.php/egresosController/listar" class="background-primary background-primary-text-color">Egresos de paypal</a></li>
                <li><a href="<?= $this->config->item('base_ulr') ?>/index.php/egresosController/ingresos" class="background-primary background-primary-text-color">Estadísticas</a></li>
            </ul>
        </li>
        <li class="">
            <a class="background-secondary" href="#Usuarios" data-toggle="collapse" aria-expanded="false">Usuarios</a>
            <ul class="<?php if ($expanded === 'Usuarios'): ?>list-unstyled collapse show<?php else: ?>collapse list-unstyled<?php endif; ?>" id="Usuarios">
                <li><a href="<?= $this->config->item('base_ulr') ?>/index.php/usuariosController/index" class="background-primary background-primary-text-color">Crear nuevo usuario</a></li>
                <li><a href="<?= $this->config->item('base_ulr') ?>/index.php/usuariosController/listar" class="background-primary background-primary-text-color">Administrar usuarios</a></li>
            </ul>
        </li>
        <li class="">
            <a class="background-secondary" href="#Usuarios" data-toggle="collapse" aria-expanded="false">Clientes</a>
            <ul class="<?php if ($expanded === 'Clientes'): ?>list-unstyled collapse show<?php else: ?>collapse list-unstyled<?php endif; ?>" id="Clientes">
                <li><a href="<?= $this->config->item('base_ulr') ?>/index.php/clienteController/index" class="background-primary background-primary-text-color">Crear nuevo Cliente</a></li>
                <li><a href="<?= $this->config->item('base_ulr') ?>/index.php/clienteController/listar" class="background-primary background-primary-text-color">Administrar Clientes</a></li>
            </ul>
        </li>
    </ul>
</nav>
<script type="text/javascript">
    $(document).ready(function(){
        $('#asserradero-sidebar-menu li').on('show.bs.collapse', function () {
            $('#asserradero-sidebar-menu li').find('.collapse').collapse("hide");
        });
    });
</script>
<div class="container">