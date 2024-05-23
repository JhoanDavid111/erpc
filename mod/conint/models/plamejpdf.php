<?php
require_once '../../../config/db.php';
class Plamej{
	// Tabla plamej
	private $nopla;
	private $fsolpla;
	private $fuepla;
	private $detfue;
	private $fobspla;
	private $cappla;
	private $obspla;
	private $areapla;
	private $estpla;
	private $porpla;
	private $actpla;

	// Tabla plaacc
	private $noacc;
	private $caumej;
	private $unimej;
	private $tapmej;
	private $formej;
	private $metmej;
	private $alcmej;
	private $finimej; 
	private $ffinmej;
	private $aremej;
	private $carlmej;
	private $carrmej;

	//Tabla Placom
	private $nocom;
	private $relcom;
	private $evicom;
	private $perid;
	private $fechcom;

	//Tabla Plaact
	private $noact;
	private $accmej;
	private $foract;
	private $bloact;

	//Tabla Plaava
	private $noava;
	private $comava;
	private $eviava;
	private $fechava;

	//Tabla Plaseg
	private $noplsg;
	private $fecseg;
	private $anaseg;
	private $ejesep;
	private $aleseg;
	private $audseg;
	private $actrea;
	private $eviseg;
	private $estseg;


	private $fil1;
	private $fil2;
	private $fil3;

	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
	//Metodos Get Devuelven el dato
	// Tabla plamej
	function getNopla(){
		return $this->nopla;
	}
	function getFsolpla(){
		return $this->fsolpla;
	}
	function getFuepla(){
		return $this->fuepla;
	}
	function getDetfue(){
		return $this->detfue;
	}
	function getFobspla(){
		return $this->fobspla;
	}
	function getCappla(){
		return $this->cappla;
	}
	function getObspla(){
		return $this->obspla;
	}
	function getAreapla(){
		return $this->areapla;
	}
	function getEstpla(){
		return $this->estpla;
	}
	function getActpla(){
		return $this->actpla;
	}
	function getPorpla(){
		return $this->porpla;
	}

	// Tabla plaacc
	function getnoacc(){
		return $this->noacc;
	}
	function getCaumej(){
		return $this->caumej;
	}
	function getUnimej(){
		return $this->unimej;
	}
	function getTapmej(){
		return $this->tapmej;
	}
	function getFormej(){
		return $this->formej;
	}
	function getMetmej(){
		return $this->metmej;
	}
	function getAlcmej(){
		return $this->alcmej;
	}
	function getFinimej(){
		return $this->finimej;
	}
	function getFfinmej(){
		return $this->ffinmej;
	}
	function getAremej(){
		return $this->aremej;
	}
	function getCarlmej(){
		return $this->carlmej;
	}
	function getCarrmej(){
		return $this->carrmej;
	}

	//Tabla Plaact
	function getNoact(){
		return $this->noact;
	}
	function getAccmej(){
		return $this->accmej;
	}
	function getForact(){
		return $this->foract;
	}
	function getBloact(){
		return $this->bloact;
	}

	//Tabla Plaava
	function getNoava(){
		return $this->noava;
	}
	function getComava(){
		return $this->comava;
	}
	function getEviava(){
		return $this->eviava;
	}
	function getFechava(){
		return $this->fechava;
	}

	// Tabla plaseg
	function getNoplsg(){
		return $this->noplsg;
	}
	function getFecseg(){
		return $this->fecseg;
	}
	function getAnaseg(){
		return $this->anaseg;
	}
	function getEjesep(){
		return $this->ejesep;
	}
	function getAleseg(){
		return $this->aleseg;
	}
	function getAudseg(){
		return $this->audseg;
	}
	function getActrea(){
		return $this->actrea;
	}
	function getEviseg(){
		return $this->eviseg;
	}
	function getEstseg(){
		return $this->estseg;
	}

	//Tabla Placom
	function getNocom(){
		return $this->nocom;
	}
	function getRelcom(){
		return $this->relcom;
	}
	function getEvicom(){
		return $this->evicom;
	}
	function getPerid(){
		return $this->perid;
	}
	function getFechcom(){
		return $this->fechcom;
	}

