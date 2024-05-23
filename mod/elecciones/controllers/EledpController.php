<?php
include'models/mbas.php';

class eledpController{
	
	public function index(){		
		Utils::useraccess('eledp/index',$_SESSION['pefid']);
	
		$eledp = new mbas();
		$eledps = $eledp->getDpAll();

		require_once 'views/eledp.php';
	}

	public function save(){
		Utils::useraccess('eledp/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$eledpid = isset($_POST['eledpid']) ? $_POST['eledpid'] : false;
			$elendep = isset($_POST['elendep']) ? $_POST['elendep'] : false;
			$elecdep = isset($_POST['elecdep']) ? str_pad($_POST['elecdep'], 2, "0", STR_PAD_LEFT) : false;
			$elenmun = isset($_POST['elenmun']) ? $_POST['elenmun'] : false;
			$elenpue = isset($_POST['elenpue']) ? $_POST['elenpue'] : false;
			$elecmun = isset($_POST['elecmun']) ? str_pad($_POST['elecmun'], 3, "0", STR_PAD_LEFT) : false;
			$eleczon = isset($_POST['eleczon']) ? str_pad($_POST['eleczon'], 2, "0", STR_PAD_LEFT) : false;
			$elcpue = isset($_POST['elcpue']) ? str_pad($_POST['elcpue'] , 2, "0", STR_PAD_LEFT) : false;
			$eleipue = isset($_POST['eleipue']) ? $_POST['eleipue'] : false;
			$elephom = isset($_POST['elephom']) ? $_POST['elephom'] : false;
			$elepmuj = isset($_POST['elepmuj']) ? $_POST['elepmuj'] : false;
			$elenmes = isset($_POST['elenmes']) ? $_POST['elenmes'] : false;
			$eleccom = isset($_POST['eleccom']) ? $_POST['eleccom'] : false;
			$elencom = isset($_POST['elencom']) ? $_POST['elencom'] : false;
			
			if($elendep && $elecdep){
				$eledp = new mbas();
				$eledp->setEledpid($elecdep.$elecmun.$eleczon.$elcpue);
				$eledp->setElendep($elendep);
				$eledp->setElecdep($elecdep);
				$eledp->setElenmun($elenmun);
				$eledp->setElenpue($elenpue);
				$eledp->setElecmun($elecmun);
				$eledp->setEleczon($eleczon);
				$eledp->setElcpue($elcpue);
				$eledp->setEleipue($eleipue);
				$eledp->setElephom($elephom);
				$eledp->setElepmuj($elepmuj);
				$eledp->setElenmes($elenmes);
				$eledp->setEleccom($eleccom);
				$eledp->setElencom($elencom);

				$eledps = $eledp->getDpAll();

				// $save = $eledp->save();
				// $edit = $eledp->edit();
				if(isset($_GET['eledpid'])){
					$eledpid = $_GET['eledpid'];
					$eledp->setEledpid($eledpid);
					
					$save = $eledp->updDp();
				}else{
					$save = $eledp->insDp();
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
		header("Location:".base_url.'eledp/index');
	}

	public function edit(){
		Utils::useraccess('eledp/index',$_SESSION['pefid']);
		if(isset($_GET['eledpid'])){
			$eledpid = $_GET['eledpid'];
// var_dump($eledpid);
// die();
			$edit = true;
		
			$eledp = new mbas();
			$eledp->setEledpid($eledpid);
			$eledps = $eledp->getDpAll();
			$domfins = $eledp->getDomAll();

			$val = $eledp->getDp($eledpid);
			// var_dump($edit);
			// var_dump($val);
			
			require_once 'views/eledp.php';
			
		}else{
			header('Location:'.base_url.'eledp/index');
		}
	}
}