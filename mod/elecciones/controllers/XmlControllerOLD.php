<?php
include 'models/mbas.php';
require_once '../../PHPExcel/Classes/PHPExcel.php';

class xmlController{
	
	public function index(){		
		Utils::useraccess('xml/index',$_SESSION['pefid']);
		$html = NULL;
		$_SESSION['mc2'] = isset($_REQUEST['mc']) ? $_REQUEST['mc']:NULL;
		$mbas = new Mbas();
		$dom = $mbas->getDom();
		$demu = $mbas->getDeMu();
		require_once 'views/vxml.php';
	}

	public function full(){		
		Utils::useraccess('xml/full',$_SESSION['pefid']);
		$html = NULL;
		$_SESSION['mc2'] = isset($_REQUEST['mc']) ? $_REQUEST['mc']:NULL;
		$mbas = new Mbas();
		$mbas->setNomvel($_SESSION['mc2']);
		$mbas->setMc();
		$demu = $mbas->getDeMu();
		require_once 'views/vver.php';
	}
	public function inser(){		
		Utils::useraccess('xml/index',$_SESSION['pefid']);
		date_default_timezone_set('America/Bogota');
   		$fecSis = date("Y-m-d H:i:s");
   		$mbas = new Mbas();
		$dom = $mbas->getDom();
		$demu = $mbas->getDeMu();
		$tipo = isset($_POST['tipo']) ? $_POST['tipo']:NULL;
		$docext =NULL;
		$_SESSION['mc2'] = NULL;

   		$html = NULL;
////////////////////// Cargar archivos Inicio /////////////////////////////
   		$arcexc = isset($_FILES['arcexc']["name"]) ? $_FILES['arcexc']["name"]:NULL;
   		if($arcexc){
   			$pre = substr($_FILES['arcexc']["name"],0,3);
			$arcexc2 = Utils::opti($_FILES['arcexc'], date('YmdHis'),"zip",$pre);
			$docext = pathinfo($_FILES['arcexc']["name"], PATHINFO_EXTENSION);
			$html .= "<br>El archivo se cargó correctamente en el servidor.";
		}else{
			$html .= "<br>ERROR: El archivo No se cargó en el servidor.";
		}
		
////////////////////// Cargar archivos Fin /////////////////////////////

////////////////////// Extrae zip Inicio /////////////////////////////
		if($docext=='zip' or $docext=='gz'){
			//$rut = 'C:/xampp/htdocs/erp/mod/elecciones/elec';
			$rut = path_file.'elec';
			//$rut = '/elec';
			$extract = Utils::extract($arcexc2, $rut, $_FILES['arcexc']["name"]);
			if($extract){
			    //echo $GLOBALS['status']['success'];
			    $html .= "<br>Se descomprimio el archivo exitosamente.";
			}else{
			    $html .= $GLOBALS['status']['error'];
			}
		}
////////////////////// Extrae zip Fin /////////////////////////////

////////////////////// Lee el XML, compara datos, inserta INICIO /////////////////////////////
		$rt = 'elec/'.substr($arcexc, 0, strpos($arcexc, ".gz"));

		// echo $rt;
		$html .= $this->mosxml($rt);
		

////////////////////// Lee el XML, compara datos, inserta FIN /////////////////////////////
		require_once 'views/vxml.php';
	}


