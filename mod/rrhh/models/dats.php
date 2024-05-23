<?php
class Dats{
	private $idedusup;
	private $perid;
	private $nomedusup;
	private $ulsecu;
	private $feculsem;
	private $modest;
	private $medcap;
	private $dep;
	private $grad;
	private $tarj;
	private $fecgrad;
	private $tiptitul;

	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato
	function getIdedusup(){
		return $this->idedusup;
	}
	function getPerid(){
		return $this->perid;
	}
	function getNomedusup(){
		return $this->nomedusup;
	}
	function getUlsecu(){
		return $this->ulsecu;
	}
	function getFeculsem(){
		return $this->feculsem;
	}
	function getModest(){
		return $this->modest;
	}
	function getMedcap(){
		return $this->medcap;
	}
	function getDep(){
		return $this->dep;
	}
	function getGrad(){
		return $this->grad;
	}
	function getTarjp(){
		return $this->tarjp;
	}
	function getFecgrad(){
		return $this->fecgrad;
	}
	function getTiptitul(){
		return $this->tiptitul;
	}
	
//Metodos Set Guardan el dato
	function setIdedusup($idedusup){
		$this->idedusup = $idedusup;
	}
	function setPerid($perid){
		$this->perid = $perid;
	}
	function setNomedusup($nomedusup){
		$this->nomedusup = $nomedusup;
	}
	function setUlsecu($ulsecu){
		$this->	ulsecu = $ulsecu;
	}
	function setFeculsem($feculsem){
		$this->feculsem = $feculsem;
	}
	function setModest($modest){
		$this->modest = $modest;
	}
	function setMedcap($medcap){
		$this->medcap = $medcap;
	}
	function setDep($dep){
		$this->dep = $dep;
	}
	function setGrad($grad){
		$this->grad = $grad;
	}
	function setTarjp($tarjp){
		$this->tarjp = $tarjp;
	}
	function setTiptitul($tiptitul){
		$this->tiptitul = $tiptitul;
	}

	function setFecgrad($fecgrad){
		$this->fecgrad = $fecgrad;
	}


//Metodos CRUD
	
	public function getOne(){
		$sql ="SELECT d.idedusup, d.perid, d.nomedusup, d.ulsecu, d.feculsem, d.modest, m.valnom AS nomme, d.medcap, c.valnom AS nommc, d.dep, d.grad, d.tarjp, d.fecgrad, d.tiptitul, t.valnom AS nomtt FROM dats AS d INNER JOIN valor AS m ON d.modest=m.valid INNER JOIN valor AS c ON d.medcap=c.valid INNER JOIN valor AS t ON d.tiptitul=t.valid WHERE d.idedusup='".$this->idedusup."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function getAlles($perid){
		$sql="SELECT d.idedusup, d.perid, d.nomedusup, d.ulsecu, d.feculsem, d.modest, m.valnom AS nomme, d.medcap, c.valnom AS nommc, d.dep, d.grad, d.tarjp, d.fecgrad, d.tiptitul, t.valnom AS nomtt FROM dats AS d INNER JOIN valor AS m ON d.modest=m.valid INNER JOIN valor AS c ON d.medcap=c.valid INNER JOIN valor AS t ON d.tiptitul=t.valid WHERE d.perid='".$perid."'";
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

	public function save(){
		$sql= "INSERT INTO dats(perid, nomedusup, ulsecu, feculsem, modest, medcap, grad, tarjp, fecgrad, tiptitul, dep) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getPerid(), $this->getNomedusup(), $this->getUlsecu(), $this->getFeculsem(), $this->getModest(), $this->getMedcap(), $this->getGrad(), $this->getTarjp(), $this->getFecgrad(), $this->getTiptitul(), $this->getDep());
		// echo $sql."<br>";
		// var_dump($arrdata);
		// die();
		$save = $insert->execute($arrdata);

	}	
	//Funcion editar los campos de la vista

	public function edit(){		

		$sql = "UPDATE dats SET nomedusup=?, ulsecu=?, feculsem=?, modest=?, medcap=?, dep=?, grad=?, tarjp=?, fecgrad=?, tiptitul=?, dep=?";
		$sql .= " WHERE idedusup={$this->idedusup};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getNomedusup(), $this->getUlsecu(), $this->getFeculsem(), $this->getModest(), $this->getMedcap(), $this->getDep(), $this->getGrad(), $this->getTarjp(), $this->getFecgrad(), $this->getTiptitul(), $this->getDep());
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

	public function getEdu(){
		$sql="SELECT count(perid) AS edu FROM dats WHERE perid='".$this->perid."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	//Funciones para llamar la tabla del dominio para los campos de seleccion en la vista

	public function Tiptitul(){
		$sql="SELECT * FROM valor WHERE parid = 57";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}
	public function ulsecu(){
		$sql="SELECT * FROM valor WHERE parid = 56";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}
		public function medcap(){
		$sql="SELECT * FROM valor WHERE parid = 49";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}
	public function modest(){
		$sql="SELECT * FROM valor WHERE parid = 48";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}
	public function grad(){
		$sql="SELECT * FROM valor WHERE parid = 58";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}
	public function tarjp(){
		$sql="SELECT * FROM valor WHERE parid = 59";
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
	
}