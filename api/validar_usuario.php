<?php
session_start();
include '../conexion.php';

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
        $_SESSION['apellido'] = $usuario['apellido']; // ¡Se añade el apellido a la sesión!
        $_SESSION['rol'] = $usuario['rol'];

        // Redirigir según el rol
        if ($usuario['rol'] === 'admin') {
            header("Location: ../administracion.php");
        } else {
            header("Location: ../index.php");
        }
        exit();
    } else {
        // Contraseña incorrecta: Almacenar mensaje en sesión y redirigir
        $_SESSION['error_message'] = "❌ Contraseña incorrecta. Por favor, inténtalo de nuevo.";
        header("Location: ../login.php"); // Redirige de vuelta a login.php
        exit();
    }
} else {
    // Usuario no encontrado: Almacenar mensaje en sesión y redirigir
    $_SESSION['error_message'] = "❌ Usuario no encontrado. Por favor, inténtalo de nuevo.";
    header("Location: ../login.php"); // Redirige de vuelta a login.php
    exit();
}

$conn->close();
?>