	public function mosxml($arc){
		$mbas = new Mbas();
		$html = '';
		$html1 = '';
		$html .= "<BR><strong>Nombre de archivo cargado:</strong> ".path_file.$arc;
		// var_dump(file_exists($arc));
		// die();

		if (file_exists(path_file.$arc)) {
		    $xml = simplexml_load_file(path_file.$arc);
		    $btn = substr($arc,9,2);
		    $tip = substr($arc,12,2);
		    $html .= '<br><br>';
		    $html .= '<div class="row">';
		    //echo $btn;
		    if($btn=="AL"){ //ALCALDÍA
				$html .= '<div class="form-group col-md-3">';
					$html .= '<a href="../views/vcsv.php?arc='.substr($arc,5).'&nu=4" target="_blank"><button class="btn-primary-ccapital">ALCALDÍA ABIERTA</button></a>';
				    $html .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				$html .= '</div>';
				$html .= '<div class="form-group col-md-3">';
					$html .= '<a href="../views/vcsv.php?arc='.substr($arc,5).'&nu=4&cer=1" target="_blank"><button class="btn-primary-ccapital">ALCALDÍA CERRADA</button></a>';
				    $html .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				$html .= '</div>';
			}elseif($btn=="GO"){ //GOBERNACIÓN
				$html .= '<div class="form-group col-md-3">';
					$html .= '<a href="../views/vcsv.php?arc='.substr($arc,5).'&nu=4" target="_blank"><button class="btn-primary-ccapital">GOBERNACIÓN</button></a>';
				    $html .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				$html .= '</div>';
				// $html .= '<div class="form-group col-md-3">';
				// 	$html .= '<a href="../views/vcsv.php?arc='.substr($arc,5).'&nu=4&cer=1" target="_blank"><button class="btn-primary-ccapital">GOBERNACIÓN CERRADA</button></a>';
				//     $html .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				// $html .= '</div>';
			}elseif($btn=="CO"){ //CONCEJO MUNICIPAL
				$html .= '<div class="form-group col-md-3">';
					$html .= '<a href="../views/vcsv.php?arc='.substr($arc,5).'&nu=4" target="_blank"><button class="btn-primary-ccapital">CONCEJO MUNICIPAL ABIERTA</button></a>';
				    $html .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				$html .= '</div>';
				$html .= '<div class="form-group col-md-3">';
					$html .= '<a href="../views/vcsv.php?arc='.substr($arc,5).'&nu=4&cer=1" target="_blank"><button class="btn-primary-ccapital">CONCEJO MUNICIPAL CERRADA</button></a>';
				    $html .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				$html .= '</div>';
			}elseif($btn=="AS"){ //ASAMBLEA DEPARTAMENTAL
				$html .= '<div class="form-group col-md-3">';
					$html .= '<a href="../views/vcsv.php?arc='.substr($arc,5).'&nu=4" target="_blank"><button class="btn-primary-ccapital">ASAMBLEA DEPARTAMENTAL ABIERTA</button></a>';
				    $html .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				$html .= '</div>';
				$html .= '<div class="form-group col-md-3">';
					$html .= '<a href="../views/vcsv.php?arc='.substr($arc,5).'&nu=4&cer=1" target="_blank"><button class="btn-primary-ccapital">ASAMBLEA DEPARTAMENTAL CERRADA</button></a>';
				    $html .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				$html .= '</div>';
			}elseif($btn=="CA"){ // CAMARA DE REPRESENTANTES
				$html .= '<div class="form-group col-md-3">';
					$html .= '<a href="../views/vcsv.php?arc='.substr($arc,5).'&nu=4" target="_blank"><button class="btn-primary-ccapital">CAMARA ABIERTA</button></a>';
				    $html .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				$html .= '</div>';
				$html .= '<div class="form-group col-md-3">';
					$html .= '<a href="../views/vcsv.php?arc='.substr($arc,5).'&nu=4&cer=1" target="_blank"><button class="btn-primary-ccapital">CAMARA CERRADA</button></a>';
				    $html .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				$html .= '</div>';
			}elseif($btn=="SE"){ // SENADO DE LA REPUBLICA
				$html .= '<div class="form-group col-md-3">';
				    $html .= '<a href="../views/vcsv.php?arc='.substr($arc,5).'&nu=1" target="_blank"><button class="btn-primary-ccapital">SENADO ABIERTA</button></a>';
				    $html .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				$html .= '</div>';
				$html .= '<div class="form-group col-md-3">';
				    $html .= '<a href="../views/vcsv.php?arc='.substr($arc,5).'&nu=1&cer=1" target="_blank"><button class="btn-primary-ccapital">SENADO CERRADA</button></a>';
				    $html .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				$html .= '</div>';
			}elseif($btn=="CT"){ // CITREP
				$html .= '<div class="form-group col-md-3">';
				    $html .= '<a href="../views/vcsv.php?arc='.substr($arc,5).'&nu=2" target="_blank"><button class="btn-primary-ccapital">CITREP ABIERTA</button></a>';
				    $html .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				$html .= '</div>';
				$html .= '<div class="form-group col-md-3">';
				    $html .= '<a href="../views/vcsv.php?arc='.substr($arc,5).'&nu=2&cer=1" target="_blank"><button class="btn-primary-ccapital">CITREP CERRADA</button></a>';
				    $html .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				$html .= '</div>';
			}else{ //OTROS
				$html .= '<div class="form-group col-md-3">';
				    $html .= '<a href="../views/vcsv.php?arc='.substr($arc,5).'&nu=3" target="_blank"><button class="btn-primary-ccapital">FULL CSV</button></a>';
				$html .= '</div>';
				$html .= '<div class="form-group col-md-3">';
				    $html .= '<a href="../views/vcsv.php?arc='.substr($arc,5).'&nu=5" target="_blank"><button class="btn-primary-ccapital">Banner CSV</button></a>';
				$html .= '</div>';
			}
			$html .= '</div>';

		    //$html .= '<br><br>';

		    $html .= '<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">';
		    	$html .= '<thead>';
					$html .= '<tr>';
						$html .= '<th>Información</th>';
						$html .= '<th>Datos</th>';
					$html .= '</tr>';
				$html .= '</thead>';
		    	$html .= '<tbody>';
		    //foreach ($xml->Boletin as $Tlb) {
					$html .= '<tr>';
						$html .= '<th>Boletin Numero</th>';
						$html .= '<td>'.$xml->Boletin->Numero['V'].'</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Boletin_Departamental</th>';
						$html .= '<td>'.$xml->Boletin->Boletin['V'].'</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Tipo_Boletin</th>';
						$html .= '<td>'.$xml->Boletin->Tipo_Boletin['V'].'</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Desc_Corporacion</th>';
						$html .= '<td>'.$xml->Boletin->Desc_Corporacion['V'].'</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Departamento</th>';
						$html .= '<td>'.$xml->Boletin->Departamento['V'].'</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Desc_Departamento</th>';
						$html .= '<td>'.$xml->Boletin->Desc_Departamento['V'].'</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Municipio</th>';
						$html .= '<td>'.$xml->Boletin->Municipio['V'].'</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Desc_Municipio</th>';
						$html .= '<td>'.$xml->Boletin->Desc_Municipio['V'].'</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Fecha</th>';
						$html .= '<td>'.$xml->Boletin->Dia['V'].'/'.$xml->Boletin->Mes['V'].'/'.$xml->Boletin->Anio['V'].'</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Hora</th>';
						$html .= '<td>'.$xml->Boletin->Hora['V'].':'.$xml->Boletin->Minuto['V'].':'.$xml->Boletin->Seg['V'].'</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Mesas_Instaladas</th>';
						$html .= '<td>'.$xml->Boletin->Mesas_Instaladas['V'].'</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Mesas_Informadas</th>';
						$html .= '<td>'.$xml->Boletin->Mesas_Informadas['V'].'</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Porc_Mesas_Informadas</th>';
						$html .= '<td>'.$xml->Boletin->Porc_Mesas_Informadas['V'].'</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Potencial_Sufragantes</th>';
						$html .= '<td>'.$xml->Boletin->Potencial_Sufragantes['V'].'</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Total_Sufragantes</th>';
						$html .= '<td>'.$xml->Boletin->Total_Sufragantes['V'].'</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Porc_Sufragantes</th>';
						$html .= '<td>'.$xml->Boletin->Porc_Sufragantes['V'].'</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Votos_Nulos</th>';
						$html .= '<td>'.$xml->Boletin->Votos_Nulos['V'].'</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Porc_Votos_Nulos</th>';
						$html .= '<td>'.$xml->Boletin->Porc_Votos_Nulos['V'].'</td>';
					$html .= '</tr>';
					$html .= '<tr>';
						$html .= '<th>Votos_No_Marcados</th>';
						$html .= '<td>'.$xml->Boletin->Votos_No_Marcados['V'].'</td>';
					$html .= '</tr>';
					$vbnul = $xml->Boletin->Votos_Nulos['V'];
					$vbpnul = str_replace(",", ".", $xml->Boletin->Porc_Votos_Nulos['V']);
			//}
				$html .= '</tbody>';
				$html .= '<tfoot>';
					$html .= '<tr>';
						$html .= '<th>Información</th>';
						$html .= '<th>Datos</th>';
					$html .= '</tr>';
				$html .= '</tfoot>';
			$html .= '</table>';

			$html .= '<br><br>';



			// if($tip<>'00') $mbas->delResulm();
		    $html .= '<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">';
		    	$html .= '<thead>';
					$html .= '<tr>';
						$html .= '<th>Partido</th>';
						$html .= '<th>Desc</th>';
						$html .= '<th>Votos</th>';
						$html .= '<th>Porc</th>';
					$html .= '</tr>';
				$html .= '</thead>';
				$html .= '<tbody>';
				foreach ($xml->Boletin as $Tlb) {
					foreach ($Tlb->Detalle_Circunscripcion->lin as $Tlin) {
						foreach ($Tlin->Detalle_Partidos_Totales->lin as $TBol) {
							$html .= '<tr>';
								$dtpa = $mbas->getPar($TBol->Partido['V']);
								$html .= '<td>'.$TBol->Partido['V'].' ';
								if($dtpa) $html .= $dtpa[0]["elenp"].'</td>';
								$html .= '<td>'.$TBol->Descripcion['V'].'</td>';
								$html .= '<td>'.$TBol->Votos['V'].'</td>';
								$html .= '<td>'.$TBol->Porc['V'].'</td>';

								$vbnom = 0;
								$vbpor = 0;
								
								if($TBol->Descripcion['V']=='VOTOS EN BLANCO'){
									$vbnom = $TBol->Descripcion['V'];
									$vbnom = $TBol->Votos['V'];
									$vbpor = $TBol->Porc['V'];
									//echo $TBol->Descripcion['V']." ".$vbnom." ".$vbpor."<br>";
								}
							$html .= '</tr>';

							/// Cargando votos en blanco Inicio ///////////////////////////////////////////
							if($vbnom){
										$mbas->setIdcan(90900900);
										$mbas->setVoto($vbnom);
										$mbas->setPorce(str_replace(",", ".", $vbpor));
										$mbas->setElcp(90900900);
										$mbas->setBolnum($Tlb->Numero['V']);
										$mbas->setPorinfo(str_replace(",", ".", $Tlb->Porc_Mesas_Informadas['V']));
										// if($xml->Boletin->Desc_Municipio['V']=='NO APLICA')
										// 	$ncip = 'NACIONAL';
										// else
										// 	$ncip = $xml->Boletin->Desc_Municipio['V'];
										if($Tlb->Desc_Departamento['V']=='NO APLICA' && $Tlb->Desc_Municipio['V']=='NO APLICA')
											$ncip = 'NACIONAL';
										elseif($Tlb->Desc_Municipio['V']=='NO APLICA')
											$ncip = $Tlb->Desc_Departamento['V'];
										else
											$ncip = $Tlb->Desc_Municipio['V'];
										$mbas->setMuni($ncip);
										$mbas->setMesinf($Tlb->Mesas_Informadas['V']);
										// if($tip<>'00'){
										// 	$mbas->insResulm();
										// }else{
										// 	$mbas->delResul();
										// 	$mbas->insResul();
										// }
										if($btn=="AL") $mbas->insResulm("eleral"); //ALCALDÍA
										elseif($btn=="GO") $mbas->insResulm("elergo"); //GOBERNACIÓN
										elseif($btn=="CO") $mbas->insResulm("elerco"); //CONCEJO MUNICIPAL
										elseif($btn=="AS") $mbas->insResulm("eleras"); //ASAMBLEA DEPARTAMENTAL
										elseif($btn=="CA") $mbas->insResulm("elerca"); // CAMARA DE REPRESENTANTES
										elseif($btn=="CT") $mbas->insResulm("elerpr"); //Presidencia
									}
							/// Cargando votos en blanco Fin ///////////////////////////////////////////

						}
					}
					$vbnul = $Tlb->Votos_Nulos['V'];
					$vbpnul = str_replace(",", ".", $Tlb->Porc_Votos_Nulos['V']);
					/// Cargando votos nulos Inicio ///////////////////////////////////////////
						$mbas->setIdcan(90900950);
						$mbas->setVoto($vbnul);
						$mbas->setPorce(str_replace(",", ".", $vbpnul));
						$mbas->setElcp(90900950);
						$mbas->setBolnum($Tlb->Numero['V']);
						$mbas->setPorinfo(str_replace(",", ".", $Tlb->Porc_Mesas_Informadas['V']));
						// if($xml->Boletin->Desc_Municipio['V']=='NO APLICA')
						// 	$ncip = 'NACIONAL';
						// else
						// 	$ncip = $xml->Boletin->Desc_Municipio['V'];
						if($Tlb->Desc_Departamento['V']=='NO APLICA' && $Tlb->Desc_Municipio['V']=='NO APLICA')
							$ncip = 'NACIONAL';
						elseif($Tlb->Desc_Municipio['V']=='NO APLICA')
							$ncip = $Tlb->Desc_Departamento['V'];
						else
							$ncip = $Tlb->Desc_Municipio['V'];
						$mbas->setMuni($ncip);
						$mbas->setMesinf($Tlb->Mesas_Informadas['V']);
						// if($tip<>'00'){
						// 	$mbas->insResulm();
						// }else{
						// 	$mbas->delResul();
						// 	$mbas->insResul();
						// }
						if($btn=="AL") $mbas->insResulm("eleral"); //ALCALDÍA
						elseif($btn=="GO") $mbas->insResulm("elergo"); //GOBERNACIÓN
						elseif($btn=="CO") $mbas->insResulm("elerco"); //CONCEJO MUNICIPAL
						elseif($btn=="AS") $mbas->insResulm("eleras"); //ASAMBLEA DEPARTAMENTAL
						elseif($btn=="CA") $mbas->insResulm("elerca"); // CAMARA DE REPRESENTANTES
						elseif($btn=="CT") $mbas->insResulm("elerpr"); //Presidencia
					/// Cargando votos nulos Fin ///////////////////////////////////////////
				}
				$html .= '</tbody>';
				$html .= '<tfoot>';
					$html .= '<tr>';
						$html .= '<th>Partido</th>';
						$html .= '<th>Desc</th>';
						$html .= '<th>Votos</th>';
						$html .= '<th>Porc</th>';
					$html .= '</tr>';
				$html .= '</tfoot>';
			$html .= '</table>';


			$html .= '<br><br>';

			$html .= '<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">';
				$html .= '<thead>';
					$html .= '<tr>';
						$html .= '<th>Partido</th>';
						$html .= '<th>Votos</th>';
						$html .= '<th>Porc</th>';
						$html .= '<th>Pref</th>';
						$html .= '<th>Curules</th>';
					$html .= '</tr>';
				$html .= '</thead>';
				$html .= '<tbody>';
				//foreach ($xml->Boletin as $Tlb) {
					//foreach ($Tlb->Detalle_Circunscripcion->lin as $Tlin) {
						foreach ($xml->Boletin->Detalle_Circunscripcion->lin->Detalle_Partido->lin as $TBol) {
							$html .= '<tr>';
								$dtpa = $mbas->getPar($TBol->Partido['V']);
								$html .= '<td>'.$TBol->Partido['V'].' '.$dtpa[0]["elenp"].'</td>';
								$html .= '<td>'.$TBol->Votos['V'].'</td>';
								$html .= '<td>'.$TBol->Porc['V'].'</td>';
								$html .= '<td>'.$TBol->Pref['V'].'</td>';
								$html .= '<td>'.$TBol->Curules['V'].'</td>';
							$html .= '</tr>';
						}
					//}
				//}
				$html .= '</tbody>';
				$html .= '<tfoot>';
					$html .= '<tr>';
						$html .= '<th>Partido</th>';
						$html .= '<th>Votos</th>';
						$html .= '<th>Porc</th>';
						$html .= '<th>Pref</th>';
						$html .= '<th>Curules</th>';
					$html .= '</tr>';
				$html .= '</tfoot>';
			$html .= '</table>';

			$html .= '<br><br>';
			
			$html .= '<table id="example" class="table table-striped table-bordered dterpc" style="width:100%;">';
				$html .= '<thead>';
					$html .= '<tr>';
						//$html .= '<th>Amb_Presenc</th>';
						$html .= '<th>No. Can</th>';
						$html .= '<th>Candidato</th>';
						$html .= '<th>Votos</th>';
						$html .= '<th>Porc</th>';
						$html .= '<th>Partido</th>';
						$html .= '<th>Sec</th>';
					$html .= '</tr>';
				$html .= '</thead>';
				$html .= '<tbody>';
				foreach ($xml->Boletin as $Tlb) {
					foreach ($Tlb->Detalle_Circunscripcion->lin as $Tlin) {
						foreach ($Tlin->Detalle_Candidato->lin as $TBol) {
							$html .= '<tr>';
								$dtpa = $mbas->getCc($TBol->Candidato['V'],$TBol->Partido['V']);
								$html .= '<td>'.$TBol->Candidato['V'].' </td>';
								$html .= '<td>';
									if($dtpa) $html .= $dtpa[0]["ncan"].' '.$dtpa[0]["acan"];
								$html .= ' </td>';
								$html .= '<td>'.$TBol->Votos['V'].'</td>';
								$html .= '<td>'.$TBol->Porc['V'].'</td>';
								$dtpa = $mbas->getPar($TBol->Partido['V']);
								$html .= '<td>'.$TBol->Partido['V'].' '.$dtpa[0]["elenp"].' </td>';
								$html .= '<td>'.$TBol->Sec['V'].'</td>';

////////////////////////////////////////////////////////////////////////
							// echo $TBol->Candidato['V'].$TBol->Votos['V'].$TBol->Porc['V'].$TBol->Partido['V'];
							$mbas->setIdcan($TBol->Candidato['V']);
							$mbas->setVoto($TBol->Votos['V']);
							$mbas->setPorce(str_replace(",", ".", $TBol->Porc['V']));
							$mbas->setElcp($TBol->Partido['V']);
							$mbas->setBolnum($Tlb->Numero['V']);
							$mbas->setPorinfo(str_replace(",", ".", $Tlb->Porc_Mesas_Informadas['V']));
							$mbas->setMesinf($Tlb->Mesas_Informadas['V']);
							if($Tlb->Desc_Departamento['V']=='NO APLICA' && $Tlb->Desc_Municipio['V']=='NO APLICA')
								$ncip = 'NACIONAL';
							elseif($Tlb->Desc_Municipio['V']=='NO APLICA')
								$ncip = $Tlb->Desc_Departamento['V'];
							else
								$ncip = $Tlb->Desc_Municipio['V'];
								// $ncip = $xml->Boletin->Desc_Municipio['V'];
							$mbas->setMuni($ncip);
							// if($tip<>'00'){
							// 	$mbas->insResulm();
							// }else{
							// 	$mbas->delResul();
							// 	$mbas->insResul();
							// }


						    if($btn=="AL") $mbas->insResulm("eleral"); //ALCALDÍA
							elseif($btn=="GO") $mbas->insResulm("elergo"); //GOBERNACIÓN
							elseif($btn=="CO") $mbas->insResulm("elerco"); //CONCEJO MUNICIPAL
							elseif($btn=="AS") $mbas->insResulm("eleras"); //ASAMBLEA DEPARTAMENTAL
							elseif($btn=="CA") $mbas->insResulm("elerca"); // CAMARA DE REPRESENTANTES
							elseif($btn=="CT") $mbas->insResulm("elerpr"); //Presidencia
							// elseif($btn=="SE") // SENADO DE LA REPUBLICA
							// elseif($btn=="CT") // CITREP
							 
////////////////////////////////////////////////////////////////////////

							$html .= '</tr>';
						}
					}
				}
				$html .= '</tbody>';
				$html .= '<tfoot>';
					$html .= '<tr>';
						//$html .= '<th>Amb_Presenc</th>';
						$html .= '<th>No. Can</th>';
						$html .= '<th>Candidato</th>';
						$html .= '<th>Votos</th>';
						$html .= '<th>Porc</th>';
						$html .= '<th>Partido</th>';
						$html .= '<th>Sec</th>';
					$html .= '</tr>';
				$html .= '</tfoot>';
			$html .= '</table>'; 
			//return $html;
		} else {
		   $html .= '<BR>No se ha cargado ningun archivo XML.';
		}
		return $html;
	}

