# Kadetes Jumper | Asistencia (PHP + MySQL)

Aplicación web responsive para registrar, editar y consultar asistencia de estudiantes por curso, con roles **Admin** y **Maestro**.

## ✅ Requisitos

- XAMPP (Apache + MySQL)
- Navegador (Chrome/Edge)
- phpMyAdmin

## 📌 Instalación y ejecución (local)

1. Copia el proyecto en:
   `C:\xampp\htdocs\jumper`

2. Inicia **Apache** y **MySQL** desde XAMPP.

3. Importa la base de datos:
   - Abre `http://localhost/phpmyadmin`
   - Crea la BD: `jumper_asistencia`
   - Entra a la BD → **Importar**
   - Selecciona: `database/database.sql` → Continuar

4. Configura conexión (si aplica):
   - Archivo: `app/config/config.php`
   - Verifica:
     - DB_HOST = localhost
     - DB_NAME = jumper_asistencia
     - DB_USER = root
     - DB_PASS = (vacío por defecto en XAMPP)

5. Abre la app:
   `http://localhost/jumper/public/`

## 👤 Accesos de prueba

> Estos datos pueden variar según tu base importada.

- Admin:
  - correo: `admin@jumper.com`
  - clave: `Jumper123*`

## ✨ Funcionalidades

- Login por correo y contraseña
- Roles: Administrador / Maestro
- Admin:
  - Crear cursos
  - Crear usuarios (maestros)
  - Eliminar (desactivar) cursos y maestros
- Maestro:
  - Crear estudiantes
  - Registrar asistencia por fecha
  - Editar asistencia
  - Consultar asistencia
  - Descargar reporte en PDF (si aplica)

## 🗄️ Base de datos

El script completo (estructura + datos) está en:
`database/jumper_asistencia.sql`
