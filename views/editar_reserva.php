<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["usuario"])) {
    header("Location: ../views/login.php");
    exit;
}

// Convertir los servicios de la base de datos en array (si están separados por comas)
$servicios_guardados = [];
if (!empty($reserva['servicios'])) {
    $servicios_guardados = explode(',', $reserva['servicios']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Reserva</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url('https://www.shutterstock.com/image-photo/luxury-hotel-room-tokyo-japan-600nw-2245471451.jpg');
      background-size: cover;
      background-position: center;
      color: #fff;
    }
    .form-container {
      backdrop-filter: blur(10px);
      background-color: rgba(0, 0, 0, 0.7);
      border-radius: 15px;
      padding: 2rem;
      max-width: 800px;
      margin: 50px auto;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
  </style>
</head>
<body>

<div class="container">
  <div class="form-container shadow-lg">
    <h2 class="text-center text-uppercase fw-bold text-light mb-3">Editar Reserva</h2>
    <p class="text-center text-info mb-4">Modifica tu reserva existente</p>

    <form action="index.php?controller=editar_reservas&action=actualizar" method="POST" class="row g-3">
      <input type="hidden" name="id_reserva" value="<?php echo htmlspecialchars($reserva['id_reserva']); ?>">

      <!-- Número de huéspedes -->
      <div class="col-md-6">
        <label for="n_huespedes" class="form-label">Número de Huéspedes</label>
        <input type="number" class="form-control shadow-sm" id="n_huespedes" name="n_huespedes" 
               min="1" value="<?php echo htmlspecialchars($reserva['n_huespedes']); ?>" required>
      </div>

      <!-- Fecha de ingreso -->
      <div class="col-md-6">
        <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
        <input type="date" class="form-control shadow-sm" id="fecha_ingreso" name="fecha_ingreso" 
               value="<?php echo htmlspecialchars($reserva['fecha_ingreso']); ?>" required>
      </div>

      <!-- Fecha de salida -->
      <div class="col-md-6">
        <label for="fecha_salida" class="form-label">Fecha de Salida</label>
        <input type="date" class="form-control shadow-sm" id="fecha_salida" name="fecha_salida" 
               value="<?php echo htmlspecialchars($reserva['fecha_salida']); ?>" required>
      </div>

      <!-- Mensaje -->
      <div class="col-12">
        <label for="mensaje" class="form-label">Mensaje</label>
        <textarea class="form-control shadow-sm" id="mensaje" name="mensaje" rows="3"><?php echo htmlspecialchars($reserva['mensaje']); ?></textarea>
      </div>

      <!-- Servicios -->
      <div class="col-12">
        <p class="fw-bold text-warning mb-2">Servicios Adicionales</p>
        <div class="row">
          <div class="col-md-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="servicio_transporte" name="servicios[]" value="transporte"
                <?php echo in_array('transporte', $servicios_guardados) ? 'checked' : ''; ?>>
              <label class="form-check-label" for="servicio_transporte">Transporte</label>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="servicio_comida" name="servicios[]" value="comida"
                <?php echo in_array('comida', $servicios_guardados) ? 'checked' : ''; ?>>
              <label class="form-check-label" for="servicio_comida">Comidas Buffet</label>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="servicio_gimnasio" name="servicios[]" value="gimnasio"
                <?php echo in_array('gimnasio', $servicios_guardados) ? 'checked' : ''; ?>>
              <label class="form-check-label" for="servicio_gimnasio">Gimnasio</label>
            </div>
          </div>
        </div>
      </div>

      <!-- Botones -->
      <div class="col-12 text-center mt-4">
        <button type="submit" class="btn btn-warning px-4 fw-bold">Guardar Cambios</button>
        <a href="index.php?controller=His_reservas&action=index" class="btn btn-secondary px-4 ms-2">Cancelar</a>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
