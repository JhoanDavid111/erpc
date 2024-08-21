<?php
include'models/antproy.php';
include'models/rubro.php';
include'models/newpaa.php';
include'models/pfinan.php';
include'models/valfin.php';

class antproyController{
	
	public function index(){		
		Utils::useraccess('antproy/index',$_SESSION['pefid']);
		unset($_SESSION['consultado']);
		$_SESSION['newpaa']=null;

		if (isset($_GET['nuevo'])) {
			$_SESSION['newpaa']=1;
		}
		
	
		$pfinan = new Newpaa();
		// $pfinand = $pfinan->getAll();

		$pfvig = $pfinan->getVig();

		$rubro = new Rubro();
		$rubros = $rubro->getAll();
		$num = $rubro->getNum();
		$ninipaa = $num[0]['ninipaa'];


		//**********************
		//**********************
		//ESTADO DE ANTEPROYECTO
		//**********************
		//**********************

		Utils::useraccess('antproy/index',$_SESSION['pefid']);

		// var_dump($_SESSION['pefid']);
		// die();			
		
		$pfvig = $pfinan->getVig();
		$vigencia = $pfvig[0]['idpaa']; 
		$_SESSION['consultado']=$vigencia;
				

		$areas = $this->dparea($_SESSION['depid']);
		$areas = $_SESSION['depid'].",".$areas;
		$areas = substr($areas,0,strlen($areas)-1);
		$_SESSION['areas']=$areas;
		// var_dump($areas);
		// die();


		//****************************
	 	//*********GRAFICO************
	 	

	 	$pfinanAnt = new Pfinan();
		$dxyc = $pfinanAnt->selgrChartxy($pfvig[0]['idpaa'],$areas);
		

		// var_dump($dxyc)	;
		// die();

	 	//****************************
	 	//*********GRAFICO************
	 	//****************************





		
		$pfinan = new Newpaa();
		// var_dump($vigencia);
		// die();
		$pfinan->setIdpaa($vigencia);
		// $pfinan->setIdpaa();
		if($areas==1016 || $_SESSION['pefid']==21)
			$pfinand = $pfinan->getAll4();
		else
			$pfinand = $pfinan->getAll4($areas);
		// var_dump($pfinand);
		// die();

		$editpf = new Antproy();
		$editp=0;
		$rubrosPf=$editpf->getRub($editp);
		$estado= $pfinan->getEstado();

		if ($estado[0]['vafid']==4) {
			$_SESSION['estAntCer']="El anteproyecto se encuentra cerrado";//estado anteproyecto
		}

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

		$rubro = new Rubro();			
		$num = $rubro->getNumAnteP($_SESSION['consultado']);
		$ninipaa = $num[0]['ninipaa'];
		require_once 'views/antproy.php';
	


		//**********************
		//**********************
		// FIN ESTADO DE ANTEPROYECTO
		//**********************
		//**********************


		//UNIDAD EJECUTORA
		$unidcon=new valfin();
		$unidcon-> setDofid(7);
		$ucontrata=$unidcon->unicontrata();

		require_once 'views/antproy.php';
		//require_once 'views/paa.php';
	}

	//AJAX FUTIC
	public function ajaxFutic(){
		// $action = $_REQUEST['action1'];
		// var_dump($action);
		// die();
		// $html="";
	
		// //$html.="<option value='".$value['id']."'>".$value['nombre']."</option>";
		// $html.="<h2>HOlaaaaaaa</h2>";
		// echo $html;

		// return $html;

		// var_dump($action);
		// die();
		// if($action=="showAll"){
  
		//   $valfinD = new Valfin();		

		//   $valfinD->setDofid(8);
		//   $futic = $valfinD->getValdom();

		//   ?>

		//   	<div class="form-group col-md-4">
		// 		<label for="futic">Resolución FUTIC</label>
		// 		<select id="futic" name="futic" class="form-control form-control-sm" style="padding: 0px;" >	
		// 			<?php foreach ($futic as $dat){ ?>
		// 				<option value="<?=$dat['vafid'];?>"  <?=isset($pf2) &&  $pf2['ftefindpa'] == $dat['vafid'] ? ' selected ' : ''; ?>><?=$dat['vafnom'];?></option>
		// 			<?php } ?>
		// 		</select>
		// 	</div>


		//   <?php
		  
		//  }else{
		  
		  
		//  }

	}

	public function insAntep(){
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

			$save = $insAntp->mInserAntp();

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
		if (isset($_GET['paa'])) {
			header("Location:".base_url.'paa/index');
			
		}else{
			header("Location:".base_url.'antproy/index');
		}
	}
	

