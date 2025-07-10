<?php
header('Content-Type: application/json');

$dataFile = '../data/inicio.json';
$uploadDir = '../img/'; // Directorio para las imágenes de categorías

// Crear el directorio de imágenes si no existe
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$response = ["success" => false, "message" => ""];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eslogan = $_POST['eslogan'] ?? '';
    $categorias_destacadas = [];

    // Procesar categorías
    for ($i = 0; $i < 5; $i++) { // Hay 5 categorías fijas
        $nombre_categoria = $_POST["categoria_{$i}_nombre"] ?? '';
        $imagen_existente = $_POST["categoria_{$i}_imagen_actual"] ?? ''; // Campo oculto para la imagen actual

        $imagen_url = $imagen_existente; // Por defecto, mantiene la imagen existente

        // Si se subió una nueva imagen para esta categoría
        if (isset($_FILES["categoria_{$i}_imagen"]) && $_FILES["categoria_{$i}_imagen"]['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["categoria_{$i}_imagen"]['tmp_name'];
            $file_extension = pathinfo($_FILES["categoria_{$i}_imagen"]['name'], PATHINFO_EXTENSION);
            $new_file_name = "categoria_home_{$i}." . $file_extension;
            $destination = $uploadDir . $new_file_name;

            if (move_uploaded_file($tmp_name, $destination)) {
                $imagen_url = 'img/' . $new_file_name;
            } else {
                $response["message"] = "Error al subir imagen para categoría {$i}.";
                echo json_encode($response);
                exit();
            }
        }

        $categorias_destacadas[] = [
            "nombre" => $nombre_categoria,
            "imagen_url" => $imagen_url
        ];
    }

    $nuevaData = [
        "eslogan" => $eslogan,
        "categorias_destacadas" => $categorias_destacadas
    ];

    if (file_put_contents($dataFile, json_encode($nuevaData, JSON_PRETTY_PRINT))) {
        $response["success"] = true;
        $response["message"] = "Contenido de inicio guardado correctamente.";
    } else {
        $response["message"] = "Error al guardar el archivo de inicio.";
    }
} else {
    $response["message"] = "Método de solicitud no válido.";
}

echo json_encode($response);
?>