<?php 

	include "config/conMongoDb.php";

	class Crud extends ConexionMongoDB{
		public function mostrarDatosEmpresas(){
			try {
				$conexion = parent::conectar();
				$coleccion = $conexion->empresas;
				$datos = $coleccion->find();
				return $datos;
			} catch (\Throwable $th) {
				return $th->getMessage();
			}

		}

		public function mostrarDatosContenidos(){
			try {
				$conexion = parent::conectar();
				$coleccion = $conexion->series;
				$datos = $coleccion->find();
				return $datos;
			} catch (\Throwable $th) {
				return $th->getMessage();
			}

		}

		public function buscarDatosContenidos($idserie){
			try {
				$conexion = parent::conectar();
				$coleccion = $conexion->series;
				$filtro = [$idserie => ['$exists' => true]]; // Modifica el filtro aquí
				$datos = $coleccion->find($filtro);
				// $cursor = $coleccion->find($filtro);
				// $datosU = $cursor->toArray();

				return $datos;
			} catch (\Throwable $th) {
				return $th->getMessage();
			}

		}


		public function buscarTags(){
			try {
				$conexion = parent::conectar();
				$coleccion = $conexion->etiquetas;
				$datos = $coleccion->find();
				// $cursor = $coleccion->find($filtro);
				// $datosU = $cursor->toArray();

				// var_dump($datos);
				// die();
				return $datos;
			} catch (\Throwable $th) {
				return $th->getMessage();
			}

		}

		public function buscarOpciones(){
			try {
				$conexion = parent::conectar();
				$coleccion = $conexion->opciones;
				$datos = $coleccion->find();
				// $cursor = $coleccion->find($filtro);
				// $datosU = $cursor->toArray();

				// var_dump($datos);
				// die();
				return $datos;
			} catch (\Throwable $th) {
				return $th->getMessage();
			}

		}


		public function mostrarEpisodios(){
			try {
				$conexion = parent::conectar();
				$coleccion = $conexion->episodios;
				$datos = $coleccion->find();
				return $datos;
			} catch (\Throwable $th) {
				return $th->getMessage();
			}

		}

		public function mostrarEpisodiosOne($codigo) {
			try {
				$conexion = parent::conectar();
				$coleccion = $conexion->episodios;
				$filtro = [$codigo => ['$exists' => true]]; // Modifica el filtro aquí
				$datos = $coleccion->find(['ABDKO01T001.codigounico' => 'ABDKO01T001']);
				// $cursor = $coleccion->find($filtro);
				// $datosU = $cursor->toArray();



				return $datos;
			} catch (\Throwable $th) {
				return $th->getMessage();
			}


		    // try {
		    //     $conexion = parent::conectar();
		    //     $coleccion = $conexion->episodios;
		    //     $filtro = ['codigounico' => $codigo];
		    //     $datos = $coleccion->findOne($filtro);

		    //     if (is_object($datos)) {
		    //         echo $datos->temporada;
		    //     } else {
		    //         echo "No se encontró ningún episodio para el código '$codigo'";
		    //     }

		    //     return $datos;
		    // } catch (\Throwable $th) {
		    //     return $th->getMessage();
		    // }
		}





	}//CIERRA CLASS

?>