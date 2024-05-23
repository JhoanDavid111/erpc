<?php
class dathvper{
	private $perid;
	private $tipcon;
	private $fecinico;
	private $fecfinco;
	private $tipdoc;
	private $nomide;	
	private $sex;
	private $panac;				
	private $grusan;
	private $usuemail;
	private $fecnac;
	private $ubiid;
	private $idzona;
	private $munbrlc;
	private $estra;
	private $tipviv;
	private $tiplib;
	private $dismil;
	private $numlib;
	private $estciv;
	private $idio;
	private $idgene;
	private $orisex;
	private $cabfam;
	private $perexp;
	private $viccon;
	private $peretn;
	private $nometb;
	private $eps;
	private $fdp;
	private $arl;
	private $nomedubas;
	private $ulgrap;
	private $feulgrap;
	private $ubidepto;

	private $nodocemp;
	private $pernom;
	private $perape;
	private $peremail;
	private $perdir;
	private $pertel;
	private $percel;
	private $depid;
	private $cargo;
	private $actemp;

	private $tiedis;
	private $disca;

	private $tiptitul;
	private $modest;
	private $medcap;

	private $prtpcg;
	private $tippcg;


	private $db;

	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato

	function getPerid(){
		return $this->perid;
	}
	function getTipcon(){
		return $this->tipcon;
	}
	function getFecinico(){
		return $this->fecinico;
	}
	function getFecfinco(){
		return $this->fecfinco;
	}
	function getTipdoc(){
		return $this->tipdoc;
	}
	function getNomide(){
		return $this->nomide;
	}
	function getSex(){
		return $this->sex;
	}
	function getPanac(){
		return $this->panac;
	}
	function getGrusan(){
		return $this->grusan;
	}
	function getUsuemail(){
		return $this->usuemail;
	}
	function getFecnac(){
		return $this->fecnac;
	}
	function getUbiid(){
		return $this->ubiid;
	}
	function getIdzona(){
		return $this->idzona;
	}
	function getEstra() {
		return $this->estra;
	}
	function getMunbrlc() {
		return $this->munbrlc;
	}
	function getTipviv() {
		return $this->tipviv;
	}
	function getTiplib() {
		return $this->tiplib;
	}
	function getDismil() {
		return $this->dismil;
	}
	function getNumlib() {
		return $this->numlib;
	}
	function getEstciv() {
		return $this->estciv;
	}
	function getIdio() {
		return $this->idio;
	}
	function getIdgene() {
		return $this->idgene;
	}
	function getOrisex() {
		return $this->orisex;
	}
	function getCabfam() {
		return $this->cabfam;
	}
	function getPerexp() {
		return $this->perexp;
	}
	function getViccon() {
		return $this->viccon;
	}
	function getPeretn() {
		return $this->peretn;
	}
	function getNometb() {
		return $this->nometb;
	}
	function getEps() {
		return $this->eps;
	}
	function getFdp() {
		return $this->fdp;
	}
	function getArl() {
		return $this->arl;
	}
	function getNomedubas() {
		return $this->nomedubas;
	}
	function getUlgrap() {
		return $this->ulgrap;
	}
	function getFeulgrap() {
		return $this->feulgrap;
	}
	function getUbidepto() {
		return $this->ubidepto;
	}

	function getNodocemp(){
		return $this->nodocemp;
	}
	function getPernom(){
		return $this->pernom;
	}
	function getPerape(){
		return $this->perape;
	}
	function getPeremail(){
		return $this->peremail;
	}
	function getPerdir(){
		return $this->perdir;
	}
	function getPertel(){
		return $this->pertel;
	}
	function getPercel(){
		return $this->percel;
	}
	function getDepid(){
		return $this->depid;
	}
	function getCargo(){
		return $this->cargo;
	}
	function getActemp(){
		return $this->actemp;
	}
	function getTiedis(){
		return $this->tiedis;
	}
	function getDisca(){
		return $this->disca;
	}
	function getTiptitul(){
		return $this->tiptitul;
	}
	function getModest(){
		return $this->modest;
	}
	function getMedcap(){
		return $this->medcap;
	}
	function getPrtpcg(){
		return $this->prtpcg;
	}
	function getTippcg(){
		return $this->tippcg;
	}


//Metodos Set Guardan el dato

