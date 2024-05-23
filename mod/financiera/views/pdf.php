<?php
session_start();
include'../../../helpers/utils.php';
include'../../../config/db.php';
$ids =isset($_SESSION['pefid']) ? $_SESSION['pefid']:NULL;
Utils::useraccess('paa/index',$ids,"Exter");


include'../models/modpdf.php';
include'../models/rubro.php';
ini_set('memory_limit', '4096M');
require_once '../../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
//use Dompdf\Options;


$pdf = isset($_GET['pdf']) ? $_GET['pdf']:NULL;
$iddpa = isset($_GET["iddpa"]) ? $_GET["iddpa"]:NULL;
$pfinan = new Pfinan();
$pfinan->setIddpa($iddpa);
$dat = $pfinan->getOne();
$flu = $pfinan->getFlujo();
$fex = $pfinan->getFechaExpCDP();

$rubro = new Rubro();		
		$num = $rubro->getNum();
		$ninipaa = $num[0]['ninipaa'];

date_default_timezone_set('America/Bogota');
$dia = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
$mes = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
//$fecha = date("d")." de ".$mes[date("m")-1]." de ".date("Y");
$fecha = substr($fex[0]['Fm'],8,2)." de ".$mes[substr($fex[0]['Fm'],5,2)-1]." de ".substr($fex[0]['Fm'],0,4);
$fecha2 = date("Ymd");
$anchohoja = 750;

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
		$html .="}";
	$html .="</style>";
