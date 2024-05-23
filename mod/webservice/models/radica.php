<?php

class Radica{

	private $norad;
	private $asurad;
	private $carrad;
	private $noradext;
	private $orirad;
	private $firrad;
	private $folrad;
	private $tiprad;
	private $areprorad;
	private $noradcon;
	private $regrad;
	private $fecrad;
	private $emprad;
	private $nomrad;
	private $dirrad;
	private $posrad;
	private $ubiid;
	private $cuerad;
	private $revrad;
	private $coprad;
	private $chkrad;
	private $adjrad;
	private $idpro;
	private $propie;
	private $consecutivo;
	private $rutarcrad;
	private $doctrd;
	private $ordflu;
	private $flujofinal;
	private $idexp;
	private $carradofi;
	private $medrad;
	private $mfirrad;

	private $fecres;
	private $perid;
	private $idflu;
	private $leido;
	private $obsres;
	private $estrad;

	private $doctitu;
	private $doctip;
	private $docfec;
	private $docext;
	private $docpub;
	private $docpes;
	private $docruta;

	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato

function getNorad() {
	return $this->norad;
}
function getAsurad() {
	return $this->asurad;
}
function getCarrad() {
	return $this->carrad;
}	
function getNoradext() {
	return $this->noradext;
}
function getOrirad() {
	return $this->orirad;
}
function getFirrad() {
	return $this->firrad;
}
function getFolrad() {
	return $this->folrad;
}
function getTiprad() {
	return $this->Tiprad;
}
function getAreprorad() {
	return $this->areprorad;
}
function getNoradcon() {
	return $this->noradcon;
}
function getRegrad() {
	return $this->regrad;
}
function getFecrad() {
	return $this->fecrad;
}
function getEmprad() {
	return $this->emprad;
}
function getNomrad() {
	return $this->nomrad;
}
function getDirrad() {
	return $this->dirrad;
}
function getPosrad() {
	return $this->posrad;
}
function getUbiid() {
	return $this->ubiid;
}
function getCuerad() {
	return $this->cuerad;
}
function getRevrad() {
	return $this->revrad;
}
function getCoprad() {
	return $this->coprad;
}
function getChkrad() {
	return $this->chkrad;
}
function getAdjrad() {
	return $this->adjrad;
}
function getIdpro() {
	return $this->idpro;
}
function getPropie() {
	return $this->propie;
}
function getConsecutivo() {
	return $this->consecutivo;
}
function getRutarcrad() {
	return $this->rutarcrad;
}
function getDoctrd() {
	return $this->doctrd;
}
function getOrdflu() {
	return $this->ordflu;
}
function getFlujofinal() {
	return $this->flujofinal;
}
function getIdexp() {
	return $this->idexp;
}
function getCarradofi() {
	return $this->carradofi;
}
function getMedrad() {
	return $this->medrad;
}

function getMfirrad() {
	return $this->mfirrad;
}

function getFecres(){
	return $this->fecres;
}
function getPerid(){
	return $this->perid;
}
function getIdflu(){
	return $this->idflu;
}
function getLeido(){
	return $this->leido;
}
function getObsres(){
	return $this->obsres;
}
function getEstrad(){
	return $this->estrad;
}

function getDoctitu(){
	return $this->doctitu;
}
function getDoctip(){
	return $this->doctip;
}
function getDocfec(){
	return $this->docfec;
}
function getDocext(){
	return $this->docext;
}
function getDocpub(){
	return $this->docpub;
}
function getDocpes(){
	return $this->docpes;
}
function getDocruta(){
	return $this->docruta;
}

//Metodos Set Guardan el dato
function setNorad($norad) {
	$this->norad = $norad;
}
function setAsurad($asurad) {
	$this->asurad = $asurad;
}
function setCarrad($carrad) {
	$this->carrad = $carrad;
}	
function setNoradext($noradext) {
	$this->noradext = $noradext;
}
function setOrirad($orirad) {
	$this->orirad = $orirad;
}
function setFirrad($firrad) {
	$this->firrad = $firrad;
}
function setFolrad($folrad) {
	$this->folrad = $folrad;
}
function setTiprad($Tiprad) {
	$this->Tiprad = $Tiprad;
}
function setAreprorad($areprorad) {
	$this->areprorad = $areprorad;
}
function setNoradcon($noradcon) {
	$this->noradcon = $noradcon;
}
function setRegrad($regrad) {
	$this->regrad = $regrad;
}
function setFecrad($fecrad) {
	$this->fecrad = $fecrad;
}
function setEmprad($emprad) {
	$this->emprad = $emprad;
}
function setNomrad($nomrad) {
	$this->nomrad = $nomrad;
}
function setDirrad($dirrad) {
	$this->dirrad = $dirrad;
}
function setPosrad($posrad) {
	$this->posrad = $posrad;
}
function setUbiid($ubiid) {
	$this->ubiid = $ubiid;
}
function setCuerad($cuerad) {
	$this->cuerad = $cuerad;
}
function setRevrad($revrad) {
	$this->revrad = $revrad;
}
function setCoprad($coprad) {
	$this->coprad = $coprad;
}
function setChkrad($chkrad) {
	$this->chkrad = $chkrad;
}
function setAdjrad($adjrad) {
	$this->adjrad = $adjrad;
}
function setIdpro($idpro) {
	$this->idpro = $idpro;
}
function setPropie($propie) {
	$this->propie = $propie;
}
function setConsecutivo($consecutivo) {
	$this->consecutivo = $consecutivo;
}
function setRutarcrad($rutarcrad) {
	$this->rutarcrad = $rutarcrad;
}
function setDoctrd($doctrd) {
	$this->doctrd = $doctrd;
}
function setOrdflu($ordflu) {
	$this->ordflu = $ordflu;
}
function setFlujofinal($flujofinal) {
	$this->flujofinal = $flujofinal;
}
function setIdexp($idexp) {
	$this->idexp = $idexp;
}
function setCarradofi($carradofi) {
	$this->carradofi = $carradofi;
}
function setMedrad($medrad) {
	$this->medrad = $medrad;
}
function setMfirrad($mfirrad) {
	$this->mfirrad = $mfirrad;
}
function setFecres($fecres){
	$this->fecres = $fecres;
}
function setPerid($perid){
	$this->perid = $perid;
}
function setIdflu($idflu){
	$this->idflu = $idflu;
}
function setLeido($leido){
	$this->leido = $leido;
}
function setObsres($obsres){
	$this->obsres = $obsres;
}
function setEstrad($estrad){
	$this->estrad = $estrad;
}


function setDoctitu($doctitu){
	$this->doctitu = $doctitu;
}
function setDoctip($doctip){
	$this->doctip = $doctip;
}
function setDocfec($docfec){
	$this->docfec = $docfec;
}
function setDocext($docext){
	$this->docext = $docext;
}
function setDocpub($docpub){
	$this->docpub = $docpub;
}
function setDocpes($docpes){
	$this->docpes = $docpes;
}
function setDocruta($docruta){
	$this->docruta = $docruta;
}

//Metodos CRUD
	public function getAll($fecin, $fecfi){
		$sql = "SELECT r.norad, r.asurad, r.carrad, c.valnom as cargo, r.noradext, r.orirad, r.firrad, r.folrad, r.tiprad, v.valnom as tip, r.areprorad, a.valnom as are, r.noradcon, r.regrad, p.pernom, p.perape, r.fecrad, r.emprad, r.nomrad, r.dirrad, r.posrad, r.ubiid, u.ubinom, u.ubidepto, r.cuerad, r.revrad, r.coprad, r.chkrad, r.adjrad, r.idpro, r.propie, r.consecutivo, r.rutarcrad, r.doctrd, r.ordflu, r.flujofinal, r.idexp, r.carradofi, r.medrad, r.mfirrad FROM radicado AS r INNER JOIN persona AS p ON r.regrad=p.perid INNER JOIN valor AS v ON r.tiprad=v.valid LEFT JOIN valor AS c ON r.carrad=c.valid LEFT JOIN valor AS a ON r.areprorad=a.valid LEFT JOIN ubica AS u ON r.ubiid=u.ubiid WHERE r.elirad=1 AND r.fecrad BETWEEN '$fecin 00:00:00' AND '$fecfi 23:59:59'";
		if($_SESSION['pefid']<>6)
			$sql .= " AND (r.areprorad='".$_SESSION['depid']."' OR r.nomrad='".$_SESSION['perid']."')";
		$sql .= " ORDER BY r.fecrad DESC";

		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	public function getTotal($fecin, $fecfi){
		$sql = "SELECT r.tiprad, v.valnom as tip, COUNT(r.norad) AS tot FROM radicado AS r INNER JOIN persona AS p ON r.regrad=p.perid INNER JOIN valor AS v ON r.tiprad=v.valid LEFT JOIN valor AS c ON r.carrad=c.valid LEFT JOIN valor AS a ON r.areprorad=a.valid LEFT JOIN ubica AS u ON r.ubiid=u.ubiid WHERE r.elirad=1 AND r.fecrad BETWEEN '$fecin 00:00:00' AND '$fecfi 23:59:59'";
		if($_SESSION['pefid']<>6)
			$sql .= " AND (r.areprorad='".$_SESSION['depid']."' OR r.nomrad='".$_SESSION['perid']."')";
		$sql .= " GROUP BY r.tiprad, v.valnom";

		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	public function getTotResp(){
		$sql = "SELECT count(idres) as tot FROM radresp WHERE estrad NOT IN (8001,8003) AND norad={$this->norad};";
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		return $rub;
	}

	public function updMem(){		
		$sql = "UPDATE configuracion SET nomemo={$this->consecutivo} WHERE idconf='1';";	
		$update= $this->db->prepare($sql);
		$arrdata = NULL;
		
		$save=$update->execute();
		// echo "Le entra Mem";die();
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function updOfi(){		
		$sql = "UPDATE configuracion SET noofi={$this->consecutivo} WHERE idconf='1';";	
		$update= $this->db->prepare($sql);
		$arrdata = NULL;
		$save=$update->execute();
		// echo "Le entra Ofi";die();
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function updExt(){		
		$sql = "UPDATE configuracion SET noext={$this->consecutivo} WHERE idconf='1';";	
		$update= $this->db->prepare($sql);
		$arrdata = NULL;
		$save=$update->execute();
		// echo "Le entra Ext";die();
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function eliOne(){		
		$sql = "UPDATE radicado SET elirad='2'";
		$sql .= " WHERE norad={$this->norad};";	
		$update= $this->db->prepare($sql);
		$arrdata = NULL;
		$save=$update->execute();
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function getAllTipo($tiprad){
		$sql = "SELECT r.norad, r.asurad, r.carrad, c.valnom as cargo, r.noradext, r.orirad, r.firrad, r.folrad, r.tiprad, v.valnom as tip, r.areprorad, a.valnom as are, r.noradcon, r.regrad, p.pernom, p.perape, r.fecrad, r.emprad, r.nomrad, r.dirrad, r.posrad, r.ubiid, u.ubinom, u.ubidepto, r.cuerad, r.revrad, r.coprad, r.chkrad, r.adjrad, r.consecutivo, r.mfirrad FROM radicado AS r INNER JOIN persona AS p ON r.regrad=p.perid INNER JOIN valor AS v ON r.tiprad=v.valid LEFT JOIN valor AS c ON r.carrad=c.valid LEFT JOIN valor AS a ON r.areprorad=a.valid LEFT JOIN ubica AS u ON r.ubiid=u.ubiid WHERE r.tiprad=$tiprad ORDER BY r.fecrad DESC";

		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	public function getOne(){
		$sql = "SELECT r.norad, r.asurad, r.carrad, c.valnom as cargo, r.noradext, r.orirad, r.firrad, r.folrad, r.tiprad, v.valnom as tip, r.areprorad, a.valnom as are, r.noradcon, r.regrad, p.pernom, p.perape, r.fecrad, r.emprad, r.nomrad, r.dirrad, r.posrad, r.ubiid, u.ubinom, u.ubidepto, r.cuerad, r.revrad, r.coprad, r.chkrad, r.adjrad, r.idpro, r.propie, r.consecutivo, r.rutarcrad, r.doctrd, r.ordflu, r.flujofinal, r.idexp, r.carradofi, r.medrad, r.mfirrad FROM radicado AS r INNER JOIN persona AS p ON r.regrad=p.perid INNER JOIN valor AS v ON r.tiprad=v.valid LEFT JOIN valor AS c ON r.carrad=c.valid LEFT JOIN valor AS a ON r.areprorad=a.valid LEFT JOIN ubica AS u ON r.ubiid=u.ubiid WHERE r.norad=".$this->norad;

		//echo "<br><br><br>".$sql."<br>'".$ano."','".$this->idcon."'<br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getNodoc($norad){
		$sql = "SELECT count(docid) as Ndoc FROM documen WHERE norad='".$norad."'";
		//echo "<br><br><br>".$sql."<br>'".$ano."','".$this->idcon."'<br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

//SELECT docid, norad, perid, doctitu, docdes, notid, doctip, doccon, docfec, docext, docpub, docpes, docruta, doctp, carid, docver, docpopular, doceli FROM documen WHERE norad

	public function getDoc($norad){
		$sql = "SELECT docid, norad, perid, doctitu, docdes, notid, doctip, doccon, docfec, docext, docpub, docpes, docruta, doctp, carid, docver, docpopular, doceli FROM documen WHERE norad='".$norad."'";
		//echo "<br><br><br>".$sql."<br>'".$ano."','".$this->idcon."'<br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}


	public function getPef($pefid){
		$sql ="SELECT pefid, pefnom, pefbus, pefdes, pefedi, pefeli FROM perfil WHERE pefid='$pefid'";
		//echo "<br><br><br>".$sql."<br>'".$pefid."'<br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getNum($valid){
		$sql ="SELECT count(norad)+1 as nro FROM radicado WHERE noradext='$valid'";
		//echo "<br><br><br>".$sql."<br>'".$valid."'<br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getRegexi($noradcon){
		$sql ="SELECT d.norad FROM radicado AS d WHERE (d.noradcon ='$noradcon';";
		//echo "<br><br><br>".$sql."<br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		return $save;
	}

	public function getDepto(){
		$sql ="SELECT ubiid, ubinom, ubidepto FROM ubica WHERE ubidepto='0' ORDER BY ubinom;";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		return $save;
	}

//Es el mismo setVal
	public function getVal($parid){
		$sql ="SELECT * FROM valor WHERE parid = ".$parid." ORDER BY valnom";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getAllVal($parid){
		$sql ="SELECT * FROM valor WHERE parid = ".$parid." ORDER BY valnom";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getValOne($valid){
		$sql ="SELECT valid, valnom, parid, valfijo, pre FROM valor WHERE valid='".$valid."' ORDER BY valnom";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	// public function eliOne($norad){
	// 	$sql ="DELETE FROM radicado WHERE norad=$norad";
	// 	$execute = $this->db->query($sql);
	// 	$save = $execute->fetchall(PDO::FETCH_ASSOC);

	// 	// var_dump($save);
	// 	// $error= $this->db->errorInfo();
	// 	// die();
	// 	return $save;
	// }

	public function save(){
		$sql= "INSERT INTO radicado (asurad, carrad, noradext, orirad, firrad, folrad, tiprad, areprorad, noradcon, regrad, fecrad, emprad, nomrad, dirrad, posrad, ubiid, cuerad, revrad, coprad, chkrad, adjrad, consecutivo, carradofi, mfirrad) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getAsurad(), $this->getCarrad(), $this->getNoradext(), $this->getOrirad(), $this->getFirrad(), $this->getFolrad(), $this->getTiprad(), $this->getAreprorad(), $this->getNoradcon(), $this->getRegrad(), $this->getFecrad(), $this->getEmprad(), $this->getNomrad(), $this->getDirrad(), $this->getPosrad(), $this->getUbiid(), $this->getCuerad(), $this->getRevrad(), $this->getCoprad(), $this->getChkrad(), $this->getAdjrad(), $this->getConsecutivo(), $this->getCarradofi(), $this->getMfirrad());
		// echo $sql;
		// var_dump($arrdata);
		// die();
		$save = $insert->execute($arrdata);

	}

	public function edit(){		

		$sql = "UPDATE radicado SET asurad=?, carrad=?, noradext=?, orirad=?, firrad=?, folrad=?, tiprad=?, areprorad=?, noradcon=?, regrad=?, fecrad=?, emprad=?, nomrad=?, dirrad=?, posrad=?, ubiid=?, cuerad=?, revrad=?, coprad=?, chkrad=?, adjrad=?, consecutivo=?, carradofi=? ";
		$sql .= " WHERE norad={$this->norad};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getAsurad(), $this->getCarrad(), $this->getNoradext(), $this->getOrirad(), $this->getFirrad(), $this->getFolrad(), $this->getTiprad(), $this->getAreprorad(), $this->getNoradcon(), $this->getRegrad(), $this->getFecrad(), $this->getEmprad(), $this->getNomrad(), $this->getDirrad(), $this->getPosrad(), $this->getUbiid(), $this->getCuerad(), $this->getRevrad(), $this->getCoprad(), $this->getChkrad(), $this->getAdjrad(), $this->getConsecutivo(), $this->getCarradofi());
		$save=$update->execute($arrdata);
		
			// var_dump($sql);
			// var_dump($save);
			// $error= $this->db->errorInfo();
			// print_r($error);
			// die();
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function saveDoc(){
		$sql= "INSERT INTO documen(norad, perid, doctitu, docdes, notid, doctip, doccon, docfec, docext, docpub,docpes, docruta, doctp, carid, docver, docpopular, doceli) VALUES (?,?,?,'','1',?,'',?,?,?,?,?,'2003','5','1','0','0')";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getNorad(), $this->getPerid(), $this->getDoctitu(), $this->getDoctip(), $this->getDocfec(), $this->getDocext(), $this->getDocpub(), $this->getDocpes(), $this->getDocruta());
		// echo $sql;
		// var_dump($arrdata);
		// die();
		$save = $insert->execute($arrdata);

	}

	public function getOneNew(){
		$sql = "SELECT norad FROM radicado WHERE asurad='".$this->getAsurad()."' AND firrad='".$this->getFirrad()."' AND tiprad='".$this->getTiprad()."' AND regrad='".$this->getRegrad()."' AND fecrad='".$this->getFecrad()."'";;

		// echo "<br><br><br>".$sql."<br><br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}	

	//Metodos con archivos
	public function getArc($norad){
		$sql ="SELECT * FROM documen WHERE norad='$norad'";
		//echo "<br><br><br>".$sql."<br>'".$norad."'<br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getArcUni($docid){
		$sql ="DELETE FROM documen WHERE docid='$docid'";
		//echo "<br><br><br>".$sql."<br>'".$docid."'<br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getArcOne($docid){
		$sql ="SELECT docid, notid, docruta FROM documen WHERE docid='$docid'";
		//echo "<br><br><br>".$sql."<br>'".$docid."'<br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	//Metodos Usuario
	public function getUsu(){
		$sql ="SELECT idusu, nomusu, carusu, emausu, firmusu, visbueusu, actusu FROM usuario WHERE actusu='1' ORDER BY nomusu;";
		//echo "<br><br><br>".$sql."<br>'".$docid."'<br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getUsuOne($idusu){
		$sql ="SELECT idusu, nomusu, carusu, emausu, firmusu, visbueusu, actusu FROM usuario WHERE idusu='$idusu';";
		//echo "<br><br><br>".$sql."<br>'".$idusu."'<br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	//Metodos Configuración
	public function getConfig(){
		$sql ="SELECT idconf, nit, nomemp, dircon, mosdir, telcon, mostel, celcon, moscel, emacon, mosema, logocon, nomemo, noofi, noext FROM configuracion";
		//echo "<br><br><br>".$sql."<br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function editConfO($noofi){		
		$sql = "UPDATE configuracion SET noofi='$noofi' WHERE idconf=1;";	
		$update= $this->db->prepare($sql);
		$save=$update->execute();

		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function editConfE($noext){		
		$sql = "UPDATE configuracion SET noext='$noext' WHERE idconf=1;";	
		$update= $this->db->prepare($sql);
		$save=$update->execute();

		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function editConfM($nomemo){		
		$sql = "UPDATE configuracion SET nomemo='$nomemo' WHERE idconf=1;";	
		$update= $this->db->prepare($sql);
		$save=$update->execute();

		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	//-----------NUEVO COD

	//-----------RETEN

	public function carReten(){
		$sql="SELECT DISTINCT r.*,p.*,t.*,e.* FROM radicado AS r INNER JOIN proceso AS p ON r.idpro=p.idpro INNER JOIN trd AS t ON p.doctrd=t.doctrd INNER JOIN expediente AS e ON t.doctrd=e.doctrd LIMIT 100;";
		//echo "<br><br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function selsst($doctrd){
		$resultado=null;
		$modelo=new conexion();
		$conexion=$modelo->get_conexion();

		$sql="SELECT t.doctrd AS doctrdt, t.destrd AS destrdt, b.doctrd AS doctrdb, b.destrd AS destrdb, s.doctrd AS doctrds, s.destrd AS destrds, d.doctrd AS doctrdd, d.destrd AS destrdd FROM trd AS t INNER JOIN trd AS b ON t.deptrd=b.doctrd INNER JOIN trd AS s ON b.deptrd=s.doctrd INNER JOIN trd AS d ON s.deptrd=d.doctrd WHERE t.doctrd= :doctrd";
		$result=$conexion->prepare($sql);
		///echo $sql."    '".$doctrd."'";
		$result->bindParam(':doctrd', $doctrd);
		$result->execute();

		while($f=$result->fetch()){
			$resultado[]=$f;
		}

		return $resultado;
	}

	//----------------PROCESOS

	public function seldeppro(){

		$sql="SELECT idpro, nompro, deppro, codpro, doctrd, ordpro FROM proceso";
		//echo "<br><br><br>".$sql."<br><br>";
		$sql .= " ORDER BY ordpro;";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
		
	}

	public function seltrd(){

		$sql="SELECT doctrd, destrd, tiptrd, ordtrd, agentrd, acentrd, dfintrd FROM trd ORDER BY ordtrd";
		//echo "<br><br><br>".$sql."<br><br>";
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
		
	}

	public function seltrd2(){

		$sql="SELECT deptrd, doctrd, destrd, tiptrd, ordtrd, agentrd, acentrd, dfintrd FROM trd WHERE doctrd<1000 ORDER BY destrd" ;
		//echo "<br><br><br>".$sql."<br><br>";
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;		
	}

	public function seltrd3($depid){

		$sql="SELECT deptrd, doctrd, destrd, tiptrd, ordtrd, agentrd, acentrd, dfintrd FROM trd WHERE doctrd<999 AND area LIKE '%$depid%' ORDER BY destrd" ;
		//echo "<br><br><br>".$sql."<br><br>";
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($sql);
		// $error= $this->db->errorInfo();
		// die();
		return $save;		
	}

	public function seltrd2Sub($serie,$depid,$j){

		if ($j>0) {
			$sql="SELECT deptrd, doctrd, destrd, tiptrd, ordtrd, agentrd, acentrd, dfintrd FROM trd WHERE deptrd LIKE '".$serie."%' AND LENGTH(doctrd)=5 ";
		}else{
			$sql="SELECT deptrd, doctrd, destrd, tiptrd, ordtrd, agentrd, acentrd, dfintrd FROM trd WHERE deptrd LIKE '".$serie."%' AND LENGTH(doctrd)=5 AND area LIKE '%$depid%' ";
		}


		

		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		return $save;		
	}

	public function seltrd3Sub($serie,$depid,$j){


		$sql="SELECT deptrd, doctrd, destrd, tiptrd, ordtrd, agentrd, acentrd, dfintrd FROM trd WHERE deptrd LIKE '".$serie."%' AND LENGTH(doctrd)>=7 AND LENGTH(doctrd)<=8 ";
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;		
	}

	public function seltrd4Sub($serie,$depid,$j){

		$sql="SELECT deptrd, doctrd, destrd, tiptrd, ordtrd, agentrd, acentrd, dfintrd FROM trd WHERE deptrd LIKE '".$serie."%' AND LENGTH(doctrd)>7 ";	
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();

		
		return $save;		
	}

	public function seltrdExp($serie,$depid){

		$sql="SELECT * FROM docgestion WHERE depid=$depid AND ultserie=$serie AND carpeta=1 ";	
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();

		
		return $save;		
	}

	public function seltrdExpCompJuri($depid){

		$sql="SELECT * FROM docgestion WHERE compjuridica=$depid AND carpeta=1 ";	
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();

		
		return $save;		
	}


	public function selpag(){

		$sql="SELECT p.idpro, p.nompro, p.deppro, p.codpro, p.doctrd, t.destrd, p.ordpro FROM proceso AS p INNER JOIN trd AS t ON p.doctrd=t.doctrd";
		//echo "<br><br><br>".$sql."<br><br>";
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
		
	}

	public function agregadoc($perid,$depid,$nomar,$tipoarchivo,$peso,$fecha,$rutafinal,$ultserie,$num,$nomserie,$dfin,$depende){

		
		$sql = "INSERT INTO docgestion (depid,perid,nomar,tipo,peso,fecha,ruta,ultserie,num,nomserie,dfin,depende) VALUES ($depid,$perid,'$nomar','$tipoarchivo',$peso,'$fecha','$rutafinal',$ultserie,$num,'$nomserie','$dfin','$depende') ";

		$save = $this->db->query($sql);		
		$result = false;
		if($save){
			$result = true;
			$sql2 = "select last_insert_id()";
	   		$execute = $this->db->query($sql2);
	 		$ultimaconsul = $execute->fetchall(PDO::FETCH_ASSOC);
	 		$docid = $ultimaconsul[0]["last_insert_id()"];

	 		$sql3 = "INSERT INTO trazadocges (ultserie,docid,anoexp,estado,perid) VALUES ($ultserie,$docid,YEAR('$fecha'),'creado',$perid) ";
	 		// var_dump($sql3);
	 		// die();
	 		$execute = $this->db->query($sql3);
	 		$traza = $execute->fetchall(PDO::FETCH_ASSOC);
		}
		return $result;
	}

	public function agregaExp($perid,$depid,$nomar,$tipoarchivo,$fecha,$ultserie,$num,$nomserie,$dfin,$asigarea){

		
		$sql = "INSERT INTO docgestion (depid,perid,nomar,tipo,fecha,ultserie,num,nomserie,dfin,carpeta,compjuridica) VALUES ($depid,$perid,'$nomar','$tipoarchivo','$fecha',$ultserie,$num,'$nomserie','$dfin',1,'$asigarea') ";

		$save = $this->db->query($sql);		
		$result = false;
		if($save){
			$result = true;
			$sql2 = "select last_insert_id()";
	   		$execute = $this->db->query($sql2);
	 		$ultimaconsul = $execute->fetchall(PDO::FETCH_ASSOC);
	 		$docid = $ultimaconsul[0]["last_insert_id()"];

	 		$sql3 = "INSERT INTO trazadocges (ultserie,docid,anoexp,estado,perid) VALUES ($ultserie,$docid,YEAR('$fecha'),'creado',$perid) ";
	 		// var_dump($sql3);
	 		// die();
	 		$execute = $this->db->query($sql3);
	 		$traza = $execute->fetchall(PDO::FETCH_ASSOC);
		}
		return $result;
	}

	public function tipodoc($serie){		

		$sql="SELECT nompro,codpro FROM proceso WHERE doctrd=$serie";
		//echo "<br><br><br>".$sql."<br><br>";

		// var_dump($sql);
		// die();
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		return $save;
		
	}

	public function getar($perid,$depid,$serie,$carpid){
		$sql="SELECT dg.*,tr.* FROM docgestion AS dg INNER JOIN trd AS tr ON dg.ultserie=tr.doctrd
		 WHERE dg.ultserie=$serie AND dg.depid=$depid AND dg.perid=$perid AND carpeta=2 AND dg.depende=$carpid ";		
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getar2(){
				
		$sql="SELECT DISTINCT ultserie,depid,fecha, valor.valnom, trd.destrd, trd.acentrd, trd.dfintrd, trd.agentrd FROM docgestion INNER JOIN valor ON docgestion.depid=valor.valid INNER JOIN trd ON docgestion.ultserie=trd.doctrd GROUP BY ultserie";		
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getar2b($depid){
				
		$sql="SELECT DISTINCT ultserie,depid,fecha, valor.valnom, trd.destrd, trd.acentrd, trd.dfintrd, trd.agentrd FROM docgestion INNER JOIN valor ON docgestion.depid=valor.valid INNER JOIN trd ON docgestion.ultserie=trd.doctrd WHERE docgestion.depid=$depid GROUP BY ultserie";		
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getarCompartidos($email){

		$sql="SELECT * FROM docdrive WHERE peremail_destino='$email' ";
				
		// $sql="SELECT DISTINCT ultserie,depid,fecha, valor.valnom, trd.destrd, trd.acentrd, trd.dfintrd, trd.agentrd FROM docgestion INNER JOIN valor ON docgestion.depid=valor.valid INNER JOIN trd ON docgestion.ultserie=trd.doctrd WHERE docgestion.depid=$depid GROUP BY ultserie";	

		// var_dump($sql);
		// die();	
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getcompartidos($ultserie,$depid,$anoexp){

		$sql="SELECT DISTINCT ultserie,depid,fecha, valor.valnom, trd.destrd, trd.acentrd, trd.dfintrd, trd.agentrd FROM docgestion INNER JOIN valor ON docgestion.depid=valor.valid INNER JOIN trd ON docgestion.ultserie=trd.doctrd WHERE docgestion.depid=$depid AND YEAR(docgestion.fecha)=$anoexp AND docgestion.ultserie=$ultserie GROUP BY ultserie";			
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getar3($serie,$depid){
		// var_dump($depid);
		// die();
		$sql="SELECT dg.*,tr.*, val.* FROM docgestion AS dg INNER JOIN trd AS tr ON dg.ultserie=tr.doctrd INNER JOIN valor AS val ON dg.depid=val.valid WHERE dg.ultserie=$serie AND dg.depid=$depid";					
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function sumap($serie,$depid){
		// var_dump($depid);
		// die();
		$sql="SELECT dg.*,tr.*, val.*,sum(dg.peso)AS sumapeso FROM docgestion AS dg INNER JOIN trd AS tr ON dg.ultserie=tr.doctrd INNER JOIN valor AS val ON dg.depid=val.valid WHERE dg.ultserie=$serie AND dg.depid=$depid";					
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}


	public function getYearInv(){
				
		$sql="SELECT DISTINCT YEAR(fecha) FROM docgestion ORDER BY  YEAR(fecha) ASC";		
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getAreasInv($y){
				
		$sql="SELECT DISTINCT dg.depid, val.valnom FROM docgestion AS dg INNER JOIN valor AS val ON dg.depid=val.valid WHERE YEAR(dg.fecha)=$y ORDER BY val.valnom ASC";		
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}
	
	public function getSeriesInv($d,$y){
				
		$sql="SELECT DISTINCT dg.depid, dg.ultserie, tr.destrd, val.valnom FROM docgestion AS dg INNER JOIN trd AS tr ON dg.ultserie=tr.doctrd INNER JOIN valor AS val ON dg.depid=val.valid WHERE YEAR(dg.fecha)=$y AND dg.depid=$d ORDER BY tr.destrd ASC";		
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($sql);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getExpInv($serie,$y,$a){
				
		$sql="SELECT * FROM docgestion WHERE ultserie=$serie AND YEAR(fecha)=$y AND depid=$a";		
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($sql);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}
	

	//-----------EXPEDIENTES

	public function selpag1(){
		//$sql="SELECT * FROM proceso WHERE idpro= :idpro";
		$sql="SELECT * FROM proceso";
		//echo "<br><br><br>".$sql."<br><br>";
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;		
	}

	public function selpag2(){

		$sql="SELECT e.idexp, e.anoexp, e.doctrd, t.deptrd, t.destrd, e.actexp FROM expediente AS e INNER JOIN trd AS t ON e.doctrd=t.doctrd";
		//echo "<br><br><br>".$sql."<br><br>";
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;		
	}

	public function insExp($idexp,$anoexp,$subserie,$actexp){
		$sql = "INSERT INTO expediente (idexp, anoexp, doctrd, actexp) VALUES ($idexp,$anoexp,$subserie,$actexp) ";

		$save = $this->db->query($sql);		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	//ARCHIVO GESTION

	public function selpag3($tiparc){
		date_default_timezone_set('America/Bogota');
		$fechaact = date("Y-m-d");

		$sql="SELECT DISTINCT r.*, p.*, t.*, e.*, concat(e.anoexp,'-12-31') AS fechacierre, DATE_ADD(concat(e.anoexp,'-12-31'),INTERVAL t.agentrd YEAR) AS Gestion, DATE_ADD(concat(e.anoexp,'-12-31'),INTERVAL (t.agentrd+t.acentrd) YEAR) AS Central FROM radicado AS r INNER JOIN proceso AS p ON r.idpro=p.idpro INNER JOIN trd AS t ON p.doctrd=t.doctrd INNER JOIN expediente AS e ON t.doctrd=e.doctrd WHERE r.norad IN (SELECT DISTINCT norad FROM radicado WHERE norad=propie) AND r.flujofinal=0";
		//echo "<br><br><br>".$sql."<br><br>";

		if($tiparc=="Gestion"){
			$sql .= " AND '".$fechaact."' BETWEEN concat(e.anoexp,'-12-31') AND DATE_ADD(concat(e.anoexp,'-12-31'),INTERVAL t.agentrd YEAR)";
		}elseif($tiparc=="Central"){
			$sql .= " AND '".$fechaact."' BETWEEN DATE_ADD(concat(e.anoexp,'-12-31'),INTERVAL t.agentrd YEAR) AND DATE_ADD(concat(e.anoexp,'-12-31'),INTERVAL (t.agentrd+t.acentrd) YEAR)";
		}
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($sql);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
		
	}

	//------------TRD
	public function carTrd(){

		$sql="SELECT t.doctrd, t.destrd AS descrip, t.tiptrd, v.valnom, t.deptrd, d.destrd As nomdep, t.ordtrd, t.agentrd, t.acentrd, t.dfintrd FROM trd AS t INNER JOIN valor AS v ON t.tiptrd=v.valid LEFT JOIN trd AS d ON t.deptrd=d.doctrd";
		//echo "<br><br><br>".$sql."<br><br>";
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
		
	}

	//Nuevo Robinson
	public function resp($norad){
		$sql ="SELECT r.idres, r.norad, r.fecres, r.perid, u.pernom, u.perape, u.peremail, r.idpro, p.nompro, r.idflu, f.actflu, r.leido, r.obsres, r.estrad, v.valnom FROM radresp AS r INNER JOIN persona AS u ON r.perid=u.perid INNER JOIN proceso AS p ON r.idpro=p.idpro INNER JOIN flujo AS f ON r.idflu=f.idflu INNER JOIN  valor AS v ON r.estrad=v.valid WHERE r.norad='$norad'";
		//echo "<br><br><br>".$sql."<br>'".$norad."'<br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function personAll(){
		$sql ="SELECT p.perid, p.nodocemp, p.pernom, p.perape, p.peremail, p.depid, a.valnom AS are, p.ordgas, p.actemp, p.planta, p.cargo, c.valnom AS carg FROM persona AS p INNER JOIN valor AS c ON p.cargo=c.valid INNER JOIN valor AS a ON p.depid=a.valid WHERE p.actemp=1 ORDER BY p.pernom, p.perape";
		//echo "<br><br><br>".$sql."<br>'".$norad."'<br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function personPlanta(){
		$sql ="SELECT p.perid, p.nodocemp, p.pernom, p.perape, p.peremail, p.depid, a.valnom AS are, p.ordgas, p.actemp, p.planta, p.cargo, c.valnom AS carg FROM persona AS p INNER JOIN valor AS c ON p.cargo=c.valid INNER JOIN valor AS a ON p.depid=a.valid WHERE p.actemp=1 AND p.planta=1 ORDER BY p.pernom, p.perape";
		//echo "<br><br><br>".$sql."<br>'".$norad."'<br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function personOne($perid){
		$sql ="SELECT p.perid, p.nodocemp, p.pernom, p.perape, p.peremail, p.depid, a.valnom AS are, p.ordgas, p.actemp, p.planta, p.cargo, c.valnom AS carg FROM persona AS p INNER JOIN valor AS c ON p.cargo=c.valid INNER JOIN valor AS a ON p.depid=a.valid WHERE p.perid='".$perid."'' ORDER BY p.pernom, p.perape";
		//echo "<br><br><br>".$sql."<br>'".$norad."'<br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getAreas(){		

		$sql = "SELECT * FROM valor WHERE parid=1 ORDER BY valnom";		
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getRoles(){		

		$sql = "SELECT per.pernom, per.perape, per.depid, per.peremail, perx.perid, perx.pefid, perf.pefid, perf.pefnom, val.valnom FROM persona AS per INNER JOIN perxpef AS perx ON per.perid=perx.perid INNER JOIN perfil AS perf ON perx.pefid=perf.pefid INNER JOIN valor AS val ON per.depid=val.valid WHERE perf.pefid=8 OR perf.pefid=9;
";		
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function saveDrive($seriedoc,$depid,$correo_dest,$peridaut,$anoexp,$perid){		

		// var_dump($anoexp);
		// die();
		$sql3 = "INSERT INTO trazadocges (ultserie,docid,anoexp,estado,perid) VALUES ($seriedoc,0,2022,'compartido',$perid) ";
	 		// var_dump($sql3);
	 		// die();
	 		$execute = $this->db->query($sql3);
	 		$traza = $execute->fetchall(PDO::FETCH_ASSOC);

		$sql = "INSERT INTO docdrive (ultserie,depid,peremail_destino,perid_aut,anoexp) VALUES ($seriedoc,$depid,'$correo_dest',$peridaut,$anoexp) ";

		// var_dump($sql);
		// die();

		$save = $this->db->query($sql);		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;

		
	}

	public function trazadocg($seriedoc){
		$sql = "SELECT per.pernom, per.perape, per.depid, per.peremail, tr.destrd, perx.perid, perx.pefid, v.valnom, traza.* FROM trazadocges AS traza INNER JOIN perxpef AS perx ON traza.perid=perx.perid INNER JOIN persona AS per ON traza.perid=per.perid INNER JOIN trd AS tr ON traza.ultserie=tr.doctrd INNER JOIN valor AS v ON v.valid=per.depid WHERE traza.ultserie=$seriedoc";
		// var_dump($sql);
		// //echo $this->db->error;
		// die();
		
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		

		return $pfinan;		
	}

	public function saveDependencias($num,$nomserie,$areas,$deptrd){
		$sql = "INSERT INTO trd (doctrd, deptrd,destrd,tiptrd,ordtrd,agentrd,acentrd,dfintrd,area,otarea,depen) VALUES ($num,$deptrd,'$nomserie',0,0,0,0,0,'$areas',0,$num) ";

		// var_dump($sql);

		$save = $this->db->query($sql);		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function saveSeries($num,$nomserie,$deptrd){		
		$sql = "SELECT area FROM trd WHERE doctrd=$deptrd";	
		
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		$areas=$pfinan[0]['area'];
		// var_dump($areas);
		// die();	

		$sql = "INSERT INTO trd (doctrd, deptrd,destrd,tiptrd,ordtrd,agentrd,acentrd,dfintrd,area,otarea,depen) VALUES ($num,$deptrd,'$nomserie',0,0,0,0,0,'$areas',0,$num) ";

		// var_dump($sql);

		$save = $this->db->query($sql);		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function saveCarpeta($depid,$perid,$depidexp,$num,$fecha,$nomserie,$ultserie,$idexp){		
		$sql = "INSERT INTO docgestion (depid,perid,nomar,tipo,fecha,ultserie,num,nomserie,carpeta,depende,compjuridica) VALUES ($depid,$perid,'$nomserie','CARPETA','$fecha',$ultserie,$num,'$nomserie',3,$idexp,$depid) ";
		// var_dump($sql);

		$save = $this->db->query($sql);		
		$result = false;
		if($save){
			$result = true;
			$sql2 = "select last_insert_id()";
	   		$execute = $this->db->query($sql2);
	 		$ultimaconsul = $execute->fetchall(PDO::FETCH_ASSOC);
	 		$docid = $ultimaconsul[0]["last_insert_id()"];

	 		// $sql3 = "INSERT INTO trazadocges (ultserie,docid,anoexp,estado,perid) VALUES ($ultserie,$docid,YEAR('$fecha'),'creado',$perid) ";
	 		// // var_dump($sql3);
	 		// // die();
	 		// $execute = $this->db->query($sql3);
	 		// $traza = $execute->fetchall(PDO::FETCH_ASSOC);
		}
		return $result;
	}

	public function saveSeriesMasivo($depen,$deptrd,$doctrd,$destrd,$agentrd,$acentrd,$area){		
		
		$sql = "INSERT INTO trd (doctrd,deptrd,destrd,tiptrd,ordtrd,agentrd,acentrd,dfintrd,area,otarea,depen) VALUES ($doctrd,$deptrd,'$destrd',0,0,0,0,0,'$area',0,$depen) ";

		 // var_dump($sql);
		 // die();

		$save = $this->db->query($sql);		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}



// Realizado 22/06/2022 Inicio ---------------
	public function estarad(){
		$sql ="SELECT valid, valnom, parid, valfijo, pre, abr, ncon, cdpmul, doctrd FROM valor WHERE parid=25 and valfijo=1;";
		//echo "<br><br><br>".$sql."<br>'".$norad."'<br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function savrr(){
		$sql= "INSERT INTO radresp(norad, fecres, perid, idpro, idflu, leido, obsres,estrad) VALUES (?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getNorad(), $this->getFecres(), $this->getPerid(), $this->getIdpro(), $this->getIdflu(), $this->getLeido(), $this->getObsres(), $this->getEstrad());
		// echo $sql;
		// var_dump($arrdata);
		// die();
		$save = $insert->execute($arrdata);

	}

	public function getPerfil($perid){
		$sql ="SELECT pefid FROM perxpef WHERE perid=$perid";
		//var_dump($sql);
		// $error= $this->db->errorInfo();
		// die();
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		
		return $save;
	}	

	public function getDepidNom($depid){
		$sql ="SELECT * FROM valor WHERE valid=$depid";		
		// var_dump($sql);
		// $error= $this->db->errorInfo();
		// die();
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		
		return $save;
	}

	public function getAreasJ(){
		$sql ="SELECT * FROM valor WHERE valid>1000 AND parid=1";		
		// var_dump($sql);
		// $error= $this->db->errorInfo();
		// die();
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		
		return $save;
	}

	public function getCarpeta($id){
		$sql ="SELECT id, depid, perid, nomar AS destrd, ultserie AS doctrd  FROM docgestion where depende=$id";		
		// var_dump($sql);
		// $error= $this->db->errorInfo();
		//die();
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		
		return $save;
	}
	

	



// Realizado 22/06/2022 Fin ---------------
}