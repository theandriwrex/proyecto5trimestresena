<?php
session_start();
require_once __DIR__ . "/../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email  = trim($_POST["email"]);
    $clave  = trim($_POST["clave"]);
    $clave1 = trim($_POST["clave1"]);

    $error = [];
    
    if (empty($email) || empty($clave) || empty($clave1)) {
        $error ['contenido'] = "este campo es obligatorio";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error ['email'] = "Email no válido.";
        exit;
    }

    if ($clave !== $clave1) {
        $error ['clave'] = "Las contraseñas no coinciden.";
        exit;
    }

    $clave_hash = password_hash($clave, PASSWORD_DEFAULT);

    $sql = "UPDATE usuarios SET clave =  :clave WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":clave", $clave_hash);
    $stmt->bindParam(":email", $email);

    if ($stmt->execute()){
        echo "Usuario registrado correctamente.";
        echo "<script>
                        setTimeout(function(){
                            window.location.href = '../views/login.php';
                        }, 700);
                    </script>";
    } else {
        $error ['busqueda'] = "no se encontro el correo : ";
    }
}
?>
