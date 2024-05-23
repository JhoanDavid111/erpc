<?php 
//detpaa
class Newpaa{

	private $idpaa;
	private $despaa;
	private $estpaa;		
	private $ninipaa;
	private $db;
	
	public function __construct() {
		$this->db = conexion::get_conexion();
	}

	function getIdpaa() {
		return $this->idpaa;
	}	

	function getDespaa() {
		return $this->despaa;
	}	

	function getEstpaa() {
		return $this->estpaa;
	}

	function getNinipaa() {
		return $this->ninipaa;
	}

	
	//SET

	function setIdpaa($idpaa) {
		$this->idpaa = $idpaa;
	}	

	function setDespaa($despaa) {
		$this->despaa = $despaa;
	}	

	function setEstpaa($estpaa) {
		$this->estpaa = $estpaa;
	}

	function setNinipaa($ninipaa) {
		$this->ninipaa = $ninipaa;
	}

	
	//METODOS

	public function saveNP(){
		$sql= "INSERT INTO paa(idpaa, despaa, estpaa, ninipaa) VALUES (?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getIdpaa(), $this->getDespaa(), $this->getEstpaa(), $this->getNinipaa());
		$save = $insert->execute($arrdata);

		// var_dump($save);
		// echo $this->db->errorInfo();
		// die();
	}

	public function getAll4($area=NULL){
		// var_dump($this->idpaa);
		// die();
		
		// $sql = "SELECT dt.*, rub.* FROM detpaa dt "
		// 		. "INNER JOIN rubro rub ON dt.codrub = rub.codrub "
		// 		. " WHERE dt.idpaa = ".$this->idpaa;		
		// $execute = $this->db->query($sql);
		// $pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		$sql = "SELECT dt.*, rub.*, val.*, valu.* FROM detpaa dt "
				. "INNER JOIN rubro rub ON dt.codrub = rub.codrub "
				. "INNER JOIN valfin val ON dt.objdpa = val.vafid  "
				. "INNER JOIN valor valu ON dt.area = valu.valid"
				. " WHERE dt.idpaa = ".$this->idpaa." AND dt.elidp=1";

		if ($area) {
			$sql .= " and dt.area IN ($area)";
		}		
		
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

			
		return $pfinan;
	}

	public function getAllAnEl(){
		$sql = "SELECT dt.*, rub.*, val.*, valu.* FROM detpaa dt INNER JOIN rubro rub ON dt.codrub = rub.codrub INNER JOIN valfin val ON dt.objdpa = val.vafid INNER JOIN valor valu ON dt.area = valu.valid INNER JOIN paa AS p ON dt.idpaa=p.idpaa WHERE dt.elidp=2 AND p.estpaa<3";
		//echo "<br>".$sql."<br>";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		return $pfinan;
	}

	

	public function getVig(){
		$sql = "SELECT DISTINCT idpaa FROM paa ORDER BY idpaa DESC";		
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);

		
		return $pfinan;
	}

	public function getEstado(){
		$sql = "SELECT p.*, val.* FROM paa p "
				. "INNER JOIN valfin val ON p.estpaa = val.vafid "
				. " WHERE p.idpaa = ".$this->idpaa;		
		$execute = $this->db->query($sql);
		$estado = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($estado);
		// die();

		return $estado;
	}

	public function getEstados(){
		// $sql = "SELECT p.*, val.* FROM paa p "
		// 		. "INNER JOIN valfin val ON p.estpaa = val.vafid "
		// 		. " WHERE p.idpaa = ".$this->idpaa;	

		$sql = "SELECT * FROM valfin WHERE dofid=1";
				

		$execute = $this->db->query($sql);
		$estado = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($estado);
		// die();

		return $estado;
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

		

		return $edpf;
	}

	public function getRub($editp){
		
		$sql = "SELECT * FROM rubro WHERE actrub = 1 ORDER BY codrub DESC";
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);

	
		return $rub;
	}

	public function edit(){		

		$sql = "UPDATE rubro SET nomrub=?,deprub=?,actrub=? ";
		$sql .= " WHERE codrub={$this->codrub};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getNomrub(), $this->getDeprub(), $this->getActrub());
		$save=$update->execute($arrdata);
					
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function editEst(){		

		$sql = "UPDATE paa SET despaa=?,ninipaa=?, estpaa=? ";
		$sql .= " WHERE idpaa={$this->idpaa};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getDespaa(), $this->getNinipaa(), $this->getEstpaa());
		$save=$update->execute($arrdata);
					
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function histobus($iddpa){
		$sql= "SELECT prd.*, pr.*, per.pernom, per.perape FROM provbusd AS prd INNER JOIN provbus AS pr ON prd.idpb=pr.idpb INNER JOIN persona AS per ON per.perid=pr.perid WHERE pr.iddpa=$iddpa AND pr.salvado=1;";
		$execute = $this->db->query($sql);
		// var_dump($sql);
		// die();
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		
		return $save;
	}

	public function busprove($histo){
		$sql= "SELECT (SELECT ROUND(AVG(pc.califica)) FROM provcali AS pc WHERE pc.idprov=p.nit) AS prome, p.* FROM proveedor AS p WHERE idprov IN (".$histo.")";
		$execute = $this->db->query($sql);
		// var_dump($sql);
		// die();
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		
		return $save;
	}








	

}

?>