<div class="container">
 <div class="row col-md-12" style="margin-top: 43px;background-color: ghostwhite;">
  <table id="cart" class="table table-hover table-condensed" style="width: 100%;">
   <thead>
    <tr class="d-flex text-center">
     <th class="col-4">Producto</th>
     <th class="col-2">Cantidad</th>
     <th class="col-2">Precio Unitario</th>
     <th class="col-2">Precio Total</th>
     <th class="col-2"><span class="noPrint">Opciones</span></th>
   </tr>
 </thead>
 <tbody>
  <?php $Total = 0; ?>
  <?php $precioTotal = 0; ?>
  <?php if($cotizaciones) { ?>
   <?php foreach ($cotizaciones as $prod) { ?>
    <tr class="d-flex">
      <td data-th="Product" class="col-4">
        <div class="row">
          <div class="col-12 text-center" style="font-size: 14px;text-align: center;">
            <div style="margin-bottom: 8px;">
              <div src="/index.php/imagen/obtener/<?php echo $prod->imagen ?>" width="100%" class="load-image">
              </div>
            </div>
            <div class="nomargin" style="text-align: center;">Producto: <?= $prod->nombreprod; ?></div>
            <div class="nomargin" style="text-align: center;">Especie: <?= $prod->nombreesp; ?></div>
            <div class="nomargin" style="text-align: center;">Cepillado:<?= $prod->caras; ?></div>
            <div class="nomargin" style="text-align: center;">Espesor: <?= $prod->espesor; ?></div>
            <div class="nomargin" style="text-align: center;">Ancho: <?= $prod->ancho; ?></div>
            <div class="nomargin" style="text-align: center;">Largo: <?= $prod->largo; ?></div>
          </div>
        </div>
      </td>
      <td class="col-2" style="font-size: 14px;"><?= $prod->cantidad; ?></td>
      <td class="col-2" style="font-size: 14px;"><?= number_format($prod->precioDescuento / $prod->cantidad,2,",",".") ;?></td>
      <td class="col-2" style="font-size: 14px;"><?= $prod->precioDescuento ?></td>
      <?php $precioTotal += $prod->precioDescuento; ?>
      <td class="col-2 actions" style="font-size: 14px;">
        <a class="btn btn-danger btn-sm eliminar-item col-md-6 noPrint" data-id="<?= $prod->cotid; ?>">
          <i class="fa fa-trash-o" style="color: white;"></i>
        </a>                
      </td>
    </tr>
  <?php } ?>
<?php } else { ?>
 <div class="col-md-10">
  <h4 class="nomargin">No hay Cotizaciones</h4>
</div>
<?php } ?>
</tbody>
<tfoot>
  <tr class="d-flex">
   <td class="text-center col-8"></td>
   <td class="text-center col-2"><strong>Total <?= $precioTotal; ?></strong></td>
   <td class="text-center col-2"></td>
 </tr>
 <tr class="d-flex noPrint">
  <td class="hidden-xs text-center col-3">
    <a onclick="printTableContent('cart', 'Lista de cepillados registrados')" class="btn background-secondary background-secondary-text-color"><i class="fa fa-print"></i> Imprimir</a>
  </td>
  <td class="hidden-xs text-center col-3 noPrint">
    <a style="width: 100%;" href="/index.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Volver</a>
  </td>
  <td class="col-4 noPrint">
    <a style="width: 100%;" href="/index.php/cotizacionController/metodoPago" class="btn btn-success btn-block">Pagar <i class="fa fa-angle-right"></i></a>
  </td>
  <td class="col-2 noPrint"></td>
</tr>
</tfoot>
</table>
</div>
</div>
<script type="text/javascript">
 $(document).ready(function(){
  $(".close").click(function(){
   $("#myAlert").alert("close");
 });
  $(".eliminar-item").click(function(el){
    var dir = "/index.php/cotizacionController/borrarAjax/";
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
        url: dir + data.id, 
        dataType: "text",  
        cache:false,
        data:{
        },
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