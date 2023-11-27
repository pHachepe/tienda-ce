<?php
if (isset($_GET["categoria"])) {
    $category = $conn->real_escape_string($_GET["categoria"]);
    $limit = 8;
    $page = 1;

    // get the total number of products in this category
    $sql = "SELECT COUNT(*) FROM productos WHERE id IN (
                SELECT id_producto
                    FROM categorias_productos
                    INNER JOIN categorias ON categorias_productos.id_categoria = categorias.id
                    WHERE nombre = '$category'
            )";
    $resultado = $conn->query($sql);
    $totalRows = $resultado->fetch_row()[0];
    $totalPages = ceil($totalRows / $limit);

    // get the products for this page
    $sql = "SELECT * FROM productos WHERE id IN (
                SELECT id_producto
                    FROM categorias_productos
                    INNER JOIN categorias ON categorias_productos.id_categoria = categorias.id
                    WHERE nombre = '$category'
            ) LIMIT $limit";

    if (isset($_GET["page"])) {
        $page = $conn->real_escape_string($_GET["page"]);
        $offset = ($page - 1) * $limit;
        $sql .= " OFFSET $offset";
    }
    $resultado = $conn->query($sql);
    $filas = $resultado->num_rows;
    $columnas = $resultado->field_count;

    $productos = [];
    for ($i = 0; $i < $filas; $i++) {
        $resultado->data_seek($i);
        $fila = $resultado->fetch_array(MYSQLI_ASSOC);
        $productos[$i] = $fila;
    }
} ?>

<!-- Breadcrumb -->
<nav class="bg-gray-100 p-4" aria-label="Breadcrumb">
    <ol class="list-none p-0 inline-flex">
        <li class="flex items-center">
            <a href="?" class="text-blue-500"><?= HOME ?></a>
            <span class="mx-2 text-gray-500"><?= SEPARATOR ?></span>
        </li>
        <li class="flex items-center">
            <span class="text-gray-600"><?= $category ?></span>
        </li>
    </ol>
</nav>

<!-- No Products -->
<?php if ($filas == 0) { ?>
    <div class="flex justify-center items-center min-h-full">
        <div>
            <h2 class="text-lg font-semibold text-gray-800"><?= NO_PRODUCTS ?></h2>
        </div>
    </div>
    <!-- Products -->
<?php } else { ?>
    <div class="content m-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <?php foreach ($productos as $producto) {
            include "product_box.php";
        } ?>
    </div>
<?php } ?>

<!-- Pagination -->
<div class="flex justify-center items-center mb-6">
    <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
        <a href="?categoria=<?= $category ?>&page=<?= $i ?>" class="mx-1 px-3 py-2 rounded-md <?= $page == $i ? "bg-blue-500 text-white" : "bg-gray-300 text-gray-700 hover:bg-gray-400" ?>">
            <?= $i ?>
        </a>
    <?php } ?>
</div>