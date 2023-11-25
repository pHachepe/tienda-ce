<?php
// ToDo: Remove this and use the real product data
$producto["calificacion"] = rand(10, 50) / 10; ?>
<div class="bg-white shadow-md p-4 flex flex-col justify-between h-full">
    <a href="index.php?producto=<?= $producto["id"] ?>">
        <div>
            <img style="view-transition-name: product-image-<?= $producto["id"] ?>" src="public/img/<?= "default.png" ?>" alt="Producto" class="w-full h-auto rounded-md mb-2">
            <h2 class="text-lg font-semibold text-gray-800"><?= $producto["nombre"] ?></h2>
            <p class="text-sm text-gray-600 mb-2"><?= $producto["descripcion"] ?></p>
        </div>
        <!-- calificacion -->
        <div class="flex justify-center items-center mb-2" style="view-transition-name: product-rating-<?= $producto["id"] ?>">
            <div class="flex space-x-1">
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <?php if ($producto["calificacion"] - $i >= 1): ?>
                        <i class="fas fa-star text-yellow-400"></i>
                    <?php elseif ($producto["calificacion"] - $i > 0): ?>
                        <i class="fas fa-star-half-alt text-yellow-400"></i>
                    <?php else: ?>
                        <i class="far fa-star text-yellow-400"></i>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
        <div class="flex justify-center items-center">
            <p class="text-lg font-semibold text-blue-500" style="view-transition-name: product-price-<?= $producto["id"] ?>"><?= $producto["precio"] . CURRENCY ?></p>
        </div>
    </a>
</div>