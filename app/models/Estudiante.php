<?php
class Estudiante {
  public static function create(array $d) {
    $stmt = db()->prepare("
      INSERT INTO estudiantes (curso_id, creado_por_usuario_id, nombres, apellidos, edad, celular)
      VALUES (?, ?, ?, ?, ?, ?)
    ");
    return $stmt->execute([$d['curso_id'], $d['usuario_id'], $d['nombres'], $d['apellidos'], $d['edad'], $d['celular']]);
  }

  public static function byCurso(int $curso_id) {
    $stmt = db()->prepare("SELECT * FROM estudiantes WHERE curso_id=? AND activo=1 ORDER BY apellidos");
    $stmt->execute([$curso_id]);
    return $stmt->fetchAll();
  }

  public static function disable(int $id) {
    $stmt = db()->prepare("UPDATE estudiantes SET activo=0 WHERE id=?");
    return $stmt->execute([$id]);
  }
}
