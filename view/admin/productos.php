<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../principal/login.php?info=1');
} elseif ($_SESSION['user']['rol'] !== 'admin') {
    header('Location: ../principal/index.php?warning=1');
}

require_once "../../model/db.php";

$query = $pdo->query("SELECT * FROM productos");
$productos = $query->fetchAll(PDO::FETCH_ASSOC);

$titulo = "EkoBazar";
include_once "../plantillas/header.php";
?>
<link rel="stylesheet" href="../../assets/css/admin/productos.css">
<title><?= $titulo ?? "EkoBazar" ?></title>
<script src="../../assets/js/alertas.js" defer></script>
<?php include '../plantillas/nav-sencillo.php'; ?>
</head>
<body>
<main class="container">
    <a href="../admin/panel.php" role="button"><i class="ph ph-arrow-left"></i> Volver al panel de administración</a>
    <?php if(isset($_GET) && $_GET['ok']==1): ?>
        <article id="ok1" class="ok">
            <i class="ph ph-check"></i> Producto guardado
        </article>
    <?php elseif(isset($_GET) && $_GET['ok']==2): ?>
        <article id="ok2" class="ok">
            <i class="ph ph-check"></i> Producto eliminado
        </article>
    <?php endif; ?>
<div>
    <p>Gestión de productos</p>
    <a href="../formularios/productos.php" role="button">Nuevo producto</a>
</div>
<div class="productos-admin">
    <?php foreach ($productos as $producto): ?>
        <div class="producto-card">
            <img src="<?= $producto['imagen_url'] ?>" alt="<?= $producto['nombre'] ?>">
            <div>
                <h3><?= $producto['nombre'] ?></h3>
                <p><strong>Marca:</strong> <?= $producto['marca'] ?></p>
                <p><strong>Precio:</strong> $<?= number_format($producto['precio'], 2) ?></p>
                <p><?= $producto['descripcion'] ?></p>
                <p><?= $producto['stock'] ?> en stock</p>
                <div class="acciones">
                    <a href="../formularios/productos.php?id=<?= $producto['id'] ?>" role="button">Editar</a>
                    <a href="../../controller/productos/eliminar.php?id=<?= $producto['id'] ?>" role="button" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include_once "../plantillas/footer.php"; ?>