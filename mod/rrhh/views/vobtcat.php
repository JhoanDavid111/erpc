<?php

require_once '../../../config/db.php';
include'../models/mdrive.php';

// echo $_POST['idcat'];
// die();

$id=$_POST['idcat'];

// echo $id;
// die();



$obtcategoria = new Drive;
$obtcategoria->obtenerCat($id);

echo json_encode($obtcategoria->obtenerCat($id));


	

	
?>