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
        session_start();        


        $conn = getConnection();
        $modelo = new VerReservasModel($conn);
        $id_usuario = $_SESSION['id_usuario'];
        $reservas = $modelo->obtenerReservasPorUsuario($id_usuario);
        $_SESSION['reservas'] = $reservas;
        require_once __DIR__ . '/../views/reports/reporte_reservas.php';
        exit();

    }

    public function generarReporteIndividual() {
        session_start();

        if (!isset($_GET['id'])) {
            die("ID de reserva no especificado.");
        }

        $id_reserva = intval($_GET['id']);
        $conn = getConnection();
        $modelo = new VerReservasModel($conn);

        $reserva = $modelo->obtenerReservaPorId($id_reserva);
        $_SESSION['reserva_individual'] = $reserva;

        require 'views/reports/reporte_reserva_individual.php';
        exit();
    }


    


    
}



?>