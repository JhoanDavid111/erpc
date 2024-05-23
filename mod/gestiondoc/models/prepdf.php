<?php
require_once '../../../config/db.php';
class Prepdf{

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


	//private $db;
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

	public function getCali(){
		$sql = "SELECT r.idprov, r.nit, r.razsoc, r.tel, r.email, c.idcali, c.fecha, c.califica, c.perid, p.pernom, p.perape, p.peremail, p.depid FROM proveedor AS r INNER JOIN provcali AS c ON r.idprov=c.idprov INNER JOIN persona AS p ON c.perid=p.perid WHERE c.idcali=".$this->getIdcali();
		//echo $sql;

		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getPreguntas(){
		$sql = "SELECT p.idepe, p.idepr, e.txtepr, e.tipepr, p.idere, p.calepe, p.idcali FROM evaluprov AS p INNER JOIN evapre AS e ON p.idepr=e.idepr WHERE p.idcali=".$this->getIdcali();
		//echo $sql;

		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getRespu(){
		$sql = "SELECT idere, idepr, txtere, punere FROM evares WHERE idepr=".$this->getIdepr();
		//echo $sql;

		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}
	public function getPreguntasProv(){
		$sql = "SELECT c.idprov, p.idepr, e.txtepr, e.tipepr, AVG(p.calepe) AS calif FROM provcali AS c INNER JOIN evaluprov AS p ON c.idcali=p.idcali INNER JOIN evapre AS e ON p.idepr=e.idepr WHERE c.idprov=".$this->getIdprov()." GROUP BY c.idprov, p.idepr, e.txtepr, e.tipepr;";
		//echo $sql."<br>";

		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getCaliProv(){
		$sql = "SELECT r.idprov, r.nit, r.razsoc, r.tel, r.email, AVG(c.califica) AS ct FROM proveedor AS r INNER JOIN provcali AS c ON r.idprov=c.idprov INNER JOIN persona AS p ON c.perid=p.perid WHERE r.idprov=".$this->getIdprov()." GROUP BY r.idprov, r.nit, r.razsoc, r.tel, r.email;";
		//echo $sql;

		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getCaliProvT(){
		$sql = "SELECT r.idprov, c.idcali, c.fecha, c.califica, c.perid, p.pernom, p.perape, p.peremail, p.depid FROM proveedor AS r INNER JOIN provcali AS c ON r.idprov=c.idprov INNER JOIN persona AS p ON c.perid=p.perid WHERE r.idprov=".$this->getIdprov();
		//echo $sql."<br>";

		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}
}