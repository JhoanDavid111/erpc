<?php
include'models/flujo.php';

class flujoController{
	
	public function index(){		
		Utils::useraccess('flujo/index',$_SESSION['pefid']);
		$idflu = NULL;
		$flujo = new Flujo();

		$datpro = $flujo->getProceso();
		$flujos = $flujo->getAll();
		$areasT = $flujo->getAreasT();

		require_once 'views/flujo.php';
	}

	public function save(){
		Utils::useraccess('flujo/index',$_SESSION['pefid']);
		if(isset($_POST)){

			$idflu = isset($_POST['idflu']) ? $_POST['idflu']:false;
			$actflu = isset($_POST['actflu']) ? $_POST['actflu']:false;
			$metflu = isset($_POST['metflu']) ? $_POST['metflu']:false;
			$idpro = isset($_POST['idpro']) ? $_POST['idpro']:false;
			$ordflu = isset($_POST['ordflu']) ? $_POST['ordflu']:false;
			$areas = isset($_POST['areas']) ? $_POST['areas']:false;
			$ntipo = isset($_POST['ntipo']) ? $_POST['ntipo']:false;
			$color = isset($_POST['color']) ? $_POST['color']:false;

			$areas = $this->aTexto($areas);

			if($color=="#000000") $color = NULL;

			if($idflu && $actflu && $idpro && $ordflu && $ntipo){
				$flujo = new Flujo();
				$flujo->setIdflu($idflu);
				$flujo->setActflu($actflu);
				$flujo->setMetflu($metflu);
				$flujo->setIdpro($idpro);
				$flujo->setOrdflu($ordflu);
				$flujo->setAreas($areas);
				$flujo->setNtipo($ntipo);
				$flujo->setColor($color);

				$datpro = $flujo->getProceso();
				$flujos = $flujo->getAll();

				if(isset($_GET['idflu'])){
					$idflu = $_GET['idflu'];
					$flujo->setIdflu($idflu);
					
					$save = $flujo->edit();
				}else{
					$save = $flujo->save();
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
		header("Location:".base_url.'flujo/index');
	}

	public function edit(){
		Utils::useraccess('flujo/index',$_SESSION['pefid']);
		if(isset($_GET['idflu'])){
			$idflu = $_GET['idflu'];
			$edit = true;
		
			$flujo = new flujo();
			$flujo->setIdflu($idflu);
			$datpro = $flujo->getProceso();
			$flujos = $flujo->getAll();
			$areasT = $flujo->getAreasT();

			$val = $flujo->getOne();
			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/flujo.php';
			
		}else{
			header('Location:'.base_url.'flujo/index');
		}
	}

	public function aTexto($vector){
		$pr = "";
		$ci = 0;
		if($vector){
			foreach ($vector as $vec) {
				$pr .= $vec;
				if($ci<count($vector)-1) $pr .= ";";
				$ci++;
			}
		}
		return $pr;
	}
}