<?php
$host = 'localhost'; // Cambiar si es necesario
$dbname = 'eko_bazar'; // Nombre de la base de datos
$username = 'postgres'; // Usuario de la base de datos
$password = '12345'; // Contraseña de la base de datos
$port = '5432'; // Puerto de la base de datos

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname;port=$port", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}