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
<div class="content m-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
    <?php foreach ($productos as $producto) {
        include 'product_box.php';
    }
    ?>
</div>