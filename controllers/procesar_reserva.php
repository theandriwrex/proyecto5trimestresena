<?php
session_start();
require_once __DIR__ . "/../config/conexion.php";

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    
    if (empty($nombre)) {
        $errores['nombre'] = "El nombre es obligatorio.";
    }elseif(strlen($nombre) < 6){
        $errores['nombre'] = "el nombre tiene que tener mas de 6 letras";
    }


    if (empty($telefono)) {
        $errores['telefono'] = "El teléfono es obligatorio.";
    } elseif (!preg_match('/^[0-9]+$/', $telefono)) {
        $errores['telefono'] = "El teléfono solo debe contener números.";
    }elseif( strlen($telefono) != 11){
        $errores['telefono'] = "el telefono debe tener 11 digitos";
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

    if (!in_array($metodo_pago, $metodosValidos)) {
        $errores['metodo_pago'] = "Método de pago inválido.";
    }

    if (!empty($errores)) {
        $_SESSION['errores'] = $errores;
        header("Location: formulario.php");
        exit;
    }

    if (empty($genero)) {
        $errores['genero'] = "El genero no puede ser vacio.";
    }

    $fecha_registro = date("Y-m-d H:i:s");

    try {
        $sql = "INSERT INTO reservas 
            (id_usuario, nombre_completo, telefono, n_huespedes, genero, mensaje, servicios, metodo_pago, fecha_ingreso, fecha_salida, fecha_registro)
            VALUES (:id_usuario, :nombre, :telefono, :n_huespedes, :genero, :mensaje, :servicios, :metodo_pago, :fecha_ingreso, :fecha_salida, :fecha_registro)";

        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ":id_usuario"    => $id_usuario,
            ":nombre"        => $nombre,
            ":telefono"      => $telefono,
            ":n_huespedes"   => $n_huespedes,
            ":genero"        => $genero,
            ":mensaje"       => $mensaje,
            ":servicios"     => $servicios,
            ":metodo_pago"   => $metodo_pago,
            ":fecha_ingreso" => $fecha_ingreso,
            ":fecha_salida"  => $fecha_salida,
            ":fecha_registro"=> $fecha_registro
        ]);

        header("Location: ../views/home.php?reserva=ok");
        exit;

    } catch (PDOException $e) {
        die("❌ Error al guardar la reserva: " . $e->getMessage());
    }
}
