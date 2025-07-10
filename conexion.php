<?php
$host = "localhost";
$user = "root";
$pass = ""; // sin contraseña por defecto en XAMPP
$dbname = "tienda_tambo"; // cambia si usaste otro nombre de base de datos

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
