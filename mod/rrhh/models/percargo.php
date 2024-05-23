<?php
class Percargo{

//sexpcgpcg, fnacpcg, prtpcg, tippcg FROM percargo	
	private $idpcg2;
	private $perid;
	private $tdocpcg;
	private $idpcg;
	private $nompcg;
	private $sexpcg;
	private $fnacpcg;
	private $prtpcg;
	private $tippcg;
	
	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getIdpcg2(){
		return $this->idpcg2;
	}
	function getPerid(){
		return $this->perid;
	}	
	function getTdocpcg(){
		return $this->tdocpcg;
	}
	function getIdpcg(){
		return $this->idpcg;
	}
	function getNompcg(){
		return $this->nompcg;
	}
	function getSexpcg(){
		return $this->sexpcg;
	}
	function getFnacpcg(){
		return $this->fnacpcg;
	}
	function getPrtpcg(){
		return $this->prtpcg;
	}
	function getTippcg(){
		return $this->tippcg;
	}
	
//Metodos Set Guardan el dato
	function setIdpcg2($idpcg2){
		$this->idpcg2 = $idpcg2;
	}
	function setPerid($perid){
		$this->perid = $perid;
	}
	function setTdocpcg($tdocpcg){
		$this->tdocpcg = $tdocpcg;
	}
	function setIdpcg($idpcg){
		$this->idpcg = $idpcg;
	}
	function setNompcg($nompcg){
		$this->nompcg = $nompcg;
	}
	function setSexpcg($sexpcg){
		$this->sexpcg = $sexpcg;
	}
	function setFnacpcg($fnacpcg){
		$this->fnacpcg = $fnacpcg;
	}
	function setPrtpcg($prtpcg){
		$this->prtpcg = $prtpcg;
	}
	function setTippcg($tippcg){
		$this->tippcg = $tippcg;
	}

//Metodos CRUD
	public function getOne(){
		// $sql="SELECT pc.idpcrg, pc.perid, pc.tdocpcg, td.valnom AS tdocpcg, pc.idpcg, pc.nompcg, pc.sexpcg, xx.valnom AS sexpcgo, pc.fnacpcg, pc.prtpcg, pr.valnom AS prtpcg, pc.tippcg, tpr.valnom AS tippcg FROM percargo as pc INNER JOIN valor AS td ON pc.tdocpcg=td.valid INNER JOIN valor AS xx ON pc.sexpcg=xx.valid INNER JOIN valor AS pr ON pc.prtpcg=pr.valid INNER JOIN valor AS tpr ON pc.tippcg=tpr.valid WHERE pc.idpcrg='".$this->idpcrg."'";
		$sql = "SELECT idpcg2, perid, tdocpcg, idpcg, nompcg, sexpcg, fnacpcg, prtpcg, tippcg FROM percargo WHERE idpcg2='".$this->idpcg2."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}
	
	public function getAlles($perid){
		$sql="SELECT pc.idpcg2, pc.perid, pc.tdocpcg, td.valnom AS tdocpcg, pc.idpcg, pc.nompcg, pc.sexpcg, xx.valnom AS sexpcgo, pc.fnacpcg, YEAR(CURDATE())-YEAR(pc.fnacpcg) + IF(DATE_FORMAT(CURDATE(),'%m-%d') >= DATE_FORMAT(pc.fnacpcg,'%m-%d'), 0 , -1 ) AS Edad, pc.prtpcg, pr.valnom AS prtpcg, pc.tippcg, tpr.valnom AS tippcg FROM percargo as pc INNER JOIN valor AS td ON pc.tdocpcg=td.valid INNER JOIN valor AS xx ON pc.sexpcg=xx.valid INNER JOIN valor AS pr ON pc.prtpcg=pr.valid INNER JOIN valor AS tpr ON pc.tippcg=tpr.valid WHERE pc.perid='".$perid."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function getOnePer(){
		$sql ="SELECT hv.perid AS idett, hv.nodocemp, hv.pernom, hv.perape, hv.peremail, hv.percel FROM persona AS hv WHERE hv.perid='".$this->perid."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

//Funcion guardar datos en la BD	
	public function save(){
		$sql= "INSERT INTO percargo (perid,tdocpcg, idpcg, nompcg, sexpcg, fnacpcg, prtpcg, tippcg) VALUES (?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getPerid(), $this->getTdocpcg(), $this->getIdpcg(), $this->getNompcg(), $this->getSexpcg(), $this->getFnacpcg(), $this->getPrtpcg(), $this->getTippcg());
		// echo $sql."<br>";
		// var_dump($arrdata);
		// die();
		$save = $insert->execute($arrdata);		
	}

	//Funcion editar los campos de la vista

	public function edit(){		

		$sql = "UPDATE percargo SET tdocpcg=?, idpcg=?, nompcg=?, sexpcg=?, fnacpcg=?, prtpcg=?, tippcg=?";
		$sql .= " WHERE idpcg2={$this->idpcg2};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getTdocpcg(), $this->getIdpcg(), $this->getNompcg(), $this->getSexpcg(), $this->getFnacpcg(), $this->getPrtpcg(), $this->getTippcg());
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

	//Funcion para llamar la tabla del dominio para los campos de seleccion en la vista 

	public function getValdo($id){
		$sql="SELECT * FROM valor WHERE parid = '".$id."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}
}