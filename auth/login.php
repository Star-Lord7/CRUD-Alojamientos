<?php

require_once __DIR__ . '/../controller/LoginController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $usuario = LoginController::login($_POST['email'], $_POST['password']);

  if (!$usuario) {
    $error = "Correo o contraseña incorrectos";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

  <!-- LOGIN -->
  <div class="container d-flex flex-grow-1 align-items-center justify-content-center">
    <form action="login.php" method="POST" class="w-100" style="max-width: 420px;">
      <?php if (!empty($error)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <div class="card shadow border-0">
        <div class="card-body p-4">
          <h1 class="text-center text-primary fw-bold mb-4">Iniciar Sesión</h1>

          <div class="mb-3">
            <label for="email" class="form-label">Usuario</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
              <input type="text" class="form-control" id="email" name="email" placeholder="Ingrese su usuario" required>
            </div>
          </div>

          <div class="mb-4">
            <label for="password" class="form-label">Contraseña</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
              <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
            </div>
          </div>

          <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>

          <!-- <p class="text-center mt-3 mb-0">
            <a href="#" class="text-decoration-none">¿Olvidó su contraseña?</a>
          </p> -->
          <p class="text-center mt-2 mb-0">
            ¿No tienes una cuenta? <a href="registro.php" class="text-decoration-none">Regístrate aquí</a>
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