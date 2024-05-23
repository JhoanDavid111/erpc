<?php
include'models/mbas.php';

class eledatController{
	
	public function index(){
		$iddel = isset($_GET['iddel']) ? $_GET['iddel'] : false;
		Utils::useraccess('eledat/index&iddel='.$iddel,$_SESSION['pefid']);
	
		$eledat = new mbas();
		$eledats = $eledat->getDatAll($iddel);
		$eleti = $eledat->getDomO($iddel);

		$domfins = $eledat->getDomAll();
		$eledm = $eledat->getDm2();

		// var_dump($domfins);
		// die();

		require_once 'views/eledat.php';
		//require_once 'views/paa.php';
	}

	public function save(){
		$iddel = isset($_GET['iddel']) ? $_GET['iddel'] : false;
		echo 'eledat/index&iddel='.$iddel;
		Utils::useraccess('eledat/index&iddel='.$iddel,$_SESSION['pefid']);
		
		if(isset($_POST)){
			$idd = isset($_POST['idd']) ? $_POST['idd'] : false;
			$nomdat = isset($_POST['nomdat']) ? $_POST['nomdat'] : false;
			$iddel = isset($_POST['iddel']) ? $_POST['iddel'] : false;
			$iddat = isset($_POST['iddat']) ? $_POST['iddat'] : false;
			
			if($nomdat && $iddel){
				$eledat = new mbas();
				$eledat->setIdd($idd);
				$eledat->setNomdat($nomdat);
				$eledat->setIddel($iddel);
				$eledat->setIddat($iddat);

				$eledats = $eledat->getDatAll($iddel);
				$eleti = $eledat->getDomO($iddel);

				// $save = $eledat->save();
				// $edit = $eledat->edit();
				if(isset($_GET['idd'])){
					$idd = $_GET['idd'];
					$eledat->setIdd($idd);
					
					$save = $eledat->updDat();
				}else{
					$save = $eledat->insDat();
				}
				
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
		echo $_SESSION['register'];
		header("Location:".base_url.'eledat/index&iddel='.$iddel);
	}

	public function edit(){
		$iddel = isset($_GET['iddel']) ? $_GET['iddel'] : false;
		Utils::useraccess('eledat/index&iddel='.$iddel,$_SESSION['pefid']);
		if(isset($_GET['idd'])){
			$idd = $_GET['idd'];
// var_dump($idd);
// die();
			$edit = true;
		
			$eledat = new mbas();
			$eledat->setIdd($idd);
			$eledats = $eledat->getDatAll($iddel);
			$eleti = $eledat->getDomO($iddel);
			$domfins = $eledat->getDomAll();

			$val = $eledat->getDat($idd);
			// var_dump($edit);
			// var_dump($val);
			
			require_once 'views/eledat.php';
			
		}else{
			header('Location:'.base_url.'eledat/index&iddel='.$iddel);
		}
	}

		public function act(){
		//Utils::useraccess('eledat/index',$_SESSION['pefid']);
		if(isset($_GET['id']) AND isset($_GET['act'])){
			$id = $_GET['id'];
			$act = $_GET['act'];
		
			$eledat = new mbas();			
			$eledat ->actDM($id,$act);
		}
		header('Location:'.base_url.'eledat/index&iddel=3');
	}
}