<?php
header('Content-Type: application/json');
require_once '../conexion.php';

$data = [];
$sql = "SELECT categoria, codigo, nombre, precio, precio_anterior, descuento, imagen_url FROM productos ORDER BY categoria, nombre";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categoria = $row['categoria'];
        if (!isset($data[$categoria])) {
            $data[$categoria] = ["productos" => []];
        }
        unset($row['categoria']); // Eliminar categoria del array de producto
        // Convertir valores numéricos a tipos apropiados si es necesario (aunque la codificación JSON suele manejar esto)
        $row['precio'] = (float) $row['precio'];
        if ($row['precio_anterior'] !== null) {
            $row['precio_anterior'] = (float) $row['precio_anterior'];
        }
        if ($row['descuento'] !== null) {
            $row['descuento'] = (int) $row['descuento'];
        }

        $data[$categoria]['productos'][] = $row;
    }
}

echo json_encode($data);

$conn->close();
?>