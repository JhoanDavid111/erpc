<?php 
//detpaa
require_once '../../../config/db.php';
class Mbas{

	private $btn;
	private $dpt;
	private $mnc;
	private $crp;
	private $ctd;
	private $bolnum;

	public function getBtn(){
		return $this->btn;
	}
	public function getDpt(){
		return $this->dpt;
	}
	public function getMnc(){
		return $this->mnc;
	}
	public function getCrp(){
		return $this->crp;
	}
	public function getCtd(){
		return $this->ctd;
	}
	public function getBolnum(){
		return $this->bolnum;
	}

	public function setBtn($btn){
		$this->btn= $btn;
	}
	public function setDpt($dpt){
		$this->dpt= $dpt;
	}
	public function setMnc($mnc){
		$this->mnc= $mnc;
	}
	public function setCrp($crp){
		$this->crp= $crp;
	}
	public function setCtd($ctd){
		$this->ctd= $ctd;
	}
	public function setBolnum($bolnum){
		$this->bolnum= $bolnum;
	}

	public function __construct() {
		$this->db = conexion::get_conexion();
	}

	public function getResult(){
		$sql = "SELECT r.idcan, c.elecp, c.eleccan, c.ncan, c.acan, c.ccan, r.voto, r.porce, r.elcp, p.elenp,r.bolnum,r.porinfo,r.muni, r.mesinf FROM elergo AS r INNER JOIN elecan AS c ON r.idcan=c.idcan INNER JOIN elepar AS p ON r.elcp=p.elecp WHERE c.act=1 ORDER BY r.voto DESC";		
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}

	public function getResmudp($tbl){
		$sql = "(SELECT g.id, g.idcan, g.voto, g.porce, g.elcp, g.bolnum, g.porinfo, g.muni, g.act, g.mesinf, g.elecdep, g.elecmun, a.idcan, a.corp, a.circ, a.elecdep, a.elecmun, a.eleccom, a.elecp, a.eleccan, a.ptip, a.ncan, a.acan, a.ccan, a.gcan, a.scan, a.act FROM ".$tbl." AS g INNER JOIN elecan AS a ON g.idcan=a.eleccan AND g.elecdep=a.elecdep and g.elecmun=a.elecmun WHERE g.elecdep='".$this->getDpt()."' AND g.elecmun='".$this->getMnc()."' AND a.act=1 AND a.corp='".$this->getCrp()."' AND g.bolnum='".$this->getBolnum()."') UNION ALL (SELECT g.id, g.idcan, g.voto, g.porce, g.elcp, g.bolnum, g.porinfo, g.muni, g.act, g.mesinf, g.elecdep, g.elecmun, '90900900' AS idcan, '0' AS corp, '0' AS circ, g.elecdep AS elecdep, g.elecmun AS elecmun, '0' AS eleccom, '0' AS elecp, '0' AS eleccan, '0' AS ptip, 'VOTOS' AS ncan, 'BLANCO' AS acan, '90900900' AS ccan, 'M' AS gcan, '0' AS scan, '1' AS act FROM ".$tbl." AS g WHERE g.elecdep='".$this->getDpt()."' AND g.elecmun='".$this->getMnc()."' AND g.bolnum='".$this->getBolnum()."' AND g.idcan IN (90900900)) UNION ALL (SELECT g.id, g.idcan, g.voto, g.porce, g.elcp, g.bolnum, g.porinfo, g.muni, g.act, g.mesinf, g.elecdep, g.elecmun, '90900950' AS idcan, '0' AS corp, '0' AS circ, g.elecdep AS elecdep, g.elecmun AS elecmun, '0' AS eleccom, '0' AS elecp, '0' AS eleccan, '0' AS ptip, 'VOTOS' AS ncan, 'NULOS' AS acan, '90900950' AS ccan, 'M' AS gcan, '0' AS scan, '1' AS act FROM ".$tbl." AS g WHERE g.elecdep='".$this->getDpt()."' AND g.elecmun='".$this->getMnc()."' AND g.bolnum='".$this->getBolnum()."' AND g.idcan IN (90900950)) ORDER BY voto DESC LIMIT 0,".$this->getCtd().";";
		// echo $sql;
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}


	public function getMc(){
		$sql = "SELECT idvel, nomvel FROM eleval WHERE idvel=9999;";
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}

	public function getCfg($id){
		$sql = "SELECT id, btn, dpt, mnc, crp, ctd, mnmc, tipo, vblc, cnul, bolnum FROM elecfg WHERE id='".$id."';";		
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}

	public function getBolMax($tbl, $dpt,$mnc){
		$sql = "SELECT MAX(bolnum) AS nb FROM ".$tbl." WHERE elecdep='".$dpt."' AND elecmun='".$mnc."'";
		//echo "<br>".$sql."<br>";	
		$execute = $this->db->query($sql);
		$elec = $execute->fetchall(PDO::FETCH_ASSOC);
		return $elec;
	}
}
?>