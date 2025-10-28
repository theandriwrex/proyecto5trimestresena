<?php
class LoginModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function loguearUsuario($usuario) {
        $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registrarUsuario($usuario, $email, $clave) {
        $sql = "INSERT INTO usuarios (usuario, clave, nombre, email) VALUES (:usuario, :clave, :nombre, :email)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':clave', $clave);
        return $stmt->execute();
    }
}
?>