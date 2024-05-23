<?php
include'models/mbas.php';

class elevalController{
	
	public function index(){		
		Utils::useraccess('eleval/index',$_SESSION['pefid']);
	
		$eleval = new mbas();
		$elevals = $eleval->getValAll();

		$domfins = $eleval->getDomAll();

		// var_dump($domfins);
		// die();

		require_once 'views/eleval.php';
		//require_once 'views/paa.php';
	}

//idvel, nomvel, iddel, fijvel
	public function save(){
		Utils::useraccess('eleval/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$idvel = isset($_POST['idvel']) ? $_POST['idvel'] : false;
			$nomvel = isset($_POST['nomvel']) ? $_POST['nomvel'] : false;
			$iddel = isset($_POST['iddel']) ? $_POST['iddel'] : false;
			$fijvel = isset($_POST['fijvel']) ? $_POST['fijvel'] : false;
			$prevel = isset($_POST['prevel']) ? $_POST['prevel'] : false;
			
			if($nomvel && $iddel){
				$eleval = new mbas();
				$eleval->setIdvel($idvel);
				$eleval->setNomvel($nomvel);
				$eleval->setIddel($iddel);
				$eleval->setFijvel($fijvel);
				$eleval->setPrevel($prevel);

				$elevals = $eleval->getValAll();

				// $save = $eleval->save();
				// $edit = $eleval->edit();
				if(isset($_GET['idvel'])){
					$idvel = $_GET['idvel'];
					$eleval->setIdvel($idvel);
					
					$save = $eleval->updVal();
				}else{
					$save = $eleval->insVal();
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
		header("Location:".base_url.'eleval/index');
	}

	public function edit(){
		Utils::useraccess('eleval/index',$_SESSION['pefid']);
		if(isset($_GET['idvel'])){
			$idvel = $_GET['idvel'];
// var_dump($idvel);
// die();
			$edit = true;
		
			$eleval = new mbas();
			$eleval->setIdvel($idvel);
			$elevals = $eleval->getValAll();
			$domfins = $eleval->getDomAll();

			$val = $eleval->getValOne($idvel);
			// var_dump($edit);
			// var_dump($val);
			
			require_once 'views/eleval.php';
			
		}else{
			header('Location:'.base_url.'eleval/index');
		}
	}
}