<?php
include'models/pasante.php';

class pasanteController{
	
	public function index(){		
		Utils::useraccess('pasante/index',$_SESSION['pefid']);
	
		$pasante = new Pasante();
		$pasantes = $pasante->getAll();

		// var_dump($ubicas);
		// die();
		date_default_timezone_set('America/Bogota');
		$fecin = date("Y-m-d");

		if($_SESSION['pefid']==7 OR $_SESSION['pefid']==57)
			require_once 'views/pasante.php';
		else
			require_once 'views/pasantes.php';
	}

	public function save(){
		Utils::useraccess('pasante/index',$_SESSION['pefid']);
		if(isset($_POST)){

			$idpas = isset($_POST['idpas']) ? $_POST['idpas'] : false;
			$docpas = isset($_POST['docpas']) ? $_POST['docpas'] : false;
			$nompas = isset($_POST['nompas']) ? $_POST['nompas'] : false;
			$propas = isset($_POST['propas']) ? $_POST['propas'] : false;
			$unipas = isset($_POST['unipas']) ? $_POST['unipas'] : false;
			$fingpas = isset($_POST['fingpas']) ? $_POST['fingpas'] : false;
			$ffinpas = isset($_POST['ffinpas']) ? $_POST['ffinpas'] : false;
			$durpas = isset($_POST['durpas']) ? $_POST['durpas'] : false;
			$acvpas = isset($_POST['acvpas']) ? $_POST['acvpas'] : false;
			$conpas = isset($_POST['conpas']) ? $_POST['conpas'] : false;
			$actpas = isset($_POST['actpas']) ? $_POST['actpas'] : false;
	
			if($nompas && $propas && $unipas && $ffinpas && $actpas){
				$pasante = new Pasante();
				$pasante->setIdpas($idpas);
				$pasante->setDocpas($docpas);
				$pasante->setNompas($nompas);
				$pasante->setPropas($propas);
				$pasante->setUnipas($unipas);
				$pasante->setFingpas($fingpas);
				$pasante->setFfinpas($ffinpas);
				$pasante->setDurpas($durpas);
				$pasante->setAcvpas($acvpas);
				$pasante->setConpas($conpas);
				$pasante->setActpas($actpas);

				$pasantes = $pasante->getAll();

				// $save = $pasante->save();
				// $edit = $pasante->edit();
				if(isset($_GET['idpas'])){
					$idpas = $_GET['idpas'];
					$pasante->setidpas($idpas);
					
					$save = $pasante->edit();
				}else{
					$save = $pasante->save();
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
		header("Location:".base_url.'pasante/index');
	}

	public function edit(){
		Utils::useraccess('pasante/index',$_SESSION['pefid']);
		if(isset($_GET['idpas'])){
			$idpas = $_GET['idpas'];
// var_dump($idpas);
// die();
			$edit = true;
		
			$pasante = new Pasante();
			$pasante->setIdpas($idpas);
			$pasantes = $pasante->getAll();

			$val = $pasante->getOne();
			// var_dump($edit);
			// var_dump($val);
			
			require_once 'views/pasante.php';
			
		}else{
			header('Location:'.base_url.'pasante/index');
		}
	}

	public function act(){
		Utils::useraccess('pasante/index',$_SESSION['pefid']);
		if(isset($_GET['idpas']) AND isset($_GET['actpas'])){
			$idpas = $_GET['idpas'];
			$actpas = $_GET['actpas'];
			$act = true;
		
			$pasante = new Pasante();
			$pasante->setActpas($actpas);
			$pasante->setIdpas($idpas);
			$val = $pasante->actPas();
			$paginas = $pasante->getAll();

			// var_dump($edit);
			// var_dump($val);
			
			// require_once 'views/pasante.php';
			header("Location:".base_url.'pasante/index');
			
		}else{
			header('Location:'.base_url.'pasante/index');
		}
	}
}