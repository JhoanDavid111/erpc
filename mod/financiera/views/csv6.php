<?php
require_once 'C:/xampp/htdocs/erpc/vendor/autoload.php';
include '../models/modpdf.php';
include '../models/traslado.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Crear un nuevo documento de Excel
$spreadsheet = new Spreadsheet();

try {
    // Primera pestaña - Presupuesto
    $sheet1 = $spreadsheet->getActiveSheet();
    $sheet1->setTitle('Presupuesto');

    // Definir encabezados de la primera hoja (Presupuesto)
    $headers = [
        'Código', 'Nombre', 'Apropiación Inicial', 'Modificaciones Mes',
        'Modificaciones Acumulado', 'Apropiación Vigente', 'Suspensión',
        'Apropiación Disponible', 'CDP Mes', 'CDP Acumulado',
        'Saldo Apropiación Disponible', 'Compromisos Mes', 
        'Compromisos Acumulados', 'Saldo CDP por Comprometer',
        'Eje Presupuestal %', 'Giro Mes Presupuestal', 
        'Giros Acumulados Presupuesto', 'Saldo por Pagar', 
        'Porcentaje Ej. Giro'
    ];

    foreach ($headers as $index => $header) {
        $sheet1->setCellValue(chr(65 + $index) . '1', $header); // A1, B1, C1, ...
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

    // Obtener datos del modelo de presupuesto
    $modpdf = new Modpdf();
    $vig = $modpdf->vigact();
    $dat = $modpdf->getAllPre();

    function excelDateToPHPDate($excelDate) {
        $unixDate = ($excelDate - 25569) * 86400;
        return date('Y-m-d', $unixDate);
    }

    $row = 2;
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

        // Obtén los valores CDP y compromisos
        $fecentDate = excelDateToPHPDate($dt['fecent']);
        $currentMonth = date('m');
        $fecentMonth = date('m', strtotime($fecentDate));

        $cdpMes = ($fecentMonth == $currentMonth) ? $dt['valcdp'] : 0;
        $compromisosMes = ($fecentMonth == $currentMonth) ? $dt['valrp'] : 0;

        $cdpAcumulado = $dt['total_valcdp'];
        $compromisosAcumulados = $dt['total_valrp'];
        $giroMesPresupuestal = 0;
        $girosAcumuladosPresupuesto = $dt['total_autgir'];

        // Llama a la función para calcular los valores
        $calculatedValues = calculateValues(
            $apropiacionInicial,
            $modificacionesAcumulado,
            $suspension,
            $cdpAcumulado,
            $compromisosAcumulados,
            $girosAcumuladosPresupuesto
        );

        // Asignar valores a las celdas
        $sheet1->setCellValue('A' . $row, $codigo);
        $sheet1->setCellValue('B' . $row, $nombre);
        $sheet1->setCellValue('C' . $row, number_format($apropiacionInicial, 0, ',', '.'));
        $sheet1->setCellValue('D' . $row, number_format($modificacionesMes, 0, ',', '.'));
        $sheet1->setCellValue('E' . $row, number_format($modificacionesAcumulado, 0, ',', '.'));
        $sheet1->setCellValue('F' . $row, number_format($calculatedValues['apropiacionVigente'], 0, ',', '.'));
        $sheet1->setCellValue('G' . $row, number_format($suspension, 0, ',', '.'));
        $sheet1->setCellValue('H' . $row, number_format($calculatedValues['apropiacionDisponible'], 0, ',', '.'));
        $sheet1->setCellValue('I' . $row, number_format($cdpMes, 0, ',', '.'));
        $sheet1->setCellValue('J' . $row, number_format($cdpAcumulado, 0, ',', '.'));
        $sheet1->setCellValue('K' . $row, number_format($calculatedValues['saldoApropiacionDisponible'], 0, ',', '.'));
        $sheet1->setCellValue('L' . $row, number_format($compromisosMes, 0, ',', '.'));
        $sheet1->setCellValue('M' . $row, number_format($compromisosAcumulados, 0, ',', '.'));
        $sheet1->setCellValue('N' . $row, number_format($calculatedValues['saldoCDPPorComprometer'], 0, ',', '.'));
        $sheet1->setCellValue('O' . $row, number_format($calculatedValues['ejePresupuestal'], 2, ',', '.'));
        $sheet1->setCellValue('P' . $row, number_format($giroMesPresupuestal, 0, ',', '.'));
        $sheet1->setCellValue('Q' . $row, number_format($girosAcumuladosPresupuesto, 0, ',', '.'));
        $sheet1->setCellValue('R' . $row, number_format($calculatedValues['saldoPorPagar'], 0, ',', '.'));
        $sheet1->setCellValue('S' . $row, number_format($calculatedValues['porcentajeEjecucionGiro'], 2, ',', '.') . "%");
        $row++; // Incrementar el índice de fila para la siguiente entrada
    }

    // Crear una nueva pestaña para Modificaciones
    $spreadsheet->createSheet();
    $sheet2 = $spreadsheet->setActiveSheetIndex(1);
    $sheet2->setTitle('Modificaciones');

    // Definir encabezados de la segunda hoja (Modificaciones)
    $sheet2Headers = [
        'Id', 'Id Persona', 'Fecha', 'Idpaa', 'Tipo Traslado', 'Id pro', 'Id flujo'
    ];

    foreach ($sheet2Headers as $index => $header) {
        $sheet2->setCellValue(chr(65 + $index) . '1', $header); // A1, B1, C1, ...
    }

    // Obtener datos del modelo de modificaciones
    $traslado = new Traslado();
    $modificaciones = $traslado->getAll();

    $row = 2;
    foreach ($modificaciones as $modificacion) {
        $sheet2->setCellValue('A' . $row, $modificacion['idtrs']);
        $sheet2->setCellValue('B' . $row, $modificacion['perid']);
        $sheet2->setCellValue('C' . $row, $modificacion['fhtrs']);
        $sheet2->setCellValue('D' . $row, $modificacion['iddpa']);
        $sheet2->setCellValue('E' . $row, $modificacion['tptrs']);
        $sheet2->setCellValue('F' . $row, $modificacion['idpro']);
        $sheet2->setCellValue('G' . $row, $modificacion['idflu']);
        $row++;
    }

    // Crear el archivo Excel
    $writer = new Xlsx($spreadsheet);

    try {
        $filename = 'Informe_Presupuesto_' . date('Y-m-d') . '.xlsx';
        $writer->save($filename);
        echo 'El archivo Excel ha sido generado exitosamente: ' . $filename;
    } catch (Exception $e) {
        echo 'Error al guardar el archivo Excel: ' . $e->getMessage();
    }

} catch (Exception $e) {
    echo 'Error en la generación del archivo Excel: ' . $e->getMessage();
}
?>
