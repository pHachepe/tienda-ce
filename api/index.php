<?php
require_once 'includes/constants.php';
require_once 'config/db.php';

$cache_file = 'cache/' . md5($_SERVER['REQUEST_URI']) . '.html';
$cache_time = 3600; // Definir el tiempo de caché, en segundos.

if (file_exists($cache_file) && (time() - filemtime($cache_file) < $cache_time)) {
    // Si el archivo de caché existe y es reciente, muestralo en lugar de crear uno nuevo.
    echo file_get_contents($cache_file);
    exit;
}
ob_start(); // Iniciar la captura de la salida.
?>

<html>

<head>
    <meta name="view-transition" content="same-origin" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="public/js/script.js"></script>
</head>

<body>
    <div class="wrapper min-h-screen ">
        <?php include 'includes/header.php'; ?>

        <main class="min-h-screen flex flex-col">
            <?php
            if (isset($_GET['producto'])) {
                include 'includes/product_details.php';
            } else if (isset($_GET['categoria'])) {
                include 'includes/category.php';
            } else if (isset($_GET['search'])) {
                include 'includes/search.php';
            } else {
                include 'includes/random_products.php';
            }
            ?>
        </main>

        <?php include 'includes/footer.php'; ?>
    </div>
</body>

</html>

<?php
$resultado->close();
$conn->close();

$page_content = ob_get_contents(); // Guardar la salida en una variable.
ob_end_flush(); // Mandar la salida al navegador.
file_put_contents($cache_file, $page_content); // Guardar la salida en el archivo de caché.
?>