<?php
require_once __DIR__ . '/../controller/LoginController.php';

// Manejar el registro cuando se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $data = [
        'nombre' => $nombre,
        'email' => $email,
        'password' => $password
    ];

    // Le pasamos "data" al controlador para que maneje el registro
    $resultado = LoginController::registrar($data);

    //Si "resultado" es verdadero, el registro fue exitoso
    if ($resultado) {
      //Mensaje de éxito
      $mensaje = "Registro Exitoso";
        // Registro exitoso, redirigir a login
        header("Location: registro.php");
        exit;
    } else {
        // Error en el registro, mostrar mensaje
        echo "Error al registrar el usuario. Inténtalo de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel - Registro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

  <!-- REGISTRO -->
  <div class="container d-flex flex-grow-1 align-items-center justify-content-center">
    <?php if (isset($mensaje)): ?>
        <div class="alert alert-success text-center w-100" style="max-width: 420px;">
            <?= htmlspecialchars($mensaje) ?>
        </div>
    <?php endif; ?>
    <form action="registro.php" method="POST" class="w-100" style="max-width: 420px;">
      <div class="card shadow border-0">
        <div class="card-body p-4">
          <h1 class="text-center text-primary fw-bold mb-4">Crear Cuenta</h1>

          <!-- Nombre -->
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre" required>
            </div>
          </div>

          <!-- Email -->
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
              <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su correo" required>
            </div>
          </div>

          <!-- Contraseña -->
          <div class="mb-4">
            <label for="password" class="form-label">Contraseña</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
              <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
            </div>
          </div>

          <!-- Botón Registrar -->
          <button type="submit" class="btn btn-primary w-100">Registrarse</button>

          <p class="text-center mt-3 mb-0">
            ¿Ya tienes una cuenta? <a href="login.php" class="text-decoration-none text-primary fw-bold">Iniciar Sesión</a>
          </p>

        </div>
      </div>
    </form>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-light text-center py-3 mt-auto">
    <p class="mb-0">© 2025 Hotel - Todos los derechos reservados</p>
  </footer>

</body>
</html>