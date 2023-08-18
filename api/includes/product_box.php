<div class="bg-white shadow-md p-4 flex flex-col justify-between h-full">
    <div>
        <img src="img/<?php echo "../img/default.png"; ?>" alt="Producto" class="w-full h-auto rounded-md mb-2">
        <h2 class="text-lg font-semibold text-gray-800"><?php echo $producto['nombre']; ?></h2>
        <p class="text-sm text-gray-600 mb-2"><?php echo $producto['descripcion']; ?></p>
    </div>
    <div class="flex justify-center items-center">
        <p class="text-lg font-semibold text-blue-500"><?php echo $producto['precio']; ?><?php echo MONEDA; ?></p>
    </div>
</div>