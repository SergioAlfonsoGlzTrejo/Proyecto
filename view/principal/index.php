<?php
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
    <link rel="stylesheet" href="/view/resources/css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <!-- Encabezado -->
    <header>
        <nav>
        <h1>E-Shop 🛒</h1>
            <ul><!--Aqui para redirigir a las paginas  -->
            <li><a href="/view/principal/catalago.php">Catálogo</a></li>
            <li><a href="/view/principal/carrito.php">Carrito</a></li>
            <li><a href="/view/login/iniciar_sesion.php">Iniciar Sesión</a></li>
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
