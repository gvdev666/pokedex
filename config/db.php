<?php

class ConexionDB
{
    private static $servername = "localhost";
    private static $username = "root";
    private static $password = "";
    private static $dbname = "pokemon";
    private static $conn;

    public static function obtenerConexion()
    {
        if (!isset(self::$conn)) {
            self::$conn = new mysqli(self::$servername, self::$username, self::$password, self::$dbname);

            if (self::$conn->connect_error) {
                die("Conexión fallida: " . self::$conn->connect_error);
            }
        }

        return self::$conn;
    }
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

   
}
