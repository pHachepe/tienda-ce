INSERT INTO categorias (nombre) VALUES
    ('Electrónica', 'fa-tv'),
    ('Ropa', 'fa-tshirt'),
    ('Hogar', 'fa-couch'),
    ('Alimentos', 'fa-utensils'),
    ('Videojuegos', 'fa-gamepad'),
    ('Deportes', 'fa-futbol'),
    ('Libros', 'fa-book'),
    ('Música', 'fa-music'),
    ('Películas', 'fa-photo-film');

-- Productos en la categoría 'Electrónicos'
INSERT INTO productos (nombre, descripcion, precio) VALUES
    ('Teléfono inteligente', 'Teléfono avanzado con cámara de alta resolución.', 499.99),
    ('Televisor LED', 'Televisor de alta definición con tecnología LED.', 699.99),
    ('Computadora portátil', 'Computadora portátil potente y ligera para trabajo y entretenimiento.', 899.99),
    ('Auriculares inalámbricos', 'Auriculares Bluetooth con cancelación de ruido.', 149.99),
    ('Cámara DSLR', 'Cámara réflex digital con lentes intercambiables.', 799.99),
    ('Tablet', 'Tablet de última generación con pantalla táctil.', 349.99),
    ('Altavoz Bluetooth', 'Altavoz portátil con conectividad Bluetooth.', 79.99),
    ('Reloj inteligente', 'Reloj con seguimiento de actividad y notificaciones.', 199.99),
    ('Consola de videojuegos', 'Consola de juegos de alta gama para experiencias de juego inmersivas.', 499.99),
    ('Impresora 3D', 'Impresora 3D para crear objetos tridimensionales.', 299.99);
-- Insertar la unión en la tabla categorias_productos
INSERT INTO categorias_productos (id_producto, id_categoria) VALUES
    (1, 1), -- Teléfono inteligente (Electrónicos)
    (2, 1), -- Televisor LED (Electrónicos)
    (3, 1), -- Computadora portátil (Electrónicos)
    (4, 1), -- Auriculares inalámbricos (Electrónicos)
    (5, 1), -- Cámara DSLR (Electrónicos)
    (6, 1), -- Tablet (Electrónicos)
    (7, 1), -- Altavoz Bluetooth (Electrónicos)
    (8, 1), -- Reloj inteligente (Electrónicos)
    (9, 1), -- Consola de videojuegos (Electrónicos)
    (10, 1); -- Impresora 3D (Electrónicos)

-- Productos en la categoría 'Ropa'
INSERT INTO productos (nombre, descripcion, precio) VALUES
    ('Camiseta de algodón', 'Camiseta básica de algodón suave.', 19.99),
    ('Jeans ajustados', 'Pantalones vaqueros ajustados y modernos.', 39.99),
    ('Vestido elegante', 'Vestido de noche elegante y sofisticado.', 69.99),
    ('Chaqueta de cuero', 'Chaqueta de cuero genuino con diseño moderno.', 129.99),
    ('Zapatillas deportivas', 'Zapatillas cómodas para actividades deportivas.', 59.99),
    ('Traje formal', 'Traje completo para ocasiones formales.', 199.99),
    ('Sudadera con capucha', 'Sudadera cómoda con capucha y bolsillos.', 29.99),
    ('Blusa de seda', 'Blusa de seda suave y ligera.', 49.99),
    ('Calcetines a rayas', 'Calcetines divertidos con diseño a rayas.', 9.99),
    ('Abrigo de invierno', 'Abrigo abrigado y resistente al viento para el invierno.', 149.99);
-- Insertar la unión en la tabla categorias_productos
INSERT INTO categorias_productos (id_producto, id_categoria) VALUES
    (11, 2), -- Camiseta de algodón (Ropa)
    (12, 2), -- Jeans ajustados (Ropa)
    (13, 2), -- Vestido elegante (Ropa)
    (14, 2), -- Chaqueta de cuero (Ropa)
    (15, 2), -- Zapatillas deportivas (Ropa)
    (16, 2), -- Traje formal (Ropa)
    (17, 2), -- Sudadera con capucha (Ropa)
    (18, 2), -- Blusa de seda (Ropa)
    (19, 2), -- Calcetines a rayas (Ropa)
    (20, 2); -- Abrigo de invierno (Ropa)

-- Productos con dos categorías
-- (Categoría: Deportes, Ropa)
INSERT INTO productos (nombre, descripcion, precio) VALUES
    ('Conjunto deportivo', 'Conjunto de ropa deportiva para entrenamientos intensos.', 59.99);

-- Insertar la unión en la tabla categorias_productos
INSERT INTO categorias_productos (id_producto, id_categoria) VALUES
    (21, 1), -- Conjunto deportivo (Deportes)
    (21, 2); -- Conjunto deportivo (Ropa)

