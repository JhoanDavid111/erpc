<?php 
require_once '../../../config/db.php';
class Muni{
	
	private $db;
	public function __construct() {
		$this->db = conexion::get_conexion();
	}

	public function getDepto(){
		$sql ="SELECT ubiid, ubinom, ubidepto FROM ubica WHERE ubidepto='0' ORDER BY ubinom;";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		return $save;
	}

	public function getMun($id){
		$sql ="SELECT ubiid, ubinom, ubidepto FROM ubica WHERE ubidepto='$id' ORDER BY ubinom;";
		$execute = $this->db->query($sql);
		$save = $execute->fetchall(PDO::FETCH_ASSOC);
		return $save;
	}
}