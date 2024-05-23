<?php
include'models/param.php';

class paramController{
	
	public function index(){		
		Utils::useraccess('param/index',$_SESSION['pefid']);
	
		$param = new Param();
		$params = $param->getAll();
		
		require_once 'views/param.php';
		//require_once 'views/paa.php';
	}

	public function save(){
		Utils::useraccess('param/index',$_SESSION['pefid']);
		if(isset($_POST)){

			$parid = isset($_POST['parid']) ? $_POST['parid'] : false;
			$parnom = isset($_POST['parnom']) ? $_POST['parnom'] : false;
			$parfijo = isset($_POST['parfijo']) ? $_POST['parfijo'] : false;
			
			if($parnom){
				$param = new Param();
				$param->setParnom($parnom);
				$param->setParfijo($parfijo);

				$params = $param->getAll();

				if(isset($_GET['parid'])){
					$parid = $_GET['parid'];
					$param->setParid($parid);
					
					$save = $param->edit();
				}else{
					$save = $param->save();
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
		header("Location:".base_url.'param/index');
	}

	public function edit(){
		Utils::useraccess('param/index',$_SESSION['pefid']);
		if(isset($_GET['parid'])){
			$parid = $_GET['parid'];
// var_dump($parid);
// die();
			$edit = true;
		
			$param = new Param();
			$param->setParid($parid);
			$params = $param->getAll();
	
			$dom = $param->getOne();

			// var_dump($edit);
			// var_dump($rub);
			
			require_once 'views/param.php';
			
		}else{
			header('Location:'.base_url.'param/index');
		}
	}
}