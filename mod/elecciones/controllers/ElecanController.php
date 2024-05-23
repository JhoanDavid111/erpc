<?php
include'models/mbas.php';

class elecanController{
	
	public function index(){		
		Utils::useraccess('elecan/index',$_SESSION['pefid']);
	
		$elecan = new mbas();
		//$elecans = $elecan->getCanAll();		
		$corporacion = $elecan->getDatAll(3);
		$circuns = $elecan->getDatAll(2);
		$elepars = $elecan->getParAll();
		$getmuns = $elecan->getMuns();		
		

		if (isset($_POST['selmun'])) {
			$showcan=1;
			$opcionSeleccionada = $_POST["selmun"]; 
			$corp2=$_POST["corp2"];    
        	// Divide la opción seleccionada en sus valores individuales
        	list($elecdep, $elecmun) = explode(":", $opcionSeleccionada);
			$elecans = $elecan->getCanAll2($elecdep,$elecmun,$corp2);	
			$_SESSION['elecdep']=$elecdep;	
			$_SESSION['elecmun']=$elecmun;
			$_SESSION['corp']=$corp2;	
		}else if (isset($_SESSION['elecdep'])) {
			$elecans = $elecan->getCanAll2($_SESSION['elecdep'], $_SESSION['elecmun'],$_SESSION['corp']);	
			$showcan=1;
		}

		

	

		require_once 'views/elecan.php';
	}

	public function save(){
		Utils::useraccess('elecan/index',$_SESSION['pefid']);
		if(isset($_POST)){
			$idcan = isset($_POST['idcan']) ? $_POST['idcan'] : false;
			$corp = isset($_POST['corp']) ? $_POST['corp'] : false;
			$circ = isset($_POST['circ']) ? str_pad($_POST['circ'], 2, "0", STR_PAD_LEFT) : false;
			$elecdep = isset($_POST['elecdep']) ? str_pad($_POST['elecdep'], 2, "0", STR_PAD_LEFT) : false;
			$elecmun = isset($_POST['elecmun']) ? str_pad($_POST['elecmun'], 3, "0", STR_PAD_LEFT) : false;
			$eleccom = isset($_POST['eleccom']) ? $_POST['eleccom'] : false;
			$elecp = isset($_POST['elecp']) ? $_POST['elecp'] : false;
			$eleccan = isset($_POST['eleccan']) ? $_POST['eleccan'] : false;
			$ptip = isset($_POST['ptip']) ? str_pad($_POST['ptip'] , 2, "0", STR_PAD_LEFT) : false;
			$ncan = isset($_POST['ncan']) ? $_POST['ncan'] : false;
			$acan = isset($_POST['acan']) ? $_POST['acan'] : false;
			$ccan = isset($_POST['ccan']) ? $_POST['ccan'] : false;
			$gcan = isset($_POST['gcan']) ? $_POST['gcan'] : false;
			$scan = isset($_POST['scan']) ? $_POST['scan'] : false;

			$ccan=trim($ccan);


			 // Verifica si se ha subido un archivo y si no hay errores

		    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {

			
		        // Verifica que el tipo de archivo sea PNG
		        $tipo_permitido = "image/png";
		        if ($_FILES["imagen"]["type"] == $tipo_permitido) {


		            $nombre_archivo = $_FILES["imagen"]["name"];
		            $carpeta_destino = "./img/"; // Reemplaza "directorio_destino" con la carpeta a la que deseas subir la imagen

					$explode = explode('.', $nombre_archivo);
					$tipoarchivo = array_pop($explode);
		            $ruta_destino = $carpeta_destino . $ccan .".".$tipoarchivo;

		            // var_dump($ruta_destino);
		            // die();

		            

		            // Mueve el archivo desde la ubicación temporal al directorio de destino
		            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_destino)) {
		            	chmod($carpeta_destino, 0777);
		                //echo "La imagen se ha subido correctamente.";
		               
		            } else {
		                //echo "Hubo un problema al subir la imagen.";
		            }
		        } else {
		            echo "Solo se permiten archivos PNG.";
		        }
		    } else {
		        echo "Error al subir el archivo.";
		    }

			
			if($corp && $circ){
				$elecan = new mbas();
				$elecan->setIdcan($idcan);
				$elecan->setCorp($corp);
				$elecan->setCirc($circ);
				$elecan->setElecdep($elecdep);
				$elecan->setElecmun($elecmun);
				$elecan->setEleccom($eleccom);
				$elecan->setElecp($elecp);
				$elecan->setEleccan($eleccan);
				$elecan->setPtip($ptip);
				$elecan->setNcan($ncan);
				$elecan->setAcan($acan);
				$elecan->setCcan($ccan);
				$elecan->setGcan($gcan);
				$elecan->setScan($scan);

				$elecans = $elecan->getCanAll();

				// $save = $elecan->save();
				// $edit = $elecan->edit();
				if(isset($_GET['idcan'])){
					$idcan = $_GET['idcan'];
					$elecan->setIdcan($idcan);
					
					$save = $elecan->updCan();
				}else{
					$save = $elecan->insCan();
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
		header("Location:".base_url.'elecan/index');
	}

	public function edit(){
		Utils::useraccess('elecan/index',$_SESSION['pefid']);
		if(isset($_GET['idcan'])){
			$idcan = $_GET['idcan'];
// var_dump($idcan);
// die();
			$edit = true;
		
			$elecan = new mbas();
			$elecan->setIdcan($idcan);
			$elecans = $elecan->getCanAll();
			$domfins = $elecan->getDomAll();

			$val = $elecan->getCan($idcan);
			// var_dump($edit);
			// var_dump($val);


			$corporacion = $elecan->getDatAll(3);
			$circuns = $elecan->getDatAll(2);
			$elepars = $elecan->getParAll();

			
			require_once 'views/elecan.php';
			
		}else{
			header('Location:'.base_url.'elecan/index');
		}
	}

	public function act(){
		Utils::useraccess('elecan/index',$_SESSION['pefid']);
		if(isset($_GET['idcan']) AND isset($_GET['act'])){
			$idcan = $_GET['idcan'];
			$act = $_GET['act'];
		
			$elecan = new mbas();
			$elecan->setIdcan($idcan);
			$elecan->setAct($act);
			$elecan->updCanA();
		}
		header('Location:'.base_url.'elecan/index');
	}
}