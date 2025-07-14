<?php
session_start();
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['reset_error'] = "❌ Formato de correo electrónico inválido.";
        header("Location: ../recuperar_contraseña_paso1.php");
        exit();
    }

    $sql = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $usuario = $result->fetch_assoc();
        $_SESSION['reset_user_id'] = $usuario['id']; // Guardamos el ID del usuario
        $_SESSION['reset_email'] = $email; // Guardamos el email para el siguiente paso

        header("Location: ../recuperar_contraseña_paso2.php"); // Redirigir al paso 2
        exit();
    } else {
        // Mensaje genérico por seguridad
        $_SESSION['reset_error'] = "❌ El correo electrónico no se encuentra registrado.";
        header("Location: ../recuperar_contraseña_paso1.php");
        exit();
    }

    $stmt->close();
    $conn->close();

} else {
    header("Location: ../recuperar_contraseña_paso1.php");
    exit();
}
?>