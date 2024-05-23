<?php

class Modulo{

	private $idmod;
	private $nommod;
	private $icomod;
	private $actmod;
	private $ordmod;
	private $pefpre;
	private $db;
	//SELECT idmod, nommod, icomod, actmod FROM modulo
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
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
		return $this->ordmod;
	}

	function getPefpre() {
		return $this->pefpre;
	}

//Metodos Set Guardan el dato
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

	function setPefpre($pefpre) {
		$this->pefpre = $pefpre;
	}

//Metodos CRUD
	public function getAll(){
		$sql = "SELECT m.idmod, m.nommod, m.icomod, m.actmod, m.ordmod, m.pefpre, p.pefnom FROM modulo AS m LEFT JOIN perfil AS p ON m.pefpre=p.pefid";
		// $sql = "SELECT * FROM modulo";	
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		/*var_dump($rub);
		die();*/

		return $rub;
	}

	public function getAllMod(){
		$sql = "SELECT idmod AS id, nommod AS nom FROM modulo";		
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		/*var_dump($rub);
		die();*/

		return $rub;
	}

	public function getOne(){
		$sql ="SELECT * FROM modulo WHERE idmod = ".$this->idmod;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function save(){
		$sql= "INSERT INTO modulo(nommod, icomod, actmod, ordmod, pefpre) VALUES (?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getNommod(), $this->getIcomod(), $this->getActmod(), $this->getOrdmod(), $this->getPefpre());
		$save = $insert->execute($arrdata);
	}


	public function savemxp($pefpre){
		$sql = "UPDATE modulo SET pefpre=? ";
		$sql .= " WHERE idmod={$this->idmod};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($pefpre);

		$save = $update->execute($arrdata);

			// var_dump($sql);
			// var_dump($arrdata);
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

	public function edit(){		

		$sql = "UPDATE modulo SET nommod=?,icomod=?,actmod=?,ordmod=? ";
		$sql .= " WHERE idmod={$this->idmod};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getNommod(), $this->getIcomod(), $this->getActmod(), $this->getOrdmod());
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

	public function actMod(){		

		$sql = "UPDATE modulo SET actmod=? ";
		$sql .= " WHERE idmod={$this->idmod};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getActmod());
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
	
	public function getAllPer(){
		$sql = "SELECT pefid, pefnom FROM perfil";		
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		/*var_dump($rub);
		die();*/

		return $rub;
	}
	
}