<?php
header('Content-Type: application/json');

$dataFile = '../data/categorias.json';

if (!file_exists($dataFile)) {
    echo json_encode(["success" => false, "message" => "Archivo no encontrado."]);
    exit;
}

$data = json_decode(file_get_contents($dataFile), true);

echo json_encode(["success" => true, "data" => $data]);
?>
