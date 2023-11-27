<?php
require_once "api/includes/constants.php";
require_once "api/config/db.php";
require_once "api/includes/session_db_handler.php";

$params = $_GET;
if (isset($_GET["logout"])) {
    session_destroy();
    unset($params["logout"]);
    header("Location: ?" . http_build_query($params));
} elseif (isset($_GET["login"])) {
    unset($params["login"]);
    header("Location: ?" . http_build_query($params));
}
?>

<html>

<head>
    <meta name="view-transition" content="same-origin" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tienda C.E.</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <!--<link rel="stylesheet" href="public/css/styles.min.css">-->
    <script src="public/js/script.js"></script>
</head>

<body class="flex flex-col min-h-screen">
    <?php include_once "api/includes/header.php"; ?>

    <main class="flex-grow">
        <?php if (isset($_GET["producto"])) {
            include_once "api/includes/product_details.php";
        } elseif (isset($_GET["categoria"])) {
            include_once "api/includes/category.php";
        } elseif (isset($_GET["search"])) {
            include_once "api/includes/search.php";
        } elseif (isset($_GET["cart"])) {
            include_once "api/includes/cart.php";
        } elseif (isset($_GET["checkout"])) {
            include_once "api/includes/checkout.php";
        } elseif (isset($_GET["profile"])) {
            include_once "api/includes/profile.php";
        } elseif (isset($_GET["orders"])) {
            include_once "api/includes/orders.php";
        } else {
            include_once "api/includes/random_products.php";
        } ?>
    </main>

    <?php include_once "api/includes/footer.php"; ?>

    <div id="loginMessage" class="fixed bottom-4 right-4 text-white px-4 py-2 rounded shadow-md opacity-0 transition-opacity"></div>
</body>

</html>