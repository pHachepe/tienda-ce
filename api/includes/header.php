<?php
$sql = "SELECT * FROM categorias";
$resultado = $conn->query($sql);
$filas = $resultado->num_rows;
$categorias = array();
for ($i = 0; $i < $filas; $i++) {
    $resultado->data_seek($i);
    $fila = $resultado->fetch_array(MYSQLI_ASSOC);
    $categorias[$i] = $fila;
}
?>
<nav class="bg-blue-500 text-white">
    <div class="container mx-auto py-4 grid grid-cols-6 gap-4 items-center">
        <!-- titulo h1 con link a index.php -->
        <h1 class="col-span-1 text-2xl font-semibold">
            <a href="index.php"><?php echo TITLE; ?></a>
        </h1>

        <div class="relative col-span-4 flex">
            <input type="text" placeholder="<?php echo BUSCAR ?>" class="w-full px-4 py-2 bg-gray-100 text-gray-800 rounded focus:outline-none focus:ring focus:ring-blue-300">
            <i class="absolute top-1/2 right-3 transform -translate-y-1/2 fas fa-search text-gray-600"></i>
        </div>
        <div class="col-span-1 flex justify-end items-center space-x-4">
            <a href="#" class="hover:text-gray-300"><i class="fas fa-shopping-cart"></i> <?php echo CESTA; ?></a>
            <a href="#" class="hover:text-gray-300"><i class="fas fa-user"></i> <?php echo MI_CUENTA; ?></a>
        </div>
    </div>
    <div class="container mx-auto py-2">
        <ul class="flex space-x-4 justify-between">
            <?php foreach ($categorias as $categoria) { ?>
                <li><a href="?categoria=<?php echo $categoria['nombre']; ?>" class="hover:text-gray-300"><i class="fas <?php echo $categoria['icono']; ?>"></i> <?php echo $categoria['nombre']; ?></a></li>
            <?php } ?>
        </ul>
    </div>
</nav>