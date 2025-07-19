<?php

require_once '../models/NosotrosModel.php';

class NosotrosController
{ 
    private $modelo;

    public function __construct()
    {
        $this->modelo = new NosotrosModel();
    }

    public function listar()
    {
        $datos = $this->modelo->obtenerTodos();
        header('Content-Type: application/json');
        echo json_encode($datos);
    }

    public function guardar()
    {
        $seccion   = $_POST['seccion'] ?? '';
        $titulo    = $_POST['titulo'] ?? '';
        $contenido = $_POST['contenido'] ?? '';
        $imagenUrl = '';

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
            $directorioDestino = __DIR__ . '/../img/nosotros/';
            $rutaWeb = 'img/nosotros/';

            if (!file_exists($directorioDestino)) {
                mkdir($directorioDestino, 0777, true);
            }

            $nombreArchivo = uniqid() . '_' . basename($_FILES['imagen']['name']);
            $rutaCompleta = $directorioDestino . $nombreArchivo;

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaCompleta)) {
                $imagenUrl = $rutaWeb . $nombreArchivo;
            }
        }

        if ($seccion && $titulo && $contenido) {
            $resultado = $this->modelo->guardarSeccion($seccion, $titulo, $contenido, $imagenUrl);

            header('Content-Type: application/json');
            echo json_encode([
                'estado' => $resultado ? 'ok' : 'error',
                'mensaje' => $resultado ? 'Sección guardada correctamente' : 'Error al guardar sección'
            ]);
        } else {
            echo json_encode([
                'estado' => 'error',
                'mensaje' => 'Faltan datos obligatorios (sección, título, contenido)'
            ]);
        }
    }
}
