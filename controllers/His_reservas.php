<?php
require_once "config/conexion.php";
require_once "models/ver_reservas.php";

class His_reservas{

    public function index(){
        session_start();        

        $conn = getConnection();
        $modelo = new VerReservasModel($conn);

        if (!isset($_SESSION['id_usuario'])) {
            header("Location: index.php?controller=loginp&action=index");
            exit();
        }

        $id_usuario = $_SESSION['id_usuario'];
        // Obtener las reservas y guardarlas en sesión para la vista
        $reservas = $modelo->obtenerReservasPorUsuario($id_usuario);
        $_SESSION['reservas'] = $reservas;

        // Cargar la vista correcta
        require_once "views/hreservas.php";
    }

    public function generarReporte() {
        
        require 'views/reports/reporte_reservas.php';
        exit();
    }
}



?>