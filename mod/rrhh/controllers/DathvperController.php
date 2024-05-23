<?php
include'models/dathvper.php';
include'models/ubica.php';
include'models/valor.php';
include'models/dats.php';
include'models/expl.php';
include'models/percargo.php';
include'models/segm.php';

class DathvperController{
	
	public function index(){
		Utils::useraccess('dathvper/index',$_SESSION['pefid']);
		$perid = isset($_REQUEST['perid']) ? $_REQUEST['perid'] : NULL;
		$txtn = isset($_GET['txtn']) ? $_GET['txtn']:NULL;

		//Objeto para llamar datos de dominio y valor en modulo configuracion

		date_default_timezone_set('America/Bogota');
	   	$hoy = date("Y-m-d");

		$td=new dathvper();

		$tipcon=$td->getValid(52);
		$tipdoc=$td->getValid(44);	
		$sex=$td->getValid(34);		
		$grusan=$td->getValid(35);	
		$idzon=$td->getValid(53); 		
		$estra=$td->getValid(36);		
		$tipviv=$td->getValid(37);		
		$tiplib=$td->getValid(38);		
		$estciv=$td->getValid(39);		
		$idgene=$td->getValid(40);		
		$orisex=$td->getValid(41);
		$nometb=$td->getValid(42);
		$td->setPerid($perid);
		$datOne = $td->getOne();

		if($datOne){
			$dlgnac = $datOne[0]['dlgnac'];
			$infnac = $this->familia($dlgnac);
			// $dcifnc = explode("&",$infnac);
			$dpmlb = $datOne[0]['dpmlb'];
			$infviv = $this->familia($dpmlb);
			$mtfviv = $this->MtxFam($dpmlb)."&".$datOne[0]['munbrlc']."&".$datOne[0]['ndpmlb'];
			$dcifvv = explode("&",$mtfviv);
		}

		$depar=$td->getUbi(0);

		// var_dump($datOne);

		require_once 'views/dathvper.php';
	}

