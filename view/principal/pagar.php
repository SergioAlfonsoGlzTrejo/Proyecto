<?php
session_start();
require_once "../../model/db.php";
if (!isset($_SESSION['user'])) {
    header('Location: login.php?info=1');
    exit;
}

$usuario_id = $_SESSION['user']['id'];
$stmt = $pdo->prepare("
    SELECT c.id AS carrito_id, p.id AS producto_id, p.nombre, p.precio, co.cantidad, (p.precio * co.cantidad) AS subtotal
    FROM carritos c
    JOIN compras co ON c.id = co.carrito_id
    JOIN productos p ON co.producto_id = p.id
    WHERE c.usuario_id = ? AND c.pago_id IS NULL
");
$stmt->execute([$usuario_id]);
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($productos)) {
    echo "<p>No hay productos en el carrito para pagar.</p>";
    exit;
}

$total = array_sum(array_column($productos, 'subtotal'));

include_once "../plantillas/header.php";
?>
<link rel="stylesheet" href="../../assets/css/principal/pagar.css">
<title><?= $titulo ?? "EkoBazar" ?></title>
<script src="../../assets/js/alertas.js" defer></script>
<?php include '../plantillas/nav-index.php'; ?>
</head>
<body>
<main class="container">
    <section>
        <p class="titulo">Confirmación de compra</p>
        <div class="form-pago">
            <p>Total: $<?= number_format($total, 2) ?></p>
            <form action="../../controller/pagos/procesar.php" method="POST">
                <input type="hidden" name="carrito_id" value="<?= $productos[0]['carrito_id'] ?>">
                <input type="hidden" name="total" value="<?= $total ?>">
                <button type="submit">Confirmar</button>
            </form>
        </div>
    </section>
    <section class="resumen-pago">
        <?php foreach ($productos as $producto): ?>
            <article class="producto">
                <h2><?= $producto['nombre'] ?></h2>
                <p>Precio: $<?= number_format($producto['precio'], 2) ?></p>
                <p>Cantidad: <?= $producto['cantidad'] ?></p>
                <p>Subtotal: $<?= number_format($producto['subtotal'], 2) ?></p>
            </article>
        <?php endforeach; ?>
    </section>
<?php include '../plantillas/footer.php'; ?>