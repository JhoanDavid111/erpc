<?php
include'models/valor.php';
include'models/param.php';

class valorController{
	
	public function index(){		
		Utils::useraccess('valor/index',$_SESSION['pefid']);
	
		$valor = new Valor();
		$valors = $valor->getAll();

		$param = new Param();
		$params = $param->getAll();

		// var_dump($params);
		// die();

		require_once 'views/valor.php';
		//require_once 'views/paa.php';
	}

//valid, valnom, parid, valfijo
	public function save(){
		Utils::useraccess('valor/index',$_SESSION['pefid']);
		if(isset($_POST)){

			$valid = isset($_POST['valid']) ? $_POST['valid'] : false;
			$valnom = isset($_POST['valnom']) ? $_POST['valnom'] : false;
			$parid = isset($_POST['parid']) ? $_POST['parid'] : false;
			$valfijo = isset($_POST['valfijo']) ? $_POST['valfijo'] : false;
			$pre = isset($_POST['pre']) ? $_POST['pre'] : false;

			$abr = isset($_POST['abr']) ? $_POST['abr'] : false;
			$ncon = isset($_POST['ncon']) ? $_POST['ncon'] : false;
			$cdpmul = isset($_POST['cdpmul']) ? $_POST['cdpmul'] : false;

			// $param = new param();
			// $params = $param->getAll();

			// var_dump($params);
			// die();
			
			if($valid && $valnom && $parid){
				$valor = new Valor();
				$valor->setValid($valid);
				$valor->setvalnom($valnom);
				$valor->setParid($parid);
				$valor->setValfijo($valfijo);
				$valor->setPre($pre);
				$valor->setAbr($abr);
				$valor->setNcon($ncon);
				$valor->setCdpmul($cdpmul);

				$valors = $valor->getAll();

				// $save = $valor->save();
				// $edit = $valor->edit();
				if(isset($_GET['valid'])){
					$valid = $_GET['valid'];
					$valor->setValid($valid);
					
					$save = $valor->edit();
				}else{
					$save = $valor->save();
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
		header("Location:".base_url.'valor/index');
	}

	public function edit(){
		Utils::useraccess('valor/index',$_SESSION['pefid']);
		if(isset($_GET['valid'])){
			$valid = $_GET['valid'];
// var_dump($valid);
// die();
			$edit = true;
		
			$valor = new valor();
			$valor->setValid($valid);
			$valors = $valor->getAll();
			$param = new Param();
			$params = $param->getAll();

			$val = $valor->getOne();
			
			require_once 'views/valor.php';
			
		}else{
			header('Location:'.base_url.'valor/index');
		}
	}

	public function act(){
		Utils::useraccess('valor/index',$_SESSION['pefid']);
		if(isset($_GET['valid']) AND isset($_GET['cdpmul'])){
			$valid = $_GET['valid'];
			$cdpmul = $_GET['cdpmul'];
			$act = true;
		
			$valor = new valor();
			$valor->setValid($valid);
			$valor->setCdpmul($cdpmul);
			$val = $valor->actCDPm();
			
			$valors = $valor->getAll();
			$param = new Param();
			$params = $param->getAll();
		}
		header('Location:'.base_url.'valor/index');
	}
}