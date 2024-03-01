<?php

class UsuarioModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function registrarUsuario($nombre, $genero, $usuario, $contrasena) {
        $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);

        $sql = "INSERT INTO entrenadores (nombre, genero, usuario, contrasena) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $nombre, $genero, $usuario, $contrasenaHash);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
