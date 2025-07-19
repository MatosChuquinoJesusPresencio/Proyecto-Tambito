<?php

require_once '../models/ContactoModel.php';

class ContactoController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new ContactoModel();
    }

    public function listar()
    {
        $datos = $this->modelo->obtener();
        header('Content-Type: application/json');
        echo json_encode($datos);
    }

    public function guardar()
    {
        error_log("POST recibido:");
        error_log(print_r($_POST, true));

        $info = [
            'horario_atencion' => $_POST['horario_atencion'] ?? '',
            'telefono'         => $_POST['telefono'] ?? '',
            'email'            => $_POST['email'] ?? ''
        ];

        $redes = [
            [
                'nombre'         => 'Instagram',
                'url'            => $_POST['instagram_url'] ?? '',
                'texto_visible'  => $_POST['instagram_text'] ?? ''
            ],
            [
                'nombre'         => 'Facebook',
                'url'            => $_POST['facebook_url'] ?? '',
                'texto_visible'  => $_POST['facebook_text'] ?? ''
            ],
            [
                'nombre'         => 'TikTok',
                'url'            => $_POST['tiktok_url'] ?? '',
                'texto_visible'  => $_POST['tiktok_text'] ?? ''
            ]
        ];

        $this->modelo->guardar($info, $redes);
        error_log("POST recibido:");
        error_log(print_r($_POST, true));

        header('Content-Type: application/json');
        echo json_encode([
            'estado' => 'ok',
            'mensaje' => 'Información de contacto actualizada correctamente.'
        ]);
    }
}