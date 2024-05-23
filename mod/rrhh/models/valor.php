<?php

class Valor{

	private $valid;
	private $valnom;
	private $parid;
	private $valfijo;
	private $pre;

	private $abr;
	private $ncon;
	private $cdpmul;

	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getValid() {
		return $this->valid;
	}

	function getValnom() {
		return $this->valnom;
	}

	function getParid() {
		return $this->parid;
	}

	function getValfijo() {
		return $this->valfijo;
	}
	
	function getPre() {
		return $this->pre;
	}

	function getAbr() {
		return $this->abr;
	}
	function getNcon() {
		return $this->ncon;
	}
	function getCdpmul() {
		return $this->cdpmul;
	}

//Metodos Set Guardan el dato
	function setValid($valid) {
		$this->valid = $valid;
	}

	function setValnom($valnom) {
		$this->valnom = $valnom;
	}

	function setParid($parid) {
		$this->parid = $parid;
	}

	function setValfijo($valfijo) {
		$this->valfijo = $valfijo;
	}

	function setPre($pre) {
		$this->pre = $pre;
	}

	function setAbr($abr) {
		$this->abr = $abr;
	}
	function setNcon($ncon) {
		$this->ncon = $ncon;
	}
	function setCdpmul($cdpmul) {
		$this->cdpmul = $cdpmul;
	}

//Metodos CRUD
	public function getAll(){
		$sql = "SELECT v.valid, v.valnom, v.parid, d.parnom, v.valfijo, v.pre, v.abr, v.ncon, v.cdpmul FROM valor AS v INNER JOIN parame AS d ON v.parid=d.parid ORDER BY v.valid";		
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		/*var_dump($rub);
		die();*/

		return $rub;
	}

	public function getOne(){
		$sql ="SELECT * FROM valor WHERE valid = ".$this->valid;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getOnePar($parid){
		$sql ="SELECT valid AS id, valnom AS nom FROM valor WHERE parid = ".$parid;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function save(){
		$sql= "INSERT INTO valor(valid, valnom, parid, valfijo, pre, abr, ncon, cdpmul) VALUES (?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getValid(), $this->getValnom(), $this->getParid(), $this->getValfijo(), $this->getPre(), $this->getAbr(), $this->getNcon(), $this->getCdpmul());
		$save = $insert->execute($arrdata);
	}

	public function edit(){		

		$sql = "UPDATE valor SET valnom=?,parid=?,valfijo=?,pre=?,abr=?, ncon=?, cdpmul=? ";
		$sql .= " WHERE valid={$this->valid};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getValnom(), $this->getParid(), $this->getValfijo(), $this->getPre(), $this->getAbr(), $this->getNcon(), $this->getCdpmul());
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

	public function actCDPm(){		

		$sql = "UPDATE valor SET cdpmul=? ";
		$sql .= " WHERE valid={$this->valid};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getCdpmul());
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
	
}