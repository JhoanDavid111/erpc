<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Categoría y Fechas del Plan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            color: #4d3274;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        select, input[type="date"], input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-top: 5px;
        }
        button {
            background-color: #4d3274;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #3a255e;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Seleccionar Categoría de Plan</h2>
        
        <?php
        if (isset($_SESSION['message'])) {
            echo '<div id="alert-message" class="alert alert-success">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>

        <?php $url_action = base_url . "revci/index"; ?>
        <form class="m-tb-40" method="POST" action="<?= htmlspecialchars($url_action); ?>">
            <div class="form-group">
                <label for="categoria">Categoría</label>
                <select id="categoria" name="categoria" required>
                    <option value="">Seleccione una opción</option>
                    <option value="mejora">Plan de Mejora</option>
                    <option value="institucional">Plan Institucional</option>
                </select>
            </div>
            <br>
            <h2 class="mt-4">Seleccionar Rangos de Fechas de Revisión</h2>
            <br>
            <div id="rango-fechas-container">
                <div class="form-group rango-fechas">
                    <label for="fecha_inicio_1">Fecha Inicio 1</label>
                    <input type="date" id="fecha_inicio_1" name="fecha_inicio[]" required>
                    <label for="fecha_fin_1">Fecha Fin 1</label>
                    <input type="date" id="fecha_fin_1" name="fecha_fin[]" required>
                </div>
            </div>
            <button type="button" onclick="agregarRangoFechas()">Agregar Otro Rango de Fechas</button>
            <br><br>
            <button type="submit">Guardar</button>
        </form>
    </div>

    <script>
        let rangoCount = 1;

        function agregarRangoFechas() {
            rangoCount++;
            const container = document.getElementById('rango-fechas-container');
            const newRango = document.createElement('div');
            newRango.classList.add('form-group', 'rango-fechas');
            newRango.innerHTML = `
                <label for="fecha_inicio_${rangoCount}">Fecha Inicio ${rangoCount}</label>
                <input type="date" id="fecha_inicio_${rangoCount}" name="fecha_inicio[]" required>
                <label for="fecha_fin_${rangoCount}">Fecha Fin ${rangoCount}</label>
                <input type="date" id="fecha_fin_${rangoCount}" name="fecha_fin[]" required>
            `;
            container.appendChild(newRango);
        }

        setTimeout(function() {
            var alert = document.getElementById('alert-message');
            if (alert) {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(function() {
                    alert.style.display = "none";
                }, 500);
            }
        }, 5000);
    </script>
</body>
</html>









