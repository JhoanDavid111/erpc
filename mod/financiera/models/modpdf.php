<?php 
//detpaa
require_once '../../../config/db.php';
class Pfinan{

	private $iddpa;
	private $idpaa;
	private $nicod;
	private $nobjeto;
	private $nomcont;
	private $area;
	private $codrub;
	private $objdpa;
	private $inidpa;
	private $prodpa;
	private $unspsc;
	private $fecinidpa;
	private $nmesdpa;
	private $tipcondpa;
	private $ftefindpa;
	private $asidpa;
	private $pmes;
	private $umes;
	private $valdpa;
	private $valvigact;
	private $fecfindpa;
	private $reqvigf;
	private $solivigf;
	private $unidad;
	private $ubicacion;
	private $resp;
	private $celres;
	private $mailres;
	//FALTA actualiar!!!!	

	private $codIddpa;
	private $ffutic;

	private $ncdppc;
	private $fecsol;
	private $idpro;
	private $idflu;
	private $observaciones;

	private $ncon;

	
	public function __construct() {
		$this->db = conexion::get_conexion();
	}

	function getIddpa() {
		return $this->iddpa;
	}	

	function getIdpaa() {
		return $this->idpaa;
	}

	function getNicod() {
		return $this->nicod;
	}	

	function getNObjeto(){
		return $this->nobjeto;
	}

	function getNomcont(){
		return $this->nomcont;
	}

	function getArea(){
		return $this->area;
	}	

	function getCodrub() {
		return $this->codrub;
	}

	function getObjdpa() {
		return $this->objdpa;
	}

	function getInidpa() {
		return $this->inidpa;
	}	

	function getProdpa() {
		return $this->prodpa;
	}

	function getUnspsc() {
		return $this->unspsc;
	}

	function getFecinidpa() {
		return $this->fecinidpa;
	}

	function getNmesdpa() {
		return $this->nmesdpa;
	}

	function getTipcondpa() {
		return $this->tipcondpa;
	}

	function getFtefindpa() {
		return $this->ftefindpa;
	}

	function getAsidpa() {
		return $this->asidpa;
	}

	function getPmes() {
		return $this->pmes;
	}

	function getUmes() {
		return $this->umes;
	}

	function getValdpa() {
		return $this->valdpa;
	}

	function getValvigact(){
		return $this->valvigact;
	}

	function getFecfindpa() {
		return $this->fecfindpa;
	}

	function getReqvigf() {
		return $this->reqvigf;
	}

	function getSolivigf() {
		return $this->solivigf;
	}

	function getUnidad() {
		return $this->unidad;
	}

	function getUbicacion() {
		return $this->ubicacion;
	}

	function getResp() {
		return $this->resp;
	}

	function getCelres() {
		return $this->celres;
	}

	function getMailres() {
		return $this->mailres;
	}

	function getCodIddpa() {
		return $this->codIddpa;
	}

	function getFfutic() {
		return $this->ffutic;
	}

	function getNcdppc() {
		return $this->ncdppc;
	}

	function getFecsol() {
		return $this->fecsol;
	}

	function getIdpro() {
		return $this->idpro;
	}	

	function getIdflu() {
		return $this->idflu;
	}	
	
	function getObservaciones() {
		return $this->observaciones;
	}

	function getNcon() {
		return $this->ncon;
	}




	//SET

	function setIddpa($iddpa) {
		$this->iddpa = $iddpa;
	}	

	function setIdpaa($idpaa) {
		$this->idpaa = $idpaa;
	}	

	function setNicod($nicod) {
		$this->nicod = $nicod;
	}

	function setNObjeto($nobjeto) {
		$this->nobjeto = $nobjeto;
	}

	function setNomcont($nomcont) {
		$this->nomcont = $nomcont;
	}

	function setArea($area) {
		$this->area = $area;
		// var_dump($area);
		// die();
	}

	function setCodrub($codrub) {
		$this->codrub = $codrub;
	}

	function setObjdpa($objdpa) {
		$this->objdpa = $objdpa;
	}
	

