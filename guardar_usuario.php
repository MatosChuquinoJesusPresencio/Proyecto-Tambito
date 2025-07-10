<?php
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

$sql = "INSERT INTO usuarios (nombre, apellido, edad, celular, direccion, email, password, rol)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssisssss", $nombre, $apellido, $edad, $celular, $direccion, $email, $password, $rol);

if ($stmt->execute()) {
    echo "Usuario registrado correctamente. <a href='login.html'>Iniciar sesión</a>";
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
