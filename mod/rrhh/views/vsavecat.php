<?php 
	require_once '../../../config/db.php';
	include'../models/mdrive.php';

	$btnagregar = isset($_POST["btnagregar"]) ? $_POST["btnagregar"]:NULL;
	$nomcat = isset($_POST["nomcat"]) ? $_POST["nomcat"]:NULL;
	$depcat = isset($_POST["depcat"]) ? $_POST["depcat"]:NULL;
	$idcat = isset($_POST["idcat"]) ? $_POST["idcat"]:0;

	session_start();
	$area=$_SESSION['depid'];
	$perid = $_SESSION['perid'];

	// var_dump($idcat);
	// die();

	if ($nomcat != NULL) {
		$drive = new Drive;
		if ($depcat==0) {
			$save = $drive->saveCat($nomcat,$area,$perid,0);
		}else{	
			$save = $drive->saveCat($nomcat,$area,$perid,$idcat);
		}		
		echo 1;
	}else{
		echo "error";
	}
	
	

	
?>