<?php
include'models/perfil.php';
include'models/modulo.php';
include'models/pagina.php';
include'models/valor.php';

class perfilController{
	
	public function index(){		
		Utils::useraccess('perfil/index',$_SESSION['pefid']);
	
		$perfil = new Perfil();
		$perfils = $perfil->getAll();

		$modulo = new Modulo();
		$modulos = $modulo->getAll();

		$pagina = new Pagina();
		$valor = new Valor();

		 // var_dump($perfils);
		 // die();

		require_once 'views/perfil.php';
	}

	public function save(){
		Utils::useraccess('perfil/index',$_SESSION['pefid']);
		if(isset($_POST)){

			$pefid = isset($_POST['pefid']) ? $_POST['pefid'] : false;
			$pefnom = isset($_POST['pefnom']) ? $_POST['pefnom'] : false;
			$pefedi = isset($_POST['pefedi']) ? $_POST['pefedi'] : 0;
			$pagprin = isset($_POST['pagprin']) ? $_POST['pagprin'] : false;
			$idmod = isset($_POST['idmod']) ? $_POST['idmod'] : false;

			// $modulo = new modulo();
			// $modulos = $modulo->getAll();

			// var_dump($modulos);
			// die();
			
			// if($pefid && $pefnom && $pefedi){
			if($pefnom){
				$perfil = new perfil();
				$perfil->setPefid($pefid);
				$perfil->setPefnom($pefnom);
				$perfil->setPefedi($pefedi);
				$perfil->setPagprin($pagprin);
				$perfil->setIdmod($idmod);

				$perfils = $perfil->getAll();

				// $save = $perfil->save();
				// $edit = $perfil->edit();
				if(isset($_GET['pefid'])){
					$pefid = $_GET['pefid'];
					$perfil->setPefid($pefid);
					
					$save = $perfil->edit();
				}else{
					$save = $perfil->save();
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
		header("Location:".base_url.'perfil/index');
	}

	public function edit(){
		Utils::useraccess('perfil/index',$_SESSION['pefid']);
		if(isset($_GET['pefid'])){
			$pefid = $_GET['pefid'];
// var_dump($pefid);
// die();
			$edit = true;
		
			$perfil = new perfil();
			$perfil->setPefid($pefid);
			$perfils = $perfil->getAll();
			$modulo = new modulo();
			$modulos = $modulo->getAll();
			$pagina = new Pagina();
			$valor = new Valor();

			$val = $perfil->getOne();
			// var_dump($edit);
			// var_dump($val);
			
			require_once 'views/perfil.php';
			
		}else{
			header('Location:'.base_url.'perfil/index');
		}
	}

	public function savepg(){
		Utils::useraccess('perfil/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$chk = isset($_POST['chk']) ? $_POST['chk'] : false;
			$id = isset($_POST['id']) ? $_POST['id'] : false;
			//var_dump($chk);

			if($id){
				$perfil = new perfil();
				$perfil->setPefid($id);
				$delpxp = $perfil->delpxp();
				if($chk){
					foreach ($chk as $ch) {
						if($ch){
							// echo "<br>".$ch."-".$id;
							$save = $perfil->savepxp($ch);
						}
					}
				}
			
				$perfils = $perfil->getAll();
				
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
		header("Location:".base_url.'perfil/index');
	}

	public function savepev(){
		Utils::useraccess('perfil/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$chk = isset($_POST['chk']) ? $_POST['chk'] : false;
			$id = isset($_POST['id']) ? $_POST['id'] : false;
			//var_dump($chk);

			if($id){
				$perfil = new perfil();
				$perfil->setPefid($id);
				$delpxp = $perfil->delpev();
				if($chk){
					foreach ($chk as $ch) {
						if($ch){
							// echo "<br>".$ch."-".$id;
							$save = $perfil->savepev($ch);
						}
					}
				}
				$perfils = $perfil->getAll();
				
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
		header("Location:".base_url.'perfil/index');
	}

	public function savepee(){
		Utils::useraccess('perfil/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$chk = isset($_POST['chk']) ? $_POST['chk'] : false;
			$ema = isset($_POST['ema']) ? $_POST['ema'] : false;
			$id = isset($_POST['id']) ? $_POST['id'] : false;
			// var_dump($chk);
			// echo "<br><br>";
			// var_dump($ema);

			if($id){
				$perfil = new perfil();
				$perfil->setPefid($id);
				$delpxp = $perfil->delpee();
				if($chk){
					foreach ($chk as $ch) {
						if($ch){
							//echo "<br>".$ch."-".$id;
							$envema = 0;
							if(in_array($ch, $ema)) $envema = 1;
							$save = $perfil->savepee($ch,$envema);
						}
					}
				}
				$perfils = $perfil->getAll();
				
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
		header("Location:".base_url.'perfil/index');
	}
}