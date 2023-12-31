-- MySQL dump 10.13  Distrib 8.1.0, for macos13.3 (arm64)
--
-- Host: localhost    Database: tienda_abraham
-- ------------------------------------------------------
-- Server version	8.1.0

-- Create Database
DROP DATABASE IF EXISTS tienda_abraham;
CREATE DATABASE tienda_abraham DEFAULT CHARACTER SET utf8mb4;

-- Create User
DROP USER IF EXISTS 'abraham'@'localhost';
CREATE USER 'abraham'@'localhost' IDENTIFIED BY 'Abrah@M917';

-- Grant privileges to abraham user on tienda_abraham database
GRANT ALL PRIVILEGES ON tienda_abraham.* TO 'abraham'@'localhost';
FLUSH PRIVILEGES;

-- Use tienda_abraham database
USE tienda_abraham;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `tarjeta` varchar(255) DEFAULT NULL,
  `es_admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
INSERT INTO `usuarios` VALUES
(1,'Admin','-','admin','$2y$10$e7B/evoXxX.vUKUHyP6DpeXGBmtmwXzOvErwMfY9BWD9LChnIBdLq','123456789','Calle Falsa, 321','1234567890ADM',1),
(2,'Abraham','Fontana','abrahamfontana@gmail.com','$2y$10$5X2WFsrFEtLrBu5u4PoxfOF8zewM3Bm4oD6afs.ZE1WKCSdTtcX0u','987654321','Calle Falsa, 123','1234567890AFR',0);
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `precio` decimal(10,2) DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `imagenes` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
INSERT INTO `productos` VALUES 
(1,'Teléfono inteligente','Teléfono avanzado con cámara de alta resolución.',499.99,5,'[\"telefono-inteligente.jpg\", \"telefono-inteligente-2.jpg\"]'),
(2,'Televisor LED','Televisor de alta definición con tecnología LED.',699.99,5,'[\"television-led.jpg\",\"television-led-2.jpg\"]'),
(3,'Portátil MSI','Portátil potente y ligero para trabajo y entretenimiento.',899.99,5,'[\"portatil-msi.jpg\"]'),
(4,'Auriculares inalámbricos','Auriculares Bluetooth con cancelación de ruido.',149.99,5,'[\"auriculares-inalambricos.jpg\"]'),
(5,'Cámara DSLR','Cámara réflex digital con lentes intercambiables.',799.99,5,'[\"camara-dslr.jpg\"]'),
(6,'Tablet','Tablet de última generación con pantalla táctil.',349.99,5,'[\"tablet.jpg\"]'),
(7,'Altavoz Bluetooth','Altavoz portátil con conectividad Bluetooth.',79.99,5,'[\"altavoz-bluetooth.jpg\",\"altavoz-bluetooth-2.jpg\"]'),
(8,'Reloj inteligente','Reloj con seguimiento de actividad y notificaciones.',199.99,5,'[\"reloj-inteligente.jpg\"]'),
(9,'Consola de videojuegos','Consola de juegos de alta gama para experiencias de juego inmersivas.',499.99,5,'[\"ps5.jpg\"]'),
(10,'Impresora 3D','Impresora 3D para crear objetos tridimensionales.',299.99,5,NULL),
(11,'Camiseta de algodón','Camiseta básica de algodón suave.',19.99,5,NULL),
(12,'Jeans ajustados','Pantalones vaqueros ajustados y modernos.',39.99,5,NULL),
(13,'Vestido elegante','Vestido de noche elegante y sofisticado.',69.99,5,NULL),
(14,'Chaqueta de cuero','Chaqueta de cuero genuino con diseño moderno.',129.99,5,NULL),
(15,'Zapatillas deportivas','Zapatillas cómodas para actividades deportivas.',59.99,5,NULL),
(16,'Traje formal','Traje completo para ocasiones formales.',199.99,5,NULL),
(17,'Sudadera con capucha','Sudadera cómoda con capucha y bolsillos.',29.99,5,NULL),
(18,'Blusa de seda','Blusa de seda suave y ligera.',49.99,5,NULL),
(19,'Calcetines a rayas','Calcetines divertidos con diseño a rayas.',9.99,5,NULL),
(20,'Abrigo de invierno','Abrigo abrigado y resistente al viento para el invierno.',149.99,5,NULL),
(21,'Conjunto deportivo','Conjunto de ropa deportiva para entrenamientos intensos.',59.99,5,NULL),
(22,'Asistente de voz inteligente','Dispositivo que proporciona control por voz y funciones para el hogar.',39.99,5,NULL),
(23,'Set de especias gourmet','Set de especias de alta calidad para cocinar platos deliciosos.',24.99,5,NULL),
(24,'Manta suave y acogedora','Manta de tela suave perfecta para relajarse en casa.',29.99,5,NULL),
(25,'Auriculares inalámbricos deportivos','Auriculares diseñados para deportes con conectividad Bluetooth.',69.99,5,NULL),
(26,'Cafetera de goteo programable','Cafetera que prepara café automáticamente con temporizador.',49.99,5,NULL),
(27,'Bicicleta estática plegable','Bicicleta de ejercicio plegable para entrenamientos en casa.',199.99,5,NULL),
(28,'Chaqueta deportiva resistente al viento','Chaqueta ligera y cortavientos para actividades deportivas.',89.99,5,NULL),
(29,'Báscula de cocina digital','Báscula precisa para medir ingredientes al cocinar.',19.99,5,NULL),
(30,'Botella de agua deportiva','Botella resistente y diseñada para llevar durante actividades físicas.',12.99,5,NULL);
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `icono` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
INSERT INTO `categorias` VALUES (1,'Electrónica','fa-tv'),(2,'Ropa','fa-tshirt'),(3,'Hogar','fa-couch'),(4,'Alimentos','fa-utensils'),(5,'Videojuegos','fa-gamepad'),(6,'Deportes','fa-futbol'),(7,'Libros','fa-book'),(8,'Música','fa-music'),(9,'Películas','fa-photo-film');
UNLOCK TABLES;

--
-- Table structure for table `categorias_productos`
--

DROP TABLE IF EXISTS `categorias_productos`;
CREATE TABLE `categorias_productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_producto` int DEFAULT NULL,
  `id_categoria` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_producto` (`id_producto`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `categorias_productos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`),
  CONSTRAINT `categorias_productos_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorias_productos`
