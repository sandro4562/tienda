<div class="col-md-12">
  <div class="">
    <div class="card card-register mx-auto mt-5">
      <center>
        <table class="table" id="printTable">
          <thead class="card-header">
            <tr>
              <th colspan="12" style="text-align: center;">Lista de Usuarios</th>
            </tr>
          </thead>
          <tbody class="card-body container">
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Apellido</th>
              <th scope="col">Correo</th>
              <th scope="col">Rol</th>
              <th scope="col" class="noPrint">Acciones</th>
            </tr>
            <?php if($usuarios){ foreach ($usuarios as $usu) { ?>
              <tr>
                <td><?= $usu->nombre; ?></td>
                <td><?= $usu->apellido; ?></td>
                <td><?= $usu->correo; ?></td>
                <td><?= $usu->rol; ?></td>
                <td class="noPrint">
                  <a class="btn btn-info" href="/index.php/usuariosController/editar/<?= $usu->id; ?>">Modificar</a>
                  <a class="btn btn-danger" href="/index.php/usuariosController/borrar/<?= $usu->id; ?>">Eliminar</a>
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
  <div>
    <button class="btn btn-primary col-md-3" onclick="printTableContent('printTable', 'Lista de usuarios registrados')"> Imprimir</button>
  </div>
</div>