<?php

require_once '../config/db.php';
require_once '../controllers/LoginController.php';

$conn = ConexionDB::obtenerConexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $contrasena = $_POST['contrasena'];

    $loginController = new LoginController($conn);
    $loginController->login($usuario, $contrasena);
}

$conn->close();
