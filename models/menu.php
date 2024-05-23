<?php

class Menu{
		
	private $pagid;
	private $pagnom;
	private $pagarc;
	private $pagmos;
	private $pagord;
	private $pagmen;
	private $icono;
	private $idmod;
	private $db;
	
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
	function getPagid() {
		return $this->pagid;
	}

	function getPagnom() {
		return $this->pagnom;
	}

	function getPagarc() {
		return $this->pagarc;
	}

	function getPagmos() {
		return $this->pagmos;
	}

	function getPagord() {
		return $this->pagord;
	}

	function getIcono() {
		return $this->icono;
	}

	function getPagmen() {
		return $this->pagmen;
	}

	function getIdmod() {
		return $this->idmod;
	}
	
	function setPagid($pagid) {
		$this->pagid = $pagid;
	}

	function setPagnom($pagnom) {
		$this->pagnom = $pagnom;
	}

	function setPagarc($pagarc) {
		$this->pagarc = $pagarc;
	}

	function setPagmos($pagmos) {
		$this->pagmos = $pagmos;
	}

	function setPagord($pagord) {
		$this->pagord = $pagord;
	}

	function setIcono($icono) {
		$this->icono = $icono;
	}

	function setPagmen($pagmen) {
		$this->pagmen = $pagmen;
	}

	function setIdmod($idmod) {
		$this->idmod = $idmod;
	}

	function getMenu($pefid){
		$sql = "SELECT p.* FROM pagina AS p INNER JOIN pagper AS x ON p.pagid=x.pagid WHERE x.pefid='$pefid' AND p.pagmos='1' AND p.idmod=".$this->idmod." ORDER BY p.pagord";
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	function getEstpaa(){
		$sql = "SELECT * FROM paa WHERE estpaa=1";
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}
	//

	function getPagper($nompag, $perfil){
		$sql = "SELECT a.pagid FROM pagina AS a INNER JOIN pagper AS f ON a.pagid=f.pagid WHERE a.pagarc='$nompag' AND f.pefid=$perfil";
		//echo "<br>".$sql."<br>";

		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);		

		return $rub;
	}

	
	function getCdpMul($area){
		$sql = "SELECT COUNT(valid) AS Nu FROM valor WHERE cdpmul=1 and valid=$area";
		//echo "<br>".$sql."<br>";
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}
}