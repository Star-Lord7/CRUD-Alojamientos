<?php
require_once __DIR__ . '/../controller/AlojamientoController.php';
require_once __DIR__ . '/../controller/FavoritosController.php';

session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: ../index.php");
  exit;
}

/*echo "<pre>";
var_dump($_SESSION['usuario']);
echo "</pre>";*/

/*echo "<pre>";
var_dump($alojamientos);
echo "</pre>";*/

$controller = new AlojamientoController();
$favoritosController = new FavoritosController();

$alojamientos = $controller->index(); //Obtenemos todos los alojamientos

// Verificamos si se ha enviado el formulario para agregar a favoritos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'agregarFavorito') {
  $id_usuario = $_SESSION['usuario']['id_usuario']; //Obtenemos el ID del usuario desde la sesión
  $id_alojamiento = $_POST['id_alojamiento']; //Obtenemos el ID del alojamiento desde el formulario

  $favoritosController->agregarFavorito($id_usuario, $id_alojamiento);
  // Redirigir para evitar reenvío del formulario
  header("Location: favoritos.php");
  exit;
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
          <!--<li class="nav-item">
            <a class="nav-link active" href="index.php">Inicio</a>
          </li>-->
          <li class="nav-item">
            <a class="nav-link" href="./favoritos.php">Ver Favoritos</a>
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
    <h1 class="text-center text-primary fw-bold mb-5">Bienvenido <?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?></h1>

    <div class="row g-4">
      <?php foreach ($alojamientos as $alojamiento): ?>
        <div class="col-md-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <img src="../images/<?php echo $alojamiento['imagen_url']; ?>" class="card-img-top mb-3" alt="Imagen de <?php echo $alojamiento['titulo']; ?>">
              <h5 class="card-title text-primary"><?php echo $alojamiento['titulo']; ?></h5>
              <p class="card-text"><?php echo $alojamiento['descripcion']; ?></p>
              <p class="card-text fw-bold">💲 <?php echo number_format($alojamiento['precio'], 2); ?></p>
              <a href="#"
                class="btn btn-outline-primary w-100"
                data-bs-toggle="modal"
                data-bs-target="#detalleModal"
                data-id="<?php echo $alojamiento['id_alojamiento']; ?>"
                data-titulo="<?php echo htmlspecialchars($alojamiento['titulo']); ?>"
                data-descripcion="<?php echo htmlspecialchars($alojamiento['descripcion']); ?>"
                data-precio="<?php echo number_format($alojamiento['precio'], 2); ?>"
                data-imagen="../images/<?php echo $alojamiento['imagen_url']; ?>">
                Ver Detalles
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="detalleModal" tabindex="-1" aria-labelledby="detalleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">

          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title fw-bold" id="detalleModalLabel">
              <i class="bi bi-house-door-fill me-2"></i>Detalles del Alojamiento
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>

          <div class="modal-body">
            <div class="row">
              <div class="col-md-6 mb-3 mb-md-0">
                <img id="modalImagen" src="" class="img-fluid rounded shadow-sm" alt="Imagen del alojamiento">
              </div>
              <div class="col-md-6 d-flex flex-column">
                <h4 id="modalTitulo" class="text-primary fw-bold"></h4>
                <p id="modalDescripcion" class="text-muted flex-grow-1"></p>
                <p id="modalPrecio" class="h5 fw-bold text-dark mb-3"></p>
                <div class="d-grid gap-2">
                  <form action="" method="POST">
                    <!-- Solo enviamos el ID del alojamiento -->
                    <input type="hidden" id="modalIdAlojamiento" name="id_alojamiento" value="">
                    <button type="submit" name="action" value="agregarFavorito" class="btn btn-primary w-100">
                      <i class="bi bi-heart-fill me-2"></i>Agregar a Favoritos
                    </button>
                  </form>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-light text-center py-3 mt-auto">
    <p class="mb-0">© 2025 Hotel - Todos los derechos reservados</p>
  </footer>

  <!-- Script para manejar el modal y poder cargar los datos segun el ID seleccionado-->
  <script>
    var detalleModal = document.getElementById('detalleModal');

    detalleModal.addEventListener('show.bs.modal', function(event) {
      var button = event.relatedTarget;

      // Tomar los datos del botón
      var titulo = button.getAttribute('data-titulo');
      var descripcion = button.getAttribute('data-descripcion');
      var precio = button.getAttribute('data-precio');
      var imagen = button.getAttribute('data-imagen');
      var id = button.getAttribute('data-id');

      // Insertarlos en el modal
      document.getElementById('modalTitulo').textContent = titulo;
      document.getElementById('modalDescripcion').textContent = descripcion;
      document.getElementById('modalPrecio').textContent = "💲 " + precio;
      document.getElementById('modalImagen').src = imagen;
      document.getElementById('modalImagen').alt = "Imagen de " + titulo;

      // Llenar el input hidden del formulario con el ID del alojamiento
      document.getElementById('modalIdAlojamiento').value = id;
    });
  </script>

</body>

</html>