<?php
require_once __DIR__ . "/../models/ver_reservas.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Spyce - Mis Reservas</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<header class="bg-white shadow-md fixed w-full z-10">
    <nav class="container mx-auto flex justify-between items-center p-4">
      <h1 class="text-2xl font-bold text-indigo-600">
        Bienvenido <?php echo $_SESSION["nombre"]; ?>
      </h1>
      <ul class="flex space-x-6">
        <li><a href="home.php" class="hover:text-indigo-500">Inicio</a></li>
        <li><a href="#reserva" class="hover:text-indigo-500">Mis Reservas</a></li>
        <li><a href="#habitaciones" class="hover:text-indigo-500">Habitaciones</a></li>
        <li><a href="#servicios" class="hover:text-indigo-500">Servicios</a></li>
        <li><a href="#contacto" class="hover:text-indigo-500">Contacto</a></li>
        <li><a href="index1.php" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500">Reservar</a></li>
      </ul>
    </nav>
  </header>

  <!-- HERO -->
  <section class="relative h-[50vh] md:h-[70vh] flex items-center justify-center bg-cover bg-center" style="background-image: url('https://www.venicecollection.com/palazzo-veneziano/wp-content/uploads/sites/2/2017/08/Luxury-Spa-Suite-05-1600x800.jpg');">
    <div class="bg-black bg-opacity-50 p-10 rounded-xl text-center text-white max-w-xl">
      <h2 class="text-4xl md:text-5xl font-bold mb-4">Historial de Reservas</h2>
      <p class="text-lg">Consulta tus reservas pasadas y futuras en un solo lugar.</p>
    </div>
  </section>

  <!-- TABLA DE RESERVAS -->
  <section id="reserva" class="py-16">
    <div class="container mx-auto">
      <h3 class="text-3xl font-bold text-center mb-10">Mis Reservas</h3>
      <div class="overflow-x-auto shadow-lg rounded-xl">
        <table class="min-w-full bg-white border border-gray-200 rounded-xl">
          <thead>
            <tr class="bg-indigo-600 text-white text-sm uppercase tracking-wider">
              <th class="py-3 px-4">#Reserva</th>
              <th class="py-3 px-4">Nombre</th>
              <th class="py-3 px-4">Teléfono</th>
              <th class="py-3 px-4">Huéspedes</th>
              <th class="py-3 px-4">Género</th>
              <th class="py-3 px-4">Mensaje</th>
              <th class="py-3 px-4">Ingreso</th>
              <th class="py-3 px-4">Salida</th>
              <th class="py-3 px-4">Servicios</th>
              <th class="py-3 px-4">Método de Pago</th>
              <th class="py-3 px-4">eliminar reserva</th>
            </tr>
          </thead>
          <tbody class="text-gray-700">
            <?php if (!empty($_SESSION["sin_reserva"])): ?>
                <tr>
                    <td colspan="10" class="py-6 px-4 text-center text-gray-500">
                        No tienes reservas en estos momentos.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($_SESSION["reservas"] as $reserva): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 text-center"><?php echo $reserva["id_reserva"]; ?></td>
                        <td class="py-3 px-4"><?php echo $reserva["nombre_completo"]; ?></td>
                        <td class="py-3 px-4"><?php echo $reserva["telefono"]; ?></td>
                        <td class="py-3 px-4 text-center"><?php echo $reserva["n_huespedes"]; ?></td>
                        <td class="py-3 px-4 text-center"><?php echo $reserva["genero"]; ?></td>
                        <td class="py-3 px-4"><?php echo $reserva["mensaje"]; ?></td>
                        <td class="py-3 px-4"><?php echo $reserva["fecha_ingreso"]; ?></td>
                        <td class="py-3 px-4"><?php echo $reserva["fecha_salida"]; ?></td>
                        <td class="py-3 px-4"><?php echo $reserva["servicios"]; ?></td>
                        <td class="py-3 px-4"><?php echo $reserva["metodo_pago"]; ?></td>
                        <td class="py-3 px-4"><a href="">cancelar reserva</a> <br><br> <a href="">editar</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
          </tbody>

        </table>
      </div>
    </div>
  </section>

  <footer id="contacto" class="bg-gray-900 text-white py-10">
    <div class="container mx-auto text-center">
      <p>&copy; 2025 Hotel Spyce. Todos los derechos reservados.</p>
      <p>📍 Dirección del hotel | 📞 +123 456 789 | ✉ contacto@hotel.com</p>
    </div>
  </footer>
</body>
</html>