	function setInidpa($inidpa) {
		$this->inidpa = $inidpa;
	}

	function setProdpa($prodpa) {
		$this->prodpa = $prodpa;
	}

	function setUnspsc($unspsc) {
		$this->unspsc = $unspsc;
	}

	function setFecinidpa($fecinidpa) {
		$this->fecinidpa = $fecinidpa;
	}

	function setNmesdpa($nmesdpa) {
		$this->nmesdpa = $nmesdpa ;
	}

	function setTipcondpa($tipcondpa) {
		$this->tipcondpa = $tipcondpa;
	}

	function setFtefindpa($ftefindpa) {
		$this->ftefindpa = $ftefindpa;
	}

	function setAsidpa($asidpa) {
		$this->asidpa = $asidpa;
	}

	function setPmes($pmes) {
		$this->pmes = $pmes;
	}

	function setUmes($umes) {
		$this->umes = $umes;
	}

	function setValdpa($valdpa) {
		$this->valdpa = $valdpa;
	}

	function setValvigact($valvigact) {
		$this->valvigact = $valvigact;
	}

	function setFecfindpa($fecfindpa) {
		$this->fecfindpa = $fecfindpa;
	}

	function setReqvigf($reqvigf) {
		$this->reqvigf = $reqvigf;
	}

	function setSolivigf($solivigf) {
		$this->solivigf = $solivigf;
	}	

	function setUnidad($unidad) {
		$this->unidad = $unidad;
	}

	function setUbicacion($ubicacion) {
		$this->ubicacion = $ubicacion;
	}
	function setCelres($celres) {
		$this->celres = $celres;
	}

	function setMailres($mailres) {
		$this->mailres = $mailres;
	}

	function setResp($resp) {
		$this->resp = $resp;
	}

	function setCodIddpa($codIddpa) {
		$this->codIddpa = $codIddpa;
	}

	function setFfutic($ffutic) {
		$this->ffutic = $ffutic;
	}

	function setFecsol($fecsol) {
		$this->fecsol = $fecsol;
	}

	function setNcdppc($ncdppc) {
		$this->ncdppc = $ncdppc;
	}

	function setIdpro($idpro) {
		$this->idpro = $idpro;
	}

	function setIdflu($idflu) {
		$this->idflu = $idflu;
	}

	function setObservaciones($observaciones) {
		$this->observaciones = $observaciones;
	}
 
    function setNcon($ncon) {
		$this->ncon = $ncon;
	}


	//METODOS

