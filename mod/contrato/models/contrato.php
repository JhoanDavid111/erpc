<?php

class Contrato{
	private $idcon;
	private $feccon;
	private $perid;
	private $valid;
	private $nomcon;
	private $peridcon;
	private $objcon;
	private $parid;
	private $linexpcon;
	private $lineccon;
	private $pubseccon;
	private $enlseccon;
	private $noseccon;
	private $estseccon;
	private $nocon;
	private $elicon;

	private $fectra;
	private $obstra;

	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getIdcon() {
		return $this->idcon;
	}

	function getFeccon() {
		return $this->feccon;
	}

	function getPerid() {
		return $this->perid;
	}

	function getValid() {
		return $this->valid;
	}

	function getNomcon() {
		return $this->nomcon;
	}
	
	function getPeridcon() {
		return $this->peridcon;
	}
	
	function getObjcon() {
		return $this->objcon;
	}

	function getParid() {
		return $this->parid;
	}

	function getLinexpcon() {
		return $this->linexpcon;
	}

	function getLineccon() {
		return $this->lineccon;
	}

	function getPubseccon() {
		return $this->pubseccon;
	}

	function getEnlseccon() {
		return $this->enlseccon;
	}

	function getNoseccon() {
		return $this->noseccon;
	}

	function getEstseccon() {
		return $this->estseccon;
	}

	function getNocon() {
		return $this->nocon;
	}

	function getElicon() {
		return $this->elicon;
	}



	function getFectra(){
		return $this->fectra;
	}

	function getObstra(){
		return $this->obstra;
	}

//Metodos Set Guardan el dato
	function setFeccon($feccon) {
		$this->feccon = $feccon;
	}

	function setIdcon($idcon) {
		$this->idcon = $idcon;
	}

	function setPerid($perid) {
		$this->perid = $perid;
	}

	function setValid($valid) {
		$this->valid = $valid;
	}

	function setNomcon($nomcon) {
		$this->nomcon = $nomcon;
	}

	function setPeridcon($peridcon) {
		$this->peridcon = $peridcon;
	}

	function setObjcon($objcon) {
		$this->objcon = $objcon;
	}

	function setParid($parid) {
		$this->parid = $parid;
	}

	function setLinexpcon($linexpcon) {
		$this->linexpcon = $linexpcon;
	}

	function SetLineccon($lineccon) {
		$this->lineccon = $lineccon;
	}

	function setPubseccon($pubseccon) {
		$this->pubseccon = $pubseccon;
	}

	function setEnlseccon($enlseccon) {
		$this->enlseccon = $enlseccon;
	}

	function setNoseccon($noseccon) {
		$this->noseccon = $noseccon;
	}

	function setEstseccon($estseccon) {
		$this->estseccon = $estseccon;
	}

	function setNocon($nocon) {
		$this->nocon = $nocon;
	}

	function setElicon($elicon) {
		$this->elicon = $elicon;
	}



	function setFectra($fectra){
		$this->fectra = $fectra;
	}

