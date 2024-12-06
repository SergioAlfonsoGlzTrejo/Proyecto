<?php
// Conexión a la base de datos
require_once 'db.php';

// Verificar si se recibe un producto para comprar
if (isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];
    
    // Obtener detalles del producto
    $sql = "SELECT * FROM productos WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_producto]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        echo "Producto no encontrado.";
        exit;
    }
} else {
    echo "No se seleccionó ningún producto para comprar.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Shop - Comprar</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Encabezado -->
    <?php include 'view/plantillas/header.php'; ?>

    <!-- Contenido principal -->
    <main>
        <h2>Compra del Producto</h2>
        <div class="producto-compra">
            <img src="productos/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
            <h3><?php echo $producto['nombre']; ?></h3>
            <p><strong>Precio:</strong> $<?php echo number_format($producto['precio'], 2); ?></p>
            <form action="procesar_pago.php" method="POST">
                <input type="hidden" name="id_producto" value="<?php echo $producto['id']; ?>">
                <input type="hidden" name="precio" value="<?php echo $producto['precio']; ?>">
                <label for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" value="1" min="1" required>
                <button type="submit">Proceder al pago</button>
            </form>
        </div>
    </main>

    <!-- Pie de página -->
    <?php include 'view/plantillas/footer.php'; ?>
</body>
</html>
