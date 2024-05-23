<?php  

require_once '../../../config/db.php';
include'../models/mdrive.php';


$gestor = new Drive();	
$depcat = $_POST['idcat'];

session_start();
$area=$_SESSION['depid'];
$perid = $_SESSION['perid'];



if ($_FILES['archivos']['size'] > 0) {
    
    // $nombreArchivo = $_FILES['archivos']['name'];
    // $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);



    

	date_default_timezone_set('America/Bogota');
	$fecha = date('Y-m-d G:i:s');
	$sfecha = strtotime($fecha);
	$fechasis = date('d-m-Y');
	$year = date("Y", strtotime($fechasis));

	$maincarpeta = '../archi/'.$year;
	if (!file_exists($maincarpeta)) {
		mkdir($maincarpeta, 0777, true);
	}

	$carpeta = '../archi/'.$year.'/'.$area;
	//$carpeta = path_file.'archi/'.$depid;	

	if (!file_exists($carpeta)) {
		mkdir($carpeta, 0777, true);
	}

	$digito = 1;
	$tarchi = count($_FILES['archivos']['name']);
	for ($i=0; $i < $tarchi; $i++) { 			
		$nombrearchivo = $_FILES['archivos']['name'][$i];
		$extension = pathinfo($nombrearchivo, PATHINFO_EXTENSION);
		
		switch ($extension) {
	        case 'doc':
	        case 'txt';
	        case 'docx':
	            $tipoDocumento = 2; // Word
	            break;
	        case 'xls':
	        case 'xlsx':
	            $tipoDocumento = 3; // Excel
	            break;
	        case 'pdf':
	            $tipoDocumento = 4; // PDF
	            break;
	        case 'jpg':
	        case 'jpeg':
	        case 'png':
	            $tipoDocumento = 5; // Imagen
	            break;
	        case 'zip':
	        case 'rar':
	            $tipoDocumento = 6; // ZIP o RAR
	            break;
	        case 'ppt':
	        case 'pptx':
	            $tipoDocumento = 8; // PowerPoint
	            break;
	        default:
	            $tipoDocumento = 9; // Otro
	            break;
	    }


		//$explode = explode('.', $nombrearchivo);
		//$tipoarchivo = array_pop($explode);
		
		$peso = round(($_FILES['archivos']['size'][$i])/1000);
		$nom = $_FILES['archivos']['tmp_name'][$i];	

		//$rutafinal = $carpeta."/".$sfecha.$nombrearchivo;
		$nominterno = ($sfecha+1).".".$extension;
		$rutafinal = $carpeta."/".$nominterno;

		

		$cont=count($_FILES['archivos']['tmp_name']);
		//$nomar=$sfecha.$nombrearchivo;
		//$nomar=$depid."_"."$ultserie"."_".$sfecha."_".$i;

		
		
		

		if (move_uploaded_file($nom, $rutafinal)) {
			// var_dump($rutafinal);
			// die();
			$respuesta = $gestor->agregadocRRHH($depcat,$perid,$area,$nombrearchivo,$nominterno,$tipoDocumento,$extension,$peso,$rutafinal);
		}
		//echo move_uploaded_file($nom, $rutafinal);
		$digito++;
	}
	//print_r($datosreg);
	if ($respuesta){
		echo 1;
	}else{
		echo 0;
	}


    
} 




?>