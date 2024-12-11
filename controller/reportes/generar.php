<?php
session_start();
require_once "../../model/db.php";

if (!isset($_SESSION['user'])) {
    header('Location: ../../view/principal/login.php?info=1');
    exit;
} elseif ($_SESSION['user']['rol'] !== 'admin') {
    header('Location: ../../view/principal/index.php?warning=1');
    exit;
}

$fecha_inicio = $_GET['fecha_inicio'] ?? null;
$fecha_fin = $_GET['fecha_fin'] ?? null;
$usuario_id = $_GET['usuario_id'] ?? null;
$producto_id = $_GET['producto_id'] ?? null;

$query = "
    SELECT p.fecha_pago, u.nombre AS usuario, pr.nombre AS producto, co.cantidad, pr.precio, (co.cantidad * pr.precio) AS total
    FROM pagos p
    JOIN carritos c ON p.carrito_id = c.id
    JOIN usuarios u ON c.usuario_id = u.id
    JOIN compras co ON c.id = co.carrito_id
    JOIN productos pr ON co.producto_id = pr.id
    WHERE 1=1
";

$params = [];

if ($fecha_inicio) {
    $query .= " AND p.fecha_pago >= ?";
    $params[] = $fecha_inicio;
}

if ($fecha_fin) {
    $query .= " AND p.fecha_pago <= ?";
    $params[] = $fecha_fin;
}

if ($usuario_id) {
    $query .= " AND u.id = ?";
    $params[] = $usuario_id;
}

if ($producto_id) {
    $query .= " AND pr.id = ?";
    $params[] = $producto_id;
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$reportes = $stmt->fetchAll(PDO::FETCH_ASSOC);

require "../../view/admin/reporte_generado.php";