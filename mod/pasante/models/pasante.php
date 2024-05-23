<?php

class Pasante{

	private $idpas;
	private $docpas;
	private $nompas;
	private $propas;
	private $unipas;
	private $fingpas;
	private $ffinpas;
	private $durpas;
	private $acvpas;
	private $conpas;
	private $actpas;
	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getIdpas() {
		return $this->idpas;
	}

	function getDocpas() {
		return $this->docpas;
	}

	function getNompas() {
		return $this->nompas;
	}

	function getPropas() {
		return $this->propas;
	}
	
	function getUnipas() {
		return $this->unipas;
	}

	function getFingpas() {
		return $this->fingpas;
	}

	function getFfinpas() {
		return $this->ffinpas;
	}

	function getDurpas() {
		return $this->durpas;
	}

	function getAcvpas() {
		return $this->acvpas;
	}

	function getConpas() {
		return $this->conpas;
	}

	function getActpas() {
		return $this->actpas;
	}
//Metodos Set Guardan el dato
	function setIdpas($idpas) {
		$this->idpas = $idpas;
	}

	function setDocpas($docpas) {
		$this->docpas = $docpas;
	}

	function setNompas($nompas) {
		$this->nompas = $nompas;
	}

	function setPropas($propas) {
		$this->propas = $propas;
	}

	function setUnipas($unipas) {
		$this->unipas = $unipas;
	}

	function setFingpas($fingpas) {
		$this->fingpas = $fingpas;
	}

	function setFfinpas($ffinpas) {
		$this->ffinpas = $ffinpas;
	}

	function setDurpas($durpas) {
		$this->durpas = $durpas;
	}

	function setAcvpas($acvpas) {
		$this->acvpas = $acvpas;
	}

	function setConpas($conpas) {
		$this->conpas = $conpas;
	}

	function setActpas($actpas) {
		$this->actpas = $actpas;
	}
//Metodos CRUD
	public function getAll(){
		$sql = "SELECT * FROM pasante";		
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	public function getOne(){
		$sql ="SELECT * FROM pasante WHERE idpas = ".$this->idpas;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function save(){
		$sql= "INSERT INTO pasante(docpas, nompas, propas, unipas, fingpas, ffinpas, durpas, acvpas, conpas, actpas) VALUES (?,?,?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getDocpas(), $this->getNompas(), $this->getPropas(), $this->getUnipas(), $this->getFingpas(), $this->getFfinpas(), $this->getDurpas(), $this->getAcvpas(), $this->getConpas(), $this->getActpas());
		$save = $insert->execute($arrdata);
	}

	public function edit(){		

		$sql = "UPDATE pasante SET docpas=?,nompas=?,propas=?,unipas=?,fingpas=?, ffinpas=?, durpas=?, acvpas=?, conpas=?, actpas=? ";
		$sql .= " WHERE idpas={$this->idpas};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getDocpas(), $this->getNompas(), $this->getPropas(), $this->getUnipas(), $this->getFingpas(), $this->getFfinpas(), $this->getDurpas(), $this->getAcvpas(), $this->getConpas(), $this->getActpas());
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
	
	public function actPas(){		

		$sql = "UPDATE pasante SET actpas=? ";
		$sql .= " WHERE idpas={$this->idpas};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getactpas());
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