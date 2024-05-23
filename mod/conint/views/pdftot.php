<?php
session_start();
include '../models/plamejpdf.php';
ini_set('memory_limit','512M');
require_once '../../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$plamej = new Plamej();
$pdf = isset($_GET['pdf']) ? $_GET['pdf']:NULL;
$fil1 = isset($_GET['fil1']) ? $_GET['fil1'] : false;
$fil2 = isset($_GET['fil2']) ? $_GET['fil2'] : false;
$fil3 = isset($_GET['fil3']) ? $_GET['fil3'] : false;
$ac = isset($_GET['ac']) ? $_GET['ac'] : false;
if($fil1 && $fil2){
	$plamej->setFil1($fil1);
	$plamej->setFil2($fil2);
}
if($fil3){
	$plamej->setFil3($fil3);
}

$datAll = $plamej->getAll($ac);

date_default_timezone_set('America/Bogota');
$dia = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
$mes = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
$fecha = date("d")." de ".$mes[date("m")-1]." de ".date("Y");
if($pdf==58947)
	$anchoja = 970;
else
	$anchoja = 980;

$html = '';
$html .= '<head>';
	$html .= '<style type="text/css">';
		$html .= '@font-face{';
		    $html .= 'font-family: Arial;';
		    $html .= 'font-style: normal;';
		    $html .= 'font-weight: 100;';
		    $html .= 'src: url(../../../fonts/arial.ttf);';
		$html .= '}';
		$html .= '@font-face{';
		    $html .= 'font-family: Arial;';
		    $html .= 'font-style: bold;';
		    $html .= 'font-weight: bold;';
		    $html .= 'src: url(../../../fonts/arialbd.ttf);';
		$html .= '}';
		$html .= 'html {';
			$html .= 'margin: 0;';
		$html .= '}';
		$html .= 'body {';
			$html .= 'font-family: "Arial";';
			$html .= 'margin: 10mm 10mm 10mm 10mm;';
		$html .= '}';
		$html .= 'th {';
			$html .= 'font-family: "Arial";';
			$html .= 'font-size: 11px;';
			$html .= 'font-weight: bold;';
			$html .= 'color: #000000;';
			$html .= 'background-color: #d8d8d7;';
		$html .= '}';
		$html .= 'td, strong, td strong {';
			$html .= 'font-family: "Arial";';
			$html .= 'font-size: 11px;';
			$html .= 'color: #000000;';
		$html .= '}';
		$html .= '.acc{';
			$html .= 'width: 100%;';
			$html .= 'padding: 3px 2px 3px 2px;';
		    $html .= 'border-radius: 0px 0px 0px 0px;';
		    $html .= 'background-color: #523178;';
		    $html .= 'background: -moz-linear-gradient(left, rgba(82,49,120,0.3) 0%, rgba(82,49,120,0) 100%);';
		    $html .= 'background: -webkit-linear-gradient(left, rgba(82,49,120,0.3) 0%,rgba(82,49,120,0) 100%);';
		    $html .= 'background: linear-gradient(to right, rgba(82,49,120,0.3) 0%,rgba(82,49,120,0) 100%);';
		    $html .= 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#80523178", endColorstr="#00523178",GradientType=1 );';
		$html .= '}';
	$html .= '</style>';
	$html .= '<title>Planes de mejora</title>';
