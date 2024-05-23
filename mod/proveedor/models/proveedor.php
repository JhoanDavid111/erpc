<?php

class Proveedor{

//SELECT idprov, nit, razsoc, dep, ciu, dir, tel, email, area
	private $idprov;
	private $nit;
	private $razsoc;
	private $dep;
	private $ciu;
	private $dir;
	private $tel;
	private $email;
	private $area;
	private $paclave;
	private $valid;

	private $idciiu;
	private $nomciiu;

	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	

//Metodos Get Devuelven el dato
	function getIdprov() {
		return $this->idprov;
	}

	function getNit() {
		return $this->nit;
	}

	function getRazsoc() {
		return $this->razsoc;
	}

	function getDep() {
		return $this->dep;
	}

	function getCiu() {
		return $this->ciu;
	}
	
	function getDir() {
		return $this->dir;
	}

	function getTel() {
		return $this->tel;
	}

	function getEmail() {
		return $this->email;
	}

	function getArea() {
		return $this->area;
	}

	function getIdciiu() {
		return $this->idciiu;
	}

	function getNomciiu() {
		return $this->nomciiu;
	}

	function getPaclave() {
		return $this->paclave;
	}

	function getValid(){
		return $this->valid;
	}


//Metodos Set Guardan el dato

	function setIdprov($idprov) {
		$this->idprov = $idprov;
	}

	function setNit($nit) {
		$this->nit = $nit;
	}

	function setRazsoc($razsoc) {
		$this->razsoc = $razsoc;
	}

	function setDep($dep) {
		$this->dep = $dep;
	}

	function setCiu($ciu) {
		$this->ciu = $ciu;
	}

	function setDir($dir) {
		$this->dir = $dir;
	}

	function setTel($tel) {
		$this->tel = $tel;
	}

	function setEmail($email) {
		$this->email = $email;
	}

	function setArea($area) {
		$this->area = $area;
	}

	function setIdciiu($idciiu) {
		$this->idciiu = $idciiu;
	}

	function setNomciiu($nomciiu) {
		$this->nomciiu = $nomciiu;
	}

	function setPaclave($paclave) {
		$this->paclave = $paclave;
	}

	function setValid($valid){
		$this->valid = $valid;
	}
	
	public function getAll(){
		$sql = "SELECT (SELECT AVG(califica) FROM provcali WHERE idprov=p.idprov) AS prome, p.idprov, p.nit, p.razsoc, p.dep, p.ciu, p.paclave, p.valid, t.valnom AS tipp, t.pre, m.ubinom AS mun, d.ubinom AS det, p.dir, p.tel, p.email, p.area, v.valnom AS are FROM proveedor AS p INNER JOIN valor AS v ON p.area=v.valid INNER JOIN ubica AS m ON p.ciu=m.ubiid INNER JOIN ubica AS d ON m.ubidepto=d.ubiid INNER JOIN valor AS t ON p.valid=t.valid";
		if($_SESSION['pefid']<>53){
			$sql .= " WHERE p.area='".$_SESSION['depid']."'";
		}
		//echo "<br>".$sql."<br>".$_SESSION['pefid']." - ".$_SESSION['depid']."<br>";
		//die();
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($rub);
		// die();
		return $rub;
	}

	public function getFilter(){
		$sql = "SELECT DISTINCT (SELECT (AVG(califica)) FROM provcali WHERE idprov=p.idprov ) AS prome, p.idprov, p.nit, p.razsoc, p.dep, p.ciu, p.paclave, m.ubinom AS mun, d.ubinom AS det, p.dir, p.tel, p.email, p.area, v.valnom FROM proveedor AS p INNER JOIN valor AS v ON p.area=v.valid INNER JOIN ubica AS m ON p.ciu=m.ubiid INNER JOIN ubica AS d ON m.ubidepto=d.ubiid INNER JOIN valor AS t ON p.valid=t.valid LEFT JOIN prociiu AS c ON p.idprov=c.idprov";
		$txt = " WHERE ";
		$n = false;
		// if($_SESSION['pefid']<>53){
		// 	$sql .= $txt."p.area='".$_SESSION['depid']."'";
		// 	$n = true;
		// }
		if($this->getRazsoc()){
			if($n==true) $txt= " OR ";
			$sql .= $txt."p.razsoc LIKE '%".$this->getRazsoc()."%'";
			$n = true;
		}
		// if($this->getNomciiu()){
		// 	if($n==true) $txt= " OR ";
		// 	$sql .= $txt."c.idciiu IN (SELECT t.idciiu FROM ciiu AS t WHERE t.codciiu LIKE '%".$this->getNomciiu()."%' OR t.nomciiu LIKE '%".$this->getNomciiu()."%')";
		// }

		if($this->getNomciiu()){
			if($n==true) $txt= " OR ";
			$sql .= $txt."p.paclave LIKE '%".$this->getNomciiu()."%'";
		}


		//echo "<br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		return $rub;
	}

