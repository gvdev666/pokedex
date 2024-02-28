<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Conexión a la base de datos (asegúrate de tener la conexión configurada)
require_once '../config/db.php';
$conn = ConexionDB::obtenerConexion();

// Verificar si el usuario está autenticado
session_start();
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    die("Acceso no autorizado");
}

// Obtener el ID del entrenador desde la sesión
$id_entrenador = $_SESSION['user_id'];

// Consultar los Pokémon favoritos del entrenador
$sql = "SELECT id_pokemon FROM pokemon_favoritos WHERE id_entrenador = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_entrenador);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$pokemon_ids = [];
while ($row = $result->fetch_assoc()) {
    $pokemon_ids[] = $row['id_pokemon'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mis Pokémon</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://cdn.rawgit.com/michalsnik/aos/2.3.1/dist/aos.css" />

    <style>
        /* Paleta de colores */
        :root {
            --primary-color: #3498db;
            /* Azul */
            --secondary-color: #2ecc71;
            /* Verde */
            --background-color: #ecf0f1;
            /* Fondo */

            /* Agrega otras variables de color según tu paleta */
        }

        /* Estilos para las tarjetas */
        .card {
            background-color: var(--background-color);
            margin: 20px;
            border-radius: 10px;
            overflow: hidden;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-body {
            text-align: center;
        }

        /* Estilo para las imágenes en la tarjeta */
        .pokemon-image {
            max-width: 150px;
            max-height: 150px;
        }

        /* Estilos para el diseño de 2x2 */
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            background-color: var(--background-color);
            padding: 20px;
            /* Agrega espacio alrededor del contenedor */
        }

        .card-column {
            width: 48%;
            /* Ajusta según tus necesidades */
        }
    </style>

</head>

<body>

    <div class="container">
        <h1 class="text-center mb-4">Mis Pokémon</h1>

        <div class="card-container">
            <?php
            function obtenerDatosPokemonDesdeAPI($pokemon_id)
            {
                // URL de la API de Pokémon (puedes cambiarla según la API que estés utilizando)
                $api_url = "https://pokeapi.co/api/v2/pokemon/$pokemon_id/";

                // Realizar una solicitud HTTP a la API
                $json_data = file_get_contents($api_url);

                // Decodificar la respuesta JSON
                $pokemon_data = json_decode($json_data, true);

                // Verificar si se obtuvieron datos válidos
                if ($pokemon_data && isset($pokemon_data['sprites']['front_default'])) {
                    return $pokemon_data;
                } else {
                    return false;
                }
            }
            // Iterar sobre los IDs y hacer llamadas a la API para obtener la información del Pokémon
            foreach ($pokemon_ids as $pokemon_id) {
                $pokemon_data = obtenerDatosPokemonDesdeAPI($pokemon_id);

                if ($pokemon_data) {
            ?>
                    <div class="card card-column" data-aos="fade-up" data-aos-duration="1000">
                        <img class="card-img-top pokemon-image" src="<?php echo $pokemon_data['sprites']['front_default']; ?>" alt="<?php echo $pokemon_data['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $pokemon_data['name']; ?></h5>
                            <!-- Puedes agregar más detalles si es necesario -->

                            <form class="delete-form" action="../acciones/eliminar_favorito.php" method="post">
                                <input type="hidden" name="idPokemon" value="<?php echo $pokemon_id; ?>">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

            <!-- Si no hay Pokémon, puedes mostrar un mensaje -->
            <?php if (empty($pokemon_ids)) : ?>
                <p>No tienes Pokémon favoritos.</p>
            <?php endif; ?>

        </div>
    </div>

    <!-- AOS JS -->
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.3.1/dist/aos.js"></script>
    <script>
        AOS.init(); // Inicializar AOS
    </script>

</body>

</html>