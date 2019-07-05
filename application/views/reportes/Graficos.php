<script src="<?= $this->config->item('highchart_js') ?>/highcharts.min.js"></script>
<script src="<?= $this->config->item('highchart_js') ?>/exporting.min.js"></script>
<script src="<?= $this->config->item('highchart_js') ?>/export-data.min.js"></script>
<div>
  <div id="mensuales-container" style="width: 100%;">
    <div class="col-md-12"">
      <div id="mensuales" style="width: 100% !important;height: 400px; margin: 0 auto;margin-top: 45px;"></div>
    </div>
  </div>
  <div class="col-md-12" style="margin-top: 10px;">
    <button class="btn btn-primary col-md-3" onclick="printContent('mensuales-container', 'Grafico de ganancias mensuales')"> Imprimir
    </button>
  </div>
  <div class="col-md-12">
    <div class="card card-register mx-auto mt-5">
      <div class="text-center noPrint" style="padding: .75rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #D7CEC7;font-weight: bold;margin-bottom: 8px;" >
        Tabla de ganancias mensuales
      </div>
      <center>
        <table class="table" style="width: 100%" id="tablaGananciasMensuales">
          <thead class="card-header">
            <tr class="text-center" style="pointer-events: none;">
              <th>Mes</th>
              <th>Ganancia</th>
            </tr>
          </thead>
          <tbody id="tablaGananciasMensualesBody">
          </tbody>
        </table>
      </center>
    </div>
  </div>
  <div class="col-md-12" style="margin-top: 10px;">
    <button class="btn btn-primary col-md-3" onclick="printContent('tablaGananciasMensuales', 'Tabla de ganancias mensuales')"> Imprimir
    </button>
  </div>
</div>

<br>

<div>
  <div id="vendidos-container" style="width: 100%;">
    <div class="col-md-12"">
      <div id="vendidos" style="width: 100% !important;height: 400px; margin: 0 auto;margin-top: 45px;"></div>
    </div>
  </div>
  <div class="col-md-12" style="margin-top: 10px;">
    <button class="btn btn-primary col-md-3" onclick="printContent('vendidos-container', 'Grafico de ganancias mensuales')"> Imprimir
    </button>
  </div>
  <div class="col-md-12">
    <div class="card card-register mx-auto mt-5">
      <div class="text-center noPrint" style="padding: .75rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #D7CEC7;font-weight: bold;margin-bottom: 8px;" >
        Productos vendidos mensuales
      </div>
      <center>
        <table class="table" style="width: 100%" id="tablaVendidosMensuales">
          <thead class="card-header">
            <tr class="text-center" style="pointer-events: none;">
              <th>Producto</th>
              <th>Mes</th>
              <th>Cantidad Vendida</th>
            </tr>
          </thead>
          <tbody id="tablaVendidosMensualesBody">
          </tbody>
        </table>
      </center>
    </div>
  </div>
  <div class="col-md-12" style="margin-top: 10px;">
    <button class="btn btn-primary col-md-3" onclick="printContent('tablaVendidosMensuales', 'Productos vendidos mensualmente')"> Imprimir
    </button>
  </div>
</div>


<br>


<div>
  <div id="porcentajes-producto-container" style="width: 100%;">
    <div class="col-md-12"">
      <div id="porcentajes-producto" style="width: 100% !important;height: 400px; margin: 0 auto;margin-top: 45px;"></div>
    </div>
  </div>
  <div class="col-md-12" style="margin-top: 10px;">
    <button class="btn btn-primary col-md-3" onclick="printContent('porcentajes-producto-container', 'Productos mas vendidos')"> Imprimir
    </button>
  </div>
  <div class="col-md-12">
    <div class="card card-register mx-auto mt-5">
      <div class="text-center noPrint" style="padding: .75rem;vertical-align: top;border-top: 1px solid #dee2e6;background-color: #D7CEC7;font-weight: bold;margin-bottom: 8px;" >
        Porcentajes de ganancias por producto
      </div>
      <center>
        <table class="table" style="width: 100%" id="tablaVendidosMensuales">
          <thead class="card-header">
            <tr class="text-center" style="pointer-events: none;">
              <th>Producto</th>
              <th>Porcentaje de ganancia</th>
            </tr>
          </thead>
          <tbody id="tablaPorcentajesBody">
          </tbody>
        </table>
      </center>
    </div>
  </div>
  <div class="col-md-12" style="margin-top: 10px;">
    <button class="btn btn-primary col-md-3" onclick="printContent('tablaVendidosMensuales', 'Productos vendidos mensualmente')"> Imprimir
    </button>
  </div>
</div>
<br>
<br>
<br>
<div style="display: none;" id="pagos"><?php echo $pagos; ?></div>
<div style="display: none;" id="cotizaciones"><?php echo $cotizaciones; ?></div>
<div style="display: none;" id="productos"><?php echo $productos; ?></div>
<script src="<?= $this->config->item('boost_serial_file') ?>/reportes.js"></script>
<script src="<?= $this->config->item('boost_serial_file') ?>/moment.js"></script>
