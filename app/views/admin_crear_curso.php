<?php require __DIR__ . '/layouts/header.php'; ?>

<h2>Crear curso</h2>

<form method="POST" action="?page=admin_crear_curso_post" onsubmit="return validarCurso()">
  <label>Nombre del curso</label>
  <input name="nombre" id="nombre" required>
  <button type="submit">Crear</button>
</form>

<?php require __DIR__ . '/layouts/footer.php'; ?>
