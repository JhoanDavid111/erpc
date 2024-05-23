<?php
include'../models/prepdf.php';
ini_set('memory_limit', '4096M');
require_once '../../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
//use Dompdf\Options;


$pdf = isset($_GET['pdf']) ? $_GET['pdf']:NULL;
$idcali = isset($_GET["idcali"]) ? $_GET["idcali"]:NULL;
$prepdf = new Prepdf();
$prepdf->setIdcali($idcali);
$dat = $prepdf->getCali();
$datpre = $prepdf->getPreguntas();

date_default_timezone_set('America/Bogota');
$dia = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
$mes = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
//$fecha = date("d")." de ".$mes[date("m")-1]." de ".date("Y");
$fecha2 = date("Ymd");
$anchohoja = 750;

// $pdf=1547;

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
			$html .="font-size: 20px;";
		$html .="}";
		$html .=".paiz {";
			$html .="padding: 0px 50px 0px 50px;";
			$html .="font-weight: bold;";
			$html .="display: inline-block;";
			$html .="margin: 0px 30px;";
			//$html .="border-top: 1px solid #000;";
		$html .="}";
		$html .=".bifb {";
			$html .="text-align: center;";
			$html .="width: 100%;";
		$html .="}";
	$html .="</style>";
$html .="</head>";
$html .="<body>";
	$html .="<div align='left' style='float: left;'>";
		$html .= "<table width='".$anchohoja."px' border='1' cellpadding='3px' cellspacing='0'>";
		$html .= "<tr>";
			$html .= "<td rowspan='4' style='text-align: center;'><img src='../../../img/logocanal.png'></td>";	
			$html .= "<td rowspan='4' align='center' class='neg'>";
				$html .= "EVALUACIÓN DE PROVEEDORES";
			$html .= "</td>";
			$html .= "<td>";
				$html .= "C&oacute;digo: ";
			$html .= "</td>";
		$html .= "</tr>";
			$html .= "<tr><td>Página: ";
				$html .= "1 de 1";
			$html .= "</td></tr>";
			$html .= "<tr><td>";
				$html .= "Versión: ";
			$html .= "</td></tr>";
			$html .= "<tr><td>";
				$html .= "Vigencia a partir de: ";
			$html .= "</td></tr>";
		$html .= "</tr>";
		$html .= "</table>";

		$html .= "</BR>";

		$html .= "<table width='".$anchohoja."px' border='1' cellpadding='3px' cellspacing='0'>";
			$html .= "<tr>";
				$html .= "<th width='100px'>";
					$html .= "CARACTERÍSTICAS";
				$html .= "</th>";
				$html .= "<th>";
					$html .= "PUNTAJE";
				$html .= "</th>";
				$html .= "<th>";
					$html .= "CRITERIOS";
				$html .= "</th>";
				$html .= "<th>";
					$html .= "CALIFICACIÓN";
				$html .= "</th>";
			$html .= "</tr>";

// Resultados de la tabla INICIO -------------------------------------------
			if($datpre){
			foreach ($datpre as $dpe) {
				$prepdf->setIdepr($dpe['idepr']);
				$datres = $prepdf->getRespu();
				if($datres){
					$can = count($datres);
					$html .= "<tr>";
						$html .= "<td rowspan='".$can."'>";
							$html .= $dpe['txtepr'];
						$html .= "</td>";
						$html .= "<td style='text-align: center;'>";
							$html .= $datres[0]['punere'];
						$html .= "</td>";
						$html .= "<td style='font-size: 9px;'>";
							$html .= $datres[0]['txtere'];
						$html .= "</td>";
						$html .= "<td style='text-align: right;' rowspan='".$can."'>";
							$html .= $dpe['calepe'];
						$html .= "</td>";
					$html .= "</tr>";
					$t=1;
					for($t=1;$t<$can;$t++){
						$html .= "<tr>";
							$html .= "<td style='text-align: center;'>";
								$html .= $datres[$t]['punere'];
							$html .= "</td>";
							$html .= "<td style='font-size: 9px;'>";
								$html .= $datres[$t]['txtere'];
							$html .= "</td>";
						$html .= "</tr>";
					}
				}
			}}

