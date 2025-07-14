<?php
session_start();
include '../conexion.php';

if (!isset($_SESSION['reset_user_id']) || !isset($_SESSION['reset_email'])) {
    $_SESSION['reset_error'] = "❌ Sesión de verificación inválida. Por favor, reinicia el proceso.";
    header("Location: ../recuperar_contraseña_paso1.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_usuario = $_SESSION['reset_user_id'];
    $email_usuario = $_SESSION['reset_email'];
    $edad_ingresada = $_POST['edad_ingresada'] ?? '';

    if (!is_numeric($edad_ingresada) || $edad_ingresada < 1 || $edad_ingresada > 100) {
        $_SESSION['reset_error'] = "❌ Por favor, ingresa una edad válida.";
        header("Location: ../recuperar_contraseña_paso2.php");
        exit();
    }

    // Obtener la edad real del usuario de la base de datos
    $sql = "SELECT edad FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $usuario = $result->fetch_assoc();
        $edad_almacenada = $usuario['edad'];

        // Comparar la edad ingresada directamente con la almacenada
        if (intval($edad_ingresada) === intval($edad_almacenada)) {
            unset($_SESSION['reset_email']);

            header("Location: ../nueva_contraseña.php");
            exit();
        } else {
            $_SESSION['reset_error'] = "❌ La edad ingresada no coincide con nuestros registros.";
            header("Location: ../recuperar_contraseña_paso2.php");
            exit();
        }
    } else {
        $_SESSION['reset_error'] = "❌ Ocurrió un error al verificar tu información. Por favor, intenta de nuevo.";
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