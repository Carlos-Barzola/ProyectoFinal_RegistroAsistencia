# Kadetes Jumper | Asistencia (PHP + MySQL)

Aplicación web responsive para el registro, edición y consulta de asistencia de estudiantes por curso, desarrollada en **PHP + MySQL**, con roles **Administrador** y **Maestro**.

---

## 🌐 Enlaces de acceso (Producción)

- **Frontend (Netlify):**  
  👉 https://web-jumper.netlify.app/

- **Backend / Aplicación (Render):**  
  👉 https://proyectofinal-registroasistencia.onrender.com/?page=login

> La aplicación es accesible desde cualquier navegador web sin configuración adicional.

---

## ⚙️ Tecnologías utilizadas
- PHP 8
- MySQL (Base de datos en la nube)
- HTML, CSS, JavaScript
- Render (Backend)
- Netlify (Frontend)
- GitHub (Control de versiones)

---

## 📌 Instalación local (opcional)
1. Clonar el repositorio.
2. Copiar el proyecto en `C:\xampp\htdocs\`.
3. Importar la base de datos desde `database/database.sql`.
4. Configurar credenciales en `app/config/config.php`.
5. Acceder desde:  
   `http://localhost/jumper/public/`

---

## 👤 Roles del sistema
- **Administrador**
  - Crear cursos
  - Crear usuarios (maestros)
  - Eliminar cursos y usuarios

- **Maestro**
  - Crear estudiantes
  - Registrar asistencia por fecha
  - Editar asistencia
  - Consultar asistencia
  - Descargar reportes (PDF)

---

## 🗄️ Base de datos
El script completo de la base de datos (estructura + datos) se encuentra en:

