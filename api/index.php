<?php
require_once 'includes/constants.php';
require_once 'config/db.php';
?>

<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="wrapper min-h-screen ">
        <?php include 'includes/header.php'; ?>

        <main class="min-h-screen flex flex-col justify-between">
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
            <?php include 'includes/footer.php'; ?>
        </main>

    </div>
</body>

</html>

<?php
$resultado->close();
$conn->close();
?>