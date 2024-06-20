<?php
include'models/plamej.php';

$validGlobal = "";

class PlamejController{
	
	public function index(){
		Utils::useraccess('plamej/index',$_SESSION['pefid']);
	
		$fil1 = isset($_POST['fil1']) ? $_POST['fil1'] : false;
		$fil2 = isset($_POST['fil2']) ? $_POST['fil2'] : false;
		$fil3 = isset($_POST['fil3']) ? $_POST['fil3'] : false;
		$selectedAreas = isset($_POST['areapla']) ? $_POST['areapla'] : []; // Nuevo filtro por área

		date_default_timezone_set('America/Bogota');
		$hoy = date("Y-m-d");
		$munm = isset($fil1) ? $fil1:date("Y-m-d",strtotime($hoy."- 1 month"));
		$val = NULL;

		$plamej = new Plamej();
		// $plamej->setCerst(0);
		if($fil1 && $fil2){
			$plamej->setFil1($fil1);
			$plamej->setFil2($fil2);
		}
		if($fil3){
			$plamej->setFil3($fil3);
		}

		if (!empty($selectedAreas)) {
            $plamej->setSelectedAreas($selectedAreas);
        }

		$plamejs = $plamej->getAll(3051);
		$areasT = $plamej->getAllVal(1,"as",3);
		$datfuet = $plamej->getAllVal(32);
		$cargoLid = $plamej->getAllValPre(6);
		// $cate = $plamej->getAllVal(10,"ds");
		// $areaen = $plamej->getAllVal(28);
		// $personal = $plamej->getAllEmp();

		// var_dump($plamejs);
		// die();

// Actualiza los planes de mejora
		$ptme = 0;
		if($plamejs){ foreach($plamejs AS $dtplmj){
			$plamej->setNopla($dtplmj['nopla']);
			$NoAccMos = $plamej->getNoAccMos();
			$ptme = 0;

			// Genera el porcentaje por plan de mejora, de acuerdo a las acciones y actividades, se tiene en cuenta que solo por actividad se cogeel ultimo seguimiento, pero se promedian las actividades y las acciones
			if($NoAccMos){ 
				foreach($NoAccMos AS $nam){
					$plamej->setNoacc($nam['noacc']);
					$NoAtPor = $plamej->getNoAtPor();
					$ptmpt = 0;
					if($NoAtPor){ 
						foreach($NoAtPor AS $nap){
							$ptmpt += $nap['maxpor'];
						}
						$ptmpt = $ptmpt/count($NoAtPor);
					}
					$ptme += $ptmpt;
				}
				$ptme = round($ptme/count($NoAccMos),0);
			}
			//echo "<br>No Plan: ".$dtplmj['nopla']." Porcentaje a Guardar: ".$ptme."<br>";
			$dtpl = $plamej->getDactPla();

			if($dtpl){
				foreach($dtpl AS $dtf){
					if($ptme==100 AND $dtf['fcava']>$dtf['ffin']){
						$aleseg = 1804;
					}else{
						if($ptme<100 AND $dtf['fcava']>$dtf['ffin']){
							$aleseg = 1805;
						}else{
							$dalesg = $plamej->getAutAlsg($ptme);
							$aleseg = $dalesg[0]["valid"];
						}
					}
					//if($aleseg>1802) $actpla=1; else 
					$actpla=1;
					$plamej->setEstpla($aleseg);
					$plamej->setActpla($actpla);
					$plamej->setPorpla($ptme);
					$plamej->editEstPm();
					//echo $dtf['pro']." ".$aleseg." ".$actpla."<br>";
				}
			}
		}}
		$plamejs = $plamej->getAll(3051);
		$valid = 3051;



		if($_SESSION['pefid']==70 or $_SESSION['pefid']==74)
			require_once 'views/plamej.php';
		else
			require_once 'views/plamej.php';
	}

