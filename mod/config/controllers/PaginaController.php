<?php
include'models/pagina.php';
include'models/modulo.php';

class paginaController{
	
	public function index(){		
		Utils::useraccess('pagina/index',$_SESSION['pefid']);
	
		$pagina = new Pagina();
		$paginas = $pagina->getAll();

		$modulo = new Modulo();
		$modulos = $modulo->getAll();

		// var_dump($modulos);
		// die();

		require_once 'views/pagina.php';
	}

	public function save(){
		Utils::useraccess('pagina/index',$_SESSION['pefid']);
		if(isset($_POST)){

			$pagid = isset($_POST['pagid']) ? $_POST['pagid'] : false;
			$pagnom = isset($_POST['pagnom']) ? $_POST['pagnom'] : false;
			$pagarc = isset($_POST['pagarc']) ? $_POST['pagarc'] : false;
			$pagmos = isset($_POST['pagmos']) ? $_POST['pagmos'] : false;
			$pagord = isset($_POST['pagord']) ? $_POST['pagord'] : false;
			$pagmen = isset($_POST['pagmen']) ? $_POST['pagmen'] : false;
			$icono = isset($_POST['icono']) ? $_POST['icono'] : false;
			$idmod = isset($_POST['idmod']) ? $_POST['idmod'] : false;

			// $modulo = new Modulo();
			// $modulos = $modulo->getAll();

			// var_dump($params);
			// die();
			
			if($pagid && $pagnom && $pagarc && $pagord && $idmod){
				$pagina = new pagina();
				$pagina->setPagid($pagid);
				$pagina->setPagnom($pagnom);
				$pagina->setPagarc($pagarc);
				$pagina->setPagmos($pagmos);
				$pagina->setPagord($pagord);
				$pagina->setPagmen($pagmen);
				$pagina->setIcono($icono);
				$pagina->setIdmod($idmod);

				$paginas = $pagina->getAll();

				// $save = $pagina->save();
				// $edit = $pagina->edit();
				if(isset($_GET['pagid'])){
					$pagid = $_GET['pagid'];
					$pagina->setPagid($pagid);
					
					$save = $pagina->edit();
				}else{
					$save = $pagina->save();
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
		header("Location:".base_url.'pagina/index');
	}

	public function edit(){
		Utils::useraccess('pagina/index',$_SESSION['pefid']);
		if(isset($_GET['pagid'])){
			$pagid = $_GET['pagid'];
// var_dump($pagid);
// die();
			$edit = true;
		
			$pagina = new pagina();
			$pagina->setPagid($pagid);
			$paginas = $pagina->getAll();
			$modulo = new Modulo();
			$modulos = $modulo->getAll();

			$val = $pagina->getOne();
			// var_dump($edit);
			// var_dump($val);
			
			require_once 'views/pagina.php';
			
		}else{
			header('Location:'.base_url.'pagina/index');
		}
	}

	public function act(){
		Utils::useraccess('pagina/index',$_SESSION['pefid']);
		if(isset($_GET['pagid']) AND isset($_GET['pagmos'])){
			$pagid = $_GET['pagid'];
			$pagmos = $_GET['pagmos'];
			$act = true;
		
			$pagina = new Pagina();
			$pagina->setPagmos($pagmos);
			$pagina->setPagid($pagid);
			$val = $pagina->actPag();
			$paginas = $pagina->getAll();

			
			// var_dump($edit);
			// var_dump($val);
			
			// require_once 'views/pagina.php';
			header("Location:".base_url.'pagina/index');
			
		}else{
			header('Location:'.base_url.'pagina/index');
		}
	}
}