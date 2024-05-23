<?php 
//detpaa
class Antproy{

	private $iddpa;
	private $idpaa;
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
	private $valdpa;
	private $fecfindpa;
	private $observaciones;
	private $elidp;
	
	public function __construct() {
		$this->db = conexion::get_conexion();
	}

	function getIddpa() {
		return $this->iddpa;
	}	

	function getIdpaa() {
		return $this->idpaa;
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

	function getValdpa() {
		return $this->valdpa;
	}

	function getFecfindpa() {
		return $this->fecfindpa;
	}
	function getObservaciones(){
		return $this->observaciones;
	}
	function getElidp(){
		return $this->elidp;
	}

	//SET

	function setIddpa($idda) {
		$this->iddpa = $idda;
	}	

	function setIdpaa($idpaa) {
		$this->idpaa = $idpaa;
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

	function setValdpa($valdpa) {
		$this->valdpa = $valdpa;
	}

	function setFecfindpa($fecfindpa) {
		$this->fecfindpa = $fecfindpa;
	}

	function setObservaciones($observaciones){
		$this->observaciones = $observaciones;
	}
	function setElidp($elidp){
		$this->elidp = $elidp;
	}

	//METODOS

	public function getAll(){
		// $sql = "SELECT * FROM detpaa WHERE idpaa = ".$this->idpaa;		
		// $execute = $this->db->query($sql);
		// $pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		$sql = "SELECT dt.*, rub.* FROM detpaa dt "
				. "INNER JOIN rubro rub ON dt.codrub = rub.codrub "
				. " WHERE dt.idpaa = ".$this->idpaa." AND dt.elidp=1";		
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($pfinan);
		// echo $this->db->error;
		// die();

		return $pfinan;
	}

	public function getVig(){
		$sql = "SELECT DISTINCT idpaa FROM detpaa ORDER BY idpaa DESC";		
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
				. " WHERE dt.codrub = ".$this->codrub;		
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

	public function edit(){		

		$sql = "UPDATE rubro SET nomrub=?,deprub=?,actrub=? ";
		$sql .= " WHERE codrub={$this->codrub};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getNomrub(), $this->getDeprub(), $this->getActrub());
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

	public function eliAnt(){
		$sql = "UPDATE detpaa SET observaciones=?,elidp=? WHERE iddpa=?";

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getObservaciones(), $this->getElidp(), $this->getIddpa());
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

	public function deleteAnt($iddpa){

		$sql = "DELETE FROM detpaa WHERE iddpa = $iddpa ";		
		$save = $this->db->query($sql);
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

}

?>