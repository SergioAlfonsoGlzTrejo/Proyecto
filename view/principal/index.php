<?php
<<<<<<< HEAD
// Conexión a la base de datos
require_once "../../model/db.php";

// Lógica para obtener productos de la base de datos (si lo deseas dinámico)
$sql = "SELECT * FROM productos LIMIT 6";  // Ajusta esta consulta a tus necesidades
$query = $pdo->query($sql);
$productos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Shop - Inicio</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Encabezado -->
    <header>
        <h1>E-Shop 🛒</h1>
        <nav>
            <ul><!--Aqui para redirigir a las paginas  -->
                <li><a href="#">Inicio</a></li>
                <li><a href="\php\catalago.php">Catálogo</a></li>
                <li><a href="carrito.php">Carrito</a></li>
                <li><a href="login.php">Iniciar Sesión</a></li>
            </ul>
        </nav>
    </header>
    
    <!-- Banner -->
    <section class="banner">
        <img src="banner.jpg" alt="Ofertas increíbles esta semana">
        <div class="banner-text">
            <h2>¡Ofertas increíbles esta semana!</h2>
            <p>Encuentra los mejores precios en nuestros productos destacados.</p>
        </div>
    </section>
    
    <!-- Productos destacados -->
    <section class="productos-destacados">
        <h2>Productos Destacados</h2>
        <div class="productos">
            <?php foreach ($productos as $producto): ?>
                <div class="producto">
                    <img width="100" src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
                    <h3><?php echo $producto['nombre']; ?></h3>
                    <p>$<?php echo number_format($producto['precio'], 2); ?></p>
                    <button>Añadir al carrito</button>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    
    <!-- Pie de página -->
    <footer>
        <p>© 2024 E-Shop. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
=======
session_start();
require_once "../../model/db.php";

$sql = "SELECT * FROM productos LIMIT 10"; 
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
>>>>>>> test/login-css
