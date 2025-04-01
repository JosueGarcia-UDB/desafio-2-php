<?php include './partials/header.php'; ?>

<div class="container">
  <h2><?= isset($empleado) ? 'Editar' : 'Nuevo' ?> Empleado</h2>

  <form action="index.php?action=store" method="POST" enctype="multipart/form-data">
    <?php if (isset($empleado)): ?>
      <input type="hidden" name="id" value="<?= $empleado['id'] ?>">
    <?php endif; ?>

    <div class="form-group">
      <label>Nombre:</label>
      <input type="text" name="nombre" required
        value="<?= $empleado['nombre'] ?? '' ?>">
    </div>

    <div class="form-group">
      <label>Salario Base ($):</label>
      <input type="number" step="0.01" name="salario" required
        value="<?= $empleado['salario'] ?? '' ?>">
    </div>

    <div class="form-group">
      <label>Horas Extras:</label>
      <input type="number" name="horas_extras"
        value="<?= $empleado['horas_extras'] ?? 0 ?>">
    </div>

    <div class="form-group">
      <label>Préstamo ($):</label>
      <input type="number" step="0.01" name="prestamo"
        value="<?= $empleado['prestamo'] ?? 0 ?>">
    </div>

    <div class="form-group">
      <label>Foto:</label>
      <input type="file" name="foto">
    </div>

    <button type="submit" class="btn-guardar">Guardar</button>
  </form>
</div>

<?php include './partials/footer.php'; ?>