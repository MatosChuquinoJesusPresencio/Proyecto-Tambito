<?php
session_start();
session_destroy(); // Destruye todas las variables de sesión

// Redirige al usuario a la página de inicio después de cerrar sesión
header("Location: ../index.php");
exit();
?>