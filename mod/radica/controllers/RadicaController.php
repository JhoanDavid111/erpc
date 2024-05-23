<?php
include'models/radica.php';

class radicaController{
	
	public function index(){
		Utils::useraccess('radica/index',$_SESSION['pefid']);
		$radica = new radica();
		$act=NULL;
		date_default_timezone_set('America/Bogota');
		$ano = isset($_POST['ano']) ? $_POST['ano']:date("Y");
		$tipo = "Recibidos";

		$fecin = isset($_POST['fecin']) ? $_POST['fecin']:date("Y-m-")."01";
		$fecfi = isset($_POST['fecfi']) ? $_POST['fecfi']:date("Y-m-d");
		$trad = isset($_POST['trad']) ? $_POST['trad']:0;
		$ope = isset($_GET['ope']) ? $_GET['ope']:NULL;
		$docid = isset($_GET['docid']) ? $_GET['docid']:NULL;
		
		
		if($docid && $ope=="eldc"){
			$radica->delDoc($docid);
		}

		$getPef = $radica->getPef($_SESSION['pefid']);
		$radicas = $radica->getAll($fecin, $fecfi,$trad);
		$tota = $radica->getTotal($fecin, $fecfi);
		if(isset($_GET['idres']) AND isset($_GET['le'])){
			$radica->updlei($_SESSION["perid"], $_GET['idres'], 2);
		}
		require_once 'views/radica.php';
	}

	public function del(){
		Utils::useraccess('radica/index',$_SESSION['pefid']);
		$radica = new radica();
		$act=NULL;
		$norad = isset($_GET['elcon']) ? $_GET['elcon'] : false;
		$radica->setNorad($norad);
		$getPef = $radica->eliOne();

		header("Location:".base_url.'radica/index');
	}

	public function savearc(){
		Utils::useraccess('radica/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$act=NULL;
			date_default_timezone_set('America/Bogota');
			$archi = isset($_FILES['arch']["name"]) ? $_FILES['arch']["name"] : false;
			$arc = NULL;
			$norad = isset($_POST['id']) ? $_POST['id'] : false;
			$fecrad = date('Y-m-d G:i:s');
			$fec = date('Y-m-d');
			$radica = new radica();

			//echo "<br><br>".$archi."-".$arc."-".$norad."-".$fecrad."-".$fec."<br><br>";

			if($archi){
				$nom = date('YmdGis');
				$anodc = date('Y');
				$arc = Utils::opti($_FILES['arch'], $nom,"Radica/".$anodc."/Otros","_".$norad);
				if($arc){
					$radica->setNorad($norad);
					$radica->setPerid($_SESSION['perid']);
					$radica->setDoctitu($_FILES['arch']["name"]);
					$radica->setDoctip($_SESSION['depid']);
					$radica->setDocfec($fec);
					$radica->setDocext(pathinfo($_FILES['arch']["name"], PATHINFO_EXTENSION));
					$radica->setDocpub($fecrad);
					$radica->setDocpes($_FILES['arch']['size']);
					$radica->setDocruta($arc);

					$radica->saveDoc();
				}
			}
		}
		header("Location:".base_url.'radica/index');
	}

