<?php

class Param{

	private $parid;
	private $parnom;
	private $parfijo;
	private $db;
	//SELECT parid, parnom, parfijo FROM parame
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getParid() {
		return $this->parid;
	}

	function getParnom() {
		return $this->parnom;
	}

	function getParfijo() {
		return $this->parfijo;
	}

//Metodos Set Guardan el dato
	function setParid($parid) {
		$this->parid = $parid;
	}

	function setParnom($parnom) {
		$this->parnom = $parnom;
	}

	function setParfijo($parfijo) {
		$this->parfijo = $parfijo;
	}

//Metodos CRUD
	public function getAll(){
		$sql = "SELECT * FROM parame ORDER BY parid";		
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		/*var_dump($rub);
		die();*/

		return $rub;
	}

	public function getOne(){
		$sql ="SELECT * FROM parame WHERE parid = ".$this->parid;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function save(){
		$sql= "INSERT INTO parame(parnom, parfijo) VALUES (?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getParnom(), $this->getParfijo());
		$save = $insert->execute($arrdata);
	}

	public function edit(){		

		$sql = "UPDATE parame SET parnom=?,parfijo=? ";
		$sql .= " WHERE parid={$this->parid};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getParnom(), $this->getParfijo());
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