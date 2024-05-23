<?php
include'models/proveedor.php';

class proveedorController{
	
	public function index(){
		Utils::useraccess('proveedor/index' ,$_SESSION['pefid']);
			
		$proveedor = new Proveedor();
		$datmun = $proveedor->getMunicipio();
		$datarea = $proveedor->getVal(1);
		$dattipp = $proveedor->getVal(26);
		$tdo = $proveedor->totdoc();
		$proveedors = $proveedor->getAll();
		
		require_once 'views/proveedor.php';

	}

	public function buspro(){

		// var_dump($_POST);
		// die();

		Utils::useraccess('proveedor/buspro' ,$_SESSION['pefid']);
		$proveedors = NULL;

		$razsoc = isset($_POST['razsoc']) ? $_POST['razsoc']:NULL;
		$nomciiu = isset($_POST['nomciiu']) ? $_POST['nomciiu']:NULL;
		$nresul = isset($_POST['nresul']) ? $_POST['nresul']:NULL;


		if($razsoc OR $nomciiu){
			$proveedor = new Proveedor();
			$proveedor->setRazsoc($razsoc);
			$proveedor->setNomciiu($nomciiu);
			$tdo = $proveedor->totdoc();
			$proveedors = $proveedor->getFilter();
			$cont=0;
			//$ct=5; // Cantidad de valores a mostrar
			$ct=$nresul;
			// var_dump($proveedors);
			// die();
			if($proveedors){ 
				$cont=count($proveedors);
				if($cont<=$ct){
					$ct=count($proveedors);
					$posmos = $this->proveeAleatorios($cont,$ct);
				}else{
					$posmos = $this->proveeAleatorios($cont,$ct);
				} 
				$contresul1=count($posmos);
				if (($contresul1>1 && $contresul1<$ct)||($contresul1>=$ct && $ct>1)) {
					
					$contresul=count($posmos)-1;
				}else{
					$contresul=count($posmos);
				}
							
			}

			if (isset($_POST['infodetpaa'])) {
				date_default_timezone_set('America/Bogota');
	   			$fecha = date("Y-m-d H:i:s");
	   			$iddpa=intval($_POST['infodetpaa']);
	   			$perid=$_SESSION['perid'];	   			
				$saveconsul = $proveedor->saveconsul($fecha,$iddpa,$perid,$nomciiu);
				$ultimaconsul = $proveedor->ultimaconsul();
				$ultima=$ultimaconsul[0]["last_insert_id()"];
				$historial=$proveedor->histoconsul($iddpa,$perid);
			}
		}
		if (isset($_SESSION['ninipaa'])) {
			$ninipaa=$_SESSION['ninipaa'];
		}else{
			$ninipaa=0;
		}
		
		

		if (isset($_GET['iddpa'])) {			
			$iddpa=$_GET['iddpa'];
			$perid=$_SESSION['perid'];
			$pfinand2= new Proveedor();
			$pfinand= $pfinand2->busiddpa($iddpa);
			$historial=$pfinand2->histoconsul($iddpa,$perid);			
		}

		if (isset($_POST['infodetpaa'])) {			
			$iddpa=intval($_POST['infodetpaa']);			
			$pfinand2= new Proveedor();
			$pfinand= $pfinand2->busiddpa($iddpa);

				
		}
		require_once 'views/buspro.php';

	}

	public function proveeAleatorios($cont,$ct){
		$rand = range(1, $cont);
		shuffle($rand);
		for($i=0;$i<$ct;$i++) {
			$h[] = ($rand[$i]-1);
		}
		return $h;
	}

