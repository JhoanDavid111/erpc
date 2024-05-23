<?php

class Peredit{
	private $perid;
	private $nodocemp;
	private $pernom;
	private $perape;
	private $peremail;
	private $perpass;
	private $ubiid;
	private $perdir;
	private $pertel;
	private $percel;
	private $pefid;
	private $depid;
	private $envema;
	private $actemp;
	private $db;
	//SELECT perpass, ubiid, perdir, pertel, percel, pefid, depid, envema, actemp FROM persona
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getPerid() {
		return $this->perid;
	}

	function getNodocemp() {
		return $this->nodocemp;
	}

	function getPernom() {
		return $this->pernom;
	}

	function getPerape() {
		return $this->perape;
	}
	
	function getPeremail() {
		return $this->peremail;
	}

	function getPerpass() {
		return $this->perpass;
	}

	function getUbiid() {
		return $this->ubiid;
	}

	function getPerdir() {
		return $this->perdir;
	}

	function getPertel() {
		return $this->pertel;
	}

	function getPercel() {
		return $this->percel;
	}

	function getPefid() {
		return $this->pefid;
	}

	function getDepid() {
		return $this->depid;
	}

	function getEnvema() {
		return $this->envema;
	}

	function getActemp() {
		return $this->actemp;
	}
//Metodos Set Guardan el dato
	function setPerid($perid) {
		$this->perid = $perid;
	}

	function setNodocemp($nodocemp) {
		$this->nodocemp = $nodocemp;
	}

	function setPernom($pernom) {
		$this->pernom = $pernom;
	}

	function setPerape($perape) {
		$this->perape = $perape;
	}

	function setPeremail($peremail) {
		$this->peremail = $peremail;
	}

	function setPerpass($perpass) {
		$this->perpass = $perpass;
	}

	function setUbiid($ubiid) {
		$this->ubiid = $ubiid;
	}

	function setPerdir($perdir) {
		$this->perdir = $perdir;
	}

	function setPertel($pertel) {
		$this->pertel = $pertel;
	}

	function setPercel($percel) {
		$this->percel = $percel;
	}

	function setPefid($pefid) {
		$this->pefid = $pefid;
	}

	function setDepid($depid) {
		$this->depid = $depid;
	}

	function setEnvema($envema) {
		$this->envema = $envema;
	}

	function setActemp($actemp) {
		$this->actemp = $actemp;
	}
//Metodos CRUD
	public function getAll(){
		$sql = "SELECT em.perid, em.nodocemp, em.pernom, em.perape, em.peremail, em.ubiid, u.ubinom, u.ubidepto, em.perdir, em.pertel, em.percel, em.pefid, pe.pefnom, em.depid, v.valnom, em.envema, em.actemp FROM persona AS em INNER JOIN perfil AS pe ON em.pefid = pe.pefid LEFT JOIN ubica AS u ON em.ubiid=u.ubiid LEFT JOIN valor AS v ON em.depid=v.valid ORDER BY em.perid";		
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		/*var_dump($rub);
		die();*/

		return $rub;
	}

