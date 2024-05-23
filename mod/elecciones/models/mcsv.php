<?php 
//detpaa
require_once '../../../config/db.php';
class Mcsv{

	private $iddel;
	private $nomdel;

	private $elecp;
	private $elenp;

	private $idvel;
	private $nomvel;
	private $fijvel;
	private $prevel;

	private $idd;
	private $iddat;
	private $nomdat;

	private $eledpid;
	private $elecdep;
	private $elecmun;
	private $eleczon;
	private $elcpue;
	private $elendep;
	private $elenmun;
	private $elenpue;
	private $eleipue;
	private $elephom;
	private $elepmuj;
	private $elenmes;
	private $eleccom;
	private $elencom;
	
	private $idcan;
	private $corp;
	private $circ;
	private $eleccan;
	private $ptip;
	private $ncan;
	private $acan;
	private $ccan;
	private $gcan;
	private $scan;

	public function __construct() {
		$this->db = conexion::get_conexion();
	}


	function getIddel() {
		return $this->iddel;
	}
	function getNomdel() {
		return $this->nomdel;
	}


	function getElecp() {
		return $this->elecp;
	}
	function getElenp() {
		return $this->elenp;
	}


	function getIdvel() {
		return $this->idvel;
	}	
	function getNomvel(){
		return $this->nomvel;
	}
	function getFijvel(){
		return $this->fijvel;
	}
	function getPrevel(){
		return $this->prevel;
	}


	function getIdd(){
		return $this->idd;
	}
	function getIddat(){
		return $this->iddat;
	}
	function getNomdat(){
		return $this->nomdat;
	}


	function getEledpid(){
		return $this->eledpid;
	}
	function getElecdep(){
		return $this->elecdep;
	}
	function getElecmun(){
		return $this->elecmun;
	}
	function getEleczon(){
		return $this->eleczon;
	}
	function getElcpue(){
		return $this->elcpue;
	}
	function getElendep(){
		return $this->elendep;
	}
	function getElenmun(){
		return $this->elenmun;
	}
	function getElenpue(){
		return $this->elenpue;
	}
	function getEleipue(){
		return $this->eleipue;
	}
	function getElephom(){
		return $this->elephom;
	}
	function getElepmuj(){
		return $this->elepmuj;
	}
	function getElenmes(){
		return $this->elenmes;
	}
	function getEleccom(){
		return $this->eleccom;
	}
	function getElencom(){
		return $this->elencom;
	}

	function getIdcan(){
		return $this->idcan;
	}
	function getCorp(){
		return $this->corp;
	}
	function getCirc(){
		return $this->circ;
	}
	function getEleccan(){
		return $this->eleccan;
	}
	function getPtip(){
		return $this->ptip;
	}
	function getNcan(){
		return $this->ncan;
	}
	function getAcan(){
		return $this->acan;
	}
	function getCcan(){
		return $this->ccan;
	}
	function getGcan(){
		return $this->gcan;
	}
	function getScan(){
		return $this->scan;
	}

//private $
	//SET

	function setIddel($iddel) {
		$this->iddel = $iddel;
	}
	function setNomdel($nomdel) {
		$this->nomdel = $nomdel;
	}


	function setElecp($elecp) {
		$this->elecp = $elecp;
	}	
	function setElenp($elenp) {
		$this->elenp = $elenp;
	}


	function setIdvel($idvel) {
		$this->idvel = $idvel;
	}
	function setNomvel($nomvel) {
		$this->nomvel = $nomvel;
	}
	function setFijvel($fijvel) {
		$this->fijvel = $fijvel;
	}
	function setPrevel($prevel) {
		$this->prevel = $prevel;
	}


	function setIdd($idd){
		$this->idd = $idd;
	}
	function setIddat($iddat){
		$this->iddat = $iddat;
	}
	function setNomdat($nomdat){
		$this->nomdat = $nomdat;
	}


	function setEledpid($eledpid){
		$this->eledpid = $eledpid;
	}
	function setElecdep($elecdep){
		$this->elecdep = $elecdep;
	}
	function setElecmun($elecmun){
		$this->elecmun = $elecmun;
	}
	function setEleczon($eleczon){
		$this->eleczon = $eleczon;
	}
	function setElcpue($elcpue){
		$this->elcpue = $elcpue;
	}
	function setElendep($elendep){
		$this->elendep = $elendep;
	}
	function setElenmun($elenmun){
		$this->elenmun = $elenmun;
	}
	function setElenpue($elenpue){
		$this->elenpue = $elenpue;
	}
	function setEleipue($eleipue){
		$this->eleipue = $eleipue;
	}
	function setElephom($elephom){
		$this->elephom = $elephom;
	}
	function setElepmuj($elepmuj){
		$this->elepmuj = $elepmuj;
	}
	function setElenmes($elenmes){
		$this->elenmes = $elenmes;
	}
	function setEleccom($eleccom){
		$this->eleccom = $eleccom;
	}
	function setElencom($elencom){
		$this->elencom = $elencom;
	}

