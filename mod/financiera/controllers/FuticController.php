<?php
include'models/valfin.php';
include'models/domfin.php';

class futicController{
	
	public function index(){		
		Utils::useraccess('futic/index',$_SESSION['pefid']);
	
		$futic = new Valfin();
		$futics = $futic->getAll("FUTIC");
		$domfin = new Domfin();
		$domfins = $domfin->getAll();
		$Newid = $futic->getNewid();
		$Newid = $Newid[0]['Newid'];
		require_once 'views/futic.php';
	}

//vafid, vafnom, dofid, vaffijo

	public function updAct(){		
		Utils::useraccess('futic/index',$_SESSION['pefid']);
		$vafid = isset($_REQUEST['vafid']) ? $_REQUEST['vafid']:false;
		$vaffijo = isset($_REQUEST['vaffijo']) ? $_REQUEST['vaffijo']:false;
		$futic = new Valfin();
		$futic->setVafid($vafid);
		$futic->setVaffijo($vaffijo);
		$futics = $futic->updact();
		header("Location:".base_url.'futic/index');
	}

	public function save(){
		Utils::useraccess('futic/index',$_SESSION['pefid']);
		if(isset($_POST)){

			$vafid = isset($_POST['vafid']) ? $_POST['vafid'] : false;
			$vafnom = isset($_POST['vafnom']) ? $_POST['vafnom'] : false;
			$dofid = 8;
			$vaffijo = 1;
			$vafpre = $vafnom;
			$vafpf = isset($_POST['vafpf']) ? $_POST['vafpf'] : false;

			// $domfin = new Domfin();
			// $domfins = $domfin->getAll();

			// var_dump($domfins);
			// die();
			
			if($vafid && $vafnom && $dofid){
				$futic = new Valfin();
				$futic->setVafid($vafid);
				$futic->setVafnom($vafnom);
				$futic->setDofid($dofid);
				$futic->setVaffijo($vaffijo);
				$futic->setVafpre($vafpre);
				$futic->setVafpf($vafpf);

				$futics = $futic->getAll();

				// $save = $futic->save();
				// $edit = $futic->edit();
				if(isset($_GET['vafid'])){
					$vafid = $_GET['vafid'];
					$futic->setVafid($vafid);
					
					$save = $futic->edit();
				}else{
					$save = $futic->save();
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
		header("Location:".base_url.'futic/index');
	}

	public function edit(){
		Utils::useraccess('futic/index',$_SESSION['pefid']);
		if(isset($_GET['vafid'])){
			$vafid = $_GET['vafid'];
// var_dump($vafid);
// die();
			$edit = true;
		
			$futic = new Valfin();
			$futic->setvafid($vafid);
			$futics = $futic->getAll();
			$domfin = new Domfin();
			$domfins = $domfin->getAll();

			$val = $futic->getOne();
			// var_dump($edit);
			// var_dump($val);
			
			require_once 'views/futic.php';
			
		}else{
			header('Location:'.base_url.'futic/index');
		}
	}
}