<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel - Bienvenido</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body class="d-flex flex-column min-vh-100">

  <!-- Sección principal con imagen de fondo -->
  <div class="d-flex flex-column justify-content-center align-items-center text-center flex-grow-1 text-white"
    style="background: url('images/ainicio.jpg') no-repeat center center/cover;">
    <div class="container bg-dark bg-opacity-300 p-5 rounded">
      <h1 class="display-4 fw-bold">Bienvenido a nuestro Hotel</h1>
      <p class="lead mt-3">
        Disfruta de una experiencia única de confort y lujo.
        Habitaciones modernas, gastronomía de clase mundial
        y el mejor servicio para hacer de tu estadía un recuerdo inolvidable.
      </p>
      <div class="mt-4">
        <a href="auth/login.php" class="btn btn-primary btn-lg me-3">
          <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
        </a>
        <a href="auth/registro.php" class="btn btn-success btn-lg">
          <i class="bi bi-person-plus"></i> Registrarse
        </a>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-light text-center py-3 mt-auto">
    <p class="mb-0">© 2025 Hotel - Todos los derechos reservados</p>
  </footer>

</body>

</html>