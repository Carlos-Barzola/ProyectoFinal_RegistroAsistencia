function validarLogin(){
  const c = document.getElementById('correo')?.value?.trim();
  const p = document.getElementById('password')?.value?.trim();
  if(!c || !p){ alert('Completa correo y contraseña'); return false; }
  return true;
}

function validarCurso(){
  const n = document.getElementById('nombre')?.value?.trim();
  if(!n){ alert('Nombre obligatorio'); return false; }
  return true;
}

function validarMaestro(){
  const nombre = document.getElementById('nombre').value.trim();
  const apellido = document.getElementById('apellido').value.trim();
  const correo = document.getElementById('correo').value.trim();
  const pass = document.getElementById('password').value.trim();
  const curso = document.getElementById('curso_id').value;

  if(!nombre || !apellido || !correo || !pass || !curso){
    alert('Completa todos los campos'); return false;
  }
  return true;
}

function validarEstudiante(){
  const n = document.getElementById('nombres').value.trim();
  const a = document.getElementById('apellidos').value.trim();
  const e = parseInt(document.getElementById('edad').value, 10);
  if(!n || !a || !e || e <= 0){ alert('Datos inválidos'); return false; }
  return true;
}

// Oculta mensajes flash después de 5 segundos
document.addEventListener("DOMContentLoaded", () => {
  const flash = document.querySelector(".flash");
  if (!flash) return;

  setTimeout(() => {
    flash.style.transition = "opacity .25s ease, transform .25s ease";
    flash.style.opacity = "0";
    flash.style.transform = "translateY(-6px)";
    setTimeout(() => flash.remove(), 260);
  }, 3500);
});
