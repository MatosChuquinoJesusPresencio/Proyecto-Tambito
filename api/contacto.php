<?php
$dataFile = '../data/contacto.json';

if (file_exists($dataFile)) {
    echo file_get_contents($dataFile);
} else {
    echo json_encode(["error" => "Contact data not found."]);
}
?>