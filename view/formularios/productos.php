<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login/iniciar_sesion.php?info=1');
    exit;
} elseif ($_SESSION['user']['rol'] !== 'admin') {
    header('Location: ../principal/index.php?warning=1');
    exit;
}

require_once "../../model/db.php";

$titulo = "EkoBazar";
$titulo1 = isset($_GET['id']) ? "Editar producto" : "Agregar producto";
include_once "../plantillas/header.php";

$producto = null;

if (isset($_GET['id'])) {
    $sql = "SELECT * FROM productos WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->execute(['id' => $_GET['id']]);
    $producto = $query->fetch(PDO::FETCH_ASSOC);
}
include_once "../plantillas/header.php";
?>
<link rel="stylesheet" href="../../assets/css/principal/form-productos.css">
<title><?= $titulo ?? "EkoBazar" ?></title>
<script src="../../assets/js/alertas.js" defer></script>
<?php include '../plantillas/nav-sencillo.php'; ?>
</head>
<body>
<main class="container">
<a href="../admin/productos.php" role="button"><i class="ph ph-arrow-left"></i> Volver al editor de productos</a>
<article>
    <p class="titulo"><?= $titulo1 ?></p>
    <form action="../../controller/productos/guardar.php" method="post" enctype="multipart/form-data">
        <?php if (isset($producto)): ?>
            <input type="hidden" name="id" value="<?= $producto['id'] ?>">
        <?php endif; ?>

        <div class="form">
            <div>
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
            </div>
            <div>
                <fieldset>
                    <label for="precio">Precio</label>
                    <input type="number" id="precio" name="precio" step="0.01" value="<?= $producto['precio'] ?? '' ?>" required>
                </fieldset>
                <fieldset>
                    <label for="precio_mayoreo">Precio al mayoreo (5 o más)</label>
                    <input type="number" id="precio_mayoreo" name="precio_mayoreo" step="0.01" value="<?= $producto['precio_mayoreo'] ?? '' ?>">
                </fieldset>
                <fieldset>
                    <label for="stock">Stock</label>
                    <input type="number" id="stock" name="stock" value="<?= $producto['stock'] ?? '' ?>">
                </fieldset>
            </div>
            <fieldset>
                <label for="imagen_url">Fotografía (URL o subir archivo)</label>
                <input type="url" id="imagen_url" name="imagen_url" placeholder="URL de la imagen" value="<?= $producto['imagen_url'] ?? '' ?>">
                <input class="no" type="file" id="archivo" name="archivo">
            </fieldset>
        </div>

        <fieldset>
            <button type="submit"><i class="ph ph-paper-plane-right"></i> Guardar</button>
        </fieldset>
    </form>
</article>
<?php include_once "../plantillas/footer.php"; ?>