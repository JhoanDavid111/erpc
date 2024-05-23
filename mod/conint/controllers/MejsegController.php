<?php
include'models/plamej.php';

class MejsegController{
	
	public function index(){		
		Utils::useraccess('mejseg/index',$_SESSION['pefid']);

		date_default_timezone_set('America/Bogota');
		$fec = date("Y-m-d");
		$fechor = date("Y-m-d H:i:s");
		$ftedtp = date("Y-m-d",strtotime($fec."+ 1 month"));
		$ftedt = date("Y-m-d",strtotime($fec."+ 1 year - 1 day"));
		$plamej = new plamej();
		$noacc = isset($_REQUEST['noacc']) ? $_REQUEST['noacc']:false;
		$nopla = isset($_REQUEST['nopla']) ? $_REQUEST['nopla']:false;
		$noact = isset($_REQUEST['noact']) ? $_REQUEST['noact']:false;
		$noava = isset($_REQUEST['noava']) ? $_REQUEST['noava']:false;
		$h = isset($_REQUEST['h']) ? $_REQUEST['h']:false;
		$plamej->setNopla($nopla);
		$plamejs = $plamej->getOne();
		$accpro = $plamej->getAllVal(33);
		$area = $plamej->getAllVal(1);
		$cargo = $plamej->getAllVal(6);
		$cargoLid = $plamej->getAllValPre(6);
		$acci = $plamej->getAllMejo();
		 if($acci AND $acci[0]['noacc']){
		 	$plamej->setNoacc($acci[0]['noacc']);
		 	$acti = $plamej->getOneAct();
		 }
		$est = $plamej->getAllVal(31);
		$audit = $plamej->getAllPer();
		$OCI=NULL;
		
		if($plamejs){
			$txm = ";".$plamejs[0]['areapla'];
			// echo $txm;
			$OCI = strpos($txm, 1006);
			// echo "<br>".$OCI;
			// die();
		}
		
		$dtOnem = NULL;
		if($noacc){
			$plamej->setNoacc($noacc);
			$dtOnem = $plamej->getOneMejo();
		}

		// var_dump($dtOnem);
		// die();

		require_once 'views/mejseg.php';
	}

