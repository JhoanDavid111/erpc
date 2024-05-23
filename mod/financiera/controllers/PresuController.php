<?php
// include'models/paa.php';
include'models/pfinan.php';
include'models/rubro.php';
include'models/valfin.php';
// include'models/newpaa.php';
include'models/antproy.php';
class presuController{
	
	public function index(){
		Utils::useraccess('paa/index',$_SESSION['pefid']);

		$ari = isset($_POST['areas']) ? $_POST['areas']:NULL;
		$pfinan = new Pfinan();
		$vig = $pfinan->vigact();
		$tot = isset($_GET['tot']) ? $_GET['tot']:NULL;
		$dpd = $_SESSION['depid'];
		$areSel = isset($_POST['areSel']) ? $_POST['areSel']:NULL;

		if($tot==1012) $dpd = 1012;

		$areas = $this->dparea($dpd);
		$areas = $dpd.",".$areas;
		$areas = substr($areas,0,strlen($areas)-1);
		$areas2 = $pfinan->depareas($areas);
		$pfinan->setIdpaa($vig[0]['idpaa']);

		if (isset($_POST['areas'])) {
			$area = $_POST['areas'];
			$_SESSION['area']=$area;
			$pfinan->setArea($area);
			$subareas = $pfinan->getSubAreas();
			$conta=count($subareas);	
		}else{
			$area = $_SESSION['depid'];
		}

		if($ari) $areas = $ari;
		$idpaa = $vig[0]['idpaa'];
		$pfcdp = $pfinan->getAll7($areSel,$idpaa);

		// echo "<pre>";
		// 	var_dump($pfinand);
		// echo "</pre>";
		// die();
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

		require_once 'views/presu.php';
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

	public function new(){
		Utils::useraccess('paa/index',$_SESSION['pefid']);

		$rubro = new Rubro();
		$rubros = $rubro->getAll();
		$num = $rubro->getNum();
		$ninipaa = $num[0]['ninipaa'];

		$_SESSION['consultado']=$_SESSION['vigP'];
		
		$editpf = new Antproy();
		$editp=0;
		$rubrosPf=$editpf->getRub($editp);

		$ari = isset($_POST['areas']) ? $_POST['areas']:NULL;
		$pfinan = new Pfinan();
		$vig = $pfinan->vigact();
		$tot = isset($_GET['tot']) ? $_GET['tot']:NULL;
		$dpd = $_SESSION['depid'];
		$areSel = isset($_POST['areSel']) ? $_POST['areSel']:NULL;

		if($tot==1012) $dpd = 1012;

		$areas = $this->dparea($dpd);
		$areas = $dpd.",".$areas;
		$areas = substr($areas,0,strlen($areas)-1);
		$areas2 = $pfinan->depareas($areas);
		$pfinan->setIdpaa($vig[0]['idpaa']);

		if (isset($_POST['areas'])) {
			$area = $_POST['areas'];
			$_SESSION['area']=$area;
			$pfinan->setArea($area);
			$subareas = $pfinan->getSubAreas();
			$conta=count($subareas);	
		}else{
			$area = $_SESSION['depid'];
		}

		if($ari) $areas = $ari;

		$pfinandOne = NULL;
		$_SESSION['newpaa']=1;

		// echo "<pre>";
		// 	var_dump($pfinand);
		// echo "</pre>";
		// die();
		$sumasi = 0;
		$sumdis = 0;
		$sumcdp = 0;
		$sumrp = 0;


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




		//UNIDAD EJECUTORA
		$unidcon=new valfin();
		$unidcon-> setDofid(7);
		$ucontrata=$unidcon->unicontrata();

		$respon = new Pfinan();
		//ORDENADOR DEL GASTO
		$ordg = $respon->ordenadorgas();
		$ordgas = $respon->responsables();
		$ordgas2 = $respon->responsables2();
		$pcdp = $respon->pcdp();


		//AREAS
		$areasutil=Utils::areasu($vig[0]['idpaa']);
		$_SESSION['vigP']=$vig[0]['idpaa'];

		$rubro = new Rubro();		
		$num = $rubro->getNum();
		$ninipaa = $num[0]['ninipaa'];

		require_once 'views/presunew.php';
	}

	public function insPresu(){
		Utils::useraccess('antproy/index',$_SESSION['pefid']);

		if (isset($_GET['paa'])) {
			$_SESSION['consultado']=$_SESSION['vigP'];
			// var_dump($_SESSION['consultado']);
			// die();
		}
		
		if(isset($_POST)){
			$areas = isset($_POST['areas']) ? $_POST['areas'] : false;
			$codUNSPSC_espacios = isset($_POST['codUNSPSC']) ? $_POST['codUNSPSC'] : false;
			$codUNSPSC= preg_replace('/[\r\n]+/', " ", $codUNSPSC_espacios);
			$codUNSPSC = str_replace ( ";" , "-" , $codUNSPSC);
			$rubroPre = isset($_POST['rubroPre']) ? substr($_POST['rubroPre'], 1) : false;
			$nombreRubro = isset($_POST['nombreRubro']) ? $_POST['nombreRubro'] : false;
			$objeto_espacios = isset($_POST['objeto']) ? $_POST['objeto'] : false;
			$objeto = preg_replace('/[\r\n]+/', " ", $objeto_espacios);
			$nomcont_espacios = isset($_POST['nomcont']) ? $_POST['nomcont'] : false;
			$nomcont = preg_replace('/[\r\n]+/', " ", $nomcont_espacios);
			$objdpa = isset($_POST['objdpa']) ? $_POST['objdpa'] : false;
			$inidpa = isset($_POST['inidpa']) ? $_POST['inidpa'] : false;
			$prodpa = isset($_POST['prodpa']) ? $_POST['prodpa'] : false;
			$fechaInicio = isset($_POST['fechaInicio']) ? $_POST['fechaInicio'] : false;
			$fechaEstimada = isset($_POST['fechaEstimada']) ? $_POST['fechaEstimada'] : false;
			$duracion = isset($_POST['duracion']) ? $_POST['duracion'] : false;
			$tipcondpa = isset($_POST['tipcondpa']) ? $_POST['tipcondpa'] : false;		
			$ftefindpa = isset($_POST['ftefindpa']) ? $_POST['ftefindpa'] : false;
			$ffutic = isset($_POST['futic']) ? $_POST['futic'] : false;		
			$valorAsignado = isset($_POST['valorAsignado']) ? $_POST['valorAsignado'] : false;
			$valorVigencia = isset($_POST['valorVigencia']) ? $_POST['valorVigencia'] : false;
			$vigenciaF = isset($_POST['vigenciaF']) ? $_POST['vigenciaF'] : false;

			$duracion = isset($_POST['duracion']) ? $_POST['duracion'] : false;
			$primerm = isset($_POST['primerm']) ? $_POST['primerm'] : false;
			$ultimom = isset($_POST['ultimom']) ? $_POST['ultimom'] : false;
			$valormensual = isset($_POST['valormensual']) ? $_POST['valormensual'] : false;
			$tipcondpa = isset($_POST['tipcondpa']) ? $_POST['tipcondpa'] : false;
			$ftefindpa = isset($_POST['ftefindpa']) ? $_POST['ftefindpa'] : false;

			$unicontra = isset($_POST['unicontra']) ? $_POST['unicontra'] : false;
			$ubicacion = isset($_POST['ubicacion']) ? $_POST['ubicacion'] : false;
			$nombreR = isset($_POST['nombreR']) ? $_POST['nombreR'] : false;
			$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			$idpro = isset($_POST['idpro']) ? $_POST['idpro'] : false;
			$ordgas = isset($_POST['norgas']) ? $_POST['norgas'] : false;

			
			$rubroPre = substr($rubroPre,0);
			$soli="NO";

			// var_dump($rubroPre);
			// die();

			$insAntp= new pfinan();
			
			$insAntp->setIdpaa($_SESSION['consultado']);

			$insAntp->setNicod(0);
			$insAntp->setNObjeto($objeto);
			$insAntp->setNomcont($nomcont);
			$insAntp->setArea($areas);
			$insAntp->setCodrub($rubroPre);
			$insAntp->setObjdpa($objdpa);
			$insAntp->setInidpa($inidpa);
			$insAntp->setProdpa($prodpa);	
			$insAntp->setUnspsc($codUNSPSC);					
			$insAntp->setFecinidpa($fechaInicio);
			$insAntp->setNmesdpa($duracion);
			$insAntp->setCuodpa(1); // Ajustar si es por cuotas		
			$insAntp->setTipcondpa($tipcondpa);
			$insAntp->setFtefindpa($ftefindpa);
			$insAntp->setAsidpa($valorAsignado);
			$insAntp->setPmes($primerm);
			$insAntp->setUmes($ultimom);
			$insAntp->setValdpa(0);
			$insAntp->setValvigact($valorVigencia);
			$insAntp->setFecfindpa($fechaEstimada);
			$insAntp->setReqvigf($vigenciaF);//Esta repetido dos lineas más abajo, revisar
			$insAntp->setSolivigf($soli);	
			$insAntp->setReqvigf($valormensual);
			$insAntp->setUnidad($unicontra);
			$insAntp->setUbicacion($ubicacion);
			$insAntp->setResp($nombreR);
			$datPer = $insAntp->getPersona($nombreR);
			$insAntp->setCelres($datPer[0]['pertel']); //Cargar dato de solicitante LISTO
			$insAntp->setMailres($datPer[0]['peremail']); //Cargar dato de solicitante LISTO
			//Nuevos
			$insAntp->setNcdppc(NULL);
			$insAntp->setFecsol(NULL);
			$insAntp->setObservaciones("");
			$insAntp->setIdpro($idpro); //Colocar control para cargar proceso LISTO
			$idflu = $insAntp->iniflu($idpro);
			$insAntp->setIdflu($idflu[0]['mini']); //Cargar flujo de acuerdo al proceso ant LISTO
			//$insAntp->setDepidd(NULL);
			$insAntp->setOrdgas($ordgas); //Colocar control para cargar proceso LISTO
			$insAntp->setMetadp(2000);
			$insAntp->setResoludp(2100);
			$insAntp->setCpc(NULL);
			$insAntp->setIdpb(NULL);
			$insAntp->setElidp(4);

			$save = $insAntp->mInserPresu();

			// var_dump($save);
			// 	die();
			if($save){
				$_SESSION['inserAnt']="si";
				$cod_iddpa=$insAntp->mgetOneIddpa();
				
				// echo $cod_iddpa['iddpa'];
				// var_dump($cod_iddpa);
				// die();

				$insFut= new pfinan();
				$insFut->setCodIddpa($cod_iddpa[0]["last_insert_id()"]);
				$insFut->setFfutic($ffutic);
				$inf=$insFut->inFutic();
			}else{
				$_SESSION['InserAnt']="no";
			}

		}
		//die();

		header("Location:".base_url.'presu/index&tot=1012');
	}
}