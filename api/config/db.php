<?php
echo "SERVER_NAME: " . $_SERVER['SERVER_NAME'] . "<br>";
if ($_SERVER['SERVER_NAME'] === 'localhost') {
    require __DIR__ . '/../vendor/autoload.php'; // Ruta correcta al archivo autoload.php de Composer
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..'); // Ruta correcta al archivo .env
    $dotenv->load();
    $conn = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME'], $_ENV['DB_PORT']);
} else {
    $conn = new mysqli($_ENV['TIDB_HOST'], $_ENV['TIDB_USER'], $_ENV['TIDB_PASSWORD'], $_ENV['TIDB_NAME'], $_ENV['TIDB_PORT']);
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
