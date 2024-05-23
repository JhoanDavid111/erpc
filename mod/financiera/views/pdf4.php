<?php
session_start();
include'../../../helpers/utils.php';
include'../../../config/db.php';
$ids =isset($_SESSION['pefid']) ? $_SESSION['pefid']:NULL;
Utils::useraccess('paa/index',$ids,"Exter");


include'../models/modpdf.php';
ini_set('memory_limit', '4096M');
require_once '../../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;


function dparea($depid){
	$txt = '';
	$pfinan = new Pfinan();
	$area = $pfinan->deparea($depid);
	foreach($area AS $ar){
			$txt .= $ar['valid'].",";
			$txt .= dparea($ar['valid']);
	}
	return $txt;
}

$depid = isset($_POST["depid"]) ? $_POST["depid"]:NULL;
$tot = isset($_POST['tot']) ? $_POST['tot']:NULL;
$areSel = isset($_POST["areSel"]) ? $_POST["areSel"]:NULL;
$ntipo = isset($_POST["ntipo"]) ? $_POST["ntipo"]:NULL;
$ntipoT = isset($_POST["ntipoT"]) ? $_POST["ntipoT"]:NULL;
$idflu = isset($_POST["idflu"]) ? $_POST["idflu"]:NULL;

if($tot==1012) $depid = 1012;
if($areSel) $depid = $areSel;
$areas = dparea($depid);
$areas = $depid.",".$areas;
$areas = substr($areas,0,strlen($areas)-1);

$pdf = isset($_POST['pdf']) ? $_POST['pdf']:NULL;
$pfinan = new Pfinan();
$vig = $pfinan->vigact();
$pfinan->setIdpaa($vig[0]['idpaa']);

$dat = $pfinan->getAllPresu($areas);

$sumasi = 0;
$sumdis = 0;
$sumcdp = 0;
$sumrp = 0;

$noar = 'Presupuesto';

if($areSel) $noar .= ' Area';
else $noar .= ' Total';

// var_dump($dat);
// die();

date_default_timezone_set('America/Bogota');
$dia = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
$mes = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
$fecha = date("d")." de ".$mes[date("m")-1]." de ".date("Y");
$fecha2 = date("Ymd");
$anchohoja = 750;

$html = "<head>";
	$html .="<style type='text/css'>";
		$html .="@font-face{";
		    $html .="font-family: Arial;";
		    $html .="font-style: normal;";
		    $html .="font-weight: 100;";
		    $html .="src: url(../../../fonts/arial.ttf);";
		$html .="}";
		$html .="@font-face{";
		    $html .="font-family: Arial;";
		    $html .="font-style: bold;";
		    $html .="font-weight: bold;";
		    $html .="src: url(../../../fonts/arialbd.ttf);";
		$html .="}";
		$html .="html {";
			$html .="margin: 0;";
		$html .="}";
		$html .="body {";
			$html .="font-family: 'Arial';";
			$html .="margin: 10mm 10mm 10mm 10mm;";
		$html .="}";
		$html .="th {";
			$html .="font-family: 'Arial';";
			$html .="font-size: 11px;";
			$html .="font-weight: bold;";
			$html .="color: #000000;";
			$html .="background-color: #d8d8d7;";
		$html .="}";
		$html .="td, strong, td strong {";
			$html .="font-family: 'Arial';";
			$html .="font-size: 11px;";
			$html .="color: #000000;";
		$html .="}";
		$html .=".neg {";
			$html .="font-weight: bold;";
			$html .="font-family: 'Arial';";
		$html .="}";
	$html .="</style>";
