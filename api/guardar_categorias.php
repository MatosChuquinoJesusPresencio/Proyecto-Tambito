<?php
header('Content-Type: application/json');

$dataFile = '../data/categorias.json';

if (!file_exists($dataFile)) {
    echo json_encode(["success" => false, "message" => "Archivo no encontrado"]);
    exit;
} 

$data = json_decode(file_get_contents($dataFile), true);
$antigua = $_POST['categoria_antigua'];
$nueva = $_POST['categoria_nueva'];

//isset verifica si la categoría antigua y nueva están definidas y no están vacías en null
if (!isset($data[$antigua])) {
    echo json_encode(["success" => false, "message" => "Categoría no encontrada"]);
    exit;
}

// Renombrar la categoría
//
$data[$nueva] = $data[$antigua];
unset($data[$antigua]);

//usa print para que sea legible en el archivo JSON
//usa unset para que los caracteres especiales no se escapen
file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo json_encode(["success" => true]);
