<?php
class MaestroController {
  public function dashboard() {
    Auth::requireRole('maestro');
    require __DIR__ . '/../views/maestro_dashboard.php';
  }

  public function crearEstudianteForm() {
    Auth::requireRole('maestro');
    $cursos = Curso::allActivos();
    require __DIR__ . '/../views/maestro_crear_estudiante.php';
  }

  public function crearEstudiante() {
    Auth::requireRole('maestro');
    $u = Auth::user();

    $nombres = trim($_POST['nombres'] ?? '');
    $apellidos = trim($_POST['apellidos'] ?? '');
    $edad = (int)($_POST['edad'] ?? 0);
    $celular = trim($_POST['celular'] ?? '');
    $curso_id = (int)($_POST['curso_id'] ?? 0);

    if ($nombres==='' || $apellidos==='' || $edad<=0 || $curso_id<=0) {
      $_SESSION['flash'] = "Completa todos los campos obligatorios.";
      header("Location: ?page=maestro_crear_estudiante");
      exit;
    }

    // Regla simple: maestro solo registra en SU curso asignado
    if ((int)$u['curso_id'] !== $curso_id) {
      $_SESSION['flash'] = "Solo puedes registrar estudiantes en tu curso asignado.";
      header("Location: ?page=maestro_crear_estudiante");
      exit;
    }

    Estudiante::create([
      'curso_id'=>$curso_id,'usuario_id'=>$u['id'],'nombres'=>$nombres,'apellidos'=>$apellidos,'edad'=>$edad,'celular'=>$celular
    ]);
    $_SESSION['flash'] = "Estudiante creado.";
    header("Location: ?page=maestro_dashboard");
    exit;
  }

public function asistenciaForm() {
  Auth::requireRole('maestro');
  $u = Auth::user();

  $curso_id = (int)$u['curso_id'];

  $curso = Curso::find($curso_id);
  $cursoNombre = $curso ? $curso['nombre'] : "Curso #".$curso_id;

  // Solo cargamos lista cuando el usuario presiona "Cargar lista"
  $load = isset($_GET['load']) && $_GET['load'] == '1';
  $fecha = $_GET['fecha'] ?? '';

  $lista = [];
  if ($load && $fecha) {
    $lista = Asistencia::listByCursoFecha($curso_id, $fecha);
  }

  require __DIR__ . '/../views/maestro_asistencia.php';
}



  public function guardarAsistencia() {
    Auth::requireRole('maestro');
    $u = Auth::user();

    $curso_id = (int)($_POST['curso_id'] ?? 0);
    $fecha = $_POST['fecha'] ?? '';

    if ($curso_id <= 0 || $fecha === '') {
      $_SESSION['flash'] = "Curso y fecha obligatorios.";
      header("Location: ?page=maestro_asistencia");
      exit;
    }
    if ($curso_id !== (int)$u['curso_id']) {
      $_SESSION['flash'] = "No autorizado para ese curso.";
      header("Location: ?page=maestro_asistencia");
      exit;
    }

    $presentes = $_POST['presente'] ?? []; // array de estudiante_id marcados

    $estudiantes = Estudiante::byCurso($curso_id);
    foreach ($estudiantes as $e) {
      $presente = in_array((string)$e['id'], $presentes, true) ? 1 : 0;
      Asistencia::upsert((int)$e['id'], $curso_id, $fecha, $presente, (int)$u['id']);
    }

    $_SESSION['flash'] = "Asistencia guardada.";
    header("Location: ?page=maestro_asistencia&fecha=".$fecha);
    exit;
  }

public function editarAsistenciaForm() {
  Auth::requireRole('maestro');
  $u = Auth::user();

  $curso_id = (int)$u['curso_id'];

  $curso = Curso::find($curso_id);
  $cursoNombre = $curso ? $curso['nombre'] : "Curso #".$curso_id;

  $load = isset($_GET['load']) && $_GET['load'] == '1';
  $fecha = $_GET['fecha'] ?? '';

  $lista = [];
  if ($load && $fecha) {
    $lista = Asistencia::listByCursoFecha($curso_id, $fecha);
  }

  require __DIR__ . '/../views/maestro_editar_asistencia.php';
}



public function actualizarAsistencia() {
  // Reutiliza la misma lógica de guardar
  $this->guardarAsistencia();
}


  public function reporteForm() {
    Auth::requireRole('maestro');
    $u = Auth::user();
    $curso_id = (int)$u['curso_id'];
    $ym = $_GET['ym'] ?? date('Y-m'); // 2026-02

    $resumen = Asistencia::resumenPorMes($curso_id, $ym);
    require __DIR__ . '/../views/maestro_reporte.php';
  }

