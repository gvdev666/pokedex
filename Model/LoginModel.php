<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class LoginModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obtenerDatosEntrenador($usuario) {
        
        $sql = "SELECT * FROM entrenadores WHERE usuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $entrenador = $result->fetch_assoc();
    
        $stmt->close();
    
        return $entrenador;
    }
    
}
