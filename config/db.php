<?php
$isLocal = $_SERVER['SERVER_NAME'] === 'localhost';

if ($isLocal) {
    require __DIR__ . '/../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();
}

$servername = $_ENV['TIDB_HOST'];
$dbname = $_ENV['TIDB_NAME'];
$username = $_ENV['TIDB_USER'];
$password = $_ENV['TIDB_PASSWORD'];

$conn = mysqli_init();

if ($isLocal) {
    mysqli_real_connect($conn, $servername, $username, $password, $dbname);
} else {
    mysqli_real_connect($conn, $servername, $username, $password, $dbname, 4000, NULL, MYSQLI_CLIENT_SSL);
}

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
