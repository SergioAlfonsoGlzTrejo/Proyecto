<?php
session_start();
require_once "../../model/db.php";

if (!isset($_SESSION['user'])) {
    header('Location: ../principal/login.php?info=1');
} elseif ($_SESSION['user']['rol'] !== 'admin') {
    header('Location: ../principal/index.php?warning=1');
}

$usuarios = $pdo->query("SELECT id, nombre, apellidos FROM usuarios")->fetchAll(PDO::FETCH_ASSOC);
$productos = $pdo->query("SELECT id, nombre FROM productos")->fetchAll(PDO::FETCH_ASSOC);

include_once "../plantillas/header.php";
?>
<link rel="stylesheet" href="../../assets/css/admin/reportes.css">
<script src="../../assets/js/alertas.js" defer></script>
<title><?= $titulo ?? "EkoBazar" ?></title>
<?php include '../plantillas/nav-sencillo.php'; ?>
</head>
<body>
<main class="container">
    <a href="../admin/panel.php" role="button"><i class="ph ph-arrow-left"></i> Volver al panel de administración</a>
    <p>Generar Reporte</p>
    <form action="../../controller/reportes/generar.php" method="GET">
        <div>
            <fieldset>
                <label for="fecha_inicio">Fecha Inicio:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio">
            </fieldset>
            <fieldset>
                <label for="fecha_fin">Fecha Fin:</label>
                <input type="date" id="fecha_fin" name="fecha_fin">
            </fieldset>
        </div>

        <div>
            <fieldset>
                <label for="usuario_id">Usuario:</label>
                <select id="usuario_id" name="usuario_id">
                    <option value="">Todos</option>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= $usuario['id'] ?>">
                            <?= $usuario['nombre'] . ' ' . $usuario['apellidos'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </fieldset>
            <fieldset>
                <label for="producto_id">Producto:</label>
                <select id="producto_id" name="producto_id">
                    <option value="">Todos</option>
                    <?php foreach ($productos as $producto): ?>
                        <option value="<?= $producto['id'] ?>">
                            <?= $producto['id'] . '. ' . $producto['nombre'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </fieldset>
        </div>

        <button type="submit">Generar Reporte</button>
    </form>
<?php include_once "../plantillas/footer.php"; ?>