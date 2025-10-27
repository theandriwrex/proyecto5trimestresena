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

}



?>
