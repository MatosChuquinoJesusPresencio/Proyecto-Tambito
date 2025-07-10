<?php
session_start();
include 'conexion.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Buscar usuario por email
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();

    // Verificar la contraseña
    if (password_verify($password, $usuario['password'])) {
        // Crear sesión
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['rol'] = $usuario['rol'];

        // Redirigir según el rol
        if ($usuario['rol'] === 'admin') {
            header("Location: administracion.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        echo "❌ Contraseña incorrecta. <a href='login.html'>Intentar de nuevo</a>";
    }
} else {
    echo "❌ Usuario no encontrado. <a href='login.html'>Intentar de nuevo</a>";
}

$conn->close();
?>
