<?php
class AuthController {
  public function showLogin() {
    require __DIR__ . '/../views/auth_login.php';
  }

  public function login() {
    $correo = trim($_POST['correo'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($correo === '' || $password === '') {
      $_SESSION['flash'] = "Completa correo y contraseña.";
      header("Location: ?page=login");
      exit;
    }

    $user = User::findByEmail($correo);
    if (!$user || !password_verify($password, $user['password_hash'])) {
      $_SESSION['flash'] = "Credenciales inválidas.";
      header("Location: ?page=login");
      exit;
    }

    $_SESSION['user'] = [
      'id' => $user['id'],
      'rol' => $user['rol'],
      'nombre' => $user['nombre'],
      'curso_id' => $user['curso_id']
    ];

    if ($user['rol'] === 'admin') {
      header("Location: ?page=admin_dashboard");
    } else {
      header("Location: ?page=maestro_dashboard");
    }
    exit;
  }

  public function logout() {
    session_destroy();
    header("Location: ?page=login");
    exit;
  }
}
