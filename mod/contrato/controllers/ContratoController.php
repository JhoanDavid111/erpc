<?php
include'models/contrato.php';
include'../financiera/models/detpaadoc.php';

class contratoController{
	
	public function index(){		
		Utils::useraccess('contrato/index',$_SESSION['pefid']);

		$contrato = new contrato();
		date_default_timezone_set('America/Bogota');
		$ano = isset($_POST['ano']) ? $_POST['ano']:date("Y");
		$est = isset($_POST['st']) ? $_POST['st']:NULL;
		$abo = isset($_POST['ab']) ? $_POST['ab']:NULL;
		$mes = date('n');
		$databo = $contrato->selabogado(13);
		$datare = $contrato->selval(1);
		$datst = $contrato->selval(11);
		$datab = $contrato->selabo();
		$datTA = $contrato->selTA();
		$anos = $contrato->selAno();
		$detpaadoc = new Detpaadoc();
		$act = "Contrato";

		$datest = $contrato->selAllEst();
		if(isset($_GET['idtra']) AND isset($_GET['le'])){
			$contrato->updlei($_SESSION["perid"], $_GET['idtra'], 2);
		}
		// if(isset($_GET['elcon'])){
		// 	$elcon = $_GET['elcon'];
		// 	$eli = $contrato->updeli($elcon);
		// }
		$contratos = $contrato->getAll($ano,$est,$abo);
		$tipo = $contrato->getAllVal(20);

		if(isset($_GET['elcon'])){
			$elcon = $_GET['elcon'];
			$eli = $contrato->updeli($elcon);
		}

		$fes = $contrato->selfest($ano);

		
		$plug1 = $this->plugin(1, $mes);
		$plug2 = $this->plugin(2, $mes);
		$plug3 = $this->plugin(3, $mes);
		$plug4 = $this->plugin(4, $mes);
		$plug5 = $this->plugin(5, $mes);

		// var_dump($tipo);
		// die();
		// if(isset($_SESSION['pefid'])){
			// if($_SESSION['pefid']==24)
				require_once 'views/contrato.php';
			// else
			// 	require_once 'views/contratos.php';
		// }else
		// 	require_once 'views/contratos.php';
	}

