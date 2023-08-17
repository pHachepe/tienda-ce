<?php
if ($_SERVER['SERVER_NAME'] === 'localhost') {
    require __DIR__ . '/../vendor/autoload.php'; // Ruta correcta al archivo autoload.php de Composer
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..'); // Ruta correcta al archivo .env
    $dotenv->load();
}
echo "host: " . $_ENV['DB_HOST'] . "<br>";
echo "user: " . $_ENV['DB_USER'] . "<br>";
echo "pass: " . $_ENV['DB_PASS'] . "<br>";
echo "name: " . $_ENV['DB_NAME'] . "<br>";
echo "port: " . $_ENV['DB_PORT'] . "<br>";
echo "server: " . $_SERVER['SERVER_NAME'] . "<br>";

$conn = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME'], $_ENV['DB_PORT']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
