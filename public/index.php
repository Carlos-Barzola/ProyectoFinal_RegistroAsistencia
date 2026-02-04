<?php
require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/config/db.php';

require_once __DIR__ . '/../app/core/Auth.php';
require_once __DIR__ . '/../app/core/Router.php';

require_once __DIR__ . '/../app/models/User.php';
require_once __DIR__ . '/../app/models/Curso.php';
require_once __DIR__ . '/../app/models/Estudiante.php';
require_once __DIR__ . '/../app/models/Asistencia.php';

require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';
require_once __DIR__ . '/../app/controllers/MaestroController.php';

Router::run();