	function getFil1() {
		return $this->fil1;
	}
	function getFil2() {
		return $this->fil2;
	}
	function getFil3() {
		return $this->fil3;
	}
//Metodos Set Guardan el dato
	// Tabla plamej
	function setNopla($nopla){
		$this->nopla = $nopla;
	}
	function setFsolpla($fsolpla){
		$this->fsolpla = $fsolpla;
	}
	function setFuepla($fuepla){
		$this->fuepla = $fuepla;
	}
	function setDetfue($detfue){
		$this->detfue = $detfue;
	}
	function setFobspla($fobspla){
		$this->fobspla = $fobspla;
	}
	function setCappla($cappla){
		$this->cappla = $cappla;
	}
	function setObspla($obspla){
		$this->obspla = $obspla;
	}
	function setAreapla($areapla){
		$this->areapla = $areapla;
	}
	function setEstpla($estpla){
		$this->estpla = $estpla;
	}
	function setActpla($actpla){
		$this->actpla = $actpla ;
	}
	function setPorpla($porpla){
		$this->porpla = $porpla;
	}

	// Tabla plaacc
	function setNoacc($noacc){
		$this->noacc = $noacc;
	}
	function setCaumej($caumej){
		$this->caumej = $caumej;
	}
	function setUnimej($unimej){
		$this->unimej = $unimej;
	}
	function setTapmej($tapmej){
		$this->tapmej = $tapmej;
	}
	function setFormej($formej){
		$this->formej = $formej;
	}
	function setMetmej($metmej){
		$this->metmej = $metmej;
	}
	function setAlcmej($alcmej){
		$this->alcmej = $alcmej;
	}
	function setFinimej($finimej){
		$this->finimej = $finimej;
	}
	function setFfinmej($ffinmej){
		$this->ffinmej = $ffinmej;
	}
	function setAremej($aremej){
		$this->aremej = $aremej;
	}
	function setCarlmej($carlmej){
		$this->carlmej = $carlmej;
	}
	function setCarrmej($carrmej){
		$this->carrmej = $carrmej;
	}
	// Tabla plaseg
	function setNoplsg($noplsg){
		$this->noplsg = $noplsg;
	}
	function setFecseg($fecseg){
		$this->fecseg = $fecseg;
	}
	function setAnaseg($anaseg){
		$this->anaseg = $anaseg;
	}
	function setEjesep($ejesep){
		$this->ejesep = $ejesep;
	}
	function setAleseg($aleseg){
		$this->aleseg = $aleseg;
	}
	function setAudseg($audseg){
		$this->audseg = $audseg;
	}
	function setActrea($actrea){
		$this->actrea = $actrea;
	}
	function setEviseg($eviseg){
		$this->eviseg = $eviseg;
	}
	function setEstseg($estseg){
		$this->estseg = $estseg;
	}

	//Tabla Plaact
	function setNoact($noact){
		$this->noact = $noact;
	}
	function setAccmej($accmej){
		$this->accmej = $accmej;
	}
	function setForact($foract){
		$this->foract = $foract;
	}
	function setBloact($bloact){
		$this->bloact = $bloact;
	}

	//Tabla Plaava
	function setNoava($noava){
		$this->noava = $noava;
	}
	function setComava($comava){
		$this->comava = $comava;
	}
	function setEviava($eviava){
		$this->eviava = $eviava;
	}
	function setFechava($fechava){
		$this->fechava = $fechava;
	}

	//Tabla Placom
	function setNocom($nocom){
		$this->nocom = $nocom;
	}
	function setRelcom($relcom){
		$this->relcom = $relcom;
	}
	function setEvicom($evicom){
		$this->evicom = $evicom;
	}
	function setPerid($perid){
		$this->perid = $perid;
	}
	function setFechcom($fechcom){
		$this->fechcom = $fechcom;
	}


