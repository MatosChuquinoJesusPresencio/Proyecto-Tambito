<?php
header('Content-Type: application/json');

$dataFile = '../data/categorias.json';

if (!file_exists($dataFile)) {
    echo json_encode(["success" => false, "message" => "Archivo JSON no encontrado."]);
    exit;
}

$data = json_decode(file_get_contents($dataFile), true);

$categoria = $_POST['categoria'];
$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$precio = floatval($_POST['precio']);

if (!isset($_FILES['imagen'])) {
    echo json_encode(["success" => false, "message" => "Imagen no enviada."]);
    exit;
}

$imagenTmp = $_FILES['imagen']['tmp_name'];
$nombreImagen = basename($_FILES['imagen']['name']);
$rutaDestino = "../uploads/" . $nombreImagen;

if (!move_uploaded_file($imagenTmp, $rutaDestino)) {
    echo json_encode(["success" => false, "message" => "Error al mover la imagen."]);
    exit;
}

// Agregar nueva categoría si no existe
if (!isset($data[$categoria])) {
    $data[$categoria] = ["productos" => []];
}

// Agregar producto nuevo
$data[$categoria]["productos"][] = [
    "codigo" => $codigo,
    "nombre" => $nombre,
    "precio" => $precio,
    "imagen_url" => "uploads/" . $nombreImagen
];

file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo json_encode(["success" => true]);
?>
