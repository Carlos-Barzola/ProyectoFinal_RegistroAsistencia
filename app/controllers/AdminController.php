<?php
class AdminController {
  public function dashboard() {
    Auth::requireRole('admin');
    require __DIR__ . '/../views/admin_dashboard.php';
  }

  public function crearUsuarioForm() {
    Auth::requireRole('admin');
    $cursos = Curso::allActivos();
    require __DIR__ . '/../views/admin_crear_usuario.php';
  }

  public function crearUsuario() {
    Auth::requireRole('admin');

    $nombre = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $password = $_POST['password'] ?? '';
    $curso_id = (int)($_POST['curso_id'] ?? 0);

    if ($nombre==='' || $apellido==='' || $correo==='' || $password==='' || $curso_id<=0) {
      $_SESSION['flash'] = "Todos los campos son obligatorios.";
      header("Location: ?page=admin_crear_usuario");
      exit;
    }
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
      $_SESSION['flash'] = "Correo inválido.";
      header("Location: ?page=admin_crear_usuario");
      exit;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    try {
      User::createMaestro([
        'nombre'=>$nombre,'apellido'=>$apellido,'correo'=>$correo,'password_hash'=>$hash,'curso_id'=>$curso_id
      ]);
      $_SESSION['flash'] = "Maestro creado correctamente.";
    } catch (Exception $e) {
      $_SESSION['flash'] = "Error al crear maestro (correo repetido o BD).";
    }
    header("Location: ?page=admin_dashboard");
    exit;
  }

  public function crearCursoForm() {
    Auth::requireRole('admin');
    require __DIR__ . '/../views/admin_crear_curso.php';
  }

  public function crearCurso() {
    Auth::requireRole('admin');
    $nombre = trim($_POST['nombre'] ?? '');
    if ($nombre === '') {
      $_SESSION['flash'] = "Nombre obligatorio.";
      header("Location: ?page=admin_crear_curso");
      exit;
    }
    try {
      Curso::create($nombre);
      $_SESSION['flash'] = "Curso creado.";
    } catch (Exception $e) {
      $_SESSION['flash'] = "Error: curso repetido.";
    }
    header("Location: ?page=admin_dashboard");
    exit;
  }

  public function eliminarForm() {
    Auth::requireRole('admin');
    $maestros = User::allMaestros();
    $cursos = Curso::allActivos();
    require __DIR__ . '/../views/admin_eliminar.php';
  }

  public function eliminar() {
    Auth::requireRole('admin');
    $tipo = $_POST['tipo'] ?? '';
    $id = (int)($_POST['id'] ?? 0);

    if ($id <= 0 || !in_array($tipo, ['usuario','curso'], true)) {
      $_SESSION['flash'] = "Acción inválida.";
      header("Location: ?page=admin_eliminar");
      exit;
    }

    if ($tipo === 'usuario') User::disableUser($id);
    if ($tipo === 'curso') Curso::disable($id);

    $_SESSION['flash'] = "Eliminado (desactivado) correctamente.";
    header("Location: ?page=admin_eliminar");
    exit;
  }
}
