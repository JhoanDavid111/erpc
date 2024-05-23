<?php

require_once '../../../config/db.php';

//Obtiene el documento de identidad del formulario

$documento = $_POST['documento'];
$tipoper = $_POST['tipoper'];

//echo $tipoper;

if($documento>0){
   $modelo= new conexion();
   $conexion=$modelo->get_conexion();
   if ($tipoper == 1) {
       $sql="SELECT perid, nodocemp, pernom, perape, tipoper FROM persona WHERE nodocemp='$documento' AND tipoper = 1 ";
   }
    if ($tipoper == 2) {
       $sql="SELECT perid, nodocemp, pernom, perape, tipoper FROM persona WHERE nodocemp='$documento' AND tipoper = 2 ";
   }



   
   $result=$conexion->prepare($sql);
   //$result1->bindParam(":email",$email);
   $result->execute();


   while($f=$result->fetch()){
       $resultado[]=$f;
   }

   //var_dump($resultado[0]['pernom']); die();

   if (isset($resultado)) {
       // Obtiene los datos del empleado

       $r=2;
       $perid = $resultado[0]['perid'];
       $nombre = $resultado[0]['pernom'];
       $apellido = $resultado[0]['perape'];
       $nodocemp = $resultado[0]['nodocemp'];
       $tipoper = $resultado[0]['tipoper'];

       // Devuelve los datos como respuesta en formato JSON
       $response = array('r' => $r,'nombre' => $nombre, 'apellido' => $apellido, 'perid' => $perid, 'nodocemp' => $nodocemp, 'tipoper' => $tipoper);
       echo json_encode($response);
   }else{
       $r=0;
       $response = array('r' => $r);
       echo json_encode($response);
   }



}else {
    $r=1;
    $response = array('r' => $r);
    echo json_encode($response);
}

 
?>
