<?php
require_once "api/includes/constants.php";
require_once "api/config/db.php";

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
    <link rel="stylesheet" href="public/css/font-awesome.6.0.0.all.min.css" />
    <script src="public/css/tailwind.js"></script>
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
        } elseif (isset($_GET["checkout"])) {
            include_once "api/includes/checkout.php";
        } elseif (isset($_GET["profile"]) || isset($_GET["addresses"]) || isset($_GET["payments"])) {
            include_once "api/includes/unimplemented.php";
        } elseif (isset($_GET["orders"])) {
            include_once "api/includes/orders.php";
        } else {
            include_once "api/includes/random_products.php";
        } ?>
    </main>

    <?php include_once "api/includes/footer.php"; ?>

    <div id="messages" class="fixed bottom-4 right-4 text-white px-4 py-2 rounded shadow-md opacity-0 transition-opacity"></div>
</body>

</html>