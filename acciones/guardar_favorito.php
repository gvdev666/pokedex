<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();
require_once '../config/db.php';

// Cargar los modelos y controladores
include '../Model/PokemonFavorito.php';
include '../Controllers/PokemonFavoritoController.php';

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

// Crear una instancia del controlador
$conn = ConexionDB::obtenerConexion(); // Obtener la conexión desde el archivo de conexión
$pokemonFavoritoController = new PokemonFavoritoController($conn);

$user_id = $_SESSION['user_id'];
$id_pokemon = $_POST['idPokemon'];



// Guardar el Pokémon en favoritos
$resultado = $pokemonFavoritoController->guardarPokemonFavorito($user_id, $id_pokemon);

// Manejar el resultado
if ($resultado) {
    http_response_code(200);
    echo "Pokémon guardado en favoritos correctamente";
} else {
    http_response_code(500);
    echo "Error al guardar el Pokémon en favoritos";
}