$html .="</head>";
$html .="<body>";
$html .="<div align='left' style='float: left;'>";
$html .= "<table width='".$anchohoja."px' border='1' cellpadding='3px' cellspacing='0'>";
$html .= "<tr>";
	$html .= "<td rowspan='4' style='text-align: center;'><img src='../../../img/logocanal.png'></td>";
	$html .= "<td rowspan='4' align='center' class='neg'>";
		$html .= "";
		$html .= "<BR>";
		$html .= "PRESUPUESTO";
		$html .= "<BR>";
		$html .= "";
	$html .= "</td>";
	$html .= "<td><strong>";
		$html .= "C&Oacute;DIGO: ";
	$html .= "</strong></td>";
	$html .= "<td rowspan='4' style='text-align: center;'><img src='../../../img/logomejor.png'></td>";
	$html .= "</tr>";
	$html .= "<tr><td><strong>VERSI&Oacute;N: ";
		$html .= "1";
	$html .= "</strong></td></tr>";
	$html .= "<tr><td><strong>FECHA DE GENERACI&Oacute;N: ";
		$html .= $fecha;
	$html .= "</strong></td></tr>";
	$html .= "<tr><td><strong>RESPONSABLE: ";
		$html .= "FINANCIERA";
	$html .= "</strong></td></tr>";
$html .= "</tr>";
$html .= "</table>";

$html .= "<br>";

$html .= "<table width='".$anchohoja."px' border='1' cellpadding='3px' cellspacing='0'>";
	$html .= "<tr>";
		$html .= "<th>Código</th>";
		$html .= "<th>Objeto</th>";
		$html .= "<th>Asignación</th>";
		$html .= "<th>CDP</th>";
		$html .= "<th>RP</th>";
		$html .= "<th>Disponible</th>";
		$html .= "<th>Iddpa</th>";
		$html .= "<th>No.</th>";
	$html .= "</tr>";
	$i=1;
	foreach ($dat as $dt) {
		$html .= "<tr>";
			$html .= "<td>";
				$html .= $vig[0]['ninipaa'].$dt['codrub'];
				$html .= "<br>";
				$html .= "<small><strong>Fondo: </strong>";
					$html .= $dt['fondo'];
				$html .= "</small>";
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['nobjeto'];
			$html .= "</td>";
			$html .= "<td style='text-align: right;'>";
				$html .= "$ ".number_format($dt['asidpa'], 0, ',', '.');
				$dtcdp = $pfinan->sumPr("2,3",$dt['codrub']);
				$dtrp = $pfinan->sumPrC("4",$dt['codrub']);
				$cdp= isset($dtcdp[0]['cdp']) ? $dtcdp[0]['cdp']:0;
				$rp= isset($dtrp[0]['cdp']) ? $dtrp[0]['cdp']:0;
				if($dt['fondo']=="3-100-F002")
					$dispo = ($dt['asidpa']-$cdp);
				else
					$dispo = 0;
				$sumasi += $dt['asidpa'];
				$sumdis += $dispo;
				$sumcdp += $cdp;
				$sumrp += $rp;
			$html .= "</td>";
			$html .= "<td style='text-align: right;'>";
				$html .= "$ ".number_format($cdp, 0, ',', '.');
			$html .= "</td>";
			$html .= "<td style='text-align: right;'>";
				$html .= "$ ".number_format($rp, 0, ',', '.');
				$html .= "<br><small>";
				$html .= "<strong>Diferencia (CP-RP): </strong>";
				$html .= "$ ".number_format(($cdp-$rp), 0, ',', '.');
				$html .= "</small>";
			$html .= "</td>";
			$html .= "<td style='text-align: right;'>";
				$html .= "$ ".number_format($dispo, 0, ',', '.');
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['iddpa'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $i;
			$html .= "</td>";
		$html .= "</tr>";
		$i++;
	}
$html .="</table>";

$html .="</div>";
$html .= "</body>";
//echo $html;
if($pdf==1547){
	//echo $html;
	$dompdf = new DOMPDF();
	$paper_size = array(0,0,612,792);
	
	$dompdf->loadHtml($html); 
	$dompdf->setPaper($paper_size);
	$dompdf->render(); 
	$dompdf->stream("Reporte ".$noar." ".$fecha2.".pdf");
}else{
	echo $html;
	echo "<script type='text/javascript'>window.print();</script>";
}
?>