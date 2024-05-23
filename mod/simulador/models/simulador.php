<?php

class Simulador{
	
	private $db;

	public function __construct() {
		$this->db = conexion::get_conexion();
	}
	


//Metodos CRUD
	public function getAll(){
		$sql = "SELECT DISTINCT rangosalario FROM simulador ORDER BY rangosalario ASC";		
		$execute = $this->db->query($sql);
		$sal = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($sal);
		// die();

		return $sal;
	}

	public function getOne($selsal){
		$sql ="SELECT DISTINCT * FROM simulador WHERE rangosalario = $selsal ";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		//var_dump($save);
		// $error= $this->db->errorInfo();
		//die();
		return $save;
	}

	public function getAllVal($parid){
		$sql ="SELECT * FROM valor WHERE parid = ".$parid." ORDER BY valnom";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);

		// var_dump($save);
		// $error= $this->db->errorInfo();
		// die();
		return $save;
	}

	public function save(){
		$sql= "INSERT INTO denuncia(denano, denfec, denpro, dennom, denape, denide, dentel, denema, dentip, dendes, denarc) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
		$insert = $this->db->prepare($sql);
		$arrdata = array($this->getDenano(),$this->getDenfec(), $this->getDenpro(), $this->getDennom(), $this->getDenape(), $this->getDenide(), $this->getDentel(), $this->getDenema(), $this->getDentip(), $this->getDendes(), $this->getDenarc());
// 	echo $sql;
// 	var_dump($arrdata);
// die();
		$save = $insert->execute($arrdata);
	}

	public function edit(){		

		$sql = "UPDATE denuncia SET denano=?, denfec=?,denpro=?,dennom=?,denape=?,denide=?, dentel=?, denema=?, dentip=?, dendes=?, denarc=? ";
		$sql .= " WHERE denid={$this->denid};";	

		$update= $this->db->prepare($sql);
		$arrdata = array($this->getDenano(),$this->getDenfec(), $this->getDenpro(), $this->getDennom(), $this->getDenape(), $this->getDenide(), $this->getDentel(), $this->getDenema(), $this->getDentip(), $this->getDendes(), $this->getDenarc());
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
}