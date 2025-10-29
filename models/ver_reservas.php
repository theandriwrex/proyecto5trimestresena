<?php

require_once __DIR__ . "/../config/conexion.php";


class VerReservasModel {
    private $conn;

    public function __construct($conexion) {
        $this->conn = $conexion;
    }

    // Obtener reservas por id de usuario (parámetro explícito)
    public function obtenerReservasPorUsuario($usuario_id) {
        $sql = "SELECT * FROM reservas WHERE id_usuario = :id_usuario ORDER BY fecha_registro DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id_usuario", $usuario_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerReservaPorId($id_reserva) {

        $sql = "SELECT * FROM reservas WHERE id_reserva = :id_reserva LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_reserva', $id_reserva, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }


}



?>
