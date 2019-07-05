<div class="col-md-12"">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <center>
        <div class="text-center noPrint" style="padding: .75rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #D7CEC7;font-weight: bold;margin-bottom: 8px;" >
          Lista de Medidas por producto
        </div>
        <table class="table productoDataTable" id="printTable" style="width: 100%">
          <thead class="card-header">
            <tr style="pointer-events: none;" class="text-center">
              <td style="display: none;">Producto</td>
              <td>Especie</td>
              <td>Largo (Mts)</td>
              <td>Espesor (Mts)</td>
              <td>Ancho (Mts)</td>
              <td>Precio de Cubicacion</td>
              <td class="text-center noPrint">Acciones</td>
            </tr>
          </thead>
          <tbody>
            <?php if($medidas){ foreach ($medidas as $prod) { ?>
             <tr>
              <td style="display: none;"><span style="font-weight: 100;">Producto: </span> <?= $prod->nombreprod; ?> <span style="font-weight: 100;">Medida:</span> <?= $prod->especieNombre; ?></td>
              <td><?= $prod->especieNombre; ?></td>
              <td><?= $prod->largo; ?></td>
              <td><?= $prod->espesor; ?></td>
              <td><?= $prod->ancho; ?></td>
              <td><?= $prod->costo; ?></td>
              <td class="noPrint">
                <a class="btn btn-info" href="/index.php/medidaController/editar/<?= $prod->id; ?>">Modificar</a>
                <a class="btn btn-danger" href="/index.php/medidaController/borrar/<?= $prod->id; ?>">Eliminar</a>
              </td>
            </tr>
          <?php } } else { ?>
            <tr>
              <td colspan="6" class="text-center">No se encontraron resultados</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </center>
  </div>
</div>
<br>
<div class="col-md-12">
  <button class="btn btn-primary col-md-3" onclick="printTableContent('printTable', 'Lista de medidas registradas')"> Imprimir
  </button>
</div>
<br>
<br>
</div>
