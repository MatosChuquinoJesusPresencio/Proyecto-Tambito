<?php
session_start(); // Iniciar la sesión al principio
include 'conexion.php';

$nombre    = $_POST['nombre'];
$apellido  = $_POST['apellido'];
$edad      = $_POST['edad'];
$celular   = $_POST['celular'];
$direccion = $_POST['direccion'];
$email     = $_POST['email'];
$password  = password_hash($_POST['password'], PASSWORD_DEFAULT); // cifrado

// Siempre guardamos como usuario normal
$rol = 'usuario';

// Validar si el email ya existe antes de insertar
$sql_check_email = "SELECT id FROM usuarios WHERE email = ?";
$stmt_check_email = $conn->prepare($sql_check_email);
$stmt_check_email->bind_param("s", $email);
$stmt_check_email->execute();
$stmt_check_email->store_result();

if ($stmt_check_email->num_rows > 0) {
    // El email ya existe: Mensaje de error para la página de REGISTRO
    $_SESSION['error_message_registro'] = "❌ El correo electrónico ya está registrado. Por favor, utiliza otro.";
    header("Location: registro.php"); // Redirige de vuelta a registro.php
    exit();
}
$stmt_check_email->close();


$sql = "INSERT INTO usuarios (nombre, apellido, edad, celular, direccion, email, password, rol)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssisssss", $nombre, $apellido, $edad, $celular, $direccion, $email, $password, $rol);

if ($stmt->execute()) {
    // Registro exitoso: Mensaje de éxito para la página de LOGIN
    $_SESSION['success_message_login'] = "🎉 ¡Cuenta creada correctamente! Por favor, inicia sesión.";
    header("Location: login.php"); // Redirige a login.php
    exit();
} else {
    // Error en el registro: Mensaje de error para la página de REGISTRO
    error_log("Error al registrar usuario: " . $stmt->error);
    $_SESSION['error_message_registro'] = "❌ Hubo un error al crear tu cuenta. Por favor, inténtalo de nuevo.";
    header("Location: registro.php"); // Redirige de vuelta a registro.php
    exit();
}

$conn->close();
?>