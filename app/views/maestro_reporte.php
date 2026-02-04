<?php require __DIR__ . '/layouts/header.php'; ?>

<h2>Reporte por mes</h2>

<form method="GET" action="">
  <input type="hidden" name="page" value="maestro_reporte">
  <label>Mes</label>
  <input type="month" name="ym" value="<?= htmlspecialchars($ym) ?>" required>
  <button type="submit">Ver</button>
</form>

<table>
  <tr><th>Fecha</th><th>Presentes</th><th>Faltas</th></tr>
  <?php foreach ($resumen as $r): ?>
    <tr>
      <td><?= htmlspecialchars($r['fecha']) ?></td>
      <td><?= (int)$r['presentes'] ?></td>
      <td><?= (int)$r['faltas'] ?></td>
    </tr>
  <?php endforeach; ?>
</table>

<p style="margin-top:12px;">
  <a class="card" href="?page=maestro_pdf&ym=<?= urlencode($ym) ?>">Descargar PDF</a>
</p>


<?php require __DIR__ . '/layouts/footer.php'; ?>
