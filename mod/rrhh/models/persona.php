<?php

class Persona{
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
	private $ordgas;
	private $planta;
	private $cargo;
	
// ordgas
// planta
// cargo

	private $db;
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

	function getOrdgas(){
		return $this->ordgas;
	}
	function getPlanta(){
		return $this->planta;
	}
	function getCargo(){
		return $this->cargo;
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

	function setOrdgas($ordgas){
		$this->ordgas = $ordgas;
	}
	function setPlanta($planta){
		$this->planta = $planta;
	}
	function setCargo($cargo){
		$this->cargo = $cargo;
	}
	
//Metodos CRUD
	public function getAll($fecinico=NULL, $fecfinco=NULL){
//ordgas, planta, cargo
		$sql = "SELECT p.perid, val.valnom AS tpcto, hv.fecinico, hv.fecfinco, p.pernom, p.perdir, p.pertel, p.perape, p.nodocemp, p.peremail, p.percel, p.cargo, pf.pefnom, p.ubiid, u.ubinom, p.envema, p.planta, p.cargo, p.actemp, a.valnom AS area, s.valnom AS tpusu, c.valnom as carg FROM persona AS p LEFT JOIN perfil AS pf ON p.pefid =pf.pefid LEFT JOIN ubica AS u ON p.ubiid=u.ubiid LEFT JOIN valor AS s ON s.parid=30 AND p.ordgas=s.ncon LEFT JOIN valor AS c ON p.cargo=c.valid LEFT JOIN valor AS a ON p.depid=a.valid LEFT JOIN dathvper AS hv ON hv.perid=p.perid LEFT JOIN valor AS val ON hv.tipcon=val.valid WHERE 1";
		if($fecinico AND $fecfinco)
			$sql .= " AND hv.fecinico>='$fecinico' AND hv.fecfinco<='$fecfinco'";
		if($_SESSION['pefid']==62) $sql .= " AND p.perid='".$_SESSION['perid']."'";
		$sql .= " ORDER BY p.perid;";
		// echo $sql;
		//die();	
	
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		
		return $rub;
	}

	public function getOne(){
		$sql ="SELECT em.perid, em.nodocemp, em.pernom, em.perape, em.peremail, em.ubiid, u.ubinom, u.ubidepto, em.perdir, em.pertel, em.percel, em.pefid, pe.pefnom, em.depid, v.valnom, em.envema, em.actemp, em.ordgas, s.valnom AS tpusu, em.planta, em.cargo, c.valnom as carg FROM persona AS em INNER JOIN perfil AS pe ON em.pefid = pe.pefid INNER JOIN valor AS s ON s.parid=30 AND em.ordgas=s.ncon LEFT JOIN valor AS c ON em.cargo=c.valid LEFT JOIN ubica AS u ON em.ubiid=u.ubiid LEFT JOIN valor AS v ON em.depid=v.valid WHERE em.perid = ".$this->perid;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getOneENo(){
		//$sql ="SELECT em.perid, em.nodocemp, em.pernom, em.perape, em.peremail, em.ubiid, u.ubinom, u.ubidepto, em.perdir, em.pertel, em.percel, em.pefid, pe.pefnom, em.depid, v.valnom, em.envema, em.actemp, em.ordgas, s.valnom AS tpusu, em.planta, em.cargo, c.valnom as carg FROM persona AS em INNER JOIN perfil AS pe ON em.pefid = pe.pefid INNER JOIN valor AS s ON s.parid=30 AND em.ordgas=s.ncon LEFT JOIN valor AS c ON em.cargo=c.valid LEFT JOIN ubica AS u ON em.ubiid=u.ubiid LEFT JOIN valor AS v ON em.depid=v.valid WHERE em.peremail='".$this->peremail."' OR em.nodocemp='".$this->nodocemp."'";
		$sql ="SELECT perid FROM persona WHERE peremail='".$this->peremail."' OR nodocemp='".$this->nodocemp."'";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getAllArea($parid){
		$sql ="SELECT valid, valnom, ncon FROM valor WHERE parid= ".$parid." ORDER BY valnom";
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
		$sql= "INSERT INTO persona(";
		if($this->getNodocemp()) $sql .= "nodocemp, ";
		$sql .= "pernom, perape, peremail, perpass, ubiid, perdir, pertel, percel, pefid, depid, envema, actemp, ordgas, planta, cargo) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		if($this->getNodocemp()){
			$arrdata = array($this->getNodocemp(), $this->getPernom(), $this->getPerape(), $this->getPeremail(), sha1(md5($this->getPerpass())), $this->getUbiid(), $this->getPerdir(), $this->getPertel(), $this->getPercel(), $this->getPefid(), $this->getDepid(), $this->getEnvema(), $this->getActemp(), $this->getOrdgas(), $this->getPlanta(), $this->getCargo());
		}else{
			$arrdata = array($this->getPernom(), $this->getPerape(), $this->getPeremail(), sha1(md5($this->getPerpass())), $this->getUbiid(), $this->getPerdir(), $this->getPertel(), $this->getPercel(), $this->getPefid(), $this->getDepid(), $this->getEnvema(), $this->getActemp(), $this->getOrdgas(), $this->getPlanta(), $this->getCargo());
		}
		$save = $insert->execute($arrdata);
	}

	public function saveMm($perid, $tipdoc, $sex){
		$sql= "INSERT INTO dathvper(perid, tipdoc, sex) VALUES ('".$perid."', '".$tipdoc."', '".$sex."')";
		$insert = $this->db->prepare($sql);
		$save = $insert->execute();
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

		$sql = "UPDATE persona SET ";
		if($this->getNodocemp()) $sql .= "nodocemp=?, ";
		$sql .= "pernom=?,perape=?,peremail=?,";
		if($this->getPerpass()) $sql .= "perpass=?, ";
		$sql .= "ubiid=?, perdir=?, pertel=?, percel=?, pefid=?, depid=?, envema=?, actemp=?, ordgas=?, planta=?, cargo=?";
		$sql .= " WHERE perid={$this->perid};";	

		$update= $this->db->prepare($sql);
		if($this->getPerpass()){
			if($this->getNodocemp()){
				$arrdata = array($this->getNodocemp(), $this->getPernom(), $this->getPerape(), $this->getPeremail(), sha1(md5($this->getPerpass())), $this->getUbiid(), $this->getPerdir(), $this->getPertel(), $this->getPercel(), $this->getPefid(), $this->getDepid(), $this->getEnvema(), $this->getActemp(), $this->getOrdgas(), $this->getPlanta(), $this->getCargo());
			}else{
				$arrdata = array($this->getPernom(), $this->getPerape(), $this->getPeremail(), sha1(md5($this->getPerpass())), $this->getUbiid(), $this->getPerdir(), $this->getPertel(), $this->getPercel(), $this->getPefid(), $this->getDepid(), $this->getEnvema(), $this->getActemp(), $this->getOrdgas(), $this->getPlanta(), $this->getCargo());
			}
		}else{
			if($this->getNodocemp()){
				$arrdata = array($this->getNodocemp(), $this->getPernom(), $this->getPerape(), $this->getPeremail(), $this->getUbiid(), $this->getPerdir(), $this->getPertel(), $this->getPercel(), $this->getPefid(), $this->getDepid(), $this->getEnvema(), $this->getActemp(), $this->getOrdgas(), $this->getPlanta(), $this->getCargo());
			}else{
				$arrdata = array($this->getPernom(), $this->getPerape(), $this->getPeremail(), $this->getUbiid(), $this->getPerdir(), $this->getPertel(), $this->getPercel(), $this->getPefid(), $this->getDepid(), $this->getEnvema(), $this->getActemp(), $this->getOrdgas(), $this->getPlanta(), $this->getCargo());
			}
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