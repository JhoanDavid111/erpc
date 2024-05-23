<?php
include'models/contrato.php';


class repareController{
	public function index(){
		Utils::useraccess('repare/index',$_SESSION['pefid']);
		$contrato = new Contrato();
		date_default_timezone_set('America/Bogota');
		$ano = isset($_POST['ano']) ? $_POST['ano']:date("Y");
		$mes = date('n');	

		$areas = $contrato->selval(1);
		$anos = $contrato->selAno();
		$toms = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0);
		require_once 'views/repare.php';		
	}




}//ciera class repestControlle