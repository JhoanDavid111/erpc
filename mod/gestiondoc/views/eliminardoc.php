<?php

require_once '../../../config/db.php';

//Obtiene el documento de identidad del formulario

$documento = $_POST['documento'];

if($documento>0){
   $modelo= new conexion();
   $conexion=$modelo->get_conexion();
   $sql="DELETE FROM docgestion WHERE id=$documento";
   $result=$conexion->prepare($sql);   
   $result->execute();



    $r=1;
    $response = array('r' => $r);
    echo json_encode($response);
}

 
?>
