//  son para la clave 
const claveInput = document.getElementById("clave");
const reqLongitud = document.getElementById("reqLongitud");
const reqNumero = document.getElementById("reqNumero");
const reqSimbolo = document.getElementById("reqSimbolo");

// el resto de validaciones de los input
const emailInput = document.getElementById("email");
const nombreInput = document.getElementById("nombre");
const usuarioInput = document.getElementById("usuario");


nombreInput.addEventListener("input",function() {
  this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
})

claveInput.addEventListener("input", function() {
  const valor = claveInput.value;

  const tieneLongitud = valor.length >= 8;
  const tieneNumero = /\d/.test(valor);
  const tieneSimbolo = /[^a-zA-Z0-9]/.test(valor);

  reqLongitud.classList.toggle("ok", tieneLongitud);
  reqNumero.classList.toggle("ok", tieneNumero);
  reqSimbolo.classList.toggle("ok", tieneSimbolo);
});


let timeout;

claveInput.addEventListener("input", function() {
  const valor = claveInput.value;

  const tieneLongitud = valor.length >= 6;
  const tieneNumero = /\d/.test(valor);
  const tieneSimbolo = /[^a-zA-Z0-9]/.test(valor);

  reqLongitud.classList.toggle("ok", tieneLongitud);
  reqNumero.classList.toggle("ok", tieneNumero);
  reqSimbolo.classList.toggle("ok", tieneSimbolo);

  if (tieneLongitud && tieneNumero && tieneSimbolo) {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
      reqLongitud.style.display = "none";
      reqNumero.style.display = "none";
      reqSimbolo.style.display = "none";
    }, 1000); 
  } else {
    reqLongitud.style.display = "";
    reqNumero.style.display = "";
    reqSimbolo.style.display = "";
  }
});
