<?php
include 'models/plamej.php';

class reparepmjController {
    public function index() {
        Utils::useraccess('reparepmj/index', $_SESSION['pefid']);
        $plamej = new Plamej();
        date_default_timezone_set('America/Bogota');
        $ano = isset($_POST['ano']) ? $_POST['ano'] : date("Y");
        $mes = date('n');

        $areas = $plamej->getAllVal(1);
        $anos = $plamej->getAno();

        $toms = array_fill(0, 14, 0); // Inicializa el array con 14 ceros
        require_once 'views/reparepmj.php';
    }
}
?>

