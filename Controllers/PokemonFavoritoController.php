<?php

require_once '../Model/PokemonFavorito.php';

class PokemonFavoritoController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new PokemonFavoritoModel($db);
    }

    public function guardarPokemonFavorito($idEntrenador, $idPokemon)
    {
        // Lógica adicional, como verificar el límite de 6 Pokémon favoritos
        return $this->model->guardarPokemonFavorito($idEntrenador, $idPokemon);
    }
    public function eliminarPokemonFavorito($idEntrenador, $idPokemon)
    {
        // Lógica adicional, como verificar si el Pokémon pertenece al entrenador
        return $this->model->eliminarPokemonFavorito($idEntrenador, $idPokemon);
    }

    
}