$html .= '</head>';
$html .= '<body>';
	$html .= '<table width="'.$anchoja.'px" border="1" cellpadding="3px" cellspacing="0px">';
		$html .= '<tr>';
			$html .= '<td rowspan="4" style="text-align: center;"><img src="../../../img/logocanal.png"></td>';
			$html .= '<td rowspan="4" align="center" class="neg">';
				$html .= '';
				$html .= '<BR>';
				$html .= 'PLANES DE MEJORA';
				$html .= '<BR>';
				$html .= '';
			$html .= '</td>';
			$html .= '<td><strong>';
				$html .= 'C&Oacute;DIGO: ';
			$html .= '</strong></td>';
			$html .= '<td rowspan="4" style="text-align: center;"><img src="../../../img/logomejor.png"></td>';
			$html .= '</tr>';
			$html .= '<tr><td><strong>VERSI&Oacute;N: ';
				$html .= '1';
			$html .= '</strong></td></tr>';
			$html .= '<tr><td><strong>FECHA DE GENERACI&Oacute;N: ';
				$html .= $fecha;
			$html .= '</strong></td></tr>';
			$html .= '<tr><td><strong>RESPONSABLE: ';
				$html .= 'Control Interno';
			$html .= '</strong></td></tr>';
		$html .= '</tr>';
	$html .= '</table>';

	$html .= '<br>';

	$html .= '<table width="'.$anchoja.'px" border="1" cellpadding="3px" cellspacing="0px">';
		$html .= '<tr>';
			$html .= '<th>Auditoría</th>';
			$html .= '<th>Código</th>';
			$html .= '<th>Acción / Actividades / Análisis</th>';
			$html .= '<th style="width: 65px;">Fecha inicio</th>';
			$html .= '<th>Fecha terminación</th>';
			$html .= '<th>Responsable</th>';
			$html .= '<th>% avance</th>';
			$html .= '<th>Estado de Avance</th>';
			$html .= '<th>Estado</th>';
		$html .= '</tr>';
		if($datAll){ foreach ($datAll as $dta) {
			$html .= '<tr>';
				$html .= '<td>';
					$html .=  $dta['nopla']." - ".$dta['detfue'];
					$html .=  '<br>';
					$html .=  '<small>';
						//$html .=  '<strong>Fuente de la Observación y/o hallazgo: </strong>'.$dta['fte'];
						$html .=  '</br>'.$dta['obspla'];
					$html .=  '</small>';
				$html .= '</td>';
				
				$html .= '<td>';
					$html .=  $dta['cappla'];
				$html .= '</td>';
				$html .= '<td>';
					$plamej->setNopla($dta['nopla']);
					$acci = $plamej->getAllMejo();
					if($acci){ foreach($acci AS $dac){
						$html .= '<strong><big><big>'.$dac['caumej'].'</big></big></strong><br>';
						$plamej->setNoacc($dac['noacc']);
						$acti = $plamej->getOneAct();
						$cati = isset($acti) ? count($acti):0;
						$html .= '<small><strong>Universo: </strong> '.$cati.'</small><br><br>';

	            			if($acti){ for ($i=0;$i<count($acti);$i++) {
	            				$html .= '<div class="acc">';
	            					$html .= ($i+1).'. '.$acti[$i]['accmej']; 
	            					$html .= '<br>';
	            					$html .= '<small>';
		            					$html .= '<strong>Indicador: </strong>';
		            					$html .= $acti[$i]['foract'];
		            				$html .= '</small>';
		            			$html .= '</div>';
								$plamej->setNoact($acti[$i]['noact']);
								$datAva = $plamej->getAllAva();
	            				
	            				$segui = NULL;

								if($datAva){ foreach ($datAva as $dtv){
									$html .= '<small>';
										$html .= '<strong>Avance: </strong>';
											$html .= $dtv['comava'];
											$html .= '. '.$dtv['fechava'];

										$html .= '<div class="form-group col-md-6 bpun bpuncm">';
									        	$plamej->setNoava($dtv['noava']);
												$segui = $plamej->getAllSeg();
									        	if($segui){ foreach ($segui as $sg){
								            		$html .= '<strong>'.$sg['ale'].'</strong> '.$sg['fecseg'];
								            		$html .= '<br>';
								            			$html .= $sg['anaseg'].' ('.$sg['ejesep'].' %)'.'<br>';
								            			$html .= '<strong>Auditor: </strong> '.$sg['pernom'].' '.$sg['perape'].'<br>';
								            		$html .= '--------------------';
											    }}
										$html .= '</div>';
									$html .= '</small>';
						        }}

						        $html .= '<br>';
	            			}}



					}}

				$html .= '</td>';
				$html .= '<td>';
					//$html .= substr($dta['fobspla'],0,10);
					if($acci){ foreach($acci AS $dac){
						$html .= substr($dac['finimej'],0,10)."<br><br>";
					}}
				$html .= '</td>';
				$html .= '<td>';
					if($acci){ foreach($acci AS $dac){
						$html .= substr($dac['ffinmej'],0,10)."<br><br>";
					}}
				$html .= '</td>';
				$html .= '<td>';
				if($dta['areapla']){
                    $areas = explode(";", $dta['areapla']);
        			foreach ($areas as $area) {
        				$ar = $plamej->getArea($area);
        				$html .= $ar[0]['valid'].' '.$ar[0]['valnom'];
        				$html .= '<br>';
        			}
                }
				$html .= '</td>';
				// $html .= '<td>';
				// $html .= '</td>';
				$html .= '<td style="text-align: center;">';
					$html .= $dta['porpla'].'%';
				$html .= '</td>';
				$html .= '<td style="background-color: '.$dta['pre'].';text-align: center;">';
					$html .= '<strong>'.$dta['est'].'</strong>';
				$html .= '</td>';
				if($dta['actpla']==1){
					$color = "#ff0000";
					$txtest = "ABIERTA";
				}else{
					$color = "#ffffff";
					$txtest = "CERRADA";
				}
				$html .= '<td style="background-color: '.$color.';text-align: center;">';
					$html .= '<strong>';
						//$html .= $dta['fuepla']." ";
						$html .= $dta['fte'];
						$html .= '<br><br>';
						$html .= $txtest;
					$html .= '</strong>';
				$html .= '</td>';
			$html .= '</tr>';
		}}
	$html .= '</table>';
$html .= '</body>';

if($pdf==58947){
	//echo $html;
	$dompdf = new DOMPDF();
	$paper_size = array(0,0,792,612);
	
	$dompdf->loadHtml($html); 
	$dompdf->setPaper($paper_size);
	$dompdf->render(); 
	$dompdf->stream("InformeTotal.pdf");
}else{
	echo $html;
	echo "<script type='text/javascript'>window.print();</script>";
}
?>