<?php
// include'models/paa.php';
include'models/pfinan.php';
include'models/rubro.php';
include'models/valfin.php';
include'models/masi.php';
include'models/antproy.php';

require __DIR__ . '/../../../vendor/autoload.php';		
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class presuController {
	
	public function index() {
		Utils::useraccess('paa/index', $_SESSION['pefid']);
	
		// Obtener filtros
		$ari = isset($_POST['areas']) ? $_POST['areas'] : NULL;
		$pfinan = new Pfinan();
		$vig = $pfinan->vigact();
		$tot = isset($_GET['tot']) ? $_GET['tot'] : NULL;
		$dpd = $_SESSION['depid'];
		$areSel = $_POST['areSel'] ?? null;
		$rubroSel = $_POST['rubroSel'] ?? null;
		$nobjetoSel = $_POST['nobjetoSel'] ?? null;
	
		// Agregar "4" al inicio del rubro
		if (!empty($rubroSel)) {
			$rubroSel = substr($rubroSel, 1);
		}
	
		// Si tot es 1012, asignar 1012 a dpd
		if ($tot == 1012) $dpd = 1012;
	
		// Obtener áreas
		$areas = $this->dparea($dpd);
		$areas = $dpd . "," . $areas;
		$areas = substr($areas, 0, strlen($areas) - 1);
		$areas2 = $pfinan->depareas($areas);
		$pfinan->setIdpaa($vig[0]['idpaa']); // Asegúrate de establecer idpaa
	
		// Filtros para áreas
		if (isset($_POST['areas'])) {
			$area = $_POST['areas'];
			$_SESSION['area'] = $area;
			$pfinan->setArea($area);
			$subareas = $pfinan->getSubAreas();
			$conta = count($subareas);
		} else {
			$area = $_SESSION['depid'];
		}
	
		if($ari) $areas = $ari;
		$idpaa = $vig[0]['idpaa'];
		// Obtener datos filtrados
		$pfcdp = $pfinan->getAll7($areSel, $vig[0]['idpaa'], $rubroSel, $nobjetoSel);
	
		// Inicializar sumas
		$sumasi = 0;
		$sumdis = 0;
		$sumcdp = 0;
		$sumrp = 0;
	
		// Obtener áreas
		$areasutil = Utils::areasu($vig[0]['idpaa']);
		$_SESSION['vigP'] = $vig[0]['idpaa'];
	
		$rubro = new Rubro();
		$num = $rubro->getNum();
		$ninipaa = $num[0]['ninipaa'];
	
		// Asegúrate de que idpaa está definido
		//$idpaa = $vig[0]['idpaa'];
	
		// Pasar a la vista
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

	public function subirArchPre(){

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

		$arcexc = isset($_FILES['arch']['name']) ? $_FILES['arch']['name'] : NULL;

		if ($arcexc && $_FILES['arch']['error'] == UPLOAD_ERR_OK) {
		    $ruta_temporal = $_FILES['arch']['tmp_name'];

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
		    // ... haz lo que necesites con la información del archivo Excel ...
		} else {
		    // Manejar el caso en que no se ha subido correctamente el archivo
		    echo 'Error al subir el archivo.';
		}

		for ($row = 2; $row <= $highestRow; $row++){
			$unspsc = "";
			//$sheet->getCell("a".$row)->getValue()
			$objeto_espacios=$objeto = $sheet->getCell("a".$row)->getValue();				
			$objeto = preg_replace('/[\r\n]+/', " ", $objeto_espacios);
			// Aplicamos la sustitución de punto y coma por coma.
			$objeto = preg_replace('/;/', ",", $objeto);

			$codigo = substr($objeto,0,strpos($objeto, " "));
			$objeto = substr($objeto,strpos($objeto, " ")+1);

			$objdpa=36;

			$cadena = $codigo;

			// Encontrar la posición del primer '2'
			$posicion = strpos($cadena, '2');

			// Verificar si se encontró el '2'
			if ($posicion !== false) {
			    // Obtener la parte de la cadena desde el primer '2' hasta el final
			    $nuevaCadena = substr($cadena, $posicion);			   
			    $codigo = $nuevaCadena;
			} 

			$rubro = $codigo;
			$meta = "2000";

			if ($meta>0) {
				
			}else{
				$meta=0;
			}

			$resolucion = "2100";

			if ($resolucion>0) {
				
			}else{
				$resolucion=0;
			}

			$compromiso = "0";
			$contratista = "";
			$asignacion = $sheet->getCell("b".$row)->getValue();			
			$comprometido = "0";
			if ($comprometido>0) {
				
			}else{
				$comprometido=0;
			}

			$modalidad = "601";
			$codmodalidad = "601";
			$fuentefinan = "651";
			$codfuente = "651";
			$resfutic = "2100";

			$fecini = date("Y")."-01-01 00:00:00";		
			$fecfin = date("Y")."-12-31 23:59:59";

			$area = "1025";
			$codarea = "1025";
			$unidad = "Canal Capital";
			$ubicacion = "Distrito Capital de Bogotá";
			$responsable = "47";
			$telefono = "4578300";
			$email = " ";
			$ordenador = "47";
			$proceso = "5004";
			$codproceso = "5004";
			$estado = "83";
			$codnuevo = "83";
			$nexpcdp = NULL;
			$nrp = NULL;
			$nbogdata = NULL;
			$ncdp = NULL;
			$estadofin = "83";
			$iddpa ="";			

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


			//echo $unspsc." - ".$objeto." - ".$objdpa." - ".$codigo." - ".$rubro." - ".$meta." - ".$resolucion." - ".$compromiso." - ".$contratista." - ".$asignacion." - ".$comprometido." - ".$modalidad." - ".$codmodalidad." - ".$fuentefinan." - ".$codfuente." - ".$resfutic." - ".$fecini." - ".$fecfin." - ".$area." - ".$codarea." - ".$unidad." - ".$ubicacion." - ".$responsable." - ".$telefono." - ".$email." - ".$ordenador." - ".$proceso." - ".$codproceso." - ".$estado." - ".$codnuevo." - ".$nexpcdp." - ".$nrp." - ".$nbogdata." - ".$ncdp." - ".$estadofin." - ".$iddpa." - ".$editar." - ".$vig." - ".$codimeta." - ".$codiresol."<BR><br>";

			$canRubpre = $cexcel->VerCodRub($rubro);
			//var_dump($canRubpre);

			if($rubro && $canRubpre && $canRubpre[0]['can']>0){
				$cexcel->edPlanoPresu($unspsc,$objeto,$objdpa,$codigo,$rubro,$meta,$resolucion,$compromiso,$contratista,$asignacion,$comprometido,$modalidad,$codmodalidad,$fuentefinan,$codfuente,$resfutic,$fecini,$fecfin,$area,$codarea,$unidad,$ubicacion,$responsable,$telefono,$email,$ordenador,$proceso,$codproceso,$estado,$codnuevo,$nexpcdp,$nrp,$nbogdata,$ncdp,$estadofin,$iddpa,$editar,$vig,$codimeta,$codiresol);
			}
			// var_dump($sheet->getCell("J".$row));
		}//CIERRA FOR


		//******************************
		// FIN NUEVA LIBRERIA DE EXCEL PhpSpreadsheet		
		//******************************

		// echo "<h1>Listo para cargar en la base de datos</h1>";
		header("Location:".base_url.'presu/index&tot=1012');
	}

	public function subirArchCon(){

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

		$tip = isset($_GET['tip']) ? $_GET['tip']:NULL;
		$arcexc = isset($_FILES['arch']['name']) ? $_FILES['arch']['name'] : NULL;

		echo "<h3>Conciliando los datos ".$tip."</h3><br>";

		echo $this->btnVolver();

		if ($arcexc && $_FILES['arch']['error'] == UPLOAD_ERR_OK) {
		    $ruta_temporal = $_FILES['arch']['tmp_name'];

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
		    // ... haz lo que necesites con la información del archivo Excel ...
		} else {
		    // Manejar el caso en que no se ha subido correctamente el archivo
		    echo 'Error al subir el archivo.';
		}

		$creg = 0;
		$cregn = 0;
		$crgf200 = 0;
		$ctot = 0;
		$reganu = 0;

		echo "<table class='table table-striped table-bordered dterpc dataTable'>";
			echo "<thead><tr>";
				echo "<th style='text-align: center;' colspan='6'>DATOS NO REGISTRADOS</th>";
			echo "</tr></thead>";
			echo "<tbody>";
				echo "<tr>";
					echo "<th>No.</th>";
					echo "<th>Fila Excel o CSV</th>";
					echo "<th>Código</th>";
					echo "<th>Rubro</th>";
					echo "<th>No. CDP Bogdata</th>";
					echo "<th>Objeto</th>";
				echo "</tr>";
		for ($row = 2; $row <= $highestRow; $row++){
			$vigarc = $sheet->getCell("a".$row)->getValue();
			$mes = $sheet->getCell("b".$row)->getValue();
			$fecini = $sheet->getCell("c".$row)->getValue();
			$fecfin = $sheet->getCell("d".$row)->getValue();
			$cege = $sheet->getCell("e".$row)->getValue();
			$rubro = $sheet->getCell("f".$row)->getValue();
			$descrip = $sheet->getCell("g".$row)->getValue();
			$ncdp = $sheet->getCell("h".$row)->getValue();
			$fecreg = $sheet->getCell("i".$row)->getValue();

			$objeto_espacios= $objeto = $sheet->getCell("j".$row)->getValue();				
			$objeto = preg_replace('/[\r\n]+/', " ", $objeto_espacios);
			// Aplicamos la sustitución de punto y coma por coma.
			$objeto = preg_replace('/;/', ",", $objeto);
			$objeto = str_replace("'","", $objeto);
			$objeto = trim($objeto);

			$codigo = substr($objeto,0,strpos($objeto, " "));
			$objetocom = $objeto;
			$objeto = substr($objeto,strpos($objeto, " ")+1);

			$fondo = $sheet->getCell("k".$row)->getValue();

			if($fondo!='3-200-F002'){
				$cadena = $rubro;
				// Encontrar la posición del primer '2'
				$posicion = strpos($cadena, '2');

				// Verificar si se encontró el '2'
				if ($posicion !== false) {
				    // Obtener la parte de la cadena desde el primer '2' hasta el final
				    $nuevaCadena = substr($cadena, $posicion);			   
				    $cod = $nuevaCadena;
				} 

				$rubro = $cod;
				$dtcrb = $cexcel->pkCodRub($rubro);
				if($dtcrb) $rubro = $dtcrb[0]['codrub'];

				$desfue = $sheet->getCell("l".$row)->getValue();
				$codcongas = $sheet->getCell("m".$row)->getValue();
				$descongas = $sheet->getCell("n".$row)->getValue();
				$codelepep = $sheet->getCell("o".$row)->getValue();
				$deselepep = $sheet->getCell("p".$row)->getValue();
				$valor = $sheet->getCell("q".$row)->getValue();
					if(!$valor) $valor=0;
				$anula = $sheet->getCell("r".$row)->getValue();
					if(!$anula) $anula=0;
				$reint = $sheet->getCell("s".$row)->getValue();
					if(!$reint) $reint=0;
				$cdpxcom = $sheet->getCell("t".$row)->getValue();
					if(!$cdpxcom) $cdpxcom=0;
				$cdpxcom = $sheet->getCell("t".$row)->getValue();
				$nintcdp = $sheet->getCell("u".$row)->getValue();
				$nposcdp = $sheet->getCell("v".$row)->getValue();
				$nofi = $sheet->getCell("w".$row)->getValue();
				$fecofi = $sheet->getCell("x".$row)->getValue();
				$idsol = $sheet->getCell("y".$row)->getValue();
				$nomsol = $sheet->getCell("z".$row)->getValue();
				$idres = $sheet->getCell("aa".$row)->getValue();
				$nomres = $sheet->getCell("ab".$row)->getValue();
				$fecreg = $sheet->getCell("ac".$row)->getValue();
				$codcuecon = $sheet->getCell("ad".$row)->getValue();
				$descuecon = $sheet->getCell("ae".$row)->getValue();

				$cexcel->setCodrub($rubro);

				$vigencia = $cexcel->vigact();
				$vig=$vigencia[0]['idpaa'];

				//echo "<strong>".$codigo." - ".$rubro." - ".$objetocom."</strong><br>";
				//echo "<strong>".$codigo." - ".$rubro."</strong><br>";

				if($valor==$anula){
					$regDt=2; 
					$reganu++;
				}else $regDt=1;

				if($objetocom)
					$resenc = $cexcel->getIddpaxCod($vig, $codigo, $rubro, $objetocom, $ncdp);
				else
					$resenc = NULL;
				
				if(!$resenc){
					$mrubro = new Rubro();
					$rubroT = $mrubro->getRubDep($rubro);
					if($rubroT && $rubroT[0]['codrub']){
						$cexcel->setCodrub($rubroT[0]['codrub']);
						$resenc = $cexcel->getIddpaxCod($vig, $codigo, $rubroT[0]['codrub'], $objetocom, $ncdp);
					}
				}

				if($regDt==1){
					if($resenc){
						$creg++;
						if($tip=="CDP"){
							$cexcel->saveCDPBg($resenc[0]['iddpa'],$valor,$anula,$cdpxcom);
						}
						if($tip=="RP"){
							$cexcel->saveRPBg($resenc[0]['iddpa'],$valor,$anula,$cdpxcom);
						}
						
					}else{
						$cregn++;
						echo "<tr>";
							echo "<td>".$cregn."</td>";
							echo "<td>".($ctot+2)."</td>";
							echo "<td>".$codigo."</td>";
							echo "<td>".$rubro."</td>";
							echo "<td>".intval($ncdp)."</td>";
							echo "<td>".substr($objetocom,0,50)."...</td>";
						echo "</tr>";
					}
				}
				// echo $vigarc." - ".$mes." - ".$fecini." - ".$fecfin." - ".$cege." - ".$rubro." - ".$descrip." - ".$ncdp." - ".$fecreg." - ".$codigo." - ".$objeto." - ".$fondo." - ".$desfue." - ".$codcongas." - ".$descongas." - ".$codelepep." - ".$deselepep." - ".$valor." - ".$anula." - ".$reint." - ".$cdpxcom." - ".$cdpxcom." - ".$nintcdp." - ".$nposcdp." - ".$nofi." - ".$fecofi." - ".$idsol." - ".$nomsol." - ".$idres." - ".$nomres." - ".$fecreg." - ".$codcuecon." - ".$descuecon."<BR><br>";

			}else{
				$crgf200++;
			}
			$ctot++;
		}//CIERRA FOR

		echo "</tbody>";
		echo "</table>";


		//******************************
		// FIN NUEVA LIBRERIA DE EXCEL PhpSpreadsheet		
		//******************************

		echo "<br><br>";
		echo "<table class='table table-striped table-bordered dterpc dataTable'>";
			echo "<thead><tr>";
				echo "<th style='text-align: center;' colspan='2'>CANTIDAD DE REGISTROS CDP</th>";
			echo "</tr></thead>";
			echo "<tbody><tr>";
				echo "<th>Actualizados: </th>";
				echo "<td style='text-align: right;'>".number_format($creg, 0, '.', ',')."</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<th>NO Insertados: </th>";
				echo "<td style='text-align: right;'>".number_format($cregn, 0, '.', ',')."</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<th>Anulaciones (Valor asignado = Valor anulación): </th>";
				echo "<td style='text-align: right;'>".number_format($reganu, 0, '.', ',')."</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<th>3-200-F002: </th>";
				echo "<td style='text-align: right;'>".number_format($crgf200, 0, '.', ',')."</td>";
			echo "</tr>";
			
			echo "<tr>";
				echo "<th>TOTAL sumado / leídos: </th>";
				echo "<th style='text-align: right;'>".number_format(($creg+$cregn+$crgf200+$reganu), 0, '.', ',')." / ".number_format($ctot, 0, '.', ',')."</th>";
			echo "</tr>";
			echo "<tr></tbody>";
		echo "</table>";

		echo $this->btnVolver();
		//header("Location:".base_url.'presu/index&tot=1012');
	}

	public function subirArcConRp(){

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

		$tip = isset($_GET['tip']) ? $_GET['tip']:NULL;
		$arcexc = isset($_FILES['arch']['name']) ? $_FILES['arch']['name'] : NULL;

		echo "<h3>Conciliando los datos ".$tip."</h3><br>";

		echo $this->btnVolver();

		if ($arcexc && $_FILES['arch']['error'] == UPLOAD_ERR_OK) {
		    $ruta_temporal = $_FILES['arch']['tmp_name'];

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
		    // ... haz lo que necesites con la información del archivo Excel ...
		} else {
		    // Manejar el caso en que no se ha subido correctamente el archivo
		    echo 'Error al subir el archivo.';
		}

		$creg = 0;
		$cregn = 0;
		$crgf200 = 0;
		$ctot = 0;
		$reganu = 0;

		echo "<table class='table table-striped table-bordered dterpc dataTable'>";
			echo "<thead><tr>";
				echo "<th style='text-align: center;' colspan='6'>DATOS NO REGISTRADOS</th>";
			echo "</tr></thead>";
			echo "<tbody>";
				echo "<tr>";
					echo "<th>No.</th>";
					echo "<th>Fila Excel o CSV</th>";
					echo "<th>Código</th>";
					echo "<th>Rubro</th>";
					echo "<th>No. CDP Bogdata</th>";
					echo "<th>Objeto</th>";
				echo "</tr>";
		for ($row = 2; $row <= $highestRow; $row++){
			$ejer = $sheet->getCell("a".$row)->getValue();
			$per = $sheet->getCell("b".$row)->getValue();
			$fecinid = $sheet->getCell("c".$row)->getValue();
			$fecfind = $sheet->getCell("d".$row)->getValue();
			$cege = $sheet->getCell("e".$row)->getValue();
			$fecreg = $sheet->getCell("f".$row)->getValue();
			$tipcom = $sheet->getCell("g".$row)->getValue();
			$com = $sheet->getCell("h".$row)->getValue();
			$ncom = $sheet->getCell("i".$row)->getValue();
			$fecini = $sheet->getCell("j".$row)->getValue();
			$fecfin = $sheet->getCell("k".$row)->getValue();
			$ncdp = $sheet->getCell("o".$row)->getValue();
			$nrp = $sheet->getCell("p".$row)->getValue();
			$rubro = $sheet->getCell("r".$row)->getValue();
			$objeto_espacios= $objeto = $sheet->getCell("q".$row)->getValue();				
			$objeto = preg_replace('/[\r\n]+/', " ", $objeto_espacios);
			// Aplicamos la sustitución de punto y coma por coma.
			$objeto = preg_replace('/;/', ",", $objeto);
			$objeto = str_replace("'","", $objeto);
			$objeto = trim($objeto);

			$codigo = substr($objeto,0,strpos($objeto, " "));
			$objetocom = $objeto;
			$objeto = substr($objeto,strpos($objeto, " ")+1);

			$fondo = $sheet->getCell("t".$row)->getValue();

			if($fondo!='3-200-F002'){
				$cadena = $rubro;
				// Encontrar la posición del primer '2'
				$posicion = strpos($cadena, '2');

				// Verificar si se encontró el '2'
				if ($posicion !== false) {
				    // Obtener la parte de la cadena desde el primer '2' hasta el final
				    $nuevaCadena = substr($cadena, $posicion);			   
				    $cod = $nuevaCadena;
				} 

				$rubro = $cod;
				$dtcrb = $cexcel->pkCodRub($rubro);
				if($dtcrb) $rubro = $dtcrb[0]['codrub'];

				$tdocben = $sheet->getCell("ad".$row)->getValue();
				$ndocben = $sheet->getCell("ae".$row)->getValue();
				$nomben = $sheet->getCell("af".$row)->getValue();
				$codelepep = $sheet->getCell("x".$row)->getValue();
				$deselepep = $sheet->getCell("z".$row)->getValue();
				$valor = $sheet->getCell("ak".$row)->getValue();
					if(!$valor) $valor=0;
				$anula = $sheet->getCell("al".$row)->getValue();
					if(!$anula) $anula=0;
				$reint = $sheet->getCell("am".$row)->getValue();
					if(!$reint) $reint=0;
				$valnet = $sheet->getCell("an".$row)->getValue();
					if(!$valnet) $valnet=0;
				$autgiro = $sheet->getCell("ao".$row)->getValue();
					if(!$autgiro) $autgiro=0;
				$csagiro = $sheet->getCell("ap".$row)->getValue();
					if(!$csagiro) $csagiro=0;
				$nintcrp = $sheet->getCell("aq".$row)->getValue();
				$nposcrp = $sheet->getCell("ar".$row)->getValue();
				$nintcdp = $sheet->getCell("as".$row)->getValue();
				$nposcdp = $sheet->getCell("at".$row)->getValue();
				$fecent = $sheet->getCell("au".$row)->getValue();
				/*echo $fecent." ";
					$fecent = substr($fecent,strlen($fecent)-1,4);*/

				$cexcel->setCodrub($rubro);

				$vigencia = $cexcel->vigact();
				$vig=$vigencia[0]['idpaa'];

				//echo "<strong>".$codigo." - ".$rubro." - ".$objetocom."</strong><br>";
				//echo "<strong>".$codigo." - ".$rubro."</strong><br>";

				if($valor==$anula){
					$regDt=2; 
					$reganu++;
				}else $regDt=1;

				if($objetocom)
					$resenc = $cexcel->getIddpaxCod($vig, $codigo, $rubro, $objetocom, $ncdp);
				else
					$resenc = NULL;

				if(!$resenc){
					$mrubro = new Rubro();
					$rubroT = $mrubro->getRubDep($rubro);
					if($rubroT && $rubroT[0]['codrub']){
						$cexcel->setCodrub($rubroT[0]['codrub']);
						$resenc = $cexcel->getIddpaxCod($vig, $codigo, $rubroT[0]['codrub'], $objetocom, $ncdp);
					}
				}

				if($regDt==1){
					if($resenc){
						$creg++;
						if($tip=="CDP"){
							$cexcel->saveCDPBg($resenc[0]['iddpa'],$valor,$anula,$cdpxcom);
						}
						if($tip=="RP"){
							//echo $fecent."<br>";
							$cexcel->saveRPBg($resenc[0]['iddpa'],$valor,$anula,$valnet,$autgiro,$csagiro,$nintcrp,$nintcdp,$fecent);
						}
						
					}else{
						$cregn++;
						echo "<tr>";
							echo "<td>".$cregn."</td>";
							echo "<td>".($ctot+2)."</td>";
							echo "<td>".$codigo."</td>";
							echo "<td>".$rubro."</td>";
							echo "<td>".intval($ncdp)."</td>";
							echo "<td>".substr($objetocom,0,50)."...</td>";
						echo "</tr>";
					}
				}
				// echo $vigarc." - ".$mes." - ".$fecini." - ".$fecfin." - ".$cege." - ".$rubro." - ".$descrip." - ".$ncdp." - ".$fecreg." - ".$codigo." - ".$objeto." - ".$fondo." - ".$desfue." - ".$codcongas." - ".$descongas." - ".$codelepep." - ".$deselepep." - ".$valor." - ".$anula." - ".$reint." - ".$cdpxcom." - ".$cdpxcom." - ".$nintcdp." - ".$nposcdp." - ".$nofi." - ".$fecofi." - ".$idsol." - ".$nomsol." - ".$idres." - ".$nomres." - ".$fecreg." - ".$codcuecon." - ".$descuecon."<BR><br>";

			}else{
				$crgf200++;
			}
			$ctot++;
		}//CIERRA FOR

		echo "</tbody>";
		echo "</table>";


		//******************************
		// FIN NUEVA LIBRERIA DE EXCEL PhpSpreadsheet		
		//******************************

		echo "<br><br>";
		echo "<table class='table table-striped table-bordered dterpc dataTable'>";
			echo "<thead><tr>";
				echo "<th style='text-align: center;' colspan='2'>CANTIDAD DE REGISTROS RP</th>";
			echo "</tr></thead>";
			echo "<tbody><tr>";
				echo "<th>Actualizados: </th>";
				echo "<td style='text-align: right;'>".number_format($creg, 0, '.', ',')."</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<th>NO Insertados: </th>";
				echo "<td style='text-align: right;'>".number_format($cregn, 0, '.', ',')."</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<th>Anulaciones (Valor asignado = Valor anulación): </th>";
				echo "<td style='text-align: right;'>".number_format($reganu, 0, '.', ',')."</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<th>3-200-F002: </th>";
				echo "<td style='text-align: right;'>".number_format($crgf200, 0, '.', ',')."</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<th>TOTAL sumado / leídos: </th>";
				echo "<th style='text-align: right;'>".number_format(($creg+$cregn+$crgf200+$reganu), 0, '.', ',')." / ".number_format($ctot, 0, '.', ',')."</th>";
			echo "</tr>";
			echo "<tr></tbody>";
		echo "</table>";

		echo $this->btnVolver();
		//header("Location:".base_url.'presu/index&tot=1012');
	}

	public function btnVolver(){
		$btnVol = '';
		$btnVol .= '<a href="https://intranet.canalcapital.gov.co/erpc/mod/financiera/presu/index&tot=1012">';
			$btnVol .= '<button id="mos" class="btn-primary-ccapital" style="display: block;margin-bottom: 20px;" title="Volver a Presupuesto"><i class="fas fa-dollar-sign ico3"></i> Volver a presupuesto</button>';
		$btnVol .= '</a>';
		return $btnVol;
	}
}