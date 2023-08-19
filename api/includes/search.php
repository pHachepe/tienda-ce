<?php
$productos = array();
$min_length = 3;
if (!isset($_GET['search']) || empty($_GET['search'])) {
    header('Location: index.php');
}

$search = $conn->real_escape_string($_GET['search']);

if (strlen($search) >= $min_length) {
    $sql = "SELECT * FROM productos WHERE nombre LIKE '%$search%' OR descripcion LIKE '%$search%'";
    $resultado = $conn->query($sql);
    for ($i = 0; $i < $resultado->num_rows; $i++) {
        $resultado->data_seek($i);
        $fila = $resultado->fetch_array(MYSQLI_ASSOC);
        $productos[$i] = $fila;

        $productos[$i]['nombre'] = preg_replace('/' . $search . '/i', '<span class="bg-yellow-200">' . strtolower($search) . '</span>', $productos[$i]['nombre']);
        $productos[$i]['descripcion'] = preg_replace('/' . $search . '/i', '<span class="bg-yellow-200">' . strtolower($search) . '</span>', $productos[$i]['descripcion']);
    }
}
?>

<!-- Breadcrumb -->
<nav class="bg-gray-100 p-4" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex">
        <li class="flex items-center">
            <span class="text-gray-600"><?php echo $resultado->num_rows . PRODUCTOS_ENCONTRADOS; ?> para <span class="bg-yellow-200">"<?php echo $search; ?>"</span></span>
        </li>
    </ol>
</nav>

<!-- No Products -->
<?php if (count($productos) == 0) { ?>
    <div class="flex justify-center items-center h-screen">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">
                <?php echo (strlen($search) <= $min_length) ? sprintf(MINIMO_CARACTERES, $min_length) : PRODUCTOS_NO_ENCONTRADOS . '"' . $search . '"'; ?>
            </h2>
        </div>
    </div>
<?php } else { ?>

    <!-- Products -->
    <div class="content m-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <?php foreach ($productos as $producto) {
            include 'product_box.php';
        } ?>
    </div>
<?php } ?>