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

if($ntipo){
	$dat = $pfinan->getAll3($areas,$ntipo,$idflu);
}else{
	$dat = $pfinan->getAll2($areas);
}

var_dump($dat);
die();


if($ntipo==3) $noar = 'CDP';
else if($ntipo==4) $noar = 'RP';
else $noar = 'PAA';

if($areSel) $noar .= ' Area';
else $noar .= ' Total';

date_default_timezone_set('America/Bogota');
$fecha2 = date("Ymd");

$noar .= " ".$fecha2;

	//generamos el contenido del archivo
	header('Content-Type: application/vnd.ms-excel');
	header("Content-Type: application/vnd.ms-excel; charset=UTF-16LE");
	header('Content-Disposition: attachment; filename="Reporte '.$noar.'.csv"');

// var_dump($dat);
// die();

	$html = "Unspsc;Objeto;Código;Rubro;Meta;Resolución;Compromiso;Contratista;Asignacion;Modalidad;Fuente Financiación;Fec Ini;Fec Fin;Area;Unidad;Ubicación;Responsable;Teléfono;Email;Ordenador de Gasto;Proceso;Estado;Iddpa;No.;";
	$html .= "\n";
	$i=1;
	foreach ($dat as $dt) {
		$html .= $dt['unspsc'].";";
		$html .= $dt['nobjeto'].";";
		$html .= "'".$dt['codrub'].";";
		$html .= $dt['nomrub'].";";		
		$html .= $dt['meta'].";";
		$html .= $dt['resolu'].";";
		$html .= $dt['comp'].";";
		$html .= $dt['nomcont'].";";
		$html .= number_format($dt['asidpa'], 0, ',', '.').";";
		$html .= $dt['tco'].";";
		$html .= $dt['fte'].";";
		$html .= $dt['fecinidpa'].";";
		$html .= $dt['fecfindpa'].";";
		$html .= $dt['are'].";";
		$html .= $dt['unidad'].";";
		$html .= $dt['ubicacion'].";";
		$html .= $dt['rspn'].";";
		$html .= $dt['pertel'].";";
		$html .= $dt['peremail'].";";
		$html .= $dt['ordg'].";";
		$html .= $dt['nompro'].";";
		$html .= $dt['actflu'].";";
		$html .= $dt['iddpa'].";";
		$html .= $i.";";
		$html .= "\n";
		$i++;
	}

 	//echo $html;
 	echo mb_convert_encoding($html, 'UTF-16LE', 'UTF-8');

?>