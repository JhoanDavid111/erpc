<?php
class Drive{

	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	

//Metodos CRUD
	public function saveCat($nomar,$area,$perid,$depcat){		
		if ($depcat>0) {
			$sql="SELECT perid, compartiuser FROM docgestion WHERE id = $depcat ";
			$execute = $this->db->query($sql);
			$save = $execute->fetchall(PDO::FETCH_ASSOC);	
		}
		if (isset($save)) {
			if (strlen($save[0]['compartiuser']) > 0) {
				$compar = $save[0]['compartiuser'].",".$save[0]['perid'];
				$sql = "INSERT INTO docgestion (perid,depcat,depid,nomar,tipod,compartiuser) VALUES ($perid,$depcat,$area,'$nomar',1,'$compar') ";
			}else{
				$sql = "INSERT INTO docgestion (perid,depcat,depid,nomar,tipod) VALUES ($perid,$depcat,$area,'$nomar',1) ";	
			}
		}else{
			$sql = "INSERT INTO docgestion (perid,depcat,depid,nomar,tipod) VALUES ($perid,$depcat,$area,'$nomar',1) ";	
		}
		
		$save = $this->db->query($sql);					
		return $save;
	}

	public function catAll($perid){	

		$sql="SELECT * FROM docgestion WHERE perid = $perid AND depcat = 0 AND tipod > 0 ORDER BY nomar ASC";
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		return $save;
		
	}

	public function selectAll(){	

		$sql="SELECT * FROM docgestion WHERE tipod > 0 ORDER BY nomar ASC";		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		return $save;
		
	}

	public function deleteCat($idecat){	

		$sql="DELETE  FROM docgestion WHERE id = $idecat ";	
		$execute = $this->db->query($sql);
		return $execute;		
	}

	public function obtenerCat($idcat){	

		$sql="SELECT * FROM docgestion WHERE id=$idcat";		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		// echo $sql;
		// die();
		return $save;
		
	}

	public function ediCat($idcat,$edicat){		
		
		$sql = "UPDATE docgestion SET nomar='$edicat' WHERE id= $idcat ";
		$save = $this->db->query($sql);	
		// var_dump($sql);			
		return $save;
	}

	public function contFolder($perid,$idcat){			
		$sql="SELECT * FROM docgestion WHERE (perid = $perid OR FIND_IN_SET('$perid', compartiuser) > 0  )AND depcat = $idcat ORDER BY nomar ASC";
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		return $save;
		
	}

		public function getFolder($idcat){	

		$sql="SELECT * FROM docgestion WHERE depcat = $idcat ORDER BY nomar ASC";
		
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		return $save;
		
	}

	public function contRama($idcat){	
		$sql="SELECT id, depcat, nomar FROM docgestion WHERE id = $idcat ";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);		

		// var_dump($save[0]['depcat']);
		// die();

		$rama = $save[0]['nomar'];
		$depcat = $save[0]['depcat'];

		while ($depcat != 0) {
            $sql = "SELECT depcat,nomar FROM docgestion WHERE id = $depcat ";
            $execute = $this->db->query($sql);
			$save = $execute->fetchall(PDO::FETCH_ASSOC);	
			$rama =  $save[0]['nomar'] ." ". '>' . " " . $rama;   
			$depcat = $save[0]['depcat'];
        }

        	// var_dump($rama);
			
		return $rama;		
	}

	public function getSubcarpetas($idcat){		
		$sql="SELECT id FROM docgestion WHERE depcat = $idcat ";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);	
		return $save;
	}

	public function agregadocRRHH($depcat,$perid,$area,$nombrearchivo,$nominterno,$tipodDocumento,$extension,$peso,$rutafinal){

		if ($depcat>0) {
			$sql="SELECT perid, compartiuser FROM docgestion WHERE id = $depcat ";
			$execute = $this->db->query($sql);
			$save = $execute->fetchall(PDO::FETCH_ASSOC);	
		}

		// var_dump($save);
		// die();

		if (isset($save)) {
			if (strlen($save[0]['compartiuser']) > 0) {
				$compar = $save[0]['compartiuser'].",".$save[0]['perid'];
				$sql = "INSERT INTO docgestion (depcat,perid,depid,nomar,nominterno,tipod,extension,peso,ruta,compartiuser) VALUES ($depcat,$perid,$area,'$nombrearchivo','$nominterno',$tipodDocumento,'$extension',$peso,'$rutafinal','$compar') ";
			}else{
				$sql = "INSERT INTO docgestion (depcat,perid,depid,nomar,nominterno,tipod,extension,peso,ruta) VALUES ($depcat,$perid,$area,'$nombrearchivo','$nominterno',$tipodDocumento,'$extension',$peso,'$rutafinal') ";	
			}
		}else{
			$sql = "INSERT INTO docgestion (depcat,perid,depid,nomar,nominterno,tipod,extension,peso,ruta) VALUES ($depcat,$perid,$area,'$nombrearchivo','$nominterno',$tipodDocumento,'$extension',$peso,'$rutafinal') ";	
		}
		

		// var_dump($sql);
		// die();	
		$save = $this->db->query($sql);					
		return $save;

	}

	public function allUserArea($area){
		$sql="SELECT perid,pernom,perape,peremail FROM persona WHERE depid = $area AND actemp=1 ORDER BY pernom ";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);	
		return $save;
	}

	public function saveShare($idcat,$usuarios){
		$sql = "UPDATE docgestion SET compartiuser='$usuarios' WHERE id= $idcat ";
		$save = $this->db->query($sql);	
		// var_dump($sql);			
		return $save;
	}

	public function conmigo($userperid){		
		$sql="SELECT * FROM docgestion WHERE FIND_IN_SET('$userperid', compartiuser) > 0; ";
		$execute = $this->db->query($sql);		
		$save = $execute->fetchall(PDO::FETCH_ASSOC);	
		return $save;

	}

	public function importTRD($area_id){
		$sql = "SELECT doctrd, destrd FROM trd WHERE (area = '$area_id' OR area LIKE '%$area_id;%') OR deptrd IN (SELECT doctrd FROM trd WHERE deptrd = '$area_id') ORDER BY doctrd";
	
		$execute = $this->db->query($sql);		
		$save = $execute->fetchall(PDO::FETCH_ASSOC);	
		return $save;
	}







}