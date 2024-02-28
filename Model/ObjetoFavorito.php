<?php

class PokemonFavoritoModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function guardarObjetoFavorito($idEntrenador, $idObjeto)
    {
        $sql = "INSERT INTO objetos_favoritos (id_entrenador, id_objeto) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ii', $idEntrenador, $idObjeto);
        return $stmt->execute();
    }

    public function eliminarObjetoFavorito($idEntrenador, $idObjeto)
    {
        $sql = "DELETE FROM objetos_favoritos WHERE id_entrenador = ? AND id_objeto = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ii', $idEntrenador, $idObjeto);
        return $stmt->execute();
    }
}
