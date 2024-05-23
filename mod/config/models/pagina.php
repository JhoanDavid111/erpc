<?php

class Pagina{

	private $pagid;
	private $pagnom;
	private $pagarc;
	private $pagmos;
	private $pagord;
	private $pagmen;
	private $icono;
	private $idmod;
	private $db;
	//SELECT pagmen, icono, idmod FROM pagina
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getPagid() {
		return $this->pagid;
	}

	function getPagnom() {
		return $this->pagnom;
	}

	function getPagarc() {
		return $this->pagarc;
	}

	function getPagmos() {
		return $this->pagmos;
	}
	
	function getPagord() {
		return $this->pagord;
	}

	function getPagmen() {
		return $this->pagmen;
	}

	function getIcono() {
		return $this->icono;
	}

	function getIdmod() {
		return $this->idmod;
	}

//Metodos Set Guardan el dato
	function setPagid($pagid) {
		$this->pagid = $pagid;
	}

	function setPagnom($pagnom) {
		$this->pagnom = $pagnom;
	}

	function setPagarc($pagarc) {
		$this->pagarc = $pagarc;
	}

	function setPagmos($pagmos) {
		$this->pagmos = $pagmos;
	}

	function setPagord($pagord) {
		$this->pagord = $pagord;
	}

	function setPagmen($pagmen) {
		$this->pagmen = $pagmen;
	}

	function setIcono($icono) {
		$this->icono = $icono;
	}

	function setIdmod($idmod) {
		$this->idmod = $idmod;
	}

//Metodos CRUD
	public function getAll(){
		$sql = "SELECT p.*, m.* FROM pagina AS p INNER JOIN modulo AS m ON p.idmod=m.idmod ORDER BY m.ordmod, p.pagord";		
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		/*var_dump($rub);
		die();*/

		return $rub;
	}

	public function getOne(){
		$sql ="SELECT * FROM pagina WHERE pagid = ".$this->pagid;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getOneMod($idmod){
		$sql ="SELECT pagid AS id, pagnom AS nom FROM pagina WHERE idmod = ".$idmod;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}


	public function save(){
		$sql= "INSERT INTO pagina(pagid, pagnom, pagarc, pagmos, pagord, pagmen, icono, idmod) VALUES (?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getPagid(), $this->getPagnom(), $this->getPagarc(), $this->getPagmos(), $this->getPagord(), $this->getPagmen(), $this->getIcono(), $this->getIdmod());
		$save = $insert->execute($arrdata);
	}

	public function edit(){		

		$sql = "UPDATE pagina SET pagnom=?,pagarc=?,pagmos=?,pagord=?,pagmen=?, icono=?, idmod=? ";
		$sql .= " WHERE pagid={$this->pagid};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getPagnom(), $this->getPagarc(), $this->getPagmos(), $this->getPagord(), $this->getPagmen(), $this->getIcono(), $this->getIdmod());
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

	public function actPag(){		

		$sql = "UPDATE pagina SET pagmos=? ";
		$sql .= " WHERE pagid={$this->pagid};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getPagmos());
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
