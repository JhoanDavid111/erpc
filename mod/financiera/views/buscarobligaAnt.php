<?php

require_once '../../../config/db.php';

$nodocemp = $_POST['documento'];
$oblicargo = $_POST['oblicargo'];
session_start();
$area = $_SESSION['depid'];
// var_dump($area);
// die();

$modelo = new conexion();
$conexion = $modelo->get_conexion();
//$sql = "SELECT * FROM obligacon WHERE perid = :nodocemp AND cargo = :oblicargo  AND area = :area ";
$sql = " SELECT * FROM obligacon WHERE perid = :nodocemp AND cargo = :oblicargo AND area = :area AND iddpa = (SELECT MAX(iddpa) FROM obligacon WHERE perid = :nodocemp AND cargo = :oblicargo AND area = :area) ";
$result = $conexion->prepare($sql);
$result->bindParam(":nodocemp", $nodocemp);
$result->bindParam(":oblicargo", $oblicargo);
$result->bindParam(":area", $area);
$result->execute();

$resultado = $result->fetchAll(PDO::FETCH_ASSOC);

if (!empty($resultado)) {
    echo json_encode($resultado);
} else {
    // Si no hay resultados
    echo json_encode([]);
}
