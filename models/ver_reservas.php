<?php
session_start();
require_once __DIR__ . "/../config/conexion.php";

$usuario_id = $_SESSION["id_usuario"]; // ojo, en homep.php usas id_usuario
$sql = "SELECT * FROM reservas WHERE id_usuario = :id_usuario ORDER BY fecha_registro DESC";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id_usuario", $usuario_id);
$stmt->execute();

$reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$reservas) {
    $_SESSION["sin_reserva"] = true;
} else {
    $_SESSION["reservas"] = $reservas; 
}



?>