	function setPerid($perid){
		$this->perid = $perid;
	}
	function setTipcon($tipcon){
		$this->tipcon = $tipcon;
	}
	function setFecinico($fecinico){
		$this->fecinico = $fecinico;
	}
	function setFecfinco($fecfinco){
		$this->fecfinco = $fecfinco;
	}
	function setTipdoc($tipdoc){
		$this->tipdoc = $tipdoc;
	}
	function setNomide($nomide){
		$this->nomide = $nomide;
	}
	function setSex($sex){
		$this->sex = $sex;
	}
	function setPanac($panac){
		$this->panac = $panac;
	}
	function setGrusan($grusan){
		$this->grusan = $grusan;
	}	
	function setUsuemail($usuemail){
		$this->usuemail = $usuemail;
	}
	function setFecnac($fecnac){
		$this->fecnac = $fecnac;
	}
	function setUbiid($ubiid) {
		$this->ubiid = $ubiid;
	}
	function setIdzona($idzona) {
		$this->idzona = $idzona;
	}
	function setMunbrlc($munbrlc) {
		$this->munbrlc = $munbrlc;
	}
	function setEstra($estra) {
		$this->estra = $estra;
	}
	function setTipviv($tipviv) {
		$this->tipviv = $tipviv;
	}
	function setTiplib($tiplib) {
		$this->tiplib = $tiplib;
	}
	function setDismil($dismil) {
		$this->dismil = $dismil;
	}
	function setNumlib($numlib) {
		$this->numlib = $numlib;
	}
	function setEstciv($estciv) {
		$this->estciv = $estciv;
	}
	function setIdio($idio) {
		$this->idio = $idio;
	}
	function setIdgene($idgene) {
		$this->idgene = $idgene;
	}
	function setOrisex($orisex) {
		$this->orisex = $orisex;
	}
	function setCabfam($cabfam) {
		$this->cabfam = $cabfam;
	}
	function setPerexp($perexp) {
		$this->perexp = $perexp;
	}
	function setViccon($viccon) {
		$this->viccon = $viccon;
	}
	function setPeretn($peretn) {
		$this->peretn = $peretn;
	}
	function setNometb($nometb) {
		$this->nometb = $nometb;
	}
	function setEps($eps) {
		$this->eps = $eps;
	}
	function setFdp($fdp) {
		$this->fdp = $fdp;
	}
	function setArl($arl) {
		$this->arl = $arl;
	}
	function setNomedubas($nomedubas) {
		$this->nomedubas = $nomedubas;
	}
	function setUlgrap($ulgrap) {
		$this->ulgrap = $ulgrap;
	}
	function setFeulgrap($feulgrap) {
		$this->feulgrap = $feulgrap;
	}
	function setUbidepto($ubidepto) {
		$this->ubidepto = $ubidepto;
	}
	function setNodocemp($nodocemp){
		$this->nodocemp = $nodocemp;
	}
	function setPernom($pernom){
		$this->pernom = $pernom;
	}
	function setPerape($perape){
		$this->perape = $perape;
	}
	function setPeremail($peremail){
		$this->peremail = $peremail;
	}
	function setPerdir($perdir){
		$this->perdir = $perdir;
	}
	function setPertel($pertel){
		$this->pertel = $pertel;
	}
	function setPercel($percel){
		$this->percel = $percel;
	}
	function setDepid($depid){
		$this->depid = $depid;
	}
	function setCargo($cargo){
		$this->cargo = $cargo;
	}
	function setActemp($actemp){
		$this->actemp = $actemp;
	}
	function setTiedis($tiedis){
		$this->tiedis = $tiedis;
	}
	function setDisca($disca){
		$this->disca = $disca;
	}
	function setTiptitul($tiptitul){
		$this->tiptitul = $tiptitul;
	}
	function setModest($modest){
		$this->modest = $modest;
	}
	function setMedcap($medcap){
		$this->medcap = $medcap;
	}
	function setPrtpcg($prtpcg){
		$this->prtpcg = $prtpcg;
	}
	function setTippcg($tippcg){
		$this->tippcg = $tippcg;
	}
	

//Metodos CRUD
	public function getAll(){
		$sql="SELECT p.perid, val.valnom AS tpcto, hv.*, p.pernom, p.perdir, p.pertel, p.perape, p.nodocemp, p.peremail, p.percel, p.cargo, pf.pefnom, p.ubiid, hv.ubiid as lgnac, uh.ubinom AS nlgnac, uh.ubidepto AS dlgnac, u.ubinom, hv.munbrlc, uv.ubinom AS ndpmlb,uv.ubidepto AS dpmlb, p.envema, p.planta, p.cargo, p.actemp, a.valnom AS area, s.valnom AS tpusu, c.valnom as carg FROM persona AS p LEFT JOIN perfil AS pf ON p.pefid =pf.pefid LEFT JOIN ubica AS u ON p.ubiid=u.ubiid LEFT JOIN valor AS s ON s.parid=30 AND p.ordgas=s.ncon LEFT JOIN valor AS c ON p.cargo=c.valid LEFT JOIN valor AS a ON p.depid=a.valid LEFT JOIN dathvper AS hv ON hv.perid=p.perid LEFT JOIN ubica AS uh ON hv.ubiid=uh.ubiid LEFT JOIN ubica AS uv ON hv.munbrlc=uv.ubiid LEFT JOIN valor AS val ON hv.tipcon=val.valid ";
		//$sql .=" WHERE p.perid='".$this->perid."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// die();
		return $pfinan;
	}

