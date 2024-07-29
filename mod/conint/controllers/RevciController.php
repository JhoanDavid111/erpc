<?php

include 'models/plamej.php';

class RevciController {
    public function index() {
        if ($_POST) {
            $categoria = $_POST['categoria'];
            $fechaci = $_POST['fechaci'];

            if ($categoria == 'mejora') {
                $valid = 3051;
            } elseif ($categoria == 'institucional') {
                $valid = 1111;
            } else {
                $_SESSION['error'] = "Categoría de plan no válida.";
                header("Location: " . base_url . 'views/reviewci');
                return;
            }

            $plamej = new Plamej();
            $plamej->setFechaci($fechaci);
            $plamej->setValid($valid);

            $save = $plamej->saveReviewPlan($valid, $fechaci);

            if ($save) {
                $_SESSION['register'] = "complete";
                $_SESSION['message'] = "La fecha $fechaci ha sido cargada al plan de tipo $categoria.";
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



