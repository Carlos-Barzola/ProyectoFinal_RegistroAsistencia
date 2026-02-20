# Kadetes Jumper | Sistema de Asistencia (PHP + MySQL)

[![Frontend Netlify](https://img.shields.io/badge/Frontend-Netlify-00C7B7?logo=netlify&logoColor=white)](https://asistencia-kadetes-jumper.netlify.app/)

[![Backend Render](https://img.shields.io/badge/Backend-Render-46E3B7?logo=render&logoColor=white)](https://proyectofinal-registroasistencia.onrender.com/?page=login)

Aplicación web responsive para el registro, edición y consulta de asistencia de estudiantes por curso, desarrollada en **PHP + MySQL**, con control de acceso por roles **Administrador** y **Maestro**.

---

## 🌐 Enlaces de acceso (Producción)

- **Frontend (Netlify):**  
  👉 https://asistencia-kadetes-jumper.netlify.app/

- **Backend / Aplicación (Render):**  
  👉 https://proyectofinal-registroasistencia.onrender.com/?page=login

> La aplicación es accesible desde cualquier navegador web sin configuración adicional.

---

## 🏗 Arquitectura del Sistema

El proyecto sigue una arquitectura tipo **MVC (Modelo - Vista - Controlador)** y está desplegado completamente en la nube.


Usuario

↓

Frontend (Netlify)

↓

Backend PHP (Render)

↓

Base de Datos MySQL (Aiven - nube)

---

## ⚙️ Tecnologías utilizadas
- PHP 8
- MySQL
- HTML5
- CSS3
- JavaScript
- GitHub (control de versiones)
- Render (despliegue backend)
- Netlify (frontend estático)
- Aiven (base de datos MySQL en la nube)

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
 
## 🔐 Seguridad

- Contraseñas almacenadas mediante `password_hash()`
- Validación con `password_verify()`
- Control de sesión
- Restricción por roles
- Protección mediante clase `Auth`

---

## 🗄 Base de Datos

La base de datos incluye las siguientes tablas:

- roles
- usuarios
- cursos
- estudiantes
- asistencias

---

## 📌 Instalación local (opcional)
1. Clonar el repositorio.
2. Copiar el proyecto en `C:\xampp\htdocs\`.
3. Importar la base de datos desde `database/database.sql`.
4. Configurar credenciales en `app/config/config.php`.
5. Acceder desde:  
   `http://localhost/jumper/public/`

---

## 🚀 Despliegue en Producción

### 🔹 Backend (Render)
- Servicio Web PHP
- Variables de entorno configuradas:
  - DB_HOST
  - DB_PORT
  - DB_NAME
  - DB_USER
  - DB_PASS

### 🔹 Base de Datos (Aiven)
- Servicio MySQL en la nube
- Conexión segura mediante SSL
- Integrada al backend mediante variables de entorno

### 🔹 Frontend (Netlify)
- Landing estática
- Redirige al backend en Render

---

## 📈 Posibles Mejoras Futuras

- Reportes avanzados
- Panel de estadísticas
- Notificaciones automáticas
- Integración con correo electrónico

---

## 👨‍💻 Autor

Carlos Barzola  
Estudiante de Ingeniería en Software
Universidad de Guayaquil
