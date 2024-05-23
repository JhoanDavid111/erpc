<?php

class Soporte{
	private $idst;
	private $fecsst;
	private $nomsst;
	private $area;
	private $desst;
	private $telst;
	private $rutst;
	private $cerst;
	private $cat;

	private $idas;
	private $perid;
	private $fecas;
	private $desas;
	private $ceras;

	private $fil1;
	private $fil2;

	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getIdst() {
		return $this->idst;
	}

	function getFecsst() {
		return $this->fecsst;
	}

	function getNomsst() {
		return $this->nomsst;
	}

	function getArea() {
		return $this->area;
	}

	function getDesst() {
		return $this->desst;
	}

	function getTelst() {
		return $this->telst;
	}
	
	function getRutst() {
		return $this->rutst;
	}

	function getCerst() {
		return $this->cerst;
	}

	function getCat() {
		return $this->cat;
	}	

	//------Asisop
	function getIdas() {
		return $this->idas;
	}
	function getPerid() {
		return $this->perid;
	}
	function getFecas() {
		return $this->fecas;
	}
	function getDesas() {
		return $this->desas;
	}
	function getCeras() {
		return $this->ceras;
	}

	function getFil1() {
		return $this->fil1;
	}
	function getFil2() {
		return $this->fil2;
	}
//Metodos Set Guardan el dato
	function setIdst($idst) {
		$this->idst = $idst;
	}

	function setFecsst($fecsst) {
		$this->fecsst = $fecsst;
	}

	function setNomsst($nomsst) {
		$this->nomsst = $nomsst;
	}

	function setArea($area) {
		$this->area = $area;
	}

	function setDesst($desst) {
		$this->desst = $desst;
	}

	function setTelst($telst) {
		$this->telst = $telst;
	}

	function setRutst($rutst) {
		$this->rutst = $rutst;
	}

	function setCerst($cerst) {
		$this->cerst = $cerst;
	}

	function setCat($cat) {
		$this->cat = $cat;
	}

	//------Asisop
	function setIdas($idas) {
		$this->idas = $idas;
	}
	function setPerid($perid) {
		$this->perid = $perid;
	}
	function setFecas($fecas) {
		$this->fecas = $fecas;
	}
	function setDesas($desas) {
		$this->desas = $desas;
	}
	function setCeras($ceras) {
		$this->ceras = $ceras;
	}

	function setFil1($fil1) {
		$this->fil1 = $fil1;
	}
	function setFil2($fil2) {
		$this->fil2 = $fil2;
	}

//Metodos CRUD
	public function getAll(){
		$sql = "SELECT s.*, v.*, c.valnom as cate FROM soporte as s INNER JOIN valor as v ON s.area=v.valid INNER JOIN valor as c ON s.cat=c.valid WHERE cerst=".$this->cerst;
		if($this->getFil1() && $this->getFil2())
			$sql .= " AND date(fecsst) BETWEEN '".$this->getFil1()."' AND '".$this->getFil2()."'";
		if($_SESSION['pefid']==27)
			$sql .= " AND c.valid IN (SELECT valid FROM catxper WHERE perid=".$_SESSION['perid'].")";
		$sql .= " ORDER BY s.fecsst";
		// echo "<br>".$sql."<br><br>".$this->getFil1()."-".$this->getFil2()."-".$_SESSION['pefid']."-".$_SESSION['perid']."<br><br><br>";

		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	public function getOne(){
		$sql ="SELECT s.*, v.*, c.valnom as cate FROM soporte as s INNER JOIN valor as v ON s.area=v.valid INNER JOIN valor as c ON s.cat=c.valid WHERE idst = ".$this->idst;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getAllVal($parid, $od="as"){
		$sql ="SELECT * FROM valor WHERE parid = ".$parid." ORDER BY valnom";
		if($od=="ds") $sql .= " DESC;";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getAllPer(){
		$sql ="SELECT perid, concat(pernom,' ', perape) AS nom FROM persona WHERE actemp=1 AND depid=1024 ORDER BY pernom";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}
	public function save(){
		$sql= "INSERT INTO soporte(fecsst, nomsst, area, desst, telst, rutst, cerst, cat) VALUES (?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getFecsst(), $this->getNomsst(), $this->getArea(),$this->getDesst(), $this->getTelst(), $this->getRutst(), $this->getCerst(), $this->getCat());
	// echo $sql;
	// var_dump($arrdata);
 // die();
		$save = $insert->execute($arrdata);

	}

	public function edit(){		

		$sql = "UPDATE soporte SET fecsst=?,nomsst=?, area=?, desst=?,telst=?,rutst=?, cerst=? , cat=?";
		$sql .= " WHERE idst={$this->idst};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getFecsst(), $this->getNomsst(),$this->getArea(), $this->getDesst(), $this->getTelst(), $this->getRutst(), $this->getCerst(), $this->getCat());
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

	public function editest(){		

		$sql = "UPDATE soporte SET cerst=? ";
		$sql .= " WHERE idst={$this->idst};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getCerst());
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

//Asistente
	
	public function getAllAsi(){
		$sql = "SELECT a.*, v.* FROM asisop AS a INNER JOIN persona AS v ON a.perid=v.perid WHERE a.idst=".$this->idst." ORDER BY fecas";
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	public function getOneAsi(){
		$sql = "SELECT a.*, v.* FROM asisop AS a INNER JOIN valor AS v ON a.perid=v.perid WHERE a.idst=".$this->idst." ORDER BY fecas";
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	public function saverp(){
		$sql= "INSERT INTO asisop(idst, perid, fecas, desas, ceras) VALUES (?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getIdst(), $this->getPerid(), $this->getFecas(),$this->getDesas(), $this->getCeras());
		// 	echo $sql;
		// 	var_dump($arrdata);
		// die();
		$save = $insert->execute($arrdata);
	}


}