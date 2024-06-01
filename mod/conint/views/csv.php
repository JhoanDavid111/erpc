<?php
session_start();
require_once '../../../config/db.php';
include '../models/plamej.php';
// include '../models/plamejpdf.php';

$plamej = new Plamej();
$pdf = isset($_GET['pdf']) ? $_GET['pdf']:NULL;
$fil1 = isset($_GET['fil1']) ? $_GET['fil1'] : false;
$fil2 = isset($_GET['fil2']) ? $_GET['fil2'] : false;
$fil3 = isset($_GET['fil3']) ? $_GET['fil3'] : false;
$valid = isset($_REQUEST['valid']) ? $_REQUEST['valid']:3001;
$ac = isset($_GET['ac']) ? $_GET['ac'] : false;
if($fil1 && $fil2){
	$plamej->setFil1($fil1);
	$plamej->setFil2($fil2);
}
if($fil3){
	$plamej->setFil3($fil3);
}
date_default_timezone_set('America/Bogota');
$fecha = date("Ymdhis");

if($ac==2)
	$datAll = $plamej->getAllcr($valid);
else
	$datAll = $plamej->getAll($valid);
header('Content-Type: application/vnd.ms-excel');
header("Content-Type: application/vnd.ms-excel; charset=UTF-16LE");
header('Content-Disposition: attachment; filename="Planes '.$fecha.'.csv"');

$html = '';
$html .= 'No.;';
$html .= 'Auditoría;';
$html .= 'Observación;';
$html .= 'Código;';
$html .= 'Acción / Actividades;';
$html .= 'Fecha inicio;';
$html .= 'Fecha terminación;';
$html .= 'Responsable;';
$html .= '% avance;';
$html .= 'Estado de Avance;';
$html .= 'Origen;';
$html .= 'Estado;';
$html .= "\n";
//$html .=  '<br>';

if($datAll){ foreach ($datAll as $dta) {
	$html .=  $dta['nopla'].';';
	$html .=  $dta['detfue'].';';
	$html .=  $dta['obspla'].';';
	$html .=  $dta['cappla'].';';
	$plamej->setNopla($dta['nopla']);
	$acci = $plamej->getAllMejo();
	if($acci){ foreach($acci AS $dac){
		$html .= $dac['caumej'].' {(Uni: ';
		$plamej->setNoacc($dac['noacc']);
		$acti = $plamej->getOneAct();
		$cati = isset($acti) ? count($acti):0;
		$html .= $cati.') ';
		if($acti){ for ($i=0;$i<count($acti);$i++) {
			$html .= '['.($i+1).'. '.$acti[$i]['accmej']; 

			// ------------------- mostrar u ocultar desde aquí -----------
			$html .= 'Indicador: ';
			$html .= $acti[$i]['foract'];
			$plamej->setNoact($acti[$i]['noact']);
			$datAva = $plamej->getAllAva();
			
			$segui = NULL;

			if($datAva){ foreach ($datAva as $dtv){
				$html .= '(Avance: ';
				$html .= $dtv['comava'];
				$html .= '. '.$dtv['fechava'].' ';
				$plamej->setNoava($dtv['noava']);
				$segui = $plamej->getAllSeg();
				if($segui){ foreach ($segui as $sg){
			    	$html .= '('.$sg['ale'].' '.$sg['fecseg'].') ';
			        $html .= $sg['anaseg'].' ('.$sg['ejesep'].' %)'.' ';
			        $html .= '(Auditor: '.$sg['pernom'].' '.$sg['perape'].') ';
				}}
				$html .= ') ';	
	    	}}
			// ------------------- mostrar u ocultar hasta aquí -----------



			$html .= '] ';
		}}
		$html .= '} ';
	}}

	$html .=  ';';
	if($acci){ foreach($acci AS $dac){
		$html .= substr($dac['finimej'],0,10).'  ';
	}}
	$html .=  ';';
	if($acci){ foreach($acci AS $dac){
		$html .= substr($dac['ffinmej'],0,10).'  ';
	}}
	$html .=  ';';
	if($dta['areapla']){
        $areas = explode(";", $dta['areapla']);
		foreach ($areas as $area) {
			$ar = $plamej->getArea($area);
			$html .= $ar[0]['valid'].'. '.$ar[0]['valnom'];
			$html .= '   ';
		}
    }
	$html .=  ';';
		$html .= $dta['porpla'].'%';
	$html .=  ';';
		$html .= $dta['est'];
	$html .=  ';';
	if($dta['actpla']==1) $txtest = "ABIERTA";
	else $txtest = "CERRADA";
	$html .= $dta['fte'];
	$html .= ';';
	$html .= $txtest;
	$html .=  ';';
	$html .= "\n";
	//$html .=  '<br>';
}}
//echo $html;
echo mb_convert_encoding($html, 'UTF-16LE', 'UTF-8');
?>