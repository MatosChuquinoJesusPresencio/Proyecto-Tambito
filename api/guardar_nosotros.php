<?php
$dataFile = '../data/nosotros.json';
 
// Crear carpeta si no existe
if (!file_exists('../uploads')) {
    mkdir('../uploads', 0777, true);
}
   
// Procesar imagen y moverla
function procesarImagen($campo, $nombreFinal) {
    if (isset($_FILES[$campo]) && $_FILES[$campo]['error'] === UPLOAD_ERR_OK) {
        $ruta = '../uploads/' . $nombreFinal;
        move_uploaded_file($_FILES[$campo]['tmp_name'], $ruta);
        return 'uploads/' . $nombreFinal;
    }
    return $_POST["{$campo}_actual"] ?? 'img/default-icon.png';
}

// Construir el nuevo JSON
$nuevaData = [
    "nosotros" => [
        "titulo" => $_POST['nosotros_titulo'],
        "descripcion" => $_POST['nosotros_descripcion'],
        "imagen_url" => procesarImagen('nosotros_imagen', 'imagen-nosotros.png')
    ],
    "mision" => [
        "titulo" => $_POST['mision_titulo'],
        "descripcion" => $_POST['mision_descripcion'],
        "imagen_url" => procesarImagen('mision_imagen', 'imagen-mision.png')
    ],
    "vision" => [
        "titulo" => $_POST['vision_titulo'],
        "descripcion" => $_POST['vision_descripcion'],
        "imagen_url" => procesarImagen('vision_imagen', 'imagen-vision.png')
    ]
];

// Guardar en el archivo JSON
file_put_contents($dataFile, json_encode($nuevaData, JSON_PRETTY_PRINT));
// Responder con éxito
echo json_encode(["success" => true]);
