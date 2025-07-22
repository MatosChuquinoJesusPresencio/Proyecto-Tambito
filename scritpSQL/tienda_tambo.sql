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

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `edad`, `celular`, `direccion`, `email`, `password`, `rol`) VALUES
(1, 'Admin', 'Tambo', 25, '999999999', 'Av. Margarita 123', 'admin@tambo.pe', '$2y$10$kC/fio02xABuVXZ.fvlemeLpAq/oq0epoM4wLRWx6Iw.9ARXrSQrG', 'admin'),
(2, 'Pepe', 'Perez', 21, '989898989', 'Av. Primavera 123', 'usuario@tambo.pe', '$2y$10$5qZMfO5tdnHdf5OOEA7fbeNYmoGF8FIqMaUgx4H4e1MRzCKcGjQBK', 'usuario');


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

INSERT INTO configuracion_general (clave, valor)
VALUES ('slogan', 'CADA VEZ MÁS CERCA');

INSERT INTO secciones_inicio (titulo, imagen_url, orden)
VALUES 
('Categoria1', 'img/categorias_home/categoria_1_1753031721.png', 1),
('Categoria2', 'img/categorias_home/categoria_2_1753031721.png', 2),
('Categoria3', 'img/categorias_home/categoria_3_1753031721.png', 3),
('Categoria4', 'img/categorias_home/categoria_4_1753031721.png', 4),
('Categoria5', 'img/categorias_home/categoria_5_1753031721.png', 5);


CREATE TABLE IF NOT EXISTS nosotros_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seccion ENUM('nosotros', 'mision', 'vision') NOT NULL UNIQUE,
    titulo VARCHAR(100) NOT NULL,
    contenido TEXT NOT NULL,
    imagen_url VARCHAR(255) NOT NULL
);


INSERT INTO nosotros_info (seccion, titulo, contenido, imagen_url)
VALUES
('nosotros', 'Sobre Nosotros', 'Somos una empresa comprometida con la calidad y el servicio.', 'img/nosotros/nosotros.png'),
('mision', 'Nuestra Misión', 'Ofrecer productos de primera necesidad con excelencia y rapidez.', 'img/nosotros/mision.png'),
('vision', 'Nuestra Visión', 'Ser la cadena de tiendas de conveniencia líder en la región.', 'img/nosotros/vision.png');

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

INSERT INTO contacto_info (horario_atencion, telefono, email)
VALUES ('Lunes a Domingo, 7:00 a.m. – 11:00 p.m.', '(01) 6124999', 'contacto@tambo.com');

INSERT INTO redes_sociales (nombre, url, texto_visible)
VALUES 
('Instagram', 'https://www.instagram.com/tiendas_tambo/', 'tiendas_tambo'),
('Facebook', 'https://www.facebook.com/TamboMas/', 'Tambo +'),
('TikTok', 'https://www.tiktok.com/@tiendas_tambo', 'tiendas_tambo');

-- Productos
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) UNIQUE NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    precio_anterior DECIMAL(10, 2) NULL,
    descuento INT NULL,
    imagen_url VARCHAR(255) NOT NULL,
    categoria VARCHAR(100) NOT NULL
);

