<?php

require_once '../config/db.php';

class AccountModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Método para eliminar la cuenta
    public function eliminarCuenta($id_usuario)
    {
        // Agrega la lógica específica de tu base de datos para eliminar la cuenta
        $sql = "DELETE FROM entrenadores WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_usuario);

        if ($stmt->execute()) {
            return true;
        } else {
            // Manejo de errores (puedes personalizar según tus necesidades)
            return false;
        }
    }
}
?>
