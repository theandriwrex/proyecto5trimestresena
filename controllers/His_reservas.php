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
        header('Content-Type: application/json');

        // verificar datos
        if (!isset($_POST['id_reserva']) || empty($_POST['id_reserva'])) {
            echo json_encode(['success' => false, 'message' => 'ID de reserva no especificado']);
            exit;
        }

        $id = intval($_POST['id_reserva']);
        $email = trim($_POST['email'] ?? '');

        // carga autoload si aún no está cargado (solo si no lo incluyes globalmente)
        if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
            echo json_encode(['success' => false, 'message' => 'autoload de Composer no encontrado']);
            exit;
        }
        require_once __DIR__ . '/../vendor/autoload.php';

        // obtener datos de la reserva (ejemplo)
        $conn = getConnection();
        require_once __DIR__ . '/../models/ver_reservas.php';
        $modelo = new VerReservasModel($conn);
        $reserva = $modelo->obtenerReservaPorId($id);

        if (!$reserva) {
            echo json_encode(['success' => false, 'message' => 'Reserva no encontrada']);
            exit;
        }

        try {
            // Instanciar usando FQCN (sin usar 'use' aquí)
            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'tu_correo@gmail.com';       // cambiar
            $mail->Password   = 'tu_app_password';           // cambiar (app password)
            $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('tu_correo@gmail.com', 'Hotel Spyce');
            $mail->addAddress($reserva['correo'] ?? $email, $reserva['nombre_completo'] ?? '');
            $mail->isHTML(true);
            $mail->Subject = "Confirmación de Reserva #{$reserva['id_reserva']}";
            $mail->Body    = "
                <h2>Confirmación de Reserva</h2>
                <p>Hola <b>" . htmlspecialchars($reserva['nombre_completo']) . "</b>,</p>
                <p>Tu reserva <b>#" . $reserva['id_reserva'] . "</b> para la habitación <b>" . ($reserva['numero_habitacion'] ?? 'N/A') . "</b> 
                desde <b>" . $reserva['fecha_ingreso'] . "</b> hasta <b>" . $reserva['fecha_salida'] . "</b> ha sido confirmada.</p>
                <p>Gracias por elegir Hotel Spyce.</p>
            ";

            $mail->send();
            echo json_encode(['success' => true]);
        } catch (\PHPMailer\PHPMailer\Exception $e) {
            echo json_encode(['success' => false, 'message' => $mail->ErrorInfo ?: $e->getMessage()]);
        }
        exit;
    }


    
}


?>