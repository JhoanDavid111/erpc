<?php
include'../models/pdf.php';
ini_set('memory_limit', '512M');
require_once '../../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$norad = isset($_POST['norad']) ? $_POST['norad']:NULL;
if(!$norad)
	$norad = isset($_GET['norad']) ? $_GET['norad']:NULL;
$pdf = isset($_GET['pdf']) ? $_GET['pdf']:NULL;
$trd = isset($_GET['trd']) ? $_GET['trd']:NULL;
$ape = isset($_SESSION["perape"]) ? $_SESSION["perape"]:NULL;
$nom = isset($_SESSION["pernom"]) ? $_SESSION["pernom"]:NULL;

$radica = new Radica();
$dtconf = $radica->getPdfrad($norad);

date_default_timezone_set('America/Bogota');
$dia = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
$mes = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
//$fecha = date("d", strtotime($dtconf[0]["fecrad"]))." de ".$mes[date("m", strtotime($dtconf[0]["fecrad"]))-1]." de ".date("Y", strtotime($dtconf[0]["fecrad"]));
$fecha = date("d/m/Y H:i:s");
//$fecha = date("d", strtotime($dtconf[0]["fecrad"]))."/".date("m", strtotime($dtconf[0]["fecrad"]))."/".date("Y", strtotime($dtconf[0]["fecrad"]))." ".date("H", strtotime($dtconf[0]["fecrad"])).":".date("i", strtotime($dtconf[0]["fecrad"])).":".date("s", strtotime($dtconf[0]["fecrad"]));

$html = "<head>";
$html .="<style type='text/css'>";
$html .="html {";
$html .="margin: 0;";
$html .="}";
$html .="body {";
$html .="font-family: 'Arial', 'Verdana';";
$html .="margin: 5mm 0mm 0mm 0mm;";
$html .="}";
$html .="th {";
$html .="font-family: 'Arial', 'Verdana';";
$html .="font-size: 12px;";
$html .="font-weight: bold;";
$html .="color: #000000;";
$html .="background-color: #d8d8d7;";
$html .="}";
$html .="td {";
$html .="font-family: 'Arial', 'Verdana';";
$html .="font-size: 12px;";
$html .="color: #000000;";
$html .="}";
$html .="</style>";

$html .="</head>";
$html .="<body>";
$html .="<div align='left' style='float: left;'>";

$html .= "<table width='400px' border='0' cellpadding='0' cellspacing='0'>";
$html .= "<tr>";
$html .= "<td align='center'><img src='../../../img/logocanal.png' width='100px'></td>";
$html .= "<td align='center'><img src='../../../img/logomejor.png' width='60px'></td>";
$html .= "<td>";
	if($trd==601)
		$html .= "<center><strong>COMUNICACIONES EXTERNAS</strong></center>";
	elseif($trd==602)
		$html .= "<center><strong>COMUNICACIONES INTERNAS</strong></center>";
	elseif($trd==603)
		$html .= "<center><strong>OFICIOS</strong></center>";
	else
		$html .= "<center><strong>COMUNICACIONES</strong></center>";
	$html .= "&nbsp;&nbsp;N&uacute;mero de Radicado: ".$dtconf[0]["consecutivo"]."<br>";
	$html .= "&nbsp;&nbsp;Registr&oacute;: ".$dtconf[0]["pernom"]." ".$dtconf[0]["perape"]."<br>";
	$html .= "&nbsp;&nbsp;N&uacute;mero de Folios: ".$dtconf[0]["folrad"]."<br>";
	$html .= "&nbsp;&nbsp;correspondencia@canalcapital.gov.co<br>";
	
	$html .= "&nbsp;&nbsp;".$fecha;
$html .= "</td>";
$html .= "</tr>";
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
	$dompdf->stream("Certificado_".$dtconf[0]["consecutivo"].".pdf");
}else{
	echo $html;
	echo "<script type='text/javascript'>window.print();</script>";
}
?>