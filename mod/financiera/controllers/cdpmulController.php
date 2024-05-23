<?php 
include'models/paa.php';
include'models/pfinan.php';
include'models/rubro.php';
include'models/valfin.php';
include'models/newpaa.php';
include'models/antproy.php';

class cdpmulController{

	public function index(){
		Utils::useraccess('paa/index',$_SESSION['pefid']);

		if (isset($_GET['valid'])) {
			// var_dump($_GET['valid']);
			// die();
			$del = new Pfinan();
			$del->delPmcdp($_GET['valid']);

		}

		if (isset($_POST['btcrear'])) {	
			$nomplant = isset($_POST['nomnuevo']) ? $_POST['nomnuevo']:NULL;
			$_SESSION['nomplant']=0;
			$selrub1 = isset($_POST['rub']) ? $_POST['rub']:NULL;
			// $selrub = explode(";",$selrub1[0]);
			// var_dump($selrub[0]);
			// die();
			$iddpas = isset($_POST['iddpa']) ? $_POST['iddpa']:NULL;					
		}

		$ari = isset($_POST['areas']) ? $_POST['areas']:NULL;
		$pfinan = new Pfinan();
		$vig = $pfinan->vigact();
		$tot = isset($_GET['tot']) ? $_GET['tot']:NULL;
		$dpd = $_SESSION['depid'];

		// if($tot==1012) $dpd = 1012;
		$dpd = 1012;

		$areas = $this->dparea($dpd);
		$areas = $dpd.",".$areas;
		$areas = substr($areas,0,strlen($areas)-1);
		$areas2 = $pfinan->depareas($areas);		

		// var_dump($vig[0]['idpaa']);
		// die();

		//$dpie = $pfinan->selgrPie();
		$dxyc = $pfinan->selgrChartxy($vig[0]['idpaa'],$areas);

		$pfinan->setIdpaa($vig[0]['idpaa']);
	
		//$area = isset($_POST['areas']) ? $_POST['areas']:null;	
		
		if (isset($_POST['areas'])) {
			$area = $_POST['areas'];
			// var_dump($area);
			// die();
			$_SESSION['area']=$area;
			$pfinan->setArea($area);

			$subareas = $pfinan->getSubAreas();
			$conta=count($subareas);			
		
		}else{
			//$_SESSION['area'] = 1012;
			$area = $_SESSION['depid'];
		}

		if($ari) $areas = $ari;
			
		$pfinand = $pfinan->getAll2($areas);

		$sumasi = 0;
		$sumdis = 0;
		$sumcdp = 0;
		$sumrp = 0;
			
		
		//AREAS
		$areasutil=Utils::areasu($vig[0]['idpaa']);
		$_SESSION['vigP']=$vig[0]['idpaa'];
				
		$rubro = new Rubro();		
		$num = $rubro->getNum();
		$ninipaa = $num[0]['ninipaa'];

		
		$editpf = new Antproy();
		$editp=0;
		$ediAnte=0;
		$rubrosPf=$editpf->getRub($editp);
		
		$valfinD = new Valfin();

		$valfinD->setDofid(1);
		$estados = $valfinD->getValdom();

		$valfinD->setDofid(2);
		$objetivos = $valfinD->getValdom();

		$valfinD->setDofid(3);
		$iniciativas = $valfinD->getValdom();

		$valfinD->setDofid(4);
		$proyectos = $valfinD->getValdom();

		$valfinD->setDofid(5);
		$tipocontra = $valfinD->getValdom();

		$valfinD->setDofid(6);
		$fuentes = $valfinD->getValdom();

		$resposable = new Pfinan();

		if (isset($selrub1)) {
			// die();
			$nnum = $resposable->getNnum();
			$nnum = $nnum[0]['maxi']+1;
			// var_dump(count($selrub1));
			// die();

			// $selrub = explode(";",$selrub1[0]);
			// var_dump($selrub[0]);
			// die();
			
			// $comnom = $resposable->getConNom($nomplant,23);//comprueba nombre
			// // var_dump($comnom);
			// // // die();
			// if (!$comnom) {
			// 	$insNPCdp=$resposable->insNPCdp($nomplant,$nnum,23);//nombre nueva plantilla cdp
			// 	// var_dump($insNPCdp);
			// 	// die();

			// 	for ($i=0;$i<count($selrub1);$i++){ 
			// 		$selrub = explode(";",$selrub1[$i]);
			// 		$resposable->insRubsPCdp($selrub[1],$nnum);					
			// 	}
			// }
			
		}

		$ordg = $resposable->ordenadorgas();

		$mcd = $resposable->getPmcdpAll($_SESSION['vig']);
		// var_dump(count($mcd));
		// die();

		for ($i=0;$i<count($mcd);$i++){ 
			$mcdt[$i] = $resposable->getPmcdp($mcd[$i]['valid'],$_SESSION['vig']);	
			//${'pfinandOne'.$i} = $pfinan->getOne();					
		}

		// var_dump(($mcdt));
		// die();



		$vig = $resposable->vigact();
		$dpd = 1027;
		//$areas = $this->dparea($dpd);

		$resposable->setIdpaa($vig[0]['idpaa']);		
		$dxyc = $pfinan->selgrChartxy($vig[0]['idpaa'],$dpd);


		if(isset($_GET['new'])){
			$_SESSION['inspaa']=true;			
		}

		$selrub1=null;

		require_once 'views/cdpmul.php';
	}


