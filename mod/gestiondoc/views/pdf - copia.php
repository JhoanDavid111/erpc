<?php
require_once '../../../config/db.php';
include'../models/radica.php';
ini_set('memory_limit', '4096M');
require_once '../../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
//use Dompdf\Options;

// var_dump('yuju');
// die();

$pdf = isset($_POST['variable']['pdf']) ? $_POST['variable']['pdf']:NULL;
$idcali = isset($_POST["idcali"]) ? $_POST["idcali"]:NULL;
$pefid = isset($_POST["pefid"]) ? $_POST["pefid"]:NULL;
$depid = isset($_POST["depid"]) ? $_POST["depid"]:NULL;
$fechar = isset($_POST["fecha"]) ? $_POST["fecha"]:NULL;
// $prepdf = new Prepdf();
// $prepdf->setIdcali($idcali);
// $dat = $prepdf->getCali();
// $datpre = $prepdf->getPreguntas();

date_default_timezone_set('America/Bogota');
$dia = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
$mes = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
//$fecha = date("d")." de ".$mes[date("m")-1]." de ".date("Y");
$fecha2 = date("Ymd");
$fecha3 = date("d/m/Y");
$anchohoja = 1200;

// $pdf=1547;

$radicad= new Radica();

//$arcentral = $radicad->getar2();

