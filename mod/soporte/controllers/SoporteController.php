<?php
include'models/soporte.php';

class SoporteController{
	
	public function index(){		
		Utils::useraccess('soporte/index',$_SESSION['pefid']);
	
		$fil1 = isset($_POST['fil1']) ? $_POST['fil1'] : false;
		$fil2 = isset($_POST['fil2']) ? $_POST['fil2'] : false;

		date_default_timezone_set('America/Bogota');
		$hoy = date("Y-m-d");
		$munm = date("Y-m-d",strtotime($hoy."- 1 month"));

		$soporte = new soporte();
		$soporte->setCerst(0);
		if($fil1 && $fil2){
			$soporte->setFil1($fil1);
			$soporte->setFil2($fil2);
		}
		$soportes = $soporte->getAll();

		$tipo = $soporte->getAllVal(1);
		$cate = $soporte->getAllVal(10,"ds");

		// var_dump($soportes);
		// die();

		if($_SESSION['pefid']==10 or $_SESSION['pefid']==27)
			require_once 'views/soporte.php';
		else
			require_once 'views/soportes.php';
	}

	public function save(){
		Utils::useraccess('soporte/index',$_SESSION['pefid']);
		if(isset($_POST)){

			$idst = isset($_POST['idst']) ? $_POST['idst'] : false;
			date_default_timezone_set('America/Bogota');
			$fecsst = date("Y-m-d H:i:s");
			$nomsst = isset($_POST['nomsst']) ? $_POST['nomsst'] : false;
			$area = isset($_POST['area']) ? $_POST['area'] : false;
			$desst = isset($_POST['desst']) ? $_POST['desst'] : false;
			$telst = isset($_POST['telst']) ? $_POST['telst'] : false;
			$rutst = isset($_POST['rutst']) ? $_POST['rutst'] : false;
			$cerst = isset($_POST['cerst']) ? $_POST['cerst'] : "0";
			$cat = isset($_POST['cat']) ? $_POST['cat'] : false;

			$arch = isset($_FILES['arch']["name"]) ? $_FILES['arch']["name"]:NULL;

 //echo "<br>".$fecsst."-".$nomsst."-".$area."-".$desst."-".$telst."-".$rutst."-".$arch."-".$cerst."-".$cat."<br>";
	// 2021-06-27 05:26:42-hjhjhkjh-1041-bjkbjk jkb kj jk jk kj k -3104567878---1
	// die();
			//Carga de archivo
			if($arch){
				$rutst = Utils::opti($_FILES['arch'], date('YmdHis'), "arcsop","soporte");
			}

			if($fecsst && $nomsst && $desst){
				$soporte = new soporte();
				$soporte->setIdst($idst);
				$soporte->setFecsst($fecsst);
				$soporte->setNomsst($nomsst);
				$soporte->setArea($area);
				$soporte->setDesst($desst);
				$soporte->setTelst($telst);
				$soporte->setRutst($rutst);
				$soporte->setCerst($cerst);
				$soporte->setCat($cat);

				$soportes = $soporte->getAll();
				$tipo = $soporte->getAllVal(1);
				$cate = $soporte->getAllVal(10,"ds");

				// $save = $soporte->save();
				// $edit = $soporte->edit();
				if(isset($_GET['idst'])){
					$idst = $_GET['idst'];
					$soporte->setIdst($idst);
					
					$save = $soporte->edit();
				}else{
					$save = $soporte->save();
				}

				//echo "<script>alert('Su soporte ha sido registrada. Pronto estaremos en contacto.');</script>";
				
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
		header("Location:".base_url.'soporte/index');
	}

	public function edit(){
		Utils::useraccess('soporte/index',$_SESSION['pefid']);
		if(isset($_GET['idst'])){
			$idst = $_GET['idst'];
// var_dump($idst);
// die();
			$edit = true;
		
			$soporte = new soporte();
			$soporte->setIdst($idst);
			$soporte->setCerst(0);
			$soportes = $soporte->getAll();
			$tipo = $soporte->getAllVal(1);
			$cate = $soporte->getAllVal(10,"ds");

			$val = $soporte->getOne();
			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/soporte.php';
			
		}else{
			header('Location:'.base_url.'soporte/index');
		}
	}
}