	function setFil1($fil1) {
		$this->fil1 = $fil1;
	}
	function setFil2($fil2) {
		$this->fil2 = $fil2;
	}
	function setFil3($fil3) {
		$this->fil3 = $fil3;
	}

//Metodos CRUD
//--Tabla plamej --------------------------------------------------
	public function getAll($ac){
		/*$sql = "SELECT DISTINCT l.nopla, l.fsolpla, l.fuepla, f.valnom AS fte, l.detfue, l.fobspla, l.cappla, l.obspla, l.areapla, l.estpla, e.valnom AS est, e.pre, l.actpla, l.porpla, l.ocpla, l.carlmej, c.valnom AS lid, l.feciepla, l.perid, p.nodocemp, p.pernom, p.perape, p.cargo, l.fecautpla, a.perid AS apro FROM plamej AS l LEFT JOIN valor AS f ON l.fuepla=f.valid LEFT JOIN valor AS e ON l.estpla=e.valid LEFT JOIN valor AS c ON l.carlmej=c.valid LEFT JOIN persona AS p ON l.perid=p.perid LEFT JOIN persona AS a ON l.carlmej=a.cargo LEFT JOIN plaacc AS p1 ON l.nopla=p1.nopla LEFT JOIN plaact AS p2 ON p1.noacc=p2.noact LEFT JOIN plaava AS p3 ON p2.noact=p3.noact LEFT JOIN plaseg AS p4 ON p3.noava=p4.noava WHERE l.actpla='".$ac."'";
		if($_SESSION['pefid']==71)
			$sql .= " AND a.perid='".$_SESSION['perid']."'";
		if($_SESSION['pefid']!=58 AND $_SESSION['pefid']!=70)
			$sql .= " AND l.areapla LIKE '%".$_SESSION['depid']."%'";

		if($this->getFil1() && $this->getFil2())
			$sql .= " AND date(p4.fecseg) BETWEEN '".$this->getFil1()."' AND '".$this->getFil2()."'";
			//$sql .= " AND date(l.fsolpla) BETWEEN '".$this->getFil1()."' AND '".$this->getFil2()."'";
		if($this->getFil3())
			$sql .= " AND l.fuepla='".$this->getFil3()."'";
		
		$sql .= " ORDER BY l.fsolpla";*/

		$sql = "SELECT DISTINCT l.nopla, l.fsolpla, l.fuepla, f.valnom AS fte, l.detfue, l.fobspla, l.cappla, l.obspla, l.areapla, l.estpla, e.valnom AS est, e.pre, l.actpla, l.porpla, l.ocpla, l.carlmej, c.valnom AS lid, l.feciepla, l.perid, p.nodocemp, p.pernom, p.perape, p.cargo, l.fecautpla, a.perid AS apro FROM plamej AS l LEFT JOIN valor AS f ON l.fuepla=f.valid LEFT JOIN valor AS e ON l.estpla=e.valid LEFT JOIN valor AS c ON l.carlmej=c.valid LEFT JOIN persona AS p ON l.perid=p.perid LEFT JOIN persona AS a ON l.carlmej=a.cargo LEFT JOIN plaacc AS p1 ON l.nopla=p1.nopla LEFT JOIN plaact AS p2 ON p1.noacc=p2.noact LEFT JOIN plaava AS p3 ON p2.noact=p3.noact LEFT JOIN plaseg AS p4 ON p3.noava=p4.noava WHERE l.actpla=1";
		if($_SESSION['pefid']==71)
			$sql .= " AND a.perid='".$_SESSION['perid']."'";
		elseif($_SESSION['pefid']!=58 AND $_SESSION['pefid']!=70)
			$sql .= " AND l.areapla LIKE '%".$_SESSION['depid']."%'";
		

		if($this->getFil1() && $this->getFil2())
			$sql .= " AND date(p4.fecseg) BETWEEN '".$this->getFil1()."' AND '".$this->getFil2()."'";
			//$sql .= " AND date(l.fsolpla) BETWEEN '".$this->getFil1()."' AND '".$this->getFil2()."'";
		if($this->getFil3())
			$sql .= " AND l.fuepla='".$this->getFil3()."'";
		
		$sql .= " ORDER BY l.fsolpla";
		// echo "<br>".$sql."<br><br>".$this->getFil1()."-".$this->getFil2()."-".$this->getFil3()."-".$_SESSION['pefid']."-".$_SESSION['perid']."<br><br><br>";
		// die();

		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	public function getAllcr(){
		$sql = "SELECT l.nopla, l.fsolpla, l.fuepla, f.valnom AS fte, l.detfue, l.fobspla, l.cappla, l.obspla, l.areapla, l.estpla, e.valnom AS est, l.actpla, l.porpla FROM plamej AS l LEFT JOIN valor AS f ON l.fuepla=f.valid LEFT JOIN valor AS e ON l.estpla=e.valid WHERE l.actpla<>1";
		if($_SESSION['pefid']!=58 AND $_SESSION['pefid']!=70)
			$sql .= " AND l.areapla LIKE '%".$_SESSION['depid']."%'";
			//$sql .= " WHERE l.areapla LIKE '%".$_SESSION['depid']."%'";
		// 	$sql2 = " AND ";
		// }else
		// 	$sql2 = " WHERE ";

		if($this->getFil1() && $this->getFil2())
			$sql .= " AND date(l.fsolpla) BETWEEN '".$this->getFil1()."' AND '".$this->getFil2()."'";
		if($this->getFil3())
			$sql .= " AND l.fuepla='".$this->getFil3()."'";
		 	//$sql .= $sql2."date(l.fsolpla) BETWEEN '".$this->getFil1()."' AND '".$this->getFil2()."'";
		
		$sql .= " ORDER BY l.fsolpla";
		// echo "<br>".$sql."<br><br>".$this->getFil1()."-".$this->getFil2()."-".$_SESSION['pefid']."-".$_SESSION['perid']."<br><br><br>";
		// die();

		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($rub);
		// die();

		return $rub;
	}

	public function getOne(){
		$sql ="SELECT l.nopla, l.fsolpla, l.fuepla, f.valnom AS fte, l.detfue, l.fobspla, l.cappla, l.obspla, l.areapla, l.estpla, e.valnom AS est, l.porpla FROM plamej AS l LEFT JOIN valor AS f ON l.fuepla=f.valid LEFT JOIN valor AS e ON l.estpla=e.valid WHERE l.nopla = ".$this->nopla;
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

	public function getAllValPre($parid, $od="as"){
		$sql ="SELECT * FROM valor WHERE parid = ".$parid." AND pre='1' ORDER BY valnom";
		if($od=="ds") $sql .= " DESC;";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getAllPer(){
		$sql ="SELECT perid, concat(pernom,' ', perape) AS nom FROM persona WHERE actemp=1 AND depid=1006 ORDER BY pernom";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	//
	public function getDactPla(){
		$sql ="SELECT DATE(MAX(c.ffinmej)) AS ffin, DATE(MAX(v.fechava)) AS fcava, ROUND(AVG(s.ejesep), 0) AS pro FROM plamej AS p INNER JOIN plaacc AS a ON p.nopla=a.nopla INNER JOIN plaact AS c ON a.noacc=c.noacc INNER JOIN plaava AS v ON c.noact=v.noact INNER JOIN plaseg AS s ON v.noava=s.noava WHERE p.nopla='".$this->nopla."' GROUP BY a.ffinmej;";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// echo "<br>".$sql."<br>";
		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getArea($valid){
		$sql = "SELECT valid, valnom, parid, valfijo, pre, abr, ncon, cdpmul, doctrd FROM valor WHERE valid='".$valid."'";
		// echo $sql;
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($rub);
		// die();
		return $rub;
	}
//--Tabla plamej --------------------------------------------------

	public function getAllMejo(){
		$sql = "SELECT p.noacc, p.nopla, p.caumej, p.accmej, p.unimej, p.tapmej, t.valnom AS tap, p.formej, p.metmej, p.alcmej, p.finimej, p.ffinmej, p.aremej, a.valnom AS are, p.carlmej, l.valnom AS cal, p.carrmej, r.valnom AS car, p.aprpmj FROM plaacc AS p INNER JOIN valor AS a ON p.aremej=a.valid INNER JOIN valor AS l ON p.carlmej=l.valid INNER JOIN valor AS r ON p.carrmej=r.valid INNER JOIN valor AS t ON p.tapmej=t.valid WHERE p.nopla=$this->nopla";
		// echo "<br>".$sql."<br><br>".noacc."-".nopla."-".caumej."-".accmej."-".unimej."-".tapmej."-".formej."-".metmej."-".alcmej."-".finimej."-".ffinmej."-".aremej."-".carlmej."-".carrmej."<br><br><br>";
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($rub);
		// die();
		return $rub;
	}

	public function getOneMejo(){
		$sql = "SELECT p.noacc, p.nopla, p.caumej, p.accmej, p.unimej, p.tapmej, p.formej, p.metmej, p.alcmej, p.finimej, p.ffinmej, p.aremej, a.valnom AS are, p.carlmej, l.valnom AS cal, p.carrmej, r.valnom AS car, p.aprpmj FROM plaacc AS p INNER JOIN valor AS a ON p.aremej=a.valid INNER JOIN valor AS l ON p.carlmej=l.valid INNER JOIN valor AS r ON p.carrmej=r.valid WHERE p.noacc=$this->noacc";
		// echo "<br>".$sql."<br><br>".noacc."-".nopla."-".caumej."-".accmej."-".unimej."-".tapmej."-".formej."-".metmej."-".alcmej."-".finimej."-".ffinmej."-".aremej."-".carlmej."-".carrmej."<br><br><br>";
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($rub);
		// die();
		return $rub;
	}

	public function getLastIdMejo(){
		$sql = "SELECT noacc FROM plaacc WHERE nopla='".$this->getNopla()."' AND caumej='".$this->getCaumej()."' AND unimej='".$this->getUnimej()."' AND tapmej='".$this->getTapmej()."' AND metmej='".$this->getMetmej()."' AND alcmej='".$this->getAlcmej()."' AND finimej='".$this->getFinimej()."' AND ffinmej='".$this->getFfinmej()."' AND aremej='".$this->getAremej()."' AND carlmej='".$this->getCarlmej()."' AND carrmej='".$this->getCarrmej()."'";
		// echo "<br>".$sql."<br><br><br>";
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($rub);
		// die();
		return $rub;
	}

//--Tabla plaact --------------------------------------------------
	public function getOneAct(){
		$sql = "SELECT noact, noacc, accmej, foract, bloact FROM plaact WHERE noacc=$this->noacc";
		// echo "<br>".$sql."<br><br>".$this->noacc."<br><br><br>";
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($rub);
		// die();
		return $rub;
	}

//--Tabla plaseg --------------------------------------------------
	public function getAllSeg(){
		$sql = "SELECT p.noplsg, p.noava, p.fecseg, p.anaseg, p.ejesep, p.aleseg, a.valnom AS ale, a.valfijo, a.pre, a.abr, p.audseg, r.pernom, r.perape, p.actrea, p.eviseg, p.estseg, e.valnom AS est FROM plaseg AS p LEFT JOIN persona AS r ON p.audseg=r.perid LEFT JOIN valor AS a ON p.aleseg=a.valid LEFT JOIN valor AS e ON p.estseg=e.valid";
		if($this->noava) $sql .= " WHERE p.noava=$this->noava";
		$sql .= " ORDER BY p.noava";
		// echo "<br>".$sql."<br><br>".$this->noava."<br><br><br>";
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($rub);
		// die();
		return $rub;
	}

	public function getAutAlsg($por){
		$sql = "SELECT valid, valnom FROM valor WHERE parid=31 AND valid NOT IN (1804,1805) AND ".$por." BETWEEN valfijo AND abr";
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($rub);
		// die();
		return $rub;
	}

// Comentario
	public function getAllCom(){
		$sql ="SELECT c.nocom, c.noacc, c.relcom, c.evicom, c.perid, p.nodocemp, p.pernom, p.perape, c.fechcom FROM placom AS c INNER JOIN persona AS p ON c.perid=p.perid WHERE noacc=$this->noacc";

		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getCanCom(){
		$sql ="SELECT COUNT(nocom) AS can FROM placom WHERE noacc=$this->noacc";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	

// Avances
	public function getAllAva(){
		$sql ="SELECT a.noava, a.noact, a.comava, a.eviava, a.perid, p.nodocemp, p.pernom, p.perape, p.peremail, a.fechava FROM plaava AS a INNER JOIN persona AS p ON a.perid=p.perid WHERE noact=$this->noact";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

// Contadores
	public function getCouAcc(){
		$sql ="SELECT COUNT(c.noacc) AS can FROM plaacc AS c WHERE c.nopla=$this->nopla";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getCouAct(){
		$sql ="SELECT COUNT(t.noact) AS can FROM plaact AS t INNER JOIN plaacc AS c ON c.noacc=t.noacc WHERE c.nopla=$this->nopla";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getCouAva(){
		$sql ="SELECT COUNT(p.noava) AS can FROM plaact AS t INNER JOIN plaacc AS c ON c.noacc=t.noacc INNER JOIN plaava AS p ON t.noact=p.noact WHERE c.nopla=$this->nopla";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getCouSeg(){
		$sql ="SELECT COUNT(s.noplsg) AS can FROM plaact AS t INNER JOIN plaacc AS c ON c.noacc=t.noacc INNER JOIN plaava AS p ON t.noact=p.noact INNER JOIN plaseg AS s ON p.noava=s.noava WHERE c.nopla=$this->nopla";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function getDtSeg(){
		$sql ="SELECT s.noplsg, s.noava, s.fecseg, s.audseg, r.nodocemp, r.pernom, r.perape  FROM plaact AS t INNER JOIN plaacc AS c ON c.noacc=t.noacc INNER JOIN plaava AS p ON t.noact=p.noact INNER JOIN plaseg AS s ON p.noava=s.noava INNER JOIN persona AS r ON s.audseg=r.perid WHERE s.fecseg=(SELECT MAX(s.fecseg) AS can FROM plaact AS t INNER JOIN plaacc AS c ON c.noacc=t.noacc INNER JOIN plaava AS p ON t.noact=p.noact INNER JOIN plaseg AS s ON p.noava=s.noava WHERE c.nopla=$this->nopla) AND c.nopla=$this->nopla";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}
}