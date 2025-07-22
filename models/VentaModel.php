<?php
require_once __DIR__ . '/../conexion.php';

class VentaModel {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function guardarVenta($total, $productos) {
        $this->conn->begin_transaction(); 
        try {
            $stmt = $this->conn->prepare("INSERT INTO ventas (total) VALUES (?)");
            $stmt->bind_param("d", $total);
            $stmt->execute();
            $venta_id = $this->conn->insert_id; 
            $stmt->close();

            $stmt_detalle = $this->conn->prepare("INSERT INTO detalles_venta (venta_id, codigo_producto, nombre_producto, cantidad, precio_unitario) VALUES (?, ?, ?, ?, ?)");
            foreach ($productos as $producto) {
                $codigo = $producto['codigo'];
                $nombre = $producto['nombre'];
                $cantidad = $producto['cantidad'];
                $precio_unitario = $producto['precio'];
                $stmt_detalle->bind_param("isdid", $venta_id, $codigo, $nombre, $cantidad, $precio_unitario);
                $stmt_detalle->execute();
            }
            $stmt_detalle->close();

            $this->conn->commit(); 
            return true;
        } catch (Exception $e) {
            $this->conn->rollback(); 
            error_log("Error al guardar la venta: " . $e->getMessage()); 
            return false;
        }
    }
}
?>