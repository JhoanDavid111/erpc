<?php
include'models/mtv.php';
require_once "models/mongoCrud.php";

class TvController{
	
	public function index(){
		Utils::useraccess('tv/index',$_SESSION['pefid']);		
		$this->contenidos();
	}

	public function contenidos(){
		Utils::useraccess('tv/index',$_SESSION['pefid']);		 
    	
		$crud = new Crud();
		$datos = $crud->mostrarDatosContenidos();
		if(isset($_GET['idserie'])){
			$idserie = $_GET['idserie'];
			$editar=1;
			$getSerie = $crud->buscarDatosContenidos($idserie);		
			$getTags = $crud->buscarTags();	
			$opciones = $crud->buscarOpciones();
			$publico = $crud->buscarOpciones();		
			$tempap = $crud->buscarOpciones();	
			$subtema = $crud->buscarOpciones();	

			
			//var_dump($getTags);
			//die();
			// foreach($getSerie as $document){
			// 	 $id = (string) $document['_id'];
			// 	 //var_dump($id);

			// 	  foreach($document as $key => $value){
			// 	  	if($key == 'ABDKO'){
			// 	  		var_dump($value['nombre']);
			// 	  		var_dump($key);

			// 	  	}
			// 	  }
			// }
		}	
		require_once 'views/vContenidos.php';
	}

	public function capitulos(){
		Utils::useraccess('tv/index',$_SESSION['pefid']);	
		
		$crud = new Crud();	
		$datos = $crud->mostrarEpisodios();
		require_once 'views/vCapitulos.php';
	}

	public function capitulosDet(){
		//var_dump($_GET);

		Utils::useraccess('tv/index',$_SESSION['pefid']);	
		$crud = new Crud();	
		$idserie = $_GET['idserie'];			
		$getSerie = $crud->mostrarEpisodiosOne($idserie);
	
		require_once 'views/vCapitulosDet.php';


	}

	public function agentes(){
		Utils::useraccess('tv/index',$_SESSION['pefid']);		
		require_once 'views/vAgentes.php';
	}

	
}