	public function saveMC(){
		//Utils::useraccess('paa/index',$_SESSION['pefid']);

		if (isset($_GET['valid'])) {
			// var_dump($_GET['valid']);
			// die();
			$del = new Pfinan();
			$del->delPmcdp($_GET['valid']);

		}

		if (isset($_POST['btcrear'])) {	
			$nomplant = isset($_POST['nomnuevo']) ? $_POST['nomnuevo']:NULL;
			$_SESSION['nomplant']=0;
			$selrub1 = isset($_POST['rub']) ? $_POST['rub']:NULL;
			// $selrub = explode(";",$selrub1[0]);
			// var_dump($selrub[0]);
			// die();
			$iddpas = isset($_POST['iddpa']) ? $_POST['iddpa']:NULL;					
		}

		$ari = isset($_POST['areas']) ? $_POST['areas']:NULL;
		$pfinan = new Pfinan();
		$vig = $pfinan->vigact();
		$tot = isset($_GET['tot']) ? $_GET['tot']:NULL;
		$dpd = $_SESSION['depid'];

		// if($tot==1012) $dpd = 1012;
		$dpd = 1012;

		$areas = $this->dparea($dpd);
		$areas = $dpd.",".$areas;
		$areas = substr($areas,0,strlen($areas)-1);
		$areas2 = $pfinan->depareas($areas);		

		//$dpie = $pfinan->selgrPie();
		$dxyc = $pfinan->selgrChartxy($vig[0]['idpaa'],$areas);

		$pfinan->setIdpaa($vig[0]['idpaa']);
	
		//$area = isset($_POST['areas']) ? $_POST['areas']:null;	
		
		if (isset($_POST['areas'])) {
			$area = $_POST['areas'];
			// var_dump($area);
			// die();
			$_SESSION['area']=$area;
			$pfinan->setArea($area);

			$subareas = $pfinan->getSubAreas();
			$conta=count($subareas);			
		
		}else{
			//$_SESSION['area'] = 1012;
			$area = $_SESSION['depid'];
		}

		if($ari) $areas = $ari;
			
		$pfinand = $pfinan->getAll2($areas);

		$sumasi = 0;
		$sumdis = 0;
		$sumcdp = 0;
		$sumrp = 0;
			
		
		//AREAS
		$areasutil=Utils::areasu($vig[0]['idpaa']);
		$_SESSION['vigP']=$vig[0]['idpaa'];
				
		$rubro = new Rubro();		
		$num = $rubro->getNum();
		$ninipaa = $num[0]['ninipaa'];

		
		$editpf = new Antproy();
		$editp=0;
		$ediAnte=0;
		$rubrosPf=$editpf->getRub($editp);
		
		$valfinD = new Valfin();

		$valfinD->setDofid(1);
		$estados = $valfinD->getValdom();

		$valfinD->setDofid(2);
		$objetivos = $valfinD->getValdom();

		$valfinD->setDofid(3);
		$iniciativas = $valfinD->getValdom();

		$valfinD->setDofid(4);
		$proyectos = $valfinD->getValdom();

		$valfinD->setDofid(5);
		$tipocontra = $valfinD->getValdom();

		$valfinD->setDofid(6);
		$fuentes = $valfinD->getValdom();

		$resposable = new Pfinan();

		if (isset($selrub1)) {
			// die();
			$nnum = $resposable->getNnum();
			$nnum = $nnum[0]['maxi']+1;
			// var_dump(count($selrub1));
			// die();

			// $selrub = explode(";",$selrub1[0]);
			// var_dump($selrub[0]);
			// die();
			
			//$comnom = $resposable->getConNom($nomplant,23);//comprueba nombre
			// var_dump($comnom);
			// // die();
			//if (!$comnom) {

			$insNPCdp=$resposable->insNPCdp($nomplant,$nnum,23,$_SESSION['vig']);//nombre nueva plantilla cdp
			// var_dump($insNPCdp);
			// die();

			for ($i=0;$i<count($selrub1);$i++){ 
				$selrub = explode(";",$selrub1[$i]);
				$resposable->insRubsPCdp($selrub[1],$nnum);					
			}
			//}
			
		}

		$ordg = $resposable->ordenadorgas();

		$mcd = $resposable->getPmcdpAll($_SESSION['vig']);
		// var_dump(count($mcd));
		// die();

		for ($i=0;$i<count($mcd);$i++){ 
			$mcdt[$i] = $resposable->getPmcdp($mcd[$i]['valid'],$_SESSION['vig']);						
		}

		// var_dump(($mcdt));
		// die();



		$vig = $resposable->vigact();
		$dpd = 1027;
		//$areas = $this->dparea($dpd);

		$resposable->setIdpaa($vig[0]['idpaa']);		
		$dxyc = $pfinan->selgrChartxy($vig[0]['idpaa'],$dpd);


		if(isset($_GET['new'])){
			$_SESSION['inspaa']=true;			
		}

		$selrub1=null;

		require_once 'views/cdpmul.php';
	}


