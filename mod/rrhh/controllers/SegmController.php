<?php
include'models/segm.php';

class SegmController{	
	public function index(){
		Utils::useraccess('segm/index',$_SESSION['pefid']);
		$perid = isset($_REQUEST['perid']) ? $_REQUEST['perid'] : NULL;
		$txtn = isset($_GET['txtn']) ? $_GET['txtn']:NULL;

		//Objeto para llamar datos de dominio y valor en modulo configuracion
	
		date_default_timezone_set('America/Bogota');
	   	$hoy = date("Y-m-d");

	   	$cm=new segm();
	   	$disca=$cm->getValdom(54);
	   	$tipo=$cm->getValdom(46);
	   	$condi=$cm->getValdom(47);

	   	$cm->setPerid($perid);
	   	$datSegm = $cm->getOnePer(); 
	   	$segm=$cm->getAlles($perid);
	   	$datOne=NULL;
		require_once 'views/segm.php';
	}

	public function save(){
		Utils::useraccess('segm/index',$_SESSION['pefid']);

		if(isset($_POST)){	
			$idcondiusu = isset($_POST['idcondiusu']) ? $_POST['idcondiusu'] : NULL;
			$perid = isset($_POST['perid']) ? $_POST['perid']:NULL;
			$fecdia = isset($_POST['fecdia']) ? $_POST['fecdia'] : NULL;
			$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
			$condi = isset($_POST['condi']) ? $_POST['condi'] : NULL;
			$diag = isset($_POST['diag']) ? $_POST['diag'] : NULL;
			$fecfincod = isset($_POST['fecfincod']) ? $_POST['fecfincod'] : NULL;
			$arccon = isset($_POST['arccon']) ? $_POST['arccon'] : NULL;
			$tiedis = isset($_POST['tiedis']) ? $_POST['tiedis'] : NULL;
			$disca = isset($_POST['disca']) ? $_POST['disca'] : NULL;
			$arcdis = isset($_POST['arcdis']) ? $_POST['arcdis'] : NULL;

			$segm = new Segm();
			$segm->setIdcondiusu($idcondiusu);
			$segm->setPerid($perid);
			$segm->setFecdia($fecdia);
			$segm->setTipo($tipo);
			$segm->setCondi($condi);
			$segm->setDiag($diag);
			$segm->setFecfincod($fecfincod);
			$segm->setArccon($arccon);
			$segm->setTiedis($tiedis);
			$segm->setDisca($disca);
			$segm->setArcdis($arcdis);

			if($idcondiusu){
				$save = $segm->edit();
				$txtn = "actualizado";
			}else{
				$save = $segm->save();
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
		header("Location:".base_url.'segm/index&perid='.$perid.'&txtn='.$txtn);
	}
	
	public function edit(){
		//Utils::useraccess('segm/index',$_SESSION['perid']);
		if(isset($_GET['perid']) && isset($_GET['idcondiusu'])){
			$perid = $_GET['perid'];
			$idcondiusu= $_GET['idcondiusu'];
			$edit = true;
		
			$txtn = isset($_GET['txtn']) ? $_GET['txtn']:NULL;

			//Objeto para llamar datos de dominio y valor en modulo configuracion

			date_default_timezone_set('America/Bogota');
		   	$hoy = date("Y-m-d");

			$cm=new segm();
	   		$disca=$cm->getValdom(54);
	   		$tipo=$cm->getValdom(46);
	   		$condi=$cm->getValdom(47);

	   		$cm->setPerid($perid);
	   		$datSegm = $cm->getOnePer(); 
	   		$segm=$cm->getAlles($perid);
	   		$cm->setIdcondiusu($idcondiusu);
	   		$datOne = $cm->getOne();
			require_once 'views/segm.php';
		}else{
			header('Location:'.base_url.'segm/index');
		}
	}
}