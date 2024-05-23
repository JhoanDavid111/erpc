<?php 
	require_once '../../../config/db.php';
	include'../models/mdrive.php';

	$idcat = isset($_POST["oldcat"]) ? $_POST["oldcat"]:NULL;//id categoria
	$edicat = isset($_POST["edicat"]) ? $_POST["edicat"]:NULL;//Nombre categoria

	// session_start();
	// $area=$_SESSION['depid'];

	if ($edicat != NULL) {
		$drive = new Drive;
		$save = $drive->ediCat($idcat,$edicat);
		echo 1;
	}else{
		echo "error";
	}
	
	

	
?>