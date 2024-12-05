<?php
   session_start();
   require_once "header.php";

   // Aquí deberías cargar los productos del carrito
   // Suponiendo que los productos se guardan en $_SESSION['carrito']
   $carrito = $_SESSION['carrito'] ?? [];

   // Si el carrito está vacío
   if (empty($carrito)) {
       echo "<p>No hay productos en el carrito.</p>";
   } else {
?>
    <section class="carrito">
        <h2>Carrito de Compras</h2>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $total = 0;
                    foreach ($carrito as $producto):
                        $total += $producto['precio'] * $producto['cantidad'];
                ?>
                    <tr>
                        <td><?= $producto['nombre'] ?></td>
                        <td>$<?= $producto['precio'] ?></td>
                        <td><?= $producto['cantidad'] ?></td>
                        <td>$<?= $producto['precio'] * $producto['cantidad'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p>Total: $<?= $total ?></p>
        <button>Finalizar compra</button>
    </section>
<?php
   }
   require_once "footer.php";
?>
