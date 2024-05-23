<?php

class Ciiu{

	private $idciiu;
	private $codciiu;
	private $nomciiu;
	private $depciiu;
	private $db;
	//SELECT idciiu, codciiu, nomciiu, depciiu FROM ciiu
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getIdciiu() {
		return $this->idciiu;
	}

	function getCodciiu() {
		return $this->codciiu;
	}

	function getNomciiu() {
		return $this->nomciiu;
	}

	function getDepciiu() {
		return $this->depciiu;
	}

//Metodos Set Guardan el dato
	function setIdciiu($idciiu) {
		$this->idciiu = $idciiu;
	}

	function setCodciiu($codciiu) {
		$this->codciiu = $codciiu;
	}

	function setNomciiu($nomciiu) {
		$this->nomciiu = $nomciiu;
	}

	function setDepciiu($depciiu) {
		$this->depciiu = $depciiu;
	}

//Metodos CRUD
	public function getAll(){
		$sql = "SELECT c.*,d.codciiu AS ccd,d.nomciiu AS ncd FROM ciiu AS c LEFT JOIN ciiu AS d ON c.depciiu=d.codciiu ORDER BY c.idciiu";		
		$execute = $this->db->query($sql);
		$cii = $execute->fetchall(PDO::FETCH_ASSOC);

		/*var_dump($cii);
		die();*/

		return $cii;
	}

	public function getOne(){
		$sql ="SELECT * FROM ciiu WHERE idciiu = ".$this->idciiu;
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
		$sql= "INSERT INTO ciiu(codciiu, nomciiu, depciiu) VALUES (?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getCodciiu(), $this->getNomciiu(), $this->getDepciiu());
		// echo $sql."<br>";
		// var_dump($arrdata);
		// die();
		$save = $insert->execute($arrdata);
	}

	public function edit(){		

		$sql = "UPDATE ciiu SET codciiu=?,nomciiu=?,depciiu=? ";
		$sql .= " WHERE idciiu={$this->idciiu};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getCodciiu(), $this->getNomciiu(), $this->getDepciiu());
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