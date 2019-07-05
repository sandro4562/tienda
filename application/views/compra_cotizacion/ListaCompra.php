<div class="container" style="margin-top: 25px;">
  <nav class=" nav-item dropdown navbar navbar-expand-md navbar-dark bg-light background-quinary" style="margin-top: 35px;">
    <div id="dropdown1" data-toggle="dropdown" class="ml-auto float-right">
      <button type="button" class="btn btn-default background-secondary" aria-label="Left Align">
        <div style="display: table;" class="background-secondary-text-color">
          <span style="display: table-cell;vertical-align: middle;padding-right: 10px;">Carrito de compras: </span>
          <i class="fa fa-shopping-cart fa-2x"></i>
        </div>
      </button>
    </div>
    <ul class="dropdown-menu col-md-12" aria-labelledby="dropdown1" style="margin: 0px;padding: 0px;">  
      <table id="cart" class="table table-hover table-condensed table-bordered" style="margin: 0px;background-color: ghostwhite!important;">
        <thead>
          <tr class="text-center">
            <th style="width:70%">Producto</th>
            <th style="width:10%">Cantidad</th>
            <th style="width:10%">Precio Unitario</th>
            <th style="width:10%">Precio Total</th>
            <th style="width:10%">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <?php $index = 0; ?>
          <?php if($cotizaciones) { ?>
            <?php foreach ($cotizaciones as $prod) { ?>
              <?php if($index < 3) { ?>
                <tr id="cotizacion-<?= $prod->cotid; ?>">
                  <td data-th="Product">
                    <div class="row">
                      <div class="col-md-4">
                        <div src="/index.php/imagen/obtener/<?php echo $prod->imagen ?>" width="60%" class="load-image"></div>
                      </div>
                      <div class="col-md-8" style="font-size: 14px;">
                        <div class="nomargin">Producto: <?= $prod->nombreprod; ?></div>
                        <div class="nomargin">Especie: <?= $prod->nombreesp; ?></div>
                        <div class="nomargin">Cepillado:<?= $prod->caras; ?></div>
                        <div class="nomargin">Espesor: <?= $prod->espesor; ?></div>
                        <div class="nomargin">Ancho: <?= $prod->ancho; ?></div>
                        <div class="nomargin">Largo: <?= $prod->largo; ?></div>
                      </div>
                    </div>
                  </td>
                  <td style="font-size: 14px;"><?= $prod->cantidad; ?></td>
                  <td style="font-size: 14px;"><?= number_format($prod->precioDescuento / $prod->cantidad,2,",",".") ;?></td>
                  <td style="font-size: 14px;"><?= $prod->precioDescuento; ?></td>
                  <td class="actions" data-th="" style="font-size: 14px;">
                    <a class="btn btn-danger btn-sm eliminar-item col-md-6" data-id="<?= $prod->cotid; ?>">
                      <i class="fa fa-trash-o" style="color: white;"></i>
                    </a>
                  </td>
                </tr>
              <?php } ?>
              <?php $index = $index + 1; ?>
            <?php } ?>
            <?php if ($index > 3) { ?>
              <tr>
                <td colspan="4">Haga click en Ver mas detalles para ver todo su carrito.</td>
              </tr>
            <?php } ?>
            <tr>
              <td colspan="4">
                <a type="button" class="btn btn-default background-secondary float-right" aria-label="Left Align" style="margin-left: 10px;" href="/index.php/cotizacionController/carrito">
                  <div style="display: table;" class="background-secondary-text-color">
                    <span style="display: table-cell;vertical-align: middle;padding-right: 10px;">Ver mas detalles</span>
                    <i class="fa fa-angle-double-right fa-1x"></i>
                  </div>
                </a>
                <a type="button" class="btn btn-default background-secondary float-right" aria-label="Left Align" href="/index.php/cotizacionController/metodoPago">
                  <div style="display: table;" class="background-secondary-text-color">
                    <span style="display: table-cell;vertical-align: middle;padding-right: 10px;">Proceder al pago</span>
                    <i class="fa fa-credit-card fa-1x"></i>
                  </div>
                </a>
              </td>
            </tr>
          <?php } else { ?>
            <tr>
              <td colspan="4">No hay elementos en su carro.</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </ul>
  </nav>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $(".close").click(function(){
      $("#myAlert").alert("close");
    });
    $(".eliminar-item").click(function(el){
      var data = $(el.target).data();
      bootbox.confirm({
        message: "Esta seguro de eliminarlo?",
        buttons: {
          confirm: {
            label: 'Si',
            className: 'btn-success'
          },
          cancel: {
            label: 'No',
            className: 'btn-danger'
          }
        },
        callback: function (result) {
          if(result) {
            $.ajax({
              type: "POST",
              url: "/index.php/cotizacionController/borrarAjax/" + data.id, 
              dataType: "json",  
              cache:false,
              data:{},
              success: function(data,statusTest,xhr){
                if(xhr.status == 200) {
                  location.reload();
                }
              }
            });
          }
        }
      });
    });
    $("#dropdown1").parent().find("ul.dropdown-menu").on('click', function (e) {
      e.stopPropagation();
    });
  });
</script>