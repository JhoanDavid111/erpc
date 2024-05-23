<?php
include'models/mbas.php';
require_once '../../PHPExcel/Classes/PHPExcel.php';

class basController{
	
	public function index(){		
		Utils::useraccess('bas/index',$_SESSION['pefid']);
		$html = NULL;
		
		$mbas = new Mbas();
		$dom = $mbas->getDom();

		//$pfvig = $pfinan->getVig();
		require_once 'views/vbas.php';
	}

	public function inser(){		
		Utils::useraccess('bas/index',$_SESSION['pefid']);
	
		date_default_timezone_set('America/Bogota');
   		$fecSis = date("Y-m-d H:i:s");
   		$mbas = new Mbas();
		$dom = $mbas->getDom();
		$tipo = isset($_POST['tipo']) ? $_POST['tipo']:NULL;
		$docext =NULL;

   		$html = NULL;
////////////////////// Cargar archivos Inicio /////////////////////////////
   		$arcexc = isset($_FILES['arcexc']["name"]) ? $_FILES['arcexc']["name"]:NULL;
   		if($arcexc){
   			$pre = substr($_FILES['arcexc']["name"],0,3);
			$arcexc2 = Utils::opti($_FILES['arcexc'], date('YmdHis'),"elec",$pre);
			$docext = pathinfo($_FILES['arcexc']["name"], PATHINFO_EXTENSION);
			$html .= "<br>El archivo se cargó correctamente en el servidor.";
		}else{
			$html .= "<br>ERROR: El archivo No se cargó en el servidor.";
		}
		
////////////////////// Cargar archivos Fin /////////////////////////////

////////////////////// Extrae zip Inicio /////////////////////////////
		if($docext=='zip' or $docext=='gz'){
			$rut = path_file.'elec';
			//$rut = '/elec';
			$extract = Utils::extract(path_filem.$arcexc2, $rut, $_FILES['arcexc']["name"]);
			if($extract){
			    //echo $GLOBALS['status']['success'];
			    $html .= "Se descomprimio el archivo exitosamente.";
			}else{
			    $html .= $GLOBALS['status']['error'];
			}
		}
////////////////////// Extrae zip Fin /////////////////////////////

////////////////////// Lee el TXT, compara datos, inserta INICIO /////////////////////////////
		if($tipo){
			$elec = $mbas->getVal($tipo);    
			$archivo = fopen(path_file.$arcexc2, "r");
			if($tipo==2 OR $tipo==3 OR $tipo==4 OR $tipo==5){
				$mbas->setIddel($tipo);
				$mbas->delDat();
			}
			if($tipo==6) $mbas->delDp();
			if($tipo==7) $mbas->delPar();
			//if($tipo==8) $mbas->delCan();
			while(!feof($archivo)){
				$fil = NULL;
				$linea = fgets($archivo);
				if($elec){
			    	foreach ($elec as $el) {
				    	// echo $el['idvel']."-".$el['nomvel']."-".$el['iddel']."-".$el['fijvel']."-".$el['prevel']."<br>";

				    	if($el['fijvel']==0)
				    		$fil[] = substr(nl2br($linea), $el['prevel'],strpos(nl2br($linea), "<br />")-1);
				    	else
					    	$fil[] = substr(nl2br($linea), $el['prevel'], $el['fijvel']);
					    // echo nl2br($linea);
		    		}
				}
				// var_dump($fil);echo "<br>";
				// echo $tipo."<br>";
				// die();

				switch($tipo){
					case 6:   // División Política
						if($fil[0] AND $fil[1] AND $fil[2] AND $fil[3] AND $fil[4] AND $fil[5] AND $fil[6] AND $fil[7] AND $fil[10] AND $fil[11] AND $fil[13]){
							//echo "Le entra 2";
							$mbas->setEledpid($fil[0]);
							$mbas->setElecdep($fil[1]);
							$mbas->setElecmun($fil[2]);
							$mbas->setEleczon($fil[3]);
							$mbas->setElcpue($fil[4]);
							$mbas->setElendep(rtrim($fil[5]));
							$mbas->setElenmun(rtrim($fil[6]));
							$mbas->setElenpue(rtrim($fil[7]));
							$mbas->setEleipue($fil[8]);
							$mbas->setElephom($fil[9]);
							$mbas->setElepmuj($fil[10]);
							$mbas->setElenmes($fil[11]);
							$mbas->setEleccom($fil[12]);
							$mbas->setElencom(rtrim($fil[13]));
							$mbas->insDp();
							//$html .= "<br>Datos de División política insertados con éxito.";
						}
						break;
					case 7:   // Partidos
						if($fil[0] AND $fil[1]){
							$mbas->setElecp($fil[0]);
							$mbas->setElenp(rtrim($fil[1]));
							$mbas->insPar();
							//$html .= "<br>Datos de Partidos insertados con éxito.";
						}
						break;
					case 8:   // Candidatos
						// echo "Le entra 1";
						$dm = $mbas->getDM();
						$dtdd = $this->arrstr($dm,'elecdep');
						$dtdm = $this->arrstr($dm,'elecmun');
						$podd = strpos($dtdd,intval($fil[2]));
						$podm = strpos($dtdm,intval($fil[3]));
						//echo $fil[2]." ".$fil[3]."<br>";
						
						if($fil[2] and $fil[3]==0){ 
							$podd = strpos($dtdm,intval($fil[2]));
							//echo $podd." Le entra<br>"; 
						}
						//die();
						if($fil[8] && (($podd>-1 && $podm>-1) || ($podd>-1 && intval($fil[3])==0))){
							// echo "Le entra 2";
							//$mbas->setIdcan($fil[0]);
							$mbas->setCorp($fil[0]);
							$mbas->setCirc($fil[1]);
							$mbas->setElecdep($fil[2]);
							$mbas->setElecmun($fil[3]);
							$mbas->setEleccom($fil[4]);
							$mbas->setElecp($fil[5]);
							$mbas->setEleccan($fil[6]);
							$mbas->setPtip($fil[7]);
							$mbas->setNcan($fil[8]);
							$mbas->setAcan($fil[9]);
							$mbas->setCcan($fil[10]);
							$mbas->setGcan($fil[11]);
							$mbas->setScan($fil[12]);
							$mbas->insCan();
							//$html .= "<br>Datos de Candidatos insertados con éxito.";
						}
						break;
					default:   // Datos Generales
						if($fil[0] AND $fil[1]){
							$mbas->setIddat($fil[0]);
							$mbas->setNomdat(rtrim($fil[1]));
							$mbas->setIddel($tipo);
							$mbas->insDat();
							//idvel, nomvel, iddel, fijvel, prevel
						}
						break;
				}
			}
			$dtng = $mbas->getDomO($tipo);
			$html .= "<br>Datos de ".$dtng[0]['nomdel']." insertados con éxito.";
			fclose($archivo);
		}
////////////////////// Lee el TXT, compara datos, inserta FIN /////////////////////////////
		require_once 'views/vbas.php';
	}

	public function arrstr($dt,$dm){
	  $txt = "";
	  if($dt){ foreach ($dt as $d) {
	    $txt .= $d[$dm].",";
	  }}
	  return $txt;
	}
}