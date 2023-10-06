<?php
$sql = "SELECT * FROM productos ORDER BY RAND() LIMIT 8";
$resultado = $conn->query($sql);
$filas = $resultado->num_rows;
$columnas = $resultado->field_count;
$productos = array();
for ($i = 0; $i < $filas; $i++) {
    $resultado->data_seek($i);
    $fila = $resultado->fetch_array(MYSQLI_ASSOC);
    $productos[$i] = $fila;
}
?>
<!-- Breadcrumb -->
<nav class="bg-gray-100 p-4" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex">
        <li class="flex items-center">
            <a href="index.php" class="text-blue-500"><?= HOME; ?></a>
            <span class="mx-2 text-gray-500"><?= SEPARATOR; ?></span>
        </li>
        <li class="flex items-center">
            <span class="text-gray-600"><?= RECOMMENDED; ?></span>
        </li>
    </ol>
</nav>

<!-- Productos -->
<div class="content m-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
    <?php foreach ($productos as $producto) {
        include 'product_box.php';
    }
    ?>
</div>