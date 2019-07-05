<div class="col-md-12"">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <center>
        <div class="text-center noPrint" style="padding: .75rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #D7CEC7;font-weight: bold;margin-bottom: 8px;" >
          Detalle de compra del cliente: <?= $user[0]->nombre; ?>
        </div>
        <table class="table" id="printTable" style="width: 100%;">
          <thead class="card-header">
            <tr class="text-center">
              <th>Nº Venta</th>
              <th>Productos</th>
              <th>Precio Unitario</th>
              <th>Cantidad</th>
              <th>Fecha</th>
              <th>Costo total</th>
            </tr>
          </thead>
          <?php $total = 0 ?>
          <?php $tamaño = sizeof($detalles)/15; ?>
          <tbody>
            <?php if($pagos){ foreach ($pagos as $prod) { ?>
              <tr id="test">
                <td rowspan="<?php echo $tamaño+1;?>"><?= $prod->id; ?></td>
                <?php $cont = 0; ?>
                <?php for ($i = 0; $i < $tamaño; $i++) { ?>
                  <tr>
                    <td><?= $detalles[1+$cont]; ?></td>
                    <td><?= $detalles[5+$cont]*6.96;?></td>
                    <td><?= $detalles[9+$cont]; ?></td>
                    <?php if($i==0){?>
                      <td rowspan="<?php echo $tamaño; ?>" class="formatDate"><?= $prod->create_time; ?></td>
                      <td rowspan="<?php echo $tamaño; ?>" class="formatTwoDecimals"><?= $prod->monto_total * 6.96; ?></td>
                    <?php } ?>
                    <?php $cont += 15; } ?>
                    <?php $total += $prod->monto_total ?>
                  </tr>
                </tr>
              <?php } ?>
              <tr>
                <th colspan="5" class="text-right">Total compra: </th>
                <th colspan="1" class="text-center formatTwoDecimals"><?php echo $total *6.96 ?> Bs</th>
              </tr>
            <?php } else { ?>
              <tr>
                <td colspan="9" class="text-center">No se encontraron resultados</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </center>
    </div>
    <div style="margin-top: 20px;">
      <button class="btn btn-primary col-md-3" onclick="printTableContent('printTable', 'Detalle de compra')"> Imprimir
      </button>
    </div>
  </div>
  <br>
</div>