	public function getOne(){
		$sql="SELECT p.perid, val.valnom AS tpcto, hv.*, p.pernom, p.perdir, p.pertel, p.perape, p.nodocemp, p.peremail, p.percel, p.cargo, pf.pefnom, p.ubiid, hv.ubiid as lgnac, uh.ubinom AS nlgnac, uh.ubidepto AS dlgnac, u.ubinom, hv.munbrlc, uv.ubinom AS ndpmlb,uv.ubidepto AS dpmlb, p.envema, p.planta, p.cargo, p.actemp, a.valnom AS area, s.valnom AS tpusu, c.valnom as carg FROM persona AS p LEFT JOIN perfil AS pf ON p.pefid =pf.pefid LEFT JOIN ubica AS u ON p.ubiid=u.ubiid LEFT JOIN valor AS s ON s.parid=30 AND p.ordgas=s.ncon LEFT JOIN valor AS c ON p.cargo=c.valid LEFT JOIN valor AS a ON p.depid=a.valid LEFT JOIN dathvper AS hv ON hv.perid=p.perid LEFT JOIN ubica AS uh ON hv.ubiid=uh.ubiid LEFT JOIN ubica AS uv ON hv.munbrlc=uv.ubiid LEFT JOIN valor AS val ON hv.tipcon=val.valid WHERE p.perid='".$this->perid."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// die();
		return $pfinan;
	}

