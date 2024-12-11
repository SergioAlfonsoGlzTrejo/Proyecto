<?php
session_start();
require_once "../../model/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $carrito_id = $_GET['carrito_id'] ?? null;
    $producto_id = $_GET['producto_id'] ?? null;

    if (!$carrito_id || !$producto_id) {
        header('Location: ../../view/principal/carrito.php?error=2');
    }

    $stmt = $pdo->prepare("DELETE FROM compras WHERE carrito_id = ? AND id = ?");
    $stmt->execute([$carrito_id, $producto_id]);

    header('Location: ../../view/principal/carrito.php?ok=2');
}