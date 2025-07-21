<?php

class CarritoModel {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
    }

    public function añadirProducto($codigo, $nombre, $precio, $imagen_url, $cantidad_deseada = 1) { 
        if (isset($_SESSION['carrito'][$codigo])) {
            $_SESSION['carrito'][$codigo]['cantidad'] += $cantidad_deseada; 
        } else {
            $_SESSION['carrito'][$codigo] = [
                'codigo' => $codigo,
                'nombre' => $nombre,
                'precio' => $precio,
                'imagen_url' => $imagen_url,
                'cantidad' => $cantidad_deseada 
            ];
        }
    }

    public function obtenerProductos() {
        return array_values($_SESSION['carrito']);
    }

    public function vaciarCarrito() {
        $_SESSION['carrito'] = [];
    }
}
?>