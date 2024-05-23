<?php 
	//CREAR CARPETA VENDOR 
	//agregar esto en la terminal de Visual Studio "composer require mongodb/mongodb --ignore-platform-reqs"

	require_once $_SERVER['DOCUMENT_ROOT'] . "/erpc/mod/tv/vendor/autoload.php";


	class ConexionMongoDB{
		public function conectar(){
			try {
				$servidor = "127.0.0.1";
				$usuario = "mongoadmin";
				$password = "123456";
				$baseDatos = "capitalinfo";
				$puerto = "27017";

				$cadenaConexion = "mongodb://".
									$usuario.":".
									$password. "@".
									$servidor. ":".
									$puerto. "/".
									$baseDatos;
				$cliente = new MongoDB\Client($cadenaConexion);
				return $cliente->selectDatabase($baseDatos);
				
			} catch (\Throwable $th) {
				return $th->getMessage();
			}
		}
	}

	// $objeto = new ConexionMongoDB();
	// var_dump($objeto->conectar());
 ?>