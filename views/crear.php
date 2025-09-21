<?php
require_once __DIR__ . '/../controller/AlojamientoController.php';

// Iniciamos una sesión y verificamos si el usuario está autenticado
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: ../index.php");
  exit;
}

$controller = new AlojamientoController();

//Manejamos el envio del formulario para tratar la imagen y guardar el alojamiento
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titulo = $_POST['titulo'];
  $descripcion = $_POST['descripcion'];
  $ubicacion = $_POST['ubicacion'];
  $precio = $_POST['precio'];
  // Procesamos la imagen
  if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $archivo = $_FILES['imagen'];

    // Validamos el tipo de archivo
    $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($archivo['type'], $tiposPermitidos)) {
      die("Error: Solo se permiten imágenes JPG, PNG o GIF.");
    }

    // Generamos un nombre único
    $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
    $nombreUnico = uniqid('img_', true) . "." . $extension;

    // Carpeta destino
    $rutaDestino = __DIR__ . "/../images/" . $nombreUnico;

    // Movemos el archivo
    if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
      $imagen = $nombreUnico; // Guardamos solo el nombre en BD
    } else {
      die("Error al mover la imagen.");
    }
  } else {
    $imagen = null;
  }

  //Pasamos los datos al controlador para crear el alojamiento
  $resultado = $controller->crear($titulo, $descripcion, $ubicacion, $precio, $imagen);

  //Verificamos si se creó correctamente y redirigimos
  if ($resultado) {
    header("Location: indiceAdmin.php");
    exit;
  } else {
    echo "<div class='alert alert-danger'>Error al crear el alojamiento.</div>";
  }
}
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
          <li class="nav-item">
            <a class="nav-link active" href="./indiceAdmin.php">Inicio</a>
          </li>
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

  <!-- Formulario para crear un nuevo alojamiento -->
  <div class="container my-5">
    <h2 class="text-center text-primary fw-bold mb-4">Crear Nuevo Alojamiento</h2>
    <form action="crear.php" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" required>
      </div>
      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
      </div>
      <div class="mb-3">
        <label for="ubicacion" class="form-label">Ubicacion</label>
        <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
      </div>
      <div class="mb-3">
        <label for="precio" class="form-label">Precio</label>
        <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
      </div>
      <div class="mb-3">
        <label for="imagen" class="form-label">Imagen</label>
        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
      </div>
      <button type="submit" class="btn btn-primary">Crear Alojamiento</button>
    </form>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-light text-center py-3 mt-auto">
    <p class="mb-0">© 2025 Hotel - Todos los derechos reservados</p>
  </footer>

</body>

</html>