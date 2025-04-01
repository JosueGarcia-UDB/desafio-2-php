<?php include './partials/header.php'; ?>

<div class="container">
  <h1>Gestión de Empleados</h1>

  <a href="index.php?action=create" class="btn-nuevo">Nuevo Empleado</a>

  <table class="tabla-empleados">
    <thead>
      <tr>
        <th>Foto</th>
        <th>Nombre</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($empleados as $emp): ?>
        <tr>
          <td>
            <?php if ($emp['foto']): ?>
              <img src="/Desafio_02/public/fotos/empleados/<?= $emp['foto'] ?>" class="foto-miniatura">
            <?php else: ?>
              <img src="/Desafio_02/public/fotos/empleados/default.webp" class="foto-miniatura">
            <?php endif; ?>
          </td>
          <td><?= htmlspecialchars($emp['nombre']) ?></td>
          <td class="acciones">
            <a href="index.php?action=show&id=<?= $emp['id'] ?>" class="btn-ver">Boleta</a>
            <a href="index.php?action=edit&id=<?= $emp['id'] ?>" class="btn-editar">Editar</a>
            <a href="index.php?action=destroy&id=<?= $emp['id'] ?>"
              class="btn-eliminar"
              onclick="return confirm('¿Eliminar empleado?')">Eliminar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include './partials/footer.php'; ?>