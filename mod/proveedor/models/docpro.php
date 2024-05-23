<?php

class Docpro{

//SELECT iddoc, valor, ruta, idprov
	private $iddoc;
	private $valid;
	private $valor;
	private $ruta;
	private $idprov;
	

	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	

//Metodos Get Devuelven el dato
	function getIddoc() {
		return $this->iddoc;
	}

	function getValid() {
		return $this->valid;
	}

	function getValor() {
		return $this->valor;
	}

	function getRuta() {
		return $this->ruta;
	}

	function getIdprov() {
		return $this->idprov;
	}

	
//Metodos Set Guardan el dato

	function setIddoc($iddoc) {
		$this->iddoc = $iddoc;
	}

	function setValid($valid) {
		$this->valid = $valid;
	}

	function setValor($valor) {
		$this->valor = $valor;
	}

	function setRuta($ruta) {
		$this->ruta = $ruta;
	}

	function setIdprov($idprov) {
		$this->idprov = $idprov;
	}

		
//Metodos CRUD
	public function getAll(){
		$sql = "SELECT iddoc, valid, valor, ruta, idprov FROM docpro";		
		// echo $sql;
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($rub);
		// die();
		return $rub;
	}

	public function getOne($idprov, $valid){
		$sql ="SELECT iddoc, valid, valor, ruta, idprov FROM docpro WHERE valid=$valid AND idprov=$idprov";

		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getVal($parid){
		$sql ="SELECT valid, valnom, parid FROM valor WHERE cdpmul=1 AND parid=$parid ORDER BY ncon DESC";

		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function eli($idprov){
		$sql ="DELETE FROM docpro WHERE iddoc=$iddoc";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}
	
	public function save(){
		$sql= "INSERT INTO docpro(valid, valor, ruta, idprov) VALUES (?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getValid(),$this->getValor(), $this->getRuta(), $this->getIdprov());
		 // echo "<br><br>".$sql."<br><br>";
		 // var_dump($arrdata);
		 // die();
		$save = $insert->execute($arrdata);
	}
	
	public function edit(){		

		$sql = "UPDATE docpro SET valor=?,ruta=?,idprov=? ";
		$sql .= " WHERE iddoc={$this->iddoc};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getIddoc(),$this->getValor(), $this->getRuta(), $this->getIdprov());
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

	public function del(){
		$sql= "DELETE FROM docpro WHERE iddoc=?";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getIddoc());
		 // echo "<br><br>".$sql."<br><br>";
		 // var_dump($arrdata);
		 // die();
		$save = $insert->execute($arrdata);
	}
}