	public function save(){
		Utils::useraccess('contrato/index',$_SESSION['pefid']);
		if(isset($_POST)){

			$idcon = isset($_POST['idcon']) ? $_POST['idcon'] : false;
			date_default_timezone_set('America/Bogota');
			$ano = isset($_GET['ano']) ? $_GET['ano']:date("Y");
			$est = isset($_POST['st']) ? $_POST['st']:NULL;
			$abo = isset($_POST['ab']) ? $_POST['ab']:NULL;
			$feccon = date("Y-m-d H:i:s");
			$perid = isset($_POST['perid']) ? $_POST['perid'] : false;
			$valid = isset($_POST['valid']) ? $_POST['valid'] : false;
			$nomcon = isset($_POST['nomcon']) ? $_POST['nomcon'] : false;
			$objcon = isset($_POST['objcon']) ? $_POST['objcon'] : false;
			$parid = isset($_POST['parid']) ? $_POST['parid'] : false;
			$linexpcon = isset($_POST['linexpcon']) ? $_POST['linexpcon'] : false;
			$lineccon = isset($_POST['lineccon']) ? $_POST['lineccon'] : false;
			$pubseccon = isset($_POST['pubseccon']) ? $_POST['pubseccon'] : false;
			$enlseccon = isset($_POST['enlseccon']) ? $_POST['enlseccon'] : false;
			$arch = isset($_FILES['arch']["name"]) ? $_FILES['arch']["name"]:NULL;
			$noseccon = isset($_POST['noseccon']) ? $_POST['noseccon'] : false;

	// echo $perid."-".$valid."-".$pubseccon."-".$enlseccon;
	// die();


			if($feccon && $perid && $valid && $linexpcon){
				$contrato = new contrato();
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
				}

				//echo "<script>alert('Su contrato ha sido registrada. Pronto estaremos en contacto.');</script>";
				
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
		header("Location:".base_url.'contrato/index');
	}

	public function savetra(){
		Utils::useraccess('contrato/index',$_SESSION['pefid']);
		if(isset($_POST)){
//idcon, fectra, valid, obstra, perid
			$idcon = isset($_POST['idcon']) ? $_POST['idcon'] : false;
			date_default_timezone_set('America/Bogota');
			$ano = isset($_GET['ano']) ? $_GET['ano']:date("Y");
			$est = isset($_POST['st']) ? $_POST['st']:NULL;
			$abo = isset($_POST['ab']) ? $_POST['ab']:NULL;
			$fectra = date("Y-m-d H:i:s");
			$perid = isset($_POST['perid']) ? $_POST['perid'] : false;
			$idabo = isset($_POST['idabo']) ? $_POST['idabo'] : false;
			
			$valid = isset($_POST['valid']) ? $_POST['valid'] : false;
			$codest = isset($_POST['codest']) ? $_POST['codest'] : false;
			$obstra = isset($_POST['obstra']) ? $_POST['obstra'] : false;
			
	// echo $perid."-".$valid."-".$pubseccon."-".$enlseccon;
	// die();
// echo "<br><strong>Idcon</strong><br>";
// var_dump($idcon);
// echo "<br><strong>Fectra</strong><br>";
// var_dump($fectra);
// echo "<br><strong>Perid</strong><br>";
// var_dump($perid);
// echo "<br><strong>Idabo</strong><br>";
// var_dump($idabo);
// echo "<br><strong>Valid</strong><br>";
// var_dump($valid);
// echo "<br><strong>Codest</strong><br>";
// var_dump($codest);
// echo "<br><strong>Obstra</strong><br>";
// var_dump($obstra);
// die();
				
			if($idcon && $fectra && $perid && $valid){
				$contrato = new contrato();	
				for ($i=0;$i<count($idcon);$i++){
					if($codest[$i]!=$valid[$i]){ //$obstra[$i]){
						$contrato->setIdcon($idcon[$i]);
						$contrato->setFectra($fectra);
						$contrato->setPerid($_SESSION["perid"]);
						$contrato->setValid($valid[$i]);
						$contrato->setObstra($obstra[$i]);

						$contratos = $contrato->getAll($ano,$est,$abo);;
						$tipo = $contrato->getAllVal(20);
						$save = $contrato->savetraz();
						if($save){
							$_SESSION['register'] = "complete";
						}else{
							$_SESSION['register'] = "failed";
						}
					}
					if($perid[$i]!=0 && $perid[$i]!=$idabo[$i]){
						$contrato->updcotabo($idcon[$i], $perid[$i]);
					}
				}
			}else{
				$_SESSION['register'] = "failed";
			}
		}else{
			$_SESSION['register'] = "failed";
		}
		header("Location:".base_url.'contrato/index');
	}

	public function edit(){
		Utils::useraccess('contrato/index',$_SESSION['pefid']);
		if(isset($_GET['idcon'])){
			$idcon = $_GET['idcon'];
// var_dump($idcon);
// die();
			$edit = true;
			$est = isset($_POST['st']) ? $_POST['st']:NULL;
			$abo = isset($_POST['ab']) ? $_POST['ab']:NULL;
		
			$contrato = new contrato();
			date_default_timezone_set('America/Bogota');
			$ano = isset($_GET['ano']) ? $_GET['ano']:date("Y");
			$contrato->setidcon($idcon);
			$contratos = $contrato->getAll($ano,$est,$abo);;
			$tipo = $contrato->getAllVal(20);

			$val = $contrato->getOne();
			// var_dump($edit);
			// var_dump($val);
			// die();
			require_once 'views/contrato.php';
			
		}else{
			header('Location:'.base_url.'contrato/index');
		}
	}

	function plugin($proceso, $mes){

		$contrato = new contrato();
		date_default_timezone_set('America/Bogota');
		$ano = isset($_GET["ano"]) ? $_GET["ano"]:date("Y");

		$pefid = isset($_SESSION["pefid"]) ? $_SESSION["pefid"]:NUll;
		$perid = isset($_SESSION["perid"]) ? $_SESSION["perid"]:NULL;
		$rsano = $contrato->setotact($proceso,$ano, NULL, $perid, $pefid);
		$rsmes = $contrato->setotact($proceso,$ano, $mes, $perid, $pefid);
		$rsnot = $contrato->setnot($perid, $pefid);
		$mest = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

		$tx = '';
		if($rsano){

			$tx .= '<div class="dvplgn">';
				$tx .= '<div class="inttop">';
					if($proceso==1)
						$tx .= 'En proceso mes actual ';
					elseif($proceso==2)
						$tx .= 'Finalizados ';
					elseif($proceso==3)
						$tx .= 'Mensual';
					elseif($proceso==4)
						$tx .= 'Anual';
					elseif($proceso==5)
						$tx .= '<i style="width: 40px;" class="fa fa-bell fa-2x"></i> Notificaciones';
					else
						$tx .= 'Registro anónimo';
				$tx .= '</div>';

				$sump = 0;
				if($proceso!=4 and $proceso!=5){
					$tx .= '<div class="intplg">';
						if($rsmes){
							foreach ($rsmes as $rms) {
								$sump += $rms['cant'];
								if($proceso==3){
									$tx .= '<div class="divlis1">';
										$tx .= $rms['nomest'];
									$tx .= '</div>';
									$tx .= '<div class="divlis2">';
										$tx .= $rms['cant'];
									$tx .= '</div>';
								}
							}
						}
						if($proceso==3){
							$tx .= '<div class="divlis1"><strong>Total:</strong></div>';
							$tx .= '<div class="divlis2">';
								$tx .= $sump;
							$tx .= '</div>';
						}else{
							$tx .= '<div class="numbig">';
								$tx .= $sump;
							$tx .= '</div>';
						}
					$tx .= '</div>';
				}
				$sumt = 0;
				if($proceso==4) $tx .= '<div class="intplg">';
					foreach ($rsano as $ran) {
						$sumt += $ran['cant'];
						if($proceso==4){
							$tx .= '<div class="divlis1">';
								$tx .= $ran['nomest'];
							$tx .= '</div>';
							$tx .= '<div class="divlis2">';
								$tx .= $ran['cant'];
							$tx .= '</div>';
						}
					}
				if($proceso==4) $tx .= '</div>';

				if($proceso==5){
					$tx .= '<div class="intplg">';
					$sumnot = 0;
					if($rsnot){
						foreach ($rsnot as $rnt) {
							$sumnot += $rnt['cant'];
								$tx .= '<div class="divlis1">';
									$tx .= $rnt['nomest'];
								$tx .= '</div>';
								$tx .= '<div class="divlis2">';
									$tx .= $rnt['cant'];
								$tx .= '</div>';
						}
					}
					$tx .= '</div>';
				}

				$tx .= '<div class="intbot">';
					if($proceso==3) $tx .= ' Mes: '.$mest[$mes]; 
					elseif($proceso!=5) $tx .= ' Año: '.$ano;
					$tx .= '&nbsp;&nbsp;&nbsp; Total: ';
					if($proceso==3) $tx .= $sump; elseif($proceso==5) $tx .= $sumnot; else $tx .= $sumt;
				$tx .= '</div>';
			$tx .= '</div>';
		}

		return $tx;
	}

	public function estudios(){
		require_once 'views/estudios.php';
	}

	public function minutas(){
		$contrato = new Contrato();
		$areas = $contrato->allAreas();
		require_once 'views/minutas.php';
	}

	public function consultarminuta(){
		$numdoc = isset($_POST['num_documento']) ? $_POST['num_documento'] : false;
		$area = isset($_POST['area']) ? $_POST['area'] : false;
		$contrato = new Contrato();
		$obligacon = $contrato->getObligaciones($numdoc,$area);
		if (isset($obligacon[0]['cargo'])) {
			$obligagen = $contrato->getObligacionesGen($obligacon[0]['cargo']);
		}else{
			$obligacon = null;
		}
		


		if ($obligacon) {
		    // Realizar alguna lógica de validación o procesamiento aquí...
		    $cdp = $contrato->getCdp($numdoc,$area);
		    $valetras = $this->convertirNumeroALetras($cdp[0]['asidpa']);
		    $mesesFormateado = $this->convertirNumeroALetras($cdp[0]['nmesdpa']);	    
		    $numeroFormateado = '$ ' . number_format($cdp[0]['asidpa'], 0, ',', '.');
		   
		    // var_dump($valetras);
		    // die();		    
			require_once 'views/minutaPN.php';
		}else{
			echo'<script type="text/javascript">
		    alert("No existe minuta");  
		    </script>';	
		    $this->minutas();
		}

		// var_dump($minuta);
		// die();		
	}

	public function convertirNumeroALetras($numero) {
	    $unidades = array('CERO', 'UNO', 'DOS', 'TRES', 'CUATRO', 'CINCO', 'SEIS', 'SIETE', 'OCHO', 'NUEVE');
	    $diezAQuince = array('DIEZ', 'ONCE', 'DOCE', 'TRECE', 'CATORCE', 'QUINCE');
	    $decenas = array('', '', 'VEINTE', 'TREINTA', 'CUARENTA', 'CINCUENTA', 'SESENTA', 'SETENTA', 'OCHENTA', 'NOVENTA');
	    $centenas = array('', 'CIENTO', 'DOSCIENTOS', 'TRESCIENTOS', 'CUATROCIENTOS', 'QUINIENTOS', 'SEISCIENTOS', 'SETECIENTOS', 'OCHOCIENTOS', 'NOVECIENTOS');

	    if ($numero < 0 || $numero > 10000000000) {
	        return "Número fuera de rango";
	    }

	    if ($numero == 10000000000) {
	        return "DIEZ MIL MILLONES";
	    }

	    $letras = '';

	    $millardos = floor($numero / 1000000000);
	    $numero %= 1000000000;
	    if ($millardos > 0) {
	        if ($millardos == 1) {
	            $letras .= 'UN MIL MILLÓN ';
	        } else {
	            $letras .= $this->convertirNumeroALetras($millardos) . ' MIL MILLONES ';
	        }
	    }

	    $millones = floor($numero / 1000000);
	    $numero %= 1000000;
	    if ($millones > 0) {
	        if ($millones == 1) {
	            $letras .= 'UN MILLÓN ';
	        } else {
	            $letras .= $this->convertirNumeroALetras($millones) . ' MILLONES ';
	        }
	    }

	    $miles = floor($numero / 1000);
	    $numero %= 1000;
	    if ($miles > 0) {
	        if ($miles == 1) {
	            $letras .= 'UN MIL ';
	        } else {
	            $letras .= $this->convertirNumeroALetras($miles) . ' MIL ';
	        }
	    }

	    $centenas_enteras = floor($numero / 100);
	    $numero %= 100;
	    if ($centenas_enteras > 0) {
	        if ($centenas_enteras == 1 && $numero == 0) {
	            $letras .= 'CIEN ';
	        } else {
	            $letras .= $centenas[$centenas_enteras] . ' ';
	        }
	    }

	    $decenas_enteras = floor($numero / 10);
	    $numero %= 10;
	    if ($decenas_enteras > 0) {
	        if ($decenas_enteras == 1) {
	            if ($numero < 6) {
	                $letras .= $diezAQuince[$numero] . ' ';
	            } else {
	                $letras .= 'DIECI' . $unidades[$numero] . ' ';
	            }
	        } elseif ($decenas_enteras == 2 && $numero == 0) {
	            $letras .= 'VEINTE ';
	        } elseif ($decenas_enteras == 2 && $numero > 0) {
	            $letras .= 'VEINTI' . $unidades[$numero] . ' ';
	        } elseif ($decenas_enteras > 2) {
	            $letras .= $decenas[$decenas_enteras] . ' ';
	            if ($numero > 0) {
	                $letras .= 'Y ';
	            }
	        }
	    }

	    if ($numero > 0 && $decenas_enteras != 1) {
	        $letras .= $unidades[$numero] . ' ';
	    }

	    return trim($letras);
	}




	
}