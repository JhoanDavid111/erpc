<?php
// Incluir el archivo que contiene la definición de la clase y la conexión a la base de datos
require_once '../../../config/db.php';
include '../models/pfinan.php';

// Crear una instancia del modelo para acceder a la función getObligaGen()
$pfModel = new Pfinan();

// Llamar a la función getObligaGen() para obtener las opciones de obligaciones generales
$obligaciones = $pfModel->getObligaGen();

// Verificar si se obtuvieron resultados
if ($obligaciones) {
    // Devolver las opciones obtenidas como JSON
    header('Content-Type: application/json');
    echo json_encode($obligaciones);
} else {
    // Si no se obtuvieron resultados, devolver un array vacío como JSON
    echo json_encode(array());
}
?>
