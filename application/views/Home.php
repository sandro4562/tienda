<div class="container" style="margin-top: 25px;">
  <div class="row">
    <div class="col-md-12" style="margin-top: 20px;">
      <div class="text-center">
        <h3 style="">Productos disponibles</h3>
      </div>
      <div class="container">
        <div class="row" style="margin-bottom: 33px;">
          <table id="productos-tabla" width="100%">
            <thead>
              <tr>
                <th style="display: none;">Nombre</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php if($productos){ foreach ($productos as $prod) { ?>
                <tr style="display: inline !important;" class="col-md-12">
                  <td style="display: none;">
                    <?= $prod->nombre; ?>
                  </td>
                  <td class="col-md-3 d-flex align-items-stretch" style="display: inline-grid !important;padding: 0px; width: 100%;">
                    <a href="/index.php/cotizacionController/detalle/<?= $prod->id; ?>" style="width: 100%; height: 100%;">
                      <div class="" style="margin-bottom: 25px;">
                        <div class="child card col-md-12" style="padding: 0px; width: 100%;">
                          <div src="/index.php/imagen/obtener/<?php echo $prod->imagen; ?>" height="100%" width= "100%" 
                            class="load-image card-img-top">
                          </div>
                          <div class="" style="width: 100%; height: 10%;">
                            <a href="/index.php/cotizacionController/detalle/<?= $prod->id; ?>">
                              <h5 class="card-title text-center"><?= $prod->nombre; ?></h5>
                            </a>
                          </div>
                        </div>
                      </div>
                    </a>
                    <br>
                    <br>
                  </td>
                <?php } } else { ?>
                  <td>
                    <div class="col-md-12 text-center" style="margin-bottom: 25px;">
                      <h3>No se encontro ningun producto</h3>
                    </div>
                  </td>
                <?php } ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active" >
            <img class="d-block img-fluid" src="/static/img/carrousel1.jpg" alt="First slide" style="width: 100%">
          </div>
          <div class="carousel-item">
            <img class="d-block img-fluid" src="/static/img/carrousel2.jpg" alt="Second slide" style="width: 100%">
          </div>
          <div class="carousel-item">
            <img class="d-block img-fluid" src="/static/img/carrousel3.jpg" alt="Third slide" style="width: 100%">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" style="width: 6%;">
          <span class="carousel-control-prev-icon" aria-hidden="true" style="height: 30px;width: 30px;background-color: sienna;border-radius: 54%;display: inline-block;"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next" style="width: 6%;">
          <span class="carousel-control-next-icon" aria-hidden="true" style="height: 30px;width: 30px;background-color: sienna;border-radius: 54%;display: inline-block;"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
  <style type="text/css">
  .dataTables_filter {
    width: 100%;
    float: left;
    text-align: left;
    margin-bottom: 10px;
  }
  .child{
    width: 100%;
  }
</style>
</div>
<script type="text/javascript">
  $(document).ready( function () {
    $('#productos-tabla').DataTable({
      "language": {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar productos:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      },
      "paging": false
    });
    $.extend( $.fn.dataTableExt.oStdClasses, {
      "sFilterInput": "form-control",
      "sLengthSelect": "form-control"
    });
    var cw = $('.child').width();
    $('.child').css({
      'height': cw + 'px'
    });
  });
</script>
