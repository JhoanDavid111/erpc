<?php
include'models/capeve.php';

class CapeveController{
	
	public function index(){
		Utils::useraccess('capeve/index',$_SESSION['pefid']);
		$idce  = isset($_REQUEST['idce ']) ? $_REQUEST['idce '] : NULL;
		$txtn = isset($_GET['txtn']) ? $_GET['txtn']:NULL;

		$idce = isset($_GET['idce']) ? $_GET['idce']:NULL;

	//Objeto para llamar datos de dominio y valor en modulo configuracion

		date_default_timezone_set('America/Bogota');
	   	$hoy = date("Y-m-d H:m");
	   	// $fecfin = date('Y-m-d H:m', strtotime('+1 month', $hoy));

		$ce = new capeve();
		$tipce=$ce->getValdom(63);
		$modce=$ce->getValdom(60);
		$formce=$ce->getValdom(62);
		
		$ce->setIdce($idce);
		//$datCapeve = $ce->getOneCap(); 
	   	$capeve=$ce->getAlles();
		$datOne=$ce->getOne();
		
		require_once 'views/capeve.php';
	}

	public function list(){
		Utils::useraccess('capeve/index',$_SESSION['pefid']);
		$idce  = isset($_REQUEST['idce']) ? $_REQUEST['idce'] : NULL;
		date_default_timezone_set('America/Bogota');
	   	$hoy = date("Y-m-d H:m");
	   	// $fecfin = date('Y-m-d H:m', strtotime('+1 month', $hoy));

	   	$txtn = "";

		$ce=new capeve();
		$ce->setIdce($idce);
		$datOne=$ce->getOne();
		$list=$ce->getList();
		require_once 'views/vlist.php';
	}

	public function save(){
		Utils::useraccess('capeve/index',$_SESSION['pefid']);

		if(isset($_POST)){
			$idce  = isset($_POST['idce ']) ? $_POST['idce ']:NULL;
			$tipce = isset($_POST['tipce']) ? $_POST['tipce']:NULL;
			$modce = isset($_POST['modce']) ? $_POST['modce']:NULL;
			$nomce = isset($_POST['nomce']) ? $_POST['nomce']:NULL;
			$entce = isset($_POST['entce']) ? $_POST['entce']:NULL;
			$fecince = isset($_POST['fecince']) ? $_POST['fecince']:date("Y-m-d H:m");
			$fecfice = isset($_POST['fecfice']) ? $_POST['fecfice']:date("Y-m-d H:m");
			$desce = isset($_POST['desce']) ? $_POST['desce']:NULL;
			$linkce = isset($_POST['linkce']) ? $_POST['linkce']:NULL;
			$ubice = isset($_POST['ubice']) ? $_POST['ubice']:NULL;
			$formce = isset($_POST['formce']) ? $_POST['formce']:NULL;
			$comce = isset($_POST['comce']) ? $_POST['comce']:NULL;
			$asisce = isset($_POST['asisce']) ? $_POST['asisce']:NULL;


			$capeve = new capeve();
			$capeve->setIdce ($idce );
			$capeve->setTipce($tipce);
			$capeve->setModce($modce);
			$capeve->setNomce($nomce);
			$capeve->setEntce($entce);
			$capeve->setFecince($fecince);
			$capeve->setFecfice($fecfice);
			$capeve->setDesce($desce);
			$capeve->setLinkce($linkce);
			$capeve->setUbice($ubice);
			$capeve->setFormce($formce);
			$capeve->setComce($comce);
			$capeve->setAsisce($asisce);

			if($idce ){
				$save = $capeve->edit();
				$txtn = "actualizado";
			}else{
				$save = $capeve->save();
				$txtn = "registrado";
			}
			//echo "<script>alert('Su usuario ha sido ".$txtn.".');</script>";

			if($save){
				$_SESSION['register'] = "complete";
			}else{
				$_SESSION['register'] = "failed";
			}
		}else{
			$_SESSION['register'] = "failed";
		}
		header("Location:".base_url.'capeve/index&idce='.$idce.'&txtn='.$txtn);
	}
	
	public function edit(){
		//Utils::useraccess('capeve/index',$_SESSION['idce']);
		if(isset($_GET['idce'])){
			$idce = $_GET['idce'];
			$edit = true;
		
			$txtn = isset($_GET['txtn']) ? $_GET['txtn']:NULL;

			//Objeto para llamar datos de dominio y valor en modulo configuracion

			date_default_timezone_set('America/Bogota');
	   		$hoy = date("Y-m-d");

			$ce=new capeve();
			$tipce=$ce->getValdom(63);
			$modce=$ce->getValdom(60);
			$formce=$ce->getValdom(62);
		
			$ce->setIdce($idce );
			$capeve=$ce->getAlles($idce);
	   		$ce->setIdce($idce);
			$datOne = $ce->getOne();
			require_once 'views/capeve.php';
		}else{
			header('Location:'.base_url.'capeve/index');
		}
	}
}