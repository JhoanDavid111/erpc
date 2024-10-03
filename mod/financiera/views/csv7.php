<?php
include '../models/traslado.php';
include '../models/pfinan.php';
include 'C:/xampp/htdocs/erpc/config/db.php';


if (isset($_POST['iddpa'])) {
    $iddpa = $_POST['iddpa'];
} else {
    echo "<script>alert('No se proporcionó el IDDPA.'); window.history.back();</script>";
    exit;
}

$traslado = new Traslado();
$Pfinan = new Pfinan();
$modificaciones = $traslado->getMovimientosPorIdDpa($iddpa); 

if (empty($modificaciones)) {
    
    echo "<script>alert('No hay registros disponibles para generar el reporte.'); window.history.back();</script>";
    exit;
}


$noar = 'Reporte_modificaciones_' . date("Ymd");


header('Content-Type: application/vnd.ms-excel');
header("Content-Type: application/vnd.ms-excel; charset=UTF-16LE");
header('Content-Disposition: attachment; filename="' . $noar . '.csv"');


$html = "\n"; 
$html .= "Id;Idpaa;Rubro;Persona;Fecha;Tipo Modificación;Monto;Flujo;Proceso\n"; 

foreach ($modificaciones as $modificacion) {
    
    switch ($modificacion['tipoMovimiento']) {
        case 1:
            $tipoMovimiento = "Reducción";
            break;
        case 2:
            $tipoMovimiento = "Suspensión";
            break;
        case 3:
            $tipoMovimiento = "Adición";
            break;
        default:
            $tipoMovimiento = "Desconocido"; // En caso de un valor no esperado
    }

    $montoFormateado = number_format($modificacion['monto'], 2, ',', '.');
    

    $html .= $modificacion['idtrs'] . ";";
    $html .= $modificacion['iddpa'] . ";";
    $html .= '4' . $Pfinan->getRubro($modificacion['iddpa']) . ";";
    $html .= $Pfinan->getPersonName($modificacion['perid']) . ";";
    $html .= date('Y-m-d', strtotime($modificacion['fecha'])) . ";";
    $html .= $tipoMovimiento . ";";  
    $html .= '$' . $montoFormateado . ";"; 
    $html .= $Pfinan->getFlujo($modificacion['idflu']) . ";";
    $html .= $Pfinan->getProceso($modificacion['idpro']) . ";";
    $html .= "\n";
}

// Convertir y enviar el archivo en formato CSV
echo mb_convert_encoding($html, 'UTF-16LE', 'UTF-8');


