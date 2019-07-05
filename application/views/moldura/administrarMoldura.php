<div class="col-md-12"">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="text-center noPrint" style="padding: .75rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #D7CEC7;font-weight: bold;margin-bottom: 8px;" >
        Lista de Molduras por producto
      </div>
      <center>
        <table class="table productoDataTable" id="printTable" style="width: 100%">
          <thead class="card-header">
            <tr class="text-center" style="pointer-events: none;">
              <td style="display: none;">Producto</td>
              <td>Imagen</td>
              <td>Costo</td>
              <td class="noPrint">Acciones</td>
            </tr>
          </thead>
          <tbody>
            <?php if($molduras){ foreach ($molduras as $prod) { ?>
              <tr>
                <td style="display: none;"><?= $prod->nombreprod; ?></td>
                <td>
                  <div src="/index.php/imagen/obtener/<?php echo $prod->imagen; ?>" width="100" class="load-image"></div>
                </td>
                <td><?= $prod->costo; ?></td>
                <td class="noPrint">
                  <button class="btn btn-info"> <a href="/index.php/molduraController/editar/<?= $prod->id; ?>">Modificar</a></button>
                  <button class="btn btn-danger"> <a href="/index.php/molduraController/borrar/<?= $prod->id; ?>">Eliminar</a></button>
                </td>
              </tr>
            <?php }} else { ?>
              <tr>
                <td colspan="4" class="text-center">No se encontraron resultados</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </center>
    </div>
  </div>
  <br>
  <br>
  <div class="col-md-12">
    <button class="btn btn-primary col-md-3" onclick="printTableContent('printTable', 'Lista de molduras registradas')"> Imprimir
    </button>
  </div>
  <br>
  <br>
</div>