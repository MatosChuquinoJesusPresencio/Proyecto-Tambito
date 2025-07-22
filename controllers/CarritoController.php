<?php
require_once __DIR__ . '/../models/CarritoModel.php';
require_once __DIR__ . '/../models/VentaModel.php';

class CarritoController {
    private $carritoModelo;
    private $ventaModelo; 

    public function __construct() {
        $this->carritoModelo = new CarritoModel();
        $this->ventaModelo = new VentaModel(); 
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
                $cantidad_deseada = $producto_data['cantidad_deseada'] ?? 1;

                if ($codigo) {
                    $this->carritoModelo->añadirProducto($codigo, $nombre, $precio, $imagen_url, $cantidad_deseada);
                    echo json_encode(['estado' => 'exito', 'mensaje' => 'Producto añadido al carrito.']);
                    return;
                }
            }
        }
        echo json_encode(['estado' => 'error', 'mensaje' => 'Datos de producto inválidos.']);
    }

    public function obtenerCarrito() {
        echo json_encode(['estado' => 'exito', 'productos' => $this->carritoModelo->obtenerProductos()]);
    }

    public function vaciarCarrito() {
        $this->carritoModelo->vaciarCarrito();
        echo json_encode(['estado' => 'exito', 'mensaje' => 'Carrito vaciado.']);
    }

    public function procesarPago() {
        $productos_carrito = $this->carritoModelo->obtenerProductos();
        if (empty($productos_carrito)) {
            echo json_encode(['estado' => 'error', 'mensaje' => 'El carrito está vacío.']);
            return;
        }

        $total_venta = 0;
        foreach ($productos_carrito as $item) {
            $total_venta += $item['precio'] * $item['cantidad'];
        }

        if ($this->ventaModelo->guardarVenta($total_venta, $productos_carrito)) {
            $this->carritoModelo->vaciarCarrito(); 
            echo json_encode(['estado' => 'exito', 'mensaje' => 'Pago procesado con éxito. El carrito ha sido vaciado y la venta registrada.']);
        } else {
            echo json_encode(['estado' => 'error', 'mensaje' => 'Error al procesar el pago y registrar la venta.']);
        }
    }
}
?>