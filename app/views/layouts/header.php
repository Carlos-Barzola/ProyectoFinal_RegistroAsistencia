<?php
// Asegura sesión disponible para leer rol/usuario
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= defined('APP_NAME') ? APP_NAME : 'Jumper Asistencia' ?></title>

  <!-- CSS -->
  <link rel="stylesheet" href="./assets/css/styles.css?v=1">
</head>
<body>

<nav class="nav">
  <div class="brand">
    <!-- Logo al lado del título (misma altura que texto por CSS .brand-logo) -->
    <img class="brand-logo" src="./assets/img/jumper-logo.png" alt="Jumper">
    <?= defined('APP_NAME') ? APP_NAME : 'Jumper Asistencia' ?>
  </div>

  <div class="links">
    <?php if (!empty($_SESSION['user'])): ?>

      <?php
        // Botón Dashboard según rol
        $rol = $_SESSION['user']['rol'] ?? '';
        $dashboardPage = ($rol === 'admin') ? 'admin_dashboard' : 'maestro_dashboard';
      ?>
      <a class="btn" href="?page=<?= $dashboardPage ?>">Dashboard</a>

      <!-- Cerrar sesión -->
      <a class="btn" href="?page=logout">Cerrar sesión</a>

    <?php endif; ?>
  </div>
</nav>

<main class="container">
  <?php if (!empty($_SESSION['flash'])): ?>
    <div class="flash success"><?= htmlspecialchars($_SESSION['flash']) ?></div>
    <?php unset($_SESSION['flash']); ?>
  <?php endif; ?>


