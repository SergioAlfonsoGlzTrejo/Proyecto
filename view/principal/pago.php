<?php
// Conexión a la base de datos
require_once 'db.php';

// Obtener los productos del carrito
$sql = "SELECT c.id, p.nombre, p.precio, c.cantidad 
        FROM carrito c 
        JOIN productos p ON c.id_producto = p.id";
$query = $pdo->query($sql);
$carrito = $query->fetchAll(PDO::FETCH_ASSOC);

// Calcular el total
$total = 0;
foreach ($carrito as $item) {
    $subtotal = $item['precio'] * $item['cantidad'];
    $total += $subtotal;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Shop - Pago</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Encabezado -->
    <?php include 'view/plantillas/header.php'; ?>
    <nav>
        <h1>E-Shop 🛒</h1>
            <ul><!--Aqui para redirigir a las paginas  -->
                <li><a href="#">Inicio</a></li>
                <li><a href="\view\principal\catalago.php">Catálogo</a></li>
                <li><a href="view\principal\carrito.php">Carrito</a></li>
                <li><a href="view\login\iniciar_sesion.php">Iniciar Sesión</a></li>
            </ul>
        </nav>

    <!-- Contenido principal -->
    <main>
        <h2>Resumen de Compra</h2>
        <?php if (empty($carrito)): ?>
            <p>No hay productos en el carrito.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($carrito as $item): ?>
                        <tr>
                            <td><?php echo $item['nombre']; ?></td>
                            <td>$<?php echo number_format($item['precio'], 2); ?></td>
                            <td><?php echo $item['cantidad']; ?></td>
                            <td>$<?php echo number_format($item['precio'] * $item['cantidad'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p><strong>Total a pagar: $<?php echo number_format($total, 2); ?></strong></p>
            <form action="procesar_pago.php" method="POST">
                <button type="submit">Pagar</button>
            </form>
        <?php endif; ?>
    </main>

    <!-- Pie de página -->
    <?php include 'view/plantillas/footer.php'; ?>
</body>
</html>
