<?php
class Conexion
{
    public static function conectar()
    {
        try {
            $opciones = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
            
            return new PDO(
                "mysql:host=localhost;port=3306;dbname=tienda_tambo",
                "root",
                "",
                $opciones
            );
        } catch (PDOException $e) {
            die("Error en la conexión: " . $e->getMessage());
        }
    }
}
 