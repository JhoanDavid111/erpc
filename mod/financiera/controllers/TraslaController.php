<?php
include'models/rubro.php';
include'models/trasla.php';

class traslaController{
	
	public function index(){		
		Utils::useraccess('trasla/index',$_SESSION['pefid']);
	
		$rubro = new Rubro();
		$rubros = $rubro->getAll();
		$num = $rubro->getNum();
		$ninipaa = $num[0]['ninipaa'];

		$trasla = new Trasla();

		require_once 'views/trasla.php';
		//require_once 'views/paa.php';
	}

//codrub, nomrub, deprub, actrub
	public function save(){
		Utils::useraccess('trasla/index',$_SESSION['pefid']);
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
				$trasla = new Trasla();
				$trasla->setCodrub($codrub);
				$trasla->setCodrub2($codrub2);
				$trasla->setNomrub($nomrub);
				$trasla->setDeprub($deprub);
				$trasla->setActrub($actrub);
				$trasla->setIntrub($intrub);

				$traslas = $trasla->getAll();

				// $save = $trasla->save();
				// $edit = $trasla->edit();
				if(isset($_GET['codrub'])){
					$codrub = $_GET['codrub'];
					$trasla->setCodrub($codrub);
					
					$save = $trasla->edit();
				}else{
					$save = $trasla->save();
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
		header("Location:".base_url.'trasla/index');
	}

	public function edit(){
		Utils::useraccess('trasla/index',$_SESSION['pefid']);
		if(isset($_GET['codrub'])){
			$codrub = $_GET['codrub'];
// var_dump($codrub);
// die();
			$edit = true;
		
			$trasla = new Trasla();
			$trasla->setCodrub($codrub);
			$traslas = $trasla->getAll();
			$num = $trasla->getNum();
			$ninipaa = $num[0]['ninipaa'];
	
			$rub = $trasla->getOne();

			$dependencias = $this->familia($rub[0]['deprub']);
			// var_dump($edit);
			// var_dump($rub);
			
			require_once 'views/trasla.php';
			
		}else{
			header('Location:'.base_url.'trasla/index');
		}
	}

	function familia($deprup,$ord="ASC"){
		$txt = '';
		$trasla = new Trasla();
		$trasla->setCodrub($deprup);
		$dep = $trasla->getOne();
		$num = $trasla->getNum();
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