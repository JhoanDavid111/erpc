<?php
include '../models/mcsv.php';

$arc2 = isset($_GET['arc']) ? $_GET['arc']:NULL;
$nu = isset($_GET['nu']) ? $_GET['nu']:NULL;

$arc = "../elec/".$arc2;

	//generamos el contenido del archivo
		//echo $arc."-".$nu;
		$mcsv = new mcsv();
		if (file_exists($arc)) {
			$xml = simplexml_load_file($arc);
			if($nu=="1"){   // SENADO
				$titulosColumnas = array('CANDIDATO','VOTOS','PORCENTAJE','PARTIDO','BOLETIN','ESCRUTADO');
				$csv_filename = 'Senado '.substr($arc2,7,2).'.csv';
				$csv_export = '';
				$field = count($titulosColumnas);
				for($i = 0; $i < $field; $i++) {
					$csv_export.= $titulosColumnas[$i];
					if($i<($field-1)) $csv_export.= ',';
				}
				$csv_export.= '
				';
				foreach ($xml->Boletin as $Tlb) {
					foreach ($Tlb->Detalle_Circunscripcion->lin as $Tlin) {
						foreach ($Tlin->Detalle_Candidato->lin as $TBol) {
							if($TBol->Candidato['V']) $obj = $mcsv->getCc($TBol->Candidato['V']); else $obj="";
							if($TBol->Partido['V']) $dtpa = $mcsv->getPar($TBol->Partido['V']); else $dtpa="";

							$csv_export .= trim($obj[0]["ncan"]).' '.trim($obj[0]["acan"]).',';
							//$csv_export .= $TBol->Candidato['V'].',';
							$csv_export .= '"'.$TBol->Votos['V'].'",';
							$csv_export .= '"'.$TBol->Porc['V'].'",';
							//$csv_export .= $TBol->Partido['V'].' '.$dtpa[0]["elenp"].',';
							$csv_export .= $dtpa[0]["elenp"].',';
							//$csv_export .= $TBol->Partido['V'].',';
							$csv_export .= $Tlb->Numero['V'].',';
							$csv_export .= '"'.$Tlb->Porc_Sufragantes['V'].'",';
							$csv_export.= '
				';
						}
					}
				}
			}else if($nu=="2"){
				$titulosColumnas = array('CANDIDATO','VOTOS','PORCENTAJE','BOLETIN','ESCRUTADO');
				$csv_filename = 'Citrep '.substr($arc2,7,2).'.csv';
				$csv_export = '';
				$field = count($titulosColumnas);
				for($i = 0; $i < $field; $i++) {
					$csv_export.= $titulosColumnas[$i];
					if($i<($field-1)) $csv_export.= ',';
				}
				$csv_export.= '
				';
				foreach ($xml->Boletin as $Tlb) {
					foreach ($Tlb->Detalle_Circunscripcion->lin as $Tlin) {
						foreach ($Tlin->Detalle_Candidato->lin as $TBol) {
							if($TBol->Candidato['V']) $obj = $mcsv->getCc($TBol->Candidato['V']); else $obj="";
							if($TBol->Partido['V']) $dtpa = $mcsv->getPar($TBol->Partido['V']); else $dtpa="";

							$csv_export .= trim($obj[0]["ncan"]).' '.trim($obj[0]["acan"]).',';
							//$csv_export .= $TBol->Candidato['V'].',';
							$csv_export .= '"'.$TBol->Votos['V'].'",';
							$csv_export .= '"'.$TBol->Porc['V'].'",';
							$csv_export .= $Tlb->Numero['V'].',';
							$csv_export .= '"'.$Tlb->Porc_Sufragantes['V'].'",';
							$csv_export.= '
				';
						}
					}
				}
			}else if($nu=="3"){
				$titulosColumnas = array('CANDIDATO','VOTOS','PORCENTAJE','PARTIDO','BOLETIN','ESCRUTADO');
				$csv_filename = 'Consulta '.substr($arc2,4,2).'.csv';
				$csv_export = '';
				$field = count($titulosColumnas);
				for($i = 0; $i < $field; $i++) {
					$csv_export.= $titulosColumnas[$i];
					if($i<($field-1)) $csv_export.= ',';
				}
				$csv_export.= '
				';
				foreach ($xml->Boletin as $Tlb) {
					foreach ($Tlb->Detalle_Circunscripcion->lin as $Tlin) {
						foreach ($Tlin->Detalle_Candidato->lin as $TBol) {
							if($TBol->Candidato['V']) $obj = $mcsv->getCc($TBol->Candidato['V']); else $obj="";
							if($TBol->Partido['V']) $dtpa = $mcsv->getPar($TBol->Partido['V']); else $dtpa="";

							$csv_export .= trim($obj[0]["ncan"]).' '.trim($obj[0]["acan"]).',';
							//$csv_export .= $TBol->Candidato['V'].',';
							$csv_export .= '"'.$TBol->Votos['V'].'",';
							$csv_export .= '"'.$TBol->Porc['V'].'",';
							//$csv_export .= $TBol->Partido['V'].' '.$dtpa[0]["elenp"].',';
							$csv_export .= $dtpa[0]["elenp"].',';
							//$csv_export .= $TBol->Partido['V'].',';
							$csv_export .= $Tlb->Numero['V'].',';
							$csv_export .= '"'.$Tlb->Porc_Sufragantes['V'].'",';
							$csv_export.= '
				';
						}
					}
				}
			}else if($nu=="4"){  //Camara
				$titulosColumnas = array('CANDIDATO','VOTOS','PORCENTAJE','PARTIDO','BOLETIN','ESCRUTADO');
				$csv_filename = 'Camara '.substr($arc2,7,2).'.csv';
				$csv_export = '';
				$field = count($titulosColumnas);
				for($i = 0; $i < $field; $i++) {
					$csv_export.= $titulosColumnas[$i];
					if($i<($field-1)) $csv_export.= ',';
				}
				$csv_export.= '
				';

				foreach ($xml->Boletin as $Tlb) {
					foreach ($Tlb->Detalle_Circunscripcion->lin as $Tlin) {
						foreach ($Tlin->Detalle_Candidato->lin as $TBol) {
							if($TBol->Candidato['V']) $obj = $mcsv->getCc($TBol->Candidato['V']); else $obj="";
							if($TBol->Partido['V']) $dtpa = $mcsv->getPar($TBol->Partido['V']); else $dtpa="";

							$csv_export .= trim($obj[0]["ncan"]).' '.trim($obj[0]["acan"]).',';
							//$csv_export .= $TBol->Candidato['V'].',';
							$csv_export .= '"'.$TBol->Votos['V'].'",';
							$csv_export .= '"'.$TBol->Porc['V'].'",';
							//$csv_export .= $TBol->Partido['V'].' '.$dtpa[0]["elenp"].',';
							$csv_export .= $dtpa[0]["elenp"].',';
							//$csv_export .= $TBol->Partido['V'].',';
							$csv_export .= $Tlb->Numero['V'].',';
							$csv_export .= '"'.$Tlb->Porc_Sufragantes['V'].'",';
							$csv_export.= '
				';
						}
					}
				}
			}
			header('Content-Type: application/vnd.ms-excel');
			header("Content-Type: application/vnd.ms-excel; charset=UTF-16LE");
			header('Content-Disposition: attachment; filename="'.$csv_filename.'"');
			echo mb_convert_encoding($csv_export, 'UTF-16LE', 'UTF-8');
			// echo($csv_export);
		}else{
			print_r('No hay resultados para mostrar');
		}
 	//echo mb_convert_encoding($html, 'UTF-16LE', 'UTF-8');


