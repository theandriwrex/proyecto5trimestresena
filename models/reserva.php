<?php
require_once __DIR__ . '/../config/conexion.php';

class ReservaModel {

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function crearReserva($id_usuario, $nombre, $mensaje, $telefono, $n_huespedes, $genero, $fecha_ingreso, $fecha_salida, $servicios, $metodo_pago) {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO reservas (
                        id_usuario, nombre_completo, telefono, n_huespedes, 
                        genero, mensaje, fecha_ingreso, fecha_salida, 
                        servicios, metodo_pago, fecha_registro
                    )VALUES(
                        :id_usuario, :nombre, :telefono, :n_huespedes, 
                        :genero, :mensaje, :fecha_ingreso, :fecha_salida, 
                        :servicios, :metodo_pago, NOW()
                    )";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':n_huespedes', $n_huespedes);
            $stmt->bindParam(':genero', $genero);
            $stmt->bindParam(':mensaje', $mensaje);
            $stmt->bindParam(':fecha_ingreso', $fecha_ingreso);
            $stmt->bindParam(':fecha_salida', $fecha_salida);
            $stmt->bindParam(':servicios', $servicios);
            $stmt->bindParam(':metodo_pago', $metodo_pago);

            if ($stmt->execute()) {
                return ['success' => true];
            } else {
                $err = $stmt->errorInfo();
                return ['success' => false, 'error' => $err, 'inputs' => [
                    'id_usuario' => $id_usuario,
                    'nombre' => $nombre,
                    'telefono' => $telefono,
                    'n_huespedes' => $n_huespedes,
                    'genero' => $genero,
                    'fecha_ingreso' => $fecha_ingreso,
                    'fecha_salida' => $fecha_salida,
                    'servicios' => $servicios,
                    'metodo_pago' => $metodo_pago
                ]];
            }

        } catch (PDOException $e) {
            return ['success' => false, 'error' => [$e->getCode(), $e->getMessage()], 'inputs' => [
                'id_usuario' => $id_usuario,
                'nombre' => $nombre,
                'telefono' => $telefono,
                'n_huespedes' => $n_huespedes,
                'genero' => $genero,
                'fecha_ingreso' => $fecha_ingreso,
                'fecha_salida' => $fecha_salida,
                'servicios' => $servicios,
                'metodo_pago' => $metodo_pago
            ]];
        }
    }

}
?>