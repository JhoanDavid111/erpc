<?php
include 'models/plamej.php';

class reparepmjController {
    public function index() {
        Utils::useraccess('reparepmj/index', $_SESSION['pefid']);
        $plamej = new Plamej();
        date_default_timezone_set('America/Bogota');
        $ano = isset($_POST['ano']) ? $_POST['ano'] : date("Y");
        $mes = date('n');

        echo "<script>console.log('Año seleccionado: $ano');</script>";

        $areas = $plamej->getAllVal(1);
        if ($areas === false) {
            echo "<script>console.log('Error al obtener áreas');</script>";
        } else {
            echo "<script>console.log('Áreas obtenidas: " . count($areas) . "');</script>";
        }

        $anos = $plamej->getAno();
        if ($anos === false) {
            echo "<script>console.log('Error al obtener años');</script>";
        } else {
            echo "<script>console.log('Años obtenidos: " . count($anos) . "');</script>";
        }

        $toms = array_fill(0, 14, 0); // Inicializa el array con 14 ceros
        require_once 'views/reparepmj.php';
    }
}
?>