	public function getOne(){
		$sql ="SELECT em.perid, em.nodocemp, em.pernom, em.perape, em.peremail, em.ubiid, u.ubinom, u.ubidepto, em.perdir, em.pertel, em.percel, em.pefid, pe.pefnom, em.depid, v.valnom, em.envema, em.actemp FROM persona AS em INNER JOIN perfil AS pe ON em.pefid = pe.pefid LEFT JOIN ubica AS u ON em.ubiid=u.ubiid LEFT JOIN valor AS v ON em.depid=v.valid WHERE em.perid = ".$this->perid;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getAllArea($parid){
		$sql ="SELECT valid, valnom FROM valor WHERE parid= ".$parid." ORDER BY valnom";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	//Seleccionar perfiles de una solo persona
	public function getAllpxp($perid){
		$sql = "SELECT x.pefid AS pid, p.idmod AS pim FROM perxpef AS x INNER JOIN perfil AS p ON x.pefid=p.pefid WHERE x.perid=".$perid;		
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		/*var_dump($rub);
		die();*/

		return $rub;
	}

	public function save(){
		$sql= "INSERT INTO persona(nodocemp, pernom, perape, peremail, perpass, ubiid, perdir, pertel, percel, pefid, depid, envema, actemp) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getNodocemp(), $this->getPernom(), $this->getPerape(), $this->getPeremail(), sha1(md5($this->getPerpass())), $this->getUbiid(), $this->getPerdir(), $this->getPertel(), $this->getPercel(), $this->getPefid(), $this->getDepid(), $this->getEnvema(), $this->getActemp());
		$save = $insert->execute($arrdata);
	}


	public function delpxp(){
		$sql= "DELETE FROM perxpef WHERE perid={$this->perid};";
		$del = $this->db->prepare($sql);
		$delpxp = $del->execute();
	}

	public function savepxp($pefid){
		$sql= "INSERT INTO perxpef(perid, pefid) VALUES (?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getPerid(), $pefid);
		$savepxp = $insert->execute($arrdata);
	}

	public function edit(){		

		$sql = "UPDATE persona SET nodocemp=?,pernom=?,perape=?,peremail=?,";
		if($this->getPerpass()) $sql .= "perpass=?, ";
		$sql .= "ubiid=?, perdir=?, pertel=?, percel=?, pefid=?, depid=?, envema=?, actemp=? ";
		$sql .= " WHERE perid={$this->perid};";	

		$update= $this->db->prepare($sql);
		if($this->getPerpass()){
			$arrdata = array($this->getNodocemp(), $this->getPernom(), $this->getPerape(), $this->getPeremail(), sha1(md5($this->getPerpass())), $this->getUbiid(), $this->getPerdir(), $this->getPertel(), $this->getPercel(), $this->getPefid(), $this->getDepid(), $this->getEnvema(), $this->getActemp());
		}else{
			$arrdata = array($this->getNodocemp(), $this->getPernom(), $this->getPerape(), $this->getPeremail(), $this->getUbiid(), $this->getPerdir(), $this->getPertel(), $this->getPercel(), $this->getPefid(), $this->getDepid(), $this->getEnvema(), $this->getActemp());
		}
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


	//EDITAR PERFIL POR USUARIO
	public function editP(){		

		$sql = "UPDATE persona SET nodocemp=?,pernom=?,perape=?,";
		//$sql = "UPDATE persona SET nodocemp=?,pernom=?,perape=?,peremail=?,";
		if($this->getPerpass()) $sql .= "perpass=?, ";
		$sql .= "ubiid=?, perdir=?, pertel=?, percel=?, envema=? ";
		$sql .= " WHERE perid={$this->perid};";	

		$update= $this->db->prepare($sql);
		
		if($this->getPerpass()){
			$arrdata = array($this->getNodocemp(), $this->getPernom(), $this->getPerape(), sha1(md5($this->getPerpass())), $this->getUbiid(), $this->getPerdir(), $this->getPertel(), $this->getPercel(), $this->getEnvema());
		}else{
			$arrdata = array($this->getNodocemp(), $this->getPernom(), $this->getPerape(), $this->getUbiid(), $this->getPerdir(), $this->getPertel(), $this->getPercel(), $this->getEnvema());
		}
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
	
	public function actPer(){		

		$sql = "UPDATE persona SET actemp=? ";
		$sql .= " WHERE perid={$this->perid};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getActemp());
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

	//Seleccionar categorias de una sola persona
	public function getAllcat($perid){
		$sql = "SELECT valid AS idb FROM catxper WHERE perid=".$perid;
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		/*var_dump($rub);
		die();*/

		return $rub;
	}

	public function savect($valid){
		$sql= "INSERT INTO catxper(perid, valid) VALUES (?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getPerid(), $valid);
		$savect = $insert->execute($arrdata);
	}

	public function delct(){
		$sql= "DELETE FROM catxper WHERE perid={$this->perid};";
		$del = $this->db->prepare($sql);
		$delct = $del->execute();
	}
}