	public function save(){
		Utils::useraccess('proveedor/index' ,$_SESSION['pefid']);
		if(isset($_POST)){

			$idprov = isset($_POST['idprov']) ? $_POST['idprov'] : false;
			$nit = isset($_POST['nit']) ? $_POST['nit'] : false;
			$razsoc = isset($_POST['razsoc']) ? $_POST['razsoc'] : false;
			$dep = isset($_POST['dep']) ? $_POST['dep'] : false;
			$ciu = isset($_POST['ciu']) ? $_POST['ciu'] : false;
			$dir = isset($_POST['dir']) ? $_POST['dir'] : false;
			$tel = isset($_POST['tel']) ? $_POST['tel'] : false;
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			$area = isset($_POST['area']) ? $_POST['area'] : false;
			$paclave = isset($_POST['paclave']) ? $_POST['paclave'] : NULL;
			$valid = isset($_POST['valid']) ? $_POST['valid'] : NULL;
			
			// echo $nit." - ".$razsoc." - ".$ciu." - ".$dir." - ".$tel." - ".$email;
			
			if($nit && $razsoc && $ciu && $dir && $tel && $email){
				$proveedor = new Proveedor();
				$proveedor->setIdprov($idprov);
				$proveedor->setNit($nit);
				$proveedor->setRazsoc($razsoc);
				$proveedor->setDep($dep);
				$proveedor->setCiu($ciu);
				$proveedor->setDir($dir);
				$proveedor->setTel($tel);
				$proveedor->setEmail($email);
				$proveedor->setArea($area);
				$proveedor->setPaclave($paclave);
				$proveedor->setValid($valid);
				
				
				$datmun = $proveedor->getMunicipio();
				$proveedors = $proveedor->getAll();
				$tdo = $proveedor->totdoc();
				if(isset($_GET['idprov'])){
					$idprov = $_GET['idprov'];
					$proveedor->setIdprov($idprov);
					
					$save = $proveedor->edit();
				}else{
					$save = $proveedor->save();
				}

				//echo "<script>alert('Su proveedor ha sido registrado.');</script>";
				
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
		header("Location:".base_url.'proveedor/index');
	}

	public function edit(){
		Utils::useraccess('proveedor/index' ,$_SESSION['pefid']);
		if(isset($_GET['idprov'])){
			$idprov = $_GET['idprov'];
			$edit = true;
		
			$proveedor = new Proveedor();
			$proveedor->setIdprov($idprov);
			$datmun = $proveedor->getMunicipio();
			$datarea = $proveedor->getVal(1);
			$dattipp = $proveedor->getVal(26);
			$proveedors = $proveedor->getAll();
			$tdo = $proveedor->totdoc();
			$val = $proveedor->getOne();
			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/proveedor.php';
			
		}else{
			header('Location:'.base_url.'proveedor/index');
		}
	}

	public function saveCiuu(){
		Utils::useraccess('proveedor/index' ,$_SESSION['pefid']);
		if(isset($_POST)){

			$idprov = isset($_POST['id']) ? $_POST['id'] : false;
			$chk = isset($_POST['chk']) ? $_POST['chk'] : false;
			
			// echo $idprov." - ".$chk[0];
			// die();
			
			if($idprov && $chk){
				$proveedor = new Proveedor();
				$proveedor->setIdprov($idprov);
				$proveedor->setIdciiu($chk[0]);

				$save = $proveedor->saveCiiu();

				//echo "<script>alert('Su proveedor ha sido registrado.');</script>";
				
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
		header("Location:".base_url.'proveedor/index');
	}

	/*public function eli(){
		Utils::useraccess('proveedor/index' ,$_SESSION['pefid']);
		if(isset($_GET['idprov'])){
			$idprov = $_GET['idprov'];
		
			$proveedor = new Proveedor();
			$datmun = $proveedor->getMunicipio();
			$proveedors = $proveedor->getAll();
			$proveedor->eli($idprov);
			require_once 'views/proveedor.php';
		}else{
			header('Location:'.base_url.'proveedor/index');
		}
	}*/

	public function eliciiu(){
		Utils::useraccess('proveedor/index' ,$_SESSION['pefid']);
		if(isset($_GET['idprov']) and isset($_GET['idciiu'])){
			$idprov = $_GET['idprov'];
			$idciiu = $_GET['idciiu'];
			$proveedor = new Proveedor();
			$proveedor->setIdprov($idprov);
			$proveedor->setIdciiu($idciiu);
			$proveedor->del();
		}
		header('Location:'.base_url.'proveedor/index');
	}

	public function salbus(){
		Utils::useraccess('proveedor/buspro' ,$_SESSION['pefid']);
		// var_dump($_POST);
		// die();

		if (isset($_POST)) {
			$idpb  = isset($_POST["ultima"]) ? $_POST["ultima"]:NULL;
			$idprov = isset($_POST["b"]) ? $_POST["b"]:NULL;
			$salproveed="";
			if($idprov){			
				for ($i=0;$i<count($idprov);$i++){
					if ((count($idprov)-$i)==1) {
						$salproveed .= $idprov[$i];
					}else{
						$salproveed .= $idprov[$i].",";
					} 				
				}

				$pfinand2= new Proveedor();
				$pfinand2->insDetConsul($idpb,$salproveed);	
				$pfinand2->editbusal($idpb);	
			}
		}
		header('Location:'.base_raiz.'modulo/mod&id=8');
			
	}
	
}