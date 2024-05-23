<?php
include'models/mbas.php';

class eledomController{
	
	public function index(){
		Utils::useraccess('eledom/index',$_SESSION['pefid']);
	
		$eledom = new Mbas();
		$eledoms = $eledom->getDomAll();
		
		require_once 'views/eledom.php';
		//require_once 'views/paa.php';
	}

	public function save(){
		Utils::useraccess('eledom/index',$_SESSION['pefid']);
		if(isset($_POST)){

			$iddel = isset($_POST['iddel']) ? $_POST['iddel'] : false;
			$nomdel = isset($_POST['nomdel']) ? $_POST['nomdel'] : false;
			
			if($nomdel){
				$eledom = new Mbas();
				$eledom->setnomdel($nomdel);

				$eledoms = $eledom->getDomAll();

				if(isset($_GET['iddel'])){
					$iddel = $_GET['iddel'];
					$eledom->setIddel($iddel);
					
					$save = $eledom->updDom();
				}else{
					$save = $eledom->insDom();
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
		header("Location:".base_url.'eledom/index');
	}

	public function edit(){
		Utils::useraccess('eledom/index',$_SESSION['pefid']);
		if(isset($_GET['iddel'])){
			$iddel = $_GET['iddel'];
// var_dump($iddel);
// die();
			$edit = true;
		
			$eledom = new Mbas();
			$eledom->setIddel($iddel);
			$eledoms = $eledom->getDomAll();
	
			$dom = $eledom->getDomO($iddel);

			// var_dump($edit);
			// var_dump($rub);
			
			require_once 'views/eledom.php';
			
		}else{
			header('Location:'.base_url.'eledom/index');
		}
	}
}