	public function inst(){
		Utils::useraccess('plamej/inst',$_SESSION['pefid']);
	
		$fil1 = isset($_POST['fil1']) ? $_POST['fil1'] : false;
		$fil2 = isset($_POST['fil2']) ? $_POST['fil2'] : false;
		$fil3 = isset($_POST['fil3']) ? $_POST['fil3'] : false;	
		$selectedAreas = isset($_POST['areapla']) ? $_POST['areapla'] : []; // Nuevo filtro por área
		//$fil4 = isset($_POST['fil4']) ? $_POST['fil4'] : false; // Agregado filtro 4

		//$valid = isset($_REQUEST['valid']) ? $_REQUEST['valid']:false;
		//$valid = isset($_POST['valid']) ? $_POST['valid'] : false;

		date_default_timezone_set('America/Bogota');
		$hoy = date("Y-m-d");
		$munm = isset($fil1) ? $fil1:date("Y-m-d",strtotime($hoy."- 1 month"));
		$val = NULL;

		$plamej = new Plamej();
		// $plamej->setCerst(0);
		if($fil1 && $fil2){
			$plamej->setFil1($fil1);
			$plamej->setFil2($fil2);
		}
		if($fil3){
			$plamej->setFil3($fil3);
		}

		if (!empty($selectedAreas)) {
            $plamej->setSelectedAreas($selectedAreas);
        }

		$plamejs = $plamej->getAll();
		$areasT = $plamej->getAllVal(1,"as",3);
		$datfuet = $plamej->getAllVal(32);
		$cargoLid = $plamej->getAllValPre(6);
		// $cate = $plamej->getAllVal(10,"ds");
		// $areaen = $plamej->getAllVal(28);
		// $personal = $plamej->getAllEmp();

		// var_dump($plamejs);
		// die();

// Actualiza los planes de mejora
		$ptme = 0;
		if($plamejs){ foreach($plamejs AS $dtplmj){
			$plamej->setNopla($dtplmj['nopla']);
			$NoAccMos = $plamej->getNoAccMos();
			$ptme = 0;

			// Genera el porcentaje por plan de mejora, de acuerdo a las acciones y actividades, se tiene en cuenta que solo por actividad se cogeel ultimo seguimiento, pero se promedian las actividades y las acciones
			if($NoAccMos){ 
				foreach($NoAccMos AS $nam){
					$plamej->setNoacc($nam['noacc']);
					$NoAtPor = $plamej->getNoAtPor();
					$ptmpt = 0;
					if($NoAtPor){ 
						foreach($NoAtPor AS $nap){
							$ptmpt += $nap['maxpor'];
						}
						$ptmpt = $ptmpt/count($NoAtPor);
					}
					$ptme += $ptmpt;
				}
				$ptme = round($ptme/count($NoAccMos),0);
			}
			//echo "<br>No Plan: ".$dtplmj['nopla']." Porcentaje a Guardar: ".$ptme."<br>";
			$dtpl = $plamej->getDactPla();

			if($dtpl){
				foreach($dtpl AS $dtf){
					if($ptme==100 AND $dtf['fcava']>$dtf['ffin']){
						$aleseg = 1804;
					}else{
						if($ptme<100 AND $dtf['fcava']>$dtf['ffin']){
							$aleseg = 1805;
						}else{
							$dalesg = $plamej->getAutAlsg($ptme);
							$aleseg = $dalesg[0]["valid"];
						}
					}
					//if($aleseg>1802) $actpla=1; else 
					$actpla=1;
					$plamej->setEstpla($aleseg);
					$plamej->setActpla($actpla);
					$plamej->setPorpla($ptme);
					$plamej->editEstPm();
					//echo $dtf['pro']." ".$aleseg." ".$actpla."<br>";
				}
			}

			//$tipla = $plamej->getTipla(90,$valid);


		}}

		$plamejs = $plamej->getAll();
		$datTiplan = $plamej->getAllTiplan(90);
		//$tipla = $plamej->getTipla(90,3004);
		//print_r($valid);


		if($_SESSION['pefid']==70 or $_SESSION['pefid']==74)
			require_once 'views/inst.php';
		else
			require_once 'views/inst.php';
	}

	public function updDAplmj(){
		$valid = isset($_REQUEST['valid']) ? $_REQUEST['valid']:false;

		if($valid==3051)
			Utils::useraccess('plamej/index',$_SESSION['pefid']);
		else
			Utils::useraccess('plamej/inst',$_SESSION['pefid']);
	
		$nopla = isset($_REQUEST['nopla']) ? $_REQUEST['nopla'] : false;

		date_default_timezone_set('America/Bogota');
		$hoy = date("Y-m-d");
		if(($_SESSION['pefid']==70 OR $_SESSION['pefid']==74) AND $nopla){
			$plamej = new Plamej();
			$plamej->setNopla($nopla);
			$plamej->updDesApro();
		}

		if($valid==3051)
			header("Location:".base_url.'plamej/index');
		else
			header("Location:".base_url.'plamej/inst');

		// header("Location:".base_url.'plamej/index');
	}

