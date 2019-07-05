<div class="col-md-12"">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <center>
        <div class="text-center noPrint" style="padding: .75rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #D7CEC7;font-weight: bold;margin-bottom: 8px;" >
          <?php if($type==="admin"){?>
          Lista de egresos
          <?php } else { ?>
            Mis compras
          <?php } ?>
        </div>
        <table class="table productoDataTable" id="printTable" style="width: 100%;">
          <thead class="card-header">
            <tr class="text-center" style="pointer-events: none;">
              <td style="display: none;">Usuario</td>
              <td>Nº Venta</td>
              <td>Fecha</td>
              <td class="noPrint">Detalle</td>
            </tr>
          </thead>
          <tbody>
            <?php if($pagos){ foreach ($pagos as $prod) { ?>
              <tr>
                <td style="display: none;"><?= $prod->nombre; ?></td>
                <td><?= $prod->idpago; ?></td>
                <td class="formatDate"><?= $prod->create_time; ?></td>
                <td class="noPrint">
                  <a class="btn btn-info" href="<?= $this->config->item('base_ulr') ?>/index.php/egresosController/listarUsuarios/<?= $prod->userid ?>/<?= $prod->idpago ?>">Ver mas</a>
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
    <div style="margin-top: 20px;">
      <button class="btn btn-primary col-md-3" onclick="printTableContent('printTable', 'Lista de compras')"> Imprimir
      </button>
    </div>
  </div>
  <br>
</div>