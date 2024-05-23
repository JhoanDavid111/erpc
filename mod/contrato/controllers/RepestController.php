<?php
include'models/contrato.php';


class repestController{
	public function index(){
		Utils::useraccess('repest/index',$_SESSION['pefid']);
		$contrato = new Contrato();
		date_default_timezone_set('America/Bogota');
		$ano = isset($_POST['ano']) ? $_POST['ano']:date("Y");
		$mes = date('n');	

		$estados = $contrato->selval(11);
		$anos = $contrato->selAno();
		$toms = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0);
		require_once 'views/repest.php';		
	}




}//ciera class repestControlle