CREATE DATABASE IF NOT EXISTS tienda_tambo CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE tienda_tambo;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    edad INT NOT NULL,
    celular VARCHAR(20) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('usuario', 'admin') DEFAULT 'usuario'
);

CREATE TABLE IF NOT EXISTS configuracion_general (
    id INT AUTO_INCREMENT PRIMARY KEY,
    clave VARCHAR(50) NOT NULL UNIQUE,    
    valor TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS secciones_inicio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    imagen_url VARCHAR(255) NOT NULL,
    orden INT NOT NULL                    
);

/*
INSERT INTO configuracion_general (clave, valor)
VALUES ('slogan', 'Bienvenido a nuestra tienda, calidad garantizada.');

INSERT INTO secciones_inicio (titulo, imagen_url, orden)
VALUES 
('Categoria1', 'imagenes/frescos.jpg', 1),
('Categoria2', 'imagenes/ofertas.jpg', 2),
('Categoria3', 'imagenes/calidad.jpg', 3),
('Categoria4', 'imagenes/atencion.jpg', 4),
('Categoria5', 'imagenes/seguridad.jpg', 5);
*/

CREATE TABLE IF NOT EXISTS nosotros_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seccion ENUM('nosotros', 'mision', 'vision') NOT NULL UNIQUE,
    titulo VARCHAR(100) NOT NULL,
    contenido TEXT NOT NULL,
    imagen_url VARCHAR(255) NOT NULL
);

/*
INSERT INTO nosotros_info (seccion, titulo, contenido, imagen_url)
VALUES
('nosotros', 'Sobre Nosotros', 'Somos una empresa comprometida con la calidad y el servicio.', 'imagenes/nosotros.jpg'),
('mision', 'Nuestra Misión', 'Ofrecer productos de primera necesidad con excelencia y rapidez.', 'imagenes/mision.jpg'),
('vision', 'Nuestra Visión', 'Ser la cadena de tiendas de conveniencia líder en la región.', 'imagenes/vision.jpg');

*/

CREATE TABLE IF NOT EXISTS contacto_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    horario_atencion VARCHAR(100) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS redes_sociales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,            
    url VARCHAR(255) NOT NULL,
    texto_visible VARCHAR(100) NOT NULL,
    UNIQUE(nombre)                           
);

/*
INSERT INTO contacto_info (horario_atencion, telefono, email)
VALUES ('Lunes a Domingo, 7:00 a.m. – 11:00 p.m.', '(01) 6124999', 'contacto@tambo.com');

INSERT INTO redes_sociales (nombre, url, texto_visible)
VALUES 
('Instagram', 'https://www.instagram.com/tiendas_tambo/', 'tiendas_tambo'),
('Facebook', 'https://www.facebook.com/TamboMas/', 'Tambo +'),
('TikTok', 'https://www.tiktok.com/@tiendas_tambo', 'tiendas_tambo');
*/

CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_categoria INT NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,                
    descuento DECIMAL(5, 2) DEFAULT 0.00,           
    precio_actual DECIMAL(10, 2) NOT NULL,
    imagen_url VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id)
        ON UPDATE CASCADE ON DELETE RESTRICT
);

/*
INSERT INTO categorias (nombre) VALUES 
('Snacks'), 
('Bebidas'), 
('Lácteos');

INSERT INTO productos (id_categoria, nombre, precio, descuento, precio_actual, imagen_url)
VALUES 
(1, 'Papas Fritas Clásicas', 5.00, 10.00, 4.50, 'imagenes/productos/papas_fritas.jpg'),
(2, 'Refresco Cola 500ml', 3.00, 0.00, 3.00, 'imagenes/productos/refresco.jpg');
*/
