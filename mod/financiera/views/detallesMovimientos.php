<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Movimientos</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Ajusta la ruta -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table th {
            background-color: #0071bc;
            color: white;
        }
        .table tr:nth-child(even) {
            background-color: #e9ecef;
        }
        .table tr:nth-child(odd) {
            background-color: #f8f9fa;
        }
        .btn-custom {
            background-color: #0071bc;
            color: white;
        }
        .btn-custom:hover {
            background-color: #005f99;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4" style="color: #0071bc;">Detalles de Movimientos</h2>

        <!-- Botón para descargar el reporte CSV7 -->
        <div class="text-right mb-3">
            <form action="<?= base_url; ?>views/csv7.php" target="_blank" method="POST">
                <!-- Asegúrate de que el iddpa se pase en un campo oculto -->
                <input type="hidden" name="iddpa" value="<?= htmlspecialchars($_GET['iddpa']); ?>"> <!-- Suponiendo que lo recibes como GET -->
                <button type="submit" class="btn btn-custom" title="Descargar Reporte">
                    <i class="fas fa-file-csv"></i> Descargar Reporte
                </button>
            </form>
        </div>

        <div class="text-right mb-3">
            <a href="javascript:history.back()" class="btn btn-secondary">Regresar</a>
        </div>

        <?php if (!empty($traslados)): ?>
            <table class="table table-striped table-bordered" style="color: #0071bc;">
                <thead class="thead-dark">
                    <tr>
                        <th>Tipo de Movimiento</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($traslados as $traslado): ?>
                        <tr>
                            <td>
                                <?php 
                                switch ($traslado['tipoMovimiento']) {
                                    case 1: echo 'Reducción'; break;
                                    case 2: echo 'Suspensión'; break;
                                    case 3: echo 'Adición'; break;
                                    default: echo 'Desconocido'; break;
                                }
                                ?>
                            </td>
                            <td><?= htmlspecialchars('$' . number_format($traslado['monto'], 2, ',', '.')); ?></td>
                            <td><?= htmlspecialchars(date('d/m/Y', strtotime($traslado['fecha']))); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                No se encontraron movimientos.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>




