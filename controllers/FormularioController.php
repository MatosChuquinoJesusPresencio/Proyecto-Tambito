<?php
require_once '../models/FormularioModel.php';

class FormularioController {
    private $modelo;

    public function __construct() {
        $this->modelo = new FormularioModel();
    }

    public function guardarComentario() {
        $nombre = $_POST['feedback-name'] ?? '';
        $email = $_POST['feedback-email'] ?? '';
        $mensaje = $_POST['feedback-message'] ?? '';

        if (empty($nombre) || empty($email) || empty($mensaje)) {
            echo json_encode(['estado' => 'error', 'mensaje' => 'Todos los campos son obligatorios.']);
            return;
        }

        if ($this->modelo->guardarComentario($nombre, $email, $mensaje)) {
            echo json_encode(['estado' => 'exito', 'mensaje' => 'Comentario enviado con éxito.']);
        } else {
            echo json_encode(['estado' => 'error', 'mensaje' => 'Error al guardar el comentario.']);
        }
    }

    public function guardarPostulacion() {
        $nombre = $_POST['app-name'] ?? '';
        $apellido = $_POST['app-lastname'] ?? '';
        $dni = $_POST['app-dni'] ?? '';
        $email = $_POST['app-email'] ?? '';
        $celular = $_POST['app-phone'] ?? '';
        $departamento = $_POST['app-department'] ?? '';
        $provincia = $_POST['app-province'] ?? '';
        $distrito = $_POST['app-district'] ?? '';
        $direccion = $_POST['app-address'] ?? '';
        $distrito_trabajo = $_POST['app-work-district'] ?? '';
        $horario_trabajo = $_POST['app-schedule'] ?? '';

        if (empty($nombre) || empty($apellido) || empty($dni) || empty($email) || empty($celular) || empty($departamento) || empty($provincia) || empty($distrito) || empty($direccion)) {
            echo json_encode(['estado' => 'error', 'mensaje' => 'Los campos obligatorios de la postulación no pueden estar vacíos.']);
            return;
        }

        if ($this->modelo->guardarPostulacion($nombre, $apellido, $dni, $email, $celular, $departamento, $provincia, $distrito, $direccion, $distrito_trabajo, $horario_trabajo)) {
            echo json_encode(['estado' => 'exito', 'mensaje' => 'Postulación enviada con éxito.']);
        } else {
            echo json_encode(['estado' => 'error', 'mensaje' => 'Error al guardar la postulación.']);
        }
    }
}
?>