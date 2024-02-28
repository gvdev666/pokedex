<?php
session_start();

// Cerrar la sesión
session_destroy();

// Redirigir al inicio o a donde desees después de cerrar sesión
header("Location: ../index.php");
exit();
?>
