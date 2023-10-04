<?php
require_once 'includes/constants.php';
require_once 'config/db.php';
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
?>