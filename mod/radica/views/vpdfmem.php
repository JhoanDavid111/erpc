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

$anctbl = '600px';
$anctbl2 = '600px';

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

$html .= "<table width='<?=$anctbl2;?>' border='0' cellpadding='0' cellspacing='0'>";
$html .= "<tr>";
$html .= "<td align='left' colspan='3'><img src='../../../img/logocanalc.png'></td>";
$html .= "</tr>";
$html .= "<tr>";
$html .= "<td colspan='3'>";
	$html .= "<br><center><strong>MEMORANDO</strong></center>";
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
				$html .= "<center><strong>COMUNICACIONES INTERNAS</strong></center>";
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
	$html .= "PARA:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
/*	$datusu = $radica->personOne($dtconf[0]["nomrad"]);
	if($datusu) $html .= $datusu[0]["pernom"]." ".$datusu[0]["perape"]." - ".$datusu[0]["carg"];
*/

		$nomrad = explode(",", $dtconf[0]["nomrad"]);
		$r=0;
		foreach ($nomrad as $cpd) {
			$datusu = $radica->personOne($cpd);
			if($datusu){
				if($r>0) $html .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				$html .= $datusu[0]["pernom"]." ".$datusu[0]["pernom"]." - ".$datusu[0]["carg"]." <br>";
			}
			$r++;
		}


	$html .= "<br><br>";
	$html .= "DE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	$datusu = $radica->personOne($dtconf[0]["firrad"]);
	if($datusu) $html .= $datusu[0]["pernom"]." ".$datusu[0]["perape"]." - ".$datusu[0]["carg"];
	$html .= "<br><br>";
	$html .= "ASUNTO:&nbsp;";
	$html .= $dtconf[0]["asurad"]."<br><br>";
	// $html .= $dtconf[0]["cargo"]."<br>";
	// $html .= "<strong>".$dtconf[0]["emprad"]."</strong><br>";
	// $html .= $dtconf[0]["dirrad"]."<br>";
	// $html .= "C&oacute;digo postal: ".$dtconf[0]["posrad"]."<br>";
	// $html .= $dtconf[0]["ubinom"]."<br><br><br><br>";
	$html .= "<table width='<?=$anctbl2;?>' cellpadding='10px'>";
		$html .= "<tr>";
			$html .= "<td>";
				$html .= "<span style='text-align: justify;'>".$dtconf[0]["cuerad"]."</span><br><br>";
			$html .= "</td>";
		$html .= "</tr>";
	$html .= "</table>";
	$html .= "Sin otro particular,<br>";

	$html .= "<table width='<?=$anctbl2;?>' cellpadding='10px'>";
	$html .= "<tr>";
	$html .= "<td>";
		if (file_exists("../../../firma/fir_".$dtconf[0]["firrad"].".png") AND $dtconf[0]["mfirrad"]==1) {
			$html .= '<img style="width:150px;" id="imagen" src="../../../firma/fir_'.$dtconf[0]["firrad"].'.png" /><br>';

		}else{
			$html .= '<br><br><br>';
		}

		$html .= "_____________________________<br>";
		if($datusu){
			$html .= "<strong>".$datusu[0]["pernom"]." ".$datusu[0]["perape"]."</strong><br>";
			$html .= "<strong>".$datusu[0]["carg"]."</strong>";
		}
	$html .= "</td>";
	$nc = 1;
		$firm = $radica->getFirmap($norad,"32,33");
		if($firm){
			foreach ($firm as $frm) {
			$html .= "<td>";
				$datusu = $radica->personOne($frm["perid"]);
				if (file_exists("../../../firma/fir_".$frm["perid"].".png")) {
					$html .= '<img style="width:150px;" id="imagen" src="../../../firma/fir_'.$frm["perid"].'.png" /><br>';
				}else{
					$html .= '<br><br><br>';
				}
				$html .= "_____________________________<br>";
				if($datusu) $html .= "<strong>".$datusu[0]["pernom"]." ".$datusu[0]["pernom"]."</strong><br><strong>".$datusu[0]["carg"]."</strong>";
				if($datusu) $html .= "<br>";
			$html .= "</td>";
				$nc++;
				if($nc%2 == 0)
					$html .= "</tr><tr>";
			}
			if($nc%2 == 1)
					$html .= "<td>&nbsp;</td>";
		}
	$html .= "</tr>";
	$html .= "</table>";

	$html .= "<br><br>";
	//$html .= "<strong>".$dtconf[0]["firrad"]."</strong><br><br><br>";
	if($dtconf[0]["adjrad"]){
		$html .= "Anexos: ".$dtconf[0]["adjrad"]."<br>";
	}
	$html .= "Elabor&oacute;: ".$dtconf[0]["pernom"]." ".$dtconf[0]["perape"]." ";
	if (file_exists("../../../firma/fir_".$dtconf[0]["regrad"].".png") AND $dtconf[0]["mfirrad"]==1) {
		$html .= '<img style="height: 20px;" id="imagen" src="../../../firma/fir_'.$dtconf[0]["regrad"].'.png" />';
	}
	$html .= "<br>";
	if($dtconf[0]["revrad"]){
		$html .= "Revis&oacute;: ".$dtconf[0]["revrad"]."<br>";
	}
	$firm = $radica->getFirma($norad,"31,33");
	if($firm){
		$html .= "Revisaron: <br>";
		
		foreach ($firm as $frm) {
			$datusu = $radica->personOne($frm["perid"]);
			if($datusu) $html .= $frm["fecres"]." ".$datusu[0]["pernom"]." ".$datusu[0]["pernom"]." - ".$datusu[0]["carg"]." ";
			if (file_exists("../../../firma/fir_".$frm["perid"].".png")) {
				$html .= '<img style="height: 20px;" id="imagen" src="../../../firma/fir_'.$frm["perid"].'.png" />';
			}
			if($datusu) $html .= "<br>";
		}
	}
	// if($dtconf[0]["coprad"]){
	// 	$html .= "Revisaron: <br>";
	// 	$coprad = explode(",", $dtconf[0]["coprad"]);
	// 	foreach ($coprad as $cpd) {
	// 		$datusu = $radica->personOne($cpd);
	// 		if($datusu) $html .= $datusu[0]["pernom"]." ".$datusu[0]["pernom"]." - ".$datusu[0]["carg"]." ";
	// 		if (file_exists("../../../firma/fir_".$cpd.".png") AND $dtconf[0]["mfirrad"]==1) {
	// 			$html .= '<img style="height: 20px;" id="imagen" src="../../../firma/fir_'.$cpd.'.png" />';
	// 		}
	// 		if($datusu) $html .= "<br>";
	// 	}
	// }

	$html .= "<br><br>".$dtconf[0]["doctrd"];
	


	$html .= "<br><br><br>";
$html .= "</td>";
$html .= "</tr>";
$html .= "<tr>";
$html .= "<td align='right' colspan='3'><img src='../../../img/logomejorc.png'></td>";
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