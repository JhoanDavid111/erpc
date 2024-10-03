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

    // Agregar la marca BOM para UTF-8
    echo "\xEF\xBB\xBF";

    // Abrir la salida estándar como archivo (para descargar el CSV)
    $output = fopen('php://output', 'w');

    // Definir los nombres de las columnas en el orden correcto
    $renamedHeader = [
        'Número del plan',
        'Fuente de observación',
        'Fecha de solicitud',
        'Detalle de la fuente',
        'Código o capítulo',
        'Observación',
        'Área',
        'Causa de la acción',
        'Acción',
        'Tipo de acción propuesta',
        'Indicador',
        'Alcance de la meta',
        'Fecha inicio',
        'Fecha terminación',
        'Cargo del líder',
        'Área responsable',
        'Fecha de seguimiento',
        'Soportes de ejecución',
        'Análisis de seguimiento',
        'Porcentaje de ejecución',
        'Alerta',
        'Auditor que realiza el seguimiento',
        'Porcentaje plan',
        'Estado plan',
        'Comentario cierre',
        'Fecha cierre plan',
        'Cierre de la observación',
    ];

    // Escribir la fila de cabecera con los nuevos nombres
    fputcsv($output, $renamedHeader, ';');  // Usar ';' como delimitador

    // Escribir los datos en el orden correcto usando las llaves proporcionadas
    foreach ($data as $row) {
        // Formatear las fechas para que se muestren solo con el formato Y-m-d
        $fsolpla = isset($row['fsolpla']) ? date('Y-m-d', strtotime($row['fsolpla'])) : '';
        $feciepla = isset($row['feciepla']) ? date('Y-m-d', strtotime($row['feciepla'])) : '';
        $finimej = isset($row['finimej']) ? date('Y-m-d', strtotime($row['finimej'])) : '';
        $ffinmej = isset($row['ffinmej']) ? date('Y-m-d', strtotime($row['ffinmej'])) : '';
        $fecseg = isset($row['fecseg']) ? date('Y-m-d', strtotime($row['fecseg'])) : '';

        // Reconstruir cada fila de acuerdo al orden de las llaves proporcionadas
        $orderedRow = [
            $row['nopla'] ?? '',       // Numero del plan
            isset($row['fuepla']) ? $plamej->getValNomById($row['fuepla']) : '',      // Fuente de observacion
            $fsolpla,                  // Fecha de solicitud formateada
            $row['detfue'] ?? '',      // Detalle de la fuente
            $row['cappla'] ?? '',      // Codigo o capitulo
            $row['obspla'] ?? '',      // Observacion plan
            isset($row['areapla']) ? $plamej->getValNomById($row['areapla']) : '',     // Area
            $row['caumej'] ?? '',      // Causa de la accion
            $row['accmej'] ?? '',      // Nombre de actividad
            isset($row['tapmej']) ? $plamej->getValNomById($row['tapmej']) : '',  // Tipo de accion propuesta
            $row['foract'] ?? '',      // Indicador
            $row['alcmej'] ?? '',      // Alcance de la meta
            $finimej,                  // Fecha inicio de la accion formateada
            $ffinmej,                  // Fecha final de la accion formateada
            isset($row['carlmej']) ? $plamej->getValNomById($row['carlmej']) : '',  // Cargo del líder
            isset($row['carrmej']) ? $plamej->getValNomById($row['carrmej']) : '',  // Cargo del responsable
            $fecseg,                   // Fecha de seguimiento formateada
            $row['comava'] ?? '',      // Comentario actividad
            $row['anaseg'] ?? '',      // Analisis de seguimiento
            isset($row['ejesep']) ? $row['ejesep'] . '%' : '',      // Porcentaje de ejecucion
            isset($row['aleseg']) ? $plamej->getValNomById($row['aleseg']) : '',  // Tipo de alerta seguimiento
            isset($row['audseg']) ? $plamej->getNomPer($row['audseg']) : '',  // Auditoria seguimiento
            isset($row['porpla']) ? $row['porpla'] . '%' : '',      // Porcentaje plan
            isset($row['estpla']) ? $plamej->getValNomById($row['estpla']) : '',  // Estado plan
            $row['acpla'] ?? '',       // Comentario cierre
            $feciepla,                 // Fecha cierre plan formateada
            isset($row['actpla']) ? ($row['actpla'] == 1 ? 'Abierta' : 'Cerrada') : '',  // Activo o inactivo
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






