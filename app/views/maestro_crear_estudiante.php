<?php require __DIR__ . '/layouts/header.php'; $u = $_SESSION['user']; ?>

<h2>Crear estudiante</h2>

<form method="POST" action="?page=maestro_crear_estudiante_post" onsubmit="return validarEstudiante()">
  <label>Nombres</label>
  <input name="nombres" id="nombres" required>

  <label>Apellidos</label>
  <input name="apellidos" id="apellidos" required>

  <label>Edad</label>
  <input type="number" name="edad" id="edad" min="1" required>

  <label>Celular (opcional)</label>
  <input name="celular" id="celular">

  <label>Curso</label>
  <!-- Forzamos el curso del maestro -->
  <select name="curso_id" id="curso_id" required>
    <?php foreach ($cursos as $c): ?>
      <?php if ((int)$c['id'] === (int)$u['curso_id']): ?>
        <option value="<?= $c['id'] ?>" selected><?= htmlspecialchars($c['nombre']) ?></option>
      <?php endif; ?>
    <?php endforeach; ?>
  </select>

  <button type="submit">Guardar</button>
</form>

<?php require __DIR__ . '/layouts/footer.php'; ?>
