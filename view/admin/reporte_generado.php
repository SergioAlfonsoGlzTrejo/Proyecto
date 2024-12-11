<?php
session_start();
require_once "../../model/db.php";

if (!isset($_SESSION['user'])) {
    header('Location: ../principal/login.php?info=1');
} elseif ($_SESSION['user']['rol'] !== 'admin') {
    header('Location: ../principal/index.php?warning=1');
}

include_once "../../view/plantillas/header.php";
?>
<link rel="stylesheet" href="../../assets/css/admin/reporte_generado.css">
<script src="../../assets/js/alertas.js" defer></script>
<title><?= $titulo ?? "EkoBazar" ?></title>
<?php include '../../view/plantillas/nav-sencillo.php'; ?>
</head>
<body>
    <main class="container">
    <a href="../../view/admin/reportes.php" role="button"><i class="ph ph-arrow-left"></i> Volver a los filtros</a>
    <a class="a2" href="../../view/principal/index.php" role="button"><i class="ph ph-house"></i> Volver al inicio</a>
    <p>Reporte generado</p>
    <table>
        <thead>
            <tr>
                <th>Fecha de pago</th>
                <th>Usuario</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($reportes)): ?>
                <?php foreach ($reportes as $reporte): ?>
                    <tr>
                        <td><?= $reporte['fecha_pago'] ?></td>
                        <td><?= $reporte['usuario'] ?></td>
                        <td><?= $reporte['producto'] ?></td>
                        <td><?= $reporte['cantidad'] ?></td>
                        <td>$<?= number_format($reporte['precio'], 2) ?></td>
                        <td>$<?= number_format($reporte['total'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No se encontraron registros para los filtros aplicados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?php include_once "../../view/plantillas/footer.php"; ?>