$html .="</head>";
$html .="<body>";
	$html .="<div align='left' style='float: left;'>";
	$html .= "<table width='".$anchohoja."px' border='1' cellpadding='3px' cellspacing='0'>";
	$html .= "<tr>";
		//$html .= "<td rowspan='4' style='text-align: center;'><img src='../../../img/logocanal.png'></td>";
	//	$html .= "<td rowspan='4' style='text-align: center;'><img src='https://intranet.canalcapital.gov.co/erp/img/logocanal.png'></td>";
		$html .= "<td rowspan='4' style='text-align: center;'><img src='logocanal.png'></td>";
		//{{$variable['signature']}}
		
		$html .= "<td rowspan='4' align='center' class='neg'>";
			$html .= "SOLICITUD DE";
			$html .= "<BR>";
			$html .= "DISPONIBILIDAD";
			$html .= "<BR>";
			$html .= "PRESUPUESTAL";
		$html .= "</td>";
		$html .= "<td><strong>";
			$html .= "C&Oacute;DIGO: AGFF-PP-FT-023";
		$html .= "</strong></td>";
		$html .= "<td rowspan='4' style='text-align: center;'><img src='../../../img/logomejor.png'></td>";
		$html .= "</tr>";
		$html .= "<tr><td><strong>VERSI&Oacute;N: ";
			$html .= "16";
		$html .= "</strong></td></tr>";
		$html .= "<tr><td><strong>FECHA DE APROBACI&Oacute;N: ";
			$html .= "28/09/2020";
		$html .= "</strong></td></tr>";
		$html .= "<tr><td><strong>RESPONSABLE: ";
			$html .= "PRESUPUESTO";
		$html .= "</strong></td></tr>";
	$html .= "</tr>";
	$html .= "</table>";

	$html .= "<br>";
		$html .= "<table width='".$anchohoja."px' border='0' cellpadding='3px' cellspacing='0'>";
		$html .= "<tr>";
			$html .= "<td style='text-align: right;'>";
				$html .= "<big><strong>";
					if($dat[0]['nexpcdp'])
						$html .= "No. Consecutivo: ".$dat[0]['nexpcdp'];
					if($dat[0]['nbogdata'])
						$html .= "&nbsp;&nbsp;&nbsp;No. Bogdata: ".$dat[0]['nbogdata'];
					$html .= "</strong></big>";
			$html .= "</td>";
		$html .= "</tr>";
		$html .= "</table>";
	$html .= "<br>";

	$html .= "<table width='".$anchohoja."px' border='1' cellpadding='3px' cellspacing='0'>";
		$html .= "<tr>";
			$html .= "<td><strong>";
				$html .= "Fecha de Elaboración:";
			$html .= "</strong></td>";
			$html .= "<td>";
					$html .= $fecha;
			$html .= "</td>";
		$html .= "</tr>";
		$html .= "<tr>";
			$html .= "<td><strong>";
				$html .= "Objeto:";
			$html .= "</strong></td>";
			$html .= "<td>";
					$html .= $dat[0]['nobjeto'];
			$html .= "</td>";
		$html .= "</tr>";
	$html .="</table>";

	//$html .= "<br>";

	$html .= "<table width='".$anchohoja."px' border='1' cellpadding='3px' cellspacing='0'>";
		$html .= "<tr>";
			$html .= "<td><strong>";
				$html .= "Firma de quien solicita:";
				$ruta = "../../../firma/fir_".$dat[0]['resp'].".png";
				//$html .= $ruta;
				if (file_exists($ruta)){
					$html .= "<br><img src='".$ruta."' height='70px'><br>";
				}else{
					$html .= "<br>";
					$html .= "<br>";
					$html .= "<br>";
				}
				$html .= strtoupper($dat[0]['rspn'])."<br>".$dat[0]['cargo'];
				//$html .= "JUAN DAVID VARGAS MANZANERA<br>";
				// if($flu){
				// 	$html .= strtoupper($flu[0]['pernom'])." ".strtoupper($flu[0]['perape'])."<br>".$flu[0]['valnom'];
				// }
				//$html .= "Subdirector Administrativo";
			$html .= "</strong></td>";
			$html .= "<td>";
				$html .= "<strong>Fecha de Recibido:</strong>";
				$html .= "<br><br>";
				//$html .= $fecha;
				if($flu){
					$html .= $flu[0]['fec'];
				}
			$html .= "</td>";
		$html .= "</tr>";
	$html .="</table>";

	//$html .= "<br>";

	$html .= "<table width='".$anchohoja."px' border='1' cellpadding='3px' cellspacing='0'>";
		$html .= "<tr>";
			$html .= "<td><strong>";
				$html .= "Código presupuestal:";
			$html .= "</strong></td>";
			$html .= "<td colspan='2'>";
				$html .= $ninipaa;
				if($dat[0]['codrub2']){
					$html .= $dat[0]['codrub2'];
				}else{
					$html .= $dat[0]['codrub'];
				}
				$html .= " - ".$dat[0]['nomrub']." $ ".number_format($dat[0]['asidpa'], 0, ',', '.');
			$html .= "</td>";
		$html .= "</tr>";
		$html .= "<tr>";
			$html .= "<td rowspan='6'><strong>";
				$html .= "Fuente de los recursos:";
			$html .= "</strong></td>";
			$html .= "<th style='text-align: center;'>";
				$html .= "<strong>Fuente</strong>";
			$html .= "</th>";
			$html .= "<th style='text-align: center;'>";
				$html .= "<strong>Valor</strong>";
			$html .= "</th>";
		$html .= "</tr>";
		$html .= "<tr>";
			$html .= "<td>";
				$html .= "<strong>Transferencia SDH</strong>";
			$html .= "</td>";
			$html .= "<td>";
				if ($dat[0]['ftefindpa']==652)
					$html .= " $ ".number_format($dat[0]['asidpa'], 0, ',', '.');
			$html .= "</td>";
		$html .= "</tr>";
		$html .= "<tr>";
			$html .= "<td>";
				$html .= "<strong>Transferencia FUTIC</strong>";
			$html .= "</td>";
			$html .= "<td>";
				if ($dat[0]['ftefindpa']==653)
					$html .= " $ ".number_format($dat[0]['asidpa'], 0, ',', '.');
			$html .= "</td>";
		$html .= "</tr>";
		$html .= "<tr>";
			$html .= "<td>";
				$html .= "<strong>Resolución FUTIC N°</strong>";
			$html .= "</td>";
			$html .= "<td>";
				$daFuT = $pfinan->getMifutic($iddpa);
				if ($dat[0]['ft'] and $dat[0]['ftefindpa']==653)
					$html .= $daFuT[0]['vafnom'];
					//$html .= $dat[0]['resolu'];
			$html .= "</td>";
		$html .= "</tr>";
		$html .= "<tr>";
			$html .= "<td>";
				$html .= "<strong>Recursos Propios</strong>";
			$html .= "</td>";
			$html .= "<td>";
				if ($dat[0]['ftefindpa']==651)
					$html .= " $ ".number_format($dat[0]['asidpa'], 0, ',', '.');
			$html .= "</td>";
		$html .= "</tr>";
		$html .= "<tr>";
			$html .= "<td>";
				$html .= "<strong>Ley 14 de 1991</strong>";
			$html .= "</td>";
			$html .= "<td>";
				if ($dat[0]['ftefindpa']==654)
					$html .= " $ ".number_format($dat[0]['asidpa'], 0, ',', '.');
			$html .= "</td>";
		$html .= "</tr>";
		$html .= "<tr>";
			$html .= "<td><strong>";
				$html .= "Valor:";
			$html .= "</strong></td>";
			$html .= "<td colspan='2'>";
				$html .= ucfirst(convertir($dat[0]['asidpa']))." pesos mcte ($ ".number_format($dat[0]['asidpa'], 0, ',', '.').".oo).";
			$html .= "</td>";
		$html .= "</tr>";
		$html .= "<tr>";
			$html .= "<td><strong>";
				$html .= "Proyecto de inversión:";
			$html .= "</strong></td>";
			$html .= "<td colspan='2'>";
				$html .= $dat[0]['pro'];
			$html .= "</td>";
		$html .= "</tr>";
		$html .= "<tr>";
			$html .= "<td><strong>";
				$html .= "Meta:";
			$html .= "</strong></td>";
			$html .= "<td colspan='2'>";
				$html .= $dat[0]['meta'];
			$html .= "</td>";
		$html .= "</tr>";
	$html .="</table>";

	$html .= "<table width='".$anchohoja."px' border='0' cellpadding='3px' cellspacing='0'>";
		$html .= "<tr>";
			$html .= "<td style='text-align:center;'>";
				$html .= "Aprobación del ordenador del gasto";
				$ruta = "../../../firma/fir_".$dat[0]['ordgas'].".png";
				if (file_exists($ruta)){
					$html .= "<br><img src='".$ruta."' height='100px'><br>";
				}else{
					$html .= "<br>";
					$html .= "<br>";
					$html .= "<br>";
				}
				$html .= "__________________________________";
				$html .= "<br>";
				$html .= "<strong>";
					$html .= strtoupper($dat[0]['ordg'])."<br>";
					$html .= "ORDENADOR DEL GASTO";
				$html .= "</strong>";
			$html .= "</td>";
		$html .= "</tr>";
		$html .= "<tr>";
			$html .= "<td><small>";
				$html .= "Proyectó:";
				if($flu){
					$html .= $flu[0]['pernom']." ".$flu[0]['perape']." - ".$flu[0]['valnom']." ";
					$ruta = "../../../firma/fir_".$flu[0]['perid'].".png";
					if (file_exists($ruta)) $html .= "<img src='".$ruta."' height='30px'>";
				}
				// $html .= "Carolina Vargas García– Técnico de Recursos Humanos";
				$html .= "<br>";
				$html .= "Revisaron:";
				if($flu){
					for($i=1;$i<count($flu)-1;$i++) {
						if($flu[$i]['depid']<>1026){
							$html .= $flu[$i]['pernom']." ".$flu[$i]['perape']." - ".$flu[$i]['valnom']." ";
							$ruta = "../../../firma/fir_".$flu[$i]['perid'].".png";
							if (file_exists($ruta)) $html .= "<img src='".$ruta."' height='25px'>";
							$html .= "<br>";
						}
					}
				}
				//$html .= "Sandra Paola Montilla Morales – Profesional Universitaria de Recursos Humanos Erika Salazar –Profesional Universitaria Producción";
				$html .= "<br>";
				$html .= "<br>";
				$html .= "<em>“Quienes proyectamos, revisamos y damos el visto bueno, declaramos dentro de nuestra responsabilidad y competencia, que el presente documento lo encontramos ajustado a las normas y disposiciones legales vigentes y por lo tanto bajo nuestra responsabilidad lo recomendamos para la firma del representante legal.</em>";
				$html .= "<br>";
				$html .= "<br>";
				$html .= "<small><strong>";
					$html .= "Avenida El Dorado N° 66-63 - Piso 5. Código Postal 111321";
					$html .= "<br>";
					$html .= "PBX: 4578300 Bogotá D.C.";
					$html .= "<br>";
					$html .= "Email: ccapital@canalcapital.gov.co Web: www.canalcapital.gov.co";
					$html .= "<br><br>";
					$html .= "Página 1 de 1";
				$html .= "</small></strong>";
			$html .= "</small></td>";
		$html .= "</tr>";
	$html .="</table>";

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


