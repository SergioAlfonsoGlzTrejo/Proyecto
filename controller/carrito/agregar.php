<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'error' => 'login_required']);
    exit;
}

require_once '../../model/db.php';

$data = json_decode(file_get_contents('php://input'), true);
$idProducto = $data['id'] ?? null;

if ($idProducto) {
    // Aquí puedes guardar el producto en el carrito de la sesión o base de datos
    $_SESSION['carrito'][] = $idProducto;
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'invalid_product']);
}
