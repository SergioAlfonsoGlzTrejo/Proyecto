<?php
session_start();
require_once "../../model/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $carrito_id = $_POST['carrito_id'] ?? null;
    $total = $_POST['total'] ?? null;
    $usuario_id = $_SESSION['user']['id'];

    if (!$carrito_id || !$total  || !$usuario_id) {
        header('Location: ../../view/principal/carrito.php?error=4');
        exit;
    }

    $pdo->beginTransaction();
    try {
        $stmt = $pdo->prepare("
            INSERT INTO pagos (carrito_id, usuario_id, total)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$carrito_id, $usuario_id, $total]);

        $pago_id = $pdo->lastInsertId();

        $stmt = $pdo->prepare("UPDATE carritos SET pago_id = ? WHERE id = ?");
        $stmt->execute([$pago_id, $carrito_id]);

        $stmt = $pdo->prepare("DELETE FROM compras WHERE carrito_id = ?");
        $stmt->execute([$carrito_id]);

        $pdo->commit();
        header('Location: ../../view/principal/pago-realizado.php');
    } catch (Exception $e) {
        $pdo->rollBack();
        header('Location: ../../view/carrito/carrito.php?error=4');
        exit;
    }
}