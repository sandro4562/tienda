<div class="col-md-12">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <center>
        <table class="table">
          <thead class="card-header">
            <tr>
              <th colspan="3">Editar stock por producto</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Imagen</th>
              <th scope="col">Acciones</th>
            </tr>
            <?php if($productos){ foreach ($productos as $prod) { ?>
              <tr>
                <td><?= $prod->nombre; ?></td>
                <td><div src="/index.php/imagen/obtener/<?= $prod->imagen; ?>" width="100" class="load-image"></div></td> 
                <td>
                  <a class="btn btn-info" href="/index.php/stockController/listarPorProducto/<?= $prod->id; ?>">Editar</a>
                </td>
              </tr>
            <?php } } else { ?>
              <tr>
                <td colspan="3" class="text-center">No se encontraron resultados</td>
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
