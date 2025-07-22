<?php
// Asegurarse de que la sesión esté iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Redirigir si el usuario no está logueado o no tiene el rol de 'usuario'
if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'usuario') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];
$nombre = "";
$apellido = "";
$email = "";
$edad = "";
$celular = "";
$direccion = "";
$message = "";
$message_type = "";

// --- Lógica para OBTENER los datos del usuario ---
$sql_select = "SELECT nombre, apellido, email, edad, celular, direccion FROM usuarios WHERE id = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("i", $user_id);
$stmt_select->execute();
$result_select = $stmt_select->get_result();

if ($result_select->num_rows === 1) {
    $usuario = $result_select->fetch_assoc();
    $nombre = htmlspecialchars($usuario['nombre']);
    $apellido = htmlspecialchars($usuario['apellido']);
    $email = htmlspecialchars($usuario['email']);
    $edad = htmlspecialchars($usuario['edad']);
    $celular = htmlspecialchars($usuario['celular']);
    $direccion = htmlspecialchars($usuario['direccion']);
} else {
    $_SESSION['message'] = "Error: No se encontraron los datos del usuario.";
    $_SESSION['message_type'] = "error";
    header("Location: perfil.php"); 
    exit();
}
$stmt_select->close();


// --- Lógica para MANEJAR ACTUALIZACIONES (Perfil o Contraseña) ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] === 'update_profile') {
        // --- Actualizar Perfil ---
        $new_nombre = trim($_POST['nombre']);
        $new_apellido = trim($_POST['apellido']);
        $new_email = trim($_POST['email']);
        $new_edad = trim($_POST['edad']);
        $new_celular = trim($_POST['celular']);
        $new_direccion = trim($_POST['direccion']);

        // Validaciones
        if (empty($new_nombre) || empty($new_apellido) || empty($new_email) || empty($new_edad) || empty($new_celular) || empty($new_direccion)) {
            $_SESSION['message'] = "Todos los campos del perfil son obligatorios.";
            $_SESSION['message_type'] = "error";
        } else if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "El formato del correo electrónico es inválido.";
            $_SESSION['message_type'] = "error";
        } else {
            // Validar que el nuevo email no esté ya registrado por OTRO usuario
            $sql_check_email = "SELECT id FROM usuarios WHERE email = ? AND id != ?";
            $stmt_check_email = $conn->prepare($sql_check_email);
            $stmt_check_email->bind_param("si", $new_email, $user_id);
            $stmt_check_email->execute();
            $result_check_email = $stmt_check_email->get_result();

            if ($result_check_email->num_rows > 0) {
                $_SESSION['message'] = "El correo electrónico ya está registrado por otra cuenta.";
                $_SESSION['message_type'] = "error";
            } else {
                // Actualizar datos en la base de datos
                $sql_update = "UPDATE usuarios SET nombre = ?, apellido = ?, email = ?, edad = ?, celular = ?, direccion = ? WHERE id = ?";
                $stmt_update = $conn->prepare($sql_update);
                // El orden de los tipos debe coincidir con el orden de las variables
                // s (nombre), s (apellido), s (email), i (edad), s (celular), s (direccion), i (id)
                $stmt_update->bind_param("sssissi", $new_nombre, $new_apellido, $new_email, $new_edad, $new_celular, $new_direccion, $user_id);

                if ($stmt_update->execute()) {
                    $_SESSION['message'] = "¡Perfil actualizado exitosamente!";
                    $_SESSION['message_type'] = "success";
                    // Actualizar variables de sesión con los nuevos datos
                    $_SESSION['nombre'] = $new_nombre;
                    $_SESSION['apellido'] = $new_apellido;
                    // El email se refrescará con la próxima carga del perfil, o podrías actualizarlo también en sesión si es crítico para otras partes.
                } else {
                    $_SESSION['message'] = "Error al actualizar el perfil: " . $stmt_update->error;
                    $_SESSION['message_type'] = "error";
                }
                $stmt_update->close();
            }
            $stmt_check_email->close();
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'change_password') {
        // --- Cambiar Contraseña ---
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if (empty($new_password) || empty($confirm_password)) {
            $_SESSION['message'] = "Por favor, introduce y confirma la nueva contraseña.";
            $_SESSION['message_type'] = "error";
        } elseif ($new_password !== $confirm_password) {
            $_SESSION['message'] = "Las contraseñas no coinciden.";
            $_SESSION['message_type'] = "error";
        } elseif (strlen($new_password) < 6) { 
            $_SESSION['message'] = "La contraseña debe tener al menos 6 caracteres.";
            $_SESSION['message_type'] = "error";
        } else {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $sql_password = "UPDATE usuarios SET password = ? WHERE id = ?";
            $stmt_password = $conn->prepare($sql_password);
            $stmt_password->bind_param("si", $hashed_password, $user_id);

            if ($stmt_password->execute()) {
                $_SESSION['message'] = "¡Contraseña actualizada exitosamente!";
                $_SESSION['message_type'] = "success";
            } else {
                $_SESSION['message'] = "Error al cambiar la contraseña: " . $stmt_password->error;
                $_SESSION['message_type'] = "error";
            }
            $stmt_password->close();
        }
    }
    // Redirigir para refrescar los datos y limpiar el POST (Previene reenvío de formulario)
    header("Location: perfil.php");
    exit();
}

// Recuperar mensajes de la sesión si existen
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $message_type = $_SESSION['message_type'];
    unset($_SESSION['message']);
    unset($_SESSION['message_type']); 
}

$conn->close();
?>