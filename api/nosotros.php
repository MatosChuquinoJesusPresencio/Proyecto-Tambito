<?php 
header('Content-Type: application/json');//indica que el contenido es JSON
$dataFile = '../data/nosotros.json';//indica donde se guarda la información
if (file_exists($dataFile)) {//verifica si el archivo existe
    echo file_get_contents($dataFile);//si existe, lee el contenido del archivo y lo devuelve como respuesta
} else {//si el archivo no existe, devuelve un JSON por defecto
    // Este JSON es un ejemplo, puedes modificarlo según tus necesidades
    echo json_encode([
        "nosotros" => [
            "titulo" => "NOSOTROS",
            "descripcion" => "Texto nosotros...",
            "imagen_url" => "img/default-icon.png"
        ],
        "mision" => [
            "titulo" => "MISIÓN",
            "descripcion" => "Nuestra misión es...",
            "imagen_url" => "img/default-icon.png"
        ],
        "vision" => [
            "titulo" => "VISIÓN",
            "descripcion" => "Nuestra visión es...",
            "imagen_url" => "img/default-icon.png"
        ]
    ]);
}    