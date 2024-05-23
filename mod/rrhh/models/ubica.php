<?php

class Ubica{

	private $ubiid;
	private $ubinom;
	private $ubidepto;
	private $ubiestado;
	private $db;
	//SELECT ubiid, ubinom, ubidepto, ubiestado FROM ubicaubiid, ubinom, ubidepto, ubiestado FROM ubica
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getUbiid() {
		return $this->ubiid;
	}

	function getUbinom() {
		return $this->ubinom;
	}

	function getUbidepto() {
		return $this->ubidepto;
	}

	function getUbiestado() {
		return $this->ubiestado;
	}

//Metodos Set Guardan el dato
	function setUbiid($ubiid) {
		$this->ubiid = $ubiid;
	}

	function setUbinom($ubinom) {
		$this->ubinom = $ubinom;
	}

	function setUbidepto($ubidepto) {
		$this->ubidepto = $ubidepto;
	}

	function setUbiestado($ubiestado) {
		$this->ubiestado = $ubiestado;
	}

//Metodos CRUD
	public function getAll(){
		$sql = "SELECT v.ubiid, v.ubinom AS mun, v.ubidepto, v.ubiestado, d.ubinom AS dept FROM ubica AS v INNER JOIN ubica AS d ON v.ubidepto=d.ubiid ORDER BY v.ubiid";		
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		/*var_dump($rub);
		die();*/

		return $rub;
	}

	public function getOne(){
		$sql ="SELECT * FROM ubica WHERE ubiid = ".$this->ubiid;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getDepto(){
		//$sql ="SELECT * FROM ubica";
		$sql ="SELECT * FROM ubica WHERE ubidepto = 0";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function save(){
		$sql= "INSERT INTO ubica(ubiid, ubinom, ubidepto, ubiestado) VALUES (?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getUbiid(), $this->getUbinom(), $this->getUbidepto(), $this->getUbiestado());
		$save = $insert->execute($arrdata);
	}

	public function edit(){		

		$sql = "UPDATE ubica SET ubinom=?,ubidepto=?,ubiestado=? ";
		$sql .= " WHERE ubiid={$this->ubiid};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getUbinom(), $this->getUbidepto(), $this->getUbiestado());
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