	public function getOne(){
		$sql = "SELECT distinct dt.*, rub.*, flu.areas AS fluareas, m.vafnom AS moda, f.vafnom AS fuen, a.valnom AS are, fl.vafid AS ft, fi.vafnom AS resolu, fn.vafnom AS pro, fo.vafnom AS meta, fo.vafnom AS comp, concat(p.pernom,' ', p.perape) AS rspn, concat(og.pernom,' ', og.perape) AS ordg, car.valnom AS cargo FROM detpaa dt INNER JOIN rubro rub ON dt.codrub = rub.codrub INNER JOIN valfin AS m ON dt.tipcondpa=m.vafid INNER JOIN valfin AS f ON dt.ftefindpa=f.vafid LEFT JOIN flujo AS flu ON dt.idflu = flu.idflu INNER JOIN valor AS a ON dt.area=a.valid LEFT JOIN futic AS fl ON dt.iddpa = fl.iddpa LEFT JOIN valfin AS fi ON dt.resoludp=fi.vafid LEFT JOIN valfin AS fn ON dt.prodpa=fn.vafid LEFT JOIN valfin AS fo ON dt.inidpa=fo.vafid LEFT JOIN valfin AS fc ON dt.compro=fc.vafid LEFT JOIN persona as p ON dt.resp=p.perid LEFT JOIN persona as og ON dt.ordgas=og.perid LEFT JOIN valor AS car ON p.depid=car.valid WHERE dt.iddpa =  ".$this->iddpa;
		
			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getFlujo(){
		$sql = "SELECT t.*,p.pernom,p.perape,p.depid, v.valnom FROM trazadetpaa AS t INNER JOIN persona AS p ON t.perid=p.perid INNER JOIN valor AS v ON p.depid=v.valid WHERE t.iddpa=".$this->iddpa;
		
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getMifutic($iddpa){
		$sql = "SELECT f.iddpa, f.vafid, v.vafnom FROM futic AS f INNER JOIN valfin AS v ON f.vafid=v.vafid WHERE f.iddpa=".$iddpa;
		
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getFechaExpCDP(){
		$sql = "SELECT max(t.fec) as Fm FROM trazadetpaa AS t INNER JOIN persona AS p ON t.perid=p.perid INNER JOIN valor AS v ON p.depid=v.valid INNER JOIN flujo as f ON t.idflu=f.idflu WHERE t.iddpa='".$this->iddpa."' AND f.ntipo=3;";
		
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function vigact(){
		
		$sql = "SELECT idpaa, ninipaa FROM paa WHERE estpaa=3";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
	}

	public function getAll2($area, $ntipo=0){
		$sql = "SELECT distinct dt.*, rub.*, m.vafnom AS moda, f.vafnom AS fuen, a.valnom AS are, concat(p.pernom,' ', p.perape) AS rspn, p.peremail, p.pertel, concat(og.pernom,' ', og.perape) AS ordg, fl.actflu, ob.vafnom AS obj, ii.vafnom AS ini, pr.vafnom AS pro, tc.vafnom AS tco, ft.vafnom AS fte, pc.nompro, fi.vafnom AS resolu, fn.vafnom AS pro, fo.vafnom AS meta, dt.compro AS comp, ef.vafnom AS estfin FROM detpaa dt INNER JOIN rubro rub ON dt.codrub = rub.codrub INNER JOIN valfin AS m ON dt.tipcondpa=m.vafid INNER JOIN valfin AS f ON dt.ftefindpa=f.vafid INNER JOIN valor AS a ON dt.area=a.valid LEFT JOIN persona as p ON dt.resp=p.perid LEFT JOIN persona as og ON dt.ordgas=og.perid INNER JOIN flujo as fl ON dt.idflu=fl.idflu INNER JOIN valfin AS ef ON (ef.dofid=12 AND fl.ntipo=ef.vaffijo) INNER JOIN valfin AS ob ON dt.objdpa=ob.vafid INNER JOIN valfin AS ii ON dt.inidpa=ii.vafid INNER JOIN valfin AS pr ON dt.prodpa=pr.vafid INNER JOIN valfin AS tc ON dt.tipcondpa=tc.vafid INNER JOIN valfin AS ft ON dt.ftefindpa=ft.vafid INNER JOIN proceso AS pc ON dt.idpro=pc.idpro LEFT JOIN valfin AS fi ON dt.resoludp=fi.vafid LEFT JOIN valfin AS fn ON dt.prodpa=fn.vafid LEFT JOIN valfin AS fo ON dt.metadp=fo.vafid LEFT JOIN valfin AS fc ON dt.compro=fc.vafid WHERE dt.idpaa =  ".$this->idpaa." AND dt.elidp=1";


		//$sql .= " AND depidd IS NULL";
		if($ntipo) $sql .= " AND fl.ntipo=$ntipo";

		if($ntipo==1) $sql .= " AND depidd IS NOT NULL";

		if ($area) {
			$sql .= " AND a.valid IN ($area)";
		}
		
		$sql .= " ORDER BY dt.iddpa ASC";

		// echo "<br><br>Le entra en 2<br><br>";
		// echo "<br><br>".$sql."<br><br>";
		// die();


		// var_dump($sql);
		// die();
			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getAll2ant($area, $ntipo=0){
		$sql = "SELECT distinct dt.*, rub.*, m.vafnom AS moda, f.vafnom AS fuen, a.valnom AS are, concat(p.pernom,' ', p.perape) AS rspn, p.peremail, p.pertel, concat(og.pernom,' ', og.perape) AS ordg, fl.actflu, ob.vafnom AS obj, ii.vafnom AS ini, pr.vafnom AS pro, tc.vafnom AS tco, ft.vafnom AS fte, pc.nompro, fi.vafnom AS resolu, fn.vafnom AS pro, fo.vafnom AS meta, dt.compro AS comp, ef.vafnom AS estfin FROM detpaa dt INNER JOIN rubro rub ON dt.codrub = rub.codrub INNER JOIN valfin AS m ON dt.tipcondpa=m.vafid INNER JOIN valfin AS f ON dt.ftefindpa=f.vafid INNER JOIN valor AS a ON dt.area=a.valid LEFT JOIN persona as p ON dt.resp=p.perid LEFT JOIN persona as og ON dt.ordgas=og.perid INNER JOIN flujo as fl ON dt.idflu=fl.idflu INNER JOIN valfin AS ef ON (ef.dofid=12 AND fl.ntipo=ef.vaffijo) INNER JOIN valfin AS ob ON dt.objdpa=ob.vafid INNER JOIN valfin AS ii ON dt.inidpa=ii.vafid INNER JOIN valfin AS pr ON dt.prodpa=pr.vafid INNER JOIN valfin AS tc ON dt.tipcondpa=tc.vafid INNER JOIN valfin AS ft ON dt.ftefindpa=ft.vafid INNER JOIN proceso AS pc ON dt.idpro=pc.idpro LEFT JOIN valfin AS fi ON dt.resoludp=fi.vafid LEFT JOIN valfin AS fn ON dt.prodpa=fn.vafid LEFT JOIN valfin AS fo ON dt.metadp=fo.vafid LEFT JOIN valfin AS fc ON dt.compro=fc.vafid WHERE dt.idpaa =  ".$this->idpaa." AND dt.elidp=1";


		//$sql .= " AND depidd IS NULL";
		if($ntipo) $sql .= " AND fl.ntipo=$ntipo";

		if($ntipo==1) $sql .= " AND depidd IS NOT NULL";

		if ($area) {
			$sql .= " AND a.valid IN ($area)";
		}

		$sql .= " ORDER BY dt.codrub ASC";

		// echo "<br><br>Le entra en 2<br><br>";
		// echo "<br><br>".$sql."<br><br>";
		// die();


		// var_dump($sql);
		// die();
			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getAllPresu($area){
		$sql = "SELECT distinct dt.*, rub.*, m.vafnom AS moda, f.vafnom AS fuen, a.valnom AS are, concat(p.pernom,' ', p.perape) AS rspn, p.peremail, p.pertel, concat(og.pernom,' ', og.perape) AS ordg, fl.actflu, ob.vafnom AS obj, ii.vafnom AS ini, pr.vafnom AS pro, tc.vafnom AS tco, ft.vafnom AS fte, pc.nompro, fi.vafnom AS resolu, fn.vafnom AS pro, fo.vafnom AS meta, fo.vafnom AS comp, ef.vafnom AS estfin FROM detpaa dt INNER JOIN rubro rub ON dt.codrub = rub.codrub INNER JOIN valfin AS m ON dt.tipcondpa=m.vafid INNER JOIN valfin AS f ON dt.ftefindpa=f.vafid INNER JOIN valor AS a ON dt.area=a.valid LEFT JOIN persona as p ON dt.resp=p.perid LEFT JOIN persona as og ON dt.ordgas=og.perid INNER JOIN flujo as fl ON dt.idflu=fl.idflu INNER JOIN valfin AS ef ON (ef.dofid=12 AND fl.ntipo=ef.vaffijo) INNER JOIN valfin AS ob ON dt.objdpa=ob.vafid INNER JOIN valfin AS ii ON dt.inidpa=ii.vafid INNER JOIN valfin AS pr ON dt.prodpa=pr.vafid INNER JOIN valfin AS tc ON dt.tipcondpa=tc.vafid INNER JOIN valfin AS ft ON dt.ftefindpa=ft.vafid INNER JOIN proceso AS pc ON dt.idpro=pc.idpro LEFT JOIN valfin AS fi ON dt.resoludp=fi.vafid LEFT JOIN valfin AS fn ON dt.prodpa=fn.vafid LEFT JOIN valfin AS fo ON dt.inidpa=fo.vafid LEFT JOIN valfin AS fc ON dt.compro=fc.vafid WHERE dt.elidp=4";

		if ($area) {
			$sql .= " AND a.valid IN ($area)";
		}

		//echo "<br><br>".$sql."<br><br>";
			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getAll3($area,$ntipo,$idflu){
		$sql = "SELECT distinct dt.*, rub.*, m.vafnom AS moda, f.vafnom AS fuen, a.valnom AS are, concat(p.pernom,' ', p.perape) AS rspn, p.peremail, p.pertel, concat(og.pernom,' ', og.perape) AS ordg, fl.actflu, ob.vafnom AS obj, ii.vafnom AS ini, pr.vafnom AS pro, tc.vafnom AS tco, ft.vafnom AS fte, pc.nompro, fi.vafnom AS resolu, fn.vafnom AS pro, fo.vafnom AS meta, dt.compro AS comp, ef.vafnom AS estfin FROM detpaa dt INNER JOIN rubro rub ON dt.codrub = rub.codrub INNER JOIN valfin AS m ON dt.tipcondpa=m.vafid INNER JOIN valfin AS f ON dt.ftefindpa=f.vafid INNER JOIN valor AS a ON dt.area=a.valid LEFT JOIN persona as p ON dt.resp=p.perid LEFT JOIN persona as og ON dt.ordgas=og.perid INNER JOIN flujo as fl ON dt.idflu=fl.idflu INNER JOIN valfin AS ef ON (ef.dofid=12 AND fl.ntipo=ef.vaffijo) INNER JOIN valfin AS ob ON dt.objdpa=ob.vafid INNER JOIN valfin AS ii ON dt.inidpa=ii.vafid INNER JOIN valfin AS pr ON dt.prodpa=pr.vafid INNER JOIN valfin AS tc ON dt.tipcondpa=tc.vafid INNER JOIN valfin AS ft ON dt.ftefindpa=ft.vafid INNER JOIN proceso AS pc ON dt.idpro=pc.idpro LEFT JOIN valfin AS fi ON dt.resoludp=fi.vafid LEFT JOIN valfin AS fn ON dt.prodpa=fn.vafid LEFT JOIN valfin AS fo ON dt.metadp=fo.vafid LEFT JOIN valfin AS fc ON dt.compro=fc.vafid WHERE dt.idpaa=".$this->idpaa." AND dt.elidp=1 AND fl.ntipo=$ntipo";

		//$sql .= " AND depidd IS NULL";
		var_dump($sql);
		die();

		if ($area) {
			$sql .= " AND a.valid IN ($area)";
		}

		if ($idflu) {
			$sql .= " AND dt.idflu=$idflu";
		}		

		// echo "<br><br>Le entra en 3<br><br>";
		// echo "<br><br>".$sql."<br><br>";
		// echo "'".$area."','".$ntipo."','".$idflu."'<br>";
		// die();
			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getAll3ant($area,$ntipo,$idflu){
		$sql = "SELECT distinct dt.*, rub.*, m.vafnom AS moda, f.vafnom AS fuen, a.valnom AS are, concat(p.pernom,' ', p.perape) AS rspn, p.peremail, p.pertel, concat(og.pernom,' ', og.perape) AS ordg, fl.actflu, ob.vafnom AS obj, ii.vafnom AS ini, pr.vafnom AS pro, tc.vafnom AS tco, ft.vafnom AS fte, pc.nompro, fi.vafnom AS resolu, fn.vafnom AS pro, fo.vafnom AS meta, dt.compro AS comp, ef.vafnom AS estfin FROM detpaa dt INNER JOIN rubro rub ON dt.codrub = rub.codrub INNER JOIN valfin AS m ON dt.tipcondpa=m.vafid INNER JOIN valfin AS f ON dt.ftefindpa=f.vafid INNER JOIN valor AS a ON dt.area=a.valid LEFT JOIN persona as p ON dt.resp=p.perid LEFT JOIN persona as og ON dt.ordgas=og.perid INNER JOIN flujo as fl ON dt.idflu=fl.idflu INNER JOIN valfin AS ef ON (ef.dofid=12 AND fl.ntipo=ef.vaffijo) INNER JOIN valfin AS ob ON dt.objdpa=ob.vafid INNER JOIN valfin AS ii ON dt.inidpa=ii.vafid INNER JOIN valfin AS pr ON dt.prodpa=pr.vafid INNER JOIN valfin AS tc ON dt.tipcondpa=tc.vafid INNER JOIN valfin AS ft ON dt.ftefindpa=ft.vafid INNER JOIN proceso AS pc ON dt.idpro=pc.idpro LEFT JOIN valfin AS fi ON dt.resoludp=fi.vafid LEFT JOIN valfin AS fn ON dt.prodpa=fn.vafid LEFT JOIN valfin AS fo ON dt.metadp=fo.vafid LEFT JOIN valfin AS fc ON dt.compro=fc.vafid WHERE dt.idpaa=".$this->idpaa." AND dt.elidp=1 AND fl.ntipo=$ntipo";

		//$sql .= " AND depidd IS NULL";

		if ($area) {
			$sql .= " AND a.valid IN ($area)";
		}

		if ($idflu) {
			$sql .= " AND dt.idflu=$idflu";
		}

		$sql .= " ORDER BY dt.codrub ASC";

		// echo "<br><br>Le entra en 3<br><br>";
		// echo "<br><br>".$sql."<br><br>";
		// echo "'".$area."','".$ntipo."','".$idflu."'<br>";
		// die();
			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function deparea($valid){
		$sql = "SELECT valid,valnom FROM valor WHERE valfijo IN ($valid)";
		// var_dump($sql);
		// die();
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		
		
		return $ordgasto;
	}



	public function resol($iddpa){
		$sql = "SELECT f.vafid, v.vafnom AS resl FROM futic AS f INNER JOIN valfin AS v ON f.vafid=v.vafid WHERE f.iddpa=$iddpa";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		
		// var_dump($ordgasto);
		// die();
		return $ordgasto;
	}

	
	public function sumPr($ntipo, $codrub){
		$sql = "SELECT sum(dt.asidpa) AS cdp FROM detpaa AS dt INNER JOIN flujo AS fl ON dt.idflu=fl.idflu WHERE dt.depidd IS NOT NULL AND dt.elidp=1 AND fl.ntipo IN ($ntipo) AND dt.codrub=$codrub";
			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function sumPrC($ntipo, $codrub){
		$sql = "SELECT sum(dt.prrp) AS cdp FROM detpaa AS dt INNER JOIN flujo AS fl ON dt.idflu=fl.idflu WHERE dt.depidd IS NOT NULL AND dt.elidp=1 AND fl.ntipo IN ($ntipo) AND dt.codrub=$codrub";
			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function vigactan(){
		
		$sql = "SELECT * FROM paa WHERE estpaa IN (1,2)";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
	}

	public function getRepLuis($ano,$mes){
		$sql = "SELECT iddpa, idpaa, nicod, nobjeto, nomcont, area, codrub, objdpa, inidpa, prodpa, unspsc, fecinidpa, nmesdpa, cuodpa, tipcondpa, ftefindpa, asidpa, pmes, umes, valdpa, valvigact, fecfindpa, reqvigf, solivigf, unidad, ubicacion, resp, celres, mailres, ncdppc, fecsol, observaciones, idpro, idflu, depidd, nexpcdp, nrp, nbogdata, rutcdp, rutrp, ordgas, elidp, fec, perid FROM luispaez WHERE YEAR(fecinidpa)='".$ano."' AND MONTH(fecinidpa)='".$mes."';";
		//echo "<br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
	}

	public function getAllPre(){
		$sql = "SELECT * FROM `detpaa` WHERE elidp = 4 AND idpaa = 2024;";            
        $execute = $this->db->query($sql);
        $ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
        return $ordgasto;
	}
}

?>