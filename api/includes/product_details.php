<?php
$id = $conn->real_escape_string($_GET["producto"]);
$sql = "SELECT * FROM productos WHERE id = $id";
$resultado = $conn->query($sql);
$producto = $resultado->fetch_assoc();
$producto["imagenes"] = !empty($producto["imagenes"]) ? json_decode($producto["imagenes"], true) : ["default.png"];

$sql = "SELECT c.nombre FROM categorias c INNER JOIN categorias_productos cp ON c.id = cp.id_categoria WHERE cp.id_producto = $id";
$resultado = $conn->query($sql);
$categorias = [];
while ($categoria = $resultado->fetch_assoc()) {
    $categorias[] = $categoria["nombre"];
}
?>

<!-- Breadcrumb -->
<nav class="bg-gray-100 p-4" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex">
        <li class="flex items-center">
            <a href="?" class="text-blue-500"><?= HOME ?></a>
            <span class="mx-2 text-gray-500"><?= SEPARATOR ?></span>
        </li>
        <?php foreach ($categorias as $categoria): ?>
            <li class="flex items-center">
                <a href="?categoria=<?= $categoria ?>" class="text-blue-500"><?= $categoria ?></a>
                <?php if ($categoria != end($categorias)): ?>
                    <span class="mx-2 text-gray-500">|</span>
                <?php else: ?>
                    <span class="mx-2 text-gray-500"><?= SEPARATOR ?></span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
        <li class="flex items-center">
            <span class="text-gray-600"><?= $producto["nombre"] ?></span>
        </li>
    </ol>
</nav>

<div class="container flex items-center justify-center m-8 mx-auto">
    <!-- Image to left -->
    <div class="w-1/2 flex flex-col items-center">
        <!-- Contenedor del visor de imágenes con tamaño fijo -->
        <div style="width: 100%; height: 400px; overflow: hidden;">
            <img id="mainImage" src="../public/img/<?= $producto["imagenes"][0] ?>" alt="Producto" class="max-w-full h-full object-contain mx-auto">
        </div>

        <!-- Thumbnails -->
        <div class="flex mt-4">
            <?php foreach ($producto["imagenes"] as $imagen): ?>
                <img src="../public/img/<?= $imagen ?>" alt="Thumbnail" class="w-14 h-14 object-contain cursor-pointer p-1" onclick="changeImage('<?= $imagen ?>')" style="border: 2px solid #ddd; margin-right: 5px;">
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Details to right -->
    <div class="w-1/2 px-8">
        <h1 class="text-2xl font-semibold mb-4"><?= $producto["nombre"] ?></h1>
        <p class="text-gray-600 mb-4"><?= $producto["descripcion"] ?></p>
        <form method="POST" id="productForm" data-product='<?= json_encode($producto) ?>'>
            <label for="cantidad" class="font-semibold text-gray-600">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" value="1" min="1" max="<?= $producto[
                "stock"
            ] ?>" class="border border-gray-300 px-4 py-2 rounded w-20 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
            <button onclick="addToCart()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 <?= $producto["stock"] > 0 ? "" : "cursor-not-allowed opacity-50 disabled" ?>">
                <i id="cart-icon-add" class="fa-solid fa-cart-arrow-down"></i>
                <?= ADD_TO_CART ?>
            </button>

            <?= $producto["stock"] > 0 ? '<p class="text-green-500 font-semibold">En Stock</p>' : '<p class="text-red-500 font-semibold">Sin Stock</p>' ?>
        </form>
        <p class="text-2xl font-bold mb-4" style="view-transition-name: product-price-<?= $producto["id"] ?>"><?= $producto["precio"] . CURRENCY ?></p>
        <div class="flex items-center mb-4" style="view-transition-name: product-rating-<?= $producto["id"] ?>">
            <i class="fas fa-star text-yellow-400"></i>
            <p class="text-gray-600 ml-1">4.5 (120 calificaciones)</p>
        </div>
        <p class="text-gray-600">Comentarios:</p>
        <div class="bg-white shadow p-4 mt-4">
            <div class="flex items-start space-x-2">
                <div class="flex-shrink-0">
                    <i class="w-15 h-15 fas fa-user-circle fa-2x"></i>
                </div>
                <div>
                    <p class="font-semibold">Nombre de Usuario</p>
                    <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <div class="flex items-start space-x-2 mt-4">
                <div class="flex-shrink-0">
                    <i class="w-15 h-15 fas fa-user-circle fa-2x"></i>
                </div>
                <div>
                    <p class="font-semibold">Otro Usuario</p>
                    <p class="text-gray-600">Fusce facilisis nunc id sagittis.</p>
                </div>
            </div>
        </div>
    </div>
</div>