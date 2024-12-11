<?php
// Conexión a la base de datos
require_once 'db.php';

// Verificar datos enviados
if (isset($_POST['id_carrito'])) {
    $id_carrito = $_POST['id_carrito'];

    // Eliminar producto del carrito
    $sql = "DELETE FROM carrito WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_carrito]);

    echo "Producto eliminado correctamente.";
} else {
    echo "Datos incompletos.";
}

// Redirigir al carrito
header("Location: carrito.php");
exit;
?>
