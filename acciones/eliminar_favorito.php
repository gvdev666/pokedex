<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();
require_once '../config/db.php';
require_once '../Controllers/PokemonFavoritoController.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    die("Acceso no autorizado");
}

// Verificar si se proporcionó el ID del Pokémon
if (!isset($_POST['idPokemon'])) {
    http_response_code(400);
    die("ID del Pokémon no proporcionado");
}

// Obtener el ID del entrenador y el ID del Pokémon a eliminar
$user_id = $_SESSION['user_id'];
$id_pokemon = $_POST['idPokemon'];

// Crear una instancia del controlador
$conn = ConexionDB::obtenerConexion();
$pokemonFavoritoController = new PokemonFavoritoController($conn);

// Eliminar el Pokémon favorito
$resultado = $pokemonFavoritoController->eliminarPokemonFavorito($user_id, $id_pokemon);

// Manejar el resultado
if ($resultado) {
    // Redirigir a la página de Pokémon después de eliminar
    header("Location: ../main/pokemon.php");
} else {
    http_response_code(500);
    die("Error al eliminar el Pokémon favorito");
}
?>
