<?php
include'models/radica.php';

class radicaController{
	
	public function index(){
		    
		Utils::useraccess('radica/trd',$_SESSION['pefid']);
		$radica = new radica();
		date_default_timezone_set('America/Bogota');
		$dat = $radica->carTrd();
		//require_once 'views/vTrd.php';
		//require_once 'views/vSeries.php';
		$this->series();
	}

	public function del(){
		Utils::useraccess('radica/index',$_SESSION['pefid']);
		$radica = new radica();
		$norad = isset($_GET['elcon']) ? $_GET['elcon'] : false;
		$radica->setNorad($norad);
		$getPef = $radica->eliOne();

		header("Location:".base_url.'radica/index');
	}

	public function savearc(){
		Utils::useraccess('radica/index',$_SESSION['pefid']);
		if(isset($_POST)){
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
				$arc = Utils::opti($_FILES['arch'], $nom,"rad","_".$norad);
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

			if($mfirrad=='on') $mfirrad=1; else $mfirrad=2;

			$coprad = $this->aTexto($coprad);

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
					$save = $radica->savrr();

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
			require_once 'views/vHistorico.php';
			
		}else{
			header('Location:'.base_url.'radica/index');
		}
	}

	public function ext(){
		Utils::useraccess('radica/ext',$_SESSION['pefid']);
		$radica = new radica();
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

// Gestión Documental
	public function trd(){
		Utils::useraccess('radica/trd',$_SESSION['pefid']);
		$radica = new radica();
		date_default_timezone_set('America/Bogota');
		$dat = $radica->carTrd();
		require_once 'views/vtrd.php';
	}

	public function arCentral(){		
		Utils::useraccess('radica/arCentral',$_SESSION['pefid']);
		$radica = new radica();
		date_default_timezone_set('America/Bogota');

		// var_dump($_SESSION['pefid']);
		// die();

		if ($_SESSION['pefid']==9){
			$ano_actual = date("Y");
			$arcentral = $radica->getar2($ano_actual,$_SESSION['depid']);
		}else{
			$arcentral = $radica->getar2b($_SESSION['depid']);
		}



		
		// $arcentrald = $radica->getar3();


		require_once 'views/vArCentral.php';
	}

	public function arHistorico(){		
		Utils::useraccess('radica/arHistorico',$_SESSION['pefid']);
		$radica = new radica();
		date_default_timezone_set('America/Bogota');
		$ano = isset($_POST['ano']) ? $_POST['ano']:date("Y");
		$tipo = "Recibidos";

		$fecin = isset($_POST['fecin']) ? $_POST['fecin']:date("Y-m-")."01";
		$fecfi = isset($_POST['fecfi']) ? $_POST['fecfi']:date("Y-m-d");

		$getPef = $radica->getPef($_SESSION['pefid']);
		$radicas = $radica->getAll($fecin, $fecfi);


		//COMPARTIDOS
		$email=$_SESSION['peremail'];
		$compartidos = $radica->getarCompartidos($email);

		//COMPARTIDOS JURIDICA
		$depid = $_SESSION['depid'];
		$compjuridica = $radica->seltrdExpCompJuri($depid);

		require_once 'views/vHistorico.php';
	}
	
	public function expedientes(){		
		Utils::useraccess('radica/expedientes',$_SESSION['pefid']);
		$radica = new radica();

		if (isset($_GET['save'])) {
			// var_dump($_GET['save']);
			// die();
			$anoexp = isset($_POST['anoexp']) ? $_POST['anoexp'] : NULL;
			$subserie = isset($_POST['doctrd']) ? $_POST['doctrd'] : NULL;
			$actexp = isset($_POST['actexp']) ? $_POST['actexp'] : NULL;
			
			$idexp=$anoexp.$subserie;
			// var_dump($anoexp);
			// die();

			$radica->insExp($idexp,$anoexp,$subserie,$actexp);
		}
		date_default_timezone_set('America/Bogota');
		$result = $radica->selpag2();
		$dttipd = $radica->seltrd();
		require_once 'views/vExpedientes.php';
	}

	public function misExpedientes(){		
		Utils::useraccess('radica/misExpedientes',$_SESSION['pefid']);
		$radica = new radica();
		date_default_timezone_set('America/Bogota');
		$result = $radica->selpag2();
	}

	public function procesos(){		
		Utils::useraccess('radica/procesos',$_SESSION['pefid']);
		$mtac = new radica();
		date_default_timezone_set('America/Bogota');
		$dttipd = $mtac->seldeppro();
		$dtseltrd = $mtac->seltrd();
		$result = $mtac->selpag();
		require_once 'views/vProcesos.php';
	}

	public function gestion(){		
		Utils::useraccess('radica/gestion',$_SESSION['pefid']);
		$radica = new radica();
		date_default_timezone_set('America/Bogota');
		$tiparc="Gestion";
		$result = $radica->selpag3($tiparc);
		require_once 'views/vArGestion.php';
	}

	public function reten(){		
		Utils::useraccess('radica/reten',$_SESSION['pefid']);		
		$radica = new radica();
		date_default_timezone_set('America/Bogota');
		$dat = $radica->carReten();
		require_once 'views/vReten.php';
	}

	public function gesdoc(){		
		Utils::useraccess('radica/expedientes',$_SESSION['pefid']);
		$radica = new radica();

		if (isset($_GET['save'])) {
			// var_dump($_GET['save']);
			// die();
			$anoexp = isset($_POST['anoexp']) ? $_POST['anoexp'] : NULL;
			$subserie = isset($_POST['doctrd']) ? $_POST['doctrd'] : NULL;
			$actexp = isset($_POST['actexp']) ? $_POST['actexp'] : NULL;
			
			$idexp=$anoexp.$subserie;
			// var_dump($anoexp);
			// die();

			$radica->insExp($idexp,$anoexp,$subserie,$actexp);
		}
		
		date_default_timezone_set('America/Bogota');		
		$result = $radica->selpag2();
		$dttipd = $radica->seltrd();
		//require_once 'views/vExpedientes.php';
		require_once 'views/vGesdoc.php';
	}

	public function series(){	
		Utils::useraccess('radica/trd',$_SESSION['pefid']);
		$depid = $_SESSION['depid'];	
		$perid = $_SESSION['perid'];

		// var_dump($_GET);
		// die();


		$radica = new radica();	
		$perfil = $radica->getPerfil($perid);
		$depidnom = $radica->getDepidNom($depid);
		$asigarea = $radica->getAreasJ();
		$j=0; 

		for ($i=0; $i < count($perfil) ; $i++) { 
			if (in_array("9", $perfil[$i])) {
			   $j=1;
			}
		}	


		if (isset($_GET['seri'])) {
				// var_dump($_GET['seri']);
				// die();
			date_default_timezone_set('America/Bogota');						
			
			$_SESSION['descrip']=$_GET['descrip'];				
			$cont=strlen($_GET['seri']);
			$serie=	$_GET['seri'];	
			// var_dump($cont);
			// die();

			//BUSCA SUB SERIES

			if ($cont<=3) { 
				$result = $radica->selpag2();
				// $descrip= $_GET['descrip'];	
					
				if ($j>0) {
					$descrip= $_GET['descrip'];						
				}else{
					$descrip= $depidnom[0]['valnom'];
				}	
				$dttipd = $radica->seltrd2Sub($_GET['seri'],$depid,$j);				
				$btnAgregar = "Nueva Seríe";
				$coltabla = "SERÍE";
				$btn=1;
			}


			if ($cont==5) {
				$nomasserie=$radica->nomasSerie($_GET['seri']);
				//var_dump (count($nomasserie));
				if(count($nomasserie)>0){
					$result = $radica->selpag2();
					$descrip= $_GET['descrip1']." ".">"." ".$_GET['descrip'];		
					$dttipd = $radica->seltrd3Sub($_GET['seri'],$depid,$j);
					$btnAgregar = "Nueva Sub-seríe";
					$coltabla = "SUB-SERÍE";
					$btn=1;

				}else{

					$result = $radica->selpag2();
					$descrip= $_GET['descrip1']." ".">"." ".$_GET['descrip'];		
					$dttipd = $radica->seltrd4Sub($_GET['seri'],$depid,$j);
					$btn=1;
					$year = date("Y");	


					if ((count($dttipd))>0) {
						$btnAgregar = "Nueva Sub-seríe";
						$coltabla = "SUB-SERÍE";
					}else{	
						if(isset($_SESSION['expediente'],$_GET['carga'])){	
							if($_GET['carga']==2){
								if (!isset($_GET['carpeta'])) {
									$btnAgregar = "Carpeta";
									$coltabla = "CARPETA";
									$j=1;
									$tipodoc = $radica->tipodoc($_GET['seri']);
									$dttipd = $radica->getCarpeta($_GET['id']);
									//unset($_SESSION['expediente']);
									$carpeta=1;
									if($_GET['id']){
										$idexp=$_GET['id'];
										$depidexp=$_GET['depidexp'];
									}
								}				
							}
								
							if(isset($_GET['carpeta'])){
								if ($_GET['carpeta']==1) {
									$btnAgregar = "Agregar documento(s)";
									$coltabla = "DOCUMENTO(s)";
									$j=1;
									$tipodoc = $radica->tipodoc($_GET['seri']);
									$carpeta=0;
									unset($_SESSION['expediente']);
								}
								
							}						
							
							
						}else{						

							if(isset($_GET['carpeta'])){

								if ($_GET['carpeta']==1) {
									$btnAgregar = "Agregar documento(s)";
									$coltabla = "DOCUMENTO(s)";
									$j=1;
									$tipodoc = $radica->tipodoc($_GET['seri']);
									$carpeta=0;
									$carpid=$_GET['id'];
									unset($_SESSION['expediente']);
								
									
								}else{
									$btnAgregar = "Agregar Expediente";
									$coltabla = "EXPEDIENTE";
									$j=1;
									$tipodoc = $radica->tipodoc($_GET['seri']);
									$dttipdEXP = $radica->seltrdExp($_GET['seri'],$depid);									
									$ExpJurid = $radica->seltrdExpCompJuri($depid);
									$_SESSION['expediente']=1;
								}
							}else{ //para cuando atras, muestre carpeta 

								$btnAgregar = "Carpeta";
								$coltabla = "CARPETA";
								$j=1;
								//var_dump($_GET);
								//die();
								$tipodoc = $radica->tipodoc($_GET['seri']);
								$dttipd = $radica->getCarpeta($_GET['id']);
								//unset($_SESSION['expediente']);
								$carpeta=1;
								if($_GET['id']){
									$idexp=$_GET['id'];
									$depidexp=$_GET['depidexp'];
								}
							}
							
						}
						
					}
					

				}			

			}//cierra if == 5


			if ($cont>=7) {
				$result = $radica->selpag2();
				$descrip= $_GET['descrip1']." ".">"." ".$_GET['descrip'];		
				$dttipd = $radica->seltrd4Sub($_GET['seri'],$depid,$j);
				$btn=1;
				$year = date("Y");	


				if ((count($dttipd))>0) {
					$btnAgregar = "Nueva Sub-seríe";
					$coltabla = "SUB-SERÍE";
				}else{	
					if(isset($_SESSION['expediente'],$_GET['carga'])){	
						if($_GET['carga']==2){
							if (!isset($_GET['carpeta'])) {
								$btnAgregar = "Carpeta";
								$coltabla = "CARPETA";
								$j=1;
								$tipodoc = $radica->tipodoc($_GET['seri']);
								$dttipd = $radica->getCarpeta($_GET['id']);
								//unset($_SESSION['expediente']);
								$carpeta=1;
								if($_GET['id']){
									$idexp=$_GET['id'];
									$depidexp=$_GET['depidexp'];
								}
							}				
						}
							
						if(isset($_GET['carpeta'])){
							if ($_GET['carpeta']==1) {
								$btnAgregar = "Agregar documento(s)";
								$coltabla = "DOCUMENTO(s)";
								$j=1;
								$tipodoc = $radica->tipodoc($_GET['seri']);
								$carpeta=0;
								unset($_SESSION['expediente']);
							}
							
						}						
						
						
					}else{						

						if(isset($_GET['carpeta'])){

							if ($_GET['carpeta']==1) {
								$btnAgregar = "Agregar documento(s)";
								$coltabla = "DOCUMENTO(s)";
								$j=1;
								$tipodoc = $radica->tipodoc($_GET['seri']);
								$carpeta=0;
								$carpid=$_GET['id'];
								unset($_SESSION['expediente']);
							
								
							}else{
								$btnAgregar = "Agregar Expediente";
								$coltabla = "EXPEDIENTE";
								$j=1;
								$tipodoc = $radica->tipodoc($_GET['seri']);
								$dttipdEXP = $radica->seltrdExp($_GET['seri'],$depid);								
								$ExpJurid = $radica->seltrdExpCompJuri($depid);
								$_SESSION['expediente']=1;
							}
						}else{ //para cuando atras, muestre carpeta 

							$btnAgregar = "Carpeta";
							$coltabla = "CARPETA";
							$j=1;
							//var_dump($_GET);
							//die();
							$tipodoc = $radica->tipodoc($_GET['seri']);
							$dttipd = $radica->getCarpeta($_GET['id']);
							//unset($_SESSION['expediente']);
							$carpeta=1;
							if($_GET['id']){
								$idexp=$_GET['id'];
								$depidexp=$_GET['depidexp'];
							}
						}
						
					}
					
				}				
			}
			
		}else{
			//CARGA PRIMERAS SERIES			
			date_default_timezone_set('America/Bogota');
			// var_dump($j);
			// die();
			$result = $radica->selpag2();
			if ($j==1) {				
				$dttipd = $radica->seltrd2();
				// var_dump($dttipd);
				// die();
			}else{
				$dttipd = $radica->seltrd3($depid);
			}
			
			$areas3=$radica->getAreas();
			$btnAgregar = "Nueva Dependecia";
			$coltabla = "DEPENDENCIA";
			$btn=1;
			
		}	
		
		require_once 'views/vSeries.php';
	}

	public function saveSerie(){		
		//Utils::useraccess('radica/expedientes',$_SESSION['pefid']);		
		//require_once 'views/vSeries.php';
	}

	public function compartir(){		
		//Utils::useraccess('radica/expedientes',$_SESSION['pefid']);		
		//require_once 'views/vSeries.php';
		$seriedoc = isset($_GET['seriedoc']) ? $_GET['seriedoc']:false;
		$depid = isset($_GET['depid']) ? $_GET['depid']:false;
		$valnom = isset($_GET['valnom']) ? $_GET['valnom']:false;
		$destrd = isset($_GET['destrd']) ? $_GET['destrd']:false;
		$fechaexp = isset($_GET['fechaexp']) ? $_GET['fechaexp']:false;

		
		require_once 'views/vCompartirdoc.php';
	}

	public function compartir2(){

		// var_dump($_POST);
		// die();		
		
		$seriedoc = isset($_POST['seriedoc']) ? $_POST['seriedoc']:false;
		$depid = isset($_POST['depid']) ? $_POST['depid']:false;
		$correo_dest = isset($_POST['correo']) ? $_POST['correo']:false;
		$destrd = isset($_POST['destrd']) ? $_POST['destrd']:false;
		$peridaut = $_SESSION['perid'];
		$fechaexp = isset($_POST['fechaexp']) ? $_POST['fechaexp']:false;
		$perid=$_SESSION['perid'];

		$radica = new radica();	
		$save = $radica->saveDrive($seriedoc,$depid,$correo_dest,$peridaut,$fechaexp,$perid);	


		//require_once 'controllers/vArCentral.php';
		header('Location:'.base_url.'radica/arCentral');
	}

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
			$datasi = $radica->resp($norad);
			$personPlan = $radica->personPlanta();
			$person = $radica->personAll();
			$muni = $radica->getDepto();
			$esta = $radica->estarad();
			$docume = $radica->getDoc($norad);

			$datrad = $radica->getOne();
			$t2 = $datrad[0]["tiprad"];
			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/resp.php';
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
			

// echo $norad."-".$fecres."-".$perid."-".$idpro."-".$idflu."-".$leido."-".$obsres."-".$estrad."<br>";
// die();

			$radica = new radica();

			if($norad && $obsres && $estrad){
				$radica->setNorad($norad);
				$radica->setFecres($fecres);
				$radica->setPerid($perid);
				$radica->setIdpro($idpro);
				$radica->setIdflu($idflu);
				$radica->setLeido($leido);
				$radica->setObsres($obsres);
				$radica->setEstrad($estrad);

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

	public function auditdoc(){
		//Utils::useraccess('radica/index',$_SESSION['pefid']);
		
		$radica = new radica();
		$trazadoc = $radica->trazadocg($_GET['seriedoc']);
		// var_dump($trazadoc);
		// die();

		require_once 'views/vAuditadoc.php';
		
	}

	public function roles(){
		//Utils::useraccess('radica/index',$_SESSION['pefid']);
		$radica = new radica();

		$users = $radica->getRoles();
		require_once 'views/vRoles.php';
		
	}

	public function inventario(){
		//Utils::useraccess('radica/index',$_SESSION['pefid']);		
		$radica = new radica();

		$yearInv = $radica->getYearInv();
		$asigarea = $radica->getAreasJ();
		require_once 'views/vInventario.php';
		
	}

	public function webservice(){
		//Utils::useraccess('radica/index',$_SESSION['pefid']);
		$radica = new radica();

		$yearInv = $radica->getYearInv();
		require_once 'views/vWebser.php';
		
	}

	public function webregpeticion(){
		//Utils::useraccess('radica/index',$_SESSION['pefid']);
		$radica = new radica();

		$yearInv = $radica->getYearInv();
		require_once 'views/vWsRegPet.php';
		
	}

	public function masivo(){
		//Utils::useraccess('radica/index',$_SESSION['pefid']);
		$radica = new radica();

		$yearInv = $radica->getYearInv();
		require_once 'views/vCargam.php';
		
	}

	public function subirTrd(){
		//var_dump('expression');

		require_once '../../PHPExcel/Classes/PHPExcel.php';

		date_default_timezone_set('America/Bogota');
   		$fecSis = date("Y-m-d H:i:s");
   		// $masi = new Masi();
   		$cexcel = new radica();

   		$html = NULL;
////////////////////// Cargar archivos Inicio /////////////////////////////
   		$arcexc = isset($_FILES['arcexc']["name"]) ? $_FILES['arcexc']["name"]:NULL;
   		$arczip = isset($_FILES['arczip']["name"]) ? $_FILES['arczip']["name"]:NULL;

   		if($arcexc){   			
			$arcexc2 = Utils::opti($_FILES['arcexc'], date('YmdHis'),"zip","excel");
			// var_dump($arcexc2);
			// die();
		}
		if($arczip){
			$arczip2 = Utils::opti($_FILES['arczip'], date('YmdHis'), "zip","RP");
		}

		////////////////////// Lee el excel, compara datos, inserta INICIO /////////////////////////////

		$arcexc2=path_file.$arcexc2;
		//var_dump($arcexc2);


		$inputFileType = PHPExcel_IOFactory::identify($arcexc2);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);

		$objPHPExcel = $objReader->load($arcexc2);
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();

		$html .= "<br><br>";
		
		$html2 = NULL;
		$html3 = NULL;
		$ae = 0;
		$ane = 0;
		$dr = 0;
		for ($row = 3; $row <= $highestRow; $row++){
			$depen = $sheet->getCell("a".$row)->getValue();
			$deptrd = $sheet->getCell("b".$row)->getValue();
			$doctrd = $sheet->getCell("c".$row)->getValue();
			$destrd = $sheet->getCell("d".$row)->getValue();
			// $destrd_espacios=$objeto = $sheet->getCell("d".$row)->getValue();				
			// $destrd = preg_replace('/[\r\n]+/', " ", $$destrd_espacios);			
			$agentrd = $sheet->getCell("g".$row)->getValue();
			if ($agentrd>0) {
				
			}else{
				$agentrd=0;
			}


			$acentrd = $sheet->getCell("h".$row)->getValue();
			if ($acentrd>0) {
				
			}else{
				$acentrd=0;
			}
			$area = $sheet->getCell("n".$row)->getValue();

			//aquiiiiiiiiiiiii

			

			$cexcel->saveSeriesMasivo($depen,$deptrd,$doctrd,$destrd,$agentrd,$acentrd,$area);


			// var_dump($sheet->getCell("J".$row));
		}//CIERRA FOR
		//$html .= "<strong>Archivos encontrados:</strong> ";
		//echo mb_convert_encoding($html, 'UTF-16LE', 'UTF-8');
		
////////////////////// Lee el excel, compara datos, inserta FIN /////////////////////////////
		//die();

		require_once 'views/vCargam.php';
	}



	



	//WEB SERVICE--------------------------
	//-------------------------------------
	
	public function webconsultapet(){
		//Utils::useraccess('radica/index',$_SESSION['pefid']);
		$radica = new radica();

		$yearInv = $radica->getYearInv();
		require_once 'views/vWebconsulpet.php';
		
	}

	

	

}