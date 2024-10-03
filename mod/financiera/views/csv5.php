<?php
include '../models/modpdf.php';

$rubroSel = isset($_POST['rubroSel']) ? $_POST['rubroSel'] : null;
$nobjetoSel = isset($_POST['nobjetoSel']) ? $_POST['nobjetoSel'] : null;

// Función para generar valores aleatorios
function generateRandomValue($min = 1000, $max = 100000) {
    return rand($min, $max);
}

// Función para calcular los valores de presupuesto
function calculateValues($apropiacionInicial, $modificacionesAcumulado, $suspension, $cdpAcumulado, $compromisosAcumulados, $girosAcumuladosPresupuesto) {
    $apropiacionVigente = $apropiacionInicial + $modificacionesAcumulado;
    $apropiacionDisponible = $apropiacionVigente - $suspension;
    $saldoApropiacionDisponible = $apropiacionDisponible - $cdpAcumulado;
    $saldoCDPPorComprometer = $cdpAcumulado - $compromisosAcumulados;
    $ejePresupuestal = ($apropiacionVigente != 0) ? ($compromisosAcumulados / $apropiacionVigente) * 100 : 0;
    $saldoPorPagar = $compromisosAcumulados - $girosAcumuladosPresupuesto;
    $porcentajeEjecucionGiro = ($apropiacionVigente != 0) ? ($girosAcumuladosPresupuesto / $apropiacionVigente) * 100 : 0;

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

$modpdf = new Modpdf();
$vig = $modpdf->vigact();
$dat = $modpdf->getAllPre($rubroSel, $nobjetoSel);

$noar = 'Reporte Presupuesto ' . date("Ymd");

header('Content-Type: application/vnd.ms-excel');
header("Content-Type: application/vnd.ms-excel; charset=UTF-16LE");
header('Content-Disposition: attachment; filename="' . $noar . '.csv"');

$html = "Código;Nombre;Apropiación Inicial;Modificaciones Mes;Modificaciones Acumulado;Apropiación Vigente;Suspensión;Apropiación Disponible;CDP Mes;CDP Acumulado;Saldo Apropiación Disponible;Compromisos Mes;Compromisos Acumulados;Saldo CDP por Comprometer;Eje Presupuestal %;Giro Mes Presupuestal;Giros Acumulados Presupuesto;Saldo por Pagar;Porcentaje Ej. Giro";
$html .= "\n";

// Función para convertir la fecha de Excel a PHP
function excelDateToPHPDate($excelDate) {
    $unixDate = ($excelDate - 25569) * 86400;
    return date('Y-m-d', $unixDate);
}

// Ciclo para la primera parte del reporte
foreach ($dat as $dt) {
    $codigo = "'" . $vig[0]['ninipaa'] . $dt['codrub'] . ";";
    $datasi = $modpdf->getAllPreAsi($dt['codrub']);
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

    $fecentDate = excelDateToPHPDate($dt['fecent']);
    $currentMonth = date('m');
    $fecentMonth = date('m', strtotime($fecentDate));

    $cdpMes = ($fecentMonth == $currentMonth) ? $dt['valcdp'] : 0;
    $compromisosMes = ($fecentMonth == $currentMonth) ? $dt['valrp'] : 0;

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