/*
			if($nu=="1"){   // SENADO
				$titulosColumnas = array('Desc_Departamento','Circunscripcion','Desc_Circunscripcion','Numero_Curules','Partido','Descripcion','Votos','Porc');
				$csv_filename = 'Senado '.substr($arc2,7,2).'.csv';
				$csv_export = '';
				$field = count($titulosColumnas);
				for($i = 0; $i < $field; $i++) {
					$csv_export.= $titulosColumnas[$i];
					if($i<($field-1)) $csv_export.= ',';
				}
				$csv_export.= '
				';
				foreach ($xml->Boletin as $Tlb) {
					foreach ($Tlb->Detalle_Circunscripcion->lin as $Tlin) {
						foreach ($Tlin->Detalle_Partidos_Totales->lin as $TBol) {
							$csv_export .= $Tlb->Desc_Departamento['V'].',';
							$csv_export .= $Tlin->Circunscripcion['V'].',';
							$csv_export .= $Tlin->Desc_Circunscripcion['V'].',';
							$csv_export .= $Tlin->Numero_Curules['V'].',';
							$csv_export .= $TBol->Partido['V'].',';
							$csv_export .= $TBol->Descripcion['V'].',';
							$csv_export .= '"'.$TBol->Votos['V'].'",';
							$csv_export .= '"'.$TBol->Porc['V'].'"';
							$csv_export.= '
				';
						}
					}
				}
			}else if($nu=="2"){
				$titulosColumnas = array('Desc_Departamento','Desc_Circunscripcion','Partido','Votos','Porc','Pref','Curules');
				$csv_filename = 'Citrep '.substr($arc2,7,2).'.csv';
				$csv_export = '';
				$field = count($titulosColumnas);
				for($i = 0; $i < $field; $i++) {
					$csv_export.= $titulosColumnas[$i];
					if($i<($field-1)) $csv_export.= ',';
				}
				$csv_export.= '
				';
				foreach ($xml->Boletin as $Tlb) {
					foreach ($Tlb->Detalle_Circunscripcion->lin as $Tlin) {
						foreach ($Tlin->Detalle_Partido->lin as $TBol) {
							$csv_export .= $Tlb->Desc_Departamento['V'].',';
							$csv_export .= $Tlin->Desc_Circunscripcion['V'].',';
							$dtpa = $mcsv->getPar($TBol->Partido['V']);
							$csv_export .= $TBol->Partido['V'].' '.$dtpa[0]["elenp"].',';
							$csv_export .= '"'.$TBol->Votos['V'].'",';
							$csv_export .= '"'.$TBol->Porc['V'].'",';
							$csv_export .= $TBol->Pref['V'].',';
							$csv_export .= '"'.$TBol->Curules['V'].'"';
							$csv_export.= '
				';
						}
					}
				}
			}else if($nu=="3"){
				$titulosColumnas = array('Desc_Departamento','Desc_Circunscripcion','Amb_Presenc','Candidato','Votos','Porc','Partido','Sec');
				$csv_filename = 'Consulta '.substr($arc2,4,2).'.csv';
				$csv_export = '';
				$field = count($titulosColumnas);
				for($i = 0; $i < $field; $i++) {
					$csv_export.= $titulosColumnas[$i];
					if($i<($field-1)) $csv_export.= ',';
				}
				$csv_export.= '
				';
				foreach ($xml->Boletin as $Tlb) {
					foreach ($Tlb->Detalle_Circunscripcion->lin as $Tlin) {
						foreach ($Tlin->Detalle_Candidato->lin as $TBol) {
							$obj = $mcsv->getCc($TBol->Candidato['V']);
							$dtpa = $mcsv->getPar($TBol->Partido['V']);
							$csv_export .= $Tlb->Desc_Departamento['V'].',';
							$csv_export .= $Tlin->Desc_Circunscripcion['V'].',';
							$csv_export .= $TBol->Amb_Presenc['V'].',';
							if($dtpa) $csv_export .= $obj[0]["ncan"].' '.$obj[0]["acan"].',';
							$csv_export .= '"'.$TBol->Votos['V'].'",';
							$csv_export .= '"'.$TBol->Porc['V'].'",';
							$csv_export .= $TBol->Partido['V'].' '.$dtpa[0]["elenp"].',';
							$csv_export .= $TBol->Partido['V'];
							$csv_export .= $TBol->Sec['V'];
							$csv_export.= '
				';
						}
					}
				}
			}else if($nu=="4"){  //Camara
				$titulosColumnas = array('Boletin Numero','Boletin_Departamental','Tipo_Boletin','Desc_Corporacion','Departamento','Desc_Departamento','Municipio','Desc_Municipio','Fecha','Hora','Mesas_Instaladas','Mesas_Informadas','Porc_Mesas_Informadas','Potencial_Sufragantes','Total_Sufragantes','Porc_Sufragantes','Votos_Nulos','Porc_Votos_Nulos','Votos_No_Marcados');
				$csv_filename = 'Camara '.substr($arc2,7,2).'.csv';
				$csv_export = '';
				$field = count($titulosColumnas);
				for($i = 0; $i < $field; $i++) {
					$csv_export.= $titulosColumnas[$i];
					if($i<($field-1)) $csv_export.= ',';
				}
				$csv_export.= '
				';

				foreach ($xml->Boletin as $Tlb) {
						$csv_export .= $Tlb->Numero['V'].',';
						$csv_export .= $Tlb->Boletin_Departamental['V'].',';
						$csv_export .= $Tlb->Tipo_Boletin['V'].',';
						$csv_export .= $Tlb->Desc_Corporacion['V'].',';
						$csv_export .= $Tlb->Departamento['V'].',';
						$csv_export .= $Tlb->Desc_Departamento['V'].',';
						$csv_export .= $Tlb->Municipio['V'].',';
						$csv_export .= $Tlb->Desc_Municipio['V'].',';
						$csv_export .= $Tlb->Dia['V'].'/'.$Tlb->Mes['V'].'/'.$Tlb->Anio['V'].',';
						$csv_export .= $Tlb->Hora['V'].':'.$Tlb->Minuto['V'].':'.$Tlb->Seg['V'].',';
						$csv_export .= $Tlb->Mesas_Instaladas['V'].',';
						$csv_export .= $Tlb->Mesas_Informadas['V'].',';
						$csv_export .= '"'.$Tlb->Porc_Mesas_Informadas['V'].'",';
						$csv_export .= $Tlb->Potencial_Sufragantes['V'].',';
						$csv_export .= $Tlb->Total_Sufragantes['V'].',';
						$csv_export .= '"'.$Tlb->Porc_Sufragantes['V'].'",';
						$csv_export .= $Tlb->Votos_Nulos['V'].',';
						$csv_export .= '"'.$Tlb->Porc_Votos_Nulos['V'].'",';
						$csv_export .= $Tlb->Votos_No_Marcados['V'];
						$csv_export.= '
				';
				}
			}

*/




?>