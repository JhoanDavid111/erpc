<?php
include'models/dats.php';

class DatsController{
	public function index(){
		Utils::useraccess('dats/index',$_SESSION['pefid']);
		$perid = isset($_REQUEST['perid']) ? $_REQUEST['perid'] : NULL;
		$txtn = isset($_GET['txtn']) ? $_GET['txtn']:NULL;

		//Objeto para llamar datos de dominio y valor en modulo configuracion

		date_default_timezone_set('America/Bogota');
	   	$hoy = date("Y-m-d");

		$ds=new dats();
		$ulsecu=$ds->ulsecu();
		$medcap=$ds->medcap();
		$modest=$ds->modest();
		$grad=$ds->grad();
		$tarjp=$ds->tarjp();
		$tiptitul=$ds->tiptitul();

		$ds->setPerid($perid);
		$datPer = $ds->getOnePer();
		$edusup=$ds->getAlles($perid);
		$datOne=NULL;
		require_once 'views/dats.php';
	}

	public function save(){
		Utils::useraccess('dats/index',$_SESSION['pefid']);

		if(isset($_POST)){
			$idedusup = isset($_POST['idedusup']) ? $_POST['idedusup']:NULL;
			$perid = isset($_POST['perid']) ? $_POST['perid']:NULL;
			$nomedusup = isset($_POST['nomedusup']) ? $_POST['nomedusup']:NULL;
			$ulsecu = isset($_POST['ulsecu']) ? $_POST['ulsecu']:NULL;
			$feculsem = isset($_POST['feculsem']) ? $_POST['feculsem']:date("Y-m-d");
			$modest = isset($_POST['modest']) ? $_POST['modest']:NULL;
			$medcap = isset($_POST['medcap']) ? $_POST['medcap']:NULL;
			$dep = isset($_POST['dep']) ? $_POST['dep']:NULL;
			$grad = isset($_POST['grad']) ? $_POST['grad']:NULL;
			$tarjp = isset($_POST['tarjp']) ? $_POST['tarjp']:NULL;
			$fecgrad = isset($_POST['fecgrad']) ? $_POST['fecgrad']:date("Y-m-d");
			$tiptitul = isset($_POST['tiptitul']) ? $_POST['tiptitul']:NULL;

			$dats = new dats();
			$dats->setIdedusup($idedusup);
			$dats->setPerid($perid);
			$dats->setNomedusup($nomedusup);
			$dats->setUlsecu($ulsecu);
			$dats->setFeculsem($feculsem);
			$dats->setModest($modest);
			$dats->setMedcap($medcap);
			$dats->setDep($dep);
			$dats->setGrad($grad);
			$dats->setTarjp($tarjp);
			$dats->setFecgrad($fecgrad);
			$dats->setTiptitul($tiptitul);

			if($idedusup){
				$save = $dats->edit();
				$txtn = "actualizado";
			}else{
				$save = $dats->save();
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
		header("Location:".base_url.'dats/index&perid='.$perid.'&txtn='.$txtn);
	}
	
	public function edit(){
		//Utils::useraccess('dats/index',$_SESSION['perid']);
		if(isset($_GET['perid']) && isset($_GET['idedusup'])){
			$perid = $_GET['perid'];
			$idedusup= $_GET['idedusup'];
			$edit = true;
		
			$txtn = isset($_GET['txtn']) ? $_GET['txtn']:NULL;

			//Objeto para llamar datos de dominio y valor en modulo configuracion

			date_default_timezone_set('America/Bogota');
		   	$hoy = date("Y-m-d");

			$ds=new dats();
			$ulsecu=$ds->ulsecu();
			$medcap=$ds->medcap();
			$modest=$ds->modest();
			$grad=$ds->grad();
			$tarjp=$ds->tarjp();
			$tiptitul=$ds->tiptitul();

			$ds->setPerid($perid);
			$datPer = $ds->getOnePer();
			$edusup=$ds->getAlles($perid);
			$ds->setIdedusup($idedusup);
			$datOne = $ds->getOne();
			require_once 'views/dats.php';
		}else{
			header('Location:'.base_url.'dats/index');
		}
	}
}
