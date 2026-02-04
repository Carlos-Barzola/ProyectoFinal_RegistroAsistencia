<?php
class User {
  public static function findByEmail(string $correo) {
    $stmt = db()->prepare("
      SELECT u.*, r.nombre AS rol
      FROM usuarios u
      JOIN roles r ON r.id = u.rol_id
      WHERE u.correo = ? AND u.activo = 1
      LIMIT 1
    ");
    $stmt->execute([$correo]);
    return $stmt->fetch();
  }

  public static function createMaestro(array $data) {
    $stmt = db()->prepare("
      INSERT INTO usuarios (rol_id, nombre, apellido, correo, password_hash, curso_id)
      VALUES ((SELECT id FROM roles WHERE nombre='maestro'), ?, ?, ?, ?, ?)
    ");
    return $stmt->execute([
      $data['nombre'], $data['apellido'], $data['correo'], $data['password_hash'], $data['curso_id']
    ]);
  }

  public static function allMaestros() {
    $stmt = db()->query("
      SELECT u.id, u.nombre, u.apellido, u.correo, u.curso_id, c.nombre AS curso
      FROM usuarios u
      LEFT JOIN cursos c ON c.id = u.curso_id
      JOIN roles r ON r.id=u.rol_id
      WHERE r.nombre='maestro' AND u.activo=1
      ORDER BY u.apellido
    ");
    return $stmt->fetchAll();
  }

  public static function disableUser(int $id) {
    $stmt = db()->prepare("UPDATE usuarios SET activo=0 WHERE id=?");
    return $stmt->execute([$id]);
  }
}
