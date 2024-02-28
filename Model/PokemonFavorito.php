<?php

class PokemonFavoritoModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function guardarPokemonFavorito($idEntrenador, $idPokemon)
    {
        $sql = "INSERT INTO pokemon_favoritos (id_entrenador, id_pokemon) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ii', $idEntrenador, $idPokemon);
        return $stmt->execute();
    }

    public function eliminarPokemonFavorito($idEntrenador, $idPokemon)
    {
        $sql = "DELETE FROM pokemon_favoritos WHERE id_entrenador = ? AND id_pokemon = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ii', $idEntrenador, $idPokemon);
        return $stmt->execute();
    }
}
