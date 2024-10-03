<?php
include'models/rubro.php';

class rubroController{
	
	public function index(){		
		Utils::useraccess('rubro/index',$_SESSION['pefid']);
	
		$rubro = new Rubro();
		$rubros = $rubro->getAll();
		$num = $rubro->getNum();
		$ninipaa = $num[0]['ninipaa'];

		require_once 'views/rubro.php';
		//require_once 'views/paa.php';
	}

//codrub, nomrub, deprub, actrub
	public function save(){
		Utils::useraccess('rubro/index',$_SESSION['pefid']);
		if(isset($_POST)){

			// var_dump($_POST['codrub2']);
			// die();

			$codrub = isset($_POST['codrub']) ? $_POST['codrub'] : false;
			$codrub2 = isset($_POST['codrub2']) ? $_POST['codrub2'] : false;
			$nomrub = isset($_POST['nomrub']) ? $_POST['nomrub'] : false;
			$deprub = isset($_POST['deprub']) ? $_POST['deprub'] : false;
			$actrub = isset($_POST['actrub']) ? $_POST['actrub'] : false;
			$intrub = isset($_POST['intrub']) ? $_POST['intrub'] : false;
			
			if($codrub && $nomrub && $actrub && $intrub){
				$rubro = new Rubro();
				$rubro->setCodrub($codrub);
				$rubro->setCodrub2($codrub2);
				$rubro->setNomrub($nomrub);
				$rubro->setDeprub($deprub);
				$rubro->setActrub($actrub);
				$rubro->setIntrub($intrub);

				$rubros = $rubro->getAll();

				// $save = $rubro->save();
				// $edit = $rubro->edit();
				if(isset($_GET['codrub'])){
					$codrub = $_GET['codrub'];
					$rubro->setCodrub($codrub);
					
					$save = $rubro->edit();
				}else{
					$save = $rubro->save();
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
		header("Location:".base_url.'rubro/index');
	}

	public function edit(){
		Utils::useraccess('rubro/index',$_SESSION['pefid']);
		if(isset($_GET['codrub'])){
			$codrub = $_GET['codrub'];
// var_dump($codrub);
// die();
			$edit = true;
		
			$rubro = new Rubro();
			$rubro->setCodrub($codrub);
			$rubros = $rubro->getAll();
			$num = $rubro->getNum();
			$ninipaa = $num[0]['ninipaa'];
	
			$rub = $rubro->getOne();

			$dependencias = $this->familia($rub[0]['deprub']);
			// var_dump($edit);
			// var_dump($rub);
			
			require_once 'views/rubro.php';
			
		}else{
			header('Location:'.base_url.'rubro/index');
		}
	}

	function familia($deprup,$ord="ASC"){
		$txt = '';
		$rubro = new Rubro();
		$rubro->setCodrub($deprup);
		$dep = $rubro->getOne();
		$num = $rubro->getNum();
		$ninipaa = $num[0]['ninipaa'];

		if($deprup<>0){
			$txt .= $ninipaa.$dep[0]['codrub']." - ".$dep[0]['nomrub']."<br>";
			if($dep[0]['deprub']<>0){
				if($ord=="ASC")
					$txt = $this->familia($dep[0]['deprub']).$txt;	//Menor a Mayor
				else
					$txt .= $this->familia($dep[0]['deprub'],"DESC");	//Mayor a Menor
			}
		}else{
			$txt .= "Sin dependencias";
		}

		return $txt;
	}

}