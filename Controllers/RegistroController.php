<?php

require_once '../Model/UsuarioModel.php';

class RegistroController {
    private $usuarioModel;

    public function __construct($conn) {
        $this->usuarioModel = new UsuarioModel($conn);
    }

    public function registrarUsuario($nombre, $genero, $contrasena) {
        $registroExitoso = $this->usuarioModel->registrarUsuario($nombre, $genero, $contrasena);
        
        if ($registroExitoso) {
            echo "Registro exitoso";
        } else {
            echo "Error al registrar el usuario";
        }
    }
}
?>
