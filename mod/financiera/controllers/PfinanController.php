<?php
include'models/pfinan.php';
include'models/rubro.php';

class pfinanController{
	
	public function index(){		
		Utils::useraccess('pfinan/index',$_SESSION['pefid']);
	
		$pfinan = new Pfinan();
		// $pfinand = $pfinan->getAll();

		$pfvig = $pfinan->getVig();

		$rubro = new Rubro();
		$rubros = $rubro->getAll();
		$num = $rubro->getNum();
		$ninipaa = $num[0]['ninipaa'];

		require_once 'views/pfinan.php';
		//require_once 'views/paa.php';
	}


	public function planes(){
		Utils::useraccess('pfinan/index',$_SESSION['pefid']);
		// var_dump($_POST);
		// die();

		if(isset($_POST)){
			$vigencia = $_POST['vigencia'];			
			$pfinan = new Pfinan();
			$pfinan->setIdpaa($vigencia);
			$pfinand = $pfinan->getAll();
			//$_SESSION['pfinand']=$pfinan->getAll();
			$pfvig = $pfinan->getVig();
			$rubro = new Rubro();
			$num = $rubro->getNum();
			$ninipaa = $num[0]['ninipaa'];
			require_once 'views/pfinan.php';

		}
	}

	public function getPf(){
		Utils::useraccess('pfinan/index',$_SESSION['pefid']);
		// var_dump($_GET);
		// die();

		if(isset($_GET)){
			$editp = $_GET['codrub'];
			$editpf = new Pfinan();
			$editpf->setCodrub($editp);
			//$pfinand = $editpf->getAll();			
			$pfvig = $editpf->getVig();
			$epf = $editpf->selPf();
			$rubrosPf=$editpf->getRub($editp);
			$pfinand=$epf;

			// var_dump($epf);
			// die();

			//DEPENDENCIAS RUBRO

			$edit = true;
		
			$rubro = new Rubro();
			$rubro->setCodrub($editp);
			$rubros = $rubro->getAll();
			$num = $rubro->getNum();
			$ninipaa = $num[0]['ninipaa'];
	
			$rub = $rubro->getOne();

			$dependencias = $this->familia($rub[0]['deprub']);

			require_once 'views/pfinan.php';

		}


	}

	public function editPf(){
		Utils::useraccess('pfinan/index',$_SESSION['pefid']);

		if(isset($_POST)){
			$asig = isset($_POST['asig']) ? $_POST['asig'] : false;
			$nmeses = isset($_POST['nmeses']) ? $_POST['nmeses'] : false;
			$valormensual = isset($_POST['valormensual']) ? $_POST['valormensual'] : false;

			if($asig && $nmeses){
				$editpf = new Pfinan();
				$editpf->setNmesdpa($nmeses);
				//$valormensual->setAsidpa($valormensual);
				$editpf->setAsidpa($asig);

				//$save = $$editpf->edit();
			}


		}
		header("Location:".base_url.'pfinan/index');
		
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