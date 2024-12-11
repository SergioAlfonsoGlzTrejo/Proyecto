<?php
session_start();
require_once "../../model/db.php";

$sql = "SELECT * FROM productos LIMIT 15"; 
$query = $pdo->query($sql);
$productos = $query->fetchAll(PDO::FETCH_ASSOC);

include "../../view/plantillas/header.php";
?>
<link rel="stylesheet" href="../../assets/css/principal/index.css">
<title><?= $titulo ?? "EkoBazar" ?></title>
<script src="../../assets/js/alertas.js" defer></script>
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
            <img src="../../assets/img/banner.png" alt="Ofertas increíbles esta semana">
        </section>
        <section class="principal">
            <div class="promociones">
                <div class="promocion">
                    <i class="ph ph-seal-percent"></i>
                    <div>
                        <h2>¡Ofertas increíbles esta semana!</h2>
                        <p>Encuentra los mejores precios en nuestros productos destacados.</p>
                    </div>
                </div>
                <div class="promocion">
                    <i class="ph ph-basket"></i>
                    <div>
                        <h2>!Llévate los mejores precios!</h2>
                        <p>Encuentra los mejores precios en nuestros productos destacados.</p>
                    </div>
                </div>
            </div>
            <div class="productos">
                <?php foreach ($productos as $producto): ?>
                    <div class="producto">
                        <a class="boton" href="../../controller/carrito/agregar.php?producto_id=<?= $producto['id'] ?>"><i class="ph ph-shopping-cart"></i></a>
                        <div class="img"><img src="<?php echo $producto['imagen_url']; ?>" alt="<?php echo $producto['nombre']; ?>"></div>
                        <div class="producto-info">
                            <h3><?= $producto['nombre'] ?></h3>
                            <p><strong>Marca:</strong> <?= $producto['marca'] ?? 'N/A' ?></p>
                            <p><?= $producto['descripcion'] ?? 'Sin descripción disponible' ?></p>
                            <p><strong>Precio:</strong> $<?= $producto['precio'] ?></p>
                            <?php if ($producto['precio_mayoreo']): ?>
                                <p><strong>Precio al mayoreo:</strong> $<?= $producto['precio_mayoreo'] ?></p>
                            <?php endif; ?>
                            <p><strong>Existencias:</strong> <?= $producto['stock'] ?? 'Sin stock disponible' ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
<?php include '../plantillas/footer.php'; ?>