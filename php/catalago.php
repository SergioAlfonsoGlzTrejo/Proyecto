<?php
// Conexión a la base de datos
require_once "../model/db.php";

// Obtener productos de la base de datos
$sql = "SELECT * FROM productos";
$query = $pdo->query($sql);
$productos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Shop - Catálogo</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Encabezado -->
    <?php include 'view/plantillas/header.php'; ?>

    <!-- Contenido principal -->
    <main>
        <h2>Catálogo de Productos</h2>
        <div class="productos">
            <?php foreach ($productos as $producto): ?>
                <div class="producto">
                    <img src="productos/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
                    <h3><?php echo $producto['nombre']; ?></h3>
                    <p>$<?php echo number_format($producto['precio'], 2); ?></p>
                    <form action="carrito.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id_producto" value="<?php echo $producto['id']; ?>">
                        <button type="submit">Añadir al carrito</button>
                    </form>
                    <form action="comprar.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id_producto" value="<?php echo $producto['id']; ?>">
                        <button type="submit">Comprar ahora</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Pie de página -->
    <?php include 'view/plantillas/footer.php'; ?>
</body>
</html>
