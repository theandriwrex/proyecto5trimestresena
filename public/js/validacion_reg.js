document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("form");
  const usuarioInput = form.querySelector('input[name="usuario"]');
  const claveInput = form.querySelector('input[name="clave"]');
  const correoInput = form.querySelector('input[name="email"]');
  const nombreInput = form.querySelector('input[name="nombre"]');

  form.addEventListener("submit", function (e) {
    e.preventDefault();

   
    document.querySelectorAll(".error").forEach(el => el.textContent = "");

    let valido = true;

    if (usuarioInput.value.trim() === "") {
      document.getElementById("usuario_error").textContent = "El campo usuario es obligatorio.";
      valido = false;
    } else if (usuarioInput.value.trim().length < 3) {
      document.getElementById("usuario_error").textContent = "El usuario debe tener al menos 3 caracteres.";
      
      valido = false;
    }

    if (nombreInput.value.trim() === "") {
      document.getElementById("nombre_error").textContent = "El nombre es obligatorio.";
      valido = false;
    } else if (nombreInput.value.trim().length < 6) {
      document.getElementById("nombre_error").textContent = "El nombre tiene que tener más de 6 letras.";
      valido = false;
    }

    const clave = claveInput.value.trim();
    if (clave === "") {
      document.getElementById("clave_error").textContent = "La clave es obligatoria";
      valido = false;
    } else if (clave.length < 3) {
      document.getElementById("clave_error").textContent = "La clave no puede tener menos de 3 caracteres";
      valido = false;
    } else if (!/^(?=.*\d)(?=.*[^a-zA-Z0-9]).+$/.test(clave)) {
      document.getElementById("clave_error").textContent = "La clave debe tener al menos un número y un símbolo";
      valido = false;
    }

    const correo = correoInput.value.trim();
    if (correo === "") {
      document.getElementById("email_error").textContent = "El email es obligatorio.";
      valido = false;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo)) {
      document.getElementById("email_error").textContent = "El email no es válido.";
      valido = false;
    }

    if (valido) {
      form.submit();
    }
  });
});



