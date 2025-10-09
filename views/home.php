<?php
require_once __DIR__ . "/../models/homep.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel spyce - Bienvenido</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="/prime/styles/home.css">
</head>
<body class="bg-gray-100 text-gray-800">
  <header class="bg-white shadow-md fixed w-full z-10">
    <nav class="container mx-auto flex justify-between items-center p-4">
      <h1 id ="h1_nav" class="text-2xl font-bold text-indigo-600"> Bienvenido <?php echo $_SESSION ["usuario"]?> </h1>
      <ul class="flex space-x-6" id="navbar">
        <li><a href="#image_session" class="hover:text-indigo-500">Inicio</a></li>
        <li><a href="hreservas.php" class="hover:text-indigo-500">Mis_Reservas</a></li>
        <li><a href="#habitaciones" class="hover:text-indigo-500">Habitaciones</a></li>
        <li><a href="#servicios" class="hover:text-indigo-500">Servicios</a></li>
        <li><a href="../controllers/logout.php" class="text-red-600 hover:text-red-800">salir</a></li>
        <li><a href="index1.php" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500">Reservar</a></li>
      </ul>
    </nav>
  </header>

  <section class="relative h-screen flex items-center justify-center bg-cover bg-center" id ="image_session">
    <div class="bg-black bg-opacity-50 p-10 rounded-xl text-center text-white">
      <h2 class="text-5xl font-bold mb-4">Vive la mejor experiencia</h2>
      <p class="text-lg mb-6">Confort, elegancia y el mejor servicio para tu estadía</p>
      <a href="index1.php" class="bg-indigo-600 px-6 py-3 rounded-lg text-lg hover:bg-indigo-500">Reserva Ahora</a>
    </div>
  </section>

  <section id="reserva" class="py-16 bg-gray-30">
    <div class="container mx-auto text-center">
      <h3 class="text-3xl font-bold mb-10">Mis Reservas</h3>
      
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
          <thead>
            <tr class="bg-indigo-100 text-indigo-700 text-sm uppercase tracking-wider">
              <th class="py-3 px-4 border">#reserva</th>
              <th class="py-3 px-4 border">Nombre</th>
              <th class="py-3 px-4 border">Teléfono</th>
              <th class="py-3 px-4 border">N° Huéspedes</th>
              <th class="py-3 px-4 border">Género</th>
              <th class="py-3 px-4 border">Mensaje</th>
              <th class="py-3 px-4 border">Ingreso</th>
              <th class="py-3 px-4 border">Salida</th>
              <th class="py-3 px-4 border">Servicios</th>
              <th class="py-3 px-4 border">Método de Pago</th>
            </tr>
          </thead>
          
          <tbody class="text-sm text-gray-700">
            <?php if (!empty($_SESSION["sin_reserva"])): ?>
            <tr>
                <td colspan="10" class="py-4 px-4 border text-center text-gray-500">
                    No tienes reservas en estos momentos.
                </td>
            </tr>
            <?php else: ?>
              <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border"><?php echo $_SESSION["id_reserva"] ?></td>
                <td class="py-2 px-4 border"><?php echo $_SESSION["nombre_completo"] ?></td>
                <td class="py-2 px-4 border"><?php echo $_SESSION["telefono"] ?></td>
                <td class="py-2 px-4 border"><?php echo $_SESSION["n_huespedes"] ?></td>
                <td class="py-2 px-4 border"><?php echo $_SESSION["genero"] ?></td>
                <td class="py-2 px-4 border"><?php echo $_SESSION["mensaje"] ?></td>
                <td class="py-2 px-4 border"><?php echo $_SESSION["fecha_ingreso"] ?></td>
                <td class="py-2 px-4 border"><?php echo $_SESSION["fecha_salida"] ?></td>
                <td class="py-2 px-4 border"><?php echo $_SESSION["servicios"] ?></td>
                <td class="py-2 px-4 border"><?php echo $_SESSION["metodo_pago"] ?></td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>


  <section id="servicios" class="py-16 bg-gray-50">
    <div class="container mx-auto text-center">
      <h3 class="text-3xl font-bold mb-10">Nuestros Servicios</h3>
      <div class="grid md:grid-cols-4 gap-8">
        <div class="p-6 bg-white shadow-lg rounded-xl">
          <h4 class="font-bold">WiFi Gratis</h4>
          <p>Conéctate en todo el hotel.</p>
        </div>
        <div class="p-6 bg-white shadow-lg rounded-xl">
          <h4 class="font-bold">Piscina</h4>
          <p>Disfruta de nuestra piscina climatizada.</p>
        </div>
        <div class="p-6 bg-white shadow-lg rounded-xl">
          <h4 class="font-bold">Spa & Relax</h4>
          <p>Relájate en manos de expertos.</p>
        </div>
        <div class="p-6 bg-white shadow-lg rounded-xl">
          <h4 class="font-bold">Restaurante</h4>
          <p>Gastronomía internacional.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="habitaciones" class="py-16">
    <div class="container mx-auto text-center">
      <h3 class="text-3xl font-bold mb-10">Habitaciones Destacadas</h3>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
          <img src="https://www.venicecollection.com/palazzo-veneziano/wp-content/uploads/sites/2/2017/08/Luxury-Spa-Suite-05-1600x800.jpg" alt="Habitación Lujo">
          <div class="p-6">
            <h4 class="font-bold">Suite Lujo</h4>
            <p>$120 / noche</p>
          </div>
        </div>
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
          <img src="https://www.hotelplaza.es/wp-content/uploads/sites/145/2024/05/HOTEL-PLAZA-CORUNA-DORMITORIO-HABITACION-PREMIUM-CORUNA-CENTRO-2200x1200.jpg" alt="Habitación Premium">
          <div class="p-6">
            <h4 class="font-bold">Premium</h4>
            <p>$90 / noche</p>
          </div>
        </div>
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
          <img src="https://image-tc.galaxy.tf/wijpeg-4t6kmu8xttmb2d4mvbeayezok/palmira-estandar4_wide.jpg?crop=0%2C99%2C1900%2C1069" alt="Habitación Estándar">
          <div class="p-6">
            <h4 class="font-bold">Estándar</h4>
            <p>$70 / noche</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer id="contacto" class="bg-gray-900 text-white py-10">
    <div class="container mx-auto text-center">
      <p>&copy; 2025 Hotel spyce. Todos los derechos reservados.</p>
      <p>📍 Dirección del hotel | 📞 +123 456 789 | ✉ contacto@hotel.com</p>
    </div>
  </footer>

</body>
</html>