<?php
//Numeros en letras

function basico($numero) {
	$valor = array ('uno','dos','tres','cuatro','cinco','seis','siete','ocho',
	'nueve','diez','once','doce','trece','catorce','quince','dieciseis','diecisiete','dieciocho','diecinueve','veinte','veintiuno ','vientidos ','veintitrés ', 'veinticuatro','veinticinco',
	'veintiséis','veintisiete','veintiocho','veintinueve');
	return $valor[$numero - 1];
}

function decenas($n) {
	$decenas = array (30=>'treinta',40=>'cuarenta',50=>'cincuenta',60=>'sesenta',
	70=>'setenta',80=>'ochenta',90=>'noventa');
	if( $n <= 29) return basico($n);
	$x = $n % 10;
	if ( $x == 0 ) {
	return $decenas[$n];
	} else return $decenas[$n - $x].' y '. basico($x);
}

function centenas($n) {
	$cientos = array (100 =>'cien',200 =>'doscientos',300=>'trecientos',
	400=>'cuatrocientos', 500=>'quinientos',600=>'seiscientos',
	700=>'setecientos',800=>'ochocientos', 900 =>'novecientos');
	if( $n >= 100) {
	if ( $n % 100 == 0 ) {
	return $cientos[$n];
	} else {
	$u = (int) substr($n,0,1);
	$d = (int) substr($n,1,2);
	return (($u == 1)?'ciento':$cientos[$u*100]).' '.decenas($d);
	}
	} else return decenas($n);
}

