<?php
include'models/valfin.php';
include'models/domfin.php';

class valfinController{
	
	public function index(){		
		Utils::useraccess('valfin/index',$_SESSION['pefid']);
	
		$valfin = new valfin();
		$valfins = $valfin->getAll();

		$domfin = new Domfin();
		$domfins = $domfin->getAll();

		// var_dump($domfins);
		// die();

		require_once 'views/valfin.php';
		//require_once 'views/paa.php';
	}

//vafid, vafnom, dofid, vaffijo
	public function save(){
		Utils::useraccess('valfin/index',$_SESSION['pefid']);
		if(isset($_POST)){

			$vafid = isset($_POST['vafid']) ? $_POST['vafid'] : false;
			$vafnom = isset($_POST['vafnom']) ? $_POST['vafnom'] : false;
			$dofid = isset($_POST['dofid']) ? $_POST['dofid'] : false;
			$vaffijo = isset($_POST['vaffijo']) ? $_POST['vaffijo'] : false;
			$vafpre = isset($_POST['vafpre']) ? $_POST['vafpre'] : false;
			$vafpf = isset($_POST['vafpf']) ? $_POST['vafpf'] : false;

			// $domfin = new Domfin();
			// $domfins = $domfin->getAll();

			// var_dump($domfins);
			// die();
			
			if($vafid && $vafnom && $dofid){
				$valfin = new valfin();
				$valfin->setVafid($vafid);
				$valfin->setVafnom($vafnom);
				$valfin->setDofid($dofid);
				$valfin->setVaffijo($vaffijo);
				$valfin->setVafpre($vafpre);
				$valfin->setVafpf($vafpf);

				$valfins = $valfin->getAll();

				// $save = $valfin->save();
				// $edit = $valfin->edit();
				if(isset($_GET['vafid'])){
					$vafid = $_GET['vafid'];
					$valfin->setVafid($vafid);
					
					$save = $valfin->edit();
				}else{
					$save = $valfin->save();
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
		header("Location:".base_url.'valfin/index');
	}

	public function edit(){
		Utils::useraccess('valfin/index',$_SESSION['pefid']);
		if(isset($_GET['vafid'])){
			$vafid = $_GET['vafid'];
// var_dump($vafid);
// die();
			$edit = true;
		
			$valfin = new valfin();
			$valfin->setvafid($vafid);
			$valfins = $valfin->getAll();
			$domfin = new Domfin();
			$domfins = $domfin->getAll();

			$val = $valfin->getOne();
			// var_dump($edit);
			// var_dump($val);
			
			require_once 'views/valfin.php';
			
		}else{
			header('Location:'.base_url.'valfin/index');
		}
	}
}