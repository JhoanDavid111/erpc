<?php
require_once '../../../config/db.php';
include '../models/capeve.php';
ini_set('memory_limit', '4096M');
require_once '../../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

date_default_timezone_set('America/Bogota');
$dia = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
$mes = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
$fecha = date("d")." de ".$mes[date("m")-1]." de ".date("Y");
$anchoja = 740;

$idce  = isset($_REQUEST['idce']) ? $_REQUEST['idce'] : NULL;
$ce=new capeve();
$ce->setIdce($idce);
$datOne=$ce->getOne();
$list=$ce->getList();

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
			$html .= 'text-align: left;';
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
				$html .= 'CONTROL ASISTENCIA A EVENTO';
				$html .= '<BR>';
				$html .= '';
			$html .= '</td>';
			$html .= '<td><strong>';
				$html .= 'C&Oacute;DIGO AGTH-FT-007';
			$html .= '</strong></td>';
			$html .= '<td rowspan="4" style="text-align: center;"><img src="../../../img/logomejor.png"></td>';
			$html .= '</tr>';
			$html .= '<tr><td><strong>VERSI&Oacute;N: ';
				$html .= '4';
			$html .= '</strong></td></tr>';
			$html .= '<tr><td><strong>FECHA DE APROBACI&Oacute;N: ';
				$html .= 26/12/2022;
			$html .= '</strong></td></tr>';
			$html .= '<tr><td><strong>RESPONSABLE: ';
				$html .= 'TALENTO HUMANO';
			$html .= '</strong></td></tr>';
		$html .= '</tr>';
		$html .= '</table>';

		//$html .= '<br>';

// Inicio Datos Plan de mejora -----------------------------------------------------

if($datOne){
	$html .= '<br>';
	$html .= '<table width="'.$anchoja.'px" border="1" cellpadding="3px" cellspacing="0px">';
        $html .= '<tr>';
            $html .= '<th>EVENTO:</th>';
            $html .= '<td>'.$datOne[0]['nomce'].'</td>';
        $html .= '</tr>';
        $html .= '<tr>';
            $html .= '<th>FECHA:</th>';
            $html .= '<td>'.$datOne[0]['fecince'].' hasta '.$datOne[0]['fecfice'].'</td>';
        $html .= '</tr>';
        $html .= '<tr>';
            $html .= '<th>TIPO / MODALIDAD:</th>';
            $html .= '<td>'.$datOne[0]['tipo'].' / '.$datOne[0]['modal'].'</td>';
        $html .= '</tr>';
        $html .= '<tr>';
            $html .= '<th>ENTIDAD:</th>';
            $html .= '<td>'.$datOne[0]['entce'].'</td>';
        $html .= '</tr>';
    $html .= '</table>';
}

$html .= '<br>';
$html .= '<table width="'.$anchoja.'px" border="1" cellpadding="3px" cellspacing="0px">';
    $html .= '<tr>';
        $html .= '<th>CEDULA</th>';
        $html .= '<th>NOMBRE</th>';
        $html .= '<th>CARGO / ACTIVIDAD</th>';
        $html .= '<th>ÁREA</th>';
        $html .= '<th style="width: 80px;">FIRMA</th>';
        /*$html .= '<th></th>';*/
    $html .= '</tr>';
    if(isset($list)){ foreach ($list as $ls){  
		$html .= '<tr>';
    		$html .= '<td>'.$ls['nodocemp'].'</td>';
        	$html .= '<td>'.$ls['pernom']." ".$ls['perape'].'</td>';
        	$html .= '<td>'.$ls['carg'].'</td>';
        	$html .= '<td>'.$ls['valnom'].'</td>';
        	$html .= '<td style="text-align: center;font-size:10px;font-style: italic;">';
        		if($ls['asis']==1) $html .= 'Firmado digitalmente<br><span style="font-size:8px;">F. Ini: '.$datOne[0]['fecince']."<br> F. Fin: ".$datOne[0]['fecfice']."</span>";
        	$html .= '</td>';
        	/*$html .= '<td style="text-align: center;">';
                $html .= '<input type="checkbox" name="chkasis" ';
                if($ls['asis']==1) $html .= 'checked';
                $html .= ' style="width: 30px;height: 30px;">';
            $html .= '</td>';*/
    	$html .= '</tr>';
   	}}
   	$html .= '<tr>';
        $html .= '<td colspan="6" style="text-align: center;"><br>En cumplimiento del Régimen General de Habeas Data, regulado por la Ley 1581 de 2012 y sus Decretos reglamentarios, con el ingreso de sus datos personales en el presente formulario, autoriza de manera voluntaria, previa, expresa e informada a Canal Capital identificada con NIT 830.012.587-4 y dirección electrónica ccapital@canalcapital.gov.co en calidad de RESPONSABLE, para tratar sus datos personales de acuerdo con su Política de Tratamiento de Datos Personales, que puede conocer en el siguiente enlace www.canalcapital.gov.co/transparencia<br><br></td>';
    $html .= '<tr>';
$html .= '</table>';

	$html .= '<br>';
	$html .= '<table width="'.$anchoja.'px" border="0" cellpadding="3px" cellspacing="0px">';
        $html .= '<tr>';
            $html .= '<td style="width: 18%;">FIRMA ENCARGADO:</td>';
            $html .= '<td style="width: 25%;border-bottom: 1px solid #000000;"></td>';
            $html .= '<td style="width: 30%;">FIRMA RESPONSABLE EN EL CANAL:</td>';
            $html .= '<td style="width: 27%;border-bottom: 1px solid #000000;"></td>';
        $html .= '</tr>';
        $html .= '<tr>';
            $html .= '<td></td>';
            $html .= '<td></td>';
            $html .= '<td>CARGO:</td>';
            $html .= '<td style="width: 27%;border-bottom: 1px solid #000000;"></td>';
        $html .= '</tr>';
    $html .= '</table>';
$html .= '</body>';

echo $html;
echo "<script type='text/javascript'>window.print();</script>";
?>

