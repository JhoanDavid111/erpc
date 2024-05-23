<?php
include '../models/plamejpdf.php';
ini_set('memory_limit', '4096M');
require_once '../../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

date_default_timezone_set('America/Bogota');
$dia = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
$mes = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
$fecha = date("d")." de ".$mes[date("m")-1]." de ".date("Y");
$anchoja = 740;

$plamej = new Plamej();
$nopla = isset($_REQUEST['nopla']) ? $_REQUEST['nopla']:false;
$plamej->setNopla($nopla);
$plamejs = $plamej->getOne();
//$accpro = $plamej->getAllVal(33);
$acci = $plamej->getAllMejo();
if($acci AND $acci[0]['noacc']){
	$plamej->setNoacc($acci[0]['noacc']);
	$acti = $plamej->getOneAct();
}


function mosArea($noAre){
	$areas = NULL;
	$noAre = explode(";",$noAre);
	$plamej = new plamej();
	if($noAre){ foreach($noAre  AS $dta){
		$dtAr = $plamej->getArea($dta);
		if($dtAr){ foreach($dtAr  AS $da){
			$areas .= $da['valid']." ".$da['valnom']."<br>";
		}}
	}}
	return $areas;
}

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
		$html .= '.bar1 {';
		    $html .= 'display: block;';
		    $html .= 'width: 100%;';
		    $html .= 'height: 20px;';
		    $html .= 'border-radius: 10px;';
		    $html .= 'border: 1px solid #523178;';
		    $html .= 'background-color: rgba(82,49,120,0.3);';
		$html .= '}';
		$html .= '.bar2 {';
		    $html .= 'display: block;';
		    $html .= 'width: 100%;';
		    $html .= 'height: 18px;';
		    $html .= 'border-radius: 10px;';
		    $html .= 'background-color: rgba(82,49,120,1);';
		    $html .= 'text-align: center;';
		    $html .= 'color: #fff;';
		    $html .= 'font-size: 12px;';
		    $html .= 'font-weight: bold;';
		$html .= '}';
	$html .= '</style>';
	$html .= '<title>Imprimir Plan de Mejora</title>';
$html .= '</head>';
$html .= '<body>';
	$html .= '<table width="'.$anchoja.'px" border="1" cellpadding="3px" cellspacing="0px">';
		$html .= '<tr>';
			$html .= '<td rowspan="4" style="text-align: center;"><img src="../../../img/logocanal.png"></td>';
			$html .= '<td rowspan="4" align="center" class="neg">';
				$html .= '';
				$html .= '<BR>';
				$html .= 'PLAN DE MEJORA';
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

		//$html .= '<br>';

// Inicio Datos Plan de mejora -----------------------------------------------------
		$html .= '<h3>Observación y/o hallazgo No. '.$nopla.'</h3>';
        if(isset($plamejs)){
        	foreach ($plamejs as $va){
				$html .= '<table width="'.$anchoja.'px" border="1" cellpadding="3px" cellspacing="0px">';
					$html .= '<tr>';
						$html .= '<th>Fecha Solicitud:</th>';
						$html .= '<td>';
							$html .= '<strong>';
								$html .= $va['fsolpla'];
							$html .= '</strong>';
						$html .= '</td>';
						$html .= '<th>Fuente:</th>';
						$html .= '<td>';
							$html .= '<strong>';
								$html .= $va['fte'];
							$html .= '</strong>';
						$html .= '</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Detalle:</th>';
						$html .= '<td colspan="4">';
							$html .= $va['detfue'];
						$html .= '</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Observación:</th>';
						$html .= '<td colspan="4">';
							$html .= $va['obspla'];
						$html .= '</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Fecha Observación:</th>';
						$html .= '<td>';
							$html .= $va['fobspla'];
						$html .= '</td>';
						$html .= '<th>Código o capítulo:</th>';
						$html .= '<td>'.$va['cappla'].'</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Áreas:</th>';
						$html .= '<td>';
							$html .= mosArea($va['areapla']);
						$html .= '</td>';
						$html .= '<th>Estados:</th>';
						$html .= '<td class="est"><strong>'.$va['est'].' ('.$va['porpla'].'%)</strong></td>';
					$html .= '</tr>';
				$html .= '</table>';
		}}

// Fin Datos Plan de Mejora --------------------------------------------------------

// Inicio Datos Acciones y demás ---------------------------------------------------

