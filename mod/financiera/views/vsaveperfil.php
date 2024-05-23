<?php
	require_once '../../../config/db.php';
	include '../models/pfinan.php';

	$nom = isset($_POST["perfilcon"]) ? $_POST["perfilcon"] : NULL;
	session_start();
	$area = $_SESSION['depid'];
	$perid = $_SESSION['perid'];
	$tipo = 1;

	$saveperfil = new Pfinan();

	$save = $saveperfil->saveNomPerfil($area, $tipo, $nom, $perid);

	if ($save) {
	    echo 1;
	} else {
	    echo 0;
	}
?>
