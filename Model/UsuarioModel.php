<?php

class UsuarioModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function registrarUsuario($nombre, $genero, $contrasena) {
        $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);

        $sql = "INSERT INTO entrenadores (nombre, genero, contrasena) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $nombre, $genero, $contrasenaHash);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
