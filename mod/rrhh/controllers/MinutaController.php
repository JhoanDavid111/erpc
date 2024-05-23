<?php
include'models/persona.php';
include'models/minuta.php';


class minutaController{
	public function index(){		
		Utils::useraccess('minuta/index',$_SESSION['pefid']);
		date_default_timezone_set('America/Bogota');
		$hoy = date("Y-m-d");
		$perid = isset($_SESSION['perid']) ? $_SESSION['perid']:NULL;
		$nummin = isset($_POST['nummin']) ? $_POST['nummin']:NULL;
		$fechos = isset($_POST['fechos']) ? $_POST['fechos']:$hoy;
		$tipmin = isset($_POST['tipmin']) ? $_POST['tipmin']:NULL;
		$nodocemp = isset($_POST['nodocemp']) ? $_POST['nodocemp']:NULL;
		$hij = isset($_POST['hij']) ? $_POST['hij']:NULL;
		$fhlle = isset($_POST['fhlle']) ? $_POST['fhlle']:$hoy;
		$obs = isset($_POST['obs']) ? $_POST['obs']:NULL;
		$ideles = isset($_POST['ideles']) ? $_POST['ideles']:NULL;
		$pdf = isset($_GET['pdf']) ? $_GET['pdf']:NULL;
		// echo $fechos." ".$fhlle." ".$nodocemp;

		$minuta = new Minuta();

		if($fechos OR $nodocemp){
		    //$minuta -> setIdusu($nodocemp);
		    $dat = $minuta->getTodo($fechos, $fhlle, $nodocemp);
		    $datP = $minuta->getTodoP($fechos, $fhlle);
		}

		require_once 'views/minuta.php';
	}
}