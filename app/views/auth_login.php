<?php require __DIR__ . '/layouts/header.php'; ?>

<div class="auth-page">
  <div class="auth-card card">
    <h2>Iniciar sesión</h2>

    <form method="POST" action="?page=login_post">
      <label>Correo</label>
      <input type="email" name="correo" required>

      <label>Contraseña</label>
      <input type="password" name="password" required>

      <button type="submit">Entrar</button>
    </form>
  </div>
</div>

<?php require __DIR__ . '/layouts/footer.php'; ?>