	function setObstra($obstra){
		$this->obstra = $obstra;
	}

//Metodos CRUD
	public function getAll($ano,$est,$abo){
		$sql = "SELECT c.idcon, c.feccon, c.perid, e.nodocemp, e.pernom, e.perape, c.nomcon, c.valid as codarea, a.valnom as nomarea, c.objcon, c.parid, n.parnom, c.linexpcon, c.lineccon, n.parfijo, c.pubseccon, c.enlseccon, c.noseccon, c.estseccon, c.nocon, t.idtra, t.idcon, t.fectra, t.valid as codest, v.valnom as nomest, t.obstra, t.leido FROM contrato AS c INNER JOIN persona AS e ON c.perid=e.perid INNER JOIN valor AS a ON c.valid=a.valid INNER JOIN parame AS n ON c.parid=n.parid INNER JOIN trazabilidad AS t ON c.idcon=t.idcon INNER JOIN valor AS v ON t.valid=v.valid WHERE c.elicon=1 AND YEAR(t.fectra)='".$ano."' AND t.valid NOT IN (64,68) AND t.fectra=(SELECT MAX(d.fectra) FROM trazabilidad as d WHERE d.idcon=c.idcon)";
		if($est){
			$sql .= " AND t.valid='".$est."'";
		}
		if($abo){
			$sql .= " AND c.perid='".$abo."'";
		}
		if($_SESSION['pefid']==13){
			$sql .= " AND c.perid='".$_SESSION['perid']."'";
		}
		if($_SESSION['pefid']==17){
			$sql .= " AND c.valid='".$_SESSION['depid']."'";
		}
		if($_SESSION['pefid']==16 OR $_SESSION['pefid']==18){
			$sql .= " AND t.valid IN (SELECT valid FROM editexp WHERE pefid='".$_SESSION['pefid']."')";
		}
		//echo $sql;
		// if($filtro OR $filtro2 OR $filtro3 OR $filtro4 OR $filtro5 OR $filtro6){
		// 	if($filtro=="0000-00-00" OR $filtro2=="0000-00-00"){
		// 		$filtro = NULL;
		// 		$filtro2 = NULL;
		// 	}
		// 	if($filtro AND $filtro2)
		// 		$sql .= " AND DATE(t.fectra) BETWEEN '$filtro' AND '$filtro2'";
		// 	if($filtro3){
		// 		$filtro3 = "%".$filtro3."%";
		// 		$sql .= " AND (c.nocon LIKE '$filtro3' OR c.nomcon LIKE '$filtro3' OR c.objcon LIKE '$filtro3')";
		// 	}
		// 	if($filtro4)
		// 		$sql .= " AND c.idem='$filtro4'";
		// 	if($filtro5)
		// 		$sql .= " AND MONTH(t.fectra)='$filtro5'";
		// 	if($filtro6)
		// 		$sql .= " AND v.codval IN ($filtro6)";
		// }
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	public function getAllFR($ano,$est,$abo){
		$sql = "SELECT c.idcon, c.feccon, c.perid, e.nodocemp, e.pernom, e.perape, c.nomcon, c.valid as codarea, a.valnom as nomarea, c.objcon, c.parid, n.parnom, c.linexpcon, c.lineccon, n.parfijo, c.pubseccon, c.enlseccon, c.noseccon, c.estseccon, c.nocon, t.idtra, t.idcon, t.fectra, t.valid as codest, v.valnom as nomest, t.obstra, t.leido FROM contrato AS c INNER JOIN persona AS e ON c.perid=e.perid INNER JOIN valor AS a ON c.valid=a.valid INNER JOIN parame AS n ON c.parid=n.parid INNER JOIN trazabilidad AS t ON c.idcon=t.idcon INNER JOIN valor AS v ON t.valid=v.valid WHERE c.elicon=1 AND YEAR(t.fectra)='".$ano."' AND t.valid IN (64,68) AND t.fectra=(SELECT MAX(d.fectra) FROM trazabilidad as d WHERE d.idcon=c.idcon)";
		if($est){
			$sql .= " AND t.valid='".$est."'";
		}
		if($abo){
			$sql .= " AND c.perid='".$abo."'";
		}
		if($_SESSION['pefid']==13){
			$sql .= " AND c.perid='".$_SESSION['perid']."'";
		}
		if($_SESSION['pefid']==17){
			$sql .= " AND c.valid='".$_SESSION['depid']."'";
		}

		// if($filtro OR $filtro2 OR $filtro3 OR $filtro4 OR $filtro5 OR $filtro6){
		// 	if($filtro=="0000-00-00" OR $filtro2=="0000-00-00"){
		// 		$filtro = NULL;
		// 		$filtro2 = NULL;
		// 	}
		// 	if($filtro AND $filtro2)
		// 		$sql .= " AND DATE(t.fectra) BETWEEN '$filtro' AND '$filtro2'";
		// 	if($filtro3){
		// 		$filtro3 = "%".$filtro3."%";
		// 		$sql .= " AND (c.nocon LIKE '$filtro3' OR c.nomcon LIKE '$filtro3' OR c.objcon LIKE '$filtro3')";
		// 	}
		// 	if($filtro4)
		// 		$sql .= " AND c.idem='$filtro4'";
		// 	if($filtro5)
		// 		$sql .= " AND MONTH(t.fectra)='$filtro5'";
		// 	if($filtro6)
		// 		$sql .= " AND v.codval IN ($filtro6)";
		// }
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	public function getAllPP(){
		$sql = "SELECT c.idcon, c.feccon, c.perid, e.nodocemp, e.pernom, e.perape, c.nomcon, c.valid as codarea, a.valnom as nomarea, c.objcon, c.parid, n.parnom, c.linexpcon, c.lineccon, n.parfijo, c.pubseccon, c.enlseccon, c.noseccon, c.estseccon, c.nocon, t.idtra, t.idcon, t.fectra, t.valid as codest, v.valnom as nomest, t.obstra, t.leido FROM contrato AS c INNER JOIN persona AS e ON c.perid=e.perid INNER JOIN valor AS a ON c.valid=a.valid INNER JOIN parame AS n ON c.parid=n.parid INNER JOIN trazabilidad AS t ON c.idcon=t.idcon INNER JOIN valor AS v ON t.valid=v.valid WHERE c.elicon!=1 AND t.fectra=(SELECT MAX(d.fectra) FROM trazabilidad as d WHERE d.idcon=c.idcon)";
		if($_SESSION['pefid']==13){
			$sql .= " AND c.perid='".$_SESSION['perid']."'";
		}
		if($_SESSION['pefid']==17){
			$sql .= " AND c.valid='".$_SESSION['depid']."'";
		}
		$sql .= " ORDER BY t.fectra DESC";
		// if($filtro OR $filtro2 OR $filtro3 OR $filtro4 OR $filtro5 OR $filtro6){
		// 	if($filtro=="0000-00-00" OR $filtro2=="0000-00-00"){
		// 		$filtro = NULL;
		// 		$filtro2 = NULL;
		// 	}
		// 	if($filtro AND $filtro2)
		// 		$sql .= " AND DATE(t.fectra) BETWEEN '$filtro' AND '$filtro2'";
		// 	if($filtro3){
		// 		$filtro3 = "%".$filtro3."%";
		// 		$sql .= " AND (c.nocon LIKE '$filtro3' OR c.nomcon LIKE '$filtro3' OR c.objcon LIKE '$filtro3')";
		// 	}
		// 	if($filtro4)
		// 		$sql .= " AND c.idem='$filtro4'";
		// 	if($filtro5)
		// 		$sql .= " AND MONTH(t.fectra)='$filtro5'";
		// 	if($filtro6)
		// 		$sql .= " AND v.codval IN ($filtro6)";
		// }
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	public function getOne($ano){
		$sql = "SELECT c.idcon, c.feccon, c.perid, e.nodocemp, e.pernom, e.perape, c.nomcon, c.valid as codarea, a.valnom as nomarea, c.objcon, c.parid, n.parnom, c.linexpcon, c.lineccon, n.parfijo, c.pubseccon, c.enlseccon, c.noseccon, c.estseccon, c.nocon, t.idtra, t.idcon, t.fectra, t.valid as codest, v.valnom as nomest, t.obstra, t.leido FROM contrato AS c INNER JOIN persona AS e ON c.perid=e.perid INNER JOIN valor AS a ON c.valid=a.valid INNER JOIN parame AS n ON c.parid=n.parid INNER JOIN trazabilidad AS t ON c.idcon=t.idcon INNER JOIN valor AS v ON t.valid=v.valid WHERE c.elicon=1 AND YEAR(t.fectra)='".$ano."' AND t.valid NOT IN (24,28) AND t.fectra=(SELECT MAX(d.fectra) FROM trazabilidad as d WHERE d.idcon=c.idcon)";
		$sql .= " AND t.idcon=".$this->idcon;

		//echo "<br><br><br>".$sql."<br>'".$ano."','".$this->idcon."'<br><br><br>"; 
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

	public function selmailto($per){
		$sql ="SELECT emaemp FROM persona WHERE pefid=$per";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function selmailtoid($perid){
		$sql ="SELECT emaemp FROM persona WHERE perid=$perid";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function selsop2($feccon, $perid, $nomcon, $valid, $parid, $linexpcon){
		$sql ="SELECT idcon FROM contrato WHERE feccon='$feccon' AND perid='$perid' AND nomcon='$nomcon' AND valid='$valid' AND parid='$parid' AND linexpcon='$linexpcon'";
		//echo "<br><br><br>".$sql."<br>'".$feccon."','".$perid."','".$nomcon."','".$valid."','".$parid."','".$linexpcon."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function elipag($idcon){
		$sql ="DELETE FROM contrato WHERE idcon=$idcon";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function elitra($idcon){
		$sql ="DELETE FROM trazabilidad WHERE idcon=$idcon";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function selval($parid){
		$sql ="SELECT valid, valnom FROM valor WHERE parid=$parid ORDER BY valnom;";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function selvalpef($pefid){
		$sql ="SELECT v.valid, v.valnom FROM valor AS v INNER JOIN editexp AS e ON v.valid=e.valid WHERE e.pefid=$pefid ORDER BY v.valnom;";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function selAno(){
		$sql ="SELECT DISTINCT(YEAR(fectra)) AS ano FROM trazabilidad ORDER BY YEAR(fectra) DESC";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function selmes(){
		$sql ="SELECT DISTINCT(MONTH(fectra)) AS fecha FROM trazabilidad;";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function selfec(){
		$sql ="SELECT DISTINCT(DATE(fectra)) AS fecha FROM trazabilidad ORDER BY DATE(fectra);";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}


	//consultas Plugins
	public function setotact($proceso, $ano, $mes, $perid, $pefid){
		$sql="SELECT t.valid as codest, v.valnom as nomest, MONTH(c.feccon) AS mes, COUNT(c.idcon) AS cant FROM contrato AS c INNER JOIN persona AS e ON c.perid=e.perid INNER JOIN valor AS a ON c.valid=a.valid INNER JOIN parame AS n ON c.parid=n.parid INNER JOIN trazabilidad AS t ON c.idcon=t.idcon INNER JOIN valor AS v ON t.valid=v.valid WHERE c.elicon=1 AND t.fectra=(SELECT MAX(d.fectra) FROM trazabilidad as d WHERE d.idcon=c.idcon)";
		if($proceso==1)
			$sql.=" AND t.valid NOT IN (64,68)";
		if($proceso==2)
			$sql.=" AND t.valid IN (64,68)";
		if($ano)
			$sql.=" AND YEAR(t.fectra)=$ano";
		if($mes)
			$sql.=" AND MONTH(t.fectra)=$mes";
		if($pefid==13 OR $pefid==17)
			$sql.=" AND c.perid=$perid";

		$sql.=" GROUP BY t.valid, v.valnom ORDER BY COUNT(c.idcon) DESC";
		//echo "<br><br><br>".$sql."<br>'".$proceso."','".$ano."','".$mes."','".$perid."','".$pefid."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function setotactn($ano, $mes, $valid){
		$sql="SELECT t.valid as codest, v.valnom as nomest, MONTH(t.fectra) AS mes, COUNT(t.idcon) AS cant FROM contrato AS c INNER JOIN persona AS e ON c.perid=e.perid INNER JOIN valor AS a ON c.valid=a.valid INNER JOIN parame AS n ON c.parid=n.parid INNER JOIN trazabilidad AS t ON c.idcon=t.idcon INNER JOIN valor AS v ON t.valid=v.valid WHERE c.elicon=1 AND t.valid='$valid' ";
		if($ano)
			$sql.=" AND YEAR(t.fectra)=$ano";
		if($mes)
			$sql.=" AND MONTH(t.fectra)=$mes";
		$sql.=" AND t.fectra=(SELECT MAX(d.fectra) FROM trazabilidad as d WHERE d.idcon=c.idcon)";
		$sql.=" GROUP BY t.valid, v.valnom ORDER BY COUNT(t.idcon) DESC";

		//echo "<br><br><br>".$sql."<br>'".$valid."','".$ano."','".$mes."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}


	public function setotarea($ano, $mes, $valid){
		$sql="SELECT c.valid as codest, v.valnom as nomest, MONTH(c.feccon) AS mes, COUNT(c.idcon) AS cant FROM contrato AS c INNER JOIN valor AS v ON c.valid=v.valid WHERE c.elicon=1 AND c.valid='$valid'";
		if($ano)
			$sql.=" AND YEAR(c.feccon)=$ano";
		if($mes)
			$sql.=" AND MONTH(c.feccon)=$mes";
		$sql.=" GROUP BY c.valid, v.valnom ORDER BY COUNT(c.idcon) DESC";

		//echo "<br><br><br>".$sql."<br>'".$valid."','".$ano."','".$mes."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function setotareano($ano, $mes, $valid){
		$sql="SELECT c.valid, v.valnom, count(c.idcon) AS c FROM contrato AS c INNER JOIN valor AS v ON c.valid=v.valid WHERE c.elicon=1 AND c.valid='$valid'";
		if($ano)
			$sql.=" AND YEAR(c.feccon)=$ano";
		/*if($mes)
			$sql.=" AND MONTH(c.feccon)=$mes";*/
		$sql.=" GROUP BY c.valid, v.valnom ORDER BY COUNT(c.idcon) DESC";

		//echo "<br><br><br>".$sql."<br>'".$valid."','".$ano."','".$mes."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function setnot($perid, $pefid){
		$sql="SELECT t.valid as codest, v.valnom as nomest, COUNT(c.idcon) AS cant FROM contrato AS c INNER JOIN persona AS e ON c.perid=e.perid INNER JOIN valor AS a ON c.valid=a.valid INNER JOIN parame AS n ON c.parid=n.parid INNER JOIN trazabilidad AS t ON c.idcon=t.idcon INNER JOIN valor AS v ON t.valid=v.valid WHERE c.elicon=1 AND t.fectra=(SELECT MAX(d.fectra) FROM trazabilidad as d WHERE d.idcon=c.idcon)";
		$sql.=" AND t.valid IN (SELECT valid FROM perxest WHERE pefid='$pefid')";
		if($pefid==13 OR $pefid==17)
			$sql.=" AND c.perid='$perid'";

		$sql.=" GROUP BY t.valid, v.valnom ORDER BY COUNT(c.idcon) DESC";
		//echo "<br><br><br>".$sql."<br>'".$proceso."','".$ano."','".$mes."','".$perid."','".$pefid."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function seleido($perid,$idtra){
		$sql="SELECT perid, idtra, visto FROM leido WHERE perid='$perid' AND idtra='$idtra'";
		//echo "<br><br><br>".$sql."<br>'".$perid."','".$idtra."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function straza($idcon, $fectra, $valid, $perid){
		$sql="SELECT idtra FROM trazabilidad WHERE idcon='$idcon' AND fectra='$fectra' AND valid='$valid' AND perid='$perid'";
		//echo "<br><br><br>".$sql."<br>'".$idcon."','".$fectra."','".$valid."','".$perid."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function camabo($idcon, $perid){
		$sql="SELECT count(idcon) AS exiemp FROM contrato WHERE idcon='$idcon' AND perid='$perid' AND elicon='1'";
		//echo "<br><br><br>".$sql."<br>'".$perid."','".$idcon."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function selenv($valid){
		$sql="SELECT pefid FROM perxest WHERE envmail='1' AND valid='$valid'";
		//echo "<br><br><br>".$sql."<br>'".$valid."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function updcotabo($idcon, $perid){
		$sql="UPDATE contrato SET perid=$perid WHERE idcon='$idcon';";
		//echo "<br><br><br>".$sql."<br>'".$idcon."','".$perid."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function updrest($idcon){
		$sql="UPDATE contrato SET elicon=1 WHERE idcon='$idcon';";
		//echo "<br><br><br>".$sql."<br>'".$idcon."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function updeli($idcon){
		$sql="UPDATE contrato SET elicon=2 WHERE idcon='$idcon';";
		//echo "<br><br><br>".$sql."<br>'".$idcon."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function updlei($perid, $idtra, $visto){
		$sql="UPDATE leido SET visto='$visto' WHERE perid='$perid' and idtra='$idtra';";
		//echo "<br><br><br>".$sql."<br>'".$idtra."','".$leido."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function seltra($idcon){
		$sql="SELECT MAX(idtra) as id FROM trazabilidad WHERE idcon='$idcon';";
		//echo "<br><br><br>".$sql."<br>'".$idcon."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function updtrz1($idcon, $leido){
		$sql="UPDATE trazabilidad SET leido=:leido WHERE idcon='$idcon';";
		//echo "<br><br><br>".$sql."<br>'".$idcon."','".$leido."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function updtrz2($idtra, $leido){
		$sql="UPDATE trazabilidad SET leido=$leido WHERE idtra='$idtra';";
		// echo "<br><br><br>".$sql."<br>'".$idtra."','".$leido."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function inslei($perid, $idtra){
		$sql="INSERT INTO leido VALUE ('$perid', '$idtra', '1');";
		//echo "<br><br><br>".$sql."<br>'".$perid."','".$idtra."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function selfest($ano){
		$resultado = NULL;
		$sql="SELECT fecfes FROM festivos";
		$execute = $this->db->query($sql);
		//$save = $execute->fetchall(PDO::FETCH_ASSOC);

		while($f=$execute->fetchall(PDO::FETCH_ASSOC)){
			$resultado[]=$f;
		}
		// var_dump($resultado);
		// echo "<br><br><br>";
		if(!$ano) $ano = date("Y");
		$re = null;
		foreach ($resultado as $r) {
			for($i=0;$i<count($resultado[0]);$i++)
				$re[] = $ano."-".$r[$i]['fecfes'];
		}
		// var_dump($re);
		// die();
		return $re;
	}

	public function save(){
		$sql= "INSERT INTO contrato(feccon, perid, nomcon, valid, objcon, parid, linexpcon, peridcon) VALUES (?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getFeccon(), $this->getPerid(), $this->getNomcon(), $this->getValid(), $this->getObjcon(), $this->getParid(), $this->getLinexpcon(), $this->getPeridcon());
	// echo $sql;
	// var_dump($arrdata);
	// die();
		$save = $insert->execute($arrdata);

	}

	public function edit(){		

		$sql = "UPDATE contrato SET perid=?,objcon=?,valid=?,parid=?,nomcon=?,linexpcon=?,lineccon=?,pubseccon=?,enlseccon=?,noseccon=?,estseccon=?,nocon=? ";
		$sql .= " WHERE idcon={$this->idcon};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getPerid(), $this->getObjcon(), $this->getValid(), $this->getParid(), $this->getNomcon(), $this->getLinexpcon(), $this->getLineccon(), $this->getPubseccon(), $this->getEnlseccon(), $this->getNoseccon(), $this->getEstseccon(), $this->getNocon());
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

	public function editAbo(){		

		$sql = "UPDATE contrato SET perid=? ";
		$sql .= " WHERE idcon={$this->idcon};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getPerid());
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

	public function editEli($elicon){		

		$sql = "UPDATE contrato SET elicon=".$elicon." ";
		$sql .= " WHERE idcon={$this->idcon};";	

		$update= $this->db->prepare($sql);
		$save=$update->execute();
		
		
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

	public function savetraz(){
		$sql= "INSERT INTO trazabilidad(idcon, fectra, valid, obstra, perid) VALUES (?,?,?,?,?)";

		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getIdcon(), $this->getFectra(), $this->getValid(), $this->getObstra(), $this->getPerid());
		//echo "<br><br><br>".$sql."<br>'".$this->getIdcon()."','". $this->getFectra()."','". $this->getValid()."','". $this->getObstra()."','". $this->getPerid()."'<br><br>";
		// var_dump($arrdata);
		// die();
		$save = $insert->execute($arrdata);
	}

	public function seltrazabilidad($idcon){
		$sql="SELECT t.idtra, t.idcon, t.fectra, t.perid, e.pernom, e.perape, t.valid, v.valnom, t.obstra FROM trazabilidad AS t INNER JOIN valor AS v ON t.valid=v.valid INNER JOIN persona AS e ON t.perid=e.perid WHERE t.idcon='$idcon' ORDER BY t.fectra;";
		//echo "<br><br><br>".$sql."<br>'".$idcon."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function selasicer($idcon){
		$sql="SELECT count(a.idtra) as Ncer FROM trazabilidad AS a WHERE a.idcon='$idcon'";
		//echo "<br><br><br>".$sql."<br>'".$idcon."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function selabogado($pefid){
		$sql="SELECT perid, nodocemp, pernom, perape FROM persona WHERE pefid in ($pefid,14) ORDER BY pernom";
		//echo "<br><br><br>".$sql."<br>'".$pefid."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function selcanabo($perid, $ano){
		$sql="SELECT c.perid, e.nodocemp, e.pernom, e.perape, MONTH(c.feccon) AS mes, COUNT(c.idcon) AS can FROM contrato AS c INNER JOIN persona AS e ON c.perid=e.perid WHERE c.elicon=1 and c.perid='$perid' AND YEAR(c.feccon)='$ano' GROUP BY c.perid, e.nodocemp, e.pernom, e.perape, MONTH(c.feccon)";
		//echo "<br><br><br>".$sql."<br>'".$pefid."','".$ano."'<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function selabo(){
		$sql="SELECT e.perid, e.nodocemp, e.pernom, e.perape FROM persona AS e WHERE e.pefid IN (13,14) ORDER BY e.pernom";
		//echo "<br><br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function selAllEst(){
		$sql="SELECT v.valid, v.parid, d.parnom, v.valnom, v.valfijo FROM valor AS v INNER JOIN parame AS d ON v.parid=d.parid WHERE v.parid IN (11,12,13) ORDER BY d.parnom, v.valnom";
		//echo "<br><br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function selTA(){
		$sql="SELECT parid, parnom, parfijo FROM parame WHERE parfijo='TA' ORDER BY parnom";
		//echo "<br><br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function allAreas(){
		$sql="SELECT valid,valnom FROM valor WHERE parid =1 ORDER BY valnom";
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		return $save;
	}

	public function getMinuta($numdoc,$area){

		
	}

	public function getCdp($numdoc,$area){

		$sql="SELECT perid FROM persona WHERE nodocemp = $numdoc";		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		if ($save) {
			$perid = $save[0]['perid'];
		}else{
			$save = false;
		}		

		if ($save) {
			$sql="SELECT iddpa FROM contrato WHERE peridcon = $perid ORDER BY iddpa DESC";		
			$execute = $this->db->query($sql);
			$save = $execute->fetchall(PDO::FETCH_ASSOC);	
			// var_dump($sql);
			// die();	
			$iddpa = $save[0]['iddpa'];
		}else{
			$save = false;
			$iddpa = false;
		}	

		if ($iddpa) {
			$sql="SELECT * FROM detpaa WHERE iddpa = $iddpa";		
			$execute = $this->db->query($sql);
			$save = $execute->fetchall(PDO::FETCH_ASSOC);
		}else{
			$save = false;
		}	

		// var_dump($save);
		// die();

		return $save;
	}

	public function getObligaciones($numdoc,$area){
		$sql="SELECT perid FROM persona WHERE nodocemp = $numdoc";		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		if ($save) {
			$perid = $save[0]['perid'];
		}else{
			$save = false;
		}		

		if ($save) {			
			$sql = " SELECT * FROM obligacon WHERE perid = $perid AND area = $area AND iddpa = (SELECT MAX(iddpa) FROM obligacon WHERE perid = $perid AND area = $area) ";	
			$execute = $this->db->query($sql);
			$save = $execute->fetchall(PDO::FETCH_ASSOC);
			return $save;
		}else{
			return $save = false;
		}
	}

	public function getObligacionesGen($cargo){
		$sql="SELECT * FROM obligaciones WHERE depen = $cargo AND tipo =2";		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		return $save;
	}


	
}