<?php
class Router {
  public static function run() {
    $page = $_GET['page'] ?? 'login';

    switch ($page) {
      case 'login':
        (new AuthController())->showLogin();
        break;
      case 'login_post':
        (new AuthController())->login();
        break;
      case 'logout':
        (new AuthController())->logout();
        break;

      // admin
      case 'admin_dashboard':
        (new AdminController())->dashboard();
        break;
      case 'admin_crear_usuario':
        (new AdminController())->crearUsuarioForm();
        break;
      case 'admin_crear_usuario_post':
        (new AdminController())->crearUsuario();
        break;
      case 'admin_crear_curso':
        (new AdminController())->crearCursoForm();
        break;
      case 'admin_crear_curso_post':
        (new AdminController())->crearCurso();
        break;
      case 'admin_eliminar':
        (new AdminController())->eliminarForm();
        break;
      case 'admin_eliminar_post':
        (new AdminController())->eliminar();
        break;

      // maestro
      case 'maestro_dashboard':
        (new MaestroController())->dashboard();
        break;
      case 'maestro_crear_estudiante':
        (new MaestroController())->crearEstudianteForm();
        break;
      case 'maestro_crear_estudiante_post':
        (new MaestroController())->crearEstudiante();
        break;
      case 'maestro_asistencia':
        (new MaestroController())->asistenciaForm();
        break;
      case 'maestro_asistencia_post':
        (new MaestroController())->guardarAsistencia();
        break;
      case 'maestro_editar_asistencia':
        (new MaestroController())->editarAsistenciaForm();
        break;
      case 'maestro_editar_asistencia_post':
        (new MaestroController())->actualizarAsistencia();
        break;
      case 'maestro_reporte':
        (new MaestroController())->reporteForm();
        break;
      case 'maestro_pdf':
        (new MaestroController())->reportePDF();
        break;
        case 'maestro_estudiantes':
        (new MaestroController())->listaEstudiantes();
        break;
        case 'maestro_eliminar_estudiante_post':
        (new MaestroController())->eliminarEstudiante();
        break;
        case 'maestro_pdf':
        (new MaestroController())->reportePDF();
        break;

      default:
        http_response_code(404);
        echo "404 - Página no encontrada";
    }
  }
}