	public function save(){
		// Utils::useraccess('plamej/index',$_SESSION['pefid']);
		if(isset($_POST)){
			date_default_timezone_set('America/Bogota');

			$fsolpla = date("Y-m-d H:i:s");
			$fuepla = isset($_POST['fuepla']) ? $_POST['fuepla']:false;
			$detfue = isset($_POST['detfue']) ? $_POST['detfue']:false;
			$fobspla = isset($_POST['fobspla']) ? $_POST['fobspla']:date("Y-m-d H:i:s");
			$cappla = isset($_POST['cappla']) ? $_POST['cappla']:false;
			$obspla = isset($_POST['obspla']) ? $_POST['obspla']:false;
			$areapla = isset($_POST['areapla']) ? $_POST['areapla']:false;
			$estpla = isset($_POST['estpla']) ? $_POST['estpla']:1801;
			$carlmej = isset($_POST['carlmej']) ? $_POST['carlmej']:false;
			$valid = isset($_POST['valid']) ? $_POST['valid']:false;
			$periodi = isset($_POST['periodi']) ? $_POST['periodi'] : false;

			$areapla = $this->aTexto($areapla);

			// echo "<br>".$nopla;
			// echo "-".$fsolpla."-".$fuepla."-".$detfue."-".$fobspla."-".$cappla."-".$obspla."-".$areapla."-".$estpla."<br>";

			if($fuepla && $detfue && $obspla){
				$plamej = new Plamej();
				$plamej->setFsolpla($fsolpla);
				$plamej->setFuepla($fuepla);
				$plamej->setDetfue($detfue);
				$plamej->setFobspla($fobspla);
				$plamej->setCappla($cappla);
				$plamej->setObspla($obspla);
				$plamej->setAreapla($areapla);
				$plamej->setEstpla($estpla);
				$plamej->setCarlmej($carlmej);
				$plamej->setValid($valid);
				$plamej->setPeriodi($periodi);
				
				$plamejs = $plamej->getAll();
				$areasT = $plamej->getAllVal(1,"as",3);
				if(isset($_GET['nopla'])){
					$nopla = $_GET['nopla'];
					$plamej->setNopla($nopla);
					$save = $plamej->edit();
				}else{
					$save = $plamej->save();
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
		if($valid==3051)
			header("Location:".base_url.'plamej/index');
		else
			header("Location:".base_url.'plamej/inst');
	}

	public function edit(){
		// Utils::useraccess('plamej/index',$_SESSION['pefid']);
		if(isset($_GET['nopla'])){
			$nopla = $_GET['nopla'];
			// var_dump($nopla);
			// die();
			$edit = true;
		
			$plamej = new Plamej();
			$plamej->setNopla($nopla);
			$plamejs = $plamej->getAll();
			$val = $plamej->getOne();
			
			$valid=NULL;
			if($val && $val[0]['valid']) $valid=$val[0]['valid'];

			if($valid==3051) $plamejs = $plamej->getAll(3051);
			else $plamejs = $plamej->getAll();

			$datTiplan = $plamej->getAllTiplan(90);
			$areasT = $plamej->getAllVal(1,"as",3);
			$datfuet = $plamej->getAllVal(32);
			$cargoLid = $plamej->getAllValPre(6);
			date_default_timezone_set('America/Bogota');
			$hoy = date("Y-m-d");
			// var_dump($edit);
			// var_dump($val);
			// die();

			
			if($valid==3051)
				require_once 'views/plamej.php';
			else
				require_once 'views/inst.php';
		}else{
			header('Location:'.base_url.'plamej/index');
		}
	}

	public function elipm(){
		$valid = isset($_REQUEST['valid']) ? $_REQUEST['valid']:false;
		if($valid==3051)
			Utils::useraccess('plamej/index',$_SESSION['pefid']);
		else
			Utils::useraccess('plamej/inst',$_SESSION['pefid']);
	
		$nopla = isset($_GET['nopla']) ? $_GET['nopla'] : false;
		$plamej = new Plamej();
		$plamej->setNopla($nopla);
		if($_SESSION['pefid']==58 OR $_SESSION['pefid']==70 OR $_SESSION['pefid']==73 OR $_SESSION['pefid']==74)
			$plamej->delPM();

		if($valid==3051)
			header("Location:".base_url.'plamej/index');
		else
			header("Location:".base_url.'plamej/inst');
		//header('Location:'.base_url.'plamej/index');
	}

	public function plamejcr(){
		Utils::useraccess('plamej/index',$_SESSION['pefid']);
	
		$fil1 = isset($_POST['fil1']) ? $_POST['fil1'] : false;
		$fil2 = isset($_POST['fil2']) ? $_POST['fil2'] : false;
		$fil3 = isset($_POST['fil3']) ? $_POST['fil3'] : false;

		date_default_timezone_set('America/Bogota');
		$hoy = date("Y-m-d");
		$munm = date("Y-m-d",strtotime($hoy."- 1 month"));
		$val = NULL;

		$plamej = new Plamej();
		// $plamej->setCerst(0);
		if($fil1 && $fil2){
			$plamej->setFil1($fil1);
			$plamej->setFil2($fil2);
		}
		if($fil3){
			$plamej->setFil3($fil3);
		}
		$valid = 3051;
		$plamejs = $plamej->getAllcr(3051);
		$areasT = $plamej->getAllVal(1,"as",3);
		$datfuet = $plamej->getAllVal(32);
		// $cate = $plamej->getAllVal(10,"ds");
		// $areaen = $plamej->getAllVal(28);
		// $personal = $plamej->getAllEmp();

		// var_dump($plamejs);
		// die();
		if($_SESSION['pefid']==70 or $_SESSION['pefid']==74)
			require_once 'views/plamejcr.php';
		else
			require_once 'views/plamejcr.php';
	}

	public function placr(){
		Utils::useraccess('plamej/inst',$_SESSION['pefid']);
	
		$fil1 = isset($_POST['fil1']) ? $_POST['fil1'] : false;
		$fil2 = isset($_POST['fil2']) ? $_POST['fil2'] : false;
		$fil3 = isset($_POST['fil3']) ? $_POST['fil3'] : false;

		date_default_timezone_set('America/Bogota');
		$hoy = date("Y-m-d");
		$munm = date("Y-m-d",strtotime($hoy."- 1 month"));
		$val = NULL;

		$plamej = new Plamej();
		// $plamej->setCerst(0);
		if($fil1 && $fil2){
			$plamej->setFil1($fil1);
			$plamej->setFil2($fil2);
		}
		if($fil3){
			$plamej->setFil3($fil3);
		}
		$plamejs = $plamej->getAllcr();
		$areasT = $plamej->getAllVal(1,"as",3);
		$datfuet = $plamej->getAllVal(32);
		// $cate = $plamej->getAllVal(10,"ds");
		// $areaen = $plamej->getAllVal(28);
		// $personal = $plamej->getAllEmp();

		// var_dump($plamejs);
		// die();
		if($_SESSION['pefid']==70 or $_SESSION['pefid']==74)
			require_once 'views/placr.php';
		else
			require_once 'views/placr.php';
	}


	public function updpm(){
		$valid = isset($_REQUEST['valid']) ? $_REQUEST['valid']:false;
		if($valid==3051)
			Utils::useraccess('plamej/index',$_SESSION['pefid']);
		else
			Utils::useraccess('plamej/inst',$_SESSION['pefid']);
		date_default_timezone_set('America/Bogota');
		$fec = date("Y-m-d H:i:s");
		if(isset($_REQUEST)){
			$nopla = isset($_REQUEST['nopla']) ? $_REQUEST['nopla']:false;
			$actpla = isset($_REQUEST['actpla']) ? $_REQUEST['actpla']:2;
			$ocpla = isset($_POST['ocpla']) ? $_POST['ocpla']:"";
			$btnCas = isset($_POST['btnCas']) ? $_POST['btnCas']:"";
			$feciepla = $fec;

			if($btnCas=="Abierto") $actpla = 1;
			if($btnCas=="Cerrado") $actpla = 2;

			if($nopla AND $actpla){
				$plamej = new plamej();
				$plamej->setActpla($actpla);
				$plamej->setNopla($nopla);
				$plamej->setOcpla($ocpla);
				$plamej->setFeciepla($feciepla);
				if($btnCas) $save = $plamej->updPm("act");
				else $save = $plamej->updPm();

				$plamej->saveObs();
				
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
		if($valid==3051)
			header("Location:".base_url.'plamej/index');
		else
			header("Location:".base_url.'plamej/inst');
		// header("Location:".base_url.'plamej/index');
	}

	public function aTexto($vector){
		$pr = "";
		$ci = 0;
		if($vector){
			foreach ($vector as $vec) {
				$pr .= $vec;
				if($ci<count($vector)-1) $pr .= ";";
				$ci++;
			}
		}
		return $pr;
	}

	public function updPlmj(){
		$valid = isset($_REQUEST['valid']) ? $_REQUEST['valid']:false;
		if($valid==3051)
			Utils::useraccess('plamej/index',$_SESSION['pefid']);
		else
			Utils::useraccess('plamej/inst',$_SESSION['pefid']);
		if(isset($_GET)){
			$nopla = isset($_GET['nopla']) ? $_GET['nopla'] : false;
			date_default_timezone_set('America/Bogota');
			$fechor = date("Y-m-d H:i:s");

			// echo $nopla."-".$aprpmj;
			// die();

			if($nopla){
				$plamej = new plamej();
				$plamej->setNopla($nopla);
				$plamej->setPerid($_SESSION['perid']);
				$plamej->setFecautpla($fechor);
				$save = $plamej->editAutLider();
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
		if($valid==3051)
			header("Location:".base_url.'plamej/index');
		else
			header("Location:".base_url.'plamej/inst');
		// header("Location:".base_url.'plamej/index');
	}
}