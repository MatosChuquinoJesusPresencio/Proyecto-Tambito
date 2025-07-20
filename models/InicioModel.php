<?php
require_once '../config/Conexion.php';

class InicioModel {
  private $conexion;

  public function __construct() {
    $this->conexion = Conexion::conectar();
  }

  public function guardarConfig($clave, $valor) {
    $stmt = $this->conexion->prepare("
      INSERT INTO configuracion_general (clave, valor)
      VALUES (?, ?)
      ON DUPLICATE KEY UPDATE valor = VALUES(valor)
    ");
    return $stmt->execute([$clave, $valor]);
  }

  public function obtenerConfig($clave) {
    $stmt = $this->conexion->prepare("SELECT valor FROM configuracion_general WHERE clave = ?");
    $stmt->execute([$clave]);
    return $stmt->fetchColumn();
  }

  public function guardarSecciones($secciones) {
    $this->conexion->exec("DELETE FROM secciones_inicio");

    foreach ($secciones as $sec) {
      $stmt = $this->conexion->prepare("
        REPLACE INTO secciones_inicio (orden, titulo, imagen_url)
        VALUES (?, ?, ?)
      ");
      $stmt->execute([$sec['orden'], $sec['titulo'], $sec['imagen_url']]);
    }

    return true;
  }

  public function listarSecciones() {
    $stmt = $this->conexion->query("
      SELECT titulo, imagen_url, orden
      FROM secciones_inicio
      ORDER BY orden ASC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}