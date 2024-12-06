<?php
// Conexión a la base de datos
require_once 'db.php';

// Lógica para mostrar los productos del carrito
// Aquí asumimos que los productos están almacenados en una tabla llamada "carrito" asociada al usuario
$sql = "SELECT c.id, p.nombre, p.precio, c.cantidad 
        FROM carrito c 
        JOIN productos p ON c.id_producto = p.id";
$query = $pdo->query($sql);
$carrito = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Shop - Carrito</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Encabezado -->
    <?php include 'view/plantillas/header.php'; ?>

    <!-- Contenido principal -->
    <main>
        <h2>Carrito de Compras</h2>
        <?php if (empty($carrito)): ?>
            <p>Tu carrito está vacío. <a href="catalogo.php">Explora nuestros productos.</a></p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    foreach ($carrito as $item): 
                        $subtotal = $item['precio'] * $item['cantidad'];
                        $total += $subtotal;
                    ?>
                        <tr>
                            <td><?php echo $item['nombre']; ?></td>
                            <td>$<?php echo number_format($item['precio'], 2); ?></td>
                            <td>
                                <form action="actualizar_carrito.php" method="POST">
                                    <input type="number" name="cantidad" value="<?php echo $item['cantidad']; ?>" min="1">
                                    <input type="hidden" name="id_carrito" value="<?php echo $item['id']; ?>">
                                    <button type="submit">Actualizar</button>
                                </form>
                            </td>
                            <td>$<?php echo number_format($subtotal, 2); ?></td>
                            <td>
                                <form action="eliminar_carrito.php" method="POST">
                                    <input type="hidden" name="id_carrito" value="<?php echo $item['id']; ?>">
                                    <button type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p><strong>Total: $<?php echo number_format($total, 2); ?></strong></p>
            <a href="pago.php" class="boton">Proceder al pago</a>
        <?php endif; ?>
    </main>

    <!-- Pie de página -->
    <?php include 'view/plantillas/footer.php'; ?>
</body>
</html>
