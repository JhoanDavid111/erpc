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

$anctbl = "600px";

$radica = new Radica();
$dtconf = $radica->getOne($norad);

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
$html .="margin: 10mm 25mm 10mm 25mm;";
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



if($dtconf[0]['oficot']==1){
	$html .= "<table width='<?=$anctbl;?>' border='1' cellpadding='0' cellspacing='0'>";
		$html .= "<tr>";
			$html .= "<td align='center' rowspan=4>";
				$html .= "<img src='../../../img/logocanalc.png' height='60px'>";
			$html .= "</td>";
			$html .= "<td align='center' rowspan=4>";
				$html .= "COTIZACIÓN<br>Sector público y privado";
			$html .= "</td>";
			$html .= "<td align='center'>";
				$html .= "CODIGO: MCOM-FT-014";
			$html .= "</td>";
			$html .= "<td align='center' rowspan=4>";
				$html .= "<img src='../../../img/logomejor.png' height='60px'>";
			$html .= "</td>";
		$html .= "</tr>";
		$html .= "<tr>";
			$html .= "<td align='center'>";
				$html .= "VERSIÓN: 3";
			$html .= "</td>";
		$html .= "</tr>";
		$html .= "<tr>";
			$html .= "<td align='center'>";
				$html .= "FECHA: 25/05/2022";
			$html .= "</td>";
		$html .= "</tr>";
		$html .= "<tr>";
			$html .= "<td align='center'>";
				$html .= "RESPONSABLE: PROY. ESTRATÉGICOS";
			$html .= "</td>";
		$html .= "</tr>";
	$html .= "</table>";
}

$html .= "<table width='<?=$anctbl;?>' border='0' cellpadding='0' cellspacing='0'>";
	if($dtconf[0]['oficot']!=1){
		$html .= "<tr>";
			$html .= "<td align='left' colspan='3'><img src='../../../img/logocanalc.png'></td>";
		$html .= "</tr>";

	}
$html .= "<tr>";
$html .= "<td colspan='3'>";
	$html .= "<br><br>Al contestar por favor cite estos datos:<br>";
	$html .= "<br>".$dtconf[0]["are"]."<br><br>";
	$html .= "<div style='border: 1px solid #000;border-radius: 10px;padding: 10px 10px;width: 420px;'>";
		$html .= "<table width='400px' border='0' cellpadding='0' cellspacing='0'>";
		$html .= "<tr>";
		$html .= "<td align='center'><img src='../../../img/logocanal.png' width='100px'></td>";
		$html .= "<td align='center'><img src='../../../img/logomejor.png' width='60px'></td>";
		$html .= "<td>";
			if($trd==601)
				$html .= "<center><strong>COMUNICACIONES EXTERNAS</strong></center>";
			elseif($trd==602 OR $trd==603)
				$html .= "<center><strong>OFICIOS</strong></center>";
			else
				$html .= "<center><strong>COMUNICACIONES</strong></center>";
			$html .= "&nbsp;&nbsp;Secretar&iacute;a general<br>";
			$html .= "&nbsp;&nbsp;N&uacute;mero de Radicado: ".$dtconf[0]["consecutivo"]."<br>";
			$html .= "&nbsp;&nbsp;Registr&oacute;: ".$dtconf[0]["pernom"]." ".$dtconf[0]["perape"]."<br>";
			$html .= "&nbsp;&nbsp;N&uacute;mero de Folios: ".$dtconf[0]["folrad"]."<br>";
			$html .= "&nbsp;&nbsp;".$fecha;
		$html .= "</td>";
		$html .= "</tr>";
		$html .="</table>";


	$html .= "</div>";
	$html .= "<br><br>";
	$html .= "Doctor(a):<br>";
	$datusu = $radica->personOne($dtconf[0]["nomrad"]);
	if($datusu){
		$html .= "<strong>".$datusu[0]["pernom"]." ".$datusu[0]["perape"]."</strong><br>";
		$html .= $datusu[0]["carg"]."<br>";
	}else{
		$html .= "<strong>".$dtconf[0]["nomrad"]."</strong><br>";
		$html .= $dtconf[0]["carrad"]."<br>";
	}
	$html .= "<strong>".$dtconf[0]["emprad"]."</strong><br>";
	$html .= $dtconf[0]["dirrad"]."<br>";
	$html .= "C&oacute;digo postal: ".$dtconf[0]["posrad"]."<br>";
	$html .= $dtconf[0]["ubinom"]."<br><br>";
	$html .= "<strong>Asunto: ".$dtconf[0]["asurad"]."</strong><br><br>";
	$html .= "<span style='text-align: justify;'>".$dtconf[0]["cuerad"]."</span><br><br>";
	$html .= "Sin otro particular,<br>";

	$datusu = $radica->personOne($dtconf[0]["firrad"]);

	if (file_exists("../../../firma/fir_".$dtconf[0]["firrad"].".png") AND $dtconf[0]["mfirrad"]==1) {
			$html .= '<img style="width:150px;" id="imagen" src="../../../firma/fir_'.$dtconf[0]["firrad"].'.png" /><br>';
	}else{
		$html .= '<br><br><br>';
	}

	if($datusu){
		$html .= "<strong>".$datusu[0]["pernom"]." ".$datusu[0]["perape"]."</strong>";
		$html .= "<br>".$datusu[0]["carg"];
	}
	$html .= "<br><br>";
	if($dtconf[0]["adjrad"]){
		$html .= "Anexos: ".$dtconf[0]["adjrad"]."<br>";
	}
	if($dtconf[0]["coprad"]){
		$html .= "Con copia a: ";
		$coprad = explode(",", $dtconf[0]["coprad"]);
		foreach ($coprad as $cpd) {
			$datusu = $radica->personOne($cpd);
			if($datusu) $html .= $datusu[0]["pernom"]." ".$datusu[0]["pernom"]." - ".$datusu[0]["carg"]." ";
			if (file_exists("../../../firma/fir_".$cpd.".png") AND $dtconf[0]["mfirrad"]==1) {
				$html .= '<img style="height: 20px;" id="imagen" src="../../../firma/fir_'.$cpd.'.png" />';
			}
			$html .= "<BR>";
		}
	}
	//$html .= "Revis&oacute;: ".$dtconf[0]["revrad"]."<br>";
	
	$html .= "Nombre del transcriptor: ".$dtconf[0]["pernom"]." ".$dtconf[0]["perape"]." ";
	if (file_exists("../../../firma/fir_".$dtconf[0]["regrad"].".png") AND $dtconf[0]["mfirrad"]==1) {
		$html .= '<img style="height: 20px;" id="imagen" src="../../../firma/fir_'.$dtconf[0]["regrad"].'.png" />';
	}
	$html .= "<br>";
	$html .= "Radicado Interno: "."<br><br>";
	$html .= $dtconf[0]["doctrd"]."<br><br>";
$html .= "</td>";
$html .= "</tr>";
$html .= "<tr>";
	$html .= "<td>";
	$html .= "<img src='../../../img/malla.png' width='50px'>";
	$html .= "</td>";
$html .= "<td>";
	$html .= "<small><strong>Dirección:</strong> Av. El Dorado No. 66 - 63, piso 5, código postal 111321<br>
<strong>PBX:</strong> 4 578 300 / <strong>email:</strong> ccapital@canalcapital.gov.co<br>
Bogotá D.C, Colombia
</small>";
$html .= "</td>";
	$html .= "<td>";
	$html .= "<img src='../../../img/logomejorc.png'>";
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