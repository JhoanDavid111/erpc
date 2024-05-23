<?php
include'models/cate.php';

class CateController{
	
	public function index(){		
		Utils::useraccess('cate/index',$_SESSION['pefid']);

		$cate = new Cate();
		$cates = $cate->getAll();

		// var_dump($cates);
		// die();
		require_once 'views/cate.php';
	}

	public function save(){
		Utils::useraccess('cate/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$idcts = isset($_POST['idcts']) ? $_POST['idcts'] : false;
			$clasop = isset($_POST['clasop']) ? $_POST['clasop'] : false;
			$sersop = isset($_POST['sersop']) ? $_POST['sersop'] : false;
			$subcsop = isset($_POST['subcsop']) ? $_POST['subcsop'] : false;
			$tipprd = isset($_POST['tipprd']) ? $_POST['tipprd'] : false;
			$tipprb = isset($_POST['tipprb']) ? $_POST['tipprb'] : false;
			$n1 = isset($_POST['n1']) ? $_POST['n1'] : false;
			$n2 = isset($_POST['n2']) ? $_POST['n2'] : false;
			$n3 = isset($_POST['n3']) ? $_POST['n3'] : false;
			$causop = isset($_POST['causop']) ? $_POST['causop'] : false;
			$nsol = isset($_POST['nsol']) ? $_POST['nsol'] : false;
			$afesop = isset($_POST['afesop']) ? $_POST['afesop'] : false;
			$obssop = isset($_POST['obssop']) ? $_POST['obssop'] : false;

			// echo "<br><br>".$idcts."-".$clasop."-".$sersop."-".$subcsop."-".$tipprd."-".$tipprb."-".$n1."-".$n2."-".$n3."-".$causop."-".$nsol."-".$afesop."-".$obssop."<br><br>";
			// die();

			if($clasop && $sersop && $subcsop && $tipprd && $tipprb && $nsol){
				$cate = new cate();
				$cate->setIdcts($idcts);
				$cate->setClasop($clasop);
				$cate->setSersop($sersop);
				$cate->setSubcsop($subcsop);
				$cate->setTipprd($tipprd);
				$cate->setTipprb($tipprb);
				$cate->setN1($n1);
				$cate->setN2($n2);
				$cate->setN3($n3);
				$cate->setCausop($causop);
				$cate->setNsol($nsol);
				$cate->setAfesop($afesop);
				$cate->setObssop($obssop);

				$cates = $cate->getAll();

				if(isset($_GET['idcts'])){
					$idcts = $_GET['idcts'];
					$cate->setIdcts($idcts);
					
					$save = $cate->edit();
				}else{
					$save = $cate->save();
				}

				//echo "<script>alert('Su cate ha sido registrada. Pronto estaremos en contacto.');</script>";
				
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
		header("Location:".base_url.'cate/index');
	}

	public function edit(){
		Utils::useraccess('cate/index',$_SESSION['pefid']);
		if(isset($_GET['idcts'])){
			$idcts = $_GET['idcts'];
		// var_dump($idcts);
		// die();
			$edit = true;
		
			$cate = new cate();
			$cate->setIdcts($idcts);
			$cates = $cate->getAll();

			$val = $cate->getOne();
			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/cate.php';
			
		}else{
			header('Location:'.base_url.'cate/index');
		}
	}
}