	public function getFilter(){
		$sql="SELECT p.perid, p.nodocemp, p.pernom, p.perape, p.peremail, p.ubiid AS ubiid1, m1.ubinom AS nmu1, m1.ubidepto AS cdp1, d1.ubinom AS ndp1, p.perdir, p.pertel, p.percel, p.pefid, p.depid, v1.valnom AS area, p.ordgas, p.actemp, p.planta, p.cargo, v2.valnom AS carg, d.tipcon, v3.valnom AS tpcto, d.fecinico, d.fecfinco, d.tipdoc, v4.valnom AS tdoc, d.nomide, d.grusan, v5.valnom AS grsan, d.sex, v6.valnom AS sx, d.panac, d.usuemail, d.fecnac, YEAR(CURDATE())-YEAR(d.fecnac) + IF(DATE_FORMAT(CURDATE(),'%m-%d') >= DATE_FORMAT(d.fecnac,'%m-%d'), 0 , -1 ) AS edad, d.ubiid AS ubiid2, m2.ubinom AS nmu2, m2.ubidepto AS cdp2, d2.ubinom AS ndp2, d.idzona, v7.valnom AS idz, d.munbrlc, m3.ubinom AS nmu3, d.estra, v8.valnom AS etr, d.tipviv, v9.valnom AS tvi, d.tiplib, v10.valnom AS tlb, d.dismil, d.numlib, d.estciv, v11.valnom AS ecv, d.idio, d.idgene, v12.valnom AS gnr, d.orisex, v13.valnom AS osx, d.cabfam, d.perexp, d.viccon, d.peretn, d.nometb, v14.valnom AS etb, d.eps, d.fdp, d.arl, d.nomedubas, d.ulgrap, d.feulgrap FROM persona AS p LEFT JOIN dathvper AS d ON p.perid=d.perid LEFT JOIN ubica AS m1 ON p.ubiid=m1.ubiid LEFT JOIN ubica AS d1 ON m1.ubidepto=d1.ubiid LEFT JOIN ubica AS m2 ON d.ubiid=m2.ubiid LEFT JOIN ubica AS d2 ON m2.ubidepto=d2.ubiid LEFT JOIN ubica AS m3 ON d.munbrlc=m3.ubiid LEFT JOIN valor AS v1 ON p.depid=v1.valid LEFT JOIN valor AS v2 ON p.cargo=v2.valid LEFT JOIN valor AS v3 ON d.tipcon=v3.valid LEFT JOIN valor AS v4 ON d.tipdoc=v4.valid LEFT JOIN valor AS v5 ON d.grusan=v5.valid LEFT JOIN valor AS v6 ON d.sex=v6.valid LEFT JOIN valor AS v7 ON d.idzona=v7.valid LEFT JOIN valor AS v8 ON d.estra=v8.valid LEFT JOIN valor AS v9 ON d.tipviv=v9.valid LEFT JOIN valor AS v10 ON d.tiplib=v10.valid LEFT JOIN valor AS v11 ON d.estciv=v11.valid LEFT JOIN valor AS v12 ON d.idgene=v12.valid LEFT JOIN valor AS v13 ON d.orisex=v13.valid LEFT JOIN valor AS v14 ON d.nometb=v14.valid WHERE 1";
		if($this->tipcon) $sql .= " AND d.tipcon='".$this->tipcon."'";
		if($this->depid) $sql .= " AND p.depid='".$this->depid."'";
		if($this->pernom) $sql .= " AND (p.pernom LIKE '%".$this->pernom."%' OR p.perape LIKE '%".$this->pernom."%')";
		if($this->cargo) $sql .= " AND p.cargo='".$this->cargo."'";
		if($this->actemp) $sql .= " AND p.actemp='".$this->actemp."'";
		if($this->sex) $sql .= " AND d.sex='".$this->sex."'";
		if($this->grusan) $sql .= " AND d.grusan='".$this->grusan."'";
		if($this->estciv) $sql .= " AND d.estciv='".$this->estciv."'";
		if($this->idgene) $sql .= " AND d.idgene='".$this->idgene."'";
		if($this->orisex) $sql .= " AND d.orisex='".$this->orisex."'";
		if($this->cabfam) $sql .= " AND d.cabfam='".$this->cabfam."'";
		if($this->perexp) $sql .= " AND d.perexp='".$this->perexp."'";
		if($this->viccon) $sql .= " AND d.viccon='".$this->viccon."'";
		if($this->peretn) $sql .= " AND d.peretn='".$this->peretn."'";
		if($this->eps) $sql .= " AND d.eps='".$this->eps."'";
		if($this->fdp) $sql .= " AND d.fdp='".$this->fdp."'";
		if($this->arl) $sql .= " AND d.arl='".$this->arl."'";

		
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// die();
		return $pfinan;
	}

