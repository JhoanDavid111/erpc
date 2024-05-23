<?php
include'models/ciiu.php';

class CiiuController{
	
	public function index(){		
		Utils::useraccess('ciiu/index',$_SESSION['pefid']);
	
		$ciiu = new Ciiu();
		$ciius = $ciiu->getAll();
		$num = $ciiu->getNum();

		require_once 'views/ciiu.php';
		//require_once 'views/paa.php';
	}

//idciiu, codciiu, nomciiu, depciiu
	public function save(){
		Utils::useraccess('ciiu/index',$_SESSION['pefid']);
		if(isset($_POST)){

			// var_dump($_POST['codciiu']);
			// die();

			$idciiu = isset($_POST['idciiu']) ? $_POST['idciiu'] : false;
			$codciiu = isset($_POST['codciiu']) ? $_POST['codciiu'] : false;
			$nomciiu = isset($_POST['nomciiu']) ? $_POST['nomciiu'] : false;
			$depciiu = isset($_POST['depciiu']) ? $_POST['depciiu'] : false;
			
			//echo $idciiu." ".$codciiu." ".$nomciiu." ".$depciiu;
			//die();

			if($codciiu && $nomciiu && $depciiu){
				$ciiu = new Ciiu();
				$ciiu->setCodciiu($codciiu);
				$ciiu->setNomciiu($nomciiu);
				$ciiu->setDepciiu($depciiu);
				
				$ciius = $ciiu->getAll();

				// $save = $ciiu->save();
				// $edit = $ciiu->edit();
				if(isset($_GET['idciiu'])){
					$idciiu = $_GET['idciiu'];
					$ciiu->setIdciiu($idciiu);
					
					$save = $ciiu->edit();
				}else{
					$save = $ciiu->save();
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
		header("Location:".base_url.'ciiu/index');
	}

	public function edit(){
		Utils::useraccess('ciiu/index',$_SESSION['pefid']);
		if(isset($_GET['idciiu'])){
			$idciiu = $_GET['idciiu'];
			$edit = true;
		
			$ciiu = new Ciiu();
			$ciiu->setIdciiu($idciiu);
			$ciius = $ciiu->getAll();
	
			$cii = $ciiu->getOne();
			// var_dump($edit);
			// var_dump($cii);
			
			require_once 'views/ciiu.php';
			
		}else{
			header('Location:'.base_url.'ciiu/index');
		}
	}

	function familia($depciiu,$ord="ASC"){
		$txt = '';
		$ciiu = new Ciuu();
		$ciiuu->setIdciiu($depciiu);
		$dep = $ciiu->getOne();
		$num = $ciiu->getNum();
		$cicipro = $num[0]['cicipro'];

		if($depciiu<>0){
			$txt .= $cicipro.$dep[0]['idciiu']." - ".$dep[0]['nomciiu']."<br>";
			if($dep[0]['depciiu']<>0){
				if($ord=="ASC")
					$txt = $this->familia($dep[0]['depciiu']).$txt;	//Menor a Mayor
				else
					$txt .= $this->familia($dep[0]['depciiu'],"DESC");	//Mayor a Menor
			}
		}else{
			$txt .= "Sin dependencias";
		}

		return $txt;
	}

}