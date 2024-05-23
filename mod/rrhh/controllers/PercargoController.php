<?php
include'models/percargo.php';

class PercargoController{	
	public function index(){
		Utils::useraccess('percargo/index',$_SESSION['pefid']);
		$perid = isset($_REQUEST['perid']) ? $_REQUEST['perid'] : NULL;
		$txtn = isset($_GET['txtn']) ? $_GET['txtn']:NULL;

		//Objeto para llamar datos de dominio y valor en modulo configuracion

		date_default_timezone_set('America/Bogota');
	   	$hoy = date("Y-m-d");

	   	$pc=new percargo();
	   	$tdocpcg=$pc->getValdo(44);
	   	$sexpcg=$pc->getValdo(34);
	   	$prtpcg=$pc->getValdo(43);
		$tippcg=$pc->getValdo(45);
		
		$pc->setPerid($perid);
	   	$datOusu = $pc->getOnePer();
	   	$percargo=$pc->getAlles($perid);
		$datOne=NULL;
		require_once 'views/percargo.php';
	}

	public function save(){
		Utils::useraccess('percargo/index',$_SESSION['pefid']);

		if(isset($_POST)){			
			$idpcg2 = isset($_POST['idpcg2']) ? $_POST['idpcg2']:NULL;	
			$perid = isset($_POST['perid']) ? $_POST['perid']:NULL;
			$tdocpcg = isset($_POST['tdocpcg']) ? $_POST['tdocpcg']:NULL;	
			$idpcg = isset($_POST['idpcg']) ? $_POST['idpcg']:NULL;	
			$nompcg = isset($_POST['nompcg']) ? $_POST['nompcg']:NULL;	
			$sexpcg = isset($_POST['sexpcg']) ? $_POST['sexpcg']:NULL;
			$fnacpcg = isset($_POST['fnacpcg']) ? $_POST['fnacpcg']:NULL;
			$prtpcg = isset($_POST['prtpcg']) ? $_POST['prtpcg']:NULL;	
			$tippcg = isset($_POST['tippcg']) ? $_POST['tippcg']:NULL;	
			
			$percargo = new Percargo();
			$percargo->setIdpcg2($idpcg2);
			$percargo->setPerid($perid);
			$percargo->setTdocpcg($tdocpcg);
			$percargo->setIdpcg($idpcg);
			$percargo->setNompcg($nompcg);
			$percargo->setSexpcg($sexpcg);
			$percargo->setFnacpcg($fnacpcg);
			$percargo->setPrtpcg($prtpcg);
			$percargo->setTippcg($tippcg);

			if($idpcg2){
				$save = $percargo->edit();
				$txtn = "actualizado";
			}else{
				$save = $percargo->save();
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
		header("Location:".base_url.'percargo/index&perid='.$perid.'&txtn='.$txtn);
	}

	public function edit(){
		//Utils::useraccess('percargo/index',$_SESSION['perid']);
		if(isset($_GET['perid']) && isset($_GET['idpcg2'])){
			$perid = $_GET['perid'];
			$idpcg2= $_GET['idpcg2'];
			$edit = true;
		
			$txtn = isset($_GET['txtn']) ? $_GET['txtn']:NULL;

			//Objeto para llamar datos de dominio y valor en modulo configuracion

			date_default_timezone_set('America/Bogota');
		   	$hoy = date("Y-m-d");

			$pc=new percargo();
	   		$tdocpcg=$pc->getValdo(44);
	   		$sexpcg=$pc->getValdo(34);
	   		$prtpcg=$pc->getValdo(43);
			$tippcg=$pc->getValdo(45);
		
			$pc->setPerid($perid);
	   		$datOusu = $pc->getOnePer();
	   		$percargo=$pc->getAlles($perid);
			$pc->setIdpcg2($idpcg2);
			$datOne = $pc->getOne();
			require_once 'views/percargo.php';
		}else{
			header('Location:'.base_url.'percargo/index');
		}
	}
}