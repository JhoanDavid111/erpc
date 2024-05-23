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

//echo "'".$areas."','".$ntipo."','".$idflu."'<br>";

//if($areSel) $areas = $areSel;
if($ntipo AND !$ntipoT){
	$dat = $pfinan->getAll3($areas,$ntipo,$idflu);
}else{
	$dat = $pfinan->getAll2($areas,$ntipoT);
}

if($ntipo==3) $noar = 'CDP';
else if($ntipo==4) $noar = 'RP';
else $noar = 'PAA';

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
		$html .= "PLAN";
		$html .= "<BR>";
		$html .= "ANUAL DE";
		$html .= "<BR>";
		$html .= "ADQUISICIONES";
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
		$html .= "<th>Unspsc</th>";
		$html .= "<th>Objeto</th>";
		$html .= "<th>Código</th>";
		$html .= "<th>Rubro</th>";
		$html .= "<th>Meta</th>";
		$html .= "<th>Resolución</th>";
		$html .= "<th>Compromiso</th>";
		$html .= "<th>Contratista</th>";
		$html .= "<th>Asignación</th>";
		$html .= "<th>Comprometido</th>";
		$html .= "<th>Modalidad</th>";
		$html .= "<th>Fuente Financiación</th>";
		$html .= "<th>Cod Fuente</th>";
		$html .= "<th>Resolución FUTIC</th>";
		$html .= "<th>Fec Ini</th>";
		$html .= "<th>Fec Fin</th>";
		$html .= "<th>Área</th>";
		$html .= "<th>Unidad</th>";
		$html .= "<th>Ubicación</th>";
		$html .= "<th>Responsable</th>";
		$html .= "<th>Teléfono</th>";
		$html .= "<th>Email</th>";
		$html .= "<th>Ordenador de Gasto</th>";
		$html .= "<th>Proceso</th>";
		$html .= "<th>Estado</th>";
		$html .= "<th>Codrub2</th>";
		$html .= "<th>No. Exp. CDP</th>";
		$html .= "<th>No. RP</th>";
		$html .= "<th>No. Bogdata</th>";
		$html .= "<th>No. CPC</th>";
		$html .= "<th>Estado Financiero</th>";
		$html .= "<th>Iddpa</th>";
		$html .= "<th>No.</th>";
	$html .= "</tr>";
	$i=1;
	foreach ($dat as $dt) {
		$html .= "<tr>";
			$html .= "<td>";
				$html .= $dt['unspsc'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['nobjeto'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $vig[0]['ninipaa'].$dt['codrub'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['nomrub'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['meta'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['resolu'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['comp'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['nomcont'];
			$html .= "</td>";
			$html .= "<td style='text-align: right;'>";
				$html .= "$ ".number_format($dt['asidpa'], 0, ',', '.');
			$html .= "</td>";
			$html .= "<td style='text-align: right;'>";
				$html .= "$ ".number_format($dt['prrp'], 0, ',', '.');
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['tco'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['fte'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['ftefindpa'];
			$html .= "</td>";
			$html .= "<td>";
				$resol = $pfinan->resol($dt['iddpa']);
				if($resol && $dt['ftefindpa']==653){
					for ($r=0;$r<count($resol);$r++) {
						$html .= $resol[$r]['resl'];
						if($r<count($resol)-1) $html .= "  ";
					}
				}
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['fecinidpa'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['fecfindpa'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['are'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['unidad'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['ubicacion'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['rspn'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['pertel'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['peremail'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['ordg'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['nompro'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['actflu'];
			$html .= "</td>";
			$html .= "<td>";
				if($dt['codrub2']) $html .= $vig[0]['ninipaa'].$dt['codrub'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['nexpcdp'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['nrp'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['nbogdata'];
			$html .= "</td>";
/*			$html .= "<td>";
				$html .= $dt['compro'];
			$html .= "</td>";*/
			$html .= "<td>";
				$html .= $dt['cpc'];
			$html .= "</td>";
			$html .= "<td>";
				$html .= $dt['estfin'];
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