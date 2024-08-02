<?php

include 'models/plamej.php';

class RevciController {
    public function index() {
        if ($_POST) {
            $categoria = $_POST['categoria'];
            $fechas_inicio = $_POST['fecha_inicio'];
            $fechas_fin = $_POST['fecha_fin'];

            if ($categoria == 'mejora') {
                $valid = 3051;
            } elseif ($categoria == 'institucional') {
                $valid = 1111;
            } else {
                $_SESSION['error'] = "Categoría de plan no válida.";
                header("Location: " . base_url . 'views/reviewci');
                return;
            }

            $rangosFechas = [];
            for ($i = 0; $i < count($fechas_inicio); $i++) {
                $rangosFechas[] = [
                    'fecha_inicio' => $fechas_inicio[$i],
                    'fecha_fin' => $fechas_fin[$i]
                ];
            }

            $plamej = new Plamej();
            $save = $plamej->saveDatesCi($valid, $rangosFechas);

            if ($save) {
                $_SESSION['register'] = "complete";
                $_SESSION['message'] = "Los rangos de fechas han sido cargados al plan de tipo $categoria.";
            } else {
                $_SESSION['register'] = "failed";
            }

            require_once 'views/reviewci.php';
        } else {
            $_SESSION['register'] = "failed";
            require_once 'views/reviewci.php';
        }
    }
}

?>



