<?php
include'models/pregunta.php';

class RespuestaController{
	
	public function index(){		
		//Utils::useraccess('respuesta/index',$_SESSION['pefid']);
	
		$pregunta = new pregunta();
		$iddap = isset($_REQUEST['iddap']) ? $_REQUEST['iddap'] : false;
		$ate = isset($_GET['ate']) ? $_GET['ate'] : false;
		$pregunta->setiddap($iddap);
		$preguntas = $pregunta->getOne();
		$asis = $pregunta->getAllAsi();
		// $psis = $pregunta->getAllPer();

		// var_dump($tipo);
		// die();

		require_once 'views/respuesta.php';
	}

	public function saverp(){
		Utils::useraccess('respuesta/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$iddap = isset($_POST['iddap']) ? $_POST['iddap'] : false;
			date_default_timezone_set('America/Bogota');
			$fecdar = date("Y-m-d H:i:s");
			$resdar = isset($_POST['resdar']) ? $_POST['resdar'] : false;
			$leido = isset($_POST['leido']) ? $_POST['leido'] : 0;

			// echo $iddap."-".$fecdar."-".$perid."-".$resdar."-".$leido;
			// die();

			if($iddap && $fecdar && $resdar){
				$pregunta = new pregunta();
				$pregunta->setiddap($iddap);
				$pregunta->setfecdar($fecdar);
				$pregunta->setresdar($resdar);
				$pregunta->setleido($leido);
				$preguntas = $pregunta->getOne();
				//$psis = $pregunta->getAllPer();
				// $save = $pregunta->save();
				// $edit = $pregunta->edit();
				if(isset($_GET['iddar'])){
					$iddap = $_GET['iddar'];
					$pregunta->setiddar($iddar);
					$save = $pregunta->edit();
				}else{
					$save = $pregunta->saverp();
					if($leido==1){
						$pregunta->setleido($leido);
						$save = $pregunta->editest();
					}
				}

				//echo "<script>alert('Su pregunta ha sido registrada. Pronto estaremos en contacto.');</script>";
				
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
		header("Location:".base_url.'respuesta/index&iddap='.$iddap);
		//header("Location:".base_url);
	}

	public function edit(){
		Utils::useraccess('respuesta/index',$_SESSION['pefid']);
		if(isset($_GET['iddap'])){
			$iddap = $_GET['iddap'];
// var_dump($iddap);
// die();
			$edit = true;
		
			$pregunta = new pregunta();
			$pregunta->setiddap($iddap);
			$pregunta->setleido(0);
			$preguntas = $pregunta->getAll('da');
			$tipo = $pregunta->getAllVal(20);

			$val = $pregunta->getOne();
			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/respuesta.php';
			
		}else{
			header('Location:'.base_url.'respuesta/index');
		}
	}
}