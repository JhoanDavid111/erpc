<?php
require 'vendor/autoload.php';

use Google\Client;

try {
    $client = new Client();
    echo "Google_Client cargado correctamente.";
} catch (Exception $e) {
    echo "Error al cargar Google_Client: " . $e->getMessage();
}