	//function gencsv($arc, $nu){
	public function gencsv(){

		$arc = isset($_GET['arc']) ? $_GET['arc']:NULL;
		$nu = isset($_GET['nu']) ? $_GET['nu']:NULL;
		$mbas = new Mbas();
		$arc = "elec/".$arc;
		$html = '';
		if (file_exists($arc)) {
			$xml = simplexml_load_file($arc);
			if($nu=="1"){
				$titulosColumnas = array('Desc_Departamento','Circunscripcion','Desc_Circunscripcion','Numero_Curules','Partido','Descripcion','Votos','Porc');
				$csv_filename = 'Reporte.csv';
				$csv_export = '';
				$field = count($titulosColumnas);
				for($i = 0; $i < $field; $i++) {
					$csv_export.= $titulosColumnas[$i].';';
				}
				$csv_export.= '
	';
				foreach ($xml->Boletin as $Tlb) {
					foreach ($Tlb->Detalle_Circunscripcion->lin as $Tlin) {
						foreach ($Tlin->Detalle_Partidos_Totales->lin as $TBol) {
							$csv_export .= $Tlb->Desc_Departamento['V'].';';
							$csv_export .= $Tlin->Circunscripcion['V'].';';
							$csv_export .= $Tlin->Desc_Circunscripcion['V'].';';
							$csv_export .= $Tlin->Numero_Curules['V'].';';
							$csv_export .= $TBol->Partido['V'].';';
							$csv_export .= $TBol->Descripcion['V'].';';
							$csv_export .= $TBol->Votos['V'].';';
							$csv_export .= $TBol->Porc['V'].';';
							$csv_export.= '
	';
						}
					}
				}
			}else if($nu=="2"){
				$titulosColumnas = array('Desc_Departamento','Desc_Circunscripcion','Partido','Votos','Porc','Pref','Curules');
				$csv_filename = 'Reporte.csv';
				$csv_export = '';
				$field = count($titulosColumnas);
				for($i = 0; $i < $field; $i++) {
					$csv_export.= $titulosColumnas[$i].';';
				}
				$csv_export.= '
	';
				foreach ($xml->Boletin as $Tlb) {
					foreach ($Tlb->Detalle_Circunscripcion->lin as $Tlin) {
						foreach ($Tlin->Detalle_Partido->lin as $TBol) {
							$csv_export .= $Tlb->Desc_Departamento['V'].';';
							$csv_export .= $Tlin->Desc_Circunscripcion['V'].';';
							$dtpa = $mbas->getPar($TBol->Partido['V']);
							$csv_export .= $TBol->Partido['V'].' '.$dtpa[0]["elenp"];
							$csv_export .= $TBol->Votos['V'].';';
							$csv_export .= $TBol->Porc['V'].';';
							$csv_export .= $TBol->Pref['V'].';';
							$csv_export .= $TBol->Curules['V'].';';
							$csv_export.= '
	';
						}
					}
				}
			}else if($nu=="3"){
				$titulosColumnas = array('Desc_Departamento','Desc_Circunscripcion','Amb_Presenc','Candidato','Votos','Porc','Partido','Sec');
				$csv_filename = 'Reporte.csv';
				$csv_export = '';
				$field = count($titulosColumnas);
				for($i = 0; $i < $field; $i++) {
					$csv_export.= $titulosColumnas[$i].';';
				}
				$csv_export.= '
	';
				foreach ($xml->Boletin as $Tlb) {
					foreach ($Tlb->Detalle_Circunscripcion->lin as $Tlin) {
						foreach ($Tlin->Detalle_Candidato->lin as $TBol) {
							$obj = $mcan->getCc($TBol->Candidato['V']);
							$dtpa = $mbas->getPar($TBol->Partido['V']);
							$csv_export .= $Tlb->Desc_Departamento['V'].';';
							$csv_export .= $Tlin->Desc_Circunscripcion['V'].';';
							$csv_export .= $TBol->Amb_Presenc['V'].';';
							if($dtpa) $csv_export .= $obj[0]["ncan"].' '.$obj[0]["acan"];
							$csv_export .= $TBol->Votos['V'].';';
							$csv_export .= $TBol->Porc['V'].';';
							$csv_export .= $TBol->Partido['V'].' '.$dtpa[0]["elenp"].';';
							$csv_export .= $TBol->Sec['V'].';';
							$csv_export.= '
		';
						}
					}
				}
			}else if($nu=="4"){
				$titulosColumnas = array('Boletin Numero','Boletin_Departamental','Tipo_Boletin','Desc_Corporacion','Departamento','Desc_Departamento','Municipio','Desc_Municipio','Fecha','Hora','Mesas_Instaladas','Mesas_Informadas','Porc_Mesas_Informadas','Potencial_Sufragantes','Total_Sufragantes','Porc_Sufragantes','Votos_Nulos','Porc_Votos_Nulos','Votos_No_Marcados');
				$csv_filename = 'Reporte.csv';
				$csv_export = '';
				$field = count($titulosColumnas);
				for($i = 0; $i < $field; $i++) {
					$csv_export.= $titulosColumnas[$i].';';
				}
				$csv_export.= '
	';
				foreach ($xml->Boletin as $Tlb) {
						$csv_export .= $Tlb->Numero['V'].';';
						$csv_export .= $Tlb->Boletin_Departamental['V'].';';
						$csv_export .= $Tlb->Tipo_Boletin['V'].';';
						$csv_export .= $Tlb->Desc_Corporacion['V'].';';
						$csv_export .= $Tlb->Departamento['V'].';';
						$csv_export .= $Tlb->Desc_Departamento['V'].';';
						$csv_export .= $Tlb->Municipio['V'].';';
						$csv_export .= $Tlb->Desc_Municipio['V'].';';
						$csv_export .= $Tlb->Dia['V'].'/'.$Tlb->Mes['V'].'/'.$Tlb->Anio['V'].';';
						$csv_export .= $Tlb->Hora['V'].':'.$Tlb->Minuto['V'].':'.$Tlb->Seg['V'].';';
						$csv_export .= $Tlb->Mesas_Instaladas['V'].';';
						$csv_export .= $Tlb->Mesas_Informadas['V'].';';
						$csv_export .= $Tlb->Porc_Mesas_Informadas['V'].';';
						$csv_export .= $Tlb->Potencial_Sufragantes['V'].';';
						$csv_export .= $Tlb->Total_Sufragantes['V'].';';
						$csv_export .= $Tlb->Porc_Sufragantes['V'].';';
						$csv_export .= $Tlb->Votos_Nulos['V'].';';
						$csv_export .= $Tlb->Porc_Votos_Nulos['V'].';';
						$csv_export .= $Tlb->Votos_No_Marcados['V'].';';
						$csv_export.= '
	';
				}
			}
			header("Content-type: text/x-csv");
			header("Content-Disposition: attachment; filename=".$csv_filename."");
			echo($csv_export);
		}else{
			print_r('No hay resultados para mostrar');
		}
		//Utils::useraccess('xml/index',$_SESSION['pefid']);	
	}
}