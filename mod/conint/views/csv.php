<?php
session_start();
require_once '../../../config/db.php';
include '../models/plamej.php';
// include '../models/plamejpdf.php';

// Instancia de la clase Plamej
$plamej = new Plamej();

$fil1 = isset($_GET['fil1']) ? $_GET['fil1'] : false;
$fil2 = isset($_GET['fil2']) ? $_GET['fil2'] : false;
$fil3 = isset($_GET['fil3']) ? $_GET['fil3'] : false;
$valid = isset($_GET['valid']) ? intval($_GET['valid']) : 3051;

if($fil1 && $fil2){
	$plamej->setFil1($fil1);
	$plamej->setFil2($fil2);
}
if($fil3){
	$plamej->setFil3($fil3);
}

date_default_timezone_set('America/Bogota');
$fecha = date("Ymdhis");

// Llamar a la función getCSV para obtener los datos
$data = $plamej->getCSV($valid);

// Verificar si se obtuvieron datos
if (!empty($data)) {
    // Nombre del archivo CSV
    $filename = "Planes_$fecha.csv";

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename="' . $filename . '"');

    // Abrir la salida estándar como archivo (para descargar el CSV)
    $output = fopen('php://output', 'w');

    // Escribir la fila de cabecera
    $header = array_keys($data[0]);
    fputcsv($output, $header);

    // Escribir los datos
    foreach ($data as $row) {
        fputcsv($output, $row);
    }

    // Cerrar el archivo
    fclose($output);
    exit();
} else {
    // Manejar el caso cuando no se obtienen datos
    echo "No data found.";
}
?>