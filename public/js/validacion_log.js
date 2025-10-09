    document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form");
    const usuarioInput = form.querySelector('input[name="usuario"]');
    const claveInput = form.querySelector('input[name="clave"]');

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        
        document.querySelectorAll(".error").forEach(el => el.textContent = "");

        let valido = true;

        const usuario = usuarioInput.value.trim();
        const clave = claveInput.value.trim();


        if (usuario === ""  ) {
            document.getElementById("usuario_error").textContent ="El campo usuario es obligatorio.";
            valido = false;
        }

        if (clave === ""  ) {
            document.getElementById("clave_error").textContent ="El campo usuario es obligatorio.";
            valido = false;
        }

        if (valido) {
            form.submit();
        }
    });
});