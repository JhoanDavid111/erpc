<?php

class Pregunta{
	private $iddap;
	private $fecdap;
	private $temdap;
	private $valid;
	private $predap;
	private $perid;
	private $okjurdap;
	private $leido;
	private $tipo;
	private $rutdap;

	private $iddar;
	private $fecdar;
	private $resdar;
	private $ceras;

	private $fil1;
	private $fil2;

	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getiddap() {
		return $this->iddap;
	}

	function getfecdap() {
		return $this->fecdap;
	}

	function gettemdap() {
		return $this->temdap;
	}

	function getvalid() {
		return $this->valid;
	}

	function getpredap() {
		return $this->predap;
	}

	function getperid() {
		return $this->perid;
	}
	
	function getokjurdap() {
		return $this->okjurdap;
	}

	function getleido() {
		return $this->leido;
	}

	function gettipo() {
		return $this->tipo;
	}

	function getrutdap(){
		return $this->rutdap;
	}

	//------derautres
	function getiddar() {
		return $this->iddar;
	}
	function getfecdar() {
		return $this->fecdar;
	}
	function getresdar() {
		return $this->resdar;
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
	function setiddap($iddap) {
		$this->iddap = $iddap;
	}

	function setfecdap($fecdap) {
		$this->fecdap = $fecdap;
	}

	function settemdap($temdap) {
		$this->temdap = $temdap;
	}

	function setvalid($valid) {
		$this->valid = $valid;
	}

	function setpredap($predap) {
		$this->predap = $predap;
	}

	function setperid($perid) {
		$this->perid = $perid;
	}

	function setokjurdap($okjurdap) {
		$this->okjurdap = $okjurdap;
	}

	function setleido($leido) {
		$this->leido = $leido;
	}

	function settipo($tipo) {
		$this->tipo = $tipo;
	}

	function setrutdap($rutdap){
		$this->rutdap = $rutdap;
	}

	//------derautres
	function setiddar($iddar) {
		$this->iddar = $iddar;
	}
	function setfecdar($fecdar) {
		$this->fecdar = $fecdar;
	}
	function setresdar($resdar) {
		$this->resdar = $resdar;
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
	public function getAll($tipo){
		$sql = "SELECT s.*, v.*, v.valnom as tipoe FROM derautpre as s INNER JOIN valor as v ON s.valid=v.valid WHERE s.tipo='$tipo' AND s.leido=".$this->leido;
		if($this->getFil1() && $this->getFil2())
			$sql .= " AND date(fecdap) BETWEEN '".$this->getFil1()."' AND '".$this->getFil2()."'";
		if($_SESSION['pefid']==27)
			$sql .= " AND c.valid IN (SELECT valid FROM tipoxper WHERE perid=".$_SESSION['perid'].")";
		$sql .= " ORDER BY s.fecdap";
		//echo "<br>".$sql."<br><br>".$this->getFil1()."-".$this->getFil2()."-".$_SESSION['pefid']."-".$_SESSION['perid']."<br><br><br>";

		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	// $sql = "SELECT dt.*, rub.*, val.*, valu.* FROM detpaa dt "
 //  				. "INNER JOIN rubro rub ON dt.codrub = rub.codrub "
 //   				. "INNER JOIN valfin val ON dt.objdpa = val.vafid  "
 //   				. "INNER JOIN valor valu ON dt.area = valu.valid  "
   				
 //   				. " WHERE dt.idpaa = ".$this->idpaa;

	public function getAllres($tipo){
		$sql = "SELECT DISTINCT s.iddap AS Ndap, s.*, v.*, r.*, v.valnom as tipoe FROM derautpre as s INNER JOIN valor as v ON s.valid=v.valid LEFT JOIN derautres as r ON s.iddap=r.iddap WHERE s.tipo='$tipo'";
		$sql .= " AND s.leido=".$this->leido;
		if($this->getFil1() && $this->getFil2())
			$sql .= " AND date(fecdap) BETWEEN '".$this->getFil1()."' AND '".$this->getFil2()."'";
		if($_SESSION['pefid']==27)
			$sql .= " AND c.valid IN (SELECT valid FROM tipoxper WHERE perid=".$_SESSION['perid'].")";
		$sql .= " ORDER BY s.fecdap";
		//echo "<br>".$sql."<br><br>".$this->getFil1()."-".$this->getFil2()."-".$_SESSION['pefid']."-".$_SESSION['perid']."<br><br><br>";

		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	public function getOne(){
		$sql ="SELECT s.*, v.*, p.*, v.valnom as tipoe FROM derautpre as s INNER JOIN valor as v ON s.valid=v.valid INNER JOIN persona as p ON s.perid=p.perid WHERE s.tipo='te' AND iddap=".$this->iddap;
		$execute = $this->db->query($sql);
		//echo $sql;
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getAllVal($parid, $od="as"){
		$sql ="SELECT * FROM valor WHERE parid = ".$parid." ORDER BY valnom";
		if($od=="ds") $sql .= " DESC;";
		//echo $sql;
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getAllPer(){
		$sql ="SELECT perid, contipo(pernom,' ', perape) AS nom FROM persona WHERE actemp=1 AND depid=1024 ORDER BY pernom";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}
	public function save(){
		$sql= "INSERT INTO derautpre(fecdap, temdap, valid, predap, perid, okjurdap, leido, tipo, rutdap) VALUES (?,?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getfecdap(), $this->gettemdap(), $this->getvalid(),$this->getpredap(), $this->getperid(), $this->getokjurdap(), $this->getleido(), $this->gettipo(), $this->getrutdap());
	// echo $sql;
	// var_dump($arrdata);
 // die();
		$save = $insert->execute($arrdata);

	}

	public function edit(){		

		$sql = "UPDATE derautpre SET fecdap=?,temdap=?, valid=?, predap=?,perid=?,okjurdap=?, leido=? , tipo=?, rutdap=?";
		$sql .= " WHERE iddap={$this->iddap};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getfecdap(), $this->gettemdap(),$this->getvalid(), $this->getpredap(), $this->getperid(), $this->getokjurdap(), $this->getleido(), $this->gettipo(), $this->rutdap());
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

		$sql = "UPDATE derautpre SET leido=? ";
		$sql .= " WHERE iddap={$this->iddap};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getleido());
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
		$sql = "SELECT a.* FROM derautres AS a WHERE a.iddap=".$this->iddap." ORDER BY a.fecdar";
		//echo $sql;
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	public function getOneAsi(){
		$sql = "SELECT a.*, v.* FROM derautres AS a INNER JOIN valor AS v ON a.perid=v.perid WHERE a.iddap=".$this->iddap." ORDER BY fecdar";
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	public function saverp(){
		////INSERT INTO `derautres`(`iddar`, `iddap`, `fecdar`, `resdar`, `leido`)
		$sql= "INSERT INTO derautres(iddap, fecdar, resdar, leido) VALUES (?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getiddap(), $this->getfecdar(),$this->getresdar(), $this->getleido());
		// 	echo $sql;
		// 	var_dump($arrdata);
		// die();
		$save = $insert->execute($arrdata);
	}


}