function miles($n) {
	if($n > 999) {
	if( $n == 1000) {return 'mil';}
	else {
	$l = strlen($n);
	$c = (int)substr($n,0,$l-3);
	$x = (int)substr($n,-3);
	if($c == 1) {$cadena = 'mil '.centenas($x);}
	else if($x != 0) {$cadena = centenas($c).' mil '.centenas($x);}
	else $cadena = centenas($c). ' mil';
	return $cadena;
	}
	} else return centenas($n);
}

function millones($n) {
	if($n == 1000000) {return 'un millón';}
	else {
	$l = strlen($n);
	$c = (int)substr($n,0,$l-6);
	$x = (int)substr($n,-6);
	if($c == 1) {
	$cadena = ' millón ';
	} else {
	$cadena = ' millones ';
	}
	return miles($c).$cadena.(($x > 0)?miles($x):'');
	}
}
function convertir($n) {
	switch (true) {
	case ( $n >= 1 && $n <= 29) : return basico($n); break;
	case ( $n >= 30 && $n < 100) : return decenas($n); break;
	case ( $n >= 100 && $n < 1000) : return centenas($n); break;
	case ($n >= 1000 && $n <= 999999): return miles($n); break;
	case ($n >= 1000000): return millones($n);
	}
}

// $html ='';
// if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
// $html = "
// <p class='centrado'>".$_POST['numero'].' se escribe ';
// $html.= '<b>'.ucfirst(convertir($_POST['numero'])).'</b>
// ';
// echo $html;
//}
?>
<!--  <form action="" method="post">
 <input type="text" name="numero">
 <button>Enviar</button>
 </form> -->