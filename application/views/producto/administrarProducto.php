<div class="col-md-12">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <center>
        <table class="table" id="productosTable">
          <thead class="card-header noPrint">
            <tr>
              <th colspan="12" class="text-center">Lista de Productos</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Imagen</th>
              <th scope="col">Precio</th>
              <th scope="col" class="noPrint">Acciones</th>
            </tr>
            <?php if($productos){ foreach ($productos as $prod) { ?>
              <tr>
                <td><?= $prod->nombre; ?></td>
                <td><div src="/index.php/imagen/obtener/<?= $prod->imagen; ?>" width="100" class="load-image"></div></td>
                <td><?= $prod->precio; ?></td>
                <td class="noPrint">
                  <a class="btn btn-info" href="/index.php/producto/editar/<?= $prod->id; ?>">Modificar</a>
                  <a class="btn btn-danger btn-sm eliminar-item id" href="/index.php/producto/borrar/<?= $prod->id; ?>" data-idp="<?= $prod->id; ?>">Eliminar</a>
                </td>
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
  <br>
  <div class="col-md-12">
    <button class="btn btn-primary col-md-3" onclick="printTableContent('productosTable', 'Lista de productos registrados')"> Imprimir</button>
  </div>
  <br>
  <br>
</div>
<script type="text/javascript">
 /*$(document).ready(function(){
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
    debugger;
    var id = $('.id').data('idp');
    $.ajax({
      type: "POST",
      url: "/index.php/producto/borrarProductoAjax/"+id, 
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
});*/
</script>