if ($pefid==9){
	$arcentral = $radicad->getar2();
}else{
	$arcentral = $radicad->getar2b($depid);
}

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
			$html .= "<td rowspan='4'  align='center' class='neg'>";
				$html .= "FORMATO ÚNICO DE INVENTARIO DOCUMENTAL (FUID)";
			$html .= "</td>";
			$html .= "<td>";
				$html .= "CÓDIGO: AGRI-GD-FT-007 ";
			$html .= "</td>";
			$html .= "<td rowspan='4' style='text-align: center;'><img src='../../../img/logomejor.png'></td>";	
		$html .= "</tr>";
			$html .= "<tr><td>VERSIÓN: ";
				$html .= "6";
			$html .= "</td></tr>";
			$html .= "<tr><td>";
				$html .= "FECHA DE APROBACIÓN: 26/02/2018 ";
			$html .= "</td></tr>";
			$html .= "<tr><td>";
				$html .= "RESPONSABLE:  GESTIÓN DOCUMENTAL ";
			$html .= "</td></tr>";

		$html .= "</tr>";
		$html .= "</table>";

		$html .= "</BR>";

		//-------------//

		$html .= "<table width='".$anchohoja."px' border='1' cellpadding='3px' cellspacing='0'>";
		$html .= "<tr>";			
			$html .= "<td>";
				$html .= "ENTIDAD REMITENTE: CANAL CAPITAL ";
			$html .= "</td>";
			$html .= "<td rowspan='4'  align='center' class='neg'>";
				$html .= " ";
			$html .= "</td>";
			$html .= "<td rowspan='2' colspan='6' align='center' class='neg'>";
				$html .= "OBJETO DEL INVENTARIO (X)";
			$html .= "</td>";
			$html .= "<td rowspan='4' align='center' class='neg'>";
				$html .= " ";
			$html .= "</td>";
			$html .= "<td rowspan='2' colspan='4'  align='center' class='neg'>";
				$html .= "REGISTRO DE ENTRADA";
			$html .= "</td>";			
		$html .= "</tr>";

			$html .= "<tr><td>ENTIDAD PRODUCTORA: ";
				$html .= "CANAL CAPITAL";
			$html .= "</td></tr>";

			$html .= "<tr>";
				$html .= "<td>";
				$html .= "UNIDAD ADMINISTRATIVA: ";
				$html .= "SUBDIRECCIÓN ADMINISTRATIVA: ";
				$html .= "</td>";
				$html .= "<td align='center'>";
					$html .= "I";					
				$html .= "</td>";
				$html .= "<td align='center'>";	
					$html .= "A.C.E";			
				$html .= "</td>";
				$html .= "<td align='center'>";	
					$html .= "T.P";			
				$html .= "</td>";
				$html .= "<td align='center'>";	
					$html .= "N.P";			
				$html .= "</td>";
				$html .= "<td align='center'>";	
					$html .= "O.A.G";			
				$html .= "</td>";
				$html .= "<td align='center'>";	
					$html .= "EA";			
				$html .= "</td>";
				$html .= "<td align='center'>";	
					$html .= "AÑO";			
				$html .= "</td>";
				$html .= "<td align='center'>";	
					$html .= "MES";			
				$html .= "</td>";
				$html .= "<td align='center'>";	
					$html .= "DÍA";			
				$html .= "</td>";
				$html .= "<td align='center'>";	
					$html .= "No. Transferencia";			
				$html .= "</td>";
			$html .= "</tr>";

			$html .= "<tr>";
				$html .= "<td>";	
					$html .= "OFICINA PRODUCTORA: ";
					$html .= " XXX ";
				$html .= "</td>";
				$html .= "<td align='center'></td>";	
				$html .= "<td align='center'></td>";
				$html .= "<td align='center'>X</td>";
				$html .= "<td align='center'></td>";
				$html .= "<td align='center'></td>";
				$html .= "<td align='center'></td>";

				$html .= "<td align='center'>2022</td>";
				$html .= "<td align='center'>10</td>";
				$html .= "<td align='center'>06</td>";
				$html .= "<td align='center'>4</td>";

				
			$html .= "</tr>";			
			

		$html .= "</tr>";
		$html .= "</table>";

		$html .= "</BR>";
		

		//-------------//


		$html .= "<table width='".$anchohoja."px' border='1' cellpadding='3px' cellspacing='0'>";
			$html .= "<tr>";
				$html .= "<th rowspan='2'>";
					$html .= "NÚMERO DE ORDEN";
				$html .= "</th>";
				$html .= "<th rowspan='2'>";
					$html .= "DEPENDENCIA";
				$html .= "</th>";
				$html .= "<th rowspan='2'>";
					$html .= "CÓDIGO SERIE, SUBSERIE ";
				$html .= "</th>";
				$html .= "<th rowspan='2'>";
					$html .= "NOMBRE DE LA SERIE";
				$html .= "</th>";
				$html .= "<th rowspan='2'>";
					$html .= "NOMBRE DE LA SUBSERIE";
				$html .= "</th>";
				$html .= "<th rowspan='2'>";
					$html .= "DESCRIPCION";
				$html .= "</th>";
				$html .= "<th colspan='2'>";
					$html .= "FECHAS EXTREMAS";
				$html .= "</th>";
				$html .= "<th colspan='4'>";
					$html .= "UNIDAD DE CONSERVACION";
				$html .= "</th>";
				$html .= "<th rowspan='2'>";
					$html .= "No. FOLIOS";
				$html .= "</th>";
				$html .= "<th rowspan='2'>";
					$html .= "SOPORTE";
				$html .= "</th>";
				$html .= "<th colspan='4'>";
					$html .= "FRECUENCIA DE CONSULTA";
				$html .= "</th>";
				$html .= "<th rowspan='2'>";
					$html .= "SIGNATURA TOPOGRÁFICA (AC)";
				$html .= "</th>";
				$html .= "<th colspan='3'>";
					$html .= "INDICADORES DE DETERIORO";
				$html .= "</th>";
				$html .= "<th colspan='2'>";
					$html .= "SEGURIDAD ";
				$html .= "</th>";
				$html .= "<th rowspan='2'>";
					$html .= "NOTAS";
				$html .= "</th>";
			$html .= "</tr>";

			$html .= "<tr>";
				$html .= "<th>";
					$html .= "INICIAL";
				$html .= "</th>";
				$html .= "<th>";
					$html .= "FINAL";
				$html .= "</th>";

				$html .= "<th>";
					$html .= "CAJA";
				$html .= "</th>";
				$html .= "<th>";
					$html .= "TOMO";
				$html .= "</th>";
				$html .= "<th>";
					$html .= "CARPETA";
				$html .= "</th>";
				$html .= "<th>";
					$html .= "OTRO";
				$html .= "</th>";

				$html .= "<th>";
					$html .= "A";
				$html .= "</th>";
				$html .= "<th>";
					$html .= "M";
				$html .= "</th>";
				$html .= "<th>";
					$html .= "B";
				$html .= "</th>";
				$html .= "<th>";
					$html .= "N";
				$html .= "</th>";

				$html .= "<th>";
					$html .= "B";
				$html .= "</th>";
				$html .= "<th>";
					$html .= "D";
				$html .= "</th>";
				$html .= "<th>";
					$html .= "MA";
				$html .= "</th>";

				$html .= "<th>";
					$html .= "G";
				$html .= "</th>";
				$html .= "<th>";
					$html .= "R";
				$html .= "</th>";
			$html .= "</tr>";


			$html .= "<tbody>";
				$nu=0;
				foreach ($arcentral AS $ac) {
					$fechaacentral = $ac['fecha'];
					$nuevafecha = strtotime ('+'.$ac['acentrd'].'year' , strtotime($fechaacentral)); 
					$nuevafecha = date ('Y-m-d',$nuevafecha);
					
					date_default_timezone_set('America/Bogota');
					$fechaact=date("Y-m-d");

					$date1 = strtotime($nuevafecha); 
					$date2 = strtotime($fechaact); 
					$diff = ($date1 - $date2);
					$nu++;
					$html .= "<tr>";
						$html .= "<td>".$nu."</td>";
						$html .= "<td><small><strong>".$ac['valnom']."</strong></small></td>";
						$html .= "<td><small>".$ac['ultserie']."</small></td>";
						$html .= "<td><small>".$ac['destrd']."</small></td>";
						$html .= "<td><small>".$ac['destrd']."</small></td>";

						$arcentrald = $radicad->getar3($ac['ultserie'],$ac['depid']);
						$totalarchivos=count($arcentrald);
						$sumap=$radicad->sumap($ac['ultserie'],$ac['depid']);

						$html .= "<td>";
							// $html .= "<small>Total de archivos: ".$totalarchivos."</small>".'  '."(".$sumap[0]['sumapeso']." Kb)";
							// $html .= "<br><br>";
							// foreach($arcentrald AS $acd){
								
						 		
						 // 		$html .= "<small>".$acd['nomserie'].'.'.$acd['tipo'].' '.'('.$acd['peso'].'Kb)'."</small><br><br>";	
							// }
						$html .= "</td>";											
						
						$html .= "<td><small>".$ac['fecha']."</small></td>";
						$html .= "<td><small>".$nuevafecha."</small></td>";

						$html .= "<td align='center'><small>".''."</small></td>";
						$html .= "<td align='center'><small>".''."</small></td>";
						$html .= "<td align='center'><small>".''."</small></td>";
						$html .= "<td align='center'><small>".'X'."</small></td>";

						$html .= "<td align='center'><small>".$totalarchivos."</small></td>";
						$html .= "<td align='center'><small>".'PDF'."</small></td>";

						$html .= "<td align='center'><small>".''."</small></td>";
						$html .= "<td align='center'><small>".''."</small></td>";
						$html .= "<td align='center'><small>".''."</small></td>";
						$html .= "<td align='center'><small>".''."</small></td>";

						$html .= "<td align='center'><small>".''."</small></td>";

						$html .= "<td align='center'><small>".''."</small></td>";
						$html .= "<td align='center'><small>".''."</small></td>";
						$html .= "<td align='center'><small>".''."</small></td>";

						$html .= "<td align='center'><small>".''."</small></td>";
						$html .= "<td align='center'><small>".''."</small></td>";

						$html .= "<td align='center'>
									<small>
										<small>Total de archivos: ".$totalarchivos."</small>".'  '."(".$sumap[0]['sumapeso']." Kb)";
										$html .= "<br><br>";
										foreach($arcentrald AS $acd){
								
						 		
									 		$html .= "<small>".$acd['nomserie'].'.'.$acd['tipo'].' '.'('.$acd['peso'].'Kb)'."</small><br><br>";	
										}
						$html .= "	</small>
								 </td>";

					$html .= "</tr>";	
				}//end foreach;

			$html .= "</tbody>";
		$html .= "</table>";
		$html .= "</BR>";


			//****************



			//****************

			//-------------//

		$html .= "<table width='".$anchohoja."px' border='1' cellpadding='3px' cellspacing='0'>";
		$html .= "<tr>";			
			$html .= "<td rowspan='1' colspan='4'>";
				$html .= "ELABORADO POR: ";
				$html .= " Persona que elabora ";
			$html .= "</td>";

			$html .= "<td rowspan='4'  align='center' class='neg'>";
				$html .= " ";
			$html .= "</td>";
			$html .= "<td rowspan='1' colspan='4'>";
				$html .= "ENTREGADO POR:";
				$html .= " Persona que entrega";
			$html .= "</td>";
			$html .= "<td rowspan='4' align='center' class='neg'>";
				$html .= " ";
			$html .= "</td>";
			$html .= "<td rowspan='1' colspan='4'>";
				$html .= "Recibido por:";
				$html .= " Persona que recibe";
			$html .= "</td>";			
		$html .= "</tr>";


			$html .= "<tr>";
				$html .= "<td colspan='4'>";
					$html .= "CARGO: ";
				$html .= "</td>";
				$html .= "<td colspan='4'>";
					$html .= "CARGO: ";
				$html .= "</td>";
				$html .= "<td colspan='4'>";
					$html .= "CARGO: ";
				$html .= "</td>";
			$html .= "</tr>";
				

			$html .= "<tr>";
				$html .= "<td rowspan='1' colspan='4'>";
				$html .= "FIRMA: ";
				$html .= "</td>";
				$html .= "<td rowspan='1' colspan='4'>";
				$html .= "FIRMA: ";
				$html .= "</td>";
				$html .= "<td rowspan='1' colspan='4'>";
				$html .= "FIRMA: ";
				$html .= "</td>";
			$html .= "</tr>";			

			$html .= "<tr>";
				$html .= "<td colspan='2'>";	
					$html .= "LUGAR: Canal Capital ";
				$html .= "</td>";
				$html .= "<td colspan='2'>";	
					$html .= "FECHA: ";
					$html .= $fecha3;					
				$html .= "</td>";

				
				$html .= "<td colspan='2'>";	
					$html .= "LUGAR: Canal Capital ";
				$html .= "</td>";
				$html .= "<td colspan='2'>";	
					$html .= "FECHA: ";
					$html .= $fecha3;
				$html .= "</td>";

				

				$html .= "<td colspan='2'>";	
					$html .= "LUGAR: Canal Capital ";
				$html .= "</td>";
				$html .= "<td colspan='2'>";	
					$html .= "FECHA: ";
					$html .= $fecha3;
				$html .= "</td>";			
			$html .= "</tr>";			
			

		$html .= "</tr>";
		$html .= "</table>";

		$html .= "</BR>";

		

		//-------------//

		//****************

			//-------------//

		$html .= "<table width='".$anchohoja."px' border='1' cellpadding='3px' cellspacing='0'>";
		$html .= "<tr>";			
			$html .= "<td rowspan='1' colspan='4' align='center'>";
				$html .= "CONVENCIONES ";				
			$html .= "</td>";

			$html .= "<td rowspan='6'  align='center' class='neg'>";
				$html .= " ";
			$html .= "</td>";
			$html .= "<td rowspan='3' colspan='4' align='center'>";
				$html .= "OBJETO DEL INVENTARIO";
				$html .= " Persona que entrega";
			$html .= "</td>";
			$html .= "<td rowspan='6' align='center' class='neg'>";
				$html .= " ";
			$html .= "</td>";
			$html .= "<td rowspan='3' colspan='2' align='center'>";
				$html .= "INDICADORES DE DETERIORO";				
			$html .= "</td>";	
			$html .= "<td rowspan='6' align='center' class='neg'>";
				$html .= " ";
			$html .= "</td>";	
			$html .= "<td rowspan='4' colspan='2' align='center'>";
				$html .= "SEGURIDAD";				
			$html .= "</td>";	
		$html .= "</tr>";


			$html .= "<tr>";
				$html .= "<td colspan='2'>";
					$html .= "AG";
				$html .= "</td>";
				$html .= "<td colspan='2'>";
					$html .= "Archivo de Gestión ";
				$html .= "</td>";				
			$html .= "</tr>";

			$html .= "<tr>";
				$html .= "<td colspan='2'>";
					$html .= "AC";
				$html .= "</td>";
				$html .= "<td colspan='2'>";
					$html .= "Archivo Central - Diligenciar para transferencia ";
				$html .= "</td>";				
			$html .= "</tr>";

			$html .= "<tr>";				
				$html .= "<td colspan='4' align='center'>";
					$html .= "FRECUENCIA DE CONSULTA ";
				$html .= "</td>";	

				$html .= "<td>";
					$html .= "I ";
				$html .= "</td>";
				$html .= "<td>";
					$html .= "Inventario Inicial";
				$html .= "</td>";
				$html .= "<td>";
					$html .= "N.P";
				$html .= "</td>";
				$html .= "<td>";
					$html .= "Entrega de archivo por novedad de personal";
				$html .= "</td>";

				$html .= "<td>";
					$html .= "B";
				$html .= "</td>";
				$html .= "<td>";
					$html .= "Biológico";
				$html .= "</td>";
			$html .= "</tr>";				

			$html .= "<tr>";
				$html .= "<td>";
				$html .= "A: ";
				$html .= "</td>";
				$html .= "<td>";
				$html .= "Alta: ";
				$html .= "</td>";
				$html .= "<td>";
				$html .= "M";
				$html .= "</td>";
				$html .= "<td>";
				$html .= "Media";
				$html .= "</td>";

				$html .= "<td>";
				$html .= "A.C.E ";
				$html .= "</td>";
				$html .= "<td>";
				$html .= "Apertura Conformación Expedientes ";
				$html .= "</td>";
				$html .= "<td>";
				$html .= "O.A.G";
				$html .= "</td>";
				$html .= "<td>";
				$html .= "Organización Archivos de Gestión";
				$html .= "</td>";

				$html .= "<td>";
				$html .= "D";
				$html .= "</td>";
				$html .= "<td>";
				$html .= "Desgarros";
				$html .= "</td>";

				$html .= "<td>";
				$html .= "G";
				$html .= "</td>";
				$html .= "<td>";
				$html .= "General ";
				$html .= "</td>";
			$html .= "</tr>";		

			$html .= "<tr>";
				$html .= "<td>";
				$html .= "B: ";
				$html .= "</td>";
				$html .= "<td>";
				$html .= "Baja: ";
				$html .= "</td>";
				$html .= "<td>";
				$html .= "N";
				$html .= "</td>";
				$html .= "<td>";
				$html .= "Ninguna";
				$html .= "</td>";

				$html .= "<td>";
				$html .= "T.P";
				$html .= "</td>";
				$html .= "<td>";
				$html .= "Transferencias Primarias";
				$html .= "</td>";
				$html .= "<td>";
				$html .= "E.A";
				$html .= "</td>";
				$html .= "<td>";
				$html .= "Entrega de Archivo (fusión, supresión, creación dependencias)";
				$html .= "</td>";

				$html .= "<td>";
				$html .= "MA";
				$html .= "</td>";
				$html .= "<td>";
				$html .= "Material Agregado";
				$html .= "</td>";

				$html .= "<td>";
				$html .= "R";
				$html .= "</td>";
				$html .= "<td>";
				$html .= "Reservado";
				$html .= "</td>";
			$html .= "</tr>";		

					
			

		$html .= "</tr>";
		$html .= "</table>";

		$html .= "</BR>";

		

		//-------------//





// Resultados de la tabla INICIO -------------------------------------------
			/*if($datpre){
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
			}} */

// Resultados de la tabla FIN ---------------------------------------------
			/*
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
			$html .= "<tr>";
				$html .= "<td colspan='4'>";
					$html .= "<strong>Observaciones:</strong><br><br><br>";
				$html .= "</td>";
			$html .= "</tr>";
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
			*/
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
	$dompdf->setPaper('A4', 'portrait');
	$dompdf->render(); 
	$dompdf->stream("Informe_".$fecha2.".pdf");
}else{
	echo $html;
	echo "<script type='text/javascript'>window.print();</script>";
}
?>