<?php
class Auth {
  public static function user() {
    return $_SESSION['user'] ?? null;
  }

  public static function requireLogin() {
    if (!self::user()) {
      header("Location: ?page=login");
      exit;
    }
  }

  public static function requireRole(string $roleName) {
    self::requireLogin();
    if (($_SESSION['user']['rol'] ?? '') !== $roleName) {
      http_response_code(403);
      echo "403 - No autorizado";
      exit;
    }
  }
}
