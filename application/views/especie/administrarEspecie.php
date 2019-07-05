<div class="col-md-12">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <center>
        <div class="text-center noPrint" style="padding: .75rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #D7CEC7;font-weight: bold;margin-bottom: 8px;" >
          Lista de Especies por Producto
        </div>
        <table class="table productoDataTable" id="printTable" style="width: 100%;">
          <thead class="card-header">
            <tr class="text-center" style="pointer-events: none;">
              <td style="display: none;">Producto</td>
              <td>Nombre</td>
              <td class="noPrint">Acciones</td>
            </tr>
          </thead>
          <tbody>
            <?php if($especies){ foreach ($especies as $prod) { ?>
              <tr>
                <td style="display: none;"><?= $prod->nombreprod; ?></td>
                <td><?= $prod->nombre; ?></td>
                <td class="noPrint">
                  <a class="btn btn-info" href="/index.php/especieController/editar/<?= $prod->id; ?>">Modificar</a>
                  <a class="btn btn-danger" href="/index.php/especieController/borrar/<?= $prod->id; ?>" >Eliminar</a>
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
  <br>
  <br>
  <div class="col-md-12">
    <button class="btn btn-primary col-md-3" onclick="printTableContent('printTable', 'Lista de especies registradas')"> Imprimir</button>
  </div>
  <br>
  <br>
</div>
