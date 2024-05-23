<?php
include'models/antproy.php';
include'models/newpaa.php';
include'models/rubro.php';

class anteliController{
	
	public function index(){		
		//Utils::useraccess('antproy/index',$_SESSION['pefid']);

		$rubro = new Rubro();			
		$num = $rubro->getNumAnteP('2023');
		$ninipaa = $num[0]['ninipaa'];

		$pfinan = new Newpaa();
		$pfinan->setIdpaa('2023'); 
		$pfinand = $pfinan->getAllAnEl();

		require_once 'views/antproeli.php';
	}

	function AntRes(){
		Utils::useraccess('antproy/index',$_SESSION['pefid']);
		$insAntp= new Antproy();
		$iddpa = isset($_GET['iddpa']) ? $_GET['iddpa'] : false;
		if($iddpa){
			$insAntp->setIddpa($iddpa);
			date_default_timezone_set('America/Bogota');
			$fecha = date("Y-m-d H:i:s");
			$observaciones = "Restaurado: ".$_SESSION['pefid']." ".$_SESSION['pefnom']." ".$fecha;
			$insAntp->setObservaciones($observaciones);
			$elidp = 1;
			$insAntp->setElidp($elidp);
			$insAntp->eliAnt();
		}
		

		header("Location:".base_url.'antproy/index');
	}
}