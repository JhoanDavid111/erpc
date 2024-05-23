<?php
require_once '../../../config/db.php';
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


//Metodos CRUD
	public function getPdfrad($norad){
		$sql = "SELECT r.norad, r.asurad, r.carrad, r.noradext, r.orirad, r.firrad, r.folrad, r.tiprad, v.valnom, r.areprorad, r.noradcon, r.regrad, p.pernom, p.perape, r.fecrad, r.emprad, r.nomrad, r.dirrad, r.posrad, r.ubiid, r.cuerad, r.revrad, r.coprad, r.chkrad, r.adjrad, r.consecutivo, r.mfirrad FROM radicado AS r INNER JOIN persona AS p ON r.regrad=p.perid INNER JOIN valor AS v ON r.tiprad=v.valid WHERE r.norad=$norad;";

		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	public function getOne($norad){
		$sql = "SELECT r.norad, r.asurad, r.carrad, r.carradofi, c.valnom as cargo, r.noradext, r.orirad, r.firrad, r.folrad, r.tiprad, v.valnom as tip, r.areprorad, a.valnom as are, a.doctrd, r.noradcon, r.regrad, p.pernom, p.perape, r.fecrad, r.emprad, r.nomrad, r.dirrad, r.posrad, r.ubiid, u.ubinom, u.ubidepto, r.cuerad, r.revrad, r.coprad, r.chkrad, r.adjrad, r.consecutivo, r.mfirrad FROM radicado AS r INNER JOIN persona AS p ON r.regrad=p.perid INNER JOIN valor AS v ON r.tiprad=v.valid LEFT JOIN valor AS c ON r.carrad=c.valid LEFT JOIN valor AS a ON r.areprorad=a.valid LEFT JOIN ubica AS u ON r.ubiid=u.ubiid WHERE norad=$norad;";

		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	public function getPer($perid){
		$sql = "SELECT idusu, nomusu, carusu, emausu, firmusu, visbueusu, actusu FROM usuario WHERE idusu=$perid;";

		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	public function personOne($perid){
		$sql ="SELECT p.perid, p.nodocemp, p.pernom, p.perape, p.peremail, p.depid, a.valnom AS are, p.ordgas, p.actemp, p.planta, p.cargo, c.valnom AS carg FROM persona AS p INNER JOIN valor AS c ON p.cargo=c.valid INNER JOIN valor AS a ON p.depid=a.valid WHERE p.perid='".$perid."' ORDER BY p.pernom, p.perape";
		//echo "<br><br><br>".$sql."<br>'".$norad."'<br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}
}