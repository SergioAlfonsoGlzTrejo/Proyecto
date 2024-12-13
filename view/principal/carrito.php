<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php?info=1');
    exit;
}

require_once "../../model/db.php";

$stmt = $pdo->prepare("SELECT id FROM carritos WHERE usuario_id = ? AND pago_id IS NULL");
$stmt->execute([$_SESSION['user']['id']]);
$carrito = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$carrito) {
    header('Location: index.php?info=1');
    exit;
}

$stmt = $pdo->prepare("
    SELECT 
        compras.id, 
        compras.cantidad, 
        productos.nombre, 
        productos.precio, 
        productos.precio_mayoreo, 
        productos.imagen_url,
        CASE 
            WHEN compras.cantidad >= 5 THEN productos.precio_mayoreo
            ELSE productos.precio
        END AS precio_aplicado,
        compras.cantidad * 
        CASE 
            WHEN compras.cantidad >= 5 THEN productos.precio_mayoreo
            ELSE productos.precio
        END AS total_producto
    FROM compras
    INNER JOIN productos ON compras.producto_id = productos.id
    WHERE compras.carrito_id = ?");
$stmt->execute([$carrito['id']]);
$productos_en_carrito = $stmt->fetchAll(PDO::FETCH_ASSOC);

$subtotal = array_sum(array_column($productos_en_carrito, 'total_producto'));

include_once "../plantillas/header.php";
?>
<link rel="stylesheet" href="../../assets/css/principal/carrito.css">
<title><?= $titulo ?? "EkoBazar" ?></title>
<script src="../../assets/js/alertas.js" defer></script>
<?php include '../plantillas/nav-sencillo.php'; ?>
</head>
<body>
<main class="container">
    <a class="atras" href="index.php" role="button"><i class="ph ph-arrow-left"></i> Volver al catálogo</a>

    <?php if (isset($_GET) && $_GET['error']==1): ?>
        <article id="error1" class="error">
            <i class="ph ph-alert-circle-exc"></i> Error al actualizar el carrito
        </article>
    <?php elseif (isset($_GET) && $_GET['warning']==1): ?>
        <article id="warning1" class="warning">
            <i class="ph ph-alert-triangle"></i> No disponible
        </article>
    <?php elseif (isset($_GET) && $_GET['warning']==2): ?>
        <article id="warning2" class="warning">
            <i class="ph ph-alert-triangle"></i> No tienes productos en tu carrito
        </article>
    <?php endif; ?>

    <section>
        <p class="titulo">Carrito de compras</p>
        <div class="total-carrito">
            <p>Subtotal: $<?= number_format($subtotal, 2) ?></p>
            <a href="pagar.php?carrito_id=<?= $carrito['id'] ?>" class="btn-pagar">Pagar</a>
        </div>
    </section>

    <?php if (count($productos_en_carrito) > 0): ?>
        <div class="productos-carrito">
            <?php foreach ($productos_en_carrito as $producto): ?>
                <div class="producto-tarjeta">
                    <div class="producto-imagen">
                        <img src="<?= $producto['imagen_url'] ?>" alt="<?= $producto['nombre'] ?>" class="imagen-producto">
                    </div>
                    <div class="producto-info">
                        <h3><?= $producto['nombre'] ?></h3>
                        <p>Precio: $<?= number_format($producto['precio_aplicado'], 2) ?></p>
                        <form action="../../controller/carrito/actualizar.php" method="POST">
                            <p>Cantidad:</p>
                            <input class="cantidad" type="number" name="cantidad" value="<?= $producto['cantidad'] ?>" min="1" max="100" required>
                            <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                            <input type="hidden" name="carrito_id" value="<?= $carrito['id'] ?>">
                            <button type="submit" class="btn-actualizar">Actualizar</button>
                        </form>
                        <p>Total: $<?= number_format($producto['total_producto'], 2) ?></p>
                        <a href="../../controller/carrito/eliminar.php?producto_id=<?= $producto['id'] ?>&carrito_id=<?= $carrito['id'] ?>" class="btn-eliminar" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Tu carrito está vacío <a href="index.php">Volver al catálogo</a></p>
    <?php endif; ?>
</main>
<?php include '../plantillas/footer.php'; ?>