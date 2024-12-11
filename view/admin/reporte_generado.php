<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Pagos y Ventas</title>
</head>
<body>
    <h1>Reporte de Pagos y Ventas</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Fecha de Pago</th>
                <th>Usuario</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
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

    <a href="reportes.php">Volver a los filtros</a>
</body>
</html>