<?php
class capeve{
	private $idce ;
	private $tipce;
	private $modce;
	private $nomce;
	private $entce;
	private $fecince;	
	private $fecfice;
	private $desce;				
	private $linkce;
	private $ubice;
	private $formce;
	private $comce;	
	private $asisce;	

	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	
//Metodos Get Devuelven el dato

	function getIdce (){
		return $this->idce;
	}
	function getTipce(){
		return $this->tipce;
	}
	function getModce(){
		return $this->modce;
	}
	function getNomce(){
		return $this->nomce;
	}
	function getEntce(){
		return $this->entce;
	}
	function getFecince(){
		return $this->fecince;
	}	
	function getFecfice(){
		return $this->fecfice;
	}
	function getDesce(){
		return $this->desce;
	}
	function getLinkce(){
		return $this->linkce;
	}
	function getUbice(){
		return $this->ubice;
	}
	function getFormce(){
		return $this->formce;
	}
	function getComce(){
		return $this->comce;
	}
	function getAsisce(){
		return $this->asisce;
	}

//Metodos Set Guardan el dato

	function setIdce($idce){
		$this->idce = $idce;
	}
	function setTipce($tipce){
		$this->tipce = $tipce;
	}
	function setModce($modce){
		$this->modce = $modce;
	}
	function setNomce($nomce){
		$this->nomce = $nomce;
	}
	function setEntce($entce){
		$this->entce = $entce;
	}
	function setFecince($fecince){
		$this->fecince = $fecince;
	}
	function setFecfice($fecfice){
		$this->fecfice = $fecfice;
	}
	function setDesce($desce){
		$this->desce = $desce;
	}
	function setLinkce($linkce){
		$this->linkce = $linkce;
	}	
	function setUbice($ubice){
		$this->ubice = $ubice;
	}
	function setFormce($formce){
		$this->formce = $formce;
	}
	function setComce($comce) {
		$this->comce = $comce;
	}
	function setAsisce($asisce) {
		$this->asisce = $asisce;
	}

//Funciones para llamar la tabla del dominio para los campos de seleccion en la vista
	public function getValdom($id){
		$sql="SELECT * FROM valor WHERE parid = '".$id."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}
	
//Metodos CRUD
	public function getOne(){
		$sql="SELECT c.idce, c.tipce, t.valnom AS tipo, c.modce, m.valnom AS modal, c.nomce, c.entce, c.fecince, c.fecfice, c.desce, c.linkce, c.ubice, c.formce, f.valnom AS forma, c.comce, c.asisce FROM capeve AS c LEFT JOIN valor AS t ON c.tipce=t.valid LEFT JOIN valor AS m ON c.modce=m.valid LEFT JOIN valor AS f ON c.formce=f.valid WHERE c.idce='".$this->idce."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		// echo $sql."<br><br>";
		// var_dump($pfinan);
		// die();
		return $pfinan;
	}
	public function getAlles(){
		$sql="SELECT c.idce, c.tipce, t.valnom AS tipo, c.modce, m.valnom AS modal, c.nomce, c.entce, c.fecince, c.fecfice, c.desce, c.linkce, c.ubice, c.formce, f.valnom AS forma, c.comce, c.asisce FROM capeve AS c LEFT JOIN valor AS t ON c.tipce=t.valid LEFT JOIN valor AS m ON c.modce=m.valid LEFT JOIN valor AS f ON c.formce=f.valid";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function getList(){
		$sql="SELECT l.idce, l.idequ, l.perid, l.asis, em.perid, em.nodocemp, em.pernom, em.perape, em.peremail, em.ubiid, u.ubinom, u.ubidepto, em.perdir, em.pertel, em.percel, em.pefid, em.depid, v.valnom, em.envema, em.actemp, em.ordgas, em.planta, em.cargo, c.valnom as carg FROM persona AS em INNER JOIN ceins AS l ON em.perid=l.perid LEFT JOIN valor AS c ON em.cargo=c.valid LEFT JOIN ubica AS u ON em.ubiid=u.ubiid LEFT JOIN valor AS v ON em.depid=v.valid WHERE l.idce='".$this->idce."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function getTotCE($idce){
		$sql="SELECT 'No Asistieron' AS tit, COUNT(idce) AS can FROM ceins WHERE idce='".$idce."' AND asis=2 UNION SELECT 'Asistieron' AS tit, COUNT(idce) AS can FROM ceins WHERE idce='".$idce."' AND asis=1 UNION SELECT 'Total Inscritos' AS tit, COUNT(idce) AS can FROM ceins WHERE idce='".$idce."'";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	//Funcion guardar datos en la BD
	
	public function save(){
		$sql= "INSERT INTO capeve (idce, tipce, modce, nomce, entce, fecince, fecfice, desce, linkce, ubice, formce, comce, asisce) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getIdce(), $this->getTipce(), $this->getModce(), $this->getNomce(), $this->getEntce(), $this->getFecince(), $this->getFecfice(), $this->getDesce(), $this->getLinkce(), $this->getUbice(), $this->getFormce(), $this->getComce(), $this->getAsisce());
		//echo $this->db->error;
		//echo $sql;
		//var_dump($arrdata);
		//die();
		$save = $insert->execute($arrdata);		
	}

	//Funcion editar los campos de la vista

	public function edit(){		

		$sql = "UPDATE capeve SET tipce=?, modce=?, nomce=?, entce=?, fecince=?, fecfice=?, desce=?, linkce=?, ubice=?, formce=?, comce=?, asisce=?";
		$sql .= " WHERE idce={$this->idce};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getTipce(), $this->getModce(), $this->getNomce(), $this->getEntce(), $this->getFecince(), $this->getFecfice(), $this->getDesce(), $this->getLinkce(), $this->getUbice(), $this->getFormce(), $this->getComce(), $this->getAsisce());
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
		
}