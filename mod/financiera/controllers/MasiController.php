<?php
include'models/masi.php';
include'models/pfinan.php';
//include'models/rubro.php';
require_once '../../PHPExcel/Classes/PHPExcel.php';

class masiController{
	
	public function index(){		
		Utils::useraccess('masi/index',$_SESSION['pefid']);
		$html = NULL;
		
		// $pfinan = new Pfinan();
		// $pfinand = $pfinan->getAll();

		//$pfvig = $pfinan->getVig();
		require_once 'views/masi.php';
	}

	public function inser(){		
		Utils::useraccess('masi/index',$_SESSION['pefid']);
	
		date_default_timezone_set('America/Bogota');
   		$fecSis = date("Y-m-d H:i:s");
   		$masi = new Masi();
   		$pfinan = new Pfinan();

   		$html = NULL;
////////////////////// Cargar archivos Inicio /////////////////////////////
   		$arcexc = isset($_FILES['arcexc']["name"]) ? $_FILES['arcexc']["name"]:NULL;
   		$arczip = isset($_FILES['arczip']["name"]) ? $_FILES['arczip']["name"]:NULL;
   		if($arcexc){
			$arcexc2 = Utils::opti($_FILES['arcexc'], date('YmdHis'),"zip","excel");
		}
		if($arczip){
			$arczip2 = Utils::opti($_FILES['arczip'], date('YmdHis'), "zip","RP");
		}
////////////////////// Cargar archivos Fin /////////////////////////////

////////////////////// Extrae zip Inicio /////////////////////////////
		$extract = Utils::extract($arczip2, 'rp/');
		if($extract){
		    //echo $GLOBALS['status']['success'];
		    $html .= "Se descomprimio el archivo exitosamente.";
		}else{
		    $html .= $GLOBALS['status']['error'];
		}
////////////////////// Extrae zip Fin /////////////////////////////

////////////////////// Lee el excel, compara datos, inserta INICIO /////////////////////////////
		$inputFileType = PHPExcel_IOFactory::identify($arcexc2);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($arcexc2);
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();

		$html .= "<br><br>";
		
		$html2 = NULL;
		$html3 = NULL;
		$ae = 0;
		$ane = 0;
		$dr = 0;
		for ($row = 2; $row <= $highestRow; $row++){
			// obtengo el valor de la celda
			$fecha_excel = $sheet->getCell("F".$row)->getValue();
				// utilizo la función y obtengo el timestamp
				$timestamp = PHPExcel_Shared_Date::ExcelToPHP($fecha_excel);
				$fec1 = date("Ymd",$timestamp);
				$fec = date("Ymd",strtotime($fec1."+ 1 days"));
			$nbogdata = $sheet->getCell("O".$row)->getValue();
			$noRP = $sheet->getCell("P".$row)->getValue();

			$filedown = "rp/".$fec."_REGISTRO_PRESUPUESTAL_No_".$noRP.".pdf";
			$file = "C:/xampp/htdocs/erpc/mod/financiera/rp/".$fec."_REGISTRO_PRESUPUESTAL_No_".$noRP.".pdf";
			$filenot = $fec."_REGISTRO_PRESUPUESTAL_No_".$noRP.".pdf";
			//echo $file;
			//echo " <a href='".$filedown."'>aqui</a>";
			if(file_exists($file)){
				$masi->setNbogdata($nbogdata);
				$ddetpaa = $masi->getId();
				if($ddetpaa){
					// echo $nbogdata." iddpa: ".$ddetpaa[0]['iddpa']." idpro: ".$ddetpaa[0]['idpro'];
					$masi->setIdpro($ddetpaa[0]['idpro']);
					$dflujo = $masi->getFlu();
					if($dflujo){
						// echo " idflu: ".$dflujo[0]['num']."<br>";
						$masi->setIddpa($ddetpaa[0]['iddpa']);
						$masi->setIdflu($dflujo[0]['num']);
						$masi->setRutrp($filedown);
						$masi->setNrp($noRP);
						$masi->edpf();
						$pfinand = $pfinan->traza($ddetpaa[0]['iddpa'],$dflujo[0]['num'],"RP por carga masiva",$fecSis,$_SESSION['perid']);
						$dr++;
					}
				}else{
					$html3 .= "<strong>No. Bogdata:</strong> ".$nbogdata." - ".$filenot."<br>";
				}
				$ae++;
			}else{
				$ane++;
				$html2 .= $filenot."<br>";
			}
			// var_dump($sheet->getCell("J".$row));
		}
		$html .= "<strong>Archivos encontrados:</strong> ";
		$html .= $ae."<br>";
		$html .= "<strong>Archivos no encontrados:</strong> ";
		$html .= $ane."<br>";
		if($ane>0) $html .="<br>".$html2."<br><br>";
		$html .= "<strong>Rp's registrados:</strong> ";
		$html .= $dr."<br>";
		$html .= "<strong>No. Bogdata no encontrados:</strong> ";
		$html .= ($ae-$dr)."<br>";
		if(($ae-$dr)>0) $html .="<br>".$html3."<br><br>";
////////////////////// Lee el excel, compara datos, inserta FIN /////////////////////////////
		//die();

		require_once 'views/masi.php';
	}
}