<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login/iniciar_sesion.php');
    exit;
}

require_once "../../model/db.php";

$producto_id = $_GET['producto_id'];
$cantidad = 1; // Por defecto la cantidad es 1

// Verificamos si el producto ya está en el carrito del usuario
$stmt = $pdo->prepare("SELECT id FROM carritos WHERE usuario_id = ? AND pago_id IS NULL");
$stmt->execute([$_SESSION['user']['id']]);
$carrito = $stmt->fetch(PDO::FETCH_ASSOC);

// Si no existe un carrito abierto, lo creamos
if (!$carrito) {
    $stmt = $pdo->prepare("INSERT INTO carritos (usuario_id) VALUES (?) RETURNING id");
    $stmt->execute([$_SESSION['user']['id']]);
    $carrito_id = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
} else {
    $carrito_id = $carrito['id'];
}

// Verificamos si el producto ya está en el carrito
$stmt = $pdo->prepare("SELECT * FROM compras WHERE carrito_id = ? AND producto_id = ?");
$stmt->execute([$carrito_id, $producto_id]);
$producto_en_carrito = $stmt->fetch(PDO::FETCH_ASSOC);

// Si el producto ya está en el carrito, solo actualizamos la cantidad
if ($producto_en_carrito) {
    $nueva_cantidad = $producto_en_carrito['cantidad'] + 1;
    $stmt = $pdo->prepare("UPDATE compras SET cantidad = ? WHERE carrito_id = ? AND producto_id = ?");
    $stmt->execute([$nueva_cantidad, $carrito_id, $producto_id]);
} else {
    // Si el producto no está en el carrito, lo agregamos
    $stmt = $pdo->prepare("INSERT INTO compras (carrito_id, producto_id, cantidad) VALUES (?, ?, ?)");
    $stmt->execute([$carrito_id, $producto_id, $cantidad]);
}

header('Location: ../../view/principal/index.php?ok=2');
exit;