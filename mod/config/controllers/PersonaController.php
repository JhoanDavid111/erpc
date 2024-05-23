<?php
include'models/persona.php';
include'models/ubica.php';
include'models/modulo.php';
include'models/perfil.php';
include'models/valor.php';
//include'models/peredit.php';

class personaController{
	
	public function index(){		
		Utils::useraccess('persona/index',$_SESSION['pefid']);
		$perid = NULL;
		$persona = new Persona();
		$personas = $persona->getAll();
		$areas = $persona->getAllArea(1);
		$tpusu = $persona->getAllArea(30);
		$carg = $persona->getAllArea(6);

		$ubica = new Ubica();
		$ubicas = $ubica->getAll();

		$modulo = new Modulo();
		$modulos = $modulo->getAllMod();

		$perfil = new Perfil();
		$perfils = $perfil->getAllpp();
		$perfils2 = $perfil->getAll();

		$valor = new Valor();
		$valores = $valor->getOnePar(10);

		// var_dump($valores);
		// die();

		require_once 'views/persona.php';
	}

//perid, nodocemp, pernom, perape
	public function save(){
		
		Utils::useraccess('persona/index',$_SESSION['pefid']);
		
		if(isset($_POST)){			

			$perid = isset($_POST['perid']) ? $_POST['perid'] : false;
			$nodocemp = isset($_POST['nodocemp']) ? $_POST['nodocemp'] : false;
			$pernom = isset($_POST['pernom']) ? $_POST['pernom'] : false;
			$perape = isset($_POST['perape']) ? $_POST['perape'] : false;
			$peremail = isset($_POST['peremail']) ? $_POST['peremail'] : false;
			$perpass = isset($_POST['perpass']) ? $_POST['perpass'] : false;
			$ubiid = isset($_POST['ubiid']) ? $_POST['ubiid'] : false;
			$perdir = isset($_POST['perdir']) ? $_POST['perdir'] : false;
			$pertel = isset($_POST['pertel']) ? $_POST['pertel'] : false;
			$percel = isset($_POST['percel']) ? $_POST['percel'] : false;
			$pefid = isset($_POST['pefid']) ? $_POST['pefid'] : false;
			$depid = isset($_POST['depid']) ? $_POST['depid'] : false;
			$envema = isset($_POST['envema']) ? $_POST['envema'] : false;
			$actemp = isset($_POST['actemp']) ? $_POST['actemp'] : 1;
			$ordgas = isset($_POST['ordgas']) ? $_POST['ordgas'] : 0;
			$planta = isset($_POST['planta']) ? $_POST['planta'] : 0;
			$cargo = isset($_POST['cargo']) ? $_POST['cargo'] : 300;

			// $ubica = new ubica();
			// $ubicas = $ubica->getAll();

			// var_dump($ubicas);
			// die();
			
			if($pernom && $perape && $peremail && $ubiid && $pefid && $depid &&	$actemp){

				$persona = new persona();
				$persona->setPerid($perid);
				$persona->setNodocemp($nodocemp);
				$persona->setPernom($pernom);
				$persona->setPerape($perape);
				$persona->setPeremail($peremail);
				$persona->setPerpass($perpass);
				$persona->setUbiid($ubiid);
				$persona->setPerdir($perdir);
				$persona->setPertel($pertel);
				$persona->setPercel($percel);
				$persona->setPefid($pefid);
				$persona->setDepid($depid);
				$persona->setEnvema($envema);
				$persona->setActemp($actemp);
				$persona->setOrdgas($ordgas);
				$persona->setPlanta($planta);
				$persona->setCargo($cargo);

				$personas = $persona->getAll();
				$areas = $persona->getAllArea(1);
				$tpusu = $persona->getAllArea(30);
				$carg = $persona->getAllArea(6);
				$ubica = new Ubica();
				$ubicas = $ubica->getAll();

				$modulo = new Modulo();
				$modulos = $modulo->getAllMod();

				$perfil = new Perfil();
				$perfils = $perfil->getAllpp();
				$perfils2 = $perfil->getAll();

				$valor = new Valor();
				$valores = $valor->getOnePar(10);

				// $save = $persona->save();
				// $edit = $persona->edit();
				if(isset($_GET['perid'])){
					$perid = $_GET['perid'];
					$persona->setPerid($perid);
					
					$save = $persona->edit();
				}else{
					$save = $persona->save();
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
		header("Location:".base_url.'persona/index');
	}



	public function edit(){
		Utils::useraccess('persona/index',$_SESSION['pefid']);
		if(isset($_GET['perid'])){
			$perid = $_GET['perid'];
// var_dump($perid);
// die();
			$edit = true;
		
			$persona = new Persona();
			$persona->setPerid($perid);
			$personas = $persona->getAll();
			$areas = $persona->getAllArea(1);
			$tpusu = $persona->getAllArea(30);
			$carg = $persona->getAllArea(6);
			$ubica = new Ubica();
			$ubicas = $ubica->getAll();

			$modulo = new Modulo();
			$modulos = $modulo->getAllMod();

			$perfil = new Perfil();
			$perfils = $perfil->getAllpp();
			$perfils2 = $perfil->getAll();

			$valor = new Valor();
			$valores = $valor->getOnePar(10);

			$val = $persona->getOne();
			// var_dump($edit);
			// var_dump($val);
			
			require_once 'views/persona.php';
			
		}else{
			header('Location:'.base_url.'persona/index');
		}
	}

	public function savepp(){
		Utils::useraccess('persona/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$chk = isset($_POST['chk']) ? $_POST['chk'] : false;
			$id = isset($_POST['id']) ? $_POST['id'] : false;
			//var_dump($chk);

			if($id){
				$persona = new Persona();
				$persona->setPerid($id);
				$delpxp = $persona->delpxp();
				if($chk){
					foreach ($chk as $ch) {
						if($ch){
							//echo "<br>".$id."-".$ch;
							
							$save = $persona->savepxp($ch);
						}
					}
				}
			
				$personas = $persona->getAll();
				$ubica = new ubica();
				$ubicas = $ubica->getAll();
				$modulo = new Modulo();
				$modulos = $modulo->getAllMod();
				$perfil = new Perfil();
				$perfils = $perfil->getAllpp();
				$perfils2 = $perfil->getAll();

				$valor = new Valor();
				$valores = $valor->getOnePar(10);
				
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
		header("Location:".base_url.'persona/index');
	}

	public function act(){
		Utils::useraccess('persona/index',$_SESSION['pefid']);
		if(isset($_GET['perid']) AND isset($_GET['actemp'])){
			$perid = $_GET['perid'];
			$actemp = $_GET['actemp'];
			$act = true;
		
			$persona = new Persona();
			$persona->setActemp($actemp);
			$persona->setPerid($perid);
			$val = $persona->actPer();
			$paginas = $persona->getAll();
			$modulo = new Modulo();
			$modulos = $modulo->getAllMod();
			$perfil = new Perfil();
			$perfils = $perfil->getAllpp();
			$perfils2 = $perfil->getAll();

			$valor = new Valor();
			$valores = $valor->getOnePar(10);

			
			// var_dump($edit);
			// var_dump($val);
			
			// require_once 'views/persona.php';
			header("Location:".base_url.'persona/index');
			
		}else{
			header('Location:'.base_url.'persona/index');
		}
	}

	public function savect(){
		Utils::useraccess('persona/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$chk = isset($_POST['chk']) ? $_POST['chk'] : false;
			$id = isset($_POST['id']) ? $_POST['id'] : false;
			//var_dump($chk);

			if($id){
				$persona = new Persona();
				$persona->setPerid($id);
				$delct = $persona->delct();
				if($chk){
					foreach ($chk as $ch) {
						if($ch){
							//echo "<br>".$id."-".$ch;
							
							$save = $persona->savect($ch);
						}
					}
				}
			
				$personas = $persona->getAll();
				$ubica = new ubica();
				$ubicas = $ubica->getAll();
				$modulo = new Modulo();
				$modulos = $modulo->getAllMod();
				$perfil = new Perfil();
				$perfils = $perfil->getAllpp();
				$perfils2 = $perfil->getAll();

				$valor = new Valor();
				$valores = $valor->getOnePar(10);
				
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
		header("Location:".base_url.'persona/index');
	}

	public function editPerf(){
		// var_dump('editar perfil - personaController');
		// var_dump($_SESSION['identity']->perid);
		// die();

		$perid= $_SESSION['identity']->perid;

		$edit = true;
		
		$persona = new Persona();
		$persona->setPerid($perid);
		$personas = $persona->getAll();
		$areas = $persona->getAllArea(1);
		$tpusu = $persona->getAllArea(30);
		$carg = $persona->getAllArea(6);
		$ubica = new Ubica();
		$ubicas = $ubica->getAll();

		$modulo = new Modulo();
		$modulos = $modulo->getAllMod();

		$perfil = new Perfil();
		$perfils = $perfil->getAllpp();
		$perfils2 = $perfil->getAll();

		$valor = new Valor();
		$valores = $valor->getOnePar(10);

		$val = $persona->getOne();
		// var_dump($edit);
		// var_dump($val);
		
		require_once 'views/vEditPerf.php';
		//header("Location:".base_raiz2.'views/vEditPerf.php');
	}

	//EDITAR DATOS PERFIL - DESDE EL USUARIO

	public function editPUser(){		
		
		//Utils::useraccess('persona/index',$_SESSION['pefid']);


		if(isset($_POST)){			

			$perid = isset($_POST['perid2']) ? $_POST['perid2'] : false;
			$nodocemp = isset($_POST['nodocemp2']) ? $_POST['nodocemp2'] : false;
			$pernom = isset($_POST['pernom2']) ? $_POST['pernom2'] : false;
			$perape = isset($_POST['perape2']) ? $_POST['perape2'] : false;
			$peremail = isset($_POST['peremail2']) ? $_POST['peremail2'] : false;
			$perpass = isset($_POST['perpass2']) ? $_POST['perpass2'] : false;
			$ubiid = isset($_POST['ubiid2']) ? $_POST['ubiid2'] : false;
			$perdir = isset($_POST['perdir2']) ? $_POST['perdir2'] : false;
			$pertel = isset($_POST['pertel2']) ? $_POST['pertel2'] : false;
			$percel = isset($_POST['percel2']) ? $_POST['percel2'] : false;
			//$pefid = isset($_POST['pefid']) ? $_POST['pefid'] : false;
			//$depid = isset($_POST['depid']) ? $_POST['depid'] : false;
			$envema = isset($_POST['envema2']) ? $_POST['envema2'] : false;
			//$actemp = isset($_POST['actemp']) ? $_POST['actemp'] : 1;

			// $ubica = new ubica();
			// $ubicas = $ubica->getAll();

			// var_dump($ubicas);
			// die();
			
			if($pernom && $perape && $ubiid){

				$persona = new persona();
				$persona->setPerid($perid);
				$persona->setNodocemp($nodocemp);
				$persona->setPernom($pernom);
				$persona->setPerape($perape);
				//$persona->setPeremail($peremail);
				$persona->setPerpass($perpass);
				$persona->setUbiid($ubiid);
				$persona->setPerdir($perdir);
				$persona->setPertel($pertel);
				$persona->setPercel($percel);				
				$persona->setEnvema($envema);
				
				$personas = $persona->getAll();
				$areas = $persona->getAllArea(1);
				$tpusu = $persona->getAllArea(30);
				$carg = $persona->getAllArea(6);
				$ubica = new Ubica();
				$ubicas = $ubica->getAll();

				$modulo = new Modulo();
				$modulos = $modulo->getAllMod();

				$perfil = new Perfil();
				$perfils = $perfil->getAllpp();
				$perfils2 = $perfil->getAll();

				$valor = new Valor();
				$valores = $valor->getOnePar(10);

				// $save = $persona->save();
				// $edit = $persona->edit();
				if(isset($_GET['perid'])){
					$perid = $_GET['perid'];
					$persona->setPerid($perid);
					
					$save = $persona->editP();
				}else{
					//	$save = $persona->save();
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
		header("Location:".base_raiz.'usuario/logout');
	}
}