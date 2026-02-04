<?php
class Asistencia {
  public static function upsert(int $estudiante_id, int $curso_id, string $fecha, int $presente, int $usuario_id) {
    $stmt = db()->prepare("
      INSERT INTO asistencias (estudiante_id, curso_id, fecha, presente, registrado_por_usuario_id)
      VALUES (?, ?, ?, ?, ?)
      ON DUPLICATE KEY UPDATE
        presente=VALUES(presente),
        registrado_por_usuario_id=VALUES(registrado_por_usuario_id)
    ");
    return $stmt->execute([$estudiante_id, $curso_id, $fecha, $presente, $usuario_id]);
  }

  public static function listByCursoFecha(int $curso_id, string $fecha) {
    $stmt = db()->prepare("
      SELECT e.id AS estudiante_id, e.nombres, e.apellidos,
             COALESCE(a.presente, 0) AS presente
      FROM estudiantes e
      LEFT JOIN asistencias a
        ON a.estudiante_id = e.id AND a.fecha = ?
      WHERE e.curso_id = ? AND e.activo=1
      ORDER BY e.apellidos
    ");
    $stmt->execute([$fecha, $curso_id]);
    return $stmt->fetchAll();
  }

  public static function resumenPorMes(int $curso_id, string $ym) {
    // ym = "2026-02"
    $stmt = db()->prepare("
      SELECT fecha,
             SUM(presente=1) AS presentes,
             SUM(presente=0) AS faltas
      FROM asistencias
      WHERE curso_id=? AND DATE_FORMAT(fecha, '%Y-%m')=?
      GROUP BY fecha
      ORDER BY fecha
    ");
    $stmt->execute([$curso_id, $ym]);
    return $stmt->fetchAll();
  }

  public static function totalesPorEstudianteMes(int $curso_id, string $ym) {
  $stmt = db()->prepare("
    SELECT e.id,
           e.apellidos,
           e.nombres,
           SUM(CASE WHEN a.presente=1 THEN 1 ELSE 0 END) AS presentes,
           SUM(CASE WHEN a.presente=0 THEN 1 ELSE 0 END) AS faltas
    FROM estudiantes e
    LEFT JOIN asistencias a
      ON a.estudiante_id = e.id
      AND DATE_FORMAT(a.fecha, '%Y-%m') = ?
    WHERE e.curso_id = ?
      AND e.activo = 1
    GROUP BY e.id
    ORDER BY e.apellidos, e.nombres
  ");
  $stmt->execute([$ym, $curso_id]);
  return $stmt->fetchAll();
}

public static function totalClasesMes(int $curso_id, string $ym) {
  $stmt = db()->prepare("
    SELECT COUNT(DISTINCT fecha) AS total
    FROM asistencias
    WHERE curso_id=? AND DATE_FORMAT(fecha, '%Y-%m')=?
  ");
  $stmt->execute([$curso_id, $ym]);
  $row = $stmt->fetch();
  return (int)($row['total'] ?? 0);
}

}
