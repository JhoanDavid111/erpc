<?php

class Modulos{
		
	private $idmod;
	private $nommod;
	private $icomod;
	private $actmod;
	private $ordmod;
	private $db;
	
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
	function getIdmod() {
		return $this->idmod;
	}

	function getNommod() {
		return $this->nommod;
	}

	function getIcomod() {
		return $this->icomod;
	}

	function getActmod() {
		return $this->actmod;
	}

	function getOrdmod() {
		return $this->Ordmod;
	}
	
	function setIdmod($idmod) {
		$this->idmod = $idmod;
	}

	function setNommod($nommod) {
		$this->nommod = $nommod;
	}

	function setIcomod($icomod) {
		$this->icomod = $icomod;
	}

	function setActmod($actmod) {
		$this->actmod = $actmod;
	}

	function setOrdmod($ordmod) {
		$this->ordmod = $ordmod;
	}

	public function getAll(){
		$sql = "SELECT * FROM modulo WHERE actmod=1 ORDER BY ordmod";		
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		/*var_dump($rub);
		die();*/

		return $rub;
	}

	public function getModUser($perid){
		$sql = "SELECT m.idmod, m.nommod, m.icomod, m.actmod, m.ordmod, p.pefid, p.pefnom, p.pagprin, u.pernom, u.perape, u.peremail FROM modulo AS m INNER JOIN perfil AS p ON m.idmod=p.idmod INNER JOIN perxpef AS x ON p.pefid=x.pefid INNER JOIN persona AS u ON x.perid=u.perid WHERE u.perid=$perid";
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		/*var_dump($rub);
		die();*/

		return $rub;
	}

	public function vigact(){
		
		$sql = "SELECT idpaa FROM paa WHERE estpaa=3";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
	}

	public function getPerfil($idmod, $perid){
		$sql = "SELECT p.pefid, p.pefnom, u.depid, v.valnom FROM modulo AS m inner JOIN perfil AS p ON m.idmod=p.idmod INNER JOIN perxpef AS x ON p.pefid=x.pefid INNER JOIN persona AS u ON x.perid=u.perid INNER JOIN valor AS v ON u.depid=v.valid WHERE u.perid=$perid AND m.idmod=$idmod";
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		/*var_dump($rub);
		die();*/

		return $rub;
	}
}