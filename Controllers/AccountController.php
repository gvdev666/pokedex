<?php

require_once '../Model/AccountModel.php';

class AccountController
{
    private $accountModel;

    public function __construct($conn)
    {
        $this->accountModel = new AccountModel($conn);
    }

    // Método para manejar la solicitud de eliminación de cuenta
    public function eliminarCuenta($id_usuario)
    {
        // Puedes realizar validaciones adicionales aquí antes de eliminar la cuenta

        // Llamar al modelo para eliminar la cuenta
        if ($this->accountModel->eliminarCuenta($id_usuario)) {
            // Cierre de sesión después de eliminar la cuenta (si es necesario)
            session_start();
            session_destroy();

            // Redirigir a la página de inicio o a donde desees después de eliminar la cuenta
            header("Location: ../index.php");
            exit();
        } else {
            // Manejo de errores (puedes personalizar según tus necesidades)
            echo "Error al eliminar la cuenta";
        }
    }
}
?>
