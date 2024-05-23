<?php
include'models/antproy.php';
include'models/rubro.php';
include'models/newpaa.php';
include'models/pfinan.php';
include'models/valfin.php';
include'models/mcdp.php';

class cdpController{
	public function solicitud(){
		Utils::useraccess('cdp/solicitud',$_SESSION['pefid']);
		$solicitud=true;
		$estado=false;
		$aprobacion=false;
		$historial=false;

		$pfinan = new Newpaa();
		$pfvig = $pfinan->getVig();

		require_once 'views/cdp.php';
		//require_once 'views/paa.php';
	}
	public function estado(){
		Utils::useraccess('cdp/estado',$_SESSION['pefid']);
		$solicitud=false;
		$estado=true;
		$aprobacion=false;
		$historial=false;
		require_once 'views/cdp.php';
		//require_once 'views/paa.php';
	}
	public function aprobacion(){
		Utils::useraccess('cdp/aprobacion',$_SESSION['pefid']);	
		$solicitud=false;
		$estado=false;
		$aprobacion=true;
		$historial=false;
		require_once 'views/cdp.php';
		//require_once 'views/paa.php';
	}
	public function historial(){
		Utils::useraccess('cdp/historial',$_SESSION['pefid']);
		$solicitud=false;
		$estado=false;
		$aprobacion=false;
		$historial=true;
		require_once 'views/cdp.php';
		//require_once 'views/paa.php';
	}

	public function planes(){
		Utils::useraccess('cdp/solicitud',$_SESSION['pefid']);
		// var_dump($_POST);
		// die();

		if(isset($_POST)){
			$vigencia = $_POST['vigencia'];	
			$_SESSION['consultado']=$vigencia;

			$areas = $this->dparea($_SESSION['depid']);
			$areas = $_SESSION['depid'].",".$areas;
			$areas = substr($areas,0,strlen($areas)-1);
			$_SESSION['areas']=$areas;

			$pfinan = new Newpaa();
			$pfinan->setIdpaa($vigencia);
			$pfinand = $pfinan->getAll4($_SESSION['areas']);
			$editpf = new Antproy();
			$editp=0;
			$rubrosPf=$editpf->getRub($editp);

			// var_dump($pfinand);
			// die();
			//$_SESSION['pfinand']=$pfinan->getAll();
			$pfvig = $pfinan->getVig();
			$estado= $pfinan->getEstado();

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

			//UNIDAD EJECUTORA
			$unidcon=new valfin();
			$unidcon-> setDofid(7);
			$ucontrata=$unidcon->unicontrata();


			$resposable = new Pfinan();
			//ORDENADOR DEL GASTO
			$ordg = $resposable->ordenadorgas();



			$rubro = new Rubro();			
			$num = $rubro->getNumAnteP($_SESSION['consultado']);
			$ninipaa = $num[0]['ninipaa'];

			$solicitud=true;
			$estado=false;
			$aprobacion=false;
			$historial=false;
			$mostrar=true;
			require_once 'views/cdp.php';
		}
	}

	public function getAntPf(){
		Utils::useraccess('cdp/index',$_SESSION['pefid']);
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

			$area = $_SESSION['area'];
			$pfinan->setArea($area);
			$pfinan->setCodrub($codrub);
			$pfinan->setIddpa($iddpa);
			$dpie = $pfinan->selgrPie();
			$dxyc = $pfinan->selgrChartxy();

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
		$pfinand = $pfinan->getAll();
		$editpf = new Antproy();
		$editp=0;
		$ediAnte=0;
		$rubrosPf=$editpf->getRub($editp);


		//UNIDAD EJECUTORA
		$unidcon=new valfin();
		$unidcon-> setDofid(7);
		$ucontrata=$unidcon->unicontrata();


		$resposable = new Pfinan();
		//ORDENADOR DEL GASTO
		$ordg = $resposable->ordenadorgas();

		$solicitud=true;
		$estado=false;
		$aprobacion=false;
		$historial=false;
		$mostrar=true;
		require_once 'views/cdp.php';		

	}

	public function solicdp(){
		Utils::useraccess('cdp/aprobacion',$_SESSION['pefid']);	
		$solicitud=false;
		$estado=false;
		$aprobacion=true;
		$historial=false;
		require_once 'views/cdp.php';	
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

}