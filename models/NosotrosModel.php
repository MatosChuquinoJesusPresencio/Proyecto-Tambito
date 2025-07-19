<?php

require_once '../config/Conexion.php';

class NosotrosModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    public function obtenerTodos()
    {
        $sql = "SELECT * FROM nosotros_info";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardarSeccion($seccion, $titulo, $contenido, $imagen_url)
    {
        $sql = "INSERT INTO nosotros_info (seccion, titulo, contenido, imagen_url)
                VALUES (?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE
                    titulo = VALUES(titulo),
                    contenido = VALUES(contenido),
                    imagen_url = VALUES(imagen_url)";

        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$seccion, $titulo, $contenido, $imagen_url]);
    }
}
