<?php
include'models/selep.php';

class SelepController{
	
	public function index(){
		Utils::useraccess('equip/index',$_SESSION['pefid']);
		$txtn = isset($_GET['txtn']) ? $_GET['txtn']:NULL;
		date_default_timezone_set('America/Bogota');
	   	$hoy = date("Y-m-d");
		$ep=new cequi();
		//$ninsCap = $ep->getOneCapNI();
		//$insCap = $ep->getOneCapI();
		$datOne=NULL;
		require_once 'views/equip.php';
	}

	public function save(){
		Utils::useraccess('equip/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$idcp = isset($_POST['idcp']) ? $_POST['idcp']:NULL;
			$idequ = isset($_POST['idequ']) ? $_POST['idequ']:NULL;
			$nomequ = isset($_POST['nomequ']) ? $_POST['nomequ']:NULL;
            $cequi = new cequi();
			$cequi->setIdcp($idcp);
			$cequi->setIdequ($idequ);
			$cequi->setNomequ($nomequ);
			$save = $cequi->save();
			$txtn = "registrada";

			if($save){
				$_SESSION['register'] = "complete";
			}else{
				$_SESSION['register'] = "failed";
			}
		}else{
			$_SESSION['register'] = "failed";
		}
		header("Location:".base_url.'equip/index'.'&txtn='.$txtn);
	}


}	