<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Movimiento</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Ajusta la ruta -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Para los íconos -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap 4 -->
    <script src="js/scripts.js"></script>

    <style>
        .title-c {
            color: #0071bc; /* Color del título */
        }
        .btn-custom {
            background-color: #0071bc; /* Mismo color que el título */
            border-color: #523178;
            color: #fff;
        }
        .btn-custom:hover {
            background-color: #6b409f; /* Un tono más oscuro para el hover */
            border-color: #6b409f;
        }
        label {
            color: #333; /* Color visible para las etiquetas */
        }
        select, input {
            color: #333; /* Color del texto de los campos de entrada */
            background-color: #fff; /* Fondo blanco para asegurar el contraste */
        }
        select {
            color: #000; /* Asegura que el texto de las opciones sea visible */
            background-color: #f8f9fa; /* Fondo ligeramente gris para mejor visibilidad */
            width: 100%; /* Aumenta el ancho del select al 100% del contenedor */
            height: 100px; /* Aumenta la altura del select */
            font-size: 18px; /* Aumenta el tamaño de la fuente para mejor legibilidad */
            padding: 10px; /* Espacio interno del select */
        }
        option {
            line-height: 1.2;
            color: #333;
            background-color: #f8f9fa;
        }
        .alert {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="title-c text-center mb-4">Realizar Movimiento</h2>
        <br><br><br>
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['mensaje']; ?>
            </div>
            <?php unset($_SESSION['mensaje']); ?>
        <?php endif; ?>
        
        <form action="<?= base_url ?>paa/realizarMovimiento&iddpa=<?= $iddpa ?>" method="POST">
            <div class="row">
                <!-- Tipo de Movimiento -->
                <div class="form-group col-md-6 offset-md-3">
                    <label for="tipoMovimiento" class="font-weight-bold">Tipo de Movimiento:</label>
                    <select name="tipoMovimiento" id="tipoMovimiento" class="form-control form-control-sm" style="padding: 0px 5px;" required>
                        <option value="" disabled selected>Seleccione un tipo de movimiento</option>
                        <option value="1">Reducción</option>
                        <option value="2">Suspensión</option>
                        <option value="3">Adición</option>
                    </select>
                </div>

                <!-- Monto -->
                <div class="form-group col-md-6 offset-md-3">
                    <label for="monto" class="font-weight-bold">Monto:</label>
                    <input type="number" name="monto" id="monto" class="form-control form-control-sm" placeholder="Ingrese el monto" required>
                </div>

                <!-- Botones -->
                <div class="form-group col-md-6 offset-md-3 text-center">
                    <button type="submit" class="btn btn-custom">
                        <i class="fas fa-paper-plane"></i> Enviar
                    </button>
                    <a href="<?= base_url ?>paa/index" class="btn btn-secondary ml-2">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Mensaje de inicio
        console.log("La vista 'Realizar Movimiento' se ha cargado.");

        // Oculta la alerta después de 5 segundos
        const alertElement = document.querySelector('.alert');
        if (alertElement) {
            setTimeout(() => {
                alertElement.style.display = 'none';
            }, 5000);
        }
    </script>
    
</body>
</html>

