<?php
include'models/preres.php';

class preresController{
	
	public function index(){
		Utils::useraccess('preres/index' ,$_SESSION['pefid']);
		
		$preres = new Preres();
		$datipo = $preres->getVal(26);
		$preress = $preres->getAll();
		
		require_once 'views/preres.php';
	}

	public function evalua(){
		//Utils::useraccess('preres/index' ,$_SESSION['pefid']);
		$idprov = isset($_GET['idprov']) ? $_GET['idprov']:NULL;
		$tipp = isset($_GET['tipp']) ? $_GET['tipp']:NULL;
		if($idprov){
			$preres = new Preres();
			$preres->setIdprov($idprov);
			$dtprov = $preres->getProv();
			$preress = $preres->getAll($tipp);
			
			require_once 'views/evalua.php';
		}else{
			header("Location:".base_url.'proveedor/index');
		}
	}

	public function histo(){
		//Utils::useraccess('preres/index' ,$_SESSION['pefid']);
		$idprov = isset($_GET['idprov']) ? $_GET['idprov']:NULL;
		if($idprov){
			$preres = new Preres();
			$preres->setIdprov($idprov);
			$dtprov = $preres->getProv();
			$preress = $preres->getAll();
			$histo = $preres->getHistori();
			
			require_once 'views/historial.php';
		}else{
			header("Location:".base_url.'proveedor/index');
		}
	}

	public function save(){
		Utils::useraccess('preres/index' ,$_SESSION['pefid']);
		if(isset($_POST)){

			$idepr = isset($_POST['idepr']) ? $_POST['idepr'] : false;
			$txtepr = isset($_POST['txtepr']) ? $_POST['txtepr'] : false;
			$tipepr = isset($_POST['tipepr']) ? $_POST['tipepr'] : false;
			// echo $idepr." - ".$txtepr." - ".$tipepr;
			
			if($txtepr && $tipepr){
				$preres = new Preres();
				$preres->setIdepr($idepr);
				$preres->setTxtepr($txtepr);
				$preres->setTipepr($tipepr);
				
				$datipo = $preres->getVal(26);
				$preress = $preres->getAll();
				if(isset($_GET['idepr'])){
					$idepr = $_GET['idepr'];
					$preres->setIdepr($idepr);
					$save = $preres->edit();
				}else{
					$save = $preres->save();
				}

				//echo "<script>alert('Su preres ha sido registrado.');</script>";
				
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
		header("Location:".base_url.'preres/index');
	}

	public function edit(){
		Utils::useraccess('preres/index' ,$_SESSION['pefid']);
		if(isset($_GET['idepr'])){
			$idepr = $_GET['idepr'];
			$edit = true;
		
			$preres = new Preres();
			$preres->setIdepr($idepr);
			$datipo = $preres->getVal(26);
			$preress = $preres->getAll();
			$val = $preres->getOne();
			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/preres.php';
			
		}else{
			header('Location:'.base_url.'preres/index');
		}
	}

	public function saveResp(){
		Utils::useraccess('preres/index' ,$_SESSION['pefid']);
		if(isset($_POST)){
			$preres = new Preres();
			$idepr = isset($_POST['id']) ? $_POST['id'] : false;
			$txtere = isset($_POST['txtere']) ? $_POST['txtere'] : false; 
			$punere = isset($_POST['punere']) ? $_POST['punere'] : false;

			if($idepr && $txtere && $punere){
				$preres = new Preres();
				$preres->setIdepr($idepr);
				$preres->setTxtere($txtere);
				$preres->setPunere($punere);
				$save = $preres->saveResp();
			}
		}
		header("Location:".base_url.'preres/index');
	}

	public function saveEvalu(){
		// Utils::useraccess('preres/index' ,$_SESSION['pefid']);
		if(isset($_POST)){

			$idprov = isset($_POST['idprov']) ? $_POST['idprov'] : false;
			date_default_timezone_set('America/Bogota');
	   		$fecha = date("Y-m-d H:i:s");
			$califica = isset($_POST['califica']) ? $_POST['califica']:0;
			$perid = $_SESSION['perid'];
			
			$idepr = isset($_POST['idepr']) ? $_POST['idepr']: false;
			
			//echo "<br>".$idprov.",".$fecha.",".$califica.",".$perid."<br>";

			if($idprov && $perid){
				$preres = new Preres();
				$preres->setIdprov($idprov);
				$preres->setFecha($fecha);
				$preres->setCalifica($califica);
				$preres->setPerid($perid);

				$save = $preres->saveCali();
				$idcali = $preres->getLastIdcali();

				foreach ($idepr as $idp) {
					$idere = isset($_POST['idere'.$idp]) ? $_POST['idere'.$idp]: false;
					$calepe = $preres->getPunres($idere);
					//echo "Pregunta: ".$idp." Valor: ".$idere."<br>";
					$preres->setIdepr($idp);
					$preres->setIdere($idere);
					$preres->setCalepe($calepe[0]["punere"]);
					$preres->setIdcali($idcali[0]["idc"]);
					$save = $preres->saveEva();
				}
				$promF = $preres->getPromEva($idcali[0]["idc"]);
				$preres->setCalifica($promF[0]['prom']);
				$save = $preres->editCali();

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
		header("Location:".base_url.'proveedor/index');
	}

	public function eliRsp(){
		Utils::useraccess('preres/index' ,$_SESSION['pefid']);
		if(isset($_GET['idere'])){
			$idere = $_GET['idere'];
			$preres = new Preres();
			$preres->setIdere($idere);
			$preres->del();
		}
		header('Location:'.base_url.'preres/index');
	}	
}