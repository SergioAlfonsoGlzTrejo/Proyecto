<?php
// Conexión a la base de datos
require_once 'db.php';

// Verificar datos enviados
if (isset($_POST['id_carrito'], $_POST['cantidad'])) {
    $id_carrito = $_POST['id_carrito'];
    $cantidad = $_POST['cantidad'];

    if ($cantidad > 0) {
        // Actualizar cantidad en el carrito
        $sql = "UPDATE carrito SET cantidad = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cantidad, $id_carrito]);

        echo "Cantidad actualizada correctamente.";
    } else {
        echo "Cantidad inválida.";
    }
} else {
    echo "Datos incompletos.";
}

// Redirigir al carrito
header("Location: carrito.php");
exit;
?>