	function setIdcan($idcan){
		$this->idcan = $idcan;
	}
	function setCorp($corp){
		$this->corp = $corp;
	}
	function setCirc($circ){
		$this->circ = $circ;
	}
	function setEleccan($eleccan){
		$this->eleccan = $eleccan;
	}
	function setPtip($ptip){
		$this->ptip = $ptip;
	}
	function setNcan($ncan){
		$this->ncan = $ncan;
	}
	function setAcan($acan){
		$this->acan = $acan;
	}
	function setCcan($ccan){
		$this->ccan = $ccan;
	}
	function setGcan($gcan){
		$this->gcan = $gcan;
	}
	function setScan($scan){
		$this->scan = $scan;
	}

	//METODOS

// Dominio
	public function getDom(){
		$sql = "SELECT iddel, nomdel FROM eledom WHERE iddel BETWEEN 2 and 8";		
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}

	public function getDomAll(){
		$sql = "SELECT iddel, nomdel FROM eledom";		
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}

	public function getDomO($iddel){
		$sql = "SELECT iddel, nomdel FROM eledom WHERE iddel=$iddel";		
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}

	public function insDom(){
		$sql = "INSERT eledom (iddel, nomdel) VALUES (?,?)";

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getIddel(), $this->getNomdel());
		$save=$update->execute($arrdata);	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function updDom(){
		$sql = "UPDATE eledom SET nomdel=? WHERE iddel=?";

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getNomdel(), $this->getIddel());
		$save=$update->execute($arrdata);	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function delDom(){
		$sql = "DELETE FROM eledom WHERE iddel=?";

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getIddel());
		$save=$update->execute($arrdata);	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

// Partido
	public function getParAll(){
		$sql = "SELECT elecp, elenp FROM elepar";		
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}

	public function getPar($elecp){
		$sql = "SELECT elecp, elenp FROM elepar WHERE elecp=$elecp";	
		// echo "<br>".$sql."<br>";
		// die();	
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}