	public function save(){
		Utils::useraccess('dathvper/index',$_SESSION['pefid']);
		
		if(isset($_POST)){
			//var_dump($_POST);
			//die();
			$nodocemp = isset($_POST['nodocemp']) ? $_POST['nodocemp']:NULL;
			$pernom = isset($_POST['pernom']) ? $_POST['pernom']:NULL;
			$perape = isset($_POST['perape']) ? $_POST['perape']:NULL;
			$peremail = isset($_POST['peremail']) ? $_POST['peremail']:NULL;
			$perdir = isset($_POST['perdir']) ? $_POST['perdir']:NULL;
			$pertel = isset($_POST['pertel']) ? $_POST['pertel']:NULL;
			$percel = isset($_POST['percel']) ? $_POST['percel']:NULL;

			$perid = isset($_REQUEST['perid']) ? $_REQUEST['perid']:NULL;
			$tipcon = isset($_POST['tipcon']) ? $_POST['tipcon'] : NULL;
	 		$fecinico = isset($_POST['fecinico']) ? $_POST['fecinico'] : NULL;
			$fecfinco = isset($_POST['fecfinco']) ? $_POST['fecfinco'] : NULL;
			$tipdoc = isset($_POST['tipdoc']) ? $_POST['tipdoc'] : NULL;
			$nomide = isset($_POST['nomide']) ? $_POST['nomide'] : NULL;
	 		$sex = isset($_POST['sex']) ? $_POST['sex'] : NULL;
	 		$panac = isset($_POST['panac']) ? $_POST['panac'] : NULL;				
	 		$grusan = isset($_POST['grusan']) ? $_POST['grusan'] : NULL;
	 		$usuemail = isset($_POST['usuemail']) ? $_POST['usuemail'] : NULL;
	 		$fecnac = isset($_POST['fecnac']) ? $_POST['fecnac'] : date("Y-m-d H:i:s");
	 		$ubiid = isset($_POST['ubiid']) ? $_POST['ubiid'] : NULL;
	 		$idzona = isset($_POST['idzona']) ? $_POST['idzona'] : NULL;
	 		$munbrlc = isset($_POST['munbrlc3']) ? $_POST['munbrlc3']:NULL;
	 		if(!$munbrlc) $munbrlc = isset($_POST['munbrlc2']) ? $_POST['munbrlc2']:NULL;
	 		if(!$munbrlc) $munbrlc = isset($_POST['munbrlc1']) ? $_POST['munbrlc1']:NULL;
	 		$estra = isset($_POST['estra']) ? $_POST['estra'] : NULL;
	 		$tipviv = isset($_POST['tipviv']) ? $_POST['tipviv'] : NULL;
	 		$tiplib = isset($_POST['tiplib']) ? $_POST['tiplib'] : NULL;
	 		$dismil = isset($_POST['dismil']) ? $_POST['dismil'] : NULL;
	 		$numlib = isset($_POST['numlib']) ? $_POST['numlib'] : NULL;
	 		$estciv = isset($_POST['estciv']) ? $_POST['estciv'] : NULL;
	 		$idio = isset($_POST['idio']) ? $_POST['idio'] : NULL;
	 		$idgene = isset($_POST['idgene']) ? $_POST['idgene'] : NULL;
	 		$orisex = isset($_POST['orisex']) ? $_POST['orisex'] : NULL;
	 		$cabfam = isset($_POST['cabfam']) ? $_POST['cabfam'] : NULL;
	 		$perexp = isset($_POST['perexp']) ? $_POST['perexp'] : NULL;
	 		$viccon = isset($_POST['viccon']) ? $_POST['viccon'] : NULL;
	 		$peretn = isset($_POST['peretn']) ? $_POST['peretn'] : NULL;
	 		$nometb = isset($_POST['nometb']) ? $_POST['nometb'] : NULL;
	 		$eps = isset($_POST['eps']) ? $_POST['eps'] : NULL;
	 		$fdp = isset($_POST['fdp']) ? $_POST['fdp'] : NULL;
	 		$arl = isset($_POST['arl']) ? $_POST['arl'] : NULL;
	 		$nomedubas = isset($_POST['nomedubas']) ? $_POST['nomedubas'] : NULL;
	 		$ulgrap = isset($_POST['ulgrap']) ? $_POST['ulgrap'] : NULL;
	 		$feulgrap = isset($_POST['feulgrap']) ? $_POST['feulgrap'] : NULL;

			$dathvper = new Dathvper();
			$dathvper->setPerid($perid);
			$dathvper->setTipcon($tipcon);
			$dathvper->setFecinico($fecinico);
			$dathvper->setFecfinco($fecfinco);
			$dathvper->setTipdoc($tipdoc);
			$dathvper->setNomide($nomide);
			$dathvper->setSex($sex);
			$dathvper->setPanac($panac);
			$dathvper->setGrusan($grusan);
			$dathvper->setUsuemail($usuemail);
			$dathvper->setFecnac($fecnac);
			$dathvper->setUbiid($ubiid);
			$dathvper->setIdzona($idzona);
			$dathvper->setMunbrlc($munbrlc);		
			$dathvper->setEstra($estra);
			$dathvper->setTipviv($tipviv);
			$dathvper->setTiplib($tiplib);
			$dathvper->setDismil($dismil);
			$dathvper->setNumlib($numlib);
			$dathvper->setEstciv($estciv);
			$dathvper->setIdio($idio);
			$dathvper->setIdgene($idgene);
			$dathvper->setOrisex($orisex);
			$dathvper->setCabfam($cabfam);
			$dathvper->setPerexp($perexp);
			$dathvper->setViccon($viccon);
			$dathvper->setPeretn($peretn);
			$dathvper->setNometb($nometb);
			$dathvper->setEps($eps);
			$dathvper->setFdp($fdp);
			$dathvper->setArl($arl);
			$dathvper->setNomedubas($nomedubas);
			$dathvper->setUlgrap($ulgrap);
			$dathvper->setFeulgrap($feulgrap);

			$dathvper->setNodocemp($nodocemp);
			$dathvper->setPernom($pernom);
			$dathvper->setPerape($perape);
			$dathvper->setPeremail($peremail);
			$dathvper->setPerdir($perdir);
			$dathvper->setPertel($pertel);
			$dathvper->setPercel($percel);

			$can = $dathvper->getDhvCan();

			// echo "<br>".$perid."'&'".$tipcon."'&'".$fecinico."'&'".$fecfinco."'&'".$tipdoc."'&'".$nomide."'&'".$grusan."'&'".$sex."'&'".$panac."'&'".$usuemail."'&'".$fecnac."'&'".$ubiid."'&'".$idzona."'&'".$munbrlc."'&'".$estra."'&'".$tipviv."'&'".$tiplib."'&'".$dismil."'&'".$numlib."'&'".$estciv."'&'".$idio."'&'".$idgene."'&'".$orisex."'&'".$cabfam."'&'".$perexp."'&'".$viccon."'&'".$peretn."'&'".$nometb."'&'".$eps."'&'".$fdp."'&'".$arl."'&'".$nomedubas."'&'".$ulgrap."'&'".$feulgrap."<br>";
			// echo "<br><br>".$_POST['munbrlc3']." - ".$_POST['munbrlc2']." - ".$_POST['munbrlc1']." - ".$munbrlc."<br>";
			// die();

			if($can && $can[0]["can"]>0){
				$save = $dathvper->edit();
				$txtn = "actualizado";
			}else{
				$save = $dathvper->save();
				$txtn = "registrado";
			}
			$dathvper->setUbiid($munbrlc);
			$save = $dathvper->editPer();

			//echo "<script>alert('Su usuario ha sido ".$txtn.".');</script>";

			if($save){
				$_SESSION['register'] = "complete";
			}else{
				$_SESSION['register'] = "failed";
			}
			
		}else{
			$_SESSION['register'] = "failed";
		}
		header("Location:".base_url.'dathvper/index&perid='.$perid.'&txtn='.$txtn);
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

	function familia($ubidepto,$ord="ASC"){
		$txt = '';
		$td = new dathvper();
		$td->setUbidepto($ubidepto);
		$dep = $td->getOneUbi();
		if($ubidepto<>0){
			//$txt .= $dep[0]['ubiid']."&".$dep[0]['ubinom']."&";
			$txt .= $dep[0]['ubinom']." / ";
			if($dep[0]['ubidepto']<>0){
				if($ord=="ASC")
					$txt = $this->familia($dep[0]['ubidepto']).$txt;	//Menor a Mayor
				else
					$txt .= $this->familia($dep[0]['ubidepto'],"DESC");	//Mayor a Menor
			}
		}else{
			$txt .= "Sin ubicación registrada.";
		}

		return $txt;
	}

	function MtxFam($ubidepto,$ord="ASC"){
		$txt = '';
		$td = new dathvper();
		$td->setUbidepto($ubidepto);
		$dep = $td->getOneUbi();
		if($ubidepto<>0){
			$txt .= $dep[0]['ubiid']."&".$dep[0]['ubinom']."&";
			if($dep[0]['ubidepto']<>0){
				if($ord=="ASC")
					$txt = $this->MtxFam($dep[0]['ubidepto']).$txt;	//Menor a Mayor
				else
					$txt .= $this->MtxFam($dep[0]['ubidepto'],"DESC");	//Mayor a Menor
			}
		}else{
			$txt .= "";
		}

		return $txt;
	}


	public function repor(){		
		Utils::useraccess('dathvper/index',$_SESSION['pefid']);
		Utils::useraccess('segm/index',$_SESSION['pefid']);
		Utils::useraccess('dats/index',$_SESSION['pefid']);
		Utils::useraccess('percargo/index',$_SESSION['pefid']);
		//$perid = NULL;
		$persona = new dathvper();
		$persona1 = new segm();
		$persona2 = new dats();
		$persona3 = new percargo();

		
		//capturar variable del filtro
		$tipcon = isset($_POST['tipcon']) ? $_POST['tipcon']:NULL;
		$depid = isset($_POST['depid']) ? $_POST['depid']:NULL;
		$pernom = isset($_POST['pernom']) ? $_POST['pernom']:NULL;
		$cargo = isset($_POST['cargo']) ? $_POST['cargo']:NULL;
		$actemp = isset($_POST['actemp']) ? $_POST['actemp']:NULL;
		$sex = isset($_POST['sex']) ? $_POST['sex']:NULL;
		$grusan = isset($_POST['grusan']) ? $_POST['grusan']:NULL;
		$estciv = isset($_POST['estciv']) ? $_POST['estciv']:NULL;
		$idgene = isset($_POST['idgene']) ? $_POST['idgene']:NULL;
		$orisex = isset($_POST['orisex']) ? $_POST['orisex']:NULL;
		$cabfam = isset($_POST['cabfam']) ? $_POST['cabfam']:NULL;
		$perexp = isset($_POST['perexp']) ? $_POST['perexp']:NULL;
		$viccon = isset($_POST['viccon']) ? $_POST['viccon']:NULL;
		$peretn = isset($_POST['peretn']) ? $_POST['peretn']:NULL;
		$eps = isset($_POST['eps']) ? $_POST['eps']:NULL;
		$fdp = isset($_POST['fdp']) ? $_POST['fdp']:NULL;
		$arl = isset($_POST['arl']) ? $_POST['arl']:NULL;
		$tiedis = isset($_POST['tiedis']) ? $_POST['tiedis']:NULL;
		$disca = isset($_POST['disca']) ? $_POST['disca']:NULL;
		$tiptitul = isset($_POST['tiptitul']) ? $_POST['tiptitul']:NULL;
		$modest = isset($_POST['modest']) ? $_POST['modest']:NULL;
		$medcap = isset($_POST['medcap']) ? $_POST['medcap']:NULL;
		$prtpcg = isset($_POST['prtpcg']) ? $_POST['prtpcg']:NULL;	
		$tippcg = isset($_POST['tippcg']) ? $_POST['tippcg']:NULL;	


		
		//Enviar dato al modelo
		$persona->setTipcon($tipcon);
		$persona->setDepid($depid);
		$persona->setPernom($pernom);
		$persona->setCargo($cargo);
		$persona->setActemp($actemp);
		$persona->setSex($sex);
		$persona->setGrusan($grusan);
		$persona->setEstciv($estciv);
		$persona->setIdgene($idgene);
		$persona->setOrisex($orisex);	
		$persona->setCabfam($cabfam);	
		$persona->setPerexp($perexp);
		$persona->setViccon($viccon);	
		$persona->setPeretn($peretn);
		$persona->setEps($eps);
		$persona->setFdp($fdp);
		$persona->setArl($arl);
		$persona1->setTiedis($tiedis); 
		$persona1->setDisca($disca);
		$persona2->setTiptitul($tiptitul);
		$persona2->setModest($modest);
		$persona2->setMedcap($medcap);
		$persona3->setPrtpcg($prtpcg);
		$persona3->setTippcg($tippcg);



		$personas = $persona->getFilter();
		$actemps=$persona->getFilter();
		$cabfams=$persona->getFilter();
		$perexps=$persona->getFilter();
		$viccons=$persona->getFilter();
		$peretns=$persona->getFilter();
		$tipcons=$persona->getValid(52);
		$tipdoc=$persona->getValid(44);	
		$sexs=$persona->getValid(34);		
		$grusans=$persona->getValid(35);	
		$idzon=$persona->getValid(53); 		
		$estra=$persona->getValid(36);		
		$tipviv=$persona->getValid(37);		
		$tiplib=$persona->getValid(38);		
		$estcivs=$persona->getValid(39);		
		$idgenes=$persona->getValid(40);		
		$orisexs=$persona->getValid(41);
		$nometb=$persona->getValid(42);
		$areas = $persona->getAllArea(1);
		$carg = $persona->getAllArea(6);
		$tiediss=$persona1->getDisca();
		$discas=$persona1->getValdom(54);
		$tiptituls=$persona2->getValdis(57);
		$modests=$persona2->getValdis(48);
		$medcaps=$persona2->getValdis(49);
		$prtpcgs=$persona3->getValdo(43);
		$tippcgs=$persona3->getValdo(45);
		$ubica = new Ubica();
		$ubicas = $ubica->getAll();
		$valor = new Valor();
		$valores = $valor->getOnePar(10);

		// var_dump($valores);
		// die();

		require_once 'views/repor.php';

	}


}