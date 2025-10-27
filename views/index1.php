<?php
  session_start();
  require_once __DIR__ . "/../config/conexion.php";

  if (!isset($_SESSION["usuario"])) {
    header("Location: ../views/login.php");
    exit;
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reserva tu Estadia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../styles/formulario.css">
</head>
<body class="bg-dark text-light" style="background-image: url('https://www.shutterstock.com/image-photo/luxury-hotel-room-tokyo-japan-600nw-2245471451.jpg'); background-size: cover; background-position: center;">

  <div class="container min-vh-100 d-flex align-items-center justify-content-center" style="background-image: url('https://www.shutterstock.com/image-photo/luxury-hotel-room-tokyo-japan-600nw-2245471451.jpg'); background-size: cover; background-position: center;">
    <div class="p-4 p-md-5 rounded-4 shadow-lg" style="backdrop-filter: blur(12px); background-color: rgba(0, 0, 0, 0.65); max-width: 800px; width: 100%; border: 1px solid rgba(255, 255, 255, 0.2);">
      
      <h2 class="text-center text-uppercase fw-bold text-light mb-3">Reserva tu estadía</h2>
      <p class="text-center text-info mb-4">Bienvenido <span class="fw-bold"><?php echo $_SESSION["nombre"] ?></span></p>

      <form action="../controllers/procesar_reserva.php" method="POST" class="row g-3">
        
        <div class="col-md-6">
          <label for="nombre" class="form-label">Nombre Completo</label>
          <input type="text" class="form-control shadow-sm" id="nombre" name="nombre">
        </div>

        <div class="col-md-6">
          <label for="telefono" class="form-label">Número de Teléfono</label>
          <input type="text" class="form-control shadow-sm" id="telefono" name="telefono">
        </div>

        <div class="col-md-6">
          <label for="n_huespedes" class="form-label">Número de Huéspedes</label>
          <input type="number" class="form-control shadow-sm" id="n_huespedes" name="n_huespedes" min="1">
        </div>

        <div class="col-md-6">
          <label for="genero" class="form-label">Género</label>
          <select class="form-select shadow-sm" id="genero" name="genero">
            <option selected disabled>Seleccione una opción</option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
            <option value="Otro">Otro</option>
          </select>
        </div>

        <div class="col-md-6">
          <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
          <input type="date" class="form-control shadow-sm" id="fecha_ingreso" name="fecha_ingreso" required>
        </div>

        <div class="col-md-6">
          <label for="fecha_salida" class="form-label">Fecha de Salida</label>
          <input type="date" class="form-control shadow-sm" id="fecha_salida" name="fecha_salida" required>
        </div>

        <div class="col-12">
          <label for="mensaje" class="form-label">Mensaje</label>
          <textarea class="form-control shadow-sm" id="mensaje" name="mensaje" rows="3"></textarea>
        </div>

        <div class="col-12">
          <p class="fw-bold text-warning mb-2">Servicios Adicionales</p>
          <div class="row">
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="servicio_transporte" name="servicios[]" value="transporte">
                <label class="form-check-label" for="servicio_transporte">Transporte</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="servicio_comida" name="servicios[]" value="comida">
                <label class="form-check-label" for="servicio_comida">Comidas Buffet</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="servicio_gimnasio" name="servicios[]" value="gimnasio">
                <label class="form-check-label" for="servicio_gimnasio">Gimnasio</label>
              </div>
            </div>
          </div>
        </div>

          <h5 class="text-warning mt-4">Método de Pago</h5>
          <div class="mb-4">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="metodo_pago" id="tarjeta" value="tarjeta" required>
              <label class="form-check-label" for="tarjeta">Tarjeta de Crédito/Débito</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="metodo_pago" id="efectivo" value="efectivo">
              <label class="form-check-label" for="efectivo">Pago en Efectivo</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="metodo_pago" id="transferencia" value="transferencia">
              <label class="form-check-label" for="transferencia">Transferencia Bancaria</label>
            </div>
          </div>

        <div class="col-12">
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="acepto" required>
            <label class="form-check-label" for="acepto">
              Acepto los <a href="#" class="text-info text-decoration-underline">términos y condiciones</a>
            </label>
          </div>
        </div>

        <div class="col-12">
          <button type="submit" class="btn btn-warning w-100 py-2 fw-bold shadow-sm" style="transition: all 0.3s;">
            Enviar
          </button>
        </div>

      </form>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
