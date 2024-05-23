<?php
include'models/plamej.php';

class CrgmtzController{
	
	public function index(){
		//Utils::useraccess('plamej/index',$_SESSION['pefid']);
	
		$fil1 = isset($_POST['fil1']) ? $_POST['fil1'] : false;
		$fil2 = isset($_POST['fil2']) ? $_POST['fil2'] : false;

		date_default_timezone_set('America/Bogota');
		$hoy = date("Y-m-d");
		$munm = date("Y-m-d",strtotime($hoy."- 1 month"));
		$val = NULL;

		require_once 'views/crgmtz.php';
	}

	public function subirArchpaa(){
		try{
			//Utils::useraccess('masi/index',$_SESSION['pefid']);
			require_once '../../PHPExcel/Classes/PHPExcel.php';
		
			date_default_timezone_set('America/Bogota');
	   		$fecSis = date("Y-m-d H:i:s");

	   		$cexcel = new plamej();

	   		$html = NULL;
	////////////////////// Cargar archivos Inicio /////////////////////////////
	   		$arcexc = isset($_FILES['arcexc']["name"]) ? $_FILES['arcexc']["name"]:NULL;
	   		if($arcexc){   			
				$arcexc2 = Utils::opti($_FILES['arcexc'], date('YmdHis'),"arcci","excel");
			}

	////////////// Lee el excel, compara datos, inserta INICIO //////////////////////

			$arcexc2=path_file.$arcexc2;
			//var_dump($arcexc2);
			$inputFileType = PHPExcel_IOFactory::identify($arcexc2);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);

			$objPHPExcel = $objReader->load($arcexc2);
			echo "Aca vamos 3 ".$arcexc2;
	die();
			$sheet = $objPHPExcel->getSheet(0); 
			$highestRow = $sheet->getHighestRow(); 
			$highestColumn = $sheet->getHighestColumn();
	
			$html .= "<br><br>";
			$html2 = NULL;
			$html3 = NULL;
			$ae = 0;
			$ane = 0;
			$dr = 0;
	echo "<br><br><br>";
			for ($row = 10; $row <= $highestRow; $row++){
				$codfue = $sheet->getCell("c".$row)->getValue();
				// $objeto_espacios=$objeto = $sheet->getCell("e".$row)->getValue();
				// $detfue = preg_replace('/[\r\n]+/', " ", $objeto_espacios);

				echo $codfue." - ".$detfue."<br>";
				
				/*
				$objdpa=36;
				$codigo = $sheet->getCell("c".$row)->getValue();
				$codigo = substr($codigo, 1);
				// var_dump($codigo);
				// die();
				$rubro = $sheet->getCell("d".$row)->getValue();
				$meta = $sheet->getCell("e".$row)->getValue();

				if ($meta>0) {
					
				}else{
					$meta=0;
				}

				$resolucion = $sheet->getCell("f".$row)->getValue();

				if ($resolucion>0) {
					
				}else{
					$resolucion=0;
				}

				$compromiso = $sheet->getCell("g".$row)->getValue();
				$contratista = $sheet->getCell("h".$row)->getValue();
				$asignacion = $sheet->getCell("i".$row)->getValue();			
				$comprometido = $sheet->getCell("j".$row)->getValue();
				if ($comprometido>0) {
					
				}else{
					$comprometido=0;
				}

				$modalidad = $sheet->getCell("k".$row)->getValue();
				$codmodalidad = $sheet->getCell("l".$row)->getValue();
				$fuentefinan = $sheet->getCell("m".$row)->getValue();
				$codfuente = $sheet->getCell("n".$row)->getValue();
				$resfutic = $sheet->getCell("o".$row)->getValue();

				$fecini = $sheet->getCell("p".$row)->getValue();		
				//$fecini = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($fecini)); 

				$fecfin = $sheet->getCell("q".$row)->getValue();
				//$fecfin = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($fecfin));



				$area = $sheet->getCell("r".$row)->getValue();
				$codarea = $sheet->getCell("s".$row)->getValue();
				$unidad = $sheet->getCell("t".$row)->getValue();
				$ubicacion = $sheet->getCell("u".$row)->getValue();
				$responsable = $sheet->getCell("v".$row)->getValue();
				$telefono = $sheet->getCell("w".$row)->getValue();
				$email = $sheet->getCell("x".$row)->getValue();
				$ordenador = $sheet->getCell("y".$row)->getValue();
				$proceso = $sheet->getCell("z".$row)->getValue();
				$codproceso = $sheet->getCell("aa".$row)->getValue();
				$estado = $sheet->getCell("ab".$row)->getValue();
				$codnuevo = $sheet->getCell("ac".$row)->getValue();
				$nexpcdp = $sheet->getCell("ad".$row)->getValue();
				$nrp = $sheet->getCell("ae".$row)->getValue();
				$nbogdata = $sheet->getCell("af".$row)->getValue();
				$ncdp = $sheet->getCell("ag".$row)->getValue();
				$estadofin = $sheet->getCell("ah".$row)->getValue();
				$iddpa = $sheet->getCell("ai".$row)->getValue();			

				$cexcel->setUnspsc($unspsc);
				$cexcel->setCodrub($codigo);

				$codimeta1=$cexcel->busVafid(10,$meta);
				if (count($codimeta1)>0) {
					
					$codimeta=$codimeta1[0]['vafid'];
				}else{
					$codimeta=2000;
				}

				$codiresol1=$cexcel->busVafid(11,$resolucion);
				if (count($codiresol1)>0) {
					$codiresol=$codiresol1[0]['vafid'];
					// var_dump($codimeta);
					// die();
				}else{
					$codiresol=2100;
				}
				
				
				$cexcel->setMetadp($codimeta);
				$cexcel->setResoludp($codiresol);
				$cexcel->setCompro($compromiso);
				$cexcel->setNomcont($contratista);
				$cexcel->setPrrp($comprometido);
				$cexcel->setIddpa($iddpa);

				if ($iddpa>0) {
					$editar="SI";
				}else{
					$editar="NO";
				}

				$vigencia = $cexcel->vigact();
				$vig=$vigencia[0]['idpaa'];

				// var_dump($vig);
				// die();	


				$cexcel->edPlanoPaa($unspsc,$objeto,$objdpa,$codigo,$rubro,$meta,$resolucion,$compromiso,$contratista,$asignacion,$comprometido,$modalidad,$codmodalidad,$fuentefinan,$codfuente,$resfutic,$fecini,$fecfin,$area,$codarea,$unidad,$ubicacion,$responsable,$telefono,$email,$ordenador,$proceso,$codproceso,$estado,$codnuevo,$nexpcdp,$nrp,$nbogdata,$ncdp,$estadofin,$iddpa,$editar,$vig,$codimeta,$codiresol); */
				// var_dump($sheet->getCell("J".$row));
			}//CIERRA FOR
			$html .= "<strong>Archivos encontrados:</strong> ";
			//echo mb_convert_encoding($html, 'UTF-16LE', 'UTF-8');
			
	////////////////////// Lee el excel, compara datos, inserta FIN /////////////////////////////
		

			require_once 'views/crgmtz.php';
		}catch(Exception $e){
			echo "";
		}
	}
}