	function dparea($depid){
		$txt = '';
		$pfinan = new Pfinan();
		$area = $pfinan->deparea($depid);
		foreach($area AS $ar){
				$txt .= $ar['valid'].",";
				$txt .= $this->dparea($ar['valid']);
		}
		return $txt;
	}

	public function getRubmc(){
		Utils::useraccess('paa/index',$_SESSION['pefid']);

		$pfinan = new Pfinan();
		$vig = $pfinan->vigact();
		// $dpie = $pfinan->selgrPie();
		//$dxyc = $pfinan->selgrChartxy($vig[0]['idpaa']);

		$dpd = 1027;
		$areas = $this->dparea($dpd);

		// var_dump($areas);
		// die();

		$pfinan->setIdpaa($vig[0]['idpaa']);
		$dxyc = $pfinan->selgrChartxy($vig[0]['idpaa'],$dpd);		

		$_SESSION['apro']=null;
				
		if (isset($_POST['r'])) {
			$codrub1 = $_POST['r'];
			$iddpa= $_POST['iddpa'];
			$valid= $_POST['valid'];
			// var_dump($iddpa);
			// die();
			$_SESSION['iddpa']=$iddpa;
			$area = $_SESSION['depid'];

			// var_dump($area);
			// die();
			//$p = isset($_POST["p"]) ? $_POST["p"]:NULL;


			$pfinan->setArea($area);
			$pfinan->setCodrub($codrub1);
			//$pfinan->setIddpa($iddpa);
			//$dpie = $pfinan->selgrPie();

			$dxyc = $pfinan->selgrChartxy($vig[0]['idpaa'], $area);

			$subareas = $pfinan->getSubAreas();
			$conta=count($subareas);		
		
		}	

		$pfinand = $pfinan->getAll2($area);	

		// var_dump(count($codrub));
		// die();

		for ($i=0;$i<count($codrub1);$i++){ 
			
			//$codrub = explode(";",$codrub1[$i]);
			// var_dump(($codrub1[$i]));
			// die();
			$pfinan->setCodrub($codrub1[$i]);
			$pfinan->setIddpa($iddpa[$i]);

			${'pfinandOne'.$i} = $pfinan->getOne();

			//$resposable->insRubsPCdp($selrub[1],$nnum);	
			//$mcdt[$i] = $resposable->getPmcdp($mcd[$i]['valid']);						
		}
		// var_dump($pfinandOne2);
		// die();

		//$pfinandOne = $pfinan->getOne();
		
		//$cuota = $pfinan->getCuota($iddpa);

		$valfinD = new Valfin();

		$valfinD->setDofid(1);
		$estados = $valfinD->getValdom();

		$valfinD->setDofid(2);
		$objetivos = $valfinD->getValdom();

		$valfinD->setDofid(3);
		$iniciativas = $valfinD->getValdom();

		$valfinD->setDofid(4);
		$proyectos = $valfinD->getValdom();

		$valfinD->setDofid(5);
		$tipocontra = $valfinD->getValdom();

		$valfinD->setDofid(6);
		$fuentes = $valfinD->getValdom();

		$valfinD->setDofid(8);		
		$futic = $valfinD->getValdom();			
		
		$areas = $pfinan->getAreas();
		$areas2 = $pfinan->getAreas();

		
		$pfvig = $pfinan->getVig();
		$rubro = new Rubro();

		$rubro = new Rubro();		
		$num = $rubro->getNum();
		$ninipaa = $num[0]['ninipaa'];

		$areas = $this->dparea($_SESSION['depid']);
		$areas = $_SESSION['depid'].",".$areas;
		$areas = substr($areas,0,strlen($areas)-1);

		$ordgas = $pfinan->responsables();
		$ordgas2 = $pfinan->responsables2();

		$pcdp = $pfinan->pcdp();		
				
		if (isset($_GET['soli'])) {
			// var_dump($_GET['soli']);
			// 	die();
			if ($_GET['soli']==true) {					
				Utils::useraccess('cdp/solicitud',$_SESSION['pefid']);
				$solicitud=true;
				$estado=false;
				$aprobacion=false;
				$historial=false;

				$pfinan = new Newpaa();
				$pfvig = $pfinan->getVig();
				
				require_once 'views/cdp.php';
			}
		}else{
			$solicitud=true;
			require_once 'views/solmcdp.php';

		}		
		
	}