	public function saveNPaa(){
		Utils::useraccess('antproy/index',$_SESSION['pefid']);
		if(isset($_POST)){

			$newvig = isset($_POST['newvig']) ? $_POST['newvig'] : false;
			$nompaa = isset($_POST['nompaa']) ? $_POST['nompaa'] : false;
			$digp = isset($_POST['digp']) ? $_POST['digp'] : false;
			
			
			if($newvig && $nompaa && $digp){

				$savenp = new Newpaa();
				$savenp->setIdpaa($newvig);
				$savenp->setDespaa($nompaa);
				$savenp->setNinipaa($digp );

				$estado=1;
				$savenp->setEstpaa($estado);

				$newpaa=$savenp->saveNP();


				//$rubros = $rubro->getAll();

				
			}
		}

		header("Location:".base_url.'antproy/index');		

	}

	public function getAntPf(){
		Utils::useraccess('antproy/index',$_SESSION['pefid']);
		$pfinan = new Pfinan();

		// $dpie = $pfinan->selgrPie();
		// $dxyc = $pfinan->selgrChartxy();

		$pfinan->setIdpaa($_SESSION['consultado']);	
		
		if (isset($_GET['codrub'])) {
			$codrub = $_GET['codrub'];
			$iddpa= $_GET['iddpa'];
			$_SESSION['iddpa']=$iddpa;

			// var_dump($iddpa);
			// die();

			$area = $_GET['area'];
			$pfinan->setArea($area);
			$pfinan->setCodrub($codrub);
			$pfinan->setIddpa($iddpa);
			//$dpie = $pfinan->selgrPie();
			//$dxyc = $pfinan->selgrChartxy();

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
			$area = $_POST['areas'] = null;
		}	
			
		$pfinand = $pfinan->getAll2($area);	
		$pfinandOne = $pfinan->getOne();

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

		

			
		//$_SESSION['pfinand']=$pfinan->getAll();
		// var_dump($pfinandOne);
		// die();

		$areas = $pfinan->getAreas();
		//var_dump(count($areas));
		// var_dump($areas);
		// die();

		$pfvig = $pfinan->getVig();
		
		$rubro = new Rubro();			
		$num = $rubro->getNumAnteP($_SESSION['consultado']);
		$ninipaa = $num[0]['ninipaa'];

		$pfinan = new Newpaa();
		$pfinan->setIdpaa($_SESSION['consultado']);		
		$pfinand = $pfinan->getAll4($_SESSION['areas']);
		$editpf = new Antproy();
		$editp=0;
		$ediAnte=0;
		$rubrosPf=$editpf->getRub($editp);


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


		// var_dump($dxyc);
		// die();
		
		//require_once 'views/pfinan.php';
		
		//$this->planes();
		require_once 'views/antproy.php';


	}


	public function getPf(){
		Utils::useraccess('antproy/index',$_SESSION['pefid']);
		// var_dump($_GET);
		// die();

		if(isset($_GET)){

			$vigencia=$_SESSION['consultado'];
			$pfinan = new Newpaa();
			$pfinan->setIdpaa($vigencia);
			$pfvig = $pfinan->getVig();
			$estado= $pfinan->getEstado();
			$estados= $pfinan->getEstados();



			$editp = $_GET['codrub'];
			// var_dump($editp);
			// var_dump($_GET['iddpa']);
			// die();
			$editpf = new Antproy();
			$editpf->setCodrub($editp);

			//$pfinand = $editpf->getAll();			
			$pfvig = $editpf->getVig();
			$epf = $editpf->selPf();
			$pfinand=$epf;
			$estado= $pfinan->getEstado();

			$edpf = new Newpaa();
			$edpf->setIdpaa($vigencia);
			$pfinand2 = $edpf->getAll();

			// var_dump($pfinand2);
			// die();

			$edit = true;
		
			$rubro = new Rubro();
			$rubro->setCodrub($editp);
			$rubros = $rubro->getAll();
			$num = $rubro->getNum();
			$ninipaa = $num[0]['ninipaa'];
	
			$rub = $rubro->getOne();

			$dependencias = $this->familia($rub[0]['deprub']);

			require_once 'views/antproy.php';

		}

	}

	public function elimAntp(){	
		
		if (isset($_GET['codrub'])) {
			$codrub = $_GET['codrub'];
			$iddpa= $_GET['iddpa'];
			$_SESSION['iddpa']=$iddpa;

			$pfinan = new Pfinan();
			$area = $_GET['area'];
			$pfinan->setArea($area);
			$pfinan->setCodrub($codrub);
			$pfinan->setIddpa($iddpa);
			$respon = new Antproy();
			$elim = $respon->deleteAnt($iddpa);
		
		}
		$this->index();		

	}

	public function editPf(){
		
		Utils::useraccess('antproy/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$asig = isset($_POST['asig']) ? $_POST['asig'] : false;
			$nmeses = isset($_POST['nmeses']) ? $_POST['nmeses'] : false;
			$valormensual = isset($_POST['valormensual']) ? $_POST['valormensual'] : false;

			if($asig && $nmeses){
				$editpf = new Antproy();
				$editpf->setNmesdpa($nmeses);
				//$valormensual->setAsidpa($valormensual);
				$editpf->setAsidpa($asig);

				//$save = $$editpf->edit();
			}


		}
		header("Location:".base_url.'antproy/index');
		
	}