// Resultados de la tabla FIN ---------------------------------------------

			$html .= "<tr>";
				$html .= "<th class='neg' colspan='3' style='text-align: right;'>";
					$html .= "PROMEDIO";
				$html .= "</th>";
				$html .= "<td class='neg' style='text-align: right;'>";
					$html .= $dat[0]['califica'];
				$html .= "</td>";
			$html .= "</tr>";
			$html .= "<tr>";
				$html .= "<td colspan='4'>";
					//$html .= "<br>";

					$html .= "<table border='1' cellpadding='3px' cellspacing='0'>";
						$html .= "<tr>";
							$html .= "<td rowspan='5' style='text-align: center;'>";
								$html .= "<strong>Criterios de<br>calificación definida</strong>";
							$html .= "</td>";	
							$html .= "<td align='center'>";
								$html .= "<strong>PUNTAJE</strong>";
							$html .= "</td>";
							$html .= "<td align='center'>";
								$html .= "<strong>RESULTADO</strong>";
							$html .= "</td>";
							$html .= "<th rowspan='5' style='text-align: center;'>";
								$html .= "<strong>".$dat[0]['nit']." ".$dat[0]['razsoc']."</strong><br>";
								$html .= "<strong>E-mail: </strong>".$dat[0]['email']."<br>";
								$html .= "<strong>Teléfono: </strong>".$dat[0]['tel']."<br><br>";
								$html .= "<strong>Fecha Evaluación: </strong>".$dat[0]['fecha']."<br>";
							$html .= "</th>";
						$html .= "</tr>";
						$html .= "<tr>";
							$html .= "<td style='text-align: center;'>";
								$html .= "4,5 - 5,0";
							$html .= "</td>";
							$html .= "<td>";
								$html .= "Excelente - Proveedor confiable y recomendado.";
							$html .= "</td>";
						$html .= "</tr>";
						$html .= "<tr>";
							$html .= "<td style='text-align: center;'>";
								$html .= "3,9 - 4,4";
							$html .= "</td>";
							$html .= "<td>";
								$html .= "Bueno - Proveedor confiable.";
							$html .= "</td>";
						$html .= "</tr>";
						$html .= "<tr>";
							$html .= "<td style='text-align: center;'>";
								$html .= "3,0 - 3,8";
							$html .= "</td>";
							$html .= "<td>";
								$html .= "Regular - Proveedor poco confiable. Condicionado y/o Sancionado";
							$html .= "</td>";
						$html .= "</tr>";
						$html .= "<tr>";
							$html .= "<td style='text-align: center;'>";
								$html .= "0,0 - 2,9";
							$html .= "</td>";
							$html .= "<td>";
								$html .= "No Confiable - Proveedor NO confiable. Restringido.";
							$html .= "</td>";
						$html .= "</tr>";
					$html .= "</table>";
				$html .= "</td>";
			$html .= "</tr>";
			// $html .= "<tr>";
			// 	$html .= "<th colspan='4'>";
			// 		$html .= "<br>";
			// 	$html .= "</th>";
			// $html .= "</tr>";
			$html .= "<tr>";
				$html .= "<td colspan='4'>";
					$html .= "<strong>Observaciones:</strong><br><br><br>";
				$html .= "</td>";
			$html .= "</tr>";
			// $html .= "<tr>";
			// 	$html .= "<th colspan='4'>";
			// 		$html .= "<br>";
			// 	$html .= "</th>";
			// $html .= "</tr>";
			$html .= "<tr>";
				$html .= "<td colspan='4'>";
					$html .= "<strong>RESPONSABLES:</strong>";
					$html .= "<div class='bifb'>";
						$html .= "<div class='paiz'><br>Ordenador de Gasto</div>";
						$html .= "<div class='paiz'>";
						$firma = "../../../../filerp/firma/fir_".$dat[0]['perid'].".png";
						if (file_exists($firma)){
							$html .= "<img src='".$firma."' width='50px'>";
						}
						$html .= "<br>".$dat[0]['pernom']." ".$dat[0]['perape']."<br>Interventor / Supervisor</div>";
					$html .= "</div>";
				$html .= "</td>";
			$html .= "</tr>";
		$html .= "</table>";


	$html .="</div>";
$html .= "</body>";
//echo $html;
if($pdf==1547){
	//echo $html;
	//$options = new Options();
	//$options->set('isRemoteEnabled',TRUE);

	$dompdf = new Dompdf();
	//$options = $dompdf->getOptions();
	//$options->setIsRemoteEnabled(true);
	//$dompdf->setOptions($options);
	$paper_size = array(0,0,612,792);
	
	$dompdf->loadHtml($html); 
	$dompdf->setPaper($paper_size);
	//$dompdf->setPaper('A4', 'landscape');
	$dompdf->render(); 
	$dompdf->stream("Informe_".$fecha2.".pdf");
}else{
	echo $html;
	echo "<script type='text/javascript'>window.print();</script>";
}
?>