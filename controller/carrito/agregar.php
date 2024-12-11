<?php
session_start();
<<<<<<< HEAD

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
=======
if (!isset($_SESSION['user'])) {
    header('Location: ../login/iniciar_sesion.php');
    exit;
}

require_once "../../model/db.php";

$producto_id = $_GET['producto_id'];
$cantidad = 1;

$stmt = $pdo->prepare("SELECT id FROM carritos WHERE usuario_id = ? AND pago_id IS NULL");
$stmt->execute([$_SESSION['user']['id']]);
$carrito = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$carrito) {
    $stmt = $pdo->prepare("INSERT INTO carritos (usuario_id) VALUES (?) RETURNING id");
    $stmt->execute([$_SESSION['user']['id']]);
    $carrito_id = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
} else {
    $carrito_id = $carrito['id'];
}

$stmt = $pdo->prepare("SELECT * FROM compras WHERE carrito_id = ? AND producto_id = ?");
$stmt->execute([$carrito_id, $producto_id]);
$producto_en_carrito = $stmt->fetch(PDO::FETCH_ASSOC);

if ($producto_en_carrito) {
    $nueva_cantidad = $producto_en_carrito['cantidad'] + 1;
    $stmt = $pdo->prepare("UPDATE compras SET cantidad = ? WHERE carrito_id = ? AND producto_id = ?");
    $stmt->execute([$nueva_cantidad, $carrito_id, $producto_id]);
} else {
    $stmt = $pdo->prepare("INSERT INTO compras (carrito_id, producto_id, cantidad) VALUES (?, ?, ?)");
    $stmt->execute([$carrito_id, $producto_id, $cantidad]);
}

header('Location: ../../view/principal/index.php?ok=2');
exit;
>>>>>>> 5fbe8ac945607c66b042f8a7cadc914aa91f2df2
