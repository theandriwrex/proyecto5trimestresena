<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../models/ver_reservas.php';

class editar_reservas {

    private $model;

    public function __construct() {
        $pdo = getConnection();
        $this->model = new VerReservasModel($pdo);
    }

    public function index() {
        session_start();
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: login.php");
            exit;
        }

        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=His_reservas&action=index");
            exit;
        }

        $id_reserva = intval($_GET['id']);
        $reserva = $this->model->obtenerReservaPorId($id_reserva);

        // Seguridad: verificar que la reserva pertenece al usuario logueado
        if (!$reserva || $reserva['id_usuario'] != $_SESSION['id_usuario']) {
            die("Acceso denegado.");
        }

        require __DIR__ . '/../views/editar_reserva.php';
    }

   public function actualizar() {
        session_start();
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: login.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_reserva = intval($_POST['id_reserva']);

            $servicios = '';
            if (isset($_POST['servicios']) && is_array($_POST['servicios'])) {
                $servicios = implode(',', $_POST['servicios']); // ej: "transporte,comida"
            }

            $datos = [
                'n_huespedes'   => $_POST['n_huespedes'],
                'mensaje'       => $_POST['mensaje'],
                'fecha_ingreso' => $_POST['fecha_ingreso'],
                'fecha_salida'  => $_POST['fecha_salida'],
                'servicios'     => $servicios
            ];

            $resultado = $this->model->actualizarReservaParcial($id_reserva, $datos);

            if ($resultado) {
                header("Location: index.php?controller=His_reservas&action=index&msg=edit_success");
                exit;
            } else {
                echo "❌ Error al actualizar la reserva.";
            }
        }
    }


    public function cancelar() {
        session_start();
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: login.php");
            exit;
        }

        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=His_reservas&action=index");
            exit;
        }

        $id_reserva = intval($_GET['id']);
        $reserva = $this->model->obtenerReservaPorId($id_reserva);

        if (!$reserva || $reserva['id_usuario'] != $_SESSION['id_usuario']) {
            die("Acceso denegado.");
        }

        $resultado = $this->model->cancelarReserva($id_reserva);

        if ($resultado) {
            header("Location: index.php?controller=His_reservas&action=index&msg=cancel_success");
            exit;
        } else {
            echo "❌ Error al cancelar la reserva.";
        }
    }


}
?>
