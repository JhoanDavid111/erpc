<?php

class Flujo{

	private $idflu;
	private $actflu;
	private $metflu;
	private $idpro;
	private $ordflu;
	private $areas;
	private $ntipo;
	private $color;

	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getIdflu() {
		return $this->idflu;
	}

	function getActflu() {
		return $this->actflu;
	}

	function getMetflu() {
		return $this->metflu;
	}

	function getIdpro() {
		return $this->idpro;
	}

	function getOrdflu() {
		return $this->ordflu;
	}
	
	function getAreas() {
		return $this->areas;
	}

	function getNtipo() {
		return $this->ntipo;
	}

	function getColor() {
		return $this->color;
	}

//Metodos Set Guardan el dato

	function setIdflu($idflu) {
		$this->idflu = $idflu;
	}

	function setActflu($actflu) {
		$this->actflu = $actflu;
	}

	function setMetflu($metflu) {
		$this->metflu = $metflu;
	}

	function setIdpro($idpro) {
		$this->idpro = $idpro;
	}

	function setOrdflu($ordflu) {
		$this->ordflu = $ordflu;
	}

	function setAreas($areas) {
		$this->areas = $areas;
	}

	function setNtipo($ntipo) {
		$this->ntipo = $ntipo;
	}

	function setColor($color) {
		$this->color = $color;
	}

//Metodos CRUD
	public function getAll(){
		$sql = "SELECT f.idflu, f.actflu, f.metflu, f.idpro, p.nompro, f.ordflu, f.areas, f.ntipo, f.color FROM flujo AS f INNER JOIN proceso AS p ON f.idpro=p.idpro WHERE f.idpro BETWEEN 5004 AND 5999;";
		// echo $sql;
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($rub);
		// die();
		return $rub;
	}

	public function getOne(){
		$sql = "SELECT idflu, actflu, metflu, idpro, ordflu, areas, ntipo, color FROM flujo WHERE idflu=$this->idflu";
		//echo "<br><br><br>".$sql."<br>'".$ano."','".$this->idcon."'<br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function eli($idflu){
		$sql ="DELETE FROM flujo WHERE idflu=$idflu";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function save(){
		$sql= "INSERT INTO flujo(idflu, actflu, metflu, idpro, ordflu, areas, ntipo, color) VALUES (?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getIdflu(), $this->getActflu(), $this->getMetflu(), $this->getIdpro(), $this->getOrdflu(), $this->getAreas(), $this->getNtipo(), $this->getColor());
	// echo $sql;
	// var_dump($arrdata);
	// die();
		$save = $insert->execute($arrdata);

	}

	public function edit(){		

		$sql = "UPDATE flujo SET actflu=?,metflu=?,idpro=?,ordflu=?,areas=?,ntipo=?,color=? ";
		$sql .= " WHERE idflu={$this->idflu};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getActflu(), $this->getMetflu(), $this->getIdpro(), $this->getOrdflu(), $this->getAreas(), $this->getNtipo(), $this->getColor());
		$save=$update->execute($arrdata);	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function getProceso(){
		$sql = "SELECT idpro, nompro FROM proceso WHERE idpro BETWEEN 5004 AND 5999 ORDER BY nompro";
		// echo $sql;
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($rub);
		// die();
		return $rub;
	}

	public function getArea($valid){
		$sql = "SELECT valid, valnom, parid, valfijo, pre, abr, ncon, cdpmul, doctrd FROM valor WHERE valid='".$valid."'";
		// echo $sql;
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($rub);
		// die();
		return $rub;
	}

	public function getAreasT(){
		$sql = "SELECT valid, valnom, parid, valfijo, pre, abr, ncon, cdpmul, doctrd FROM valor WHERE parid='1' ORDER BY valnom";
		// echo $sql;
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($rub);
		// die();
		return $rub;
	}
}