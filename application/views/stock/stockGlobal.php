<div class="col-md-12">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <center>
        <table class="table">
          <thead class="card-header">
            <tr>
              <th colspan="8">Lista de Productos</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="col">Producto</th>
              <th scope="col">Imagen</th>
              <th scope="col">Ingresos</th>
              <th scope="col">Egresos</th>
              <th scope="col">Total</th>
            </tr>
              <tr>
                <?php if($stock){ foreach ($stock as $prod) { ?>
                <td><?= $prod->nombreprod; ?></td>
                <td><div src="/index.php/imagen/obtener/<?= $prod->imagen; ?>" width="100" class="load-image"></div></td>
                <td><?= $prod->ingreso; ?></td>
                <td><?= $prod->egreso; ?></td>
                <td>0</td>
              </tr>
              <?php } } else { ?>
            <tr>
              <td colspan="9" class="text-center">No se encontraron resultados</td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </center>
    </div>
  </div>
</div>
<script type="text/javascript">
 $(document).ready(function(){
  $(".close").click(function(){
   $("#myAlert").alert("close");
 });
  $(".eliminar-item").click(function(){
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
      url: "/index.php/producto/borrarProductoAjax/<?= $prod->id; ?>", 
      dataType: "text",  
      cache:false,

      data:{
      },
      success: function(data,statusTest,xhr){
        if(xhr.status == 206) {
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