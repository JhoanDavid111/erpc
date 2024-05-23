<?php
include'models/contrato.php';

class resoController{
	
	public function index(){		
		//Utils::isAdmin();

		$contrato = new contrato();
		date_default_timezone_set('America/Bogota');
		$ano = isset($_GET['ano']) ? $_GET['ano']:date("Y");
		$mes = date('n');
		$idcon = isset($_GET['idcon']) ? $_GET['idcon']:false;
		$act = isset($_GET['act']) ? $_GET['act']:false;
		if(isset($_GET['idcon']) AND isset($_GET['idtra'])){
			$idcon = $_GET['idcon'];
			$idtra = $_GET['idtra'];
			$lei = $contrato->updlei($_SESSION["perid"], $idtra, 1);
			if(!$lei){
				$contrato->inslei($_SESSION["perid"], $idtra);
				$contrato->updlei($_SESSION["perid"], $idtra, 1);
			}
		}
		$contrato->setidcon($idcon);
		$datsop = $contrato->getOne($ano);
		$databo = $contrato->selabogado(13);
		$datare = $contrato->selval(1);
		$datTA = $contrato->selTA();
		$datasi = $contrato->seltrazabilidad($idcon);
		$datusu = $contrato->selvalpef($_SESSION["pefid"]);
		$contratos = $contrato->getAll($ano);
		$tipo = $contrato->getAllVal(20);

		if(isset($_GET['elcon'])){
			$elcon = $_GET['elcon'];
			$eli = $contrato->updeli($elcon);
		}

		$fes = $contrato->selfest($ano);


		// var_dump($tipo);
		// die();
		require_once 'views/reso.php';
	}

	public function save(){
		//Utils::isAdmin();
		if(isset($_POST)){

			$idcon = isset($_POST['idcon']) ? $_POST['idcon'] : false;
			$idtra = isset($_GET['idtra']) ? $_GET['idtra']:false;
			date_default_timezone_set('America/Bogota');
			$ano = isset($_GET['ano']) ? $_GET['ano']:date("Y");
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
			$estseccon = isset($_POST['estseccon']) ? $_POST['estseccon'] : false;
			$nocon = isset($_POST['nocon']) ? $_POST['nocon'] : false;
	// echo $perid."-".$valid."-".$pubseccon."-".$enlseccon;
	// die();

			if($feccon && $perid && $valid && $linexpcon){
				$contrato = new contrato();
				$contrato->setIdcon($idcon);
				$contrato->setFeccon($feccon);
				$contrato->setPerid($perid);
				$contrato->setValid($valid);
				$contrato->setNomcon($nomcon);
				$contrato->setObjcon($objcon);
				$contrato->setParid($parid);
				$contrato->setLinexpcon($linexpcon);
				$contrato->setLineccon($lineccon);
				$contrato->setPubseccon($pubseccon);
				$contrato->setEnlseccon($enlseccon);
				$contrato->setNoseccon($noseccon);
				$contrato->setEstseccon($estseccon);
				$contrato->setNocon($nocon);
				$contratos = $contrato->getAll($ano);
				$tipo = $contrato->getAllVal(20);
// echo "<br><br><br>".$_GET['idcon']."-".$idcon."-".$feccon."-".$perid."-".$objcon."-".$valid."-".$parid."-".$nomcon."-".$linexpcon."-".$lineccon."-".$pubseccon."-".$enlseccon."-".$noseccon."-".$estseccon."-".$nocon."<br><br><br>";
// die();
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
		header("Location:".base_url.'reso/index&idcon='.$idcon.'&idtra='.$idtra);
	}

	public function edit(){
		Utils::isAdmin();
		if(isset($_GET['idcon'])){
			if(isset($_GET['idcon']) AND isset($_GET['idtra'])){
				$idcon = $_GET['idcon'];
				$idtra = $_GET['idtra'];
			}
// var_dump($idcon);
// die();
			$edit = true;
		
			$contrato = new contrato();
			date_default_timezone_set('America/Bogota');
			$ano = isset($_GET['ano']) ? $_GET['ano']:date("Y");
			$contrato->setIdcon($idcon);
			$contratos = $contrato->getAll($ano);
			$databo = $contrato->selabogado(13);
			$datare = $contrato->selval(1);
			$datTA = $contrato->selTA();
			$datasi = $contrato->seltrazabilidad($idcon);
			$datusu = $contrato->selvalpef($_SESSION["pefid"]);
			$contratos = $contrato->getAll($ano);
			$tipo = $contrato->getAllVal(20);
			$datsop = $contrato->getOne($ano);

			$val = $contrato->getOne($ano);
			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/reso.php';
			
		}else{
			header('Location:'.base_url.'reso/index');
		}
	}

	public function saveseg(){
		//Utils::isAdmin();
		if(isset($_POST)){

			if(isset($_GET['idcon']) AND isset($_GET['idtra'])){
				$idcon = $_GET['idcon'];
				$idtra = $_GET['idtra'];
			}
			// echo "<br><br><br>".$idcon." ".$idtra."<br><br><br>";
			// die();
			$idcon = isset($_POST['idcon']) ? $_POST['idcon'] : false;
			date_default_timezone_set('America/Bogota');
			$fectra = date("Y-m-d H:i:s");
			$perid = isset($_POST['perid']) ? $_POST['perid'] : $_SESSION["perid"];
			$valid = isset($_POST['valid']) ? $_POST['valid'] : false;
			$obstra = isset($_POST['obstra']) ? $_POST['obstra'] : false;
	// echo $perid."-".$valid."-".$pubseccon."-".$enlseccon;
	// die();

			if($idcon && $fectra && $valid && $obstra && $perid){
				$contrato = new contrato();
				$contrato->setIdcon($idcon);
				$contrato->setFectra($fectra);
				$contrato->setValid($valid);
				$contrato->setObstra($obstra);
				$contrato->setPerid($perid);
				$contrato->savetraz($idcon, $fectra, $valid, $obstra, $_SESSION["perid"]);
				
				$contratos = $contrato->getAll($ano);
				$tipo = $contrato->getAllVal(20);

				$save = $contrato->save();
				// $edit = $contrato->edit();

				// if(isset($_GET['idcon'])){
				// 	$idcon = $_GET['idcon'];
				// 	$contrato->setidcon($idcon);
					
				// 	$save = $contrato->edit();
				// }else{
				// 	$save = $contrato->save();
				// }

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
		header("Location:".base_url.'reso/index&idcon='.$idcon.'&idtra='.$idtra);
	}
}