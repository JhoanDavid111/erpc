<?php
include '../models/modpdf.php';

function generateRandomValue($min = 1000, $max = 100000) {
    return rand($min, $max);
}

function calculateValues($apropiacionInicial, $modificacionesAcumulado, $suspension, $cdpAcumulado, $compromisosAcumulados, $girosAcumuladosPresupuesto) {
    $apropiacionVigente = $apropiacionInicial + $modificacionesAcumulado;
    $apropiacionDisponible = $apropiacionVigente - $suspension;
    $saldoApropiacionDisponible = $apropiacionDisponible - $cdpAcumulado;
    $saldoCDPPorComprometer = $cdpAcumulado - $compromisosAcumulados;
    $ejePresupuestal = ($apropiacionDisponible != 0) ? ($compromisosAcumulados / $apropiacionDisponible) * 100 : 0;
    $saldoPorPagar = $compromisosAcumulados - $girosAcumuladosPresupuesto;
    $porcentajeEjecucionGiro = ($apropiacionDisponible != 0) ? ($girosAcumuladosPresupuesto / $apropiacionDisponible) * 100 : 0;

    return [
        'apropiacionVigente' => $apropiacionVigente,
        'apropiacionDisponible' => $apropiacionDisponible,
        'saldoApropiacionDisponible' => $saldoApropiacionDisponible,
        'saldoCDPPorComprometer' => $saldoCDPPorComprometer,
        'ejePresupuestal' => $ejePresupuestal,
        'saldoPorPagar' => $saldoPorPagar,
        'porcentajeEjecucionGiro' => $porcentajeEjecucionGiro
    ];
}

$pfinan = new Pfinan();
$vig = $pfinan->vigact();
$dat = $pfinan->getAllPre();


$noar = 'Reporte Presupuesto ' . date("Ymd");

header('Content-Type: application/vnd.ms-excel');
header("Content-Type: application/vnd.ms-excel; charset=UTF-16LE");
header('Content-Disposition: attachment; filename="' . $noar . '.csv"');

$html = "Código;Nombre;Apropiación Inicial;Modificaciones Mes;Modificaciones Acumulado;Apropiación Vigente;Suspensión;Apropiación Disponible;CDP Mes;CDP Acumulado;Saldo Apropiación Disponible;Compromisos Mes;Compromisos Acumulados;Saldo CDP por Comprometer;Eje Presupuestal %;Giro Mes Presupuestal;Giros Acumulados Presupuesto;Saldo por Pagar;Porcentaje Ej. Giro";
$html .= "\n";

function excelDateToPHPDate($excelDate) {
    // La fecha base de Excel (1 de enero de 1900) en formato Unix timestamp
    $unixDate = ($excelDate - 25569) * 86400;
    return date('Y-m-d', $unixDate);
}

foreach ($dat as $dt) {
    $codigo = "'" . $vig[0]['ninipaa'] . $dt['codrub'] . ";";
    $datasi = $pfinan->getAllPreAsi($dt['codrub']);
    if (!empty($datasi) && isset($datasi[0])) {
        $nombre = trim($datasi[0]['nobjeto']) . ";";
        $apropiacionInicial = $datasi[0]['asidpa'];
    } else {
        $nombre = "Objeto no encontrado;";
        $apropiacionInicial = 0;
    }
    $modificacionesMes = 0; 
    $modificacionesAcumulado = 0;
    $suspension = 0;

    // Convertir la fecha de Excel a fecha PHP
    $fecentDate = excelDateToPHPDate($dt['fecent']);

    // Obtener el mes actual
    $currentMonth = date('m');

    $fecentMonth = date('m', strtotime($fecentDate));

    if ($fecentMonth == $currentMonth) {
        $cdpMes = $dt['valcdp'];
        $compromisosMes = $dt['valrp'];
    } else {
        $cdpMes = 0; 
        $compromisosMes = 0;
    }

    $cdpAcumulado = $dt['total_valcdp'];
    $compromisosAcumulados = $dt['total_valrp'];
    $giroMesPresupuestal = 0;
    $girosAcumuladosPresupuesto = $dt['total_autgir'];

    $calculatedValues = calculateValues(
        $apropiacionInicial,
        $modificacionesAcumulado,
        $suspension,
        $cdpAcumulado,
        $compromisosAcumulados,
        $girosAcumuladosPresupuesto
    );

    $html .= "$codigo";
    $html .= "$nombre";
    $html .= number_format($apropiacionInicial, 0, ',', '.') . ";";
    $html .= number_format($modificacionesMes, 0, ',', '.') . ";";
    $html .= number_format($modificacionesAcumulado, 0, ',', '.') . ";";
    $html .= number_format($calculatedValues['apropiacionVigente'], 0, ',', '.') . ";";
    $html .= number_format($suspension, 0, ',', '.') . ";";
    $html .= number_format($calculatedValues['apropiacionDisponible'], 0, ',', '.') . ";";
    $html .= number_format($cdpMes, 0, ',', '.') . ";";
    $html .= number_format($cdpAcumulado, 0, ',', '.').";";
    $html .= number_format($calculatedValues['saldoApropiacionDisponible'], 0, ',', '.') . ";";
    $html .= number_format($compromisosMes, 0, ',', '.') . ";";
    $html .= number_format($compromisosAcumulados, 0, ',', '.') . ";";
    $html .= number_format($calculatedValues['saldoCDPPorComprometer'], 0, ',', '.') . ";";
    $html .= number_format($calculatedValues['ejePresupuestal'], 2, ',', '.') . ";";
    $html .= number_format($giroMesPresupuestal, 0, ',', '.') . ";";
    $html .= number_format($girosAcumuladosPresupuesto, 0, ',', '.') . ";";
    $html .= number_format($calculatedValues['saldoPorPagar'], 0, ',', '.') . ";";
    $html .= number_format($calculatedValues['porcentajeEjecucionGiro'], 2, ',', '.') . "%;";
    $html .= "\n";
}

echo mb_convert_encoding($html, 'UTF-16LE', 'UTF-8');
?>
