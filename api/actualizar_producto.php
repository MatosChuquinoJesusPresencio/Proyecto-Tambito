<?php
header('Content-Type: application/json');

$dataFile = '../data/categorias.json';

if (!file_exists($dataFile)) {
    echo json_encode(["success" => false, "message" => "Archivo JSON no encontrado."]);
    exit;
}

$data = json_decode(file_get_contents($dataFile), true);

$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$precio = floatval($_POST['precio']);
$imagen_url = null;

if (isset($_FILES['imagen'])) {
    $tmp = $_FILES['imagen']['tmp_name'];
    $nombreArchivo = basename($_FILES['imagen']['name']);
    $ruta = "../uploads/" . $nombreArchivo;

    if (!move_uploaded_file($tmp, $ruta)) {
        echo json_encode(["success" => false, "message" => "No se pudo subir la imagen."]);
        exit;
    }

    $imagen_url = "uploads/" . $nombreArchivo;
}

// Buscar y actualizar el producto
$productoEncontrado = false;
foreach ($data as $categoria => &$contenido) {
    foreach ($contenido['productos'] as &$producto) {
        if ($producto['codigo'] === $codigo) {
            $producto['nombre'] = $nombre;
            $producto['precio'] = $precio;
            if ($imagen_url) {
                $producto['imagen_url'] = $imagen_url;
            }
            $productoEncontrado = true;
            break 2;
        }
    } 
}

if (!$productoEncontrado) {
    echo json_encode(["success" => false, "message" => "Producto no encontrado."]);
    exit;
}

file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo json_encode(["success" => true]);
