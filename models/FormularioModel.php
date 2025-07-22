<?php
require_once '../conexion.php';

class FormularioModel {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function guardarComentario($nombre, $email, $mensaje) {
        $stmt = $this->conn->prepare("INSERT INTO form_comentarios (nombre, email, mensaje) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $email, $mensaje);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }

    public function guardarPostulacion($nombre, $apellido, $dni, $email, $celular, $departamento, $provincia, $distrito, $direccion, $distrito_trabajo, $horario_trabajo) {
        $stmt = $this->conn->prepare("INSERT INTO form_postulantes (nombre, apellido, dni, email, celular, departamento, provincia, distrito, direccion, distrito_trabajo, horario_trabajo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssss", $nombre, $apellido, $dni, $email, $celular, $departamento, $provincia, $distrito, $direccion, $distrito_trabajo, $horario_trabajo);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }
}
?>