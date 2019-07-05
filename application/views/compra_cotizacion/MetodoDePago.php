<div class="container">
 <div class="row col-md-12" style="margin-top: 43px;">
  <table id="cart" class="table table-hover table-condensed" style="background-color: ghostwhite;">
   <thead>
    <tr class="text-center">
     <th style="width:70%">Producto</th>
     <th></th>
     <th style="width:10%">Cantidad</th>
     <th style="width:10%">Precio unitario</th>
     <th style="width:10%">Total</th>
    </tr>
   </thead>
   <tbody>
    <?php $precioTotal = 0; ?>
    <?php if($cotizaciones) { ?>
     <?php foreach ($cotizaciones as $prod) { ?>
      <tr>
       <td data-th="Product" class="product-item" colspan="2" data-product-id="<?= $prod->prodid; ?>" data-product-name="<?= $prod->nombreprod; ?>" data-product-price="<?= $prod->precioDescuento / $prod->cantidad; ?>" data-product-quantity="<?= $prod->cantidad; ?>" data-cotizazion-id="<?= $prod->cotid; ?>">
        <div class="row">
         <div class="col-md-4">
          <div src="/index.php/imagen/obtener/<?php echo $prod->imagen ?>" width="60%" class="load-image"></div>
         </div>
         <div class="col-md-8">
          <h6 class="nomargin">Producto: <?= $prod->nombreprod; ?></h6>
         </div>
        </div>
       </td>
       <td><?= $prod->cantidad; ?></td>
       <td><?= number_format($prod->precioDescuento / $prod->cantidad,2,",",".") ; ?></td>
       <td><?= $prod->precioDescuento ?></td>
       <?php $precioTotal += $prod->precioDescuento; ?>
      </tr>
     <?php } ?>
    <?php } else { ?>
     <div class="col-md-10">
      <h4 class="nomargin">No hay Cotizaciones</h4>
     </div>
    <?php } ?>
   </tbody>
   <tfoot>
    <tr>
     <td class="text-center" colspan="2"></td>
     <td class="text-center" colspan="2"></td>
     <td class="text-center"><strong>Total <?= $precioTotal; ?></strong></td>
    </tr>
    <tr>
     <td></td>
     <td colspan="3" class="hidden-xs">Realizar pago con: </td>
     <td>
      <div class="boton-container">
        <div id="loader-container" style="margin-left: 80px;margin-right: 88px;">
          Cargando
          <div class="loader" style="margin-left: 25px;"></div>
        </div>
        <div id="boton-de-pago" style="display: none;"></div>
      </div>
      </td>
    </tr>
   </tfoot>
  </table>
 </div>
</div>
<script src="<?= $this->config->item('boost_serial_file') ?>/paypal.js"></script>
<script src="<?= $this->config->item('boost_serial_file') ?>/pagoPaypal.js"></script>
<style type="text/css">
  .loader {
    border: 7px solid #f3f3f3;
    border-top: 7px solid #3498db;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    animation: spin 2s linear infinite;
  }
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
</style>
<script type="text/javascript">
  $(window).on('load', function(){
    setTimeout(function () {
      $("#loader-container").hide();
      $("#boton-de-pago").show();
    }, 1000);
  });
</script>