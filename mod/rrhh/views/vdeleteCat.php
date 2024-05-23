<?php

require_once '../../../config/db.php';
include'../models/mdrive.php';

// echo $_POST['idcat'];
// die();

$idcat=$_POST['idcat'];

// echo $id;
// die();

$delete = new Drive;
// Uso
//eliminarCarpetaYSubniveles($idcat);
$operacionTerminada = eliminarCarpetaYSubniveles($idcat);


//ELIMINAR CARPETAS Y SUBNIVELES
function eliminarCarpetaYSubniveles($idcat) {   

    // Obtener la lista de subcarpetas
    $subcarpetas = obtenerSubcarpetas($idcat);

    // Eliminar la carpeta actual
    eliminarCarpeta($idcat);

    // Eliminar las subcarpetas recursivamente
    foreach ($subcarpetas as $subcarpeta) {
        //eliminarCarpetaYSubniveles($subcarpeta['idcat']);
        if (!eliminarCarpetaYSubniveles($subcarpeta['idcat'])) {
            // Si hay un problema en la eliminación de una subcarpeta, retornar false
            return false;
        }        
    }
    // Indicar que la operación ha terminado satisfactoriamente
    return true;
}

function obtenerSubcarpetas($idcat) {  
    //$subcarpetas = array();
    $delete = new Drive;
	$subcarpetas = $delete->getSubcarpetas($idcat);
    return $subcarpetas;
}

function eliminarCarpeta($idcat) { 
	$delete = new Drive;   
    $del = $delete->deleteCat($idcat);
}

if ($operacionTerminada) {
    echo 1;
} else {
    //echo "Hubo un problema durante la eliminación.";
}

// if ($del){
// 	echo 1;
// }
	

	
?>