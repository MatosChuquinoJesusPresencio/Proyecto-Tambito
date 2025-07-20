<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$accion = $_GET['accion'] ?? '';

switch ($accion) {
    case 'listar_nosotros':
        require_once '../controllers/NosotrosController.php';
        $controlador = new NosotrosController();
        $controlador->listar();
        break;

    case 'guardar_nosotros':
        require_once '../controllers/NosotrosController.php';
        $controlador = new NosotrosController();
        $controlador->guardar();
        break;

    case 'listar_contacto':
        require_once '../controllers/ContactoController.php';
        $controlador = new ContactoController();
        $controlador->listar();
        break;

    case 'guardar_contacto':
        require_once '../controllers/ContactoController.php';
        $controlador = new ContactoController();
        $controlador->guardar();
        break;

    case 'modificar_categoria':
        require_once '../controllers/CategoriaController.php';
        $controlador = new CategoriaController();
        $controlador->renombrar();
        break;

    case 'listar_categorias':
        require_once '../controllers/CategoriaController.php';
        $controlador = new CategoriaController();
        $controlador->listar();
        break;

    case 'guardar_producto':
        require_once '../controllers/CategoriaController.php';
        $controlador = new CategoriaController();
        $controlador->guardarProducto();
        break;

    case 'actualizar_producto':
        require_once '../controllers/CategoriaController.php';
        $controlador = new CategoriaController();
        $controlador->actualizarProducto();
        break;

    case 'eliminar_producto':
        require_once '../controllers/CategoriaController.php';
        $controlador = new CategoriaController();
        $controlador->eliminarProducto();
        break;

    case 'guardar_config':
        require_once '../controllers/InicioController.php';
        $controlador = new InicioController();
        $controlador->guardar_config();
        break;

    case 'guardar_secciones_inicio':
        require_once '../controllers/InicioController.php';
        $controlador = new InicioController();
        $controlador->guardar_secciones_inicio();
        break;

    case 'obtener_datos_inicio':
        require_once '../controllers/InicioController.php';
        $controlador = new InicioController();
        $controlador->obtener_datos_inicio();
        break;

    default:
        header('Content-Type: application/json');
        echo json_encode([
            'estado' => 'error',
            'mensaje' => 'Acción no reconocida'
        ]);
        break;
}