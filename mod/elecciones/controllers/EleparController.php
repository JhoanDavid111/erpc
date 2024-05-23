<?php
include'models/mbas.php';

class eleparController{
	
	public function index(){
		Utils::useraccess('elepar/index',$_SESSION['pefid']);
	
		$elepar = new Mbas();
		$elepars = $elepar->getParAll();
		
		require_once 'views/elepar.php';
		//require_once 'views/paa.php';
	}
//elecp, elenp
	public function save(){
		Utils::useraccess('elepar/index',$_SESSION['pefid']);
		if(isset($_POST)){

			$elecp = isset($_POST['elecp']) ? $_POST['elecp'] : false;
			$elenp = isset($_POST['elenp']) ? $_POST['elenp'] : false;
			
			if($elenp){
				$elepar = new Mbas();
				$elepar->setElecp($elecp);
				$elepar->setElenp($elenp);

				$elepars = $elepar->getParAll();

				if(isset($_GET['elecp'])){
					$elecp = $_GET['elecp'];
					$elepar->setElecp($elecp);
					
					$save = $elepar->updPar();
				}else{
					$save = $elepar->insPar();
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
		header("Location:".base_url.'elepar/index');
	}

	public function edit(){
		Utils::useraccess('elepar/index',$_SESSION['pefid']);
		if(isset($_GET['elecp'])){
			$elecp = $_GET['elecp'];
// var_dump($elecp);
// die();
			$edit = true;
		
			$elepar = new Mbas();
			$elepar->setElecp($elecp);
			$elepars = $elepar->getParAll();
	
			$dom = $elepar->getPar($elecp);

			// var_dump($edit);
			// var_dump($rub);
			
			require_once 'views/elepar.php';
			
		}else{
			header('Location:'.base_url.'elepar/index');
		}
	}
}