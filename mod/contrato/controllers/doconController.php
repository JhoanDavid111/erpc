<?php
include'models/contrato.php';
include'../financiera/models/detpaadoc.php';

class doconController{
	
	public function index(){		
		Utils::useraccess('docon/index',$_SESSION['pefid']);

		$detpaadoc = new Detpaadoc();
		date_default_timezone_set('America/Bogota');
		$idcon = isset($_REQUEST['idcon']) ? $_REQUEST['idcon']:NULL;

		$contrato = new contrato();
		$ano = isset($_GET['ano']) ? $_GET['ano']:date("Y");
		$mes = date('n');
		$est = isset($_POST['st']) ? $_POST['st']:NULL;
		$abo = isset($_POST['ab']) ? $_POST['ab']:NULL;
		$act = isset($_GET['act']) ? $_GET['act']:false;
		$contrato->setidcon($idcon);
		$datsop = $contrato->getOne($ano);
		$databo = $contrato->selabogado(13);
		$datare = $contrato->selval(1);
		$datTA = $contrato->selTA();
		$datasi = $contrato->seltrazabilidad($idcon);
		$datusu = $contrato->selvalpef($_SESSION["pefid"]);
		$contratos = $contrato->getAll($ano,$est,$abo);
		$tipo = $contrato->getAllVal(20);

		$datAll = NULL;
		if($idcon){
			$detpaadoc->setIdcon($idcon);
			$datAll = $detpaadoc->getAll();
		}
		//var_dump($datAll);
		require_once 'views/cardoc.php';
	}

	public function save(){
		Utils::useraccess('contrato/index',$_SESSION['pefid']);
		if(isset($_POST)){

			$idcon = isset($_POST['idcon']) ? $_POST['idcon'] : false;
			date_default_timezone_set('America/Bogota');
			$ano = isset($_GET['ano']) ? $_GET['ano']:date("Y");
			$est = isset($_POST['st']) ? $_POST['st']:NULL;
			$abo = isset($_POST['ab']) ? $_POST['ab']:NULL;
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


			if($feccon && $perid && $valid && $linexpcon){
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

				$contratos = $contrato->getAll($ano,$est,$abo);;
				$tipo = $contrato->getAllVal(20);

				// $save = $contrato->save();
				// $edit = $contrato->edit();
				if(isset($_GET['idcon'])){
					$idcon = $_GET['idcon'];
					$contrato->setidcon($idcon);
					
					$save = $contrato->edit();
				}else{
					$save = $contrato->save();
					$estado = '51';
					$idcon = $contrato->selsop2($feccon, $perid, $nomcon, $valid, $parid, $linexpcon);
					$contrato->setidcon($idcon[0]['idcon']);
					$contrato->setvalid($estado);
					$contrato->setobstra('Inicio proceso');
					$contrato->setperid($_SESSION["perid"]);
					$contrato->setfectra($feccon);
					$contrato->savetraz();
					$idtra = $contrato->straza($idcon[0]['idcon'], $feccon, $estado, $_SESSION["perid"]);
					$contrato->updtrz2($idtra[0]['idtra'], 1);
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
		header("Location:".base_url.'contrato/index');
	}

	public function edit(){
		Utils::useraccess('contrato/index',$_SESSION['pefid']);
		if(isset($_GET['idcon'])){
			$idcon = $_GET['idcon'];
			$edit = true;
			$est = isset($_POST['st']) ? $_POST['st']:NULL;
			$abo = isset($_POST['ab']) ? $_POST['ab']:NULL;
		
			$contrato = new contrato();
			date_default_timezone_set('America/Bogota');
			$ano = isset($_GET['ano']) ? $_GET['ano']:date("Y");
			$contrato->setidcon($idcon);
			$contratos = $contrato->getAll($ano,$est,$abo);;
			$tipo = $contrato->getAllVal(20);

			$val = $contrato->getOne();
			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/contrato.php';
			
		}else{
			header('Location:'.base_url.'contrato/index');
		}
	}
}
?>