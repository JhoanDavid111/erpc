<?php
class Segm{
	private $idcondiusu;
	private $perid;
	private $fecdia;
	private $tipo;
	private $diag;
	private $condi;
	private $fecfincod;
	private $arccon;
	private $tiedis;
	private $disca;
	private $arcdis;
	
	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getIdcondiusu(){
		return $this->idcondiusu;
	}
	function getPerid(){
		return $this->perid;
	}
	function getFecdia(){
		return $this->fecdia;
	}
	function getTipo(){
		return $this->tipo;
	}
	function getCondi(){
		return $this->condi;
	}
	function getDiag(){
		return $this->diag;
	}	
	function getFecfincod(){
		return $this->fecfincod;
	}
	function getArccon(){
		return $this->arccon;
	}
	function getTiedis(){
		return $this->tiedis;
	}
	function getDisca(){
		return $this->disca;
	}
	function getArcdis(){
		return $this->arcdis;
	}

//Metodos Set Guardan el dato
	function setIdcondiusu($idcondiusu){
		$this->idcondiusu = $idcondiusu;
	}
	function setPerid($perid){
		$this->perid = $perid;
	}
	function setFecdia($fecdia){
		$this->fecdia = $fecdia;
	}
	function setTipo($tipo){
		$this->tipo = $tipo;
	}
	function setCondi($condi){
		$this->condi = $condi;
	}
	function setDiag($diag){
		$this->diag = $diag;
	}
	function setFecfincod($fecfincod){
		$this->fecfincod = $fecfincod;
	}
	function setArccon($arccon){
		$this->arccon = $arccon;
	}
	function setTiedis($tiedis){
		$this->tiedis = $tiedis;
	}
	function setDisca($disca){
		$this->disca = $disca;
	}
	function setArcdis($arcdis){
		$this->arcdis = $arcdis;
	}

//Metodos CRUD
	public function getOne(){
		$sql="SELECT se.idcondiusu, se.perid, se.fecdia, se.tipo, tip.valnom AS nomtipo, se.condi, cd.valnom AS nomcondi, se.diag, se.fecfincod, se.arccon, se.tiedis, se.disca, ds.valnom AS nomdisca, se.arcdis FROM segm AS se INNER JOIN valor AS tip ON se.tipo=tip.valid INNER JOIN valor AS cd ON se.condi=cd.valid INNER JOIN valor AS ds ON se.disca=ds.valid WHERE se.idcondiusu='".$this->idcondiusu."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}
	public function getAlles($perid){
		$sql="SELECT se.idcondiusu, se.perid, se.fecdia, se.tipo, tip.valnom AS nomtipo, se.condi, cd.valnom AS nomcondi, se.diag, se.fecfincod, se.arccon, se.tiedis, se.disca, ds.valnom AS nomdisca, se.arcdis FROM segm AS se INNER JOIN valor AS tip ON se.tipo=tip.valid INNER JOIN valor AS cd ON se.condi=cd.valid INNER JOIN valor AS ds ON se.disca=ds.valid WHERE se.perid='".$perid."'";
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
		$sql= "INSERT INTO segm (perid, fecdia, tipo, condi, diag, fecfincod, arccon, tiedis, disca, arcdis) VALUES (?,?,?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getPerid(), $this->getFecdia(), $this->getTipo(), $this->getCondi(), $this->getDiag(), $this->getFecfincod(), $this->getArccon(), $this->getTiedis(), $this->getDisca(), $this->getArcdis());
		// echo $sql."<br>";
		// echo "<br>'".$this->getPerid()."','".$this->getFecdia()."','".$this->getTipo()."','".$this->getCondi()."','".$this->getDiag()."','".$this->getFecfincod()."','".$this->getArccon()."','".$this->getTiedis()."','".$this->getDisca()."','".$this->getArcdis()."'<br>";
		// die();
		$save = $insert->execute($arrdata);		

	}
	//Funcion editar los campos de la vista

	public function edit(){		

		$sql = "UPDATE segm SET fecdia=?, tipo=?, condi=?, diag=?, fecfincod=?, arccon=?, tiedis=?, disca=?, arcdis=?";
		$sql .= " WHERE idcondiusu={$this->idcondiusu};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getFecdia(), $this->getTipo(), $this->getCondi(), $this->getDiag(), $this->getFecfincod(), $this->getArccon(), $this->getTiedis(), $this->getDisca(), $this->getArcdis());
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

	public function getValdom($id){
		$sql="SELECT * FROM valor WHERE parid = '".$id."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}
}