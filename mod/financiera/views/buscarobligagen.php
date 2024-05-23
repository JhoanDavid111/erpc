<?php

require_once '../../../config/db.php';

$idcargo = $_POST['valid'];

$modelo = new conexion();
$conexion = $modelo->get_conexion();
$sql = "SELECT * FROM obligaciones WHERE depen = :idcargo AND tipo = 2";
$result = $conexion->prepare($sql);
$result->bindParam(":idcargo", $idcargo);
$result->execute();

$resultado = $result->fetchAll(PDO::FETCH_ASSOC);

if (!empty($resultado)) {
    echo json_encode($resultado);
} else {
    // Si no hay resultados
    echo json_encode([]);
}
