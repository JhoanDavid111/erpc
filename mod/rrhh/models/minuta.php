<?php
class Minuta{
//Atributos

	private $nummin;
	private $perid;
	private $fechos;
	private $tipmin;
	private $obs;
	private $ideles;
	private $fhlle;

	private $nodocemp;

	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}

// Métodos Get devuelven datos
	function getNummin(){
		return $this->nummin;
	}
	function getPerid(){
		return $this->perid;
	}
	function getFechos(){
		return $this->fechos;
	}
	function getTipmin(){
		return $this->tipmin;
	}
	function getObs(){
		return $this->obs;
	}
	function getFhlle(){
		return $this->fhlle;
	}
	function getIdeles(){
		return $this->ideles;
	}

	function getNodocemp(){
		return $this->nodocemp;
	}
//Métodos Set guardan datos
	function setNummin($nummin){
		$this->nummin = $nummin;
	}
	function setPerid($perid){
		$this->perid = $perid;
	}
	function setFechos($fechos){
		$this->fechos = $fechos;
	}
	function setTipmin($tipmin){
		$this->tipmin = $tipmin;
	}
	function setObs($obs){
		$this->obs = $obs;
	}
	function setFhlle($fhlle){
		$this->fhlle = $fhlle;
	}
	function setIdeles($ideles){
		$this->ideles = $ideles;
	}

	function setNodocemp($nodocemp){
		$this->nodocemp = $nodocemp;
	}

