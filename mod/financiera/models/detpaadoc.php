<?php 
//detpaadoc
class Detpaadoc{
	private $iddpdc;
	private $iddpa;
	private $valid;
	private $idcon;
	private $perid;
	private $fechor;
	
	public function __construct() {
		$this->db = conexion::get_conexion();
	}

	function getIddpdc(){
		return $this->iddpdc;
	}
	function getIddpa(){
		return $this->iddpa;
	}
	function getValid(){
		return $this->valid;
	}
	function getIdcon(){
		return $this->idcon;
	}
	function getPerid(){
		return $this->perid;
	}
	function getFechor(){
		return $this->fechor;
	}

	//SET

	function setIddpdc($iddpdc){
		$this->iddpdc = $iddpdc;
	}
	function setIddpa($iddpa){
		$this->iddpa = $iddpa;
	}
	function setValid($valid){
		$this->valid = $valid;
	}
	function setIdcon($idcon){
		$this->idcon = $idcon;
	}
	function setPerid($perid){
		$this->perid = $perid;
	}
	function setFechor($fechor){
		$this->fechor = $fechor;
	}

	//METODOS

	public function getAll(){
		$sql = "SELECT d.iddpdc, d.iddpa, d.valid, v.valnom, d.idcon, d.perid,p.nodocemp,p.pernom,p.perape,p.peremail, d.fechor, d.rutdpdc FROM detpaadoc AS d INNER JOIN valor AS v ON d.valid=v.valid INNER JOIN persona AS p ON d.perid=p.perid";
		$sql .= " WHERE d.idcon=".$this->idcon;
		$execute = $this->db->query($sql);
		$resp = $execute->fetchall(PDO::FETCH_ASSOC);
		return $resp;
	}

	public function getOne(){
		$sql = "SELECT d.iddpdc, d.iddpa, d.valid, v.valnom, d.idcon, d.perid,p.nodocemp,p.pernom,p.perape,p.peremail, d.fechor, d.rutdpdc FROM detpaadoc AS d INNER JOIN valor AS v ON d.valid=v.valid INNER JOIN persona AS p ON d.perid=p.perid WHERE d.iddpdc=".$this->iddpdc;
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function getFaltan(){
		$sql = "SELECT COUNT(iddpdc) AS can FROM detpaadoc WHERE rutdpdc IS NULL AND idcon=".$this->idcon;
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}
	public function getTiene(){
		$sql = "SELECT COUNT(iddpdc) AS can FROM detpaadoc WHERE rutdpdc IS NOT NULL AND idcon=".$this->idcon;
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function editDpdoc(){	
		$sql = "UPDATE detpaadoc SET iddpa=?, valid=?, idcon=?, perid=?";
		$sql .= " WHERE iddpdc={$this->iddpdc};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getIddpa(), $this->getValid(), $this->getIdcon(), $this->getPerid());
		$save=$update->execute($arrdata);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function editConDpaa($iddpa,$idcon){	
		$sql = "UPDATE contrato SET iddpa='$iddpa' WHERE idcon='$idcon'";
		$update= $this->db->prepare($sql);
		$save=$update->execute();
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function save(){
		$sql = "INSERT INTO detpaadoc(iddpa,valid,idcon,perid) VALUES (?,?,?,?) ";
		$update= $this->db->prepare($sql);
		$arrdata = array($this->getIddpa(), $this->getValid(), $this->getIdcon(), $this->getPerid());
		$save=$update->execute($arrdata);	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function eli($iddpdc){
		$sql = "DELETE FROM detpaadoc WHERE iddpdc='$iddpdc' ";
		$update= $this->db->prepare($sql);
		$save=$update->execute();

		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function savePer($nodocemp, $pernom, $perape, $peremail, $perpass, $depid){
		$sql= "INSERT INTO persona(nodocemp, pernom, perape, peremail, perpass, ubiid, pefid, depid,actemp) VALUES (?,?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
			$arrdata = array($nodocemp, $pernom, $perape, $peremail, sha1(md5($perpass)), '11001', '19', $depid, '1');
		/*echo $sql."<br><br>";
		var_dump($arrdata);
		echo "<br><br>";
		die();*/
		$save = $insert->execute($arrdata);
	}

	public function getOneLast($nodocemp,$pernom,$perape,$peremail,$perpass,$depid){
		$sql = "SELECT perid FROM persona WHERE nodocemp='$nodocemp' AND pernom='$pernom' AND perape='$perape' AND peremail='$peremail' AND perpass='".sha1(md5($perpass))."' AND ubiid='11001' AND pefid='19' AND depid='$depid' AND actemp='1'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}
}
?>