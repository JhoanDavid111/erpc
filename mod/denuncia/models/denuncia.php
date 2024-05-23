<?php

class Denuncia{
	private $denid;
	private $denfec;
	private $denano;
	private $denpro;
	private $dennom;
	private $denape;
	private $denide;
	private $dentel;
	private $denema;
	private $dentip;
	private $dendes;
	private $denarc;

	private $idobs;
	private $perid;
	private $denobs;
	private $denest;

	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getDenid() {
		return $this->denid;
	}

	function getDenfec() {
		return $this->denfec;
	}

	function getDenano() {
		return $this->denano;
	}

	function getDenpro() {
		return $this->denpro;
	}

	function getDennom() {
		return $this->dennom;
	}
	
	function getDenape() {
		return $this->denape;
	}

	function getDenide() {
		return $this->denide;
	}

	function getDentel() {
		return $this->dentel;
	}

	function getDenema() {
		return $this->denema;
	}

	function getDentip() {
		return $this->dentip;
	}

	function getDendes() {
		return $this->dendes;
	}

	function getDenarc() {
		return $this->denarc;
	}

	function getIdobs(){
		return $this->idobs;
	}
	function getPerid(){
		return $this->perid;
	}
	function getDenobs(){
		return $this->denobs;
	}
	function getDenest(){
		return $this->denest;
	}

//Metodos Set Guardan el dato
	function setDenfec($denfec) {
		$this->denfec = $denfec;
	}

	function setDenid($denid) {
		$this->denid = $denid;
	}

	function setDenano($denano) {
		$this->denano = $denano;
	}

	function setDenpro($denpro) {
		$this->denpro = $denpro;
	}

	function setDennom($dennom) {
		$this->dennom = $dennom;
	}

	function setDenape($denape) {
		$this->denape = $denape;
	}

	function setDenide($denide) {
		$this->denide = $denide;
	}

	function setDentel($dentel) {
		$this->dentel = $dentel;
	}

	function setDenema($denema) {
		$this->denema = $denema;
	}

	function setDentip($dentip) {
		$this->dentip = $dentip;
	}

	function setDendes($dendes) {
		$this->dendes = $dendes;
	}

	function setDenarc($denarc) {
		$this->denarc = $denarc;
	}

	function setIdobs($idobs){
		$this->idobs = $idobs;
	}
	function setPerid($perid){
		$this->perid = $perid;
	}
	function setDenobs($denobs){
		$this->denobs = $denobs;
	}
	function setDenest($denest){
		$this->denest = $denest;
	}

//Metodos CRUD
	public function getAll(){
		$sql = "SELECT d.*, v.* FROM denuncia as d INNER JOIN valor as v ON d.dentip=v.valid ORDER BY d.denfec DESC";		
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	public function getOne(){
		$sql ="SELECT d.*, v.* FROM denuncia as d INNER JOIN valor as v ON d.dentip=v.valid WHERE denid = ".$this->denid;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}
	
	public function getObs(){
		$sql ="SELECT d.idobs, d.denid, d.perid, d.denfec, d.denobs, d.denest, v.valnom FROM denobs AS d INNER JOIN valor AS v ON d.denest=v.valid WHERE d.denid=".$this->denid;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}
	public function getAllVal($parid){
		$sql ="SELECT * FROM valor WHERE parid = ".$parid." ORDER BY valnom";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function save(){
		$sql= "INSERT INTO denuncia(denano, denfec, denpro, dennom, denape, denide, dentel, denema, dentip, dendes, denarc) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getDenano(),$this->getDenfec(), $this->getDenpro(), $this->getDennom(), $this->getDenape(), $this->getDenide(), $this->getDentel(), $this->getDenema(), $this->getDentip(), $this->getDendes(), $this->getDenarc());
// 	echo $sql;
// 	var_dump($arrdata);
// die();
		$save = $insert->execute($arrdata);
	}

	public function saveObs(){
		$sql= "INSERT INTO denobs(denid, perid, denfec, denobs, denest) VALUES (?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getDenid(), $this->getPerid(), $this->getDenfec(), $this->getDenobs(), $this->getDenest());
		// echo $sql;
		// echo "<br>'".$this->getDenid()."','".$this->getPerid()."','".$this->getDenfec()."','".$this->getDenobs()."','".$this->getDenest()."'<br>";
		// var_dump($arrdata);
		// die();
		$save = $insert->execute($arrdata);
	}

	public function edit(){		

		$sql = "UPDATE denuncia SET denano=?, denfec=?,denpro=?,dennom=?,denape=?,denide=?, dentel=?, denema=?, dentip=?, dendes=?, denarc=? ";
		$sql .= " WHERE denid={$this->denid};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getDenano(),$this->getDenfec(), $this->getDenpro(), $this->getDennom(), $this->getDenape(), $this->getDenide(), $this->getDentel(), $this->getDenema(), $this->getDentip(), $this->getDendes(), $this->getDenarc());
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

	public function delObs(){
		$sql ="DELETE FROM denobs WHERE idobs=".$this->idobs;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
	}
}