	public function insPar(){
		$sql = "INSERT elepar (elecp, elenp) VALUES (?,?)";

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getElecp(), $this->getElenp());
		$save=$update->execute($arrdata);	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function updPar(){
		$sql = "UPDATE elepar SET elenp=? WHERE elecp=?";

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getElenp(), $this->getElecp());
		$save=$update->execute($arrdata);	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function delPar(){
		$sql = "DELETE FROM elepar";

		$update= $this->db->prepare($sql);
		//$arrdata = array($this->getElecp());
		//$save=$update->execute($arrdata);
		$save=$update->execute();
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

// VALORES 1 Circunscripción - 2 Corporaciones - 3 Indicadores - 4 Tipo cámara - 5 División política - 6 Partidos - 7 Candidatos
	public function getValAll(){
		$sql = "SELECT v.idvel, v.nomvel, v.iddel, d.nomdel, v.fijvel, v.prevel FROM eleval AS v INNER JOIN eledom AS d ON v.iddel=d.iddel";		
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}

	public function getVal($iddel){
		$sql = "SELECT idvel, nomvel, iddel, fijvel, prevel FROM eleval WHERE iddel=$iddel";		
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}

	public function getValOne($idvel){
		$sql = "SELECT idvel, nomvel, iddel, fijvel, prevel FROM eleval WHERE idvel=$idvel";		
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}

	public function insVal(){
		$sql = "INSERT INTO eleval(nomvel, iddel, fijvel, prevel) VALUES (?,?,?,?)";

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getNomvel(), $this->getIddel(), $this->getFijvel(), $this->getPrevel());
		$save=$update->execute($arrdata);	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function updVal(){
		$sql = "UPDATE eleval SET nomvel=?, iddel=?, fijvel=?, prevel=? WHERE idvel=?";

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getNomvel(), $this->getIddel(), $this->getFijvel(), $this->getPrevel(),$this->getIdvel());
		$save=$update->execute($arrdata);	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function delVal(){
		$sql = "DELETE FROM eleval WHERE idvel=?";

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getIdvel());
		$save=$update->execute($arrdata);	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

// División Política
	public function getDpAll(){
		$sql = "SELECT eledpid, elecdep, elecmun, eleczon, elcpue, elendep, elenmun, elenpue, eleipue, elephom, elepmuj, elenmes, eleccom, elencom FROM eledp";		
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}

	public function getDp($eledpid){
		$sql = "SELECT eledpid, elecdep, elecmun, eleczon, elcpue, elendep, elenmun, elenpue, eleipue, elephom, elepmuj, elenmes, eleccom, elencom FROM eledp WHERE eledpid=$eledpid";		
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}

	public function insDp(){
		$sql = "INSERT eledp (eledpid, elecdep, elecmun, eleczon, elcpue, elendep, elenmun, elenpue, eleipue, elephom, elepmuj, elenmes, eleccom, elencom) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getEledpid(), $this->getElecdep(), $this->getElecmun(), $this->getEleczon(), $this->getElcpue(), $this->getElendep(), $this->getElenmun(), $this->getElenpue(), $this->getEleipue(), $this->getElephom(), $this->getElepmuj(), $this->getElenmes(), $this->getEleccom(), $this->getElencom());
		$save=$update->execute($arrdata);	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function updDp(){
		$sql = "UPDATE eledp SET elecdep=?, elecmun=?, eleczon=?, elcpue=?, elendep=?, elenmun=?, elenpue=?, eleipue=?, elephom=?, elepmuj=?, elenmes=?, eleccom=?, elencom=? WHERE eledpid=?";

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getElecdep(), $this->getElecmun(), $this->getEleczon(), $this->getElcpue(), $this->getElendep(), $this->getElenmun(), $this->getElenpue(), $this->getEleipue(), $this->getElephom(), $this->getElepmuj(), $this->getElenmes(), $this->getEleccom(), $this->getElencom(), $this->getEledpid());
		$save=$update->execute($arrdata);	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function delDp(){
		$sql = "DELETE FROM eledp";

		$update= $this->db->prepare($sql);
		//$arrdata = array($this->getEledpid());
		//$save=$update->execute($arrdata);
		$save=$update->execute();	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

// Candidato
	public function getCanAll(){
		$sql = "SELECT c.idcan, c.corp, d.nomdat AS nco, c.circ, d2.nomdat AS nci, c.elecdep, c.elecmun, c.eleccom, c.elecp, p.elenp, c.eleccan, c.ptip, c.ncan, c.acan, c.ccan, c.gcan, c.scan FROM elecan AS c INNER JOIN elepar AS p ON c.elecp=p.elecp LEFT JOIN eledat AS d ON (c.corp=d.iddat AND d.iddel=3) LEFT JOIN eledat AS d2 ON (c.circ=d2.iddat AND d2.iddel=2)";		
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}

	public function getCan($idcan){
		$sql = "SELECT idcan, corp, circ, elecdep, elecmun, eleccom, elecp, eleccan, ptip, ncan, acan, ccan, gcan, scan FROM elecan WHERE idcan=$idcan";		
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}

	public function getCc($eleccan,$elecp,$corp){
		$sql = "SELECT idcan, corp, circ, elecdep, elecmun, eleccom, elecp, eleccan, ptip, ncan, acan, ccan, gcan, scan FROM elecan WHERE eleccan=$eleccan and elecp=$elecp";
		// echo "<br>".$sql."<br>";
		// die();
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}

	public function insCan(){
		$sql = "INSERT elecan (corp, circ, elecdep, elecmun, eleccom, elecp, eleccan, ptip, ncan, acan, ccan, gcan, scan) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getCorp(), $this->getCirc(), $this->getElecdep(), $this->getElecmun(), $this->getEleccom(), $this->getElecp(), $this->getEleccan(), $this->getPtip(), $this->getNcan(), $this->getAcan(), $this->getCcan(), $this->getGcan(), $this->getScan());
		$save=$update->execute($arrdata);	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function updCan(){
		$sql = "UPDATE elecan SET corp=?, circ=?, elecdep=?, elecmun=?, eleccom=?, elecp=?, eleccan=?, ptip=?, ncan=?, acan=?, ccan=?, gcan=?, scan=? WHERE idcan=?";

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getCorp(), $this->getCirc(), $this->getElecdep(), $this->getElecmun(), $this->getEleccom(), $this->getElecp(), $this->getEleccan(), $this->getPtip(), $this->getNcan(), $this->getAcan(), $this->getCcan(), $this->getGcan(), $this->getScan(), $this->getIdcan());
		$save=$update->execute($arrdata);	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function delCan(){
		$sql = "DELETE FROM elecan";

		$update= $this->db->prepare($sql);
		//$arrdata = array($this->getIdcan());
		//$save=$update->execute($arrdata);	
		$save=$update->execute();	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

//Datos generales
	public function getDatAll($iddel){
		$sql = "SELECT d.idd, d.iddat, d.nomdat, d.iddel, o.nomdel FROM eledat AS d INNER JOIN eledom AS o ON d.iddel=o.iddel WHERE d.iddel=$iddel";		
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}

	public function getDat($idd){
		$sql = "SELECT idd, iddat, nomdat, iddel FROM eledat WHERE idd=$idd";		
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}

	public function insDat(){
		$sql = "INSERT INTO eledat(iddat, nomdat, iddel) VALUES (?,?,?)";

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getIddat(), $this->getNomdat(), $this->getIddel());
		$save=$update->execute($arrdata);	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function updDat(){
		$sql = "UPDATE eledat SET iddat=?, nomdat=?, iddel=? WHERE idd=?";

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getIddat(), $this->getNomdat(), $this->getIddel(), $this->getIdd());
		$save=$update->execute($arrdata);	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function delDat(){
		$sql = "DELETE FROM eledat WHERE iddel=?";

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getIddel());
		$save=$update->execute($arrdata);	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
// Consulta para averiguar División política
	public function getDepto($elecdep){
		$sql = "SELECT DISTINCT elendep AS nom FROM eledp WHERE elecdep=$elecdep";		
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}

	public function getMunic($elecmun){
		$sql = "SELECT DISTINCT elenmun AS nom FROM eledp WHERE elecmun=$elecmun";		
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}

	public function getComun($eleccom){
		$sql = "SELECT DISTINCT elencom AS nom FROM eledp WHERE eleccom=$eleccom";		
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}
}
?>