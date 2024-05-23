<?php 
//detpaa
class Alertas{

	public function __construct() {
		$this->db = conexion::get_conexion();
	}

	public function getAproFinanCDP($area,$areSel,$flu1,$flu2,$flu3,$flu4,$flu5,$flu6,$flu7,$flu8){
		$var1=$this->getFCrea(2);
		$var2=$this->getFCrea(3);
		$sql = "SELECT COUNT(dt.iddpa) FROM detpaa AS dt INNER JOIN rubro AS rub ON dt.codrub = rub.codrub INNER JOIN valfin AS m ON dt.tipcondpa=m.vafid INNER JOIN valfin AS f ON dt.ftefindpa=f.vafid INNER JOIN valor AS a ON dt.area=a.valid INNER JOIN flujo as fl ON dt.idflu=fl.idflu WHERE dt.idpaa =  ".$this->idpaa." AND dt.idflu IN ($var1,$var2) AND dt.elidp=1 AND fl.areas=".$area;
		if ($areSel) {
			$sql .= " AND dt.area IN ($areSel)";
		}
		//echo "<br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	//Financiera

	//public function getAll8($area,$areSel,$flu1,$flu2,$flu3,$flu4){
	public function getAll8(){
		$sql = "SELECT COUNT(dt.iddpa) AS alerta FROM detpaa AS dt INNER JOIN rubro AS rub ON dt.codrub = rub.codrub INNER JOIN valfin AS m ON dt.tipcondpa=m.vafid INNER JOIN valfin AS f ON dt.ftefindpa=f.vafid INNER JOIN valor AS a ON dt.area=a.valid INNER JOIN flujo as fl ON dt.idflu=fl.idflu AND dt.elidp=1";
		// $sql .= " WHERE dt.idpaa = ".$this->idpaa;
		// $sql .= " AND dt.idflu IN (".$flu1.",".$flu2.",".$flu3.",".$flu4.")";
		// $sql .= " AND fl.areas=".$area;
		// if ($areSel) {
		// 	$sql .= " AND dt.area IN ($areSel)";
		// }
		// echo "<br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	public function getAll8_apr($area){
		$idpaa = $this->vigact();
		if($idpaa){
			$idpaa = $idpaa[0]['idpaa'];
			$var1=$this->getFCrea(2);
			$var2=$this->getFCrea(3);
			$sql = "SELECT COUNT(distinct dt.iddpa) AS alerta FROM detpaa AS dt INNER JOIN rubro AS rub ON dt.codrub = rub.codrub INNER JOIN valfin AS m ON dt.tipcondpa=m.vafid INNER JOIN valfin AS f ON dt.ftefindpa=f.vafid INNER JOIN valor AS a ON dt.area=a.valid INNER JOIN flujo as fl ON dt.idflu=fl.idflu WHERE dt.idpaa = ".$idpaa." AND dt.idflu IN ($var1,$var2) AND dt.elidp=1 AND fl.areas LIKE '%".$area."%'";
			//echo "<br><br>".$sql."<br><br>";
			echo "<script>console.log('Console: " . $sql . "' );</script>";
			
			$execute = $this->db->query($sql);
			$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);


		// var_dump($pfinan);
		// echo $this->db->error;
		// die();
		}else{
			echo "No se encuentra un PAA activo, comuníquese con sistemas. Verificar la base de datos Tabla PAA.";
			die();
		}
		return $pfinan;
	}

	public function sumcdpR_area($areas,$vigencia){
		$var1=$this->getFCrea(1);
		$var2=$this->getFCrea(4);
		$var3=$this->getFCrea(5);
		$sql = "SELECT count(asidpa) AS alerta FROM detpaa WHERE idflu NOT IN ($var1,$var2,$var3) AND area IN ($areas) AND elidp=1 AND idpaa=$vigencia";
		//echo "<br><br>".$sql."<br><br>";
		//echo "<script>console.log('Console: " . $sql . "' );</script>";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
	}

	public function sumcdpR($vigencia){
		$var1=$this->getFCrea(1);
		$var2=$this->getFCrea(4);
		$var3=$this->getFCrea(5);
		$sql = "SELECT count(asidpa) AS alerta FROM detpaa WHERE idflu NOT IN ($var1,$var2,$var3) AND elidp=1 AND idpaa=$vigencia";
		//echo "<br><br>".$sql."<br><br>";
		//echo "<script>console.log('Console: " . $sql . "' );</script>";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
	}

	//Denuncia
	public function getAll9(){
		$sql = "SELECT COUNT(denid) as alerta FROM denuncia";
		// $sql .= " WHERE dt.idpaa = ".$this->idpaa;
		// $sql .= " AND dt.idflu IN (".$flu1.",".$flu2.",".$flu3.",".$flu4.")";
		// $sql .= " AND fl.areas=".$area;
		// if ($areSel) {
		// 	$sql .= " AND dt.area IN ($areSel)";
		// }
		// echo "<br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	//Soporte
	public function getAll4($perid=0){
		$sql = "SELECT COUNT(idst) as alerta FROM soporte WHERE cerst=0";
		if($perid)
			$sql .= " AND cat IN (SELECT valid FROM catxper WHERE perid=$perid)";
		// echo "<br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	//DerAutor y Solicitudes temporales. dependiendo del tipo
	public function getAll11($tipo){
		$sql = "SELECT (SELECT count(iddap) FROM derautpre WHERE tipo='".$tipo."')-(SELECT count(DISTINCT p.iddap) FROM derautpre AS p INNER JOIN derautres AS r ON p.iddap=r.iddap WHERE p.tipo='".$tipo."') AS alerta";
		// echo "<br><br>".$sql."<br><br>";
		$execute = $this->db->query($sql);
		$pfinan = $execute->fetchall(PDO::FETCH_ASSOC);
		return $pfinan;
	}

	//Contratos
	public function getAll3($pefid, $depid){
		//$ano=date("Y");
		$sql = "SELECT COUNT(c.idcon) AS alerta FROM contrato AS c INNER JOIN persona AS e ON c.perid=e.perid INNER JOIN valor AS a ON c.valid=a.valid INNER JOIN parame AS n ON c.parid=n.parid INNER JOIN trazabilidad AS t ON c.idcon=t.idcon INNER JOIN valor AS v ON t.valid=v.valid WHERE c.elicon=1";
		//$sql .= " AND YEAR(t.fectra)='".$ano."'";
		$sql .= " AND t.valid NOT IN (64,68) AND t.fectra=(SELECT MAX(d.fectra) FROM trazabilidad as d WHERE d.idcon=c.idcon)";
		if($pefid==13){
			$sql .= " AND c.perid='".$_SESSION['perid']."'";
		}
		if($pefid==17){
			$sql .= " AND c.valid='".$depid."'";
		}
		if($pefid==16 OR $pefid==18){
			$sql .= " AND t.valid IN (SELECT valid FROM editexp WHERE pefid='".$pefid."')";
		}
		//echo "<br><br>".$sql."<br><br>".$_SESSION['perid']." - ".$depid;
		$execute = $this->db->query($sql);
		$rub = $execute->fetchall(PDO::FETCH_ASSOC);
		return $rub;
	}

	//Vigencia Activa
	public function vigact(){
		
		$sql = "SELECT idpaa FROM paa WHERE estpaa=3";
		$execute = $this->db->query($sql);
		$ordgasto = $execute->fetchall(PDO::FETCH_ASSOC);
		return $ordgasto;
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
}

?>