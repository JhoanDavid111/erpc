<?php
include'../models/modpdf.php';
// ini_set('memory_limit', '512M');
// require_once '../../../dompdf/autoload.inc.php';
// use Dompdf\Dompdf;

$ano = isset($_POST["anoIn"]) ? $_POST["anoIn"]:NULL;
$mes = isset($_POST['mesIn']) ? $_POST['mesIn']:NULL;

$pfinan = new Pfinan();
$dat = $pfinan->getRepLuis($ano,$mes);

	//generamos el contenido del archivo
	header('Content-Type: application/vnd.ms-excel');
	header("Content-Type: application/vnd.ms-excel; charset=UTF-16LE");
	header('Content-Disposition: attachment; filename="Reporte '.$ano.'_'.$mes.'.csv"');



	$html = "Iddpa;Idpaa;Nicod;Nobjeto;Nomcont;Area;Codrub;Objdpa;Inidpa;Prodpa;Unspsc;Fecinidpa;Nmesdpa;Cuodpa;Tipcondpa;Ftefindpa;Asidpa;Pmes;Umes;Valdpa;Valvigact;Fecfindpa;Reqvigf;Solivigf;Unidad;Ubicacion;Resp;Celres;Mailres;Ncdppc;Fecsol;Observaciones;Idpro;Idflu;Depidd;Nexpcdp;Nrp;Nbogdata;Rutcdp;Rutrp;Ordgas;Elidp;Fec;Perid;";
	$html .= "\n";
	$i=1;
	if($dat){
		foreach ($dat as $dt) {
			$html .= $dt['iddpa'].";";
			$html .= $dt['idpaa'].";";
			$html .= $dt['nicod'].";";
			$html .= $dt['nobjeto'].";";
			$html .= $dt['nomcont'].";";
			$html .= $dt['area'].";";
			$html .= $dt['codrub'].";";
			$html .= $dt['objdpa'].";";
			$html .= $dt['inidpa'].";";
			$html .= $dt['prodpa'].";";
			$html .= $dt['unspsc'].";";
			$html .= $dt['fecinidpa'].";";
			$html .= $dt['nmesdpa'].";";
			$html .= $dt['cuodpa'].";";
			$html .= $dt['tipcondpa'].";";
			$html .= $dt['ftefindpa'].";";
			$html .= $dt['asidpa'].";";
			$html .= $dt['pmes'].";";
			$html .= $dt['umes'].";";
			$html .= $dt['valdpa'].";";
			$html .= $dt['valvigact'].";";
			$html .= $dt['fecfindpa'].";";
			$html .= $dt['reqvigf'].";";
			$html .= $dt['solivigf'].";";
			$html .= $dt['unidad'].";";
			$html .= $dt['ubicacion'].";";
			$html .= $dt['resp'].";";
			$html .= $dt['celres'].";";
			$html .= $dt['mailres'].";";
			$html .= $dt['ncdppc'].";";
			$html .= $dt['fecsol'].";";
			$html .= $dt['observaciones'].";";
			$html .= $dt['idpro'].";";
			$html .= $dt['idflu'].";";
			$html .= $dt['depidd'].";";
			$html .= $dt['nexpcdp'].";";
			$html .= $dt['nrp'].";";
			$html .= $dt['nbogdata'].";";
			$html .= $dt['rutcdp'].";";
			$html .= $dt['rutrp'].";";
			$html .= $dt['ordgas'].";";
			$html .= $dt['elidp'].";";
			$html .= $dt['fec'].";";
			$html .= $dt['perid'].";";
			$html .= "\n";
			$i++;
		}
	}

 	//echo $html;
 	echo mb_convert_encoding($html, 'UTF-16LE', 'UTF-8');

?>