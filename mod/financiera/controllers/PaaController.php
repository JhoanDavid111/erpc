<?php
include'models/paa.php';
include'models/pfinan.php';
include'models/rubro.php';
include'models/valfin.php';
include'models/newpaa.php';
include'models/antproy.php';
include'models/masi.php';
include'models/detpaadoc.php';
include'models/traslado.php';

require __DIR__ . '/../../../vendor/autoload.php';		
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class paaController{
	
	public function index(){
		Utils::useraccess('paa/index',$_SESSION['pefid']);
		$ari = isset($_POST['areas']) ? $_POST['areas']:NULL;
		$pfinan = new Pfinan();
		$vig = $pfinan->vigact();
		$_SESSION['vig']=$vig[0]['idpaa'];
		$tot = isset($_REQUEST['tot']) ? $_REQUEST['tot']:NULL;
		$dpd = $_SESSION['depid'];
		$areSel = isset($_POST['areSel']) ? $_POST['areSel']:NULL;
		$estFin = isset($_POST['estFin']) ? $_POST['estFin']:NULL;

		if($tot==1012) $dpd = 1012;

		$areas = $this->dparea($dpd);
		$areas = $dpd.",".$areas;
		$areas = substr($areas,0,strlen($areas)-1);
		$areas2 = $pfinan->depareas($areas);
// --------- Inicio Enero 2023 ------------
		$mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		date_default_timezone_set('America/Bogota');
   		$hano = date("Y");
   		$hmes = date("m");
		$vig2 = $pfinan->getVigencia();
// --------- Fin Enero 2023 ------------

		// echo "<br>".$areas."<br>";
		// echo "<pre>";
		// var_dump($vig[0]['idpaa']);
		// echo "</pre>";
		// die();

		//$dpie = $pfinan->selgrPie();
		$dxyc = $pfinan->selgrChartxy($vig[0]['idpaa'],$areas);		
		$estfi = $pfinan->getVf(12);

		$pfinan->setIdpaa($vig[0]['idpaa']);
		$ConMCdps = $pfinan->getMc();
		$NMcdps = count($ConMCdps);
		// var_dump($ConMCdps);
		// die();



		for ($i=0;$i<count($ConMCdps);$i++){ 
			$mcdt[$i] = $pfinan->getMCdpAll($vig[0]['idpaa'],$ConMCdps[$i]['idmcdp']);					
			$sumMCdp[$i] = $pfinan->sumMCdp($vig[0]['idpaa'],$ConMCdps[$i]['idmcdp']);	

			if (isset($mcdt[$i][0]['idflu'])) {
				$idflu=$mcdt[$i][0]['idflu'];
				$actflu[$i]=$pfinan->getfl($idflu);
			}		
			
			//$selnom[$i] = $pfinan->selNom($mcdt[$i][0]['depidd']);
			// $mcdt[$i] = $pfinan->getMCdpAll2($vig[0]['idpaa'],$areas,$ConMCdps[$i]['idmcdp']);	
			// ${'pfinandOne'.$i} = $pfinan->getMCdpAll2($vig[0]['idpaa'],$areas,$ConMCdps[$i]['idmcdp']);				
		}

		// var_dump($actflu);
		// die();
	
		//$area = isset($_POST['areas']) ? $_POST['areas']:null;	
		
		if (isset($_POST['areas'])) {
			$area = $_POST['areas'];
			// var_dump($area);
			// die();
			$_SESSION['area']=$area;
			$pfinan->setArea($area);

			$subareas = $pfinan->getSubAreas();
			$conta=count($subareas);
			// var_dump($subareas);
			// die();
		
		}else{
			//$_SESSION['area'] = 1012;
			$area = $_SESSION['depid'];
		}

		if($ari) $areas = $ari;
			
		$pfinand = $pfinan->getAll2($areas);

		// echo "<pre>";
		// 	var_dump($pfinand);
		// echo "</pre>";
		// die();
		$sumasi = 0;
		$sumdis = 0;
		$sumcdp = 0;
		$sumrp = 0;
			
		//$_SESSION['pfinand']=$pfinan->getAll();
		// var_dump($pfinand);
		// die();

		//$areas = $pfinan->getAreas();
		//var_dump(count($areas));
		// var_dump($areas);
		// die();



		//AREAS
		$areasutil=Utils::areasu($vig[0]['idpaa']);
		$_SESSION['vigP']=$vig[0]['idpaa'];

		//var_dump($areasutil);
		//die();

		
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

		$valfinD->setDofid(10);
		$metas = $valfinD->getValdom();

		$valfinD->setDofid(11);
		$resols = $valfinD->getValdom();

		$resposable = new Pfinan();
		//ORDENADOR DEL GASTO
		$ordg = $resposable->ordenadorgas();


		if(isset($_GET['new'])){
			$_SESSION['inspaa']=true;			
		}

		require_once 'views/paa.php';
	}

	public function realizarMovimiento() {
		error_log("Función realizarMovimiento llamada");
	
		// Asegúrate de que $iddpa esté definido
		if (!isset($_GET['iddpa'])) {
			error_log("Error: iddpa no está definido.");
			// Manejo de error, podrías redirigir o mostrar un mensaje
			return;
		}
	
		$iddpa = $_GET['iddpa']; // Asigna el valor de iddpa desde la URL
	
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			error_log("Datos recibidos: " . print_r($_POST, true));
	
			$tptrs = $_POST['tipoMovimiento'];
			$monto = $_POST['monto'];
			$perid = $_SESSION['perid'];
		
			// Configurar la fecha/hora en UTC-5
			$timezone = new DateTimeZone('America/Bogota'); // UTC-5
			$datetime = new DateTime('now', $timezone);
			$fhtrs = $datetime->format('Y-m-d H:i:s'); // Generar el formato adecuado
		
			$idpro = 5004;
			$idflu = 301;
	
			// Configura el objeto Traslado
			$traslado = new Traslado();
			$traslado->setIddpa($iddpa);
			$traslado->setTptrs($tptrs);
			$traslado->setMonto($monto);
			$traslado->setPerid($perid);
			$traslado->setFhtrs($fhtrs);
			$traslado->setIdpro($idpro);
			$traslado->setIdflu($idflu);
	
			// Verifica que el monto del movimiento no supere el saldo disponible
			$pfinan = new Pfinan();
			$asignado = $pfinan->getDetpaaById($iddpa);
	
			// Asegúrate de que 'asidpa' no esté vacío o nulo
			/*
			if (isset($asignado['asidpa']) && !empty($asignado['asidpa'])) {
				$saldoAsignado = $asignado['asidpa'];
				
				// Log para verificar el valor del saldo asignado
				error_log("El saldo asignado es: " . $saldoAsignado);
	
				if ($_POST['monto'] > $saldoAsignado) {
					error_log("Error: El monto del movimiento supera el saldo disponible.");
					$_SESSION['mensaje'] = "Error: El monto del movimiento supera el saldo disponible.";
					return;
				}
			} else {
				error_log("Error: No se pudo obtener el saldo asignado.");
				$_SESSION['mensaje'] = "Error: No se pudo obtener el saldo asignado.";
				return;
			}
				*/
	
			// Guarda el movimiento
			if ($traslado->create()) {
				$_SESSION['mensaje'] = "Movimiento registrado correctamente.";
				$_SESSION['tipoMovimiento'] = $tptrs; // Almacena el tipo de movimiento
				$_SESSION['monto'] = $monto; // Almacena el monto
			} else {
				$_SESSION['mensaje'] = "Error al registrar el movimiento.";
			}
	
			// Redirecciona
			header("Location: " . base_url . "paa/index");
			exit();
		}
	
		// Carga la vista
		require_once 'views/realizarMovimiento.php';
	}
	
	public function detallesMovimientos() {
		// Obtiene el ID de la petición
		$iddpa = $_GET['iddpa'];
		error_log("ID DPA recibido: " . $iddpa); // Para verificar si se recibe el ID
	
		// Consulta a la base de datos
		$trasladoModel = new Traslado();
		$traslados = $trasladoModel->getMovimientosPorIdDpa($iddpa); // Guardar el resultado
	
		if (empty($traslados)) {
			error_log("No se encontraron movimientos para ID DPA: " . $iddpa);
		}
	
		// Cargar la vista
		require_once 'views/detallesMovimientos.php';
	}
	
	
	

	public function detpaa(){
		Utils::useraccess('paa/index',$_SESSION['pefid']);
		$ari = isset($_POST['areas']) ? $_POST['areas']:NULL;
		$pfinan = new Pfinan();
		$vig = $pfinan->vigact();
		$tot = isset($_REQUEST['tot']) ? $_REQUEST['tot']:NULL;
		$dpd = $_SESSION['depid'];

		$areSel = isset($_POST['areSel']) ? $_POST['areSel']:NULL;
		$estFin = isset($_POST['estFin']) ? $_POST['estFin']:NULL;

		if($tot==1012) $dpd = 1012;

		$areas = $this->dparea($dpd);
		$areas = $dpd.",".$areas;
		$areas = substr($areas,0,strlen($areas)-1);
		$areas2 = $pfinan->depareas($areas);
		$estfi = $pfinan->getVf(12);
		
		// echo "<br>".$areas."<br>";
		// echo "<pre>";
		// var_dump($areas2);
		// echo "</pre>";
		// die();
		$codrub = isset($_GET['codrub']) ? $_GET['codrub']:NULL;
		$areSel = isset($_POST['areSel']) ? $_POST['areSel']:NULL;
		$tip = isset($_GET['tip']) ? $_GET['tip']:0;

		//$dpie = $pfinan->selgrPie();
		$dxyc = $pfinan->selgrChartxy2($vig[0]['idpaa'],$codrub);

		$pfinan->setIdpaa($vig[0]['idpaa']);
		//$area = isset($_POST['areas']) ? $_POST['areas']:null;	
		
		if (isset($_POST['areas'])) {
			$area = $_POST['areas'];
			$_SESSION['area']=$area;
			$pfinan->setArea($area);

			$subareas = $pfinan->getSubAreas();
			$conta=count($subareas);
		}else{
			//$_SESSION['area'] = 1012;
			$area = $_SESSION['depid'];
		}

		if($ari) $areas = $ari;

		$valFlu1 = $pfinan->getFCrea(1);
		$valFlu2 = $pfinan->getFCrea(2);
		$valFlu3 = $pfinan->getFCrea(3);
		$valFlu4 = $pfinan->getFCrea(4);
		// echo $valFlu;
		// die();

		if($codrub)	$pfinand = $pfinan->getAll3($areas,$codrub,$areSel,$valFlu1); else $pfinand = NULL;
		if($codrub)	$pfcdp = $pfinan->getAll4($areas,$codrub,$areSel,$valFlu2.','.$valFlu3); else $pfinand = NULL;
		if($codrub)	$pfrp = $pfinan->getAll3($areas,$codrub,$areSel,$valFlu4); else $pfinand = NULL;
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

		$valfinD->setDofid(10);
		$metas = $valfinD->getValdom();
		$valfinD->setDofid(11);
		$resols = $valfinD->getValdom();

		$resposable = new Pfinan();
		//ORDENADOR DEL GASTO
		$ordg = $resposable->ordenadorgas();
		if(isset($_GET['new'])){
			$_SESSION['inspaa']=true;			
		}

		require_once 'views/detpaa.php';
	}
    
    public function index2robin(){
    	Utils::useraccess('paa/index',$_SESSION['pefid']);
		$pfinan = new Pfinan();
		$vig = $pfinan->vigact();
		$dpie = $pfinan->selgrPie();
		$dxyc = $pfinan->selgrChartxy($vig[0]['idpaa']);

		$pfinan->setIdpaa($vig[0]['idpaa']);
	
		$area = isset($_POST['areas']) ? $_POST['areas']:null;	
		if($area) $areas = $this->areasAll($area);	else $areas=NULL;	

		$pfinand = $pfinan->getAll2($areas);
		// var_dump(count($pfinand));
		//die();


		$areas = $pfinan->getAreas();
		// var_dump($areas);
		// die();

		$pfvig = $pfinan->getVig();
		$rubro = new Rubro();

		$rubro = new Rubro();		
		$num = $rubro->getNum();
		$ninipaa = $num[0]['ninipaa'];

		// var_dump($dxyc);
		// die();
		
		//require_once 'views/pfinan.php';
		require_once 'views/paa.php';
	}


	public function areasAll($area){
			//ROBIN
		$pfinan = new Pfinan();
		$areas = [];
		array_push($areas, $area);

		$pfinan->setArea($area);
		$sare = $pfinan->getSubAreas();
		if($sare){
			foreach ($sare as $sar) {
				array_push($areas, $sar['valid']);
				$pfinan->setArea($sar['valid']);
				$sare1 = $pfinan->getSubAreas();
				if($sare1){
					foreach ($sare1 as $sar1) {
						array_push($areas, $sar1['valid']);
						$pfinan->setArea($sar1['valid']);
						$sare2 = $pfinan->getSubAreas();
						if($sare2){
							foreach ($sare2 as $sar2)
								array_push($areas, $sar2['valid']);
						}
					}
				}
			}
		}
		$txt = "";
		$i=0;
		foreach ($areas as $ae) {
			$txt .= $ae;
			if($i<count($areas)-1) $txt .= ",";
			$i++;
		}
		return $txt;
	}


	public function getRub(){

		// var_dump($_GET);
		// die();

		Utils::useraccess('paa/index',$_SESSION['pefid']);

		$pfinan = new Pfinan();
		$vig = $pfinan->vigact();
		// $dpie = $pfinan->selgrPie();
		// $dxyc = $pfinan->selgrChartxy($vig[0]['idpaa']);

		$pfinan->setIdpaa($vig[0]['idpaa']);

		// var_dump($_GET);
		// die();

		$_SESSION['apro']=null;

		if(isset($_GET['apro'])){
			
			$_SESSION['apro']=1;
		}	
		
		if (isset($_GET['codrub'])) {

			$codrub = $_GET['codrub'];
			$iddpa= $_GET['iddpa'];
			$_SESSION['iddpa']=$iddpa;

			// var_dump($iddpa);
			// die();

			$area = $_SESSION['depid'];
			$pfinan->setArea($area);
			$pfinan->setCodrub($codrub);
			$pfinan->setIddpa($iddpa);
			$dpie = $pfinan->selgrPie();
			$pernat = $pfinan->getValPNJ(81);
			$perjur = $pfinan->getValPNJ(24);

			$dxyc = $pfinan->selgrChartxy($vig[0]['idpaa'], $area);

			$subareas = $pfinan->getSubAreas();
			$conta=count($subareas);
			// var_dump($subareas);
			// die();

			$dimensiones=0;
			$dependen=[];
			$codi=[];
			$indice="[]";
		
			if ($conta>0) {
				$indice .= "[]";
				for ($i=0; $i < $conta ; $i++) { 
					$j=0;
					$dependen[0][$i][$j]=$subareas[$i]['valnom'];
					$dependen[0][$i][$j+1]=$subareas[$i]['valid'];
					$valcodi=$dependen[0][$i][$j+1];
					array_push($codi, $valcodi);	

				}
				$contreg = count($dependen[0]);

				$dep=[];
				$dep=$dependen;
				$lgcodi=count($codi);


				$arreglo=[];
				if($contreg>0){
					for ($i=0; $i < $contreg; $i++) { 
						$j=0;

						if($dependen[0][$i][$j+1]!=null){
							$pfinan->setArea($dependen[0][$i][$j+1]);
							//$pfinan->setArea(1021);
							$subareas1 = $pfinan->getSubAreas();
							array_push($arreglo, $subareas1);							
						}

					}
				}				

			}else{
				
			}
		
		}else{
			//$area = $_POST['areas'] = null;
		}	



		$pfinand = $pfinan->getAll2($area);	
		$pfinandOne = $pfinan->getOne();
		$numeroFormateado = '$ ' . number_format($pfinandOne[0]['asidpa'], 0, ',', '.');
		// var_dump($pfinandOne);
		// die();
		$cuota = $pfinan->getCuota($iddpa);

		// var_dump($pfinandOne);
		// die();

		// var_dump($pfinandOne[0]['idflu']);
		// die();

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

		$valfinD->setDofid(10);
		$metas = $valfinD->getValdom();

		$valfinD->setDofid(11);
		$resols = $valfinD->getValdom();

		$obligagen = $pfinan->getObligaGen();
		

			
		//$_SESSION['pfinand']=$pfinan->getAll();
		// var_dump($pfinandOne);
		// die();

		$areas = $pfinan->getAreas();
		$areas2 = $pfinan->getAreas();

		// var_dump(count($areas));
		// var_dump($areas);
		// die();



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
				$histo = $pfinan->histobus($iddpa);	
				// var_dump(count($histo));
				// die();
				
				// if (count($histo)>0) {
				// 	$prov =$pfinan->busprove($histo[0]['idprov']);
				// }	

				if (count($histo)>0) {
					for ($i=0; $i < count($histo) ; $i++) { 
						$prov[$i] =$pfinan->busprove($histo[$i]['idprov']);
					}
					
				}	
				// var_dump(($prov[0]));
				// die();			
				
				require_once 'views/cdp.php';
			}
		}else{			
			//require_once 'views/cdp.php';
			require_once 'views/paa.php';

		}		
		
	}

	public function getRubMcdp(){

		Utils::useraccess('paa/index',$_SESSION['pefid']);

		$pfinan = new Pfinan();
		$vig = $pfinan->vigact();
		// $dpie = $pfinan->selgrPie();
		//$dxyc = $pfinan->selgrChartxy($vig[0]['idpaa']);

		// $dpd = 1027;
		// $areas = $this->dparea($dpd);

		
		$pfinan->setIdpaa($vig[0]['idpaa']);		
		$_SESSION['apro']=null;
		
				
		if (isset($_GET['codrub'])) {

			$suma = $_GET['suma'];
			$codrub = $_GET['codrub'];
			$iddpa= $_GET['iddpa'];
			$_SESSION['iddpa']=$iddpa;
			
			//$valid= $_POST['valid'];
			
			// var_dump($iddpa);
			// die();
			$_SESSION['iddpa']=$iddpa;
			$area = $_SESSION['depid'];

			// var_dump($area);
			// die();
			//$p = isset($_POST["p"]) ? $_POST["p"]:NULL;

			$pfinan->setArea($area);
			$pfinan->setCodrub($codrub);
			//$pfinan->setIddpa($iddpa);
			//$dpie = $pfinan->selgrPie();

			$dxyc = $pfinan->selgrChartxy($vig[0]['idpaa'], $area);

			$subareas = $pfinan->getSubAreas();
			$conta=count($subareas);		
		
		}	

		$pfinand = $pfinan->getAll2($area);	

		// var_dump(count($codrub));
		// die();

		$idMCdpRub = $pfinan->idMCdpRub($vig[0]['idpaa'],$iddpa);		
		$codrub1 = $pfinan->getCodrubAll($vig[0]['idpaa'],$idMCdpRub[0]['idmcdp']);	

		for ($i=0;$i<count($codrub1);$i++){ 
			
			//$codrub = explode(";",$codrub1[$i]);
			// var_dump(($codrub1[$i]['iddpa']));
			// die();
			$pfinan->setCodrub($codrub1[$i]);
			$pfinan->setIddpa($codrub1[$i]['iddpa']);

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
			require_once 'views/aproMcdp.php';

		}		
		
	}



	public function editpaa(){
		Utils::useraccess('paa/index',$_SESSION['pefid']);
		// var_dump($_POST["boton"]);
		// die();
		$btn = isset($_POST["boton"]) ? $_POST["boton"]:NULL;

		if ($btn=="duplicar") {
			if(isset($_POST)){

			// echo "Aca le entra en cero";	
			// var_dump($_POST);
			// die();
			
			$are = isset($_POST['marea']) ? $_POST['marea'] : false;
			$areas = isset($_POST['areas']) ? $_POST['areas'] : false;
			//$marea = isset($_POST['areas']) ? $_POST['areas'] : false; //MODIFICAR AREA ASIGNADA
			$codUNSPSC = isset($_POST['codUNSPSC']) ? $_POST['codUNSPSC'] : false;
			$rubroPre = isset($_POST['rubroPre']) ? substr($_POST['rubroPre'], 1) : false;
			$nombreRubro = isset($_POST['nombreRubro']) ? $_POST['nombreRubro'] : false;
			//$objeto = isset($_POST['objeto']) ? $_POST['objeto'] : false;
			$objeto_espacios = isset($_POST['objeto']) ? $_POST['objeto'] : false;			
			$objeto = preg_replace('/[\r\n]+/', " ", $objeto_espacios);

			$nomcont = isset($_POST['nomcont']) ? $_POST['nomcont'] : false;
			$objdpa = isset($_POST['objdpa']) ? $_POST['objdpa'] : false;			
			$inidpa = isset($_POST['inidpa']) ? $_POST['inidpa'] : false;
			$prodpa = isset($_POST['prodpa']) ? $_POST['prodpa'] : false;
			$fechaInicio = isset($_POST['fechaInicio']) ? $_POST['fechaInicio'] : false;
			$fechaEstimada = isset($_POST['fechaEstimada']) ? $_POST['fechaEstimada'] : false;
			//$duracion = isset($_POST['duracion']) ? $_POST['duracion'] : false;			
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
			$norgas = isset($_POST['norgas']) ? $_POST['norgas'] : false;	
			$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			$idpro = isset($_POST['idpro']) ? $_POST['idpro'] : false;
			$hidpro = isset($_POST['hidpro']) ? $_POST['hidpro'] : false;
			$hidflu = isset($_POST['idflu']) ? $_POST['idflu'] : false;
			$hdepid = isset($_POST['depidd']) ? $_POST['depidd'] : null;
			$metadp = isset($_POST['metadp']) ? $_POST['metadp'] : null;
			$resoludp = isset($_POST['resoludp']) ? $_POST['resoludp'] : null;

			
			$rubroPre = substr($rubroPre,0);
			$soli="NO";

			// var_dump($rubroPre);
			// die();

			$insAntp= new pfinan();

			$Vidflu = $insAntp->iniflu($idpro);
			$idflu = $Vidflu[0]['mini'];

			
			if ($idpro==$hidpro) {
				$idflu=$hidflu;		
				var_dump('sin cambios');				
			}else{
				if($hdepid!=null){//ES CDP HIJO				
					$idflu = $Vidflu[0]['mini']+1;
					// var_dump('cambia flujo y es hijo');
					// var_dump($idflu);
				}else{
					// if ($hidflu==$Vidflu[0]['mini']+1) {
					// 	var_dump('esta para aprobacion del area paso2');
					// }
					$idflu = $Vidflu[0]['mini'];
					// var_dump('cambia flujo y es padre');
				}
			}
			
			
			$insAntp->setIdpaa($_SESSION['consultado']);

			$insAntp->setNicod(0);
			$insAntp->setNObjeto($objeto);
			if($are)
				$insAntp->setArea($are);
			else
				$insAntp->setArea($areas);
				$insAntp->setCodrub($rubroPre);
				$insAntp->setObjdpa($objdpa);
				$insAntp->setNomcont($nomcont);
				$insAntp->setInidpa($inidpa);
				$insAntp->setProdpa($prodpa);	
				$insAntp->setUnspsc($codUNSPSC);					
				$insAntp->setFecinidpa($fechaInicio);
				$insAntp->setTipcondpa($tipcondpa);
				$insAntp->setFtefindpa($ftefindpa);
				$insAntp->setAsidpa($valorAsignado);
				$insAntp->setValvigact($valorVigencia);
				$insAntp->setFecfindpa($fechaEstimada);
				$insAntp->setReqvigf($vigenciaF);
				$insAntp->setSolivigf($soli);	

				$insAntp->setValdpa(0);
				$insAntp->setNmesdpa($duracion);
				$insAntp->setPmes($primerm);
				$insAntp->setUmes($ultimom);
				$insAntp->setReqvigf($valormensual);
				$insAntp->setTipcondpa($tipcondpa);
				$insAntp->setFtefindpa($ftefindpa);

				$insAntp->setUnidad($unicontra);
				$insAntp->setUbicacion($ubicacion);
				$insAntp->setResp($nombreR);
				$insAntp->setOrdgas($norgas);

				$insAntp->setIdpro($idpro);
				$insAntp->setIdflu($idflu);
				//$insAntp->setCelres($telefono);
				//$insAntp->setMailres($email);		

				$insAntp->setMetadp($metadp);
				$insAntp->setResoludp($resoludp);	

				$save = $insAntp->mInserAntp();		
				// var_dump($save);
				// 	die();
			if($save){
				$_SESSION['inserAnt']="si";
			}else{
				$_SESSION['InserAnt']="no";
			}

		}
			//die();
			header("Location:".base_url.'paa/index');
		}else{
			// echo "Aca le entra en uno";	
			// var_dump($_POST);
			// die();
			$p = isset($_POST["p"]) ? $_POST["p"]:NULL;
			$pagoman = isset($_POST['pagoman']) ? $_POST['pagoman'] : false;

			$are = isset($_POST['marea']) ? $_POST['marea'] : false;
			$areas = isset($_POST['areas']) ? $_POST['areas'] : false;
			$compromiso = isset($_POST['compromiso']) ? $_POST['compromiso'] : 0;

			$iddpa = isset($_POST['iddpa']) ? $_POST['iddpa'] : false;
			$nomcont = isset($_POST['nomcont']) ? $_POST['nomcont'] : false;
			$codUNSPSC = isset($_POST['codUNSPSC']) ? $_POST['codUNSPSC'] : false;
			$rubroPre = isset($_POST['rubroPre']) ? substr($_POST['rubroPre'], 1) : false;
			$nombreRubro = isset($_POST['nombreRubro']) ? $_POST['nombreRubro'] : false;
			//$objeto = isset($_POST['objeto']) ? $_POST['objeto'] : false;
			$objeto_espacios = isset($_POST['objeto']) ? $_POST['objeto'] : false;			
			$objeto = preg_replace('/[\r\n]+/', " ", $objeto_espacios);

			$objdpa = isset($_POST['objdpa']) ? $_POST['objdpa'] : false;			
			$inidpa = isset($_POST['inidpa']) ? $_POST['inidpa'] : false;
			$prodpa = isset($_POST['prodpa']) ? $_POST['prodpa'] : false;
			$fechaInicio = isset($_POST['fechaInicio']) ? $_POST['fechaInicio'] : false;
			$fechaEstimada = isset($_POST['fechaEstimada']) ? $_POST['fechaEstimada'] : false;
			$duracion = isset($_POST['duracion']) ? $_POST['duracion'] : false;
			$duracion2 = isset($_POST['duracion2']) ? $_POST['duracion2'] : false;
			$tipcondpa = isset($_POST['tipcondpa']) ? $_POST['tipcondpa'] : false;

			$ftefindpa = isset($_POST['ftefindpa']) ? $_POST['ftefindpa'] : false;
			$ffutic = isset($_POST['futic']) ? $_POST['futic'] : false;
			$cpc= isset($_POST['cpc']) ? $_POST['cpc'] : NULL;
			$observa = isset($_POST['observa']) ? $_POST['observa'] : false;

			$valorAsignado = isset($_POST['valorAsignado']) ? $_POST['valorAsignado'] : false;
			$valorVigencia = isset($_POST['valorVigencia']) ? $_POST['valorVigencia'] : false;
			$vigenciaF = isset($_POST['vigenciaF']) ? $_POST['vigenciaF'] : false;
			$unicontra = isset($_POST['unicontra']) ? $_POST['unicontra'] : false;
			$ubicacion = isset($_POST['ubicacion']) ? $_POST['ubicacion'] : false;
			$nombreR = isset($_POST['nombreR']) ? $_POST['nombreR'] : false;
			$norgas = isset($_POST['norgas']) ? $_POST['norgas'] : false;	
			$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			$idpro = isset($_POST['idpro']) ? $_POST['idpro'] : false;
			$hidpro = isset($_POST['hidpro']) ? $_POST['hidpro'] : false;
			$hidflu = isset($_POST['idflu']) ? $_POST['idflu'] : false;
			$hdepid = isset($_POST['depidd']) ? $_POST['depidd'] : null;
			$metadp = isset($_POST['metadp']) ? $_POST['metadp'] : null;
			$resoludp = isset($_POST['resoludp']) ? $_POST['resoludp'] : null;

			$editpf = new Pfinan();

			$Vidflu = $editpf->iniflu($idpro);
			$idflu = $Vidflu[0]['mini'];			

			if ($idpro==$hidpro) {
				$idflu=$hidflu;		
				// var_dump('sin cambios');				
			}else{
				if($hdepid!=null){//ES CDP HIJO				
					$idflu = $Vidflu[0]['mini']+1;
					// var_dump('cambia flujo y es hijo');
					// var_dump($idflu);
				}else{
					// if ($hidflu==$Vidflu[0]['mini']+1) {
					// 	var_dump('esta para aprobacion del area paso2');
					// }
					$idflu = $Vidflu[0]['mini'];
					//var_dump('cambia flujo y es padre');
				}
			}
			//die();
	
			// echo "Aca le entra en dos<br>";	
			// var_dump('no');
			// var_dump($hdepid);
			// die();
			
			$editpf->setIddpa($iddpa);			

			if ($pagoman=="pagoman") {	
				$duracion=$duracion2;				
				$editpf->setNmesdpa(0);
				$editpf->setCuodpa($duracion2);				

				if($p){					
					$editpf->elimCuota($iddpa);
					for ($i=0;$i<count($p);$i++){   						
						$editpf->insCuota($iddpa,$p[$i]);						
					}
				}				
			}else{
				$editpf->setNmesdpa($duracion);
				$editpf->setCuodpa(0);				
			}

			if($are)
				$editpf->setArea($are);
			else
				$editpf->setArea($areas);
				$editpf->setNomcont($nomcont);
				$editpf->setNObjeto($objeto);
				$editpf->setCodrub($rubroPre);
				$editpf->setObjdpa($objdpa);
				$editpf->setInidpa($inidpa);
				$editpf->setProdpa($prodpa);	
				$editpf->setUnspsc($codUNSPSC);					
				$editpf->setFecinidpa($fechaInicio);
				$editpf->setTipcondpa($tipcondpa);
				$editpf->setFtefindpa($ftefindpa);
				$editpf->setObservaciones($observa);
				$editpf->setAsidpa($valorAsignado);
				$editpf->setValvigact($valorVigencia);
				$editpf->setFecfindpa($fechaEstimada);
				$editpf->setReqvigf($vigenciaF);			
				$editpf->setUnidad($unicontra);
				$editpf->setUbicacion($ubicacion);
				$editpf->setResp($nombreR);
				$editpf->setOrdgas($norgas);

				$editpf->setIdpro($idpro);
				$editpf->setIdflu($idflu);

				$editpf->setMetadp($metadp);
				$editpf->setResoludp($resoludp);

				$editpf->setCpc($cpc);
				$editpf->setCompro($compromiso);

				$save = $editpf->edpaa();

				// echo "<br>Aca le entra en tres<br>";	
				// var_dump($save);
				// die();
			if($save){
				$_SESSION['actpaa']="si";
				
				$insFut= new pfinan();
				$insFut->setCodIddpa($_SESSION['iddpa']);

				if ($ffutic != null) {
					// var_dump($ffutic);
					// var_dump($_SESSION['iddpa']);
					
					// die();
					$insFut->setFfutic($ffutic);
					$inf=$insFut->actFutic();
				}
				
			}else{
				$_SESSION['actpaa']="no";
			}

			if (isset($_SESSION['editAntp'])) {
				header("Location:".base_url.'paa/index');
			}else{
				header("Location:".base_url.'paa/index');
			}
		}
	}

	//EDITA ANTEPROYECTO
	public function editpaa2(){
		Utils::useraccess('paa/index',$_SESSION['pefid']);
		// var_dump($_POST["boton"]);
		// die();	

		if ($_POST["boton"]=="duplicar") {
			if(isset($_POST)){

				// var_dump($_POST);
				// die();

				$areas = isset($_POST['areas']) ? $_POST['areas'] : false;

				$idpaa = isset($_POST['idpaa']) ? $_POST['idpaa'] : false;
				$codUNSPSC = isset($_POST['codUNSPSC']) ? $_POST['codUNSPSC'] : false;
				$rubroPre = isset($_POST['rubroPre']) ? substr($_POST['rubroPre'], 1) : false;
				$nombreRubro = isset($_POST['nombreRubro']) ? $_POST['nombreRubro'] : false;
				//$objeto = isset($_POST['objeto']) ? $_POST['objeto'] : false;
				$objeto_espacios = isset($_POST['objeto']) ? $_POST['objeto'] : false;		
				$objeto = preg_replace('/[\r\n]+/', " ", $objeto_espacios);

				$nomcont = isset($_POST['nomcont']) ? $_POST['nomcont'] : false;
				$objdpa = isset($_POST['objdpa']) ? $_POST['objdpa'] : false;			
				$inidpa = isset($_POST['inidpa']) ? $_POST['inidpa'] : false;
				$prodpa = isset($_POST['prodpa']) ? $_POST['prodpa'] : false;
				$fechaInicio = isset($_POST['fechaInicio']) ? $_POST['fechaInicio'] : false;
				$fechaEstimada = isset($_POST['fechaEstimada']) ? $_POST['fechaEstimada'] : false;
				$duracion = isset($_POST['duracion']) ? $_POST['duracion'] : false;
				$tipcondpa = isset($_POST['tipcondpa']) ? $_POST['tipcondpa'] : false;		
				$ftefindpa = isset($_POST['ftefindpa']) ? $_POST['ftefindpa'] : false;
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

				$insAntp->setTipcondpa($tipcondpa);
				$insAntp->setFtefindpa($ftefindpa);
				$insAntp->setAsidpa($valorAsignado);
				$insAntp->setPmes($primerm);
				$insAntp->setUmes($ultimom);
				$insAntp->setValvigact($valorVigencia);
				$insAntp->setFecfindpa($fechaEstimada);
				$insAntp->setReqvigf($vigenciaF);
				$insAntp->setSolivigf($soli);

				$insAntp->setValdpa(0);				
				
				$insAntp->setTipcondpa($tipcondpa);
				$insAntp->setFtefindpa($ftefindpa);



				$insAntp->setUnidad($unicontra);
				$insAntp->setUbicacion($ubicacion);
				$insAntp->setResp($nombreR);
				//$insAntp->setCelres($telefono);
				//$insAntp->setMailres($email);
							

				$save = $insAntp->mInserAntp();		
				// var_dump($save);
				// 	die();
				if($save){
					$_SESSION['inserAnt']="si";
					$insFut= new pfinan();
					$insFut->setCodIddpa($_SESSION['iddpa']);

					if ($ffutic != null) {
						// var_dump($ffutic);
						// var_dump($_SESSION['iddpa']);
						
						// die();
						$insFut->setFfutic($ffutic);
						$inf=$insFut->actFutic();
					}
				}else{
					$_SESSION['InserAnt']="no";
				}

			}
			//die();
			header("Location:".base_url.'antproy/index');
		}else{
			// var_dump($_POST);
				// die();
			$areas = isset($_POST['areas']) ? $_POST['areas'] : false;
			
			$nomcont = isset($_POST['nomcont']) ? $_POST['nomcont'] : false;
			$codUNSPSC = isset($_POST['codUNSPSC']) ? $_POST['codUNSPSC'] : false;
			$rubroPre = isset($_POST['rubroPre']) ? substr($_POST['rubroPre'], 1) : false;
			$nombreRubro = isset($_POST['nombreRubro']) ? $_POST['nombreRubro'] : false;
			//$objeto = isset($_POST['objeto']) ? $_POST['objeto'] : false;
			$objeto_espacios = isset($_POST['objeto']) ? $_POST['objeto'] : false;			
			$objeto = preg_replace('/[\r\n]+/', " ", $objeto_espacios);

			$objdpa = isset($_POST['objdpa']) ? $_POST['objdpa'] : false;			
			$inidpa = isset($_POST['inidpa']) ? $_POST['inidpa'] : false;
			$prodpa = isset($_POST['prodpa']) ? $_POST['prodpa'] : false;
			$fechaInicio = isset($_POST['fechaInicio']) ? $_POST['fechaInicio'] : false;
			$fechaEstimada = isset($_POST['fechaEstimada']) ? $_POST['fechaEstimada'] : false;
			$duracion = isset($_POST['duracion']) ? $_POST['duracion'] : false;
			$tipcondpa = isset($_POST['tipcondpa']) ? $_POST['tipcondpa'] : false;		
			$ftefindpa = isset($_POST['ftefindpa']) ? $_POST['ftefindpa'] : false;
			//$futic = isset($_POST['futic']) ? $_POST['futic'] : false;
			$valorAsignado = isset($_POST['valorAsignado']) ? $_POST['valorAsignado'] : false;
			$valorVigencia = isset($_POST['valorVigencia']) ? $_POST['valorVigencia'] : false;
			$vigenciaF = isset($_POST['vigenciaF']) ? $_POST['vigenciaF'] : false;
			$unicontra = isset($_POST['unicontra']) ? $_POST['unicontra'] : false;
			$ubicacion = isset($_POST['ubicacion']) ? $_POST['ubicacion'] : false;
			$nombreR = isset($_POST['nombreR']) ? $_POST['nombreR'] : false;
			$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
			$email = isset($_POST['email']) ? $_POST['email'] : false;

			
			$editpf = new Pfinan();
			
			$editpf->setIddpa($_SESSION['iddpa']);
			$editpf->setArea($areas);			
			$editpf->setNomcont($nomcont);
			$editpf->setNObjeto($objeto);
			$editpf->setCodrub($rubroPre);
			$editpf->setObjdpa($objdpa);
			$editpf->setInidpa($inidpa);
			$editpf->setProdpa($prodpa);	
			$editpf->setUnspsc($codUNSPSC);					
			$editpf->setFecinidpa($fechaInicio);
			$editpf->setNmesdpa($duracion);
			$editpf->setTipcondpa($tipcondpa);
			$editpf->setFtefindpa($ftefindpa);			
			$editpf->setAsidpa($valorAsignado);
			$editpf->setValvigact($valorVigencia);
			$editpf->setFecfindpa($fechaEstimada);
			$editpf->setReqvigf($vigenciaF);			
			$editpf->setUnidad($unicontra);
			$editpf->setUbicacion($ubicacion);
			$editpf->setResp($nombreR);
			//$editpf->setCelres($telefono);
			//$editpf->setMailres($email);
						

			$save = $editpf->edpaaAnt();		
			// var_dump($save);
			// 	die();
			if($save){
				$_SESSION['actpaa']="si";

				//fuente futic
				//$ffutic = new Pfinan();


			}else{
				$_SESSION['actpaa']="no";
			}

			if (isset($_SESSION['editAntp'])) {
				header("Location:".base_url.'antproy/index');
			}else{
				header("Location:".base_url.'antproy/index');
			}
		}	
	}

	function solicdp(){
		include'../contrato/models/contrato.php';
		// var_dump($_POST);
		// die();
		if(isset($_POST)){
			//********************
			//**INFO CONTRATISTA PN
			//**********************

			
			$tipper = isset($_POST['tipper']) ? $_POST['tipper']:false;
			if($tipper=="2"){
				$docpernat = isset($_POST['docpernat']) ? $_POST['docpernat']:false;
			}elseif($tipper=="3"){
				$docpernat = isset($_POST['docperjur']) ? $_POST['docperjur']:false;
			}

			$idcon = isset($_POST['num_documento']) ? $_POST['num_documento']:NULL;
			$num_documento = isset($_POST['num_documento']) ? $_POST['num_documento']:NULL;
			date_default_timezone_set('America/Bogota');
			$ano = isset($_GET['ano']) ? $_GET['ano']:date("Y");
			$est = isset($_POST['st']) ? $_POST['st']:NULL;
			$abo = isset($_POST['ab']) ? $_POST['ab']:NULL;
			$feccon = date("Y-m-d H:i:s");
			$perid = 265;

			$valid = $_SESSION['depid'];
			$peridNew = isset($_POST['peridNew']) ? $_POST['peridNew']:NULL;
			$nomcon = isset($_POST['nomcontNew']) ? $_POST['nomcontNew'] : false;
			$apecon = isset($_POST['apecontNew']) ? $_POST['apecontNew'] : false;
			$mailcontNew = isset($_POST['mailcontNew']) ? $_POST['mailcontNew']:'prueba@canalcapital.gov.co';
			$nodocemp = isset($_POST['nodocemp']) ? $_POST['nodocemp']:NULL;

			$detpaadoc = new Detpaadoc();
			//Crear Persona sino existe
			if(!$peridNew){
				$detpaadoc->savePer($nodocemp, $nomcon, $apecon, $mailcontNew, $nodocemp, $valid);
				$peridNew = $detpaadoc->getOneLast($nodocemp, $nomcon, $apecon, $mailcontNew, $nodocemp, $valid);
				if($peridNew) $peridNew = $peridNew[0]['perid'];
			}
			//echo "Perid: ".$peridNew;
			// var_dump($peridNew);
			// die();

			$nomcon = $nomcon." ".$apecon;	




			$objcon = isset($_POST['objeto']) ? $_POST['objeto'] : false;
			$parid = 11;
			$linexpcon = isset($_POST['linexpcon']) ? $_POST['linexpcon'] : false;
			$lineccon = isset($_POST['lineccon']) ? $_POST['lineccon'] : false;
			$pubseccon = isset($_POST['pubseccon']) ? $_POST['pubseccon'] : false;
			$enlseccon = isset($_POST['enlseccon']) ? $_POST['enlseccon'] : false;
			$arch = isset($_FILES['arch']["name"]) ? $_FILES['arch']["name"]:NULL;
			$noseccon = isset($_POST['noseccon']) ? $_POST['noseccon'] : false;

			if($feccon && $perid && $valid){
				$contrato = new Contrato();
				$contrato->setidcon($idcon);
				$contrato->setfeccon($feccon);
				$contrato->setperid($perid);
				$contrato->setvalid($valid);
				$contrato->setnomcon($nomcon);
				$contrato->setobjcon($objcon);
				$contrato->setparid($parid);
				$contrato->setlinexpcon($linexpcon);
				$contrato->setlineccon($lineccon);
				$contrato->setpubseccon($pubseccon);
				$contrato->setenlseccon($enlseccon);
				$contrato->setnoseccon($noseccon);
				$contrato->setPeridcon($peridNew);

				$contratos = $contrato->getAll($ano,$est,$abo);;
				$tipo = $contrato->getAllVal(20);

				// $save = $contrato->save();
				// $edit = $contrato->edit();
				if(isset($_GET['idcon'])){
					$idcon = $_GET['idcon'];
					$contrato->setidcon($idcon);
					
					$save = $contrato->edit();
				}else{
					$save = $contrato->save();
					$estado = '51';
					$idcon = $contrato->selsop2($feccon, $perid, $nomcon, $valid, $parid, $linexpcon);
					$contrato->setidcon($idcon[0]['idcon']);
					$contrato->setvalid($estado);
					$contrato->setobstra('Inicio proceso');
					$contrato->setperid($_SESSION["perid"]);
					$contrato->setfectra($feccon);
					$contrato->savetraz();
					$idtra = $contrato->straza($idcon[0]['idcon'], $feccon, $estado, $_SESSION["perid"]);
					$contrato->updtrz2($idtra[0]['idtra'], 1);
					$idcon = $idcon[0]['idcon'];
				}	
			}

			//********************
			//** FIN INFO CONTRATISTA PN
			//**********************

			$p = isset($_POST["p"]) ? $_POST["p"]:NULL;
			$pagoman = isset($_POST['pagoman']) ? $_POST['pagoman'] : false;
				
			$iddpa = isset($_POST['iddpa']) ? $_POST['iddpa'] : false;
			$idpaa = isset($_POST['idpaa']) ? $_POST['idpaa'] : false;
			$area = isset($_POST['are']) ? $_POST['are'] : false;
			$codUNSPSC = isset($_POST['codUNSPSC']) ? $_POST['codUNSPSC'] : false;
			$rubroPre = isset($_POST['rubroPre']) ? substr($_POST['rubroPre'], 1) : false;
			$nombreRubro = isset($_POST['nombreRubro']) ? $_POST['nombreRubro'] : false;
			$objeto_espacios = isset($_POST['objeto']) ? $_POST['objeto'] : false;			
			$objeto = preg_replace('/[\r\n]+/', " ", $objeto_espacios);

			// var_dump($objeto);
			// die();

			$nomcont = isset($_POST['nomcont']) ? $_POST['nomcont'] : false;
			$objdpa = isset($_POST['objdpa']) ? $_POST['objdpa'] : false;			
			$inidpa = isset($_POST['inidpa']) ? $_POST['inidpa'] : false;
			$prodpa = isset($_POST['prodpa']) ? $_POST['prodpa'] : false;
			$fechaInicio = isset($_POST['fechaInicio']) ? $_POST['fechaInicio'] : false;
			$fechaEstimada = isset($_POST['fechaEstimada']) ? $_POST['fechaEstimada'] : false;
			$duracion = isset($_POST['duracion']) ? $_POST['duracion'] : false;
			$duracion2 = isset($_POST['duracion2']) ? $_POST['duracion2'] : false;
			$tipcondpa = isset($_POST['tipcondpa']) ? $_POST['tipcondpa'] : false;		
			$ftefindpa = isset($_POST['ftefindpa']) ? $_POST['ftefindpa'] : false;
			$futic = isset($_POST['futic']) ? $_POST['futic'] : false;
			$valorAsignado = isset($_POST['valorAsignado']) ? $_POST['valorAsignado'] : false;
			$valorVigencia = isset($_POST['valorVigencia']) ? $_POST['valorVigencia'] : false;
			$vigenciaF = isset($_POST['vigenciaF']) ? $_POST['vigenciaF'] : false;
			$duracion = isset($_POST['duracion']) ? $_POST['duracion'] : false;
			$primerm = isset($_POST['primerm']) ? $_POST['primerm'] : false;
			$ultimom = isset($_POST['ultimom']) ? $_POST['ultimom'] : false;
			$valormensual = isset($_POST['valormensual']) ? $_POST['valormensual'] : false;
			$tipcondpa = isset($_POST['tipcondpa']) ? $_POST['tipcondpa'] : false;
			$ftefindpa = isset($_POST['ftefindpa']) ? $_POST['ftefindpa'] : false;

			$observa = isset($_POST['observa']) ? $_POST['observa'] : false;
			$cpc = isset($_POST['cpc']) ? $_POST['cpc'] : null;

			$unicontra = isset($_POST['unicontra']) ? $_POST['unicontra'] : false;
			$ubicacion = isset($_POST['ubicacion']) ? $_POST['ubicacion'] : false;
			$nombreR = isset($_POST['nombreR']) ? $_POST['nombreR'] : false;
			$norgas = isset($_POST['norgas']) ? $_POST['norgas'] : false;
			$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			$metadp = isset($_POST['metadp']) ? $_POST['metadp'] : false;
			$resoludp = isset($_POST['resoludp']) ? $_POST['resoludp'] : false;

			$idpro = isset($_POST['idpro']) ? $_POST['idpro'] : false;
			$idpb = isset($_POST['rad1']) ? $_POST['rad1'] : 0;
			
			$rubroPre = substr($rubroPre,0);
			$soli="NO";

			date_default_timezone_set('America/Bogota');
   			$fec = date("Y-m-d H:i:s");

			// var_dump($idpro);
			// die();

			$solcdp= new pfinan();			
			
			$solcdp->setIddpa($iddpa);
			$solcdp->setIdpaa($idpaa);
			$solcdp->setNicod(0);
			$solcdp->setNObjeto($objeto);
			$solcdp->setNomcont($nomcont);
			$solcdp->setArea($area);
			$solcdp->setCodrub($rubroPre);
			$solcdp->setObjdpa($objdpa);			
			$solcdp->setInidpa($inidpa);
			$solcdp->setProdpa($prodpa);	
			$solcdp->setUnspsc($codUNSPSC);					
			$solcdp->setFecinidpa($fechaInicio);
			$solcdp->setIdpb($idpb);
			// var_dump($idpb);
			// die();

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
			
			$solcdp->setTipcondpa($tipcondpa);
			if ($ftefindpa==653) {
				$solcdp->setFutic($futic);
			}else{
				$solcdp->setFutic(655);
			}
			$solcdp->setFtefindpa($ftefindpa);
			$solcdp->setAsidpa($valorAsignado);			

			$solcdp->setValdpa(0);

			$solcdp->setValvigact($valorVigencia);
			// var_dump($valorVigencia);
			// die();
			$nvalor=$valorVigencia-$valorAsignado;

			$solcdp->setFecfindpa($fechaEstimada);
			$solcdp->setReqvigf($vigenciaF);
			$solcdp->setSolivigf($soli);			

			$solcdp->setIdpro($idpro);
			$solcdp->setUnidad($unicontra);
			$solcdp->setUbicacion($ubicacion);
			$solcdp->setResp($nombreR);
			//$solcdp->setOrdgas(intval($norgas));
			$solcdp->setOrdgas($norgas);
			$solcdp->setCelres($telefono);
			$solcdp->setMailres($email);
			$solcdp->setMetadp($metadp);
			$solcdp->setResoludp($resoludp);
			$solcdp->setCpc($cpc);

			//NUMERO DE PROCESO CONTRACTUAL			

			$sigla=$solcdp->sigla($area);


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
			$solcdp->setIdpro($idpro);
		

			$save = $solcdp->regCdp();
			$nIddpa = $solcdp->mgetOneIddpa();

			// Insertar documentos a solicitar en la tabla
			
			$detpaadoc->editConDpaa($nIddpa[0]["last_insert_id()"],$idcon);
			if($docpernat){ foreach ($docpernat as $dpnj) {
				$detpaadoc->setIddpa($nIddpa[0]["last_insert_id()"]);
				$detpaadoc->setValid($dpnj);
				$detpaadoc->setIdcon($idcon);
				$detpaadoc->setPerid($_SESSION['perid']);
				$detpaadoc->save();
			}}

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


		
			
			//----insertar obligaciones PN
			$obligaCargo = isset($_POST["obligacionCargo"]) ? $_POST["obligacionCargo"]:NULL;
			$obligaOld = isset($_POST["obligacionOld"]) ? $_POST["obligacionOld"]:NULL;
			$obligaNew = isset($_POST["obligacionNew"]) ? $_POST["obligacionNew"]:NULL;
			$cargo = isset($_POST["oblicargo"]) ? $_POST["oblicargo"]:NULL;
			$areacon = $_SESSION['depid'];

			$tipoper=1;

			if ($peridNew>0 AND $cargo>0) {
				$solcdp->deleteObligaGen($cargo);

				foreach ($obligaCargo as $oblic) {				
					$obn = htmlspecialchars($oblic);				
					$solcdp->saveObligaGen($peridNew,$cargo,$areacon,$obn,$tipoper);
				}

				// foreach ($obligaCargo as $oblic) {				
				// 	$obn = htmlspecialchars($oblic);				
				// 	$solcdp->saveObliga($peridNew,$cargo,$areacon,$obn,$tipoper,$nIddpa[0]["last_insert_id()"]);
				// }

				foreach ($obligaOld as $obliO) {				
					$obn = htmlspecialchars($obliO);
					$solcdp->saveObliga($peridNew,$cargo,$areacon,$obn,$tipoper,$nIddpa[0]["last_insert_id()"]);
				}

				foreach ($obligaNew as $oblin) {				
					$obn = htmlspecialchars($oblin);
					$solcdp->saveObliga($peridNew,$cargo,$areacon,$obn,$tipoper,$nIddpa[0]["last_insert_id()"]);
				}

				//---- FIN insertar estudio PN

							//----insertar obligaciones PN
				$estudios = isset($_POST["estudioc"]) ? $_POST["estudioc"]:NULL;	        
		        $solcdp->deleteEstudio($peridNew);
		     

				foreach ($estudios as $estu) {				
					$es = htmlspecialchars($estu);				
					$solcdp->saveEstudio($peridNew,$es);
				}

				//---- FIN insertar estudio PN
			}
	        
	       


			$solcdp->actVCdp($nvalor,$iddpa);
			//$solcdp->traza($iddpa,$idflujo,$observa,$fec,$_SESSION['perid']);
			$solcdp->traza($nIddpa[0]["last_insert_id()"],$idflujo,$observa,$fec,$_SESSION['perid']);


			if($save){
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

		header("Location:".base_url.'paa/index');		
		
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

	function aprobacion(){
		$btn = isset($_POST["boton"]) ? $_POST["boton"]:NULL;
		// var_dump($btn);
		// die();
		if(isset($_POST)){	
			$area = isset($_POST['are']) ? $_POST['are'] : false;		
			$idflu= isset($_POST['idflu']) ? $_POST['idflu'] : NULL;
			$iddpa= isset($_POST['iddpa']) ? $_POST['iddpa'] : NULL;
			$nbogdata= isset($_POST['nbogdata']) ? $_POST['nbogdata'] : NULL;
			$nexpcdp= isset($_POST['nexpcdp']) ? $_POST['nexpcdp'] : NULL;
			$nrp= isset($_POST['nrp']) ? $_POST['nrp'] : 0;
			date_default_timezone_set('America/Bogota');
   			$fec = date("Y-m-d H:i:s");
   			$observa = isset($_POST['observa']) ? $_POST['observa'] : false;

   			$ftefindpa = isset($_POST['ftefindpa']) ? $_POST['ftefindpa'] : NULL;	

   			$arch = isset($_FILES['arch']["name"]) ? $_FILES['arch']["name"]:NULL;
   			$archRP = isset($_FILES['archRP']["name"]) ? $_FILES['archRP']["name"]:NULL;
			$rutcdp = isset($_POST['rutcdp']) ? $_POST['rutcdp'] : NULL;
			$rutrp = isset($_POST['rutrp']) ? $_POST['rutrp'] : NULL;	
			$norgas = isset($_POST['norgas']) ? $_POST['norgas'] : false;		
			//die();
			//Carga de archivo


			if($arch){
				$rutcdp = Utils::opti($_FILES['arch'], date('YmdHis'), "cdp","CDP");
			}

			if($archRP){
				$rutrp = Utils::opti($_FILES['archRP'], date('YmdHis'), "cdp","RP");
			}

			$aprob = new pfinan();
			$idProc=$aprob->getIdproc($iddpa);
			$vflujo=$aprob->getVFlujo($idProc[0]['idpro']);

			//VERIFICAR CONSECUTIVO

			$conNexpcdp=$aprob->getRadiNexpcdp($iddpa);			

			if ($btn=="aprobar") {		
				if ($conNexpcdp[0]['nexpcdp']!=null) {
					$nexpcdp=$conNexpcdp[0]['nexpcdp'];
					// var_dump('si existe');
					// die();
				}else{
					$srp = $aprob->siglaNrp($ftefindpa);
					$sigRP = $srp[0]['vafpf'];
					

					$cnrp = $aprob->conRP(3);
					$consRP = $cnrp[0]['ncexpcdp'];
					$idp=$cnrp[0]['idpaa'];

					$consRP++;
					
					$nConsRP=$consRP."-".$sigRP;

					$nexpcdp=$nConsRP;
					// var_dump('Noo  existe');
					// die();
				}				
				
				$area=$_SESSION['depid'];				

				$aprob->updOrdgas(intval($norgas),$iddpa);
				if ($area==1026) {
					$aprob->conPaa($idp,$consRP);
				}

				//si SD FINANCIERA = 1026
				if ($area==1026) {

					if (($idflu>=$vflujo[0]['mini'] && $idflu<=$vflujo[0]['maxi'])) {
						$idflu++;
						$aprob->aprFlujoSF($iddpa,$idflu,$observa,$fec,$rutcdp,$nbogdata,$rutrp,$nexpcdp,$nrp);
						$aprob->traza($iddpa,$idflu,$observa,$fec,$_SESSION['perid']);
					}

				}else{
					//echo $btn." ".$idflu." ".$vflujo[0]['mini']." ".$vflujo[0]['maxi']." ".$idProc[0]['idpro'];
					//die();
					if (($idflu>=$vflujo[0]['mini'] && $idflu<=$vflujo[0]['maxi'])) {
						$idflu++;
						$aprob->aprFlujo($iddpa,$idflu,$observa,$fec,$rutcdp,$nbogdata,$rutrp);
						$aprob->traza($iddpa,$idflu,$observa,$fec,$_SESSION['perid']);
					}
				}
			}

			if ($btn=="rechazar") {			
				$aprob = new pfinan();	

				if ($area==1026) {
					if ($idflu>$vflujo[0]['mini'] && $idflu<=$vflujo[0]['maxi']) {
						$idflu=$vflujo[0]['mini']+1;
						$aprob->aprFlujoSF($iddpa,$idflu,$observa,$fec,$rutcdp,$nbogdata,$rutrp,$nexpcdp,$nrp);
						$aprob->traza($iddpa,$idflu,$observa,$fec,$_SESSION['perid']);
					}
					
				}else{
					if ($idflu>$vflujo[0]['mini'] && $idflu<=$vflujo[0]['maxi']) {
						$idflu=$vflujo[0]['mini']+1;
						$aprob->aprFlujo($iddpa,$idflu,$observa,$fec,$rutcdp,$nbogdata,$rutrp);
						$aprob->traza($iddpa,$idflu,$observa,$fec,$_SESSION['perid']);
					}					
				}
			}

			if ($btn=="regresar") {
				header("Location:".base_url.'paa/index');
			}
			header("Location:".base_url.'paa/index');
		}
		
	}

	// Eliminar CDP
	public function delcdp(){
		Utils::useraccess('paa/index',$_SESSION['pefid']);
		$pfinan = new Pfinan();
		$vig = $pfinan->vigact();

		$iddpa = isset($_GET['iddpa']) ? $_GET['iddpa']:NULL;
		$pfinan->setIddpa($iddpa);
		$datOne = $pfinan->getOne();
	
		// echo "<pre>";
		// 	var_dump($datOne);
		// echo "</pre>";
		$nvalor1 = $datOne[0]['asidpa'];
		$iddpa2 = $datOne[0]['depidd'];

		$pfinan->setIddpa($datOne[0]['depidd']);
		$datTwo = $pfinan->getOne();

		$nvalor2 = $datTwo[0]['asidpa'];
		$nvalor = ($nvalor1 + $nvalor2);

		//die();
		//$pfinan->eliTraza($iddpa);
		//$pfinan->eliCdp($iddpa);
		$pfinan->updEliCdp($iddpa);
		$pfinan->actVCdp($nvalor,$iddpa2);

		header("Location:".base_url.'paa/index');
	}


	public function apro(){
		Utils::useraccess('paa/index',$_SESSION['pefid']);
		$ari = isset($_POST['areas']) ? $_POST['areas']:NULL;
		$pfinan = new Pfinan();
		$vig = $pfinan->vigact();
		$ntipo = isset($_POST["ntipo"]) ? $_POST["ntipo"]:NULL;
		$idflu = isset($_POST["idflu"]) ? $_POST["idflu"]:NULL;
		$areas = $this->dparea($_SESSION['depid']);
		$areas = $_SESSION['depid'].",".$areas;
		$areas = substr($areas,0,strlen($areas)-1);
		$areas2 = $pfinan->getAreas();
		// echo "<br>".$areas."<br>";
		// echo "<pre>";
		// var_dump($areas2);
		// echo "</pre>";
		// die();
		$areSel = isset($_POST['areSel']) ? $_POST['areSel']:NULL;
		$tip = isset($_GET['tip']) ? $_GET['tip']:0;

		$pfinan->setIdpaa($vig[0]['idpaa']);
		//$area = isset($_POST['areas']) ? $_POST['areas']:null;	
		
		if (isset($_POST['areas'])) {
			$area = $_POST['areas'];
			$_SESSION['area']=$area;
			$pfinan->setArea($area);

			$subareas = $pfinan->getSubAreas();
			$conta=count($subareas);
		}else{
			//$_SESSION['area'] = 1012;
			$area = $_SESSION['depid'];
		}

		if($ari) $areas = $ari;

		$valFlu2 = $pfinan->getFCrea(2);
		$valFlu3 = $pfinan->getFCrea(3);
		$valFlu4 = $pfinan->getFCrea(4);

		$pfcdp = $pfinan->getAll5($_SESSION['depid'],$areSel,$valFlu2.','.$valFlu3);
		$pfrp = $pfinan->getAll6($_SESSION['depid'],$areSel,$valFlu4);
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
		
		if(isset($_GET['new'])){
			$_SESSION['inspaa']=true;			
		}


		//MCDP
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
		
		// echo "<br>".$areas."<br>";
		// echo "<pre>";
		// var_dump($areas2);
		// echo "</pre>";
		// die();

		//$dpie = $pfinan->selgrPie();
		$dxyc = $pfinan->selgrChartxy($vig[0]['idpaa'],$areas);		

		$pfinan->setIdpaa($vig[0]['idpaa']);
		$ConMCdps = $pfinan->getMc();
		$NMcdps = count($ConMCdps);
		// var_dump($ConMCdps);
		// die();



		for ($i=0;$i<count($ConMCdps);$i++){ 
			$mcdt[$i] = $pfinan->getMCdpAll($vig[0]['idpaa'],$ConMCdps[$i]['idmcdp']);
			$sumMCdp[$i] = $pfinan->sumMCdp($vig[0]['idpaa'],$ConMCdps[$i]['idmcdp']);
			$idflu=$mcdt[$i][0]['idflu'];
			$actflu[$i]=$pfinan->getfl($idflu);
			//$selnom[$i] = $pfinan->selNom($mcdt[$i][0]['depidd']);
			// $mcdt[$i] = $pfinan->getMCdpAll2($vig[0]['idpaa'],$areas,$ConMCdps[$i]['idmcdp']);	
			// ${'pfinandOne'.$i} = $pfinan->getMCdpAll2($vig[0]['idpaa'],$areas,$ConMCdps[$i]['idmcdp']);				
		}

		// var_dump($actflu);
		// die();
	
		//$area = isset($_POST['areas']) ? $_POST['areas']:null;	
		
		if (isset($_POST['areas'])) {
			$area = $_POST['areas'];
			// var_dump($area);
			// die();
			$_SESSION['area']=$area;
			$pfinan->setArea($area);

			$subareas = $pfinan->getSubAreas();
			$conta=count($subareas);
			// var_dump($subareas);
			// die();
		
		}else{
			//$_SESSION['area'] = 1012;
			$area = $_SESSION['depid'];
		}

		if($ari) $areas = $ari;
			
		$pfinand = $pfinan->getAll2($areas);

		// echo "<pre>";
		// 	var_dump($pfinand);
		// echo "</pre>";
		// die();
		$sumasi = 0;
		$sumdis = 0;
		$sumcdp = 0;
		$sumrp = 0;
			
		//$_SESSION['pfinand']=$pfinan->getAll();
		// var_dump($pfinand);
		// die();

		//$areas = $pfinan->getAreas();
		//var_dump(count($areas));
		// var_dump($areas);
		// die();



		//AREAS
		$areasutil=Utils::areasu($vig[0]['idpaa']);
		$_SESSION['vigP']=$vig[0]['idpaa'];

		//var_dump($areasutil);
		//die();

		
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

		$valfinD->setDofid(10);
		$metas = $valfinD->getValdom();

		$valfinD->setDofid(11);
		$resols = $valfinD->getValdom();

		$resposable = new Pfinan();
		//ORDENADOR DEL GASTO
		$ordg = $resposable->ordenadorgas();


		if(isset($_GET['new'])){
			$_SESSION['inspaa']=true;			
		}

		require_once 'views/apro.php';
	}

	public function aprorp(){
		Utils::useraccess('paa/index',$_SESSION['pefid']);
		$ari = isset($_POST['areas']) ? $_POST['areas']:NULL;
		$pfinan = new Pfinan();
		$vig = $pfinan->vigact();
		$ntipo = isset($_POST["ntipo"]) ? $_POST["ntipo"]:NULL;
		$idflu = isset($_POST["idflu"]) ? $_POST["idflu"]:NULL;
		$areas = $this->dparea($_SESSION['depid']);
		$areas = $_SESSION['depid'].",".$areas;
		$areas = substr($areas,0,strlen($areas)-1);
		$areas2 = $pfinan->getAreas();

		$areSel = isset($_POST['areSel']) ? $_POST['areSel']:NULL;
		$tip = isset($_GET['tip']) ? $_GET['tip']:0;

		$pfinan->setIdpaa($vig[0]['idpaa']);	
		
		if (isset($_POST['areas'])) {
			$area = $_POST['areas'];
			$_SESSION['area']=$area;
			$pfinan->setArea($area);

			$subareas = $pfinan->getSubAreas();
			$conta=count($subareas);
		}else{
			//$_SESSION['area'] = 1012;
			$area = $_SESSION['depid'];
		}

		if($ari) $areas = $ari;

		$valFlu2 = $pfinan->getFCrea(2);
		$valFlu3 = $pfinan->getFCrea(3);
		$valFlu4 = $pfinan->getFCrea(4);

		$pfcdp = $pfinan->getAll5($_SESSION['depid'],$areSel,$valFlu2.','.$valFlu3);
		$pfrp = $pfinan->getAll6($_SESSION['depid'],"",$valFlu4);
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
		if(isset($_GET['new'])){
			$_SESSION['inspaa']=true;			
		}

		require_once 'views/aprorp.php';
	}

	function libera(){
		//$btn = isset($_POST["boton"]) ? $_POST["boton"]:NULL;
		if(isset($_POST)){	
			$iddpa = isset($_POST['id']) ? $_POST['id'] : NULL;		
			$codrub= isset($_POST['cod']) ? $_POST['cod'] : NULL;
			date_default_timezone_set('America/Bogota');
   			$feclib = date("Y-m-d H:i:s");
   			$estlib = "Pendiente";
   			$arch = isset($_FILES['arch']["name"]) ? $_FILES['arch']["name"]:NULL;
   			$rutlib = isset($_POST['rutcdp']) ? $_POST['rutcdp'] : NULL;

   			 // echo $iddpa.' '.$codrub.' '.$fec.' '.$arch;
			 // die();

			//Carga de archivo
			if($arch){
				$rutlib = Utils::opti($_FILES['arch'], date('YmdHis'), "cdp","Libera");
			}

			$pfinan = new pfinan();
			$pfinan->setFeclib($feclib);
			$pfinan->setRutlib($rutlib);
			$pfinan->setEstlib($estlib);
			$pfinan->setIddpa($iddpa);
			$pfinan->updLibera();


			header("Location:".base_url.'paa/detpaa&codrub='.$codrub.'&tot=1012');
		}		
	}

	public function libver(){
		Utils::useraccess('paa/index',$_SESSION['pefid']);
		$ari = isset($_POST['areas']) ? $_POST['areas']:NULL;
		$pfinan = new Pfinan();
		$vig = $pfinan->vigact();
		$areas = $this->dparea($_SESSION['depid']);
		$areas = $_SESSION['depid'].",".$areas;
		$areas = substr($areas,0,strlen($areas)-1);
		$areas2 = $pfinan->getAreas();

		$areSel = isset($_REQUEST['areSel']) ? $_REQUEST['areSel']:NULL;
		$estlib = isset($_GET['estlib']) ? $_GET['estlib']:"Pendiente";
		
		$tip = isset($_GET['tip']) ? $_GET['tip']:0;

		$pfinan->setIdpaa($vig[0]['idpaa']);	
		
		if (isset($_POST['areas'])) {
			$area = $_POST['areas'];
			$_SESSION['area']=$area;
			$pfinan->setArea($area);

			$subareas = $pfinan->getSubAreas();
			$conta=count($subareas);
		}else{
			//$_SESSION['area'] = 1012;
			$area = $_SESSION['depid'];
		}

		if($ari) $areas = $ari;

		$pfrp = $pfinan->libver($areSel,$estlib);
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
		if(isset($_GET['new'])){
			$_SESSION['inspaa']=true;			
		}

		require_once 'views/libera.php';
	}

	function libest(){
		//$btn = isset($_POST["boton"]) ? $_POST["boton"]:NULL;
		if(isset($_GET)){	
			$iddpa = isset($_GET['iddpa']) ? $_GET['iddpa'] : NULL;		
			$areSel= isset($_GET['areSel']) ? $_GET['areSel'] : NULL;
   			$estlib = isset($_GET['estlib']) ? $_GET['estlib']:"Pendiente";

			$pfinan = new pfinan();
			$pfinan->setEstlib($estlib);
			$pfinan->setIddpa($iddpa);
			$pfinan->updLibest();

			header("Location:".base_url.'paa/libver&areSel='.$areSel);
		}		
	}

	function apromas(){

		// var_dump($_POST);
		// die();
		$btn = isset($_POST["btn"]) ? $_POST["btn"]:NULL;
		if(isset($_POST)){	
			$chk[] = isset($_POST['chk']) ? $_POST['chk'] : NULL;
			$idf[] = isset($_POST['idf']) ? $_POST['idf'] : NULL;
			$fte[] = isset($_POST['fte']) ? $_POST['fte'] : NULL;
			date_default_timezone_set('America/Bogota');
   			$fec = date("Y-m-d H:i:s");
   			
   			if($chk){
				for ($i=0;$i<count($chk[0]);$i++) {
					$idflu= isset($idf[0][$i]) ? $idf[0][$i] : NULL;
					$iddpa= isset($chk[0][$i]) ? $chk[0][$i]:NULL;
					$ftefindpa= isset($fte[0][$i]) ? $fte[0][$i]:NULL;
					$nrp= isset($_POST['nrp']) ? $_POST['nrp'] : 0;

					$aprob = new pfinan();
					$idProc=$aprob->getIdproc($iddpa);
					$vflujo=$aprob->getVFlujo($idProc[0]['idpro']);

					//VERIFICAR CONSECUTIVO

					$conNexpcdp=$aprob->getRadiNexpcdp($iddpa);			

					if ($btn=="aprobar") {		
						if ($conNexpcdp[0]['nexpcdp']!=null) {
							$nexpcdp=$conNexpcdp[0]['nexpcdp'];
						}else{
							$srp = $aprob->siglaNrp($ftefindpa);
							$sigRP = $srp[0]['vafpf'];
							
							$cnrp = $aprob->conRP(3);
							$consRP = $cnrp[0]['ncexpcdp'];
							$idp=$cnrp[0]['idpaa'];

							$consRP++;
							
							$nConsRP=$consRP."-".$sigRP;

							$nexpcdp=$nConsRP;
						}				

						$area=$_SESSION['depid'];				

						if ($area==1026) {
							$aprob->conPaa($idp,$consRP);
						}

						//si SD FINANCIERA = 1026
						if ($area==1026) {

							if (($idflu>=$vflujo[0]['mini'] && $idflu<=$vflujo[0]['maxi'])) {
								$idflu++;
								$aprob->aprFluSFM($iddpa,$idflu,$nexpcdp,$nrp);
								$aprob->traza($iddpa,$idflu,'',$fec,$_SESSION['perid']);
							}

						}else{
							if (($idflu>=$vflujo[0]['mini'] && $idflu<=$vflujo[0]['maxi'])) {
								$idflu++;
								$aprob->aprFluM($iddpa,$idflu);
								$aprob->traza($iddpa,$idflu,'',$fec,$_SESSION['perid']);
							}
						}					
					}

					if ($btn=="rechazar") {			
						$aprob = new pfinan();	
						if ($area==1026) {
							if ($idflu>$vflujo[0]['mini'] && $idflu<=$vflujo[0]['maxi']) {
								$idflu=$vflujo[0]['mini']+1;
								// echo "<br>FLUJO: ".$iddpa." ".$idflu." '' ".$fec." ".$nexpcdp." ".$nrp;
								// echo "<br>TRAZA: ".$iddpa." ".$idflu." '' ".$fec." ".$_SESSION['perid'];
								$aprob->aprFluSFM($iddpa,$idflu,$nexpcdp,$nrp);
								$aprob->traza($iddpa,$idflu,'',$fec,$_SESSION['perid']);
							}
							
						}else{
							if ($idflu>$vflujo[0]['mini'] && $idflu<=$vflujo[0]['maxi']) {
								$idflu=$vflujo[0]['mini']+1;
								// echo "<br>FLUJO: ".$iddpa." ".$idflu." '' ".$fec;
								// echo "<br>TRAZA: ".$iddpa." ".$idflu." '' ".$fec." ".$_SESSION['perid'];
								$aprob->aprFluM($iddpa,$idflu);
								$aprob->traza($iddpa,$idflu,'',$fec,$_SESSION['perid']);
							}					
						}				
					}
				}
			}else{

			}
			header("Location:".base_url.'paa/apro');
		}		
	}

	function aproMCdp(){

		$btn = isset($_POST["boton"]) ? $_POST["boton"]:NULL;
		
		if(isset($_POST)){	
			$area = isset($_POST['are']) ? $_POST['are'] : false;		
			$idflu= isset($_POST['idflu']) ? $_POST['idflu'] : NULL;

			$iddpa= isset($_POST['iddpa']) ? $_POST['iddpa'] : NULL;
			$nbogdata= isset($_POST['nbogdata']) ? $_POST['nbogdata'] : NULL;
			$nexpcdp= isset($_POST['nexpcdp']) ? $_POST['nexpcdp'] : NULL;
			$nrp= isset($_POST['nrp']) ? $_POST['nrp'] : 0;
			date_default_timezone_set('America/Bogota');
   			$fec = date("Y-m-d H:i:s");
   			$observa = isset($_POST['observa']) ? $_POST['observa'] : false;

   			$ftefindpa = isset($_POST['ftefindpa']) ? $_POST['ftefindpa'] : NULL;
            //var_dump($ftefindpa);
			// die();	

   			$arch = isset($_FILES['arch']) ? $_FILES['arch']:NULL;
   			$archRP = isset($_FILES['archRP']["name"]) ? $_FILES['archRP']["name"]:NULL;
			$rutcdp = isset($_POST['rutcdp']) ? $_POST['rutcdp'] : NULL;
			$rutrp = isset($_POST['rutrp']) ? $_POST['rutrp'] : NULL;	
			$norgas = isset($_POST['norgas']) ? $_POST['norgas'] : false;		
			// die();
			//Carga de archivo

			// var_dump($_POST);
			// var_dump($arch);
			// var_dump($archRP);
			// var_dump($rutcdp);
			// die();
			


			if($arch){
				$rutcdp = Utils::opti($_FILES['arch'], date('YmdHis'), "cdp","CDPM");
				// var_dump('aqui');
				// die();
			}

			// var_dump('afuera');
			// 	die();

			if($archRP){
				$rutrp = Utils::opti($_FILES['archRP'], date('YmdHis'), "cdp","RPM");
			}			

			$aprob = new pfinan();

			$concon=0;//controlar consecutivo rp nexpcdp

			for ($i=0;$i<count($iddpa);$i++){ 	
				$idflu= isset($_POST['idflu']) ? $_POST['idflu'] : NULL;		
				//$codrub = explode(";",$codrub1[$i]);
				// var_dump(($codrub1[$i]));
				// die();
				// $pfinan->setCodrub($codrub1[$i]);
				// $pfinan->setIddpa($iddpa[$i]);
				//${'pfinandOne'.$i} = $pfinan->getOne();
				//$resposable->insRubsPCdp($selrub[1],$nnum);	
				//$mcdt[$i] = $resposable->getPmcdp($mcd[$i]['valid']);	
				$idProc[$i]=$aprob->getIdproc($iddpa[$i]);
				$vflujo=$aprob->getVFlujo($idProc[$i][0]['idpro']);	

				//VERIFICAR CONSECUTIVO
				$conNexpcdp=$aprob->getRadiNexpcdp($iddpa[$i]);	

				if ($btn=="aprobar") {

					if ($conNexpcdp[0]['nexpcdp']!=null) {
						$nexpcdp=$conNexpcdp[0]['nexpcdp'];
						
					}else{

						$srp = $aprob->siglaNrp($ftefindpa[$i]);						
						$sigRP = $srp[0]['vafpf'];
						$cnrp = $aprob->conRP(3);
						$consRP = $cnrp[0]['ncexpcdp'];
						$idp=$cnrp[0]['idpaa'];
						if ($concon==0) {
							$consRP++;
							$concon++;
						}
						
						
						$nConsRP=$consRP."-".$sigRP;

						$nexpcdp=$nConsRP;
						
						
					}
					$area=$_SESSION['depid'];								

					$aprob->updOrdgas(intval($norgas),$iddpa[$i]);
						
					if ($area==1026) {
						$aprob->conPaa($idp,$consRP);
					}					

					//si SD FINANCIERA = 1026
					if ($area==1026) {

						if (($idflu>=$vflujo[0]['mini'] && $idflu<=$vflujo[0]['maxi'])) {
							$idflu++;
							$aprob->aprFlujoSF($iddpa[$i],$idflu,$observa,$fec,$rutcdp,$nbogdata,$rutrp,$nexpcdp,$nrp);
							$aprob->traza($iddpa[$i],$idflu,$observa,$fec,$_SESSION['perid']);
						}

					}else{

						if (($idflu>=$vflujo[0]['mini'] && $idflu<=$vflujo[0]['maxi'])) {
							$idflu++;
							$aprob->aprFlujo($iddpa[$i],$idflu,$observa,$fec,$rutcdp,$nbogdata,$rutrp);
							$aprob->traza($iddpa[$i],$idflu,$observa,$fec,$_SESSION['perid']);
						}
					}
				}

				// die();


				if ($btn=="rechazar") {			
					$aprob = new pfinan();	

					if ($area==1026) {
						if ($idflu>$vflujo[0]['mini'] && $idflu<=$vflujo[0]['maxi']) {
							$idflu=$vflujo[0]['mini']+1;
							$aprob->aprFlujoSF($iddpa[$i],$idflu,$observa,$fec,$rutcdp,$nbogdata,$rutrp,$nexpcdp,$nrp);
							$aprob->traza($iddpa[$i],$idflu,$observa,$fec,$_SESSION['perid']);
						}
						
					}else{
						if ($idflu>$vflujo[0]['mini'] && $idflu<=$vflujo[0]['maxi']) {
							$idflu=$vflujo[0]['mini']+1;
							$aprob->aprFlujo($iddpa[$i],$idflu,$observa,$fec,$rutcdp,$nbogdata,$rutrp);
							$aprob->traza($iddpa[$i],$idflu,$observa,$fec,$_SESSION['perid']);
						}					
					}
				}	
							
			} //ENd for					

			

			if ($btn=="regresar") {
				header("Location:".base_url.'paa/index');
			}
			header("Location:".base_url.'paa/index');
		}
		
	}


	public function liberarRub(){

		// var_dump($_GET);
		// die();

		Utils::useraccess('paa/index',$_SESSION['pefid']);

		$pfinan = new Pfinan();
		$vig = $pfinan->vigact();
		// $dpie = $pfinan->selgrPie();
		// $dxyc = $pfinan->selgrChartxy($vig[0]['idpaa']);

		$pfinan->setIdpaa($vig[0]['idpaa']);

		// var_dump($_GET);
		// die();

		$_SESSION['apro']=null;

		if(isset($_GET['apro'])){
			
			$_SESSION['apro']=1;
		}	
		
		if (isset($_GET['codrub'])) {

			$codrub = $_GET['codrub'];
			$iddpa= $_GET['iddpa'];
			$_SESSION['iddpa']=$iddpa;

			// var_dump($iddpa);
			// die();

			$area = $_SESSION['depid'];
			$pfinan->setArea($area);
			$pfinan->setCodrub($codrub);
			$pfinan->setIddpa($iddpa);
			$dpie = $pfinan->selgrPie();



			$dxyc = $pfinan->selgrChartxy($vig[0]['idpaa'], $area);

			$subareas = $pfinan->getSubAreas();
			$conta=count($subareas);
			// var_dump($subareas);
			// die();

			$dimensiones=0;
			$dependen=[];
			$codi=[];
			$indice="[]";
		
			if ($conta>0) {
				$indice .= "[]";
				for ($i=0; $i < $conta ; $i++) { 
					$j=0;
					$dependen[0][$i][$j]=$subareas[$i]['valnom'];
					$dependen[0][$i][$j+1]=$subareas[$i]['valid'];
					$valcodi=$dependen[0][$i][$j+1];
					array_push($codi, $valcodi);	

				}
				$contreg = count($dependen[0]);

				$dep=[];
				$dep=$dependen;
				$lgcodi=count($codi);


				$arreglo=[];
				if($contreg>0){
					for ($i=0; $i < $contreg; $i++) { 
						$j=0;

						if($dependen[0][$i][$j+1]!=null){
							$pfinan->setArea($dependen[0][$i][$j+1]);
							//$pfinan->setArea(1021);
							$subareas1 = $pfinan->getSubAreas();
							array_push($arreglo, $subareas1);							
						}

					}
				}				

			}else{
				
			}
		
		}else{
			//$area = $_POST['areas'] = null;
		}	



		$pfinand = $pfinan->getAll2($area);	
		$pfinandOne = $pfinan->getOne();
		// var_dump($pfinandOne);
		// die();
		$cuota = $pfinan->getCuota($iddpa);

		// var_dump($pfinandOne);
		// die();

		// var_dump($pfinandOne[0]['idflu']);
		// die();

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

		$valfinD->setDofid(10);
		$metas = $valfinD->getValdom();

		$valfinD->setDofid(11);
		$resols = $valfinD->getValdom();
		

			
		//$_SESSION['pfinand']=$pfinan->getAll();
		// var_dump($pfinandOne);
		// die();

		$areas = $pfinan->getAreas();
		$areas2 = $pfinan->getAreas();

		// var_dump(count($areas));
		// var_dump($areas);
		// die();



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
			require_once 'views/liberar.php';

		}		
		
	}

	public function editLibera(){
		Utils::useraccess('paa/index',$_SESSION['pefid']);
		// var_dump($_POST["boton"]);
		// die();
		$btn = isset($_POST["boton"]) ? $_POST["boton"]:NULL;


		// echo "Aca le entra en uno";	
		
		$p = isset($_POST["p"]) ? $_POST["p"]:NULL;
		$pagoman = isset($_POST['pagoman']) ? $_POST['pagoman'] : false;

		$are = isset($_POST['marea']) ? $_POST['marea'] : false;
		$areas = isset($_POST['areas']) ? $_POST['areas'] : false;

		$valiberar = isset($_POST['valiberar']) ? $_POST['valiberar'] : false;

		$iddpa = isset($_POST['iddpa']) ? $_POST['iddpa'] : false;
		$nomcont = isset($_POST['nomcont']) ? $_POST['nomcont'] : false;
		$codUNSPSC = isset($_POST['codUNSPSC']) ? $_POST['codUNSPSC'] : false;
		$rubroPre = isset($_POST['rubroPre']) ? substr($_POST['rubroPre'], 1) : false;
		$nombreRubro = isset($_POST['nombreRubro']) ? $_POST['nombreRubro'] : false;
		//$objeto = isset($_POST['objeto']) ? $_POST['objeto'] : false;
		$objeto_espacios = isset($_POST['objeto']) ? $_POST['objeto'] : false;			
		$objeto = preg_replace('/[\r\n]+/', " ", $objeto_espacios);

		$objdpa = isset($_POST['objdpa']) ? $_POST['objdpa'] : false;			
		$inidpa = isset($_POST['inidpa']) ? $_POST['inidpa'] : false;
		$prodpa = isset($_POST['prodpa']) ? $_POST['prodpa'] : false;
		$fechaInicio = isset($_POST['fechaInicio']) ? $_POST['fechaInicio'] : false;
		$fechaEstimada = isset($_POST['fechaEstimada']) ? $_POST['fechaEstimada'] : false;
		$duracion = isset($_POST['duracion']) ? $_POST['duracion'] : false;
		$duracion2 = isset($_POST['duracion2']) ? $_POST['duracion2'] : false;
		$tipcondpa = isset($_POST['tipcondpa']) ? $_POST['tipcondpa'] : false;

		$ftefindpa = isset($_POST['ftefindpa']) ? $_POST['ftefindpa'] : false;
		$ffutic = isset($_POST['futic']) ? $_POST['futic'] : false;
		$observa = isset($_POST['observa']) ? $_POST['observa'] : false;

		$valorAsignado = isset($_POST['valorAsignado']) ? $_POST['valorAsignado'] : false;
		$valorVigencia = isset($_POST['valorVigencia']) ? $_POST['valorVigencia'] : false;
		$vigenciaF = isset($_POST['vigenciaF']) ? $_POST['vigenciaF'] : false;
		$unicontra = isset($_POST['unicontra']) ? $_POST['unicontra'] : false;
		$ubicacion = isset($_POST['ubicacion']) ? $_POST['ubicacion'] : false;
		$nombreR = isset($_POST['nombreR']) ? $_POST['nombreR'] : false;
		$norgas = isset($_POST['norgas']) ? $_POST['norgas'] : false;	
		$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
		$email = isset($_POST['email']) ? $_POST['email'] : false;
		$idpro = isset($_POST['idpro']) ? $_POST['idpro'] : false;
		$hidpro = isset($_POST['hidpro']) ? $_POST['hidpro'] : false;
		$hidflu = isset($_POST['idflu']) ? $_POST['idflu'] : false;
		$hdepid = isset($_POST['depidd']) ? $_POST['depidd'] : null;
		$metadp = isset($_POST['metadp']) ? $_POST['metadp'] : null;
		$resoludp = isset($_POST['resoludp']) ? $_POST['resoludp'] : null;

		$editpf = new Pfinan();

		$Vidflu = $editpf->iniflu($idpro);
		$idflu = $Vidflu[0]['mini'];	

		$nuevoSaldoRp=(intval($valorAsignado)-intval($valiberar));

		$saldoPadre = $editpf->saldoPa($hdepid);
		$nuevoSalPa = (intval($saldoPadre[0]['asidpa'])+intval($valiberar));

		// var_dump($nuevoSalPa);
		// var_dump($valiberar);
		// var_dump($nuevoSaldoRp);
		// var_dump($hdepid);
		// var_dump($iddpa);
		// var_dump($saldoPadre);
		
		// die();		

		if ($idpro==$hidpro) {
			$idflu=$hidflu;		
			// var_dump('sin cambios');				
		}else{
			if($hdepid!=null){//ES CDP HIJO				
				$idflu = $Vidflu[0]['mini']+1;
				// var_dump('cambia flujo y es hijo');
				// var_dump($idflu);
			}else{
				// if ($hidflu==$Vidflu[0]['mini']+1) {
				// 	var_dump('esta para aprobacion del area paso2');
				// }
				$idflu = $Vidflu[0]['mini'];
				//var_dump('cambia flujo y es padre');
			}
		}
		//die();

		// echo "Aca le entra en dos<br>";	
		// var_dump('no');
		// var_dump($hdepid);
		// die();
		
		$editpf->setIddpa($iddpa);			

		if ($pagoman=="pagoman") {	
			$duracion=$duracion2;				
			$editpf->setNmesdpa(0);
			$editpf->setCuodpa($duracion2);				

			if($p){					
				$editpf->elimCuota($iddpa);
				for ($i=0;$i<count($p);$i++){   						
					$editpf->insCuota($iddpa,$p[$i]);						
				}
			}				
		}else{
			$editpf->setNmesdpa($duracion);
			$editpf->setCuodpa(0);				
		}

		if($are)
			$editpf->setArea($are);
		else
			$editpf->setArea($areas);
			$editpf->setNomcont($nomcont);
			$editpf->setNObjeto($objeto);
			$editpf->setCodrub($rubroPre);
			$editpf->setObjdpa($objdpa);
			$editpf->setInidpa($inidpa);
			$editpf->setProdpa($prodpa);	
			$editpf->setUnspsc($codUNSPSC);					
			$editpf->setFecinidpa($fechaInicio);
			$editpf->setTipcondpa($tipcondpa);
			$editpf->setFtefindpa($ftefindpa);
			$editpf->setObservaciones($observa);
			$editpf->setAsidpa($valorAsignado);
			$editpf->setValvigact($valorVigencia);
			$editpf->setFecfindpa($fechaEstimada);
			$editpf->setReqvigf($vigenciaF);			
			$editpf->setUnidad($unicontra);
			$editpf->setUbicacion($ubicacion);
			$editpf->setResp($nombreR);
			$editpf->setOrdgas($norgas);

			$editpf->setIdpro($idpro);
			$editpf->setIdflu($idflu);

			$editpf->setMetadp($metadp);
			$editpf->setResoludp($resoludp);

			$save = $editpf->liberar($nuevoSaldoRp,$nuevoSalPa,$hdepid,$iddpa);

			// echo "<br>Aca le entra en tres<br>";	
			// var_dump($save);
			// die();
		if($save){
			$_SESSION['actpaa']="si";
			
			$insFut= new pfinan();
			$insFut->setCodIddpa($_SESSION['iddpa']);

			if ($ffutic != null) {
				// var_dump($ffutic);
				// var_dump($_SESSION['iddpa']);
				
				// die();
				$insFut->setFfutic($ffutic);
				$inf=$insFut->actFutic();
			}
			
		}else{
			$_SESSION['actpaa']="no";
		}

		if (isset($_SESSION['editAntp'])) {
			header("Location:".base_url.'paa/index');
		}else{
			header("Location:".base_url.'paa/index');
		}
		
	}

	public function cargaPaa(){
		require_once 'views/cargapaa.php';
	}

	public function subirArchpaa(){

		//******************************
		//NUEVA LIBRERIA DE EXCEL PhpSpreadsheet		
		//******************************
		
		date_default_timezone_set('America/Bogota');
   		$fecSis = date("Y-m-d H:i:s");
   		$masi = new Masi();
   		$cexcel = new Pfinan();
   				
		$html2 = NULL;
		$html3 = NULL;
		$ae = 0;
		$ane = 0;
		$dr = 0;

		$arcexc = isset($_FILES['arcexc']['name']) ? $_FILES['arcexc']['name'] : NULL;

		if ($arcexc && $_FILES['arcexc']['error'] == UPLOAD_ERR_OK) {
		    $ruta_temporal = $_FILES['arcexc']['tmp_name'];

		    // Ahora puedes cargar el archivo directamente desde la ubicación temporal con PhpSpreadsheet
		    $arcexc2 = IOFactory::load($ruta_temporal);

		    // Aquí puedes procesar el archivo Excel según tus necesidades
		    // Por ejemplo, acceder a las hojas de cálculo, leer celdas, etc.
		    // $hoja = $arcexc2->getActiveSheet();
		    $hoja = $arcexc2->getSheet(0);
		    //$valorCeldaA1 = $hoja->getCell('A2')->getValue();
		    //var_dump($valorCeldaA1);



			$sheet =  $arcexc2->getSheet(0); 
			$highestRow = $sheet->getHighestRow(); 
			$highestColumn = $sheet->getHighestColumn();

		   

		    //echo 'Subio archivo.';

		    // ... haz lo que necesites con la información del archivo Excel ...
		} else {
		    // Manejar el caso en que no se ha subido correctamente el archivo
		    echo 'Error al subir el archivo.';
		}

		for ($row = 2; $row <= $highestRow; $row++){
			$unspsc = $sheet->getCell("a".$row)->getValue();
			$objeto_espacios=$objeto = $sheet->getCell("b".$row)->getValue();				
			$objeto = preg_replace('/[\r\n]+/', " ", $objeto_espacios);
			// Aplicamos la sustitución de punto y coma por coma.
			$objeto = preg_replace('/;/', ",", $objeto);
			$objdpa=36;

			$codigo = $sheet->getCell("c".$row)->getValue();
			//$codigo = substr($codigo, 2);

			$cadena = $codigo;

			// Encontrar la posición del primer '2'
			$posicion = strpos($cadena, '2');

			// Verificar si se encontró el '2'
			if ($posicion !== false) {
			    // Obtener la parte de la cadena desde el primer '2' hasta el final
			    $nuevaCadena = substr($cadena, $posicion);			   
			    $codigo = $nuevaCadena;
			} 


			// var_dump($codigo);
			// die();

			$rubro = $sheet->getCell("d".$row)->getValue();
			$meta = $sheet->getCell("e".$row)->getValue();

			if ($meta>0) {
				
			}else{
				$meta=0;
			}

			$resolucion = $sheet->getCell("f".$row)->getValue();

			if ($resolucion>0) {
				
			}else{
				$resolucion=0;
			}

			$compromiso = $sheet->getCell("g".$row)->getValue();
			$contratista = $sheet->getCell("h".$row)->getValue();
			$asignacion = $sheet->getCell("i".$row)->getValue();			
			$comprometido = $sheet->getCell("j".$row)->getValue();
			if ($comprometido>0) {
				
			}else{
				$comprometido=0;
			}

			$modalidad = $sheet->getCell("k".$row)->getValue();
			$codmodalidad = $sheet->getCell("l".$row)->getValue();
			$fuentefinan = $sheet->getCell("m".$row)->getValue();
			$codfuente = $sheet->getCell("n".$row)->getValue();
			$resfutic = $sheet->getCell("o".$row)->getValue();

			$fecini = $sheet->getCell("p".$row)->getValue();		
			//$fecini = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($fecini)); 

			$fecfin = $sheet->getCell("q".$row)->getValue();
			//$fecfin = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($fecfin));



			$area = $sheet->getCell("r".$row)->getValue();
			$codarea = $sheet->getCell("s".$row)->getValue();
			$unidad = $sheet->getCell("t".$row)->getValue();
			$ubicacion = $sheet->getCell("u".$row)->getValue();
			$responsable = $sheet->getCell("v".$row)->getValue();
			$telefono = $sheet->getCell("w".$row)->getValue();
			$email = $sheet->getCell("x".$row)->getValue();
			$ordenador = $sheet->getCell("y".$row)->getValue();
			$proceso = $sheet->getCell("z".$row)->getValue();
			$codproceso = $sheet->getCell("aa".$row)->getValue();
			$estado = $sheet->getCell("ab".$row)->getValue();
			$codnuevo = $sheet->getCell("ac".$row)->getValue();
			$nexpcdp = $sheet->getCell("ad".$row)->getValue();
			$nrp = $sheet->getCell("ae".$row)->getValue();
			$nbogdata = $sheet->getCell("af".$row)->getValue();
			$ncdp = $sheet->getCell("ag".$row)->getValue();
			$estadofin = $sheet->getCell("ah".$row)->getValue();
			$iddpa = $sheet->getCell("ai".$row)->getValue();			

			$cexcel->setUnspsc($unspsc);
			$cexcel->setCodrub($codigo);

			$codimeta1=$cexcel->busVafid(10,$meta);
			if (count($codimeta1)>0) {
				
				$codimeta=$codimeta1[0]['vafid'];
			}else{
				$codimeta=2000;
			}

			$codiresol1=$cexcel->busVafid(11,$resolucion);
			if (count($codiresol1)>0) {
				$codiresol=$codiresol1[0]['vafid'];
				// var_dump($codimeta);
				// die();
			}else{
				$codiresol=2100;
			}
			
			
			$cexcel->setMetadp($codimeta);
			$cexcel->setResoludp($codiresol);
			$cexcel->setCompro($compromiso);
			$cexcel->setNomcont($contratista);
			$cexcel->setPrrp($comprometido);
			$cexcel->setIddpa($iddpa);

			if ($iddpa>0) {
				$editar="SI";
			}else{
				$editar="NO";
			}

			$vigencia = $cexcel->vigact();
			$vig=$vigencia[0]['idpaa'];

			// var_dump($vig);
			// die();	


			$cexcel->edPlanoPaa($unspsc,$objeto,$objdpa,$codigo,$rubro,$meta,$resolucion,$compromiso,$contratista,$asignacion,$comprometido,$modalidad,$codmodalidad,$fuentefinan,$codfuente,$resfutic,$fecini,$fecfin,$area,$codarea,$unidad,$ubicacion,$responsable,$telefono,$email,$ordenador,$proceso,$codproceso,$estado,$codnuevo,$nexpcdp,$nrp,$nbogdata,$ncdp,$estadofin,$iddpa,$editar,$vig,$codimeta,$codiresol);
			// var_dump($sheet->getCell("J".$row));
		}//CIERRA FOR


		//******************************
		// FIN NUEVA LIBRERIA DE EXCEL PhpSpreadsheet		
		//******************************

		require_once 'views/cargapaa.php';
	}

		public function subirPlanoAntp(){

		//******************************
		//NUEVA LIBRERIA DE EXCEL PhpSpreadsheet		
		//******************************
		
		date_default_timezone_set('America/Bogota');
   		$fecSis = date("Y-m-d H:i:s");
   		$masi = new Masi();
   		$cexcel = new Pfinan();
   				
		$html2 = NULL;
		$html3 = NULL;
		$ae = 0;
		$ane = 0;
		$dr = 0;

		$arcexc = isset($_FILES['arcexc']['name']) ? $_FILES['arcexc']['name'] : NULL;

		if ($arcexc && $_FILES['arcexc']['error'] == UPLOAD_ERR_OK) {
		    $ruta_temporal = $_FILES['arcexc']['tmp_name'];

		    // Ahora puedes cargar el archivo directamente desde la ubicación temporal con PhpSpreadsheet
		    $arcexc2 = IOFactory::load($ruta_temporal);

		    // Aquí puedes procesar el archivo Excel según tus necesidades
		    // Por ejemplo, acceder a las hojas de cálculo, leer celdas, etc.
		    // $hoja = $arcexc2->getActiveSheet();
		    $hoja = $arcexc2->getSheet(0);
		    //$valorCeldaA1 = $hoja->getCell('A2')->getValue();
		    //var_dump($valorCeldaA1);

			$sheet =  $arcexc2->getSheet(0); 
			$highestRow = $sheet->getHighestRow(); 
			$highestColumn = $sheet->getHighestColumn();		   

		    //echo 'Subio archivo.';

		    // ... haz lo que necesites con la información del archivo Excel ...
		} else {
		    // Manejar el caso en que no se ha subido correctamente el archivo
		    echo 'Error al subir el archivo.';
		}	

		for ($row = 2; $row <= $highestRow; $row++){
			$unspsc = $sheet->getCell("a".$row)->getValue();
			$objeto_espacios=$objeto = $sheet->getCell("b".$row)->getValue();				
			$objeto = preg_replace('/[\r\n]+/', " ", $objeto_espacios);
			// Aplicamos la sustitución de punto y coma por coma.
			$objeto = preg_replace('/;/', ",", $objeto);
			$objdpa=36;

			$codigo = $sheet->getCell("c".$row)->getValue();
			//$codigo = substr($codigo, 2);

			$cadena = $codigo;

			// Encontrar la posición del primer '2'
			$posicion = strpos($cadena, '2');

			// Verificar si se encontró el '2'
			if ($posicion !== false) {
			    // Obtener la parte de la cadena desde el primer '2' hasta el final
			    $nuevaCadena = substr($cadena, $posicion);			   
			    $codigo = $nuevaCadena;
			} 


			// var_dump($codigo);
			// die();

			$rubro = $sheet->getCell("d".$row)->getValue();
			$meta = $sheet->getCell("e".$row)->getValue();

			if ($meta>0) {
				
			}else{
				$meta=0;
			}

			$resolucion = $sheet->getCell("f".$row)->getValue();

			if ($resolucion>0) {
				
			}else{
				$resolucion=0;
			}

			$compromiso = $sheet->getCell("g".$row)->getValue();
			$contratista = $sheet->getCell("h".$row)->getValue();
			$asignacion = $sheet->getCell("i".$row)->getValue();			
			$comprometido = $sheet->getCell("j".$row)->getValue();
			if ($comprometido>0) {
				
			}else{
				$comprometido=0;
			}

			$modalidad = $sheet->getCell("k".$row)->getValue();
			$codmodalidad = $sheet->getCell("l".$row)->getValue();
			$fuentefinan = $sheet->getCell("m".$row)->getValue();
			$codfuente = $sheet->getCell("n".$row)->getValue();
			$resfutic = $sheet->getCell("o".$row)->getValue();

			$fecini = $sheet->getCell("p".$row)->getValue();		
			//$fecini = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($fecini)); 

			$fecfin = $sheet->getCell("q".$row)->getValue();
			//$fecfin = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($fecfin));



			$area = $sheet->getCell("r".$row)->getValue();
			$codarea = $sheet->getCell("s".$row)->getValue();
			$unidad = $sheet->getCell("t".$row)->getValue();
			$ubicacion = $sheet->getCell("u".$row)->getValue();
			$responsable = $sheet->getCell("v".$row)->getValue();
			$telefono = $sheet->getCell("w".$row)->getValue();
			$email = $sheet->getCell("x".$row)->getValue();
			$ordenador = $sheet->getCell("y".$row)->getValue();
			$proceso = $sheet->getCell("z".$row)->getValue();
			$codproceso = $sheet->getCell("aa".$row)->getValue();
			$estado = $sheet->getCell("ab".$row)->getValue();
			$codnuevo = $sheet->getCell("ac".$row)->getValue();
			$nexpcdp = $sheet->getCell("ad".$row)->getValue();
			$nrp = $sheet->getCell("ae".$row)->getValue();
			$nbogdata = $sheet->getCell("af".$row)->getValue();
			$ncdp = $sheet->getCell("ag".$row)->getValue();
			$estadofin = $sheet->getCell("ah".$row)->getValue();
			$iddpa = $sheet->getCell("ai".$row)->getValue();			

			$cexcel->setUnspsc($unspsc);
			$cexcel->setCodrub($codigo);

			$codimeta1=$cexcel->busVafid(10,$meta);
			if (count($codimeta1)>0) {
				
				$codimeta=$codimeta1[0]['vafid'];
			}else{
				$codimeta=2000;
			}

			$codiresol1=$cexcel->busVafid(11,$resolucion);
			if (count($codiresol1)>0) {
				$codiresol=$codiresol1[0]['vafid'];
				// var_dump($codimeta);
				// die();
			}else{
				$codiresol=2100;
			}			
			
			$cexcel->setMetadp($codimeta);
			$cexcel->setResoludp($codiresol);
			$cexcel->setCompro($compromiso);
			$cexcel->setNomcont($contratista);
			$cexcel->setPrrp($comprometido);
			$cexcel->setIddpa($iddpa);

			if ($iddpa>0) {
				$editar="SI";
			}else{
				$editar="NO";
			}

			$vigencia = $cexcel->vigactAntp();
			$vig=$vigencia[0]['idpaa'];	

		// 	var_dump($editar);
		// die();

			$cexcel->edPlanoAnt($unspsc,$objeto,$objdpa,$codigo,$rubro,$meta,$resolucion,$compromiso,$contratista,$asignacion,$comprometido,$modalidad,$codmodalidad,$fuentefinan,$codfuente,$resfutic,$fecini,$fecfin,$area,$codarea,$unidad,$ubicacion,$responsable,$telefono,$email,$ordenador,$proceso,$codproceso,$estado,$codnuevo,$nexpcdp,$nrp,$nbogdata,$ncdp,$estadofin,$iddpa,$editar,$vig,$codimeta,$codiresol);
			// var_dump($sheet->getCell("J".$row));
		}//CIERRA FOR		

		require_once 'views/cargaantp.php';
	}

	public function delMcdp(){
		Utils::useraccess('paa/index',$_SESSION['pefid']);
		

		$iddpa = isset($_GET["iddpa"]) ? $_GET["iddpa"]:NULL;
		$pfinan = new Pfinan();

		// var_dump(count($iddpa));
		// die();

		$vig = $pfinan->vigact();

		for ($i=0;$i<count($iddpa);$i++){ 
			$pfinan->setIddpa($iddpa[$i]);
			$datOne = $pfinan->getOne();
			$nvalor1 = $datOne[0]['asidpa'];
			$iddpa2 = $datOne[0]['depidd'];

			$pfinan->setIddpa($datOne[0]['depidd']);
			$datTwo = $pfinan->getOne();
			$nvalor2 = $datTwo[0]['asidpa'];
			$nvalor = ($nvalor1 + $nvalor2);

			$pfinan->updEliCdp($iddpa[$i]);
			$pfinan->actVCdp($nvalor,$iddpa2);	
							
		}
		header("Location:".base_url.'paa/index');
	}			 
		
		
}