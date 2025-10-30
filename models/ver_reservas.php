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

    public function actualizarReservaParcial($id_reserva, $datos) {
        $sql = "UPDATE reservas 
                SET 
                    n_huespedes = :n_huespedes,
                    mensaje = :mensaje,
                    fecha_ingreso = :fecha_ingreso,
                    fecha_salida = :fecha_salida,
                    servicios = :servicios
                WHERE id_reserva = :id_reserva";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':n_huespedes', $datos['n_huespedes'], PDO::PARAM_INT);
        $stmt->bindParam(':mensaje', $datos['mensaje'], PDO::PARAM_STR);
        $stmt->bindParam(':fecha_ingreso', $datos['fecha_ingreso'], PDO::PARAM_STR);
        $stmt->bindParam(':fecha_salida', $datos['fecha_salida'], PDO::PARAM_STR);
        $stmt->bindParam(':servicios', $datos['servicios'], PDO::PARAM_STR);
        $stmt->bindParam(':id_reserva', $id_reserva, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function cancelarReserva($id_reserva) {
        $sql = "UPDATE reservas SET activo = 0 WHERE id_reserva = :id";
        $stmt = $this->conn->prepare($sql); // <--- cambiar $this->conexion por $this->conn
        $stmt->bindParam(':id', $id_reserva, PDO::PARAM_INT);
        return $stmt->execute();
    }





}



?>
