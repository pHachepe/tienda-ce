<?php
$sql = "SELECT * FROM categorias";
$resultado = $conn->query($sql);
$filas = $resultado->num_rows;
$categories = array();
for ($i = 0; $i < $filas; $i++) {
    $resultado->data_seek($i);
    $fila = $resultado->fetch_array(MYSQLI_ASSOC);
    $categories[$i] = $fila;
}
?>
<nav class="bg-blue-500 text-white">
    <div class="container mx-auto py-4 grid grid-cols-6 items-center">
        <h1 class="col-span-1 text-2xl font-semibold">
            <a href="index.php"><?php echo TITLE; ?></a>
        </h1>

        <form method="GET" class="relative col-span-4 flex pt-2 mt-1">
            <input type="text" name="search" placeholder="<?php echo SEARCH ?>" class="w-full px-4 py-2 bg-gray-100 text-gray-800 rounded focus:outline-none focus:ring focus:ring-blue-300">
            <button type="submit" class="absolute top-1/2 right-3 transform -translate-y-1/2">
                <i class="fas fa-search text-gray-600 pt-2"></i>
            </button>
        </form>

        <div class="col-span-1 flex ml-2">
            <!-- Dropdown Cart -->
            <div class="relative group hover:bg-white hover:text-blue-500 rounded-t-lg px-2 py-3">
                <button class="flex items-center">
                    <i id="cart-icon" class="fas fa-shopping-cart relative z-10"></i>
                    <span id="cart-count" class="absolute top-0 left-4 bg-red-500 text-white rounded-full px-1 text-xs z-20">0</span>
                    <span class="ml-2"><?php echo BASKET; ?></span>
                </button>
                <div id="cart-dropdown" class="bg-white absolute top-full w-96 -left-40 group-hover:block z-10 hidden rounded-t-lg">
                    <div id="cart-body" class="p-4 bg-white text-black shadow-md rounded-md">
                        <?php include 'cart.php'; ?>
                    </div>
                </div>
            </div>
            <!-- End Dropdown Cart -->
            <!-- Dropdown My Account -->
            <div class="relative group hover:bg-white  hover:text-blue-500 rounded-t-lg px-2 py-3">
                <button>
                    <i class="fas fa-user"></i> <?php echo MY_ACCOUNT; ?>
                </button>
                <div class="bg-white absolute top-full w-60 -left-24 group-hover:block hidden rounded-t-lg">
                    <?php include 'form_login.php'; ?>
                </div>
            </div>
            <!-- End Dropdown My Account -->
        </div>
    </div>
    <div class="container mx-auto py-2">
        <ul class="flex space-x-4 justify-between">
            <?php foreach ($categories as $category) { ?>
                <li><a href="?categoria=<?php echo $category['nombre']; ?>" class="hover:text-gray-300"><i class="fas <?php echo $category['icono']; ?>"></i> <?php echo $category['nombre']; ?></a></li>
            <?php } ?>
        </ul>
    </div>
</nav>