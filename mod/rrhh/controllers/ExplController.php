<?php
include'models/expl.php';

class ExplController{
	
	public function index(){
		Utils::useraccess('expl/index',$_SESSION['pefid']);
		$perid = isset($_REQUEST['perid']) ? $_REQUEST['perid'] : NULL;
		$txtn = isset($_GET['txtn']) ? $_GET['txtn']:NULL;

		//Objeto para llamar datos de dominio y valor en modulo configuracion

		date_default_timezone_set('America/Bogota');
	   	$hoy = date("Y-m-d");

		$el=new expl();	
		$natent=$el->natent();
		$dedex=$el->dedex();			
		$cauret=$el->cauret();
		
		$el->setPerid($perid);
		$datPer = $el->getOnePer();
		$expla=$el->getAllep($perid);
		$datOne=NULL;
		require_once 'views/expl.php';
	}

	public function save(){
		Utils::useraccess('expl/index',$_SESSION['pefid']);


		if(isset($_POST)){

			$idexplab = isset($_POST['idexplab']) ? $_POST['idexplab']:NULL;
			$perid = isset($_POST['perid']) ? $_POST['perid']:NULL;
			$natent = isset($_POST['natent']) ? $_POST['natent']:NULL;
			$emaent = isset($_POST['emaent']) ? $_POST['emaent']:NULL;
			$nument = isset($_POST['nument']) ? $_POST['nument']:NULL;
			$traact = isset($_POST['traact']) ? $_POST['traact']:NULL;
			$fecing = isset($_POST['fecing']) ? $_POST['fecing']:date("Y-m-d H:i:s");
			$fecret = isset($_POST['fecret']) ? $_POST['fecret']:date("Y-m-d H:i:s");
			$cauret = isset($_POST['cauret']) ? $_POST['cauret']:NULL;
			$dedex = isset($_POST['dedex']) ? $_POST['dedex']:NULL;
			$noment = isset($_POST['noment']) ? $_POST['noment']:NULL;
			$empcar = isset($_POST['empcar']) ? $_POST['empcar']:NULL;

				$expl = new expl();
				$expl->setIdexplab($idexplab);
				$expl->setPerid($perid);
				$expl->setNatent($natent);
				$expl->setEmaent($emaent);
				$expl->setNument($nument);
				$expl->setTraact($traact);
				$expl->setFecing($fecing);
				$expl->setFecret($fecret);
				$expl->setCauret($cauret);
				$expl->setDedex($dedex);
				$expl->setNoment($noment);
				$expl->setEmpcar($empcar);


				if($idexplab){
					$save = $expl->edit();
					$txtn = "actualizado";
				}else{
					$save = $expl->save();
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
			header("Location:".base_url.'expl/index&perid='.$perid.'&txtn='.$txtn);
		}


		public function edit(){
			//Utils::useraccess('dats/index',$_SESSION['perid']);
			if(isset($_GET['perid']) && isset($_GET['idexplab'])){
				$perid = $_GET['perid'];
				$idexplab= $_GET['idexplab'];
				$edit = true;
			
				$txtn = isset($_GET['txtn']) ? $_GET['txtn']:NULL;
	
				//Objeto para llamar datos de dominio y valor en modulo configuracion
	
				date_default_timezone_set('America/Bogota');
				   $hoy = date("Y-m-d");
	
				   $el=new expl();	
				   $natent=$el->natent();
				   $dedex=$el->dedex();			
				   $cauret=$el->cauret();
				   
				   $el->setPerid($perid);
				   $datPer = $el->getOnePer();
				   $expla=$el->getAllep($perid);
				   $el->setIdexplab($idexplab);
				   $datOne= $el->getOne();
				   require_once 'views/expl.php';
			}else{
				header('Location:'.base_url.'expl/index');
			}
		}
}	

