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
            <a href="index.php"><?= TITLE; ?></a>
        </h1>

        <form method="GET" class="relative col-span-4 flex pt-2 mt-1">
            <input type="text" name="search" placeholder="<?= SEARCH ?>" class="w-full px-4 py-2 bg-gray-100 text-gray-800 rounded focus:outline-none focus:ring focus:ring-blue-300">
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
                    <span class="ml-2"><?= BASKET; ?></span>
                </button>
                <div id="cart-dropdown" class="bg-white absolute z-10 top-full w-96 -left-40 group-hover:block hidden rounded-t-lg">
                    <div id="cart-body" class="p-4 text-black shadow-md rounded-md">
                        <?php include_once 'cart.php'; ?>
                    </div>
                </div>
            </div>
            <!-- End Dropdown Cart -->
            <!-- Dropdown My Account -->
            <div class="relative group hover:bg-white hover:text-blue-500 rounded-t-lg px-2 py-3">
                <button>
                    <i class="fas fa-user"></i> <?= isset($_SESSION['loggedin']) ? $_SESSION['user']['nombre'] : MY_ACCOUNT; ?>
                </button>

                <?php
                if (isset($_SESSION['loggedin'])) {
                ?>
                    <div id="user-dropdown" class="bg-white absolute z-10 top-full -left-8 w-40 group-hover:block hidden rounded-t-lg">
                        <div class="h-52 text-gray-700 shadow-md rounded-md flex flex-col p-5 space-y-3">
                            <a href="profile.php" class="hover:text-blue-500"><i class="fas fa-gear"></i> <?= PROFILE; ?></a>
                            <a href="orders.php" class="hover:text-blue-500"><i class="fas fa-box-archive"></i> <?= ORDERS; ?></a>
                            <a href="payments.php" class="hover:text-blue-500"><i class="fas fa-credit-card"></i> <?= PAYMENTS; ?></a>
                            <a href="addresses.php" class="hover:text-blue-500"><i class="fas fa-map-marker-alt"></i> <?= ADDRESSES; ?></a>
                            <a href="?logout" class="hover:text-blue-500"><i class="fas fa-sign-out-alt"></i> <?= LOGOUT; ?></a>
                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <div id="user-dropdown" class="bg-white absolute z-10 top-full left-20 transform -translate-x-48 w-64 group-hover:block hidden rounded-t-lg">
                        <div class="h-52 text-gray-700 shadow-md rounded-md flex flex-col items-center justify-center">
                            <?php include_once 'form-login.php'; ?>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <!-- End Dropdown My Account -->
        </div>
    </div>
    <div class="container mx-auto py-2">
        <ul class="flex space-x-4 justify-between">
            <?php foreach ($categories as $category) { ?>
                <li><a href="?categoria=<?= $category['nombre']; ?>" class="hover:text-gray-300"><i class="fas <?= $category['icono']; ?>"></i> <?= $category['nombre']; ?></a></li>
            <?php } ?>
        </ul>
    </div>
</nav>
