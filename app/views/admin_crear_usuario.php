<?php require __DIR__ . '/layouts/header.php'; ?>

<h2>Crear maestro</h2>

<form method="POST" action="?page=admin_crear_usuario_post" onsubmit="return validarMaestro()">
  <label>Nombre</label>
  <input name="nombre" id="nombre" required>

  <label>Apellido</label>
  <input name="apellido" id="apellido" required>

  <label>Correo</label>
  <input type="email" name="correo" id="correo" required>

  <label>Contraseña inicial</label>
  <input type="text" name="password" id="password" required>

  <label>Curso</label>
  <select name="curso_id" id="curso_id" required>
    <option value="">Seleccione...</option>
    <?php foreach ($cursos as $c): ?>
      <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nombre']) ?></option>
    <?php endforeach; ?>
  </select>

  <button type="submit">Guardar</button>
</form>

<?php require __DIR__ . '/layouts/footer.php'; ?>
