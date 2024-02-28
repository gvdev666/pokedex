<?php

require_once '../Model/ObjetoFavorito.php';

class ObjetoController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new PokemonFavoritoModel($db);
    }

    public function guardarObjetoFavorito($idEntrenador, $idPokemon)
    {
        // Lógica adicional, como verificar el límite de 6 Pokémon favoritos
        return $this->model->guardarObjetoFavorito($idEntrenador, $idPokemon);
    }
    public function eliminarObjetoFavorito($idEntrenador, $idPokemon)
    {
        // Lógica adicional, como verificar si el Pokémon pertenece al entrenador
        return $this->model->eliminarObjetoFavorito($idEntrenador, $idPokemon);
    }

    
}
