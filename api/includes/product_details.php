<?php
$id = $conn->real_escape_string($_GET['producto']);
$sql = "SELECT * FROM productos WHERE id = $id";
$resultado = $conn->query($sql);
$producto = $resultado->fetch_assoc();

if (!$producto) {
    header('Location: index.php');
}
?>

<div class="container mx-auto py-8">
    <div class="flex">
        <!-- Image to left -->
        <div class="w-1/2">
            <img style="view-transition-name: product-image-<?= $producto['id']; ?>" src="../img/default.png" alt="Producto" class="max-w-full h-auto mx-auto">
        </div>
        <!-- Details to right -->
        <div class="w-1/2 px-8">
            <h1 class="text-2xl font-semibold mb-4"><?php echo $producto['nombre']; ?></h1>
            <p class="text-gray-600 mb-4"><?php echo $producto['descripcion']; ?></p>
            <form method="POST" id="productForm" data-product='<?php echo json_encode($producto); ?>'>
                <label for="cantidad" class="font-semibold text-gray-600">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" value="1" min="1" max="<?php echo $producto['stock']; ?>" class="border border-gray-300 px-4 py-2 rounded-lg w-20 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                <button onclick="addToCart(event)" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 <?= ($producto['stock'] > 0) ? '' : 'cursor-not-allowed opacity-50 disabled'; ?>">
                    <i id="cart-icon-add" class="fa-solid fa-cart-arrow-down"></i>
                    <?= ADD_TO_CART; ?>
                </button>

                <?= ($producto['stock'] > 0) ? '<p class="text-green-500 font-semibold">En Stock</p>' : '<p class="text-red-500 font-semibold">Sin Stock</p>'; ?>
            </form>
            <p class="text-2xl font-bold mb-4" style="view-transition-name: product-price-<?= $producto['id']; ?>"><?php echo $producto['precio']; ?><?php echo MONEDA; ?></p>
            <div class="flex items-center mb-4" style="view-transition-name: product-rating-<?= $producto['id']; ?>">
                <i class="fas fa-star text-yellow-400"></i>
                <p class="text-gray-600 ml-1">4.5 (120 calificaciones)</p>
            </div>
            <p class="text-gray-600">Comentarios:</p>
            <div class="bg-white rounded-lg shadow p-4 mt-4">
                <div class="flex items-start space-x-2">
                    <div class="flex-shrink-0">
                        <i class="w-15 h-15 rounded-full fas fa-user-circle fa-2x"></i>
                        <!--<img src="avatar1.jpg" alt="Usuario" class="w-10 h-10 rounded-full">-->
                    </div>
                    <div>
                        <p class="font-semibold">Nombre de Usuario</p>
                        <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-2 mt-4">
                    <div class="flex-shrink-0">
                        <i class="w-15 h-15 rounded-full fas fa-user-circle fa-2x"></i>
                    </div>
                    <div>
                        <p class="font-semibold">Otro Usuario</p>
                        <p class="text-gray-600">Fusce facilisis nunc id sagittis.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>