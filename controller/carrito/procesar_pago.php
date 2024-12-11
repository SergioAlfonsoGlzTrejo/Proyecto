<?php
// Conexión a la base de datos
require_once 'db.php';

// Procesar datos enviados desde el formulario
if (isset($_POST['id_producto'], $_POST['cantidad'], $_POST['precio'])) {
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $total = $cantidad * $precio;

    // Aquí puedes agregar lógica para registrar el pedido en la base de datos
    $sql = "INSERT INTO pedidos (id_producto, cantidad, total) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_producto, $cantidad, $total]);

    echo "Compra procesada exitosamente. Total: $" . number_format($total, 2);
} else {
    echo "Datos incompletos para procesar la compra.";
    exit;
}
?>
