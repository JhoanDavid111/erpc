<?php
include'models/domfin.php';

class domfinController{
	
	public function index(){
		Utils::useraccess('domfin/index',$_SESSION['pefid']);
	
		$domfin = new Domfin();
		$domfins = $domfin->getAll();
		
		require_once 'views/domfin.php';
		//require_once 'views/paa.php';
	}

	public function save(){
		Utils::useraccess('domfin/index',$_SESSION['pefid']);
		if(isset($_POST)){

			$dofid = isset($_POST['dofid']) ? $_POST['dofid'] : false;
			$dofnom = isset($_POST['dofnom']) ? $_POST['dofnom'] : false;
			$doffijo = isset($_POST['doffijo']) ? $_POST['doffijo'] : false;
			
			if($dofnom){
				$domfin = new Domfin();
				$domfin->setDofnom($dofnom);
				$domfin->setDoffijo($doffijo);

				$domfins = $domfin->getAll();

				if(isset($_GET['dofid'])){
					$dofid = $_GET['dofid'];
					$domfin->setDofid($dofid);
					
					$save = $domfin->edit();
				}else{
					$save = $domfin->save();
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
		header("Location:".base_url.'domfin/index');
	}

	public function edit(){
		Utils::useraccess('domfin/index',$_SESSION['pefid']);
		if(isset($_GET['dofid'])){
			$dofid = $_GET['dofid'];
// var_dump($dofid);
// die();
			$edit = true;
		
			$domfin = new Domfin();
			$domfin->setDofid($dofid);
			$domfins = $domfin->getAll();
	
			$dom = $domfin->getOne();

			// var_dump($edit);
			// var_dump($rub);
			
			require_once 'views/domfin.php';
			
		}else{
			header('Location:'.base_url.'domfin/index');
		}
	}
}