<?php
class expl{	
	private $idexplab;
	private $perid;
	private $natent;
	private $emaent;
	private $nument;
	private $traact;
	private $fecing;
	private $fecret;
	private $cauret;
	private $dedex;
	private $noment;
	private $empcar;
	
	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getIdexplab(){
		return $this->idexplab;
	}
	function getPerid(){
		return $this->perid;
	}
	function getNatent(){
		return $this->natent;
	}
	function getEmaent(){
		return $this->emaent;
	}
	function getNument(){
		return $this->nument;
	}
	function getTraact(){
		return $this->traact;
	}
	function getFecing(){
		return $this->fecing;
	}
	function getFrecet(){
		return $this->fecret;
	}
	function getCauret(){
		return $this->cauret;
	}
	function getDedex(){
		return $this->dedex;
	}
	function getNoment(){
		return $this->noment;
	}
	function getEmpcar(){
		return $this->empcar;
	}

//Metodos Set Guardan el dato
	function setIdexplab($idexplab) {
		$this->idexplab = $idexplab;
	}
	function setPerid($perid) {
		$this->perid= $perid;
	}
	function setNatent($natent) {
		$this->natent= $natent;
	}
	function setEmaent($emaent) {
		$this->emaent= $emaent;
	}
	function setNument($nument) {
		$this->nument= $nument;
	}
	function setTraact($traact) {
		$this->traact= $traact;
	}
	function setFecing($fecing) {
		$this->fecing= $fecing;
	}
	function setFecret($fecret) {
		$this->fecret= $fecret;
	}
	function setCauret($cauret) {
		$this->cauret= $cauret;
	}
	function setDedex($dedex) {
		$this->dedex= $dedex;
	}
	function setNoment($noment) {
		$this->noment= $noment;
	}
	function setEmpcar($empcar) {
		$this->empcar= $empcar;
	}


//Metodos CRUD
	public function getOne(){
		$sql ="SELECT e.idexplab, e.perid, e.natent, e.emaent, v.valnom AS ent, e.traact, e.cauret, e.fecing,e.nument, e.fecret, f.valnom AS ret, e.dedex, e.noment, e.empcar, n.valnom AS demm 
		FROM expl AS e INNER JOIN valor AS v ON e.natent=v.valid INNER JOIN valor AS f ON e.traact=f.valid INNER JOIN valor AS n ON e.dedex=n.valid WHERE e.idexplab='".$this->idexplab."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function getAllep($perid){
		$sql="SELECT e.idexplab, e.perid, e.natent, e.emaent, v.valnom AS ent, e.traact, e.cauret, e.fecing,e.nument, e.fecret, f.valnom AS ret, e.dedex, e.noment, e.empcar, n.valnom AS demm 
		FROM expl AS e INNER JOIN valor AS v ON e.natent=v.valid INNER JOIN valor AS f ON e.traact=f.valid INNER JOIN valor AS n ON e.dedex=n.valid WHERE e.perid='".$perid."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}
	
	public function getOnePer(){
		$sql ="SELECT hv.perid AS iden, hv.nodocemp, hv.pernom, hv.perape, hv.peremail, hv.percel FROM persona AS hv WHERE hv.perid='".$this->perid."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function save(){
		$sql= "INSERT INTO expl (idexplab, perid, natent, emaent, nument, traact, fecing, fecret, cauret, dedex, noment, empcar) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getIdexplab(), $this->getPerid(), $this->getNatent(), $this->getEmaent(), $this->getNument(), $this->getTraact(), $this->getFecing(), $this->getFrecet(), $this->getCauret(),$this->getDedex(), $this->getNoment(), $this->getEmpcar());
		// echo $sql;
		// var_dump($arrdata);
		// die();
		$save = $insert->execute($arrdata);
	}

	public function edit(){
	    $sql = "UPDATE expl SET natent=?, emaent=?, nument=?, traact=?, fecing=?, fecret=?, cauret=?, dedex=?, noment=?, empcar=?";
		$sql .= " WHERE idexplab={$this->idexplab};";

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getNatent(), $this->getEmaent(), $this->getNument(), $this->getTraact(), $this->getFecing(), $this->getFrecet(), $this->getCauret(),$this->getDedex(), $this->getNoment(), $this->getEmpcar());
		$save=$update->execute($arrdata);
				
			//var_dump($sql);
			// var_dump($save);
			// $error= $this->db->errorInfo();
			// print_r($error);
			 //die();
		
		$result = false;
			if($save){
			$result = true;
		}
		return $result;
	}

	public function getExpl(){
		$sql="SELECT count(perid) AS exp FROM expl WHERE perid='".$this->perid."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	//Funciones para llamar la tabla del dominio para los campos de seleccion en la vista

	public function natent(){
		$sql="SELECT * FROM valor WHERE parid = 50";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function dedex(){
		$sql="SELECT * FROM valor WHERE parid = 55";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function cauret(){
		$sql="SELECT * FROM valor WHERE parid = 51";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

}