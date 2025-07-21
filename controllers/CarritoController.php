<?php
require_once __DIR__ . '/../models/CarritoModel.php';

class CarritoController {
    private $modelo;

    public function __construct() {
        $this->modelo = new CarritoModel();
    }

    public function añadirProducto() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $json_data = file_get_contents('php://input');
            $producto_data = json_decode($json_data, true);

            if ($producto_data) {
                $codigo = $producto_data['codigo'] ?? null;
                $nombre = $producto_data['nombre'] ?? 'Producto Desconocido';
                $precio = $producto_data['precio'] ?? 0;
                $imagen_url = $producto_data['imagen_url'] ?? '';
                $cantidad_deseada = $producto_data['cantidad_deseada'] ?? 1; // Obtener la cantidad deseada

                if ($codigo) {
                    $this->modelo->añadirProducto($codigo, $nombre, $precio, $imagen_url, $cantidad_deseada); // Pasar la cantidad
                    echo json_encode(['estado' => 'exito', 'mensaje' => 'Producto añadido al carrito.']);
                    return;
                }
            }
        }
        echo json_encode(['estado' => 'error', 'mensaje' => 'Datos de producto inválidos.']);
    }

    public function obtenerCarrito() {
        echo json_encode(['estado' => 'exito', 'productos' => $this->modelo->obtenerProductos()]);
    }

    public function vaciarCarrito() {
        $this->modelo->vaciarCarrito();
        echo json_encode(['estado' => 'exito', 'mensaje' => 'Carrito vaciado.']);
    }

    public function procesarPago() {
        $productos_carrito = $this->modelo->obtenerProductos();
        if (empty($productos_carrito)) {
            echo json_encode(['estado' => 'error', 'mensaje' => 'El carrito está vacío.']);
            return;
        }

        $this->modelo->vaciarCarrito();
        echo json_encode(['estado' => 'exito', 'mensaje' => 'Pago procesado con éxito. El carrito ha sido vaciado.']);
    }
}
?>