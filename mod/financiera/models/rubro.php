<?php

class Rubro{

	private $codrub;
	private $codrub2;
	private $nomrub;
	private $deprub;
	private $actrub;
	private $db;
	//SELECT codrub, nomrub, deprub, actrub FROM rubro
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getCodrub() {
		return $this->codrub;
	}
	function getCodrub2() {
		return $this->codrub2;
	}

	function getNomrub() {
		return $this->nomrub;
	}

	function getDeprub() {
		return $this->deprub;
	}

	function getActrub() {
		return $this->actrub;
	}

//Metodos Set Guardan el dato
	function setCodrub($codrub) {
		$this->codrub = $codrub;
	}

	function setCodrub2($codrub2) {
		$this->codrub2 = $codrub2;
	}

	function setNomrub($nomrub) {
		$this->nomrub = $nomrub;
	}

	function setDeprub($deprub) {
		$this->deprub = $deprub;
	}

	function setActrub($actrub) {
		$this->actrub = $actrub;
	}

//Metodos CRUD
	/*
	
	INSERT INTO rubro(codrub, nomrub, deprub, actrub) VALUES (:codrub, :nomrub, :deprub, :actrub);
	UPDATE rubro SET nomrub=:nomrub,deprub=:deprub,actrub=:actrub WHERE codrub=:codrub
	DELETE FROM rubro WHERE codrub=:codrub
	*/

	public function getAll(){
		$sql = "SELECT * FROM rubro ORDER BY codrub";		
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		/*var_dump($rub);
		die();*/

		return $rub;
	}

	public function getOne(){
		$sql ="SELECT * FROM rubro WHERE codrub = ".$this->codrub;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getNumAnteP($consultado){
		//$sql ="SELECT idpaa, ninipaa FROM paa WHERE estpaa=3";
		$sql ="SELECT idpaa, ninipaa FROM paa WHERE idpaa=$consultado";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		return $save;
	}

	public function getNum(){		
		$sql ="SELECT idpaa, ninipaa FROM paa WHERE estpaa=3";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		return $save;
	}


	public function save(){
		$sql= "INSERT INTO rubro(codrub,codrub2,nomrub, deprub, actrub) VALUES (?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getCodrub(),$this->getCodrub2(),$this->getNomrub(), $this->getDeprub(), $this->getActrub());
		$save = $insert->execute($arrdata);
	}

	public function edit(){		

		$sql = "UPDATE rubro SET codrub2=?,nomrub=?,deprub=?,actrub=? ";
		$sql .= " WHERE codrub={$this->codrub};";	

		// var_dump($sql);
		// die();

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getCodrub2(),$this->getNomrub(), $this->getDeprub(), $this->getActrub());
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