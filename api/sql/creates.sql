-- Tabla de Categorías
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    icono VARCHAR(255)
);

-- Tabla de Productos
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    descripcion TEXT,
    precio DECIMAL(10, 2)
);

-- Tabla de Categorías_Productos
CREATE TABLE categorias_productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT,
    id_categoria INT,
    FOREIGN KEY (id_producto) REFERENCES productos(id),
    FOREIGN KEY (id_categoria) REFERENCES categorias(id)
);

-- Tabla de Usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    correo VARCHAR(255),
    contraseña VARCHAR(255),
    telefono VARCHAR(255),
    direccion VARCHAR(255),
    tarjeta VARCHAR(255),
    es_admin BOOLEAN
);

-- Tabla de Imágenes_Productos
CREATE TABLE imagenes_productos (
    id_imagen INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT,
    direccion_imagen VARCHAR(255),
    FOREIGN KEY (id_producto) REFERENCES productos(id)
);

-- Tabla de Pedidos
CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    fecha_pedido DATE,
    fecha_entrega DATE,
    total DECIMAL(10, 2),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

-- Tabla de Pedidos_Productos
CREATE TABLE pedidos_productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT,
    id_producto INT,
    precio DECIMAL(10, 2),
    cantidad INT,
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id),
    FOREIGN KEY (id_producto) REFERENCES productos(id)
);

-- Tabla de Comentarios
CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT,
    id_usuario INT,
    comentario TEXT,
    calificacion INT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_producto) REFERENCES productos(id),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

-- Tabla de Direcciones
CREATE TABLE direcciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    direccion VARCHAR(255),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

-- Tabla de Tarjetas
CREATE TABLE tarjetas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    tarjeta VARCHAR(255),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);
