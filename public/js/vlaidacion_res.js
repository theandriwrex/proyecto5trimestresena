document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formReserva");

  form.addEventListener("submit", function (e) {
    const errores = {};

    const nombre = form.nombre.value.trim();
    const telefono = form.telefono.value.trim();
    const n_huespedes = parseInt(form.n_huespedes.value.trim()) || 0;
    const fecha_ingreso = form.fecha_ingreso.value;
    const fecha_salida = form.fecha_salida.value;
    const genero = form.genero.value;
    const metodo_pago = form.metodo_pago.value;

    const hoy = new Date();
    hoy.setHours(0,0,0,0);

    

    if (nombre === "") {
      errores.nombre = "El nombre es obligatorio.";
    } else if (nombre.length < 6) {
      errores.nombre = "El nombre debe tener al menos 6 caracteres.";
    }

    if (telefono === "") {
      errores.telefono = "El teléfono es obligatorio.";
    } else if (!/^[0-9]+$/.test(telefono)) {
      errores.telefono = "El teléfono solo debe contener números.";
    } else if (telefono.length !== 11) {
      errores.telefono = "El teléfono debe tener 11 dígitos.";
    }

    if (n_huespedes <= 0) {
      errores.n_huespedes = "Debe indicar al menos un huésped.";
    }

    if (fecha_ingreso === "" || fecha_salida === "") {
      errores.fechas = "Las fechas son obligatorias.";
    } else {
      const fIngreso = new Date(fecha_ingreso);
      const fSalida = new Date(fecha_salida);

      if (fIngreso < hoy || fSalida < hoy) {
        errores.fechas = "Las fechas no pueden ser anteriores a hoy.";
      } else if (fSalida <= fIngreso) {
        errores.fechas = "La fecha de salida debe ser posterior a la de ingreso.";
      }
    }

    if (genero === "" || genero === null) {
      errores.genero = "Debe seleccionar un género.";
    }

    const metodosValidos = ["efectivo","tarjeta","transferencia"];
    if (!metodosValidos.includes(metodo_pago)) {
      errores.metodo_pago = "Debe seleccionar un método de pago válido.";
    }

    if (Object.keys(errores).length > 0) {
      e.preventDefault();
      mostrarErrores(errores);
    }
  });

  function mostrarErrores(errores) {

    document.querySelectorAll(".error-msg").forEach(el => el.remove());

    for (let campo in errores) {
      const input = form.querySelector(`[name="${campo}"]`);
      if (input) {
        const span = document.createElement("span");
        span.classList.add("error-msg");
        span.style.color = "red";
        span.textContent = errores[campo];
        input.insertAdjacentElement("afterend", span);
      } else if (campo === "fechas") {

         const inputFecha = form.querySelector(`[name="fecha_ingreso"]`);
        const span = document.createElement("span");
        span.classList.add("error-msg");
        span.style.color = "red";
        span.textContent = errores[campo];
        inputFecha.insertAdjacentElement("afterend", span);
      }
    }
  }
});

