<?php
include'models/antproy.php';
include'models/rubro.php';
include'models/newpaa.php';
include'models/pfinan.php';
include'models/valfin.php';

class reportesController{
	
	public function index(){		
		Utils::useraccess('reportes/index',$_SESSION['pefid']);
		unset($_SESSION['consultado']);
	
		
		require_once 'views/vreportes.php';
		
	}


	
		
	
}