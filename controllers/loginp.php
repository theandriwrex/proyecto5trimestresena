<?php
require_once 'config/conexion.php';
require_once 'models/login.php';

class Loginp {

    public function index() {
        require 'views/login.php';
    }

    public function autenticar() {
     session_start();
     $errores = [];

        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $errores[] = "Debes completar usuario y clave.";
        } else {
            $usuario1 = trim($_POST['usuario']);
            $clave  = $_POST['clave'];

            $conn = getConnection();
            $model = new LoginModel($conn);
            $data = $model->loguearUsuario($usuario1);

            if ($data && password_verify($clave, $data['clave'])) {
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['id_usuario'] = $data['id_usuario'];
                $_SESSION['correo'] = $data['email'];
                header("Location: index.php?controller=homep&action=index");
                exit;
            } else {
                $errores[] = "Usuario o clave incorrectos.";
            }
        }

        require 'views/login.php';
    }

}
?>
