<?php

class Domfin{

	private $dofid;
	private $dofnom;
	private $doffijo;
	private $db;
	//SELECT dofid, dofnom, doffijo FROM domfin
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getDofid() {
		return $this->dofid;
	}

	function getDofnom() {
		return $this->dofnom;
	}

	function getDoffijo() {
		return $this->doffijo;
	}

//Metodos Set Guardan el dato
	function setDofid($dofid) {
		$this->dofid = $dofid;
	}

	function setDofnom($dofnom) {
		$this->dofnom = $dofnom;
	}

	function setDoffijo($doffijo) {
		$this->doffijo = $doffijo;
	}

//Metodos CRUD
	public function getAll(){
		$sql = "SELECT * FROM domfin ORDER BY dofid";		
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		/*var_dump($rub);
		die();*/

		return $rub;
	}

	public function getOne(){
		$sql ="SELECT * FROM domfin WHERE dofid = ".$this->dofid;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function save(){
		$sql= "INSERT INTO domfin(dofnom, doffijo) VALUES (?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getDofnom(), $this->getDoffijo());
		$save = $insert->execute($arrdata);
	}

	public function edit(){		

		$sql = "UPDATE domfin SET dofnom=?,doffijo=? ";
		$sql .= " WHERE dofid={$this->dofid};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getDofnom(), $this->getDoffijo());
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