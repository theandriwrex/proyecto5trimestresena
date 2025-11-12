<?php
  // Asegurar que la sesión esté iniciada
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }

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

      <form action="index.php?controller=procesar_reserva&action=guardar" method="POST" class="row g-3">
      <?php
      if (!empty($_SESSION['errores'])) {
        echo '<div class="alert alert-danger w-100">';
        foreach ($_SESSION['errores'] as $err) {
          echo '<div>' . htmlspecialchars($err) . '</div>';
        }
        echo '</div>';
        unset($_SESSION['errores']);
      }

      if (!empty($_SESSION['error_general'])) {
        echo '<div class="alert alert-danger w-100">' . htmlspecialchars($_SESSION['error_general']) . '</div>';
        unset($_SESSION['error_general']);
      }

      if (!empty($_SESSION['reserva_exitosa'])) {
        echo '<div class="alert alert-success w-100">' . htmlspecialchars($_SESSION['reserva_exitosa']) . '</div>';
        unset($_SESSION['reserva_exitosa']);
      }

      // Mostrar información de depuración (temporal)
      if (!empty($_SESSION['debug_reserva'])) {
        echo '<div class="alert alert-warning w-100"><strong>Debug DB:</strong> ' . htmlspecialchars(json_encode($_SESSION['debug_reserva'])) . '</div>';
        unset($_SESSION['debug_reserva']);
      }

      if (!empty($_SESSION['debug_inputs_reserva'])) {
        echo '<div class="alert alert-info w-100"><strong>Inputs:</strong> ' . htmlspecialchars(json_encode($_SESSION['debug_inputs_reserva'])) . '</div>';
        unset($_SESSION['debug_inputs_reserva']);
      }
      ?>
        
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

        <div class="mb-4">
          <label for="tipo_habitacion">Tipo de Habitación:</label>
          <select id="tipo_habitacion" name="tipo_habitacion" class="border p-2 rounded w-full">
              <option value="">-- Selecciona un tipo --</option>
              <option value="1">Estándar</option>
              <option value="2">Doble</option>
              <option value="3">Premium</option>
              <option value="4">Suite</option>
              <option value="5">Suite Lujo</option>
          </select>
        </div>

        <div class="mb-4">
          <label for="habitacion">Habitación disponible:</label>
          <select id="habitacion" name="habitacion" class="border p-2 rounded w-full">
              <option value="">-- Primero selecciona un tipo --</option>
          </select>
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

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#tipo_habitacion').on('change', function() {
        var idTipo = $(this).val();
        $('#habitacion').html('<option>Cargando...</option>');

        if (idTipo) {
            $.ajax({
                url: 'index.php?controller=procesar_reserva&action=obtenerHabitacionesAjax',
                type: 'POST',
                data: { id_tipo: idTipo },
                dataType: 'json',
                success: function(data) {
                  console.log("Respuesta AJAX:", data); 
                    $('#habitacion').empty().append('<option value="">-- Selecciona una habitación --</option>');
                    if (data.length > 0) {
                        $.each(data, function(i, habitacion) {
                            $('#habitacion').append('<option value="'+habitacion.id_habitacion+'">Habitación '+habitacion.numero_habitacion+'</option>');
                        });
                    } else {
                        $('#habitacion').append('<option value="">No hay habitaciones disponibles</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error AJAX:", error);
                    alert('Error al cargar las habitaciones');
                }
            });
        } else {
            $('#habitacion').html('<option value="">-- Primero selecciona un tipo --</option>');
        }
    });

    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
