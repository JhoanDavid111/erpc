<?php
include'models/mdrive.php';

class DriveController{
	
	public function index(){

		$drive=new Drive;
		$alldrive=$drive->selectAll();		
		$allcat=$drive->catAll($_SESSION['perid']);
		
		$idcat = 0;
		$allUserArea=$drive->allUserArea(1027);
		$userperid = $_SESSION['perid'];

		$conmigo = $drive->conmigo($userperid);
		$carpetas_raiz=$this->miUnidad($conmigo);
		$permisocom = true;

		// Obtener las carpetas raíz de acuerdo al área específica
    	// En esta línea, pasamos el valor de la carpeta principal que deseas obtener
    	//$trdArea = $this->obtenerCarpetasPorArea(1027);

		$trd = $drive->importTRD(1027);
		

		// var_dump($trd);
		// die();

		//require_once 'views/vdrive.php';
		require_once 'views/vcategorias.php';
	}

	public function categorias(){

		$drive=new Drive;
		$allcat=$drive->catAll($_SESSION['perid']);
		$idcat = 0;
		$allUserArea=$drive->allUserArea(1027);
		$userperid = $_SESSION['perid'];
		$conmigo = $drive->conmigo($userperid);
		$carpetas_raiz=$this->miUnidad($conmigo);
		$permisocom = true;
		$trd = $drive->importTRD(1027);

		require_once 'views/vcategorias.php';

	}

	public function contenido(){

		$drive=new Drive;
		$allcat=$drive->contFolder($_SESSION['perid'],$_GET['idcat']);
		$idcat = $_GET['idcat'];

		$rama=$drive->contRama($idcat);

		$allUserArea=$drive->allUserArea(1027);
		$userperid = $_SESSION['perid'];
		$conmigo = $drive->conmigo($userperid);
		$carpetas_raiz=$this->miUnidad($conmigo);
		$permisocom = false;
		$trd = $drive->importTRD(1027);

		require_once 'views/vcontedrive.php';

	}

	public function compartido(){
		$drive=new Drive;
		$allcat=$drive->getFolder($_GET['idcat']);
		$idcat = $_GET['idcat'];

		$rama=$drive->contRama($idcat);
		$permisocom = false;
		$compartidos =1;

		require_once 'views/vcontedrive.php';

		//require_once 'views/vcompartiver.php';
		//require_once 'vcomparti.php';
	}


	public function miUnidad($conmigo) {
	    // Obtener las carpetas de más alto nivel compartidas
	    $carpetas_raiz = $this->obtenerCarpetasRaizCompartidas($conmigo);
	    
	    return $carpetas_raiz;
	}

	public function obtenerCarpetasRaizCompartidas($conmigo) {
	    $carpetas_raiz = array();

	    // Iterar sobre todas las carpetas compartidas
	    foreach ($conmigo as $carpeta) {
	        // Verificar si la carpeta está en el nivel más alto compartido
	        if (!$this->tieneCarpetaPadreCompartida($carpeta, $conmigo)) {
	            // Si no tiene una carpeta "padre" compartida, agrégala al arreglo
	            $carpetas_raiz[] = $carpeta;
	        }
	    }

	    return $carpetas_raiz;
	}

	public function tieneCarpetaPadreCompartida($carpeta, $conmigo) {
	    // Obtener el id de la carpeta "padre"
	    $depcat = $carpeta['depcat'];

	    // Verificar si la carpeta "padre" está compartida
	    foreach ($conmigo as $c) {
	        if ($c['idcat'] == $depcat) {
	            return true;
	        }
	    }

	    return false;
	}



	// Función para obtener las carpetas y subcarpetas de la tabla trd según el área especificada
	public function obtenerCarpetasPorArea($area_id, $doctrdPadre = 0, $nivel = 0, $ultimaCarpeta = false) {
	  $drive = new Drive;

	  // Obtener las carpetas de la base de datos
	  $trd = $drive->importTRD($area_id, $doctrdPadre);


	  $carpetas = [];

	  // Recorrer las carpetas
	  foreach ($trd as $t) {
	    $row = [];
	    $row['doctrd'] = $t['doctrd'];
	    $row['nombre_trd'] = $t['destrd'];
	    $row['nivel'] = $nivel;

	    // Agregar la carpeta a la lista
	    $carpetas[] = $row;

	    // Verificar si es la última carpeta
	    if ($t['ultima_carpeta'] == 1) {
	      $ultimaCarpeta = true;
	      break; // Se agrega un break para salir del ciclo al encontrar la última carpeta
	    }

	    // Obtener las subcarpetas de forma recursiva
	    if (!$ultimaCarpeta) {
	      $subcarpetas = $this->obtenerSubcarpetas($area_id, $t['doctrd'], $nivel + 1);

	      // Agregar las subcarpetas a la lista
	      $carpetas = array_merge($carpetas, $subcarpetas);
	    }
	  }

	  return $carpetas;
	}





	// Función auxiliar para obtener las subcarpetas de forma recursiva
	public function obtenerSubcarpetas($area_id, $doctrdPadre, $nivel) {

	    $drive = new Drive;

	    // Obtener las subcarpetas de la base de datos
	    $subcarpetas = $drive->importTRD($area_id, $doctrdPadre);

	    if ($nivel > 10) {
	        return []; // Salir de la recursion si el nivel supera un límite
	    }

	    foreach ($subcarpetas as $t) {
	        $row = [];
	        $row['doctrd'] = $t['doctrd'];
	        $row['nombre_trd'] = $t['destrd'];
	        $row['nivel'] = $nivel;

	        // Agregar la subcarpeta a la lista
	        $carpetas[] = $row;

	        // Llamar recursivamente a la función para obtener las subcarpetas de la subcarpeta actual
	        $subcarpetasHijas = $this->obtenerSubcarpetas($area_id, $t['doctrd'], $nivel + 1);

	        // Agregar las subcarpetas de la subcarpeta actual a la lista
	        $carpetas = array_merge($carpetas, $subcarpetasHijas);
	    }

	    return $carpetas;
	}












	





	
}