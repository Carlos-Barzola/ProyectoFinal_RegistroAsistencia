<?php require __DIR__ . '/layouts/header.php'; $u=$_SESSION['user']; ?>

<div class="card">
  <div style="display:flex; gap:10px; flex-wrap:wrap; align-items:center; justify-content:space-between;">
    <h2 style="margin:0;">Editar asistencia</h2>

    <span class="badge">
      Curso: <?= htmlspecialchars($cursoNombre) ?>
    </span>
  </div>

  <form method="GET" action="">
    <input type="hidden" name="page" value="maestro_editar_asistencia">
    <input type="hidden" name="load" value="1">

    <!-- CAMBIO: clase para hacer responsive el grid -->
    <div class="asistencia-grid" style="display:grid; gap:10px; align-items:end;">
      <div>
        <label>Curso</label>
        <input value="<?= htmlspecialchars($cursoNombre) ?>" disabled>
      </div>

      <div>
        <label>Fecha</label>
        <input type="date" name="fecha" value="<?= htmlspecialchars($fecha) ?>" required>
      </div>

      <button type="submit">Cargar asistencia</button>
    </div>
  </form>
</div>

<hr>

<form method="POST" action="?page=maestro_editar_asistencia_post">
  <input type="hidden" name="curso_id" value="<?= (int)$u['curso_id'] ?>">
  <input type="hidden" name="fecha" value="<?= htmlspecialchars($fecha) ?>">

  <?php if (!empty($lista)): ?>

    <!-- CAMBIO: wrapper para tabla responsive -->
    <div class="table-wrap">
      <table>
        <tr><th>Estudiante</th><th>Presente</th></tr>

        <?php foreach ($lista as $row): ?>
          <tr>
            <td><?= htmlspecialchars($row['apellidos'].' '.$row['nombres']) ?></td>
            <td>
              <input
                type="checkbox"
                name="presente[]"
                value="<?= $row['estudiante_id'] ?>"
                <?= ((int)$row['presente'] === 1) ? 'checked' : '' ?>
              >
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>

    <button type="submit">Actualizar asistencia</button>

  <?php else: ?>
    <div class="flash success" style="background: rgba(80,121,47,.15);">
      Selecciona una fecha y pulsa <b>Cargar asistencia</b> para editar registros.
    </div>
  <?php endif; ?>
</form>

<?php require __DIR__ . '/layouts/footer.php'; ?>
