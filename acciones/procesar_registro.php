<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once '../config/db.php';
require_once '../Controllers/RegistroController.php';

// Obtener la conexión a la base de datos
$conn = ConexionDB::obtenerConexion();

// Verificar si se enviaron datos por el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $genero = mysqli_real_escape_string($conn, $_POST['genero']);
    $contrasena = $_POST['contrasena'];

    // Crear una instancia del controlador de registro
    $registroController = new RegistroController($conn);

    // Llamar al método para registrar al usuario
    $registroController->registrarUsuario($nombre, $genero, $usuario, $contrasena);
}
 header("Location: ../index.php"); // Descomentar para redireccionar

?>
