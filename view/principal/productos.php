<?php
session_start();
require_once "../../controller/productos/listar.php";

$titulo = "EkoBazar";
include_once "../plantillas/header.php";
?>
<link rel="stylesheet" href="../recursos/css/productos.css">
<title><?= $titulo ?? "EkoBazar" ?></title>
<?php include '../plantillas/nav-index.php'; ?>
</head>
<body>

<article>
    <h2>Catálogo de productos</h2>
    <a href="formulario_producto.php" role="button" style="margin-bottom: 1rem;">Agregar producto</a>

    <?php if (isset($_GET['ok'])): ?>
        <article style="color: green; margin-bottom: 1rem;">✅ Operación realizada con éxito</article>
    <?php endif; ?>

    <div class="productos-container">
        <?php foreach ($productos as $producto): ?>
            <div class="producto-card">
                <img src="<?= $producto['imagen_url'] ?>" alt="Producto" class="producto-img">
                <div class="producto-info">
                    <h3><?= $producto['nombre'] ?></h3>
                    <p><strong>Marca:</strong> <?= $producto['marca'] ?? 'N/A' ?></p>
                    <p><?= $producto['descripcion'] ?? 'Sin descripción disponible' ?></p>
                    <p><strong>Precio:</strong> $<?= $producto['precio'] ?></p>
                    <?php if ($producto['precio_mayoreo']): ?>
                        <p><strong>Precio al mayoreo:</strong> $<?= $producto['precio_mayoreo'] ?></p>
                    <?php endif; ?>
                    <div class="acciones">
                        <a href="formulario_producto.php?id=<?= $producto['id'] ?>" class="btn-editar">Editar</a>
                        <a href="../../controller/productos/eliminar.php?id=<?= $producto['id'] ?>" class="btn-eliminar">Eliminar</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</article>

<?php include_once "../plantillas/footer.php"; ?>