--

LOCK TABLES `categorias_productos` WRITE;
INSERT INTO `categorias_productos` VALUES (1,1,1),(2,2,1),(3,3,1),(4,4,1),(5,5,1),(6,6,1),(7,7,1),(8,8,1),(9,9,1),(10,10,1),(11,11,2),(12,12,2),(13,13,2),(14,14,2),(15,15,2),(16,16,2),(17,17,2),(18,18,2),(19,19,2),(20,20,2),(21,21,2),(22,21,6),(23,22,1),(24,22,3),(26,23,3),(27,24,2),(28,24,3),(29,25,1),(30,25,6),(31,26,3),(33,27,1),(34,27,3),(35,28,2),(36,28,6),(37,29,1),(38,29,3),(39,30,3),(40,30,6),(41,15,6),(42,2,3),(43,4,5),(44,3,5),(45,8,6),(46,9,5),(47,27,6);
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `fecha` datetime DEFAULT NOW(),
  `direccion` varchar(255) NOT NULL,
  `tarjeta` varchar(255) NOT NULL,
  `total` decimal(10,2) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `pedidos_productos`
--

DROP TABLE IF EXISTS `pedidos_productos`;
CREATE TABLE `pedidos_productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pedido` int DEFAULT NULL,
  `id_producto` int DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pedido` (`id_pedido`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `pedidos_productos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`),
  CONSTRAINT `pedidos_productos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `data` mediumtext NOT NULL,
  `last_accessed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
