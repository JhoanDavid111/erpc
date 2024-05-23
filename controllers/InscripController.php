<?php
include'mod/rrhh/models/equip.php';
include'mod/rrhh/models/persona.php';



class InscripController{
	
	public function index(){
		//Utils::useraccess('inscrip/index',$_SESSION['pefid']);
		$txtn = isset($_GET['txtn']) ? $_GET['txtn']:NULL;
        $ema = isset($_GET['ema']) ? $_GET['ema']:NULL;
        $ndc = isset($_GET['ndc']) ? $_GET['ndc']:NULL;
        if($txtn=="registrada"){
            $txtn = "¡Su Inscripción ha sido registrada.! Por favor ingrese a:<br><br>";
            $txtn .= "Link: <a href='https://intranet.canalcapital.gov.co/erp/' target='_blank'>https://intranet.canalcapital.gov.co/erp</a><br>";
            $txtn .= "Usuario: ".$ema."<br>";
            $txtn .= "Contraseña: ***** ¡Es su número de documento que acabo de registrar.";
        }
		date_default_timezone_set('America/Bogota');
	   	$hoy = date("Y-m-d");
		$ep=new equip();
		$ninsCap = $ep->getOneCapEX();
        $per = new Persona();
        $dttd = $per->getAllArea(44);
        $dtsx = $per->getAllArea(34);
		$datOne=NULL;
		require_once 'views/inscrip.php';
	}


	public function saveExt(){
    //Utils::useraccess('inscrip/index',$_SESSION['pefid']);   

        if(isset($_POST)){

            $ip = $_SERVER["REMOTE_ADDR"];
            $captcha = $_POST['g-recaptcha-response'];
            $secretKey = '6Lc6LCEfAAAAAAwvPU20257qXSfzkhO0dk8_lI7l';

            $errors = array();

            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captcha}&remoteip={$ip}");

            $atributos = json_decode($response, TRUE);
            if (!$atributos['success']) {
                //$errors[] = 'Verifica el captcha';
                echo '<script language="javascript">alert("Verifica el captcha")</script>';
                echo "<script>location.href='https://intranet.canalcapital.gov.co/erpc/inscrip/index'</script>";
                
                //header("Location:".base_url);
           }else{
                $nodocemp = isset($_POST['nodocemp']) ? $_POST['nodocemp']:NULL;
                $tipdoc = isset($_POST['tipdoc']) ? $_POST['tipdoc']:NULL;
                $pernom = isset($_POST['pernom']) ? $_POST['pernom']:NULL;
                $peremail = isset($_POST['peremail']) ? $_POST['peremail']:NULL;
                $pertel = isset($_POST['pertel']) ? $_POST['pertel']:NULL;
                $sex = isset($_POST['sex']) ? $_POST['sex']:NULL;

                $idce = isset($_POST['idce']) ? $_POST['idce'] : NULL;
                $idequ = isset($_POST['idequ']) ? $_POST['idequ'] : NULL;
                $nomequ = isset($_POST['nomequ']) ? $_POST['nomequ'] : NULL;
                $comce = isset($_POST['comce']) ? $_POST['comce'] : NULL;

                echo "<br>".$nodocemp."-".$tipdoc."-".$pernom."-".$peremail."-".$pertel."-".$sex."-".$idce."-".$idequ."-".$nomequ."-".$comce."<br>";

                $per = new Persona();
                $per->setPeremail($peremail);
                $per->setNodocemp($nodocemp);
                $dtpr = $per->getOneENo();
                if(!$dtpr){
                    $per->setNodocemp($nodocemp);
                    $per->setPernom($pernom);
                    $per->setPerape("");
                    $per->setPeremail($peremail);
                    $per->setPerpass($nodocemp);
                    $per->setUbiid("11001");
                    $per->setPerdir("");
                    $per->setPertel($pertel);
                    $per->setPercel($pertel);
                    $per->setPefid("4");
                    $per->setDepid("1012");
                    $per->setEnvema("1");
                    $per->setActemp("1");
                    $per->setOrdgas("0");
                    $per->setPlanta("0");
                    $per->setCargo("300");
                    $per->save();
                    $dtpr = $per->getOneENo();
                    $per->saveMm($dtpr[0]['perid'], $tipdoc, $sex);
                    $per->setPerid($dtpr[0]['perid']);
                    $per->savepxp(62);
                }

                $cequi = new equip();
                $cequi->setIdce($idce);
                $cequi->setIdequ($idequ);
                $cequi->setNomequ($nomequ);
                $cequi->setPerid($dtpr[0]['perid']);
                $can = $cequi->getInsExi($idce, $dtpr[0]['perid']);
                if($can && $can[0]['can']==0){
                    if ($nomequ AND $comce == 2 AND $dtpr[0]['perid']) {
                        $save = $cequi->saveEqu();
                        $save = $cequi->getEqu();
                        $idequ = $save[0]['idequ'];
                        $cequi->setIdequ($idequ);
                        $save = $cequi->saveExt();
                        $txtn = "registrada_con_equipo";
                    } elseif ($idequ AND $comce == 2 AND $per) {
                        $save = $cequi->saveExt();
                        $txtn = "registrada_con_equipo_existente";
                    } elseif (!$idequ AND $comce == 2) {
                        $txtn = "rechazada._Debes_crear_primero_un_equipo._No_guardado";
                    } elseif (!$per) {
                        $txtn = "rechazada.<br><br>El número de documento no está registrado, por favor comuníquese con Recursos Humanos";
                    }else{
                        $txtn = "registrada&ema=".$peremail."&ndc=".$nodocemp;
                        $save = $cequi->saveExt();
                        
                    }
                }else{
                    $txtn = "rechazada._El_usuario_ya_está_registrado.";
                }     
                
                header("Location:".base_url.'inscrip/index&txtn='.$txtn);

            }
        }
    }
}
