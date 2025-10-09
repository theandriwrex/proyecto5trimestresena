<?php
require_once 'config/conexion.php';

class Loginp {
    // Muestra el formulario de login
    public function index() {
        require 'views/login.php';
    }

    // Procesa el inicio de sesión
    public function autenticar() {
        $errores = [];
        session_start();

        if (!isset($_POST['usuario'], $_POST['clave'])) {
            $errores[] = "Debes completar usuario y clave.";
        } else {
            $usuario = trim($_POST['usuario']);
            $clave   = $_POST['clave'];

            global $conn;
            $sql = "SELECT * FROM usuarios WHERE usuario=:usuario";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user || !password_verify($clave, $user['clave'])) {
                $errores[] = "Usuario o clave incorrectos.";
            } else {
                // Inicio de sesión exitoso
                $_SESSION['usuario'] = $user['usuario'];
                $_SESSION['nombre'] = $user['nombre'];
                
                header("Location: index.php?controller=homep&action=index");
                exit;
            }
        }

        // Si algo falla, vuelve a mostrar el login con errores
        require 'views/login.php';
    }

}
?>
