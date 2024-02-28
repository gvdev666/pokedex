<?php

require_once '../Model/LoginModel.php';

class LoginController {
    private $loginModel;

    public function __construct($conn) {
        $this->loginModel = new LoginModel($conn);
    }

    public function login($usuario, $contrasena) {
        $entrenador = $this->loginModel->obtenerDatosEntrenador($usuario);

        if ($entrenador && password_verify($contrasena, $entrenador['contrasena'])) {
            // Inicio de sesión exitoso
            session_start();
            $_SESSION['usuario'] = $entrenador['id'];
            // Puedes almacenar más información del usuario en la sesión si es necesario
            // $_SESSION['nombre'] = $entrenador['nombre'];

            // Redirigir a la página principal o a otra página después del inicio de sesión
            header("Location: ../main/index.php");
            exit();
        } else {
            // Inicio de sesión fallido
            echo "Credenciales incorrectas";
        }
    }
}
?>