	public function updMej(){
		Utils::useraccess('mejseg/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$noacc = isset($_GET['noacc']) ? $_GET['noacc'] : false;
			date_default_timezone_set('America/Bogota');
			$fec = date("Y-m-d");
			$fechor = date("Y-m-d H:i:s");
			$aprpmj = isset($_POST['aprpmj']) ? $_POST['aprpmj']:false;
			$at = isset($_GET['at']) ? $_GET['at'] : false;

			// echo $noacc."-".$aprpmj;
			// die();

			if($noacc){
				$plamej = new plamej();
				$nopla = isset($_REQUEST['nopla']) ? $_REQUEST['nopla'] : false;
				$plamej->setNopla($nopla);
				$plamejs = $plamej->getOne();
				$accpro = $plamej->getAllVal(33);
				$area = $plamej->getAllVal(1);
				$cargo = $plamej->getAllVal(6);
				$cargoLid = $plamej->getAllValPre(6);
				$acci = $plamej->getAllMejo();
				$segui = $plamej->getAllSeg();
				$est = $plamej->getAllVal(31);
				$audit = $plamej->getAllPer();
				$aprpmj = $at;

				// $save = $plamej->save();
				// $edit = $plamej->edit();
				if(isset($_GET['noacc'])){
					$noacc = $_GET['noacc'];
					$plamej->setNoacc($noacc);
					$save = $plamej->updMej($aprpmj);
				}
				//echo "<script>alert('Su plamej ha sido registrada. Pronto estaremos en contacto.');</script>";
				
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
		header("Location:".base_url.'mejseg/index&nopla='.$nopla);
		//header("Location:".base_url);
	}

	public function saveMejo(){
		Utils::useraccess('mejseg/index',$_SESSION['pefid']);

		if(isset($_POST)){
			$noacc = isset($_REQUEST['noacc']) ? $_REQUEST['noacc'] : false;
			$nopla = isset($_REQUEST['nopla']) ? $_REQUEST['nopla'] : false;
			$edit = isset($_POST['edit']) ? $_POST['edit']:false;
			date_default_timezone_set('America/Bogota');
			$fec = date("Y-m-d");
			$fechor = date("Y-m-d H:i:s");
			$caumej = isset($_POST['caumej']) ? $_POST['caumej']:false;
			$accmej = isset($_POST['accmej']) ? $_POST['accmej']:false;
			$unimej = isset($_POST['unimej']) ? $_POST['unimej']:false;
			$tapmej = isset($_POST['tapmej']) ? $_POST['tapmej']:false;
			$foract = isset($_POST['foract']) ? $_POST['foract']:false;
			$chkeli = isset($_POST['chkeli']) ? $_POST['chkeli']:false;
			$metmej = isset($_POST['metmej']) ? $_POST['metmej']:false;
			$alcmej = isset($_POST['alcmej']) ? $_POST['alcmej']:false;
			$finimej = isset($_POST['finimej']) ? $_POST['finimej']:$fec;
			$ffinmej = isset($_POST['ffinmej']) ? $_POST['ffinmej']:$fec;
			$aremej = isset($_POST['aremej']) ? $_POST['aremej']:false;
			$carlmej = isset($_POST['carlmej']) ? $_POST['carlmej']:false;
			$carrmej = isset($_POST['carrmej']) ? $_POST['carrmej']:false;
			$noact = isset($_POST['noact']) ? $_POST['noact']:false;

			$aremej = $this->aTexto($aremej);
			$carlmej = $this->aTexto($carlmej);
			$carrmej = $this->aTexto($carrmej);

			// echo $edit."-".$noacc."-".$nopla."-".$caumej."-".$unimej."-".$tapmej."-".$metmej."-".$alcmej."-".$finimej."-".$ffinmej."-".$aremej."-".$carlmej."-".$carrmej."<br><br>";
			// var_dump($accmej);
			// echo "<br><br>";
			// var_dump($foract);
			// die();
			
			if($nopla && $caumej && $tapmej && $aremej && $carlmej && $carrmej && $accmej && $foract){
				$plamej = new plamej();
				$plamej->setNopla($nopla);
				$plamej->setCaumej($caumej);
				$plamej->setUnimej($unimej);
				$plamej->setTapmej($tapmej);
				$plamej->setMetmej($metmej);
				$plamej->setAlcmej($alcmej);
				$plamej->setAremej($aremej);
				$plamej->setCarlmej($carlmej);
				$plamej->setCarrmej($carrmej);

				// $plamejs = $plamej->getOne();
				// $accpro = $plamej->getAllVal(33);
				// $area = $plamej->getAllVal(1);
				// $cargo = $plamej->getAllVal(6);
				// $cargoLid = $plamej->getAllValPre(6);
				// $acci = $plamej->getAllMejo();
				// $segui = $plamej->getAllSeg();
				// $est = $plamej->getAllVal(31);
				// $audit = $plamej->getAllPer();
				if($edit && $noacc){
					$plamej->setNoacc($noacc);
					$save = $plamej->updMejAcc();
					if($accmej){
						for ($i=0;$i<count($accmej);$i++) {
							$nct = isset($noact[$i]) ? $noact[$i]:0;
							$plamej->setNoact($nct);
							$plamej->setAccmej($accmej[$i]);
							$plamej->setForact($foract[$i]);
							$plamej->setFinimej($finimej[$i]." 00:00:00");
							$plamej->setFfinmej($ffinmej[$i]." 23:59:59");
							if($nct){
								// echo "<br>Edita ".$noact[$i]." ".$accmej[$i];
								$save = $plamej->editAct();
							}else{
								// echo "<br>Inserta ".$accmej[$i]." ".$foract[$i];
								$save = $plamej->saveAct();
							}
						}
					}
					if($chkeli){
						foreach($chkeli AS $cel){
							$plamej->setNoact($cel);
							$plamej->delAT();
						}
					}

					/*if($noact){
						var_dump($accmej);
						die();
						for ($i=0;$i<count($noact);$i++) {
							$plamej->setNoact($noact[$i]);
							$plamej->setAccmej($accmej[$i]);
							$plamej->setForact($foract[$i]);
							$save = $plamej->editAct();
						}
					}*/
				}else{
					$save = $plamej->saveMejo();
					$newid = $plamej->getLastIdMejo();
					// var_dump($newid);
					// die();
					if($newid AND $newid[0]['noacc']){
						for ($i=0;$i<count($accmej);$i++) {
							$plamej->setNoacc($newid[0]['noacc']);
							$plamej->setAccmej($accmej[$i]);
							$plamej->setForact($foract[$i]);
							$plamej->setFinimej($finimej[$i]." 00:00:00");
							$plamej->setFfinmej($ffinmej[$i]." 23:59:59");
							$save = $plamej->saveAct();
						}
					}
				}
				//echo "<script>alert('Su plamej ha sido registrada. Pronto estaremos en contacto.');</script>";
				
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
		header("Location:".base_url.'mejseg/index&nopla='.$nopla);
		//header("Location:".base_url);
	}


	public function delMejo(){
		Utils::useraccess('mejseg/index',$_SESSION['pefid']);
		if(isset($_GET)){
			$noacc = isset($_REQUEST['noacc']) ? $_REQUEST['noacc'] : false;
			$nopla = isset($_REQUEST['nopla']) ? $_REQUEST['nopla'] : false;
			if($noacc && $nopla){
				$plamej = new plamej();
				$plamej->setNoacc($noacc);
				$save = $plamej->delMej();
			}
			header("Location:".base_url.'mejseg/index&nopla='.$nopla);
		}else{
			header("Location:".base_url.'plamej/index');
		}
		
	}

	public function eliacc(){
		Utils::useraccess('mejseg/index',$_SESSION['pefid']);
		if(isset($_GET)){
			$noacc = isset($_REQUEST['noacc']) ? $_REQUEST['noacc'] : false;
			$nopla = isset($_REQUEST['nopla']) ? $_REQUEST['nopla'] : false;
			if($noacc){
				$plamej = new plamej();
				$plamej->setNoacc($noacc);
				$save = $plamej->delActot();
				$save = $plamej->delMej();
			}
			header("Location:".base_url.'mejseg/index&nopla='.$nopla);
		}else{
			header("Location:".base_url.'plamej/index');
		}
		
	}

	public function edit(){
		Utils::useraccess('mejseg/index',$_SESSION['pefid']);
		if(isset($_GET['nopla'])){
			$nopla = $_GET['nopla'];
			$edit = true;
		
			$plamej = new plamej();
			$plamej->setnopla($nopla);
			$plamej->setCerst(0);
			$plamejs = $plamej->getAll();
			$tipo = $plamej->getAllVal(20);

			$val = $plamej->getOne();
			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/mejseg.php';
			
		}else{
			header('Location:'.base_url.'mejseg/index');
		}
	}

 	public function saveSegu(){
		Utils::useraccess('mejseg/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$noplsg = isset($_REQUEST['noplsg']) ? $_REQUEST['noplsg'] : false;
			$noava = isset($_REQUEST['noava']) ? $_REQUEST['noava'] : false;
			$nopla = isset($_REQUEST['nopla']) ? $_REQUEST['nopla'] : false;
			date_default_timezone_set('America/Bogota');
			$fec = date("Y-m-d");
			$fechor = date("Y-m-d H:i:s");
			$anaseg = isset($_POST['anaseg']) ? $_POST['anaseg']:false;
			$aleseg = isset($_POST['aleseg']) ? $_POST['aleseg']:0;

			$fecseg = isset($_POST['fecseg']) ? $_POST['fecseg']:$fechor;
			$ejesep = isset($_POST['ejesep']) ? $_POST['ejesep']:false;
			$audseg = isset($_POST['audseg']) ? $_POST['audseg']:false;
			$actrea = isset($_POST['actrea']) ? $_POST['actrea']:false;
			$eviseg = isset($_POST['eviseg']) ? $_POST['eviseg']:false;
			$estseg = isset($_POST['estseg']) ? $_POST['estseg']:false;
			$fecter = isset($_POST['fecter']) ? $_POST['fecter']:false;

			// Generar estado automáticamente, dependiendo de porcentaje y fecha
			$plamej = new plamej();
			if(!$aleseg){
				if($ejesep==100 AND substr($fecseg,0,10)>$fecter){
					$aleseg = 1804;
				}else{
					if(substr($fecseg,0,10)>$fecter){
						$aleseg = 1805;
					}else{
						$dalesg = $plamej->getAutAlsg($ejesep);
						$aleseg = $dalesg[0]["valid"];
					}
				}
			}

			// echo "<br>Con Avance<br><br>";
			// echo $nopla."-".$noava."-".$fechor."-".$anaseg."-".$ejesep."-".$aleseg."-".$_SESSION['perid']."-".$actrea."-".$eviseg."-".$estseg."-".$fecter;
			// die();

			if($noava && $anaseg && $aleseg){
				$plamej->setNoava($noava);
				$plamej->setFecseg($fechor);
				$plamej->setAnaseg($anaseg);
				$plamej->setAleseg($aleseg);
				$plamej->setAudseg($_SESSION['perid']);
				$plamej->setEjesep($ejesep);
				$plamej->setActrea($actrea);
				$plamej->setEviseg($eviseg);
				$plamej->setEstseg($estseg);



				if($noplsg){
					$plamej->setNoplsg($noplsg);
					$save = $plamej->editSeg();
				}else{
					$save = $plamej->saveSeg();
				}
				//echo "<script>alert('Su plamej ha sido registrada. Pronto estaremos en contacto.');</script>";
				
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
		header("Location:".base_url.'mejseg/index&nopla='.$nopla);
	}

 	public function saveSeguSA(){
		Utils::useraccess('mejseg/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$noplsg = isset($_REQUEST['noplsg']) ? $_REQUEST['noplsg'] : false;
			$noava = isset($_REQUEST['noava']) ? $_REQUEST['noava'] : false;
			$nopla = isset($_REQUEST['nopla']) ? $_REQUEST['nopla'] : false;
			date_default_timezone_set('America/Bogota');
			$fec = date("Y-m-d");
			$fechor = date("Y-m-d H:i:s");
			$anaseg = isset($_POST['anaseg']) ? $_POST['anaseg']:false;
			$aleseg = isset($_POST['aleseg']) ? $_POST['aleseg']:0;

			$fecseg = isset($_POST['fecseg']) ? $_POST['fecseg']:$fechor;
			$ejesep = isset($_POST['ejesep']) ? $_POST['ejesep']:false;
			$audseg = isset($_POST['audseg']) ? $_POST['audseg']:false;
			$actrea = isset($_POST['actrea']) ? $_POST['actrea']:false;
			$eviseg = isset($_POST['eviseg']) ? $_POST['eviseg']:false;
			$estseg = isset($_POST['estseg']) ? $_POST['estseg']:false;
			$fecter = isset($_POST['fecter']) ? $_POST['fecter']:false;

			$plamej = new plamej();
			// Inicio insertar Avance Vacio -------------
				$plamej->setNoact($noava);
				$plamej->setComava("Sin avance registrado");
				$plamej->setEviava("");
				$plamej->setPerid($_SESSION['perid']);
				$plamej->setFechava($fechor);
				$plamej->saveAva();
				$resSAva = $plamej->getOneAvaUlt();
				if($resSAva) $noava = $resSAva[0]['noava'];
			// Fin insertar Avance Vacio ----------

			// Generar estado automáticamente, dependiendo de porcentaje y fecha
				// echo "Aca entra";
			if(!$aleseg){
				if($ejesep==100 AND substr($fecseg,0,10)>$fecter){
					$aleseg = 1804;
				}else{
					if($ejesep==0 AND $plamej->getComava()=="Sin avance registrado"){
						$aleseg = 1801;
					}elseif(substr($fecseg,0,10)>$fecter){
						$aleseg = 1805;
					}else{
						$dalesg = $plamej->getAutAlsg($ejesep);
						$aleseg = $dalesg[0]["valid"];
					}
				}
			}

			// echo "<br>Sin Avance<br><br>";
			// echo $nopla."-".$noava."-".$fechor."-".$anaseg."-".$ejesep."-".$aleseg."-".$_SESSION['perid']."-".$actrea."-".$eviseg."-".$estseg."-".$fecter;
			// die();

			if($noava && $anaseg && $aleseg){
				$plamej->setNoava($noava);
				$plamej->setFecseg($fechor);
				$plamej->setAnaseg($anaseg);
				$plamej->setAleseg($aleseg);
				$plamej->setAudseg($_SESSION['perid']);
				$plamej->setEjesep($ejesep);
				$plamej->setActrea($actrea);
				$plamej->setEviseg($eviseg);
				$plamej->setEstseg($estseg);



				if($noplsg){
					$plamej->setNoplsg($noplsg);
					$save = $plamej->editSeg();
				}else{
					$save = $plamej->saveSeg();
				}
				//echo "<script>alert('Su plamej ha sido registrada. Pronto estaremos en contacto.');</script>";
				
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
		header("Location:".base_url.'mejseg/index&nopla='.$nopla);
	}

	public function saveCom(){
		Utils::useraccess('mejseg/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$nopla = isset($_REQUEST['nopla']) ? $_REQUEST['nopla'] : false;
			$noacc = isset($_REQUEST['noacc']) ? $_REQUEST['noacc'] : false;
			date_default_timezone_set('America/Bogota');
			$fec = date("Y-m-d");
			$fechor = date("Y-m-d H:i:s");

			$nocom = isset($_POST['nocom']) ? $_POST['nocom']:false;
			$relcom = isset($_POST['relcom']) ? $_POST['relcom']:false;
			// $evicom = isset($_POST['evicom']) ? $_POST['evicom']:false;
			// echo $nocom."-".$noacc."-".$nopla."-".$relcom;
			// die();

			if($relcom){
				$plamej = new plamej();
				$plamej->setNocom($nocom);
				$plamej->setNoacc($noacc);
				$plamej->setRelcom($relcom);
				// $plamej->setEvicom($evicom);
				$plamej->setPerid($_SESSION['perid']);
				$plamej->setFechcom($fechor);

				$plamej->setNopla($nopla);
				$plamejs = $plamej->getOne();
				$accpro = $plamej->getAllVal(33);
				$area = $plamej->getAllVal(1);
				$cargo = $plamej->getAllVal(6);
				$cargoLid = $plamej->getAllValPre(6);
				$acci = $plamej->getAllMejo();
				$segui = $plamej->getAllSeg();
				$est = $plamej->getAllVal(31);
				$audit = $plamej->getAllPer();

				if(isset($_GET['nocom'])){
					$nocom = $_GET['nocom'];
					$plamej->setNocom($nocom);
					$save = $plamej->editCom();
				}else{
					$save = $plamej->saveCom();
				}
				//echo "<script>alert('Su plamej ha sido registrada. Pronto estaremos en contacto.');</script>";
				
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
		header("Location:".base_url.'mejseg/index&nopla='.$nopla);
		//header("Location:".base_url);
	}

	// Guardar Avance
		public function saveAva(){
		Utils::useraccess('mejseg/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$nopla = isset($_REQUEST['nopla']) ? $_REQUEST['nopla'] : false;
			$noava = isset($_REQUEST['noava']) ? $_REQUEST['noava'] : false;
			date_default_timezone_set('America/Bogota');
			$fec = date("Ymd");
			$fechor = date("Y-m-d H:i:s");

			$noact = isset($_POST['noact']) ? $_POST['noact']:false;
			$comava = isset($_POST['comava']) ? $_POST['comava']:false;
			$ruta = isset($_FILES['eviava']["name"]) ? $_FILES['eviava']["name"] : false;
			
			if($ruta){
				$eviava = Utils::opti($_FILES['eviava'], $noact."_".$fec,"arcci","");
			}

			// echo $noact."-".$noava."-".$nopla."-".$comava."-";
			// var_dump($eviava);
			// die();

			if($comava AND $eviava){
				$plamej = new plamej();
				$plamej->setNoava($noava);
				$plamej->setNoact($noact);
				$plamej->setComava($comava);
				$plamej->setEviava($eviava);
				$plamej->setPerid($_SESSION['perid']);
				$plamej->setFechava($fechor);

				$plamej->setNopla($nopla);
				$plamejs = $plamej->getOne();
				$accpro = $plamej->getAllVal(33);
				$area = $plamej->getAllVal(1);
				$cargo = $plamej->getAllVal(6);
				$cargoLid = $plamej->getAllValPre(6);
				$acci = $plamej->getAllMejo();
				$segui = $plamej->getAllSeg();
				$est = $plamej->getAllVal(31);
				$audit = $plamej->getAllPer();

				if(isset($_GET['noava'])){
					$noava = $_GET['noava'];
					$plamej->setNoava($noava);
					$save = $plamej->editAva();
				}else{
					$save = $plamej->saveAva();
				}
				//echo "<script>alert('Su plamej ha sido registrada. Pronto estaremos en contacto.');</script>";
				
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
		header("Location:".base_url.'mejseg/index&nopla='.$nopla);
		//header("Location:".base_url);
	}

	public function updBloq(){
		Utils::useraccess('mejseg/index',$_SESSION['pefid']);
		if(isset($_GET)){
			$noact = isset($_GET['noact']) ? $_GET['noact']:false;
			$bloact = isset($_GET['bloact']) ? $_GET['bloact']:false;

			if($noact AND $bloact>=1 AND $bloact<=2){
				$plamej = new plamej();
				$nopla = isset($_REQUEST['nopla']) ? $_REQUEST['nopla'] : false;
				$plamej->setBloact($bloact);
				$plamej->setNoact($noact);
				$save = $plamej->editActBlq();
				
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
		header("Location:".base_url.'mejseg/index&nopla='.$nopla);
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

}