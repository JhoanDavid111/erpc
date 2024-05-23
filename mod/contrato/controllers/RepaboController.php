<?php
include'models/contrato.php';

class repaboController{
	
	public function index(){		
		Utils::useraccess('repabo/index',$_SESSION['pefid']);
	
		$contrato = new contrato();
		$contratos = $contrato->getAll(2021);
		$tipo = $contrato->getAllVal(20);

		// var_dump($tipo);
		// die();
		// if(isset($_SESSION['pefid'])){
			// if($_SESSION['pefid']==24)
				require_once 'views/repabo.php';
			// else
			// 	require_once 'views/contratos.php';
		// }else
		// 	require_once 'views/contratos.php';
	}

	public function save(){
		Utils::useraccess('repabo/index',$_SESSION['pefid']);
		if(isset($_POST)){

			$idcon = isset($_POST['idcon']) ? $_POST['idcon'] : false;
			date_default_timezone_set('America/Bogota');
			$feccon = date("Y-m-d H:i:s");
			$perid = isset($_POST['perid']) ? $_POST['perid'] : false;
			$valid = isset($_POST['valid']) ? $_POST['valid'] : false;
			$nomcon = isset($_POST['nomcon']) ? $_POST['nomcon'] : false;
			$objcon = isset($_POST['objcon']) ? $_POST['objcon'] : false;
			$parid = isset($_POST['parid']) ? $_POST['parid'] : false;
			$linexpcon = isset($_POST['linexpcon']) ? $_POST['linexpcon'] : false;
			$lineccon = isset($_POST['lineccon']) ? $_POST['lineccon'] : false;
			$pubseccon = isset($_POST['pubseccon']) ? $_POST['pubseccon'] : false;
			$enlseccon = isset($_POST['enlseccon']) ? $_POST['enlseccon'] : false;
			$arch = isset($_FILES['arch']["name"]) ? $_FILES['arch']["name"]:NULL;
			$noseccon = isset($_POST['noseccon']) ? $_POST['noseccon'] : false;
	// echo $perid."-".$valid."-".$pubseccon."-".$enlseccon;
	// die();


			if($feccon && $perid && $valid && $lineccon && $pubseccon && $enlseccon){
				$contrato = new contrato();
				$contrato->setidcon($idcon);
				$contrato->setfeccon($feccon);
				$contrato->setperid($perid);
				$contrato->setvalid($valid);
				$contrato->setnomcon($nomcon);
				$contrato->setobjcon($objcon);
				$contrato->setparid($parid);
				$contrato->setlinexpcon($linexpcon);
				$contrato->setlineccon($lineccon);
				$contrato->setpubseccon($pubseccon);
				$contrato->setenlseccon($enlseccon);
				$contrato->setnoseccon($noseccon);

				$contratos = $contrato->getAll(2021);
				$tipo = $contrato->getAllVal(20);

				// $save = $contrato->save();
				// $edit = $contrato->edit();
				if(isset($_GET['idcon'])){
					$idcon = $_GET['idcon'];
					$contrato->setidcon($idcon);
					
					$save = $contrato->edit();
				}else{
					$save = $contrato->save();
				}

				//echo "<script>alert('Su contrato ha sido registrada. Pronto estaremos en contacto.');</script>";
				
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
		header("Location:".base_url.'repabo/index');
	}

	public function edit(){
		Utils::useraccess('repabo/index',$_SESSION['pefid']);
		if(isset($_GET['idcon'])){
			$idcon = $_GET['idcon'];
// var_dump($idcon);
// die();
			$edit = true;
		
			$contrato = new contrato();
			$contrato->setidcon($idcon);
			$contratos = $contrato->getAll(2021);
			$tipo = $contrato->getAllVal(20);

			$val = $contrato->getOne();
			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/repabo.php';
			
		}else{
			header('Location:'.base_url.'repabo/index');
		}
	}
}