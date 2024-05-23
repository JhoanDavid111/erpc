<?php
require_once 'models/modulos.php';

class moduloController{
	
	public function index(){

	}

	public function mod(){
		session_start();


		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$_SESSION['idmod'] = $id;
			$_SESSION['pefid'] = NULL;
			$_SESSION['pefnom'] = NULL;
			$mod = new Modulos();
			// var_dump($_SESSION['ctrlnav']);
			// die();
			switch ($id) {
				case 1: // 1	Documentacion
                  $perfil = $mod->getPerfil(1, $_SESSION['perid']);
                	$_SESSION['pefid'] = $perfil[0]['pefid'];
                	$_SESSION['pefnom'] = $perfil[0]['pefnom'];
                	header('Location:../mod/document/');
                  break;
                case 2: // 2	Radicacion
                  $perfil = $mod->getPerfil(2, $_SESSION['perid']);
                	$_SESSION['pefid'] = $perfil[0]['pefid'];
                	$_SESSION['pefnom'] = $perfil[0]['pefnom'];
                	header('Location:../mod/radica/');
                  break; 
                case 3: // 3	Contratos
                	$perfil = $mod->getPerfil(3, $_SESSION['perid']);
                	$_SESSION['pefid'] = $perfil[0]['pefid'];
                	$_SESSION['pefnom'] = $perfil[0]['pefnom'];

                  // if($_SESSION['ctrlnav']>1){
                  // 	 header('Location:../mod/contrata/home.php');
                  // }else{
                  // 	header('Location:../mod/contrata/modelo/control.php');
                  // }
                  	header('Location:../mod/contrato/');
                  break;
                case 4: // 4	Soporte
                  $perfil = $mod->getPerfil(4, $_SESSION['perid']);
                	$_SESSION['pefid'] = $perfil[0]['pefid'];
                	$_SESSION['pefnom'] = $perfil[0]['pefnom'];
                	header('Location:../mod/soporte/');
                  break;
                case 6: // 6	Pasantes
                  $perfil = $mod->getPerfil(6, $_SESSION['perid']);
                	$_SESSION['pefid'] = $perfil[0]['pefid'];
                	$_SESSION['pefnom'] = $perfil[0]['pefnom'];
                	header('Location:../mod/pasante/');
                  break; 

                case 7: // 7	Configuracion
                	$perfil = $mod->getPerfil(7, $_SESSION['perid']);
                	$_SESSION['pefid'] = $perfil[0]['pefid'];
                	$_SESSION['pefnom'] = $perfil[0]['pefnom'];
                  header('Location:../mod/config/');	
                  break; 
                case 8: // 8	Financiera
                	$perfil = $mod->getPerfil(8, $_SESSION['perid']);
                	$_SESSION['pefid'] = $perfil[0]['pefid'];
                	$_SESSION['pefnom'] = $perfil[0]['pefnom'];
                	$_SESSION['depid'] = $perfil[0]['depid'];
                	$_SESSION['nomarea'] = $perfil[0]['valnom'];
                	
                	
                  header('Location:../mod/financiera/');		
                  break;
                case 9: // 9	Denuncia
                	$perfil = $mod->getPerfil(9, $_SESSION['perid']);
                	$_SESSION['pefid'] = $perfil[0]['pefid'];
                	$_SESSION['pefnom'] = $perfil[0]['pefnom'];
                  header('Location:../mod/denuncia/');		
                  break;

                default:
                  //echo "Valor no valido";                
                  break;
              }
			//header('Location:../mod/financiera/');
		}
				
		//require_once'mod/contrata/index.php';		
		
	}	
	
	
	
} // fin clase