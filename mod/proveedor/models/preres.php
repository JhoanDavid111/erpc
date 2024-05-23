<?php

class Preres{

	private $idepr;
	private $txtepr;
	private $tipepr;

	private $idere;
	private $txtere;
	private $punere;

	private $idepe;
	private $calepe;

	private $idcali;
	private $idprov;
	private $fecha;
	private $califica;
	private $perid;


	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	

//Metodos Get Devuelven el dato
	function getIdepr() {
		return $this->idepr;
	}
	function getTxtepr() {
		return $this->txtepr;
	}
	function getTipepr() {
		return $this->tipepr;
	}

	function getIdere() {
		return $this->idere;
	}
	function getTxtere() {
		return $this->txtere;
	}
	function getPunere() {
		return $this->punere;
	}

	function getIdepe() {
		return $this->idepe;
	}
	function getCalepe() {
		return $this->calepe;
	}

	function getIdcali() {
		return $this->idcali;
	}
	function getIdprov(){
		return $this->idprov;
	}
	function getFecha(){
		return $this->fecha;
	}
	function getCalifica(){
		return $this->califica;
	}
	function getPerid(){
		return $this->perid;
	}

//Metodos Set Guardan el dato

	function setIdepr($idepr) {
		$this->idepr = $idepr;
	}
	function setTxtepr($txtepr) {
		$this->txtepr = $txtepr;
	}
	function setTipepr($tipepr) {
		$this->tipepr = $tipepr;
	}

	function setIdere($idere) {
		$this->idere = $idere;
	}
	function setTxtere($txtere) {
		$this->txtere = $txtere;
	}
	function setPunere($punere) {
		$this->punere = $punere;
	}

	function setIdepe($idepe) {
		$this->idepe = $idepe;
	}
	function setCalepe($calepe) {
		$this->calepe = $calepe;
	}

	function setIdcali($idcali) {
		$this->idcali = $idcali;
	}
	function setIdprov($idprov){
		$this->idprov = $idprov;
	}
	function setFecha($fecha){
		$this->fecha = $fecha;
	}
	function setCalifica($califica){
		$this->califica = $califica;
	}
	function setPerid($perid){
		$this->perid = $perid;
	}

//Metodos CRUD
	public function getAll($tipp=NULL){
		$sql = "SELECT e.idepr, e.txtepr, e.tipepr, v.valnom FROM evapre AS e INNER JOIN valor AS v ON e.tipepr=v.valid";
		if($tipp)
			$sql .= " WHERE e.tipepr IN (".$tipp.")";
		//echo $sql;
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($rub);
		// die();
		return $rub;
	}

	public function getOne(){
		$sql = "SELECT e.idepr, e.txtepr, e.tipepr, v.valnom FROM evapre AS e INNER JOIN valor AS v ON e.tipepr=v.valid WHERE idepr=".$this->getIdepr();
		//echo $sql;

		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}
	
	public function save(){
		try {
			$sql= "INSERT INTO evapre(idepr, txtepr, tipepr) VALUES (?,?,?)";
			$insert = $this->db->prepare($sql);
			$arrdata = array($this->getIdepr(),$this->getTxtepr(), $this->getTipepr());
			// echo "<br><br>".$sql."<br><br>";
			// var_dump($arrdata);
			// die();
		    $save = $insert->execute($arrdata);
		} catch (PDOException $e) {
		    echo 'Falló la conexión: '.$e->getMessage();
		}
	}

	public function edit(){		
		$sql = "UPDATE evapre SET txtepr=?,tipepr=? ";
		$sql .= " WHERE idepr={$this->idepr};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getTxtepr(), $this->getTipepr());
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

	public function getVal($parid){
		$sql = "SELECT valid, valnom FROM valor WHERE parid='$parid'";
		// echo $sql;
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($rub);
		// die();
		return $rub;
	}
	
	public function getResp($idepr){
		$sql ="SELECT idere, idepr, txtere, punere FROM evares WHERE idepr=$idepr ORDER BY punere DESC";
		// var_dump($sql);
		// $error= $this->db->errorInfo();
		// die();
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		
		return $save;
	}

	public function saveResp(){
		$sql= "INSERT INTO evares(idepr, txtere, punere) VALUES (?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getIdepr(),$this->getTxtere(),$this->getPunere());
		 // echo "<br><br>".$sql."<br><br>";
		 // var_dump($arrdata);
		 // die();
		$save = $insert->execute($arrdata);
	}
	public function del(){
		$sql= "DELETE FROM evares WHERE idere=?";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getIdere());
		 //echo "<br><br>".$sql."<br><br>";
		 //var_dump($arrdata);
		 //die();
		$save = $insert->execute($arrdata);
	}
//Evaluación desagregada
	public function saveEva(){
		$sql= "INSERT INTO evaluprov(idepr, idere, calepe, idcali) VALUES (?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getIdepr(),$this->getIdere(),$this->getCalepe(),$this->getIdcali());
		 // echo "<br><br>".$sql."<br><br>";
		 // var_dump($arrdata);
		 // die();
		$save = $insert->execute($arrdata);
	}

	public function getPunres($idere){
		$sql ="SELECT punere FROM evares WHERE idere=$idere";
		// var_dump($sql);
		// $error= $this->db->errorInfo();
		// die();
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		
		return $save;
	}
	
	public function getPromEva($idcali){
		$sql ="SELECT AVG(calepe) as prom FROM evaluprov WHERE idcali=$idcali";
		// var_dump($sql);
		// $error= $this->db->errorInfo();
		// die();
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		
		return $save;
	}

	public function getEva(){
		$sql = "SELECT v.idepe, v.idepr, p.txtepr, v.idere, v.calepe, v.idcali FROM evaluprov AS v INNER JOIN evapre AS p ON v.idepr=p.idepr INNER JOIN evares AS e ON v.idere=e.idere WHERE idcali=".$this->getIdcali();
		//echo $sql;

		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getProv(){
		$sql = "SELECT idprov, nit, razsoc, tel, email FROM proveedor WHERE idprov=".$this->getIdprov();
		//echo $sql;

		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}
//Calificación total
	public function saveCali(){
		$sql= "INSERT INTO provcali(idprov, fecha, califica, perid) VALUES (?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getIdprov(),$this->getFecha(),$this->getCalifica(),$this->getPerid());
		 // echo "<br><br>".$sql."<br><br>";
		 // var_dump($arrdata);
		 // die();
		$save = $insert->execute($arrdata);
	}

	public function getLastIdcali(){		
		$sql = "SELECT last_insert_id() AS idc FROM provcali";
		// $sql = "SELECT last_insert_id()";
		$execute = $this->db->query($sql);
		$conprov = $execute->fetchall(PDO::FETCH_ASSOC);		
		return $conprov;		
	}

	public function editCali(){
		$sql= "UPDATE provcali SET califica=? WHERE idcali=?";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getCalifica(),$this->getIdcali());
		 // echo "<br><br>".$sql."<br><br>";
		 // var_dump($arrdata);
		 // die();
		$save = $insert->execute($arrdata);
	}

	public function getHistori(){
		$sql = "SELECT r.idprov, r.nit, r.razsoc, r.tel, r.email, c.idcali, c.fecha, c.califica, c.perid, p.pernom, p.perape, p.peremail, p.depid FROM proveedor AS r INNER JOIN provcali AS c ON r.idprov=c.idprov INNER JOIN persona AS p ON c.perid=p.perid WHERE r.idprov=".$this->getIdprov();
		// echo $sql;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}
}