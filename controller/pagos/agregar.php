<?php
include_once "../../model/db.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../../view/login/iniciar_sesion.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $carrito_id = $_POST['carrito_id'];
    $usuario_id = $_SESSION['user']['id'];
    $total = $_POST['total'];

    $sql = "INSERT INTO pagos (carrito_id, usuario_id, total) VALUES (:carrito_id, :usuario_id, :total)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':carrito_id' => $carrito_id,
        ':usuario_id' => $usuario_id,
        ':total' => $total
    ]);

    $sql = "UPDATE carritos SET pago_id = :pago_id WHERE id = :carrito_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':pago_id' => $pdo->lastInsertId(),
        ':carrito_id' => $carrito_id
    ]);

    header("Location: ../../view/principal/pagos.php?ok=1");
}
?>
