<?php
session_start();
require_once __DIR__ . "/../config/conexion.php";
require_once __DIR__ . "/../models/reserva.php";

class procesar_reserva {

    public function index() {
        require_once __DIR__ . '/../views/index1.php';
    }

    public function guardar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            try {

                $conn = getConnection();
                $modelo = new ReservaModel($conn);

                $id_usuario    = $_SESSION["id_usuario"];
                $nombre        = trim($_POST["nombre"] ?? "");
                $telefono      = trim($_POST["telefono"] ?? "");
                $n_huespedes   = intval($_POST["n_huespedes"] ?? 0);
                $fecha_ingreso = $_POST["fecha_ingreso"] ?? "";
                $fecha_salida  = $_POST["fecha_salida"] ?? "";
                $genero        = $_POST["genero"] ?? "";
                $mensaje       = trim($_POST["mensaje"] ?? "");
                
                $serviciosSeleccionados = $_POST["servicios"] ?? [];
                $servicios = !empty($serviciosSeleccionados) ? implode(",", $serviciosSeleccionados) : "";

                $metodo_pago = $_POST["metodo_pago"] ?? "";

                $hoy = date("Y-m-d");
                $errores = [];
                $metodosValidos = ['efectivo','tarjeta','transferencia'];

                // --- Validaciones ---
                if (empty($nombre)) {
                    $errores['nombre'] = "El nombre es obligatorio.";
                } elseif (strlen($nombre) < 6) {
                    $errores['nombre'] = "El nombre debe tener más de 6 letras.";
                }

                if (empty($telefono)) {
                    $errores['telefono'] = "El teléfono es obligatorio.";
                } elseif (!preg_match('/^[0-9]+$/', $telefono)) {
                    $errores['telefono'] = "El teléfono solo debe contener números.";
                } elseif (strlen($telefono) != 10) {
                    $errores['telefono'] = "El teléfono debe tener 11 dígitos.";
                }

                if ($n_huespedes <= 0) {
                    $errores['n_huespedes'] = "Debe indicar al menos un huésped.";
                }

                if (empty($fecha_ingreso) || empty($fecha_salida)) {
                    $errores['fechas'] = "Las fechas son obligatorias.";
                } elseif ($fecha_ingreso < $hoy || $fecha_salida < $hoy) {
                    $errores['fechas'] = "Las fechas no pueden ser anteriores a hoy.";
                } elseif ($fecha_salida <= $fecha_ingreso) {
                    $errores['fechas'] = "La fecha de salida debe ser posterior a la de ingreso.";
                }

                if (empty($genero)) {
                    $errores['genero'] = "El género no puede estar vacío.";
                }

                if (!in_array($metodo_pago, $metodosValidos)) {
                    $errores['metodo_pago'] = "Método de pago inválido.";
                }

                if (!empty($errores)) {
                    $_SESSION['errores'] = $errores;
                    header("Location: index.php?controller=procesar_reserva&action=index");
                    exit;
                }

                // Verificar que tengamos id_usuario antes de intentar insertar
                if (empty($id_usuario)) {
                    $_SESSION['error_general'] = "No se pudo identificar al usuario. Por favor inicia sesión de nuevo.";
                    header("Location: index.php?controller=procesar_reserva&action=index");
                    exit;
                }

                $resultado = $modelo->crearReserva(
                    $id_usuario,
                    $nombre,
                    $mensaje,
                    $telefono,
                    $n_huespedes,
                    $genero,
                    $fecha_ingreso,
                    $fecha_salida,
                    $servicios,
                    $metodo_pago
                );

                if (is_array($resultado) && !empty($resultado['success'])) {
                    $_SESSION["reserva_exitosa"] = "La reserva se ha registrado correctamente.";
                    header("Location: index.php?controller=homep&action=index");
                } else {
                    $_SESSION["error_general"] = "Hubo un error al guardar la reserva.";
                    // Guardar información de depuración para mostrar en la vista
                    if (is_array($resultado) && isset($resultado['error'])) {
                        $_SESSION['debug_reserva'] = $resultado['error'];
                        if (isset($resultado['inputs'])) {
                            $_SESSION['debug_inputs_reserva'] = $resultado['inputs'];
                        }
                    }
                    header("Location: index.php?controller=procesar_reserva&action=index");
                }
            }
            catch (Exception $e) {
                echo "<pre style='color:red'><b>Excepción capturada:</b> " . $e->getMessage() . "</pre>";
            }
            exit;
        }
    }
}
?>



<!-- $fecha_registro = date("Y-m-d H:i:s"); -->