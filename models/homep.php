<?php
class HomepModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obtenerUltimaReserva($id_usuario) {
        $sql = "SELECT * FROM reservas WHERE id_usuario = :id_usuario ORDER BY fecha_registro DESC LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
