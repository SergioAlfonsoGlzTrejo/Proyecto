}<?php
session_start();
require_once "../../model/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $carrito_id = $_POST['carrito_id'] ?? null;
    $producto_id = $_POST['producto_id'] ?? null;
    $cantidad = $_POST['cantidad'] ?? null;

    if (!$carrito_id || !$producto_id || !$cantidad || $cantidad <= 0) {
        header('Location: ../../view/principal/carrito.php?error=1');
        exit;
    }

    $stmt = $pdo->prepare("UPDATE compras SET cantidad = ? WHERE carrito_id = ? AND id = ?");
    $stmt->execute([$cantidad, $carrito_id, $producto_id]);

    header('Location: ../../view/principal/carrito.php?ok=1');
    exit;
}