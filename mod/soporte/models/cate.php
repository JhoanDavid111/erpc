<?php

class Cate{
	private $idcts;
	private $clasop;
	private $sersop;
	private $subcsop;
	private $tipprd;
	private $tipprb;
	private $n1;
	private $n2;
	private $n3;
	private $causop;
	private $nsol;
	private $afesop;
	private $obssop;

	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getIdcts() {
		return $this->idcts;
	}

	function getClasop() {
		return $this->clasop;
	}

	function getSersop() {
		return $this->sersop;
	}

	function getSubcsop() {
		return $this->subcsop;
	}

	function getTipprd() {
		return $this->tipprd;
	}

	function getTipprb() {
		return $this->tipprb;
	}
	
	function getN1() {
		return $this->n1;
	}

	function getN2() {
		return $this->n2;
	}

	function getN3() {
		return $this->n3;
	}	

	function getCausop() {
		return $this->causop;
	}
	function getNsol() {
		return $this->nsol;
	}
	function getAfesop() {
		return $this->afesop;
	}

	function getObssop() {
		return $this->obssop;
	}

//Metodos Set Guardan el dato
	function setIdcts($idcts) {
		$this->idcts = $idcts;
	}

	function setClasop($clasop) {
		$this->clasop = $clasop;
	}

	function setSersop($sersop) {
		$this->sersop = $sersop;
	}

	function setSubcsop($subcsop) {
		$this->subcsop = $subcsop;
	}

	function setTipprd($tipprd) {
		$this->tipprd = $tipprd;
	}

	function setTipprb($tipprb) {
		$this->tipprb = $tipprb;
	}

	function setN1($n1) {
		$this->n1 = $n1;
	}

	function setN2($n2) {
		$this->n2 = $n2;
	}

	function setN3($n3) {
		$this->n3 = $n3;
	}

	function setCausop($causop) {
		$this->causop = $causop;
	}
	function setNsol($nsol) {
		$this->nsol = $nsol;
	}
	function setAfesop($afesop) {
		$this->afesop = $afesop;
	}

	function setObssop($obssop) {
		$this->obssop = $obssop;
	}

//Metodos CRUD
	public function getAll(){
		$sql = "SELECT idcts, clasop, sersop, subcsop, tipprd, tipprb, n1, n2, n3, causop, nsol, afesop, obssop FROM catsop";
		$sql .= " ORDER BY tipprb,tipprd,subcsop,sersop,clasop";
		// echo "<br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($rub);
		// die();
		return $rub;
	}

	public function getOne(){
		$sql ="SELECT idcts, clasop, sersop, subcsop, tipprd, tipprb, n1, n2, n3, causop, nsol, afesop, obssop FROM catsop WHERE idcts = ".$this->idcts;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function save(){
		$sql= "INSERT INTO catsop(clasop, sersop, subcsop, tipprd, tipprb, n1, n2, n3, causop, nsol, afesop, obssop) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getClasop(), $this->getSersop(), $this->getSubcsop(),$this->getTipprd(), $this->getTipprb(), $this->getN1(), $this->getN2(), $this->getN3(), $this->getCausop(), $this->getNsol(), $this->getAfesop(), $this->getObssop());
	// echo $sql;
	// var_dump($arrdata);
 // die();
		$save = $insert->execute($arrdata);

	}

	public function edit(){		

		$sql = "UPDATE catsop SET clasop=?,sersop=?, subcsop=?, tipprd=?,tipprb=?,n1=?, n2=? , n3=?, causop=?, nsol=?, afesop=?, obssop=?";
		$sql .= " WHERE idcts={$this->idcts};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getClasop(), $this->getSersop(), $this->getSubcsop(),$this->getTipprd(), $this->getTipprb(), $this->getN1(), $this->getN2(), $this->getN3(), $this->getCausop(), $this->getNsol(), $this->getAfesop(), $this->getObssop());

		$save=$update->execute($arrdata);
		
			// echo "<br>".$sql."<br><br>";
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