<?php require __DIR__ . '/layouts/header.php'; ?>

<h2>Eliminar (desactivar)</h2>

<h3>Maestros</h3>
<form method="POST" action="?page=admin_eliminar_post">
  <input type="hidden" name="tipo" value="usuario">
  <select name="id" required>
    <option value="">Seleccione maestro...</option>
    <?php foreach ($maestros as $m): ?>
      <option value="<?= $m['id'] ?>">
        <?= htmlspecialchars($m['apellido'].' '.$m['nombre'].' - '.$m['correo']) ?>
      </option>
    <?php endforeach; ?>
  </select>
  <button type="submit">Eliminar maestro</button>
</form>

<h3>Cursos</h3>
<form method="POST" action="?page=admin_eliminar_post">
  <input type="hidden" name="tipo" value="curso">
  <select name="id" required>
    <option value="">Seleccione curso...</option>
    <?php foreach ($cursos as $c): ?>
      <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nombre']) ?></option>
    <?php endforeach; ?>
  </select>
  <button type="submit">Eliminar curso</button>
</form>

<?php require __DIR__ . '/layouts/footer.php'; ?>
