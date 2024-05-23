<?php
include'models/soporte.php';

class RessopController{
	
	public function index(){		
		Utils::useraccess('ressop/index',$_SESSION['pefid']);
	
		$soporte = new soporte();
		$idst = isset($_REQUEST['idst']) ? $_REQUEST['idst'] : false;
		$ate = isset($_GET['ate']) ? $_GET['ate'] : false;
		$soporte->setIdst($idst);
		$soportes = $soporte->getOne();
		$asis = $soporte->getAllAsi();
		$psis = $soporte->getAllPer();

		// var_dump($tipo);
		// die();

		require_once 'views/ressop.php';
	}

	public function saverp(){
		Utils::useraccess('ressop/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$idst = isset($_POST['idst']) ? $_POST['idst'] : false;
			date_default_timezone_set('America/Bogota');
			$fecas = date("Y-m-d H:i:s");
			$perid = isset($_POST['perid']) ? $_POST['perid'] : $_SESSION['perid'];
			$desas = isset($_POST['desas']) ? $_POST['desas'] : false;
			$ceras = isset($_POST['ceras']) ? $_POST['ceras'] : 0;

			// echo $idst."-".$fecas."-".$perid."-".$desas."-".$ceras;
			// die();

			if($idst && $fecas && $perid && $desas){
				$soporte = new soporte();
				$soporte->setIdst($idst);
				$soporte->setFecas($fecas);
				$soporte->setPerid($perid);
				$soporte->setDesas($desas);
				$soporte->setCeras($ceras);

				$soporte->setIdst($idst);
				$soportes = $soporte->getOne();
				$psis = $soporte->getAllPer();

				// $save = $soporte->save();
				// $edit = $soporte->edit();
				if(isset($_GET['idst'])){
					$idst = $_GET['idst'];
					$soporte->setIdst($idst);
					$save = $soporte->edit();
				}else{
					$save = $soporte->saverp();
					if($ceras==1){
						$soporte->setCerst($ceras);
						$save = $soporte->editest();
					}
				}

				//echo "<script>alert('Su soporte ha sido registrada. Pronto estaremos en contacto.');</script>";
				
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
		//header("Location:".base_url.'ressop/index&idst='.$idst);
		header("Location:".base_url);
	}

	public function edit(){
		Utils::useraccess('ressop/index',$_SESSION['pefid']);
		if(isset($_GET['idst'])){
			$idst = $_GET['idst'];
// var_dump($idst);
// die();
			$edit = true;
		
			$soporte = new soporte();
			$soporte->setIdst($idst);
			$soporte->setCerst(0);
			$soportes = $soporte->getAll();
			$tipo = $soporte->getAllVal(20);

			$val = $soporte->getOne();
			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/ressop.php';
			
		}else{
			header('Location:'.base_url.'ressop/index');
		}
	}
}