<?php
// Inicia el script PHP

header('Content-Type: application/json');
// Indica que la respuesta será en formato JSON

$dataFile = '../data/categorias.json';
// Define la ruta al archivo donde están guardadas las categorías

if (file_exists($dataFile)) {
// Verifica si el archivo de categorías existe

    echo file_get_contents($dataFile);
// Si existe, lee y muestra el contenido del archivo (que ya está en formato JSON)

} else {
// Si el archivo no existe...

    echo json_encode(["categorias" => []]);
// ...devuelve un JSON vacío con una clave "categorias" que es un array vacío

}