-- (Categoría: Electrónicos, Hogar)
INSERT INTO productos (nombre, descripcion, precio) VALUES
    ('Asistente de voz inteligente', 'Dispositivo que proporciona control por voz y funciones para el hogar.', 39.99);

-- Insertar la unión en la tabla categorias_productos
INSERT INTO categorias_productos (id_producto, id_categoria) VALUES
    (22, 1), -- Asistente de voz inteligente (Electrónicos)
    (22, 3); -- Asistente de voz inteligente (Hogar)

-- (Categoría: Alimentos, Hogar)
INSERT INTO productos (nombre, descripcion, precio) VALUES
    ('Set de especias gourmet', 'Set de especias de alta calidad para cocinar platos deliciosos.', 24.99);

-- Insertar la unión en la tabla categorias_productos
INSERT INTO categorias_productos (id_producto, id_categoria) VALUES
    (23, 4), -- Set de especias gourmet (Alimentos)
    (23, 3); -- Set de especias gourmet (Hogar)

-- (Categoría: Ropa, Hogar)
INSERT INTO productos (nombre, descripcion, precio) VALUES
    ('Manta suave y acogedora', 'Manta de tela suave perfecta para relajarse en casa.', 29.99);

-- Insertar la unión en la tabla categorias_productos
INSERT INTO categorias_productos (id_producto, id_categoria) VALUES
    (24, 2), -- Manta suave y acogedora (Ropa)
    (24, 3); -- Manta suave y acogedora (Hogar)

-- (Categoría: Electrónicos, Deportes)
INSERT INTO productos (nombre, descripcion, precio) VALUES
    ('Auriculares inalámbricos deportivos', 'Auriculares diseñados para deportes con conectividad Bluetooth.', 69.99);

-- Insertar la unión en la tabla categorias_productos
INSERT INTO categorias_productos (id_producto, id_categoria) VALUES
    (25, 1), -- Auriculares inalámbricos deportivos (Electrónicos)
    (25, 6); -- Auriculares inalámbricos deportivos (Deportes)

-- (Categoría: Hogar, Alimentos)
INSERT INTO productos (nombre, descripcion, precio) VALUES
    ('Cafetera de goteo programable', 'Cafetera que prepara café automáticamente con temporizador.', 49.99);

-- Insertar la unión en la tabla categorias_productos
INSERT INTO categorias_productos (id_producto, id_categoria) VALUES
    (26, 3), -- Cafetera de goteo programable (Hogar)
    (26, 4); -- Cafetera de goteo programable (Alimentos)

-- (Categoría: Deportes, Hogar)
INSERT INTO productos (nombre, descripcion, precio) VALUES
    ('Bicicleta estática plegable', 'Bicicleta de ejercicio plegable para entrenamientos en casa.', 199.99);

-- Insertar la unión en la tabla categorias_productos
INSERT INTO categorias_productos (id_producto, id_categoria) VALUES
    (27, 1), -- Bicicleta estática plegable (Deportes)
    (27, 3); -- Bicicleta estática plegable (Hogar)

-- (Categoría: Ropa, Deportes)
INSERT INTO productos (nombre, descripcion, precio) VALUES
    ('Chaqueta deportiva resistente al viento', 'Chaqueta ligera y cortavientos para actividades deportivas.', 89.99);

-- Insertar la unión en la tabla categorias_productos
INSERT INTO categorias_productos (id_producto, id_categoria) VALUES
    (28, 2), -- Chaqueta deportiva resistente al viento (Ropa)
    (28, 6); -- Chaqueta deportiva resistente al viento (Deportes)

-- (Categoría: Electrónicos, Alimentos)
INSERT INTO productos (nombre, descripcion, precio) VALUES
    ('Báscula de cocina digital', 'Báscula precisa para medir ingredientes al cocinar.', 19.99);

-- Insertar la unión en la tabla categorias_productos
INSERT INTO categorias_productos (id_producto, id_categoria) VALUES
    (29, 1), -- Báscula de cocina digital (Electrónicos)
    (29, 4); -- Báscula de cocina digital (Alimentos)

-- (Categoría: Deportes, Alimentos)
INSERT INTO productos (nombre, descripcion, precio) VALUES
    ('Botella de agua deportiva', 'Botella resistente y diseñada para llevar durante actividades físicas.', 12.99);

-- Insertar la unión en la tabla categorias_productos
INSERT INTO categorias_productos (id_producto, id_categoria) VALUES
    (30, 1), -- Botella de agua deportiva (Deportes)
    (30, 4); -- Botella de agua deportiva (Alimentos)
