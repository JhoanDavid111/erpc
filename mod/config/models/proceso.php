<?php

class Proceso{

	private $idpro;
	private $nompro;
	private $deppro;
	private $codpro;
	private $doctrd;
	private $ordpro;

	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getIdpro(){
		return $this->idpro;
	}
	function getNompro(){
		return $this->nompro;
	}
	function getDeppro(){
		return $this->deppro;
	}
	function getCodpro(){
		return $this->codpro;
	}
	function getDoctrd(){
		return $this->doctrd;
	}
	function getOrdpro(){
		return $this->ordpro;
	}

//Metodos Set Guardan el dato

	function setIdpro($idpro){
		$this->idpro = $idpro;
	}
	function setNompro($nompro){
		$this->nompro = $nompro;
	}
	function setDeppro($deppro){
		$this->deppro = $deppro;
	}
	function setCodpro($codpro){
		$this->codpro = $codpro;
	}
	function setDoctrd($doctrd){
		$this->doctrd = $doctrd;
	}
	function setOrdpro($ordpro){
		$this->ordpro = $ordpro;
	}

//Metodos CRUD
	public function getAll(){
		$sql = "SELECT idpro, nompro, deppro, codpro, doctrd, ordpro FROM proceso WHERE idpro BETWEEN 5004 AND 5999 ORDER BY idpro";
		// echo $sql;
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($rub);
		// die();
		return $rub;
	}

	public function getOne(){
		$sql = "SELECT idpro, nompro, deppro, codpro, doctrd, ordpro FROM proceso WHERE idpro=$this->idpro";
		//echo "<br><br><br>".$sql."<br>'".$this->idpro."'<br><br><br>"; 
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function eli($idpro){
		$sql ="DELETE FROM proceso WHERE idpro=$idpro";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function save(){
		$sql= "INSERT INTO proceso(idpro, nompro, deppro, codpro, doctrd, ordpro) VALUES (?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getIdpro(), $this->getNompro(), $this->getDeppro(), $this->getCodpro(), $this->getDoctrd(), $this->getOrdpro());
	// echo $sql;
	// var_dump($arrdata);
	// die();
		$save = $insert->execute($arrdata);

	}

	public function edit(){		

		$sql = "UPDATE proceso SET nompro=?,ordpro=? ";
		$sql .= " WHERE idpro={$this->idpro};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getNompro(), $this->getOrdpro());
		$save=$update->execute($arrdata);	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
}