INSERT INTO `productos` (`id`, `codigo`, `nombre`, `precio`, `precio_anterior`, `descuento`, `imagen_url`, `categoria`) VALUES
(1, 'P001', 'apfoemf', 33.30, 185.90, 30, './img/PRODUCTOS-CATEGORIA/cerveza1.png', 'Cervezas'),
(2, 'P002', 'PRUEBA 6 CONFEEEEE', 99.90, NULL, NULL, './img/PRODUCTOS-CATEGORIA/cerveza2.png', 'Cervezas'),
(3, 'P003', 'Vapeador Deluxe Edition', 159.90, 189.90, 15, './img/PRODUCTOS-CATEGORIA/cerveza3.png', 'Cervezas'),
(4, 'P004', 'Vapeador Basic 3000', 75.90, NULL, NULL, './img/PRODUCTOS-CATEGORIA/cerveza4.png', 'Cervezas'),
(5, 'P005', 'Kit Pod System', 99.90, 124.90, 20, './img/PRODUCTOS-CATEGORIA/cerveza5.png', 'Cervezas'),
(6, 'P006', 'Vape Pen Slim', 65.90, NULL, NULL, './img/PRODUCTOS-CATEGORIA/cerveza6.png', 'Cervezas'),
(7, 'P007', 'Mod Avanzado 200W', 199.90, 219.90, 10, './img/PRODUCTOS-CATEGORIA/cerveza7.png', 'Cervezas'),
(8, 'P008', 'Kit Inicial Vapeo', 119.90, NULL, NULL, './img/PRODUCTOS-CATEGORIA/cerveza1.png', 'Cervezas'),
(9, 'CER12333333', 'Ejemplo de cerveza', 90.90, NULL, NULL, './img/PRODUCTOS-CATEGORIA/cerveza2.png', 'Cervezas'),
(10, 'P009', 'Lager Premium 355ml', 15.90, 19.90, 20, './img/PRODUCTOS-CATEGORIA/rtds1.png', 'RTDs'),
(11, 'P010', 'IPA Artesanal 473ml', 18.90, NULL, NULL, './img/PRODUCTOS-CATEGORIA/rtds2.png', 'RTDs'),
(12, 'P011', 'Stout Negra 500ml', 21.90, 25.90, 15, './img/PRODUCTOS-CATEGORIA/rtds3.png', 'RTDs'),
(13, 'P012', 'Cerveza de Trigo 330ml', 16.50, NULL, NULL, './img/PRODUCTOS-CATEGORIA/rtds4.png', 'RTDs'),
(14, 'P013', 'Pack 6 Unidades', 89.90, 99.90, 10, './img/PRODUCTOS-CATEGORIA/rtds5.png', 'RTDs'),
(15, 'P014', 'Light Premium 355ml', 14.90, NULL, NULL, './img/PRODUCTOS-CATEGORIA/rtds6.png', 'RTDs'),
(16, 'P015', 'Edición Limitada 750ml', 34.90, 46.90, 25, './img/PRODUCTOS-CATEGORIA/rtds7.png', 'RTDs'),
(17, 'P016', 'Porter Artesanal 500ml', 22.90, NULL, NULL, './img/PRODUCTOS-CATEGORIA/rtds8.png', 'RTDs'),
(18, 'P017', 'Licor de Café 750ml', 19.90, NULL, NULL, './img/PRODUCTOS-CATEGORIA/licor1.png', 'Licores'),
(19, 'P018', 'Licor de Naranja 700ml', 22.50, NULL, NULL, './img/PRODUCTOS-CATEGORIA/licor2.png', 'Licores'),
(20, 'P019', 'Licor de Fresa 500ml', 18.90, NULL, NULL, './img/PRODUCTOS-CATEGORIA/licor3.png', 'Licores'),
(21, 'P020', 'Licor de Hierbas 750ml', 24.90, NULL, NULL, './img/PRODUCTOS-CATEGORIA/licor4.png', 'Licores'),
(22, 'P021', 'Licor de Coco 700ml', 21.50, NULL, NULL, './img/PRODUCTOS-CATEGORIA/licor5.png', 'Licores'),
(23, 'P022', 'Licor de Menta 500ml', 17.90, NULL, NULL, './img/PRODUCTOS-CATEGORIA/licor6.png', 'Licores'),
(24, 'P023', 'Licor de Almendra 750ml', 25.90, NULL, NULL, './img/PRODUCTOS-CATEGORIA/licor7.png', 'Licores'),
(25, 'P024', 'Licor de Vainilla 700ml', 20.90, NULL, NULL, './img/PRODUCTOS-CATEGORIA/licor8.png', 'Licores'),
(26, 'P025', 'Lager Premium 355ml', 15.90, 19.90, 20, './img/PRODUCTOS-CATEGORIA/vape1.png', 'Cigarros'),
(27, 'P026', 'IPA Artesanal 473ml', 18.90, NULL, NULL, './img/PRODUCTOS-CATEGORIA/vape2.png', 'Cigarros'),
(28, 'P027', 'Stout Negra 500ml', 21.90, 25.90, 15, './img/PRODUCTOS-CATEGORIA/vape3.png', 'Cigarros'),
(29, 'P028', 'Cerveza de Trigo 330ml', 16.50, NULL, NULL, './img/PRODUCTOS-CATEGORIA/vape4.png', 'Cigarros'),
(30, 'P029', 'Pack 6 Unidades', 89.90, 99.90, 10, './img/PRODUCTOS-CATEGORIA/vape5.png', 'Cigarros'),
(31, 'P030', 'Light Premium 355ml', 14.90, NULL, NULL, './img/PRODUCTOS-CATEGORIA/vape6.png', 'Cigarros'),
(32, 'P031', 'Edición Limitada 750ml', 34.90, 46.90, 25, './img/PRODUCTOS-CATEGORIA/vape7.png', 'Cigarros'),
(33, 'P032', 'Porter Artesanal 500ml', 22.90, NULL, NULL, './img/PRODUCTOS-CATEGORIA/vape8.png', 'Cigarros');

CREATE TABLE form_comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    mensaje TEXT NOT NULL,
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE form_postulantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    dni VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    celular VARCHAR(20) NOT NULL,
    departamento VARCHAR(255) NOT NULL,
    provincia VARCHAR(255) NOT NULL,
    distrito VARCHAR(255) NOT NULL,
    direccion TEXT NOT NULL,
    distrito_trabajo VARCHAR(255),
    horario_trabajo VARCHAR(255),
    fecha_postulacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);