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
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `precio` decimal(10,2) DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `imagenes` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Teléfono inteligente','Teléfono avanzado con cámara de alta resolución.',499.99,5,'[\"telefono-inteligente.jpg\", \"telefono-inteligente-2.jpg\"]'),(2,'Televisor LED','Televisor de alta definición con tecnología LED.',699.99,5,'[\"television-led.jpg\",\"television-led-2.jpg\"]'),(3,'Portátil MSI','Portátil potente y ligero para trabajo y entretenimiento.',899.99,5,NULL),(4,'Auriculares inalámbricos','Auriculares Bluetooth con cancelación de ruido.',149.99,5,NULL),(5,'Cámara DSLR','Cámara réflex digital con lentes intercambiables.',799.99,5,NULL),(6,'Tablet','Tablet de última generación con pantalla táctil.',349.99,5,NULL),(7,'Altavoz Bluetooth','Altavoz portátil con conectividad Bluetooth.',79.99,5,NULL),(8,'Reloj inteligente','Reloj con seguimiento de actividad y notificaciones.',199.99,5,NULL),(9,'Consola de videojuegos','Consola de juegos de alta gama para experiencias de juego inmersivas.',499.99,5,NULL),(10,'Impresora 3D','Impresora 3D para crear objetos tridimensionales.',299.99,5,NULL),(11,'Camiseta de algodón','Camiseta básica de algodón suave.',19.99,5,NULL),(12,'Jeans ajustados','Pantalones vaqueros ajustados y modernos.',39.99,5,NULL),(13,'Vestido elegante','Vestido de noche elegante y sofisticado.',69.99,5,NULL),(14,'Chaqueta de cuero','Chaqueta de cuero genuino con diseño moderno.',129.99,5,NULL),(15,'Zapatillas deportivas','Zapatillas cómodas para actividades deportivas.',59.99,5,NULL),(16,'Traje formal','Traje completo para ocasiones formales.',199.99,5,NULL),(17,'Sudadera con capucha','Sudadera cómoda con capucha y bolsillos.',29.99,5,NULL),(18,'Blusa de seda','Blusa de seda suave y ligera.',49.99,5,NULL),(19,'Calcetines a rayas','Calcetines divertidos con diseño a rayas.',9.99,5,NULL),(20,'Abrigo de invierno','Abrigo abrigado y resistente al viento para el invierno.',149.99,5,NULL),(21,'Conjunto deportivo','Conjunto de ropa deportiva para entrenamientos intensos.',59.99,5,NULL),(22,'Asistente de voz inteligente','Dispositivo que proporciona control por voz y funciones para el hogar.',39.99,5,NULL),(23,'Set de especias gourmet','Set de especias de alta calidad para cocinar platos deliciosos.',24.99,5,NULL),(24,'Manta suave y acogedora','Manta de tela suave perfecta para relajarse en casa.',29.99,5,NULL),(25,'Auriculares inalámbricos deportivos','Auriculares diseñados para deportes con conectividad Bluetooth.',69.99,5,NULL),(26,'Cafetera de goteo programable','Cafetera que prepara café automáticamente con temporizador.',49.99,5,NULL),(27,'Bicicleta estática plegable','Bicicleta de ejercicio plegable para entrenamientos en casa.',199.99,5,NULL),(28,'Chaqueta deportiva resistente al viento','Chaqueta ligera y cortavientos para actividades deportivas.',89.99,5,NULL),(29,'Báscula de cocina digital','Báscula precisa para medir ingredientes al cocinar.',19.99,5,NULL),(30,'Botella de agua deportiva','Botella resistente y diseñada para llevar durante actividades físicas.',12.99,5,NULL);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `icono` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Electrónica','fa-tv'),(2,'Ropa','fa-tshirt'),(3,'Hogar','fa-couch'),(4,'Alimentos','fa-utensils'),(5,'Videojuegos','fa-gamepad'),(6,'Deportes','fa-futbol'),(7,'Libros','fa-book'),(8,'Música','fa-music'),(9,'Películas','fa-photo-film');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias_productos`
--

DROP TABLE IF EXISTS `categorias_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias_productos`
--

LOCK TABLES `categorias_productos` WRITE;
/*!40000 ALTER TABLE `categorias_productos` DISABLE KEYS */;
INSERT INTO `categorias_productos` VALUES (1,1,1),(2,2,1),(3,3,1),(4,4,1),(5,5,1),(6,6,1),(7,7,1),(8,8,1),(9,9,1),(10,10,1),(11,11,2),(12,12,2),(13,13,2),(14,14,2),(15,15,2),(16,16,2),(17,17,2),(18,18,2),(19,19,2),(20,20,2),(21,21,2),(22,21,6),(23,22,1),(24,22,3),(26,23,3),(27,24,2),(28,24,3),(29,25,1),(30,25,6),(31,26,3),(33,27,1),(34,27,3),(35,28,2),(36,28,6),(37,29,1),(38,29,3),(39,30,3),(40,30,6),(41,15,6),(42,2,3),(43,4,5),(44,3,5),(45,8,6),(46,9,5),(47,27,6);
/*!40000 ALTER TABLE `categorias_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagenes_productos`
--

DROP TABLE IF EXISTS `imagenes_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `imagenes_productos` (
  `id_imagen` int NOT NULL AUTO_INCREMENT,
  `id_producto` int DEFAULT NULL,
  `direccion_imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_imagen`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `imagenes_productos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagenes_productos`
--

LOCK TABLES `imagenes_productos` WRITE;
/*!40000 ALTER TABLE `imagenes_productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `imagenes_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `fecha_pedido` date DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos_productos`
--

DROP TABLE IF EXISTS `pedidos_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos_productos`
--

LOCK TABLES `pedidos_productos` WRITE;
/*!40000 ALTER TABLE `pedidos_productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `data` mediumtext NOT NULL,
  `last_accessed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('dkqpvlfejnsvacpv8rtm22r60j','','2023-10-30 16:07:52'),('n92qm355o9vsau3hk3pb6ohtdm','','2023-11-14 05:35:31');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `tarjeta` varchar(255) DEFAULT NULL,
  `es_admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Abraham','Fontana','admin','$2y$10$e7B/evoXxX.vUKUHyP6DpeXGBmtmwXzOvErwMfY9BWD9LChnIBdLq','987654321','Calle Falsa, 123','1234567890AFR',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;


-- Dump completed on 2023-11-19  9:32:47
