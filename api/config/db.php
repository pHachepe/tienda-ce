<?php
echo "SERVER_NAME: " . $_SERVER['SERVER_NAME'] . "<br>";
if ($_SERVER['SERVER_NAME'] === 'localhost') {
    require __DIR__ . '/../vendor/autoload.php'; // Ruta correcta al archivo autoload.php de Composer
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..'); // Ruta correcta al archivo .env
    $dotenv->load();
    // mysqli with ssl
    $mysql = mysqli_init();
    $mysql->ssl_set(
        NULL,
        NULL,
        '/etc/mysql/certs/ca.pem',
        NULL,
        NULL
    );
    $conn = mysqli_real_connect(
        $mysql,
        $_ENV['DB_HOST'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
        $_ENV['DB_NAME'],
        $_ENV['DB_PORT'],
        NULL,
        MYSQLI_CLIENT_SSL
    );

    $conn = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME'], $_ENV['DB_PORT']);
} else {
    //$conn = new mysqli($_ENV['TIDB_HOST'], $_ENV['TIDB_USER'], $_ENV['TIDB_PASSWORD'], $_ENV['TIDB_NAME'], $_ENV['TIDB_PORT']);
    // connect with ssl in tidb
    $conn = mysqli_init();
    $conn->ssl_set(
        NULL,
        NULL,
        '/etc/mysql/certs/ca.pem',
        NULL,
        NULL
    );
    $conn->real_connect(
        $_ENV['TIDB_HOST'],
        $_ENV['TIDB_USER'],
        $_ENV['TIDB_PASSWORD'],
        $_ENV['TIDB_NAME'],
        $_ENV['TIDB_PORT'],
        NULL,
        MYSQLI_CLIENT_SSL
    );

}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