	public function solimcdp(){
		// var_dump($_POST);
		// 	die();
		if(isset($_POST)){
			$p = isset($_POST["p"]) ? $_POST["p"]:NULL;
			$pagoman = isset($_POST['pagoman']) ? $_POST['pagoman'] : false;
				
			$iddpa1 = isset($_POST['iddpa']) ? $_POST['iddpa'] : false;
			// var_dump($iddpa1);
			// die();
			$idpaa = isset($_POST['idpaa']) ? $_POST['idpaa'] : false;
			$valid = $_POST['valid'];
			// var_dump($valid );
			// die();
			// $area = isset($_POST['are']) ? $_POST['are'] : false;
			$area=1027;
			
			$codUNSPSC = isset($_POST['codUNSPSC']) ? $_POST['codUNSPSC'] : false;
			$rubroPre = isset($_POST['rubroPre']) ? $_POST['rubroPre'] : null;
			$nombreRubro = isset($_POST['nombreRubro']) ? $_POST['nombreRubro'] : null;
			$objeto = isset($_POST['objeto']) ? $_POST['objeto'] : false;
			$nomcont = isset($_POST['nomcont']) ? $_POST['nomcont'] : false;
			// $objdpa = isset($_POST['objdpa']) ? $_POST['objdpa'] : false;
			$objdpa = 36;

			$inidpa = isset($_POST['inidpa']) ? $_POST['inidpa'] : null;
			$prodpa = isset($_POST['prodpa']) ? $_POST['prodpa'] : null;
			$fechaInicio = isset($_POST['fechaInicio']) ? $_POST['fechaInicio'] : false;
			$fechaEstimada = isset($_POST['fechaEstimada']) ? $_POST['fechaEstimada'] : false;
			$duracion = isset($_POST['duracion']) ? $_POST['duracion'] : false;
			$duracion2 = isset($_POST['duracion2']) ? $_POST['duracion2'] : false;
					
			$ftefindpa = isset($_POST['ftefindpa']) ? $_POST['ftefindpa'] : false;
			$futic = isset($_POST['futic']) ? $_POST['futic'] : false;
			// var_dump($futic);
			// die();
			$valorAsignado = isset($_POST['valorAsignado']) ? $_POST['valorAsignado'] : false;
			$valorVigencia = isset($_POST['valorVigencia']) ? $_POST['valorVigencia'] : false;
			// var_dump($valorVigencia);
			// die();
			$vigenciaF = isset($_POST['vigenciaF']) ? $_POST['vigenciaF'] : 'NO';
			$duracion = isset($_POST['duracion']) ? $_POST['duracion'] : false;
			$primerm = isset($_POST['primerm']) ? $_POST['primerm'] : false;
			$ultimom = isset($_POST['ultimom']) ? $_POST['ultimom'] : false;
			$valormensual = isset($_POST['valormensual']) ? $_POST['valormensual'] : false;
			$tipcondpa = isset($_POST['tipcondpa']) ? $_POST['tipcondpa'] : null;
			$ftefindpa = isset($_POST['ftefindpa']) ? $_POST['ftefindpa'] : false;
			// var_dump($ftefindpa);
			// die();
			$observa = isset($_POST['observa']) ? $_POST['observa'] : false;
			$cpc = isset($_POST['cpc']) ? $_POST['cpc'] : NULL;

			$unicontra = isset($_POST['unicontra']) ? $_POST['unicontra'] : false;
			$ubicacion = isset($_POST['ubicacion']) ? $_POST['ubicacion'] : false;
			$nombreR = isset($_POST['nombreR']) ? $_POST['nombreR'] : false;
			$norgas = isset($_POST['norgas']) ? $_POST['norgas'] : false;
			$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
			$email = isset($_POST['email']) ? $_POST['email'] : false;

			$idpro = isset($_POST['idpro']) ? $_POST['idpro'] : false;
			$elidp = 1;
			
			// $rubroPre = substr($rubroPre,0);
			$soli="NO";

			date_default_timezone_set('America/Bogota');
   			$fec = date("Y-m-d H:i:s");

			$solcdp= new pfinan();	

			// var_dump(count($iddpa1));
			// die();

			//NUMERO DE PROCESO CONTRACTUAL			


				$sigla=$solcdp->sigla($area);

				// var_dump($sigla);
				// die();


				if ($sigla) {					
				
					$numpc=$sigla[0]['abr'].($sigla[0]['Mncon']);
					$nnpc=$sigla[0]['Mncon']+1;

					$obs= $numpc.' '.$objeto;		

					$solcdp->setNcdppc($numpc);
					$solcdp->setFecsol($fec);
					$solcdp->setNObjeto($obs);
					
					// var_dump($obs);
					// die()

					$solcdp->setNcon($nnpc);
					$actNpc=$solcdp->actNcon($area,$nnpc,$sigla[0]['abr']);	//Actualizar consecutivo


					//FLUJO aprob

					//$pre= $sigla[0]['pre'];
					$pre=$idpro;
					// var_dump($pre);
					// die();	

					$nsig=	$solcdp->getVFlujo($pre);				
					$solcdp->setIdflu($nsig[0]['mini']+1);
					$idflujo=$nsig[0]['mini']+1;						

					$solcdp->setIdpro($pre);		
					
				}

			$valortotal=0;

			$idmcdp = $solcdp->getIdmcdps();				
			$idmcdp=$idmcdp[0]['maxi']+1;

			// var_dump($idmcdp);
			// die();

			for ($i=0;$i<count($iddpa1);$i++){ 
			
				//$codrub = explode(";",$codrub1[$i]);
				// var_dump(($codrub1[$i]));
				// die();
				

				// $solcdp->setIddpa($iddpa1[$i]);
				$solcdp->setIdpaa($idpaa);
				$solcdp->setIddpa($iddpa1[$i]);
				// var_dump($iddpa1[$i]);
				// die();
				$solcdp->setNicod(0);				
				$solcdp->setNomcont($nomcont);
				// var_dump($area);
				// die();
				$solcdp->setArea($area);
				$solcdp->setCodrub(substr($rubroPre[$i], 1));
				$solcdp->setObjdpa($objdpa);			
				$solcdp->setInidpa($inidpa);
				$solcdp->setProdpa($prodpa);	
				$solcdp->setUnspsc($codUNSPSC);					
				$solcdp->setFecinidpa($fechaInicio);
				$solcdp->setValid($valid);



				//${'pfinandOne'.$i} = $pfinan->getOne();

				//$resposable->insRubsPCdp($selrub[1],$nnum);	
				//$mcdt[$i] = $resposable->getPmcdp($mcd[$i]['valid']);			

				if ($pagoman=="pagoman") {
					$solcdp->setNmesdpa(0);
					$solcdp->setCuodpa($duracion2);
					$solcdp->setPmes(0);
					$solcdp->setUmes(0);
				}else{
					$solcdp->setNmesdpa($duracion);
					$solcdp->setCuodpa(0);
					$solcdp->setPmes($primerm);
					$solcdp->setUmes($ultimom);
				}
				
				$solcdp->setTipcondpa($tipcondpa[$i]);

				if ($ftefindpa[$i]==653) {
					$solcdp->setFutic($futic[$i]);
				}else{
					$solcdp->setFutic(655);
				}
				$solcdp->setFtefindpa($ftefindpa[$i]);
				$solcdp->setAsidpa($valorAsignado[$i]);			

				$solcdp->setValdpa(0);

				$solcdp->setValvigact($valorVigencia[$i]);
				// var_dump($valorVigencia);
				// die();
				
				$nvalor=$valorVigencia[$i]-$valorAsignado[$i];
				// var_dump($nvalor);
				// die();

				$valortotal+=$nvalor;

				$solcdp->setFecfindpa($fechaEstimada);
				$solcdp->setReqvigf($vigenciaF);
				$solcdp->setSolivigf($soli);			

				$solcdp->setIdpro($idpro);
				$solcdp->setUnidad($unicontra);
				$solcdp->setUbicacion($ubicacion);
				$solcdp->setResp($nombreR);
				$solcdp->setOrdgas(intval($norgas));			
				$solcdp->setCelres($telefono);
				$solcdp->setMailres($email);
				$solcdp->setElidp($elidp);
				$solcdp->setCpc($cpc);

				

				$solcdp->setIdmcdp($idmcdp);

				
				$save = $solcdp->regMCdp();

				$nIddpa = $solcdp->mgetOneIddpa();
				// var_dump($nIddpa);
				// die();

				if ($pagoman=="pagoman") {	
					$duracion=$duracion2;			
					if($p){					
						$solcdp->elimCuota($nIddpa[0]["last_insert_id()"]);
						for ($i=0;$i<count($p);$i++){   						
							$solcdp->insCuota($nIddpa[0]["last_insert_id()"],$p[$i]);						
						}
					}				
				}

				$solcdp->actVCdp($nvalor,$iddpa1[$i]);
				$solcdp->traza($iddpa1[$i],$idflujo,$observa,$fec,$_SESSION['perid']);


				if($save){
					// var_dump('guardo ');
					// die();
					$_SESSION['inserAnt']="si";
					$insFut= new pfinan();
					$insFut->setCodIddpa($nIddpa[0]["last_insert_id()"]);

					// var_dump($nIddpa);
					// die();

					if ($ftefindpa ==653) {
						// var_dump($ffutic);
						// var_dump($_SESSION['iddpa']);
						
						// die();
						$insFut->setFfutic($futic);
						$inf=$insFut->actFutic();
					}
				}else{
					$_SESSION['InserAnt']="no";
				}

			}

			// for ($i=0;$i<count($iddpa1);$i++){   						
			// 	$iddpas = $iddpa1[$i].';';						
			// }

			// $hsave = $solcdp->regHMCdp($idmcdp,$iddpas,$valortotal);
		}

		header("Location:".base_url.'paa/index');		
		
	}

	public function viewsMCdp(){
		// $mcdp = new Pfinan();
		// $conCdp = $mcdp->getMc();
		// require_once 'views/cdpsm.php';
	}


}// cierra clase

?>