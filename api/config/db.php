<?php
if ($_SERVER['SERVER_NAME'] === 'localhost') {
    require __DIR__ . '/../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
    $dotenv->load();
}
$servername = $_ENV['TIDB_HOST'];
$dbname = $_ENV['TIDB_NAME'];
$username = $_ENV['TIDB_USER'];
$password = $_ENV['TIDB_PASSWORD'];

// Create connection
$conn = mysqli_init();
//mysqli_ssl_set($conn, NULL, NULL, "/etc/ssl/cert.pem", NULL, NULL);
//if (!$_SERVER['SERVER_NAME'] === 'localhost') {
    mysqli_real_connect($conn, $servername, $username, $password, $dbname, 4000, NULL, MYSQLI_CLIENT_SSL);
//} else {
//    mysqli_real_connect($conn, $servername, $username, $password, $dbname);
//}
echo $_SERVER['SERVER_NAME'];
echo "es el server name ". $_SERVER['SERVER_NAME'] === 'localhost';
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
