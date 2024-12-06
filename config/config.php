<?php
$host = 'localhost';
$dbname = 'sipresma';
$username = 'sa';
$password = 'siwof';

try {
    // Adding UTF-8 encoding to the connection string
    $conn = new PDO("sqlsrv:Server=$host;Database=$dbname", $username, $password,);
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
    die();
}
