<?php
include'models/pregunta.php';

class PregcanalController{
	
	public function index(){		
		//Utils::useraccess('pregunta/index',$_SESSION['pefid']);

		$_SESSION['pefid']=4;
		$_SESSION['pefid']=11;		
	
		$fil1 = isset($_POST['fil1']) ? $_POST['fil1'] : false;
		$fil2 = isset($_POST['fil2']) ? $_POST['fil2'] : false;

		date_default_timezone_set('America/Bogota');
		$hoy = date("Y-m-d");
		$munm = date("Y-m-d",strtotime($hoy."- 1 month"));

		$pregunta = new pregunta();
		$pregunta->setleido(0);
		if($fil1 && $fil2){
			$pregunta->setFil1($fil1);
			$pregunta->setFil2($fil2);
		}
		$preguntas = $pregunta->getAllres('te');
		// var_dump($preguntas);
		// die();

		$tipo = $pregunta->getAllVal(22);
		$tipoe = $pregunta->getAllVal(22,"ds");

		// var_dump($preguntas);
		// die();

		// if($_SESSION['pefid']==42)
			require_once 'views/respcanal.php';
		// else
		// 	require_once 'views/preguntas.php';
	}

	public function save(){
		Utils::useraccess('pregunta/index',$_SESSION['pefid']);
		if(isset($_POST)){

// SELECT iddap, fecdap, perid, okjurdap, leido, tipo, temdap, predap, valid FROM derautpre
			$iddap = isset($_POST['iddap']) ? $_POST['iddap'] : false;
			date_default_timezone_set('America/Bogota');
			$fecdap = date("Y-m-d H:i:s");
			$temdap = isset($_POST['temdap']) ? $_POST['temdap'] : false;
			$valid = isset($_POST['valid']) ? $_POST['valid'] : false;
			$predap = isset($_POST['predap']) ? $_POST['predap'] : false;
			$perid = isset($_POST['perid']) ? $_POST['perid'] : 1;
			$okjurdap = isset($_POST['okjurdap']) ? $_POST['okjurdap'] : false;
			if($okjurdap=='on') $okjurdap = 1;
			$leido = isset($_POST['leido']) ? $_POST['leido'] : "0";
			$tipo = 'te';
			$rutdap = isset($_POST['rutdap']) ? $_POST['rutdap'] : false;;

			$arch = isset($_FILES['arch']["name"]) ? $_FILES['arch']["name"]:NULL;

 //echo "<br>".$fecdap."-".$temdap."-".$valid."-".$predap."-".$perid."-".$okjurdap."-".$arch."-".$leido."-".$tipo."<br>";
	// 2021-06-27 05:26:42-hjhjhkjh-1041-bjkbjk jkb kj jk jk kj k -3104567878---1
	 //die();
			// Carga de archivo
			if($arch){
				$rutdap = Utils::opti($_FILES['arch'], date('YmdHis'), "arcsop","temporal");
			}

			if($fecdap && $temdap && $predap){
				$pregunta = new pregunta();
				$pregunta->setiddap($iddap);
				$pregunta->setfecdap($fecdap);
				$pregunta->settemdap($temdap);
				$pregunta->setvalid($valid);
				$pregunta->setpredap($predap);
				$pregunta->setperid($perid);
				$pregunta->setokjurdap($okjurdap);
				$pregunta->setleido($leido);
				$pregunta->settipo($tipo);
				$pregunta->setrutdap($rutdap);

				$preguntas = $pregunta->getAll('te');
				$tipo = $pregunta->getAllVal(1);
				$tipoe = $pregunta->getAllVal(10,"ds");

				// $save = $pregunta->save();
				// $edit = $pregunta->edit();
				if(isset($_GET['iddap'])){
					$iddap = $_GET['iddap'];
					$pregunta->setiddap($iddap);
					
					$save = $pregunta->edit();
				}else{
					$save = $pregunta->save();
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
		header("Location:".base_url.'pregunta/index');
	}

	public function edit(){
		Utils::useraccess('pregunta/index',$_SESSION['pefid']);
		if(isset($_GET['iddap'])){
			$iddap = $_GET['iddap'];
// var_dump($iddap);
// die();
			$edit = true;
		
			$pregunta = new pregunta();
			$pregunta->setiddap($iddap);
			$pregunta->setleido(0);
			$preguntas = $pregunta->getAll('te');
			$tipo = $pregunta->getAllVal(1);
			$tipoe = $pregunta->getAllVal(10,"ds");

			$val = $pregunta->getOne();
			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/pregunta.php';
			
		}else{
			header('Location:'.base_url.'pregunta/index');
		}
	}
}