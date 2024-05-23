<?php 
//detpaa
class Masi{

	private $iddpa;
	private $nbogdata;
	private $idflu;
	private $nrp;
	private $idpro;
	private $rutrp;
	
	public function __construct() {
		$this->db = conexion::get_conexion();
	}

	function getIddpa() {
		return $this->iddpa;
	}	

	function getNbogdata() {
		return $this->nbogdata;
	}

	function getNrp() {
		return $this->nrp;
	}

	function getRutrp() {
		return $this->rutrp;
	}	

	function getIdflu(){
		return $this->idflu;
	}

	function getIdpro(){
		return $this->idpro;
	}

	//SET

	function setIddpa($iddpa) {
		$this->iddpa = $iddpa;
	}	

	function setNbogdata($nbogdata) {
		$this->nbogdata = $nbogdata;
	}	

	function setRutrp($rutrp) {
		$this->rutrp = $rutrp;
	}

	function setIdflu($idflu) {
		$this->idflu = $idflu;
	}

	function setNrp($nrp) {
		$this->nrp = $nrp;
	}

	function setIdpro($idpro) {
		$this->idpro = $idpro;
	}

	//METODOS

	public function getId(){
		$sql = "SELECT * FROM detpaa WHERE nbogdata=".$this->nbogdata;		
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function getFlu(){
		$sql = "SELECT MAX(idflu) AS num FROM flujo WHERE ntipo=4 AND idpro=".$this->idpro;		
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function edpf(){
		$sql = "UPDATE detpaa SET rutrp=?,idflu=?,nrp=?";
		$sql .= " WHERE iddpa={$this->iddpa};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getRutrp(), $this->getIdflu(), $this->getNrp());
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
}
?>