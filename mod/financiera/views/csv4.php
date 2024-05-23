<?php
include'../models/modpdf.php';
// ini_set('memory_limit', '512M');
// require_once '../../../dompdf/autoload.inc.php';
// use Dompdf\Dompdf;


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
$ntipoT = isset($_POST["ntipoT"]) ? $_POST["ntipoT"]:NULL;
$ntipo = isset($_POST["ntipo"]) ? $_POST["ntipo"]:NULL;
$idflu = isset($_POST["idflu"]) ? $_POST["idflu"]:NULL;

if($tot==1012) $depid = 1012;
if($areSel) $depid = $areSel;
$areas = dparea($depid);
$areas = $depid.",".$areas;
$areas = substr($areas,0,strlen($areas)-1);

$pfinan = new Pfinan();
$vig = $pfinan->vigact();

$pfinan->setIdpaa($vig[0]['idpaa']);

$dat = $pfinan->getAllPresu($areas);
$noar = 'Presupuesto';

$sumasi = 0;
$sumdis = 0;
$sumcdp = 0;
$sumrp = 0;

if($areSel) $noar .= ' Area';
else $noar .= ' Total';

date_default_timezone_set('America/Bogota');
$fecha2 = date("Ymd");

$noar .= " ".$fecha2;

	//generamos el contenido del archivo
	header('Content-Type: application/vnd.ms-excel');
	header("Content-Type: application/vnd.ms-excel; charset=UTF-16LE");
	header('Content-Disposition: attachment; filename="Reporte '.$noar.'.csv"');



	$html = "Código;Fondo;Objeto;Asignacion;CDP's;RP's;Disponible;Iddpa;No.;";
	$html .= "\n";
	$i=1;
	foreach ($dat as $dt) {				
		$html .= "'".$vig[0]['ninipaa'].$dt['codrub'].";";
		$html .= $dt['fondo'].";";
		$html .= $dt['nobjeto'].";";
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
		$html .= number_format($dt['asidpa'], 0, ',', '.').";";
		$html .= number_format($cdp, 0, ',', '.').";";
		$html .= number_format($rp, 0, ',', '.').";";
		$html .= number_format($dispo, 0, ',', '.').";";
		$html .= $dt['iddpa'].";";
		$html .= $i.";";
		$html .= "\n";
		$i++;
	}

 	//echo $html;
 	echo mb_convert_encoding($html, 'UTF-16LE', 'UTF-8');

?>