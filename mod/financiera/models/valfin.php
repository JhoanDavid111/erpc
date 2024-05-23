<?php

class Valfin{

	private $vafid;
	private $vafnom;
	private $dofid;
	private $vaffijo;
	private $vafpre;
	private $vafpf;
	private $db;
	//SELECT vafid, vafnom, dofid, vaffijo, vafpre FROM valfin
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getVafid() {
		return $this->vafid;
	}

	function getVafnom() {
		return $this->vafnom;
	}

	function getDofid() {
		return $this->dofid;
	}

	function getVaffijo() {
		return $this->vaffijo;
	}
	
	function getVafpre() {
		return $this->vafpre;
	}

	function getVafpf() {
		return $this->vafpf;
	}

//Metodos Set Guardan el dato
	function setvafid($vafid) {
		$this->vafid = $vafid;
	}

	function setVafnom($vafnom) {
		$this->vafnom = $vafnom;
	}

	function setDofid($dofid) {
		$this->dofid = $dofid;
	}

	function setVaffijo($vaffijo) {
		$this->vaffijo = $vaffijo;
	}

	function setVafpre($vafpre) {
		$this->vafpre = $vafpre;
	}

	function setVafpf($vafpf) {
		$this->vafpf = $vafpf;
	}

//Metodos CRUD
	public function getAll($tp=""){
		$sql = "SELECT v.vafid, v.vafnom, v.dofid, d.dofnom, v.vaffijo, v.vafpre, v.vafpf FROM valfin AS v INNER JOIN domfin AS d ON v.dofid=d.dofid";
		if($tp=="FUTIC") $sql .= " WHERE v.dofid=8";
		$sql .= " ORDER BY v.vafid";		
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		/*var_dump($rub);
		die();*/

		return $rub;
	}

	public function getOne(){
		$sql ="SELECT * FROM valfin WHERE vafid = ".$this->vafid;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getNewid(){
		$sql ="SELECT MAX(vafid)+1 AS Newid FROM valfin WHERE dofid=8";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		return $save;
	}

	public function getValdom(){
		if ($this->dofid == 8) {
			$sql ="SELECT * FROM valfin WHERE vaffijo=1 AND dofid = ".$this->dofid;
			//$sql ="SELECT * FROM valfin WHERE dofid = ".$this->dofid;
		}else{
			$sql ="SELECT * FROM valfin WHERE dofid = ".$this->dofid;
		}		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}
	public function save(){
		$sql= "INSERT INTO valfin(vafid, vafnom, dofid, vaffijo, vafpre, vafpf) VALUES (?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getVafid(), $this->getVafnom(), $this->getDofid(), $this->getVaffijo(), $this->getVafpre(), $this->getVafpf());
		$save = $insert->execute($arrdata);
	}

	public function edit(){		

		$sql = "UPDATE valfin SET vafnom=?,dofid=?,vaffijo=?,vafpre=?,vafpf=? ";
		$sql .= " WHERE vafid={$this->vafid};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getVafnom(), $this->getDofid(), $this->getVaffijo(), $this->getVafpre(), $this->getVafpf());
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
	
	public function updact(){		
		$sql = "UPDATE valfin SET vaffijo=?";
		$sql .= " WHERE vafid={$this->vafid};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getVaffijo());
		$save=$update->execute($arrdata);
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	//OBTENER UNIDAD EJECUTORA - UNIDAD DE CONTRATACION

	public function unicontrata(){
		$sql ="SELECT vafid,vafnom FROM valfin WHERE dofid = ".$this->dofid;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}
	
}