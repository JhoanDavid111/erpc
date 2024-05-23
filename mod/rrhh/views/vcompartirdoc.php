<?php 
	require_once '../../../config/db.php';
	include'../models/mdrive.php';


	$idcat = isset($_POST["idcatcomp"]) ? $_POST["idcatcomp"]:0;
	$usuario = isset($_POST["selectOptions"]) ? $_POST["selectOptions"]:0;
	$usuarios = implode(",", $usuario);
	
	session_start();
	$area=1027;
	$perid = $_SESSION['perid'];
	
	$operacionTerminada = compartirCarpetaYSubniveles($idcat,$usuarios);


	//COMPARTIR CARPETAS Y SUBNIVELES
	function compartirCarpetaYSubniveles($idcat,$usuarios) {   

	    // Obtener la lista de subcarpetas
	    $subcarpetas = obtenerSubcarpetas($idcat);

	    // Compartir la carpeta actual
	    compartirCarpeta($idcat,$usuarios);

	    // Compartir las subcarpetas recursivamente
	    foreach ($subcarpetas as $subcarpeta) {	        
	        if (!compartirCarpetaYSubniveles($subcarpeta['idcat'],$usuarios)) {
	            // Si hay un problema, retornar false
	            return false;
	        }        
	    }
	    // Indicar que la operación ha terminado satisfactoriamente
	    return true;
	}

	function obtenerSubcarpetas($idcat) {  
	    //$subcarpetas = array();
	    $compar = new Drive;
		$subcarpetas = $compar->getSubcarpetas($idcat);
	    return $subcarpetas;
	}

	function compartirCarpeta($idcat,$usuarios) { 
		$compar = new Drive;
	    $save = $compar->saveShare($idcat,$usuarios);
	}

	if ($operacionTerminada) {
	    echo 1;
	} else {
	    echo 0;
	}

	

	
?>

