<?php
include'models/ubica.php';

class ubicaController{
	
	public function index(){		
		Utils::useraccess('ubica/index',$_SESSION['pefid']);
	
		$ubica = new ubica();
		$ubicas = $ubica->getAll();

		$deptos = $ubica->getDepto();

		// var_dump($params);
		// die();

		require_once 'views/ubica.php';
	}

	public function save(){
		Utils::useraccess('ubica/index',$_SESSION['pefid']);
		if(isset($_POST)){

			$ubiid = isset($_POST['ubiid']) ? $_POST['ubiid'] : false;
			$ubinom = isset($_POST['ubinom']) ? $_POST['ubinom'] : false;
			$ubidepto = isset($_POST['ubidepto']) ? $_POST['ubidepto'] : false;
			$ubiestado = isset($_POST['ubiestado']) ? $_POST['ubiestado'] : false;

			// $param = new param();
			// $params = $param->getAll();

			// var_dump($params);
			// die();
			
			if($ubiid && $ubinom){
				$ubica = new ubica();
				$ubica->setUbiid($ubiid);
				$ubica->setUbinom($ubinom);
				$ubica->setUbidepto($ubidepto);
				$ubica->setUbiestado($ubiestado);

				$ubicas = $ubica->getAll();

				// $save = $ubica->save();
				// $edit = $ubica->edit();
				if(isset($_GET['ubiid'])){
					$ubiid = $_GET['ubiid'];
					$ubica->setUbiid($ubiid);
					
					$save = $ubica->edit();
				}else{
					$save = $ubica->save();
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
		header("Location:".base_url.'ubica/index');
	}

	public function edit(){
		Utils::useraccess('ubica/index',$_SESSION['pefid']);
		if(isset($_GET['ubiid'])){
			$ubiid = $_GET['ubiid'];
// var_dump($ubiid);
// die();
			$edit = true;
		
			$ubica = new ubica();
			$ubica->setUbiid($ubiid);
			$ubicas = $ubica->getAll();
			$deptos = $ubica->getDepto();

			$val = $ubica->getOne();
			// var_dump($edit);
			// var_dump($val);
			
			require_once 'views/ubica.php';
			
		}else{
			header('Location:'.base_url.'ubica/index');
		}
	}
}