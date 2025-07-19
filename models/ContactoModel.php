<?php

require_once '../config/Conexion.php';

class ContactoModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }
 
    public function obtener()
    {
        $info = $this->conexion->query("SELECT * FROM contacto_info LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        $redes = $this->conexion->query("SELECT nombre, url, texto_visible FROM redes_sociales")->fetchAll(PDO::FETCH_ASSOC);

        return [
            'info' => $info,
            'redes' => $redes
        ];
    }

    public function guardar($info, $redes)
    {
        $stmt = $this->conexion->prepare("
            INSERT INTO contacto_info (id, horario_atencion, telefono, email)
            VALUES (1, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
                horario_atencion = VALUES(horario_atencion),
                telefono = VALUES(telefono),
                email = VALUES(email)
        ");
        $stmt->execute([
            $info['horario_atencion'],
            $info['telefono'],
            $info['email']
        ]);
        error_log("Guardado en contacto_info: " . $stmt->rowCount());

        foreach ($redes as $red) {
            $stmt2 = $this->conexion->prepare("
                REPLACE INTO redes_sociales (nombre, url, texto_visible)
                VALUES (?, ?, ?)
            ");
            $stmt2->execute([
                $red['nombre'],
                $red['url'],
                $red['texto_visible']
            ]);
            error_log("Red social guardada: " . $red['nombre'] . " - Filas afectadas: " . $stmt2->rowCount());
        }

        return true;
    }
}