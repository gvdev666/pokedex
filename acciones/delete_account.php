<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Archivo para eliminar la cuenta del usuario

require_once '../config/db.php'; // Asegúrate de tener la conexión a la base de datos configurada
require_once '../Controllers/AccountController.php';

session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    die("Acceso no autorizado");
}

// Obtener el ID del usuario desde la sesión
$id_usuario = $_SESSION['user_id'];

// Crear una instancia del controlador de cuenta
$accountController = new AccountController(ConexionDB::obtenerConexion());

// Manejar la solicitud de eliminación de cuenta
$accountController->eliminarCuenta($id_usuario);
?>
