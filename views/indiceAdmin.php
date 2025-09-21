<?php
require_once __DIR__ . '/../controller/AlojamientoController.php';

// Iniciamos una sesión y verificamos si el usuario está autenticado
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}

$controller = new AlojamientoController();
$alojamientos = $controller->index();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body class="d-flex flex-column min-vh-100 bg-light">

  <!-- Navbar Responsive -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="#">Hotel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHotel" aria-controls="navbarHotel" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarHotel">
        <ul class="navbar-nav ms-auto">
          <!--<li class="nav-item">
            <a class="nav-link active" href="index.php">Inicio</a>
          </li>-->
          <li class="nav-item">
            <a class="nav-link" href="crear.php">Crear Alojamiento</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../auth/logout.php">Cerrar Sesión</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Contenido -->
  <div class="container my-5">
    <h1 class="text-center text-primary fw-bold mb-5">Bienvenido Administrador</h1>

    <div class="row g-4">
      <?php foreach($alojamientos as $alojamiento): ?>
        <div class="col-md-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
                <img src="../images/<?php echo $alojamiento['imagen_url']; ?>" class="card-img-top mb-3" alt="Imagen de <?php echo $alojamiento['titulo']; ?>">
              <h5 class="card-title text-primary"><?php echo $alojamiento['titulo']; ?></h5>
              <p class="card-text"><?php echo $alojamiento['descripcion']; ?></p>
              <p class="card-text fw-bold">💲 <?php echo number_format($alojamiento['precio'], 2); ?></p>
              <a href="#" class="btn btn-outline-primary w-100">Editar</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-light text-center py-3 mt-auto">
    <p class="mb-0">© 2025 Hotel - Todos los derechos reservados</p>
  </footer>

</body>
</html>