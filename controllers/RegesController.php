<?php
include'mod/rrhh/models/minuta.php';
include'mod/rrhh/models/persona.php';

class RegesController{
	
	public function index(){
		//Utils::useraccess('inscrip/index',$_SESSION['pefid']);
        $nodocemp = isset($_REQUEST['nodocemp']) ? $_REQUEST['nodocemp']:NULL;
        $direc = "save";
        $image_url = NULL;
		require_once 'views/reges.php';
	}

    function posiCc($Texto) {
        $p = 0;
        for ($i = 0; $i < strlen($Texto); $i++) {
            if (substr($Texto, $i, 1) >= 0 AND substr($Texto, $i, 1) <= 9) {
                $p++;
            } else {
                $i = strlen($Texto);
            }
        }
        return ($p - 10);
    }

	public function save(){
        date_default_timezone_set('America/Bogota');
        $mmcon = new Minuta();
        $nummin = isset($_REQUEST['nummin']) ? $_REQUEST['nummin']:NULL;
        $perid = isset($_REQUEST['perid']) ? $_REQUEST['perid']:NULL;
        $obs = isset($_POST['obs']) ? $_POST['obs']:NULL;
        $ideles = isset($_POST['ideles']) ? $_POST['ideles']:NULL;
        $dtUds = isset($_REQUEST['dtUds']) ? $_REQUEST['dtUds']:NULL;
        $datEle = NULL;
        $msjerr = NULL;
        
        $fechos = date('Y-m-d H:i:s');
        $hoy = date('Y-m-d');
        if($ideles) $ideles = implode(";", $ideles);
        $nodocemp = isset($_REQUEST['nodocemp']) ? $_REQUEST['nodocemp']:NULL;
        $ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;

        $direc = "edit";

        $mmcon->updFecAnt();
        $nodocemp = str_replace(".","",$nodocemp);
        $nodocemp = str_replace(",","",$nodocemp);

        if (strlen($nodocemp) > 11) {
            if (substr($nodocemp, 0, 4) == "http") {
                $nodocemp = substr($nodocemp, 77, (strpos($nodocemp, '/') - 77));
            } elseif (substr($nodocemp, 10, 7) == "PubDSK?") {
                $nodocemp = substr($nodocemp, 17, 60);
                $pose = $this->posiCc($nodocemp);
                $nodocemp = substr($nodocemp, $pose, 10);
            } else {
                $nodocemp = substr($nodocemp, 50, 8);
            }
        }

        $mmcon->setNodocemp($nodocemp);
        if ($ope == "save") {
            if ($nodocemp) {
                $val = $mmcon->getPersona($hoy);
                if ($val) {
                    $mmcon->setPerid($val[0]['perid']);
                    $dtUrF = $mmcon->getUsuRgF();
                    $msjerr = "";
                    $rdtT = $mmcon->getExiste($val[0]['perid']);
                    if ($rdtT) {
                        $mmcon->setPerid($rdtT[0]['perid']);
                        $mmcon->setFechos($fechos);
                        $gvlt = $mmcon->getVuelta();
                        if ($gvlt[0]['can'] > 0) {
                            $mmcon->updHij($fechos, $rdtT[0]['nummin']);
                        }
                    }else{
                        $mmcon->setFechos($fechos);
                        $rti = $mmcon->getDest();

                        if ($rti[0]['can'] > 0) $tip = 'F';
                        else $tip = 'I';

                        $mmcon->setTipmin($tip);

                        if ($rti AND $rti[0]['nummin']) $mmcon->updHij($fechos, $rti[0]['nummin']);
                        else $res = $mmcon->save();
                    }
                } else {
                    $rdtT = NULL;
                    $dtUds = "Sin Datos";
                }
            }
        }
        $image_url = NULL;
        require_once 'views/reges.php';
    }
}
