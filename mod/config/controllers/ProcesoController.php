<?php
include'models/proceso.php';

class procesoController{
	
	public function index(){		
		Utils::useraccess('proceso/index',$_SESSION['pefid']);
		$idpro = NULL;
		$proceso = new Proceso();
		date_default_timezone_set('America/Bogota');
		$result = $proceso->getAll();
		require_once 'views/proceso.php';
	}

	public function save(){
		Utils::useraccess('proceso/index',$_SESSION['pefid']);

		if(isset($_POST)){
			$idpro = isset($_POST['idpro']) ? $_POST['idpro']:false;
			$nompro = isset($_POST['nompro']) ? $_POST['nompro']:false;
			$deppro = isset($_POST['deppro']) ? $_POST['deppro']:5;
			$codpro = isset($_POST['codpro']) ? $_POST['codpro']:'';
			$doctrd = isset($_POST['doctrd']) ? $_POST['doctrd']:0;
			$ordpro = isset($_POST['ordpro']) ? $_POST['ordpro']:false;
			if($idpro>=5004 && $idpro<=5999 && $nompro && $ordpro){
				$proceso = new Proceso();
				$proceso->setIdpro($idpro);
				$proceso->setNompro($nompro);
				$proceso->setDeppro($deppro);
				$proceso->setCodpro($codpro);
				$proceso->setDoctrd($doctrd);
				$proceso->setOrdpro($ordpro);

				if(isset($_GET['idpro'])){
					$idpro = $_GET['idpro'];
					$proceso->setIdpro($idpro);
					$save = $proceso->edit();
				}else{
					$save = $proceso->save();
				}
				
				if($save){
					$_SESSION['register'] = "complete";
				}else{
					$_SESSION['register'] = "failed";
				}
			}else{
				$_SESSION['register'] = "failed";
			}
		}else{
			$_SESSION['register'] = "failed";
		}
		header("Location:".base_url.'proceso/index');
	}

	public function edit(){
		Utils::useraccess('flujo/index',$_SESSION['pefid']);
		if(isset($_GET['idpro'])){
			$idpro = $_GET['idpro'];
			$edit = true;
		
			$proceso = new Proceso();
			$proceso->setIdpro($idpro);
			$result = $proceso->getAll();

			$val = $proceso->getOne();
			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/proceso.php';
			
		}else{
			header('Location:'.base_url.'proceso/index');
		}
	}
}