  public function reportePDF() {
  Auth::requireRole('maestro');
  $u = Auth::user();

  $curso_id = (int)$u['curso_id'];
  $ym = $_GET['ym'] ?? date('Y-m'); // formato: YYYY-MM

  // Datos
  $curso = Curso::find($curso_id);
  $nombreCurso = $curso ? $curso['nombre'] : ("Curso #".$curso_id);

  $resumen = Asistencia::resumenPorMes($curso_id, $ym); // por fecha
  $totales = Asistencia::totalesPorEstudianteMes($curso_id, $ym); // por estudiante
  $totalClases = Asistencia::totalClasesMes($curso_id, $ym);

  // Cargar FPDF
  require_once __DIR__ . '/../libs/fpdf/fpdf.php';

  $pdf = new FPDF('P', 'mm', 'A4');
  $pdf->AddPage();

  // Título
  $pdf->SetFont('Arial', 'B', 16);
  $pdf->Cell(0, 10, 'Reporte de Asistencia - Jumper', 0, 1, 'C');

  $pdf->SetFont('Arial', '', 12);
  $pdf->Cell(0, 8, 'Curso: ' . $nombreCurso, 0, 1);
  $pdf->Cell(0, 8, 'Mes: ' . $ym . ' | Total de clases registradas: ' . $totalClases, 0, 1);
  $pdf->Cell(0, 8, 'Generado: ' . date('Y-m-d H:i'), 0, 1);

  $pdf->Ln(4);

  // Tabla 1: Resumen por fecha
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(0, 8, 'Resumen por fecha', 0, 1);

  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(50, 8, 'Fecha', 1, 0, 'C');
  $pdf->Cell(40, 8, 'Presentes', 1, 0, 'C');
  $pdf->Cell(40, 8, 'Faltas', 1, 1, 'C');

  $pdf->SetFont('Arial', '', 10);

  if (empty($resumen)) {
    $pdf->Cell(130, 8, 'No hay asistencias registradas en este mes.', 1, 1);
  } else {
    foreach ($resumen as $r) {
      $pdf->Cell(50, 8, $r['fecha'], 1, 0);
      $pdf->Cell(40, 8, (string)$r['presentes'], 1, 0, 'C');
      $pdf->Cell(40, 8, (string)$r['faltas'], 1, 1, 'C');
    }
  }

  $pdf->Ln(6);

  // Tabla 2: Totales por estudiante
  $pdf->SetFont('Arial', 'B', 12);
  $pdf->Cell(0, 8, 'Totales por estudiante', 0, 1);

  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(90, 8, 'Estudiante', 1, 0, 'C');
  $pdf->Cell(30, 8, 'Presentes', 1, 0, 'C');
  $pdf->Cell(30, 8, 'Faltas', 1, 1, 'C');

  $pdf->SetFont('Arial', '', 10);

  if (empty($totales)) {
    $pdf->Cell(150, 8, 'No hay estudiantes en el curso.', 1, 1);
  } else {
    foreach ($totales as $t) {
      $nombre = $t['apellidos'] . ' ' . $t['nombres'];
      $pdf->Cell(90, 8, $nombre, 1, 0);
      $pdf->Cell(30, 8, (string)($t['presentes'] ?? 0), 1, 0, 'C');
      $pdf->Cell(30, 8, (string)($t['faltas'] ?? 0), 1, 1, 'C');
    }
  }

  // Salida del PDF
  header('Content-Type: application/pdf');
  header('Content-Disposition: inline; filename="reporte_asistencia_'.$ym.'.pdf"');
  $pdf->Output('I');
  exit;
}


  public function listaEstudiantes() {
  Auth::requireRole('maestro');
  $u = Auth::user();

  $curso_id = (int)$u['curso_id'];
  $estudiantes = Estudiante::byCurso($curso_id);

  require __DIR__ . '/../views/maestro_estudiantes.php';
}

public function eliminarEstudiante() {
  Auth::requireRole('maestro');
  $u = Auth::user();

  $id = (int)($_POST['id'] ?? 0);
  if ($id <= 0) {
    $_SESSION['flash'] = "Estudiante inválido.";
    header("Location: ?page=maestro_estudiantes");
    exit;
  }

  // Seguridad: confirmar que el estudiante es del curso del maestro
  $curso_id = (int)$u['curso_id'];
  $lista = Estudiante::byCurso($curso_id);

  $esDelCurso = false;
  foreach ($lista as $e) {
    if ((int)$e['id'] === $id) { $esDelCurso = true; break; }
  }

  if (!$esDelCurso) {
    $_SESSION['flash'] = "No autorizado para eliminar este estudiante.";
    header("Location: ?page=maestro_estudiantes");
    exit;
  }

  Estudiante::disable($id);
  $_SESSION['flash'] = "Estudiante eliminado (desactivado).";
  header("Location: ?page=maestro_estudiantes");
  exit;
}

}
