<div class="container">
  <h1 class="gestion-empleado-title">Gestión de Empleados</h1>

  <div class="opciones-lista">
    <div>
      <a href="index.php?action=create" class="btn-nuevo">Nuevo Empleado <strong>+</strong></a>
    </div>
    <form action="index.php" method="GET" class="form-busqueda">
      <input type="hidden" name="action" value="search">
      <input type="text" name="termino" placeholder="Buscar por nombre..."
        value="<?= isset($_GET['termino']) ? htmlspecialchars($_GET['termino']) : '' ?>">
      <button type="submit" class="btn-buscar">Buscar</button>
      <?php if (isset($_GET['termino']) && !empty($_GET['termino'])): ?>
        <div>
        <a href="index.php" class="btn-limpiar">Limpiar</a>
        </div>
      <?php endif; ?>
    </form>
  </div>

  <?php if (isset($_GET['termino']) && !empty($_GET['termino'])): ?>
    <p class="resultados-busqueda">
      Resultados para: <strong><?= htmlspecialchars($_GET['termino']) ?></strong>
      (<?= count($empleados) ?> encontrados)
    </p>
  <?php endif; ?>

  <table class="tabla-empleados">
    <thead>
      <tr>
        <th>Foto</th>
        <th>Nombre</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if (count($empleados) > 0): ?>
        <?php foreach ($empleados as $emp): ?>
          <tr >
            <td class="td-center">
              <?php if ($emp['foto']): ?>
                <img src="/Desafio_02/public/fotos/empleados/<?= $emp['foto'] ?>" class="foto-miniatura">
              <?php else: ?>
                <img src="/Desafio_02/public/fotos/empleados/default.jpg" class="foto-miniatura">
              <?php endif; ?>
            </td>
            <td class="td-center"><?= htmlspecialchars($emp['nombre']) ?></td>
            <td class="acciones td-center">
              <a href="index.php?action=show&id=<?= $emp['id'] ?>" class="btn-ver">Boleta</a>
              <a href="index.php?action=edit&id=<?= $emp['id'] ?>" class="btn-editar">Editar</a>
              <a href="index.php?action=destroy&id=<?= $emp['id'] ?>"
                class="btn-eliminar"
                onclick="return confirm('¿Eliminar empleado?')">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="3" class="no-resultados">No se encontraron empleados</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>