<?php
class Curso {
  public static function create(string $nombre) {
    $stmt = db()->prepare("INSERT INTO cursos (nombre) VALUES (?)");
    return $stmt->execute([$nombre]);
  }

  public static function allActivos() {
    $stmt = db()->query("SELECT * FROM cursos WHERE activo=1 ORDER BY nombre");
    return $stmt->fetchAll();
  }

  public static function disable(int $id) {
    $stmt = db()->prepare("UPDATE cursos SET activo=0 WHERE id=?");
    return $stmt->execute([$id]);
  }

  public static function find(int $id) {
  $stmt = db()->prepare("SELECT * FROM cursos WHERE id=? LIMIT 1");
  $stmt->execute([$id]);
  return $stmt->fetch();
  }
}