//Métodos CRUD
	function getAll(){
		$sql = "SELECT m.nummin, m.perid, u.nodocemp, concat(pernom, perape) AS nomusu, m.fechos, m.fhlle, m.obs FROM minuta AS m LEFT JOIN persona AS u ON m.perid=u.perid";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->execute();
		$res = NULL;
		while($f=$result->fetch())
			$res[]=$f;
		return $res;
	}
	function getOne(){
		$sql = "SELECT m.nummin, m.perid, u.nodocemp, concat(pernom, perape) AS nomusu, m.fechos, m.fhlle, m.obs FROM minuta AS m LEFT JOIN persona AS u ON m.perid=u.perid WHERE m.nummin=:nummin";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$nummin = $this->getNummin();
		$result->bindParam(':nummin',$nummin);
		$result->execute();
		$res = NULL;
		while($f=$result->fetch())
			$res[]=$f;
		return $res;
	}
	function save(){
		$sql = "INSERT INTO minuta(nummin, perid, tipmin, fechos) VALUES (:nummin, :perid, :tipmin, :fechos)";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$nummin=$this->getNummin();
		$result->bindParam(':nummin',$nummin);
		$perid=$this->getPerid();
		$result->bindParam(':perid',$perid);
		$tipmin=$this->getTipmin();
		$result->bindParam(':tipmin',$tipmin);
		$fechos=$this->getFechos();
		$result->bindParam(':fechos',$fechos);
		$result->execute();
		$res = $conexion->lastInsertId();
		return $res;
	}

	function del(){
		$sql = "DELETE FROM persona WHERE perid=:perid";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$perid = $this->getPerid();
		$result->bindParam(':perid',$perid);
		//echo $sql."<br>";
		//echo $perid."<br>";
		$result->execute();
		$res = NULL;
		while($f=$result->fetch())
			$res[]=$f;
		return $res;
	}


	function getPersona(){
		$sql = "SELECT u.perid, u.nodocemp, concat(pernom,' ',perape) AS nomusu FROM persona AS u WHERE actemp=1 AND planta=1 AND u.nodocemp=:nodocemp";

		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$nodocemp = $this->getNodocemp();
		$result->bindParam(':nodocemp',$nodocemp);
		$result->execute();
		$res = NULL;
		while($f=$result->fetch())
			$res[]=$f;
		// echo "<br>".$sql."<br>'".$nodocemp."'<br>";
		// var_dump($res);
		// die();
		return $res;
	}

	function getUsuRgF()
	{
		date_default_timezone_set('America/Bogota');
		$fch = date('Y-m-d');
		$sql = "SELECT m.nummin, m.perid, u.nodocemp, m.obs, m.hij, m.ideles FROM minuta AS m INNER JOIN persona AS u ON m.perid=u.perid WHERE m.fechos BETWEEN '" . $fch . " 00:00:00' AND '" . $fch . " 23:59:59' AND m.perid=:valbus AND fechos=(SELECT MAX(fechos) AS fecMax FROM minuta WHERE fechos BETWEEN '" . $fch . " 00:00:00' AND '" . $fch . " 23:59:59' AND perid=:valbus)";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$valbus = $this->getPerid();
		$result->bindParam(':valbus', $valbus);
		$result->execute();
		$res = $result->fetchall(PDO::FETCH_ASSOC);
		return $res;
	}

	function getRepetido(){
		$sql = "SELECT COUNT(nummin) AS cot FROM minuta WHERE perid=:perid AND tipmin=:tipmin AND hij=0";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$perid = $this->getPerid();
		$result->bindParam(':perid',$perid);
		$tipmin = 'I';//$this->getTipmin();
		$result->bindParam(':tipmin',$tipmin);
		//echo "<br>".$sql."<br>'".$perid."' '".$tipmin."'<br>";
		$result->execute();
		$res = NULL;
		while($f=$result->fetch())
			$res[]=$f;
		return $res;
	}

	function updHij($fhlle,$nummin){
		$sql = "UPDATE minuta SET hij=1, tipmin='S', fhlle=:fhlle WHERE nummin=:nummin;";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->bindParam(':nummin',$nummin);
		$result->bindParam(':fhlle',$fhlle);
		//echo $sql."<br>";
		//echo $perid."<br>";
		$result->execute();
	}

	function getVuelta(){
		$sql = "SELECT nummin, COUNT(nummin) AS can FROM minuta WHERE perid=:perid AND tipmin='I' AND fhlle IS NULL;";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$perid = $this->getPerid();
		$result->bindParam(':perid',$perid);
		// echo "<br>".$sql."<br>'".$perid."'<br>";
		// die();
		$result->execute();
		$res = NULL;
		while($f=$result->fetch())
			$res[]=$f;
		return $res;
	}

	function getDest(){
		$sql = "SELECT nummin, COUNT(nummin) AS can FROM minuta WHERE perid=:perid AND tipmin='I' AND date_add(fechos, interval 110 minute)<=:fechos";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$perid=$this->getPerid();
		$result->bindParam(':perid',$perid);
		$fechos = $this->getFechos();
		$result->bindParam(':fechos',$fechos);
		// "<br>".$sql."<br>'".$idusu."' '".$placa."' '".$orimin."' '".$fechos."'<br>";
		$result->execute();
		$res = NULL;
		while($f=$result->fetch())
			$res[]=$f;
		return $res;
	}

	function getExiste($perid){
		$sql = "SELECT nummin, perid, fechos, tipmin, hij, fhlle FROM minuta WHERE perid='$perid' AND tipmin='I' AND fhlle IS NULL;";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->execute();
		$res = NULL;
		while($f=$result->fetch())
			$res[]=$f;
		return $res;
	}

	function updFecAnt(){
		$sql = "UPDATE minuta SET fhlle=concat(DATE(fechos),' 23:59:59'),tipmin='S',obs='Sistema.' WHERE fhlle IS NULL AND fechos<CURDATE();";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->execute();
	}

	function getDelFot(){
		$sql = "SELECT * FROM minuta WHERE fechos<DATE_SUB(NOW(),INTERVAL '1' MONTH) AND foteli=1;";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->execute();
		$res = NULL;
		while($f=$result->fetch())
			$res[]=$f;
		return $res;
	}

	function updFecEli(){
		$sql = "UPDATE minuta SET foteli=2 WHERE fechos<DATE_SUB(NOW(),INTERVAL '1' MONTH) AND foteli=1";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->execute();
	}

	function getTodo($datemin, $datemax,$nodocemp){
		$sql = "SELECT m.nummin, COALESCE(concat(u.pernom, u.perape), 'Invitado') AS nomusu, COALESCE(u.nodocemp, m.perid) AS nodocemp, m.fechos, m.fhlle, m.obs, m.tipmin, m.hij, m.ideles, TIMEDIFF(m.fhlle, m.fechos) as tiempo FROM minuta AS m LEFT JOIN persona AS u ON m.perid=u.perid WHERE DATE(m.fechos)>='".$datemin."'";
		if($datemax) $sql .= " AND DATE(m.fechos)<='".$datemax."' AND m.tipmin IN ('F','S','I')";
		if($nodocemp) $sql .= " AND u.nodocemp LIKE CONCAT('%', ".$nodocemp.", '%')";
		$sql .= " ORDER BY m.fechos DESC;";
		// echo "<br>".$sql."<br>"; 

		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		return $save;
	}
	function getTodoP(){
		$sql = "SELECT m.nummin, m.perid, m.fechos, m.tipmin, m.hij, m.fhlle, m.obs, m.ideles, concat(u.pernom, u.perape) AS nomusu, u.nodocemp FROM minuta AS m INNER JOIN persona AS u ON u.perid=m.perid WHERE m.tipmin IN ('A')";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->execute();
		$res = $result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}
}
?>