	public function editEPF(){
		Utils::useraccess('antproy/index',$_SESSION['pefid']);
		$newvig = isset($_POST['newvig']) ? $_POST['newvig'] : false;
		$nompaa = isset($_POST['nompaa']) ? $_POST['nompaa'] : false;
		$digp = isset($_POST['digp']) ? $_POST['digp'] : false;
		$mestado = isset($_POST['mestado']) ? $_POST['mestado'] : false;

			
			
		if($newvig && $nompaa && $digp){

			$eepf = new Newpaa();
			$eepf->setIdpaa($newvig);
			$eepf->setDespaa($nompaa);
			$eepf->setNinipaa($digp );
			$eepf->setEstpaa($mestado);

			//$estado=1;
			//$savenp->setEstpaa($estado);

			$estpf=$eepf->editEst();


			//$rubros = $rubro->getAll();
			
		}
		header("Location:".base_url.'antproy/index');
	}	
	



	function familia($deprup,$ord="ASC"){
		$txt = '';
		$rubro = new Rubro();
		$rubro->setCodrub($deprup);
		$dep = $rubro->getOne();
		$num = $rubro->getNum();
		$ninipaa = $num[0]['ninipaa'];

		if($deprup<>0){
			$txt .= $ninipaa.$dep[0]['codrub']." - ".$dep[0]['nomrub']."<br>";
			if($dep[0]['deprub']<>0){
				if($ord=="ASC")
					$txt = $this->familia($dep[0]['deprub']).$txt;	//Menor a Mayor
				else
					$txt .= $this->familia($dep[0]['deprub'],"DESC");	//Mayor a Menor
			}
		}else{
			$txt .= "Sin dependencias";
		}

		return $txt;
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
	

		//EDITA ANTEPROYECTO
	public function editpaa2(){
		Utils::useraccess('paa/index',$_SESSION['pefid']);
		// var_dump($_POST["boton"]);
		// die();	
		// die();
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
		//$futic = isset($_POST['futic']) ? $_POST['futic'] : false;
		$valorAsignado = isset($_POST['valorAsignado']) ? $_POST['valorAsignado'] : false;
		$valorVigencia = isset($_POST['valorVigencia']) ? $_POST['valorVigencia'] : false;
		$vigenciaF = isset($_POST['vigenciaF']) ? $_POST['vigenciaF'] : false;
		$unicontra = isset($_POST['unicontra']) ? $_POST['unicontra'] : false;
		$ubicacion = isset($_POST['ubicacion']) ? $_POST['ubicacion'] : false;
		$nombreR = isset($_POST['nombreR']) ? $_POST['nombreR'] : false;
		$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
		$email = isset($_POST['email']) ? $_POST['email'] : false;
		$idpro = isset($_POST['idpro']) ? $_POST['idpro'] : false;
		$ordgas = isset($_POST['norgas']) ? $_POST['norgas'] : false;

		
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
		$editpf->setIdpro($idpro);
		$idflu = $editpf->iniflu($idpro);
		$editpf->setIdflu($idflu[0]['mini']); //Cargar flujo de acuerdo al proceso ant LISTO
		$editpf->setOrdgas($ordgas); 

		if ($_POST["boton"]=="modificar") {
			if(isset($_POST)){// var_dump($_POST);
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
			//die();
			header("Location:".base_url.'antproy/index');
		}else{
			$editpf->setCpc(0);
			$editpf->setIdpb(0);
			$editpf->setIdpaa($_SESSION['consultado']);
			$editpf->setNicod(0);
			$editpf->setSolivigf("NO");
			// var_dump($_SESSION['consultado']);
			// die();
			$save = $editpf->mInserAntp();				
			if($save){

				$_SESSION['inserAnt']="si";
				$insFut= new pfinan();
				$insFut->setCodIddpa($_SESSION['iddpa']);

				if ($ffutic != null) {
					$insFut->setFfutic($ffutic);
					$inf=$insFut->actFutic();
				}
			}else{
				$_SESSION['InserAnt']="no";
			}
			header("Location:".base_url.'antproy/index');	
		}	
	}
	
	function AntEli(){
		Utils::useraccess('antproy/index',$_SESSION['pefid']);
		$insAntp= new Antproy();
		$iddpa = isset($_GET['iddpa']) ? $_GET['iddpa'] : false;
		if($iddpa){
			$insAntp->setIddpa($iddpa);
			date_default_timezone_set('America/Bogota');
			$fecha = date("Y-m-d H:i:s");
			$observaciones = "Eliminado: ".$_SESSION['pefid']." ".$_SESSION['pefnom']." ".$fecha;
			$insAntp->setObservaciones($observaciones);
			$elidp = 2;
			$insAntp->setElidp($elidp);
			$insAntp->eliAnt();
		}
		

		header("Location:".base_url.'antproy/index');
	}

	public function cargaantp(){
		require_once 'views/cargaantp.php';

	}
}