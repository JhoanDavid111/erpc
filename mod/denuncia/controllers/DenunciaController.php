<?php
include'models/denuncia.php';

class denunciaController{
	
	public function index(){
		// $pfd = isset($_SESSION['pefid']) ? $_SESSION['pefid']:NULL;
		// Utils::useraccess('denuncia/index',$pfd);
		//Utils::useraccess('denuncia/index',$_SESSION['pefid']);

		$txtn = isset($_REQUEST['txtn']) ? $_REQUEST['txtn']:NULL;
		$denuncia = new Denuncia();
		$denuncias = $denuncia->getAll();
		$tipo = $denuncia->getAllVal(20);
		$est = $denuncia->getAllVal(64);

		// var_dump($tipo);
		// die();
		if(isset($_SESSION['pefid'])){
			if($_SESSION['pefid']==24)
				require_once 'views/denuncia.php';
			else
				require_once 'views/denuncias.php';
		}else
			require_once 'views/denuncias.php';
	}

	public function save(){
		//Utils::useraccess('denuncia/index',$_SESSION['pefid']);

		if(isset($_POST)){
			$ip = $_SERVER["REMOTE_ADDR"];
     		$captcha = $_POST['g-recaptcha-response'];
   		    $secretKey = '6Lc6LCEfAAAAAAwvPU20257qXSfzkhO0dk8_lI7l';

            $errors = array();

            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captcha}&remoteip={$ip}");

            $atributos = json_decode($response, TRUE);

            if (!$atributos['success']) {
            	 echo "<script>
                alert('El recaptcha es obligatorio');
                window.history.back ();
    			</script>";die();

				//echo '<script language="javascript">alert("Verifica el captcha");</script>';	

				//echo "<script>location.href='https://intranet.canalcapital.gov.co/intranet/rrhh/denuncia'</script>";

		    }else{
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
					$denarc = Utils::opti($_FILES['arch'], date('YmdHis'), "arcden","denuncia");
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
			}
		}else{
			$_SESSION['register'] = "failed";
		}
		header("Location:".base_url.'denuncia/index');
	}

	public function edit(){
		//Utils::useraccess('denuncia/index',$_SESSION['pefid']);

		$txtn = isset($_REQUEST['txtn']) ? $_REQUEST['txtn']:NULL;
		if(isset($_GET['denid'])){
			$denid = $_GET['denid'];
// var_dump($denid);
// die();
			$edit = true;
		
			$denuncia = new Denuncia();
			$denuncia->setDenid($denid);
			$denuncias = $denuncia->getAll();
			$tipo = $denuncia->getAllVal(20);
			$est = $denuncia->getAllVal(64);

			$val = $denuncia->getOne();
			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/denuncia.php';
			
		}else{
			header('Location:'.base_url.'denuncia/index');
		}
	}

	public function svobs(){
		Utils::useraccess('denuncia/index',$_SESSION['pefid']);

		$idobs = isset($_POST['idobs']) ? $_POST['idobs']:NULL;
		$denid = isset($_REQUEST['denid']) ? $_REQUEST['denid']:NULL;
		$perid = $_SESSION['perid'];
		$denfec = date('Y-m-d H:i:s');
		$denobs = isset($_POST['denobs']) ? $_POST['denobs']:NULL;
		$denest = isset($_POST['denest']) ? $_POST['denest']:NULL;

		// echo "<br><br><br>".$idobs."-".$denid."-".$perid."-".$denfec."-".$denobs."-".$denest."<br><br><br>";
		if($denid && $denobs && $denest){
			$denuncia = new Denuncia();
			$denuncia->setDenid($denid);
			$denuncia->setPerid($perid);
			$denuncia->setDenfec($denfec);
			$denuncia->setDenobs($denobs);
			$denuncia->setDenest($denest);
			$denuncia->saveObs();
			//require_once 'views/denuncia.php';
			header('Location:'.base_url.'denuncia/index');
		}else{
			header('Location:'.base_url.'denuncia/index&txtn=No se guardo la observación');
		}
	}

	public function dlobs(){
		Utils::useraccess('denuncia/index',$_SESSION['pefid']);

		$idobs = isset($_REQUEST['idobs']) ? $_REQUEST['idobs']:NULL;

		// echo "<br><br><br>".$idobs."-".$denid."-".$perid."-".$denfec."-".$denobs."-".$denest."<br><br><br>";
		if($idobs){
			$denuncia = new Denuncia();
			$denuncia->setIdobs($idobs);
			$denuncia->delObs();
		}
		header('Location:'.base_url.'denuncia/index');
	}
}