$html .= '<h3>Acción de mejora</h3>';
$html .= '<table width="'.$anchoja.'px" border="1" cellpadding="3px" cellspacing="0px">';
    $html .= '<tr>';
    	$html .= '<th>Acciones - Causa(s) de la observación y/o hallazgo</th>';
	$html .= '</tr>';
    if(isset($acci)){ foreach ($acci as $va){
	    $html .= '<tr>';
	        $html .= '<td>';
	            $html .= '<big>';
	            	$html .= '<strong>No. Acción: '.$va['noacc'].' - '.$va['caumej'].'</strong><br>';
	            $html .= '</big>';
	            $html .= '<small>';
		            $html .= '<strong>Universo:</strong> ';
		            if(isset($acti)) $html .= count($acti).'&nbsp;&nbsp;&nbsp;';
	            	$html .= '<strong>Tipo de acción Propuesta:</strong> '.$va['tap'].'<br>';
                    $html .= '<strong>% que se espera alcanzar de la meta:</strong> '.$va['alcmej'].'<br>';
                    $html .= '<strong>Fec. Inicio:</strong> '.substr($va['finimej'],0,10).'&nbsp;&nbsp;&nbsp;';
                    $html .= '<strong>Fec. Terminación:</strong> '.substr($va['ffinmej'],0,10).'<br>';
                    $html .= '<strong>Área res. de ejecución:</strong> '.$va['are'].'<br>';
                    $html .= '<strong>Líder proceso:</strong> '.$va['cal'].' ';
                    $html .= '<strong>Responsable de ejecución:</strong> '.$va['car'];
                $html .= '</small>';
                $html .= '<br><br>';
				$html .= '<strong>Detalle de Actividades para ejecutar la acción:</strong> <br><br>';
		        $plamej->setNoacc($va['noacc']);
				$acti = $plamej->getOneAct();
		        if($acti){ for ($i=0;$i<count($acti);$i++) {
	            	$html .= '<div class="titdtact">';
	            			$html .= ($i+1).'. '.$acti[$i]['accmej'];
	            			$html .= '('.$acti[$i]['foract'].')';
	            	$html .= '</div>';
					$plamej->setNoact($acti[$i]['noact']);
					$datAva = $plamej->getAllAva();
					$html .= '<br>';
	            	$segui = NULL;

	            	$html .= '<small>';
					$html .= '<table width="'.$anchoja.'px" border="0" cellpadding="3px" cellspacing="0px">';
					if($datAva){ foreach ($datAva as $dta){
						$html .= '<tr>';
							$html .= '<td width="17%">';
								$html .= $dta['comava'];
							$html .= '</td>';
							$html .= '<td width="17%">';
								$html .= $dta['fechava'];
							$html .= '</td>';
							$html .= '<td width="17%">';
								$html .= 'Evidencia '.$dta['comava'];
							$html .= '</td>';
							$html .= '<td width="49%">';
						        $plamej->setNoava($dta['noava']);
								$segui = $plamej->getAllSeg();
						        if($segui){ foreach ($segui as $sg){
					            		$html .= '<strong>'.$sg['ale'].'</strong> '.$sg['fecseg'];
					            		$html .= '<br>';
					            		$html .= '<small>';
					            			$html .= $sg['anaseg'].'<br>';
				                        $html .= '</small>';
				                        $txtbcsb=""; 
				                        if(!$sg['ejesep']) $txtbcsb= "style='background-color: ".$sg['pre'].";'";
				                        $html .= '<div class="bar1" '.$txtbcsb.'><div class="bar2" style="background-color: '.$sg['pre'].';width: '.$sg['ejesep'].'%;">'.$sg['ejesep'].' %';
				                        $html .= '</div></div>';
				                        $html .= '<small>';
					            			$html .= '<strong>Auditor: </strong> '.$sg['pernom'].' '.$sg['perape'].'<br>';
					            		$html .= '</small>';
								    }}else{
								    	$html .= '<small>Sin seguimiento</small>';
								}
							$html .= '</td>';
						$html .= '</tr>';
			        }}
			        $html .= '</table>';
					$html .= '</small>';
			        $html .= '<br>';
	            }}
            $html .= '</td>';
        $html .= '</tr>';
	}}
$html .= '</table>';


// Fin DAtos Acciones y demás ------------------------------------------------------







$html .= '</body>';

echo $html;
echo "<script type='text/javascript'>window.print();</script>";
?>

