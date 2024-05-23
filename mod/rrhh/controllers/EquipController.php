<?php
include'models/equip.php';

class EquipController{
	
	public function index(){
		Utils::useraccess('equip/index',$_SESSION['pefid']);
		$txtn = isset($_GET['txtn']) ? $_GET['txtn']:NULL;
		date_default_timezone_set('America/Bogota');
	   	$hoy = date("Y-m-d");
		$ep=new equip();
		$ninsCap = $ep->getOneCapNI();
		$insCap = $ep->getOneCapI();
		$datOne=NULL;
		require_once 'views/equip.php';
	}

	public function asins(){
		Utils::useraccess('equip/index',$_SESSION['pefid']);
		$txtn = isset($_REQUEST['txtn']) ? $_REQUEST['txtn']:NULL;
		$idce = isset($_REQUEST['idce']) ? $_REQUEST['idce']:NULL;
		$save = isset($_REQUEST['save']) ? $_REQUEST['save']:NULL;
		date_default_timezone_set('America/Bogota');
		$txtn = "actualizada. Registró su asistencia correctamente. Gracias.";
	   	$hoy = date("Y-m-d");
		$ep=new equip();
		if($save=="actin" and $idce){
			$ep->setIdce($idce);
			$ep->updAsiIns(1);
		}
		$ninsCap = $ep->getOneCapNI();
		$insCap = $ep->getOneCapI();
		$datOne=NULL;
		require_once 'views/equip.php';
	}

	public function save(){
		Utils::useraccess('equip/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$idce = isset($_POST['idce']) ? $_POST['idce']:NULL;
			$idequ = isset($_POST['idequ']) ? $_POST['idequ']:NULL;
			$nomequ = isset($_POST['nomequ']) ? $_POST['nomequ']:NULL;
			$comce = isset($_POST['comce']) ? $_POST['comce']:NULL;
            $cequi = new equip();
			$cequi->setIdce($idce);
			$cequi->setIdequ($idequ);
			$cequi->setNomequ($nomequ);

			// echo $cequi->getIdce()." ".$cequi->getIdequ()." ".$cequi->getNomequ();
			if($nomequ AND $comce==2){
				$save = $cequi->saveEqu();
				$save = $cequi->getEqu();
				$idequ = $save[0]['idequ'];
				$cequi->setIdequ($idequ);
				$save = $cequi->save();
				$txtn = "registrada con equipo";
			}elseif($idequ AND $comce==2){
				$save = $cequi->save();
				$txtn = "registrada con equipo existente";
			}elseif(!$idequ AND $comce==2){
				$txtn = "rechazada. Debes crear primero un equipo. No guardado";
			}else{
				$save = $cequi->save();
				$txtn = "registrada";
			}
			
			

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

	public function del(){
		Utils::useraccess('equip/index',$_SESSION['pefid']);
		if(isset($_GET)){
			$idce = isset($_GET['idce']) ? $_GET['idce']:NULL;
            $cequi = new equip();
			$cequi->setIdce($idce);
			$save = $cequi->del();
			$txtn = "cancelada";

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