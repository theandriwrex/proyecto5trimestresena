<?php
require 'models/login.php';
class Registrop {
    
    public function index() {
        require 'views/registro.php';
    }


    public function guardar() {
        $errores = [];
        
        if (empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['nombre']) || empty($_POST['email'])) {
            $errores[] = "Todos los campos son obligatorios.";
        } else {
            $usuario = trim($_POST['usuario']);
            $nombre = trim($_POST['nombre']);
            $email = trim($_POST['email']);
            $clave_plana = $_POST['clave'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores[] = "El email no es válido.";
            }
            if (strlen($usuario) < 3) {
                $errores[] = "El usuario debe tener al menos 3 caracteres.";
            }
            if (strlen($clave_plana) < 6) {
                $errores[] = "La clave debe tener al menos 6 caracteres.";
            }
        }

        if (count($errores) === 0) {
            
            $conn = getConnection();

            $clave = password_hash($clave_plana, PASSWORD_DEFAULT);

            $model = new LoginModel($conn);
            $data = $model->registrarUsuario($usuario, $email, $clave);
            
            if ($data) {
                $mensaje = "Usuario registrado correctamente.";
                header("Location: /prime/index.php?controller=loginp&action=index");
                exit;
            } else {
                $errorInfo = $stmt->errorInfo();
                $errores[] = "Error SQL: " . $errorInfo[2];
            }
        }

        // Renderiza la vista y pasa los errores/mensajes de estado
        require 'views/registro.php';
    }
}
?>
