<?php 
	require_once '../../../config/db.php';
	include'../models/radica.php';

	$btnagregar = isset($_POST["btnagregar"]) ? $_POST["btnagregar"]:NULL;


	if (isset($_POST['areaaso']) && $btnagregar == "Nueva Dependecia") {
		//echo 1;
		$gestor = new radica();	

		$areaaso = isset($_POST["areaaso"]) ? $_POST["areaaso"]:NULL;
		$num = isset($_POST["num"]) ? $_POST["num"]:NULL;
		$nomserie = isset($_POST["nomserie"]) ? $_POST["nomserie"]:NULL;
		$deptrd = 0;

		

		$areas="";
		if ($areaaso) {
			
			for ($i=0;$i<count($areaaso);$i++){   						
				//$solcdp->insCuota($nIddpa[0]["last_insert_id()"],$p[$i]);	
				if ($i==(count($areaaso)-1)) {
					$areas.= $areaaso[$i];
				}else{
					$areas.= $areaaso[$i].";";
				}									
			}	

			$savedepen = $gestor->saveDependencias($num,$nomserie,$areas,$deptrd);
			echo 1;		
		}
	}

	if ($btnagregar == "Agregar documento(s)") {
		$gestor = new radica();	
		$ultserie = $_POST['ultserie'];
		$perid = $_POST['perid'];
		$depid = $_POST['depid'];
		$num = 0;
		$fechaN = $_POST['num'];

		$fcierre = $_POST['cierre'];
		$fcierreEntero = strtotime($fcierre);
		$anio = date("Y", $fcierreEntero);

		$nomserie1 = $_POST['nomserie'];
		//$dfin = $_POST['dfin'];
		$tipodoc = isset($_POST["tipodoc"]) ? $_POST["tipodoc"]:NULL;
		$carpid = isset($_POST["carpid"]) ? $_POST["carpid"]:NULL;
		$dfin = 0;
		if ($tipodoc !="") {
			$nomserie = $tipodoc."_".$nomserie1;
		}else{
			$nomserie = $nomserie1;
		}
		
		$fechaComoEntero = strtotime($fechaN);
		$year = date("Y", $fechaComoEntero);

		date_default_timezone_set('America/Bogota');
		$fecha = date('Y-m-d G:i:s');
		$sfecha = strtotime($fecha);

		$fechasis = date('d-m-Y');

		//$nomserie = $fechasis."_".$nomserie;
		//$nomserie = $fechaN."_".$nomserie;
		$nomserie = $fcierre."_".$nomserie;
		$num=$sfecha;

		// var_dump($sfecha);
		// die();

		if ($_FILES['archivos']['size']>0) {
			//$year = date("Y");
			$maincarpeta = '../archi/'.$year;
			if (!file_exists($maincarpeta)) {
				mkdir($maincarpeta, 0777, true);
			}

			$carpeta = '../archi/'.$year.'/'.$depid;
			//$carpeta = path_file.'archi/'.$depid;		


			if (!file_exists($carpeta)) {
				mkdir($carpeta, 0777, true);
			}

			$tarchi = count($_FILES['archivos']['name']);
			for ($i=0; $i < $tarchi; $i++) { 			
				$nombrearchivo = $_FILES['archivos']['name'][$i];
				$explode = explode('.', $nombrearchivo);
				$tipoarchivo = array_pop($explode);
				$peso = round(($_FILES['archivos']['size'][$i])/1000);

				$nom = $_FILES['archivos']['tmp_name'][$i];

				//var_dump($_FILES['archivos']['tmp_name'][$i];);
				// echo "<script>console.log('Console: " . $peso . "' )</script>";
				// die();

				$rutafinal = $carpeta."/".$sfecha.$nombrearchivo;

				$cont=count($_FILES['archivos']['tmp_name']);
				//$nomar=$sfecha.$nombrearchivo;
				$nomar=$depid."_"."$ultserie"."_".$sfecha."_".$i;

				// $datosreg = array(
				// 			"perid" => $perid,
				// 			"depid" => $depid,
				// 			"nomarchivo" => $sfecha.$nombrearchivo,
				// 			"tipo" => $tipoarchivo,
				// 			"fecha" => $fecha,
				// 			"ruta" => $rutafinal,
				// 			"ultserie" => $ultserie
				// 				);
				

				if (move_uploaded_file($nom, $rutafinal)) {
					$respuesta = $gestor->agregadoc($perid,$depid,$nomar,$tipoarchivo,$peso,$fechaN,$rutafinal,$ultserie,$num,$nomserie,$dfin,$carpid,$fcierre,$anio,$fecha);
				}
				//echo move_uploaded_file($nom, $rutafinal);
			}
			//print_r($datosreg);
			echo $respuesta;
		}
	}

	if ($btnagregar == "Agregar Expediente") {
		$gestor = new radica();	
		$ultserie = $_POST['ultserie'];
		$perid = $_POST['perid'];
		$depid = $_POST['depid'];
		$num = 0;
		$fecha = $_POST['num'];
		$nomserie1 = $_POST['nomserie'];
		//$dfin = $_POST['dfin'];
		$tipodoc = isset($_POST["tipodoc"]) ? $_POST["tipodoc"]:NULL;
		$asigarea = isset($_POST["asigarea"]) ? $_POST["asigarea"]:NULL;
		$dfin = 0;

		$nomserie = $nomserie1;
		

		date_default_timezone_set('America/Bogota');
		// $fecha = date('Y-m-d G:i:s');
		// $sfecha = strtotime($fecha);

		// $fechasis = date('d-m-Y');		
		// $num=$sfecha;

		$fechaComoEntero = strtotime($fecha);
		$year = date("Y", $fechaComoEntero);

		//$year = date("Y");
		$maincarpeta = '../archi/'.$year;
		if (!file_exists($maincarpeta)) {
			mkdir($maincarpeta, 0777, true);
		}

		$carpeta = '../archi/'.$year.'/'.$depid;
		//$carpeta = path_file.'archi/'.$depid;		


		if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
		}		
					
		$nombrearchivo = "EXPEDIENTE"."_".$nomserie;		
		$tipoarchivo = "EXPEDIENTE";
		$peso = 0;	
		

		$respuesta = $gestor->agregaExp($perid,$depid,$nombrearchivo,$tipoarchivo,$fecha,$ultserie,$num,$nomserie,$dfin,$asigarea);

		//echo move_uploaded_file($nom, $rutafinal);
		//print_r($datosreg);
		echo $respuesta;		
	}


	if ($btnagregar == "Nueva Seríe" || $btnagregar == "Nueva Sub-seríe") {
		$gestor = new radica();	
		
		$num = isset($_POST["num"]) ? $_POST["num"]:NULL;
		$nomserie = isset($_POST["nomserie"]) ? $_POST["nomserie"]:NULL;
		$deptrd = isset($_POST["depende"]) ? $_POST["depende"]:NULL;			
			
		$savedepen = $gestor->saveSeries($num,$nomserie,$deptrd);
		echo 1;		
		
	}

	if ($btnagregar == "Carpeta") {
		$gestor = new radica();	
		$depidexp = $_POST['depidexp'];
		$depid = $_POST['depid'];
		$perid = $_POST['perid'];
		// var_dump($perid);
		// die();
		$num=0;
		$fecha=isset($_POST["num"]) ? $_POST["num"]:NULL;
		$nomserie = isset($_POST["nomserie"]) ? $_POST["nomserie"]:NULL;
		$deptrd = isset($_POST["depende"]) ? $_POST["depende"]:NULL;
		$idexp=	isset($_POST["idexp"]) ? $_POST["idexp"]:NULL;	
		$creaCarp = isset($_POST["carpeta"]) ? $_POST["carpeta"]:NULL;
		$ultserie = $_POST['ultserie'];

		date_default_timezone_set('America/Bogota');	

		//$fecha = date('Y-m-d G:i:s');

		$fechaComoEntero = strtotime($fecha);
		$year = date("Y", $fechaComoEntero);

			
		$savecarp = $gestor->saveCarpeta($depid,$perid,$depidexp,$num,$fecha,$nomserie,$ultserie,$idexp);
		echo 1;		
		
	}

	
?>