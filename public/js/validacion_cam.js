    document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form");
    const emailInput = form.querySelector('input[name="email"]');
    const contraseñaInput = form.querySelector('input[name="contraseña"]');
    const contraseñaInput1 = form.querySelector('input[name="contraseña1"]');


    form.addEventListener("submit", function (e) {
        const email = emailInput.value.trim();
        const contraseña = contraseñaInput.value;
        const contraseña1 = contraseñaInput1.value;

        let valido = true

        if (email === "") {
            document.getElementById('email_error').textContent = "la contraseña es obligatoria"
            valido = false

        } else if (email.length < 3) {
            document.getElementById('email_error').textContent = "las contraseñas no coinciden"
            valido = false

        }

        if (contraseña.length && contraseña1.length < 6) {
            document.getElementById('contraseña_error').textContent = "La contraseña debe tener al menos 6 caracteres."
            document.getElementById('contraseña1_error').textContent = "La contraseña debe tener al menos 6 caracteres."
            valido = false

        }
        
        if (contraseña !== contraseña1){
            document.getElementById('contraseña_error').textContent = "las contraseñas no coinciden"
            document.getElementById('contraseña1_error').textContent = "las contraseñas  no coinciden"
            valido = false

        }

        if (valido) {
            form.submit();
        }
    });
});


