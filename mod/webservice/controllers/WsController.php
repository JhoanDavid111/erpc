<?php
include'models/radica.php';

class WsController{
	
	public function index(){
		
		//Utils::useraccess('radica/trd',$_SESSION['pefid']);
		$radica = new radica();

		$yearInv = $radica->getYearInv();
		require_once 'views/vWebser.php';
	}

	
	public function webservice(){
		//Utils::useraccess('radica/index',$_SESSION['pefid']);
		$radica = new radica();

		$yearInv = $radica->getYearInv();
		require_once 'views/vWebser.php';
		
	}

	public function webregpeticion(){
		//Utils::useraccess('radica/index',$_SESSION['pefid']);
		$radica = new radica();

		$yearInv = $radica->getYearInv();
		require_once 'views/vWsRegPet.php';
		
	}

	//WEB SERVICE--------------------------
	//-------------------------------------
	
	public function webconsultapet(){
		//Utils::useraccess('radica/index',$_SESSION['pefid']);
		$radica = new radica();

		$yearInv = $radica->getYearInv();
		require_once 'views/vWebconsulpet.php';
		
	}

	public function webconsultapetfechas(){
		//Utils::useraccess('radica/index',$_SESSION['pefid']);
		$radica = new radica();

		$yearInv = $radica->getYearInv();
		require_once 'views/vWebconsulpetfechas.php';
		
	}

	public function savePeticion(){
		//Utils::useraccess('radica/index',$_SESSION['pefid']);
		
		//var_dump($_POST);
		// die();

		

		require_once 'views/vWebser.php';
		
	}
}