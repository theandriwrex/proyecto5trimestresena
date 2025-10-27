<?php
require_once __DIR__ . '/../models/homep.php';
require_once 'config/conexion.php';

class Homep {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }
        
        $conn = getConnection();
        $modelo = new HomepModel($conn);

        if (isset($_SESSION['usuario'])) {
            // Usar el id numérico de usuario en sesión para obtener la reserva correctamente
            $userId = $_SESSION['id_usuario'] ?? null;
            if ($userId) {
                $reserva = $modelo->obtenerUltimaReserva($userId);
            } else {
                // Si por alguna razón no tenemos id en sesión, no marcar como sin_reserva aquí
                $reserva = null;
            }

            if ($reserva) {
                // Asignar datos a sesión en el controlador y no en el modelo
                $_SESSION["id_reserva"] = $reserva["id_reserva"];
                $_SESSION["nombre_completo"] = $reserva["nombre_completo"];
                $_SESSION["mensaje"] = $reserva["mensaje"];
                $_SESSION["telefono"] = $reserva["telefono"];
                $_SESSION["n_huespedes"] = $reserva["n_huespedes"];
                $_SESSION["genero"] = $reserva["genero"];
                $_SESSION["fecha_ingreso"] = $reserva["fecha_ingreso"];
                $_SESSION["fecha_salida"] = $reserva["fecha_salida"];
                $_SESSION["servicios"] = $reserva["servicios"];
                $_SESSION["metodo_pago"] = $reserva["metodo_pago"];
                unset($_SESSION["sin_reserva"]);

                
            } else {
                $_SESSION["sin_reserva"] = true;
            }

            require 'views/home.php';
        }
        
    }

    
    
    
    // Cierra sesión
    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?controller=loginp&action=index");
        exit;
    }
}
?>
