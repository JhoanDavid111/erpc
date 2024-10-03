<?php 
//detpaa
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
	private $cuodpa;
	private $tipcondpa;
	private $ftefindpa;
	private $futic;
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
	private $ordgas;
	private $celres;
	private $mailres;	

	private $codIddpa;
	private $ffutic;

	private $ncdppc;
	private $fecsol;
	private $idpro;
	private $idflu;
	private $observaciones;

	private $ncon;

	private $feclib;
	private $rutlib;
	private $estlib;
	private $metadp;
	private $resoludp;
	private $prrp;

	private $elidp;
	private $idmcdp;
	private $valid;
	private $compro;
	private $cpc;
	private $idpb;


	private $valcdp;
	private $anucdp;
	private $cxccdp;
	private $valrp;
	private $anurp;
	private $cxcrp;
	
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

	function getCuodpa() {
		return $this->cuodpa;
	}

	function getTipcondpa() {
		return $this->tipcondpa;
	}

	function getFtefindpa() {
		return $this->ftefindpa;
	}

	function getFutic() {
		return $this->futic;
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

	function getOrdgas() {
		return $this->ordgas;
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

	function getFeclib() {
		return $this->feclib;
	}

	function getRutlib() {
		return $this->rutlib;
	}

	function getEstlib() {
		return $this->estlib;
	}

	function getMetadp() {
		return $this->metadp;
	}

	function getResoludp() {
		return $this->resoludp;
	}

	function getPrrp() {
		return $this->prrp;
	}

	function getElidp() {
		return $this->elidp;
	}

	function getIdmcdp() {
		return $this->idmcdp;
	}

	function getValid() {
		return $this->valid;
	}

	function getCompro() {
		return $this->compro;
	}

	function getCpc() {
		return $this->cpc;
	}

	function getIdpb() {
		return $this->idpb;
	}


	function getValcdp(){
		return $this->valcdp;
	}
	function getAnucdp(){
		return $this->anucdp;
	}
	function getCxccdp(){
		return $this->cxccdp;
	}
	function getValrp(){
		return $this->valrp;
	}
	function getAnurp(){
		return $this->anurp;
	}
	function getCxcrp(){
		return $this->cxcrp;
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
		$this->nmesdpa = $nmesdpa;
	}

	function setCuodpa($cuodpa) {
		$this->cuodpa = $cuodpa;
	}

	function setTipcondpa($tipcondpa) {
		$this->tipcondpa = $tipcondpa;
	}

	function setFtefindpa($ftefindpa) {
		$this->ftefindpa = $ftefindpa;
	}

	function setFutic($futic) {
		$this->futic = $futic;
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

	function setOrdgas($ordgas) {
		$this->ordgas = $ordgas;
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

	function setFeclib($feclib) {
		$this->feclib = $feclib;
	}

	function setRutlib($rutlib) {
		$this->rutlib = $rutlib;
	}

	function setEstlib($estlib) {
		$this->estlib = $estlib;
	}

	function setMetadp($metadp) {
		$this->metadp = $metadp;
	}

	function setResoludp($resoludp) {
		$this->resoludp = $resoludp;
	}

	function setPrrp($prrp) {
		$this->prrp = $prrp;
	}

	function setElidp($elidp) {
		$this->elidp = $elidp;
	}

	function setIdmcdp($idmcdp) {
		$this->idmcdp = $idmcdp;
	}

	function setValid($valid) {
		$this->valid = $valid;
	}

	function setCompro($compro) {
		$this->compro = $compro;
	}

	function setCpc($cpc) {
		$this->cpc = $cpc;
	}

	function setIdpb($idpb) {
		$this->idpb = $idpb;
	}


	function setValcdp($valcdp){
		$this->valcdp = $valcdp;
	}
	function setAnucdp($anucdp){
		$this->anucdp = $anucdp;
	}
	function setCxccdp($cxccdp){
		$this->cxccdp = $cxccdp;
	}
	function setValrp($valrp){
		$this->valrp = $valrp;
	}
	function setAnurp($anurp){
		$this->anurp = $anurp;
	}
	function setCxcrp($cxcrp){
		$this->cxcrp = $cxcrp;
	}


	//METODOS

	public function getAreas(){
		// $sql = "SELECT * FROM detpaa WHERE idpaa = ".$this->idpaa;		
		// $execute = $this->db->query($sql);
		// $pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		$sql = "SELECT * FROM valor WHERE parid=1 ORDER BY valnom";		
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getValPNJ($parid){
		$sql = "SELECT valid, valnom FROM valor WHERE parid='$parid' ORDER BY ncon";		
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();
		return $pfinan;
	}


	public function getSubAreas(){
		// $sql = "SELECT * FROM detpaa WHERE idpaa = ".$this->idpaa;		
		// $execute = $this->db->query($sql);
		// $pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		$sql = "SELECT * FROM valor WHERE valfijo =  ".$this->area ." ORDER BY valnom";		
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getAll(){
		// $sql = "SELECT * FROM detpaa WHERE idpaa = ".$this->idpaa;		
		// $execute = $this->db->query($sql);
		// $pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		$sql = "SELECT dt.*, rub.*, m.vafnom AS moda, f.vafnom AS fuen, a.valnom AS are FROM detpaa dt INNER JOIN rubro rub ON dt.codrub = rub.codrub INNER JOIN valfin AS m ON dt.tipcondpa=m.vafid INNER JOIN valfin AS f ON dt.ftefindpa=f.vafid INNER JOIN valor AS a ON dt.area=a.valid WHERE dt.idpaa =  ".$this->idpaa." AND dt.elidp=1";
		
			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}


	public function getAll2($area){
		// $sql = "SELECT * FROM detpaa WHERE idpaa = ".$this->idpaa;		
		// $execute = $this->db->query($sql);
		// $pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		$sql = "SELECT distinct dt.*, rub.*, m.vafnom AS moda, f.vafnom AS fuen, a.valnom AS are FROM detpaa dt INNER JOIN rubro rub ON dt.codrub = rub.codrub INNER JOIN valfin AS m ON dt.tipcondpa=m.vafid INNER JOIN valfin AS f ON dt.ftefindpa=f.vafid INNER JOIN valor AS a ON dt.area=a.valid WHERE dt.idpaa =  ".$this->idpaa." AND dt.elidp=1";
		if ($area) {
			$sql .= " and a.valid IN ($area)";
		}
		

//echo "<br><br>".$sql."<br><br>";
			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getAll3($area,$codrub,$areSel,$flu){
		// $sql = "SELECT * FROM detpaa WHERE idpaa = ".$this->idpaa;		
		// $execute = $this->db->query($sql);
		// $pfinan = $execute->fetchall(PDO::FETCH_ASSOC);		

		$sql = "SELECT distinct dt.*, rub.*, m.vafnom AS moda, f.vafnom AS fuen, a.valnom AS are, fl.actflu, fl.color, pr.nompro FROM detpaa AS dt INNER JOIN rubro AS rub ON dt.codrub = rub.codrub INNER JOIN valfin AS m ON dt.tipcondpa=m.vafid INNER JOIN valfin AS f ON dt.ftefindpa=f.vafid INNER JOIN proceso AS pr ON dt.idpro=pr.idpro INNER JOIN valor AS a ON dt.area=a.valid INNER JOIN flujo as fl ON dt.idflu=fl.idflu WHERE dt.idpaa = ".$this->idpaa." AND rub.codrub=".$codrub." AND dt.elidp=1 AND dt.idflu IN (".$flu.") AND dt.elidp=1";

		// var_dump($sql);
		// die();
		if ($areSel) {
			$sql .= " and dt.area IN ($areSel)";
		}else{
			$sql .= " and dt.area IN ($area)";
		}

		//echo "<br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getAll4($area,$codrub,$areSel,$flu){
		// var_dump('a');
		// die();
		
		// $sql = "SELECT * FROM detpaa WHERE idpaa = ".$this->idpaa;		
		// $execute = $this->db->query($sql);
		// $pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		$sql = "SELECT distinct dt.*, rub.*, m.vafnom AS moda, f.vafnom AS fuen, a.valnom AS are, fl.actflu, fl.color, pr.nompro FROM detpaa AS dt INNER JOIN rubro AS rub ON dt.codrub = rub.codrub INNER JOIN valfin AS m ON dt.tipcondpa=m.vafid INNER JOIN valfin AS f ON dt.ftefindpa=f.vafid INNER JOIN proceso AS pr ON dt.idpro=pr.idpro INNER JOIN valor AS a ON dt.area=a.valid INNER JOIN flujo as fl ON dt.idflu=fl.idflu WHERE dt.idpaa =  ".$this->idpaa." AND rub.codrub=".$codrub." AND dt.idflu IN (".$flu.") AND dt.elidp=1";

		// var_dump($sql);
		// die();
		if ($areSel) {
			$sql .= " and dt.area IN ($areSel)";
		}else{
			$sql .= " and dt.area IN ($area)";
		}
//echo "<br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getAll5($area,$areSel,$flu){
		$sql = "SELECT distinct dt.*, rub.*, m.vafnom AS moda, f.vafnom AS fuen, a.valnom AS are, fl.actflu, fl.color, pr.nompro FROM detpaa AS dt INNER JOIN rubro AS rub ON dt.codrub = rub.codrub INNER JOIN valfin AS m ON dt.tipcondpa=m.vafid INNER JOIN valfin AS f ON dt.ftefindpa=f.vafid INNER JOIN proceso AS pr ON dt.idpro=pr.idpro INNER JOIN valor AS a ON dt.area=a.valid INNER JOIN flujo as fl ON dt.idflu=fl.idflu WHERE dt.idpaa =  ".$this->idpaa." AND dt.idflu IN ($flu) AND dt.elidp=1 AND fl.areas LIKE '%".$area."%'";
		if ($areSel) {
			$sql .= " AND dt.area IN ($areSel)";
		}
//echo "<br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getAll6($area,$areSel,$flu){		

		$sql = "SELECT distinct dt.*, rub.*, m.vafnom AS moda, f.vafnom AS fuen, a.valnom AS are, fl.actflu, fl.color FROM detpaa AS dt INNER JOIN rubro AS rub ON dt.codrub = rub.codrub INNER JOIN valfin AS m ON dt.tipcondpa=m.vafid INNER JOIN valfin AS f ON dt.ftefindpa=f.vafid INNER JOIN valor AS a ON dt.area=a.valid INNER JOIN flujo as fl ON dt.idflu=fl.idflu WHERE dt.idpaa = ".$this->idpaa." AND dt.idflu IN (".$flu.") AND dt.elidp=1";
		/* $sql .= " AND fl.areas=".$area;
		if ($areSel) {
			$sql .= " AND dt.area IN ($areSel)";
		}*/
//echo "<br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}
	public function getOne(){
		// $sql = "SELECT * FROM detpaa WHERE idpaa = ".$this->idpaa;		
		// $execute = $this->db->query($sql);
		// $pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		$sql = "SELECT distinct dt.*, rub.*, flu.areas AS fluareas, m.vafnom AS moda, f.vafnom AS fuen, a.valnom AS are, fl.vafid AS ft FROM detpaa dt INNER JOIN rubro rub ON dt.codrub = rub.codrub INNER JOIN valfin AS m ON dt.tipcondpa=m.vafid INNER JOIN valfin AS f ON dt.ftefindpa=f.vafid LEFT JOIN flujo AS flu ON dt.idflu = flu.idflu INNER JOIN valor AS a ON dt.area=a.valid LEFT JOIN futic AS fl ON dt.iddpa = fl.iddpa WHERE dt.iddpa =  ".$this->iddpa;
		
			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getVig(){
		$sql = "SELECT DISTINCT idpaa FROM detpaa";		
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		/*var_dump($rub);
		die();*/

		return $pfinan;
	}

	public function selPf(){
		// $sql = "SELECT * FROM detpaa WHERE codrub =".$this->codrub;		
		// $execute = $this->db->query($sql);
		// $edpf = $execute->fetchall(PDO::FETCH_ASSOC);

		$sql = "SELECT dt.*, rub.* FROM detpaa dt "
				. "INNER JOIN rubro rub ON dt.codrub = rub.codrub "
				. " WHERE dt.codrub = ".$this->codrub." AND dt.elidp=1";		
		$execute = $this->db->query($sql);
		$edpf = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($edpf);
		// die();

		return $edpf;
	}


	public function selgrPie(){
		// $sql = "SELECT * FROM detpaa WHERE codrub =".$this->codrub;		
		// $execute = $this->db->query($sql);
		// $edpf = $execute->fetchall(PDO::FETCH_ASSOC);

		$sql = "SELECT d.codrub, r.nomrub,d.area, v.valnom, Sum(d.asidpa) AS Asig, sum(d.valvigact) AS Valact FROM detpaa AS d INNER JOIN rubro AS r ON d.codrub=r.codrub INNER JOIN valor AS v ON d.area=v.valid WHERE d.codrub={$this->codrub} AND d.elidp=1 GROUP BY d.codrub, r.nomrub,d.area, v.valnom";
 
					
		$execute = $this->db->query($sql);
		$edpf = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($edpf);
		// die();

		return $edpf;
	}

	public function selgrChartxy($idpaa, $areas){				
		$sql = "SELECT d.idpaa, d.codrub, pr.nompro, r.codrub2, r.nomrub,d.area,d.iddpa, v.valnom, (SELECT sum(h.asidpa) FROM detpaa AS h WHERE h.codrub=d.codrub and h.idpaa='$idpaa' AND h.area IN ($areas) AND elidp=1) AS Asig, sum(d.valvigact) AS Valact FROM detpaa AS d INNER JOIN rubro AS r ON d.codrub=r.codrub INNER JOIN proceso AS pr ON d.idpro=pr.idpro INNER JOIN valor AS v ON d.area=v.valid WHERE d.idpaa='$idpaa' AND d.elidp=1";
		$sql .= " AND d.area IN ($areas)";
		$sql .= " GROUP BY d.codrub, r.nomrub";

		//echo "<br><br>".$sql."<br><br>";		
		$execute = $this->db->query($sql);
		$edpf = $execute->fetchall(PDO::FETCH_ASSOC);

		 // var_dump($edpf);
		 // die();

		return $edpf;
	}

	public function selgrChartxy2($idpaa,$codrub){
		// $sql = "SELECT * FROM detpaa WHERE codrub =".$this->codrub;		
		// $execute = $this->db->query($sql);
		// $edpf = $execute->fetchall(PDO::FETCH_ASSOC);

		$sql = "SELECT d.codrub, r.nomrub,d.area, v.valnom, Sum(d.asidpa) AS Asig, sum(d.valvigact) AS Valact FROM detpaa AS d INNER JOIN rubro AS r ON d.codrub=r.codrub INNER JOIN valor AS v ON d.area=v.valid WHERE d.area={$_SESSION['depid']} AND d.idpaa='$idpaa' AND d.codrub='$codrub' AND d.elidp=1 GROUP BY d.codrub, r.nomrub,d.area, v.valnom";

		//echo $sql;		
		$execute = $this->db->query($sql);
		$edpf = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($edpf);
		// die();

		return $edpf;
	}




	public function getRub($editp){
		// $sql = "SELECT * FROM detpaa WHERE codrub =".$this->codrub;		
		// $execute = $this->db->query($sql);
		// $edpf = $execute->fetchall(PDO::FETCH_ASSOC);

		//$sql = "SELECT * FROM rubro WHERE actrub = 1 ORDER BY FIELD (codrub,$editp)DESC, codrub";	 
		$sql = "SELECT * FROM rubro WHERE actrub = 1 ORDER BY codrub DESC";
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($edpf);
		// die();

		return $rub;
	}

	public function edpf(){

		//*********
		// $sql = "UPDATE rubro SET nomrub=?,deprub=?,actrub=? ";
		// $sql .= " WHERE codrub={$this->codrub};";	

		// $update= $this->db->prepare($sql);
		// $arrdata = array($this->getNomrub(), $this->getDeprub(), $this->getActrub());
		// $save=$update->execute($arrdata);
		//*************
		

		$sql = "UPDATE detpaa SET objdpa=?,inidpa=?,prodpa=?,unspsc=?,fecinidpa=?,nmesdpa=?,asidpa=?,pmes=?, ";
		$sql .= " umes=?, valdpa=?, fecfindpa=?";
		$sql .= " WHERE codrub={$this->codrub};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getObjdpa(), $this->getInidpa(), $this->getProdpa(), $this->getUnspsc(), $this->getFecinidpa(), $this->getNmesdpa(), $this->getAsidpa(), $this->getPmes(), $this->getUmes(), $this->getValdpa(), $this->getFecfindpa());
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

		// var_dump($result);
		// die();
		return $result;
	}


	public function edpaa(){	


		$sql = "UPDATE detpaa SET area=?, nobjeto=?, nomcont=?, codrub=?,objdpa=?,inidpa=?,prodpa=?,unspsc=?,fecinidpa=?, nmesdpa=?, cuodpa=?, tipcondpa=?,ftefindpa=?, nmesdpa=?, asidpa=?,valvigact=?,fecfindpa=?,reqvigf=?,unidad=?,ubicacion=?,resp=?, observaciones=?, ordgas=?, idpro=?, idflu=?, metadp=?, resoludp=?, compro=?, cpc=?";
		$sql .= " WHERE iddpa={$this->iddpa};";	


		$update= $this->db->prepare($sql);
		$arrdata = array($this->getArea(), $this->getNObjeto(), $this->getNomcont(), $this->getCodrub(),$this->getObjdpa(), $this->getInidpa(), $this->getProdpa(), $this->getUnspsc(), $this->getFecinidpa(), $this->getNmesdpa(), $this->getCuodpa(), $this->getTipcondpa(), $this->getFtefindpa(), $this->getNmesdpa(), $this->getAsidpa(), $this->getValvigact(), $this->getFecfindpa(),$this->getReqvigf(), $this->getUnidad(), $this->getUbicacion(), $this->getResp(), $this->getObservaciones(), $this->getOrdgas(), $this->getIdpro(), $this->getIdflu(), $this->getMetadp(), $this->getResoludp(), $this->getCompro(), $this->getCpc());
		$save=$update->execute($arrdata);
		
			// var_dump($sql);
			// var_dump($save);
			// echo "<br>";
			// var_dump($arrdata);
			// $error= $this->db->errorInfo();
			// print_r($error);
			// die();
		
		$result = false;
		if($save){
			$result = true;
		}

		// var_dump($result);
		// die();
		return $result;
	}

	//EDITAR ANTEPROYECTO
	public function edpaaAnt(){	

		// var_dump($this->iddpa);
		// die();


		$sql = "UPDATE detpaa SET area=?, nobjeto=?, nomcont=?, codrub=?,objdpa=?,inidpa=?,prodpa=?,unspsc=?,fecinidpa=?,tipcondpa=?,ftefindpa=?, nmesdpa=?, asidpa=?,valvigact=?,fecfindpa=?,reqvigf=?,unidad=?,ubicacion=?,resp=?,idpro=?,idflu=?,ordgas=?";
		$sql .= " WHERE iddpa={$this->iddpa};";	


		$update= $this->db->prepare($sql);
		$arrdata = array($this->getArea(), $this->getNObjeto(), $this->getNomcont(), $this->getCodrub(),$this->getObjdpa(), $this->getInidpa(), $this->getProdpa(), $this->getUnspsc(), $this->getFecinidpa(),$this->getTipcondpa(), $this->getFtefindpa(), $this->getNmesdpa(), $this->getAsidpa(), $this->getValvigact(), $this->getFecfindpa(),$this->getReqvigf(), $this->getUnidad(), $this->getUbicacion(), $this->getResp(),$this->getIdpro(),$this->getIdflu(),$this->getOrdgas());
		$save=$update->execute($arrdata);
		
			// var_dump($sql);
			// var_dump($save);
			// echo "<br>";
			// var_dump($arrdata);
			// $error= $this->db->errorInfo();
			// print_r($error);
			// die();
		
		$result = false;
		if($save){
			$result = true;
		}

		// var_dump($result);
		// die();
		return $result;
	}	


	public function mInserAntp(){
		$sql = "INSERT INTO detpaa(idpaa, nicod, nobjeto, nomcont, area, codrub, objdpa, inidpa, prodpa, unspsc, fecinidpa, nmesdpa, cuodpa, tipcondpa, ftefindpa, asidpa, pmes, umes, valdpa, valvigact, fecfindpa, reqvigf,solivigf, unidad, ubicacion, resp, celres, mailres, ncdppc, fecsol, observaciones, idpro, idflu, depidd,ordgas,metadp,resoludp,cpc,idpb) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";

			// var_dump($sql);
			// die();

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getIdpaa(), $this->getNicod(), $this->getNobjeto(), $this->getNomcont(), $this->getArea(), $this->getCodrub(), $this->getObjdpa(), $this->getInidpa(), $this->getProdpa(), $this->getUnspsc(), $this->getFecinidpa(), $this->getNmesdpa(), $this->getCuodpa(), $this->getTipcondpa(), $this->getFtefindpa(), $this->getAsidpa(), $this->getPmes(), $this->getUmes(), $this->getValdpa(), $this->getValvigact(), $this->getFecfindpa(), $this->getReqvigf(), $this->getSolivigf(), $this->getUnidad(), $this->getUbicacion(), $this->getResp(), $this->getCelres(), $this->getMailres(), $this->getNcdppc(), $this->getFecsol(), $this->getObservaciones(), $this->getIdpro(), $this->getIdflu(),  NULL, $this->getOrdgas(), $this->getMetadp(), $this->getResoludp(), $this->getCpc(),$this->getIdpb());

		$save=$update->execute($arrdata);
		
		
			// var_dump($sql);
			// var_dump($arrdata);
			// // $error= $this->db->errorInfo();
			// // print_r($error);
			// die();
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function mInserPresu(){
		$sql = "INSERT INTO detpaa(idpaa, nicod, nobjeto, nomcont, area, codrub, objdpa, inidpa, prodpa, unspsc, fecinidpa, nmesdpa, cuodpa, tipcondpa, ftefindpa, asidpa, pmes, umes, valdpa, valvigact, fecfindpa, reqvigf,solivigf, unidad, ubicacion, resp, celres, mailres, ncdppc, fecsol, observaciones, idpro, idflu, depidd,ordgas,metadp,resoludp,cpc,idpb,elidp) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";

			// var_dump($sql);
			// die();

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getIdpaa(), $this->getNicod(), $this->getNobjeto(), $this->getNomcont(), $this->getArea(), $this->getCodrub(), $this->getObjdpa(), $this->getInidpa(), $this->getProdpa(), $this->getUnspsc(), $this->getFecinidpa(), $this->getNmesdpa(), $this->getCuodpa(), $this->getTipcondpa(), $this->getFtefindpa(), $this->getAsidpa(), $this->getPmes(), $this->getUmes(), $this->getValdpa(), $this->getValvigact(), $this->getFecfindpa(), $this->getReqvigf(), $this->getSolivigf(), $this->getUnidad(), $this->getUbicacion(), $this->getResp(), $this->getCelres(), $this->getMailres(), $this->getNcdppc(), $this->getFecsol(), $this->getObservaciones(), $this->getIdpro(), $this->getIdflu(),  NULL, $this->getOrdgas(), $this->getMetadp(), $this->getResoludp(), $this->getCpc(),$this->getIdpb(),$this->getElidp());
		$save=$update->execute($arrdata);
		
		
			// var_dump($sql);
			// var_dump($arrdata);
			// // $error= $this->db->errorInfo();
			// // print_r($error);
			// die();
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function ordenadorgas(){
		$sql = "SELECT p.*, v.valnom FROM persona AS p INNER JOIN valor AS v ON p.cargo=v.valid WHERE p.ordgas=1 AND p.actemp=1 ORDER BY p.pernom, p.perape";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		
		// var_dump($ordgasto);
		// die();
		return $ordgasto;
	}

	
	public function deparea($valid){
		$sql = "SELECT valid,valnom FROM valor WHERE valfijo IN ($valid)";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		
		// var_dump($ordgasto);
		// die();
		return $ordgasto;
	}

	public function depareas($valid){
		$sql = "SELECT valid, valnom FROM valor WHERE valid IN ($valid) ORDER BY valnom";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		
		// var_dump($ordgasto);
		// die();
		return $ordgasto;
	}

	public function sumcdp($iddpa, $areas, $vigencia){

		$var1=$this->getFCrea(1);
		$var2=$this->getFCrea(4);
		$var3=$this->getFCrea(5);

		$sql = "SELECT sum(asidpa) AS cdp FROM detpaa WHERE iddpa='$iddpa' and idflu NOT IN ($var1,$var2,$var3) AND area IN ($areas) AND elidp=1 AND idpaa=$vigencia";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
	}

	public function sumrp($iddpa, $areas, $vigencia){
		$var2=$this->getFCrea(4);
		$sql = "SELECT sum(asidpa) AS rp FROM detpaa WHERE iddpa='$iddpa' and idflu IN ($var2) AND area IN ($areas) AND elidp=1 AND idpaa=$vigencia";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
	}

	public function sumcdpR($codrub, $areas,$vigencia){
		//echo $vigencia;
		
		$var1=$this->getFCrea(1);
		$var2=$this->getFCrea(4);
		$var3=$this->getFCrea(5);

		$sql = "SELECT sum(asidpa) AS cdp FROM detpaa WHERE codrub='$codrub' and idflu NOT IN ($var1,$var2,$var3) AND area IN ($areas) AND elidp=1 AND idpaa=$vigencia";


		//echo "<br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
	}

	public function sumrpR($codrub, $areas, $vigencia){
		$var2=$this->getFCrea(4);
		$sql = "SELECT sum(asidpa) AS rp FROM detpaa WHERE codrub='$codrub' and idflu IN ($var2) AND area IN ($areas) AND elidp=1 AND idpaa=$vigencia";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
	}

	public function contcdpR($codrub, $areas, $vigencia){
		$var1=$this->getFCrea(1);
		$var2=$this->getFCrea(4);
		$var3=$this->getFCrea(5);
		$sql = "SELECT COUNT(asidpa) AS alerta FROM detpaa WHERE codrub='$codrub' and idflu NOT IN ($var1,$var2,$var3) AND area IN ($areas) AND elidp=1 AND idpaa=$vigencia";
		//echo "<br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
	}

	public function contrpR($codrub, $areas, $vigencia){
		$var2=$this->getFCrea(4);
		$sql = "SELECT COUNT(asidpa) AS alerta FROM detpaa WHERE codrub='$codrub' and idflu IN ($var2) AND area IN ($areas) AND elidp=1 AND idpaa=$vigencia";
		//echo "<br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
	}
	
	public function vigact(){
		
		$sql = "SELECT idpaa FROM paa WHERE estpaa=3";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
	}



	// public function mgetOneIddpa(){

	// 	$sql = "SELECT iddpa FROM detpaa WHERE idpaa=? AND nicod=? AND nobjeto=? AND nomcont=? AND area=? AND codrub=? AND objdpa=? AND inidpa=? AND prodpa=? AND unspsc=? AND fecinidpa=? AND nmesdpa=? AND tipcondpa=? AND ftefindpa=? AND asidpa=? AND pmes=? AND umes=? AND valdpa=? AND valvigact=? AND fecfindpa=? AND reqvigf=? AND solivigf=? AND unidad=? AND ubicacion=? AND resp=? ";	

	// 	$update= $this->db->prepare($sql);
	// 	$arrdata = array($this->getIdpaa(), $this->getNicod(), $this->getNobjeto(), $this->getNomcont(), $this->getArea(), $this->getCodrub(), $this->getObjdpa(), $this->getInidpa(), $this->getProdpa(), $this->getUnspsc(), $this->getFecinidpa(), $this->getNmesdpa(), $this->getTipcondpa(), $this->getFtefindpa(), $this->getAsidpa(), $this->getPmes(), $this->getUmes(), $this->getValdpa(), $this->getValvigact(), $this->getFecfindpa(), $this->getReqvigf(), $this->getSolivigf(), $this->getUnidad(), $this->getUbicacion(), $this->getResp());
	// 	$save=$update->execute($arrdata);
		
		
	// 		var_dump($sql);
	// 		var_dump($save);
	// 		$error= $this->db->errorInfo();
	// 		print_r($error);
	// 		die();
		
	// 	$result = false;
	// 	if($save){
	// 		$result = true;
	// 	}
	// 	return $result;
	// }



	//RECUPERAR ULTIMO ID GENERADO - FUNCIONA INDIVIDUAL POR SESION
	public function mgetOneIddpa(){

		//$sql = "SELECT idpaa FROM paa WHERE estpaa=3";
		$sql = "select last_insert_id()";
		$execute = $this->db->query($sql);
		$ffuticp = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($ffuticp);
		// die();
		return $ffuticp;
		//select last_insert_id()
	}

	public function inFutic(){
		$sql = "INSERT INTO futic(iddpa, vafid) VALUES (?,?) ";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getCodIddpa(), $this->getFfutic());
		$save=$update->execute($arrdata);
		
		
			// var_dump($sql);
			// var_dump($arrdata);
			// $error= $this->db->errorInfo();
			// print_r($error);
			// die();
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function actFutic(){


		// $sql = "UPDATE futic SET vafid=?";
		// $sql .= " WHERE iddpa={$this->codIddpa};";	

		$sql2 = "DELETE FROM futic WHERE iddpa={$this->codIddpa};";	
		$update= $this->db->prepare($sql2);	
		$save=$update->execute();

		$sql = "INSERT INTO futic(iddpa, vafid) VALUES (?,?) ";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getCodIddpa(), $this->getFfutic());
		$save=$update->execute($arrdata);	

		// var_dump($this->getCodIddpa());
		// die();			
		
		$result = false;
		if($save){
			$result = true;
		}
		
		return $result;
	}

	//OBTENER SIGLA AREA

	public function sigla($area){

		$sql = "SELECT l.*, (SELECT max(v.ncon) FROM valor AS v WHERE v.abr=l.abr) AS Mncon FROM valor AS l WHERE l.valid='$area' ";
		$execute = $this->db->query($sql);
		$sig = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($sig);
		// die();
		return $sig;
	}

	//ACTUALIZAR CONSECUTIVO PROCESO CONTRACTUAL ncon

	public function actNcon($area,$nnpc,$sigla){

		$sql = "UPDATE valor SET ncon=? WHERE abr='$sigla' AND parid=1 ";

		$update= $this->db->prepare($sql);
		$arrdata = array($nnpc);
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

		// var_dump($result);
		// die();
		return $result;
	}

	public function flujo($pre){
		$sql = "SELECT * FROM flujo WHERE idpro='$pre' ";
		$execute = $this->db->query($sql);
		$sig = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($sig);
		// die();
		return $sig;
	}

	//CREAR CPD
	public function regCdp(){		

		$sql = "INSERT INTO detpaa(idpaa, nicod, nobjeto, nomcont, area, codrub, objdpa, inidpa, prodpa, unspsc, fecinidpa, nmesdpa, cuodpa, tipcondpa, ftefindpa, asidpa, pmes, umes, valdpa, valvigact, fecfindpa, reqvigf,solivigf, unidad, ubicacion, resp, celres, mailres, ncdppc, fecsol, observaciones, idpro, idflu, depidd,ordgas,metadp,resoludp,cpc,idpb) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getIdpaa(), $this->getNicod(), $this->getNobjeto(), $this->getNomcont(), $this->getArea(), $this->getCodrub(), $this->getObjdpa(), $this->getInidpa(), $this->getProdpa(), $this->getUnspsc(), $this->getFecinidpa(), $this->getNmesdpa(), $this->getCuodpa(), $this->getTipcondpa(), $this->getFtefindpa(), $this->getAsidpa(), $this->getPmes(), $this->getUmes(), $this->getValdpa(), $this->getValvigact(), $this->getFecfindpa(), $this->getReqvigf(), $this->getSolivigf(), $this->getUnidad(), $this->getUbicacion(), $this->getResp(), '111111', $this->getMailres(), $this->getNcdppc(), $this->getFecsol(), $this->getObservaciones(), $this->getIdpro(), $this->getIdflu(),  $this->getIddpa(), $this->getOrdgas(), $this->getMetadp(), $this->getResoludp(), $this->getCpc(),$this->getIdpb());
			// var_dump($this->getIdpb());
			// die();
			//var_dump($arrdata);
		$save=$update->execute($arrdata);
		
		
			//var_dump($sql);
			//var_dump($arrdata);
			//var_dump($save);
			// $error= $this->db->errorInfo();
			// print_r($error);
			//die();
		
		$result = false;
		// var_dump('aqui');
		// die();
		if($save){
			$result = true;				
				
		}
		return $result;
	}


	public function actVCdp($nvalor,$iddpa){
		$sql = "UPDATE detpaa SET asidpa=? WHERE iddpa='$iddpa' ";

		$update= $this->db->prepare($sql);
		$arrdata = array($nvalor);
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

		// var_dump($result);
		// die();
		return $result;
	}

	public function eliTraza($iddpa){
		$sql = "DELETE FROM trazadetpaa WHERE iddpa='$iddpa' ";
		$update= $this->db->prepare($sql);
		$save=$update->execute();

		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function eliCdp($iddpa){
		$sql = "DELETE FROM detpaa WHERE iddpa='$iddpa' ";
		$update= $this->db->prepare($sql);
		$save=$update->execute();

		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function traza($iddpa,$idflu,$obs,$fec,$perid){
		$sql = "INSERT INTO trazadetpaa (iddpa, idflu, obs, fec, perid) VALUES ('$iddpa','$idflu','$obs','$fec', '$perid') ";

		$save = $this->db->query($sql);
		
		
			// var_dump($sql);
			// var_dump($save);

			// //var_dump($arrdata);
			// $error= $this->db->errorInfo();
			// print_r($error);
			// die();
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	// Total valor asignado de un registro
	public function TotAsig($iddpa){

		$sql = "SELECT asidpa, (SELECT SUM(asidpa) FROM detpaa WHERE depidd='$iddpa' AND elidp=1) AS TotAsig FROM detpaa WHERE iddpa='$iddpa' AND elidp=1";
		// echo "<br>".$sql."<br>";
		$execute = $this->db->query($sql);
		$sig = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($sig);
		// die();
		return $sig;
	}

	public function aprFlujo($iddpa,$idflu,$observa,$fec,$rutcdp,$nbogdata,$rutrp){

		$sql2 = "UPDATE detpaa SET idflu='$idflu', observaciones='$observa', rutcdp='$rutcdp', nbogdata='$nbogdata', rutrp='$rutrp' WHERE iddpa='$iddpa'";	
		$update= $this->db->prepare($sql2);	
		$save=$update->execute();

		// var_dump($update);
		// var_dump($save);
		// die();						
		
		$result = false;
		if($save){
			$result = true;
		}
		
		return $result;
	}

	public function aprFlujoSF($iddpa,$idflu,$observa,$fec,$rutcdp,$nbogdata,$rutrp,$nexpcdp,$nrp){
		$sql2 = "UPDATE detpaa SET idflu='$idflu', observaciones='$observa', rutcdp='$rutcdp', nbogdata='$nbogdata', rutrp='$rutrp', nexpcdp='$nexpcdp', nrp='$nrp' WHERE iddpa='$iddpa' ";	
		$update= $this->db->prepare($sql2);	
		$save=$update->execute();

		// var_dump($update);
		// var_dump($save);
		// die();						
		
		$result = false;
		if($save){
			$result = true;
		}
		
		return $result;
	}
///////// Inicio Masivo /////////////////////////////////////////////
	public function aprFluM($iddpa,$idflu){
		$sql2 = "UPDATE detpaa SET idflu='$idflu' WHERE iddpa='$iddpa'";	
		$update= $this->db->prepare($sql2);	
		$save=$update->execute();

		// var_dump($update);
		// var_dump($save);
		// die();						
		
		$result = false;
		if($save){
			$result = true;
		}
		
		return $result;
	}

	public function aprFluSFM($iddpa,$idflu,$nexpcdp,$nrp){
		$sql2 = "UPDATE detpaa SET idflu='$idflu', nexpcdp='$nexpcdp', nrp='$nrp' WHERE iddpa='$iddpa' ";	
		$update= $this->db->prepare($sql2);	
		$save=$update->execute();

		// var_dump($update);
		// var_dump($save);
		// die();						
		
		$result = false;
		if($save){
			$result = true;
		}
		
		return $result;
	}
///////// Fin Masivo /////////////////////////////////////////////


	//SIGLA RP
	public function siglaNrp($ftefindpa){
		$sql = "SELECT * FROM valfin WHERE vafid='$ftefindpa' ";
		$execute = $this->db->query($sql);
		$sig = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($sig);
		// die();
		return $sig;
	}

	//CONSECUTIVO RP
	public function conRP($estpaa){
		$sql = "SELECT * FROM paa WHERE estpaa='$estpaa' ";
		$execute = $this->db->query($sql);
		$sig = $execute->fetchall(PDO::FETCH_ASSOC);
		// var_dump($sig);
		// die();


		return $sig;
	}

	public function conPaa($iddpa,$consRP){
		$sql = "UPDATE paa SET ncexpcdp=? WHERE idpaa='$iddpa' ";

		$update= $this->db->prepare($sql);
		$arrdata = array($consRP);
		$save=$update->execute($arrdata);
	}

	public function responsables(){
			
		$sql = "SELECT p.*, v.valnom FROM persona AS p INNER JOIN valor AS v ON p.cargo=v.valid WHERE p.ordgas IN (1,2) AND p.actemp=1 ORDER BY p.pernom, p.perape";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		
		// var_dump($ordgasto);
		// die();
		return $ordgasto;
	}

	public function responsables2(){
			
		$sql = "SELECT p.*, v.valnom FROM persona AS p INNER JOIN valor AS v ON p.cargo=v.valid WHERE p.ordgas IN (1) AND p.actemp=1 ORDER BY p.pernom, p.perape";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		
		// var_dump($ordgasto);
		// die();
		return $ordgasto;
	}

	public function getPersona($perid){
			
		$sql = "SELECT p.*, v.valnom FROM persona AS p INNER JOIN valor AS v ON p.cargo=v.valid WHERE perid=$perid";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		
		// var_dump($ordgasto);
		// die();
		return $ordgasto;
	}

	public function elimCuota($iddpa){
		// $sql = "DELETE FROM cuota WHERE iddpa='$iddpa' ";
		// $update= $this->db->prepare($sql);
		// $arrdata = array($iddpa);
		// $save=$update->execute($arrdata);
		if ($iddpa>0) {
			$sql = "DELETE FROM cuota WHERE iddpa=$iddpa ";
			$update= $this->db->prepare($sql);
			$arrdata = array($iddpa);
			//var_dump($sql);
			//die();
			$save=$update->execute();
		}
	}

	public function insCuota($iddpa,$valor){
		$sql = "INSERT INTO cuota(iddpa, valor) VALUES ('$iddpa','$valor') ";
		$save = $this->db->query($sql);
	}

	public function updOrdgas($ordgas,$iddpa){
		$sql2 = "UPDATE detpaa SET ordgas='$ordgas' WHERE iddpa='$iddpa' ";	
		$update= $this->db->prepare($sql2);	
		$save=$update->execute();

		// var_dump($update);
		//var_dump($save);
		//die();						
		
		$result = false;
		if($save){
			$result = true;
		}
		
		return $result;
	}

	public function getCuota($iddpa){
		$sql2 = "SELECT valor FROM cuota WHERE iddpa='$iddpa' ";	
		$execute = $this->db->query($sql2);
		$cuot = $execute->fetchall(PDO::FETCH_ASSOC);
		
		// var_dump($cuot);
		// die();
		return $cuot;
	}

	public function getVFlujo($idpro){
		$sql2 = "SELECT MIN(idflu) As mini, MAX(idflu) As maxi FROM flujo WHERE ntipo IN (1,2,3) AND idpro='$idpro' ";	
		$execute = $this->db->query($sql2);
		$cuot = $execute->fetchall(PDO::FETCH_ASSOC);
		
		// var_dump($cuot);
		// die();
		return $cuot;
	}

	public function getIdproc($iddpa){
		$sql2 = "SELECT idpro FROM detpaa WHERE iddpa='$iddpa';";	
		$execute = $this->db->query($sql2);
		$cuot = $execute->fetchall(PDO::FETCH_ASSOC);
		
		// var_dump($cuot);
		// die();
		return $cuot;
	}

	public function getRadiNexpcdp($iddpa){
		$sql2 = "SELECT * FROM detpaa WHERE iddpa='$iddpa';";	
		$execute = $this->db->query($sql2);
		$cuot = $execute->fetchall(PDO::FETCH_ASSOC);
		
		// var_dump($cuot);
		// die();
		return $cuot;
	}

	public function getFCrea($nt){
		$sql2 = "SELECT * FROM flujo WHERE ntipo='$nt';";	
		$execute = $this->db->query($sql2);
		$cuot = $execute->fetchall(PDO::FETCH_ASSOC);
		$v="";
		$i=0;

		foreach ($cuot as $c) {
			$v .= $c['idflu'];
			if ($i<=count($cuot)-2) {
				$v .= ',';
			}
			$i++;
		}
		// var_dump($cuot);
		// die();
		return $v;
	}

	public function getFCreaM($nt){
		$sql2 = "SELECT * FROM flujo WHERE ntipo='$nt';";	
		$execute = $this->db->query($sql2);
		$cuot = $execute->fetchall(PDO::FETCH_ASSOC);
		return $cuot;
	}

	public function getVFlujoPro($idpro,$ntipo){
		$sql2 = "SELECT MIN(idflu) AS mini, MAX(idflu) AS maxi FROM flujo WHERE idpro=$idpro AND ntipo='$ntipo' ";	
		$execute = $this->db->query($sql2);
		$cuot = $execute->fetchall(PDO::FETCH_ASSOC);
		
		// var_dump($cuot);
		// die();
		return $cuot;
	}

	//proceso CPD
	public function pcdp(){
		$sql2 = "SELECT * FROM proceso WHERE idpro BETWEEN 5004 AND 6000";	
		$execute = $this->db->query($sql2);
		$cuot = $execute->fetchall(PDO::FETCH_ASSOC);
		
		// var_dump($cuot);
		// die();
		return $cuot;
	}

	//Num en el que inicia el flujo
	public function iniflu($idpro){
		$sql2 = "SELECT MIN(idflu) AS mini FROM flujo WHERE idpro='$idpro'";	
		$execute = $this->db->query($sql2);
		$cuot = $execute->fetchall(PDO::FETCH_ASSOC);
		
		// var_dump($cuot);
		// die();
		return $cuot;
	}

	//Actualización para eliminar lógicamente
	public function updEliCdp($iddpa){
		$sql = "UPDATE detpaa SET elidp=2 WHERE iddpa='$iddpa' ";

		$update= $this->db->prepare($sql);
		$save=$update->execute();
		
		$result = false;
		if($save){
			$result = true;
		}

		// var_dump($result);
		// die();
		return $result;
	}

	//Actualización para liberación, parcial o total
	public function updLibera(){
		$sql = "UPDATE detpaa SET feclib=?,rutlib=?,estlib=? WHERE iddpa=?;";

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getFeclib(), $this->getRutlib(), $this->getEstlib(), $this->getIddpa());
		$save=$update->execute($arrdata);
		
		$result = false;
		if($save){
			$result = true;
		}

		// var_dump($result);
		// die();
		return $result;
	}
	
	public function libver($areSel,$estlib){		

		$sql = "SELECT distinct dt.*, rub.*, m.vafnom AS moda, f.vafnom AS fuen, a.valnom AS are, fl.actflu, fl.color FROM detpaa AS dt INNER JOIN rubro AS rub ON dt.codrub = rub.codrub INNER JOIN valfin AS m ON dt.tipcondpa=m.vafid INNER JOIN valfin AS f ON dt.ftefindpa=f.vafid INNER JOIN valor AS a ON dt.area=a.valid INNER JOIN flujo as fl ON dt.idflu=fl.idflu WHERE feclib IS NOT NULL AND rutlib IS NOT NULL AND dt.estlib='$estlib'";
		if ($areSel) {
			$sql .= " AND dt.area IN ($areSel)";
		}
//echo "<br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function updLibest(){
		$sql = "UPDATE detpaa SET estlib=? WHERE iddpa=?;";

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getEstlib(), $this->getIddpa());

		$save=$update->execute($arrdata);
		
		$result = false;
		if($save){
			$result = true;
		}

		// var_dump($result);
		// die();
		return $result;
	}

	public function seltrad($iddpa,$idflu){
		$sql = "SELECT * FROM trazadetpaa WHERE iddpa='$iddpa' AND idflu='$idflu'";
		//echo "<br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getAll7($areSel, $idpaa = 0, $rubroSel = null, $nobjetoSel = null) {
		// Iniciar la consulta SQL
		$sql = "SELECT DISTINCT dt.*, rub.*, m.vafnom AS moda, f.vafnom AS fuen, a.valnom AS are,
				CONCAT(p.pernom, ' ', p.perape) AS rspn, p.peremail, p.pertel, 
				CONCAT(og.pernom, ' ', og.perape) AS ordg, fl.actflu, ob.vafnom AS obj, 
				ii.vafnom AS ini, pr.vafnom AS pro, tc.vafnom AS tco, 
				ft.vafnom AS fte, pc.nompro, fi.vafnom AS resolu, 
				fn.vafnom AS pro, fo.vafnom AS meta, fo.vafnom AS comp, 
				ef.vafnom AS estfin 
				FROM detpaa dt 
				INNER JOIN rubro rub ON dt.codrub = rub.codrub 
				INNER JOIN valfin AS m ON dt.tipcondpa = m.vafid 
				INNER JOIN valfin AS f ON dt.ftefindpa = f.vafid 
				INNER JOIN valor AS a ON dt.area = a.valid 
				LEFT JOIN persona AS p ON dt.resp = p.perid 
				LEFT JOIN persona AS og ON dt.ordgas = og.perid 
				INNER JOIN flujo AS fl ON dt.idflu = fl.idflu 
				INNER JOIN valfin AS ef ON (ef.dofid = 12 AND fl.ntipo = ef.vaffijo) 
				INNER JOIN valfin AS ob ON dt.objdpa = ob.vafid 
				INNER JOIN valfin AS ii ON dt.inidpa = ii.vafid 
				INNER JOIN valfin AS pr ON dt.prodpa = pr.vafid 
				INNER JOIN valfin AS tc ON dt.tipcondpa = tc.vafid 
				INNER JOIN valfin AS ft ON dt.ftefindpa = ft.vafid 
				INNER JOIN proceso AS pc ON dt.idpro = pc.idpro 
				LEFT JOIN valfin AS fi ON dt.resoludp = fi.vafid 
				LEFT JOIN valfin AS fn ON dt.prodpa = fn.vafid 
				LEFT JOIN valfin AS fo ON dt.inidpa = fo.vafid 
				LEFT JOIN valfin AS fc ON dt.compro = fc.vafid 
				WHERE dt.elidp = 4 AND dt.idpaa = :idpaa";
		
		// Agregar filtros
		if ($areSel) {
			$sql .= " AND dt.area = :areSel";
		}
		if ($rubroSel) {
			$rubroSel = "%" . $rubroSel . "%";
			$sql .= " AND CAST(dt.codrub AS CHAR) LIKE :rubroSel";
		}
		if ($nobjetoSel) {
			$nobjetoSel = "%" . $nobjetoSel . "%";
			$sql .= " AND CAST(dt.nobjeto AS CHAR) LIKE :nobjetoSel";
		}
	
		// Registrar la consulta y los parámetros
		error_log("Consulta SQL: " . $sql);
		error_log("Parámetros: idpaa=" . $idpaa . ", areSel=" . $areSel . ", rubroSel=" . $rubroSel . ", nobjetoSel=" . $nobjetoSel);
	
		// Preparar la consulta
		$stmt = $this->db->prepare($sql);
	
		// Vincular los parámetros
		$stmt->bindValue(':idpaa', $idpaa, PDO::PARAM_INT);
		if ($areSel) {
			$stmt->bindValue(':areSel', $areSel, PDO::PARAM_INT);
		}
		if ($rubroSel) {
			$stmt->bindValue(':rubroSel', $rubroSel, PDO::PARAM_STR); 
		}
		if ($nobjetoSel) {
			$stmt->bindValue(':nobjetoSel', $nobjetoSel, PDO::PARAM_STR);
		}
	
		// Ejecutar la consulta
		$stmt->execute();
	
		// Log de los resultados de la consulta
		$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
		error_log("Resultados de la consulta: " . print_r($resultados, true));
		
		return $resultados;
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

	public function getPmcdpAll($vigencia){ //SELECCIONAR CUANTAS PLANTILLAS MULTIPLE CDP		

		$sql = "SELECT valid from valor WHERE parid=23 AND ncon = 1 AND valfijo=$vigencia ORDER BY valnom ASC";		
			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// //echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getPmcdp($nmcdp,$vigencia){ //PLANTILLA MULTIPLE CDP	

		// $sql = "SELECT dt.*, rub.*, m.vafnom AS moda, f.vafnom AS fuen, a.valnom AS are FROM detpaa dt INNER JOIN rubro rub ON dt.codrub = rub.codrub INNER JOIN valfin AS m ON dt.tipcondpa=m.vafid INNER JOIN valfin AS f ON dt.ftefindpa=f.vafid INNER JOIN valor AS a ON dt.area=a.valid WHERE dt.idpaa =  ".$this->idpaa." AND dt.elidp=1";

		// $sql = "SELECT * from detpaa dt INNER JOIN pmcdp pm on dt.iddpa = pm.iddpa INNER JOIN valor val on pm.noncdp = val.valid WHERE val.valid=$nmcdp AND dt.depidd is NULL";

		$sql = "SELECT * from detpaa dt INNER JOIN pmcdp pm on dt.iddpa = pm.iddpa INNER JOIN valor val on pm.noncdp = val.valid INNER JOIN rubro rb on dt.codrub = rb.codrub WHERE val.valid = $nmcdp AND dt.depidd is NULL AND val.valfijo=$vigencia";
		
			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($sql);
		// //echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getConNom($nomplant){ 

		$sql = "SELECT * from valor WHERE valnom='$nomplant' AND parid=23";		
			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		
		return $pfinan;
	}

	public function getNnum(){ //OBTNER NUMERO NUEVA PLANTILLA CDP		

		$sql = "SELECT MAX(valid) AS maxi from valor WHERE valid BETWEEN 10000 AND 10999 AND parid=23";		
			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// //echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function insNPCdp($nomplant,$nnum,$parid,$vigencia){
		// var_dump($nomplant);
		// var_dump($nnum);
		// var_dump($parid);
		// //die();
		$sql = "INSERT INTO valor(valid, valnom, parid, valfijo) VALUES ($nnum,'$nomplant',$parid,$vigencia) ";
		$save = $this->db->query($sql);
		// var_dump($sql);
		// die();
		
	}

	public function insRubsPCdp($iddpa,$nnum){
		$sql = "INSERT INTO pmcdp (iddpa, noncdp) VALUES ($iddpa,$nnum) ";
		$save = $this->db->query($sql);
		
	}

	public function delPmcdp($noncdp){
		// $sql2 = "DELETE FROM valor WHERE valid=$noncdp ";
		// $update2= $this->db->prepare($sql2);
		// $save2=$update2->execute();

		$sql = "UPDATE valor SET ncon=2 WHERE valid=$noncdp;";
		$update= $this->db->prepare($sql);		
		$save=$update->execute();

		$sql2 = "DELETE FROM pmcdp WHERE noncdp=$noncdp ";
		$update2= $this->db->prepare($sql2);
		$save=$update2->execute();

		

		
	}

	public function regMCdp(){		

		$sql = "INSERT INTO detpaa(idpaa, nicod, nobjeto, nomcont, area, codrub, objdpa, inidpa, prodpa, unspsc, fecinidpa, nmesdpa, cuodpa, tipcondpa, ftefindpa, asidpa, pmes, umes, valdpa, valvigact, fecfindpa, reqvigf,solivigf, unidad, ubicacion, resp, celres, mailres, ncdppc, fecsol, observaciones, idpro, idflu, depidd,ordgas,elidp,idmcdp,valid,cpc)  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getIdpaa(), $this->getNicod(), $this->getNobjeto(), $this->getNomcont(), $this->getArea(), $this->getCodrub(), $this->getObjdpa(), $this->getInidpa(), $this->getProdpa(), $this->getUnspsc(), $this->getFecinidpa(), $this->getNmesdpa(), $this->getCuodpa(), $this->getTipcondpa(), $this->getFtefindpa(), $this->getAsidpa(), $this->getPmes(), $this->getUmes(), $this->getValdpa(), $this->getValvigact(), $this->getFecfindpa(), $this->getReqvigf(), $this->getSolivigf(), $this->getUnidad(), $this->getUbicacion(), $this->getResp(), $this->getCelres(), $this->getMailres(), $this->getNcdppc(), $this->getFecsol(), $this->getObservaciones(), $this->getIdpro(), $this->getIdflu(),  $this->getIddpa(), $this->getOrdgas(), $this->getElidp(),$this->getIdmcdp(),$this->getValid(),$this->getCpc());
		$save=$update->execute($arrdata);
		
		
			// var_dump($this->getIddpa());
			// // var_dump($update);
			// // var_dump($arrdata);
			// var_dump($save);
			// $error= $this->db->errorInfo();
			// print_r($error);
			// die();
		
		$result = false;
		// var_dump('aqui');
		// die();
		if($save){
			$result = true;				
				
		}
		return $result;
	}


	public function getIdmcdps(){ 	

		$sql = "SELECT MAX(idmcdp) AS maxi from detpaa";			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// //echo $this->db->error;
		// die();

		return $pfinan;
	}


	public function regHMCdp($iddpa,$nnum){
		$sql = "INSERT INTO pmcdp (iddpa, noncdp) VALUES ($iddpa,$nnum) ";
		$save = $this->db->query($sql);
		
	}

	public function getMc(){
		$sql = "SELECT DISTINCT idmcdp from detpaa ";
		$sql .= " WHERE idpaa={$this->idpaa} AND elidp=1 AND idmcdp IS NOT NULL;";					
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// //echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getMCdpAll($idpaa,$idmcdp){
		$sql = "SELECT * from detpaa dt  INNER JOIN valor v on dt.valid = v.valid INNER JOIN proceso AS pr ON dt.idpro=pr.idpro INNER JOIN flujo f on dt.idflu = f.idflu WHERE idmcdp = $idmcdp AND elidp=1 AND idpaa=$idpaa";	
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// //echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function sumMCdp($idpaa,$idmcdp){
		$sql = "SELECT *, sum(dt.asidpa) AS Asig from detpaa dt  INNER JOIN valor v on dt.valid = v.valid WHERE idmcdp = $idmcdp AND elidp=1 AND idpaa=$idpaa";		

		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// //echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function idMCdpRub($idpaa,$iddpa){
		$sql = "SELECT idmcdp from detpaa WHERE iddpa=$iddpa AND idpaa=$idpaa AND elidp=1 ";			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// //echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getCodrubAll($idpaa,$idmcdp){
		$sql = "SELECT codrub,iddpa from detpaa WHERE idmcdp=$idmcdp AND idpaa=$idpaa AND elidp=1";			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// //echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getfl($idflu){
		$sql = "SELECT actflu from flujo WHERE idflu=$idflu";

		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		

		// var_dump($pfinan);
		// //echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function saldoPa($hdepid){
		$sql = "SELECT asidpa from detpaa WHERE iddpa=$hdepid";			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// //echo $this->db->error;
		// die();

		return $pfinan;

	}


	public function liberar($nuevoSaldoRp,$nuevoSalPa,$hdepid,$iddpa){

		$sql = "UPDATE detpaa SET asidpa=$nuevoSaldoRp WHERE iddpa=$iddpa;";
		$update= $this->db->prepare($sql);		
		$save=$update->execute();

		$sql2 = "UPDATE detpaa SET asidpa=$nuevoSalPa WHERE iddpa=$hdepid;";
		$update2= $this->db->prepare($sql2);		
		$save2=$update2->execute();

	}

	public function edPresu($iddpa,$cdps,$rps){

		// var_dump($cdps);
		// var_dump($rps);
		


		$sql = "UPDATE detpaa SET prcdp=$cdps, prrp=$rps WHERE iddpa=$iddpa;";
		

		$update= $this->db->prepare($sql);		
		$save=$update->execute();

		

	}

	public function edPlanoPaa($unspsc,$objeto,$objdpa,$codigo,$rubro,$meta,$resolucion,$compromiso,$contratista,$asignacion,$comprometido,$modalidad,$codmodalidad,$fuentefinan,$codfuente,$resfutic,$fecini,$fecfin,$area,$codarea,$unidad,$ubicacion,$responsable,$telefono,$email,$ordenador,$proceso,$codproceso,$estado,$codnuevo,$nexpcdp,$nrp,$nbogdata,$ncdp,$estadofin,$iddpa,$editar,$vig,$codimeta,$codiresol){	

		// var_dump($codimeta);
		// var_dump($codiresol);
		// var_dump($responsable);
		// die();

		date_default_timezone_set('America/Bogota');		


		$fecini = date('Y-m-d H:i:s', strtotime('1899-12-30 00:00:00') + ($fecini + 1) * 24 * 60 * 60);
		$fecfin = date('Y-m-d H:i:s', strtotime('1899-12-30 00:00:00') + ($fecfin + 1) * 24 * 60 * 60);

		// var_dump($iddpa);
		
		
		//$codrub = substr($codigo, 1);
		$codrub = $codigo;

		if ($iddpa>0) {			
			$sql = "UPDATE detpaa SET unspsc='$unspsc',nobjeto='$objeto',codrub=$codrub,metadp=$codimeta,compro='$compromiso',nomcont='$contratista',asidpa=$asignacion,prrp=$comprometido,tipcondpa=$codmodalidad,ftefindpa=$codfuente,resoludp=$codiresol,fecinidpa='$fecini',fecfindpa='$fecfin',area=$codarea,unidad='$unidad',ubicacion='$ubicacion',resp='$responsable',celres=$telefono,mailres='$email',idpro=$codproceso ";
			$sql .= "WHERE iddpa=$iddpa;";
		}else{

			$sql2 = "SELECT MIN(idflu) As mini, MAX(idflu) As maxi FROM flujo WHERE ntipo IN (1,2,3) AND idpro='$codproceso'";	
				$execute = $this->db->query($sql2);
				$cuot = $execute->fetchall(PDO::FETCH_ASSOC);

				//var_dump($cuot[0]['mini']);
				// var_dump($sql2);
				// die();
				$idflu=$cuot[0]['mini'];
			
			$sql = "INSERT INTO detpaa (idpaa,unspsc, nobjeto,objdpa, codrub, metadp,compro,nomcont,asidpa,prrp,tipcondpa,ftefindpa,resoludp,fecinidpa,fecfindpa,area,unidad,ubicacion,resp,celres,mailres,idpro,idflu) VALUES ($vig,'$unspsc','$objeto','$objdpa',$codrub,$codimeta,'$compromiso','$contratista',$asignacion,$comprometido,$codmodalidad,$codfuente,$codiresol,'$fecini','$fecfin',$codarea,'$unidad','$ubicacion','$responsable',$telefono,'$email',$codproceso,$idflu) ";
		}

		// var_dump($sql);
		// die();

		$update= $this->db->prepare($sql);		
		$save=$update->execute();

	}

	public function edPlanoAnt($unspsc,$objeto,$objdpa,$codigo,$rubro,$meta,$resolucion,$compromiso,$contratista,$asignacion,$comprometido,$modalidad,$codmodalidad,$fuentefinan,$codfuente,$resfutic,$fecini,$fecfin,$area,$codarea,$unidad,$ubicacion,$responsable,$telefono,$email,$ordenador,$proceso,$codproceso,$estado,$codnuevo,$nexpcdp,$nrp,$nbogdata,$ncdp,$estadofin,$iddpa,$editar,$vig,$codimeta,$codiresol){


		$fecini = date('Y-m-d H:i:s', strtotime('1899-12-30 00:00:00') + ($fecini + 1) * 24 * 60 * 60);
		$fecfin = date('Y-m-d H:i:s', strtotime('1899-12-30 00:00:00') + ($fecfin + 1) * 24 * 60 * 60);

		//$codrub = substr($codigo, 1);
		$codrub = $codigo;

		if ($iddpa>0) {			
			$sql = "UPDATE detpaa SET unspsc='$unspsc',nobjeto='$objeto',codrub=$codrub,metadp=$codimeta,compro='$compromiso',nomcont='$contratista',asidpa=$asignacion,prrp=$comprometido,tipcondpa=$codmodalidad,ftefindpa=$codfuente,resoludp=$codiresol,fecinidpa='$fecini',fecfindpa='$fecfin',area=$codarea,unidad='$unidad',ubicacion='$ubicacion',resp='$responsable',celres=$telefono,mailres='$email',idpro=$codproceso ";
			$sql .= "WHERE iddpa=$iddpa;";
		}else{
			$sql2 = "SELECT MIN(idflu) As mini, MAX(idflu) As maxi FROM flujo WHERE ntipo IN (1,2,3) AND idpro='$codproceso'";	
				$execute = $this->db->query($sql2);
				$cuot = $execute->fetchall(PDO::FETCH_ASSOC);

				//var_dump($cuot[0]['mini']);
				// var_dump($sql2);
				// die();
				$idflu=$cuot[0]['mini'];

			$sql = "INSERT INTO detpaa (idpaa,unspsc, nobjeto,objdpa, codrub, metadp,compro,nomcont,asidpa,prrp,tipcondpa,ftefindpa,resoludp,fecinidpa,fecfindpa,area,unidad,ubicacion,resp,celres,mailres,idpro,idflu) VALUES ($vig,'$unspsc','$objeto','$objdpa',$codrub,$codimeta,'$compromiso','$contratista',$asignacion,$comprometido,$codmodalidad,$codfuente,$codiresol,'$fecini','$fecfin',$codarea,'$unidad','$ubicacion','$responsable',$telefono,'$email',$codproceso,$idflu) ";

		}		
		
			// var_dump($sql);
			// die();

		$update= $this->db->prepare($sql);		
		$save=$update->execute();
		return $save;
	}

	public function edPlanoPresu($unspsc,$objeto,$objdpa,$codigo,$rubro,$meta,$resolucion,$compromiso,$contratista,$asignacion,$comprometido,$modalidad,$codmodalidad,$fuentefinan,$codfuente,$resfutic,$fecini,$fecfin,$area,$codarea,$unidad,$ubicacion,$responsable,$telefono,$email,$ordenador,$proceso,$codproceso,$estado,$codnuevo,$nexpcdp,$nrp,$nbogdata,$ncdp,$estadofin,$iddpa,$editar,$vig,$codimeta,$codiresol){	

		// var_dump($codimeta);
		// var_dump($codiresol);
		// var_dump($responsable);
		// die();

		date_default_timezone_set('America/Bogota');		


		// $fecini = date('Y-m-d H:i:s', strtotime('1899-12-30 00:00:00') + ($fecini + 1) * 24 * 60 * 60);
		// $fecfin = date('Y-m-d H:i:s', strtotime('1899-12-30 00:00:00') + ($fecfin + 1) * 24 * 60 * 60);

		// var_dump($iddpa);
		
		
		//$codrub = substr($codigo, 1);
		$codrub = $codigo;

		if ($iddpa>0) {			
			$sql = "UPDATE detpaa SET unspsc='$unspsc',nobjeto='$objeto',codrub=$codrub,metadp=$codimeta,compro='$compromiso',nomcont='$contratista',asidpa=$asignacion,prrp=$comprometido,tipcondpa=$codmodalidad,ftefindpa=$codfuente,resoludp=$codiresol,fecinidpa='$fecini',fecfindpa='$fecfin',area=$codarea,unidad='$unidad',ubicacion='$ubicacion',resp='$responsable',celres=$telefono,mailres='$email',idpro=$codproceso ";
			$sql .= "WHERE iddpa=$iddpa;";
		}else{

			$sql2 = "SELECT MIN(idflu) As mini, MAX(idflu) As maxi FROM flujo WHERE ntipo IN (1,2,3) AND idpro='$codproceso'";	
				$execute = $this->db->query($sql2);
				$cuot = $execute->fetchall(PDO::FETCH_ASSOC);

				//var_dump($cuot[0]['mini']);
				// var_dump($sql2);
				// die();
				$idflu=$cuot[0]['mini'];
			
			$sql = "INSERT INTO detpaa (idpaa,unspsc, nobjeto,objdpa, codrub, metadp,compro,nomcont,asidpa,prrp,tipcondpa,ftefindpa,resoludp,fecinidpa,fecfindpa,area,unidad,ubicacion,resp,celres,mailres,idpro,idflu,elidp) VALUES ($vig,'$unspsc','$objeto','$objdpa',$codrub,$codimeta,'$compromiso','$contratista',$asignacion,$comprometido,$codmodalidad,$codfuente,$codiresol,'$fecini','$fecfin',$codarea,'$unidad','$ubicacion','$responsable',$telefono,'$email',$codproceso,$idflu,4)";
		}

		// var_dump($sql);
		// die();

		$update= $this->db->prepare($sql);		
		$save=$update->execute();

	}

	public function vigactAntp(){
		$sql = "SELECT idpaa FROM paa WHERE estpaa=3";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
	}

	public function pkCodRub($rubro){
		$sql = "SELECT codrub FROM rubro WHERE (codrub='$rubro' OR codrub2='$rubro')";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
	}

	public function VerCodRub($rubro){
		$sql = "SELECT COUNT(codrub) AS can FROM rubro WHERE (codrub='$rubro' OR codrub2='$rubro') AND actrub=1;";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
	}

	public function VerPresCargado($vig){
		$sql = "SELECT COUNT(iddpa) AS can FROM detpaa WHERE idpaa='$vig' AND elidp=4;";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
	}

	public function EliPresCargado($vig){
		$sql = "DELETE FROM detpaa WHERE idpaa='$vig' AND elidp=4;";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
	}


// ------------- Inicio Valor financiero ---------------------
	public function getVf($dofid){
		$sql = "SELECT vaffijo, vafnom FROM valfin WHERE dofid=$dofid ORDER BY vaffijo";			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// //echo $this->db->error;
		// die();

		return $pfinan;
	}
// ------------- Fin Valor financiero ---------------------
	

	public function busVafid($dofid,$nom){
		$sql = "SELECT vafid FROM valfin WHERE dofid=$dofid AND vafnom='$nom' ";			
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		//$nr=count($pfinan);

		// var_dump($nr);
		// //echo $this->db->error;
		//die();

		return $pfinan;

	}	

	public function vigactan(){
		
		$sql = "SELECT * FROM paa WHERE estpaa IN (1,2)";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
	}
	
// --------- Inicio Enero 2023 ------------
	public function getVigencia(){
		$sql = "SELECT idpaa FROM paa";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
	}
// --------- Fin Enero 2023 ------------


// --------- Inicio Enero 2024 ------------
	// public function getObligaGen(){
	// 	$sql = "SELECT valid, valnom FROM valor WHERE parid=6";
	// 	$execute = $this->db->query($sql);
	// 	$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);		
	// 	return $ordgasto;
	// }


	public function getObligaGen(){		
		$area = $_SESSION['depid'];
		$sql = "SELECT idobliga,nom FROM obligaciones WHERE tipo=1 AND area = $area";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);		
		return $ordgasto;
	}

	public function getIddpaxCod($idpaa, $cdg, $rubro, $objetocom, $ncdp){
		/*Revisando con rubro*/
		$sql = "SELECT d.iddpa, d.idpaa, d.nicod, d.nobjeto, d.nomcont, d.area, d.codrub, d.objdpa, d.inidpa, d.prodpa, d.unspsc, d.fecinidpa, d.nmesdpa, d.cuodpa, d.tipcondpa, d.ftefindpa, d.asidpa, d.asirp, d.pmes, d.umes, d.valdpa, d.valvigact, d.fecfindpa, d.reqvigf, d.solivigf, d.unidad, d.ubicacion, d.resp, d.celres, d.mailres, d.ncdppc, d.fecsol, d.observaciones, d.idpro, d.idflu, d.depidd, d.nexpcdp, d.nrp, d.nbogdata, d.rutcdp, d.rutrp, d.ordgas, d.elidp, d.feclib, d.rutlib, d.estlib, d.metadp, d.resoludp, d.idmcdp, d.valid, d.compro, d.cpc, d.fondo, d.prcdp, d.prrp, d.idpb FROM detpaa AS d WHERE d.idpaa='".$idpaa."' AND d.elidp=1 AND ";
		$sql .=  "d.codrub='".$rubro."' AND (";
		if($ncdp) $sql .= "trim(d.nbogdata)=trim(CAST('".$ncdp."' AS INTEGER)) OR (";
		$sql .=  "(d.nobjeto LIKE '".$cdg." %' OR TRIM(d.nobjeto) LIKE '%".$objetocom."%'))";
		$sql .= ")";
		
		/*Revisando sin rubro
		$sql = "SELECT d.iddpa, d.idpaa, d.nicod, d.nobjeto, d.nomcont, d.area, d.codrub, d.objdpa, d.inidpa, d.prodpa, d.unspsc, d.fecinidpa, d.nmesdpa, d.cuodpa, d.tipcondpa, d.ftefindpa, d.asidpa, d.asirp, d.pmes, d.umes, d.valdpa, d.valvigact, d.fecfindpa, d.reqvigf, d.solivigf, d.unidad, d.ubicacion, d.resp, d.celres, d.mailres, d.ncdppc, d.fecsol, d.observaciones, d.idpro, d.idflu, d.depidd, d.nexpcdp, d.nrp, d.nbogdata, d.rutcdp, d.rutrp, d.ordgas, d.elidp, d.feclib, d.rutlib, d.estlib, d.metadp, d.resoludp, d.idmcdp, d.valid, d.compro, d.cpc, d.fondo, d.prcdp, d.prrp, d.idpb FROM detpaa AS d WHERE d.idpaa='".$idpaa."' AND d.elidp=1 AND (";
		if($ncdp) $sql .= "d.nbogdata=CAST('".$ncdp."' AS INTEGER) OR (";
		$sql .=  "d.codrub='".$rubro."' AND ";
		$sql .=  "(d.nobjeto LIKE '".$cdg." %' OR TRIM(d.nobjeto) LIKE '%".$objetocom."%'))";
		$sql .= ")";*/


		try{
			//echo $sql."<br>";
			$execute = $this->db->query($sql);
			$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);		
			return $ordgasto;
		}catch(Exception $e){
			echo "Error en consulta: ".$e."<br><br>".$sql."<br>";
		}
	}

	public function deleteObliga($perid,$cargo){	
		$sql1 = "DELETE FROM obligacon WHERE perid=$perid AND cargo=$cargo";		
		$save = $this->db->query($sql1);		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function deleteEstudio($peridNew){	
		$sql1 = "DELETE FROM estudiocon WHERE perid=$peridNew";
		$save = $this->db->query($sql1);		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	public function saveObliga($peridNew,$cargo,$areacon,$obliga,$tipoper,$nIddpa){	
		$sql = "INSERT INTO obligacon (iddpa,perid,cargo,area,obliga,tipoper) VALUES ($nIddpa,$peridNew,$cargo,$areacon,'$obliga',$tipoper) ";
		
		$save = $this->db->query($sql);
				
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	
	public function saveEstudio($peridNew,$es){	
		$sql = "INSERT INTO estudiocon (perid,estudio) VALUES ($peridNew,'$es') ";
		
		$save = $this->db->query($sql);
				
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
// --------- Fin Enero 2024 -------------

//-----------Febrero 2024----------------
	public function saveNomPerfil($area,$tipo,$nom,$perid){
		$sql = "INSERT INTO obligaciones (area,tipo,nom,perid) VALUES ($area,$tipo,'$nom',$perid) ";		
		$save = $this->db->query($sql);
				
		$result = false;
		if($save){
			$result = true;
		}
		return $result;

	}

	public function deleteObligaGen($cargo){
		$sql1 = "DELETE FROM obligaciones WHERE depen = $cargo AND tipo=2";
		$save = $this->db->query($sql1);		
		return $save;	
	}

	public function saveObligaGen($peridNew,$cargo,$areacon,$obliga,$tipoper){		

		$perid=$_SESSION['perid'];


		$sql = "INSERT INTO obligaciones (depen,area,tipo,obliga,perid) VALUES ($cargo,$areacon,2,'$obliga',$perid) ";

		// var_dump($sql);
		// die();

		
		$save = $this->db->query($sql);
				
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}


//---------- Fin Febrero 2024------------

	public function saveCDPBg($iddpa,$valor,$anula,$cdpxcom){	
		$sql = "UPDATE detpaa SET valcdp='".$valor."', anucdp='".$anula."', cxccdp='".$cdpxcom."' WHERE iddpa='".$iddpa."'";
		$save = $this->db->query($sql);
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function saveRPBg($iddpa,$valor,$anula,$vlrneto,$autgir,$csagir,$nintcrp,$nintcdp,$fecent){	
		$sql = "UPDATE detpaa SET valrp='".$valor."', anurp='".$anula."', vlrneto='".$vlrneto."',autgir='".$autgir."', csagir='".$csagir."', nintcrp='".$nintcrp."', nintcdp='".$nintcdp."', fecent='".$fecent."' WHERE iddpa='".$iddpa."'";
		$save = $this->db->query($sql);
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function getAllAnaPre($codrub){
		//$sql = "SELECT distinct dt.*, rub.*, m.vafnom AS moda, f.vafnom AS fuen, a.valnom AS are, fl.actflu, fl.color, pr.nompro FROM detpaa AS dt INNER JOIN rubro AS rub ON dt.codrub = rub.codrub INNER JOIN valfin AS m ON dt.tipcondpa=m.vafid INNER JOIN valfin AS f ON dt.ftefindpa=f.vafid INNER JOIN proceso AS pr ON dt.idpro=pr.idpro INNER JOIN valor AS a ON dt.area=a.valid INNER JOIN flujo as fl ON dt.idflu=fl.idflu WHERE dt.idpaa=".$this->idpaa." AND rub.codrub=".$codrub." AND dt.elidp=1";

		$sql = "SELECT SUM(dt.valcdp) AS valcdpM, SUM(dt.anucdp) AS anucdpM, SUM(dt.csagir) AS csagirM, SUM(dt.autgir) AS autgirM, SUM(dt.valrp) AS valrpM, SUM(dt.anurp) AS anurpM, SUM(dt.vlrneto) AS vlrnetoM FROM detpaa AS dt INNER JOIN rubro AS rub ON dt.codrub = rub.codrub INNER JOIN valfin AS m ON dt.tipcondpa=m.vafid INNER JOIN valfin AS f ON dt.ftefindpa=f.vafid INNER JOIN proceso AS pr ON dt.idpro=pr.idpro INNER JOIN valor AS a ON dt.area=a.valid INNER JOIN flujo as fl ON dt.idflu=fl.idflu WHERE dt.idpaa=".$this->idpaa." AND rub.codrub=".$codrub." AND dt.elidp=1";

		// var_dump($sql);
		// die();
		// echo "<br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}


	public function getAllPre(){
		$sql = "
			SELECT 
				codrub,
				fecent,
				valcdp,
				MIN(nobjeto) as nobjeto, -- Selecciona una descripción por rubro
				SUM(asidpa) as total_asidpa, 
				SUM(valcdp) as total_valcdp, 
				SUM(valrp) as total_valrp, 
				SUM(autgir) as total_autgir 
			FROM detpaa 
			WHERE idpaa = 2024 AND fecent IS NOT NULL 
			GROUP BY codrub;
		";             
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchAll(PDO::FETCH_ASSOC);
		return $ordgasto;
	}

	public function getAllPreAsi($rubro) {
		$sql = "
			SELECT 
				asidpa,
				nobjeto 
			FROM detpaa 
			WHERE codrub = :rubro AND elidp = 4 AND idpaa = 2024;
		";             
		$execute = $this->db->prepare($sql);
		$execute->bindParam(':rubro', $rubro, PDO::PARAM_INT);
		$execute->execute();
		$ordgasto = $execute->fetchAll(PDO::FETCH_ASSOC);
		return $ordgasto;
	}

	public function getPersonName($perid) {

		$sql = "
			SELECT 
				pernom 
			FROM persona 
			WHERE perid = :perid;
		";             
		$execute = $this->db->prepare($sql);
		$execute->bindParam(':perid', $perid, PDO::PARAM_INT);
		$execute->execute();
		$persona = $execute->fetch(PDO::FETCH_ASSOC);
		return $persona ? $persona['pernom'] : null;

	}

	public function getDetpaaById($iddpa) {
		$sql = "SELECT asidpa FROM detpaa WHERE iddpa = ? AND elidp = 4 AND idpaa = 2024";
		$select = $this->db->prepare($sql);
		$select->execute(array($iddpa));
		$record = $select->fetch(PDO::FETCH_ASSOC);
	
		return $record;
	}

	public function getRubro($iddpa) {
		$sql = "SELECT codrub FROM detpaa WHERE iddpa = :iddpa";

		$execute = $this->db->prepare($sql);
		$execute->bindParam(':iddpa', $iddpa, PDO::PARAM_INT);
		$execute->execute();
		$rubro = $execute->fetch(PDO::FETCH_ASSOC);
		return $rubro ? $rubro['codrub'] : null;

	}


	public function getFlujo($idflu) {
		$sql = "SELECT actflu FROM flujo WHERE idflu = :idflu";

		$execute = $this->db->prepare($sql);
		$execute->bindParam(':idflu', $idflu, PDO::PARAM_INT);
		$execute->execute();
		$flujo = $execute->fetch(PDO::FETCH_ASSOC);
		return $flujo ? $flujo['actflu'] : null;

	}

	public function getProceso($idpro) {
		$sql = "SELECT nompro FROM proceso WHERE idpro = :idpro";

		$execute = $this->db->prepare($sql);
		$execute->bindParam(':idpro', $idpro, PDO::PARAM_INT);
		$execute->execute();
		$proceso = $execute->fetch(PDO::FETCH_ASSOC);
		return $proceso ? $proceso['nompro'] : null;

	}

    public function getAllFiltered($areSel, $rubroSel, $nobjetoSel) {
        $sql = "SELECT * FROM detpaa WHERE elidp = 4 and idpaa = 2024"; // Cambia 'tu_tabla' por el nombre real de la tabla.

        // Filtrar por área
        if (!empty($areSel)) {
            $sql .= " AND area = :areSel";
        }

        // Filtrar por rubro utilizando LIKE
        if (!empty($rubroSel)) {
            $sql .= " AND codrub LIKE :rubroSel"; // Usa LIKE para buscar coincidencias parciales
        }

        // Filtrar por iddpa utilizando LIKE
        if (!empty($nobjetoSel)) {
            $sql .= " AND iddpa LIKE :nobjetoSel"; // Usa LIKE para buscar coincidencias parciales
        }

        $stmt = $this->db->prepare($sql);

        // Vincular parámetros
        if (!empty($areSel)) {
            $stmt->bindValue(':areSel', $areSel);
        }
        if (!empty($idpaa)) {
            $stmt->bindValue(':idpaa', $idpaa);
        }
        if (!empty($rubroSel)) {
            $stmt->bindValue(':rubroSel', '%' . $rubroSel . '%'); // Agrega '%' para búsqueda parcial
        }
        if (!empty($nobjetoSel)) {
            $stmt->bindValue(':nobjetoSel', '%' . $nobjetoSel . '%'); // Agrega '%' para búsqueda parcial
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>