	public function getOne(){
		$sql = "SELECT * FROM proveedor WHERE idprov=".$this->getIdprov();
		//echo $sql;

		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	/* public function eli($idprov){
		$sql ="DELETE FROM proveedor WHERE idprov=$idprov";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($sql);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// print_r($error);
		// die();
		return $save;
	} */
	
	public function save(){
		try {
			$sql= "INSERT INTO proveedor(idprov, nit, razsoc, dep, ciu, dir, tel, email, area, paclave, valid) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
			$insert = $this->db->prepare($sql);
			$arrdata = array($this->getIdprov(),$this->getNit(), $this->getRazsoc(), $this->getDep(), $this->getCiu(), $this->getDir(), $this->getTel(), $this->getEmail(), $this->getArea(), $this->getPaclave(), $this->getValid());
			// echo "<br><br>".$sql."<br><br>";
			// var_dump($arrdata);
			// die();
		    $save = $insert->execute($arrdata);
		} catch (PDOException $e) {
		    echo 'Falló la conexión: '.$e->getMessage();
		}
	}
	
	// public function save(){
	// 	$sql= "INSERT INTO proveedor(idprov, nit, razsoc, dep, ciu, dir, tel, email, area) VALUES (?,?,?,?,?,?,?,?,?)";
	// 	$insert = $this->db->prepare($sql);
	// 	$arrdata = array($this->getIdprov(),$this->getNit(), $this->getRazsoc(), $this->getDep(), $this->getCiu(), $this->getDir(), $this->getTel(), $this->getEmail(), $this->getArea());
	// 	$save = $insert->execute($arrdata);
	// }

	public function edit(){		

		$sql = "UPDATE proveedor SET nit=?,razsoc=?,ciu=?,dir=?,tel=?,email=?,area=?, paclave=?,valid=? ";
		$sql .= " WHERE idprov={$this->idprov};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getNit(), $this->getRazsoc(), $this->getCiu(), $this->getDir(), $this->getTel(), $this->getEmail(), $this->getArea(), $this->getPaclave(), $this->getValid());
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

	public function getMunicipio(){
		$sql = "SELECT m.ubiid AS codm, m.ubinom AS nomm, m.ubidepto AS codd, d.ubinom AS nomd FROM ubica AS m INNER JOIN ubica AS d ON m.ubidepto=d.ubiid ORDER BY m.ubinom;";
		// echo $sql;
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($rub);
		// die();
		return $rub;
	}
	public function getVal($parid){
		$sql = "SELECT valid, valnom, pre FROM valor WHERE parid='$parid' ORDER BY valnom;";
		// echo $sql;
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($rub);
		// die();
		return $rub;
	}
	
	public function getCiiu($idprov){
		$sql ="SELECT p.idprov, p.idciiu, c.codciiu, c.nomciiu FROM prociiu AS p INNER JOIN ciiu AS c ON p.idciiu=c.idciiu WHERE p.idprov=$idprov";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($sql);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getCiius(){
		$sql = 'SELECT idciiu AS idp, concat(substring(codciiu,2)," - ",nomciiu) AS nom2 FROM ciiu;';
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function saveCiiu(){
		$sql= "INSERT INTO prociiu(idprov, idciiu) VALUES (?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getIdprov(),$this->getIdciiu());
		 // echo "<br><br>".$sql."<br><br>";
		 // var_dump($arrdata);
		 // die();
		$save = $insert->execute($arrdata);
	}
	public function del(){
		$sql= "DELETE FROM prociiu WHERE idprov=? and idciiu=?";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getIdprov(),$this->getIdciiu());
		 //echo "<br><br>".$sql."<br><br>";
		 //var_dump($arrdata);
		 //die();
		$save = $insert->execute($arrdata);
	}

	public function totdoc(){
		$sql= "SELECT COUNT(valid) AS total FROM valor WHERE cdpmul=1 AND parid=24;";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		return $save;
	}

	public function tdocnit($idprov){
		$sql= "SELECT COUNT(iddoc) AS tdoc FROM docpro WHERE idprov=$idprov;";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		return $save;
	}

	public function busiddpa($id){
		$sql= "SELECT *  FROM detpaa WHERE iddpa=$id;";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		return $save;
	}

	public function saveconsul($fecha,$iddpa,$perid,$nomciiu){
		$sql = "INSERT INTO provbus (fecpb, iddpa, perid,filserv) VALUES ('$fecha',$iddpa,$perid,'$nomciiu') ";
		$save = $this->db->query($sql);		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function ultimaconsul(){		
		$sql = "select last_insert_id()";
		$execute = $this->db->query($sql);
		$conprov = $execute->fetchall(PDO::FETCH_ASSOC);		
		return $conprov;		
	}

	public function insDetConsul($idpb,$idprov){
		$sql = "INSERT INTO provbusd (idpb, idprov) VALUES ($idpb,'$idprov') ";
		$save = $this->db->query($sql);	

		// var_dump($sql);
		// die();	
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function editbusal($idpb){		
		$sql = "UPDATE provbus SET salvado=1 WHERE idpb=$idpb;";	
		$update= $this->db->prepare($sql);
		$save=$update->execute();

		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function histoconsul($iddpa,$perid){
		$sql= "SELECT pr.*, per.pernom, per.perape FROM provbus AS pr INNER JOIN persona AS per ON pr.perid=per.perid WHERE iddpa=$iddpa ORDER BY pr.fecpb DESC";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		return $save;
	}
}