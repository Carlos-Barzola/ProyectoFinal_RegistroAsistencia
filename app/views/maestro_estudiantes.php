<?php require __DIR__ . '/layouts/header.php'; ?>

<h2>Estudiantes de mi curso</h2>

<?php if (empty($estudiantes)): ?>
  <p>No hay estudiantes registrados.</p>
<?php else: ?>
  <table>
    <tr>
      <th>Apellidos</th>
      <th>Nombres</th>
      <th>Edad</th>
      <th>Celular</th>
      <th>Acción</th>
    </tr>

    <?php foreach ($estudiantes as $e): ?>
      <tr>
        <td><?= htmlspecialchars($e['apellidos']) ?></td>
        <td><?= htmlspecialchars($e['nombres']) ?></td>
        <td><?= (int)$e['edad'] ?></td>
        <td><?= htmlspecialchars($e['celular'] ?? '') ?></td>
        <td>
          <form method="POST" action="?page=maestro_eliminar_estudiante_post"
                onsubmit="return confirm('¿Seguro que deseas eliminar este estudiante?');">
            <input type="hidden" name="id" value="<?= (int)$e['id'] ?>">
            <button type="submit">Eliminar</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php endif; ?>

<p style="margin-top:12px;">
  <a href="?page=maestro_dashboard">Volver al dashboard</a>
</p>

<?php require __DIR__ . '/layouts/footer.php'; ?>
