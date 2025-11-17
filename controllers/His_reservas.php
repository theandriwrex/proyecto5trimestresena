<?php
require_once "config/conexion.php";
require_once "models/ver_reservas.php";
require_once __DIR__ . '/../vendor/autoload.php';

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


    public function generarReporteExcel() {
        session_start();
        require_once __DIR__ . '/../views/reports/reporte_reserva_excel.php';
        exit();
    }


    public function enviarCorreoAjax() {

        session_start();

        if (!isset($_SESSION['correo'])) {
            echo json_encode(['success' => false, 'error' => 'Correo no disponible en sesión']);
            return;
        }

        $id_reserva = $_POST['id_reserva'] ?? null;

        if (!$id_reserva) {
            echo json_encode(['success' => false, 'error' => 'ID no recibido']);
            return;
        }

        require 'vendor/autoload.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            // Config SMTP
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "theandriwrex@gmail.com";
            $mail->Password = "vrpr mmyu prrp hrva";
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;

            // Dirección del hotel
            $mail->setFrom("TU_CORREO@gmail.com", "Hotel Spyce");

            // 📌 Destino → correo del usuario logueado
            $mail->addAddress($_SESSION['correo'], $_SESSION['nombre']);

            $mail->isHTML(true);
            $mail->Subject = "Confirmación de Reserva";
            $mail->Body = "Hola " . $_SESSION['nombre'] . ", tu reserva #" . $id_reserva . " fue confirmada.";

            $mail->send();

            echo json_encode(['success' => true]);

        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $mail->ErrorInfo]);
        }
    }


    
}


?>