<?php
$dataFile = '../data/contacto.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevaData = [
        "contacto" => [
            "telefono" => $_POST['contacto_telefono'] ?? '',
            "email" => $_POST['contacto_email'] ?? '',
            "instagram_url" => $_POST['contacto_instagram_url'] ?? '',
            "instagram_text" => $_POST['contacto_instagram_text'] ?? '',
            "facebook_url" => $_POST['contacto_facebook_url'] ?? '',
            "facebook_text" => $_POST['contacto_facebook_text'] ?? '',
            "tiktok_url" => $_POST['contacto_tiktok_url'] ?? '',
            "tiktok_text" => $_POST['contacto_tiktok_text'] ?? '',
            "horario" => $_POST['contacto_horario'] ?? ''
        ]
    ];

    if (file_put_contents($dataFile, json_encode($nuevaData, JSON_PRETTY_PRINT))) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Error writing to file."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>