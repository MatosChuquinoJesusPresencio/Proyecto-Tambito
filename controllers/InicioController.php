<?php
require_once '../models/InicioModel.php';

class InicioController {
  private $modelo;

  public function __construct() {
    $this->modelo = new InicioModel();
  }

  public function guardar_config() {
    $clave = $_POST['clave'] ?? '';
    $valor = $_POST['valor'] ?? '';

    $ok = $this->modelo->guardarConfig($clave, $valor);

    header('Content-Type: application/json');
    echo json_encode([
      'estado' => $ok ? 'ok' : 'error',
      'mensaje' => $ok ? 'Eslogan guardado correctamente.' : 'Error al guardar el eslogan.'
    ]);
  }

  public function guardar_secciones_inicio() {
    $secciones = [];

    for ($i = 1; $i <= 5; $i++) {
      $titulo = $_POST["cat_{$i}_titulo"] ?? '';
      $orden = $_POST["cat_{$i}_orden"] ?? $i;

      $imagen_url = $_POST["cat_{$i}_imagen_actual"] ?? '';

      if (
        isset($_FILES["cat_{$i}_imagen"]) &&
        is_array($_FILES["cat_{$i}_imagen"]) &&
        $_FILES["cat_{$i}_imagen"]["error"] === 0
      ) {
        // Construimos el nombre y la ruta
        $nombre = "categoria_" . $orden . "_" . time() . ".png";
        $carpeta = __DIR__ . '/../img/categorias_home/';

        // Creamos la carpeta si no existe
        if (!file_exists($carpeta)) {
          mkdir($carpeta, 0755, true);
        }

        $ruta_destino = $carpeta . $nombre;

        // Movemos el archivo
        move_uploaded_file($_FILES["cat_{$i}_imagen"]["tmp_name"], $ruta_destino);

        // Guardamos el path relativo
        $imagen_url = "img/categorias_home/" . $nombre;
      }

      $secciones[] = [
        'titulo' => $titulo,
        'imagen_url' => $imagen_url,
        'orden' => $orden
      ];
    }

    // Guardamos en la base de datos
    $this->modelo->guardarSecciones($secciones);

    header('Content-Type: application/json');
    echo json_encode([
      'estado' => 'ok',
      'mensaje' => 'Categorías guardadas correctamente.'
    ]);
  }

  public function obtener_datos_inicio() {
    $slogan = $this->modelo->obtenerConfig('slogan');
    $categorias = $this->modelo->listarSecciones();

    header('Content-Type: application/json');
    echo json_encode([
      'slogan' => $slogan,
      'categorias' => $categorias
    ]);
  }
}