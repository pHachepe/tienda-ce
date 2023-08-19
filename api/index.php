<?php
require_once 'includes/constants.php';
require_once 'config/db.php';
?>

<html>

<head>
    <meta name="view-transition" content="same-origin" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
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

<script>
    if (document.startViewTransition) {
        window.navigation.addEventListener('navigate', (event) => {
            const toUrl = new URL(event.destination.url)

            // si no es una navegación en el mismo dominio (origen) no intercepta
            if (location.origin !== toUrl.origin) return

            // si es una navegación en el mismo dominio (origen) intercepta
            event.intercept({
                async handler() {
                    // carga la página de destino utilizando un fetch para obtener el HTML
                    const response = await fetch(toUrl)
                    const text = await response.text()
                    // extrae el contenido del main del HTML usando una expresión regular
                    const [, data] = text.match(/<main\b[^>]*>([\s\S]*?)<\/main>/i)

                    document.startViewTransition(() => {
                        const main = document.querySelector('main')
                        main.innerHTML = data
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });

                    })
                }
            })
        })
    }
</script>

<?php
$resultado->close();
$conn->close();
?>