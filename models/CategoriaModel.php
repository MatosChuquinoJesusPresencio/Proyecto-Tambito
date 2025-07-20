<?php

class CategoriaModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function renombrarCategoria($antigua, $nueva) {
        $stmt = $this->conn->prepare("UPDATE productos SET categoria = ? WHERE categoria = ?");
        if ($stmt === false) {
            return ["success" => false, "message" => "Error al preparar la consulta: " . $this->conn->error];
        }
        $stmt->bind_param("ss", $nueva, $antigua);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return ["success" => true, "message" => "Categoría renombrada con éxito."];
            } else {
                return ["success" => false, "message" => "Categoría antigua no encontrada o no se realizaron cambios."];
            }
        } else {
            return ["success" => false, "message" => "Error al renombrar la categoría: " . $stmt->error];
        }
        $stmt->close();
    }

    public function crearProducto($categoria, $codigo, $nombre, $precio, $imagen_url) {
        $stmt = $this->conn->prepare("INSERT INTO productos (codigo, nombre, precio, imagen_url, categoria) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            return ["success" => false, "message" => "Error al preparar la consulta: " . $this->conn->error];
        }

        $stmt->bind_param("ssdss", $codigo, $nombre, $precio, $imagen_url, $categoria);

        if ($stmt->execute()) {
            return ["success" => true, "message" => "Producto creado exitosamente."];
        } else {
            if ($stmt->errno == 1062) {
                return ["success" => false, "message" => "Error: El código de producto ya existe."];
            } else {
                return ["success" => false, "message" => "Error al guardar el producto: " . $stmt->error];
            }
        }
        $stmt->close();
    }

    public function actualizarProducto($codigo, $nombre, $precio, $imagen_url = null) {
        if ($imagen_url) {
            $stmt = $this->conn->prepare("UPDATE productos SET nombre = ?, precio = ?, imagen_url = ? WHERE codigo = ?");
            if ($stmt === false) {
                return ["success" => false, "message" => "Error al preparar la consulta: " . $this->conn->error];
            }
            $stmt->bind_param("sdss", $nombre, $precio, $imagen_url, $codigo);
        } else {
            $stmt = $this->conn->prepare("UPDATE productos SET nombre = ?, precio = ? WHERE codigo = ?");
            if ($stmt === false) {
                return ["success" => false, "message" => "Error al preparar la consulta: " . $this->conn->error];
            }
            $stmt->bind_param("sds", $nombre, $precio, $codigo);
        }

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return ["success" => true, "message" => "Producto actualizado con éxito."];
            } else {
                return ["success" => false, "message" => "Producto no encontrado o no se realizaron cambios."];
            }
        } else {
            return ["success" => false, "message" => "Error al actualizar el producto: " . $stmt->error];
        }
        $stmt->close();
    }

    public function eliminarProducto($codigo) {
        $stmt = $this->conn->prepare("DELETE FROM productos WHERE codigo = ?");
        if ($stmt === false) {
            return ["success" => false, "message" => "Error al preparar la consulta de eliminación: " . $this->conn->error];
        }
        $stmt->bind_param("s", $codigo);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return ["success" => true, "message" => "Producto eliminado con éxito."];
            } else {
                return ["success" => false, "message" => "Producto no encontrado para eliminar."];
            }
        } else {
            return ["success" => false, "message" => "Error al eliminar el producto: " . $stmt->error];
        }
        $stmt->close();
    }
}
?>