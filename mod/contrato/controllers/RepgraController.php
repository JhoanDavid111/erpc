<?php
include'models/contrato.php';

class repgraController{
	
	public function index(){
		Utils::useraccess('repgra/index',$_SESSION['pefid']);
		$contrato = new Contrato();
		date_default_timezone_set('America/Bogota');
		$ano = isset($_POST['ano']) ? $_POST['ano']:date("Y");
		$mes = date('n');
		
		$abogados = $contrato->selabo();
		$anos = $contrato->selAno();
		$toms = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0);

		require_once 'views/repgra.php';
	}

}