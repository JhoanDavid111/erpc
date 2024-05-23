<?php
include'models/simulador.php';

class simuladorController{
	
	public function index(){
		// $pfd = isset($_SESSION['pefid']) ? $_SESSION['pefid']:NULL;
		// Utils::useraccess('denuncia/index',$pfd);
		//Utils::useraccess('denuncia/index',$_SESSION['pefid']);

	
		$salarios = new Simulador();
		$salario = $salarios->getAll();
		//$oneSal['saldevtem']=0;
		$oneSal[0]['rangosalario']=0;
		

		// var_dump($tipo);	
		// die();
		require_once 'views/vsimulador.php';
	}

	public function oneSal(){
		if(isset($_POST)){
			// var_dump($_POST);
			// die();
			$selsal = isset($_POST['selsal']) ? $_POST['selsal'] : false;

			

			$oneSals = new Simulador();
			$salario = $oneSals->getAll();
			$oneSal = $oneSals->getOne($selsal);
			// var_dump($oneSal[0]['idsimul']);
			// die();
			require_once 'views/vsimulador.php';

		}
	}

	public function save(){
		Utils::useraccess('denuncia/index',$_SESSION['pefid']);
		if(isset($_POST)){

			$denid = isset($_POST['denid']) ? $_POST['denid'] : false;
			date_default_timezone_set('America/Bogota');
			$denfec = date("Y-m-d H:i:s");
			$denano = isset($_POST['denano']) ? $_POST['denano'] : false;
			$denpro = isset($_POST['denpro']) ? $_POST['denpro'] : false;
			$dennom = isset($_POST['dennom']) ? $_POST['dennom'] : false;
			$denape = isset($_POST['denape']) ? $_POST['denape'] : false;
			$denide = isset($_POST['denide']) ? $_POST['denide'] : false;
			$dentel = isset($_POST['dentel']) ? $_POST['dentel'] : false;
			$denema = isset($_POST['denema']) ? $_POST['denema'] : false;
			$dentip = isset($_POST['dentip']) ? $_POST['dentip'] : false;
			$dendes = isset($_POST['dendes']) ? $_POST['dendes'] : false;
			$arch = isset($_FILES['arch']["name"]) ? $_FILES['arch']["name"]:NULL;
			$denarc = isset($_POST['denarc']) ? $_POST['denarc'] : false;
	// echo $denano."-".$denpro."-".$dentip."-".$dendes;
	// die();
			//Carga de archivo
			if($arch){
				$denarc = Utils::opti($_FILES['arch'], date('YmdHis'), "arcden","simulador");
			}

			if($denfec && $denano && $denpro && $denema && $dentip && $dendes){
				$denuncia = new Denuncia();
				$denuncia->setDenid($denid);
				$denuncia->setDenfec($denfec);
				$denuncia->setDenano($denano);
				$denuncia->setDenpro($denpro);
				$denuncia->setDennom($dennom);
				$denuncia->setDenape($denape);
				$denuncia->setDenide($denide);
				$denuncia->setDentel($dentel);
				$denuncia->setDenema($denema);
				$denuncia->setDentip($dentip);
				$denuncia->setDendes($dendes);
				$denuncia->setDenarc($denarc);

				$denuncias = $denuncia->getAll();
				$tipo = $denuncia->getAllVal(20);

				// $save = $denuncia->save();
				// $edit = $denuncia->edit();
				if(isset($_GET['denid'])){
					$denid = $_GET['denid'];
					$denuncia->setDenid($denid);
					
					$save = $denuncia->edit();
				}else{
					$save = $denuncia->save();
				}

				//echo "<script>alert('Su denuncia ha sido registrada. Pronto estaremos en contacto.');</script>";
				
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
		header("Location:".base_url.'denuncia/index');
	}

	public function edit(){
		Utils::useraccess('denuncia/index',$_SESSION['pefid']);
		if(isset($_GET['denid'])){
			$denid = $_GET['denid'];
// var_dump($denid);
// die();
			$edit = true;
		
			$denuncia = new Denuncia();
			$denuncia->setDenid($denid);
			$denuncias = $denuncia->getAll();
			$tipo = $denuncia->getAllVal(20);

			$val = $denuncia->getOne();
			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/denuncia.php';
			
		}else{
			header('Location:'.base_url.'denuncia/index');
		}
	}
}