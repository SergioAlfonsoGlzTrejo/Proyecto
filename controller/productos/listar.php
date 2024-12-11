<?php
require_once "../../model/db.php";

try {
    $sql = "SELECT * FROM productos";
    $stmt = $pdo->query($sql);
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}