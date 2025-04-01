<?php include './partials/header.php'; ?>

<div class="container">
  <h1>Boleta de Pago</h1>
  <div class="boleta">
    <div class="encabezado">
      <h2><?= htmlspecialchars($empleado['nombre']) ?></h2>
      <?php if ($empleado['foto']): ?>
        <img src="/Desafio_02/public/fotos/empleados/<?= $empleado['foto'] ?>" class="foto-empleado">
      <?php else: ?>
        <img src="/Desafio_02/public/fotos/empleados/default.webp" class="foto-empleado">
      <?php endif; ?>
    </div>

    <div class="detalle">
      <div class="ingresos">
        <h3>Ingresos</h3>
        <p>Salario Base: $<?= number_format($boleta['salario'], 2) ?></p>
        <p>Horas Extras: $<?= number_format($boleta['horas_extras'], 2) ?></p>
      </div>

      <div class="descuentos">
        <h3>Descuentos</h3>
        <p>AFP (7.25%): $<?= number_format($boleta['afp'], 2) ?></p>
        <p>ISSS (3%): $<?= number_format($boleta['isss'], 2) ?></p>
        <p>Renta (10%): $<?= number_format($boleta['renta'], 2) ?></p>
        <?php if ($boleta['prestamo'] > 0): ?>
          <p>Préstamo: $<?= number_format($boleta['prestamo'], 2) ?></p>
        <?php endif; ?>
      </div>

      <div class="totales">
        <h3>Total Descuentos: $<?= number_format($boleta['total_descuentos'], 2) ?></h3>
        <h3 class="sueldo-liquido">Sueldo Líquido: $<?= number_format($boleta['sueldo_liquido'], 2) ?></h3>
      </div>
    </div>
  </div>
  <a href="index.php" class="btn-volver">Volver</a>
</div>

<?php include './partials/footer.php'; ?>