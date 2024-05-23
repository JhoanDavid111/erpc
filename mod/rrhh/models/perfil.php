<?php

class Perfil{

	private $pefid;
	private $pefnom;
	private $pefedi;
	private $pagprin;
	private $idmod;
	private $db;
	//SELECT pefid, pefnom, pefbus, pefdes, pefedi, pefeli, pagprin, idmod FROM perfil
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getPefid() {
		return $this->pefid;
	}

	function getPefnom() {
		return $this->pefnom;
	}

	function getPefedi() {
		return $this->pefedi;
	}

	function getPagprin() {
		return $this->pagprin;
	}
	
	function getIdmod() {
		return $this->idmod;
	}

//Metodos Set Guardan el dato
	function setPefid($pefid) {
		$this->pefid = $pefid;
	}

	function setPefnom($pefnom) {
		$this->pefnom = $pefnom;
	}

	function setPefedi($pefedi) {
		$this->pefedi = $pefedi;
	}

	function setPagprin($pagprin) {
		$this->pagprin = $pagprin;
	}

	function setIdmod($idmod) {
		$this->idmod = $idmod;
	}

//Metodos CRUD
	public function getAll(){
		$sql = "SELECT p.*, m.* FROM perfil AS p INNER JOIN modulo AS m ON p.idmod=m.idmod ORDER BY p.pefid";		
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		/*var_dump($rub);
		die();*/

		return $rub;
	}

	public function getOne(){
		$sql ="SELECT * FROM perfil WHERE pefid = ".$this->pefid;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}
	//Seleccionar los perfiles de un módulo específico
	public function getAllpp(){
		$sql = "SELECT p.pefid AS idp, m.idmod AS idb, p.pefnom AS nom2 FROM perfil AS p INNER JOIN modulo AS m ON p.idmod=m.idmod ORDER BY p.pefnom";		
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		/*var_dump($rub);
		die();*/

		return $rub;
	}
	//Seleccionar las páginas de un perfil
	public function getOnePxP($pefid){
		$sql ="SELECT pagid AS idb FROM pagper WHERE pefid = ".$pefid;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}
	//Seleccionar los estados y email de un perfil
	public function getOnePxEm($pefid){
		$sql ="SELECT valid AS idb, envmail AS em FROM perxest WHERE pefid = ".$pefid;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}
	//Seleccionar los estados a visualizar de un perfil
	public function getOnePxEv($pefid){
		$sql ="SELECT valid AS idb FROM editexp WHERE pefid = ".$pefid;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		//var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function save(){
		$sql= "INSERT INTO perfil(pefnom, pefedi, pagprin, idmod) VALUES (?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getPefnom(), $this->getPefedi(), $this->getPagprin(), $this->getIdmod());
		$save = $insert->execute($arrdata);
	}

	public function delpxp(){
		$sql= "DELETE FROM pagper WHERE pefid={$this->pefid};";
		$del = $this->db->prepare($sql);
		$delpxp = $del->execute();
	}

	public function savepxp($pagid){
		$sql= "INSERT INTO pagper(pagid, pefid) VALUES (?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($pagid, $this->getPefid());
		$savepxp = $insert->execute($arrdata);
	}

	public function delpev(){
		$sql= "DELETE FROM editexp WHERE pefid={$this->pefid};";
		$del = $this->db->prepare($sql);
		$delpev = $del->execute();
	}

	public function savepev($valid){
		$sql= "INSERT INTO editexp(pefid,valid) VALUES (?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getPefid(), $valid);
		$savepev = $insert->execute($arrdata);
	}

	public function delpee(){
		$sql= "DELETE FROM perxest WHERE pefid={$this->pefid};";
		$del = $this->db->prepare($sql);
		$delpee = $del->execute();
	}

	public function savepee($valid,$envmail){
		$sql= "INSERT INTO perxest(pefid,valid,envmail) VALUES (?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getPefid(), $valid, $envmail);
		$savepee = $insert->execute($arrdata);
	}

	public function edit(){		

		$sql = "UPDATE perfil SET pefnom=?,pefedi=?,pagprin=?,idmod=? ";
		$sql .= " WHERE pefid={$this->pefid};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getPefnom(), $this->getPefedi(), $this->getPagprin(), $this->getIdmod());
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