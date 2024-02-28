<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.rawgit.com/michalsnik/aos/2.3.1/dist/aos.css" />
  <style>
    body {
      background: linear-gradient(to right, #3498db, #e74c3c);
      color: white;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .login-form {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 25px;
      border-radius: 10px;
      width: 100%;
      max-width: 400px;
    }
    .form-label{
        color: black;
    }
    h2{
        color: black;
    }
  </style>
</head>
<body>
  <div class="login-form" data-aos="fade-up" data-aos-duration="1000">
    <h2 class="text-center mb-4">Inicio de Sesión</h2>
    <form action="acciones/procesar_login.php" method="post">
      <div class="mb-3">
        <label for="usuario" class="form-label">ID de Entrenador</label>
        <input type="text" class="form-control" id="usuario" name="usuario" required>
      </div>
      <div class="mb-3">
        <label for="contrasena" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.rawgit.com/michalsnik/aos/2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>
