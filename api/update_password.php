<?php
session_start();
include '../conexion.php';

// Verificar que el usuario está autorizado para actualizar la contraseña
if (!isset($_SESSION['reset_user_id'])) {
    $_SESSION['reset_error'] = "❌ Sesión de restablecimiento inválida. Por favor, reinicia el proceso.";
    header("Location: ../recuperar_contraseña_paso1.php");
    exit();
}

$id_usuario = $_SESSION['reset_user_id'];
$new_password = $_POST['new_password'] ?? '';
$confirm_new_password = $_POST['confirm_new_password'] ?? '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($new_password) || empty($confirm_new_password)) {
        $_SESSION['reset_error'] = "Las contraseñas no pueden estar vacías.";
        header("Location: ../nueva_contraseña.php");
        exit();
    }
    if ($new_password !== $confirm_new_password) {
        $_SESSION['reset_error'] = "Las contraseñas no coinciden.";
        header("Location: ../nueva_contraseña.php");
        exit();
    }

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $sql_update_password = "UPDATE usuarios SET password = ? WHERE id = ?";
    $stmt_update_password = $conn->prepare($sql_update_password);
    $stmt_update_password->bind_param("si", $hashed_password, $id_usuario);

    if ($stmt_update_password->execute()) {
        unset($_SESSION['reset_user_id']);
        
        $_SESSION['success_message_login'] = "🎉 ¡Tu contraseña ha sido restablecida correctamente! Ya puedes iniciar sesión con tu nueva contraseña.";
        header("Location: ../login.php");
        exit();
    } else {
        error_log("Error al actualizar la contraseña del usuario ID: " . $id_usuario . " - Error: " . $stmt_update_password->error);
        $_SESSION['reset_error'] = "Ocurrió un error al actualizar tu contraseña. Por favor, inténtalo de nuevo.";
        header("Location: api/nueva_contraseña.php");
        exit();
    }
    $stmt_update_password->close();
    $conn->close();

} else {
    header("Location: ../recuperar_contraseña_paso1.php");
    exit();
}
?>