<?php
// controllers/CategoriaController.php
require_once __DIR__ . '/../models/CategoriaModel.php';
require_once __DIR__ . '/../conexion.php'; 

class CategoriaController {
    private $model;
    private $conn;

    public function __construct() {
        global $conn; 
        $this->conn = $conn;
        $this->model = new CategoriaModel($this->conn);
    }

    public function renombrar() {
        header('Content-Type: application/json');
        $antigua = $_POST['categoria_antigua'] ?? '';
        $nueva = $_POST['categoria_nueva'] ?? '';

        if (empty($antigua) || empty($nueva)) {
            echo json_encode(["success" => false, "message" => "Completa ambos campos."]);
            exit;
        }

        $result = $this->model->renombrarCategoria($antigua, $nueva);
        echo json_encode($result);
    }

    public function guardarProducto() {
        header('Content-Type: application/json');

        $categoria = $_POST['categoria'] ?? '';
        $codigo = $_POST['codigo'] ?? '';
        $nombre = $_POST['nombre'] ?? '';
        $precio = floatval($_POST['precio'] ?? 0);
        $imagen_url = null;

        if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(["success" => false, "message" => "Imagen no enviada o error al subirla."]);
            exit;
        }

        $imagenTmp = $_FILES['imagen']['tmp_name'];
        $nombreImagen = basename($_FILES['imagen']['name']);
        $rutaDestino = __DIR__ . "/../uploads/" . $nombreImagen;

        if (!is_dir(__DIR__ . '/../uploads')) {
            mkdir(__DIR__ . '/../uploads', 0777, true);
        }

        if (!move_uploaded_file($imagenTmp, $rutaDestino)) {
            echo json_encode(["success" => false, "message" => "Error al mover la imagen."]);
            exit;
        }

        $imagen_url = "uploads/" . $nombreImagen;

        $result = $this->model->crearProducto($categoria, $codigo, $nombre, $precio, $imagen_url);
        echo json_encode($result);
    }

    public function actualizarProducto() {
        header('Content-Type: application/json');

        $codigo = $_POST['codigo'] ?? '';
        $nombre = $_POST['nombre'] ?? '';
        $precio = floatval($_POST['precio'] ?? 0);
        $imagen_url = null;

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $tmp = $_FILES['imagen']['tmp_name'];
            $nombreArchivo = basename($_FILES['imagen']['name']);
            $ruta = __DIR__ . "/../uploads/" . $nombreArchivo;

            if (!is_dir(__DIR__ . '/../uploads')) {
                mkdir(__DIR__ . '/../uploads', 0777, true);
            }

            if (!move_uploaded_file($tmp, $ruta)) {
                echo json_encode(["success" => false, "message" => "No se pudo subir la imagen."]);
                exit;
            }
            $imagen_url = "uploads/" . $nombreArchivo;
        }

        $result = $this->model->actualizarProducto($codigo, $nombre, $precio, $imagen_url);
        echo json_encode($result);
    }

    public function eliminarProducto() {
        header('Content-Type: application/json');
        $codigo = $_POST['codigo'] ?? '';

        if (empty($codigo)) {
            echo json_encode(["success" => false, "message" => "El código del producto es requerido para eliminar."]);
            exit;
        }

        $result = $this->model->eliminarProducto($codigo);
        echo json_encode($result);
    }
}
?>