	public function getDiscap(){
		$sql="SELECT s.perid, s.idcondiusu, s.tiedis, s.disca, v.valnom FROM segm AS s INNER JOIN valor AS v ON s.disca=v.valid WHERE s.perid=$this->perid";
		if($this->tiedis) $sql .= " AND s.tiedis='".$this->tiedis."'";
		if($this->disca) $sql .= " AND s.disca='".$this->disca."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function getEstu(){
		$sql="SELECT ds.idedusup, ds.perid, ds.nomedusup, ds.ulsecu, ds.feculsem, ds.modest, m.valnom AS nomme, ds.medcap, c.valnom AS nommc, ds.dep, ds.grad, ds.tarjp, ds.fecgrad, ds.tiptitul, t.valnom AS nomtt FROM dats AS ds INNER JOIN valor AS m ON ds.modest=m.valid INNER JOIN valor AS c ON ds.medcap=c.valid INNER JOIN valor AS t ON ds.tiptitul=t.valid WHERE ds.perid=$this->perid";
		if($this->tiptitul) $sql .= " AND ds.tiptitul='".$this->tiptitul."'";
		if($this->modest) $sql .= " AND ds.modest='".$this->modest."'";
		if($this->medcap) $sql .= " AND ds.medcap='".$this->medcap."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function getPerca(){
		$sql="SELECT pc.idpcg2, pc.perid, pc.tdocpcg, td.valnom AS tdocpcg, pc.idpcg, pc.nompcg, pc.sexpcg, xx.valnom AS sexpcgo, pc.fnacpcg, YEAR(CURDATE())-YEAR(pc.fnacpcg) + IF(DATE_FORMAT(CURDATE(),'%m-%d') >= DATE_FORMAT(pc.fnacpcg,'%m-%d'), 0 , -1 ) AS Edad, pc.prtpcg, pr.valnom AS prtpcg, pc.tippcg, tpr.valnom AS tippcg FROM percargo as pc INNER JOIN valor AS td ON pc.tdocpcg=td.valid INNER JOIN valor AS xx ON pc.sexpcg=xx.valid INNER JOIN valor AS pr ON pc.prtpcg=pr.valid INNER JOIN valor AS tpr ON pc.tippcg=tpr.valid WHERE pc.perid=$this->perid";
		if($this->prtpcg) $sql .= " AND pc.prtpcg='".$this->prtpcg."'";
		if($this->tippcg) $sql .= " AND pc.tippcg='".$this->tippcg."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}


	//Funcion guardar datos en la BD
	
	public function save(){
		$sql= "INSERT INTO dathvper (perid, tipcon, fecinico, fecfinco, tipdoc, nomide, sex, panac, grusan, usuemail, fecnac, ubiid, idzona, munbrlc, estra, tipviv, tiplib, dismil, numlib, estciv, idio, idgene, orisex, cabfam, perexp, viccon, peretn, nometb, eps, fdp, arl, nomedubas, ulgrap, feulgrap) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getPerid(), $this->getTipcon(), $this->getFecinico(), $this->getFecfinco(), $this->getTipdoc(), $this->getNomide(), $this->getSex(), $this->getPanac(), $this->getGrusan(), $this->getUsuemail(), $this->getFecnac(), $this->getUbiid(), $this->getIdzona(), $this->getMunbrlc(), $this->getEstra(), $this->getTipviv(), $this->getTiplib(), $this->getDismil(), $this->getNumlib(), $this->getEstciv(), $this->getIdio(), $this->getIdgene(), $this->getOrisex(), $this->getCabfam(), $this->getPerexp(), $this->getViccon(), $this->getPeretn(), $this->getNometb(), $this->getEps(), $this->getFdp(), $this->getArl(), $this->getNomedubas(), $this->getUlgrap(), $this->getFeulgrap());
		//echo $this->db->error;
		//echo $sql;
		//var_dump($arrdata);
		//die();
		$save = $insert->execute($arrdata);		
	}

	//Funcion editar los campos de la vista

	public function edit(){		

		$sql = "UPDATE dathvper SET tipcon=?, fecinico=?, fecfinco=?, tipdoc=?, nomide=?, grusan=?, sex=?, panac=?, usuemail=?, fecnac=?, ubiid=?, idzona=?, munbrlc=?, estra=?, tipviv=?, tiplib=?, dismil=?, numlib=?, estciv=?, idio=?, idgene=?, orisex=?, cabfam=?, perexp=?, viccon=?, peretn=?, nometb=?, eps=?, fdp=?, arl=?, nomedubas=?, ulgrap=?, feulgrap=?";
		$sql .= " WHERE perid={$this->perid};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getTipcon(), $this->getFecinico(), $this->getFecfinco(), $this->getTipdoc(), $this->getNomide(), $this->getGrusan(), $this->getSex(), $this->getPanac(), $this->getUsuemail(), $this->getFecnac(), $this->getUbiid(), $this->getIdzona(), $this->getMunbrlc(), $this->getEstra(), $this->getTipviv(), $this->getTiplib(), $this->getDismil(), $this->getNumlib(), $this->getEstciv(), $this->getIdio(), $this->getIdgene(), $this->getOrisex(), $this->getCabfam(), $this->getPerexp(), $this->getViccon(), $this->getPeretn(), $this->getNometb(), $this->getEps(), $this->getFdp(), $this->getArl(), $this->getNomedubas(), $this->getUlgrap(), $this->getFeulgrap());
		$save=$update->execute($arrdata);
		
		// echo "<br>".$sql."<br>";
		// var_dump($arrdata);
		// die();
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	//Funciones para llamar la tabla del dominio para los campos de seleccion en la vista
	public function getValid($id){
		$sql="SELECT * FROM valor WHERE parid = '".$id."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function getValdom($id){
		$sql="SELECT * FROM valor WHERE parid = '".$id."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function getValdis($id){
		$sql="SELECT * FROM valor WHERE parid = '".$id."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function getValdo($id){
		$sql="SELECT * FROM valor WHERE parid = '".$id."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}


	//Traer Departamentos, municipios

	public function getUbi($id){
		$sql="SELECT * FROM ubica WHERE ubidepto='".$id."' ORDER BY ubinom ASC";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function getDhvCan(){
		$sql="SELECT count(perid) AS can FROM dathvper WHERE perid='".$this->perid."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function getOneUbi(){
		$sql="SELECT ubiid, ubinom, ubidepto FROM ubica WHERE ubiid='".$this->getUbidepto()."'";
		// echo $sql;
		// die();
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function editPer(){		

		$sql = "UPDATE persona SET nodocemp=?, pernom=?, perape=?, peremail=?, perdir=?, pertel=?, percel=?, ubiid=?";
		$sql .= " WHERE perid={$this->perid};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getNodocemp(), $this->getPernom(), $this->getPerape(), $this->getPeremail(), $this->getPerdir(), $this->getPertel(), $this->getPercel(), $this->getUbiid());
		$save=$update->execute($arrdata);
		// echo "<br>".$sql."<br>";
		// var_dump($arrdata);
		// die();
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function getAllArea($parid){
		$sql ="SELECT valid, valnom, ncon FROM valor WHERE parid= ".$parid." ORDER BY valnom";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}
}