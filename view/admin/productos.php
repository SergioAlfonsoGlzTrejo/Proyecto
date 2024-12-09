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

$titulo = "Gestión de Productos";
include_once "../plantillas/header.php";
?>
<link rel="stylesheet" href="../recursos/css/admin_productos.css">
<title><?= $titulo ?? "EkoBazar" ?></title>
<?php include '../plantillas/nav-index.php'; ?>
</head>
<body>

<h2>Gestión de Productos</h2>
<a href="formulario_producto.php" role="button">Agregar Nuevo Producto</a>
<div class="productos-admin">
    <?php foreach ($productos as $producto): ?>
        <div class="producto-card">
            <img src="<?= htmlspecialchars($producto['imagen_url']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>">
            <div>
                <h3><?= htmlspecialchars($producto['nombre']) ?></h3>
                <p><strong>Marca:</strong> <?= htmlspecialchars($producto['marca']) ?></p>
                <p><strong>Precio:</strong> $<?= number_format($producto['precio'], 2) ?></p>
                <p><?= htmlspecialchars($producto['descripcion']) ?></p>
                <a href="editar_producto.php?id=<?= $producto['id'] ?>" role="button">Editar</a>
                <a href="../../controller/productos/eliminar.php?id=<?= $producto['id'] ?>" role="button" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include_once "../plantillas/footer.php"; ?>