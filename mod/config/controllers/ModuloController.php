<?php
include'models/modulo.php';
include'models/perfil.php';

class moduloController{
	
	public function index(){		
		Utils::useraccess('modulo/index',$_SESSION['pefid']);
	
		$modulo = new Modulo();
		$modulos = $modulo->getAll();
		$ppn = $modulo->getAllPer();
		$perfil = new Perfil();
		$perfils = $perfil->getAllpp();

		// var_dump($params);
		// die();

		require_once 'views/modulo.php';
	}

	public function save(){
		Utils::useraccess('modulo/index',$_SESSION['pefid']);
		if(isset($_POST)){

			$idmod = isset($_POST['idmod']) ? $_POST['idmod'] : false;
			$nommod = isset($_POST['nommod']) ? $_POST['nommod'] : false;
			$icomod = isset($_POST['icomod']) ? $_POST['icomod'] : false;
			$actmod = isset($_POST['actmod']) ? $_POST['actmod'] : false;
			$ordmod = isset($_POST['ordmod']) ? $_POST['ordmod'] : false;
			$pefpre = isset($_POST['pefpre']) ? $_POST['pefpre'] : false;



			// var_dump($params);
			// die();
			
			if($nommod && $actmod && $ordmod){
				$modulo = new Modulo();
				$modulo->setIdmod($idmod);
				$modulo->setNommod($nommod);
				$modulo->setIcomod($icomod);
				$modulo->setActmod($actmod);
				$modulo->setOrdmod($ordmod);
				$modulo->setPefpre($pefpre);

				$modulos = $modulo->getAll();
				$ppn = $modulo->getAllPer();
				$perfil = new Perfil();
				$perfils = $perfil->getAllpp();

				// $save = $modulo->save();
				// $edit = $modulo->edit();
				if(isset($_GET['idmod'])){
					$idmod = $_GET['idmod'];
					$modulo->setIdmod($idmod);
					$save = $modulo->edit();
				}else{
					$save = $modulo->save();
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
		header("Location:".base_url.'modulo/index');
	}

	public function edit(){
		Utils::useraccess('modulo/index',$_SESSION['pefid']);
		if(isset($_GET['idmod'])){
			$idmod = $_GET['idmod'];
// var_dump($idmod);
// die();
			$edit = true;
		
			$modulo = new Modulo();
			$modulo->setIdmod($idmod);
			$modulos = $modulo->getAll();
			$ppn = $modulo->getAllPer();
			$perfil = new Perfil();
			$perfils = $perfil->getAllpp();

			$val = $modulo->getOne();
			// var_dump($edit);
			// var_dump($val);
			
			require_once 'views/modulo.php';
			
		}else{
			header('Location:'.base_url.'modulo/index');
		}
	}

	public function savemxp(){
		Utils::useraccess('modulo/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$chk = isset($_POST['chk']) ? $_POST['chk'] : false;
			$id = isset($_POST['id']) ? $_POST['id'] : false;
			// var_dump($chk);
			// echo "<br>".$id;
			// die();

			if($id){		
				$modulo = new Modulo();
				$modulo->setIdmod($id);
				
				if($chk){
					foreach ($chk as $ch) {
						// if($ch){
							// echo "<br>".$modulo->getIdmod()."-".$ch."-".$id;
							//die();
							$save = $modulo->savemxp($ch);
						// }
					}
				}
			
				$modulos = $modulo->getAll();
				$perfil = new Perfil();
				$perfils = $perfil->getAllpp();
				
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
		header("Location:".base_url.'modulo/index');
	}

	public function act(){
		Utils::useraccess('modulo/index',$_SESSION['pefid']);
		if(isset($_GET['idmod']) AND isset($_GET['actmod'])){
			$idmod = $_GET['idmod'];
			$actmod = $_GET['actmod'];
			$act = true;
		
			$modulo = new Modulo();
			$modulo->setActmod($actmod);
			$modulo->setIdmod($idmod);
			$val = $modulo->actMod();
			$modulos = $modulo->getAll();

			
			// var_dump($edit);
			// var_dump($val);
			
			// require_once 'views/modulo.php';
			header("Location:".base_url.'modulo/index');
			
		}else{
			header('Location:'.base_url.'modulo/index');
		}
	}
}