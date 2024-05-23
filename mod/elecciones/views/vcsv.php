<?php
include '../models/mcsv.php';

$arc2 = isset($_GET['arc']) ? $_GET['arc']:NULL;
$nu = isset($_GET['nu']) ? $_GET['nu']:NULL;
$cer = isset($_GET['cer']) ? $_GET['cer']:NULL;

$arc = "../elec/".$arc2;

	//generamos el contenido del archivo
		//echo $arc."-".$nu;
		$mcsv = new mcsv();
		$sep = ';';
		if (file_exists($arc)) {
			

			$xml = simplexml_load_file($arc);
			$corp = NULL;
			if($nu=="1") $corp = 1; //Senado
			if($nu=="4") $corp = 2; //Camara
			if($nu=="2") $corp = 7; //CITREP
			if($xml->Boletin->Desc_Corporacion['V']=="EQUIPO POR COLOMBIA")  $corp = 9; //EQUIPO POR COLOMBIA - Consulta
			if($xml->Boletin->Desc_Corporacion['V']=="COALICIÓN CENTRO ESPERANZA")  $corp = 6; //CENTRO ESPERANZA - Consulta
			if($xml->Boletin->Desc_Corporacion['V']=="CENTRO ESPERANZA")  $corp = 6; //CENTRO ESPERANZA - Consulta
			if($xml->Boletin->Desc_Corporacion['V']=="PACTO HISTÓRICO")  $corp = 8; //PACTO HISTÓRICO - Consulta

			// echo "Desc: ".$xml->Boletin->Desc_Corporacion['V']."<br>";
			// echo "Corp: ".$corp;
			// die();


			if(($nu=="1" OR $nu=="2" OR $nu=="4") and $cer==1){   // SENADO y CAMARA  CERRADA
				//$titulosColumnas = array('','CANDIDATO','VOTOS','PORCENTAJE','PARTIDO','BOLETIN','ESCRUTADO');
				$titulosColumnas = array('BOLETIN','MESAS INF','PORCENTAJE MESAS','DEPARTAMENTO','VOTOS','PORCENTAJE PARTIDO', 'PARTIDO', 'Nombre');

				if($nu=="1") $csv_filename = 'Senado Cerrada'.substr($arc2,7,2).'.csv';
				if($nu=="4") $csv_filename = 'Camara Cerrada'.substr($arc2,7,2).'.csv';
				if($nu=="2") $csv_filename = 'Citrep Cerrada'.substr($arc2,7,2).'.csv';
				$csv_export = '';
				$field = count($titulosColumnas);
				for($i = 0; $i < $field; $i++) {
					$csv_export.= $titulosColumnas[$i];
					if($i<($field-1)) $csv_export.= $sep;
				}
				$csv_export.= '
';

				//foreach ($xml->Boletin as $Tlb) {
					//foreach ($Tlb->Detalle_Circunscripcion->lin as $Tlin) {
						foreach ($xml->Boletin->Detalle_Circunscripcion->lin->Detalle_Partido->lin as $TBol) {
							//if($TBol->Candidato['V']) $obj = $mcsv->getCc($TBol->Candidato['V'],$TBol->Partido['V'],$corp); else $obj="";
							if($TBol->Partido['V']) $dtpa = $mcsv->getPar($TBol->Partido['V']); else $dtpa="";

							$csv_export .= $xml->Boletin->Numero['V'].$sep;									//1
							$csv_export .= $xml->Boletin->Mesas_Instaladas['V'].$sep;						//2
							$nvo = intval($xml->Boletin->Porc_Mesas_Informadas['V']);
							$nvo2 = substr($xml->Boletin->Porc_Mesas_Informadas['V'],3,strpos($xml->Boletin->Porc_Mesas_Informadas['V'],","));
							//$nvo2 = substr($xml->Boletin->Porc_Mesas_Informadas['V'],3,strpos($xml->Boletin->Porc_Mesas_Informadas['V'],"."));
							$por = str_replace(",", ".", $nvo.$nvo2);
							$csv_export .= '"'.$por.'"'.$sep;												//3
							$csv_export .= $xml->Boletin->Desc_Departamento['V'].$sep;						//4 Departamento
							$nvo = number_format(intval($TBol->Votos['V']), 0, ',', '.');
							$csv_export .= '"'.$nvo.'"'.$sep;												//5
							$nvo = intval($TBol->Porc['V']);
							$nvo2 = substr($TBol->Porc['V'],3,strpos($TBol->Porc['V'],","));
							$por = str_replace(",", ".", $nvo.$nvo2);
							$csv_export .= '"'.$por.'"'.$sep;												//6 Porc Candidato
							$csv_export .= $TBol->Partido['V'].$sep;										//7
							$csv_export .= '"'.$dtpa[0]["elenp"].'"'.$sep;									//8 Nombre Partido
							$csv_export.= '
';
						}
					//}
				//}
			}elseif($nu=="1" OR $nu=="2" OR $nu=="4"){   // SENADO y CAMARA
				//$titulosColumnas = array('','CANDIDATO','VOTOS','PORCENTAJE','PARTIDO','BOLETIN','ESCRUTADO');
				$titulosColumnas = array('BOLETIN','MESAS INF','PORCENTAJE MESAS','DEPARTAMENTO','CANDIDATO','PORCENTAJE CANDIDATO','VOTOS', 'PARTIDO', 'NOMBRE', 'Partido');

				if($nu=="1") $csv_filename = 'Senado '.substr($arc2,7,2).'.csv';
				if($nu=="4") $csv_filename = 'Camara '.substr($arc2,7,2).'.csv';
				if($nu=="2") $csv_filename = 'Citrep '.substr($arc2,7,2).'.csv';
				$csv_export = '';
				$field = count($titulosColumnas);
				for($i = 0; $i < $field; $i++) {
					$csv_export.= $titulosColumnas[$i];
					if($i<($field-1)) $csv_export.= $sep;
				}
				$csv_export.= '
';

// Quitar el candidato con cada Detalle_Partido
// agregar porcentaje de cada Detalle_Candidato
// cantidad de caracteres del candidato (primer nombre primer apellido) No funciona

				foreach ($xml->Boletin as $Tlb) {
					foreach ($Tlb->Detalle_Circunscripcion->lin as $Tlin) {
						foreach ($Tlin->Detalle_Candidato->lin as $TBol) {
							if($TBol->Candidato['V']) $obj = $mcsv->getCc($TBol->Candidato['V'],$TBol->Partido['V'],$corp); else $obj="";
							if($TBol->Partido['V']) $dtpa = $mcsv->getPar($TBol->Partido['V']); else $dtpa="";

							$nomca = trim($obj[0]["ncan"]).' '.trim($obj[0]["acan"]);
							if($nomca<>trim($dtpa[0]["elenp"])){
								// $nn = substr(trim($obj[0]["ncan"]), 0,(strpos(trim($obj[0]["ncan"])," ")));
								// $nn = isset($nn) ? $nn:trim($obj[0]["ncan"]);
								// $na = substr(trim($obj[0]["acan"]), 0,(strpos(trim($obj[0]["acan"])," ")));
								// $na = isset($na) ? $na:trim($obj[0]["acan"]);
								//$nomca = $nn." ".$na;
								$nomca = substr($nomca, 0,34);
								$csv_export .= $xml->Boletin->Numero['V'].$sep;									//1
								$csv_export .= $xml->Boletin->Mesas_Instaladas['V'].$sep;						//2
								$nvo = intval($xml->Boletin->Porc_Mesas_Informadas['V']);
								$nvo2 = substr($xml->Boletin->Porc_Mesas_Informadas['V'],3,strpos($xml->Boletin->Porc_Mesas_Informadas['V'],","));
								//$nvo2 = substr($xml->Boletin->Porc_Mesas_Informadas['V'],3,strpos($xml->Boletin->Porc_Mesas_Informadas['V'],"."));
								$por = str_replace(",", ".", $nvo.$nvo2);
								$csv_export .= '"'.$por.'"'.$sep;												//3
								$csv_export .= $xml->Boletin->Desc_Departamento['V'].$sep;						//4 Departamento
								//$csv_export .= $TBol->Candidato['V'].$sep;										//5 No. Candidato
								if($obj) $csv_export .= '"'.trim($obj[0]["ccan"]).'"'.$sep;						//4 Cedula Candida
								$nvo = intval($TBol->Porc['V']);
								$nvo2 = substr($TBol->Porc['V'],3,strpos($TBol->Porc['V'],","));
								$por = str_replace(",", ".", $nvo.$nvo2);
								$csv_export .= '"'.$por.'"'.$sep;												//6 Porc Candidato
								$nvo = number_format(intval($TBol->Votos['V']), 0, ',', '.');
								$csv_export .= '"'.$nvo.'"'.$sep;												//7
								$csv_export .= $TBol->Partido['V'].$sep;										//8
								if($obj) $csv_export .= '"'.$nomca.'"'.$sep;									//9 Nombre Candidato
								else $csv_export .= $sep;
								$csv_export .= '"'.$dtpa[0]["elenp"].'"'.$sep;									//10 Nombre Partido
								$csv_export.= '
';
							}
						}
					}
				}
			}elseif($nu=="3" OR $nu=="5"){   // CONSULTA
				//$titulosColumnas = array('','CANDIDATO','VOTOS','PORCENTAJE','PARTIDO','BOLETIN','ESCRUTADO');
				$titulosColumnas = array('BOLETIN','MESAS INF','PORCENTAJE MESAS','CANDIDATO','PORCENTAJE','VOTOS', 'DEPARTAMENTO','CEDULA');
				if($nu=="3") $csv_filename = 'FullPresidencia_'.substr($arc2,4,2).'.csv';
				if($nu=="5") $csv_filename = 'BannerPresidencia_'.substr($arc2,4,2).'.csv';
				$csv_export = '';
				$field = count($titulosColumnas);
				for($i = 0; $i < $field; $i++) {
					$csv_export.= $titulosColumnas[$i];
					if($i<($field-1)) $csv_export.= $sep;
				}
				$csv_export.= '
';
				$csv_export.= $xml->Boletin->Numero['V'].$sep;
				$csv_export.= $xml->Boletin->Mesas_Informadas['V'].$sep;
				$csv_export.= $sep;
				if($nu=="5") $csv_export .= "B";
				$csv_export.= "Blanco".$sep;
				foreach ($xml->Boletin->Detalle_Circunscripcion->lin->Detalle_Partidos_Totales->lin as $TBol) {
					if($TBol->Descripcion['V']=='VOTOS EN BLANCO'){
						$csv_export.=  $TBol->Porc['V'].$sep;
						$csv_export.=  number_format(intval($TBol->Votos['V']), 0, ',', '.').$sep;
					}
				}
				$csv_export.= $sep;
				$csv_export.= '
';
				$csv_export.= $xml->Boletin->Numero['V'].$sep;
				$csv_export.= $xml->Boletin->Mesas_Informadas['V'].$sep;
				$csv_export.= $sep;
				if($nu=="5") $csv_export .= "B";
				$csv_export.= "Nulos".$sep;
				$csv_export.= $xml->Boletin->Porc_Votos_Nulos['V'].$sep;
				$csv_export.= number_format(intval($xml->Boletin->Votos_Nulos['V']), 0, ',', '.').$sep;
				$csv_export.= $sep;
				$csv_export.= '
';
				foreach ($xml->Boletin as $Tlb) {
					foreach ($Tlb->Detalle_Circunscripcion->lin as $Tlin) {
						foreach ($Tlin->Detalle_Candidato->lin as $TBol) {
							if($TBol->Candidato['V']) $obj = $mcsv->getCc($TBol->Candidato['V'],$TBol->Partido['V'],$corp); else $obj="";
							if($TBol->Partido['V']) $dtpa = $mcsv->getPar($TBol->Partido['V']); else $dtpa="";
							$csv_export .= $xml->Boletin->Numero['V'].$sep;						// 1 No Boletin 
							$csv_export .= $xml->Boletin->Mesas_Informadas['V'].$sep;			// 2 Mesas Info
							$nvo = intval($xml->Boletin->Porc_Mesas_Informadas['V']);
							$nvo2 = substr($xml->Boletin->Porc_Mesas_Informadas['V'],3,strpos($xml->Boletin->Porc_Mesas_Informadas['V'],","));
							//$nvo2 = substr($xml->Boletin->Porc_Mesas_Informadas['V'],3,strpos($xml->Boletin->Porc_Mesas_Informadas['V'],"."));
							$por = str_replace(",", ".", $nvo.$nvo2);
							$csv_export .= '"'.$por.'"'.$sep;									// 3 Porcentaje Mesas
							if($nu=="5") $csv_export .= "B";
							$csv_export .= intval($TBol->Candidato['V']).$sep;					// 4 No. Candidato
							//if($obj) $csv_export .= '"'.trim($obj[0]["ccan"]).'"'.$sep;		// 4 Cedula
							$csv_export .= $TBol->Porc['V'].$sep;								// 5 Porcentaje
							$nvo = number_format(intval($TBol->Votos['V']), 0, ',', '.');
							$csv_export .= '"'.$nvo.'"'.$sep;									// 6 Votos
							if ($xml->Boletin->Desc_Municipio['V']=="NO APLICA") $mnp = "NACIONAL"; else $mnp = $xml->Boletin->Desc_Municipio['V'];
							$csv_export .= $mnp.$sep;											// 7 Departamento
							$csv_export .= '"'.trim($obj[0]["ccan"]).'"'.$sep;
							$csv_export.= '
';
						}
					}
				}
			}
// 			else if($nu=="2"){ // CITREP
// 				$titulosColumnas = array('CANDIDATO','VOTOS','PORCENTAJE','BOLETIN','ESCRUTADO');
// 				$csv_filename = 'Citrep '.substr($arc2,7,2).'.csv';
// 				$csv_export = '';
// 				$field = count($titulosColumnas);
// 				for($i = 0; $i < $field; $i++) {
// 					$csv_export.= $titulosColumnas[$i];
// 					if($i<($field-1)) $csv_export.= $sep;
// 				}
// 				$csv_export.= '
// ';
// 				foreach ($xml->Boletin as $Tlb) {
// 					foreach ($Tlb->Detalle_Circunscripcion->lin as $Tlin) {
// 						foreach ($Tlin->Detalle_Candidato->lin as $TBol) {
// 							if($TBol->Candidato['V']) $obj = $mcsv->getCc($TBol->Candidato['V'],$TBol->Partido['V'],$corp); else $obj="";
// 							if($TBol->Partido['V']) $dtpa = $mcsv->getPar($TBol->Partido['V']); else $dtpa="";

// 							$csv_export .= '"'.trim($obj[0]["ncan"]).' '.trim($obj[0]["acan"]).'"'.$sep;
// 							//$csv_export .= $TBol->Candidato['V'].$sep;
// 							//$csv_export .= '"'.$TBol->Votos['V'].'"'.$sep;
// 							$nvo = number_format(intval($TBol->Votos['V']), 0, ',', '.');
// 							$csv_export .= '"'.$nvo.'"'.$sep;
// 							//$csv_export .= '"'.$TBol->Porc['V'].'"'.$sep;
// 							$por = str_replace(",", ".", $TBol->Porc['V']);
// 							$csv_export .= '"'.$por.'"'.$sep;
// 							$csv_export .= $Tlb->Numero['V'].$sep;
// 							//$csv_export .= '"'.$Tlb->Porc_Sufragantes['V'].'"'.$sep;
// 							$por = str_replace(",", ".", $Tlb->Porc_Sufragantes['V']);
// 							$csv_export .= '"'.$por.'"'.$sep;
// 							$csv_export.= '
// ';
// 						}
// 					}
// 				}
// 			}
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



// 				foreach ($xml->Boletin as $Tlb) {
// 					foreach ($Tlb->Detalle_Circunscripcion->lin as $Tlin) {
// 						foreach ($Tlin->Detalle_Candidato->lin as $TBol) {
// 							if($TBol->Candidato['V']) $obj = $mcsv->getCc($TBol->Candidato['V'],$TBol->Partido['V']); else $obj="";
// 							if($TBol->Partido['V']) $dtpa = $mcsv->getPar($TBol->Partido['V']); else $dtpa="";

// 							$csv_export .= '"'.trim($obj[0]["ncan"]).' '.trim($obj[0]["acan"]).'"'.$sep;
// 							//$csv_export .= $TBol->Candidato['V'].$sep;
// 							$nvo = number_format(intval($TBol->Votos['V']), 0, ',', '.');
// 							$csv_export .= '"'.$nvo.'"'.$sep;
// 							//$csv_export .= '"'.$TBol->Votos['V'].'"'.$sep;
// 							//$csv_export .= '"'.$TBol->Porc['V'].'"'.$sep;
// 							$por = str_replace(",", ".", $TBol->Porc['V']);
// 							$csv_export .= '"'.$por.'"'.$sep;
// 							//$csv_export .= $TBol->Partido['V'].' '.$dtpa[0]["elenp"].$sep;
// 							$csv_export .= '"'.$dtpa[0]["elenp"].'"'.$sep;
// 							//$csv_export .= $TBol->Partido['V'].$sep;
// 							$csv_export .= $Tlb->Numero['V'].$sep;
// 							//$csv_export .= '"'.$Tlb->Porc_Sufragantes['V'].'"'.$sep;
// 							$por = str_replace(",", ".", $Tlb->Porc_Sufragantes['V']);
// 							$csv_export .= '"'.$por.'"'.$sep;
// 							$csv_export.= '
// ';
// 						}
// 					}
// 				}



*/




?>