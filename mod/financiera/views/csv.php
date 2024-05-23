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

//echo "'".$areas."','".$ntipo."','".$idflu."'<br>";

if($ntipo AND !$ntipoT){
	$dat = $pfinan->getAll3($areas,$ntipo,$idflu);
}else{
	$dat = $pfinan->getAll2($areas,$ntipoT);
}

// var_dump($dat);
// die();


if($ntipo==3) $noar = 'CDP';
else if($ntipo==4) $noar = 'RP';
else $noar = 'PAA';

if($areSel) $noar .= ' Area';
else $noar .= ' Total';
// var_dump($dat);
// 		die();
date_default_timezone_set('America/Bogota');
$fecha2 = date("Ymd");

$noar .= " ".$fecha2;

	//generamos el contenido del archivo
	header('Content-Type: application/vnd.ms-excel');
	header("Content-Type: application/vnd.ms-excel; charset=UTF-16LE");
	header('Content-Disposition: attachment; filename="Reporte '.$noar.'.csv"');



	$html = "Unspsc;Objeto;Código;Rubro;Meta;Resolución;Compromiso;Contratista;Asignacion;Comprometido;Modalidad;Cod Modalidad;Fuente Financiación;Cod Fuente;Resolución FUTIC;Fec Ini;Fec Fin;Area;Cod Area;Unidad;Ubicación;Responsable;Teléfono;Email;Ordenador de Gasto;Proceso; Cod Proceso;Estado;Cod Nuevo;No. Exp. CDP;No. RP;No. Bogdata;No. CPC;Estado Financiero;Iddpa;No.;depidd;";
	$html .= "\n";
	$i=1;
	foreach ($dat as $dt) {				
		$html .= $dt['unspsc'].";";
		//$html .= $dt['nobjeto'].";";
		// Aplicamos la sustitución de punto y coma por coma.
		$objeto = preg_replace('/;/', ",", $dt['nobjeto']);
		$html .= $objeto.";";
		$html .= "'".$vig[0]['ninipaa'].$dt['codrub'].";";
		$html .= $dt['nomrub'].";";		
		$html .= $dt['meta'].";";
		$html .= $dt['resolu'].";";
		$html .= $dt['comp'].";";
		$html .= $dt['nomcont'].";";
		$html .= number_format($dt['asidpa'], 0, ',', '.').";";
		$html .= number_format($dt['prrp'], 0, ',', '.').";";
		$html .= $dt['tco'].";";
		$html .= $dt['tipcondpa'].";";
		$html .= $dt['fte'].";";
		$html .= $dt['ftefindpa'].";";
		$resol = $pfinan->resol($dt['iddpa']);
		if($resol && $dt['ftefindpa']==653){
			for ($r=0;$r<count($resol);$r++) {
				$html .= $resol[$r]['resl'];
				if($r<count($resol)-1) $html .= "  ";
			}
		}
		$html .= ";";
		$html .= $dt['fecinidpa'].";";
		$html .= $dt['fecfindpa'].";";
		$html .= $dt['are'].";";
		$html .= $dt['area'].";";
		$html .= $dt['unidad'].";";
		$html .= $dt['ubicacion'].";";
		$html .= $dt['rspn'].";";
		$html .= $dt['celres'].";";
		$html .= $dt['mailres'].";";
		$html .= $dt['ordg'].";";		
		$html .= $dt['nompro'].";";
		$html .= $dt['idpro'].";";
		$html .= $dt['actflu'].";";
		if($dt['codrub2']) $html .= "'".$vig[0]['ninipaa'].$dt['codrub2'];
		$html .= ";";
		$html .= $dt['nexpcdp'].";";
		$html .= $dt['nrp'].";";
		$html .= $dt['nbogdata'].";";
		//$html .= $dt['compro'].";";
		$html .= $dt['cpc'].";";
		$html .= $dt['estfin'].";";
		$html .= $dt['iddpa'].";";
		$html .= $i.";";
		$html .= $dt['depidd'].";";
		$html .= "\n";
		$i++;
	}

 	//echo $html;
 	echo mb_convert_encoding($html, 'UTF-16LE', 'UTF-8');

?>