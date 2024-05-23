<?php
include'models/docpro.php';
include'models/proveedor.php';

class docproController{
	
	public function index(){
		Utils::useraccess('docpro/index' ,$_SESSION['pefid']);
		if(isset($_GET['idprov'])){
			$idprov = $_GET['idprov'];
		
			$docpro = new Docpro();
			$proveedor = new Proveedor();
			$proveedor->setIdprov($idprov);
			$ciius2 = $proveedor->getCiiu($idprov);
			$docpros = $docpro->getAll();
			$va = $proveedor->getOne();
			$docm = $docpro->getVal(24);
			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/docpro.php';
			
		}else{
			header('Location:'.base_url.'proveedor/index');
		}
	}

	public function save(){
		Utils::useraccess('docpro/index' ,$_SESSION['pefid']);
		if(isset($_POST)){

			$iddoc= isset($_POST['iddoc']) ? $_POST['iddoc'] : false;
			$valid = isset($_POST['valid']) ? $_POST['valid'] : false;
			$valor = isset($_POST['valor']) ? $_POST['valor'] : false;
			$idprov = isset($_POST['idprov']) ? $_POST['idprov'] : false;
			
			if($valid){	
				$docpro = new Docpro();
				$docpro->setIddoc($iddoc);
				$docpro->setIdprov($idprov);
				$docpros = $docpro->getAll();
				for ($i=0; $i<count($valid); $i++) {
					$ruta = isset($_FILES['ruta'.$i]["name"]) ? $_FILES['ruta'.$i]["name"] : false;   
					if($ruta){
						$docpro->setValid($valid[$i]);
						$docpro->setValor($valor[$i]);
						$arcpro = Utils::opti($_FILES['ruta'.$i], $idprov."_".$valid[$i],"arcprv","");
						$docpro->setRuta($arcpro);
						$save = $docpro->save();
						//echo "<script>alert('Su documento a sido registrado.');</script>";
						if($save){

							$_SESSION['register'] = "complete";
						}else{
							$_SESSION['register'] = "failed";
						}						
					}	
				}
			}else{
				$_SESSION['register'] = "failed";
			}
		}
		header ("Location:".base_url.'docpro/index');
	}
			
	public function edit(){
		Utils::useraccess('docpro/index' ,$_SESSION['pefid']);
		if(isset($_GET['iddoc'])){
			$iddoc = $_GET['iddoc'];
			$edit = true;
		
			$docpro = new Docpro();
			$docpro->setIddoc($iddoc);
			$docpros = $docpro->getAll();

			$val = $docpro->getOne();
			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/docpro.php';
			
		}else{
			header('Location:'.base_url.'docpro/index');
		}
	}

	
	public function elidoc(){
		Utils::useraccess('docpro/index' ,$_SESSION['pefid']);
		if(isset($_GET['iddoc'])){
			$iddoc = $_GET['iddoc'];
			$docpro = new Docpro();
			$docpro->setIddoc($iddoc);
			$docpro->del();
		}
		header('Location:'.base_url.'docpro/index');
	}
}