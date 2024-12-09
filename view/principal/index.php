<?php
session_start();
require_once "../../model/db.php";

$sql = "SELECT * FROM productos LIMIT 12"; 
$query = $pdo->query($sql);
$productos = $query->fetchAll(PDO::FETCH_ASSOC);

include "../../view/plantillas/header.php";
?>
<link rel="stylesheet" href="../recursos/css/index.css">
<title><?= $titulo ?? "EkoBazar" ?></title>
<script src="../recursos/js/alertas.js" defer></script>
<?php include '../plantillas/nav-index.php'; ?>
</head>
<body>
    <main class="container">
    <?php if (isset($_GET) && $_GET['ok']==1): ?>
        <article id="ok1" class="ok">
            <i class="ph ph-check"></i> Sesión iniciada correctamente
        </article>
    <?php elseif (isset($_GET) && $_GET['ok']==2): ?>
        <article id="ok2" class="ok">
            <i class="ph ph-check"></i> Producto añadido al carrito
        </article>
    <?php elseif (isset($_GET) && $_GET['ok']==3): ?>
        <article id="ok3" class="ok">
            <i class="ph ph-check"></i> Cantidad actualizada correctamente
        </article>
    <?php elseif (isset($_GET) && $_GET['info']==1): ?>
        <article id="info1" class="info">
            <i class="ph ph-info"></i> No tienes productos en tu carrito
        </article>
    <?php elseif (isset($_GET) && $_GET['warning']==1): ?>
        <article id="warning1" class="warning">
            <i class="ph ph-warning"></i> No tienes permiso para acceder a ese contenido
        </article>
    <?php endif; ?>
        <section class="banner">
            <img src="banner.jpg" alt="Ofertas increíbles esta semana">
            <div class="banner-text">
                <h2>¡Ofertas increíbles esta semana!</h2>
                <p>Encuentra los mejores precios en nuestros productos destacados.</p>
            </div>
        </section>
        <section class="productos-destacados">
            <h2>Productos Destacados</h2>
            <div class="productos">
                <?php foreach ($productos as $producto): ?>
                    <div class="producto">
                        <img width="100" src="<?php echo $producto['imagen_url']; ?>" alt="<?php echo $producto['nombre']; ?>">
                        <div class="producto-info">
                            <h3><?= $producto['nombre'] ?></h3>
                            <p><strong>Marca:</strong> <?= $producto['marca'] ?? 'N/A' ?></p>
                            <p><?= $producto['descripcion'] ?? 'Sin descripción disponible' ?></p>
                            <p><strong>Precio:</strong> $<?= $producto['precio'] ?></p>
                            <?php if ($producto['precio_mayoreo']): ?>
                                <p><strong>Precio al mayoreo:</strong> $<?= $producto['precio_mayoreo'] ?></p>
                            <?php endif; ?>
                            <p><strong>Existencias:</strong> <?= $producto['stock'] ?? 'Sin stock disponible' ?></p>
                            <a href="../../controller/carrito/agregar.php?producto_id=<?= $producto['id'] ?>" class="btn">Añadir al carrito</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
<?php include '../plantillas/footer.php'; ?>