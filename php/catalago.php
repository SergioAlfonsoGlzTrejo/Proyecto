<?php
   require_once "header.php";
   // Aquí deberías consultar la base de datos para obtener los productos
   $productos = [
       ['id' => 1, 'nombre' => 'Producto 1', 'precio' => 100, 'imagen' => 'producto1.jpg'],
       ['id' => 2, 'nombre' => 'Producto 2', 'precio' => 150, 'imagen' => 'producto2.jpg'],
       // Más productos...
   ];
?>

<section class="productos">
    <h2>Catálogo de Productos</h2>
    <div class="productos-lista">
        <?php foreach ($productos as $producto): ?>
            <div class="producto">
                <img src="assets/images/<?= $producto['imagen'] ?>" alt="<?= $producto['nombre'] ?>">
                <h3><?= $producto['nombre'] ?></h3>
                <p>$<?= $producto['precio'] ?></p>
                <a href="producto-detalle.php?id=<?= $producto['id'] ?>" class="ver-detalle">Ver detalle</a>
                <button class="agregar-carrito">Añadir al carrito</button>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
   require_once "footer.php";
?>
