<?php
session_start();
require_once "../../model/db.php";

$titulo = isset($_GET['id']) ? "Editar producto" : "Agregar producto";
include_once "../plantillas/header.php";

$producto = null;

if (isset($_GET['id'])) {
    $sql = "SELECT * FROM productos WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->execute(['id' => $_GET['id']]);
    $producto = $query->fetch(PDO::FETCH_ASSOC);
}
?>

<article>
    <h2><?= $titulo ?></h2>
    <form action="../../controller/productos/guardar.php" method="post" enctype="multipart/form-data">
        <?php if (isset($producto)): ?>
            <input type="hidden" name="id" value="<?= $producto['id'] ?>">
        <?php endif; ?>

        <fieldset>
            <label for="nombre">Nombre del producto</label>
            <input type="text" id="nombre" name="nombre" value="<?= $producto['nombre'] ?? '' ?>" required>
        </fieldset>

        <fieldset>
            <label for="marca">Marca</label>
            <input type="text" id="marca" name="marca" value="<?= $producto['marca'] ?? '' ?>">
        </fieldset>

        <fieldset>
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4"><?= $producto['descripcion'] ?? '' ?></textarea>
        </fieldset>

        <fieldset>
            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" step="0.01" value="<?= $producto['precio'] ?? '' ?>" required>
        </fieldset>

        <fieldset>
            <label for="precio_mayoreo">Precio al mayoreo (5+)</label>
            <input type="number" id="precio_mayoreo" name="precio_mayoreo" step="0.01" value="<?= $producto['precio_mayoreo'] ?? '' ?>">
        </fieldset>

        <fieldset>
            <label for="imagen_url">Fotografía (URL o subir archivo)</label>
            <input type="url" id="imagen_url" name="imagen_url" placeholder="URL de la imagen" value="<?= $producto['imagen_url'] ?? '' ?>">
            <input type="file" id="archivo" name="archivo">
        </fieldset>

        <fieldset>
            <button type="submit"><i class="ph ph-paper-plane-right"></i> Guardar</button>
        </fieldset>
    </form>
</article>

<?php include_once "../plantillas/footer.php"; ?>