<?php
session_start();
require_once '../../../config/db.php';
include '../models/plamej.php';

// Instancia de la clase Plamej
$plamej = new Plamej();

// Obtener los filtros y validación desde los parámetros GET
$fil1 = isset($_GET['fil1']) ? $_GET['fil1'] : false;
$fil2 = isset($_GET['fil2']) ? $_GET['fil2'] : false;
$fil3 = isset($_GET['fil3']) ? $_GET['fil3'] : false;
$valid = isset($_GET['valid']) ? intval($_GET['valid']) : 3051;

// Aplicar filtros si están presentes
if ($fil1 && $fil2) {
    $plamej->setFil1($fil1);
    $plamej->setFil2($fil2);
}
if ($fil3) {
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

    // Establecer el tipo de contenido y el nombre del archivo para la descarga
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment;filename="' . $filename . '"');

    // Abrir la salida estándar como archivo (para descargar el CSV)
    $output = fopen('php://output', 'w');

    // Definir los nombres de las columnas en el orden correcto
    $renamedHeader = [
        'Numero del plan',
        'Fecha de solicitud',
        'Fuente de observacion',
        'Detalle de la fuente',
        'Codigo o capitulo',
        'Observacion plan',
        'Area',
        'Estado plan',
        'Cargo del lider',
        'Activo o inactivo',
        'Porcentaje plan',
        'Comentario cierre',
        'Fecha cierre plan',
        'Causa de la accion',
        'Nombre de actividad',
        'Tipo de accion propuesta',
        'Alcance de la meta',
        'Fecha inicio de la accion',
        'Fecha final de la accion',
        'Cargo del responsable',
        'Indicador',
        'Comentario actividad',
        'Fecha de seguimiento',
        'Analisis de seguimiento',
        'Porcentaje de ejecucion',
        'Tipo de alerta seguimiento',
        'Auditoria seguimiento'
    ];

    // Escribir la fila de cabecera con los nuevos nombres
    fputcsv($output, $renamedHeader, ';');  // Usar ';' como delimitador

    // Escribir los datos en el orden correcto usando las llaves proporcionadas
    foreach ($data as $row) {
        // Reconstruir cada fila de acuerdo al orden de las llaves proporcionadas
        $orderedRow = [
            $row['nopla'] ?? '',       // Numero del plan
            $row['fsolpla'] ?? '',     // Fecha de solicitud
            isset($row['fuepla']) ? $plamej->getValNomById($row['fuepla']) : '',      // Fuente de observacion
            $row['detfue'] ?? '',      // Detalle de la fuente
            $row['cappla'] ?? '',      // Codigo o capitulo
            $row['obspla'] ?? '',      // Observacion plan
            isset($row['areapla']) ? $plamej->getValNomById($row['areapla']) : '',     // Area
            isset($row['estpla']) ? $plamej->getValNomById($row['estpla']) : '',  // Estado plan
            isset($row['carlmej']) ? $plamej->getValNomById($row['carlmej']) : '',  // Cargo del líder
            isset($row['actpla']) ? ($row['actpla'] == 1 ? 'Activo' : 'Inactivo') : '',  // Activo o inactivo
            isset($row['porpla']) ? $row['porpla'] . '%' : '',      // Porcentaje plan
            $row['acpla'] ?? '',       // Comentario cierre
            $row['feciepla'] ?? '',    // Fecha cierre plan
            $row['caumej'] ?? '',      // Causa de la accion
            $row['accmej'] ?? '',      // Nombre de actividad
            isset($row['tapmej']) ? $plamej->getValNomById($row['tapmej']) : '',  // Tipo de accion propuesta
            $row['alcmej'] ?? '',      // Alcance de la meta
            $row['finimej'] ?? '',     // Fecha inicio de la accion
            $row['ffinmej'] ?? '',     // Fecha final de la accion
            isset($row['carrmej']) ? $plamej->getValNomById($row['carrmej']) : '',  // Cargo del responsable
            $row['foract'] ?? '',      // Indicador
            $row['comava'] ?? '',      // Comentario actividad
            $row['fecseg'] ?? '',      // Fecha de seguimiento
            $row['anaseg'] ?? '',      // Analisis de seguimiento
            isset($row['ejesep']) ? $row['ejesep'] . '%' : '',      // Porcentaje de ejecucion
            isset($row['aleseg']) ? $plamej->getValNomById($row['aleseg']) : '',  // Tipo de alerta seguimiento
            isset($row['audseg']) ? $plamej->getNomPer($row['audseg']) : '',  // Auditoria seguimiento
        ];

        // Escribir la fila procesada en el CSV
        fputcsv($output, $orderedRow, ';');  // Usar ';' como delimitador
    }

    // Cerrar el archivo
    fclose($output);
    exit();
} else {
    // Manejar el caso cuando no se obtienen datos
    echo "No data found.";
}
?>