	public function save(){
		Utils::useraccess('radica/index',$_SESSION['pefid']);
		if(isset($_POST) AND isset($_GET['tipo'])){
			$act=NULL;
			date_default_timezone_set('America/Bogota');
			$tipo = $_GET['tipo'];
			$archi = isset($_FILES['archi']["name"]) ? $_FILES['archi']["name"] : false;
			$arc = NULL;
			$norad = isset($_POST['norad']) ? $_POST['norad'] : false;
			$asurad = isset($_POST['asurad']) ? $_POST['asurad']:false;
			$carrad = isset($_POST['carrad']) ? $_POST['carrad']:308;
			$noradext = isset($_POST['noradext']) ? $_POST['noradext']:false;
			$orirad = isset($_POST['orirad']) ? $_POST['orirad']:false;
			$firrad = isset($_POST['firrad']) ? $_POST['firrad']:false;
			$folrad = isset($_POST['folrad']) ? $_POST['folrad']:false;
			$tiprad = isset($_POST['tiprad']) ? $_POST['tiprad']:$tipo;
			$areprorad = isset($_POST['areprorad']) ? $_POST['areprorad']:false;
			$noradcon = isset($_POST['noradcon']) ? $_POST['noradcon']:false;
			$regrad = isset($_SESSION['perid']) ? $_SESSION['perid']:false;
			$fecrad = date('Y-m-d G:i:s');
			$fec = date('Y-m-d');
			$ano = date('Y');
			$emprad = isset($_POST['emprad']) ? $_POST['emprad']:false;
			$nomrad = isset($_POST['nomrad']) ? $_POST['nomrad']:false;
			$dirrad = isset($_POST['dirrad']) ? $_POST['dirrad']:false;
			$posrad = isset($_POST['posrad']) ? $_POST['posrad']:false;
			$ubiid = isset($_POST['ubiid']) ? $_POST['ubiid']:11001;
			$cuerad = isset($_POST['cuerad']) ? $_POST['cuerad']:false;
			$revrad = isset($_POST['revrad']) ? $_POST['revrad']:false;
			$coprad = isset($_POST['coprad']) ? $_POST['coprad']:NULL;
			$chkrad = isset($_POST['chkrad']) ? $_POST['chkrad']:false;
			$adjrad = isset($_POST['adjrad']) ? $_POST['adjrad']:false;
			$carradofi = isset($_POST['carradofi']) ? $_POST['carradofi']:false;
			$mfirrad = isset($_POST['mfirrad']) ? $_POST['mfirrad']:false;
			$oficot = isset($_POST['oficot']) ? $_POST['oficot']:false;

			if($mfirrad=='on') $mfirrad=1; else $mfirrad=2;
			if($oficot=='on') $oficot=1; else $oficot=2;

			$coprad = $this->aTexto($coprad);
			$nomrad = $this->aTexto($nomrad);

			$radica = new radica();
			$dtconf = $radica->getConfig();
			if($chkrad=='on') $chkrad=1; else $chkrad=2;

			if($tipo==602) {
				$consecutivo = $dtconf[0]['nomemo'];
				$idpro = 5001;
			}elseif($tipo==603) {
				$consecutivo = $dtconf[0]['noofi'];
				$idpro = 5003;
			}elseif($tipo==601) {
				$consecutivo = $dtconf[0]['noext'];
				$idpro = 5002;
			}
			$doctrd = 23009;
			$tip = $tipo;

			if($asurad && $firrad && $tiprad && $regrad){
				// echo "<br>".$asurad."-".$carrad."-".$noradext."-".$orirad."-".$firrad."-".$folrad."-".$tiprad."-".$areprorad."-F".$noradcon."-".$regrad."-".$fecrad."-F".$emprad."-F".$nomrad."-F".$dirrad."-F".$posrad."-".$ubiid."-F".$cuerad."-F".$revrad."-".$coprad."-".$chkrad."-".$adjrad."-".$consecutivo."-F".$carradofi."<br>";
				$radica->setNorad($norad);
				$radica->setAsurad($asurad);
				$radica->setCarrad($carrad);
				$radica->setNoradext($noradext);
				$radica->setOrirad($orirad);
				$radica->setFirrad($firrad);
				$radica->setFolrad($folrad);
				$radica->setTiprad($tiprad);
				$radica->setAreprorad($areprorad);
				$radica->setNoradcon($noradcon);
				$radica->setRegrad($regrad);
				$radica->setFecrad($fecrad);
				$radica->setEmprad($emprad);
				$radica->setNomrad($nomrad);
				$radica->setDirrad($dirrad);
				$radica->setPosrad($posrad);
				$radica->setUbiid($ubiid);
				$radica->setCuerad($cuerad);
				$radica->setRevrad($revrad);
				$radica->setCoprad($coprad);
				$radica->setChkrad($chkrad);
				$radica->setAdjrad($adjrad);
				$radica->setIdpro($idpro);
				$radica->setDoctrd($doctrd);
				$radica->setConsecutivo($consecutivo);
				$radica->setCarradofi($carradofi);
				$radica->setMfirrad($mfirrad);
				$radica->setOficot($oficot);

				$fecin = isset($_POST['fecin']) ? $_POST['fecin']:date("Y-m-")."01";
				$fecfi = isset($_POST['fecfi']) ? $_POST['fecfi']:date("Y-m-d");
				$radicas = $radica->getAll($fecin, $fecfi);

				//$radicas = $radica->getAll($ano);
				$tipo = $radica->getVal(20);
				if(isset($_GET['norad'])){
					$norad = $_GET['norad'];
					$radica->setNorad($norad);
					$save = $radica->edit();
				}else{
					$consecutivo++;
					$radica->setConsecutivo($consecutivo);
					$save = $radica->save();
					if($tip==602) $radica->updMem();
					elseif($tip==603) $radica->updOfi();
					elseif($tip==601) $radica->updExt();
					$dat = $radica->getOneNew();

					$radica->setNorad($dat[0]["norad"]);
					$radica->setFecres($fecrad);
					$radica->setPerid($regrad);
					$radica->setIdpro('5001');
					$radica->setIdflu('236');
					$radica->setLeido('1');
					$radica->setObsres('Documento radicado');
					$radica->setEstrad('8001');
					$radica->setVisres('31');
					$save = $radica->savrr();

					$idres = $radica->straza($dat[0]["norad"], $fecrad, '8001', $_SESSION["perid"]);
					$radica->updtrz2($idres[0]['idres'], 1);

					if($archi){
						$nom = date('YmdGis');
						$arc = Utils::opti($_FILES['archi'], $nom,"rad","_".$dat[0]["norad"]);
						if($arc){
							$radica->setNorad($dat[0]["norad"]);
							$radica->setPerid($_SESSION['perid']);
							$radica->setDoctitu($asurad);
							$radica->setDoctip($_SESSION['depid']);
							$radica->setDocfec($fec);
							$radica->setDocext(pathinfo($_FILES['archi']["name"], PATHINFO_EXTENSION));
							$radica->setDocpub($fecrad);
							$radica->setDocpes($_FILES['archi']['size']);
							$radica->setDocruta($arc);

							$radica->saveDoc();
						}
					}
				}

				//echo "<script>alert('Su radica ha sido registrada. Pronto estaremos en contacto.');</script>";
				
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
		header("Location:".base_url.'radica/index');
	}

	public function edit(){
		Utils::useraccess('radica/index',$_SESSION['pefid']);
		if(isset($_GET['norad'])){
			$act=NULL;
			$norad = $_GET['norad'];
			// var_dump($norad);
			// die();
			$edit = true;
		
			$radica = new radica();
			date_default_timezone_set('America/Bogota');
			$fecin = isset($_POST['fecin']) ? $_POST['fecin']:date("Y-m-")."01";
			$fecfi = isset($_POST['fecfi']) ? $_POST['fecfi']:date("Y-m-d");
			$getPef = $radica->getPef($_SESSION['pefid']);
			$radica->setNorad($norad);
			$radicas = $radica->getAll($fecin, $fecfi);
			$tipo = $radica->getAllVal(20);

			$val = $radica->getOne();
			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/radica.php';
			
		}else{
			header('Location:'.base_url.'radica/index');
		}
	}

	public function ext(){
		Utils::useraccess('radica/ext',$_SESSION['pefid']);
		$radica = new radica();
		$act=NULL;
		date_default_timezone_set('America/Bogota');
		$ano = isset($_POST['ano']) ? $_POST['ano']:date("Y");
		$getPef = $radica->getPef($_SESSION['pefid']);
		$getVal = $radica->getVal(6);
		$areas = $radica->getVal(1);
		$muni = $radica->getDepto();
		$fecin = isset($_POST['fecin']) ? $_POST['fecin']:date("Y-m-")."01";
		$fecfi = isset($_POST['fecfi']) ? $_POST['fecfi']:date("Y-m-d");
		$radicas = $radica->getAll($fecin, $fecfi);
		$personPlan = $radica->personPlanta();
		$person = $radica->personAll();
		$tipo = "Externo";
		$t2 = "601";
		require_once 'views/ext.php';
	}

	public function mem(){
		Utils::useraccess('radica/mem',$_SESSION['pefid']);
		$radica = new radica();
		$act=NULL;
		date_default_timezone_set('America/Bogota');
		$ano = isset($_POST['ano']) ? $_POST['ano']:date("Y");
		$getPef = $radica->getPef($_SESSION['pefid']);
		$getVal = $radica->getVal(6);
		$areas = $radica->getVal(1);
		$muni = $radica->getDepto();
		$fecin = isset($_POST['fecin']) ? $_POST['fecin']:date("Y-m-")."01";
		$fecfi = isset($_POST['fecfi']) ? $_POST['fecfi']:date("Y-m-d");
		$radicas = $radica->getAll($fecin, $fecfi);
		$personPlan = $radica->personPlanta();
		$person = $radica->personAll();
		$tipo = "Memorando";
		$t2 = "602";
		require_once 'views/ext.php';
	}

	public function ofi(){
		Utils::useraccess('radica/ofi',$_SESSION['pefid']);
		$radica = new radica();
		$act=NULL;
		date_default_timezone_set('America/Bogota');
		$ano = isset($_POST['ano']) ? $_POST['ano']:date("Y");
		$getPef = $radica->getPef($_SESSION['pefid']);
		$getVal = $radica->getVal(6);
		$areas = $radica->getVal(1);
		$muni = $radica->getDepto();
		$fecin = isset($_POST['fecin']) ? $_POST['fecin']:date("Y-m-")."01";
		$fecfi = isset($_POST['fecfi']) ? $_POST['fecfi']:date("Y-m-d");
		$radicas = $radica->getAll($fecin, $fecfi);
		$personPlan = $radica->personPlanta();
		$person = $radica->personAll();
		$tipo = "Oficio";
		$t2 = "603";
		require_once 'views/ext.php';
	}

	public function email(){
		Utils::useraccess('radica/index',$_SESSION['pefid']);
		$act=NULL;
		$radica = new radica();
		date_default_timezone_set('America/Bogota');
		$ano = isset($_POST['ano']) ? $_POST['ano']:date("Y");

		$tipo = "Recibidos";

		$fecin = isset($_POST['fecin']) ? $_POST['fecin']:date("Y-m-")."01";
		$fecfi = isset($_POST['fecfi']) ? $_POST['fecfi']:date("Y-m-d");
		$getPef = $radica->getPef($_SESSION['pefid']);
		$radicas = $radica->getAll($fecin, $fecfi);
		$tota = $radica->getTotal($fecin, $fecfi);
		
		$id = isset($_POST['id']) ? $_POST['id']:NULL;
		$emaenv = isset($_POST['emaenv']) ? $_POST['emaenv']:NULL;
		$radica->setNorad($id);
		$datRadica = $radica->getOne();
		$emaenv = explode(", ",$emaenv);
		// rinconrobix@gmail.com, robinson.rincon@canalcapital.gov.co
		// var_dump($emaenv);
		// echo "<BR>Aqui vamos ".$id."<BR><pre>";
		// var_dump($datRadica);
		// echo "</pre><BR>";
		// die();


		$mail_username = "robinson.rincon@canalcapital.gov.co";
		$mail_userpassword = "Bat2022@RcC";
		$mail_setFromEmail = "correspondencia@canalcapital.gov.co";
		$mail_setFromName = "Canal Capital";

// Se construye el Sticker INICIO
		$stick = "";
		$stick .= "<div style='border: 1px solid #000;border-radius: 10px;padding: 10px 10px;width: 420px;'>";
			$stick .= "<table border='0' cellpadding='5px' cellspacing='0'>";
			$stick .= "<tr>";
			$stick .= "<td align='center'>";
				//$stick .= "<img src='https://intranet.canalcapital.gov.co/intranet/img/logocanal.png' width='100px'>";
			$stick .= "</td>";
			$stick .= "<td align='center'>";
				//$stick .= "<img src='https://intranet.canalcapital.gov.co/erp/img/logomejor.png' width='60px'>";
			$stick .= "</td>";
			$stick .= "<td>";
				$stick .= "<center><strong>OFICIOS</strong></center>";
				$stick .= "Secretar&iacute;a general<br>";
				$stick .= "N&uacute;mero de Radicado: ".$datRadica[0]["consecutivo"]."<br>";
				$stick .= "Registr&oacute;: ".$datRadica[0]["pernom"]." ".$datRadica[0]["perape"]."<br>";
				$stick .= "N&uacute;mero de Folios: ".$datRadica[0]["folrad"]."<br>";
				//$stick .= "&nbsp;&nbsp;".$fecha;
			$stick .= "</td>";
			$stick .= "</tr>";
			$stick .="</table>";
		$stick .= "</div>";
// Se construye el Sticker FIN

// Se construye el Sticker INICIO
		$diri = "";
		$diri .= "Doctor(a):<br>";
		// $datusu = $radica->personOne($datRadica[0]["nomrad"]);
		// if($datusu){
		// 	$diri .= "<strong>".$datusu[0]["pernom"]." ".$datusu[0]["perape"]."</strong><br>";
		// 	$diri .= $datusu[0]["carg"]."<br>";
		// }else{
			$diri .= "<strong>".$datRadica[0]["nomrad"]."</strong><br>";
			$diri .= $datRadica[0]["carrad"]."<br>";
		// }
		$diri .= "<strong>".$datRadica[0]["emprad"]."</strong><br>";
		$diri .= $datRadica[0]["dirrad"]."<br>";
		$diri .= "C&oacute;digo postal: ".$datRadica[0]["posrad"]."<br>";
		$diri .= $datRadica[0]["ubinom"]."<br><br>";
		$diri = "";
// Se construye el Sticker FIN
		// $txt_message = $datRadica[0]['cuerad'];
		$txt_message = "Se ha dado respuesta a su radicado, en los archivos adjuntos encontrará la respuesta.";
// Se construye la firma INICIO
		$firm = "";
		$datusu = $radica->personOne($datRadica[0]["firrad"]);
		// if (file_exists("../../../firma/fir_".$dtconf[0]["firrad"].".png") AND $dtconf[0]["mfirrad"]==1) {
		// 		$firm .= '<img style="width:150px;" id="imagen" src="../../../firma/fir_'.$dtconf[0]["firrad"].'.png" /><br>';
		// }else{
		// 	$firm .= '<br><br><br>';
		// }

		$firm .= "<strong>".$datusu[0]["pernom"]." ".$datusu[0]["perape"]."</strong>";
		$firm .= "<br>".$datusu[0]["carg"];
// Se construye la firma FIN

// Se construye la muestra de documentos adjuntos INICIO

		$Ndoc = $radica->getNodoc($datRadica[0]['norad']);
		$docs = $radica->getDoc($datRadica[0]['norad']);
		$dadj = '';
		if($Ndoc && $Ndoc[0]['Ndoc']>0){
			$dadj .= '<strong>No. de archivos adjuntos:'.$Ndoc[0]['Ndoc'].'</strong><br>';
			foreach ($docs as $dcs) {
				$dadj .= '<a href="'.path_filem.$dcs['docruta'].'" target="_blank">';
					$dadj .= $dcs['doctitu'];
				$dadj .= '</a><br>';
			}
			$dadj .= '<br>';
		}

// Se construye la muestra de documentos adjuntos FIN

		$mail_subject = substr($datRadica[0]['asurad'],0,40);
		$template = "../../tempmail.html";

		Utils::carsenmail();

		if($emaenv){
			foreach ($emaenv as $emln) {
				$mail_addAddress = $emln;
				Utils::sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$stick,$diri,$txt_message,$mail_subject,$firm,$dadj, $template);
			}
		}
		header("Location:".base_url.'radica/index');
	}

// // Gestión Documental
// 	public function trd(){		
// 		Utils::useraccess('radica/trd',$_SESSION['pefid']);
// 		$radica = new radica();
// 		date_default_timezone_set('America/Bogota');
// 		$dat = $radica->carTrd();
// 		require_once 'views/vtrd.php';
// 	}

// 	public function arCentral(){		
// 		Utils::useraccess('radica/arCentral',$_SESSION['pefid']);
// 		$radica = new radica();
// 		date_default_timezone_set('America/Bogota');
// 		require_once 'views/vArCentral.php';
// 	}

// 	public function arHistorico(){		
// 		Utils::useraccess('radica/arHistorico',$_SESSION['pefid']);
// 		$radica = new radica();
// 		date_default_timezone_set('America/Bogota');
// 		$ano = isset($_POST['ano']) ? $_POST['ano']:date("Y");
// 		$tipo = "Recibidos";

// 		$fecin = isset($_POST['fecin']) ? $_POST['fecin']:date("Y-m-")."01";
// 		$fecfi = isset($_POST['fecfi']) ? $_POST['fecfi']:date("Y-m-d");

// 		$getPef = $radica->getPef($_SESSION['pefid']);
// 		$radicas = $radica->getAll($fecin, $fecfi);
// 		require_once 'views/vHistorico.php';
// 	}
	
// 	public function expedientes(){		
// 		Utils::useraccess('radica/expedientes',$_SESSION['pefid']);
// 		$radica = new radica();

// 		if (isset($_GET['save'])) {
// 			// var_dump($_GET['save']);
// 			// die();
// 			$anoexp = isset($_POST['anoexp']) ? $_POST['anoexp'] : NULL;
// 			$subserie = isset($_POST['doctrd']) ? $_POST['doctrd'] : NULL;
// 			$actexp = isset($_POST['actexp']) ? $_POST['actexp'] : NULL;
			
// 			$idexp=$anoexp.$subserie;
// 			// var_dump($anoexp);
// 			// die();

// 			$radica->insExp($idexp,$anoexp,$subserie,$actexp);
// 		}
// 		date_default_timezone_set('America/Bogota');
// 		$result = $radica->selpag2();
// 		$dttipd = $radica->seltrd();
// 		require_once 'views/vExpedientes.php';
// 	}

// 	public function misExpedientes(){		
// 		Utils::useraccess('radica/misExpedientes',$_SESSION['pefid']);
// 		$radica = new radica();
// 		date_default_timezone_set('America/Bogota');
// 		$result = $radica->selpag2();
// 	}

// 	public function procesos(){		
// 		Utils::useraccess('radica/procesos',$_SESSION['pefid']);
// 		$mtac = new radica();
// 		date_default_timezone_set('America/Bogota');
// 		$dttipd = $mtac->seldeppro();
// 		$dtseltrd = $mtac->seltrd();
// 		$result = $mtac->selpag();
// 		require_once 'views/vProcesos.php';
// 	}

// 	public function gestion(){		
// 		Utils::useraccess('radica/gestion',$_SESSION['pefid']);
// 		$radica = new radica();
// 		date_default_timezone_set('America/Bogota');
// 		$tiparc="Gestion";
// 		$result = $radica->selpag3($tiparc);
// 		require_once 'views/vArGestion.php';
// 	}

// 	public function reten(){		
// 		Utils::useraccess('radica/reten',$_SESSION['pefid']);		
// 		$radica = new radica();
// 		date_default_timezone_set('America/Bogota');
// 		$dat = $radica->carReten();
// 		require_once 'views/vReten.php';
// 	}

// 	public function gesdoc(){		
// 		Utils::useraccess('radica/expedientes',$_SESSION['pefid']);
// 		$radica = new radica();

// 		if (isset($_GET['save'])) {
// 			// var_dump($_GET['save']);
// 			// die();
// 			$anoexp = isset($_POST['anoexp']) ? $_POST['anoexp'] : NULL;
// 			$subserie = isset($_POST['doctrd']) ? $_POST['doctrd'] : NULL;
// 			$actexp = isset($_POST['actexp']) ? $_POST['actexp'] : NULL;
			
// 			$idexp=$anoexp.$subserie;
// 			// var_dump($anoexp);
// 			// die();

// 			$radica->insExp($idexp,$anoexp,$subserie,$actexp);
// 		}
		
// 		date_default_timezone_set('America/Bogota');
// 		$result = $radica->selpag2();
// 		$dttipd = $radica->seltrd();
// 		//require_once 'views/vExpedientes.php';
// 		require_once 'views/vGesdoc.php';
// 	}

// 	public function series(){		
// 		Utils::useraccess('radica/expedientes',$_SESSION['pefid']);
// 		$radica = new radica();			

// 		if (isset($_GET['seri'])) {
// 			date_default_timezone_set('America/Bogota');						
			
// 			$_SESSION['descrip']=$_GET['descrip'];				
// 			$cont=strlen($_GET['seri']);		
// 			// var_dump($cont);
// 			// die();

// 			//BUSCA SUB SERIES
// 			if ($cont<=3) {
// 				$result = $radica->selpag2();
// 				$descrip= $_GET['descrip'];		
// 				$dttipd = $radica->seltrd2Sub($_GET['seri']);
// 				$btnAgregar = "Nueva Seríe";
// 			}
// 			if ($cont==5) {
// 				$result = $radica->selpag2();
// 				$descrip= $_GET['descrip1']." ".">"." ".$_GET['descrip'];		
// 				$dttipd = $radica->seltrd3Sub($_GET['seri']);
// 				$btnAgregar = "Nueva Sub-seríe";
// 			}
// 			if ($cont>=7) {
// 				$result = $radica->selpag2();
// 				$descrip= $_GET['descrip1']." ".">"." ".$_GET['descrip'];		
// 				$dttipd = $radica->seltrd4Sub($_GET['seri']);
// 				$btnAgregar = "Nuevo Tipo Documental";
// 			}
			
// 		}else{
// 			//CARGA PRIMERAS SERIES
// 			date_default_timezone_set('America/Bogota');
// 			$result = $radica->selpag2();
// 			$dttipd = $radica->seltrd2();
// 			$btnAgregar = "Nueva Dependecia";
			
// 		}	
		
// 		require_once 'views/vSeries.php';
// 	}

// 	public function saveSerie(){		
// 		//Utils::useraccess('radica/expedientes',$_SESSION['pefid']);		
// 		//require_once 'views/vSeries.php';
// 	}

// Nuevos Robinson
	public function resp(){		
		Utils::useraccess('radica/resp',$_SESSION['pefid']);
		if(isset($_GET['norad'])){
			$norad = $_GET['norad'];
			// var_dump($norad);
			// die();
			$edit = true;
		
			$radica = new radica();
			date_default_timezone_set('America/Bogota');
			$radica->setNorad($norad);
			$tipo = $radica->getAllVal(20);
			$getVal = $radica->getVal(6);
			$areas = $radica->getVal(1);
			$datFir = $radica->getVal(29);
			$datasi = $radica->resp($norad);
			$personPlan = $radica->personPlanta();
			$person = $radica->personAll();
			$muni = $radica->getDepto();
			$esta = $radica->estarad();
			$docume = $radica->getDoc($norad);

			$datrad = $radica->getOne();
			$t2 = $datrad[0]["tiprad"];

			$dtres= $radica->seltra($norad);
			//var_dump($dtres);
			if(isset($_GET['norad']) AND isset($dtres[0]['id'])){
				$norad = $_GET['norad'];
				$idres = $dtres[0]['id'];
				$lei = $radica->exilei($_SESSION["perid"], $idres);
				//var_dump($lei);
				if(!$lei){
					$radica->inslei($_SESSION["perid"], $idres);
					//$radica->updlei($_SESSION["perid"], $idres, 1);
				}else{
					$radica->updlei($_SESSION["perid"], $idres, 1);
				}
			}

			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/resp.php';
		}else{
			header('Location:'.base_url.'radica/index');
		}
	}

	public function savevb(){		
		Utils::useraccess('radica/resp',$_SESSION['pefid']);
		if(isset($_POST['norad']) AND isset($_POST['idres'])){
			$norad = $_POST['norad'];
			$idres = $_POST['idres'];
			$visres = $_POST['visres'];
		
			$radica = new radica();
			//$radica->inslei($norad, $visres);
			header('Location:'.base_url.'radica/resp&norad='.$norad);
		}else{
			header('Location:'.base_url.'radica/index');
		}
	}

	public function aTexto($vector){
		$pr = "";
		$ci = 0;
		if($vector){
			foreach ($vector as $vec) {
				$pr .= $vec;
				if($ci<count($vector)-1) $pr .= ",";
				$ci++;
			}
		}
		return $pr;
	}

	public function savrr(){
		Utils::useraccess('radica/index',$_SESSION['pefid']);
		if(isset($_POST)){
			date_default_timezone_set('America/Bogota');
			$norad = isset($_POST['norad']) ? $_POST['norad'] : false;
			$fecres = date('Y-m-d G:i:s');
			$perid = $_SESSION['perid'];
			$idpro = isset($_POST['idpro']) ? $_POST['idpro']:5001;
			$idflu = isset($_POST['idflu']) ? $_POST['idflu']:236;
			$leido = isset($_POST['leido']) ? $_POST['leido']:1;
			$obsres = isset($_POST['obsres']) ? $_POST['obsres']:false;
			$estrad = isset($_POST['estrad']) ? $_POST['estrad']:false;
			$visres = isset($_POST['visres']) ? $_POST['visres']:31;
			

// echo $norad."-".$fecres."-".$perid."-".$idpro."-".$idflu."-".$leido."-".$obsres."-".$estrad."<br>";
// die();

			$radica = new radica();

			if($norad && $estrad && $visres){
				$radica->setNorad($norad);
				$radica->setFecres($fecres);
				$radica->setPerid($perid);
				$radica->setIdpro($idpro);
				$radica->setIdflu($idflu);
				$radica->setLeido($leido);
				$radica->setObsres($obsres);
				$radica->setEstrad($estrad);
				$radica->setVisres($visres);

				if(isset($_GET['idres'])){
					$idres = $_GET['idres'];
					$radica->setNorad($norad);
					//$save = $radica->edit();
				}else{
					$save = $radica->savrr();
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
		header("Location:".base_url.'radica/index');
	}
}