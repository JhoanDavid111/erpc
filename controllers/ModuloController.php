<?php
require_once 'models/modulos.php';

class moduloController{
	
	public function index(){}

	public function mod(){
		session_start();
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$_SESSION['idmod'] = $id;
			$_SESSION['pefid'] = NULL;
			$_SESSION['pefnom'] = NULL;
			$mod = new Modulos();


			switch ($id) {
				case 1: // 1	Documentacion
          $perfil = $mod->getPerfil(1, $_SESSION['perid']);
        	$_SESSION['pefid'] = $perfil[0]['pefid'];
        	$_SESSION['pefnom'] = $perfil[0]['pefnom'];
        	//header('Location:../mod/document/');
        	header('Location:https://intranet.canalcapital.gov.co/intranet/docdowncc/');
          break;
        case 2: // 2	Radicacion
          $perfil = $mod->getPerfil(2, $_SESSION['perid']);
        	$_SESSION['pefid'] = $perfil[0]['pefid'];
        	$_SESSION['pefnom'] = $perfil[0]['pefnom'];
        	$_SESSION['depid'] = $perfil[0]['depid'];
        	$_SESSION['nomarea'] = $perfil[0]['valnom'];
        	header('Location:../mod/radica/');
          break; 
        case 3: // 3	Contratos
        	$perfil = $mod->getPerfil(3, $_SESSION['perid']);
        	$_SESSION['pefid'] = $perfil[0]['pefid'];
        	$_SESSION['pefnom'] = $perfil[0]['pefnom'];
        	$_SESSION['depid'] = $perfil[0]['depid'];
        	$_SESSION['nomarea'] = $perfil[0]['valnom'];
        	header('Location:../mod/contrato/');
          break;
        case 4: // 4	Soporte
          $perfil = $mod->getPerfil(4, $_SESSION['perid']);
        	$_SESSION['pefid'] = $perfil[0]['pefid'];
        	$_SESSION['pefnom'] = $perfil[0]['pefnom'];
        	header('Location:../mod/soporte/');
          break;
        case 5: // 5  Gestión Documental
          $perfil = $mod->getPerfil(5, $_SESSION['perid']);
          $_SESSION['pefid'] = $perfil[0]['pefid'];
          $_SESSION['pefnom'] = $perfil[0]['pefnom'];
          $_SESSION['depid'] = $perfil[0]['depid'];
          $_SESSION['nomarea'] = $perfil[0]['valnom'];
          header('Location:../mod/gestiondoc/');
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
        case 10: // 10  Preguntas y Repuestas Simulador temporal
          /* $perfil = $mod->getPerfil(10, $_SESSION['perid']);
          $_SESSION['pefid'] = $perfil[0]['pefid'];
          $_SESSION['pefnom'] = $perfil[0]['pefnom'];
          header('Location:../mod/temporal/'); */
          header('Location:https://intranet.canalcapital.gov.co/intranet/radicado-cuentas-de-cobro/');
          break;
        case 11: // 9	Derecho de Autor
        	$perfil = $mod->getPerfil(11, $_SESSION['perid']);
        	$_SESSION['pefid'] = $perfil[0]['pefid'];
        	$_SESSION['pefnom'] = $perfil[0]['pefnom'];
        	header('Location:../mod/preres/');
          break;
        case 12: // 12 Simulador
          $perfil = $mod->getPerfil(12, $_SESSION['perid']);
          $_SESSION['pefid'] = $perfil[0]['pefid'];
          $_SESSION['pefnom'] = $perfil[0]['pefnom'];
          header('Location:../mod/simulador/');
          break;
        case 13: // 13 Elecciones
          $perfil = $mod->getPerfil(13, $_SESSION['perid']);
          $_SESSION['pefid'] = $perfil[0]['pefid'];
          $_SESSION['pefnom'] = $perfil[0]['pefnom'];
          $_SESSION['depid'] = $perfil[0]['depid'];
          $_SESSION['nomarea'] = $perfil[0]['valnom'];
          header('Location:../mod/elecciones/');
          break;
        case 14: // 14 Proveedores
          $perfil = $mod->getPerfil(14, $_SESSION['perid']);
          $_SESSION['pefid'] = $perfil[0]['pefid'];
          $_SESSION['pefnom'] = $perfil[0]['pefnom'];
          $_SESSION['depid'] = $perfil[0]['depid'];
          $_SESSION['nomarea'] = $perfil[0]['valnom'];
          if ($_GET['bus']==1) {
            header('Location:../mod/proveedor/proveedor/buspro&iddpa='.$_GET['iddpa']);
          }else{
            header('Location:../mod/proveedor/');
          }
          break;
        case 20: // 20  Radicacion Old
          echo '<script>window.location="https://intranet.canalcapital.gov.co/intranet/docdowncc/index.php?pg=501";</script>';
          break;
        case 21: // 21  Control Interno
          $perfil = $mod->getPerfil(21, $_SESSION['perid']);
          $_SESSION['pefid'] = $perfil[0]['pefid'];
          $_SESSION['pefnom'] = $perfil[0]['pefnom'];
          $_SESSION['depid'] = $perfil[0]['depid'];
          $_SESSION['nomarea'] = $perfil[0]['valnom'];
          // OR $_SESSION['pefid']==71
          if($_SESSION['pefid']==58 or $_SESSION['pefid']==70)
            header('Location:../mod/conint/');
          else
            header('Location:../mod/conint/plamej/inst');
          break;
        case 23: // 23 Recursos Humanos
          $perfil = $mod->getPerfil(23, $_SESSION['perid']);
          $_SESSION['pefid'] = $perfil[0]['pefid'];
          $_SESSION['pefnom'] = $perfil[0]['pefnom'];
          $_SESSION['depid'] = $perfil[0]['depid'];
          $_SESSION['nomarea'] = $perfil[0]['valnom'];
          header('Location:../mod/rrhh/');
          break;
        case 24: // 24 tv
          $perfil = $mod->getPerfil(24, $_SESSION['perid']);          
          $_SESSION['pefid'] = $perfil[0]['pefid'];
          $_SESSION['pefnom'] = $perfil[0]['pefnom'];
          $_SESSION['depid'] = $perfil[0]['depid'];
          $_SESSION['nomarea'] = $perfil[0]['valnom'];          
          header('Location:../mod/tv/');
          break;
        case 26: // 25 webservice
          $perfil = $mod->getPerfil(26, $_SESSION['perid']);          

          $_SESSION['pefid'] = $perfil[0]['pefid'];
          $_SESSION['pefnom'] = $perfil[0]['pefnom'];
          $_SESSION['depid'] = $perfil[0]['depid'];
          $_SESSION['nomarea'] = $perfil[0]['valnom'];          
          header('Location:../mod/webservice/');
          break;
        default:
          //echo "Valor no valido";                
          break;
      }
		}
	}
	
  public function firm(){
    session_start();
    $perid = isset($_SESSION['perid']) ? $_SESSION['perid']:NULL;
    $arch = isset($_FILES['arch']["name"]) ? $_FILES['arch']["name"]:NULL;
    if($perid AND $arch){
      $rutcdp = Utils::opti($_FILES['arch'], "fir_".$perid, "firma","");
      header('Location:../views/modulos.php');
    }
  }

} // fin clase